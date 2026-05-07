// =============================================================================
//  SMART BUOY — NodeMCU (A0 Hall Edition)
// =============================================================================

#include <Wire.h>
#include <SPI.h>
#include <LoRa.h>
#include <OneWire.h>
#include <DallasTemperature.h>
#include <math.h>

#define ONE_WIRE_BUS  D3 
#define HALL_PIN      A0   // Solder point: Analog A0
#define LORA_SCK      D5 
#define LORA_MISO     D6 
#define LORA_MOSI     D7 
#define LORA_CS       D8 
#define LORA_RST      D4 
#define LORA_FREQ     433E6 
#define MPU_ADDR      0x68

// --- Constants ---
const float alpha = 0.97;
const int sampleRate = 50;  // 20Hz
const float radius = 0.04; 
const float anemFactor = 2.5; 
const int hallThreshold = 512; // Below this = Magnet Present

struct BuoyData {
  float pitch;
  float roll;
  float waveHeight;
  float waterTemp;
  float windSpeed;
  int   packetID;
};

OneWire oneWire(ONE_WIRE_BUS);
DallasTemperature ds18b20(&oneWire);

// --- Global State ---
int packetCounter = 0;
unsigned long lastSampleTime = 0;
unsigned long lastTxTime = 0;

// Integration & Wave Vars
float accelZPrev = 0, filtAccelPrev = 0;
float velocity = 0, displacement = 0;
float maxDisp = -999, minDisp = 999;

// Anemometer Logic (Analog Polling)
int pulseCount = 0;
bool magnetDetected = false; 

void mpu_writeRegister(uint8_t reg, uint8_t value) {
  Wire.beginTransmission(MPU_ADDR);
  Wire.write(reg);
  Wire.write(value);
  Wire.endTransmission();
}

bool mpu_readMotion(int16_t &ax, int16_t &ay, int16_t &az) {
  Wire.beginTransmission(MPU_ADDR);
  Wire.write(0x3B);
  Wire.endTransmission(false);
  if (Wire.requestFrom((uint8_t)MPU_ADDR, (uint8_t)6) != 6) return false;
  ax = (Wire.read() << 8) | Wire.read();
  ay = (Wire.read() << 8) | Wire.read();
  az = (Wire.read() << 8) | Wire.read();
  return true;
}

void setup() {
  Serial.begin(115200);
  Wire.begin(D2, D1);
  
  mpu_writeRegister(0x6B, 0x00); 
  mpu_writeRegister(0x1C, 0x00);
  
  ds18b20.begin();
  ds18b20.setResolution(12);
  ds18b20.setWaitForConversion(false);
  ds18b20.requestTemperatures();

  SPI.pins(LORA_SCK, LORA_MISO, LORA_MOSI, LORA_CS);
  LoRa.setPins(LORA_CS, LORA_RST, -1);
  if (!LoRa.begin(LORA_FREQ)) { while (1); }
  
  Serial.println(F("Marisense Online (A0 Hall Polling)"));
}

void loop() {
  unsigned long now = millis();

  // 1. HIGH-SPEED SAMPLING (Wave + Anemometer Check)
  if (now - lastSampleTime >= sampleRate) {
    float dt = (now - lastSampleTime) / 1000.0;
    lastSampleTime = now;

    // --- ANEMOMETER POLL (A0) ---
    int hallVal = analogRead(HALL_PIN);
    if (hallVal < hallThreshold) {
      if (!magnetDetected) { // Only count the initial drop (Edge Detection)
        pulseCount++;
        magnetDetected = true;
      }
    } else {
      magnetDetected = false; // Magnet has moved away
    }

    // --- WAVE HEIGHT INTEGRATION ---
    int16_t ax, ay, az;
    if (mpu_readMotion(ax, ay, az)) {
      float rawZ = (az / 16384.0f) * 9.81;
      float filtAccel = alpha * (filtAccelPrev + rawZ - accelZPrev);
      accelZPrev = rawZ;
      filtAccelPrev = filtAccel;

      velocity += filtAccel * dt;
      displacement += velocity * dt;

      if (displacement > maxDisp) maxDisp = displacement;
      if (displacement < minDisp) minDisp = displacement;
    }
  }

  // 2. TRANSMIT (1 Second)
  if (now - lastTxTime >= 1000) {
    lastTxTime = now;

    // Wind Speed calculation
    float rps = (float)pulseCount; 
    pulseCount = 0; 
    float windSpeed = (rps * (2.0 * PI * radius)) * anemFactor;

    float currentWaveHeight = (maxDisp == -999) ? 0 : (maxDisp - minDisp);
    float waterTemp = ds18b20.getTempCByIndex(0);
    ds18b20.requestTemperatures(); 

    BuoyData txData;
    txData.pitch = atan2f(0, accelZPrev) * (180.0f / PI);
    txData.roll = 0;
    txData.waveHeight = currentWaveHeight;
    txData.waterTemp = (waterTemp < -50) ? -99.0 : waterTemp;
    txData.windSpeed = windSpeed;
    txData.packetID = packetCounter++ & 0x7FFF;

    LoRa.beginPacket();
    LoRa.write((uint8_t*)&txData, sizeof(txData));
    LoRa.endPacket();

    Serial.printf("Wave: %.2fm | Wind: %.2f m/s\n", txData.waveHeight, txData.windSpeed);

    // Reset wave window
    velocity = 0;
    displacement = 0;
    maxDisp = -999;
    minDisp = 999;
  }
}