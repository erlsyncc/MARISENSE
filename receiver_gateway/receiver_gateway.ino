#include <SPI.h>
#include <LoRa.h>
#include <WiFi.h>
#include <WiFiMulti.h> // Added for multiple WiFi networks
#include <HTTPClient.h>
#include <ArduinoJson.h>

WiFiMulti wifiMulti; // Create instance

// ---------------------------------------------------------------------------
// API Endpoint
// ---------------------------------------------------------------------------
const char* API_ENDPOINT  = "http://192.168.100.51:5000/api/buoy-data";

// LoRa Pin Mapping (ESP32)
#define LORA_SCK   18
#define LORA_MISO  19
#define LORA_MOSI  23
#define LORA_SS     5
#define LORA_RST   14
#define LORA_DIO0   2
#define LORA_FREQ  433E6
#define AGGREGATE_WINDOW_MS  60000UL

// ---------------------------------------------------------------------------
// UPDATED Shared Data Structure — MATCHES TRANSMITTER
// ---------------------------------------------------------------------------
struct BuoyData {
  float pitch;
  float roll;
  float waveHeight;  // New
  float waterTemp;
  float windSpeed;   // New
  int   packetID;
};

// ---------------------------------------------------------------------------
// UPDATED Aggregation buffer
// ---------------------------------------------------------------------------
struct AggWindow {
  double pitchSum, rollSum, tempSum, rssiSum;
  double waveSum, windSum; // New tracking
  
  float pitchMin, pitchMax, rollMin, rollMax;
  float tempMin, tempMax, waveMin, waveMax, windMin, windMax;

  int sampleCount;
  int tempValidCount;
  unsigned long windowStart;

  void reset(unsigned long now) {
    pitchSum = rollSum = tempSum = rssiSum = waveSum = windSum = 0;
    sampleCount = tempValidCount = 0;
    windowStart = now;
    // Reset Min/Max logic handled in first ingest
  }

  void ingest(const BuoyData& d, int rssi) {
    sampleCount++;
    pitchSum += d.pitch;
    rollSum  += d.roll;
    waveSum  += d.waveHeight;
    windSum  += d.windSpeed;
    rssiSum  += rssi;

    if (sampleCount == 1) {
      pitchMin = pitchMax = d.pitch;
      rollMin  = rollMax  = d.roll;
      waveMin  = waveMax  = d.waveHeight;
      windMin  = windMax  = d.windSpeed;
    } else {
      if (d.pitch < pitchMin) pitchMin = d.pitch; if (d.pitch > pitchMax) pitchMax = d.pitch;
      if (d.waveHeight < waveMin) waveMin = d.waveHeight; if (d.waveHeight > waveMax) waveMax = d.waveHeight;
      if (d.windSpeed < windMin) windMin = d.windSpeed; if (d.windSpeed > windMax) windMax = d.windSpeed;
    }

    if (d.waterTemp > -100.0f) {
      tempSum += d.waterTemp;
      tempValidCount++;
      if (tempValidCount == 1) { tempMin = tempMax = d.waterTemp; }
      else {
        if (d.waterTemp < tempMin) tempMin = d.waterTemp;
        if (d.waterTemp > tempMax) tempMax = d.waterTemp;
      }
    }
  }
};

AggWindow agg;
int totalReceived = 0;

void setup() {
  Serial.begin(115200);
  
  // --- MULTI-WIFI SETUP ---
  wifiMulti.addAP("HUAWEI-2.4G-V6aF", "WCKT9Q8f"); // Home
  wifiMulti.addAP("iphone", "hotspot0123");       // Hotspot
  
  Serial.println("[WiFi] Connecting...");
  
  SPI.begin(LORA_SCK, LORA_MISO, LORA_MOSI, LORA_SS);
  LoRa.setPins(LORA_SS, LORA_RST, LORA_DIO0);

  if (!LoRa.begin(LORA_FREQ)) {
    Serial.println("[LoRa] Critical Failure!");
    while (1);
  }

  agg.reset(millis());
  Serial.println("[GATEWAY] Listening for Marisense Packets...");
}

void loop() {
  unsigned long now = millis();

  // 1. WiFi Multi Check (Handles reconnection automatically)
  if (wifiMulti.run() != WL_CONNECTED) {
    // We are offline, but wifiMulti.run() will keep trying APs in background
  }

  // 2. Window Check
  if (now - agg.windowStart >= AGGREGATE_WINDOW_MS) {
    postAggregate(agg, now);
    agg.reset(now);
  }

  // 3. LoRa Poll
  int packetSize = LoRa.parsePacket();
  if (packetSize == sizeof(BuoyData)) {
    BuoyData rxData;
    LoRa.readBytes((uint8_t*)&rxData, sizeof(rxData));
    agg.ingest(rxData, LoRa.packetRssi());
    totalReceived++;
    
    Serial.printf("[LoRa] Pkt#%d Rx (Wave: %.2fm, Wind: %.2fm/s)\n", 
                  rxData.packetID, rxData.waveHeight, rxData.windSpeed);
  }
}

void postAggregate(const AggWindow& w, unsigned long windowEnd) {
  if (w.sampleCount == 0 || WiFi.status() != WL_CONNECTED) return;

  StaticJsonDocument<1024> doc;
  
  // Basic Fields
  doc["sampleCount"]     = w.sampleCount;
  doc["avgWaveHeight"]   = w.waveSum / w.sampleCount;
  doc["avgWindSpeed"]    = w.windSum / w.sampleCount;
  doc["maxWindSpeed"]    = w.windMax;

  // Pitch Object (Required by your parseObjectField method)
  JsonObject pitch = doc.createNestedObject("pitch");
  pitch["avg"] = w.pitchSum / w.sampleCount;

  // WaterTemp Object (Required by your parseObjectField method)
  JsonObject wtemp = doc.createNestedObject("waterTemp");
  if (w.tempValidCount > 0) {
    wtemp["avg"] = w.tempSum / w.tempValidCount;
  } else {
    wtemp["avg"] = nullptr;
  }

  String jsonPayload;
  serializeJson(doc, jsonPayload);

  HTTPClient http;
  http.begin(API_ENDPOINT);
  http.addHeader("Content-Type", "application/json");
  
  int httpCode = http.POST(jsonPayload);
  Serial.printf("[HTTP] Code: %d\n", httpCode);
  http.end();
}