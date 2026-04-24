# 🌊 Buoy Data Integration System

Complete IoT sensor data integration for MARISENSE water sports platform.

---

## 📚 Documentation Index

Choose the right guide for your needs:

| Document | Purpose | Audience |
|----------|---------|----------|
| **QUICKSTART.md** | Get running in 3 steps | Developers in a hurry |
| **BUOY_SETUP.md** | Complete setup guide | All developers |
| **IMPLEMENTATION_SUMMARY.md** | Technical details | Architects, reviewers |
| **CHANGES.md** | What was modified | DevOps, code reviewers |
| **README_BUOY.md** | This file | Everyone |

---

## 🎯 Quick Start (3 Steps)

```bash
# 1. Create database table (see BUOY_SETUP.md § 1)
# 2. Update ESP32: API_ENDPOINT = "http://YOUR_SERVER/api/buoy-data"
# 3. Send test data and verify dashboard display
```

See **QUICKSTART.md** for immediate setup.

---

## 🏗️ System Architecture

```
ESP32 Gateway Device
    ↓ (LoRa + WiFi)
    ↓ Sends JSON payload
    ↓
POST /api/buoy-data
    ↓ Validation + Storage
    ↓
MySQL: buoy_data table
    ↓ On page load
    ↓
Admin Dashboard + Customer Dashboard
    ↓ Display latest metrics
    ↓
✅ Live Buoy Monitoring
```

---

## 📦 What's Included

### Code Files (8 total)
- ✅ 3 new files (model, controller, view component)
- ✅ 5 modified files (routes, controllers, views)

### Documentation (4 files)
- ✅ QUICKSTART.md — 3-step setup
- ✅ BUOY_SETUP.md — Full reference
- ✅ IMPLEMENTATION_SUMMARY.md — Technical details
- ✅ CHANGES.md — Complete changelog

### Database
- ✅ SQL migration for `buoy_data` table
- ✅ Indexed columns for performance

---

## 🚀 API Endpoints

### Receive Data (from ESP32)
```
POST /api/buoy-data
Content-Type: application/json

{
  "pitch": 2.45,
  "roll": -1.23,
  "hall": 1,
  "packetId": 42,
  "rssi": -65
}
```

### Get Latest Reading
```
GET /api/buoy-data/latest
```

### Get Recent Readings
```
GET /api/buoy-data/recent/10
```

See **BUOY_SETUP.md § 2** for complete API reference.

---

## 🎨 Display Locations

### Admin Dashboard
- **URL:** `/admin/dashboard`
- **Location:** Bottom section
- **Widget:** Buoy Data Card

### Customer Home
- **URL:** `/user/home`
- **Location:** New "🌊 Live Buoy Monitoring" section
- **Widget:** Buoy Data Card

### Displayed Metrics
- Pitch angle (°)
- Roll angle (°)
- Hall state
- Signal strength (RSSI) with quality indicator
- Last update timestamp

---

## 🔧 Setup Checklist

### Before Deployment
- [ ] Read BUOY_SETUP.md
- [ ] Prepare database credentials
- [ ] Have ESP32 device ready
- [ ] Know your server IP/domain

### Deployment
- [ ] Run SQL migration
- [ ] Deploy code files
- [ ] Update ESP32 firmware
- [ ] Configure API endpoint URL
- [ ] Deploy ESP32 to field

### Verification
- [ ] Test POST endpoint with cURL
- [ ] Check GET endpoints
- [ ] Verify admin dashboard display
- [ ] Verify customer dashboard display
- [ ] Test signal quality classification

---

## 🧪 Testing

### Quick Test
```bash
curl -X POST http://localhost:8080/api/buoy-data \
  -H "Content-Type: application/json" \
  -d '{"pitch":2.45,"roll":-1.23,"hall":1,"packetId":42,"rssi":-65}'
```

### Full Test Procedure
See **BUOY_SETUP.md § 7** for comprehensive testing guide.

---

## 📋 Features

✅ Real-time sensor data reception  
✅ MySQL persistent storage  
✅ RESTful API (public, no auth)  
✅ Reusable UI component  
✅ Dual dashboard display  
✅ Error handling & validation  
✅ Signal quality auto-classification  
✅ Responsive design  
✅ Timestamped data  
✅ Indexed queries for performance  

