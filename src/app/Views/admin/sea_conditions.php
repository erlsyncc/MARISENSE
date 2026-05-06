<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sea Conditions | Waves Admin</title>
    <link rel="stylesheet" href="<?= base_url('bootstrap5/css/bootstrap.min.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <style>
        :root { --deep-blue: #052c39; --ocean-blue: #0a5872; --accent-cyan: #48cae4; --soft-white: #f4f9fc; --sidebar-width: 260px; }
        * { box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background: linear-gradient(180deg, var(--ocean-blue) 0%, var(--deep-blue) 60%, var(--deep-blue) 100%);}
        .sidebar { position: fixed; top: 0; left: 0; width: var(--sidebar-width); height: 100vh; background: rgba(5,44,57,0.95); backdrop-filter: blur(20px); border-right: 1px solid rgba(255,255,255,0.1); z-index: 1000; display: flex; flex-direction: column; overflow-y: auto; }
        .sidebar-brand { padding: 28px 24px 22px; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .sidebar-brand .brand-icon { font-size: 2rem; color: var(--accent-cyan); margin-bottom: 6px; }
        .sidebar-brand .brand-title { font-size: 1.1rem; font-weight: 700; color: white; }
        .sidebar-brand .brand-sub { font-size: 0.7rem; color: rgba(255,255,255,0.4); text-transform: uppercase; letter-spacing: 1px; }
        .sidebar-section-label { font-size: 0.65rem; text-transform: uppercase; letter-spacing: 2px; color: rgba(255,255,255,0.3); padding: 18px 24px 6px; }
        .nav-item { display: flex; align-items: center; gap: 12px; padding: 11px 20px; margin: 2px 12px; border-radius: 12px; color: rgba(255,255,255,0.65); text-decoration: none; font-size: 0.88rem; font-weight: 500; transition: 0.25s; }
        .nav-item:hover { background: rgba(255,255,255,0.08); color: var(--accent-cyan); text-decoration: none; }
        .nav-item.active { background: var(--accent-cyan); color: var(--deep-blue); font-weight: 700; }
        .nav-item i { width: 18px; text-align: center; font-size: 0.9rem; }
        .sidebar-footer { margin-top: auto; padding: 16px 12px; border-top: 1px solid rgba(255,255,255,0.08); }
        .logout-btn { display: flex; align-items: center; gap: 12px; padding: 11px 20px; border-radius: 12px; color: #ff6b6b; text-decoration: none; font-size: 0.88rem; font-weight: 600; border: 1px solid rgba(255,107,107,0.25); transition: 0.25s; }
        .logout-btn:hover { background: #ff6b6b; color: white; text-decoration: none; }

        .main-content { margin-left: var(--sidebar-width); padding: 32px 36px; min-height: 100vh; }
        .page-topbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 28px; }
        .page-title { font-size: 1.6rem; font-weight: 700; color: white; margin: 0; }
        .page-subtitle { font-size: 0.82rem; color: rgba(255,255,255,0.5); margin: 2px 0 0; }
        .admin-pill { background: rgba(72,202,228,0.12); border: 1px solid rgba(72,202,228,0.3); color: var(--accent-cyan); border-radius: 50px; padding: 6px 18px; font-size: 0.78rem; font-weight: 600; letter-spacing: 1px; }

        .sea-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 18px; margin-bottom: 28px; }
        .sea-card { background: rgba(255,255,255,0.08); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.12); border-radius: 20px; padding: 26px 22px; text-align: center; transition: 0.3s; }
        .sea-card:hover { transform: translateY(-4px); border-color: rgba(72,202,228,0.3); }
        .sea-card .card-icon { font-size: 2rem; color: var(--accent-cyan); margin-bottom: 12px; }
        .sea-card .card-label { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1.5px; color: rgba(255,255,255,0.5); margin-bottom: 6px; }
        .sea-card .card-value { font-size: 2.2rem; font-weight: 700; color: white; line-height: 1; }
        .sea-card .card-unit { font-size: 0.8rem; color: var(--accent-cyan); margin-top: 4px; }

        .panels-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 24px; }
        .panel { background: rgba(255,255,255,0.07); backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.1); border-radius: 24px; padding: 28px; }
        .panel-title { font-size: 0.82rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: rgba(255,255,255,0.6); margin-bottom: 20px; display: flex; align-items: center; gap: 8px; }
        .panel-title i { color: var(--accent-cyan); }
        .chart-panel { margin-bottom: 24px; }
        .chart-meta { font-size: 0.76rem; color: rgba(255,255,255,0.45); margin-top: -8px; margin-bottom: 14px; }

        .status-box { border-radius: 20px; padding: 28px; text-align: center; margin-bottom: 24px; }
        .status-safe     { background: rgba(40,167,69,0.12); border: 2px solid rgba(40,167,69,0.35); }
        .status-moderate { background: rgba(255,193,7,0.12); border: 2px solid rgba(255,193,7,0.35); }
        .status-unsafe   { background: rgba(220,53,69,0.12); border: 2px solid rgba(220,53,69,0.35); }
        .status-icon { font-size: 3rem; margin-bottom: 10px; }
        .status-label { font-size: 1.4rem; font-weight: 700; }
        .status-desc { font-size: 0.85rem; opacity: 0.7; margin-top: 6px; color: white; }

        /* Update form */
        .form-panel { background: rgba(255,255,255,0.07); backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.12); border-radius: 24px; padding: 30px; margin-bottom: 24px; }
        .field-label { display: block; font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: var(--accent-cyan); margin-bottom: 8px; }
        .form-control-wave { width: 100%; background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.15); border-radius: 12px; color: white; padding: 12px 16px; font-size: 0.9rem; font-family: 'Poppins', sans-serif; transition: border-color 0.3s; outline: none; }
        .form-control-wave:focus { border-color: rgba(72,202,228,0.6); background: rgba(255,255,255,0.1); }
        .form-control-wave::placeholder { color: rgba(255,255,255,0.3); }
        .form-select-wave { width: 100%; background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.15); border-radius: 12px; color: white; padding: 12px 16px; font-size: 0.9rem; font-family: 'Poppins', sans-serif; outline: none; -webkit-appearance: none; }
        .form-select-wave option { background: #073d52; color: white; }
        .form-row-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 18px; margin-bottom: 18px; }
        .form-row-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; margin-bottom: 18px; }
        .btn-update { background: var(--accent-cyan); color: var(--deep-blue); font-weight: 700; border: none; border-radius: 14px; padding: 14px 36px; font-size: 0.95rem; cursor: pointer; transition: 0.3s; }
        .btn-update:hover { background: white; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(72,202,228,0.3); }

        /* History table */
        .history-table { width: 100%; color: white; border-collapse: separate; border-spacing: 0 6px; }
        .history-table thead th { border: none; text-transform: uppercase; font-size: 0.68rem; letter-spacing: 1.5px; opacity: 0.5; padding: 6px 14px; font-weight: 600; }
        .history-table tbody tr { background: rgba(255,255,255,0.04); }
        .history-table tbody tr:hover { background: rgba(255,255,255,0.08); }
        .history-table td { padding: 10px 14px; vertical-align: middle; font-size: 0.82rem; border: none; }
        .history-table td:first-child { border-radius: 10px 0 0 10px; }
        .history-table td:last-child { border-radius: 0 10px 10px 0; }
        .dot-safe { color: #5ddb8a; }
        .dot-moderate { color: #ffc107; }
        .dot-unsafe { color: #ff6b6b; }
        @keyframes wave-motion {0% { transform: translateY(0); }50% { transform: translateY(-3px); }100% { transform: translateY(0); }}
        .brand-icon i { animation: wave-motion 3s ease-in-out infinite;display: inline-block;}
        /* Help Button & Modal */
        .help-btn { display: flex; align-items: center; gap: 12px; padding: 11px 20px; border-radius: 12px; color: var(--accent-cyan); text-decoration: none; font-size: 0.88rem; font-weight: 600; border: 1px solid rgba(72,202,228,0.25); transition: 0.25s; cursor: pointer; background: none; width: 100%; margin-top: 8px; }
        .help-btn:hover { background: rgba(72,202,228,0.15); color: white; }
        .help-overlay { display: none; position: fixed; inset: 0; background: rgba(5,44,57,0.85); backdrop-filter: blur(8px); z-index: 9999; align-items: center; justify-content: center; }
        .help-overlay.open { display: flex; }
        .help-modal { background: linear-gradient(145deg, #0a3d52, #052c39); border: 1px solid rgba(72,202,228,0.25); border-radius: 28px; padding: 36px; max-width: 560px; width: 90%; max-height: 85vh; overflow-y: auto; position: relative; }
        .help-modal-title { font-size: 1.3rem; font-weight: 700; color: white; margin-bottom: 4px; }
        .help-modal-sub { font-size: 0.78rem; color: rgba(255,255,255,0.4); margin-bottom: 24px; }
        .help-close { position: absolute; top: 20px; right: 20px; background: rgba(255,255,255,0.08); border: none; color: rgba(255,255,255,0.6); border-radius: 50%; width: 34px; height: 34px; cursor: pointer; font-size: 1rem; transition: 0.2s; display: flex; align-items: center; justify-content: center; }
        .help-close:hover { background: rgba(220,53,69,0.3); color: #ff6b6b; }
        .help-section { margin-bottom: 20px; }
        .help-section-title { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 2px; color: var(--accent-cyan); margin-bottom: 10px; font-weight: 700; }
        .help-item { display: flex; align-items: flex-start; gap: 14px; padding: 12px 14px; background: rgba(255,255,255,0.05); border-radius: 14px; margin-bottom: 8px; border: 1px solid rgba(255,255,255,0.06); }
        .help-item-icon { width: 36px; height: 36px; border-radius: 10px; background: rgba(72,202,228,0.12); display: flex; align-items: center; justify-content: center; color: var(--accent-cyan); font-size: 0.85rem; flex-shrink: 0; }
        .help-item-title { font-size: 0.85rem; font-weight: 700; color: white; margin-bottom: 2px; }
        .help-item-desc { font-size: 0.76rem; color: rgba(255,255,255,0.5); line-height: 1.5; }
        .help-tip { background: rgba(72,202,228,0.07); border: 1px solid rgba(72,202,228,0.2); border-radius: 12px; padding: 12px 16px; font-size: 0.78rem; color: rgba(255,255,255,0.6); line-height: 1.6; }
        .help-tip strong { color: var(--accent-cyan); }
    </style>
</head>
<body>

<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon">
            <i class="fa-solid fa-water"></i> </div>
        <div class="brand-title">Waves Admin</div>
        <div class="brand-sub">Control Panel</div>
    </div>
    <div class="sidebar-section-label">Main</div>
    <a href="<?= base_url('admin/dashboard') ?>" class="nav-item"><i class="fa-solid fa-chart-line"></i> Dashboard</a>
    <a href="<?= base_url('admin/bookings') ?>" class="nav-item"><i class="fa-solid fa-calendar-check"></i> Bookings</a>
    <a href="<?= base_url('admin/users') ?>" class="nav-item"><i class="fa-solid fa-users"></i> Users</a>
    <div class="sidebar-section-label">Operations</div>
    <a href="<?= base_url('admin/sea-conditions') ?>" class="nav-item active"><i class="fa-solid fa-tower-broadcast"></i> Sea Conditions</a>
    <a href="<?= base_url('admin/reviews') ?>" class="nav-item"><i class="fa-solid fa-star"></i> Reviews</a>
    <div class="sidebar-section-label">System</div>
    <a href="<?= base_url('admin/activities') ?>" class="nav-item"><i class="fa-solid fa-person-swimming"></i> Activities</a>
    <a href="<?= base_url('admin/sales') ?>" class="nav-item"><i class="fa-solid fa-peso-sign"></i> Sales</a>
    <div class="sidebar-footer">
    <button class="help-btn" onclick="document.getElementById('helpOverlay').classList.add('open')">
        <i class="fa-solid fa-circle-question"></i> Help & Guide
    </button>
    
    <a href="<?= base_url('logout') ?>" class="logout-btn">
        <i class="fa-solid fa-power-off"></i> Logout
    </a>
</div>
</aside>

<main class="main-content">
    <div class="page-topbar">
        <div>
            <h1 class="page-title">Sea Conditions</h1>
            <p class="page-subtitle">MARISENSE live data — monitor and update sea safety status.</p>
        </div>
        <span class="admin-pill"><i class="fa-solid fa-satellite-dish me-2"></i>MARISENSE</span>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success rounded-4 mb-3"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger rounded-4 mb-3"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <?php
        $current = $latestSea ?? [];
        $currentStatus = strtolower($current['safety_status'] ?? 'safe');

        $statusClass = match ($currentStatus) {
            'moderate' => 'status-moderate',
            'unsafe' => 'status-unsafe',
            default => 'status-safe',
        };
        $statusIcon = match ($currentStatus) {
            'moderate' => '🟡',
            'unsafe' => '🔴',
            default => '🟢',
        };
        $statusTitle = match ($currentStatus) {
            'moderate' => 'MODERATE CONDITIONS',
            'unsafe' => 'UNSAFE FOR ACTIVITIES',
            default => 'SAFE FOR ACTIVITIES',
        };
        $statusColor = match ($currentStatus) {
            'moderate' => '#ffc107',
            'unsafe' => '#ff6b6b',
            default => '#5ddb8a',
        };
        $statusDesc = match ($currentStatus) {
            'moderate' => 'Conditions are fair. Activities may proceed with caution and close operator monitoring.',
            'unsafe' => 'Conditions exceeded safety thresholds. Delay or suspend open-water activities.',
            default => 'All conditions are within acceptable thresholds. Activities may proceed normally.',
        };

        $recordedAt = $current['recorded_at'] ?? $current['created_at'] ?? null;
        $recordedDisplay = $recordedAt ? date('M d, Y h:i A', strtotime($recordedAt)) : 'No updates yet';

        $historyRows = array_reverse($seaHistory ?? []);
        $trendLabels = [];
        $trendWind = [];
        $trendWave = [];
        foreach ($historyRows as $row) {
            $timeKey = $row['recorded_at'] ?? $row['created_at'] ?? null;
            $trendLabels[] = $timeKey ? date('M d H:i', strtotime($timeKey)) : '—';
            $trendWind[] = isset($row['wind_speed']) ? (float) $row['wind_speed'] : 0.0;
            $trendWave[] = isset($row['wave_height']) ? (float) $row['wave_height'] : 0.0;
        }
    ?>

    <!-- LIVE METRICS -->
    <div class="sea-grid">
        <div class="sea-card">
            <div class="card-icon"><i class="fa-solid fa-wind"></i></div>
            <div class="card-label">Wind Speed</div>
            <div class="card-value"><?= number_format((float) ($current['wind_speed'] ?? 0), 1) ?></div>
            <div class="card-unit">knots</div>
        </div>
        <div class="sea-card">
            <div class="card-icon"><i class="fa-solid fa-compass"></i></div>
            <div class="card-label">Wind Direction</div>
            <div class="card-value" style="font-size:1.4rem;"><?= esc(substr((string) ($current['wind_direction'] ?? 'N/A'), 0, 3)) ?></div>
            <div class="card-unit"><?= esc($current['wind_direction'] ?? 'No direction data') ?></div>
        </div>
        <div class="sea-card">
            <div class="card-icon"><i class="fa-solid fa-water"></i></div>
            <div class="card-label">Wave Height</div>
            <div class="card-value"><?= number_format((float) ($current['wave_height'] ?? 0), 2) ?></div>
            <div class="card-unit">meters</div>
        </div>
        <div class="sea-card">
            <div class="card-icon"><i class="fa-solid fa-wave-square"></i></div>
            <div class="card-label">Wave Period</div>
            <div class="card-value"><?= number_format((float) ($current['wave_period'] ?? 0), 1) ?></div>
            <div class="card-unit">seconds</div>
        </div>
    </div>

    <!-- STATUS DISPLAY -->
    <div class="status-box <?= $statusClass ?>">
        <div class="status-icon"><?= $statusIcon ?></div>
        <div class="status-label" style="color:<?= $statusColor ?>;"><?= $statusTitle ?></div>
        <div class="status-desc"><?= esc($statusDesc) ?></div>
        <div style="font-size:0.76rem;color:rgba(255,255,255,0.6);margin-top:10px;">
            Last update: <?= esc($recordedDisplay) ?>
        </div>
    </div>

    <div class="panel chart-panel">
        <div class="panel-title"><i class="fa-solid fa-chart-line"></i> Condition Trend (Recent 20 Updates)</div>
        <p class="chart-meta">Wind speed and wave height over time.</p>
        <canvas id="seaTrendChart" style="height: 280px;"></canvas>
        <?php if (empty($seaHistory)): ?>
            <p style="text-align:center; color: rgba(255,255,255,0.7); font-size: 0.82rem; margin-top: 16px;">No trend data yet.</p>
        <?php endif; ?>
    </div>

    <div class="panels-row">
        <!-- UPDATE FORM -->
        <div class="form-panel">
            <div class="panel-title" style="margin-bottom:20px;"><i class="fa-solid fa-pen-to-square"></i> Update Sea Data</div>
            <form method="POST" action="<?= base_url('admin/sea-conditions/update') ?>">
                <?= csrf_field() ?>
                <div class="form-row-3">
                    <div>
                        <label class="field-label">Wind Speed (knots)</label>
                        <input type="number" step="0.1" name="wind_speed" class="form-control-wave" placeholder="e.g. 10" value="<?= esc($current['wind_speed'] ?? '') ?>" required>
                    </div>
                    <div>
                        <label class="field-label">Wind Direction</label>
                        <select name="wind_direction" class="form-select-wave">
                            <?php
                                $selectedDirection = $current['wind_direction'] ?? 'Northeast';
                                $directionOptions = ['North', 'Northeast', 'East', 'Southeast', 'South', 'Southwest', 'West', 'Northwest'];
                            ?>
                            <?php foreach ($directionOptions as $dir): ?>
                                <option value="<?= esc($dir) ?>" <?= $selectedDirection === $dir ? 'selected' : '' ?>><?= esc($dir) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label class="field-label">Temperature (°C)</label>
                        <input type="number" step="0.1" name="temperature" class="form-control-wave" placeholder="e.g. 28" value="<?= esc($current['temperature'] ?? '') ?>">
                    </div>
                </div>
                <div class="form-row-2">
                    <div>
                        <label class="field-label">Wave Height (meters)</label>
                        <input type="number" step="0.1" name="wave_height" class="form-control-wave" placeholder="e.g. 0.9" value="<?= esc($current['wave_height'] ?? '') ?>" required>
                    </div>
                    <div>
                        <label class="field-label">Wave Period (seconds)</label>
                        <input type="number" step="0.1" name="wave_period" class="form-control-wave" placeholder="e.g. 5" value="<?= esc($current['wave_period'] ?? '') ?>" required>
                    </div>
                </div>
                <div style="margin-bottom:18px;">
                    <label class="field-label">Safety Status</label>
                    <select name="safety_status" class="form-select-wave">
                        <?php $selectedStatus = $current['safety_status'] ?? 'safe'; ?>
                        <option value="safe" <?= $selectedStatus === 'safe' ? 'selected' : '' ?>>🟢 Safe for Activities</option>
                        <option value="moderate" <?= $selectedStatus === 'moderate' ? 'selected' : '' ?>>🟡 Moderate — Proceed with Caution</option>
                        <option value="unsafe" <?= $selectedStatus === 'unsafe' ? 'selected' : '' ?>>🔴 Unsafe — Operations Suspended</option>
                    </select>
                </div>
                <div style="margin-bottom:18px;">
                    <label class="field-label">Admin Notes (Optional)</label>
                    <textarea name="notes" class="form-control-wave" rows="2" placeholder="e.g. High tide expected at 3PM..."><?= esc($current['notes'] ?? '') ?></textarea>
                </div>
                <button type="submit" class="btn-update">
                    <i class="fa-solid fa-satellite-dish me-2"></i> Update Sea Data
                </button>
            </form>
        </div>

        <!-- SAFETY THRESHOLDS -->
        <div class="panel">
            <div class="panel-title"><i class="fa-solid fa-shield-halved"></i> Safety Thresholds</div>
            <div style="font-size:0.85rem;line-height:2.2;">
                
                <div style="display:flex;justify-content:space-between;border-bottom:1px solid rgba(255,255,255,0.06);padding-bottom:10px;margin-bottom:10px;">
                    <span style="color:rgba(255,255,255,0.6);"><i class="fa-solid fa-wind me-2" style="color:var(--accent-cyan);"></i>Wind Speed</span>
                    <span style="color:white;">
                        ≤ 15 kts = <span style="color:#5ddb8a;">Safe </span>
                        &nbsp;|&nbsp; 
                        &gt; 15 kts = <span style="color:#ff6b6b;">Unsafe</span>
                    </span>
                </div>

                <div style="display:flex;justify-content:space-between;border-bottom:1px solid rgba(255,255,255,0.06);padding-bottom:10px;margin-bottom:10px;">
                    <span style="color:rgba(255,255,255,0.6);"><i class="fa-solid fa-water me-2" style="color:var(--accent-cyan);"></i>Wave Height</span>
                    <span style="color:white;">
                        ≤ 1.5 m =<span style="color:#5ddb8a;"> Safe </span>
                        &nbsp;|&nbsp; 
                        &gt; 1.5 m = <span style="color:#ff6b6b;">Unsafe</span>
                    </span>
                </div>

                <div style="display:flex;justify-content:space-between;padding-bottom:10px;margin-bottom:10px;">
                    <span style="color:rgba(255,255,255,0.6);"><i class="fa-solid fa-stopwatch me-2" style="color:var(--accent-cyan);"></i>Wave Period</span>
                    <span style="color:white;">
                        ≥ 4 s = <span style="color:#5ddb8a;">Acceptable</span>
                    </span>
                </div>

                <div style="background:rgba(255,193,7,0.08);border:1px dashed rgba(255,193,7,0.3);border-radius:12px;padding:14px;margin-top:14px;font-size:0.8rem;color:white;">
                    <i class="fa-solid fa-circle-exclamation text-warning me-2"></i>
                    Operations are automatically flagged when thresholds are exceeded. Always use your judgment for final decisions.
                </div>
            </div>
        </div>
    </div>

    <!-- HISTORY LOG -->
    <div class="panel">
        <div class="panel-title" style="margin-bottom:20px;"><i class="fa-solid fa-clock-rotate-left"></i> Recent Sea Data Log</div>
        <?php if (!empty($seaHistory)): ?>
            <div style="overflow-x:auto;">
                <table class="history-table">
                    <thead>
                        <tr>
                            <th>Timestamp</th>
                            <th>Wind Speed</th>
                            <th>Direction</th>
                            <th>Wave Height</th>
                            <th>Wave Period</th>
                            <th>Status</th>
                            <th>Updated By</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($seaHistory as $h): ?>
                        <?php
                            $dotClass = match($h['safety_status'] ?? 'safe') {
                                'safe'     => 'dot-safe',
                                'moderate' => 'dot-moderate',
                                'unsafe'   => 'dot-unsafe',
                                default    => 'dot-safe'
                            };
                            $dot = match($h['safety_status'] ?? 'safe') { 'safe'=>'🟢','moderate'=>'🟡','unsafe'=>'🔴',default=>'🟢' };
                        ?>
                        <tr>
                            <td style="color:rgba(255,255,255,0.6);"><?= date('M d, Y h:i A', strtotime($h['recorded_at'] ?? $h['created_at'])) ?></td>
                            <td><?= esc($h['wind_speed']) ?> kts</td>
                            <td><?= esc($h['wind_direction'] ?? 'N/A') ?></td>
                            <td><?= esc($h['wave_height']) ?> m</td>
                            <td><?= esc($h['wave_period']) ?> s</td>
                            <td><span class="<?= $dotClass ?>"><?= $dot ?> <?= ucfirst($h['safety_status'] ?? 'safe') ?></span></td>
                            <td style="color:rgba(255,255,255,0.5);"><?= esc($h['admin_username'] ?? 'System') ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p style="text-align:center; color: white; opacity: 0.7; font-size: 0.85rem;">No sea data history yet.</p>
        <?php endif; ?>
    </div>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
const trendLabels = <?= json_encode($trendLabels ?? []) ?>;
const trendWind = <?= json_encode($trendWind ?? []) ?>;
const trendWave = <?= json_encode($trendWave ?? []) ?>;

if (trendLabels.length > 0) {
    const ctx = document.getElementById('seaTrendChart').getContext('2d');
    const waveGradient = ctx.createLinearGradient(0, 0, 0, 260);
    waveGradient.addColorStop(0, 'rgba(72,202,228,0.22)');
    waveGradient.addColorStop(1, 'rgba(72,202,228,0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: trendLabels,
            datasets: [
                {
                    label: 'Wind Speed (kts)',
                    data: trendWind,
                    borderColor: '#ffc107',
                    backgroundColor: 'rgba(255,193,7,0.12)',
                    borderWidth: 2,
                    pointRadius: 2,
                    tension: 0.35,
                },
                {
                    label: 'Wave Height (m)',
                    data: trendWave,
                    borderColor: '#48cae4',
                    backgroundColor: waveGradient,
                    borderWidth: 2.4,
                    pointRadius: 2,
                    fill: true,
                    tension: 0.35,
                    yAxisID: 'y1',
                },
            ],
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: {
                        color: 'rgba(255,255,255,0.72)',
                        font: { family: 'Poppins', size: 11 },
                    },
                },
            },
            scales: {
                x: {
                    ticks: { color: 'rgba(255,255,255,0.5)', maxRotation: 0, autoSkip: true, maxTicksLimit: 8 },
                    grid: { color: 'rgba(255,255,255,0.05)' },
                },
                y: {
                    title: { display: true, text: 'kts', color: 'rgba(255,255,255,0.45)' },
                    ticks: { color: 'rgba(255,255,255,0.5)' },
                    grid: { color: 'rgba(255,255,255,0.05)' },
                },
                y1: {
                    position: 'right',
                    title: { display: true, text: 'm', color: 'rgba(255,255,255,0.45)' },
                    ticks: { color: 'rgba(255,255,255,0.5)' },
                    grid: { drawOnChartArea: false },
                },
            },
        },
    });
}
</script>
<!-- HELP MODAL -->
<div class="help-overlay" id="helpOverlay" onclick="if(event.target===this) this.classList.remove('open')">
    <div class="help-modal">
        <button class="help-close" onclick="document.getElementById('helpOverlay').classList.remove('open')">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <div class="help-modal-title"><i class="fa-solid fa-circle-question me-2" style="color:var(--accent-cyan)"></i>Admin Help Guide</div>
        <div class="help-modal-sub">Everything you need to manage the Waves platform.</div>

        <div class="help-section">
            <div class="help-section-title">📋 Main</div>
            <div class="help-item">
                <div class="help-item-icon"><i class="fa-solid fa-chart-line"></i></div>
                <div>
                    <div class="help-item-title">Dashboard</div>
                    <div class="help-item-desc">Overview of total bookings, revenue, and platform activity at a glance.</div>
                </div>
            </div>
            <div class="help-item">
                <div class="help-item-icon"><i class="fa-solid fa-calendar-check"></i></div>
                <div>
                    <div class="help-item-title">Bookings</div>
                    <div class="help-item-desc">View and manage all customer reservations. Update statuses, track schedules, and cancel bookings here.</div>
                </div>
            </div>
            <div class="help-item">
                <div class="help-item-icon"><i class="fa-solid fa-users"></i></div>
                <div>
                    <div class="help-item-title">Users</div>
                    <div class="help-item-desc">Browse all registered accounts, check booking counts, and identify roles (Admin vs User).</div>
                </div>
            </div>
        </div>

        <div class="help-section">
            <div class="help-section-title">⚙️ Operations</div>
            <div class="help-item">
                <div class="help-item-icon"><i class="fa-solid fa-tower-broadcast"></i></div>
                <div>
                    <div class="help-item-title">Sea Conditions</div>
                    <div class="help-item-desc">Post live sea condition updates (wave height, wind speed, safety status) visible to customers before booking.</div>
                </div>
            </div>
            <div class="help-item">
                <div class="help-item-icon"><i class="fa-solid fa-star"></i></div>
                <div>
                    <div class="help-item-title">Reviews</div>
                    <div class="help-item-desc">Monitor guest feedback. Filter by activity and remove inappropriate reviews using the delete button on each card.</div>
                </div>
            </div>
        </div>

        <div class="help-section">
            <div class="help-section-title">🛠 System</div>
            <div class="help-item">
                <div class="help-item-icon"><i class="fa-solid fa-person-swimming"></i></div>
                <div>
                    <div class="help-item-title">Activities</div>
                    <div class="help-item-desc">Add, edit, or remove available water activities (Jet Ski, Kayaking, etc.) and manage their pricing.</div>
                </div>
            </div>
            <div class="help-item">
                <div class="help-item-icon"><i class="fa-solid fa-peso-sign"></i></div>
                <div>
                    <div class="help-item-title">Sales</div>
                    <div class="help-item-desc">Track revenue reports, view earnings per activity, and monitor payment trends over time.</div>
                </div>
            </div>
        </div>

        <div class="help-tip">
            <strong>💡 Tip:</strong> Sea conditions you post are shown to customers on the booking page — always keep them updated before opening hours to help guests make informed decisions.
        </div>
    </div>
</div>
</body>
</html>
