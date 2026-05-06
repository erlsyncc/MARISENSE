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

        /* ── Sidebar ── */
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
        @keyframes wave-motion { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-3px)} }
        .brand-icon i { animation: wave-motion 3s ease-in-out infinite; display: inline-block; }

        /* ── Main ── */
        .main-content { margin-left: var(--sidebar-width); padding: 32px 36px; min-height: 100vh; }
        .page-topbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 28px; }
        .page-title { font-size: 1.6rem; font-weight: 700; color: white; margin: 0; }
        .page-subtitle { font-size: 0.82rem; color: rgba(255,255,255,0.5); margin: 2px 0 0; }
        .admin-pill { background: rgba(72,202,228,0.12); border: 1px solid rgba(72,202,228,0.3); color: var(--accent-cyan); border-radius: 50px; padding: 6px 18px; font-size: 0.78rem; font-weight: 600; letter-spacing: 1px; }

        /* ── Notice banner ── */
        .sales-notice { background: rgba(72,202,228,0.07); border: 1px solid rgba(72,202,228,0.2); border-radius: 14px; padding: 11px 18px; margin-bottom: 20px; font-size: 0.8rem; color: rgba(255,255,255,0.6); display: flex; align-items: center; gap: 10px; }
        .sales-notice i { color: var(--accent-cyan); flex-shrink: 0; }
        .sales-notice strong { color: var(--accent-cyan); }

        /* ── KPI ── */
        .kpi-row { display: grid; grid-template-columns: repeat(5,1fr); gap: 13px; margin-bottom: 22px; }
        .kpi-card { background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.1); border-radius: 18px; padding: 20px 18px; text-align: center; transition: 0.22s; }
        .kpi-card:hover { background: rgba(255,255,255,0.1); transform: translateY(-2px); }
        .kpi-value { font-size: 1.45rem; font-weight: 700; color: var(--accent-cyan); }
        .kpi-label { font-size: 0.68rem; text-transform: uppercase; letter-spacing: 1px; color: rgba(255,255,255,0.45); margin-top: 4px; }
        .kpi-sub { font-size: 0.65rem; color: rgba(255,255,255,0.3); margin-top: 3px; }

        /* ── Chart cards ── */
        .chart-row { display: grid; grid-template-columns: 1.4fr 1fr; gap: 18px; margin-bottom: 22px; }
        .chart-card { background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.1); border-radius: 20px; padding: 24px; }
        .chart-title { font-size: 0.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.2px; color: rgba(255,255,255,0.55); margin-bottom: 14px; display: flex; align-items: center; gap: 8px; }
        .chart-title i { color: var(--accent-cyan); }
        .sales-tabs { display: flex; gap: 6px; margin-bottom: 14px; }
        .sales-tab { background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); color: rgba(255,255,255,0.6); padding: 5px 14px; border-radius: 50px; font-size: 0.74rem; font-weight: 600; cursor: pointer; transition: 0.2s; }
        .sales-tab.active, .sales-tab:hover { background: var(--accent-cyan); color: var(--deep-blue); border-color: var(--accent-cyan); }

        /* ── Data cards / tables ── */
        .data-card { background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.1); border-radius: 20px; padding: 24px; margin-bottom: 22px; }
        .data-table { width: 100%; color: white; border-collapse: collapse; }
        .data-table thead th { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1px; color: rgba(255,255,255,0.4); padding: 8px 14px; border-bottom: 1px solid rgba(255,255,255,0.06); }
        .data-table tbody td { padding: 13px 14px; font-size: 0.84rem; border-bottom: 1px solid rgba(255,255,255,0.04); vertical-align: middle; }
        .data-table tbody tr:last-child td { border-bottom: none; }
        .data-table tbody tr:hover td { background: rgba(255,255,255,0.03); }

        /* ── Badges ── */
        .badge-status { padding: 4px 12px; border-radius: 50px; font-size: 0.7rem; font-weight: 700; border: 1px solid transparent; }
        .status-pending   { background: rgba(255,193,7,0.1);  color: #ffc107; border-color: #ffc107; }
        .status-confirmed { background: rgba(40,167,69,0.1);  color: #28a745; border-color: #28a745; }
        .status-completed { background: rgba(72,202,228,0.1); color: #48cae4; border-color: #48cae4; }
        .status-cancelled { background: rgba(220,53,69,0.1);  color: #dc3545; border-color: #dc3545; }
        .pay-paid   { background: rgba(40,167,69,0.12);  color: #5ddb8a; border: 1px solid rgba(40,167,69,0.35);  padding: 3px 10px; border-radius: 50px; font-size: 0.7rem; font-weight: 700; white-space: nowrap; }
        .pay-half   { background: rgba(255,193,7,0.12);  color: #ffc107; border: 1px solid rgba(255,193,7,0.35);  padding: 3px 10px; border-radius: 50px; font-size: 0.7rem; font-weight: 700; white-space: nowrap; }
        .pay-unpaid { background: rgba(255,255,255,0.06); color: rgba(255,255,255,0.45); border: 1px solid rgba(255,255,255,0.12); padding: 3px 10px; border-radius: 50px; font-size: 0.7rem; font-weight: 700; }

        /* ── Amount columns: full vs partial ── */
        .amt-full    { color: var(--accent-cyan); font-weight: 700; }
        .amt-partial { color: #ffc107; font-weight: 700; }
        .amt-counted { font-size: 0.68rem; color: rgba(255,255,255,0.35); margin-top: 2px; font-style: italic; }

        /* ── Progress bar ── */
        .progress-bar-custom { background: rgba(255,255,255,0.08); border-radius: 4px; height: 6px; overflow: hidden; }
        .progress-fill { height: 100%; border-radius: 4px; background: var(--accent-cyan); }

        /* ── Search ── */
        .search-bar { display: flex; gap: 10px; margin-bottom: 16px; }
        .search-input { background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); border-radius: 50px; color: white; padding: 9px 20px; font-size: 0.82rem; outline: none; min-width: 280px; font-family: 'Poppins', sans-serif; }
        .search-input::placeholder { color: rgba(255,255,255,0.35); }
        .search-input:focus { border-color: var(--accent-cyan); }

        /* ── Tx filter tabs ── */
        .tx-filter-row { display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap; }
        .tx-filter-btn { background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.12); color: rgba(255,255,255,0.6); padding: 5px 16px; border-radius: 50px; font-size: 0.75rem; font-weight: 600; cursor: pointer; transition: 0.2s; }
        .tx-filter-btn.active, .tx-filter-btn:hover { background: var(--accent-cyan); color: var(--deep-blue); border-color: var(--accent-cyan); }

        /* ── Pending-payment section ── */
        .pending-note { background: rgba(255,193,7,0.07); border: 1px solid rgba(255,193,7,0.25); border-radius: 12px; padding: 10px 16px; font-size: 0.76rem; color: rgba(255,193,7,0.8); display: flex; align-items: center; gap: 8px; margin-bottom: 14px; }
        .pending-note i { flex-shrink: 0; }

        /* ── Help ── */
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

<?php
$db = \Config\Database::connect();

/*
 * ═══════════════════════════════════════════════════════════════════
 *  PAYMENT-GATED HELPER
 *  A booking counts toward revenue ONLY when:
 *    payment_status = 'paid'   →  count full total_amount
 *    OR down_payment_status = 'paid'  →  count down_payment amount only
 *
 *  Unpaid bookings (no payment at all) are EXCLUDED from all figures.
 * ═══════════════════════════════════════════════════════════════════
 */

/**
 * Sum the "collected" amount from the bookings table.
 * - Fully paid  → total_amount
 * - Half paid   → down_payment
 * - Unpaid      → 0 (excluded)
 *
 * We use a CASE expression so the DB does one pass.
 */
function salesSum($db, array $extraWhere = []): float
{
    $builder = $db->table('bookings')
        ->select("SUM(
            CASE
                WHEN payment_status = 'paid'         THEN total_amount
                WHEN down_payment_status = 'paid'    THEN COALESCE(down_payment, CEIL(total_amount / 2))
                ELSE 0
            END
        ) AS collected")
        ->where('status !=', 'cancelled');

    foreach ($extraWhere as $col => $val) {
        $builder->where($col, $val);
    }

    $row = $builder->get()->getRowArray();
    return (float)($row['collected'] ?? 0);
}

/**
 * The "pending" figure: total_amount of confirmed/pending bookings
 * that have NOT paid anything yet.
 */
function pendingSum($db): float
{
    $row = $db->table('bookings')
        ->select('SUM(total_amount) AS t')
        ->whereIn('status', ['pending', 'confirmed'])
        ->where('payment_status !=', 'paid')
        ->where('down_payment_status !=', 'paid')
        ->get()->getRowArray();
    return (float)($row['t'] ?? 0);
}

/* ── KPIs ── */
$totalRevenue  = salesSum($db);
$monthRevenue  = salesSum($db, ["DATE_FORMAT(created_at,'%Y-%m')" => date('Y-m')]);
$weekRevenue   = salesSum($db, ['created_at >=' => date('Y-m-d', strtotime('-7 days'))]);
$pendingValue  = pendingSum($db);   // money not yet collected

$paidCount     = $db->table('bookings')->where('payment_status', 'paid')->countAllResults();
$halfPaidCount = $db->table('bookings')
    ->where('payment_status !=', 'paid')
    ->where('down_payment_status', 'paid')
    ->countAllResults();
$unpaidCount   = $db->table('bookings')
    ->whereIn('status', ['pending', 'confirmed'])
    ->where('payment_status !=', 'paid')
    ->where('down_payment_status !=', 'paid')
    ->countAllResults();

/* ── Activity revenue breakdown (payment-gated) ── */
$actRevenue = $db->table('bookings')
    ->select("activity_name,
              COUNT(*) AS count,
              SUM(
                  CASE
                      WHEN payment_status = 'paid'      THEN total_amount
                      WHEN down_payment_status = 'paid' THEN COALESCE(down_payment, CEIL(total_amount / 2))
                      ELSE 0
                  END
              ) AS revenue")
    ->where('status !=', 'cancelled')
    ->having('revenue >', 0)
    ->groupBy('activity_name')
    ->orderBy('revenue', 'DESC')
    ->get()->getResultArray();
$maxRevenue = !empty($actRevenue) ? max(array_column($actRevenue, 'revenue')) : 1;

/* ── Weekly / Monthly / Yearly trend (payment-gated via CASE) ── */
function buildTrend($db, string $groupExpr, array $periods): array
{
    $out = [];
    foreach ($periods as $item) {
        $row = $db->table('bookings')
            ->select("SUM(
                CASE
                    WHEN payment_status = 'paid'         THEN total_amount
                    WHEN down_payment_status = 'paid'    THEN COALESCE(down_payment, CEIL(total_amount / 2))
                    ELSE 0
                END
            ) AS collected")
            ->where('status !=', 'cancelled')
            ->where($groupExpr, $item['key'])
            ->get()->getRowArray();
        $out[] = ['label' => $item['label'], 'amount' => (float)($row['collected'] ?? 0)];
    }
    return $out;
}

// Weekly (last 7 days)
$weekPeriods = [];
for ($i = 6; $i >= 0; $i--) {
    $day = date('Y-m-d', strtotime("-{$i} days"));
    $weekPeriods[] = ['key' => $day, 'label' => date('D', strtotime($day))];
}
$weeklySales = buildTrend($db, 'DATE(created_at)', $weekPeriods);

// Monthly (last 6 months)
$monthPeriods = [];
for ($i = 5; $i >= 0; $i--) {
    $mo = date('Y-m', strtotime("-{$i} months"));
    $monthPeriods[] = ['key' => $mo, 'label' => date('M Y', strtotime($mo . '-01'))];
}
$monthlySales = buildTrend($db, "DATE_FORMAT(created_at,'%Y-%m')", $monthPeriods);

// Yearly (last 3 years)
$yearPeriods = [];
for ($i = 2; $i >= 0; $i--) {
    $yr = date('Y', strtotime("-{$i} years"));
    $yearPeriods[] = ['key' => $yr, 'label' => $yr];
}
$yearlySales = buildTrend($db, 'YEAR(created_at)', $yearPeriods);

/* ── Bar chart: revenue per activity per month (last 3 months, payment-gated) ── */
$barLabels   = [];
$barDatasets = [];
$actNames    = array_unique(array_column($actRevenue, 'activity_name'));
$colors      = ['#48cae4', '#ffc107', '#5ddb8a', '#74b4ff', '#ff9999'];

for ($i = 2; $i >= 0; $i--) {
    $barLabels[] = date('M Y', strtotime("-{$i} months"));
}
foreach ($actNames as $idx => $act) {
    $vals = [];
    for ($i = 2; $i >= 0; $i--) {
        $mo  = date('Y-m', strtotime("-{$i} months"));
        $row = $db->table('bookings')
            ->select("SUM(
                CASE
                    WHEN payment_status = 'paid'         THEN total_amount
                    WHEN down_payment_status = 'paid'    THEN COALESCE(down_payment, CEIL(total_amount / 2))
                    ELSE 0
                END
            ) AS collected")
            ->where('activity_name', $act)
            ->where('status !=', 'cancelled')
            ->where("DATE_FORMAT(created_at,'%Y-%m')", $mo)
            ->get()->getRowArray();
        $vals[] = (float)($row['collected'] ?? 0);
    }
    $barDatasets[] = [
        'label'           => $act,
        'data'            => $vals,
        'backgroundColor' => $colors[$idx % count($colors)],
    ];
}

/* ── Transactions: only bookings with at least some payment ── */
$paidTransactions = $db->table('bookings b')
    ->select('b.*, u.username')
    ->join('users u', 'u.id = b.user_id', 'left')
    ->groupStart()
        ->where('b.payment_status', 'paid')
        ->orWhere('b.down_payment_status', 'paid')
    ->groupEnd()
    ->orderBy('b.created_at', 'DESC')
    ->get()->getResultArray();

/* ── Unpaid bookings (for the separate "awaiting payment" section) ── */
$unpaidTransactions = $db->table('bookings b')
    ->select('b.*, u.username')
    ->join('users u', 'u.id = b.user_id', 'left')
    ->where('b.payment_status !=', 'paid')
    ->where('b.down_payment_status !=', 'paid')
    ->whereIn('b.status', ['pending', 'confirmed'])
    ->orderBy('b.created_at', 'DESC')
    ->get()->getResultArray();
?>

<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon"><i class="fa-solid fa-water"></i></div>
        <div class="brand-title">Waves Admin</div>
        <div class="brand-sub">Control Panel</div>
    </div>
    <div class="sidebar-section-label">Main</div>
    <a href="<?= base_url('admin/dashboard') ?>" class="nav-item"><i class="fa-solid fa-chart-line"></i> Dashboard</a>
    <a href="<?= base_url('admin/bookings') ?>" class="nav-item">
        <i class="fa-solid fa-calendar-check"></i> Bookings
    </a>
    <a href="<?= base_url('admin/users') ?>" class="nav-item"><i class="fa-solid fa-users"></i> Users</a>
    <div class="sidebar-section-label">Operations</div>
    <a href="<?= base_url('admin/sea-conditions') ?>" class="nav-item"><i class="fa-solid fa-tower-broadcast"></i> Sea Conditions</a>
    <a href="<?= base_url('admin/reviews') ?>" class="nav-item"><i class="fa-solid fa-star"></i> Reviews</a>
    <div class="sidebar-section-label">System</div>
    <a href="<?= base_url('admin/activities') ?>" class="nav-item"><i class="fa-solid fa-person-swimming"></i> Activities</a>
    <a href="<?= base_url('admin/sales') ?>" class="nav-item active"><i class="fa-solid fa-peso-sign"></i> Sales</a>
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
            <h1 class="page-title">Sales & Revenue</h1>
            <p class="page-subtitle">Financial overview — only bookings with confirmed payment are counted.</p>
        </div>
        <span class="admin-pill"><i class="fa-solid fa-peso-sign me-2"></i>SALES</span>
    </div>

    <!-- Notice -->
    <div class="sales-notice">
        <i class="fa-solid fa-circle-info"></i>
        <span>
            <strong>Payment-gated reporting:</strong>
            Revenue figures only include bookings where payment has been received —
            either <strong>full payment</strong> or a <strong>50% down payment</strong>.
            Unpaid bookings are shown separately at the bottom.
        </span>
    </div>

    <!-- KPI CARDS -->
    <div class="kpi-row">
        <div class="kpi-card">
            <div class="kpi-value">₱<?= number_format($totalRevenue, 0) ?></div>
            <div class="kpi-label">Collected Revenue</div>
            <div class="kpi-sub">paid + partial</div>
        </div>
        <div class="kpi-card">
            <div class="kpi-value" style="color:#5ddb8a;">₱<?= number_format($monthRevenue, 0) ?></div>
            <div class="kpi-label">This Month</div>
            <div class="kpi-sub">paid bookings</div>
        </div>
        <div class="kpi-card">
            <div class="kpi-value" style="color:#ffc107;">₱<?= number_format($weekRevenue, 0) ?></div>
            <div class="kpi-label">Last 7 Days</div>
            <div class="kpi-sub">paid bookings</div>
        </div>
        <div class="kpi-card">
            <div class="kpi-value" style="color:#74b4ff;"><?= $paidCount ?> <span style="font-size:0.9rem;">/ <?= $halfPaidCount ?></span></div>
            <div class="kpi-label">Full / Half Paid</div>
            <div class="kpi-sub">both counted</div>
        </div>
        <div class="kpi-card">
            <div class="kpi-value" style="color:#ff9999;">₱<?= number_format($pendingValue, 0) ?></div>
            <div class="kpi-label">Awaiting Payment</div>
            <div class="kpi-sub"><?= $unpaidCount ?> booking<?= $unpaidCount != 1 ? 's' : '' ?></div>
        </div>
    </div>

    <!-- CHARTS -->
    <div class="chart-row">
        <div class="chart-card">
            <div class="chart-title"><i class="fa-solid fa-chart-line"></i> Collected Revenue Trend</div>
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
        <div class="chart-title" style="margin-bottom:6px;"><i class="fa-solid fa-person-swimming"></i> Revenue by Activity</div>
        <p style="font-size:0.75rem;color:rgba(255,255,255,0.35);margin-bottom:18px;">Based on collected amounts only (fully paid + partial down payments).</p>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Activity</th>
                    <th>Paid Bookings</th>
                    <th>Collected Revenue</th>
                    <th>Share</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($actRevenue as $ar): ?>
                <?php $pct = $totalRevenue > 0 ? round($ar['revenue'] / $totalRevenue * 100) : 0; ?>
                <tr>
                    <td style="font-weight:600;"><?= esc($ar['activity_name']) ?></td>
                    <td><?= number_format($ar['count']) ?> booking<?= $ar['count'] != 1 ? 's' : '' ?></td>
                    <td class="amt-full">₱<?= number_format($ar['revenue'], 2) ?></td>
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
                <tr><td colspan="4" style="text-align:center;opacity:0.4;padding:24px;">No collected revenue yet.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- PAID TRANSACTIONS -->
    <div class="data-card">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;">
            <div class="chart-title" style="margin-bottom:0;">
                <i class="fa-solid fa-receipt"></i> Paid Transactions
            </div>
            <span style="font-size:0.75rem;color:rgba(255,255,255,0.4);"><?= count($paidTransactions) ?> record<?= count($paidTransactions) != 1 ? 's' : '' ?></span>
        </div>
        <p style="font-size:0.75rem;color:rgba(255,255,255,0.35);margin-bottom:14px;">
            Only bookings where at least a down payment has been confirmed.
            <span style="color:#ffc107;">Yellow amount</span> = partial (50% collected so far).
        </p>

        <div class="search-bar">
            <input type="text" class="search-input" id="txSearch"
                   placeholder="🔍  Search by booking code, user, or activity…"
                   oninput="filterTx()">
        </div>

        <!-- Payment type filter tabs -->
        <div class="tx-filter-row">
            <button class="tx-filter-btn active" onclick="setTxFilter('all',this)">All Paid</button>
            <button class="tx-filter-btn" onclick="setTxFilter('full',this)">Fully Paid</button>
            <button class="tx-filter-btn" onclick="setTxFilter('half',this)">50% Down</button>
        </div>

        <div style="overflow-x:auto;">
        <table class="data-table" id="txTable">
            <thead>
                <tr>
                    <th>Booking Code</th>
                    <th>User</th>
                    <th>Activity</th>
                    <th>Date</th>
                    <th>Pax</th>
                    <th>Total Value</th>
                    <th>Collected</th>
                    <th>Status</th>
                    <th>Payment</th>
                    <th>Booked On</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($paidTransactions as $tx):
                    $sc = match(strtolower($tx['status'])) {
                        'pending'   => 'status-pending',
                        'confirmed' => 'status-confirmed',
                        'completed' => 'status-completed',
                        'cancelled' => 'status-cancelled',
                        default     => '',
                    };
                    $isFullyPaid = $tx['payment_status'] === 'paid';
                    $isHalfPaid  = !$isFullyPaid && ($tx['down_payment_status'] ?? '') === 'paid';

                    // Amount actually collected
                    $collected = $isFullyPaid
                        ? (float)$tx['total_amount']
                        : (float)($tx['down_payment'] ?? ceil($tx['total_amount'] / 2));

                    $payClass = $isFullyPaid ? 'pay-paid' : 'pay-half';
                    $payText  = $isFullyPaid ? 'Fully Paid' : '50% Down';
                    $txFilter = $isFullyPaid ? 'full' : 'half';
                    $amtClass = $isFullyPaid ? 'amt-full' : 'amt-partial';
                ?>
                <tr data-search="<?= strtolower(($tx['booking_code'] ?? '') . ' ' . ($tx['username'] ?? '') . ' ' . ($tx['activity_name'] ?? '')) ?>"
                    data-paytype="<?= $txFilter ?>">
                    <td style="font-size:0.76rem;opacity:0.8;">#<?= esc($tx['booking_code']) ?></td>
                    <td style="font-weight:600;"><?= esc($tx['username'] ?? '—') ?></td>
                    <td><?= esc($tx['all_activities'] ?? $tx['activity_name']) ?></td>
                    <td style="opacity:0.7;"><?= date('M d, Y', strtotime($tx['date'])) ?></td>
                    <td style="text-align:center;"><?= esc($tx['participants']) ?></td>
                    <td style="opacity:0.6;">₱<?= number_format($tx['total_amount'], 2) ?></td>
                    <td>
                        <div class="<?= $amtClass ?>">₱<?= number_format($collected, 2) ?></div>
                        <?php if ($isHalfPaid): ?>
                        <div class="amt-counted">50% of ₱<?= number_format($tx['total_amount'], 2) ?></div>
                        <?php endif; ?>
                    </td>
                    <td><span class="badge-status <?= $sc ?>"><?= ucfirst($tx['status']) ?></span></td>
                    <td><span class="<?= $payClass ?>"><?= $payText ?></span></td>
                    <td style="opacity:0.6;font-size:0.76rem;"><?= date('M d, Y', strtotime($tx['created_at'])) ?></td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($paidTransactions)): ?>
                <tr><td colspan="10" style="text-align:center;opacity:0.4;padding:24px;">No paid transactions yet.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
        </div>
    </div>

    <!-- AWAITING PAYMENT (informational, not counted in revenue) -->
    <?php if (!empty($unpaidTransactions)): ?>
    <div class="data-card">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;">
            <div class="chart-title" style="margin-bottom:0;color:#ffc107;">
                <i class="fa-solid fa-hourglass-half" style="color:#ffc107;"></i>
                Awaiting Payment
            </div>
            <span style="font-size:0.75rem;color:rgba(255,193,7,0.6);"><?= count($unpaidTransactions) ?> record<?= count($unpaidTransactions) != 1 ? 's' : '' ?></span>
        </div>
        <div class="pending-note">
            <i class="fa-solid fa-triangle-exclamation"></i>
            These bookings have <strong>not yet made any payment</strong> and are <strong>not counted in any revenue figure above</strong>.
            They will appear in sales once payment is confirmed.
        </div>

        <div style="overflow-x:auto;">
        <table class="data-table" id="pendingTable">
            <thead>
                <tr>
                    <th>Booking Code</th>
                    <th>User</th>
                    <th>Activity</th>
                    <th>Date</th>
                    <th>Pax</th>
                    <th>Expected Amount</th>
                    <th>Status</th>
                    <th>Booked On</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($unpaidTransactions as $tx):
                    $sc = match(strtolower($tx['status'])) {
                        'pending'   => 'status-pending',
                        'confirmed' => 'status-confirmed',
                        default     => 'status-pending',
                    };
                ?>
                <tr>
                    <td style="font-size:0.76rem;opacity:0.8;">#<?= esc($tx['booking_code']) ?></td>
                    <td style="font-weight:600;"><?= esc($tx['username'] ?? '—') ?></td>
                    <td><?= esc($tx['all_activities'] ?? $tx['activity_name']) ?></td>
                    <td style="opacity:0.7;"><?= date('M d, Y', strtotime($tx['date'])) ?></td>
                    <td style="text-align:center;"><?= esc($tx['participants']) ?></td>
                    <td style="color:#ffc107;font-weight:700;opacity:0.75;">₱<?= number_format($tx['total_amount'], 2) ?></td>
                    <td><span class="badge-status <?= $sc ?>"><?= ucfirst($tx['status']) ?></span></td>
                    <td style="opacity:0.6;font-size:0.76rem;"><?= date('M d, Y', strtotime($tx['created_at'])) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    </div>
    <?php endif; ?>

</main>

<!-- ════ CHARTS ════ -->
<script>
const salesData = {
    weekly:  { labels: <?= json_encode(array_column($weeklySales,  'label')) ?>, values: <?= json_encode(array_column($weeklySales,  'amount')) ?> },
    monthly: { labels: <?= json_encode(array_column($monthlySales, 'label')) ?>, values: <?= json_encode(array_column($monthlySales, 'amount')) ?> },
    yearly:  { labels: <?= json_encode(array_column($yearlySales,  'label')) ?>, values: <?= json_encode(array_column($yearlySales,  'amount')) ?> },
};

const lineCtx = document.getElementById('lineChart').getContext('2d');
const grad = lineCtx.createLinearGradient(0, 0, 0, 200);
grad.addColorStop(0, 'rgba(72,202,228,0.3)');
grad.addColorStop(1, 'rgba(72,202,228,0)');

const lineChart = new Chart(lineCtx, {
    type: 'line',
    data: {
        labels: salesData.weekly.labels,
        datasets: [{
            label: '₱ Collected',
            data: salesData.weekly.values,
            borderColor: '#48cae4',
            backgroundColor: grad,
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

/* ── Transaction filters ── */
let currentTxFilter = 'all';

function setTxFilter(type, btn) {
    currentTxFilter = type;
    document.querySelectorAll('.tx-filter-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    applyTxFilters();
}

function filterTx() { applyTxFilters(); }

function applyTxFilters() {
    const q = document.getElementById('txSearch').value.toLowerCase().trim();
    document.querySelectorAll('#txTable tbody tr').forEach(row => {
        const matchSearch  = !q || row.dataset.search.includes(q);
        const matchPayType = currentTxFilter === 'all' || row.dataset.paytype === currentTxFilter;
        row.style.display  = (matchSearch && matchPayType) ? '' : 'none';
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
                <div><div class="help-item-title">Dashboard</div><div class="help-item-desc">Overview of total bookings, revenue, and platform activity at a glance.</div></div>
            </div>
            <div class="help-item">
                <div class="help-item-icon"><i class="fa-solid fa-calendar-check"></i></div>
                <div><div class="help-item-title">Bookings</div><div class="help-item-desc">View and manage all customer reservations. Update statuses, verify GCash receipts, and cancel bookings here.</div></div>
            </div>
            <div class="help-item">
                <div class="help-item-icon"><i class="fa-solid fa-users"></i></div>
                <div><div class="help-item-title">Users</div><div class="help-item-desc">Browse all registered accounts, check booking counts, and identify roles.</div></div>
            </div>
        </div>
        <div class="help-section">
            <div class="help-section-title">⚙️ Operations</div>
            <div class="help-item">
                <div class="help-item-icon"><i class="fa-solid fa-tower-broadcast"></i></div>
                <div><div class="help-item-title">Sea Conditions</div><div class="help-item-desc">Post live sea condition updates visible to customers before booking.</div></div>
            </div>
            <div class="help-item">
                <div class="help-item-icon"><i class="fa-solid fa-star"></i></div>
                <div><div class="help-item-title">Reviews</div><div class="help-item-desc">Monitor guest feedback. Remove inappropriate reviews using the delete button.</div></div>
            </div>
        </div>
        <div class="help-section">
            <div class="help-section-title">🛠 System</div>
            <div class="help-item">
                <div class="help-item-icon"><i class="fa-solid fa-person-swimming"></i></div>
                <div><div class="help-item-title">Activities</div><div class="help-item-desc">Add, edit, or remove water activities and manage their pricing.</div></div>
            </div>
            <div class="help-item">
                <div class="help-item-icon"><i class="fa-solid fa-peso-sign"></i></div>
                <div>
                    <div class="help-item-title">Sales</div>
                    <div class="help-item-desc">Revenue is counted only when payment is confirmed — full or partial 50% down payment. Unpaid bookings appear in the "Awaiting Payment" section but do not affect revenue totals.</div>
                </div>
            </div>
        </div>
        <div class="help-tip">
            <strong>💡 Tip:</strong> Go to <strong>Bookings → View</strong> to verify a GCash receipt and mark a booking as paid. Once marked, it will appear in Sales automatically.
        </div>
    </div>
</div>

</body>
</html>