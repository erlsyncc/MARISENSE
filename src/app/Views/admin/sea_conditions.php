<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sea Conditions | Waves Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <style>
        :root { --deep-blue: #052c39; --ocean-blue: #0a5872; --accent-cyan: #48cae4; --sidebar-width: 260px; }
        * { box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background: linear-gradient(180deg, var(--ocean-blue) 0%, var(--deep-blue) 60%, var(--deep-blue) 100%); margin: 0; }
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
        .help-btn { display: flex; align-items: center; gap: 12px; padding: 11px 20px; border-radius: 12px; color: var(--accent-cyan); text-decoration: none; font-size: 0.88rem; font-weight: 600; border: 1px solid rgba(72,202,228,0.25); transition: 0.25s; cursor: pointer; background: none; width: 100%; margin-top: 8px; }
        .help-btn:hover { background: rgba(72,202,228,0.15); color: white; }

        .main-content { margin-left: var(--sidebar-width); padding: 32px 36px; min-height: 100vh; }
        .sidebar-toggle { display: none; position: fixed; top: 14px; left: 14px; width: 42px; height: 42px; border-radius: 10px; border: 1px solid rgba(72,202,228,0.35); background: rgba(5,44,57,0.92); color: var(--accent-cyan); z-index: 1101; align-items: center; justify-content: center; font-size: 1rem; cursor: pointer; }
        .sidebar-backdrop { display: none; position: fixed; inset: 0; background: rgba(5,44,57,0.55); z-index: 1099; }
        .sidebar-backdrop.open { display: block; }
        .page-topbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 26px; }
        .page-title { font-size: 1.6rem; font-weight: 700; color: white; margin: 0; }
        .page-subtitle { font-size: 0.82rem; color: rgba(255,255,255,0.5); margin: 2px 0 0; }
        .admin-pill { background: rgba(72,202,228,0.12); border: 1px solid rgba(72,202,228,0.3); color: var(--accent-cyan); border-radius: 50px; padding: 6px 18px; font-size: 0.78rem; font-weight: 600; letter-spacing: 1px; }

        .status-box { border-radius: 20px; padding: 24px; margin-bottom: 22px; border: 2px solid transparent; background: rgba(255,255,255,0.06); color: white; }
        .status-safe { border-color: rgba(40,167,69,0.45); }
        .status-moderate { border-color: rgba(255,193,7,0.45); }
        .status-unsafe { border-color: rgba(220,53,69,0.45); }
        .status-top { display: flex; justify-content: space-between; align-items: center; gap: 14px; flex-wrap: wrap; }
        .status-badge { font-weight: 700; border-radius: 999px; padding: 8px 14px; font-size: 0.84rem; }
        .badge-safe { background: rgba(40,167,69,0.2); color: #5ddb8a; }
        .badge-moderate { background: rgba(255,193,7,0.2); color: #ffd24d; }
        .badge-unsafe { background: rgba(220,53,69,0.2); color: #ff9fa9; }
        .status-desc { margin-top: 10px; font-size: 0.84rem; color: rgba(255,255,255,0.75); }
        .status-time { font-size: 0.78rem; color: rgba(255,255,255,0.55); }

        .metrics-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(190px, 1fr)); gap: 14px; margin-bottom: 22px; }
        .metric-card { background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.12); border-radius: 18px; padding: 18px; transition: 0.2s; color: white; }
        .metric-card:hover { transform: translateY(-3px); border-color: rgba(72,202,228,0.35); }
        .metric-icon { color: var(--accent-cyan); margin-bottom: 8px; font-size: 1rem; }
        .metric-label { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1.3px; color: rgba(255,255,255,0.58); margin-bottom: 5px; }
        .metric-value { font-size: 1.18rem; font-weight: 700; line-height: 1.2; }
        .metric-unit { font-size: 0.72rem; color: rgba(72,202,228,0.9); margin-top: 2px; min-height: 14px; }

        .panel { background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.1); border-radius: 22px; padding: 24px; margin-bottom: 22px; }
        .panel-title { font-size: 0.82rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: rgba(255,255,255,0.65); margin-bottom: 14px; display: flex; align-items: center; gap: 8px; }
        .panel-title i { color: var(--accent-cyan); }
        .panel-sub { font-size: 0.78rem; color: rgba(255,255,255,0.48); margin-bottom: 16px; }

        .charts-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 14px; }
        .chart-card { background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.08); border-radius: 16px; padding: 14px; min-height: 210px; }
        .chart-title { font-size: 0.72rem; text-transform: uppercase; letter-spacing: 1.2px; color: rgba(255,255,255,0.75); margin-bottom: 8px; display: flex; align-items: center; gap: 8px; }
        .chart-title i { color: var(--accent-cyan); }
        .chart-wrap { height: 155px; }
        .chart-wrap-lg { height: 320px; }

        .dash-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 14px; margin-bottom: 22px; }
        .dash-card { background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 18px; padding: 18px; color: white; display: flex; flex-direction: column; justify-content: space-between; }
        .dash-card-header { font-size: 0.68rem; text-transform: uppercase; letter-spacing: 1.3px; color: rgba(255,255,255,0.55); margin-bottom: 10px; display: flex; align-items: center; gap: 8px; }
        .dash-card-header i { color: var(--accent-cyan); }
        .dash-stat-row { display: flex; gap: 14px; }
        .dash-stat { flex: 1; }
        .dash-stat-label { font-size: 0.62rem; color: rgba(255,255,255,0.45); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 3px; }
        .dash-stat-value { font-size: 1.05rem; font-weight: 700; }
        .dash-stat-value.min { color: #5ddb8a; }
        .dash-stat-value.max { color: #ff9fa9; }
        .dash-stat-value.avg { color: #ffd24d; }
        .chart-empty { font-size: 0.76rem; color: rgba(255,255,255,0.5); margin-top: 8px; }

        .table-wrap { overflow-x: auto; }
        .history-table { width: 100%; border-collapse: separate; border-spacing: 0 6px; color: white; min-width: 1600px; }
        .history-table th { font-size: 0.64rem; text-transform: uppercase; letter-spacing: 1.3px; color: rgba(255,255,255,0.5); padding: 7px 11px; font-weight: 600; border: none; white-space: nowrap; }
        .history-table td { font-size: 0.76rem; padding: 9px 11px; border: none; white-space: nowrap; background: rgba(255,255,255,0.04); }
        .history-table tr:hover td { background: rgba(255,255,255,0.08); }
        .history-table td:first-child { border-radius: 8px 0 0 8px; }
        .history-table td:last-child { border-radius: 0 8px 8px 0; }
        .text-soft { color: rgba(255,255,255,0.55); }

        .table-paginator { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px; margin-top: 14px; }
        .table-paginator .page-info { font-size: 0.74rem; color: rgba(255,255,255,0.5); }
        .table-paginator .page-size { font-size: 0.74rem; color: rgba(255,255,255,0.6); background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.12); border-radius: 8px; padding: 5px 10px; outline: none; cursor: pointer; }
        .table-paginator .page-btn { font-size: 0.74rem; color: rgba(255,255,255,0.7); background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.12); border-radius: 8px; padding: 5px 12px; cursor: pointer; transition: 0.2s; min-width: 34px; }
        .table-paginator .page-btn:hover:not(:disabled) { background: rgba(72,202,228,0.15); color: var(--accent-cyan); border-color: rgba(72,202,228,0.35); }
        .table-paginator .page-btn:disabled { opacity: 0.35; cursor: not-allowed; }
        .table-paginator .page-btn.active { background: var(--accent-cyan); color: var(--deep-blue); border-color: var(--accent-cyan); font-weight: 700; }
        .table-paginator .page-nav { display: flex; gap: 6px; align-items: center; flex-wrap: wrap; }

        .toggle-wrap { text-align: center; margin: 10px 0 18px; }
        .toggle-btn { display: inline-flex; align-items: center; gap: 8px; font-size: 0.78rem; font-weight: 600; color: var(--accent-cyan); background: rgba(72,202,228,0.1); border: 1px solid rgba(72,202,228,0.3); border-radius: 12px; padding: 8px 18px; cursor: pointer; transition: 0.2s; }
        .toggle-btn:hover { background: rgba(72,202,228,0.2); }
        .toggle-btn i { transition: transform 0.25s; }
        .toggle-btn.open i { transform: rotate(180deg); }
        .detail-section { display: none; }
        .detail-section.open { display: block; animation: fadeIn 0.35s ease; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(-6px); } to { opacity: 1; transform: translateY(0); } }

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
        @keyframes wave-motion { 0% { transform: translateY(0); } 50% { transform: translateY(-3px); } 100% { transform: translateY(0); } }
        .brand-icon i { animation: wave-motion 3s ease-in-out infinite; display: inline-block; }

        @media (max-width: 991.98px) {
            .sidebar { transform: translateX(-100%); transition: transform 0.22s ease; }
            .sidebar.open { transform: translateX(0); }
            .main-content { margin-left: 0; padding: 78px 16px 20px; }
            .sidebar-toggle { display: inline-flex; }
        }
    </style>
