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
        .page-body { max-width: 800px; margin: 60px auto 100px; padding: 0 24px; }
        .details-card { background: rgba(255,255,255,0.08); backdrop-filter: blur(15px); border: 1px solid rgba(255,255,255,0.15); border-radius: 30px; padding: 40px; }
        .booking-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 30px; flex-wrap: wrap; gap: 10px; }
        .booking-code-badge { background: rgba(72,202,228,0.15); border: 1px solid var(--accent-cyan); color: var(--accent-cyan); padding: 6px 18px; border-radius: 50px; font-size: 0.85rem; font-weight: 700; letter-spacing: 1px; }
        .detail-row { display: flex; justify-content: space-between; align-items: center; padding: 16px 0; border-bottom: 1px solid rgba(255,255,255,0.08); font-size: 0.95rem; }
        .detail-row:last-child { border-bottom: none; }
        .detail-label { color: rgba(255,255,255,0.5); font-weight: 500; }
        .detail-value { font-weight: 600; color: white; text-align: right; }
        .badge-status { padding: 8px 18px; border-radius: 50px; font-weight: 700; font-size: 0.85rem; }
        .status-pending   { background: rgba(255,193,7,0.15); color: #ffc107; border: 1px solid #ffc107; }
        .status-confirmed { background: rgba(40,167,69,0.15); color: #28a745; border: 1px solid #28a745; }
        .status-completed { background: rgba(72,202,228,0.15); color: #48cae4; border: 1px solid #48cae4; }
        .status-cancelled { background: rgba(220,53,69,0.15); color: #dc3545; border: 1px solid #dc3545; }
        .total-highlight { font-size: 1.4rem; font-weight: 900; color: var(--accent-cyan); }
        .action-row { margin-top: 30px; display: flex; gap: 14px; flex-wrap: wrap; }
        .btn-back { background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); color: white; padding: 12px 28px; border-radius: 50px; text-decoration: none; font-weight: 600; transition: 0.3s; }
        .btn-back:hover { background: rgba(255,255,255,0.2); color: white; }
        .btn-cancel-booking { background: rgba(220,53,69,0.15); border: 1px solid rgba(220,53,69,0.4); color: #ff9999; padding: 12px 28px; border-radius: 50px; font-weight: 600; cursor: pointer; transition: 0.3s; }
        .btn-cancel-booking:hover { background: rgba(220,53,69,0.3); }
        .alert-wave-success { background: rgba(40,167,69,0.15); border: 1px solid rgba(40,167,69,0.4); color: #5ddb8a; border-radius: 14px; padding: 14px 18px; margin-bottom: 24px; font-size: 0.9rem; }
        footer { background: var(--deep-blue); padding: 60px 0 30px; color: rgba(255,255,255,0.6); text-align: center; border-top: 1px solid rgba(255,255,255,0.1); }
        /* Tooltip para sa mga action buttons */
        .tooltip-btn { position: relative; cursor: pointer; }
        .tooltip-btn::after {
            content: attr(data-tooltip);
            position: absolute;
            bottom: 120%; left: 50%;
            transform: translateX(-50%);
            background: #052c39; color: #48cae4;
            padding: 6px 12px; border-radius: 6px;
            font-size: 0.75rem; font-weight: 600;
            white-space: nowrap; opacity: 0; pointer-events: none;
            transition: 0.3s; border: 1px solid #48cae4;
        }
        .tooltip-btn:hover::after { opacity: 1; }

        /* Enhanced Buttons */
        .btn-back, .btn-cancel-booking { 
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-flex; align-items: center;
        }
        .btn-back:hover { transform: translateY(-3px); box-shadow: 0 5px 15px rgba(255,255,255,0.1); }
        .btn-cancel-booking:hover { transform: translateY(-3px); box-shadow: 0 5px 15px rgba(220,53,69,0.3); }
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
        <div class="logout-wrapper"><a href="<?= base_url('logout') ?>" class="btn-logout-custom">Logout</a></div>
    </div>
</nav>

<div class="page-body">

    <?php if (session()->getFlashdata('success')): ?>
    <div class="alert-wave-success">
        <i class="fa-solid fa-circle-check me-2"></i>
        <?= session()->getFlashdata('success') ?>
    </div>
    <?php endif; ?>

    <?php
    $statusClass = match(strtolower($booking['status'])) {
        'pending'              => 'status-pending',
        'confirmed', 'approved'=> 'status-confirmed',
        'completed'            => 'status-completed',
        'cancelled'            => 'status-cancelled',
        default                => '',
    };
    $canCancel = in_array($booking['status'], ['pending', 'confirmed']);
    ?>

    <div class="details-card shadow-lg">
        <div class="booking-header">
            <div>
                <h2 class="fw-bold mb-1"><?= esc($booking['activity_name']) ?></h2>
                <p class="opacity-60 mb-0">Matabungkay Beach · Waves Water Sports</p>
            </div>
            <span class="booking-code-badge"># <?= esc($booking['booking_code']) ?></span>
        </div>

        <div class="detail-row">
            <span class="detail-label"><i class="fa-solid fa-circle-check me-2 text-info"></i> Status</span>
            <span class="detail-value"><span class="badge-status <?= $statusClass ?>"><?= ucfirst($booking['status']) ?></span></span>
        </div>

        <div class="detail-row">
            <span class="detail-label"><i class="fa-regular fa-calendar me-2 text-info"></i> Date</span>
            <span class="detail-value"><?= date('F d, Y', strtotime($booking['date'])) ?></span>
        </div>

        <div class="detail-row">
            <span class="detail-label"><i class="fa-regular fa-clock me-2 text-info"></i> Time</span>
            <span class="detail-value"><?= date('h:i A', strtotime($booking['time'])) ?></span>
        </div>

        <div class="detail-row">
            <span class="detail-label"><i class="fa-solid fa-users me-2 text-info"></i> Participants</span>
            <span class="detail-value"><?= esc($booking['participants']) ?> person<?= $booking['participants'] > 1 ? 's' : '' ?></span>
        </div>

        <?php if (!empty($booking['special_requests'])): ?>
        <div class="detail-row">
            <span class="detail-label"><i class="fa-solid fa-note-sticky me-2 text-info"></i> Special Requests</span>
            <span class="detail-value" style="max-width:60%;"><?= esc($booking['special_requests']) ?></span>
        </div>
        <?php endif; ?>

        <div class="detail-row">
            <span class="detail-label"><i class="fa-solid fa-credit-card me-2 text-info"></i> Payment</span>
            <span class="detail-value">
                <?php if ($booking['payment_status'] === 'paid'): ?>
                    <span class="text-success fw-bold">✔ Paid</span>
                <?php else: ?>
                    <span class="text-warning fw-bold">⏳ Unpaid</span>
                <?php endif; ?>
            </span>
        </div>

        <div class="detail-row">
            <span class="detail-label"><i class="fa-solid fa-peso-sign me-2 text-info"></i> Total Amount</span>
            <span class="detail-value total-highlight">₱<?= number_format($booking['total_amount'], 2) ?></span>
        </div>

        <div class="detail-row">
            <span class="detail-label"><i class="fa-regular fa-calendar-plus me-2 text-info"></i> Booked On</span>
            <span class="detail-value"><?= date('F d, Y h:i A', strtotime($booking['created_at'])) ?></span>
        </div>

        <div class="action-row">
            <a href="<?= base_url('user/my-bookings') ?>" 
            class="btn-back tooltip-btn" 
            data-tooltip="Return to booking list">
                <i class="fa-solid fa-arrow-left me-2"></i> Back to My Bookings
            </a>

            <?php if ($canCancel): ?>
            <form action="<?= base_url('user/booking/cancel/' . $booking['id']) ?>" method="POST"
                onsubmit="return confirm('Are you sure you want to cancel this booking?');">
                <?= csrf_field() ?>
                <button type="submit" 
                        class="btn-cancel-booking tooltip-btn" 
                        data-tooltip="Request cancellation">
                    <i class="fa-solid fa-xmark me-2"></i> Cancel Booking
                </button>
            </form>
            <?php endif; ?>
        </div>
    </div>
</div>

<footer>
    <div class="copyright-text opacity-50">&copy; 2026 Waves Water Sports | Tech by <span class="text-info fw-bold">MARISENSE</span></div>
</footer>

</body>
</html>