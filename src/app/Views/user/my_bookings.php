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
        body {font-family: 'Poppins', sans-serif; background: linear-gradient(180deg, var(--ocean-blue) 0%, var(--deep-blue) 100%); background-attachment: fixed; color: var(--soft-white); margin: 0; min-height: 100vh}

        .waves-navbar { background: var(--ocean-blue); padding: 35px 0; position: sticky; top: 0; z-index: 1000; box-shadow: 0 4px 20px rgba(0,0,0,0.15); }
        .header-container { display: flex; justify-content: space-between; align-items: center; padding: 0 40px; }
        .user-greeting { color: white; font-size: 1.2rem; font-weight: 400; flex: 1; }
        .nav-menu-center { display: flex; gap: 10px; justify-content: center; flex: 2; }
        .logout-wrapper { flex: 1; display: flex; justify-content: flex-end; gap: 10px; align-items: center; }
        .nav-link-custom { color: rgba(255,255,255,0.8); text-decoration: none; font-size: 1rem; font-weight: 500; padding: 8px 16px; border-radius: 50px; transition: 0.3s; white-space: nowrap; }
        .nav-link-custom:hover { color: var(--accent-cyan); background: rgba(255,255,255,0.1); }
        .nav-link-custom.active { background: var(--accent-cyan); color: var(--deep-blue); font-weight: 600; }
        .btn-logout-custom { color: #ff6b6b; text-decoration: none; font-weight: 600; font-size: 0.85rem; padding: 8px 18px; border: 1px solid rgba(255,107,107,0.3); border-radius: 50px; transition: 0.3s; }
        .btn-logout-custom:hover { background: #ff6b6b; color: white; }
        .btn-help-custom { color: #48cae4; font-weight: 600; font-size: 0.85rem; padding: 8px 18px; border: 1px solid rgba(72,202,228,0.5); border-radius: 50px; background: rgba(72,202,228,0.08); cursor: pointer; transition: 0.3s; }
        .btn-help-custom:hover { background: rgba(72,202,228,0.2); border-color: var(--accent-cyan); }

        /* Help Modal */
        #helpModal { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(5,44,57,0.88); backdrop-filter: blur(8px); z-index: 9999; display: flex; align-items: center; justify-content: center; padding: 20px; }
        #helpModal.d-none { display: none !important; }
        .help-modal-box { background: #0a3d52; border: 1px solid rgba(72,202,228,0.35); border-radius: 30px; padding: 40px; max-width: 780px; width: 100%; box-shadow: 0 30px 60px rgba(0,0,0,0.5); }
        .help-modal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 28px; }
        .help-modal-title { color: #48cae4; font-size: 1.3rem; font-weight: 700; margin: 0; }
        .btn-close-help { background: none; border: 1px solid rgba(255,255,255,0.25); color: white; border-radius: 50px; padding: 6px 20px; cursor: pointer; font-size: 0.85rem; transition: 0.3s; }
        .btn-close-help:hover { background: rgba(255,255,255,0.1); }
        .help-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        @media (max-width: 600px) { .help-grid { grid-template-columns: 1fr; } }
        .help-item { background: rgba(255,255,255,0.05); border-left: 4px solid #48cae4; border-radius: 14px; padding: 18px 20px; transition: 0.3s; }
        .help-item:hover { background: rgba(72,202,228,0.08); transform: translateX(4px); }
        .help-item strong { color: #48cae4; display: block; margin-bottom: 8px; font-size: 0.92rem; }
        .help-item p { color: rgba(255,255,255,0.75); font-size: 0.85rem; margin: 0; line-height: 1.6; }
        .help-modal-footer { margin-top: 28px; text-align: center; color: rgba(255,255,255,0.4); font-size: 0.8rem; }

        .welcome-hero { background: linear-gradient(rgba(5,44,57,0.5), rgba(5,44,57,0.7)), url('<?= base_url('images/background.png') ?>'); background-size: cover; background-position: center; background-attachment: fixed; padding: 145px 40px; color: white; border-radius: 0 0 80px 80px; margin-bottom: 60px; }
        .page-container { max-width: 1150px; margin: 0 auto 80px; padding: 0 24px; }

        /* Stats */
        .stats-strip { display: grid; grid-template-columns: repeat(4,1fr); gap: 14px; margin-bottom: 28px; }
        .stat-box { background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.12); border-radius: 18px; padding: 18px; text-align: center; transition: 0.2s; }
        .stat-box:hover { background: rgba(255,255,255,0.12); transform: translateY(-2px); }
        .stat-value { font-size: 1.7rem; font-weight: 700; color: var(--accent-cyan); }
        .stat-label { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1px; color: rgba(255,255,255,0.5); margin-top: 2px; }

        /* Tabs */
        .history-tabs { display: flex; gap: 8px; margin-bottom: 20px; flex-wrap: wrap; }
        .tab-btn { background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); color: rgba(255,255,255,0.7); padding: 8px 20px; border-radius: 50px; font-size: 0.82rem; font-weight: 600; cursor: pointer; transition: 0.2s; }
        .tab-btn:hover, .tab-btn.active { background: var(--accent-cyan); color: var(--deep-blue); border-color: var(--accent-cyan); }

        /* Search */
        .search-bar { display: flex; gap: 10px; margin-bottom: 18px; }
        .search-input { background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); border-radius: 50px; color: white; padding: 9px 20px; font-size: 0.82rem; outline: none; min-width: 280px; font-family: 'Poppins', sans-serif; }
        .search-input::placeholder { color: rgba(255,255,255,0.35); }
        .search-input:focus { border-color: var(--accent-cyan); }

        .bookings-panel { background: rgba(255,255,255,0.06); backdrop-filter: blur(15px); border: 1px solid rgba(255,255,255,0.1); border-radius: 24px; padding: 28px; }

        /* Booking card */
        .booking-card { background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 20px; padding: 22px 26px; margin-bottom: 16px; transition: 0.2s; position: relative; }
        .booking-card:last-child { margin-bottom: 0; }
        .booking-card:hover { background: rgba(255,255,255,0.08); border-color: rgba(72,202,228,0.2); transform: translateX(3px); }
        .booking-card-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 14px; flex-wrap: wrap; gap: 10px; }
        .bc-left { display: flex; align-items: center; gap: 14px; }
        .bc-icon { width: 46px; height: 46px; border-radius: 13px; background: rgba(72,202,228,0.12); display: flex; align-items: center; justify-content: center; color: var(--accent-cyan); font-size: 1.2rem; flex-shrink: 0; }
        .bc-title { font-size: 1rem; font-weight: 700; margin-bottom: 3px; }
        .bc-code { font-size: 0.72rem; color: var(--accent-cyan); font-weight: 600; letter-spacing: 1px; opacity: 0.8; }
        .bc-badges { display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }

        /* Booking meta strip */
        .bc-meta-strip { display: flex; gap: 20px; flex-wrap: wrap; margin-bottom: 12px; padding: 10px 14px; background: rgba(255,255,255,0.03); border-radius: 10px; border: 1px solid rgba(255,255,255,0.06); }
        .bc-meta-item { display: flex; align-items: center; gap: 6px; font-size: 0.75rem; color: rgba(255,255,255,0.5); }
        .bc-meta-item i { color: var(--accent-cyan); font-size: 0.7rem; }
        .bc-meta-item span { color: rgba(255,255,255,0.8); font-weight: 600; }

        /* Per-activity cost breakdown table */
        .bc-pax-table { background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.07); border-radius: 12px; overflow: hidden; margin-bottom: 14px; }
        .bc-pax-header { padding: 7px 14px; background: rgba(72,202,228,0.07); font-size: 0.62rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: var(--accent-cyan); border-bottom: 1px solid rgba(72,202,228,0.12); }
        .bc-pax-row { display: flex; justify-content: space-between; align-items: center; padding: 8px 14px; border-bottom: 1px solid rgba(255,255,255,0.04); font-size: 0.8rem; }
        .bc-pax-row:last-child { border-bottom: none; }
        .bc-pax-row .pax-act { display: flex; align-items: center; gap: 7px; color: rgba(255,255,255,0.75); font-weight: 500; }
        .bc-pax-row .pax-act i { color: var(--accent-cyan); font-size: 0.72rem; width: 14px; }
        .bc-pax-row .pax-formula { font-size: 0.72rem; color: rgba(255,255,255,0.38); margin-left: 6px; font-style: italic; }
        .bc-pax-row .pax-line-total { font-weight: 700; color: var(--accent-cyan); white-space: nowrap; }
        .bc-pax-total { display: flex; justify-content: space-between; align-items: center; padding: 9px 14px; background: rgba(72,202,228,0.08); border-top: 2px solid rgba(72,202,228,0.2); font-size: 0.82rem; font-weight: 700; color: var(--accent-cyan); }

        /* Contact / special row */
        .bc-info-row { display: flex; gap: 16px; flex-wrap: wrap; background: rgba(255,255,255,0.03); border-radius: 10px; padding: 10px 14px; margin-bottom: 14px; border: 1px solid rgba(255,255,255,0.06); }
        .bc-info-item .info-label { font-size: 0.62rem; text-transform: uppercase; letter-spacing: 1px; color: rgba(255,255,255,0.4); font-weight: 700; margin-bottom: 2px; }
        .bc-info-item .info-val { font-size: 0.82rem; font-weight: 600; color: white; }

        /* Activity pills */
        .bc-activities { display: flex; flex-wrap: wrap; gap: 7px; margin-bottom: 14px; }
        .bc-act-pill { background: rgba(10,88,114,0.3); border: 1px solid rgba(72,202,228,0.2); border-radius: 50px; padding: 5px 14px; font-size: 0.78rem; font-weight: 600; color: rgba(255,255,255,0.8); display: flex; align-items: center; gap: 6px; }
        .bc-act-pill i { color: var(--accent-cyan); font-size: 0.75rem; }

        /* Action row */
        .bc-actions { display: flex; gap: 8px; flex-wrap: wrap; }
        .btn-view-details { background: rgba(72,202,228,0.12); color: var(--accent-cyan); border: 1px solid rgba(72,202,228,0.35); padding: 8px 20px; border-radius: 50px; font-size: 0.8rem; font-weight: 600; cursor: pointer; transition: 0.2s; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; }
        .btn-view-details:hover { background: var(--accent-cyan); color: var(--deep-blue); transform: translateY(-1px); }
        .btn-pay-now { background: rgba(40,167,69,0.12); color: #5ddb8a; border: 1px solid rgba(40,167,69,0.35); padding: 8px 18px; border-radius: 50px; font-size: 0.8rem; font-weight: 600; cursor: pointer; transition: 0.2s; display: inline-flex; align-items: center; gap: 6px; }
        .btn-pay-now:hover { background: rgba(40,167,69,0.3); transform: translateY(-1px); }

        /* Badges */
        .badge-status { padding: 5px 14px; border-radius: 50px; font-weight: 700; font-size: 0.72rem; display: inline-flex; align-items: center; gap: 5px; }
        .status-pending   { background: rgba(255,193,7,0.12);  color: #ffc107; border: 1px solid rgba(255,193,7,0.4); }
        .status-confirmed { background: rgba(40,167,69,0.12);  color: #5ddb8a; border: 1px solid rgba(40,167,69,0.4); }
        .status-completed { background: rgba(72,202,228,0.12); color: #48cae4; border: 1px solid rgba(72,202,228,0.4); }
        .status-cancelled { background: rgba(220,53,69,0.12);  color: #ff9999; border: 1px solid rgba(220,53,69,0.4); }
        .payment-badge { padding: 5px 12px; border-radius: 50px; font-size: 0.7rem; font-weight: 700; display: inline-flex; align-items: center; gap: 4px; }
        .pay-paid   { background: rgba(40,167,69,0.15);   color: #5ddb8a; border: 1px solid rgba(40,167,69,0.4); }
        .pay-half   { background: rgba(255,193,7,0.12);   color: #ffc107; border: 1px solid rgba(255,193,7,0.4); }
        .pay-unpaid { background: rgba(255,255,255,0.06); color: rgba(255,255,255,0.45); border: 1px solid rgba(255,255,255,0.12); }

        /* Empty state */
        .empty-state { text-align: center; padding: 50px 20px; }
        .empty-state i { font-size: 2.5rem; opacity: 0.35; display: block; margin-bottom: 14px; }
        .empty-state p { opacity: 0.5; margin: 0; }

        /* Toast */
        #toast-notification { position: fixed; top: 100px; left: 50%; transform: translateX(-50%) translateY(-20px); background: linear-gradient(135deg, #0a4d28, #0a5872); border: 1px solid rgba(93,219,138,0.5); border-radius: 50px; padding: 14px 28px; display: flex; align-items: center; gap: 12px; box-shadow: 0 12px 40px rgba(0,0,0,0.4); z-index: 99999; opacity: 0; transition: opacity 0.4s ease, transform 0.4s ease; pointer-events: none; white-space: nowrap; }
        #toast-notification.show { opacity: 1; transform: translateX(-50%) translateY(0); }
        #toast-notification i { color: #5ddb8a; font-size: 1.1rem; }
        #toast-notification span { color: white; font-size: 0.88rem; font-weight: 600; font-family: 'Poppins', sans-serif; }

        /* Payment Modal */
        #payModal { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(5,44,57,0.92); backdrop-filter: blur(10px); z-index: 9999; display: flex; align-items: center; justify-content: center; padding: 20px; }
        #payModal.d-none { display: none !important; }
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
        .btn-confirm-pay.loading { opacity: 0.7; pointer-events: none; }
        .btn-close-pay { background: none; border: 1px solid rgba(255,255,255,0.2); color: rgba(255,255,255,0.6); border-radius: 50px; padding: 6px 18px; cursor: pointer; font-size: 0.82rem; transition: 0.3s; }
        .btn-close-pay:hover { background: rgba(255,255,255,0.1); color: white; }

        footer { background: var(--deep-blue); padding: 100px 0 40px; color: rgba(255,255,255,0.6) !important; border-top: 1px solid rgba(255,255,255,0.1); width: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; }
        .social-icons { display: flex; justify-content: center; gap: 20px; margin-bottom: 25px; }
        .social-icons i { color: rgba(255,255,255,0.7); transition: 0.3s; cursor: pointer; font-size: 1.5rem; }
        .social-icons i:hover { color: var(--accent-cyan); transform: scale(1.2); }
        /* ── SEARCH ── */
        .btn-search-custom { color: #48cae4; font-size: 1.1rem; padding: 8px 12px; border: 1px solid rgba(72,202,228,0.5); border-radius: 50px; background: rgba(72,202,228,0.08); cursor: pointer; transition: 0.3s; display: flex; align-items: center; justify-content: center; }
        .btn-search-custom:hover { background: rgba(72,202,228,0.2); border-color: #48cae4; }
        #searchOverlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(5,44,57,0.92); backdrop-filter: blur(10px); z-index: 99999; display: flex; flex-direction: column; align-items: center; padding-top: 100px; animation: fadeInSearch 0.2s ease; }
        #searchOverlay.d-none { display: none !important; }
        @keyframes fadeInSearch { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
        .search-overlay-inner { width: 100%; max-width: 640px; padding: 0 20px; }
        .search-overlay-bar { display: flex; align-items: center; gap: 12px; background: #0a3d52; border: 1.5px solid rgba(72,202,228,0.5); border-radius: 16px; padding: 14px 18px; margin-bottom: 12px; }
        .search-overlay-bar i { color: #48cae4; font-size: 1rem; flex-shrink: 0; }
        .search-overlay-input { flex: 1; background: none; border: none; outline: none; color: #fff; font-size: 1rem; font-family: 'Poppins', sans-serif; }
        .search-overlay-input::placeholder { color: rgba(255,255,255,0.35); }
        .btn-close-search { background: none; border: 1px solid rgba(255,255,255,0.2); color: rgba(255,255,255,0.6); border-radius: 50px; padding: 5px 14px; font-size: 0.78rem; cursor: pointer; font-family: 'Poppins', sans-serif; transition: 0.2s; white-space: nowrap; }
        .btn-close-search:hover { background: rgba(255,255,255,0.1); color: #fff; }
        .search-results-box { background: #0a3d52; border: 1px solid rgba(72,202,228,0.25); border-radius: 16px; overflow: hidden; max-height: 420px; overflow-y: auto; }
        .sdn-section-label { font-size: 0.62rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: rgba(72,202,228,0.7); padding: 10px 16px 4px; background: rgba(72,202,228,0.05); }
        .sdn-item { display: flex; align-items: center; gap: 12px; padding: 11px 16px; border-bottom: 1px solid rgba(255,255,255,0.05); text-decoration: none; color: #fff; transition: 0.15s; }
        .sdn-item:last-child { border-bottom: none; }
        .sdn-item:hover { background: rgba(72,202,228,0.1); }
        .sdn-icon { width: 34px; height: 34px; border-radius: 9px; background: rgba(72,202,228,0.12); display: flex; align-items: center; justify-content: center; color: #48cae4; flex-shrink: 0; }
        .sdn-title { font-size: 0.85rem; font-weight: 600; line-height: 1.2; }
        .sdn-sub { font-size: 0.72rem; color: rgba(255,255,255,0.45); margin-top: 2px; }
        .sdn-no-result { text-align: center; padding: 30px; color: rgba(255,255,255,0.4); font-size: 0.88rem; }
        .sdn-hint { text-align: center; padding: 20px; color: rgba(255,255,255,0.3); font-size: 0.8rem; }
        .sdn-highlight { background: rgba(72,202,228,0.25); color: #48cae4; border-radius: 2px; padding: 0 2px; }
    </style>
</head>
<body>

<!-- Toast -->
<div id="toast-notification">
    <i class="fa-solid fa-circle-check"></i>
    <span id="toast-msg">Payment submitted successfully!</span>
</div>

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
            <!-- SEARCH ICON -->
            <button class="btn-search-custom" onclick="openSearch()" title="Search">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
            <!-- HELP -->
            <button class="btn-help-custom" onclick="document.getElementById('helpModal').classList.remove('d-none')">
                <i class="fa-solid fa-circle-question me-1"></i> Help
            </button>
            <!-- LOGOUT -->
            <a href="<?= base_url('logout') ?>" class="btn-logout-custom">
                <i class="fa-solid fa-power-off me-1"></i> Logout
            </a>
        </div>
    </div>
</nav>

<header class="welcome-hero">
    <div class="container">
        <h1 class="display-5 fw-bold mb-2">My Bookings</h1>
        <p class="lead mb-5 opacity-90 mx-auto" style="max-width: 800px;">
            View all your current and past reservations in one place easily and quickly.
            Track details, payment status, and manage your schedule anytime.
        </p>
    </div>
</header>

<div class="page-container">

    <?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger rounded-4 mb-4"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <?php
    /* ── helpers ── */
    $db = \Config\Database::connect();

    /**
     * Computes line total for one activity given its DB row and pax count.
     * per_person  → price × pax
     * flat        → price (regardless of pax)
     */
    function mbCalcLine(array $actRow, int $pax): array {
        $price     = (float)($actRow['price'] ?? 0);
        $priceType = $actRow['price_type'] ?? 'flat';
        $lineTotal = ($priceType === 'per_person') ? $price * $pax : $price;
        return [
            'price'      => $price,
            'price_type' => $priceType,
            'pax'        => $pax,
            'line_total' => $lineTotal,
        ];
    }

    $iconMap = [
        'jet ski'       => 'fa-water',
        'banana boat'   => 'fa-ship',
        'kayaking'      => 'fa-sailboat',
        'flying saucer' => 'fa-circle-radiation',
    ];

    $all       = $bookings ?? [];
    $active    = array_filter($all, fn($b) => in_array($b['status'], ['pending','confirmed']));
    $completed = array_filter($all, fn($b) => $b['status'] === 'completed');
    $cancelled = array_filter($all, fn($b) => $b['status'] === 'cancelled');
    $totalSpent= array_sum(array_column(array_filter($all, fn($b) => $b['status'] !== 'cancelled'), 'total_amount'));

    $successMsg = session()->getFlashdata('success');
    ?>

    <!-- Stats -->
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

    <!-- Search + Tabs -->
    <div class="search-bar">
        <input type="text" class="search-input" id="searchInput"
               placeholder="🔍  Search by activity name or booking code…"
               oninput="filterBookings()">
    </div>
    <div class="history-tabs">
        <button class="tab-btn active" onclick="filterTab('all',this)">All <span style="opacity:0.6;">(<?= count($all) ?>)</span></button>
        <button class="tab-btn" onclick="filterTab('active',this)">Active <span style="opacity:0.6;">(<?= count($active) ?>)</span></button>
        <button class="tab-btn" onclick="filterTab('completed',this)">Completed <span style="opacity:0.6;">(<?= count($completed) ?>)</span></button>
        <button class="tab-btn" onclick="filterTab('cancelled',this)">Cancelled <span style="opacity:0.6;">(<?= count($cancelled) ?>)</span></button>
    </div>

    <!-- Bookings Panel -->
    <div class="bookings-panel shadow-lg">

        <?php if (!empty($all)): ?>

        <div id="bookings-list">
        <?php foreach ($all as $booking):
            $status      = strtolower($booking['status']);
            $statusClass = match($status) { 'pending'=>'status-pending','confirmed'=>'status-confirmed','completed'=>'status-completed','cancelled'=>'status-cancelled',default=>'' };
            $statusIcon  = match($status) { 'pending'=>'fa-hourglass-half','confirmed'=>'fa-circle-check','completed'=>'fa-trophy','cancelled'=>'fa-ban',default=>'fa-circle' };
            $tabGroup    = match($status) { 'pending','confirmed'=>'active','completed'=>'completed','cancelled'=>'cancelled',default=>'all' };

            $payClass = 'pay-unpaid'; $payText = 'Unpaid'; $payIcon = 'fa-hourglass';
            if ($booking['payment_status'] === 'paid')                        { $payClass = 'pay-paid';   $payText = 'Paid';     $payIcon = 'fa-check'; }
            elseif (($booking['down_payment_status'] ?? '') === 'paid')       { $payClass = 'pay-half';   $payText = '50% Paid'; $payIcon = 'fa-circle-half-stroke'; }

            /* ── Activities ── */
            $allActNames = array_values(array_filter(array_map('trim', explode(',', $booking['all_activities'] ?? $booking['activity_name']))));
            if (empty($allActNames)) $allActNames = [$booking['activity_name']];
            $multiActivity = count($allActNames) > 1;

            $primaryAct   = strtolower($allActNames[0]);
            $primaryIcon  = $iconMap[$primaryAct] ?? 'fa-person-swimming';
            $displayTitle = $multiActivity ? implode(' + ', $allActNames) : $booking['activity_name'];
            $searchStr    = strtolower($displayTitle . ' ' . $booking['booking_code'] . ' ' . implode(' ', $allActNames));

            /* ── Participants per activity ── */
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

            /* ── Fetch activity rows from DB for pricing ── */
            $actRowCache = [];
            foreach ($allActNames as $an) {
                $an = trim($an);
                $row = $db->table('activities')->where('name', $an)->get()->getRowArray();
                if ($row) $actRowCache[$an] = $row;
            }

            /* ── Compute per-activity line totals & grand total ──────────────
             * Sum ALL activity line totals. Do NOT use $booking['total_amount']
             * here because it may only reflect a single activity if the booking
             * was saved incorrectly. The computed sum is always correct.
             * ──────────────────────────────────────────────────────────────── */
            $lineItems     = [];
            $computedTotal = 0.0;
            foreach ($allActNames as $an) {
                $an  = trim($an);
                $pax = (int)($ppaMap[$an] ?? 0);
                if (isset($actRowCache[$an])) {
                    $line = mbCalcLine($actRowCache[$an], $pax);
                } else {
                    $line = ['price' => 0, 'price_type' => 'flat', 'pax' => $pax, 'line_total' => 0];
                }
                $lineItems[$an]  = $line;
                $computedTotal  += $line['line_total'];
            }

            /*
             * Use $computedTotal as the authoritative display total.
             * Fall back to $booking['total_amount'] only if we couldn't
             * resolve any prices from the DB (e.g. activity deleted).
             */
            $displayTotal = ($computedTotal > 0) ? $computedTotal : (float)$booking['total_amount'];

            /* ── Time display ── */
            $ts          = strtotime($booking['time']);
            $timeDisplay = date('h:i A', $ts) . ' – ' . date('h:i A', $ts + 3600);

            /* ── Dates ── */
            $bookedOn = date('M d, Y', strtotime($booking['created_at']));
            $actDate  = date('M d, Y', strtotime($booking['date']));

            /* ── Remaining balance (use displayTotal for accuracy) ── */
            $remaining = $displayTotal - (float)($booking['down_payment'] ?? 0);

            $totalParticipants = array_sum($ppaMap);
        ?>
        <div class="booking-card"
             data-tab="<?= $tabGroup ?>"
             data-search="<?= esc($searchStr) ?>">

            <!-- Card header -->
            <div class="booking-card-header">
                <div class="bc-left">
                    <div class="bc-icon"><i class="fa-solid <?= $primaryIcon ?>"></i></div>
                    <div>
                        <div class="bc-title"><?= esc($displayTitle) ?></div>
                        <div class="bc-code"><i class="fa-solid fa-barcode me-1"></i><?= esc($booking['booking_code']) ?></div>
                    </div>
                </div>
                <div class="bc-badges">
                    <span class="badge-status <?= $statusClass ?>">
                        <i class="fa-solid <?= $statusIcon ?>"></i> <?= ucfirst($booking['status']) ?>
                    </span>
                    <span class="payment-badge <?= $payClass ?>">
                        <i class="fa-solid <?= $payIcon ?>"></i> <?= $payText ?>
                    </span>
                    <?php if ($multiActivity): ?>
                    <span style="background:rgba(72,202,228,0.1);border:1px solid rgba(72,202,228,0.25);color:var(--accent-cyan);padding:5px 12px;border-radius:50px;font-size:0.7rem;font-weight:700;">
                        <i class="fa-solid fa-layer-group me-1"></i> <?= count($allActNames) ?> Activities
                    </span>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Meta strip -->
            <div class="bc-meta-strip">
                <div class="bc-meta-item">
                    <i class="fa-regular fa-clock"></i>
                    Booked on: <span><?= $bookedOn ?></span>
                </div>
                <div class="bc-meta-item">
                    <i class="fa-regular fa-calendar-check"></i>
                    Activity date: <span><?= $actDate ?></span>
                </div>
                <div class="bc-meta-item">
                    <i class="fa-regular fa-clock"></i>
                    Time: <span><?= $timeDisplay ?></span>
                </div>
            </div>

            <!-- Activity pills (multi only) -->
            <?php if ($multiActivity): ?>
            <div class="bc-activities">
                <?php foreach ($allActNames as $an):
                    $anKey  = strtolower(trim($an));
                    $anIcon = $iconMap[$anKey] ?? 'fa-person-swimming';
                ?>
                <span class="bc-act-pill">
                    <i class="fa-solid <?= $anIcon ?>"></i> <?= esc(trim($an)) ?>
                </span>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <!-- ── Cost Breakdown ── -->
            <div class="bc-pax-table">
                <div class="bc-pax-header">
                    <i class="fa-solid fa-calculator me-1"></i> Cost Breakdown
                </div>
                <?php foreach ($allActNames as $an):
                    $an   = trim($an);
                    $aKey = strtolower($an);
                    $icon = $iconMap[$aKey] ?? 'fa-person-swimming';
                    $line = $lineItems[$an] ?? ['price' => 0, 'price_type' => 'flat', 'pax' => 0, 'line_total' => 0];
                ?>
                <div class="bc-pax-row">
                    <div class="pax-act">
                        <i class="fa-solid <?= $icon ?>"></i>
                        <?= esc($an) ?>
                        <?php if ($line['price_type'] === 'per_person' && $line['price'] > 0): ?>
                            <span class="pax-formula">
                                ₱<?= number_format($line['price'], 0) ?> &times; <?= $line['pax'] ?> person<?= $line['pax'] != 1 ? 's' : '' ?>
                            </span>
                        <?php elseif ($line['price'] > 0): ?>
                            <span class="pax-formula">
                                flat rate &middot; <?= $line['pax'] ?> person<?= $line['pax'] != 1 ? 's' : '' ?>
                            </span>
                        <?php endif; ?>
                    </div>
                    <div class="pax-line-total">₱<?= number_format($line['line_total'], 2) ?></div>
                </div>
                <?php endforeach; ?>
                <!-- ✅ Grand total = sum of ALL activity line totals -->
                <div class="bc-pax-total">
                    <span>
                        <i class="fa-solid fa-equals me-1"></i> Total Amount
                        <span style="font-size:0.7rem;font-weight:400;opacity:0.55;margin-left:6px;">
                            <?= count($allActNames) ?> activit<?= count($allActNames) > 1 ? 'ies' : 'y' ?>
                            &middot; <?= $totalParticipants ?> participant<?= $totalParticipants != 1 ? 's' : '' ?>
                        </span>
                    </span>
                    <span>₱<?= number_format($displayTotal, 2) ?></span>
                </div>
            </div>

            <!-- Contact / down payment / special requests -->
            <div class="bc-info-row">
                <?php if (!empty($booking['contact_number'])): ?>
                <div class="bc-info-item">
                    <div class="info-label"><i class="fa-solid fa-phone me-1"></i> Contact</div>
                    <div class="info-val"><?= esc($booking['contact_number']) ?></div>
                </div>
                <?php endif; ?>
                <?php if ((float)($booking['down_payment'] ?? 0) > 0): ?>
                <div class="bc-info-item">
                    <div class="info-label"><i class="fa-solid fa-circle-half-stroke me-1"></i> Down Paid</div>
                    <div class="info-val" style="color:#ffc107;">₱<?= number_format($booking['down_payment'], 2) ?></div>
                </div>
                <div class="bc-info-item">
                    <div class="info-label"><i class="fa-solid fa-scale-balanced me-1"></i> Remaining</div>
                    <div class="info-val" style="color:#ff9999;">₱<?= number_format($remaining, 2) ?></div>
                </div>
                <?php endif; ?>
                <?php if (!empty($booking['special_requests'])): ?>
                <div class="bc-info-item" style="flex-basis:100%;">
                    <div class="info-label"><i class="fa-solid fa-note-sticky me-1"></i> Special Request</div>
                    <div class="info-val" style="font-size:0.78rem;opacity:0.85;font-style:italic;"><?= esc($booking['special_requests']) ?></div>
                </div>
                <?php endif; ?>
            </div>

            <!-- Action buttons -->
            <div class="bc-actions">
                <a href="<?= base_url('user/booking-details/' . $booking['id']) ?>" class="btn-view-details">
                    <i class="fa-solid fa-eye"></i> View Status
                </a>
                <?php if (in_array($status, ['pending','confirmed']) && $booking['payment_status'] !== 'paid'): ?>
                <button class="btn-pay-now"
                    onclick="openPayModal(
                        <?= $booking['id'] ?>,
                        '<?= esc(addslashes($displayTitle)) ?>',
                        <?= $displayTotal ?>,
                        '<?= $booking['down_payment_status'] ?>'
                    )">
                    <i class="fa-solid fa-peso-sign"></i>
                    <?= ($booking['down_payment_status'] === 'paid') ? 'Pay Remaining' : 'Pay Now' ?>
                </button>
                <?php endif; ?>
            </div>

        </div>
        <?php endforeach; ?>
        </div>

        <div id="empty-filter" style="display:none;" class="empty-state">
            <i class="fa-solid fa-filter-circle-xmark"></i>
            <p>No bookings match your filter or search.</p>
        </div>

        <?php else: ?>
        <div class="empty-state">
            <i class="fa-solid fa-calendar-xmark"></i>
            <p>You have no bookings yet. <a href="<?= base_url('user/booking') ?>" style="color:var(--accent-cyan);">Book an activity now!</a></p>
        </div>
        <?php endif; ?>

    </div><!-- /bookings-panel -->
</div>

<footer class="text-center">
    <div class="container d-flex flex-column align-items-center">
        <div class="footer-inquiry-text mb-4 opacity-75">For inquiries, message us through our social media platforms.</div>
        <div class="social-icons">
            <a href="https://www.facebook.com/profile.php?id=100077368436521" target="_blank"><i class="fa-brands fa-facebook"></i></a>
            <a href="https://instagram.com" target="_blank"><i class="fa-brands fa-instagram"></i></a>
            <a href="https://twitter.com" target="_blank"><i class="fa-brands fa-twitter"></i></a>
        </div>
        <div class="copyright-text opacity-50">&copy; 2026 Waves Water Sports | Tech by <span class="text-info fw-bold">MARISENSE</span></div>
    </div>
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
                3. Screenshot receipt &nbsp;|&nbsp; 4. Upload the screenshot below
            </div>
        </div>

        <form action="<?= base_url('user/booking/pay') ?>" method="POST" enctype="multipart/form-data" id="payForm">
            <?= csrf_field() ?>
            <input type="hidden" name="booking_id"   id="pay-booking-id" value="">
            <input type="hidden" name="payment_type" id="pay-type-hidden" value="half">

            <div style="margin-bottom:12px;">
                <label class="pay-field-label">GCash Receipt Screenshot <span style="font-weight:400;text-transform:none;letter-spacing:0;opacity:0.6;">(required)</span></label>
                <input type="file" name="gcash_receipt" id="gcash-file-input" accept="image/*" class="pay-file-input" required>
                <p class="pay-note">Attach a screenshot of your GCash transaction. Accepted: JPG, PNG.</p>
            </div>

            <div style="margin-bottom:12px;">
                <label class="pay-field-label">GCash Reference No. <span style="font-weight:400;text-transform:none;letter-spacing:0;opacity:0.6;">(optional)</span></label>
                <input type="text" name="gcash_ref" placeholder="e.g. 1234567890" class="pay-text-input">
            </div>

            <button type="submit" class="btn-confirm-pay" id="pay-submit-btn">
                <i class="fa-solid fa-check-circle me-2"></i> Submit Payment
            </button>
        </form>
    </div>
</div>

<!-- HELP MODAL -->
<div id="helpModal" class="d-none">
    <div class="help-modal-box">
        <div class="help-modal-header">
            <h5 class="help-modal-title"><i class="fa-solid fa-circle-question me-2"></i> System Guide</h5>
            <button class="btn-close-help" onclick="document.getElementById('helpModal').classList.add('d-none')"><i class="fa-solid fa-xmark me-1"></i> Close</button>
        </div>
        <div class="help-grid">
            <div class="help-item"><strong><i class="fa-solid fa-house me-2"></i>Home</strong><p>Overview of the whole system — featured activities, live sea conditions powered by MARISENSE, and recent customer reviews at a glance.</p></div>
            <div class="help-item"><strong><i class="fa-solid fa-person-swimming me-2"></i>Activities</strong><p>Browse all available water sports — Jet Ski, Banana Boat, Kayaking, and Flying Saucer — with descriptions and pricing info.</p></div>
            <div class="help-item"><strong><i class="fa-solid fa-water me-2"></i>Safety & Sea Conditions</strong><p>View real-time MARISENSE data: wind speed, wave height, wave period, and whether activities are currently safe to proceed.</p></div>
            <div class="help-item"><strong><i class="fa-solid fa-calendar-check me-2"></i>Book & Reserve</strong><p>Select your preferred activity, pick a date and time slot, and confirm your reservation online before heading to the beach.</p></div>
            <div class="help-item"><strong><i class="fa-solid fa-list-check me-2"></i>My Bookings</strong><p>Track all your active and past reservations. View booking status, schedule, and activity details anytime.</p></div>
            <div class="help-item"><strong><i class="fa-solid fa-star me-2"></i>Reviews</strong><p>Read honest feedback from fellow adventurers, or leave your own review and rating after completing an activity.</p></div>
        </div>
        <div class="help-modal-footer"><i class="fa-solid fa-shield-halved me-1"></i>For further assistance, contact us via our social media pages.</div>
    </div>
</div>

<script>
    let currentTab     = 'all';
    let payTotalAmount = 0;

    <?php if ($successMsg): ?>
    window.addEventListener('DOMContentLoaded', function () {
        showToast(<?= json_encode($successMsg) ?>);
    });
    <?php endif; ?>

    function showToast(msg) {
        var toast = document.getElementById('toast-notification');
        document.getElementById('toast-msg').textContent = msg;
        toast.classList.add('show');
        setTimeout(function () { toast.classList.remove('show'); }, 4500);
    }

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

    document.getElementById('payForm').addEventListener('submit', function(e) {
        var fileInput = document.getElementById('gcash-file-input');
        if (!fileInput.files || fileInput.files.length === 0) {
            e.preventDefault();
            alert('Please attach your GCash receipt screenshot before submitting.');
            return;
        }
        var btn = document.getElementById('pay-submit-btn');
        btn.classList.add('loading');
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-2"></i> Uploading…';
    });

    document.getElementById('payModal').addEventListener('click', function(e) {
        if (e.target === this) closePayModal();
    });

    function filterTab(tab, btn) {
        currentTab = tab;
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        filterBookings();
    }

    function filterBookings() {
        const q     = document.getElementById('searchInput').value.toLowerCase().trim();
        const cards = document.querySelectorAll('.booking-card');
        let visible = 0;
        cards.forEach(card => {
            const matchTab    = currentTab === 'all' || card.dataset.tab === currentTab;
            const matchSearch = !q || card.dataset.search.includes(q);
            const show        = matchTab && matchSearch;
            card.style.display = show ? '' : 'none';
            if (show) visible++;
        });
        document.getElementById('empty-filter').style.display = visible === 0 ? 'block' : 'none';
    }

    document.getElementById('helpModal').addEventListener('click', function(e) {
        if (e.target === this) this.classList.add('d-none');
    });
    /* ═══════════════════════════════════
   GLOBAL SEARCH — User Side
   Add before </body> on every user page.
═══════════════════════════════════ */
(function () {
    const BASE = (typeof CI_BASE_URL !== 'undefined') ? CI_BASE_URL : '/';

    const SEARCH_INDEX = [
        /* HOME */
        { section: 'Home', title: 'Home Dashboard',     sub: 'Activities, sea conditions & reviews at a glance', icon: 'fa-house',           url: BASE + 'user/home' },
        { section: 'Home', title: 'Live Buoy Data',     sub: 'Real-time MARISENSE buoy monitoring widget',       icon: 'fa-satellite-dish',  url: BASE + 'user/home' },
        { section: 'Home', title: 'Find Us on Map',     sub: 'Matabungkay Beach, Lian, Batangas',                icon: 'fa-location-dot',    url: BASE + 'user/home' },
        { section: 'Home', title: 'About Us',           sub: 'About Waves Water Sports and our commitments',     icon: 'fa-circle-info',     url: BASE + 'user/home' },
        /* ACTIVITIES */
        { section: 'Activities', title: 'All Activities',   sub: 'Browse all available water sports',                    icon: 'fa-person-swimming',  url: BASE + 'user/activities' },
        { section: 'Activities', title: 'Jet Ski',          sub: 'High-speed water adventure',                           icon: 'fa-water',            url: BASE + 'user/activities#jet-ski' },
        { section: 'Activities', title: 'Banana Boat',      sub: 'Fun group ride for families and friends',              icon: 'fa-ship',             url: BASE + 'user/activities#banana-boat' },
        { section: 'Activities', title: 'Kayaking',         sub: 'Explore calm coastal waters peacefully',               icon: 'fa-sailboat',         url: BASE + 'user/activities#kayaking' },
        { section: 'Activities', title: 'Flying Saucer',    sub: 'Glide and spin thrillingly on the water surface',      icon: 'fa-circle-radiation', url: BASE + 'user/activities#flying-saucer' },
        /* BOOK & RESERVE */
        { section: 'Book & Reserve', title: 'Book an Activity',    sub: 'Select your water sport and reserve a slot',   icon: 'fa-calendar-check', url: BASE + 'user/booking' },
        { section: 'Book & Reserve', title: 'Choose Date & Time',  sub: 'Pick an available date and time slot',         icon: 'fa-clock',          url: BASE + 'user/booking' },
        { section: 'Book & Reserve', title: 'GCash Payment',       sub: 'Pay 50% down payment or full via GCash',       icon: 'fa-peso-sign',      url: BASE + 'user/booking' },
        { section: 'Book & Reserve', title: 'Number of Participants', sub: 'Set number of riders per activity',          icon: 'fa-users',          url: BASE + 'user/booking' },
        { section: 'Book & Reserve', title: 'Special Requests',    sub: 'Add health concerns or special needs',          icon: 'fa-note-sticky',    url: BASE + 'user/booking' },
        /* MY BOOKINGS */
        { section: 'My Bookings', title: 'My Reservations',  sub: 'View all your active and past bookings',          icon: 'fa-list-check',      url: BASE + 'user/my-bookings' },
        { section: 'My Bookings', title: 'Booking Status',   sub: 'Pending, Confirmed, Completed, Cancelled',        icon: 'fa-circle-check',    url: BASE + 'user/my-bookings' },
        { section: 'My Bookings', title: 'Pay Balance',      sub: 'Pay remaining balance via GCash',                  icon: 'fa-credit-card',     url: BASE + 'user/my-bookings' },
        { section: 'My Bookings', title: 'Booking Code',     sub: 'Find booking by code or activity name',            icon: 'fa-barcode',         url: BASE + 'user/my-bookings' },
        { section: 'My Bookings', title: 'Cancel Booking',   sub: 'Free cancellation up to 24 hrs before schedule',   icon: 'fa-ban',             url: BASE + 'user/my-bookings' },
        /* SAFETY */
        { section: 'Safety & Sea Conditions', title: 'Sea Conditions Overview', sub: 'Full MARISENSE live data dashboard',              icon: 'fa-tower-broadcast', url: BASE + 'user/safety' },
        { section: 'Safety & Sea Conditions', title: 'Wind Speed',              sub: 'Current wind speed reading in knots',              icon: 'fa-wind',            url: BASE + 'user/safety#marisense-section' },
        { section: 'Safety & Sea Conditions', title: 'Wave Height',             sub: 'Live buoy wave height in meters',                  icon: 'fa-water',           url: BASE + 'user/safety#marisense-section' },
        { section: 'Safety & Sea Conditions', title: 'Wave Period',             sub: 'Wave frequency measured in seconds',               icon: 'fa-wave-square',     url: BASE + 'user/safety#marisense-section' },
        { section: 'Safety & Sea Conditions', title: 'Safety Status',           sub: 'Safe / Moderate / Unsafe activity indicator',      icon: 'fa-shield-halved',   url: BASE + 'user/safety' },
        { section: 'Safety & Sea Conditions', title: 'About MARISENSE',         sub: 'Smart marine monitoring system overview',          icon: 'fa-circle-info',     url: BASE + 'user/safety' },
        { section: 'Safety & Sea Conditions', title: 'Safety Protocol',         sub: 'Wind and wave thresholds for activity suspension', icon: 'fa-triangle-exclamation', url: BASE + 'user/safety' },
        /* REVIEWS */
        { section: 'Reviews', title: 'Read Reviews',    sub: 'Browse feedback from fellow adventurers',              icon: 'fa-star',          url: BASE + 'user/reviews' },
        { section: 'Reviews', title: 'Write a Review',  sub: 'Share your experience after completing an activity',   icon: 'fa-pen-to-square', url: BASE + 'user/reviews' },
        { section: 'Reviews', title: 'Star Rating',     sub: 'Rate your activity experience from 1 to 5 stars',      icon: 'fa-star-half-stroke', url: BASE + 'user/reviews' },
        { section: 'Reviews', title: 'Felt Safe',       sub: 'Indicate whether you felt safe during the activity',   icon: 'fa-shield-halved', url: BASE + 'user/reviews' },
    ];

    function escRe(s) { return s.replace(/[.*+?^${}()|[\]\\]/g, '\\$&'); }

    function hl(text, q) {
        if (!q) return text;
        return text.replace(new RegExp('(' + escRe(q) + ')', 'gi'),
            '<span class="sdn-highlight">$1</span>');
    }

    window.openSearch = function () {
        document.getElementById('searchOverlay').classList.remove('d-none');
        setTimeout(function () {
            var inp = document.getElementById('globalSearchInput');
            if (inp) { inp.value = ''; inp.focus(); }
            document.getElementById('searchResultsBox').innerHTML =
                '<div class="sdn-hint"><i class="fa-solid fa-magnifying-glass me-2"></i>Start typing to search the entire system…</div>';
        }, 60);
    };

    window.closeSearch = function () {
        document.getElementById('searchOverlay').classList.add('d-none');
    };

    window.runGlobalSearch = function (q) {
        var box = document.getElementById('searchResultsBox');
        q = q.trim();

        if (!q) {
            box.innerHTML = '<div class="sdn-hint"><i class="fa-solid fa-magnifying-glass me-2"></i>Start typing to search the entire system…</div>';
            return;
        }

        var hits = SEARCH_INDEX.filter(function (it) {
            return (it.title + ' ' + it.sub + ' ' + it.section)
                .toLowerCase().includes(q.toLowerCase());
        }).slice(0, 14);

        if (!hits.length) {
            box.innerHTML = '<div class="sdn-no-result"><i class="fa-solid fa-circle-xmark me-2" style="color:rgba(255,100,100,0.6);"></i>No results found for <strong>"' + q + '"</strong></div>';
            return;
        }

        var sections = [...new Set(hits.map(function (h) { return h.section; }))];
        var html = '';
        sections.forEach(function (sec) {
            html += '<div class="sdn-section-label"><i class="fa-solid fa-folder-open me-1"></i>' + sec + '</div>';
            hits.filter(function (h) { return h.section === sec; }).forEach(function (it) {
                html += '<a class="sdn-item" href="' + it.url + '" onclick="closeSearch()">'
                      + '<div class="sdn-icon"><i class="fa-solid ' + it.icon + '" style="font-size:13px;"></i></div>'
                      + '<div><div class="sdn-title">' + hl(it.title, q) + '</div>'
                      + '<div class="sdn-sub">' + hl(it.sub, q) + '</div></div>'
                      + '</a>';
            });
        });

        box.innerHTML = html;
    };

    /* Close on Escape or clicking the backdrop */
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeSearch();
    });

    document.getElementById('searchOverlay').addEventListener('click', function (e) {
        if (e.target === this) closeSearch();
    });
})();
</script>
<script>const CI_BASE_URL = "<?= base_url() ?>";</script>
<!-- GLOBAL SEARCH OVERLAY -->
<div id="searchOverlay" class="d-none">
    <div class="search-overlay-inner">
        <div class="search-overlay-bar">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input class="search-overlay-input"
                   id="globalSearchInput"
                   type="text"
                   placeholder="Search activities, bookings, sea conditions…"
                   autocomplete="off"
                   oninput="runGlobalSearch(this.value)">
            <button class="btn-close-search" onclick="closeSearch()">
                <i class="fa-solid fa-xmark me-1"></i> Close
            </button>
        </div>
        <div id="searchResultsBox" class="search-results-box">
            <div class="sdn-hint">
                <i class="fa-solid fa-magnifying-glass me-2"></i>
                Start typing to search the entire system…
            </div>
        </div>
    </div>
</div>
<!-- END GLOBAL SEARCH OVERLAY -->
</body>
</html>