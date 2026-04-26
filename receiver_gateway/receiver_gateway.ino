// =============================================================================
//  SMART BUOY — ESP32 (Gateway / Receiver)
//  Role   : Stay awake, receive LoRa packets → POST JSON to Web API via WiFi
//  Author : Senior Embedded Systems & IoT Engineer
//  Board  : ESP32 Dev Module
// =============================================================================

#include <SPI.h>
#include <LoRa.h>       // Sandeep Mistry  https://github.com/sandeepmistry/arduino-LoRa
#include <WiFi.h>
#include <HTTPClient.h>
#include <ArduinoJson.h> 

// ---------------------------------------------------------------------------
// WiFi Credentials  — REPLACE with your network details
// ---------------------------------------------------------------------------
const char* WIFI_SSID     = "HUAWEI-2.4G-V6aF";
const char* WIFI_PASSWORD = "WCKT9Q8f";

// ---------------------------------------------------------------------------
// API Endpoint  — REPLACE with your server URL
// ---------------------------------------------------------------------------
const char* API_ENDPOINT  = "http://192.168.100.51:5000/api/buoy-data";
// const char* API_ENDPOINT  = "http://marisense.networq.online/api/buoy-data";

// ---------------------------------------------------------------------------
// LoRa Pin Mapping  (ESP32)
// ---------------------------------------------------------------------------
#define LORA_SCK   18
#define LORA_MISO  19
#define LORA_MOSI  23
#define LORA_SS     5   // Chip Select
#define LORA_RST   14
#define LORA_DIO0   2   // IRQ

// ---------------------------------------------------------------------------
// LoRa Settings  — Must match the sender!
// ---------------------------------------------------------------------------
#define LORA_FREQ  433E6   // 433 MHz — change to 915E6 for North America / AU

// ---------------------------------------------------------------------------
// Timing constants
// ---------------------------------------------------------------------------
#define WIFI_TIMEOUT_MS      15000   // Max time to wait for WiFi connection
#define WIFI_RETRY_INTERVAL  30000   // Re-attempt WiFi if disconnected (ms)
#define HTTP_TIMEOUT_MS       8000   // HTTP request timeout

// ---------------------------------------------------------------------------
// Shared Data Structure (must be IDENTICAL in both sketches)
// ---------------------------------------------------------------------------
struct BuoyData {
  float pitch;
  float roll;
  int   hallState;
  int   packetID;
};

// ---------------------------------------------------------------------------
// State tracking
// ---------------------------------------------------------------------------
unsigned long lastWifiRetry = 0;
int           packetsReceived = 0;
int           packetsPosted   = 0;

// ===========================================================================
//  connectWiFi()  — Attempt to connect/reconnect; non-blocking with timeout
//  Returns: true if connected, false if timed out
// ===========================================================================
bool connectWiFi() {
  if (WiFi.status() == WL_CONNECTED) return true;

  Serial.printf("[WiFi]    Connecting to '%s'", WIFI_SSID);
  WiFi.mode(WIFI_STA);
  WiFi.begin(WIFI_SSID, WIFI_PASSWORD);

  unsigned long start = millis();
  while (WiFi.status() != WL_CONNECTED) {
    if (millis() - start > WIFI_TIMEOUT_MS) {
      Serial.println(F("\n[WiFi]    Timeout! Will retry later."));
      return false;
    }
    delay(500);
    Serial.print('.');
  }

  Serial.printf("\n[WiFi]    Connected — IP: %s  RSSI: %d dBm\n",
                WiFi.localIP().toString().c_str(), WiFi.RSSI());
  return true;
}

