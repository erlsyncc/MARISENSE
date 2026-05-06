<?php

namespace App\Controllers;

use App\Models\BuoyDataModel;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\Database\RawSql;
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
        $windowDurationMs = $this->parseIntField($payload, 'windowDurationMs');
        $sampleCount = $this->parseIntField($payload, 'sampleCount');
        $expectedSamples = $this->parseIntField($payload, 'expectedSamples');
        $packetLossPct = $this->parseFloatField($payload, 'packetLossPct');
        $firstPacketId = $this->parseIntField($payload, 'firstPacketId');
        $lastPacketId = $this->parseIntField($payload, 'lastPacketId');
        $hallDetections = $this->parseIntField($payload, 'hallDetections');
        $avgRssi = $this->parseFloatField($payload, 'avgRssi');

        $pitch = $this->parseNestedStats($payload, 'pitch');
        $roll = $this->parseNestedStats($payload, 'roll');
        $waterTemp = $this->parseWaterTemp($payload);

        return [
            'window_duration_ms' => $windowDurationMs,
            'sample_count' => $sampleCount,
            'expected_samples' => $expectedSamples,
            'packet_loss_pct' => $packetLossPct,
            'first_packet_id' => $firstPacketId,
            'last_packet_id' => $lastPacketId,
            'hall_detections' => $hallDetections,
            'avg_rssi' => $avgRssi,
            'pitch_avg' => $pitch['avg'],
            'pitch_min' => $pitch['min'],
            'pitch_max' => $pitch['max'],
            'roll_avg' => $roll['avg'],
            'roll_min' => $roll['min'],
            'roll_max' => $roll['max'],
            'water_temp_avg' => $waterTemp['avg'],
            'water_temp_min' => $waterTemp['min'],
            'water_temp_max' => $waterTemp['max'],
            'water_temp_valid_samples' => $waterTemp['validSamples'],
            'recorded_at' => new RawSql('NOW()'),
        ];
    }

    private function parseNestedStats(array $payload, string $key): array
    {
        if (! array_key_exists($key, $payload) || ! is_array($payload[$key])) {
            throw new \InvalidArgumentException("Missing required field: $key");
        }

        $section = $payload[$key];

        return [
            'avg' => $this->parseFloatField($section, 'avg', $key),
            'min' => $this->parseFloatField($section, 'min', $key),
            'max' => $this->parseFloatField($section, 'max', $key),
        ];
    }

    private function parseWaterTemp(array $payload): array
    {
        if (! array_key_exists('waterTemp', $payload) || ! is_array($payload['waterTemp'])) {
            throw new \InvalidArgumentException('Missing required field: waterTemp');
        }

        $section = $payload['waterTemp'];

        return [
            'avg' => $this->parseNullableFloatField($section, 'avg', 'waterTemp'),
            'min' => $this->parseNullableFloatField($section, 'min', 'waterTemp'),
            'max' => $this->parseNullableFloatField($section, 'max', 'waterTemp'),
            'validSamples' => $this->parseIntField($section, 'validSamples', 'waterTemp'),
        ];
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

    private function parseNullableFloatField(array $payload, string $field, ?string $parent = null): ?float
    {
        if (! array_key_exists($field, $payload)) {
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
