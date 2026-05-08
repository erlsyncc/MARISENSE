#include <Wire.h>
#include <SPI.h>
#include <LoRa.h>
#include <OneWire.h>
#include <DallasTemperature.h>
#include <math.h>

// =============================================================================
// PINS
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
// CONSTANTS
// =============================================================================
const float alpha = 0.97;
const int sampleRate = 50;
const float radius = 0.04;
const float anemFactor = 2.5;
const int hallThreshold = 512;

// =============================================================================
// PACKED STRUCT (IMPORTANT)
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
// OBJECTS
// =============================================================================
OneWire oneWire(ONE_WIRE_BUS);
DallasTemperature ds18b20(&oneWire);

// =============================================================================
// GLOBALS
// =============================================================================
int packetCounter = 0;

unsigned long lastSampleTime = 0;
unsigned long lastTxTime = 0;

float accelZPrev = 0;
float filtAccelPrev = 0;

float velocity = 0;
float displacement = 0;

float maxDisp = -999;
float minDisp = 999;

int pulseCount = 0;
bool magnetDetected = false;

// =============================================================================
// MPU FUNCTIONS
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

  if (Wire.requestFrom((uint8_t)MPU_ADDR, (uint8_t)6) != 6)
    return false;

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

  Serial.println();
  Serial.println("=================================");
  Serial.println(" SMART BUOY TRANSMITTER");
  Serial.println("=================================");

  Serial.printf("Struct Size: %d bytes\n", sizeof(BuoyData));

  // I2C
  Wire.begin(D2, D1);

  // MPU6050
  mpu_writeRegister(0x6B, 0x00);
  mpu_writeRegister(0x1C, 0x00);

  // Temperature Sensor
  ds18b20.begin();
  ds18b20.setResolution(12);
  ds18b20.setWaitForConversion(false);
  ds18b20.requestTemperatures();

  // LoRa
  SPI.pins(LORA_SCK, LORA_MISO, LORA_MOSI, LORA_CS);

  LoRa.setPins(LORA_CS, LORA_RST, -1);

  if (!LoRa.begin(LORA_FREQ)) {
    Serial.println("[ERROR] LoRa init failed!");
    while (1);
  }

  // IMPORTANT
  LoRa.setSyncWord(0xF3);

  Serial.println("[OK] LoRa initialized");
}

// =============================================================================
// LOOP
// =============================================================================
void loop() {

  unsigned long now = millis();

  // --------------------------------------------------------------------------
  // HIGH SPEED SAMPLING
  // --------------------------------------------------------------------------
  if (now - lastSampleTime >= sampleRate) {

    float dt = (now - lastSampleTime) / 1000.0f;

    lastSampleTime = now;

    // ------------------------------------------------------------------------
    // ANEMOMETER
    // ------------------------------------------------------------------------
    int hallVal = analogRead(HALL_PIN);

    if (hallVal < hallThreshold) {

      if (!magnetDetected) {
        pulseCount++;
        magnetDetected = true;
      }

    } else {

      magnetDetected = false;
    }

    // ------------------------------------------------------------------------
    // MPU6050
    // ------------------------------------------------------------------------
    int16_t ax, ay, az;

    if (mpu_readMotion(ax, ay, az)) {

      float rawZ = (az / 16384.0f) * 9.81;

      float filtAccel =
        alpha * (filtAccelPrev + rawZ - accelZPrev);

      accelZPrev = rawZ;
      filtAccelPrev = filtAccel;

      velocity += filtAccel * dt;
      displacement += velocity * dt;

      if (displacement > maxDisp)
        maxDisp = displacement;

      if (displacement < minDisp)
        minDisp = displacement;
    }
  }

  // --------------------------------------------------------------------------
  // TRANSMIT EVERY 1 SECOND
  // --------------------------------------------------------------------------
  if (now - lastTxTime >= 1000) {

    lastTxTime = now;

    float rps = (float)pulseCount;

    pulseCount = 0;

    float windSpeed =
      (rps * (2.0 * PI * radius)) * anemFactor;

    float currentWaveHeight =
      (maxDisp == -999) ? 0 : (maxDisp - minDisp);

    float waterTemp =
      ds18b20.getTempCByIndex(0);

    ds18b20.requestTemperatures();

    // ------------------------------------------------------------------------
    // CREATE DATA
    // ------------------------------------------------------------------------
    BuoyData txData;

    txData.pitch =
      atan2f(0, accelZPrev) * (180.0f / PI);

    txData.roll = 0;

    txData.waveHeight = currentWaveHeight;

    txData.waterTemp =
      (waterTemp < -50) ? -99.0 : waterTemp;

    txData.windSpeed = windSpeed;

    txData.packetID =
      packetCounter++;

    // ------------------------------------------------------------------------
    // SEND
    // ------------------------------------------------------------------------
    LoRa.beginPacket();

    LoRa.write((uint8_t*)&txData, sizeof(txData));

    LoRa.endPacket();

    // ------------------------------------------------------------------------
    // DEBUG
    // ------------------------------------------------------------------------
    Serial.println();
    Serial.println("========== SENT ==========");

    Serial.printf("Packet ID  : %d\n", txData.packetID);
    Serial.printf("Pitch      : %.2f\n", txData.pitch);
    Serial.printf("Roll       : %.2f\n", txData.roll);
    Serial.printf("Wave       : %.2f m\n", txData.waveHeight);
    Serial.printf("Temp       : %.2f C\n", txData.waterTemp);
    Serial.printf("Wind       : %.2f m/s\n", txData.windSpeed);

    Serial.println("==========================");

    // ------------------------------------------------------------------------
    // RESET WAVE WINDOW
    // ------------------------------------------------------------------------
    velocity = 0;
    displacement = 0;

    maxDisp = -999;
    minDisp = 999;
  }
}