<?php

namespace App\Models;

use CodeIgniter\Model;

class BuoyDataModel extends Model
{
    protected $table = 'buoy_data';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = [
        'window_duration_ms',
        'sample_count',
        'expected_samples',
        'packet_loss_pct',
        'first_packet_id',
        'last_packet_id',
        'hall_detections',
        'avg_rssi',
        'pitch_avg',
        'pitch_min',
        'pitch_max',
        'roll_avg',
        'roll_min',
        'roll_max',
        'water_temp_avg',
        'water_temp_min',
        'water_temp_max',
        'water_temp_valid_samples',
        'avg_wave_height',
        'avg_wind_speed',
        'max_wind_speed',
        'recorded_at',
    ];
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