</head>
<body>

<button type="button" class="sidebar-toggle" id="sidebarToggle" aria-label="Toggle sidebar">
    <i class="fa-solid fa-bars"></i>
</button>
<div class="sidebar-backdrop" id="sidebarBackdrop"></div>

<aside class="sidebar" id="adminSidebar">
    <div class="sidebar-brand">
        <div class="brand-icon"><i class="fa-solid fa-water"></i></div>
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
            <p class="page-subtitle">Live telemetry from buoy_data with full animated metric trends.</p>
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
        $latestRaw = $latestBuoy ?? ($buoyData ?? []);
        $latest = is_array($latestRaw) ? $latestRaw : [];
        $historyDesc = is_array($buoyHistory ?? null) ? $buoyHistory : [];
        if (empty($latest) && ! empty($historyDesc) && is_array($historyDesc[0])) {
            $latest = $historyDesc[0];
        }
        $historyAsc = array_reverse($historyDesc);
        $hasBuoyData = ! empty($latest);

        $primaryMetrics = [
            'avg_wave_height' => ['label' => 'Avg Wave Height', 'unit' => 'm', 'precision' => 2, 'icon' => 'fa-solid fa-water'],
            'avg_wind_speed' => ['label' => 'Avg Wind Speed', 'unit' => 'kts', 'precision' => 1, 'icon' => 'fa-solid fa-wind'],
            'water_temp_avg' => ['label' => 'Water Temp Avg', 'unit' => '°C', 'precision' => 2, 'icon' => 'fa-solid fa-temperature-half'],
            'pitch_avg' => ['label' => 'Pitch Avg', 'unit' => '°', 'precision' => 2, 'icon' => 'fa-solid fa-chart-line'],
            'roll_avg' => ['label' => 'Roll Avg', 'unit' => '°', 'precision' => 2, 'icon' => 'fa-solid fa-chart-simple'],
            'avg_rssi' => ['label' => 'Average RSSI', 'unit' => 'dBm', 'precision' => 2, 'icon' => 'fa-solid fa-tower-broadcast'],
        ];

        $detailMetrics = [
            'pitch_min' => ['label' => 'Pitch Min', 'unit' => '°', 'precision' => 2, 'icon' => 'fa-solid fa-arrow-down'],
            'pitch_max' => ['label' => 'Pitch Max', 'unit' => '°', 'precision' => 2, 'icon' => 'fa-solid fa-arrow-up'],
            'roll_min' => ['label' => 'Roll Min', 'unit' => '°', 'precision' => 2, 'icon' => 'fa-solid fa-arrow-down'],
            'roll_max' => ['label' => 'Roll Max', 'unit' => '°', 'precision' => 2, 'icon' => 'fa-solid fa-arrow-up'],
            'water_temp_min' => ['label' => 'Water Temp Min', 'unit' => '°C', 'precision' => 2, 'icon' => 'fa-solid fa-temperature-empty'],
            'water_temp_max' => ['label' => 'Water Temp Max', 'unit' => '°C', 'precision' => 2, 'icon' => 'fa-solid fa-temperature-full'],
            'water_temp_valid_samples' => ['label' => 'Temp Valid Samples', 'unit' => 'count', 'precision' => 0, 'icon' => 'fa-solid fa-vial'],
            'max_wind_speed' => ['label' => 'Max Wind Speed', 'unit' => 'kts', 'precision' => 1, 'icon' => 'fa-solid fa-wind'],
            'sample_count' => ['label' => 'Sample Count', 'unit' => 'count', 'precision' => 0, 'icon' => 'fa-solid fa-list-ol'],
            'expected_samples' => ['label' => 'Expected Samples', 'unit' => 'count', 'precision' => 0, 'icon' => 'fa-solid fa-check-double'],
            'packet_loss_pct' => ['label' => 'Packet Loss', 'unit' => '%', 'precision' => 2, 'icon' => 'fa-solid fa-triangle-exclamation'],
            'hall_detections' => ['label' => 'Hall Detections', 'unit' => 'count', 'precision' => 0, 'icon' => 'fa-solid fa-magnet'],
            'window_duration_ms' => ['label' => 'Window Duration', 'unit' => 'ms', 'precision' => 0, 'icon' => 'fa-solid fa-stopwatch'],
            'first_packet_id' => ['label' => 'First Packet ID', 'unit' => '', 'precision' => 0, 'icon' => 'fa-solid fa-inbox'],
            'last_packet_id' => ['label' => 'Last Packet ID', 'unit' => '', 'precision' => 0, 'icon' => 'fa-solid fa-inbox'],
        ];

        $metricConfig = $primaryMetrics + $detailMetrics;

        $formatMetric = static function ($value, int $precision = 2): string {
            if ($value === null || $value === '') {
                return 'N/A';
            }
            return number_format((float) $value, $precision);
        };

        $status = 'safe';
        $statusBadge = 'SAFE FOR ACTIVITIES';
        $statusDesc = 'Wave and wind indicators are within normal operating range.';
        $statusClass = 'status-safe';
        $badgeClass = 'badge-safe';
        $waveHeight = (float) ($latest['avg_wave_height'] ?? 0.0);
        $windSpeed = (float) ($latest['avg_wind_speed'] ?? 0.0);
        if ($waveHeight > 1.2 || $windSpeed > 20.0) {
            $status = 'unsafe';
            $statusBadge = 'UNSAFE CONDITIONS';
            $statusDesc = 'Buoy thresholds exceeded (wave > 1.2m or wind > 20kts).';
            $statusClass = 'status-unsafe';
            $badgeClass = 'badge-unsafe';
        } elseif ($waveHeight >= 0.7 || $windSpeed >= 12.0) {
            $status = 'moderate';
            $statusBadge = 'MODERATE CONDITIONS';
            $statusDesc = 'Conditions are acceptable with caution and close monitoring.';
            $statusClass = 'status-moderate';
            $badgeClass = 'badge-moderate';
        }

        $recordedAt = $latest['recorded_at'] ?? $latest['created_at'] ?? null;
        $recordedDisplay = $recordedAt ? date('M d, Y h:i A', strtotime($recordedAt)) : 'No buoy data yet';

        // 24h summary stats helper
        $summaryFields = ['avg_wave_height','avg_wind_speed','water_temp_avg'];
        $summaryStats = [];
        foreach ($summaryFields as $sf) {
            $vals = [];
            foreach ($historyDesc as $hrow) {
                $v = $hrow[$sf] ?? null;
                if ($v !== null && $v !== '') $vals[] = (float) $v;
            }
            if (count($vals)) {
                $summaryStats[$sf] = [
                    'min' => min($vals),
                    'max' => max($vals),
                    'avg' => array_sum($vals) / count($vals),
                ];
            } else {
                $summaryStats[$sf] = ['min' => null, 'max' => null, 'avg' => null];
            }
        }

        $trendLabels = [];
        $trendSeries = [];
        foreach ($metricConfig as $field => $meta) {
            $trendSeries[$field] = [];
        }
        foreach ($historyAsc as $row) {
            $timeKey = $row['recorded_at'] ?? $row['created_at'] ?? null;
            $trendLabels[] = $timeKey ? date('M d H:i', strtotime($timeKey)) : '—';
            foreach ($metricConfig as $field => $meta) {
                $raw = $row[$field] ?? null;
                $trendSeries[$field][] = ($raw === null || $raw === '') ? null : (float) $raw;
            }
        }
    ?>

    <?php if (! $hasBuoyData): ?>
        <div class="alert alert-info rounded-4">No buoy data available yet.</div>
    <?php else: ?>
        <div class="status-box <?= esc($statusClass) ?>">
            <div class="status-top">
                <div class="status-badge <?= esc($badgeClass) ?>">
                    <i class="fa-solid fa-circle me-2" style="font-size:0.5rem;vertical-align:middle;"></i><?= esc($statusBadge) ?>
                </div>
                <div class="status-time">Last buoy packet: <?= esc($recordedDisplay) ?></div>
            </div>
            <div class="status-desc"><?= esc($statusDesc) ?></div>
        </div>

        <div class="metrics-grid" id="primaryMetrics">
            <?php foreach ($primaryMetrics as $field => $meta): ?>
                <?php
                    $display = $formatMetric($latest[$field] ?? null, (int) $meta['precision']);
                    $unitText = $meta['unit'];
                ?>
                <div class="metric-card">
                    <div class="metric-icon"><i class="<?= esc($meta['icon']) ?>"></i></div>
                    <div class="metric-label"><?= esc($meta['label']) ?></div>
                    <div class="metric-value"><?= esc($display) ?></div>
                    <div class="metric-unit"><?= esc($unitText) ?></div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="toggle-wrap">
            <button type="button" class="toggle-btn" id="detailToggle" onclick="document.getElementById('detailMetrics').classList.toggle('open');this.classList.toggle('open');">
                <i class="fa-solid fa-chevron-down"></i>
                <span>Show Detailed Metrics</span>
            </button>
        </div>

        <div class="detail-section" id="detailMetrics">
            <div class="metrics-grid">
                <?php foreach ($detailMetrics as $field => $meta): ?>
                    <?php
                        $display = $formatMetric($latest[$field] ?? null, (int) $meta['precision']);
                        $unitText = $meta['unit'];
                    ?>
                    <div class="metric-card">
                        <div class="metric-icon"><i class="<?= esc($meta['icon']) ?>"></i></div>
                        <div class="metric-label"><?= esc($meta['label']) ?></div>
                        <div class="metric-value"><?= esc($display) ?></div>
                        <div class="metric-unit"><?= esc($unitText) ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="dash-grid">
            <div class="dash-card">
                <div class="dash-card-header"><i class="fa-solid fa-water"></i> Wave Height (24h)</div>
                <div class="dash-stat-row">
                    <div class="dash-stat">
                        <div class="dash-stat-label">Min</div>
                        <div class="dash-stat-value min"><?= $summaryStats['avg_wave_height']['min'] !== null ? number_format($summaryStats['avg_wave_height']['min'], 2) . ' m' : 'N/A' ?></div>
                    </div>
                    <div class="dash-stat">
                        <div class="dash-stat-label">Max</div>
                        <div class="dash-stat-value max"><?= $summaryStats['avg_wave_height']['max'] !== null ? number_format($summaryStats['avg_wave_height']['max'], 2) . ' m' : 'N/A' ?></div>
                    </div>
                    <div class="dash-stat">
                        <div class="dash-stat-label">Avg</div>
                        <div class="dash-stat-value avg"><?= $summaryStats['avg_wave_height']['avg'] !== null ? number_format($summaryStats['avg_wave_height']['avg'], 2) . ' m' : 'N/A' ?></div>
                    </div>
                </div>
            </div>
            <div class="dash-card">
                <div class="dash-card-header"><i class="fa-solid fa-wind"></i> Wind Speed (24h)</div>
                <div class="dash-stat-row">
                    <div class="dash-stat">
                        <div class="dash-stat-label">Min</div>
                        <div class="dash-stat-value min"><?= $summaryStats['avg_wind_speed']['min'] !== null ? number_format($summaryStats['avg_wind_speed']['min'], 1) . ' kts' : 'N/A' ?></div>
                    </div>
                    <div class="dash-stat">
                        <div class="dash-stat-label">Max</div>
                        <div class="dash-stat-value max"><?= $summaryStats['avg_wind_speed']['max'] !== null ? number_format($summaryStats['avg_wind_speed']['max'], 1) . ' kts' : 'N/A' ?></div>
                    </div>
                    <div class="dash-stat">
                        <div class="dash-stat-label">Avg</div>
                        <div class="dash-stat-value avg"><?= $summaryStats['avg_wind_speed']['avg'] !== null ? number_format($summaryStats['avg_wind_speed']['avg'], 1) . ' kts' : 'N/A' ?></div>
                    </div>
                </div>
            </div>
            <div class="dash-card">
                <div class="dash-card-header"><i class="fa-solid fa-temperature-half"></i> Water Temp (24h)</div>
                <div class="dash-stat-row">
                    <div class="dash-stat">
                        <div class="dash-stat-label">Min</div>
                        <div class="dash-stat-value min"><?= $summaryStats['water_temp_avg']['min'] !== null ? number_format($summaryStats['water_temp_avg']['min'], 2) . ' °C' : 'N/A' ?></div>
                    </div>
                    <div class="dash-stat">
                        <div class="dash-stat-label">Max</div>
                        <div class="dash-stat-value max"><?= $summaryStats['water_temp_avg']['max'] !== null ? number_format($summaryStats['water_temp_avg']['max'], 2) . ' °C' : 'N/A' ?></div>
                    </div>
                    <div class="dash-stat">
                        <div class="dash-stat-label">Avg</div>
                        <div class="dash-stat-value avg"><?= $summaryStats['water_temp_avg']['avg'] !== null ? number_format($summaryStats['water_temp_avg']['avg'], 2) . ' °C' : 'N/A' ?></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel">
            <div class="panel-title"><i class="fa-solid fa-chart-line"></i> Critical Conditions Overview</div>
            <p class="panel-sub">Wave height, wind speed, and water temperature trends combined.</p>
            <div class="chart-wrap-lg">
                <canvas id="chart_overview"></canvas>
            </div>
        </div>

        <div class="panel">
            <div class="panel-title"><i class="fa-solid fa-server"></i> System Health & Connectivity</div>
            <p class="panel-sub">Packet loss percentage and average RSSI per transmission window.</p>
            <div class="charts-grid">
                <div class="chart-card">
                    <div class="chart-title"><i class="fa-solid fa-triangle-exclamation"></i> Packet Loss %</div>
                    <div class="chart-wrap">
                        <canvas id="chart_packet_loss"></canvas>
                    </div>
                </div>
                <div class="chart-card">
                    <div class="chart-title"><i class="fa-solid fa-tower-broadcast"></i> Average RSSI (dBm)</div>
                    <div class="chart-wrap">
                        <canvas id="chart_rssi"></canvas>
                    </div>
                </div>
                <div class="chart-card">
                    <div class="chart-title"><i class="fa-solid fa-arrows-up-down"></i> Pitch vs Roll Average</div>
                    <div class="chart-wrap">
                        <canvas id="chart_motion"></canvas>
                    </div>
                </div>
                <div class="chart-card">
                    <div class="chart-title"><i class="fa-solid fa-database"></i> Sample Count vs Expected</div>
                    <div class="chart-wrap">
                        <canvas id="chart_samples"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel">
            <div class="panel-title"><i class="fa-solid fa-chart-area"></i> Animated Buoy Metric Graphs</div>
            <p class="panel-sub">Each buoy_data metric is plotted from the most recent packets.</p>
            <div class="charts-grid">
                <?php foreach ($primaryMetrics as $field => $meta): ?>
                    <div class="chart-card">
                        <div class="chart-title"><i class="<?= esc($meta['icon']) ?>"></i> <?= esc($meta['label']) ?></div>
                        <div class="chart-wrap">
                            <canvas id="chart_<?= esc($field) ?>"></canvas>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="toggle-wrap">
                <button type="button" class="toggle-btn" id="chartToggle" onclick="document.getElementById('detailCharts').classList.toggle('open');this.classList.toggle('open');">
                    <i class="fa-solid fa-chevron-down"></i>
                    <span>Show Detailed Metric Graphs</span>
                </button>
            </div>
            <div class="detail-section" id="detailCharts">
                <div class="charts-grid">
                    <?php foreach ($detailMetrics as $field => $meta): ?>
                        <div class="chart-card">
                            <div class="chart-title"><i class="<?= esc($meta['icon']) ?>"></i> <?= esc($meta['label']) ?></div>
                            <div class="chart-wrap">
                                <canvas id="chart_<?= esc($field) ?>"></canvas>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="panel">
            <div class="panel-title"><i class="fa-solid fa-table"></i> Raw Buoy Data Log (Latest 40)</div>
            <?php if (! empty($historyDesc)): ?>
                <div class="table-wrap" id="buoyTableWrap">
                    <table class="history-table" id="buoyTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Timestamp</th>
                                <?php foreach ($metricConfig as $meta): ?>
                                    <th><?= esc($meta['label']) ?></th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($historyDesc as $row): ?>
                                <?php $rowTime = $row['recorded_at'] ?? $row['created_at'] ?? null; ?>
                                <tr>
                                    <td class="text-soft"><?= esc($row['id'] ?? '—') ?></td>
                                    <td class="text-soft"><?= $rowTime ? esc(date('M d, Y h:i A', strtotime($rowTime))) : '—' ?></td>
                                    <?php foreach ($metricConfig as $field => $meta): ?>
                                        <?php
                                            $value = $formatMetric($row[$field] ?? null, (int) $meta['precision']);
                                            $cell = $value === 'N/A' ? 'N/A' : trim($value . ' ' . $meta['unit']);
                                        ?>
                                        <td><?= esc($cell) ?></td>
                                    <?php endforeach; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="table-paginator" id="buoyPaginator">
                    <div style="display:flex;align-items:center;gap:10px;">
                        <span class="page-info" id="buoyPageInfo"></span>
                        <select class="page-size" id="buoyPageSize">
                            <option value="5">5 / page</option>
                            <option value="10" selected>10 / page</option>
                            <option value="20">20 / page</option>
                            <option value="50">50 / page</option>
                        </select>
                    </div>
                    <div class="page-nav" id="buoyPageNav"></div>
                </div>
            <?php else: ?>
                <p class="text-soft mb-0">No buoy history available yet.</p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
