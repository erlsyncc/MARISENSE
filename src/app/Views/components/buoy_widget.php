<?php
/**
 * Buoy Sensor Data Widget
 * Displays current marine safety indicators with theme-matched animations
 */

$formatFloat = static function ($value, int $precision = 2): string {
    return $value === null ? 'N/A' : number_format((float) $value, $precision);
};
?>

<div class="buoy-widget">
    <div class="buoy-header">
        <div class="buoy-title-section">
            <div class="buoy-icon">
                <i class="fa-solid fa-water"></i>
            </div>
            <div>
                <h5 class="buoy-title">Live Buoy Data</h5>
                <p class="buoy-subtitle">Real-time marine conditions</p>
            </div>
        </div>
        <div class="buoy-status-dot"></div>
    </div>

    <div class="buoy-content">
        <?php if ($buoyData): ?>
            <?php
                $waveHeight = (float) ($buoyData['avg_wave_height'] ?? 0.0);
                $windAvg = (float) ($buoyData['avg_wind_speed'] ?? 0.0);
                $windGust = (float) ($buoyData['max_wind_speed'] ?? $windAvg);
                $waterTempAvg = $buoyData['water_temp_avg'] ?? null;
                $receivedAt = $buoyData['recorded_at'] ?? null;

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

            <!-- Metrics Grid -->
            <div class="buoy-metrics">
                <div class="metric-card <?= $windState ?>" style="animation-delay: 0.05s">
                    <div class="metric-icon wind">
                        <i class="fa-solid fa-wind"></i>
                    </div>
                    <div class="metric-data">
                        <div class="metric-label">Wind Speed</div>
                        <div class="metric-value"><?= $formatFloat($windAvg, 1) ?> <span>m/s</span></div>
                        <div class="metric-detail">Gust: <?= $formatFloat($windGust, 1) ?> m/s</div>
                        <div class="metric-tooltip"><?= esc($windHover) ?></div>
                    </div>
                </div>

                <div class="metric-card <?= $waveState ?>" style="animation-delay: 0.1s">
                    <div class="metric-icon wave">
                        <i class="fa-solid fa-water"></i>
                    </div>
                    <div class="metric-data">
                        <div class="metric-label">Wave Height</div>
                        <div class="metric-value"><?= $formatFloat($waveHeight, 2) ?> <span>m</span></div>
                        <div class="metric-detail">Current avg wave</div>
                        <div class="metric-tooltip"><?= esc($waveHover) ?></div>
                    </div>
                </div>

                <div class="metric-card <?= $tempState ?>" style="animation-delay: 0.15s">
                    <div class="metric-icon temp">
                        <i class="fa-solid fa-thermometer"></i>
                    </div>
                    <div class="metric-data">
                        <div class="metric-label">Water Temp</div>
                        <div class="metric-value"><?= $formatFloat($waterTempAvg) ?> <span>°C</span></div>
                        <div class="metric-detail"><?= $waterTempAvg === null ? 'Sensor offline' : 'Surface reading' ?></div>
                        <div class="metric-tooltip"><?= esc($tempHover) ?></div>
                    </div>
                </div>
            </div>

            <!-- Safety Status Banner -->
            <div class="safety-banner <?= $safetyState ?>">
                <div class="safety-indicator">
                    <div class="safety-pulse"></div>
                </div>
                <div class="safety-content">
                    <div class="safety-label">Safety Status</div>
                    <div class="safety-status"><?= esc($safetyLabel) ?></div>
                    <div class="safety-reason"><?= esc($safetyReason) ?></div>
                </div>
            </div>

            <!-- Last Updated -->
            <div class="buoy-footer">
                <i class="fa-solid fa-clock"></i>
                <span>Last update: <?= $receivedAt ? date('M d, Y H:i:s', strtotime($receivedAt)) : 'N/A' ?></span>
            </div>

        <?php else: ?>
            <div class="buoy-empty">
                <i class="fa-solid fa-tower-broadcast"></i>
                <p>No buoy data available yet</p>
                <span>Sensor data will appear here once transmitted</span>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
    @keyframes fadeUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes slideIn { from { opacity: 0; transform: translateX(-16px); } to { opacity: 1; transform: translateX(0); } }
    @keyframes pulse { 0%, 100% { transform: scale(1); opacity: 1; } 50% { transform: scale(1.2); opacity: 0.7; } }
    @keyframes shimmer { from { background-position: -1000px 0; } to { background-position: 1000px 0; } }
    @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-8px); } }

    .buoy-widget {
        background: linear-gradient(145deg, rgba(20, 80, 100, 0.85), rgba(10, 50, 65, 0.95));
        border: 1px solid rgba(72, 202, 228, 0.28);
        border-radius: 20px;
        padding: 24px;
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        box-shadow: 0 16px 34px rgba(0, 0, 0, 0.2);
        position: relative;
        overflow: hidden;
        animation: fadeUp 0.6s ease-out;
    }

    .buoy-widget::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 15% 16%, rgba(72, 202, 228, 0.07), transparent 44%);
        pointer-events: none;
    }

    .buoy-widget > * {
        position: relative;
        z-index: 1;
    }

    .buoy-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
        padding-bottom: 16px;
        border-bottom: 1px solid rgba(72, 202, 228, 0.15);
    }

    .buoy-title-section {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .buoy-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        background: rgba(72, 202, 228, 0.15);
        color: #48cae4;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        animation: float 3s ease-in-out infinite;
    }

    .buoy-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: white;
        margin: 0;
        animation: slideIn 0.5s ease-out;
    }

    .buoy-subtitle {
        font-size: 0.72rem;
        color: rgba(255, 255, 255, 0.75);
        margin: 4px 0 0;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .buoy-status-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: #5ddb8a;
        box-shadow: 0 0 12px rgba(93, 219, 138, 0.6);
        animation: pulse 2s ease-in-out infinite;
    }

    .buoy-metrics {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 14px;
        margin-bottom: 20px;
    }

    .metric-card {
        background: rgba(255, 255, 255, 0.06);
        border: 1px solid rgba(255, 255, 255, 0.12);
        border-radius: 14px;
        padding: 16px;
        display: flex;
        gap: 12px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        animation: fadeUp 0.6s ease-out both;
        position: relative;
        overflow: hidden;
    }

    .metric-card::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 20% 50%, rgba(72, 202, 228, 0.1), transparent 60%);
        opacity: 0;
        transition: opacity 0.3s ease;
        pointer-events: none;
    }

    .metric-card:hover {
        background: rgba(255, 255, 255, 0.09);
        border-color: rgba(72, 202, 228, 0.35);
        transform: translateY(-4px);
    }

    .metric-card:hover::before {
        opacity: 1;
    }

    .metric-card.normal { border-left: 3px solid rgba(40, 167, 69, 0.6); }
    .metric-card.watch { border-left: 3px solid rgba(255, 193, 7, 0.7); }
    .metric-card.not-normal { border-left: 3px solid rgba(220, 53, 69, 0.7); }

    .metric-icon {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        flex-shrink: 0;
        transition: transform 0.3s ease;
    }

    .metric-card:hover .metric-icon {
        transform: scale(1.1) rotate(5deg);
    }

    .metric-icon.wind { background: rgba(72, 202, 228, 0.15); color: #48cae4; }
    .metric-icon.wave { background: rgba(72, 202, 228, 0.15); color: #48cae4; }
    .metric-icon.temp { background: rgba(72, 202, 228, 0.15); color: #48cae4; }

    .metric-data {
        display: flex;
        flex-direction: column;
        justify-content: center;
        flex: 1;
    }

    .metric-label {
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: rgba(255, 255, 255, 0.75);
        margin-bottom: 4px;
        font-weight: 600;
    }

    .metric-value {
        font-size: 1.3rem;
        font-weight: 700;
        color: white;
    }

    .metric-value span {
        font-size: 0.75rem;
        color: rgba(255, 255, 255, 0.6);
        margin-left: 2px;
    }

    .metric-detail {
        font-size: 0.7rem;
        color: rgba(255, 255, 255, 0.75);
        margin-top: 2px;
    }

    .metric-tooltip {
        display: none;
        font-size: 0.72rem;
        color: #48cae4;
        margin-top: 4px;
        padding-top: 4px;
        border-top: 1px solid rgba(72, 202, 228, 0.15);
        line-height: 1.3;
    }

    .metric-card:hover .metric-tooltip {
        display: block;
        animation: fadeUp 0.3s ease-out;
    }

    .safety-banner {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 16px 18px;
        border-radius: 14px;
        margin-bottom: 14px;
        border: 1px solid;
        animation: slideIn 0.7s ease-out 0.2s both;
    }

    .safety-indicator {
        width: 14px;
        height: 14px;
        border-radius: 50%;
        flex-shrink: 0;
        position: relative;
    }

    .safety-pulse {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        animation: pulse 2s ease-in-out infinite;
    }

    .safety-banner.green {
        background: rgba(40, 167, 69, 0.12);
        border-color: rgba(40, 167, 69, 0.45);
        color: #5ddb8a;
    }

    .safety-banner.green .safety-pulse {
        background: #28a745;
        box-shadow: 0 0 12px rgba(40, 167, 69, 0.7);
    }

    .safety-banner.amber {
        background: rgba(255, 193, 7, 0.12);
        border-color: rgba(255, 193, 7, 0.5);
        color: #ffd24d;
    }

    .safety-banner.amber .safety-pulse {
        background: #ffc107;
        box-shadow: 0 0 12px rgba(255, 193, 7, 0.75);
    }

    .safety-banner.red {
        background: rgba(220, 53, 69, 0.12);
        border-color: rgba(220, 53, 69, 0.55);
        color: #ff8f9a;
    }

    .safety-banner.red .safety-pulse {
        background: #dc3545;
        box-shadow: 0 0 12px rgba(220, 53, 69, 0.75);
    }

    .safety-content {
        flex: 1;
    }

    .safety-label {
        font-size: 0.68rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        opacity: 0.85;
        font-weight: 600;
    }

    .safety-status {
        font-size: 0.95rem;
        font-weight: 700;
        margin: 2px 0;
    }

    .safety-reason {
        font-size: 0.72rem;
        opacity: 0.8;
        line-height: 1.3;
        margin-top: 2px;
    }

    .buoy-footer {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.76rem;
        color: rgba(255, 255, 255, 0.75);
        padding-top: 12px;
        border-top: 1px solid rgba(72, 202, 228, 0.1);
        animation: fadeUp 0.8s ease-out 0.4s both;
    }

    .buoy-footer i {
        color: #48cae4;
        font-size: 0.9rem;
    }

    .buoy-empty {
        text-align: center;
        padding: 40px 24px;
        color: rgba(255, 255, 255, 0.4);
        animation: fadeUp 0.6s ease-out;
    }

    .buoy-empty i {
        font-size: 3rem;
        color: rgba(72, 202, 228, 0.3);
        margin-bottom: 12px;
        display: block;
        animation: float 3s ease-in-out infinite;
    }

    .buoy-empty p {
        font-size: 1.05rem;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.6);
        margin-bottom: 4px;
    }

    .buoy-empty span {
        font-size: 0.8rem;
        color: rgba(255, 255, 255, 0.35);
    }

    @media (prefers-reduced-motion: reduce) {
        * { animation: none !important; transition: none !important; }
    }
</style>
