<?php
/**
 * Buoy Sensor Data Widget
 * Displays latest buoy readings (pitch, roll, hall state, signal strength)
 */
?>

<div class="buoy-widget card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">🌊 Live Buoy Data</h5>
    </div>
    <div class="card-body">
        <?php if ($buoyData): ?>
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="metric-box">
                        <label class="text-muted small">Pitch (°)</label>
                        <h4 class="mb-0"><?= number_format($buoyData['pitch'], 2) ?></h4>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="metric-box">
                        <label class="text-muted small">Roll (°)</label>
                        <h4 class="mb-0"><?= number_format($buoyData['roll'], 2) ?></h4>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="metric-box">
                        <label class="text-muted small">Hall State</label>
                        <h4 class="mb-0"><?= $buoyData['hall'] ?></h4>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="metric-box">
                        <label class="text-muted small">Signal (RSSI)</label>
                        <h4 class="mb-0"><?= $buoyData['rssi'] ?> dBm</h4>
                        <small class="text-muted">
                            <?php 
                                $rssi = $buoyData['rssi'];
                                if ($rssi >= -50) $signal = 'Excellent';
                                elseif ($rssi >= -60) $signal = 'Good';
                                elseif ($rssi >= -70) $signal = 'Fair';
                                else $signal = 'Poor';
                                echo $signal;
                            ?>
                        </small>
                    </div>
                </div>
            </div>
            <div class="mt-3 pt-2 border-top">
                <small class="text-muted">
                    Last update: <?= date('M d, Y H:i:s', strtotime($buoyData['recorded_at'])) ?>
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
