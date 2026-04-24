# Buoy Data Integration Setup Guide

This document describes the complete integration of IoT buoy sensor data into MARISENSE.

## Overview

The system receives real-time data from an ESP32 gateway device via LoRa, processes it, and displays the readings in both admin and customer dashboards.

**Data received from ESP32:**
- `pitch` — Buoy pitch angle (degrees)
- `roll` — Buoy roll angle (degrees)
- `hall` — Hall effect sensor state
- `packetId` — Packet sequence number
- `rssi` — Radio signal strength indicator (dBm)

## 1. Database Setup

Run the following SQL migration to create the `buoy_data` table:

```sql
CREATE TABLE IF NOT EXISTS `buoy_data` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `pitch` float NOT NULL COMMENT 'Buoy pitch angle in degrees',
  `roll` float NOT NULL COMMENT 'Buoy roll angle in degrees',
  `hall` int(11) NOT NULL COMMENT 'Hall state reading',
  `packet_id` int(11) NOT NULL COMMENT 'Packet sequence ID from ESP32',
  `rssi` int(11) NOT NULL COMMENT 'Signal strength in dBm',
  `recorded_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Time sensor reading was taken',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  KEY `idx_recorded_at` (`recorded_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE INDEX IF NOT EXISTS idx_created_at ON buoy_data(created_at DESC);
```

## 2. API Endpoints

### POST `/api/buoy-data` — Receive sensor data
**Request (from ESP32):**
```json
{
  "pitch": 2.45,
  "roll": -1.23,
  "hall": 1,
  "packetId": 42,
  "rssi": -65
}
```

**Response (201 Created):**
```json
{
  "message": "Buoy data received successfully"
}
```

---

### GET `/api/buoy-data/latest` — Get the most recent reading
**Response:**
```json
{
  "id": 1,
  "pitch": 2.45,
  "roll": -1.23,
  "hall": 1,
  "packet_id": 42,
  "rssi": -65,
  "recorded_at": "2026-04-24 12:15:30",
  "created_at": "2026-04-24 12:15:30"
}
```

---

### GET `/api/buoy-data/recent/:limit` — Get last N readings
**Example:** `/api/buoy-data/recent/10`

Returns array of up to 10 recent readings, ordered by most recent first.

## 3. Controllers & Models

### BuoyDataModel (`app/Models/BuoyDataModel.php`)
Handles database queries for buoy data:
- `getLatestReading()` — Returns most recent reading
- `getRecentReadings($limit)` — Returns last N readings
- `getReadingsByDateRange($start, $end)` — Returns readings in date range

### Api Controller (`app/Controllers/Api.php`)
Handles API endpoints:
- `buoyData()` — POST endpoint to receive and store data
- `getLatestBuoyData()` — GET latest reading
- `getRecentBuoyData($limit)` — GET recent readings

### Updated Controllers
- **Admin.php** — Updated `index()` to fetch and pass `$buoyData` to dashboard
- **User.php** — Updated `index()` to fetch and pass `$buoyData` to home page

## 4. Views

### Buoy Widget (`app/Views/components/buoy_widget.php`)
Reusable component that displays:
- Pitch angle (degrees)
- Roll angle (degrees)
- Hall state value
- Signal strength (RSSI in dBm) with quality indicator
- Last update timestamp

Displays in both:
- **Admin Dashboard** → `/admin/dashboard` (bottom section)
- **User Home** → `/user/home` (new "Live Buoy Monitoring" section)

## 5. Routes

Added to `app/Config/Routes.php`:

```php
$routes->group('api', function($routes) {
    $routes->post('buoy-data', 'Api::buoyData');
    $routes->get('buoy-data/latest', 'Api::getLatestBuoyData');
    $routes->get('buoy-data/recent/(:num)', 'Api::getRecentBuoyData/$1');
});
```

**Note:** API endpoints are PUBLIC (no authentication required) to allow ESP32 device to POST data.

## 6. ESP32 Configuration

Update the ESP32 sketch with the correct endpoint. In `buoy_gateway_esp32.ino`, modify:

```cpp
const char* API_ENDPOINT  = "http://your-server-ip:5000/api/buoy-data";
```

Replace with your actual server URL.

## 7. Testing

### Test 1: POST data via cURL
```bash
curl -X POST http://localhost:5000/api/buoy-data \
  -H "Content-Type: application/json" \
  -d '{"pitch":2.45,"roll":-1.23,"hall":1,"packetId":42,"rssi":-65}'
```

Expected response: `201 Created` with success message

### Test 2: Retrieve latest data
```bash
curl http://localhost:5000/api/buoy-data/latest
```

### Test 3: Retrieve recent data
```bash
curl http://localhost:5000/api/buoy-data/recent/10
```

### Test 4: Check admin dashboard
Navigate to `/admin/dashboard` — buoy data widget should appear at bottom

### Test 5: Check user home
Navigate to `/user/home` — buoy data widget should appear in "Live Buoy Monitoring" section

## 8. Signal Strength Guide

RSSI values are interpreted as follows:

| RSSI Range  | Quality    | Meaning              |
|-------------|-----------|----------------------|
| ≥ -50 dBm  | Excellent | Very close, strong   |
| -60 to -50 | Good      | Strong signal        |
| -70 to -60 | Fair      | Acceptable signal    |
| < -70      | Poor      | Weak signal          |

## 9. Files Modified/Created

```
✅ Created:
  • app/Models/BuoyDataModel.php
  • app/Controllers/Api.php
  • app/Views/components/buoy_widget.php

✏️  Modified:
  • app/Config/Routes.php (added API routes)
  • app/Controllers/Admin.php (fetch buoy data)
  • app/Controllers/User.php (fetch buoy data)
  • app/Views/admin/dashboard.php (added buoy widget)
  • app/Views/user/home.php (added buoy section)
```

## 10. Next Steps (Optional)

- [ ] Add historical data charts (Chart.js graph of readings over time)
- [ ] Implement data retention policy (auto-delete readings older than X days)
- [ ] Add real-time WebSocket updates for live dashboard refresh
- [ ] Create alerts if signal drops below threshold
- [ ] Export buoy data to CSV for analysis
