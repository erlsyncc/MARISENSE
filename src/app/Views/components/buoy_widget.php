<?php
/**
 * Buoy Sensor Data Widget
 * Displays the latest aggregated buoy window
 */

$formatFloat = static function ($value, int $precision = 2): string {
    return $value === null ? 'N/A' : number_format((float) $value, $precision);
};

$formatInt = static function ($value): string {
    return $value === null ? 'N/A' : number_format((int) $value);
};
?>

<div class="buoy-widget card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">🌊 Live Buoy Data</h5>
    </div>
    <div class="card-body">
        <?php if ($buoyData): ?>
            <?php
                $pitchAvg = $buoyData['pitch_avg'] ?? null;
                $pitchMin = $buoyData['pitch_min'] ?? null;
                $pitchMax = $buoyData['pitch_max'] ?? null;
                $rollAvg = $buoyData['roll_avg'] ?? null;
                $rollMin = $buoyData['roll_min'] ?? null;
                $rollMax = $buoyData['roll_max'] ?? null;
                $waterTempAvg = $buoyData['water_temp_avg'] ?? null;
                $waterTempMin = $buoyData['water_temp_min'] ?? null;
                $waterTempMax = $buoyData['water_temp_max'] ?? null;
                $waterTempValidSamples = $buoyData['water_temp_valid_samples'] ?? null;
                $sampleCount = $buoyData['sample_count'] ?? null;
                $expectedSamples = $buoyData['expected_samples'] ?? null;
                $packetLossPct = $buoyData['packet_loss_pct'] ?? null;
                $hallDetections = $buoyData['hall_detections'] ?? null;
                $avgRssi = $buoyData['avg_rssi'] ?? null;
                $receivedAt = $buoyData['recorded_at'] ?? null;
            ?>
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="metric-box">
                        <label class="text-muted small">Pitch (°)</label>
                        <h4 class="mb-0"><?= $formatFloat($pitchAvg) ?></h4>
                        <small class="text-muted">Min <?= $formatFloat($pitchMin) ?> / Max <?= $formatFloat($pitchMax) ?></small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="metric-box">
                        <label class="text-muted small">Roll (°)</label>
                        <h4 class="mb-0"><?= $formatFloat($rollAvg) ?></h4>
                        <small class="text-muted">Min <?= $formatFloat($rollMin) ?> / Max <?= $formatFloat($rollMax) ?></small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="metric-box">
                        <label class="text-muted small">Water Temp (°C)</label>
                        <h4 class="mb-0"><?= $formatFloat($waterTempAvg) ?></h4>
                        <small class="text-muted">
                            Min <?= $formatFloat($waterTempMin) ?> / Max <?= $formatFloat($waterTempMax) ?><br>
                            Valid samples: <?= $formatInt($waterTempValidSamples) ?>
                        </small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="metric-box">
                        <label class="text-muted small">Window Stats</label>
                        <h4 class="mb-0"><?= $formatInt($sampleCount) ?> / <?= $formatInt($expectedSamples) ?></h4>
                        <small class="text-muted">
                            Loss: <?= $formatFloat($packetLossPct, 1) ?>%<br>
                            Hall detections: <?= $formatInt($hallDetections) ?><br>
                            Avg RSSI: <?= $formatFloat($avgRssi, 1) ?> dBm
                        </small>
                    </div>
                </div>
            </div>
            <div class="mt-3 pt-2 border-top">
                <small class="text-muted">
                    Last update: <?= $receivedAt ? date('M d, Y H:i:s', strtotime($receivedAt)) : 'N/A' ?>
                </small>
            </div>
        <?php else: ?>
            <div class="alert alert-info mb-0">
                <i class="bi bi-info-circle"></i> No buoy data available yet
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
    .buoy-widget .metric-box {
        padding: 12px;
        background-color: #f8f9fa;
        border-radius: 6px;
        text-align: center;
    }
    
    .buoy-widget .metric-box label {
        display: block;
        font-weight: 600;
        margin-bottom: 4px;
    }
    
    .buoy-widget .metric-box h4 {
        color: #0d6efd;
        font-weight: 700;
    }
</style>