(function () {
    const table = document.getElementById('buoyTable');
    if (!table) return;
    const tbody = table.querySelector('tbody');
    const allRows = Array.from(tbody.querySelectorAll('tr'));
    const pageInfo = document.getElementById('buoyPageInfo');
    const pageNav = document.getElementById('buoyPageNav');
    const pageSizeSelect = document.getElementById('buoyPageSize');
    if (!allRows.length) return;

    let currentPage = 1;
    let pageSize = parseInt(pageSizeSelect?.value || '10', 10);

    function renderPage() {
        const total = allRows.length;
        const totalPages = Math.max(1, Math.ceil(total / pageSize));
        currentPage = Math.min(currentPage, totalPages);
        const start = (currentPage - 1) * pageSize;
        const end = Math.min(start + pageSize, total);

        allRows.forEach((row, i) => {
            row.style.display = (i >= start && i < end) ? '' : 'none';
        });

        if (pageInfo) {
            pageInfo.textContent = `Showing ${start + 1}–${end} of ${total} entries`;
        }

        if (pageNav) {
            const maxButtons = 5;
            let startPage = Math.max(1, currentPage - Math.floor(maxButtons / 2));
            let endPage = startPage + maxButtons - 1;
            if (endPage > totalPages) {
                endPage = totalPages;
                startPage = Math.max(1, endPage - maxButtons + 1);
            }

            let html = '';
            html += `<button type="button" class="page-btn" data-page="prev" ${currentPage === 1 ? 'disabled' : ''}>Prev</button>`;
            for (let p = startPage; p <= endPage; p++) {
                html += `<button type="button" class="page-btn${p === currentPage ? ' active' : ''}" data-page="${p}">${p}</button>`;
            }
            html += `<button type="button" class="page-btn" data-page="next" ${currentPage === totalPages ? 'disabled' : ''}>Next</button>`;
            pageNav.innerHTML = html;

            pageNav.querySelectorAll('button[data-page]').forEach((btn) => {
                btn.addEventListener('click', () => {
                    const action = btn.getAttribute('data-page');
                    if (action === 'prev') {
                        if (currentPage > 1) currentPage--;
                    } else if (action === 'next') {
                        if (currentPage < totalPages) currentPage++;
                    } else {
                        currentPage = parseInt(action, 10);
                    }
                    renderPage();
                });
            });
        }
    }

    if (pageSizeSelect) {
        pageSizeSelect.addEventListener('change', () => {
            pageSize = parseInt(pageSizeSelect.value, 10);
            currentPage = 1;
            renderPage();
        });
    }

    renderPage();
})();

