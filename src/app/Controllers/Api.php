<?php

namespace App\Controllers;

use App\Models\BuoyDataModel;
use CodeIgniter\API\ResponseTrait;

class Api extends BaseController
{
    use ResponseTrait;

    protected $buoyModel;

    public function __construct()
    {
        $this->buoyModel = new BuoyDataModel();
    }

    /**
     * POST /api/buoy-data
     * Receive and store buoy sensor data from ESP32 gateway
     */
    public function buoyData()
    {
        if ($this->request->getMethod() !== 'post') {
            return $this->failMethodNotAllowed('POST method required');
        }

        $json = $this->request->getJSON();

        // Validate required fields
        $required = ['pitch', 'roll', 'hall', 'packetId', 'rssi'];
        foreach ($required as $field) {
            if (!isset($json->$field)) {
                return $this->failValidationErrors(['error' => "Missing required field: $field"]);
            }
        }

        // Store the buoy data
        $data = [
            'pitch' => floatval($json->pitch),
            'roll' => floatval($json->roll),
            'hall' => intval($json->hall),
            'packet_id' => intval($json->packetId),
            'rssi' => intval($json->rssi),
            'recorded_at' => date('Y-m-d H:i:s'),
        ];

        if ($this->buoyModel->insert($data)) {
            return $this->respondCreated(['message' => 'Buoy data received successfully']);
        } else {
            return $this->fail('Failed to store buoy data', 500);
        }
    }

    /**
     * GET /api/buoy-data/latest
     * Retrieve the latest buoy reading
     */
    public function getLatestBuoyData()
    {
        $latest = $this->buoyModel->getLatestReading();
        
        if (!$latest) {
            return $this->failNotFound('No buoy data available');
        }

        return $this->respond($latest);
    }

    /**
     * GET /api/buoy-data/recent/:limit
     * Retrieve recent buoy readings
     */
    public function getRecentBuoyData($limit = 10)
    {
        $limit = min(intval($limit), 100); // Cap at 100 records
        $readings = $this->buoyModel->getRecentReadings($limit);
        
        return $this->respond($readings);
    }
}
