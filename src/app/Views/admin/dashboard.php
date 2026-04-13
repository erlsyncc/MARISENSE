<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Waves Admin</title>
    <link rel="stylesheet" href="<?= base_url('bootstrap5/css/bootstrap.min.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <style>
        :root { --deep-blue: #052c39; --ocean-blue: #0a5872; --accent-cyan: #48cae4; --soft-white: #f4f9fc; --sidebar-width: 260px; }
        * { box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background: linear-gradient(180deg, var(--ocean-blue) 0%, var(--deep-blue) 60%); background-attachment: fixed; color: var(--soft-white); margin: 0; min-height: 100vh; }
        /* SIDEBAR — same as dashboard */
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
        .nav-item .badge-count { margin-left: auto; background: rgba(255,193,7,0.2); color: #ffc107; border: 1px solid rgba(255,193,7,0.4); border-radius: 20px; padding: 1px 8px; font-size: 0.7rem; font-weight: 700; }
        .nav-item.active .badge-count { background: rgba(5,44,57,0.3); color: var(--deep-blue); border-color: rgba(5,44,57,0.4); }
        .sidebar-footer { margin-top: auto; padding: 16px 12px; border-top: 1px solid rgba(255,255,255,0.08); }
        .logout-btn { display: flex; align-items: center; gap: 12px; padding: 11px 20px; border-radius: 12px; color: #ff6b6b; text-decoration: none; font-size: 0.88rem; font-weight: 600; border: 1px solid rgba(255,107,107,0.25); transition: 0.25s; }
        .logout-btn:hover { background: #ff6b6b; color: white; text-decoration: none; }

        .main-content { margin-left: var(--sidebar-width); padding: 32px 36px; min-height: 100vh; }
        .page-topbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 28px; }
        .page-title { font-size: 1.6rem; font-weight: 700; color: white; margin: 0; }
        .page-subtitle { font-size: 0.82rem; color: rgba(255,255,255,0.5); margin: 2px 0 0; }
        .admin-pill { background: rgba(72,202,228,0.12); border: 1px solid rgba(72,202,228,0.3); color: var(--accent-cyan); border-radius: 50px; padding: 6px 18px; font-size: 0.78rem; font-weight: 600; letter-spacing: 1px; }
        /* KPI cards */
        .kpi-row { display: grid; grid-template-columns: repeat(4,1fr); gap: 14px; margin-bottom: 24px; }
        .kpi-card { background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.1); border-radius: 20px; padding: 22px; display: flex; align-items: center; gap: 16px; transition: 0.25s; }
        .kpi-card:hover { background: rgba(255,255,255,0.1); transform: translateY(-2px); }
        .kpi-icon { width: 48px; height: 48px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; flex-shrink: 0; }
        .kpi-icon.cyan   { background: rgba(72,202,228,0.15); color: var(--accent-cyan); }
        .kpi-icon.yellow { background: rgba(255,193,7,0.15); color: #ffc107; }
        .kpi-icon.green  { background: rgba(40,167,69,0.15); color: #5ddb8a; }
        .kpi-icon.blue   { background: rgba(13,110,253,0.15); color: #74b4ff; }
        .kpi-value { font-size: 1.6rem; font-weight: 700; color: white; line-height: 1; }
        .kpi-label { font-size: 0.72rem; text-transform: uppercase; letter-spacing: 1px; color: rgba(255,255,255,0.48); margin-top: 3px; }
        /* Charts row */
        .charts-row { display: grid; grid-template-columns: 1fr 1.8fr; gap: 18px; margin-bottom: 24px; }
        .chart-card { background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.1); border-radius: 20px; padding: 24px; }
        .chart-title { font-size: 0.82rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.2px; color: rgba(255,255,255,0.55); margin-bottom: 6px; display: flex; align-items: center; gap: 8px; }
        .chart-title i { color: var(--accent-cyan); }
        .sales-tabs { display: flex; gap: 6px; margin-bottom: 14px; }
        .sales-tab { background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); color: rgba(255,255,255,0.6); padding: 5px 14px; border-radius: 50px; font-size: 0.75rem; font-weight: 600; cursor: pointer; transition: 0.2s; }
        .sales-tab.active, .sales-tab:hover { background: var(--accent-cyan); color: var(--deep-blue); border-color: var(--accent-cyan); }
        /* Recent bookings table */
        .recent-card { background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.1); border-radius: 20px; padding: 24px; margin-bottom: 24px; }
        .section-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px; }
        .section-title { font-size: 0.82rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.2px; color: rgba(255,255,255,0.55); }
        .btn-view-all { background: rgba(72,202,228,0.1); border: 1px solid rgba(72,202,228,0.3); color: var(--accent-cyan); padding: 5px 14px; border-radius: 50px; font-size: 0.75rem; font-weight: 600; text-decoration: none; transition: 0.2s; }
        .btn-view-all:hover { background: var(--accent-cyan); color: var(--deep-blue); }
        .recent-table { width: 100%; color: white; border-collapse: collapse; }
        .recent-table thead th { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1px; color: rgba(255,255,255,0.4); padding: 8px 12px; border-bottom: 1px solid rgba(255,255,255,0.06); white-space: nowrap; }
        .recent-table tbody td { padding: 12px 12px; font-size: 0.84rem; border-bottom: 1px solid rgba(255,255,255,0.04); vertical-align: middle; }
        .recent-table tbody tr:last-child td { border-bottom: none; }
        .recent-table tbody tr:hover td { background: rgba(255,255,255,0.03); }
        .badge-status { padding: 4px 12px; border-radius: 50px; font-size: 0.72rem; font-weight: 700; border: 1px solid transparent; }
        .status-pending   { background: rgba(255,193,7,0.1); color: #ffc107; border-color: #ffc107; }
        .status-confirmed { background: rgba(40,167,69,0.1); color: #28a745; border-color: #28a745; }
        .status-completed { background: rgba(72,202,228,0.1); color: #48cae4; border-color: #48cae4; }
        .status-cancelled { background: rgba(220,53,69,0.1); color: #dc3545; border-color: #dc3545; }
        /* Sea condition widget */
        .sea-widget { background: rgba(72,202,228,0.06); border: 1px solid rgba(72,202,228,0.18); border-radius: 16px; padding: 18px 22px; }
        .sea-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 12px; margin-top: 10px; text-align: center; }
        .sea-item strong { display: block; font-size: 1.2rem; color: var(--accent-cyan); }
        .sea-item span { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.8px; color: rgba(255,255,255,0.45); }
        .safety-tag { display: inline-flex; align-items: center; gap: 6px; padding: 6px 14px; border-radius: 50px; font-weight: 700; font-size: 0.8rem; margin-top: 12px; }
        .safe-tag { background: rgba(40,167,69,0.12); color: #5ddb8a; border: 1px solid rgba(40,167,69,0.3); }
        .moderate-tag { background: rgba(255,193,7,0.12); color: #ffc107; border: 1px solid rgba(255,193,7,0.3); }
        .unsafe-tag { background: rgba(220,53,69,0.12); color: #ff9999; border: 1px solid rgba(220,53,69,0.3); }
        @keyframes wave-motion {0% { transform: translateY(0); }50% { transform: translateY(-3px); }100% { transform: translateY(0); }}
        .brand-icon i { animation: wave-motion 3s ease-in-out infinite;display: inline-block;}
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
    <a href="<?= base_url('admin/dashboard') ?>" class="nav-item active"><i class="fa-solid fa-chart-line"></i> Dashboard</a>
    <a href="<?= base_url('admin/bookings') ?>" class="nav-item">
        <i class="fa-solid fa-calendar-check"></i> Bookings
        <?php if (($pendingBookings ?? 0) > 0): ?>
        <span class="badge-count"><?= $pendingBookings ?></span>
        <?php endif; ?>
    </a>
    <a href="<?= base_url('admin/users') ?>" class="nav-item"><i class="fa-solid fa-users"></i> Users</a>
    <div class="sidebar-section-label">Operations</div>
    <a href="<?= base_url('admin/sea-conditions') ?>" class="nav-item"><i class="fa-solid fa-tower-broadcast"></i> Sea Conditions</a>
    <a href="<?= base_url('admin/reviews') ?>" class="nav-item"><i class="fa-solid fa-star"></i> Reviews</a>
    <div class="sidebar-section-label">System</div>
    <a href="<?= base_url('admin/activities') ?>" class="nav-item"><i class="fa-solid fa-person-swimming"></i> Activities</a>
    <a href="<?= base_url('admin/sales') ?>" class="nav-item"><i class="fa-solid fa-peso-sign"></i> Sales</a>
    <div class="sidebar-footer">
        <a href="<?= base_url('logout') ?>" class="logout-btn"><i class="fa-solid fa-power-off"></i> Logout</a>
    </div>
</aside>

<main class="main-content">
    <div class="page-topbar">
        <div>
            <h1 class="page-title">Dashboard</h1>
            <p class="page-subtitle">Welcome back, Admin · <?= date('F d, Y') ?></p>
        </div>
        <span class="admin-pill"><i class="fa-solid fa-gauge me-2"></i>OVERVIEW</span>
    </div>

    <!-- KPI CARDS -->
    <?php
        $db = \Config\Database::connect();
        $totalRevenue = $db->table('bookings')->where('status !=', 'cancelled')->selectSum('total_amount','total')->get()->getRowArray()['total'] ?? 0;
    ?>
    <div class="kpi-row">
        <div class="kpi-card">
            <div class="kpi-icon cyan"><i class="fa-solid fa-calendar-check"></i></div>
            <div>
                <div class="kpi-value"><?= $totalBookings ?? 0 ?></div>
                <div class="kpi-label">Total Bookings</div>
            </div>
        </div>
        <div class="kpi-card">
            <div class="kpi-icon yellow"><i class="fa-solid fa-clock-rotate-left"></i></div>
            <div>
                <div class="kpi-value" style="color:#ffc107;"><?= $pendingBookings ?? 0 ?></div>
                <div class="kpi-label">Pending</div>
            </div>
        </div>
        <div class="kpi-card">
            <div class="kpi-icon green"><i class="fa-solid fa-users"></i></div>
            <div>
                <div class="kpi-value" style="color:#5ddb8a;"><?= $totalUsers ?? 0 ?></div>
                <div class="kpi-label">Registered Users</div>
            </div>
        </div>
        <div class="kpi-card">
            <div class="kpi-icon blue"><i class="fa-solid fa-peso-sign"></i></div>
            <div>
                <div class="kpi-value" style="color:#74b4ff;font-size:1.2rem;">₱<?= number_format($totalRevenue, 0) ?></div>
                <div class="kpi-label">Total Revenue</div>
            </div>
        </div>
    </div>

    <!-- CHARTS -->
    <?php
        // Activity distribution for pie chart
        $activityCounts = $db->table('bookings')
            ->select('activity_name, COUNT(*) as count')
            ->where('status !=', 'cancelled')
            ->groupBy('activity_name')
            ->get()->getResultArray();
        $actNames  = array_column($activityCounts, 'activity_name');
        $actCounts = array_column($activityCounts, 'count');

        // Weekly sales (last 7 days)
        $weeklySales = [];
        for ($i = 6; $i >= 0; $i--) {
            $day = date('Y-m-d', strtotime("-$i days"));
            $amt = $db->table('bookings')->where('status !=','cancelled')->where('DATE(created_at)', $day)->selectSum('total_amount','total')->get()->getRowArray()['total'] ?? 0;
            $weeklySales[] = ['label' => date('D', strtotime($day)), 'amount' => (float)$amt];
        }

        // Monthly sales (last 6 months)
        $monthlySales = [];
        for ($i = 5; $i >= 0; $i--) {
            $mo  = date('Y-m', strtotime("-$i months"));
            $amt = $db->table('bookings')->where('status !=','cancelled')->where('DATE_FORMAT(created_at,\'%Y-%m\')', $mo)->selectSum('total_amount','total')->get()->getRowArray()['total'] ?? 0;
            $monthlySales[] = ['label' => date('M Y', strtotime($mo.'-01')), 'amount' => (float)$amt];
        }

        // Yearly sales (last 3 years)
        $yearlySales = [];
        for ($i = 2; $i >= 0; $i--) {
            $yr  = date('Y', strtotime("-$i years"));
            $amt = $db->table('bookings')->where('status !=','cancelled')->where('YEAR(created_at)', $yr)->selectSum('total_amount','total')->get()->getRowArray()['total'] ?? 0;
            $yearlySales[] = ['label' => $yr, 'amount' => (float)$amt];
        }
    ?>

    <div class="charts-row">
        <!-- Pie chart: Activity distribution -->
        <div class="chart-card">
            <div class="chart-title"><i class="fa-solid fa-chart-pie"></i> Activity Distribution</div>
            <p style="font-size:0.72rem;color:rgba(255,255,255,0.4);margin-bottom:14px;">Bookings per water activity</p>
            <canvas id="pieChart" style="max-height:220px;"></canvas>
            <?php if (empty($activityCounts)): ?>
            <p style="text-align:center;opacity:0.4;font-size:0.82rem;margin-top:20px;">No booking data yet.</p>
            <?php endif; ?>
        </div>

        <!-- Line chart: Sales -->
        <div class="chart-card">
            <div class="chart-title"><i class="fa-solid fa-chart-line"></i> Sales Overview</div>
            <div class="sales-tabs">
                <button class="sales-tab active" onclick="showSales('weekly',this)">Weekly</button>
                <button class="sales-tab" onclick="showSales('monthly',this)">Monthly</button>
                <button class="sales-tab" onclick="showSales('yearly',this)">Yearly</button>
            </div>
            <canvas id="lineChart" style="max-height:200px;"></canvas>
        </div>
    </div>

    <!-- SEA CONDITIONS + RECENT BOOKINGS -->
    <div style="display:grid;grid-template-columns:1fr 2.2fr;gap:18px;margin-bottom:24px;">
        <!-- Sea conditions -->
        <div class="chart-card">
            <div class="chart-title"><i class="fa-solid fa-tower-broadcast"></i> Current Sea Conditions</div>
            <?php if ($latestSea ?? null): ?>
            <div class="sea-widget">
                <div class="sea-grid">
                    <div class="sea-item"><strong><?= esc($latestSea['wind_speed']) ?> kts</strong><span>Wind Speed</span></div>
                    <div class="sea-item"><strong><?= esc($latestSea['wave_height']) ?> m</strong><span>Wave Height</span></div>
                    <div class="sea-item"><strong><?= esc($latestSea['wave_period']) ?> s</strong><span>Wave Period</span></div>
                </div>
                <?php
                    $s = strtolower($latestSea['safety_status'] ?? 'safe');
                    $tagClass = match($s) { 'unsafe' => 'unsafe-tag', 'moderate' => 'moderate-tag', default => 'safe-tag' };
                    $tagIcon  = match($s) { 'unsafe' => 'fa-triangle-exclamation', 'moderate' => 'fa-circle-exclamation', default => 'fa-circle-check' };
                ?>
                <div class="text-center">
                    <div class="safety-tag <?= $tagClass ?>"><i class="fa-solid <?= $tagIcon ?>"></i> <?= ucfirst($s) ?></div>
                </div>
            </div>
            <p style="font-size:0.7rem;color:rgba(255,255,255,0.35);margin-top:10px;margin-bottom:0;">
                Updated: <?= date('M d, Y h:i A', strtotime($latestSea['recorded_at'])) ?>
            </p>
            <?php else: ?>
            <p style="opacity:0.4;font-size:0.84rem;margin-top:16px;">No sea data yet.</p>
            <?php endif; ?>
        </div>

        <!-- Recent Bookings -->
        <div class="recent-card" style="margin-bottom:0;">
            <div class="section-header">
                <span class="section-title"><i class="fa-solid fa-clock-rotate-left me-2" style="color:var(--accent-cyan);"></i>Recent Bookings</span>
                <a href="<?= base_url('admin/bookings') ?>" class="btn-view-all">View All</a>
            </div>
            <?php if (!empty($recentBookings)): ?>
            <table class="recent-table">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>User</th>
                        <th>Activity</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($recentBookings as $b): ?>
                    <?php
                        $sc = match(strtolower($b['status'])) {
                            'pending' => 'status-pending', 'confirmed','approved' => 'status-confirmed',
                            'completed' => 'status-completed', 'cancelled' => 'status-cancelled', default => '',
                        };
                    ?>
                    <tr>
                        <td style="font-size:0.76rem;opacity:0.7;">#<?= esc($b['booking_code']) ?></td>
                        <td style="font-weight:600;"><?= esc($b['username'] ?? '—') ?></td>
                        <td><?= esc($b['activity_name']) ?></td>
                        <td style="opacity:0.7;"><?= date('M d, Y', strtotime($b['date'])) ?></td>
                        <td style="color:var(--accent-cyan);font-weight:600;">₱<?= number_format($b['total_amount'],0) ?></td>
                        <td><span class="badge-status <?= $sc ?>"><?= ucfirst($b['status']) ?></span></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
            <p style="opacity:0.4;font-size:0.84rem;text-align:center;padding:20px 0;">No bookings yet.</p>
            <?php endif; ?>
        </div>
    </div>

</main>

<script>
// ── PIE CHART ──────────────────────────────────────────
const actNames  = <?= json_encode($actNames ?? []) ?>;
const actCounts = <?= json_encode(array_map('intval', $actCounts ?? [])) ?>;

if (actNames.length > 0) {
    new Chart(document.getElementById('pieChart'), {
        type: 'doughnut',
        data: {
            labels: actNames,
            datasets: [{
                data: actCounts,
                backgroundColor: ['#48cae4','#ffc107','#5ddb8a','#74b4ff'],
                borderColor: 'rgba(5,44,57,0.8)',
                borderWidth: 2,
            }]
        },
        options: {
            plugins: {
                legend: { labels: { color: 'rgba(255,255,255,0.7)', font: { family: 'Poppins', size: 11 }, padding: 14 } }
            },
            cutout: '60%',
        }
    });
}

// ── LINE CHART ─────────────────────────────────────────
const salesData = {
    weekly:  { labels: <?= json_encode(array_column($weeklySales, 'label')) ?>, values: <?= json_encode(array_column($weeklySales, 'amount')) ?> },
    monthly: { labels: <?= json_encode(array_column($monthlySales, 'label')) ?>, values: <?= json_encode(array_column($monthlySales, 'amount')) ?> },
    yearly:  { labels: <?= json_encode(array_column($yearlySales, 'label')) ?>, values: <?= json_encode(array_column($yearlySales, 'amount')) ?> },
};

const lineCtx = document.getElementById('lineChart').getContext('2d');
const lineGrad = lineCtx.createLinearGradient(0, 0, 0, 200);
lineGrad.addColorStop(0, 'rgba(72,202,228,0.35)');
lineGrad.addColorStop(1, 'rgba(72,202,228,0)');

const lineChart = new Chart(lineCtx, {
    type: 'line',
    data: {
        labels: salesData.weekly.labels,
        datasets: [{
            label: 'Sales (₱)',
            data: salesData.weekly.values,
            borderColor: '#48cae4',
            backgroundColor: lineGrad,
            borderWidth: 2.5,
            pointBackgroundColor: '#48cae4',
            pointRadius: 4,
            fill: true,
            tension: 0.4,
        }]
    },
    options: {
        plugins: { legend: { display: false } },
        scales: {
            x: { ticks: { color: 'rgba(255,255,255,0.5)', font: { family: 'Poppins', size: 10 } }, grid: { color: 'rgba(255,255,255,0.04)' } },
            y: { ticks: { color: 'rgba(255,255,255,0.5)', font: { family: 'Poppins', size: 10 }, callback: v => '₱' + v.toLocaleString() }, grid: { color: 'rgba(255,255,255,0.06)' } }
        }
    }
});

function showSales(period, btn) {
    document.querySelectorAll('.sales-tab').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    lineChart.data.labels = salesData[period].labels;
    lineChart.data.datasets[0].data = salesData[period].values;
    lineChart.update();
}
</script>
</body>
</html>