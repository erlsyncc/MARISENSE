<?php

namespace App\Models;

use CodeIgniter\Model;

class SeaSafetyStateModel extends Model
{
    protected $table            = 'sea_safety_state';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $protectFields    = true;

    protected $allowedFields = [
        'id',
        'status',
        'booking_blocked',
        'last_unsafe_confirmed_at',
        'last_safe_confirmed_at',
        'last_wave_height',
        'last_wind_speed',
        'created_at',
        'updated_at',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getCurrentState(): array
    {
        $state = $this->find(1);
        if (is_array($state)) {
            return $state;
        }

        $this->insert([
            'id'              => 1,
            'status'          => 'safe',
            'booking_blocked' => 0,
        ]);

        return $this->find(1) ?? [
            'id'              => 1,
            'status'          => 'safe',
            'booking_blocked' => 0,
        ];
    }
}
