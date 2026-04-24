# Buoy Data Integration — Quick Start

## 3-Step Setup

### 1️⃣ Create Database Table
```sql
CREATE TABLE IF NOT EXISTS `buoy_data` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `pitch` float NOT NULL,
  `roll` float NOT NULL,
  `hall` int(11) NOT NULL,
  `packet_id` int(11) NOT NULL,
  `rssi` int(11) NOT NULL,
  `recorded_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  KEY `idx_recorded_at` (`recorded_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

### 2️⃣ Update ESP32 Code
In `buoy_gateway_esp32.ino` line 23:
```cpp
const char* API_ENDPOINT  = "http://YOUR_SERVER_IP:5000/api/buoy-data";
```

### 3️⃣ Deploy & Test
```bash
# Send test data
curl -X POST http://localhost:8080/api/buoy-data \
  -H "Content-Type: application/json" \
  -d '{"pitch":2.45,"roll":-1.23,"hall":1,"packetId":42,"rssi":-65}'

# View in admin dashboard
# Navigate to: /admin/dashboard (scroll to bottom)

# View in customer dashboard
# Navigate to: /user/home (new "Live Buoy Monitoring" section)
```

---

## What You Get

✅ **API Endpoint** — `/api/buoy-data` accepts POST requests  
✅ **Admin Dashboard** — Shows latest buoy metrics  
✅ **Customer Dashboard** — Shows latest buoy metrics  
✅ **Database** — Persistent storage with timestamps  
✅ **Signal Quality** — Auto-classified (Excellent/Good/Fair/Poor)  

---

## Files

- **Setup Guide:** `BUOY_SETUP.md` (comprehensive)
- **Summary:** `IMPLEMENTATION_SUMMARY.md` (technical details)
- **Arduino Sketch:** `buoy_gateway_esp32.ino` (firmware)

---

## More Info

See `BUOY_SETUP.md` for full documentation, API details, and testing procedures.
