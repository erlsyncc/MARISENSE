<?php

namespace App\Controllers;

use App\Models\BuoyDataModel;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\Database\RawSql;
use CodeIgniter\API\ResponseTrait;

class Api extends BaseController
{
    use ResponseTrait;

    private const DEFAULT_WINDOW_DURATION_MS = 60000;

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

        $payload = $this->request->getJSON(true);
        if (! is_array($payload)) {
            return $this->jsonError('Invalid JSON payload.');
        }

        $receivedAt = date('Y-m-d H:i:s');

        try {
            $data = $this->parseBuoyPayload($payload);
        } catch (\InvalidArgumentException $e) {
            return $this->jsonError($e->getMessage(), 400);
        }

        $data = $this->filterPersistableColumns($data);
        if ($data === []) {
            return $this->dbError();
        }

        try {
            $insertId = $this->buoyModel->insert($data);
        } catch (DatabaseException $e) {
            log_message('error', 'Failed to store buoy data: {message}', ['message' => $e->getMessage()]);
            return $this->dbError();
        }

        if ($insertId === false) {
            return $this->dbError();
        }

        return $this->respondCreated([
            'ok' => true,
            'id' => (int) $insertId,
            'receivedAt' => $receivedAt,
        ]);
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

    private function parseBuoyPayload(array $payload): array
    {
        $sampleCount = $this->parseIntField($payload, 'sampleCount');
        if ($sampleCount < 1) {
            throw new \InvalidArgumentException('Invalid integer value for sampleCount');
        }

        $avgWaveHeight = $this->parseFloatField($payload, 'avgWaveHeight');
        $avgWindSpeed = $this->parseFloatField($payload, 'avgWindSpeed');
        $maxWindSpeed = $this->parseFloatField($payload, 'maxWindSpeed');

        $pitch = $this->parseObjectField($payload, 'pitch');
        $pitchAvg = $this->parseFloatField($pitch, 'avg', 'pitch');

        $waterTemp = $this->parseObjectField($payload, 'waterTemp');
        $waterTempAvg = $this->parseNullableFloatField($waterTemp, 'avg', 'waterTemp');
        $waterTempSamples = $waterTempAvg === null ? 0 : $sampleCount;

        return [
            'sample_count' => $sampleCount,
            'expected_samples' => $sampleCount,
            'packet_loss_pct' => 0.0,
            'first_packet_id' => 0,
            'last_packet_id' => 0,
            'hall_detections' => 0,
            'avg_rssi' => 0.0,
            'window_duration_ms' => self::DEFAULT_WINDOW_DURATION_MS,
            'pitch_avg' => $pitchAvg,
            'pitch_min' => $pitchAvg,
            'pitch_max' => $pitchAvg,
            'roll_avg' => 0.0,
            'roll_min' => 0.0,
            'roll_max' => 0.0,
            'water_temp_avg' => $waterTempAvg,
            'water_temp_min' => $waterTempAvg,
            'water_temp_max' => $waterTempAvg,
            'water_temp_valid_samples' => $waterTempSamples,
            'avg_wave_height' => $avgWaveHeight,
            'avg_wind_speed' => $avgWindSpeed,
            'max_wind_speed' => $maxWindSpeed,
            'recorded_at' => new RawSql('NOW()'),
        ];
    }

    private function parseObjectField(array $payload, string $field): array
    {
        if (! array_key_exists($field, $payload) || ! is_array($payload[$field])) {
            throw new \InvalidArgumentException("Missing required field: $field");
        }

        return $payload[$field];
    }

    private function filterPersistableColumns(array $data): array
    {
        static $fieldMap = null;

        if ($fieldMap === null) {
            $dbFields = \Config\Database::connect()->getFieldNames('buoy_data');
            $fieldMap = array_fill_keys($dbFields, true);
        }

        return array_intersect_key($data, $fieldMap);
    }

    private function parseFloatField(array $payload, string $field, ?string $parent = null): float
    {
        if (! array_key_exists($field, $payload)) {
            $name = $parent ? $parent . '.' . $field : $field;
            throw new \InvalidArgumentException("Missing required field: $name");
        }

        $value = $payload[$field];
        if (! is_numeric($value)) {
            $name = $parent ? $parent . '.' . $field : $field;
            throw new \InvalidArgumentException("Invalid numeric value for $name");
        }

        return (float) $value;
    }

    private function parseNullableFloatField(array $payload, string $field, ?string $parent = null, bool $allowMissing = false): ?float
    {
        if (! array_key_exists($field, $payload)) {
            if ($allowMissing) {
                return null;
            }
            $name = $parent ? $parent . '.' . $field : $field;
            throw new \InvalidArgumentException("Missing required field: $name");
        }

        $value = $payload[$field];
        if ($value === null) {
            return null;
        }

        if (! is_numeric($value)) {
            $name = $parent ? $parent . '.' . $field : $field;
            throw new \InvalidArgumentException("Invalid numeric value for $name");
        }

        return (float) $value;
    }

    private function parseIntField(array $payload, string $field, ?string $parent = null): int
    {
        if (! array_key_exists($field, $payload)) {
            $name = $parent ? $parent . '.' . $field : $field;
            throw new \InvalidArgumentException("Missing required field: $name");
        }

        $value = $payload[$field];
        if (filter_var($value, FILTER_VALIDATE_INT) === false) {
            $name = $parent ? $parent . '.' . $field : $field;
            throw new \InvalidArgumentException("Invalid integer value for $name");
        }

        $intValue = (int) $value;
        if ($intValue < 0) {
            $name = $parent ? $parent . '.' . $field : $field;
            throw new \InvalidArgumentException("Invalid integer value for $name");
        }

        return $intValue;
    }

    private function jsonError(string $message, int $statusCode = 400)
    {
        return $this->response
            ->setStatusCode($statusCode)
            ->setJSON(['ok' => false, 'error' => $message]);
    }

    private function dbError()
    {
        return $this->response
            ->setStatusCode(500)
            ->setJSON(['ok' => false, 'error' => 'db_error']);
    }
}
