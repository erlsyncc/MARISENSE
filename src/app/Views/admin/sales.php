<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales | Waves Admin</title>
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
        /* KPI */
        .kpi-row { display: grid; grid-template-columns: repeat(5,1fr); gap: 13px; margin-bottom: 22px; }
        .kpi-card { background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.1); border-radius: 18px; padding: 20px 18px; text-align: center; transition: 0.22s; }
        .kpi-card:hover { background: rgba(255,255,255,0.1); transform: translateY(-2px); }
        .kpi-value { font-size: 1.45rem; font-weight: 700; color: var(--accent-cyan); }
        .kpi-label { font-size: 0.68rem; text-transform: uppercase; letter-spacing: 1px; color: rgba(255,255,255,0.45); margin-top: 4px; }
        /* Chart cards */
        .chart-row { display: grid; grid-template-columns: 1.4fr 1fr; gap: 18px; margin-bottom: 22px; }
        .chart-card { background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.1); border-radius: 20px; padding: 24px; }
        .chart-title { font-size: 0.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.2px; color: rgba(255,255,255,0.55); margin-bottom: 14px; display: flex; align-items: center; gap: 8px; }
        .chart-title i { color: var(--accent-cyan); }
        .sales-tabs { display: flex; gap: 6px; margin-bottom: 14px; }
        .sales-tab { background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); color: rgba(255,255,255,0.6); padding: 5px 14px; border-radius: 50px; font-size: 0.74rem; font-weight: 600; cursor: pointer; transition: 0.2s; }
        .sales-tab.active, .sales-tab:hover { background: var(--accent-cyan); color: var(--deep-blue); border-color: var(--accent-cyan); }
        /* Activity revenue table */
        .data-card { background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.1); border-radius: 20px; padding: 24px; margin-bottom: 22px; }
        .data-table { width: 100%; color: white; border-collapse: collapse; }
        .data-table thead th { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1px; color: rgba(255,255,255,0.4); padding: 8px 14px; border-bottom: 1px solid rgba(255,255,255,0.06); }
        .data-table tbody td { padding: 13px 14px; font-size: 0.84rem; border-bottom: 1px solid rgba(255,255,255,0.04); vertical-align: middle; }
        .data-table tbody tr:last-child td { border-bottom: none; }
        .data-table tbody tr:hover td { background: rgba(255,255,255,0.03); }
        .badge-status { padding: 4px 12px; border-radius: 50px; font-size: 0.7rem; font-weight: 700; border: 1px solid transparent; }
        .status-pending   { background: rgba(255,193,7,0.1); color: #ffc107; border-color: #ffc107; }
        .status-confirmed { background: rgba(40,167,69,0.1); color: #28a745; border-color: #28a745; }
        .status-completed { background: rgba(72,202,228,0.1); color: #48cae4; border-color: #48cae4; }
        .status-cancelled { background: rgba(220,53,69,0.1); color: #dc3545; border-color: #dc3545; }
        .pay-paid   { background: rgba(40,167,69,0.12); color: #5ddb8a; border: 1px solid rgba(40,167,69,0.35); padding: 3px 10px; border-radius: 50px; font-size: 0.7rem; font-weight: 700; }
        .pay-half   { background: rgba(255,193,7,0.12); color: #ffc107; border: 1px solid rgba(255,193,7,0.35); padding: 3px 10px; border-radius: 50px; font-size: 0.7rem; font-weight: 700; }
        .pay-unpaid { background: rgba(255,255,255,0.06); color: rgba(255,255,255,0.45); border: 1px solid rgba(255,255,255,0.12); padding: 3px 10px; border-radius: 50px; font-size: 0.7rem; font-weight: 700; }
        .progress-bar-custom { background: rgba(255,255,255,0.08); border-radius: 4px; height: 6px; overflow: hidden; }
        .progress-fill { height: 100%; border-radius: 4px; background: var(--accent-cyan); }
        .search-bar { display: flex; gap: 10px; margin-bottom: 16px; }
        .search-input { background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); border-radius: 50px; color: white; padding: 9px 20px; font-size: 0.82rem; outline: none; min-width: 280px; }
        .search-input::placeholder { color: rgba(255,255,255,0.35); }
        .search-input:focus { border-color: var(--accent-cyan); }
         @keyframes wave-motion {0% { transform: translateY(0); }50% { transform: translateY(-3px); }100% { transform: translateY(0); }}
        .brand-icon i { animation: wave-motion 3s ease-in-out infinite;display: inline-block;}
    </style>
</head>
<body>

<?php
    $db = \Config\Database::connect();

    // KPIs
    $totalRevenue    = (float)($db->table('bookings')->where('status !=','cancelled')->selectSum('total_amount','t')->get()->getRowArray()['t'] ?? 0);
    $monthRevenue    = (float)($db->table('bookings')->where('status !=','cancelled')->where('DATE_FORMAT(created_at,\'%Y-%m\')', date('Y-m'))->selectSum('total_amount','t')->get()->getRowArray()['t'] ?? 0);
    $weekRevenue     = (float)($db->table('bookings')->where('status !=','cancelled')->where('created_at >=', date('Y-m-d', strtotime('-7 days')))->selectSum('total_amount','t')->get()->getRowArray()['t'] ?? 0);
    $paidCount       = $db->table('bookings')->where('payment_status','paid')->countAllResults();
    $unpaidCount     = $db->table('bookings')->where('payment_status','unpaid')->where('status !=','cancelled')->countAllResults();
    $totalBookings   = $db->table('bookings')->where('status !=','cancelled')->countAllResults();

    // Activity revenue breakdown
    $actRevenue = $db->table('bookings b')
        ->select('activity_name, COUNT(*) as count, SUM(total_amount) as revenue')
        ->where('b.status !=','cancelled')
        ->groupBy('activity_name')
        ->orderBy('revenue','DESC')
        ->get()->getResultArray();
    $maxRevenue = !empty($actRevenue) ? max(array_column($actRevenue, 'revenue')) : 1;

    // Sales data
    $weeklySales = [];
    for ($i = 6; $i >= 0; $i--) {
        $day = date('Y-m-d', strtotime("-$i days"));
        $amt = (float)($db->table('bookings')->where('status !=','cancelled')->where('DATE(created_at)', $day)->selectSum('total_amount','t')->get()->getRowArray()['t'] ?? 0);
        $weeklySales[] = ['label' => date('D', strtotime($day)), 'amount' => $amt];
    }
    $monthlySales = [];
    for ($i = 5; $i >= 0; $i--) {
        $mo  = date('Y-m', strtotime("-$i months"));
        $amt = (float)($db->table('bookings')->where('status !=','cancelled')->where('DATE_FORMAT(created_at,\'%Y-%m\')', $mo)->selectSum('total_amount','t')->get()->getRowArray()['t'] ?? 0);
        $monthlySales[] = ['label' => date('M Y', strtotime($mo.'-01')), 'amount' => $amt];
    }
    $yearlySales = [];
    for ($i = 2; $i >= 0; $i--) {
        $yr  = date('Y', strtotime("-$i years"));
        $amt = (float)($db->table('bookings')->where('status !=','cancelled')->where('YEAR(created_at)', $yr)->selectSum('total_amount','t')->get()->getRowArray()['t'] ?? 0);
        $yearlySales[] = ['label' => $yr, 'amount' => $amt];
    }

    // All transactions
    $transactions = $db->table('bookings b')
        ->select('b.*, u.username')
        ->join('users u','u.id = b.user_id','left')
        ->orderBy('b.created_at','DESC')
        ->get()->getResultArray();

    // Bar chart data per activity per month (last 3 months)
    $barLabels = [];
    $barDatasets = [];
    $actNames = array_unique(array_column($actRevenue, 'activity_name'));
    $colors = ['#48cae4','#ffc107','#5ddb8a','#74b4ff','#ff9999'];
    for ($i = 2; $i >= 0; $i--) {
        $barLabels[] = date('M Y', strtotime("-$i months"));
    }
    foreach ($actNames as $idx => $act) {
        $vals = [];
        for ($i = 2; $i >= 0; $i--) {
            $mo  = date('Y-m', strtotime("-$i months"));
            $amt = (float)($db->table('bookings')->where('activity_name',$act)->where('status !=','cancelled')->where('DATE_FORMAT(created_at,\'%Y-%m\')', $mo)->selectSum('total_amount','t')->get()->getRowArray()['t'] ?? 0);
            $vals[] = $amt;
        }
        $barDatasets[] = ['label' => $act, 'data' => $vals, 'backgroundColor' => $colors[$idx % count($colors)]];
    }
?>

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
    <a href="<?= base_url('admin/sea-conditions') ?>" class="nav-item"><i class="fa-solid fa-tower-broadcast"></i> Sea Conditions</a>
    <a href="<?= base_url('admin/reviews') ?>" class="nav-item"><i class="fa-solid fa-star"></i> Reviews</a>
    <div class="sidebar-section-label">System</div>
    <a href="<?= base_url('admin/activities') ?>" class="nav-item"><i class="fa-solid fa-person-swimming"></i> Activities</a>
    <a href="<?= base_url('admin/sales') ?>" class="nav-item active"><i class="fa-solid fa-peso-sign"></i> Sales</a>
    <div class="sidebar-footer">
        <a href="<?= base_url('logout') ?>" class="logout-btn"><i class="fa-solid fa-power-off"></i> Logout</a>
    </div>
</aside>

<main class="main-content">
    <div class="page-topbar">
        <div>
            <h1 class="page-title">Sales & Revenue</h1>
            <p class="page-subtitle">Complete financial overview — all transactions, activity revenue, and trends.</p>
        </div>
        <span class="admin-pill"><i class="fa-solid fa-peso-sign me-2"></i>SALES</span>
    </div>

    <!-- KPI CARDS -->
    <div class="kpi-row">
        <div class="kpi-card">
            <div class="kpi-value">₱<?= number_format($totalRevenue, 0) ?></div>
            <div class="kpi-label">All-Time Revenue</div>
        </div>
        <div class="kpi-card">
            <div class="kpi-value" style="color:#5ddb8a;">₱<?= number_format($monthRevenue, 0) ?></div>
            <div class="kpi-label">This Month</div>
        </div>
        <div class="kpi-card">
            <div class="kpi-value" style="color:#ffc107;">₱<?= number_format($weekRevenue, 0) ?></div>
            <div class="kpi-label">Last 7 Days</div>
        </div>
        <div class="kpi-card">
            <div class="kpi-value" style="color:#74b4ff;"><?= $paidCount ?></div>
            <div class="kpi-label">Paid Bookings</div>
        </div>
        <div class="kpi-card">
            <div class="kpi-value" style="color:#ff9999;"><?= $unpaidCount ?></div>
            <div class="kpi-label">Pending Payment</div>
        </div>
    </div>

    <!-- CHARTS -->
    <div class="chart-row">
        <div class="chart-card">
            <div class="chart-title"><i class="fa-solid fa-chart-line"></i> Sales Trend</div>
            <div class="sales-tabs">
                <button class="sales-tab active" onclick="showSales('weekly',this)">Weekly</button>
                <button class="sales-tab" onclick="showSales('monthly',this)">Monthly</button>
                <button class="sales-tab" onclick="showSales('yearly',this)">Yearly</button>
            </div>
            <canvas id="lineChart" style="max-height:200px;"></canvas>
        </div>
        <div class="chart-card">
            <div class="chart-title"><i class="fa-solid fa-chart-bar"></i> Revenue by Activity (3 months)</div>
            <canvas id="barChart" style="max-height:200px;"></canvas>
        </div>
    </div>

    <!-- ACTIVITY REVENUE BREAKDOWN -->
    <div class="data-card">
        <div class="chart-title" style="margin-bottom:18px;"><i class="fa-solid fa-person-swimming"></i> Revenue by Activity</div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Activity</th>
                    <th>Total Bookings</th>
                    <th>Revenue</th>
                    <th>Share</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($actRevenue as $ar): ?>
                <?php $pct = $totalRevenue > 0 ? round($ar['revenue'] / $totalRevenue * 100) : 0; ?>
                <tr>
                    <td style="font-weight:600;"><?= esc($ar['activity_name']) ?></td>
                    <td><?= number_format($ar['count']) ?> bookings</td>
                    <td style="color:var(--accent-cyan);font-weight:700;">₱<?= number_format($ar['revenue'], 2) ?></td>
                    <td style="width:200px;">
                        <div style="display:flex;align-items:center;gap:8px;">
                            <div class="progress-bar-custom" style="flex:1;">
                                <div class="progress-fill" style="width:<?= $pct ?>%;"></div>
                            </div>
                            <span style="font-size:0.76rem;opacity:0.7;flex-shrink:0;"><?= $pct ?>%</span>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($actRevenue)): ?>
                <tr><td colspan="4" style="text-align:center;opacity:0.4;padding:24px;">No revenue data yet.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- ALL TRANSACTIONS -->
    <div class="data-card">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:18px;">
            <div class="chart-title" style="margin-bottom:0;"><i class="fa-solid fa-receipt"></i> All Transactions</div>
            <span style="font-size:0.75rem;color:rgba(255,255,255,0.4);"><?= count($transactions) ?> records</span>
        </div>
        <div class="search-bar">
            <input type="text" class="search-input" id="txSearch" placeholder="🔍  Search by booking code, user, or activity…" oninput="filterTx()">
        </div>
        <div style="overflow-x:auto;">
        <table class="data-table" id="txTable">
            <thead>
                <tr>
                    <th>Booking Code</th>
                    <th>User</th>
                    <th>Activity</th>
                    <th>Date</th>
                    <th>Participants</th>
                    <th>Contact</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Payment</th>
                    <th>Booked On</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($transactions as $tx): ?>
                <?php
                    $sc = match(strtolower($tx['status'])) {
                        'pending' => 'status-pending', 'confirmed','approved' => 'status-confirmed',
                        'completed' => 'status-completed', 'cancelled' => 'status-cancelled', default => '',
                    };
                    $payClass = 'pay-unpaid'; $payText = 'Unpaid';
                    if ($tx['payment_status'] === 'paid') { $payClass = 'pay-paid'; $payText = 'Paid'; }
                    elseif (($tx['down_payment_status'] ?? '') === 'paid') { $payClass = 'pay-half'; $payText = '50% GCash'; }
                ?>
                <tr data-search="<?= strtolower($tx['booking_code'].' '.$tx['username'].' '.$tx['activity_name']) ?>">
                    <td style="font-size:0.76rem;opacity:0.8;">#<?= esc($tx['booking_code']) ?></td>
                    <td style="font-weight:600;"><?= esc($tx['username'] ?? '—') ?></td>
                    <td><?= esc($tx['activity_name']) ?></td>
                    <td style="opacity:0.7;"><?= date('M d, Y', strtotime($tx['date'])) ?></td>
                    <td style="text-align:center;"><?= esc($tx['participants']) ?></td>
                    <td style="opacity:0.7;"><?= esc($tx['contact_number'] ?? '—') ?></td>
                    <td style="color:var(--accent-cyan);font-weight:700;">₱<?= number_format($tx['total_amount'],2) ?></td>
                    <td><span class="badge-status <?= $sc ?>"><?= ucfirst($tx['status']) ?></span></td>
                    <td><span class="<?= $payClass ?>"><?= $payText ?></span></td>
                    <td style="opacity:0.6;font-size:0.76rem;"><?= date('M d, Y', strtotime($tx['created_at'])) ?></td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($transactions)): ?>
                <tr><td colspan="10" style="text-align:center;opacity:0.4;padding:24px;">No transactions yet.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
        </div>
    </div>

</main>

<script>
const salesData = {
    weekly:  { labels: <?= json_encode(array_column($weeklySales, 'label')) ?>, values: <?= json_encode(array_column($weeklySales, 'amount')) ?> },
    monthly: { labels: <?= json_encode(array_column($monthlySales, 'label')) ?>, values: <?= json_encode(array_column($monthlySales, 'amount')) ?> },
    yearly:  { labels: <?= json_encode(array_column($yearlySales, 'label')) ?>, values: <?= json_encode(array_column($yearlySales, 'amount')) ?> },
};

const lineCtx = document.getElementById('lineChart').getContext('2d');
const grad = lineCtx.createLinearGradient(0,0,0,200);
grad.addColorStop(0,'rgba(72,202,228,0.3)');
grad.addColorStop(1,'rgba(72,202,228,0)');

const lineChart = new Chart(lineCtx, {
    type: 'line',
    data: {
        labels: salesData.weekly.labels,
        datasets: [{ label: '₱ Sales', data: salesData.weekly.values, borderColor: '#48cae4', backgroundColor: grad, borderWidth: 2.5, pointBackgroundColor: '#48cae4', pointRadius: 4, fill: true, tension: 0.4 }]
    },
    options: {
        plugins: { legend: { display: false } },
        scales: {
            x: { ticks: { color: 'rgba(255,255,255,0.5)', font: { family: 'Poppins', size: 10 } }, grid: { color: 'rgba(255,255,255,0.04)' } },
            y: { ticks: { color: 'rgba(255,255,255,0.5)', font: { family: 'Poppins', size: 10 }, callback: v => '₱' + v.toLocaleString() }, grid: { color: 'rgba(255,255,255,0.05)' } }
        }
    }
});

function showSales(p, btn) {
    document.querySelectorAll('.sales-tab').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    lineChart.data.labels = salesData[p].labels;
    lineChart.data.datasets[0].data = salesData[p].values;
    lineChart.update();
}

// Bar chart
new Chart(document.getElementById('barChart'), {
    type: 'bar',
    data: {
        labels: <?= json_encode($barLabels) ?>,
        datasets: <?= json_encode($barDatasets) ?>
    },
    options: {
        plugins: { legend: { labels: { color: 'rgba(255,255,255,0.6)', font: { family: 'Poppins', size: 10 }, padding: 10 } } },
        scales: {
            x: { ticks: { color: 'rgba(255,255,255,0.5)', font: { family: 'Poppins', size: 10 } }, grid: { display: false } },
            y: { ticks: { color: 'rgba(255,255,255,0.5)', font: { family: 'Poppins', size: 10 }, callback: v => '₱' + v.toLocaleString() }, grid: { color: 'rgba(255,255,255,0.05)' } }
        }
    }
});

function filterTx() {
    const q = document.getElementById('txSearch').value.toLowerCase();
    document.querySelectorAll('#txTable tbody tr').forEach(row => {
        row.style.display = (!q || row.dataset.search.includes(q)) ? '' : 'none';
    });
}
</script>
</body>
</html>