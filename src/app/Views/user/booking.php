<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Session | Waves Water Sports</title>
    <link rel="stylesheet" href="<?= base_url('bootstrap5/css/bootstrap.min.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root { --deep-blue: #052c39; --ocean-blue: #0a5872; --accent-cyan: #48cae4; --soft-white: #f4f9fc; }
        body { font-family: 'Poppins', sans-serif; background: linear-gradient(180deg, var(--accent-cyan) 0%, var(--ocean-blue) 40%, var(--deep-blue) 100%); background-attachment: fixed; color: var(--soft-white); margin: 0; }
        .highlight-brand { font-weight: 700; color: #48cae4; text-shadow: 0 0 10px rgba(72, 202, 228, 0.4); letter-spacing: 1px; }
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
        /* ============================================================ */

        .welcome-hero { background: linear-gradient(rgba(5,44,57,0.5), rgba(5,44,57,0.7)), url('<?= base_url('images/background.png') ?>'); background-size: cover; background-position: center; background-attachment: fixed; padding: 145px 40px; color: white; border-radius: 0 0 80px 80px; margin-bottom: 60px; }
        footer { background: var(--deep-blue); padding: 100px 0 40px 0; color: rgba(255,255,255,0.6) !important; border-top: 1px solid rgba(255,255,255,0.1); width: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; }
        .social-icons { display: flex; justify-content: center; gap: 20px; margin-bottom: 25px; }
        .social-icons i { color: rgba(255,255,255,0.7); transition: 0.3s; cursor: pointer; font-size: 1.5rem; }
        .social-icons i:hover { color: var(--accent-cyan); transform: scale(1.2); }
        .booking-layout { display: grid; grid-template-columns: 1.6fr 1fr; gap: 28px; max-width: 1200px; margin: 0 auto 80px; padding: 0 24px; align-items: start; }
        .step-card { background: rgba(255,255,255,0.08); backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.15); border-radius: 28px; padding: 32px; margin-bottom: 24px; transition: border-color 0.3s; }
        .step-card:hover { border-color: rgba(72,202,228,0.25); }
        .step-label { display: inline-flex; align-items: center; gap: 10px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.8px; color: var(--accent-cyan); margin-bottom: 6px; }
        .section-sep { width: 50px; height: 2px; background: linear-gradient(90deg, var(--accent-cyan), transparent); border-radius: 2px; margin-bottom: 22px; }
        .activity-highlight { background: linear-gradient(135deg, rgba(10,88,114,0.5) 0%, rgba(5,44,57,0.7) 100%); border-left: 5px solid var(--accent-cyan); border-radius: 18px; padding: 24px 28px; position: relative; margin-bottom: 10px; }
        .activity-highlight h3 { font-size: 1.6rem; font-weight: 700; margin-bottom: 6px; color: white; padding-right: 160px; }
        .activity-highlight p { color: rgba(255,255,255,0.6); font-size: 0.88rem; margin-bottom: 18px; }
        .activity-meta { display: grid; grid-template-columns: 1fr 1fr; gap: 8px 20px; font-size: 0.82rem; color: rgba(255,255,255,0.75); }
        .activity-meta span { display: flex; align-items: center; gap: 8px; }
        .activity-meta i { color: var(--accent-cyan); width: 14px; }
        .act-card-actions { position: absolute; top: 14px; right: 14px; display: flex; align-items: center; gap: 6px; }
        .btn-cancel-act { background: rgba(255,107,107,0.15); border: 1px solid rgba(255,107,107,0.35); color: #ff9999; border-radius: 50%; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; font-size: 0.85rem; cursor: pointer; transition: 0.25s; text-decoration: none; }
        .btn-cancel-act:hover { background: #ff6b6b; color: white; border-color: #ff6b6b; }
        .act-count-badge { display: none; align-items: center; justify-content: center; background: var(--accent-cyan); color: var(--deep-blue); font-size: 0.65rem; font-weight: 800; width: 20px; height: 20px; border-radius: 50%; margin-left: 4px; }
        .activity-picker { display: none; }
        .activity-picker.show { display: block; }
        .picker-info-label { font-size: 0.8rem; color: rgba(255,255,255,0.5); margin-bottom: 10px; }
        .activity-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px; margin-top: 14px; }
        .activity-option { background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.15); border-radius: 16px; padding: 16px 18px; cursor: pointer; transition: 0.25s; display: flex; align-items: center; gap: 12px; color: white; font-size: 0.9rem; font-weight: 500; }
        .activity-option:hover { background: rgba(72,202,228,0.15); border-color: var(--accent-cyan); color: var(--accent-cyan); }
        .activity-option.already-selected { opacity: 0.3; pointer-events: none; cursor: not-allowed; }
        .activity-option i { color: var(--accent-cyan); font-size: 1.1rem; width: 20px; text-align: center; }
        .btn-add-activity { display: inline-flex; align-items: center; gap: 8px; background: rgba(72,202,228,0.12); border: 1px dashed rgba(72,202,228,0.5); color: var(--accent-cyan); border-radius: 50px; padding: 8px 20px; font-size: 0.82rem; font-weight: 600; cursor: pointer; transition: 0.25s; margin-top: 14px; width: 100%; justify-content: center; }
        .btn-add-activity:hover { background: rgba(72,202,228,0.25); border-style: solid; }
        .calendar-header-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px; }
        .calendar-header-row h4 { font-size: 1.1rem; font-weight: 700; }
        .cal-nav { display: flex; gap: 8px; }
        .cal-nav button { background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); color: white; width: 34px; height: 34px; border-radius: 50%; cursor: pointer; transition: 0.3s; display: flex; align-items: center; justify-content: center; font-size: 0.82rem; }
        .cal-nav button:hover { background: var(--accent-cyan); color: var(--deep-blue); border-color: var(--accent-cyan); }
        .cal-day-headers { display: grid; grid-template-columns: repeat(7, 1fr); gap: 6px; text-align: center; margin-bottom: 8px; }
        .cal-day-headers span { font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.8px; color: var(--accent-cyan); padding: 4px 0; }
        .calendar-days-grid { display: grid; grid-template-columns: repeat(7, 1fr); gap: 6px; }
        .day-box { aspect-ratio: 1; display: flex; align-items: center; justify-content: center; border-radius: 12px; font-size: 0.82rem; font-weight: 600; cursor: default; min-height: 36px; transition: all 0.25s ease; }
        .day-box.empty { background: transparent; }
        .day-box.available { background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.12); color: white; cursor: pointer; }
        .day-box.available:hover { background: var(--accent-cyan); color: var(--deep-blue); border-color: var(--accent-cyan); transform: scale(1.1); }
        .day-box.past { background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05); color: rgba(255,255,255,0.2); cursor: not-allowed; }
        .day-box.booked { background: rgba(255,107,107,0.18); border: 1px solid rgba(255,107,107,0.35); color: #ff9999; cursor: not-allowed; }
        .day-box.today { border: 2px solid var(--accent-cyan); background: rgba(72,202,228,0.1); color: var(--accent-cyan); }
        .day-box.selected { background: var(--accent-cyan) !important; color: var(--deep-blue) !important; border: none !important; font-weight: 700 !important; box-shadow: 0 4px 14px rgba(72,202,228,0.45) !important; }
        .cal-legend { display: flex; gap: 20px; margin-top: 18px; padding-top: 16px; border-top: 1px solid rgba(255,255,255,0.08); font-size: 0.78rem; color: rgba(255,255,255,0.6); }
        .cal-legend-item { display: flex; align-items: center; gap: 7px; }
        .cal-dot { width: 12px; height: 12px; border-radius: 3px; }
        .cal-dot.available { background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.2); }
        .cal-dot.booked { background: rgba(255,107,107,0.5); }
        .cal-dot.today { border: 2px solid var(--accent-cyan); background: rgba(72,202,228,0.12); }
        .time-slots-wrapper { max-height: 220px; overflow-y: auto; border: 1px solid rgba(255,255,255,0.12); border-radius: 14px; padding: 10px; background: rgba(255,255,255,0.03); }
        .time-slot-btn { display: flex; align-items: center; justify-content: space-between; width: 100%; padding: 12px 16px; margin-bottom: 8px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.12); border-radius: 10px; color: white; cursor: pointer; transition: 0.25s; font-size: 0.87rem; font-weight: 500; }
        .time-slot-btn:last-child { margin-bottom: 0; }
        .time-slot-btn:hover { border-color: rgba(72,202,228,0.5); background: rgba(72,202,228,0.1); }
        .time-slot-btn.active { background: var(--accent-cyan); color: var(--deep-blue); border-color: var(--accent-cyan); font-weight: 700; }
        .time-slot-btn.active .slot-status { background: rgba(5,44,57,0.3); color: var(--deep-blue); }
        .time-slot-btn.unavailable { background: rgba(255,107,107,0.08); color: rgba(255,255,255,0.35); border-color: rgba(255,107,107,0.2); cursor: not-allowed; }
        .slot-status { font-size: 0.72rem; padding: 3px 10px; border-radius: 50px; font-weight: 600; }
        .slot-status.open { background: rgba(40,167,69,0.2); color: #5ddb8a; }
        .slot-status.taken { background: rgba(255,107,107,0.2); color: #ff9999; }
        .slots-loading { text-align: center; padding: 20px; opacity: 0.5; }
        .form-row-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
        .field-group { margin-bottom: 18px; }
        .field-label { display: block; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: var(--accent-cyan); margin-bottom: 8px; }
        .form-control-wave, .form-select-wave { width: 100%; background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.15); border-radius: 14px; color: white; padding: 12px 16px; font-family: 'Poppins', sans-serif; font-size: 0.9rem; transition: border-color 0.3s; -webkit-appearance: none; }
        .form-control-wave:focus, .form-select-wave:focus { outline: none; border-color: rgba(72,202,228,0.6); background: rgba(255,255,255,0.1); box-shadow: 0 0 0 3px rgba(72,202,228,0.12); color: white; }
        .form-control-wave::placeholder { color: rgba(255,255,255,0.3); }
        .form-select-wave option { background: #073d52; color: white; }
        textarea.form-control-wave { resize: vertical; min-height: 90px; }
        .form-hint { font-size: 0.76rem; color: rgba(255,255,255,0.5); margin-top: 5px; }
        .conditions-box { background: rgba(72,202,228,0.06); border: 1px solid rgba(72,202,228,0.2); border-radius: 16px; padding: 20px 24px; }
        .conditions-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; text-align: center; }
        .condition-item { font-size: 0.82rem; }
        .condition-item strong { display: block; font-size: 1.1rem; color: var(--accent-cyan); margin-bottom: 2px; }
        .condition-item span { color: rgba(255,255,255,0.5); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.8px; }
        .safety-badge { display: inline-flex; align-items: center; gap: 8px; padding: 8px 18px; border-radius: 50px; font-weight: 700; font-size: 0.85rem; }
        .safe-bg { background: rgba(40,167,69,0.15); color: #5ddb8a; border: 1px solid rgba(40,167,69,0.35); }
        .summary-sidebar { position: sticky; top: 90px; }
        .summary-card { background: var(--soft-white); color: var(--deep-blue); border-radius: 28px; padding: 32px; box-shadow: 0 24px 60px rgba(0,0,0,0.35); margin-bottom: 20px; }
        .summary-card h4 { font-size: 1.25rem; font-weight: 900; border-bottom: 2px solid rgba(10,88,114,0.15); padding-bottom: 14px; margin-bottom: 22px; color: var(--deep-blue); }
        .summary-row { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 13px; font-size: 0.87rem; }
        .summary-row .s-label { color: rgba(5,44,57,0.5); }
        .summary-row .s-value { font-weight: 600; color: var(--deep-blue); text-align: right; max-width: 55%; }
        .summary-divider { border: none; border-top: 1px solid rgba(10,88,114,0.12); margin: 18px 0; }
        .summary-total-box { background: linear-gradient(135deg, rgba(10,88,114,0.08) 0%, rgba(72,202,228,0.1) 100%); border: 1px solid rgba(10,88,114,0.15); border-radius: 14px; padding: 16px 18px; margin-bottom: 20px; }
        .price-breakdown { font-size: 0.83rem; color: rgba(5,44,57,0.6); margin-bottom: 10px; }
        .price-breakdown-row { display: flex; justify-content: space-between; margin-bottom: 5px; }
        .price-total-row { display: flex; justify-content: space-between; align-items: center; border-top: 1px solid rgba(10,88,114,0.15); padding-top: 10px; }
        .price-total-row .total-label { font-weight: 700; font-size: 0.9rem; color: var(--deep-blue); }
        .price-total-row .total-amount { font-size: 1.7rem; font-weight: 900; color: var(--ocean-blue); }
        .form-check-label { font-size: 0.83rem; color: rgba(5,44,57,0.7); }
        .form-check-input:checked { background-color: var(--ocean-blue); border-color: var(--ocean-blue); }
        .btn-confirm { display: block; width: 100%; padding: 16px; background: linear-gradient(135deg, var(--ocean-blue) 0%, var(--deep-blue) 100%); color: white; border: none; border-radius: 16px; font-size: 1rem; font-weight: 700; cursor: pointer; transition: all 0.3s; box-shadow: 0 8px 24px rgba(10,88,114,0.35); }
        .btn-confirm:hover { background: linear-gradient(135deg, var(--accent-cyan) 0%, var(--ocean-blue) 100%); color: var(--deep-blue); transform: translateY(-3px); box-shadow: 0 14px 35px rgba(72,202,228,0.35); }
        .btn-confirm:disabled { opacity: 0.6; cursor: not-allowed; transform: none; }
        .slots-info-card { background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); border-radius: 20px; padding: 20px 22px; }
        .slots-info-card p { font-size: 0.82rem; color: rgba(255,255,255,0.6); margin: 0 0 6px; }
        .slots-info-card p:last-child { margin: 0; }
        .slots-info-card i { color: var(--accent-cyan); margin-right: 6px; }
        .alert-wave { border-radius: 14px; padding: 14px 18px; margin-bottom: 20px; font-size: 0.9rem; font-weight: 500; }
        .alert-wave-danger { background: rgba(220,53,69,0.15); border: 1px solid rgba(220,53,69,0.4); color: #ff9999; }
        .alert-wave-success { background: rgba(40,167,69,0.15); border: 1px solid rgba(40,167,69,0.4); color: #5ddb8a; }
        #scrollBtn { position: fixed; right: 20px; top: 50%; transform: translateY(-50%); z-index: 1000; width: 46px; height: 140px; background: rgba(10,88,114,0.85); backdrop-filter: blur(10px); border: 2px solid var(--accent-cyan); border-radius: 60px; display: flex; align-items: center; justify-content: center; color: var(--accent-cyan); cursor: pointer; transition: all 0.3s ease; box-shadow: 0 12px 30px rgba(0,0,0,0.3); }
        #scrollBtn:hover { background: var(--accent-cyan); color: var(--deep-blue); right: 24px; }
        #scrollBtn i { font-size: 2.2rem; transition: transform 0.5s cubic-bezier(0.68,-0.55,0.27,1.55); }
        .rotate-up { transform: rotate(180deg); }
        @media (max-width: 992px) { .booking-layout { grid-template-columns: 1fr; } .summary-sidebar { position: static; } .form-row-2 { grid-template-columns: 1fr; } .activity-meta { grid-template-columns: 1fr; } .conditions-grid { grid-template-columns: 1fr; gap: 8px; } .activity-grid { grid-template-columns: 1fr; } }
        html { scroll-behavior: smooth; }
        .tooltip-btn { position: relative; cursor: pointer; }
        .tooltip-btn::after { content: attr(data-tooltip); position: absolute; bottom: 125%; left: 50%; transform: translateX(-50%); background: var(--deep-blue); color: var(--soft-white); padding: 8px 14px; border-radius: 8px; font-size: 0.75rem; font-weight: 500; white-space: nowrap; opacity: 0; visibility: hidden; transition: 0.3s ease; pointer-events: none; border: 1px solid var(--accent-cyan); z-index: 2000; box-shadow: 0 8px 20px rgba(0,0,0,0.4); }
        .tooltip-btn:hover::after { opacity: 1; visibility: visible; }
        .sum-activity-line { background: rgba(10,88,114,0.07); border-radius: 10px; padding: 10px 12px; margin-bottom: 7px; }
        .sum-activity-line:last-child { margin-bottom: 0; }
        .sal-name { font-size: 0.85rem; font-weight: 700; color: var(--ocean-blue); margin-bottom: 4px; }
        .sal-detail { display: flex; justify-content: space-between; font-size: 0.78rem; color: rgba(5,44,57,0.55); }
        .sal-price { font-weight: 700; color: var(--ocean-blue); }
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
            <a href="<?= base_url('user/booking') ?>" class="nav-link-custom active">Book & Reserve</a>
            <a href="<?= base_url('user/my-bookings') ?>" class="nav-link-custom">My Bookings</a>
            <a href="<?= base_url('user/reviews') ?>" class="nav-link-custom">Reviews</a>
        </div>
        <!-- UPDATED: added Help button beside Logout -->
        <div class="logout-wrapper">
            <button class="btn-help-custom" onclick="document.getElementById('helpModal').classList.remove('d-none')">
                <i class="fa-solid fa-circle-question me-1"></i> Help
            </button>
            <a href="<?= base_url('logout') ?>" class="btn-logout-custom">
                <i class="fa-solid fa-power-off me-1"></i> Logout
            </a>
        </div>
    </div>
</nav>

<header class="welcome-hero">
    <div class="container">
        <h1 class="display-4 fw-bold mb-3">Book Your Water Adventure</h1>
        <p class="lead opacity-90 mx-auto" style="max-width: 800px;">Complete your reservation for your chosen activity at Matabungkay Beach. Select your schedule and confirm your booking.</p>
    </div>
</header>

<script>
    const BOOKING_SLOTS_URL = "<?= base_url('user/booking/slots') ?>";
    const ACTIVITY_PRICING  = <?= json_encode($pricing) ?>;
    const ACTIVITY_MAX      = <?= json_encode($maxRiders) ?>;
    const ACTIVITY_DURATION = <?= json_encode($durations) ?>;
    let selectedActivity     = "<?= esc($selectedActivity) ?>";
    let bookedDates          = <?= json_encode($bookedDates) ?>;
    let selectedDate         = '';
    let selectedTime         = '';
</script>

<form action="<?= base_url('user/booking/store') ?>" method="POST" id="bookingForm">
    <?= csrf_field() ?>
    <input type="hidden" name="activity"        id="f_activity"       value="<?= esc($selectedActivity) ?>">
    <input type="hidden" name="all_activities"  id="f_all_activities" value="<?= esc($selectedActivity) ?>">
    <input type="hidden" name="date"            id="f_date"           value="">
    <input type="hidden" name="time"            id="f_time"           value="">
    <input type="hidden" name="participants"    id="f_participants"   value="1">

<div class="booking-layout">

    <div class="steps-column">

        <?php if (session()->getFlashdata('error')): ?>
        <div class="alert-wave alert-wave-danger">
            <i class="fa-solid fa-circle-exclamation me-2"></i><?= session()->getFlashdata('error') ?>
        </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert-wave alert-wave-danger">
            <?php foreach (session()->getFlashdata('errors') as $err): ?>
                <div><i class="fa-solid fa-circle-exclamation me-2"></i><?= esc($err) ?></div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <div class="step-card">
            <div class="step-label">
                <i class="fa-solid fa-person-surfing"></i> Step 1 — Your Activity
                <span class="act-count-badge" id="act-badge"></span>
            </div>
            <div class="section-sep"></div>
            <div id="activity-display"></div>
            <div id="activity-empty" style="display:none;">
                <p class="opacity-50 mb-0" style="font-size:0.9rem;">
                    <i class="fa-solid fa-circle-info me-2"></i>No activity selected. Pick one below.
                </p>
            </div>
            <div class="activity-picker" id="activity-picker">
                <p class="picker-info-label" id="picker-label">Choose an activity to add:</p>
                <div class="activity-grid">
                    <div class="activity-option" data-activity="Jet Ski" onclick="pickActivity('Jet Ski')">
                        <i class="fa-solid fa-person-water-polo"></i> Jet Ski
                    </div>
                    <div class="activity-option" data-activity="Banana Boat" onclick="pickActivity('Banana Boat')">
                        <i class="fa-solid fa-ship"></i> Banana Boat
                    </div>
                    <div class="activity-option" data-activity="Kayaking" onclick="pickActivity('Kayaking')">
                        <i class="fa-solid fa-water"></i> Kayaking
                    </div>
                    <div class="activity-option" data-activity="Flying Saucer" onclick="pickActivity('Flying Saucer')">
                        <i class="fa-solid fa-circle-radiation"></i> Flying Saucer
                    </div>
                </div>
            </div>
            <div id="btn-add-wrapper" style="display:none; margin-top:14px;">
                <button type="button" class="btn-add-activity" onclick="showPicker()">
                    <i class="fa-solid fa-plus"></i> Add Another Activity
                </button>
            </div>
        </div>

        <div class="step-card">
            <div class="step-label"><i class="fa-regular fa-calendar-days"></i> Step 2 — Choose Your Date</div>
            <div class="section-sep"></div>
            <div class="calendar-header-row">
                <h4 id="cal-month-year">Loading…</h4>
                <div class="cal-nav">
                    <button type="button" id="prev-month">&#9664;</button>
                    <button type="button" id="next-month">&#9654;</button>
                </div>
            </div>
            <div class="cal-day-headers">
                <span>S</span><span>M</span><span>T</span><span>W</span><span>T</span><span>F</span><span>S</span>
            </div>
            <div class="calendar-days-grid" id="calendar-days"></div>
            <div class="cal-legend">
                <div class="cal-legend-item"><div class="cal-dot available"></div> Available</div>
                <div class="cal-legend-item"><div class="cal-dot booked"></div> Fully Booked</div>
                <div class="cal-legend-item"><div class="cal-dot today"></div> Today</div>
            </div>
        </div>

        <div class="step-card">
            <div class="step-label"><i class="fa-regular fa-clock"></i> Step 3 — Select Time Slot</div>
            <div class="section-sep"></div>
            <div class="time-slots-wrapper" id="time-slots-container">
                <div class="slots-loading">
                    <i class="fa-solid fa-calendar-days me-2"></i>Please select a date first.
                </div>
            </div>
            <p class="form-hint mt-2" id="slots-count-hint"></p>
        </div>

        <div class="step-card">
            <div class="step-label"><i class="fa-solid fa-pen-to-square"></i> Step 4 — Your Details</div>
            <div class="section-sep"></div>
            <div class="form-row-2">
                <div class="field-group">
                    <label class="field-label">Participants</label>
                    <div id="participants-container">
                        <p class="form-hint" style="opacity:0.5;">Select an activity first.</p>
                    </div>
                </div>
                <div class="field-group">
                    <label class="field-label">Special Requests</label>
                    <textarea class="form-control-wave" name="special_requests" rows="3" placeholder="Special requests, health concerns…"></textarea>
                </div>
            </div>
        </div>

        <div class="step-card" style="border-color: rgba(72,202,228,0.2);">
            <div class="step-label"><i class="fa-solid fa-tower-broadcast"></i> Step 5 — Check Current Sea Conditions by MARISENSE</div>
            <div class="section-sep"></div>
            <div class="conditions-box">
                <div class="conditions-grid mb-4">
                    <div class="condition-item"><strong>10 kts</strong><span>Wind Speed</span></div>
                    <div class="condition-item"><strong>0.9 m</strong><span>Wave Height</span></div>
                    <div class="condition-item"><strong>5 s</strong><span>Wave Period</span></div>
                </div>
                <div class="text-center">
                    <div class="safety-badge safe-bg">
                        <i class="fa-solid fa-circle-check"></i> Conditions Safe for Activity
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="summary-sidebar">
        <div class="summary-card">
            <div class="step-label"><i class="fa-solid fa-pen-to-square"></i> Step 6 — Confirm It</div>
            <h4>Booking Summary</h4>
            <div class="summary-row">
                <span class="s-label">Activity</span>
                <span class="s-value" id="summary-activity">—</span>
            </div>
            <div class="summary-row">
                <span class="s-label">Location</span>
                <span class="s-value">Matabungkay Beach</span>
            </div>
            <div class="summary-row">
                <span class="s-label">Date</span>
                <span class="s-value" id="summary-date">Not selected</span>
            </div>
            <div class="summary-row">
                <span class="s-label">Time</span>
                <span class="s-value" id="summary-time">Not selected</span>
            </div>
            <div class="summary-row">
                <span class="s-label">Duration</span>
                <span class="s-value" id="summary-duration">—</span>
            </div>
            <div class="summary-row">
                <span class="s-label">Participants</span>
                <span class="s-value" id="summary-participants">—</span>
            </div>
            <hr class="summary-divider">
            <div class="summary-total-box">
                <div class="price-breakdown" id="summary-base-price"></div>
                <div class="price-total-row">
                    <span class="total-label">Total</span>
                    <span class="total-amount" id="summary-total">—</span>
                </div>
            </div>
            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" name="guidelines" id="guidelines" value="1" required>
                <label class="form-check-label" for="guidelines">
                    I have read and agree to the safety guidelines and activity rules.
                </label>
            </div>
            <button type="submit" class="btn-confirm tooltip-btn" id="confirm-btn" disabled
                data-tooltip="Click here to Confirm your Reservation">
                <i class="fas fa-check-circle me-2"></i> Confirm Reservation
            </button>
            <p class="form-hint text-center mt-2" id="confirm-hint">Please select a date and time to continue.</p>
        </div>

        <div class="slots-info-card">
            <p><i class="fas fa-shield-halved"></i> Safety gear provided for all activities</p>
            <p><i class="fas fa-rotate-left"></i> Free cancellation up to 24 hrs before</p>
            <p><i class="fas fa-headset"></i> On-site crew available at all times</p>
        </div>
    </div>

</div>
</form>

<footer class="text-center">
    <div class="container d-flex flex-column align-items-center">
        <div class="mb-4 opacity-75">For inquiries, message us through our social media platforms.</div>
        <div class="social-icons">
            <a href="https://www.facebook.com/profile.php?id=100077368436521" target="_blank"><i class="fa-brands fa-facebook"></i></a>
            <a href="https://instagram.com" target="_blank"><i class="fa-brands fa-instagram"></i></a>
            <a href="https://twitter.com" target="_blank"><i class="fa-brands fa-twitter"></i></a>
        </div>
        <div class="opacity-50">&copy; 2026 Waves Water Sports | Tech by <span class="text-info fw-bold">MARISENSE</span></div>
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

<div id="scrollBtn" onclick="smartScroll()" title="Navigate">
    <i class="fa-solid fa-arrow-down" id="scrollIcon"></i>
</div>

<script>
// ==========================================================================
// ACTIVITY DATA
// ==========================================================================
const activityData = {
    'Jet Ski':       { desc: 'Ride across the open sea on a powerful jet ski. Perfect for thrill-seekers who enjoy speed and ocean adventure.', difficulty: 'Moderate' },
    'Banana Boat':   { desc: 'A fun group ride on an inflatable banana-shaped boat pulled by a speedboat. Expect splashes and laughter.',       difficulty: 'Easy' },
    'Kayaking':      { desc: 'Paddle along the calm waters and enjoy the scenic view of Matabungkay Beach.',                                    difficulty: 'Easy' },
    'Flying Saucer': { desc: 'An exciting inflatable ride that spins and glides across the waves.',                                             difficulty: 'Moderate' },
};

const PER_PERSON_ACTIVITIES = ['Banana Boat', 'Flying Saucer'];

let selectedActivities = selectedActivity ? [selectedActivity] : [];
let pickerVisible       = false;

function initActivityDisplay() {
    renderActivityList();
    renderSummaryActivities();
    if (selectedActivities.length === 0) {
        showPicker();
    } else {
        hidePicker();
    }
}

function showPicker() {
    pickerVisible = true;
    document.getElementById('activity-picker').classList.add('show');
    document.getElementById('btn-add-wrapper').style.display = 'none';
    refreshPickerOptions();
}

function hidePicker() {
    pickerVisible = false;
    document.getElementById('activity-picker').classList.remove('show');
    if (selectedActivities.length > 0) {
        document.getElementById('btn-add-wrapper').style.display = 'block';
    }
}

function refreshPickerOptions() {
    document.querySelectorAll('.activity-option').forEach(function(el) {
        const act = el.getAttribute('data-activity');
        if (selectedActivities.includes(act)) {
            el.classList.add('already-selected');
        } else {
            el.classList.remove('already-selected');
        }
    });
}

function pickActivity(act) {
    if (selectedActivities.includes(act)) return;
    selectedActivities.push(act);
    document.getElementById('f_activity').value       = selectedActivities[0];
    document.getElementById('f_all_activities').value = selectedActivities.join(',');
    hidePicker();
    renderActivityList();
    renderSummaryActivities();
    checkConfirmReady();

    const primary = selectedActivities[0];
    fetch(`<?= base_url('user/booking/booked-dates') ?>?activity=${encodeURIComponent(primary)}`)
        .then(function(r) { return r.json(); })
        .then(function(data) {
            bookedDates = data.bookedDates || [];
            renderCalendar();
            selectedDate = ''; selectedTime = '';
            document.getElementById('f_date').value = '';
            document.getElementById('f_time').value = '';
            document.getElementById('summary-date').textContent = 'Not selected';
            document.getElementById('summary-time').textContent = 'Not selected';
            document.getElementById('time-slots-container').innerHTML =
                '<div class="slots-loading"><i class="fa-solid fa-calendar-days me-2"></i>Please select a date first.</div>';
            document.getElementById('slots-count-hint').textContent = '';
            checkConfirmReady();
        });
}

function removeActivity(act) {
    selectedActivities = selectedActivities.filter(function(a) { return a !== act; });
    document.getElementById('f_activity').value       = selectedActivities.length > 0 ? selectedActivities[0] : '';
    document.getElementById('f_all_activities').value = selectedActivities.join(',');
    renderActivityList();
    renderSummaryActivities();
    if (selectedActivities.length === 0) {
        showPicker();
        document.getElementById('btn-add-wrapper').style.display = 'none';
    }
    checkConfirmReady();
}

function renderActivityList() {
    const container = document.getElementById('activity-display');
    const emptyEl   = document.getElementById('activity-empty');
    const badge     = document.getElementById('act-badge');

    if (selectedActivities.length > 0) {
        badge.textContent = selectedActivities.length;
        badge.style.display = 'inline-flex';
    } else {
        badge.style.display = 'none';
    }

    if (selectedActivities.length === 0) {
        container.innerHTML = '';
        emptyEl.style.display = 'block';
        return;
    }

    emptyEl.style.display = 'none';

    container.innerHTML = selectedActivities.map(function(act) {
        const data  = activityData[act] || {};
        const max   = ACTIVITY_MAX[act]      || 1;
        const dur   = ACTIVITY_DURATION[act] || 0;
        const price = ACTIVITY_PRICING[act]  || 0;
        const pp    = PER_PERSON_ACTIVITIES.includes(act);

        return '<div class="activity-highlight">'
            + '<div class="act-card-actions">'
            +   '<button type="button" class="btn-cancel-act" onclick="removeActivity(\'' + act + '\')" title="Remove ' + act + '">'
            +     '<i class="fa-solid fa-xmark"></i>'
            +   '</button>'
            + '</div>'
            + '<h3>' + act + '</h3>'
            + '<p>' + (data.desc || '') + '</p>'
            + '<div class="activity-meta">'
            +   '<span><i class="fa-solid fa-clock"></i> Duration: ' + dur + ' mins</span>'
            +   '<span><i class="fa-solid fa-users"></i> Max Riders: ' + max + ' persons</span>'
            +   '<span><i class="fa-solid fa-vest"></i> Gear: Life Vest</span>'
            +   '<span><i class="fa-solid fa-gauge-high"></i> ' + (data.difficulty || '—') + '</span>'
            +   '<span><i class="fa-solid fa-tag"></i> ₱' + price.toLocaleString() + (pp ? ' / person' : '') + '</span>'
            + '</div>'
            + '</div>';
    }).join('');
}

function clearActivity() {
    selectedActivities = [];
    document.getElementById('f_activity').value       = '';
    document.getElementById('f_all_activities').value = '';
    renderActivityList();
    renderSummaryActivities();
    showPicker();
    checkConfirmReady();
}

var participantCounts = {};

function updateActivityParticipants(act, val) {
    participantCounts[act] = parseInt(val);
    var total = 0;
    Object.values(participantCounts).forEach(function(v) { total += v; });
    document.getElementById('f_participants').value = total;
    updateSummaryParticipants();
    recalcTotal();
}

function updateSummaryParticipants() {
    if (selectedActivities.length === 0) {
        document.getElementById('summary-participants').textContent = '—';
        return;
    }
    var parts = selectedActivities.map(function(act) {
        var c = participantCounts[act] || 1;
        return act + ': ' + c + ' person' + (c > 1 ? 's' : '');
    });
    document.getElementById('summary-participants').textContent = parts.join(' · ');
}

function renderParticipantsDropdowns() {
    var container = document.getElementById('participants-container');

    if (selectedActivities.length === 0) {
        container.innerHTML = '<p class="form-hint" style="opacity:0.5;">Select an activity first.</p>';
        return;
    }

    container.innerHTML = selectedActivities.map(function(act) {
        var max     = ACTIVITY_MAX[act] || 1;
        var current = participantCounts[act] || 1;
        if (current > max) { current = 1; }
        participantCounts[act] = current;

        var options = '';
        for (var i = 1; i <= max; i++) {
            options += '<option value="' + i + '"' + (i === current ? ' selected' : '') + '>'
                     + i + ' Person' + (i > 1 ? 's' : '') + '</option>';
        }

        return '<div style="margin-bottom:12px;">'
            + '<p style="font-size:0.78rem;color:rgba(255,255,255,0.6);margin-bottom:5px;font-weight:600;">'
            + '<i class="fa-solid fa-person-swimming me-1" style="color:var(--accent-cyan);"></i>' + act
            + ' <span style="opacity:0.5;font-weight:400;">(max ' + max + ')</span></p>'
            + '<select class="form-select-wave" onchange="updateActivityParticipants(\'' + act + '\', this.value)">'
            + options
            + '</select>'
            + '</div>';
    }).join('');

    updateSummaryParticipants();

    var totalP = 0;
    Object.values(participantCounts).forEach(function(v) { totalP += v; });
    document.getElementById('f_participants').value = totalP || 1;
}

function cleanParticipantCounts() {
    Object.keys(participantCounts).forEach(function(act) {
        if (!selectedActivities.includes(act)) delete participantCounts[act];
    });
    selectedActivities.forEach(function(act) {
        if (!participantCounts[act]) participantCounts[act] = 1;
    });
}

function recalcTotal() {
    var total = 0;
    selectedActivities.forEach(function(act) {
        var price = ACTIVITY_PRICING[act] || 0;
        var count = participantCounts[act] || 1;
        if (PER_PERSON_ACTIVITIES.includes(act)) {
            total += price * count;
        } else {
            total += price;
        }
    });
    document.getElementById('summary-total').textContent = total ? '₱' + total.toLocaleString() : '—';
}

function renderSummaryActivities() {
    cleanParticipantCounts();
    renderParticipantsDropdowns();

    document.getElementById('summary-activity').textContent =
        selectedActivities.length > 0 ? selectedActivities.join(', ') : '—';

    if (selectedActivities.length > 0) {
        var durParts = selectedActivities.map(function(a) {
            return a + ': ' + (ACTIVITY_DURATION[a] || 0) + ' mins';
        });
        document.getElementById('summary-duration').textContent = durParts.join(' · ');
    } else {
        document.getElementById('summary-duration').textContent = '—';
    }

    var total = 0;
    var breakdownHTML = '';

    if (selectedActivities.length === 0) {
        breakdownHTML = '';
        document.getElementById('summary-total').textContent = '—';
    } else {
        selectedActivities.forEach(function(act) {
            var price = ACTIVITY_PRICING[act] || 0;
            var pp    = PER_PERSON_ACTIVITIES.includes(act);
            var count = participantCounts[act] || 1;
            var line  = pp ? price * count : price;
            total += line;
            breakdownHTML +=
                '<div class="sum-activity-line">'
                + '<div class="sal-name">' + act + '</div>'
                + '<div class="sal-detail">'
                +   '<span>' + (ACTIVITY_DURATION[act] || 0) + ' mins · ' + count + ' person' + (count > 1 ? 's' : '') + (pp ? ' · ₱' + price.toLocaleString() + ' × ' + count : '') + '</span>'
                +   '<span class="sal-price">₱' + line.toLocaleString() + '</span>'
                + '</div>'
                + '</div>';
        });
        document.getElementById('summary-total').textContent = '₱' + total.toLocaleString();
    }

    document.getElementById('summary-base-price').innerHTML = breakdownHTML;
    updateSummaryParticipants();
}

const monthNames = ['January','February','March','April','May','June','July','August','September','October','November','December'];
let currentDate  = new Date();

function renderCalendar() {
    const yr = currentDate.getFullYear(), mo = currentDate.getMonth();
    document.getElementById('cal-month-year').textContent = `${monthNames[mo]} ${yr}`;

    const firstDay    = new Date(yr, mo, 1).getDay();
    const daysInMonth = new Date(yr, mo + 1, 0).getDate();
    const todayStr    = formatDate(new Date());
    const grid        = document.getElementById('calendar-days');
    grid.innerHTML    = '';

    for (let i = 0; i < firstDay; i++) {
        const d = document.createElement('div'); d.className = 'day-box empty'; grid.appendChild(d);
    }

    for (let day = 1; day <= daysInMonth; day++) {
        const d       = document.createElement('div');
        d.className   = 'day-box';
        d.textContent = day;
        const dateStr = `${yr}-${String(mo+1).padStart(2,'0')}-${String(day).padStart(2,'0')}`;
        const isToday = dateStr === todayStr;
        const isPast  = dateStr < todayStr;

        if (isPast) {
            d.classList.add('past'); d.title = 'Past date';
        } else if (bookedDates.includes(dateStr)) {
            d.classList.add('booked'); d.title = 'Fully booked';
        } else {
            d.classList.add('available');
            if (isToday) d.classList.add('today');
            d.addEventListener('click', function () {
                document.querySelectorAll('.day-box.selected').forEach(el => el.classList.remove('selected'));
                d.classList.add('selected');
                selectDate(dateStr);
            });
        }
        grid.appendChild(d);
    }
}

function formatDate(dt) {
    return `${dt.getFullYear()}-${String(dt.getMonth()+1).padStart(2,'0')}-${String(dt.getDate()).padStart(2,'0')}`;
}

function selectDate(dateStr) {
    selectedDate = dateStr;
    document.getElementById('f_date').value = dateStr;

    const opts = { year: 'numeric', month: 'long', day: 'numeric' };
    document.getElementById('summary-date').textContent =
        new Date(dateStr + 'T00:00:00').toLocaleDateString('en-PH', opts);

    selectedTime = '';
    document.getElementById('f_time').value = '';
    document.getElementById('summary-time').textContent = 'Not selected';

    checkConfirmReady();
    loadTimeSlots(dateStr);
}

document.getElementById('prev-month').addEventListener('click', () => {
    const now = new Date();
    if (currentDate.getFullYear() === now.getFullYear() && currentDate.getMonth() === now.getMonth()) return;
    currentDate.setMonth(currentDate.getMonth() - 1);
    renderCalendar();
});
document.getElementById('next-month').addEventListener('click', () => {
    currentDate.setMonth(currentDate.getMonth() + 1);
    renderCalendar();
});

function loadTimeSlots(date) {
    const actForSlots = selectedActivities.length > 0 ? selectedActivities[0] : '';

    if (!actForSlots) {
        document.getElementById('time-slots-container').innerHTML =
            '<div class="slots-loading"><i class="fa-solid fa-circle-exclamation me-2 text-warning"></i>Please select an activity first.</div>';
        return;
    }

    const container = document.getElementById('time-slots-container');
    container.innerHTML = '<div class="slots-loading"><i class="fa-solid fa-spinner fa-spin me-2"></i>Loading available slots…</div>';
    document.getElementById('slots-count-hint').textContent = '';

    const staticSlots = [];
    for (var h = 7; h < 17; h++) {
        var startHour   = h;
        var endHour     = h + 1;
        var startAmPm   = startHour < 12 ? 'AM' : 'PM';
        var endAmPm     = endHour   < 12 ? 'AM' : 'PM';
        var startDisp   = (startHour > 12 ? startHour - 12 : startHour) + ':00 ' + startAmPm;
        var endDisp     = (endHour   > 12 ? endHour   - 12 : endHour)   + ':00 ' + endAmPm;
        var label       = startDisp + ' – ' + endDisp;
        var value       = String(startHour).padStart(2, '0') + ':00';
        staticSlots.push({ label: label, value: value });
    }

    fetch(`${BOOKING_SLOTS_URL}?activity=${encodeURIComponent(actForSlots)}&date=${date}`)
        .then(function(r) { return r.json(); })
        .then(function(data) {
            var takenValues = new Set();
            (data.slots || []).forEach(function(s) {
                if (!s.available) takenValues.add(s.value);
            });

            container.innerHTML = '';
            var available = 0;

            staticSlots.forEach(function(slot) {
                var isTaken = takenValues.has(slot.value);
                var btn = document.createElement('div');
                btn.className = 'time-slot-btn' + (isTaken ? ' unavailable' : '');

                var timeSpan = document.createElement('span');
                timeSpan.textContent = slot.label;

                var statusSpan = document.createElement('span');
                statusSpan.className = 'slot-status ' + (isTaken ? 'taken' : 'open');
                statusSpan.textContent = isTaken ? 'Taken' : 'Available';

                btn.appendChild(timeSpan);
                btn.appendChild(statusSpan);

                if (!isTaken) {
                    available++;
                    btn.addEventListener('click', function() {
                        document.querySelectorAll('.time-slot-btn.active').forEach(function(b) { b.classList.remove('active'); });
                        btn.classList.add('active');
                        selectTime(slot.value, slot.label);
                    });
                }
                container.appendChild(btn);
            });

            var hint = document.getElementById('slots-count-hint');
            if (available === 0) {
                hint.innerHTML = '<i class="fas fa-circle-xmark me-1 text-danger"></i> No slots available for this date.';
            } else {
                hint.innerHTML = '<i class="fas fa-circle-info me-1" style="color:var(--accent-cyan);"></i> ' + available + ' slot' + (available !== 1 ? 's' : '') + ' available';
            }
        })
        .catch(function() {
            container.innerHTML = '';
            var available = 0;
            staticSlots.forEach(function(slot) {
                var btn = document.createElement('div');
                btn.className = 'time-slot-btn';
                var timeSpan = document.createElement('span');
                timeSpan.textContent = slot.label;
                var statusSpan = document.createElement('span');
                statusSpan.className = 'slot-status open';
                statusSpan.textContent = 'Available';
                btn.appendChild(timeSpan);
                btn.appendChild(statusSpan);
                available++;
                btn.addEventListener('click', function() {
                    document.querySelectorAll('.time-slot-btn.active').forEach(function(b) { b.classList.remove('active'); });
                    btn.classList.add('active');
                    selectTime(slot.value, slot.label);
                });
                container.appendChild(btn);
            });
            document.getElementById('slots-count-hint').innerHTML =
                '<i class="fas fa-circle-info me-1" style="color:var(--accent-cyan);"></i> ' + available + ' slots available';
        });
}

function selectTime(value, display) {
    selectedTime = value;
    document.getElementById('f_time').value = value;
    document.getElementById('summary-time').textContent = display;
    checkConfirmReady();
}

function checkConfirmReady() {
    const btn  = document.getElementById('confirm-btn');
    const hint = document.getElementById('confirm-hint');

    if (selectedActivities.length === 0) {
        btn.disabled = true; hint.textContent = 'Please select at least one activity first.';
    } else if (!selectedDate) {
        btn.disabled = true; hint.textContent = 'Please select a date to continue.';
    } else if (!selectedTime) {
        btn.disabled = true; hint.textContent = 'Please select a time slot to continue.';
    } else {
        btn.disabled = false; hint.textContent = '';
    }
}

document.getElementById('bookingForm').addEventListener('submit', function (e) {
    if (selectedActivities.length === 0 || !selectedDate || !selectedTime) {
        e.preventDefault();
        alert('Please select an activity, date, and time slot before confirming.');
        return;
    }
    if (!document.getElementById('guidelines').checked) {
        e.preventDefault();
        alert('Please agree to the safety guidelines before confirming.');
    }
});

function smartScroll() {
    const icon = document.getElementById('scrollIcon');
    const atBottom = (window.innerHeight + window.scrollY) >= (document.documentElement.scrollHeight - 200);
    if (atBottom || icon.classList.contains('rotate-up')) {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    } else {
        window.scrollBy({ top: 600, behavior: 'smooth' });
    }
}
window.addEventListener('scroll', function () {
    const icon = document.getElementById('scrollIcon'), btn = document.getElementById('scrollBtn');
    const pct  = window.scrollY / (document.documentElement.scrollHeight - window.innerHeight);
    if (pct > 0.8) {
        icon.classList.add('rotate-up'); btn.style.background = 'var(--accent-cyan)'; icon.style.color = 'var(--deep-blue)';
    } else {
        icon.classList.remove('rotate-up'); btn.style.background = 'rgba(10,88,114,0.85)'; icon.style.color = 'var(--accent-cyan)';
    }
});

/* ADDED: Close help modal when clicking outside the box */
document.getElementById('helpModal').addEventListener('click', function(e) {
    if (e.target === this) {
        this.classList.add('d-none');
    }
});

initActivityDisplay();
renderCalendar();
</script>

</body>
</html>