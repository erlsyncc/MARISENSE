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

#define MPU_ADDR      0x68
#define LORA_FREQ     433E6

// =============================================================================
// DATA STRUCT
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
// SENSOR OBJECTS
// =============================================================================
OneWire oneWire(ONE_WIRE_BUS);
DallasTemperature ds18b20(&oneWire);

// =============================================================================
// GLOBALS
// =============================================================================
int packetCounter = 0;
unsigned long lastSampleTime = 0;
unsigned long lastTxTime = 0;

// MPU offsets
float axOffset = 0;
float ayOffset = 0;
float azOffset = 0;

// Wave estimation
float smoothedMotion = 0;
float maxWave = 0;
float estimatedWaveHeight = 0;

// Hall sensor
int pulseCount = 0;
bool magnetDetected = false;

// =============================================================================
// MPU HELPERS
// =============================================================================
void mpuWrite(uint8_t reg, uint8_t value) {
  Wire.beginTransmission(MPU_ADDR);
  Wire.write(reg);
  Wire.write(value);
  Wire.endTransmission();
}

bool mpuRead(int16_t &ax, int16_t &ay, int16_t &az) {

  Wire.beginTransmission(MPU_ADDR);
  Wire.write(0x3B);

  if (Wire.endTransmission(false) != 0)
    return false;

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

  Wire.begin(D2, D1);

  // --------------------------------------------------------------------------
  // MPU6050 INIT
  // --------------------------------------------------------------------------
  mpuWrite(0x6B, 0x00);

  delay(100);

  // --------------------------------------------------------------------------
  // CALIBRATION
  // --------------------------------------------------------------------------
  Serial.println("Calibrating MPU6050...");

  long sx = 0;
  long sy = 0;
  long sz = 0;

  const int samples = 200;

  for (int i = 0; i < samples; i++) {

    int16_t ax, ay, az;

    if (mpuRead(ax, ay, az)) {
      sx += ax;
      sy += ay;
      sz += az;
    }

    delay(5);
  }

  axOffset = sx / (float)samples;
  ayOffset = sy / (float)samples;
  azOffset = sz / (float)samples;

  Serial.println("Calibration done.");

  // --------------------------------------------------------------------------
  // TEMP SENSOR
  // --------------------------------------------------------------------------
  ds18b20.begin();

  // --------------------------------------------------------------------------
  // LORA
  // --------------------------------------------------------------------------
  SPI.pins(
    LORA_SCK,
    LORA_MISO,
    LORA_MOSI,
    LORA_CS
  );

  LoRa.setPins(
    LORA_CS,
    LORA_RST,
    -1
  );

  if (!LoRa.begin(LORA_FREQ)) {

    Serial.println("LoRa init failed!");

    while (1);
  }

  LoRa.setSyncWord(0xF3);

  Serial.println("LoRa Ready");
}

// =============================================================================
// LOOP
// =============================================================================
void loop() {

  unsigned long now = millis();

  // ===========================================================================
  // FAST SENSOR SAMPLING
  // ===========================================================================
  if (now - lastSampleTime >= 50) {

    lastSampleTime = now;

    // ------------------------------------------------------------------------
    // HALL SENSOR
    // ------------------------------------------------------------------------
    int hallVal = analogRead(HALL_PIN);

    if (hallVal < 400) {

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
    int16_t rawX, rawY, rawZ;

    if (mpuRead(rawX, rawY, rawZ)) {

      float ax =
        (rawX - axOffset) / 16384.0;

      float ay =
        (rawY - ayOffset) / 16384.0;

      float az =
        (rawZ - azOffset) / 16384.0;

      // ----------------------------------------------------------------------
      // PITCH & ROLL
      // ----------------------------------------------------------------------
      float pitch =
        atan2(ay, az) * 180.0 / PI;

      float roll =
        atan2(-ax,
        sqrt(ay * ay + az * az))
        * 180.0 / PI;

      // ----------------------------------------------------------------------
      // MOTION MAGNITUDE
      // ----------------------------------------------------------------------
      static float prevMotion = 0;

      float motion =
        sqrt(ax * ax + ay * ay + az * az);

      // CHANGE in movement
      float deltaMotion =
        abs(motion - prevMotion);

      prevMotion = motion;

      // Deadzone to ignore tiny noise
      if (deltaMotion < 0.015)
        deltaMotion = 0;

      // Smooth it
      smoothedMotion =
        (0.92 * smoothedMotion)
        + (0.08 * deltaMotion);

      // Convert to estimated wave height
      estimatedWaveHeight =
        smoothedMotion * 12.0;

      // Clamp
      if (estimatedWaveHeight < 0)
        estimatedWaveHeight = 0;

      if (estimatedWaveHeight > 6.0)
        estimatedWaveHeight = 6.0;

      if (estimatedWaveHeight > maxWave)
        maxWave = estimatedWaveHeight;
    }
  }

  // ===========================================================================
  // TRANSMIT EVERY 1 SECOND
  // ===========================================================================
  if (now - lastTxTime >= 1000) {

    lastTxTime = now;

    // ------------------------------------------------------------------------
    // READ MPU AGAIN FOR FINAL ORIENTATION
    // ------------------------------------------------------------------------
    int16_t rawX, rawY, rawZ;

    float pitch = 0;
    float roll  = 0;

    if (mpuRead(rawX, rawY, rawZ)) {

      float ax =
        (rawX - axOffset) / 16384.0;

      float ay =
        (rawY - ayOffset) / 16384.0;

      float az =
        (rawZ - azOffset) / 16384.0;

      pitch =
        atan2(ay, az) * 180.0 / PI;

      roll =
        atan2(-ax,
        sqrt(ay * ay + az * az))
        * 180.0 / PI;
    }

    // ------------------------------------------------------------------------
    // WATER TEMP
    // ------------------------------------------------------------------------
    ds18b20.requestTemperatures();

    float waterTemp =
      ds18b20.getTempCByIndex(0);

    if (waterTemp == DEVICE_DISCONNECTED_C ||
        isnan(waterTemp)) {

      waterTemp = -99.0;
    }

    // ------------------------------------------------------------------------
    // WIND SPEED
    // ------------------------------------------------------------------------
    float windSpeed =
      pulseCount * 0.8;

    pulseCount = 0;

    // ------------------------------------------------------------------------
    // PACK DATA
    // ------------------------------------------------------------------------
    BuoyData txData;

    txData.pitch      = pitch;
    txData.roll       = roll;
    txData.waveHeight = maxWave;
    txData.waterTemp  = waterTemp;
    txData.windSpeed  = windSpeed;
    txData.packetID   = packetCounter++;

    // ------------------------------------------------------------------------
    // SEND LORA
    // ------------------------------------------------------------------------
    LoRa.beginPacket();
    LoRa.write((uint8_t*)&txData,
               sizeof(txData));
    LoRa.endPacket();

    // ------------------------------------------------------------------------
    // DEBUG
    // ------------------------------------------------------------------------
    Serial.println();
    Serial.println("─────────────────────────────");

    Serial.printf("[TX #%d]\n",
      txData.packetID);

    Serial.printf("Pitch     : %.2f °\n",
      txData.pitch);

    Serial.printf("Roll      : %.2f °\n",
      txData.roll);

    Serial.printf("Wave Est  : %.2f m\n",
      txData.waveHeight);

    Serial.printf("WaterTemp : %.2f °C\n",
      txData.waterTemp);

    Serial.printf("Wind      : %.2f m/s\n",
      txData.windSpeed);

    Serial.println("─────────────────────────────");

    // Reset rolling wave peak
    maxWave *= 0.7;
  }
}