const adminSidebar = document.getElementById('adminSidebar');
const sidebarToggleBtn = document.getElementById('sidebarToggle');
const sidebarBackdrop = document.getElementById('sidebarBackdrop');

function setSidebarOpen(nextOpen) {
    if (!adminSidebar || !sidebarBackdrop) return;
    adminSidebar.classList.toggle('open', nextOpen);
    sidebarBackdrop.classList.toggle('open', nextOpen);
}

if (sidebarToggleBtn) {
    sidebarToggleBtn.addEventListener('click', () => {
        const isOpen = adminSidebar.classList.contains('open');
        setSidebarOpen(!isOpen);
    });
}

if (sidebarBackdrop) {
    sidebarBackdrop.addEventListener('click', () => setSidebarOpen(false));
}

document.querySelectorAll('#adminSidebar .nav-item').forEach((item) => {
    item.addEventListener('click', () => {
        if (window.innerWidth <= 991) {
            setSidebarOpen(false);
        }
    });
});

window.addEventListener('resize', () => {
    if (window.innerWidth > 991) {
        setSidebarOpen(false);
    }
});

const trendLabels = <?= json_encode($trendLabels ?? []) ?>;
const trendSeries = <?= json_encode($trendSeries ?? []) ?>;
const metricMeta = <?= json_encode($metricConfig ?? []) ?>;
const palette = [
    { line: 'rgba(72,202,228,1)', fill: 'rgba(72,202,228,0.2)' },
    { line: 'rgba(255,193,7,1)', fill: 'rgba(255,193,7,0.2)' },
    { line: 'rgba(93,219,138,1)', fill: 'rgba(93,219,138,0.2)' },
    { line: 'rgba(255,107,107,1)', fill: 'rgba(255,107,107,0.2)' },
    { line: 'rgba(155,89,182,1)', fill: 'rgba(155,89,182,0.2)' },
    { line: 'rgba(86,204,242,1)', fill: 'rgba(86,204,242,0.2)' }
];

