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
        body { font-family: 'Poppins', sans-serif; background: linear-gradient(180deg, var(--ocean-blue) 0%, var(--deep-blue) 100%); background-attachment: fixed; color: var(--soft-white); margin: 0; min-height: 100vh; }

        /* ── Navbar ── */
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

        /* ── Page layout ── */
        .page-body { max-width: 820px; margin: 50px auto 100px; padding: 0 24px; }

        .breadcrumb-strip { display: flex; align-items: center; gap: 8px; font-size: 0.8rem; color: rgba(255,255,255,0.5); margin-bottom: 22px; }
        .breadcrumb-strip a { color: var(--accent-cyan); text-decoration: none; }
        .breadcrumb-strip a:hover { text-decoration: underline; }

        /* ── Main card ── */
        .details-card { background: rgba(255,255,255,0.08); backdrop-filter: blur(15px); border: 1px solid rgba(255,255,255,0.15); border-radius: 28px; padding: 38px; }

        /* ── Booking header ── */
        .booking-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 28px; flex-wrap: wrap; gap: 14px; }
        .booking-header-title { font-size: 1.55rem; font-weight: 700; margin: 0 0 4px; line-height: 1.3; }
        .booking-header-sub { font-size: 0.82rem; color: rgba(255,255,255,0.45); margin: 0; }
        .booking-code-badge { background: rgba(72,202,228,0.12); border: 1px solid var(--accent-cyan); color: var(--accent-cyan); padding: 6px 18px; border-radius: 50px; font-size: 0.82rem; font-weight: 700; letter-spacing: 1px; white-space: nowrap; }

        /* ── Timeline ── */
        .timeline { display: flex; margin-bottom: 30px; }
        .tl-step { flex: 1; text-align: center; position: relative; }
        .tl-step:not(:last-child)::after { content: ''; position: absolute; top: 13px; left: 60%; width: 80%; height: 2px; background: rgba(255,255,255,0.1); }
        .tl-dot { width: 28px; height: 28px; border-radius: 50%; margin: 0 auto 6px; display: flex; align-items: center; justify-content: center; font-size: 0.72rem; font-weight: 700; border: 2px solid rgba(255,255,255,0.15); color: rgba(255,255,255,0.3); background: rgba(255,255,255,0.05); position: relative; z-index: 1; }
        .tl-dot.done    { background: var(--accent-cyan); color: var(--deep-blue); border-color: var(--accent-cyan); }
        .tl-dot.current { background: rgba(72,202,228,0.18); color: var(--accent-cyan); border-color: var(--accent-cyan); }
        .tl-label { font-size: 0.63rem; color: rgba(255,255,255,0.38); font-weight: 600; text-transform: uppercase; letter-spacing: 1px; }
        .tl-label.active { color: var(--accent-cyan); }

        /* ── Section label ── */
        .section-label { font-size: 0.66rem; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; color: var(--accent-cyan); margin-bottom: 14px; display: flex; align-items: center; gap: 8px; }
        .section-divider { border: none; border-top: 1px solid rgba(255,255,255,0.08); margin: 26px 0; }

        /* ── Status badges ── */
        .badge-status { padding: 6px 16px; border-radius: 50px; font-weight: 700; font-size: 0.78rem; display: inline-flex; align-items: center; gap: 5px; }
        .status-pending   { background: rgba(255,193,7,0.12);  color: #ffc107; border: 1px solid rgba(255,193,7,0.45); }
        .status-confirmed { background: rgba(40,167,69,0.12);  color: #5ddb8a; border: 1px solid rgba(40,167,69,0.45); }
        .status-completed { background: rgba(72,202,228,0.12); color: #48cae4; border: 1px solid rgba(72,202,228,0.45); }
        .status-cancelled { background: rgba(220,53,69,0.12);  color: #ff9999; border: 1px solid rgba(220,53,69,0.45); }

        /* ── Cost summary table ── */
        .cost-table { background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.09); border-radius: 16px; overflow: hidden; margin-bottom: 22px; }
        .cost-table-header { padding: 10px 18px; background: rgba(72,202,228,0.07); font-size: 0.63rem; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; color: var(--accent-cyan); border-bottom: 1px solid rgba(72,202,228,0.12); }
        .cost-row { display: flex; justify-content: space-between; align-items: center; padding: 13px 18px; border-bottom: 1px solid rgba(255,255,255,0.05); font-size: 0.88rem; }
        .cost-row:last-child { border-bottom: none; }
        .cost-row-label { display: flex; align-items: center; gap: 9px; color: rgba(255,255,255,0.8); font-weight: 500; }
        .cost-row-label i { color: var(--accent-cyan); width: 16px; text-align: center; font-size: 0.8rem; }
        .cost-row-formula { font-size: 0.74rem; color: rgba(255,255,255,0.35); margin-left: 4px; font-style: italic; }
        .cost-row-amount { font-weight: 700; color: var(--accent-cyan); }
        .cost-total-row { display: flex; justify-content: space-between; align-items: center; padding: 14px 18px; background: rgba(72,202,228,0.08); border-top: 2px solid rgba(72,202,228,0.22); }
        .cost-total-label { font-size: 0.88rem; font-weight: 700; color: var(--accent-cyan); }
        .cost-total-meta { font-size: 0.7rem; font-weight: 400; opacity: 0.55; margin-left: 8px; }
        .cost-total-amount { font-size: 1.35rem; font-weight: 900; color: var(--accent-cyan); }

        /* ── Payment block ── */
        .payment-block { background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.09); border-radius: 16px; padding: 20px 22px; margin-bottom: 22px; }
        .payment-row { display: flex; justify-content: space-between; align-items: center; font-size: 0.88rem; padding: 7px 0; border-bottom: 1px solid rgba(255,255,255,0.05); }
        .payment-row:last-child { border-bottom: none; }
        .payment-row .p-label { color: rgba(255,255,255,0.5); display: flex; align-items: center; gap: 7px; }
        .payment-row .p-label i { color: var(--accent-cyan); width: 15px; text-align: center; font-size: 0.8rem; }
        .payment-row .p-value { font-weight: 700; }
        .pay-badge-paid   { background: rgba(40,167,69,0.14);  color: #5ddb8a; border: 1px solid rgba(40,167,69,0.4);  padding: 5px 14px; border-radius: 50px; font-size: 0.76rem; font-weight: 700; }
        .pay-badge-half   { background: rgba(255,193,7,0.12);  color: #ffc107; border: 1px solid rgba(255,193,7,0.4);  padding: 5px 14px; border-radius: 50px; font-size: 0.76rem; font-weight: 700; }
        .pay-badge-unpaid { background: rgba(255,255,255,0.06); color: rgba(255,255,255,0.45); border: 1px solid rgba(255,255,255,0.14); padding: 5px 14px; border-radius: 50px; font-size: 0.76rem; font-weight: 700; }
        .pay-instruction { background: rgba(72,202,228,0.05); border: 1px solid rgba(72,202,228,0.15); border-radius: 10px; padding: 11px 16px; margin-top: 14px; font-size: 0.78rem; color: rgba(255,255,255,0.55); line-height: 1.7; }
        .pay-instruction strong { color: var(--accent-cyan); }

        /* ── Action buttons ── */
        .action-row { display: flex; gap: 12px; flex-wrap: wrap; margin-top: 6px; }
        .btn-back { background: rgba(255,255,255,0.09); border: 1px solid rgba(255,255,255,0.2); color: white; padding: 11px 26px; border-radius: 50px; text-decoration: none; font-weight: 600; transition: 0.3s; display: inline-flex; align-items: center; gap: 8px; font-size: 0.88rem; }
        .btn-back:hover { background: rgba(255,255,255,0.18); color: white; transform: translateY(-2px); }
        .btn-cancel-booking { background: rgba(220,53,69,0.1); border: 1px solid rgba(220,53,69,0.32); color: #ff9999; padding: 11px 26px; border-radius: 50px; font-weight: 600; cursor: pointer; transition: 0.3s; display: inline-flex; align-items: center; gap: 8px; font-size: 0.88rem; }
        .btn-cancel-booking:hover { background: rgba(220,53,69,0.28); transform: translateY(-2px); box-shadow: 0 6px 18px rgba(220,53,69,0.2); }
        .btn-pay-detail { background: rgba(40,167,69,0.1); border: 1px solid rgba(40,167,69,0.32); color: #5ddb8a; padding: 11px 26px; border-radius: 50px; font-weight: 600; cursor: pointer; transition: 0.3s; display: inline-flex; align-items: center; gap: 8px; font-size: 0.88rem; }
        .btn-pay-detail:hover { background: rgba(40,167,69,0.28); transform: translateY(-2px); }

        /* ── Payment Modal ── */
        #payModal { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(5,44,57,0.92); backdrop-filter: blur(10px); z-index: 9999; display: flex; align-items: center; justify-content: center; padding: 20px; animation: fadeInModal 0.25s ease; }
        #payModal.d-none { display: none !important; }
        @keyframes fadeInModal { from { opacity: 0; transform: scale(0.96); } to { opacity: 1; transform: scale(1); } }
        .pay-modal-box { background: #0a3d52; border: 1px solid rgba(72,202,228,0.35); border-radius: 28px; padding: 36px; max-width: 520px; width: 100%; box-shadow: 0 30px 60px rgba(0,0,0,0.5); }
        .pay-modal-title { color: #48cae4; font-size: 1.2rem; font-weight: 700; margin-bottom: 2px; }
        .pay-modal-subtitle { color: rgba(255,255,255,0.5); font-size: 0.82rem; margin-bottom: 22px; }
        .pay-opt-row { display: flex; gap: 10px; margin-bottom: 18px; }
        .pay-opt { flex: 1; border: 1px solid rgba(255,255,255,0.15); border-radius: 14px; padding: 14px; text-align: center; cursor: pointer; transition: 0.2s; font-size: 0.85rem; font-weight: 600; color: rgba(255,255,255,0.6); background: rgba(255,255,255,0.04); }
        .pay-opt:hover { border-color: var(--accent-cyan); }
        .pay-opt.selected { background: rgba(72,202,228,0.15); color: #48cae4; border-color: var(--accent-cyan); }
        .pay-amount-box { background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 12px; padding: 14px 18px; margin-bottom: 16px; display: flex; justify-content: space-between; align-items: center; }
        .pay-amount-label { font-size: 0.75rem; color: rgba(255,255,255,0.5); text-transform: uppercase; letter-spacing: 1px; }
        .pay-amount-value { font-size: 1.4rem; font-weight: 900; color: #48cae4; }
        .gcash-info-box { background: rgba(72,202,228,0.06); border: 1px solid rgba(72,202,228,0.2); border-radius: 12px; padding: 14px; margin-bottom: 14px; text-align: center; }
        .gcash-num { font-size: 1.05rem; font-weight: 700; color: #0077B6; letter-spacing: 1px; }
        .pay-field-label { font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: #48cae4; margin-bottom: 6px; display: block; }
        .pay-file-input { width: 100%; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.15); border-radius: 10px; color: white; padding: 9px 12px; font-size: 0.82rem; font-family: 'Poppins',sans-serif; }
        .pay-text-input { width: 100%; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.15); border-radius: 10px; color: white; padding: 9px 12px; font-size: 0.82rem; font-family: 'Poppins',sans-serif; outline: none; }
        .pay-text-input::placeholder { color: rgba(255,255,255,0.3); }
        .pay-note { font-size: 0.72rem; color: rgba(255,255,255,0.4); margin-top: 4px; }
        .btn-confirm-pay { display: block; width: 100%; padding: 13px; background: linear-gradient(135deg,#0a5872,#052c39); color: white; border: none; border-radius: 12px; font-size: 0.92rem; font-weight: 700; cursor: pointer; transition: 0.3s; margin-top: 18px; }
        .btn-confirm-pay:hover { background: linear-gradient(135deg,#48cae4,#0a5872); color: var(--deep-blue); }
        .btn-close-pay { background: none; border: 1px solid rgba(255,255,255,0.2); color: rgba(255,255,255,0.6); border-radius: 50px; padding: 6px 18px; cursor: pointer; font-size: 0.82rem; transition: 0.3s; }
        .btn-close-pay:hover { background: rgba(255,255,255,0.1); color: white; }

        footer { background: var(--deep-blue); padding: 60px 0 30px; color: rgba(255,255,255,0.6); text-align: center; border-top: 1px solid rgba(255,255,255,0.1); }

        /* ── CENTER TOAST NOTIFICATION ── */
        @keyframes toastIn  { from { opacity:0; transform:scale(0.7); } to { opacity:1; transform:scale(1); } }
        @keyframes toastOut { from { opacity:1; transform:scale(1); } to { opacity:0; transform:scale(0.85); } }
        .center-toast-wrap { position: fixed; top: 0; left: 0; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; z-index: 99999; pointer-events: none; }
        .center-toast-box { border-radius: 20px; padding: 22px 36px; font-family: 'Poppins', sans-serif; font-size: 1rem; font-weight: 600; display: flex; align-items: center; gap: 14px; box-shadow: 0 20px 60px rgba(0,0,0,0.6); max-width: 480px; text-align: center; pointer-events: auto; animation: toastIn 0.35s cubic-bezier(0.34,1.56,0.64,1) both, toastOut 0.4s ease 2.8s both; }
        .center-toast-box.toast-success { background: rgba(13,50,38,0.97); border: 1px solid rgba(40,167,69,0.6); color: #5ddb8a; }
        .center-toast-box.toast-error   { background: rgba(50,13,13,0.97);  border: 1px solid rgba(220,53,69,0.6);  color: #ff8888; }
        .center-toast-box i { font-size: 1.4rem; }
    </style>
</head>
<body>

<!-- ════ CENTER TOAST (flash messages) ════ -->
<?php
$flashSuccess = session()->getFlashdata('success');
$flashError   = session()->getFlashdata('error');
?>
<?php if ($flashSuccess || $flashError): ?>
<div class="center-toast-wrap" id="centerToast">
    <div class="center-toast-box <?= $flashSuccess ? 'toast-success' : 'toast-error' ?>">
        <i class="fa-solid <?= $flashSuccess ? 'fa-circle-check' : 'fa-circle-xmark' ?>"></i>
        <?= esc($flashSuccess ?? $flashError) ?>
    </div>
</div>
<script>setTimeout(() => { const t = document.getElementById('centerToast'); if (t) t.remove(); }, 3300);</script>
<?php endif; ?>

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

    <div class="breadcrumb-strip">
        <a href="<?= base_url('user/my-bookings') ?>"><i class="fa-solid fa-arrow-left me-1"></i> My Bookings</a>
        <span>/</span>
        <span><?= esc($booking['booking_code']) ?></span>
    </div>

    <?php
    /* ── icon map ── */
    $iconMap = [
        'jet ski'       => 'fa-water',
        'banana boat'   => 'fa-ship',
        'kayaking'      => 'fa-sailboat',
        'flying saucer' => 'fa-circle-radiation',
    ];

    /* ── status helpers ── */
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
    $canPay    = in_array($status, ['pending','confirmed']) && $booking['payment_status'] !== 'paid';

    /* ── parse activity list ── */
    $allActNames = array_values(array_filter(array_map('trim', explode(',', $booking['all_activities'] ?? $booking['activity_name']))));
    if (empty($allActNames)) $allActNames = [$booking['activity_name']];
    $isMulti = count($allActNames) > 1;

    /* ── fetch activity rows ── */
    $db      = \Config\Database::connect();
    $actRows = [];
    foreach ($allActNames as $an) {
        $row = $db->table('activities')->where('name', trim($an))->get()->getRowArray();
        if ($row) $actRows[trim($an)] = $row;
    }

    /* ── participants per activity ── */
    $ppaMap = [];
    if (!empty($booking['participants_per_activity'])) {
        $decoded = json_decode($booking['participants_per_activity'], true);
        if (is_array($decoded)) $ppaMap = $decoded;
    }
    if (empty($ppaMap)) {
        $totalPax  = (int)$booking['participants'];
        $perAct    = (int)floor($totalPax / max(count($allActNames), 1));
        $remainder = $totalPax % max(count($allActNames), 1);
        foreach ($allActNames as $idx => $an) {
            $ppaMap[trim($an)] = $perAct + ($idx === 0 ? $remainder : 0);
        }
    }

    /* ── compute line totals ── */
    $lineItems     = [];
    $computedTotal = 0.0;
    foreach ($allActNames as $an) {
        $an    = trim($an);
        $pax   = (int)($ppaMap[$an] ?? 0);
        $row   = $actRows[$an] ?? null;
        $price = $row ? (float)$row['price'] : 0;
        $type  = $row ? ($row['price_type'] ?? 'flat') : 'flat';
        $lineT = ($type === 'per_person') ? $price * $pax : $price;
        $lineItems[$an] = [
            'price'      => $price,
            'price_type' => $type,
            'pax'        => $pax,
            'line_total' => $lineT,
        ];
        $computedTotal += $lineT;
    }

    $displayTotal      = ($computedTotal > 0) ? $computedTotal : (float)$booking['total_amount'];
    $totalParticipants = array_sum($ppaMap);

    /* ── timeline ── */
    $tlSteps = ['Booked', 'Paid', 'Confirmed', 'Completed'];

    $isPaid = ($booking['payment_status'] === 'paid')
           || (($booking['down_payment_status'] ?? '') === 'paid');

    $tlIndex = match(true) {
        $status === 'completed'                      => 3,
        in_array($status, ['confirmed','approved'])  => 2,
        $isPaid                                      => 1,
        default                                      => 0,
    };

    /* ── time display ── */
    $startTs     = strtotime($booking['time']);
    $timeDisplay = date('h:i A', $startTs) . ' – ' . date('h:i A', $startTs + 3600);

    $displayTitle = $isMulti ? implode(' + ', $allActNames) : $booking['activity_name'];
    ?>

    <div class="details-card shadow-lg">

        <!-- Booking Header -->
        <div class="booking-header">
            <div>
                <h2 class="booking-header-title"><?= esc($displayTitle) ?></h2>
                <p class="booking-header-sub">
                    <i class="fa-solid fa-location-dot me-1"></i> Matabungkay Beach &middot; Waves Water Sports
                </p>
                <div style="margin-top:10px;">
                    <span class="badge-status <?= $statusClass ?>">
                        <i class="fa-solid <?= $statusIcon ?>"></i> <?= ucfirst($booking['status']) ?>
                    </span>
                </div>
            </div>
            <span class="booking-code-badge">
                <i class="fa-solid fa-barcode me-1"></i> <?= esc($booking['booking_code']) ?>
            </span>
        </div>

        <!-- Booking Progress Timeline (hidden when cancelled) -->
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

        <!-- Cost Summary -->
        <div class="section-label"><i class="fa-solid fa-receipt"></i> Cost Summary</div>
        <div class="cost-table">
            <div class="cost-table-header">
                <i class="fa-solid fa-calculator me-1"></i>
                <?= count($allActNames) ?> Activit<?= count($allActNames) > 1 ? 'ies' : 'y' ?>
                &middot; <?= $totalParticipants ?> Participant<?= $totalParticipants != 1 ? 's' : '' ?>
            </div>
            <?php foreach ($allActNames as $an):
                $an    = trim($an);
                $aKey  = strtolower($an);
                $icon  = $iconMap[$aKey] ?? 'fa-person-swimming';
                $line  = $lineItems[$an];
                $pp    = ($line['price_type'] === 'per_person');
                $price = $line['price'];
                $pax   = $line['pax'];
                $lineT = $line['line_total'];
            ?>
            <div class="cost-row">
                <div class="cost-row-label">
                    <i class="fa-solid <?= $icon ?>"></i>
                    <?= esc($an) ?>
                    <?php if ($pp && $price > 0): ?>
                        <span class="cost-row-formula">₱<?= number_format($price, 0) ?>/person &times; <?= $pax ?> person<?= $pax != 1 ? 's' : '' ?></span>
                    <?php elseif ($price > 0): ?>
                        <span class="cost-row-formula">flat rate &middot; <?= $pax ?> person<?= $pax != 1 ? 's' : '' ?></span>
                    <?php endif; ?>
                </div>
                <div class="cost-row-amount">₱<?= number_format($lineT, 2) ?></div>
            </div>
            <?php endforeach; ?>
            <div class="cost-total-row">
                <span class="cost-total-label">
                    <i class="fa-solid fa-equals me-1"></i> Total Amount
                    <span class="cost-total-meta">
                        <?= count($allActNames) ?> activit<?= count($allActNames) > 1 ? 'ies' : 'y' ?>
                        &middot; <?= $totalParticipants ?> participant<?= $totalParticipants != 1 ? 's' : '' ?>
                    </span>
                </span>
                <span class="cost-total-amount">₱<?= number_format($displayTotal, 2) ?></span>
            </div>
        </div>

        <!-- Payment Details -->
        <div class="section-label"><i class="fa-solid fa-credit-card"></i> Payment Details</div>
        <div class="payment-block">
            <div class="payment-row">
                <span class="p-label"><i class="fa-solid fa-circle-info"></i> Payment Status</span>
                <span class="p-value">
                    <?php if ($booking['payment_status'] === 'paid'): ?>
                        <span class="pay-badge-paid"><i class="fa-solid fa-check me-1"></i> Fully Paid</span>
                    <?php elseif (($booking['down_payment_status'] ?? '') === 'paid'): ?>
                        <span class="pay-badge-half"><i class="fa-solid fa-circle-half-stroke me-1"></i> 50% Down Paid</span>
                    <?php else: ?>
                        <span class="pay-badge-unpaid"><i class="fa-solid fa-hourglass me-1"></i> Unpaid</span>
                    <?php endif; ?>
                </span>
            </div>

            <?php if ((float)($booking['down_payment'] ?? 0) > 0): ?>
            <div class="payment-row">
                <span class="p-label"><i class="fa-solid fa-circle-half-stroke"></i> Down Payment Paid</span>
                <span class="p-value" style="color:var(--accent-cyan);">₱<?= number_format($booking['down_payment'], 2) ?></span>
            </div>
            <?php if (!empty($booking['down_payment_paid_at'])): ?>
            <div class="payment-row">
                <span class="p-label"><i class="fa-regular fa-calendar-check"></i> Paid On</span>
                <span class="p-value" style="opacity:0.7;"><?= date('M d, Y h:i A', strtotime($booking['down_payment_paid_at'])) ?></span>
            </div>
            <?php endif; ?>
            <div class="payment-row">
                <span class="p-label"><i class="fa-solid fa-scale-balanced"></i> Remaining Balance</span>
                <span class="p-value" style="color:#ffc107;">₱<?= number_format($displayTotal - (float)$booking['down_payment'], 2) ?></span>
            </div>
            <?php endif; ?>

            <?php if ($canPay): ?>
            <div class="pay-instruction">
                <i class="fa-solid fa-circle-info me-1"></i>
                To secure your booking, click <strong>Pay Now</strong> below and send payment via <strong>GCash</strong>.
                You may pay <strong>50% as a down payment</strong> to reserve your slot, or pay the <strong>full amount</strong> upfront.
                Upload your GCash screenshot as proof of payment.
            </div>
            <?php endif; ?>
        </div>

        <!-- Action Buttons -->
        <div class="action-row">
            <a href="<?= base_url('user/my-bookings') ?>" class="btn-back">
                <i class="fa-solid fa-arrow-left"></i> Back to My Bookings
            </a>

            <?php if ($canPay): ?>
            <button class="btn-pay-detail"
                onclick="openPayModal(
                    <?= $booking['id'] ?>,
                    '<?= esc(addslashes($displayTitle)) ?>',
                    <?= $displayTotal ?>,
                    '<?= $booking['down_payment_status'] ?>'
                )">
                <i class="fa-solid fa-peso-sign"></i>
                <?= ($booking['down_payment_status'] === 'paid') ? 'Pay Remaining Balance' : 'Pay Now' ?>
            </button>
            <?php endif; ?>

            <?php if ($canCancel): ?>
            <form action="<?= base_url('user/booking/cancel/' . $booking['id']) ?>" method="POST"
                  onsubmit="return confirm('Are you sure you want to cancel this booking? This action cannot be undone.');">
                <?= csrf_field() ?>
                <button type="submit" class="btn-cancel-booking">
                    <i class="fa-solid fa-xmark"></i> Cancel Booking
                </button>
            </form>
            <?php endif; ?>
        </div>

    </div><!-- /details-card -->
</div>

<footer>
    <div class="copyright-text opacity-50">&copy; 2026 Waves Water Sports | Tech by <span class="text-info fw-bold">MARISENSE</span></div>
</footer>

<!-- PAYMENT MODAL -->
<div id="payModal" class="d-none">
    <div class="pay-modal-box">
        <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:6px;">
            <div>
                <div class="pay-modal-title"><i class="fa-solid fa-peso-sign me-2"></i>Pay for Booking</div>
                <div class="pay-modal-subtitle" id="pay-modal-activity">—</div>
            </div>
            <button class="btn-close-pay" onclick="closePayModal()"><i class="fa-solid fa-xmark me-1"></i> Close</button>
        </div>

        <div class="pay-opt-row">
            <div class="pay-opt selected" id="payopt-half" onclick="selectPayOpt('half')">
                <i class="fa-brands fa-google-pay me-1" style="color:#1a73e8;"></i><br>
                50% Down<br><span style="font-size:0.68rem;font-weight:400;">Secure your slot</span>
            </div>
            <div class="pay-opt" id="payopt-full" onclick="selectPayOpt('full')">
                <i class="fa-solid fa-money-bill-wave me-1"></i><br>
                Full Payment<br><span style="font-size:0.68rem;font-weight:400;">Pay everything now</span>
            </div>
        </div>

        <div class="pay-amount-box">
            <div>
                <div class="pay-amount-label" id="pay-amount-label">Down Payment (50%)</div>
                <div class="pay-amount-value" id="pay-amount-display">—</div>
            </div>
            <div style="font-size:0.72rem;color:rgba(255,255,255,0.4);text-align:right;">
                Total:<br><span id="pay-total-display" style="color:rgba(255,255,255,0.7);font-weight:700;">—</span>
            </div>
        </div>

        <div class="gcash-info-box">
            <div style="font-size:0.68rem;text-transform:uppercase;letter-spacing:1px;color:rgba(255,255,255,0.4);margin-bottom:4px;">GCash Number</div>
            <div class="gcash-num"><i class="fa-brands fa-google-pay" style="color:#1a73e8;"></i> 0917-XXX-XXXX</div>
            <div style="font-size:0.75rem;color:rgba(255,255,255,0.5);margin-top:2px;">Waves Water Sports</div>
            <div style="font-size:0.72rem;color:rgba(255,255,255,0.35);margin-top:8px;line-height:1.6;">
                1. Open GCash → Send Money &nbsp;|&nbsp; 2. Enter number &amp; amount<br>
                3. Screenshot receipt &nbsp;|&nbsp; 4. Upload screenshot below
            </div>
        </div>

        <form action="<?= base_url('user/booking/pay') ?>" method="POST" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <input type="hidden" name="booking_id"   id="pay-booking-id" value="">
            <input type="hidden" name="payment_type" id="pay-type-hidden" value="half">

            <div style="margin-bottom:12px;">
                <label class="pay-field-label">GCash Receipt Screenshot <span style="font-weight:400;text-transform:none;letter-spacing:0;opacity:0.6;">(required)</span></label>
                <input type="file" name="gcash_receipt" accept="image/*" class="pay-file-input" required>
                <p class="pay-note">Attach a screenshot of your GCash transaction. Accepted: JPG, PNG.</p>
            </div>

            <div style="margin-bottom:12px;">
                <label class="pay-field-label">GCash Reference No. <span style="font-weight:400;text-transform:none;letter-spacing:0;opacity:0.6;">(optional)</span></label>
                <input type="text" name="gcash_ref" placeholder="e.g. 1234567890" class="pay-text-input">
            </div>

            <button type="submit" class="btn-confirm-pay">
                <i class="fa-solid fa-check-circle me-2"></i> Submit Payment
            </button>
        </form>
    </div>
</div>

<script>
    let payTotalAmount = 0;

    function openPayModal(bookingId, activityName, total, downPayStatus) {
        payTotalAmount = parseFloat(total);
        document.getElementById('pay-booking-id').value           = bookingId;
        document.getElementById('pay-modal-activity').textContent = activityName + ' · Booking #' + bookingId;
        document.getElementById('pay-total-display').textContent  = '₱' + payTotalAmount.toLocaleString('en-PH', {minimumFractionDigits:2});
        selectPayOpt(downPayStatus === 'paid' ? 'full' : 'half');
        document.getElementById('payModal').classList.remove('d-none');
    }

    function closePayModal() {
        document.getElementById('payModal').classList.add('d-none');
    }

    function selectPayOpt(type) {
        document.getElementById('pay-type-hidden').value = type;
        document.getElementById('payopt-half').classList.toggle('selected', type === 'half');
        document.getElementById('payopt-full').classList.toggle('selected', type === 'full');
        var half = Math.ceil(payTotalAmount / 2);
        if (type === 'half') {
            document.getElementById('pay-amount-label').textContent   = 'Down Payment (50%)';
            document.getElementById('pay-amount-display').textContent = '₱' + half.toLocaleString('en-PH', {minimumFractionDigits:2});
        } else {
            document.getElementById('pay-amount-label').textContent   = 'Full Payment';
            document.getElementById('pay-amount-display').textContent = '₱' + payTotalAmount.toLocaleString('en-PH', {minimumFractionDigits:2});
        }
    }

    document.getElementById('payModal').addEventListener('click', function(e) {
        if (e.target === this) closePayModal();
    });
</script>
</body>
</html>