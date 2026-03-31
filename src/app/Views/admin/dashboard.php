<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Waves Admin</title>
    <link rel="stylesheet" href="<?= base_url('bootstrap5/css/bootstrap.min.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --deep-blue: #052c39;
            --ocean-blue: #0a5872;
            --accent-cyan: #48cae4;
            --soft-white: #f4f9fc;
            --sidebar-width: 260px;
        }
        * { box-sizing: border-box; }
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(180deg, var(--accent-cyan) 0%, var(--ocean-blue) 40%, var(--deep-blue) 100%);
            background-attachment: fixed;
            color: var(--soft-white);
            margin: 0;
            min-height: 100vh;
        }
        /* SIDEBAR */
        .sidebar {
            position: fixed;
            top: 0; left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: rgba(5, 44, 57, 0.95);
            backdrop-filter: blur(20px);
            border-right: 1px solid rgba(255,255,255,0.1);
            z-index: 1000;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }
        .sidebar-brand {
            padding: 28px 24px 22px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        .sidebar-brand .brand-icon {
            font-size: 2rem;
            color: var(--accent-cyan);
            margin-bottom: 6px;
        }
        .sidebar-brand .brand-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: white;
            line-height: 1.2;
        }
        .sidebar-brand .brand-sub {
            font-size: 0.7rem;
            color: rgba(255,255,255,0.4);
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .sidebar-section-label {
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: rgba(255,255,255,0.3);
            padding: 18px 24px 6px;
        }
        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 20px;
            margin: 2px 12px;
            border-radius: 12px;
            color: rgba(255,255,255,0.65);
            text-decoration: none;
            font-size: 0.88rem;
            font-weight: 500;
            transition: 0.25s;
            cursor: pointer;
        }
        .nav-item:hover {
            background: rgba(255,255,255,0.08);
            color: var(--accent-cyan);
            text-decoration: none;
        }
        .nav-item.active {
            background: var(--accent-cyan);
            color: var(--deep-blue);
            font-weight: 700;
        }
        .nav-item i { width: 18px; text-align: center; font-size: 0.9rem; }
        .nav-item .badge-count {
            margin-left: auto;
            background: rgba(255,193,7,0.2);
            color: #ffc107;
            border: 1px solid rgba(255,193,7,0.4);
            border-radius: 20px;
            padding: 1px 8px;
            font-size: 0.7rem;
            font-weight: 700;
        }
        .nav-item.active .badge-count {
            background: rgba(5,44,57,0.3);
            color: var(--deep-blue);
            border-color: rgba(5,44,57,0.4);
        }
        .sidebar-footer {
            margin-top: auto;
            padding: 16px 12px;
            border-top: 1px solid rgba(255,255,255,0.08);
        }
        .logout-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 20px;
            border-radius: 12px;
            color: #ff6b6b;
            text-decoration: none;
            font-size: 0.88rem;
            font-weight: 600;
            border: 1px solid rgba(255,107,107,0.25);
            transition: 0.25s;
        }
        .logout-btn:hover {
            background: #ff6b6b;
            color: white;
            text-decoration: none;
        }
        /* MAIN */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 32px 36px;
            min-height: 100vh;
        }
        .page-topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
        }
        .page-title { font-size: 1.6rem; font-weight: 700; color: white; margin: 0; }
        .page-subtitle { font-size: 0.82rem; color: rgba(255,255,255,0.5); margin: 2px 0 0; }
        .admin-pill {
            background: rgba(72,202,228,0.12);
            border: 1px solid rgba(72,202,228,0.3);
            color: var(--accent-cyan);
            border-radius: 50px;
            padding: 6px 18px;
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 1px;
        }
        /* STATS */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin-bottom: 28px;
        }
        .stat-card {
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 20px;
            padding: 24px 22px;
            transition: 0.3s;
        }
        .stat-card:hover { transform: translateY(-4px); border-color: rgba(72,202,228,0.3); }
        .stat-card .stat-icon {
            width: 44px; height: 44px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem;
            margin-bottom: 14px;
        }
        .stat-card .stat-label { font-size: 0.72rem; text-transform: uppercase; letter-spacing: 1.5px; color: rgba(255,255,255,0.5); margin-bottom: 4px; }
        .stat-card .stat-value { font-size: 2rem; font-weight: 700; color: white; line-height: 1; }
        .stat-card .stat-sub { font-size: 0.75rem; color: rgba(255,255,255,0.4); margin-top: 6px; }
        /* PANELS */
        .panels-row { display: grid; grid-template-columns: 1.6fr 1fr; gap: 20px; margin-bottom: 24px; }
        .panel {
            background: rgba(255,255,255,0.07);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 24px;
            padding: 28px;
        }
        .panel-title {
            font-size: 0.82rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: rgba(255,255,255,0.6);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .panel-title i { color: var(--accent-cyan); }
        /* BOOKING ROWS */
        .booking-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }
        .booking-row:last-child { border-bottom: none; }
        .booking-avatar {
            width: 36px; height: 36px;
            border-radius: 50%;
            background: rgba(72,202,228,0.15);
            display: flex; align-items: center; justify-content: center;
            font-size: 0.7rem;
            font-weight: 700;
            color: var(--accent-cyan);
            flex-shrink: 0;
            margin-right: 12px;
        }
        .booking-name { font-size: 0.88rem; font-weight: 600; color: white; }
        .booking-meta { font-size: 0.75rem; color: rgba(255,255,255,0.45); }
        .badge-status { padding: 4px 14px; border-radius: 50px; font-size: 0.72rem; font-weight: 700; white-space: nowrap; }
        .s-pending   { background: rgba(255,193,7,0.12); color: #ffc107; border: 1px solid rgba(255,193,7,0.4); }
        .s-confirmed { background: rgba(40,167,69,0.12); color: #5ddb8a; border: 1px solid rgba(40,167,69,0.4); }
        .s-completed { background: rgba(72,202,228,0.12); color: #48cae4; border: 1px solid rgba(72,202,228,0.4); }
        .s-cancelled { background: rgba(220,53,69,0.12); color: #ff8888; border: 1px solid rgba(220,53,69,0.4); }
        /* SEA DATA */
        .sea-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid rgba(255,255,255,0.06);
            font-size: 0.85rem;
        }
        .sea-row:last-child { border-bottom: none; }
        .sea-label { color: rgba(255,255,255,0.55); display: flex; align-items: center; gap: 8px; }
        .sea-label i { color: var(--accent-cyan); width: 16px; }
        .sea-val { font-weight: 700; color: var(--accent-cyan); }
        .status-safe-pill {
            display: inline-flex; align-items: center; gap: 8px;
            background: rgba(40,167,69,0.15);
            color: #5ddb8a;
            border: 1px solid rgba(40,167,69,0.4);
            border-radius: 50px;
            padding: 8px 18px;
            font-size: 0.8rem;
            font-weight: 700;
            margin-top: 14px;
        }
        /* QUICK ACTIONS */
        .quick-actions { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; margin-bottom: 24px; }
        .qa-btn {
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 16px;
            padding: 20px;
            text-align: center;
            text-decoration: none;
            color: white;
            transition: 0.3s;
            display: block;
        }
        .qa-btn:hover { background: rgba(72,202,228,0.15); border-color: var(--accent-cyan); color: var(--accent-cyan); transform: translateY(-3px); text-decoration: none; }
        .qa-btn i { font-size: 1.5rem; margin-bottom: 8px; display: block; color: var(--accent-cyan); }
        .qa-btn span { font-size: 0.8rem; font-weight: 600; }
        /* VIEW ALL LINK */
        .view-all { color: var(--accent-cyan); font-size: 0.78rem; font-weight: 600; text-decoration: none; margin-top: 14px; display: inline-flex; align-items: center; gap: 4px; }
        .view-all:hover { color: white; text-decoration: none; }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon"><i class="fa-solid fa-anchor"></i></div>
        <div class="brand-title">Waves Admin</div>
        <div class="brand-sub">Control Panel</div>
    </div>

    <div class="sidebar-section-label">Main</div>
    <a href="<?= base_url('admin/dashboard') ?>" class="nav-item active">
        <i class="fa-solid fa-chart-line"></i> Dashboard
    </a>
    <a href="<?= base_url('admin/bookings') ?>" class="nav-item">
        <i class="fa-solid fa-calendar-check"></i> Bookings
        <span class="badge-count">14</span>
    </a>
    <a href="<?= base_url('admin/users') ?>" class="nav-item">
        <i class="fa-solid fa-users"></i> Users
    </a>

    <div class="sidebar-section-label">Operations</div>
    <a href="<?= base_url('admin/sea-conditions') ?>" class="nav-item">
        <i class="fa-solid fa-tower-broadcast"></i> Sea Conditions
    </a>
    <a href="<?= base_url('admin/reviews') ?>" class="nav-item">
        <i class="fa-solid fa-star"></i> Reviews
    </a>

    <div class="sidebar-section-label">System</div>
    <a href="<?= base_url('admin/activities') ?>" class="nav-item">
        <i class="fa-solid fa-person-swimming"></i> Activities
    </a>

    <div class="sidebar-footer">
        <a href="<?= base_url('logout') ?>" class="logout-btn">
            <i class="fa-solid fa-power-off"></i> Logout
        </a>
    </div>
</aside>

<!-- MAIN CONTENT -->
<main class="main-content">

    <div class="page-topbar">
        <div>
            <h1 class="page-title">Dashboard</h1>
            <p class="page-subtitle">Welcome back, <strong><?= auth()->user()->username ?></strong> — here's what's happening today.</p>
        </div>
        <span class="admin-pill"><i class="fa-solid fa-shield-halved me-2"></i>ADMIN PANEL</span>
    </div>

    <!-- STATS -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(72,202,228,0.15); color: var(--accent-cyan);">
                <i class="fa-solid fa-calendar-check"></i>
            </div>
            <div class="stat-label">Total Bookings</div>
            <div class="stat-value"><?= $totalBookings ?? 0 ?></div>
            <div class="stat-sub">All-time reservations</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(40,167,69,0.15); color: #5ddb8a;">
                <i class="fa-solid fa-users"></i>
            </div>
            <div class="stat-label">Registered Users</div>
            <div class="stat-value"><?= $totalUsers ?? 0 ?></div>
            <div class="stat-sub">Active accounts</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(255,193,7,0.15); color: #ffc107;">
                <i class="fa-solid fa-hourglass-half"></i>
            </div>
            <div class="stat-label">Pending</div>
            <div class="stat-value" style="color: #ffc107;"><?= $pendingBookings ?? 0 ?></div>
            <div class="stat-sub">Awaiting approval</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(40,167,69,0.15); color: #5ddb8a;">
                <i class="fa-solid fa-water"></i>
            </div>
            <div class="stat-label">Sea Status</div>
            <div class="stat-value" style="font-size: 1rem; margin-top: 6px; color: #5ddb8a;">🟢 SAFE</div>
            <div class="stat-sub">10 kts · 0.9m waves</div>
        </div>
    </div>

    <!-- QUICK ACTIONS -->
    <div class="quick-actions">
        <a href="<?= base_url('admin/bookings') ?>" class="qa-btn">
            <i class="fa-solid fa-calendar-plus"></i>
            <span>Manage Bookings</span>
        </a>
        <a href="<?= base_url('admin/users') ?>" class="qa-btn">
            <i class="fa-solid fa-user-gear"></i>
            <span>Manage Users</span>
        </a>
        <a href="<?= base_url('admin/sea-conditions') ?>" class="qa-btn">
            <i class="fa-solid fa-tower-broadcast"></i>
            <span>View Sea Data</span>
        </a>
    </div>

    <!-- PANELS ROW -->
    <div class="panels-row">

        <!-- Recent Bookings -->
        <div class="panel">
            <div class="panel-title"><i class="fa-solid fa-clock-rotate-left"></i> Recent Bookings</div>

            <?php if (!empty($recentBookings)): ?>
                <?php foreach ($recentBookings as $b): ?>
                    <?php
                        $initials = strtoupper(substr($b['username'] ?? 'U', 0, 2));
                        $sc = match(strtolower($b['status'])) {
                            'pending'             => 's-pending',
                            'confirmed','approved'=> 's-confirmed',
                            'completed'           => 's-completed',
                            'cancelled'           => 's-cancelled',
                            default               => 's-pending'
                        };
                    ?>
                    <div class="booking-row">
                        <div class="d-flex align-items-center">
                            <div class="booking-avatar"><?= $initials ?></div>
                            <div>
                                <div class="booking-name"><?= esc($b['username'] ?? 'Guest') ?></div>
                                <div class="booking-meta"><?= esc($b['activity_name'] ?? '—') ?> · <?= date('M d, Y', strtotime($b['date'])) ?></div>
                            </div>
                        </div>
                        <span class="badge-status <?= $sc ?>"><?= ucfirst($b['status']) ?></span>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center opacity-50 py-3" style="font-size:0.85rem;">No bookings yet.</p>
            <?php endif; ?>

            <a href="<?= base_url('admin/bookings') ?>" class="view-all">View all bookings <i class="fa-solid fa-chevron-right"></i></a>
        </div>

        <!-- MARISENSE Live -->
        <div class="panel">
            <div class="panel-title"><i class="fa-solid fa-satellite-dish"></i> MARISENSE Live</div>

            <div class="sea-row">
                <span class="sea-label"><i class="fa-solid fa-wind"></i> Wind Speed</span>
                <span class="sea-val">10 knots</span>
            </div>
            <div class="sea-row">
                <span class="sea-label"><i class="fa-solid fa-compass"></i> Direction</span>
                <span class="sea-val">Northeast</span>
            </div>
            <div class="sea-row">
                <span class="sea-label"><i class="fa-solid fa-water"></i> Wave Height</span>
                <span class="sea-val">0.9 m</span>
            </div>
            <div class="sea-row">
                <span class="sea-label"><i class="fa-solid fa-wave-square"></i> Wave Period</span>
                <span class="sea-val">5 sec</span>
            </div>
            <div class="sea-row">
                <span class="sea-label"><i class="fa-solid fa-thermometer-half"></i> Temperature</span>
                <span class="sea-val">28 °C</span>
            </div>

            <div class="status-safe-pill">
                <i class="fa-solid fa-circle-check"></i> SAFE FOR ACTIVITIES
            </div>

            <div class="mt-3">
                <a href="<?= base_url('admin/sea-conditions') ?>" class="view-all">View full report <i class="fa-solid fa-chevron-right"></i></a>
            </div>
        </div>

    </div>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>