Object.entries(trendSeries).forEach(([field, values], index) => {
    const canvas = document.getElementById(`chart_${field}`);
    if (!canvas) return;

    const hasData = Array.isArray(values) && values.some((v) => v !== null && !Number.isNaN(v));
    if (!hasData || trendLabels.length === 0) {
        const empty = document.createElement('div');
        empty.className = 'chart-empty';
        empty.textContent = 'No trend data yet.';
        canvas.parentElement.appendChild(empty);
        return;
    }

    const ctx = canvas.getContext('2d');
    const color = palette[index % palette.length];
    const meta = metricMeta[field] || { label: field, unit: '', precision: 2 };

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: trendLabels,
            datasets: [{
                label: meta.label,
                data: values,
                borderColor: color.line,
                backgroundColor: color.fill,
                borderWidth: 2,
                fill: true,
                tension: 0.35,
                pointRadius: 0,
                pointHoverRadius: 3,
            }],
        },
        options: {
            maintainAspectRatio: false,
            animation: {
                duration: 1300,
                easing: 'easeOutQuart',
            },
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label(context) {
                            const value = context.parsed.y;
                            if (value === null) return `${meta.label}: N/A`;
                            const precision = Number.isInteger(meta.precision) ? meta.precision : 2;
                            const formatted = Number(value).toFixed(precision);
                            const unit = meta.unit ? ` ${meta.unit}` : '';
                            return `${meta.label}: ${formatted}${unit}`;
                        },
                    },
                },
            },
            scales: {
                x: {
                    ticks: { color: 'rgba(255,255,255,0.48)', maxTicksLimit: 6 },
                    grid: { color: 'rgba(255,255,255,0.05)' },
                },
                y: {
                    ticks: { color: 'rgba(255,255,255,0.48)' },
                    grid: { color: 'rgba(255,255,255,0.06)' },
                },
            },
        },
    });
});

