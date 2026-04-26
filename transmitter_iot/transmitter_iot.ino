#include <Wire.h>
#include <SPI.h>
#include <LoRa.h>

const uint8_t MPU = 0x68;

uint8_t readRegister(uint8_t reg) {
  Wire.beginTransmission(MPU);
  Wire.write(reg);
  Wire.endTransmission(false);
  Wire.requestFrom((uint8_t)MPU, (uint8_t)1);
  if (Wire.available()) return Wire.read();
  return 0xFF;
}

void writeRegister(uint8_t reg, uint8_t value) {
  Wire.beginTransmission(MPU);
  Wire.write(reg);
  Wire.write(value);
  Wire.endTransmission(false);
  delay(10);
}

void setup() {
  Serial.begin(115200);
  delay(1000);

  // MPU6050 init
  Wire.begin(D2, D1);
  delay(200);
  writeRegister(0x6B, 0x00);
  delay(200);
  byte pwr = readRegister(0x6B);
  if (pwr == 0x00) {
    Serial.println("[MPU6050] OK");
  } else {
    Serial.println("[MPU6050] FAILED");
  }

  // LoRa init
  SPI.pins(D5, D6, D7, D8);
  SPI.begin();
  LoRa.setPins(D8, D4, -1);
  if (!LoRa.begin(433E6)) {
    Serial.println("[LoRa] FAILED");
    while (1);
  }
  Serial.println("[LoRa] OK");
}

void loop() {
  int16_t AcX, AcY, AcZ, Tmp, GyX, GyY, GyZ;

  // Read MPU6050
  Wire.beginTransmission(MPU);
  Wire.write(0x3B);
  Wire.endTransmission(false);

  uint8_t bytes = Wire.requestFrom((uint8_t)MPU, (uint8_t)14);

  if (bytes != 14) {
    Serial.println("[MPU6050] Read failed");
    delay(500);
    return;
  }

  AcX = Wire.read() << 8 | Wire.read();
  AcY = Wire.read() << 8 | Wire.read();
  AcZ = Wire.read() << 8 | Wire.read();
  Tmp = Wire.read() << 8 | Wire.read();
  GyX = Wire.read() << 8 | Wire.read();
  GyY = Wire.read() << 8 | Wire.read();
  GyZ = Wire.read() << 8 | Wire.read();

  float tempC = Tmp / 340.0 + 36.53;

  // Print locally
  Serial.println("=== MPU6050 ===");
  Serial.print("Accel X: "); Serial.print(AcX);
  Serial.print("  Y: ");     Serial.print(AcY);
  Serial.print("  Z: ");     Serial.println(AcZ);
  Serial.print("Gyro  X: "); Serial.print(GyX);
  Serial.print("  Y: ");     Serial.print(GyY);
  Serial.print("  Z: ");     Serial.println(GyZ);
  Serial.print("Temp: ");    Serial.print(tempC);
  Serial.println(" °C");

  // Send over LoRa
  String packet = "AX:" + String(AcX) +
                  ",AY:" + String(AcY) +
                  ",AZ:" + String(AcZ) +
                  ",GX:" + String(GyX) +
                  ",GY:" + String(GyY) +
                  ",GZ:" + String(GyZ) +
                  ",T:"  + String(tempC, 1);

  LoRa.beginPacket();
  LoRa.print(packet);
  LoRa.endPacket();

  Serial.print("[LoRa] Sent: ");
  Serial.println(packet);
  Serial.println();

  delay(2000);
}