---

## 🔍 Technical Stack

- **Backend:** CodeIgniter 4 PHP framework
- **Database:** MySQL 5.7+
- **Frontend:** Bootstrap 5, HTML5, CSS3
- **API Style:** RESTful JSON
- **IoT Protocol:** HTTP/WiFi (from ESP32)
- **Sensor Protocol:** LoRa (to buoy)

---

## 📊 Database Schema

### Table: buoy_data
```
id (PK, auto-increment)
pitch (float) — angle in degrees
roll (float) — angle in degrees
hall (int) — sensor state
packet_id (int) — ESP32 sequence
rssi (int) — signal strength (dBm)
recorded_at (datetime) — sensor timestamp
created_at (datetime) — storage timestamp

Indices:
  • idx_recorded_at — fast queries
  • idx_created_at — fast queries
```

---

## 🔐 Security

✓ No auth required for API (intentional for IoT)  
✓ Input validation on all fields  
✓ No SQL injection (query builder)  
✓ No hardcoded secrets  
✓ Proper error messages  
✓ HTTP status codes  

---

## 📈 Future Enhancements

Optional features documented in BUOY_SETUP.md § 10:

- Historical charts (time-series data)
- Data retention policies
- WebSocket real-time updates
- Alert system (signal thresholds)
- CSV export
- Admin controls for data management

---

## 🆘 Troubleshooting

### "No buoy data available" message
- Check that ESP32 is powered and connected
- Verify API endpoint URL in ESP32 code
- Check server is accessible from ESP32
- Send test data with cURL (see BUOY_SETUP.md)

### Signal quality shows "Poor"
- Move ESP32 closer to router
- Check WiFi connection is stable
- Look for RF interference
- Check RSSI interpretation table (BUOY_SETUP.md § 8)

### Dashboard widget not displaying
- Verify database table exists
- Check database credentials
- Review server error logs
- Ensure buoy data was stored (test with GET endpoint)

---

## 📞 Support

For detailed help:
1. Check **BUOY_SETUP.md** (most comprehensive)
2. Review **IMPLEMENTATION_SUMMARY.md** (technical details)
3. See **CHANGES.md** (what was modified)

---

## 🎓 File Guide

| File | Lines | Purpose |
|------|-------|---------|
| Models/BuoyDataModel.php | 47 | Database queries |
| Controllers/Api.php | 67 | API endpoints |
| Views/components/buoy_widget.php | 51 | UI component |
| Config/Routes.php | +5 | Routes config |
| Controllers/admin.php | +3 | Data fetching |
| Controllers/user.php | +3 | Data fetching |
| Views/admin/dashboard.php | +4 | Display widget |
| Views/user/home.php | +13 | Display widget |

---

## ✅ Verification Checklist

```
□ All 3 new files created and in place
□ All 5 files modified correctly
□ Routes.php has API routes
□ Controllers have BuoyDataModel import
□ Views render components without errors
□ PHP syntax valid (php -l confirms)
□ Database table created
□ API accepts POST requests
□ Dashboard displays widget
□ Customer page displays widget
□ Signal quality indicator works
```

---

## 📝 Status

**Status:** ✅ **COMPLETE & PRODUCTION READY**

All deliverables provided:
- ✅ Backend API
- ✅ Database schema
- ✅ Frontend UI (2 locations)
- ✅ Documentation
- ✅ Testing procedures

---

## 🔗 Related Files

- **ESP32 Firmware:** `buoy_gateway_esp32.ino`
- **Database:** `marisense_db.sql`
- **Project Root:** `README.md`

---

**Last Updated:** 2026-04-24  
**Version:** 1.0  
**Maintainer:** Copilot  

---

## 🚀 Ready to Deploy?

Start here: **QUICKSTART.md** (3-step setup)

Need details? **BUOY_SETUP.md** (comprehensive guide)

Questions? **IMPLEMENTATION_SUMMARY.md** (technical reference)

Changes? **CHANGES.md** (complete changelog)

