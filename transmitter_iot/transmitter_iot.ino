#include <Wire.h>
#include <SPI.h>
#include <LoRa.h>
#include <OneWire.h>
#include <DallasTemperature.h>
#include <math.h>

// =============================================================================
// PINS & CONFIG
// =============================================================================
#define ONE_WIRE_BUS  D3
#define HALL_PIN      A0
#define LORA_SCK      D5
#define LORA_MISO     D6
#define LORA_MOSI     D7
#define LORA_CS       D8
#define LORA_RST      D4

#define LORA_FREQ     433E6
#define MPU_ADDR      0x68

// =============================================================================
// CONSTANTS & CALIBRATION
// =============================================================================
const float alpha = 0.97;       // High-pass filter coefficient
const int sampleRate = 50;      // 50ms = 20Hz
const float radius = 0.04;      // Anemometer radius in meters
const float anemFactor = 2.5;   // Calibration factor for wind
const int hallThreshold = 512;
const float accelDeadzone = 0.05; // Ignore acceleration noise below 0.05 m/s^2

// =============================================================================
// DATA STRUCTURE
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
// GLOBALS
// =============================================================================
OneWire oneWire(ONE_WIRE_BUS);
DallasTemperature ds18b20(&oneWire);

int packetCounter = 0;
unsigned long lastSampleTime = 0;
unsigned long lastTxTime = 0;

// Calibration Offsets
float azOffset = 0;
float axOffset = 0;
float ayOffset = 0;

// Integration Variables
float velocity = 0;
float displacement = 0;
float maxDisp = -999;
float minDisp = 999;

// Filtering Variables
float accelZPrev = 0;
float filtAccelPrev = 0;

// Anemometer
int pulseCount = 0;
bool magnetDetected = false;

// =============================================================================
// MPU HELPER FUNCTIONS
// =============================================================================
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

// =============================================================================
// SETUP
// =============================================================================
void setup() {
  Serial.begin(115200);
  Wire.begin(D2, D1);

  // Initialize MPU6050
  mpu_writeRegister(0x6B, 0x00); // Wake up
  mpu_writeRegister(0x1C, 0x00); // Set Accel to +/- 2g
  delay(100);

  // --- CALIBRATION ROUTINE ---
  Serial.println("Calibrating MPU6050... Keep Buoy Still");
  long sumX = 0, sumY = 0, sumZ = 0;
  int samples = 200;
  for(int i = 0; i < samples; i++) {
    int16_t ax, ay, az;
    if(mpu_readMotion(ax, ay, az)) {
      sumX += ax; sumY += ay; sumZ += az;
    }
    delay(5);
  }
  axOffset = sumX / (float)samples;
  ayOffset = sumY / (float)samples;
  azOffset = (sumZ / (float)samples) - 16384.0f; // Expecting 1g (16384) at rest
  Serial.println("Calibration Done.");

  // Initialize Sensors
  ds18b20.begin();
  ds18b20.setResolution(12);
  ds18b20.requestTemperatures();

  // LoRa Setup
  SPI.pins(LORA_SCK, LORA_MISO, LORA_MOSI, LORA_CS);
  LoRa.setPins(LORA_CS, LORA_RST, -1);
  if (!LoRa.begin(LORA_FREQ)) {
    Serial.println("LoRa Failed!");
    while (1);
  }
  LoRa.setSyncWord(0xF3);
}

// =============================================================================
// LOOP
// =============================================================================
void loop() {
  unsigned long now = millis();

  // 1. HIGH SPEED SAMPLING (MPU & ANEMOMETER)
  if (now - lastSampleTime >= sampleRate) {
    float dt = (now - lastSampleTime) / 1000.0f;
    lastSampleTime = now;

    // Wind Speed Pulse Counting
    int hallVal = analogRead(HALL_PIN);
    if (hallVal < hallThreshold) {
      if (!magnetDetected) { pulseCount++; magnetDetected = true; }
    } else {
      magnetDetected = false;
    }

    // MPU Processing
    int16_t rawX, rawY, rawZ;
    if (mpu_readMotion(rawX, rawY, rawZ)) {
      
      // Apply Offsets
      float calibratedZ = (rawZ - azOffset) / 16384.0f * 9.81;
      
      // DC Block / High Pass Filter (Removes gravity 9.81 component)
      float filtAccel = alpha * (filtAccelPrev + calibratedZ - accelZPrev);
      accelZPrev = calibratedZ;
      filtAccelPrev = filtAccel;

      // Apply Deadzone to stop drift when stationary
      if (abs(filtAccel) < accelDeadzone) filtAccel = 0;

      // Double Integration
      velocity += filtAccel * dt;
      displacement += velocity * dt;

      if (displacement > maxDisp) maxDisp = displacement;
      if (displacement < minDisp) minDisp = displacement;
    }
  }

  // 2. TRANSMIT DATA (EVERY 1 SECOND)
  if (now - lastTxTime >= 1000) {
    lastTxTime = now;

    // Calculate Wind Speed
    float rps = (float)pulseCount; 
    pulseCount = 0;
    float windSpeed = (rps * (2.0 * PI * radius)) * anemFactor;

    // Calculate Wave Height
    float currentWaveHeight = (maxDisp == -999) ? 0 : (maxDisp - minDisp);

    // Get Temperature
    float waterTemp = ds18b20.getTempCByIndex(0);
    ds18b20.requestTemperatures();

    // Orientation (Pitch/Roll)
    int16_t rx, ry, rz;
    mpu_readMotion(rx, ry, rz);
    float ax = (rx - axOffset) / 16384.0;
    float ay = (ry - ayOffset) / 16384.0;
    float az = (rz - azOffset) / 16384.0;

    BuoyData txData;
    txData.pitch = atan2(ay, az) * 180.0 / PI;
    txData.roll  = atan2(-ax, sqrt(ay * ay + az * az)) * 180.0 / PI;
    txData.waveHeight = currentWaveHeight;
    txData.waterTemp = (waterTemp < -50) ? -99.0 : waterTemp;
    txData.windSpeed = windSpeed;
    txData.packetID = packetCounter++;

    // LoRa Transmit
    LoRa.beginPacket();
    LoRa.write((uint8_t*)&txData, sizeof(txData));
    LoRa.endPacket();

    // Serial Debug
    Serial.printf("ID: %d | Pitch: %.1f | Roll: %.1f | Wave: %.2f m | Temp: %.1f C | Wind: %.1f m/s\n", 
                  txData.packetID, txData.pitch, txData.roll, txData.waveHeight, txData.waterTemp, txData.windSpeed);

    // RESET Integration to prevent long-term drift
    velocity = 0;
    displacement = 0;
    maxDisp = -999;
    minDisp = 999;
  }
}