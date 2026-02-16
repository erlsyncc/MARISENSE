# MARISENSE: A Smart Buoy–Based Localized Marine Weather Monitoring System

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![Docker](https://img.shields.io/badge/Docker-Enabled-blue.svg)](https://www.docker.com/)
[![CodeIgniter](https://img.shields.io/badge/CodeIgniter-4.x-orange.svg)](https://codeigniter.com/)

> **Empowering small-scale fishermen with real-time marine weather intelligence.**  
> A localized IoT system that delivers hyper-accurate weather data straight to coastal communities.

## 🎯 Project Overview

**MARISENSE** is an IoT-based marine weather monitoring system designed specifically for small-scale fishermen in the Philippines. It deploys a smart buoy in fishing grounds to collect real-time environmental data, helping fishermen make safer and more informed decisions at sea.

### Key Problem It Solves
- Fishermen often rely on outdated forecasts or personal experience.
- Sudden changes in wind, waves, or sea state lead to accidents and lost income.
- No affordable, localized monitoring tools for remote coastal areas.

### Target Users
- Coastal fishing communities (mga samahan ng mangingisda)
- Local fisherfolk associations
- Municipal fisheries offices

### UN Sustainable Development Goals (SDGs) Aligned
- **SDG 1**: No Poverty (improves income stability)
- **SDG 9**: Industry, Innovation & Infrastructure (IoT tech for rural areas)
- **SDG 11**: Sustainable Cities & Communities (disaster risk reduction)
- **SDG 13**: Climate Action (climate-resilient fishing)
- **SDG 14**: Life Below Water (marine ecosystem protection)

---

## ✨ Core Features

### Buoy Side (Hardware)
- **Real-time Monitoring**:
  - Wind speed (via Hall-effect anemometer)
  - Wave motion & sea state (via tri-axis IMU)
  - Atmospheric temperature (DS18B20)
  - (Future: Atmospheric pressure, water temperature)
- **LoRa Wireless Transmission** – Up to 10+ km range, ultra-low power
- **Solar-powered** – 12V 5W panel + 2S Li-ion battery system
- **Waterproof & Durable** – 3D-printed PETG enclosure

### Web Dashboard (Software)
- Live buoy data visualization
- Historical trends & analytics
- Threshold-based **danger alerts** (SMS/Email/Push)
- Role-Based Access Control (RBAC) for:
  - Community admins (manage alerts)
  - Users (See Status and book activities)
- Mobile-responsive UI with real-time updates via AJAX

---

## 🛠️ Tech Stack

### Backend
- **PHP 8.2+** with **CodeIgniter 4**
- **CodeIgniter Shield** – Authentication & authorization
- **MySQL 8** – Data storage (buoy readings, users, alerts)
- **RBAC** – Custom role system (Fisherman, Admin, Officer)

### Frontend
- **AJAX** – Real-time data fetching
- **Chart.js** / **ApexCharts** – Graphs & dashboards
- **Tailwind CSS** – Modern, responsive design

### DevOps
- **Docker** + **Docker Compose** – Full environment (PHP, MySQL, Redis)
- **GitHub Actions** – CI/CD pipeline

### Hardware
| Component                  | Purpose |
|----------------------------|--------|
| ESP32 DevKit V1           | Main controller + LoRa |
| LoRa SX1276               | Long-range comms |
| MPU6050 (Accel + Gyro)    | Wave motion detection |
| A3144 Hall Effect         | Wind speed (anemometer) |
| DS18B20 Temperature       | Air/water temp |
| Solar Panel 12V 5W        | Renewable power |
| TP5100 Charger            | Solar charging |
| 2S BMS Protection         | Battery safety |
| 18650 Batteries           | Energy storage |
| Adjustable Buck Converter | Voltage regulation |
| PETG Filament (Red)       | 3D-printed buoy |

---

## 🚀 Quick Start

### Prerequisites
- Docker & Docker Compose
- Git
- PHP 8.2+ (optional for local dev)
# Docker Instruction for Event System (One-Command Workflow)

## 1. Install Docker
1. Download Docker Desktop for your operating system: https://www.docker.com/get-started
2. Follow the installation instructions for your OS.
3. Verify installation by running in terminal:
   ```bash
   docker --version
   docker compose version
   ```

## 2. One-Command VSCode Terminal Setup
1. Open VSCode and open your terminal (**Terminal → New Terminal**).
2. Navigate to your `event-system` project directory:
   ```bash
   cd path/to/marisense
   ```
3. Run the following command to build, start containers, enter the app container, and run migrations in one go:
   ```bash
   docker compose up --build -d && \
   docker exec -it marisense-app bash -c "php spark migrate"
   ```

## 3. Verify
1. Check that your containers are running:
   ```bash
   docker ps
   ```
2. Open your browser and go to your app URL (e.g., http://localhost:8080) to ensure everything is running.