/* ══════════════ DASHBOARD OVERVIEW CHARTS ══════════════ */

function initChart(canvasId, type, datasetConfig, options = {}) {
    const canvas = document.getElementById(canvasId);
    if (!canvas) return null;
    const hasAny = datasetConfig.datasets.some((ds) => Array.isArray(ds.data) && ds.data.some((v) => v !== null && !Number.isNaN(v)));
    if (!hasAny || trendLabels.length === 0) {
        const empty = document.createElement('div');
        empty.className = 'chart-empty';
        empty.textContent = 'No trend data yet.';
        canvas.parentElement.appendChild(empty);
        return null;
    }
    const ctx = canvas.getContext('2d');
    return new Chart(ctx, {
        type: type,
        data: { labels: trendLabels, datasets: datasetConfig.datasets },
        options: {
            maintainAspectRatio: false,
            animation: { duration: 1300, easing: 'easeOutQuart' },
            plugins: {
                legend: { labels: { color: 'rgba(255,255,255,0.75)', font: { size: 11 } } },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                    callbacks: {
                        label(context) {
                            const value = context.parsed.y;
                            if (value === null) return `${context.dataset.label}: N/A`;
                            const formatted = Number(value).toFixed(context.dataset.precision || 2);
                            const unit = context.dataset.unit || '';
                            return `${context.dataset.label}: ${formatted}${unit}`;
                        },
                    },
                },
            },
            scales: {
                x: { ticks: { color: 'rgba(255,255,255,0.48)', maxTicksLimit: 8 }, grid: { color: 'rgba(255,255,255,0.05)' } },
                y: { ticks: { color: 'rgba(255,255,255,0.48)' }, grid: { color: 'rgba(255,255,255,0.06)' } },
            },
            ...options,
        },
    });
}

