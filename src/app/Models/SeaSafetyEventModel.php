<?php

namespace App\Models;

use CodeIgniter\Model;

class SeaSafetyEventModel extends Model
{
    protected $table            = 'sea_safety_events';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;

    protected $allowedFields = [
        'event_type',
        'message',
        'wave_height',
        'wind_speed',
        'threshold_wave_height',
        'threshold_wind_speed',
        'consecutive_packets',
        'duration_seconds',
        'affected_bookings',
        'details',
        'created_at',
    ];

    protected $useTimestamps = false;
}
