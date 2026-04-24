<?php

namespace App\Models;

use CodeIgniter\Model;

class BuoyDataModel extends Model
{
    protected $table = 'buoy_data';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = ['pitch', 'roll', 'hall', 'packet_id', 'rssi', 'recorded_at'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = null;

    /**
     * Get the latest buoy reading
     */
    public function getLatestReading()
    {
        return $this->orderBy('recorded_at', 'DESC')
                    ->limit(1)
                    ->first();
    }

    /**
     * Get last N readings
     */
    public function getRecentReadings($limit = 10)
    {
        return $this->orderBy('recorded_at', 'DESC')
                    ->limit($limit)
                    ->findAll();
    }

    /**
     * Get readings for a specific date range
     */
    public function getReadingsByDateRange($startDate, $endDate)
    {
        return $this->where('recorded_at >=', $startDate)
                    ->where('recorded_at <=', $endDate)
                    ->orderBy('recorded_at', 'DESC')
                    ->findAll();
    }
}
