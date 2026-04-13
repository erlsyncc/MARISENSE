<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings | Waves Water Sports</title>
    <link rel="stylesheet" href="<?= base_url('bootstrap5/css/bootstrap.min.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --deep-blue: #052c39; --ocean-blue: #0a5872; --accent-cyan: #48cae4; --soft-white: #f4f9fc; }
        body { font-family: 'Poppins', sans-serif; background: linear-gradient(180deg, var(--accent-cyan) 0%, var(--ocean-blue) 40%, var(--deep-blue) 100%); background-attachment: fixed; color: var(--soft-white); margin: 0; min-height: 100vh; }
        /* Navbar Styles */
        .waves-navbar { background: var(--ocean-blue); padding: 35px 0; position: sticky; top: 0; z-index: 1000; box-shadow: 0 4px 20px rgba(0,0,0,0.15); }
        .header-container { display: flex; justify-content: space-between; align-items: center; padding: 0 40px; }
        .user-greeting { color: white; font-size: 1.2rem; font-weight: 400; flex: 1; }
        .nav-menu-center { display: flex; gap: 10px; justify-content: center; flex: 2; }
        .logout-wrapper { flex: 1; display: flex; justify-content: flex-end; gap: 10px; align-items: center; }
        .nav-link-custom { color: rgba(255, 255, 255, 0.8); text-decoration: none; font-size: 1rem; font-weight: 500; padding: 8px 16px; border-radius: 50px; transition: 0.3s; white-space: nowrap; }
        .nav-link-custom:hover { color: var(--accent-cyan); background: rgba(255, 255, 255, 0.1); }
        .nav-link-custom.active { background: var(--accent-cyan); color: var(--deep-blue); font-weight: 600; }
        .btn-logout-custom { color: #ff6b6b; text-decoration: none; font-weight: 600; font-size: 0.85rem; padding: 8px 18px; border: 1px solid rgba(255, 107, 107, 0.3); border-radius: 50px; transition: 0.3s; }
        .btn-logout-custom:hover { background: #ff6b6b; color: white; }

        /* ============================================================
           ADDED: HELP BUTTON STYLE
           ============================================================ */
        .btn-help-custom {
            color: #48cae4;
            font-weight: 600;
            font-size: 0.85rem;
            padding: 8px 18px;
            border: 1px solid rgba(72,202,228,0.5);
            border-radius: 50px;
            background: rgba(72,202,228,0.08);
            cursor: pointer;
            transition: 0.3s;
        }
        .btn-help-custom:hover {
            background: rgba(72,202,228,0.2);
            border-color: var(--accent-cyan);
        }
        /* ============================================================
           ADDED: HELP MODAL STYLES
           ============================================================ */
        #helpModal {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(5,44,57,0.88);
            backdrop-filter: blur(8px);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            animation: fadeInModal 0.25s ease;
        }
        #helpModal.d-none { display: none !important; }
        @keyframes fadeInModal {
            from { opacity: 0; transform: scale(0.96); }
            to   { opacity: 1; transform: scale(1); }
        }
        .help-modal-box {
            background: #0a3d52;
            border: 1px solid rgba(72,202,228,0.35);
            border-radius: 30px;
            padding: 40px;
            max-width: 780px;
            width: 100%;
            box-shadow: 0 30px 60px rgba(0,0,0,0.5);
        }
        .help-modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
        }
        .help-modal-title {
            color: #48cae4;
            font-size: 1.3rem;
            font-weight: 700;
            margin: 0;
        }
        .btn-close-help {
            background: none;
            border: 1px solid rgba(255,255,255,0.25);
            color: white;
            border-radius: 50px;
            padding: 6px 20px;
            cursor: pointer;
            font-size: 0.85rem;
            transition: 0.3s;
        }
        .btn-close-help:hover { background: rgba(255,255,255,0.1); }
        .help-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }
        @media (max-width: 600px) { .help-grid { grid-template-columns: 1fr; } }
        .help-item {
            background: rgba(255,255,255,0.05);
            border-left: 4px solid #48cae4;
            border-radius: 14px;
            padding: 18px 20px;
            transition: 0.3s;
        }
        .help-item:hover { background: rgba(72,202,228,0.08); transform: translateX(4px); }
        .help-item strong {
            color: #48cae4;
            display: block;
            margin-bottom: 8px;
            font-size: 0.92rem;
        }
        .help-item p {
            color: rgba(255,255,255,0.75);
            font-size: 0.85rem;
            margin: 0;
            line-height: 1.6;
        }
        .help-modal-footer {
            margin-top: 28px;
            text-align: center;
            color: rgba(255,255,255,0.4);
            font-size: 0.8rem;
        }
        .welcome-hero {background: linear-gradient(rgba(5, 44, 57, 0.5), rgba(5, 44, 57, 0.7)), url('<?= base_url('images/background.png') ?>'); background-size: cover; background-position: center;background-attachment: fixed;padding: 145px 40px;color: white;border-radius: 0 0 80px 80px;margin-bottom: 60px;}
        .social-icons { display: flex; justify-content: center; gap: 20px; margin-bottom: 20px; }
        .page-container { max-width: 1100px; margin: 0 auto 80px; padding: 0 24px; }
        /* Stats */
        .stats-strip { display: grid; grid-template-columns: repeat(4,1fr); gap: 14px; margin-bottom: 28px; }
        .stat-box { background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.12); border-radius: 18px; padding: 18px; text-align: center; }
        .stat-value { font-size: 1.7rem; font-weight: 700; color: var(--accent-cyan); }
        .stat-label { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1px; color: rgba(255,255,255,0.5); margin-top: 2px; }
        /* Tabs */
        .history-tabs { display: flex; gap: 8px; margin-bottom: 20px; flex-wrap: wrap; }
        .tab-btn { background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); color: rgba(255,255,255,0.7); padding: 8px 20px; border-radius: 50px; font-size: 0.82rem; font-weight: 600; cursor: pointer; transition: 0.2s; }
        .tab-btn:hover, .tab-btn.active { background: var(--accent-cyan); color: var(--deep-blue); border-color: var(--accent-cyan); }
        /* Main container */
        .bookings-panel { background: rgba(255,255,255,0.06); backdrop-filter: blur(15px); border: 1px solid rgba(255,255,255,0.1); border-radius: 24px; padding: 32px; overflow-x: auto; }
        .custom-table { width: 100%; color: white; border-collapse: separate; border-spacing: 0 12px; }
        .custom-table thead th { border: none; text-transform: uppercase; font-size: 0.72rem; letter-spacing: 1px; opacity: 0.6; padding: 8px 18px; white-space: nowrap; }
        .custom-table tbody tr { background: rgba(255,255,255,0.05); transition: 0.2s; }
        .custom-table tbody tr:hover { background: rgba(255,255,255,0.09); transform: translateX(2px); }
        .custom-table td { padding: 16px 18px; vertical-align: middle; border: none; }
        .custom-table td:first-child { border-radius: 16px 0 0 16px; }
        .custom-table td:last-child { border-radius: 0 16px 16px 0; }
        .badge-status { padding: 6px 14px; border-radius: 50px; font-weight: 600; font-size: 0.75rem; border: 1px solid transparent; white-space: nowrap; }
        .status-pending   { background: rgba(255,193,7,0.1); color: #ffc107; border-color: #ffc107; }
        .status-confirmed { background: rgba(40,167,69,0.1); color: #28a745; border-color: #28a745; }
        .status-completed { background: rgba(72,202,228,0.1); color: #48cae4; border-color: #48cae4; }
        .status-cancelled { background: rgba(220,53,69,0.1); color: #dc3545; border-color: #dc3545; }
        .payment-badge { padding: 4px 10px; border-radius: 50px; font-size: 0.7rem; font-weight: 700; }
        .pay-paid   { background: rgba(40,167,69,0.15); color: #5ddb8a; border: 1px solid rgba(40,167,69,0.4); }
        .pay-half   { background: rgba(255,193,7,0.15); color: #ffc107; border: 1px solid rgba(255,193,7,0.4); }
        .pay-unpaid { background: rgba(255,255,255,0.08); color: rgba(255,255,255,0.5); border: 1px solid rgba(255,255,255,0.15); }
        .btn-view-details { background: rgba(72,202,228,0.15); color: var(--accent-cyan); border: 1px solid rgba(72,202,228,0.4); padding: 7px 18px; border-radius: 50px; font-size: 0.8rem; font-weight: 600; cursor: pointer; transition: 0.2s; white-space: nowrap; }
        .btn-view-details:hover { background: var(--accent-cyan); color: var(--deep-blue); transform: translateY(-1px); }
        .activity-icon-wrap { width: 38px; height: 38px; border-radius: 10px; background: rgba(72,202,228,0.12); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .empty-state { text-align: center; padding: 50px 20px; }
        .empty-state i { font-size: 2.5rem; opacity: 0.4; display: block; margin-bottom: 12px; }
        .empty-state p { opacity: 0.5; margin: 0; }
        .search-bar { display: flex; gap: 10px; margin-bottom: 18px; }
        .search-input { background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); border-radius: 50px; color: white; padding: 9px 20px; font-size: 0.82rem; outline: none; min-width: 260px; }
        .search-input::placeholder { color: rgba(255,255,255,0.35); }
        .search-input:focus { border-color: var(--accent-cyan); }
        /* Footer Styles */
        footer { background: var(--deep-blue); padding: 100px 0 40px 0; color: rgba(255, 255, 255, 0.6) !important; border-top: 1px solid rgba(255, 255, 255, 0.1); width: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; }
        .social-icons { display: flex; justify-content: center; gap: 20px; margin-bottom: 25px; }
        .social-icons i { color: rgba(255, 255, 255, 0.7); transition: 0.3s; cursor: pointer; font-size: 1.5rem; }
        .social-icons i:hover { color: var(--accent-cyan); transform: scale(1.2); }
    </style>
</head>
<body>

<nav class="waves-navbar">
    <div class="container header-container">
        <div class="user-greeting"><i class="fa-solid fa-circle-user me-2 text-info"></i> Hi, <span class="fw-bold"><?= auth()->user()->username ?></span></div>
        <div class="nav-menu-center d-none d-lg-flex">
            <a href="<?= base_url('user/home') ?>" class="nav-link-custom">Home</a>
            <a href="<?= base_url('user/activities') ?>" class="nav-link-custom">Activities</a>
            <a href="<?= base_url('user/safety') ?>" class="nav-link-custom">Safety & Sea Conditions</a>
            <a href="<?= base_url('user/booking') ?>" class="nav-link-custom">Book & Reserve</a>
            <a href="<?= base_url('user/my-bookings') ?>" class="nav-link-custom active">My Bookings</a>
            <a href="<?= base_url('user/reviews') ?>" class="nav-link-custom">Reviews</a>
        </div>
        <div class="logout-wrapper">
            <a href="<?= base_url('logout') ?>" class="btn-logout-custom"><i class="fa-solid fa-power-off me-1"></i> Logout</a>
        </div>
    </div>
</nav>

<header class="welcome-hero">
    <div class="container">
        <h1 class="display-5 fw-bold mb-2">My Bookings</h1>
        <p class="lead mb-5 opacity-90 mx-auto" style="max-width: 800px;">
            View all your current and past reservations in one place easily and quickly.
            Track details, payment status, and manage your schedule anytime with full convenience.
        </p>
    </div>
</header>

<div class="page-container">

    <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success rounded-4 mb-4"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger rounded-4 mb-4"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <?php
        $all       = $bookings ?? [];
        $active    = array_filter($all, fn($b) => in_array($b['status'], ['pending','confirmed']));
        $completed = array_filter($all, fn($b) => $b['status'] === 'completed');
        $cancelled = array_filter($all, fn($b) => $b['status'] === 'cancelled');
        $totalSpent = array_sum(array_column(array_filter($all, fn($b) => $b['status'] !== 'cancelled'), 'total_amount'));
    ?>

    <!-- STATS STRIP -->
    <div class="stats-strip">
        <div class="stat-box">
            <div class="stat-value"><?= count($all) ?></div>
            <div class="stat-label">Total Bookings</div>
        </div>
        <div class="stat-box">
            <div class="stat-value" style="color:#ffc107;"><?= count($active) ?></div>
            <div class="stat-label">Active</div>
        </div>
        <div class="stat-box">
            <div class="stat-value" style="color:#5ddb8a;"><?= count($completed) ?></div>
            <div class="stat-label">Completed</div>
        </div>
        <div class="stat-box">
            <div class="stat-value" style="font-size:1.2rem;">₱<?= number_format($totalSpent, 0) ?></div>
            <div class="stat-label">Total Spent</div>
        </div>
    </div>

    <!-- SEARCH + TABS -->
    <div class="search-bar">
        <input type="text" class="search-input" id="searchInput" placeholder="🔍  Search by activity or booking code…" oninput="filterRows()">
    </div>

    <div class="history-tabs">
        <button class="tab-btn active" onclick="filterTab('all',this)">All <span style="opacity:0.6;">(<?= count($all) ?>)</span></button>
        <button class="tab-btn" onclick="filterTab('active',this)">Active <span style="opacity:0.6;">(<?= count($active) ?>)</span></button>
        <button class="tab-btn" onclick="filterTab('completed',this)">Completed <span style="opacity:0.6;">(<?= count($completed) ?>)</span></button>
        <button class="tab-btn" onclick="filterTab('cancelled',this)">Cancelled <span style="opacity:0.6;">(<?= count($cancelled) ?>)</span></button>
    </div>

    <div class="bookings-panel shadow-lg">
        <?php if (!empty($all)): ?>
        <table class="custom-table" id="bookingsTable">
            <thead>
                <tr>
                    <th>Activity</th>
                    <th>Date & Time</th>
                    <th>Participants</th>
                    <th>Contact</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Payment</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($all as $booking): ?>
                <?php
                    $statusClass = match(strtolower($booking['status'])) {
                        'pending'              => 'status-pending',
                        'confirmed','approved' => 'status-confirmed',
                        'completed'            => 'status-completed',
                        'cancelled'            => 'status-cancelled',
                        default                => '',
                    };
                    $tabGroup = match(strtolower($booking['status'])) {
                        'pending','confirmed' => 'active',
                        'completed'           => 'completed',
                        'cancelled'           => 'cancelled',
                        default               => 'all',
                    };
                    $payClass = 'pay-unpaid'; $payText = 'Unpaid';
                    if ($booking['payment_status'] === 'paid') { $payClass = 'pay-paid'; $payText = 'Paid'; }
                    elseif (($booking['down_payment_status'] ?? '') === 'paid') { $payClass = 'pay-half'; $payText = '50% GCash'; }

                    $actIcon = match(strtolower($booking['activity_name'])) {
                        'jet ski'       => 'fa-water',
                        'banana boat'   => 'fa-ship',
                        'kayaking'      => 'fa-sailboat',
                        'flying saucer' => 'fa-circle-radiation',
                        default         => 'fa-person-swimming',
                    };
                ?>
                <tr data-tab="<?= $tabGroup ?>"
                    data-search="<?= strtolower($booking['activity_name'].' '.$booking['booking_code']) ?>">

                    <td>
                        <div class="d-flex align-items-center gap-3">
                            <div class="activity-icon-wrap"><i class="fa-solid <?= $actIcon ?> text-info"></i></div>
                            <div>
                                <div class="fw-bold" style="font-size:0.9rem;"><?= esc($booking['activity_name']) ?></div>
                                <small style="opacity:0.5;font-size:0.72rem;">#<?= esc($booking['booking_code']) ?></small>
                            </div>
                        </div>
                    </td>

                    <td>
                        <div class="fw-bold" style="font-size:0.85rem;"><?= date('M d, Y', strtotime($booking['date'])) ?></div>
                        <small style="color:var(--accent-cyan);font-size:0.75rem;"><?= date('h:i A', strtotime($booking['time'])) ?></small>
                    </td>

                    <td style="font-size:0.88rem;"><?= esc($booking['participants']) ?> person<?= $booking['participants']>1?'s':'' ?></td>

                    <td style="font-size:0.82rem;opacity:0.8;"><?= esc($booking['contact_number'] ?? '—') ?></td>

                    <td>
                        <div class="fw-bold" style="color:var(--accent-cyan);font-size:0.9rem;">₱<?= number_format($booking['total_amount'],2) ?></div>
                        <?php if (!empty($booking['down_payment']) && $booking['down_payment'] > 0): ?>
                        <small style="opacity:0.5;font-size:0.7rem;">Down: ₱<?= number_format($booking['down_payment'],2) ?></small>
                        <?php endif; ?>
                    </td>

                    <td>
                        <span class="badge-status <?= $statusClass ?>">
                            <?= ucfirst($booking['status']) ?>
                        </span>
                    </td>

                    <td>
                        <span class="payment-badge <?= $payClass ?>"><?= $payText ?></span>
                    </td>

                    <td class="text-center">
                        <button class="btn-view-details" onclick="window.location.href='<?= base_url('user/booking-details/'.$booking['id']) ?>'">
                            <i class="fa-solid fa-eye me-1"></i> View
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div id="empty-filter" style="display:none;" class="empty-state">
            <i class="fa-solid fa-filter-circle-xmark"></i>
            <p>No bookings match your filter.</p>
        </div>
        <?php else: ?>
        <div class="empty-state">
            <i class="fa-solid fa-calendar-xmark"></i>
            <p>You have no bookings yet. <a href="<?= base_url('user/booking') ?>" style="color:var(--accent-cyan);">Book an activity now!</a></p>
        </div>
        <?php endif; ?>
    </div>

</div>

<footer class="text-center">
    <div class="container d-flex flex-column align-items-center">
        <div class="footer-inquiry-text mb-4 opacity-75">For inquiries, message us through our social media platforms.</div>
        <div class="social-icons">
            <a href="https://www.facebook.com/profile.php?id=100077368436521" target="_blank" title="Facebook">
                <i class="fa-brands fa-facebook"></i>
            </a>
            <a href="https://instagram.com" target="_blank" title="Instagram">
                <i class="fa-brands fa-instagram"></i>
            </a>
            <a href="https://twitter.com" target="_blank" title="Twitter">
                <i class="fa-brands fa-twitter"></i>
            </a>
        </div>
        <div class="copyright-text opacity-50">&copy; 2026 Waves Water Sports | Tech by <span class="text-info fw-bold">MARISENSE</span></div>
    </div>
</footer>
<!-- ADDED: HELP MODAL -->
<div id="helpModal" class="d-none">
    <div class="help-modal-box">
        <div class="help-modal-header">
            <h5 class="help-modal-title">
                <i class="fa-solid fa-circle-question me-2"></i> System Guide
            </h5>
            <button class="btn-close-help" onclick="document.getElementById('helpModal').classList.add('d-none')">
                <i class="fa-solid fa-xmark me-1"></i> Close
            </button>
        </div>
        <div class="help-grid">
            <div class="help-item">
                <strong><i class="fa-solid fa-house me-2"></i>Home</strong>
                <p>Overview of the whole system — featured activities, live sea conditions powered by MARISENSE, and recent customer reviews at a glance.</p>
            </div>
            <div class="help-item">
                <strong><i class="fa-solid fa-person-swimming me-2"></i>Activities</strong>
                <p>Browse all available water sports — Jet Ski, Banana Boat, Kayaking, and Flying Saucer — with descriptions and pricing info.</p>
            </div>
            <div class="help-item">
                <strong><i class="fa-solid fa-water me-2"></i>Safety & Sea Conditions</strong>
                <p>View real-time MARISENSE data: wind speed, wave height, wave period, and whether activities are currently safe to proceed.</p>
            </div>
            <div class="help-item">
                <strong><i class="fa-solid fa-calendar-check me-2"></i>Book & Reserve</strong>
                <p>Select your preferred activity, pick a date and time slot, and confirm your reservation online before heading to the beach.</p>
            </div>
            <div class="help-item">
                <strong><i class="fa-solid fa-list-check me-2"></i>My Bookings</strong>
                <p>Track all your active and past reservations. View booking status, schedule, and activity details anytime.</p>
            </div>
            <div class="help-item">
                <strong><i class="fa-solid fa-star me-2"></i>Reviews</strong>
                <p>Read honest feedback from fellow adventurers, or leave your own review and rating after completing an activity.</p>
            </div>
        </div>
        <div class="help-modal-footer">
            <i class="fa-solid fa-shield-halved me-1"></i>
            For further assistance, contact us via our social media pages.
        </div>
    </div>
</div>
<!-- END HELP MODAL -->

<script>
    let currentTab = 'all';

    function filterTab(tab, btn) {
        currentTab = tab;
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        filterRows();
    }

    function filterRows() {
        const q = document.getElementById('searchInput').value.toLowerCase();
        const rows = document.querySelectorAll('#bookingsTable tbody tr');
        let visible = 0;
        rows.forEach(row => {
            const matchTab = currentTab === 'all' || row.dataset.tab === currentTab;
            const matchSearch = !q || row.dataset.search.includes(q);
            const show = matchTab && matchSearch;
            row.style.display = show ? '' : 'none';
            if (show) visible++;
        });
        document.getElementById('empty-filter').style.display = visible === 0 ? 'block' : 'none';
    }
</script>
</body>
</html>