initChart('chart_overview', 'line', {
    datasets: [
        { label: 'Wave Height', data: trendSeries['avg_wave_height'] || [], borderColor: 'rgba(72,202,228,1)', backgroundColor: 'rgba(72,202,228,0.08)', borderWidth: 2, fill: true, tension: 0.35, pointRadius: 0, pointHoverRadius: 4, unit: ' m', precision: 2, yAxisID: 'y' },
        { label: 'Wind Speed', data: trendSeries['avg_wind_speed'] || [], borderColor: 'rgba(255,193,7,1)', backgroundColor: 'rgba(255,193,7,0.08)', borderWidth: 2, fill: true, tension: 0.35, pointRadius: 0, pointHoverRadius: 4, unit: ' kts', precision: 1, yAxisID: 'y' },
        { label: 'Water Temp', data: trendSeries['water_temp_avg'] || [], borderColor: 'rgba(93,219,138,1)', backgroundColor: 'rgba(93,219,138,0.08)', borderWidth: 2, fill: true, tension: 0.35, pointRadius: 0, pointHoverRadius: 4, unit: ' °C', precision: 2, yAxisID: 'y1' },
    ],
}, {
    scales: {
        x: { ticks: { color: 'rgba(255,255,255,0.48)', maxTicksLimit: 8 }, grid: { color: 'rgba(255,255,255,0.05)' } },
        y: { type: 'linear', display: true, position: 'left', ticks: { color: 'rgba(255,255,255,0.48)' }, grid: { color: 'rgba(255,255,255,0.06)' }, title: { display: true, text: 'Height (m) / Wind (kts)', color: 'rgba(255,255,255,0.5)', font: { size: 10 } } },
        y1: { type: 'linear', display: true, position: 'right', ticks: { color: 'rgba(93,219,138,0.9)' }, grid: { drawOnChartArea: false }, title: { display: true, text: 'Temp (°C)', color: 'rgba(93,219,138,0.9)', font: { size: 10 } } },
    },
});

