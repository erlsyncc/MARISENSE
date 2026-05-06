<?php
/**
 * Buoy Sensor Data Widget
 * Displays current marine safety indicators
 */

$formatFloat = static function ($value, int $precision = 2): string {
    return $value === null ? 'N/A' : number_format((float) $value, $precision);
};
?>

<div class="buoy-widget card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">🌊 Live Buoy Data</h5>
    </div>
    <div class="card-body">
        <?php if ($buoyData): ?>
            <?php
                $waveHeight = (float) ($buoyData['avg_wave_height'] ?? 0.0);
                $windAvg = (float) ($buoyData['avg_wind_speed'] ?? 0.0);
                $windGust = (float) ($buoyData['max_wind_speed'] ?? $windAvg);
                $waterTempAvg = $buoyData['water_temp_avg'] ?? null;
                $receivedAt = $buoyData['recorded_at'] ?? null;

                // Traffic-light conclusion:
                // Red: Waves > 1.2m OR Wind > 20m/s
                // Amber: Waves 0.6 - 1.2m OR Wind 10 - 20m/s
                // Green: below those ranges
                $safetyState = 'green';
                $safetyLabel = 'SAFE';
                $safetyReason = 'Waves and wind are within normal operating range.';

                if ($waveHeight > 1.2 || $windAvg > 20.0) {
                    $safetyState = 'red';
                    $safetyLabel = 'DANGEROUS';
                    $safetyReason = 'Unsafe threshold exceeded: wave height > 1.2m or wind > 20m/s.';
                } elseif (($waveHeight >= 0.6 && $waveHeight <= 1.2) || ($windAvg >= 10.0 && $windAvg <= 20.0)) {
                    $safetyState = 'amber';
                    $safetyLabel = 'CAUTION';
                    $safetyReason = 'Moderate threshold reached: wave height 0.6-1.2m or wind 10-20m/s.';
                }

                $waveState = $waveHeight > 1.2 ? 'not-normal' : (($waveHeight >= 0.6) ? 'watch' : 'normal');
                $waveHover = $waveHeight > 1.2
                    ? 'Not Normal: wave level is dangerous.'
                    : (($waveHeight >= 0.6) ? 'Not Normal: wave level needs caution.' : 'Normal: wave level is calm/stable.');

                $windState = $windAvg > 20.0 ? 'not-normal' : (($windAvg >= 10.0) ? 'watch' : 'normal');
                $windHover = $windAvg > 20.0
                    ? 'Not Normal: wind speed is dangerous.'
                    : (($windAvg >= 10.0) ? 'Not Normal: wind speed needs caution.' : 'Normal: wind speed is manageable.');

                $tempState = 'watch';
                $tempHover = 'No baseline configured.';
                if ($waterTempAvg === null) {
                    $tempState = 'watch';
                    $tempHover = 'Not Normal: temperature sensor has no reading.';
                } else {
                    $waterTemp = (float) $waterTempAvg;
                    if ($waterTemp < 20.0 || $waterTemp > 34.0) {
                        $tempState = 'not-normal';
                        $tempHover = 'Not Normal: temperature is outside safe comfort range.';
                    } elseif ($waterTemp < 24.0 || $waterTemp > 32.0) {
                        $tempState = 'watch';
                        $tempHover = 'Not Normal: temperature is marginal.';
                    } else {
                        $tempState = 'normal';
                        $tempHover = 'Normal: temperature is within expected range.';
                    }
                }
            ?>
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="metric-box <?= $windState ?>" title="<?= esc($windHover) ?>">
                        <label class="text-muted small">Wind Speed</label>
                        <h4 class="mb-0"><?= $formatFloat($windAvg, 1) ?> m/s</h4>
                        <small class="text-muted">Gust: <?= $formatFloat($windGust, 1) ?> m/s</small>
                        <div class="hover-indicator"><?= esc($windHover) ?></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="metric-box <?= $waveState ?>" title="<?= esc($waveHover) ?>">
                        <label class="text-muted small">Wave Height</label>
                        <h4 class="mb-0"><?= $formatFloat($waveHeight, 2) ?> m</h4>
                        <small class="text-muted">Current avg wave</small>
                        <div class="hover-indicator"><?= esc($waveHover) ?></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="metric-box <?= $tempState ?>" title="<?= esc($tempHover) ?>">
                        <label class="text-muted small">Water Temp (°C)</label>
                        <h4 class="mb-0"><?= $formatFloat($waterTempAvg) ?></h4>
                        <small class="text-muted"><?= $waterTempAvg === null ? 'Sensor offline' : 'Surface reading' ?></small>
                        <div class="hover-indicator"><?= esc($tempHover) ?></div>
                    </div>
                </div>
            </div>
            <div class="traffic-light <?= $safetyState ?>">
                <div class="traffic-dot"></div>
                <div>
                    <strong>Safety Status: <?= esc($safetyLabel) ?></strong>
                    <div class="traffic-reason"><?= esc($safetyReason) ?></div>
                </div>
            </div>
            <div class="mt-2 pt-2 border-top">
                <small class="text-muted">
                    Last update: <?= $receivedAt ? date('M d, Y H:i:s', strtotime($receivedAt)) : 'N/A' ?>
                </small>
            </div>
        <?php else: ?>
            <div class="alert alert-info mb-0">
                <i class="fa-solid fa-circle-info me-1"></i> No buoy data available yet
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
    .buoy-widget .metric-box {
        position: relative;
        padding: 12px;
        border-radius: 12px;
        text-align: center;
        transition: border-color 0.2s ease, transform 0.2s ease;
        border: 1px solid transparent;
    }

    .buoy-widget .metric-box:hover {
        transform: translateY(-3px);
    }

    .buoy-widget .metric-box.normal { border-color: rgba(40, 167, 69, 0.45); }
    .buoy-widget .metric-box.watch { border-color: rgba(255, 193, 7, 0.5); }
    .buoy-widget .metric-box.not-normal { border-color: rgba(220, 53, 69, 0.55); }

    .buoy-widget .metric-box label {
        display: block;
        font-weight: 600;
        margin-bottom: 4px;
    }

    .buoy-widget .metric-box h4 {
        color: #0d6efd;
        font-weight: 700;
    }

    .buoy-widget .hover-indicator {
        opacity: 0;
        pointer-events: none;
        position: absolute;
        left: 8px;
        right: 8px;
        bottom: -8px;
        transform: translateY(100%);
        padding: 6px 8px;
        border-radius: 8px;
        font-size: 0.72rem;
        line-height: 1.35;
        background: rgba(5, 44, 57, 0.92);
        color: #fff;
        border: 1px solid rgba(72, 202, 228, 0.35);
        transition: opacity 0.2s ease;
        z-index: 5;
    }

    .buoy-widget .metric-box:hover .hover-indicator {
        opacity: 1;
    }

    .buoy-widget .traffic-light {
        margin-top: 14px;
        border-radius: 12px;
        padding: 10px 12px;
        display: flex;
        align-items: center;
        gap: 10px;
        border: 1px solid;
    }

    .buoy-widget .traffic-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .buoy-widget .traffic-light.green {
        background: rgba(40, 167, 69, 0.12);
        border-color: rgba(40, 167, 69, 0.45);
        color: #5ddb8a;
    }

    .buoy-widget .traffic-light.green .traffic-dot {
        background: #28a745;
        box-shadow: 0 0 10px rgba(40, 167, 69, 0.7);
    }

    .buoy-widget .traffic-light.amber {
        background: rgba(255, 193, 7, 0.12);
        border-color: rgba(255, 193, 7, 0.5);
        color: #ffd24d;
    }

    .buoy-widget .traffic-light.amber .traffic-dot {
        background: #ffc107;
        box-shadow: 0 0 10px rgba(255, 193, 7, 0.75);
    }

    .buoy-widget .traffic-light.red {
        background: rgba(220, 53, 69, 0.12);
        border-color: rgba(220, 53, 69, 0.55);
        color: #ff8f9a;
    }

    .buoy-widget .traffic-light.red .traffic-dot {
        background: #dc3545;
        box-shadow: 0 0 10px rgba(220, 53, 69, 0.75);
    }

    .buoy-widget .traffic-reason {
        font-size: 0.75rem;
        opacity: 0.9;
        margin-top: 2px;
    }
</style>
