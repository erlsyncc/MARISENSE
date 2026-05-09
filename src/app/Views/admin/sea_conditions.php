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
        .chart-empty { font-size: 0.76rem; color: rgba(255,255,255,0.5); margin-top: 8px; }

        .table-wrap { overflow-x: auto; }
        .history-table { width: 100%; border-collapse: separate; border-spacing: 0 6px; color: white; min-width: 1600px; }
        .history-table th { font-size: 0.64rem; text-transform: uppercase; letter-spacing: 1.3px; color: rgba(255,255,255,0.5); padding: 7px 11px; font-weight: 600; border: none; white-space: nowrap; }
        .history-table td { font-size: 0.76rem; padding: 9px 11px; border: none; white-space: nowrap; background: rgba(255,255,255,0.04); }
        .history-table tr:hover td { background: rgba(255,255,255,0.08); }
        .history-table td:first-child { border-radius: 8px 0 0 8px; }
        .history-table td:last-child { border-radius: 0 8px 8px 0; }
        .text-soft { color: rgba(255,255,255,0.55); }

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
    </style>
</head>
<body>

<aside class="sidebar">
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
        $latest = $latestBuoy ?? [];
        $historyDesc = $buoyHistory ?? [];
        $historyAsc = array_reverse($historyDesc);
        $hasBuoyData = ! empty($latest);

        $metricConfig = [
            'pitch_avg' => ['label' => 'Pitch Avg', 'unit' => '°', 'precision' => 2, 'icon' => 'fa-solid fa-chart-line'],
            'pitch_min' => ['label' => 'Pitch Min', 'unit' => '°', 'precision' => 2, 'icon' => 'fa-solid fa-arrow-down'],
            'pitch_max' => ['label' => 'Pitch Max', 'unit' => '°', 'precision' => 2, 'icon' => 'fa-solid fa-arrow-up'],
            'roll_avg' => ['label' => 'Roll Avg', 'unit' => '°', 'precision' => 2, 'icon' => 'fa-solid fa-chart-simple'],
            'roll_min' => ['label' => 'Roll Min', 'unit' => '°', 'precision' => 2, 'icon' => 'fa-solid fa-arrow-down'],
            'roll_max' => ['label' => 'Roll Max', 'unit' => '°', 'precision' => 2, 'icon' => 'fa-solid fa-arrow-up'],
            'water_temp_avg' => ['label' => 'Water Temp Avg', 'unit' => '°C', 'precision' => 2, 'icon' => 'fa-solid fa-temperature-half'],
            'water_temp_min' => ['label' => 'Water Temp Min', 'unit' => '°C', 'precision' => 2, 'icon' => 'fa-solid fa-temperature-empty'],
            'water_temp_max' => ['label' => 'Water Temp Max', 'unit' => '°C', 'precision' => 2, 'icon' => 'fa-solid fa-temperature-full'],
            'water_temp_valid_samples' => ['label' => 'Temp Valid Samples', 'unit' => 'count', 'precision' => 0, 'icon' => 'fa-solid fa-vial'],
            'avg_wave_height' => ['label' => 'Avg Wave Height', 'unit' => 'm', 'precision' => 2, 'icon' => 'fa-solid fa-water'],
            'avg_wind_speed' => ['label' => 'Avg Wind Speed', 'unit' => 'kts', 'precision' => 1, 'icon' => 'fa-solid fa-wind'],
            'max_wind_speed' => ['label' => 'Max Wind Speed', 'unit' => 'kts', 'precision' => 1, 'icon' => 'fa-solid fa-wind'],
            'sample_count' => ['label' => 'Sample Count', 'unit' => 'count', 'precision' => 0, 'icon' => 'fa-solid fa-list-ol'],
            'expected_samples' => ['label' => 'Expected Samples', 'unit' => 'count', 'precision' => 0, 'icon' => 'fa-solid fa-check-double'],
            'packet_loss_pct' => ['label' => 'Packet Loss', 'unit' => '%', 'precision' => 2, 'icon' => 'fa-solid fa-triangle-exclamation'],
            'hall_detections' => ['label' => 'Hall Detections', 'unit' => 'count', 'precision' => 0, 'icon' => 'fa-solid fa-magnet'],
            'avg_rssi' => ['label' => 'Average RSSI', 'unit' => 'dBm', 'precision' => 2, 'icon' => 'fa-solid fa-tower-broadcast'],
            'window_duration_ms' => ['label' => 'Window Duration', 'unit' => 'ms', 'precision' => 0, 'icon' => 'fa-solid fa-stopwatch'],
            'first_packet_id' => ['label' => 'First Packet ID', 'unit' => '', 'precision' => 0, 'icon' => 'fa-solid fa-inbox'],
            'last_packet_id' => ['label' => 'Last Packet ID', 'unit' => '', 'precision' => 0, 'icon' => 'fa-solid fa-inbox'],
        ];

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

        <div class="metrics-grid">
            <?php foreach ($metricConfig as $field => $meta): ?>
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

        <div class="panel">
            <div class="panel-title"><i class="fa-solid fa-chart-area"></i> Animated Buoy Metric Graphs</div>
            <p class="panel-sub">Each buoy_data metric is plotted from the most recent packets.</p>
            <div class="charts-grid">
                <?php foreach ($metricConfig as $field => $meta): ?>
                    <div class="chart-card">
                        <div class="chart-title"><i class="<?= esc($meta['icon']) ?>"></i> <?= esc($meta['label']) ?></div>
                        <div class="chart-wrap">
                            <canvas id="chart_<?= esc($field) ?>"></canvas>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="panel">
            <div class="panel-title"><i class="fa-solid fa-table"></i> Raw Buoy Data Log (Latest 40)</div>
            <?php if (! empty($historyDesc)): ?>
                <div class="table-wrap">
                    <table class="history-table">
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
            <?php else: ?>
                <p class="text-soft mb-0">No buoy history available yet.</p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
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