initChart('chart_packet_loss', 'bar', {
    datasets: [
        { label: 'Packet Loss %', data: trendSeries['packet_loss_pct'] || [], borderColor: 'rgba(255,107,107,1)', backgroundColor: 'rgba(255,107,107,0.35)', borderWidth: 1, borderRadius: 4, unit: '%', precision: 2 },
    ],
}, {
    plugins: { legend: { display: false } },
});

initChart('chart_rssi', 'line', {
    datasets: [
        { label: 'Avg RSSI', data: trendSeries['avg_rssi'] || [], borderColor: 'rgba(155,89,182,1)', backgroundColor: 'rgba(155,89,182,0.1)', borderWidth: 2, fill: true, tension: 0.35, pointRadius: 0, pointHoverRadius: 4, unit: ' dBm', precision: 2 },
    ],
}, {
    plugins: { legend: { display: false } },
});

initChart('chart_motion', 'line', {
    datasets: [
        { label: 'Pitch Avg', data: trendSeries['pitch_avg'] || [], borderColor: 'rgba(72,202,228,1)', backgroundColor: 'rgba(72,202,228,0.08)', borderWidth: 2, fill: false, tension: 0.35, pointRadius: 0, pointHoverRadius: 4, unit: '°', precision: 2 },
        { label: 'Roll Avg', data: trendSeries['roll_avg'] || [], borderColor: 'rgba(255,193,7,1)', backgroundColor: 'rgba(255,193,7,0.08)', borderWidth: 2, fill: false, tension: 0.35, pointRadius: 0, pointHoverRadius: 4, unit: '°', precision: 2 },
    ],
});

initChart('chart_samples', 'bar', {
    datasets: [
        { label: 'Sample Count', data: trendSeries['sample_count'] || [], borderColor: 'rgba(72,202,228,1)', backgroundColor: 'rgba(72,202,228,0.35)', borderWidth: 1, borderRadius: 4, unit: '', precision: 0 },
        { label: 'Expected', data: trendSeries['expected_samples'] || [], borderColor: 'rgba(255,255,255,0.5)', backgroundColor: 'rgba(255,255,255,0.15)', borderWidth: 1, borderRadius: 4, unit: '', precision: 0 },
    ],
}, {
    plugins: { legend: { labels: { color: 'rgba(255,255,255,0.75)', font: { size: 11 } } } },
});
</script>

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
                    <div class="help-item-desc">Review every sensor value from buoy_data and monitor animated historical trends from live telemetry.</div>
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
            <strong>💡 Tip:</strong> Keep this panel open during operations to watch each buoy metric trend before approving activity schedules.
        </div>
    </div>
</div>
</body>
</html>