// ===========================================================================
//  postToAPI()  — Serialize BuoyData + RSSI to JSON and POST to API endpoint
//  Returns: HTTP response code, or negative on error
// ===========================================================================
int postToAPI(const BuoyData& data, int rssi) {
  if (WiFi.status() != WL_CONNECTED) {
    Serial.println(F("[HTTP]    Not connected — skipping POST"));
    return -1;
  }

  // ── Build JSON payload ────────────────────────────────────────────────────
  // Using ArduinoJson for safe, well-formed JSON (avoids manual sprintf bugs)
  StaticJsonDocument<256> doc;
  doc["pitch"]     = serialized(String(data.pitch,  2));
  doc["roll"]      = serialized(String(data.roll,   2));
  doc["hall"]      = data.hallState;
  doc["packetId"]  = data.packetID;
  doc["rssi"]      = rssi;

  String jsonPayload;
  serializeJson(doc, jsonPayload);
  Serial.printf("[HTTP]    Payload: %s\n", jsonPayload.c_str());

  // ── Send HTTP POST ────────────────────────────────────────────────────────
  HTTPClient http;
  http.begin(API_ENDPOINT);
  http.addHeader("Content-Type", "application/json");
  http.setTimeout(HTTP_TIMEOUT_MS);

  int httpCode = http.POST(jsonPayload);

  // ── Handle response ───────────────────────────────────────────────────────
  if (httpCode > 0) {
    // Positive code = valid HTTP response from server
    String responseBody = http.getString();
    if (httpCode == HTTP_CODE_OK || httpCode == HTTP_CODE_CREATED) {
      packetsPosted++;
      Serial.printf("[HTTP]    SUCCESS %d — Server: %s\n",
                    httpCode, responseBody.c_str());
    } else {
      // Server returned an error status (4xx / 5xx)
      Serial.printf("[HTTP]    Server error %d — Body: %s\n",
                    httpCode, responseBody.c_str());
    }
  } else {
    // Negative code = client-side / transport error
    Serial.printf("[HTTP]    Request failed — Error: %s\n",
                  http.errorToString(httpCode).c_str());
  }

  http.end();
  return httpCode;
}

// ===========================================================================
//  setup()
// ===========================================================================
void setup() {
  Serial.begin(115200);
  delay(200);
  Serial.println(F("\n[GATEWAY] Smart Buoy Gateway starting up..."));

  // ── WiFi ──────────────────────────────────────────────────────────────────
  connectWiFi();

  // ── LoRa Initialisation ───────────────────────────────────────────────────
  SPI.begin(LORA_SCK, LORA_MISO, LORA_MOSI, LORA_SS);
  LoRa.setPins(LORA_SS, LORA_RST, LORA_DIO0);

  while (!LoRa.begin(LORA_FREQ)) {
    Serial.println(F("[LoRa]    Init failed — retrying in 2 s..."));
    delay(2000);
  }

  // Optional: match sender's spreading factor if you changed it
  // LoRa.setSpreadingFactor(10);

  Serial.println(F("[LoRa]    Initialized — listening for packets"));
  Serial.println(F("[GATEWAY] Ready.\n"));
}

// ===========================================================================
//  loop()  — Non-blocking: check LoRa, handle WiFi drops, print stats
// ===========================================================================
void loop() {

  // ── 1. Attempt WiFi reconnection if disconnected ──────────────────────────
  if (WiFi.status() != WL_CONNECTED) {
    unsigned long now = millis();
    if (now - lastWifiRetry > WIFI_RETRY_INTERVAL) {
      lastWifiRetry = now;
      Serial.println(F("[WiFi]    Disconnected — attempting reconnect..."));
      connectWiFi();
    }
  }

  // ── 2. Poll LoRa for incoming packets (non-blocking) ─────────────────────
  int packetSize = LoRa.parsePacket();

  if (packetSize == 0) {
    // Nothing arrived — yield and return immediately
    yield();
    return;
  }

  // ── 3. Validate packet size matches expected struct ───────────────────────
  if (packetSize != sizeof(BuoyData)) {
    Serial.printf("[LoRa]    WARN: Unexpected packet size %d (expected %d) — discarding\n",
                  packetSize, (int)sizeof(BuoyData));
    // Drain the buffer
    while (LoRa.available()) LoRa.read();
    return;
  }

  // ── 4. Read raw bytes into struct ─────────────────────────────────────────
  BuoyData rxData;
  LoRa.readBytes((uint8_t*)&rxData, sizeof(rxData));
  int rssi = LoRa.packetRssi();
  float snr = LoRa.packetSnr();
  packetsReceived++;

  // ── 5. Print to Serial Monitor ────────────────────────────────────────────
  Serial.println(F("─────────────────────────────────────────"));
  Serial.printf("[LoRa]    Packet #%d received\n",       rxData.packetID);
  Serial.printf("          Pitch    : %.2f °\n",         rxData.pitch);
  Serial.printf("          Roll     : %.2f °\n",         rxData.roll);
  Serial.printf("          Hall     : %d\n",             rxData.hallState);
  Serial.printf("          RSSI     : %d dBm\n",         rssi);
  Serial.printf("          SNR      : %.1f dB\n",        snr);
  Serial.printf("          Stats    : Rx=%d  Posted=%d\n",
                packetsReceived, packetsPosted);
  Serial.println(F("─────────────────────────────────────────"));

  // ── 6. POST to API ────────────────────────────────────────────────────────
  postToAPI(rxData, rssi);
}
