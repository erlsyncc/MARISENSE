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
// const char* SSID = "iPhone";
// const char* PASSWORD = "hotspot0123";

// =============================================================================
// API
// =============================================================================
const char* API_ENDPOINT =
  "https://marisense.networq.online/api/buoy-data";

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
// OVERRIDE MODES
// =============================================================================
enum OverrideMode {
  MODE_NORMAL,
  MODE_MODERATE,
  MODE_DANGER
};

OverrideMode currentMode = MODE_NORMAL;

// =============================================================================
// PACKED STRUCT
// =============================================================================
struct __attribute__((packed)) BuoyData {
  float pitch;
  float roll;
  float waveHeight;
  float waterTemp;
  float windSpeed;
  int packetID;
};

// =============================================================================
// TIMING
// =============================================================================
unsigned long lastSendTime = 0;
const unsigned long SEND_INTERVAL = 60000;

// =============================================================================
// RANDOM FLOAT
// =============================================================================
float randomFloat(float minVal, float maxVal) {
  return minVal +
    ((float)random(0, 10000) / 10000.0f)
    * (maxVal - minVal);
}

// =============================================================================
// WIFI CONNECT
// =============================================================================
void connectWiFi() {
  if (WiFi.status() == WL_CONNECTED)
    return;

  Serial.println("[WiFi] Connecting...");
  WiFi.begin(SSID, PASSWORD);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println();
  Serial.println("[WiFi] Connected");
  Serial.print("[WiFi] IP: ");
  Serial.println(WiFi.localIP());
}

// =============================================================================
// PRINT RAW HEX
// =============================================================================
void printRawHex(uint8_t* buffer, int len) {
  Serial.println("Raw HEX:");
  for (int i = 0; i < len; i++) {
    if (buffer[i] < 0x10) Serial.print("0");
    Serial.print(buffer[i], HEX);
    Serial.print(" ");
  }
  Serial.println();
}

// =============================================================================
// SEND TO API
// =============================================================================
void sendToAPI(BuoyData data, int rssi, float snr) {

  // --------------------------------------------------------------------------
  // OVERRIDE MODES (Simulation Logic)
  // --------------------------------------------------------------------------
  if (currentMode == MODE_MODERATE) {
    data.waveHeight = randomFloat(0.8,  1.5);
    data.windSpeed  = randomFloat(7.0,  12.0);
    data.waterTemp  = randomFloat(28.0, 30.0);
    data.pitch      = randomFloat(10.0, 25.0);
    // FIX: roll was always 0 in simulation — now randomised
    data.roll       = randomFloat(8.0,  20.0);
    // FIX: simulate realistic signal values instead of hardcoded constants
    rssi            = (int)randomFloat(-80.0, -55.0);
    snr             = randomFloat(4.0, 9.0);
    Serial.println("[SIMULATION] MODERATE MODE ACTIVE");

  } else if (currentMode == MODE_DANGER) {
    data.waveHeight = randomFloat(2.5,  6.0);
    data.windSpeed  = randomFloat(18.0, 35.0);
    data.waterTemp  = randomFloat(29.0, 33.0);
    data.pitch      = randomFloat(28.0, 50.0);
    // FIX: roll was always 0 in simulation — now randomised
    data.roll       = randomFloat(25.0, 45.0);
    // FIX: danger mode implies worse signal
    rssi            = (int)randomFloat(-100.0, -70.0);
    snr             = randomFloat(-2.0, 4.0);
    Serial.println("[SIMULATION] DANGER MODE ACTIVE");
  }

  if (WiFi.status() != WL_CONNECTED) {
    Serial.println("[HTTP] No WiFi");
    return;
  }

  // --------------------------------------------------------------------------
  // JSON
  // --------------------------------------------------------------------------
  StaticJsonDocument<768> doc;

  // Mandatory top-level fields
  doc["sampleCount"]    = 1;
  doc["avgWaveHeight"]  = data.waveHeight;
  doc["avgWindSpeed"]   = data.windSpeed;
  doc["maxWindSpeed"]   = data.windSpeed;

  // Nested pitch object
  JsonObject pitchObj = doc.createNestedObject("pitch");
  pitchObj["avg"] = data.pitch;

  // FIX: roll was never included in the JSON payload — added here
  JsonObject rollObj = doc.createNestedObject("roll");
  rollObj["avg"] = data.roll;

  // Nested waterTemp object
  JsonObject waterTempObj = doc.createNestedObject("waterTemp");
  waterTempObj["avg"] = data.waterTemp;

  // FIX: rssi and packetID were sent as debug metadata but never mapped
  //      in the controller. Renamed to match expected controller mapping.
  doc["packetID"] = data.packetID;
  doc["rssi"]     = rssi;   // controller will now map this to avg_rssi
  doc["snr"]      = snr;

  doc["mode"] = (currentMode == MODE_DANGER)   ? "danger"   :
                (currentMode == MODE_MODERATE) ? "moderate" : "normal";

  String payload;
  serializeJson(doc, payload);

  Serial.println("[HTTP] Sending Payload:");
  Serial.println(payload);

  // --------------------------------------------------------------------------
  // HTTP POST
  // --------------------------------------------------------------------------
  WiFiClientSecure client;
  client.setInsecure();
  HTTPClient http;

  http.begin(client, API_ENDPOINT);
  http.addHeader("Content-Type", "application/json");

  int httpCode = http.POST(payload);

  Serial.printf("[HTTP] Code: %d\n", httpCode);

  if (httpCode > 0) {
    String response = http.getString();
    Serial.println("[HTTP] Response:");
    Serial.println(response);
  } else {
    Serial.printf("[HTTP] Error: %s\n", http.errorToString(httpCode).c_str());
  }

  if (httpCode == 301 || httpCode == 302) {
    Serial.printf("[HTTP] Redirected to: %s\n", http.getLocation().c_str());
  }

  http.end();
}

