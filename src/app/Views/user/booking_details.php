<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Details | Waves Water Sports</title>
    <link rel="stylesheet" href="<?= base_url('bootstrap5/css/bootstrap.min.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --deep-blue: #052c39; --ocean-blue: #0a5872; --accent-cyan: #48cae4; --soft-white: #f4f9fc; }
        body { font-family: 'Poppins', sans-serif; background: linear-gradient(180deg, var(--accent-cyan) 0%, var(--ocean-blue) 40%, var(--deep-blue) 100%); background-attachment: fixed; color: var(--soft-white); margin: 0; min-height: 100vh; }

        /* Navbar */
        .waves-navbar { background: var(--ocean-blue); padding: 35px 0; position: sticky; top: 0; z-index: 1000; box-shadow: 0 4px 20px rgba(0,0,0,0.15); }
        .header-container { display: flex; justify-content: space-between; align-items: center; padding: 0 40px; }
        .user-greeting { color: white; font-size: 1.2rem; font-weight: 400; flex: 1; }
        .nav-menu-center { display: flex; gap: 10px; justify-content: center; flex: 2; }
        .logout-wrapper { flex: 1; display: flex; justify-content: flex-end; }
        .nav-link-custom { color: rgba(255,255,255,0.8); text-decoration: none; font-size: 1rem; font-weight: 500; padding: 8px 16px; border-radius: 50px; transition: 0.3s; white-space: nowrap; }
        .nav-link-custom:hover { color: var(--accent-cyan); background: rgba(255,255,255,0.1); }
        .nav-link-custom.active { background: var(--accent-cyan); color: var(--deep-blue); font-weight: 600; }
        .btn-logout-custom { color: #ff6b6b; text-decoration: none; font-weight: 600; font-size: 0.85rem; padding: 8px 18px; border: 1px solid rgba(255,107,107,0.3); border-radius: 50px; transition: 0.3s; }
        .btn-logout-custom:hover { background: #ff6b6b; color: white; }

        /* Page layout */
        .page-body { max-width: 860px; margin: 60px auto 100px; padding: 0 24px; }

        /* Top breadcrumb */
        .breadcrumb-strip { display: flex; align-items: center; gap: 8px; font-size: 0.8rem; color: rgba(255,255,255,0.5); margin-bottom: 24px; }
        .breadcrumb-strip a { color: var(--accent-cyan); text-decoration: none; }
        .breadcrumb-strip a:hover { text-decoration: underline; }

        /* Main card */
        .details-card { background: rgba(255,255,255,0.08); backdrop-filter: blur(15px); border: 1px solid rgba(255,255,255,0.15); border-radius: 30px; padding: 40px; }

        /* Booking header */
        .booking-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 32px; flex-wrap: wrap; gap: 14px; }
        .booking-code-badge { background: rgba(72,202,228,0.15); border: 1px solid var(--accent-cyan); color: var(--accent-cyan); padding: 6px 18px; border-radius: 50px; font-size: 0.85rem; font-weight: 700; letter-spacing: 1px; }

        /* Section titles inside card */
        .section-label { font-size: 0.68rem; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; color: var(--accent-cyan); margin-bottom: 14px; display: flex; align-items: center; gap: 8px; }
        .section-divider { border: none; border-top: 1px solid rgba(255,255,255,0.08); margin: 24px 0; }

        /* Detail rows */
        .detail-row { display: flex; justify-content: space-between; align-items: center; padding: 13px 0; border-bottom: 1px solid rgba(255,255,255,0.06); font-size: 0.92rem; }
        .detail-row:last-child { border-bottom: none; }
        .detail-label { color: rgba(255,255,255,0.5); font-weight: 500; display: flex; align-items: center; gap: 8px; }
        .detail-value { font-weight: 600; color: white; text-align: right; max-width: 55%; }

        /* Status badges */
        .badge-status { padding: 7px 18px; border-radius: 50px; font-weight: 700; font-size: 0.82rem; display: inline-flex; align-items: center; gap: 6px; }
        .status-pending   { background: rgba(255,193,7,0.15);  color: #ffc107; border: 1px solid rgba(255,193,7,0.5); }
        .status-confirmed { background: rgba(40,167,69,0.15);  color: #5ddb8a; border: 1px solid rgba(40,167,69,0.5); }
        .status-completed { background: rgba(72,202,228,0.15); color: #48cae4; border: 1px solid rgba(72,202,228,0.5); }
        .status-cancelled { background: rgba(220,53,69,0.15);  color: #ff9999; border: 1px solid rgba(220,53,69,0.5); }
        .pay-badge-paid   { background: rgba(40,167,69,0.15);  color: #5ddb8a; border: 1px solid rgba(40,167,69,0.4);  padding: 5px 14px; border-radius: 50px; font-size: 0.78rem; font-weight: 700; }
        .pay-badge-unpaid { background: rgba(255,255,255,0.06);color: rgba(255,255,255,0.5); border: 1px solid rgba(255,255,255,0.15); padding: 5px 14px; border-radius: 50px; font-size: 0.78rem; font-weight: 700; }

        /* Activity breakdown block */
        .activities-block { background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.1); border-radius: 18px; overflow: hidden; }
        .activity-item { display: flex; align-items: center; gap: 16px; padding: 18px 22px; border-bottom: 1px solid rgba(255,255,255,0.06); }
        .activity-item:last-child { border-bottom: none; }
        .act-icon-box { width: 46px; height: 46px; border-radius: 12px; background: rgba(72,202,228,0.12); display: flex; align-items: center; justify-content: center; flex-shrink: 0; color: var(--accent-cyan); font-size: 1.2rem; }
        .act-item-info { flex: 1; }
        .act-item-name { font-weight: 700; font-size: 0.95rem; margin-bottom: 4px; }
        .act-item-tags { display: flex; flex-wrap: wrap; gap: 6px; }
        .act-tag { background: rgba(72,202,228,0.1); border: 1px solid rgba(72,202,228,0.2); color: rgba(255,255,255,0.7); padding: 3px 10px; border-radius: 50px; font-size: 0.7rem; font-weight: 600; }
        .act-tag.gear-tag { background: rgba(255,193,7,0.1); border-color: rgba(255,193,7,0.3); color: #ffc107; }
        .act-item-price { font-weight: 700; color: var(--accent-cyan); font-size: 0.95rem; text-align: right; flex-shrink: 0; }

        /* Total box */
        .total-box { background: linear-gradient(135deg, rgba(10,88,114,0.3), rgba(5,44,57,0.5)); border: 1px solid rgba(72,202,228,0.25); border-radius: 16px; padding: 20px 24px; display: flex; justify-content: space-between; align-items: center; }
        .total-label { font-size: 0.85rem; color: rgba(255,255,255,0.6); font-weight: 600; }
        .total-amount { font-size: 1.8rem; font-weight: 900; color: var(--accent-cyan); }

        /* Payment info block */
        .payment-block { background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.1); border-radius: 16px; padding: 20px 24px; }
        .payment-row { display: flex; justify-content: space-between; align-items: center; font-size: 0.88rem; margin-bottom: 10px; }
        .payment-row:last-child { margin-bottom: 0; }
        .payment-row .p-label { color: rgba(255,255,255,0.5); }
        .payment-row .p-value { font-weight: 700; }

        /* Action buttons */
        .action-row { margin-top: 32px; display: flex; gap: 14px; flex-wrap: wrap; }
        .btn-back { background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); color: white; padding: 12px 28px; border-radius: 50px; text-decoration: none; font-weight: 600; transition: 0.3s; display: inline-flex; align-items: center; gap: 8px; font-size: 0.9rem; }
        .btn-back:hover { background: rgba(255,255,255,0.2); color: white; transform: translateY(-2px); }
        .btn-cancel-booking { background: rgba(220,53,69,0.12); border: 1px solid rgba(220,53,69,0.35); color: #ff9999; padding: 12px 28px; border-radius: 50px; font-weight: 600; cursor: pointer; transition: 0.3s; display: inline-flex; align-items: center; gap: 8px; font-size: 0.9rem; }
        .btn-cancel-booking:hover { background: rgba(220,53,69,0.3); transform: translateY(-2px); box-shadow: 0 6px 18px rgba(220,53,69,0.25); }

        /* Flash alerts */
        .alert-wave-success { background: rgba(40,167,69,0.15); border: 1px solid rgba(40,167,69,0.4); color: #5ddb8a; border-radius: 14px; padding: 14px 18px; margin-bottom: 24px; font-size: 0.9rem; display: flex; align-items: center; gap: 10px; }

        /* Timeline steps */
        .timeline { display: flex; gap: 0; margin-bottom: 28px; }
        .tl-step { flex: 1; text-align: center; position: relative; }
        .tl-step:not(:last-child)::after { content: ''; position: absolute; top: 14px; left: 60%; width: 80%; height: 2px; background: rgba(255,255,255,0.1); }
        .tl-dot { width: 28px; height: 28px; border-radius: 50%; margin: 0 auto 6px; display: flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: 700; border: 2px solid rgba(255,255,255,0.15); color: rgba(255,255,255,0.3); background: rgba(255,255,255,0.05); position: relative; z-index: 1; }
        .tl-dot.done { background: var(--accent-cyan); color: var(--deep-blue); border-color: var(--accent-cyan); }
        .tl-dot.current { background: rgba(72,202,228,0.2); color: var(--accent-cyan); border-color: var(--accent-cyan); }
        .tl-label { font-size: 0.65rem; color: rgba(255,255,255,0.4); font-weight: 600; text-transform: uppercase; letter-spacing: 1px; }
        .tl-label.active { color: var(--accent-cyan); }

        footer { background: var(--deep-blue); padding: 60px 0 30px; color: rgba(255,255,255,0.6); text-align: center; border-top: 1px solid rgba(255,255,255,0.1); }
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
        <div class="logout-wrapper"><a href="<?= base_url('logout') ?>" class="btn-logout-custom"><i class="fa-solid fa-power-off me-1"></i> Logout</a></div>
    </div>
</nav>

<div class="page-body">

    <!-- Breadcrumb -->
    <div class="breadcrumb-strip">
        <a href="<?= base_url('user/my-bookings') ?>"><i class="fa-solid fa-arrow-left me-1"></i> My Bookings</a>
        <span>/</span>
        <span><?= esc($booking['booking_code']) ?></span>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
    <div class="alert-wave-success">
        <i class="fa-solid fa-circle-check"></i>
        <?= session()->getFlashdata('success') ?>
    </div>
    <?php endif; ?>

    <?php
    /* ── helpers ── */
    $status      = strtolower($booking['status']);
    $statusClass = match($status) {
        'pending'              => 'status-pending',
        'confirmed','approved' => 'status-confirmed',
        'completed'            => 'status-completed',
        'cancelled'            => 'status-cancelled',
        default                => '',
    };
    $statusIcon = match($status) {
        'pending'   => 'fa-hourglass-half',
        'confirmed' => 'fa-circle-check',
        'completed' => 'fa-trophy',
        'cancelled' => 'fa-ban',
        default     => 'fa-circle',
    };
    $canCancel = in_array($status, ['pending','confirmed']);

    /* ── parse all_activities ── */
    $allActNames = array_filter(array_map('trim', explode(',', $booking['all_activities'] ?? $booking['activity_name'])));
    if (empty($allActNames)) $allActNames = [$booking['activity_name']];

    /* ── activity icon map ── */
    $iconMap = [
        'jet ski'       => 'fa-water',
        'banana boat'   => 'fa-ship',
        'kayaking'      => 'fa-sailboat',
        'flying saucer' => 'fa-circle-radiation',
    ];

    /* ── pull activity details from DB ── */
    $db = \Config\Database::connect();
    $actRows = [];
    foreach ($allActNames as $an) {
        $row = $db->table('activities')->where('name', trim($an))->get()->getRowArray();
        if ($row) $actRows[trim($an)] = $row;
    }

    /* ── timeline state ── */
    $tlSteps = ['Booked','Confirmed','Completed'];
    $tlIndex  = match($status) { 'pending'=>0,'confirmed'=>1,'completed'=>2,default=>-1 };

    /* ── time display ── */
    $startTs = strtotime($booking['time']);
    $endTs   = $startTs + 3600;
    $timeDisplay = date('h:i A', $startTs) . ' – ' . date('h:i A', $endTs);
    ?>

    <div class="details-card shadow-lg">

        <!-- Header -->
        <div class="booking-header">
            <div>
                <h2 class="fw-bold mb-1" style="font-size:1.6rem;">
                    <?= esc(count($allActNames) > 1 ? implode(' + ', $allActNames) : $booking['activity_name']) ?>
                </h2>
                <p style="opacity:0.5;font-size:0.85rem;margin:0;">Matabungkay Beach · Waves Water Sports</p>
            </div>
            <span class="booking-code-badge"><i class="fa-solid fa-barcode me-1"></i> <?= esc($booking['booking_code']) ?></span>
        </div>

        <!-- Status Timeline (skip if cancelled) -->
        <?php if ($status !== 'cancelled'): ?>
        <div class="timeline mb-4">
            <?php foreach ($tlSteps as $i => $step): ?>
            <div class="tl-step">
                <div class="tl-dot <?= $i < $tlIndex ? 'done' : ($i === $tlIndex ? 'current' : '') ?>">
                    <?= $i < $tlIndex ? '<i class="fa-solid fa-check"></i>' : ($i + 1) ?>
                </div>
                <div class="tl-label <?= $i <= $tlIndex ? 'active' : '' ?>"><?= $step ?></div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Status + Booking Info -->
        <div class="section-label"><i class="fa-solid fa-circle-info"></i> Booking Information</div>

        <div class="detail-row">
            <span class="detail-label"><i class="fa-solid fa-circle-check text-info"></i> Status</span>
            <span class="detail-value">
                <span class="badge-status <?= $statusClass ?>">
                    <i class="fa-solid <?= $statusIcon ?>"></i> <?= ucfirst($booking['status']) ?>
                </span>
            </span>
        </div>
        <div class="detail-row">
            <span class="detail-label"><i class="fa-regular fa-calendar text-info"></i> Date</span>
            <span class="detail-value"><?= date('l, F d, Y', strtotime($booking['date'])) ?></span>
        </div>
        <div class="detail-row">
            <span class="detail-label"><i class="fa-regular fa-clock text-info"></i> Time Slot</span>
            <span class="detail-value"><?= $timeDisplay ?></span>
        </div>
        <div class="detail-row">
            <span class="detail-label"><i class="fa-solid fa-users text-info"></i> Total Participants</span>
            <span class="detail-value"><?= esc($booking['participants']) ?> person<?= $booking['participants'] > 1 ? 's' : '' ?></span>
        </div>
        <div class="detail-row">
            <span class="detail-label"><i class="fa-solid fa-phone text-info"></i> Contact Number</span>
            <span class="detail-value"><?= !empty($booking['contact_number']) ? esc($booking['contact_number']) : '<span style="opacity:0.4;">—</span>' ?></span>
        </div>
        <?php if (!empty($booking['special_requests'])): ?>
        <div class="detail-row">
            <span class="detail-label"><i class="fa-solid fa-note-sticky text-info"></i> Special Requests</span>
            <span class="detail-value" style="max-width:55%;font-style:italic;opacity:0.85;"><?= esc($booking['special_requests']) ?></span>
        </div>
        <?php endif; ?>
        <div class="detail-row">
            <span class="detail-label"><i class="fa-regular fa-calendar-plus text-info"></i> Booked On</span>
            <span class="detail-value"><?= date('M d, Y h:i A', strtotime($booking['created_at'])) ?></span>
        </div>

        <hr class="section-divider">

        <!-- Activities Breakdown -->
        <div class="section-label"><i class="fa-solid fa-person-swimming"></i> 
            <?= count($allActNames) > 1 ? 'Activities Breakdown' : 'Activity Details' ?>
        </div>

        <div class="activities-block mb-4">
            <?php foreach ($allActNames as $actName):
                $actName = trim($actName);
                $row     = $actRows[$actName] ?? null;
                $aKey    = strtolower($actName);
                $icon    = $iconMap[$aKey] ?? 'fa-person-swimming';
                $dur     = $row ? (int)$row['duration'] : 0;
                $max     = $row ? esc($row['max_riders']) : '—';
                $diff    = $row ? esc($row['difficulty']) : '—';
                $gear    = $row ? esc($row['gear'] ?? '') : '';
                $price   = $row ? (float)$row['price'] : 0;
                $pp      = $row && ($row['price_type'] ?? 'flat') === 'per_person';
                $desc    = $row ? esc($row['description'] ?? '') : '';
            ?>
            <div class="activity-item">
                <div class="act-icon-box"><i class="fa-solid <?= $icon ?>"></i></div>
                <div class="act-item-info">
                    <div class="act-item-name"><?= esc($actName) ?></div>
                    <?php if ($desc): ?>
                    <div style="font-size:0.78rem;color:rgba(255,255,255,0.5);margin-bottom:8px;"><?= $desc ?></div>
                    <?php endif; ?>
                    <div class="act-item-tags">
                        <?php if ($dur): ?><span class="act-tag"><i class="fa-solid fa-clock me-1"></i><?= $dur ?> mins</span><?php endif; ?>
                        <?php if ($max !== '—'): ?><span class="act-tag"><i class="fa-solid fa-users me-1"></i>Max <?= $max ?></span><?php endif; ?>
                        <?php if ($diff !== '—'): ?><span class="act-tag"><i class="fa-solid fa-gauge-high me-1"></i><?= $diff ?></span><?php endif; ?>
                        <?php if ($gear): ?><span class="act-tag gear-tag"><i class="fa-solid fa-vest me-1"></i><?= $gear ?></span><?php endif; ?>
                        <?php if ($pp): ?><span class="act-tag" style="color:#ffc107;border-color:rgba(255,193,7,0.3);">Per Person</span><?php endif; ?>
                    </div>
                </div>
                <div class="act-item-price">
                    ₱<?= number_format($price, 2) ?><?= $pp ? '<br><small style="font-size:0.7rem;font-weight:400;opacity:0.6;">/person</small>' : '' ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Total -->
        <div class="total-box mb-4">
            <div>
                <div class="total-label">Total Booking Amount</div>
                <div style="font-size:0.75rem;color:rgba(255,255,255,0.35);margin-top:3px;">
                    <?= count($allActNames) ?> activit<?= count($allActNames) > 1 ? 'ies' : 'y' ?> · <?= esc($booking['participants']) ?> participant<?= $booking['participants'] > 1 ? 's' : '' ?>
                </div>
            </div>
            <div class="total-amount">₱<?= number_format($booking['total_amount'], 2) ?></div>
        </div>

        <hr class="section-divider">

        <!-- Payment Details -->
        <div class="section-label"><i class="fa-solid fa-credit-card"></i> Payment Details</div>
        <div class="payment-block">
            <div class="payment-row">
                <span class="p-label">Payment Status</span>
                <span class="p-value">
                    <?php if ($booking['payment_status'] === 'paid'): ?>
                        <span class="pay-badge-paid"><i class="fa-solid fa-check me-1"></i> Fully Paid</span>
                    <?php elseif (($booking['down_payment_status'] ?? '') === 'paid'): ?>
                        <span class="pay-badge-paid" style="background:rgba(255,193,7,0.15);color:#ffc107;border-color:rgba(255,193,7,0.4);">
                            <i class="fa-solid fa-circle-half-stroke me-1"></i> 50% Paid
                        </span>
                    <?php else: ?>
                        <span class="pay-badge-unpaid"><i class="fa-solid fa-hourglass me-1"></i> Unpaid</span>
                    <?php endif; ?>
                </span>
            </div>
            <?php if (!empty($booking['down_payment']) && $booking['down_payment'] > 0): ?>
            <div class="payment-row">
                <span class="p-label">Down Payment</span>
                <span class="p-value" style="color:var(--accent-cyan);">₱<?= number_format($booking['down_payment'], 2) ?></span>
            </div>
            <?php if (!empty($booking['down_payment_paid_at'])): ?>
            <div class="payment-row">
                <span class="p-label">Down Payment Date</span>
                <span class="p-value" style="opacity:0.7;"><?= date('M d, Y h:i A', strtotime($booking['down_payment_paid_at'])) ?></span>
            </div>
            <?php endif; ?>
            <div class="payment-row">
                <span class="p-label">Remaining Balance</span>
                <span class="p-value" style="color:#ffc107;">
                    ₱<?= number_format($booking['total_amount'] - $booking['down_payment'], 2) ?>
                </span>
            </div>
            <?php endif; ?>
            <?php if ($booking['payment_status'] !== 'paid' && $status !== 'cancelled'): ?>
            <div class="payment-row" style="margin-top:12px;padding-top:12px;border-top:1px solid rgba(255,255,255,0.06);">
                <span class="p-label" style="font-size:0.78rem;opacity:0.6;">
                    <i class="fa-solid fa-circle-info me-1"></i>
                    Go to <strong>My Bookings</strong> to pay via GCash (50% down or full).
                </span>
            </div>
            <?php endif; ?>
        </div>

        <!-- Action Buttons -->
        <div class="action-row">
            <a href="<?= base_url('user/my-bookings') ?>" class="btn-back">
                <i class="fa-solid fa-arrow-left"></i> Back to My Bookings
            </a>
            <?php if ($canCancel): ?>
            <form action="<?= base_url('user/booking/cancel/' . $booking['id']) ?>" method="POST"
                  onsubmit="return confirm('Are you sure you want to cancel this booking? This action cannot be undone.');">
                <?= csrf_field() ?>
                <button type="submit" class="btn-cancel-booking">
                    <i class="fa-solid fa-xmark"></i> Cancel Booking
                </button>
            </form>
            <?php endif; ?>
            <?php if (!in_array($status, ['cancelled','completed'])): ?>
            <a href="<?= base_url('user/booking?activity=' . urlencode($booking['activity_name'])) ?>" class="btn-back" style="background:rgba(72,202,228,0.12);border-color:rgba(72,202,228,0.3);color:var(--accent-cyan);">
                <i class="fa-solid fa-plus"></i> Book Again
            </a>
            <?php endif; ?>
        </div>

    </div><!-- /details-card -->
</div>

<footer>
    <div class="copyright-text opacity-50">&copy; 2026 Waves Water Sports | Tech by <span class="text-info fw-bold">MARISENSE</span></div>
</footer>

</body>
</html>