


#include <SPI.h>
#include <LoRa.h>
#include <WiFiClientSecure.h>
#include <WiFi.h>
#include <HTTPClient.h>
#include <ArduinoJson.h>

// =============================================================================
// WIFI
// =============================================================================
const char* SSID = "HUAWEI-2.4G-V6aF";
const char* PASSWORD = "WCKT9Q8f";

// =============================================================================
// API
// =============================================================================
const char* API_ENDPOINT = "https://marisense.networq.online/api/buoy-data";

// =============================================================================
// LORA PINS
// =============================================================================
#define LORA_SCK   18
#define LORA_MISO  19
#define LORA_MOSI  23
#define LORA_SS     5
#define LORA_RST   14
#define LORA_DIO0   2
#define LORA_FREQ 433E6

// =============================================================================
// STRUCT & MODES
// =============================================================================
struct __attribute__((packed)) BuoyData {
  float pitch;
  float roll;
  float waveHeight;
  float waterTemp;
  float windSpeed;
  int packetID;
};

enum OverrideMode {
  MODE_NORMAL,
  MODE_MODERATE,
  MODE_DANGER
};

OverrideMode currentMode = MODE_NORMAL;

// =============================================================================
// AGGREGATION & TIMERS
// =============================================================================
float sumWave = 0, sumWind = 0, sumPitch = 0, sumRoll = 0, sumTemp = 0;
float maxWind = 0;
int sampleCount = 0;

unsigned long lastSendTime = 0;
const unsigned long SEND_INTERVAL = 60000; // 1 Minute

unsigned long lastSimTime = 0;
const unsigned long SIM_INTERVAL = 10000;  // Generate sim data every 10s

// =============================================================================
// WIFI CONNECT
// =============================================================================
void connectWiFi() {
  if (WiFi.status() == WL_CONNECTED) return;
  Serial.println("[WiFi] Connecting...");
  WiFi.begin(SSID, PASSWORD);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("\n[WiFi] Connected");
}

// =============================================================================
// SEND TO API
// =============================================================================
void sendToAPI(BuoyData data, int rssi, float snr) {
  if (WiFi.status() != WL_CONNECTED) { connectWiFi(); }

  StaticJsonDocument<768> doc;
  doc["sampleCount"]   = sampleCount;
  doc["avgWaveHeight"] = data.waveHeight;
  doc["avgWindSpeed"]  = data.windSpeed;
  doc["maxWindSpeed"]  = maxWind;
  doc["mode"]          = (int)currentMode; // Indicate mode to API

  doc.createNestedObject("pitch")["avg"] = data.pitch;
  doc.createNestedObject("roll")["avg"]  = data.roll;
  doc.createNestedObject("waterTemp")["avg"] = data.waterTemp;

  doc["packetID"] = data.packetID;
  doc["rssi"] = rssi;
  doc["snr"] = snr;

  String payload;
  serializeJson(doc, payload);

  WiFiClientSecure client;
  client.setInsecure();
  HTTPClient http;
  http.begin(client, API_ENDPOINT);
  http.addHeader("Content-Type", "application/json");

  int code = http.POST(payload);
  Serial.printf("[HTTP] Sent! Code: %d\n", code);
  http.end();
}

// =============================================================================
// SIMULATION LOGIC
// =============================================================================
void runSimulation() {
  if (currentMode == MODE_NORMAL) return;

  if (millis() - lastSimTime >= SIM_INTERVAL) {
    lastSimTime = millis();
    
    float sWind, sWave, sPitch, sRoll;
    
    if (currentMode == MODE_MODERATE) {
      sWind = 12.0 + (random(0, 500) / 100.0); // 12-17 m/s
      sWave = 1.5 + (random(0, 100) / 100.0);  // 1.5-3.0 m
      sPitch = random(-10, 10);
      sRoll = random(-15, 15);
    } else { // DANGER
      sWind = 30.0 + (random(0, 2000) / 100.0); // 30-50 m/s
      sWave = 4.0 + (random(0, 600) / 100.0);   // 4.0-10.0 m
      sPitch = random(-25, 25);
      sRoll = random(-35, 35);
    }

    sumWind += sWind;
    sumWave += sWave;
    sumPitch += sPitch;
    sumRoll += sRoll;
    sumTemp += 24.5; // Constant temp for sim
    if (sWind > maxWind) maxWind = sWind;
    sampleCount++;

    Serial.printf("[SIM] Mode:%d Wind:%.2f Samples:%d\n", (int)currentMode, sWind, sampleCount);
  }
}

// =============================================================================
// COMMAND HANDLING
// =============================================================================
void checkSerialCommands() {
  if (Serial.available() > 0) {
    String input = Serial.readStringUntil('\n');
    input.trim();
    input.toUpperCase();

    if (input == "NORMAL") {
      currentMode = MODE_NORMAL;
      Serial.println(">>> SWITCHED TO NORMAL MODE");
    } else if (input == "MODERATE") {
      currentMode = MODE_MODERATE;
      Serial.println(">>> SWITCHED TO MODERATE SIMULATION");
    } else if (input == "DANGER") {
      currentMode = MODE_DANGER;
      Serial.println(">>> SWITCHED TO DANGER SIMULATION");
    }
  }
}

// =============================================================================
// SETUP
// =============================================================================
void setup() {
  Serial.begin(115200);
  connectWiFi();

  SPI.begin(LORA_SCK, LORA_MISO, LORA_MOSI, LORA_SS);
  LoRa.setPins(LORA_SS, LORA_RST, LORA_DIO0);
  if (!LoRa.begin(LORA_FREQ)) {
    Serial.println("[ERROR] LoRa failed");
    while (1);
  }
  LoRa.setSyncWord(0xF3);
  Serial.println("[OK] Gateway Ready. Commands: NORMAL, MODERATE, DANGER");
}

// =============================================================================
// LOOP
// =============================================================================
void loop() {
  checkSerialCommands();
  runSimulation();

  // Handle incoming LoRa packets (Real Data)
  int packetSize = LoRa.parsePacket();
  if (packetSize == sizeof(BuoyData)) {
    BuoyData rxData;
    LoRa.readBytes((uint8_t*)&rxData, sizeof(BuoyData));

    sumWave += rxData.waveHeight;
    sumWind += rxData.windSpeed;
    sumPitch += rxData.pitch;
    sumRoll += rxData.roll;
    sumTemp += rxData.waterTemp;
    if (rxData.windSpeed > maxWind) maxWind = rxData.windSpeed;
    sampleCount++;

    Serial.printf("[RX] PacketID:%d Wind:%.2f\n", rxData.packetID, rxData.windSpeed);
  }

  // 1-Minute Reporting Trigger
  if (millis() - lastSendTime >= SEND_INTERVAL) {
    if (sampleCount > 0) {
      BuoyData report;
      report.waveHeight = sumWave / sampleCount;
      report.windSpeed  = sumWind / sampleCount;
      report.pitch      = sumPitch / sampleCount;
      report.roll       = sumRoll / sampleCount;
      report.waterTemp  = sumTemp / sampleCount;
      report.packetID   = 888; // Virtual ID for gateway report

      sendToAPI(report, (packetSize ? LoRa.packetRssi() : 0), (packetSize ? LoRa.packetSnr() : 0));
      
      // Reset Aggregators
      sumWave = sumWind = sumPitch = sumRoll = sumTemp = 0;
      maxWind = 0;
      sampleCount = 0;
    }
    lastSendTime = millis();
  }
}