// =============================================================================
// SETUP
// =============================================================================
void setup() {
  Serial.begin(115200);
  randomSeed(analogRead(0));

  Serial.println();
  Serial.println("=================================");
  Serial.println(" LORA RECEIVER + API");
  Serial.println("=================================");
  Serial.printf("Struct Size: %d bytes\n", sizeof(BuoyData));
  Serial.println();
  Serial.println("AVAILABLE COMMANDS:");
  Serial.println(" dang");
  Serial.println(" mod");
  Serial.println(" norm");
  Serial.println();

  connectWiFi();

  // --------------------------------------------------------------------------
  // LORA
  // --------------------------------------------------------------------------
  SPI.begin(LORA_SCK, LORA_MISO, LORA_MOSI, LORA_SS);
  LoRa.setPins(LORA_SS, LORA_RST, LORA_DIO0);

  if (!LoRa.begin(LORA_FREQ)) {
    Serial.println("[ERROR] LoRa init failed!");
    while (1);
  }

  LoRa.setSyncWord(0xF3);

  Serial.println("[OK] LoRa initialized");
  Serial.println("[INFO] Waiting for packets...");
}

// =============================================================================
// LOOP
// =============================================================================
void loop() {

  // --------------------------------------------------------------------------
  // SERIAL COMMANDS
  // --------------------------------------------------------------------------
  if (Serial.available()) {
    String cmd = Serial.readStringUntil('\n');
    cmd.trim();

    if (cmd == "dang") {
      currentMode = MODE_DANGER;
      Serial.println("[MODE] DANGER MODE ENABLED");
    } else if (cmd == "mod") {
      currentMode = MODE_MODERATE;
      Serial.println("[MODE] MODERATE MODE ENABLED");
    } else if (cmd == "norm") {
      currentMode = MODE_NORMAL;
      Serial.println("[MODE] NORMAL MODE ENABLED");
    }
  }

  // --------------------------------------------------------------------------
  // SCHEDULED SIMULATION SEND
  // --------------------------------------------------------------------------
  if (currentMode != MODE_NORMAL) {
    if (millis() - lastSendTime >= SEND_INTERVAL) {
      lastSendTime = millis();

      Serial.println("\n[SIMULATION] Triggering scheduled update...");

      BuoyData simData;
      simData.packetID   = random(1, 9999); // FIX: random ID instead of constant 888
      simData.pitch      = 0;  // overwritten by sendToAPI simulation logic
      simData.roll       = 0;  // overwritten by sendToAPI simulation logic
      simData.waveHeight = 0;
      simData.waterTemp  = 0;
      simData.windSpeed  = 0;

      // FIX: rssi/snr are now also overwritten inside sendToAPI for sim modes,
      //      so these initial values don't matter — but passing 0/0 is cleaner
      //      than the old hardcoded -40 / 9.5
      sendToAPI(simData, 0, 0.0);
    }
  }

  // --------------------------------------------------------------------------
  // RECEIVE LORA
  // --------------------------------------------------------------------------
  int packetSize = LoRa.parsePacket();

  if (packetSize) {
    Serial.println();
    Serial.println("========== RECEIVED ==========");
    Serial.printf("Packet Size : %d\n", packetSize);
    Serial.printf("RSSI        : %d dBm\n", LoRa.packetRssi());
    Serial.printf("SNR         : %.2f\n",   LoRa.packetSnr());

    uint8_t rawBuffer[64];
    int index = 0;

    while (LoRa.available() && index < 64) {
      rawBuffer[index++] = LoRa.read();
    }

    printRawHex(rawBuffer, index);

    // ------------------------------------------------------------------------
    // DECODE
    // ------------------------------------------------------------------------
    if (index == sizeof(BuoyData)) {
      BuoyData data;
      memcpy(&data, rawBuffer, sizeof(BuoyData));

      Serial.println("--------------------------------");
      Serial.printf("Packet ID : %d\n",   data.packetID);
      Serial.printf("Pitch     : %.2f\n", data.pitch);
      Serial.printf("Roll      : %.2f\n", data.roll);
      Serial.printf("Wave      : %.2f m\n", data.waveHeight);
      Serial.printf("Temp      : %.2f C\n", data.waterTemp);
      Serial.printf("Wind      : %.2f m/s\n", data.windSpeed);
      Serial.println("--------------------------------");

      sendToAPI(data, LoRa.packetRssi(), LoRa.packetSnr());

    } else {
      Serial.println("[WARNING] Size mismatch!");
    }

    Serial.println("==============================");
  }
}
