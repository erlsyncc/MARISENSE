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
        
        .highlight-brand {
            font-weight: 700;
            color: #48cae4; /* Matches your accent cyan */
            text-shadow: 0 0 10px rgba(72, 202, 228, 0.4);
            letter-spacing: 1px;
        }

        /* ===== NAVBAR ===== */
        .waves-navbar { background: var(--ocean-blue); padding: 35px 0; position: sticky; top: 0; z-index: 1000; box-shadow: 0 4px 20px rgba(0,0,0,0.15); }
        .header-container { display: flex; justify-content: space-between; align-items: center; padding: 0 40px; }
        .user-greeting { color: white; font-size: 1.2rem; font-weight: 400; flex: 1; }
        .nav-menu-center { display: flex; gap: 10px; justify-content: center; flex: 2; }
        .logout-wrapper { flex: 1; display: flex; justify-content: flex-end; }
        .nav-link-custom { color: rgba(255, 255, 255, 0.8); text-decoration: none; font-size: 1rem; font-weight: 500; padding: 8px 16px; border-radius: 50px; transition: 0.3s; white-space: nowrap; }
        .nav-link-custom:hover { color: var(--accent-cyan); background: rgba(255, 255, 255, 0.1); }
        .nav-link-custom.active { background: var(--accent-cyan); color: var(--deep-blue); font-weight: 600; }
        .btn-logout-custom { color: #ff6b6b; text-decoration: none; font-weight: 600; font-size: 0.85rem; padding: 8px 18px; border: 1px solid rgba(255, 107, 107, 0.3); border-radius: 50px; transition: 0.3s; }
        .btn-logout-custom:hover { background: #ff6b6b; color: white; }

        /* ===== HERO ===== */
        .welcome-hero {
            background: linear-gradient(rgba(5, 44, 57, 0.5), rgba(5, 44, 57, 0.7)), 
                        url('<?= base_url('images/bookings_bg.png') ?>'); 
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            padding: 145px 40px;
            color: white;
            border-radius: 0 0 80px 80px;
            margin-bottom: 60px;
        }

        /* ===== FOOTER ===== */
        footer { background: var(--deep-blue); padding: 100px 0 40px 0; color: rgba(255, 255, 255, 0.6) !important; border-top: 1px solid rgba(255, 255, 255, 0.1); width: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; }
        .social-icons { display: flex; justify-content: center; gap: 20px; margin-bottom: 25px; }
        .social-icons i { color: rgba(255, 255, 255, 0.7); transition: 0.3s; cursor: pointer; font-size: 1.5rem; }
        .social-icons i:hover { color: var(--accent-cyan); transform: scale(1.2); }

        /* ===== MAIN LAYOUT ===== */
        .booking-layout {
            display: grid;
            grid-template-columns: 1.6fr 1fr;
            gap: 28px;
            max-width: 1200px;
            margin: 0 auto 80px;
            padding: 0 24px;
            align-items: start;
        }

        /* ===== STEP CARDS ===== */
        .step-card {
            background: var(--card-bg);
            backdrop-filter: blur(12px);
            border: 1px solid var(--card-border);
            border-radius: 28px;
            padding: 32px;
            margin-bottom: 24px;
            transition: border-color 0.3s;
        }
        .step-card:hover { border-color: rgba(72,202,228,0.25); }

        .step-label {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.8px;
            color: var(--accent-cyan);
            margin-bottom: 6px;
        }
        .section-sep {
            width: 50px;
            height: 2px;
            background: linear-gradient(90deg, var(--accent-cyan), transparent);
            border-radius: 2px;
            margin-bottom: 22px;
        }

        /* ===== SELECTED ACTIVITY BOX ===== */
        .activity-highlight {
            background: linear-gradient(135deg, rgba(10,88,114,0.5) 0%, rgba(5,44,57,0.7) 100%);
            border-left: 5px solid var(--accent-cyan);
            border-radius: 18px;
            padding: 24px 28px;
            position: relative;
        }
        .activity-highlight h3 {
            font-family: 'DM Sans', sans-serif;
            font-size: 1.6rem;
            font-weight: 700;
            margin-bottom: 6px;
            color: white;
        }
        .activity-highlight p { color: var(--text-muted); font-size: 0.88rem; margin-bottom: 18px; }
        .btn-change-act {
            position: absolute;
            top: 20px; right: 20px;
            background: rgba(255,255,255,0.08);
            color: rgba(255,255,255,0.8);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 50px;
            padding: 5px 14px;
            font-size: 0.78rem;
            text-decoration: none;
            transition: 0.3s;
        }
        .btn-change-act:hover { background: var(--accent-cyan); color: var(--deep-blue); border-color: var(--accent-cyan); }
        .activity-meta {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px 20px;
            font-size: 0.82rem;
            color: rgba(255,255,255,0.75);
        }
        .activity-meta span { display: flex; align-items: center; gap: 8px; }
        .activity-meta i { color: var(--accent-cyan); width: 14px; }

        /* ===== CALENDAR ===== */
        .calendar-header-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 18px;
        }
        .calendar-header-row h4 {
            font-family: 'DM Sans', sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
        }
        .cal-nav { display: flex; gap: 8px; }
        .cal-nav button {
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.15);
            color: white;
            width: 34px; height: 34px;
            border-radius: 50%;
            cursor: pointer;
            transition: 0.3s;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.82rem;
        }
        .cal-nav button:hover { background: var(--accent-cyan); color: var(--deep-blue); border-color: var(--accent-cyan); }

        .cal-day-headers {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 6px;
            text-align: center;
            margin-bottom: 8px;
        }
        .cal-day-headers span {
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: var(--accent-cyan);
            padding: 4px 0;
        }
        .calendar-days-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 6px;
        }
        .day-box {
            aspect-ratio: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-size: 0.82rem;
            font-weight: 600;
            cursor: default;
            min-height: 36px;
            transition: all 0.25s ease;
        }
        .day-box.empty { background: transparent; }
        .day-box.available {
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.12);
            color: white;
            cursor: pointer;
        }
        .day-box.available:hover {
            background: var(--accent-cyan);
            color: var(--deep-blue);
            border-color: var(--accent-cyan);
            transform: scale(1.1);
        }
        .day-box.booked {
            background: rgba(255,107,107,0.18);
            border: 1px solid rgba(255,107,107,0.35);
            color: #ff9999;
            cursor: not-allowed;
        }
        .day-box.today {
            border: 2px solid var(--accent-cyan);
            background: rgba(72,202,228,0.1);
            color: var(--accent-cyan);
        }
        .day-box.selected {
            background: var(--accent-cyan) !important;
            color: var(--deep-blue) !important;
            border: none !important;
            font-weight: 700 !important;
            box-shadow: 0 4px 14px rgba(72,202,228,0.45) !important;
        }
        .cal-legend {
            display: flex;
            gap: 20px;
            margin-top: 18px;
            padding-top: 16px;
            border-top: 1px solid rgba(255,255,255,0.08);
            font-size: 0.78rem;
            color: var(--text-muted);
        }
        .cal-legend-item { display: flex; align-items: center; gap: 7px; }
        .cal-dot { width: 12px; height: 12px; border-radius: 3px; }
        .cal-dot.available { background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.2); }
        .cal-dot.booked { background: rgba(255,107,107,0.5); }
        .cal-dot.today { border: 2px solid var(--accent-cyan); background: rgba(72,202,228,0.12); }

        /* ===== TIME SLOTS ===== */
        .time-slots-wrapper {
            max-height: 200px;
            overflow-y: auto;
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 14px;
            padding: 10px;
            background: rgba(255,255,255,0.03);
        }
        .time-slot-btn {
            display: block;
            width: 100%;
            padding: 10px 14px;
            margin-bottom: 6px;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 10px;
            color: white;
            cursor: pointer;
            transition: 0.25s;
            text-align: center;
            font-size: 0.87rem;
            font-weight: 500;
            font-family: 'DM Sans', sans-serif;
        }
        .time-slot-btn:hover { border-color: rgba(72,202,228,0.5); background: rgba(72,202,228,0.1); }
        .time-slot-btn.active { background: var(--accent-cyan); color: var(--deep-blue); border-color: var(--accent-cyan); font-weight: 700; }
        .time-slot-btn.unavailable { background: rgba(255,107,107,0.12); color: #ff9999; border-color: rgba(255,107,107,0.3); cursor: not-allowed; }

        /* ===== FORM ELEMENTS ===== */
        .form-row-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
        .field-group { margin-bottom: 18px; }
        .field-label {
            display: block;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: var(--accent-cyan);
            margin-bottom: 8px;
        }
        .form-control-wave, .form-select-wave {
            width: 100%;
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 14px;
            color: white;
            padding: 12px 16px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9rem;
            transition: border-color 0.3s;
            -webkit-appearance: none;
        }
        .form-control-wave:focus, .form-select-wave:focus {
            outline: none;
            border-color: rgba(72,202,228,0.6);
            background: rgba(255,255,255,0.1);
            box-shadow: 0 0 0 3px rgba(72,202,228,0.12);
            color: white;
        }
        .form-control-wave::placeholder { color: rgba(255,255,255,0.3); }
        .form-select-wave option { background: #073d52; color: white; }
        textarea.form-control-wave { resize: vertical; min-height: 90px; }
        .form-hint { font-size: 0.76rem; color: var(--text-muted); margin-top: 5px; }

        /* ===== SEA CONDITIONS ===== */
        .conditions-box {
            background: rgba(72,202,228,0.06);
            border: 1px solid rgba(72,202,228,0.2);
            border-radius: 16px;
            padding: 20px 24px;
        }
        .conditions-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
            text-align: center;
        }
        .condition-item { font-size: 0.82rem; }
        .condition-item strong { display: block; font-size: 1.1rem; color: var(--accent-cyan); margin-bottom: 2px; }
        .condition-item span { color: var(--text-muted); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.8px; }
        .safety-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 18px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.85rem;
        }
        .safe-bg { background: rgba(40,167,69,0.15); color: #5ddb8a; border: 1px solid rgba(40,167,69,0.35); }
        .unsafe-bg { background: rgba(255,107,107,0.15); color: #ff9999; border: 1px solid rgba(255,107,107,0.35); }

        /* ===== SUMMARY SIDEBAR ===== */
        .summary-sidebar { position: sticky; top: 90px; }

        .summary-card {
            background: var(--soft-white);
            color: var(--deep-blue);
            border-radius: 28px;
            padding: 32px;
            box-shadow: 0 24px 60px rgba(0,0,0,0.35);
            margin-bottom: 20px;
        }
        .summary-card h4 {
            font-family: 'DM Sans', sans-serif;
            font-size: 1.25rem;
            font-weight: 900;
            border-bottom: 2px solid rgba(10,88,114,0.15);
            padding-bottom: 14px;
            margin-bottom: 22px;
            color: var(--deep-blue);
        }
        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 13px;
            font-size: 0.87rem;
        }
        .summary-row .s-label { color: rgba(5,44,57,0.5); }
        .summary-row .s-value { font-weight: 600; color: var(--deep-blue); text-align: right; max-width: 55%; }
        .summary-divider { border: none; border-top: 1px solid rgba(10,88,114,0.12); margin: 18px 0; }
        .summary-total-box {
            background: linear-gradient(135deg, rgba(10,88,114,0.08) 0%, rgba(72,202,228,0.1) 100%);
            border: 1px solid rgba(10,88,114,0.15);
            border-radius: 14px;
            padding: 16px 18px;
            margin-bottom: 20px;
        }
        .price-breakdown { font-size: 0.83rem; color: rgba(5,44,57,0.6); margin-bottom: 10px; }
        .price-breakdown-row { display: flex; justify-content: space-between; margin-bottom: 5px; }
        .price-total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid rgba(10,88,114,0.15);
            padding-top: 10px;
        }
        .price-total-row .total-label { font-weight: 700; font-size: 0.9rem; color: var(--deep-blue); }
        .price-total-row .total-amount {
            font-family: 'DM Sans', sans-serif;
            font-size: 1.7rem;
            font-weight: 900;
            color: var(--ocean-blue);
        }

        .form-check-label { font-size: 0.83rem; color: rgba(5,44,57,0.7); }
        .form-check-input:checked { background-color: var(--ocean-blue); border-color: var(--ocean-blue); }

        .btn-confirm {
            display: block;
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, var(--ocean-blue) 0%, var(--deep-blue) 100%);
            color: white;
            border: none;
            border-radius: 16px;
            font-family: 'DM Sans', sans-serif;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 8px 24px rgba(10,88,114,0.35);
            letter-spacing: 0.3px;
        }
        .btn-confirm:hover {
            background: linear-gradient(135deg, var(--accent-cyan) 0%, var(--ocean-blue) 100%);
            color: var(--deep-blue);
            transform: translateY(-3px);
            box-shadow: 0 14px 35px rgba(72,202,228,0.35);
        }

        /* Slots info sidebar card */
        .slots-info-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 20px;
            padding: 20px 22px;
        }
        .slots-info-card p { font-size: 0.82rem; color: var(--text-muted); margin: 0 0 6px; }
        .slots-info-card p:last-child { margin: 0; }
        .slots-info-card i { color: var(--accent-cyan); margin-right: 6px; }



        /* ===== SCROLL BTN ===== */
        #scrollBtn {
            position: fixed;
            right: 20px; top: 50%;
            transform: translateY(-50%);
            z-index: 1000;
            width: 46px; height: 140px;
            background: rgba(10,88,114,0.85);
            backdrop-filter: blur(10px);
            border: 2px solid var(--accent-cyan);
            border-radius: 60px;
            display: flex; align-items: center; justify-content: center;
            color: var(--accent-cyan);
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 12px 30px rgba(0,0,0,0.3);
        }
        #scrollBtn:hover { background: var(--accent-cyan); color: var(--deep-blue); right: 24px; }
        #scrollBtn i { font-size: 2.2rem; transition: transform 0.5s cubic-bezier(0.68,-0.55,0.27,1.55); }
        .rotate-up { transform: rotate(180deg); }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 992px) {
            .booking-layout { grid-template-columns: 1fr; }
            .summary-sidebar { position: static; }
            .form-row-2 { grid-template-columns: 1fr; }
            .activity-meta { grid-template-columns: 1fr; }
            .conditions-grid { grid-template-columns: 1fr; gap: 8px; }
        }
        @media (max-width: 576px) {
            .header-container { padding: 0 16px; }
            .nav-menu-center { display: none; }
            .booking-hero { padding: 70px 20px 50px; border-radius: 0 0 40px 40px; }
            .step-card { padding: 22px; }
            .booking-layout { padding: 0 14px; }
        }
        html {
            scroll-behavior: smooth;
        }
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
        <div class="logout-wrapper"><a href="<?= base_url('logout') ?>" class="btn-logout-custom">Logout</a></div>
    </div>
</nav>

<header class="welcome-hero">
    <div class="container">
        <h1 class="display-4 fw-bold mb-3">Book Your Water Adventure</h1>
        <p class="lead opacity-90 mx-auto" style="max-width: 800px;">Complete your reservation for your chosen activity at Matabungkay Beach. Select your schedule and confirm your booking.</p>
    </div>
</header>

<!-- ===== MAIN LAYOUT ===== -->
<div class="booking-layout">

    <!-- LEFT: STEPS COLUMN -->
    <div class="steps-column">

        <!-- Selected Activity -->
        <div class="step-card">
            <div class="step-label"><i class="fa-solid fa-person-surfing"></i> Your Activity</div>
            <div class="section-sep"></div>
            <div class="activity-highlight">
                <a href="<?= base_url('user/activities') ?>" class="btn-change-act">Change Activity</a>
                <h3>Jet Ski</h3>
                <p>Ride across the open sea on a powerful jet ski. Perfect for thrill-seekers.</p>
                <div class="activity-meta">
                    <span><i class="fa-solid fa-clock"></i> Duration: 15 mins</span>
                    <span><i class="fa-solid fa-users"></i> Max Riders: 1–2 persons</span>
                    <span><i class="fa-solid fa-vest"></i> Gear: Life Vest</span>
                    <span><i class="fa-solid fa-gauge-high"></i> Difficulty: Moderate</span>
                </div>
            </div>
        </div>

        <!-- Step 1: Choose Date -->
        <div class="step-card">
            <div class="step-label"><i class="fa-regular fa-calendar-days"></i> Step 1 — Choose Your Date</div>
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

        <!-- Step 2: Select Time Slot -->
        <div class="step-card">
            <div class="step-label"><i class="fa-regular fa-clock"></i> Step 2 — Select Time Slot</div>
            <div class="section-sep"></div>

            <div class="time-slots-wrapper" id="time-slots-container">
                <div class="time-slot-btn" onclick="selectTimeSlot(this, '09:00 AM')">09:00 AM</div>
                <div class="time-slot-btn active" onclick="selectTimeSlot(this, '10:00 AM')">10:00 AM</div>
                <div class="time-slot-btn" onclick="selectTimeSlot(this, '11:00 AM')">11:00 AM</div>
                <div class="time-slot-btn" onclick="selectTimeSlot(this, '01:00 PM')">01:00 PM</div>
                <div class="time-slot-btn" onclick="selectTimeSlot(this, '02:00 PM')">02:00 PM</div>
                <div class="time-slot-btn" onclick="selectTimeSlot(this, '03:00 PM')">03:00 PM</div>
            </div>
            <p class="form-hint mt-2"><i class="fas fa-circle-info me-1" style="color:var(--accent-cyan);"></i> Available slots: 3 remaining</p>
        </div>

        <!-- Step 3: Details -->
        <div class="step-card">
            <div class="step-label"><i class="fa-solid fa-pen-to-square"></i> Step 3 — Your Details</div>
            <div class="section-sep"></div>

            <div class="form-row-2">
                <div class="field-group">
                    <label class="field-label">Participants</label>
                    <select class="form-select-wave">
                        <option>1 Person</option>
                        <option>2 Persons</option>
                    </select>
                    <p class="form-hint">Max 2 persons for Jet Ski</p>
                </div>
                <div class="field-group">
                    <label class="field-label">Additional Requests</label>
                    <textarea class="form-control-wave" rows="3" placeholder="Special requests, health concerns…"></textarea>
                </div>
            </div>
        </div>

        <!-- Sea Conditions -->
        <div class="step-card" style="border-color: rgba(72,202,228,0.2);">
            <div class="step-label"><i class="fa-solid fa-tower-broadcast"></i> Current Sea Conditions — MARISENSE</div>
            <div class="section-sep"></div>

            <div class="conditions-box">
                <div class="conditions-grid mb-4">
                    <div class="condition-item">
                        <strong>10 kts</strong>
                        <span>Wind Speed</span>
                    </div>
                    <div class="condition-item">
                        <strong>0.9 m</strong>
                        <span>Wave Height</span>
                    </div>
                    <div class="condition-item">
                        <strong>5 s</strong>
                        <span>Wave Period</span>
                    </div>
                </div>
                <div class="text-center">
                    <div class="safety-badge safe-bg">
                        <i class="fa-solid fa-circle-check"></i> Conditions Safe for Activity
                    </div>
                </div>
            </div>
        </div>

    </div><!-- /steps-column -->

    <!-- RIGHT: SIDEBAR -->
    <div class="summary-sidebar">

        <!-- Booking Summary Card -->
        <div class="summary-card">
            <h4>Booking Summary</h4>

            <div class="summary-row">
                <span class="s-label">Activity</span>
                <span class="s-value">Jet Ski</span>
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
                <span class="s-value" id="summary-time">10:00 AM</span>
            </div>
            <div class="summary-row">
                <span class="s-label">Duration</span>
                <span class="s-value">15 minutes</span>
            </div>
            <div class="summary-row">
                <span class="s-label">Participants</span>
                <span class="s-value" id="summary-participants">1 person</span>
            </div>

            <hr class="summary-divider">

            <div class="summary-total-box">
                <div class="price-breakdown">
                    <div class="price-breakdown-row">
                        <span>Activity Fee</span>
                        <span>₱2,500.00</span>
                    </div>
                </div>
                <div class="price-total-row">
                    <span class="total-label">Total</span>
                    <span class="total-amount">₱2,500</span>
                </div>
            </div>

            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" id="guidelines" required>
                <label class="form-check-label" for="guidelines">
                    I have read and agree to the safety guidelines and activity rules.
                </label>
            </div>

            <button class="btn-confirm">
                <i class="fas fa-check-circle me-2"></i> Confirm Reservation
            </button>
        </div>

        <!-- Quick Info Card -->
        <div class="slots-info-card">
            <p><i class="fas fa-shield-halved"></i> Safety gear provided for all activities</p>
            <p><i class="fas fa-rotate-left"></i> Free cancellation up to 24 hrs before</p>
            <p><i class="fas fa-headset"></i> On-site crew available at all times</p>
        </div>

    </div><!-- /summary-sidebar -->

</div><!-- /booking-layout -->

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

<!-- ===== SCROLL BTN ===== -->
<div id="scrollBtn" onclick="smartScroll()" title="Navigate">
    <i class="fa-solid fa-arrow-down" id="scrollIcon"></i>
</div>

<script>
    // ===== CALENDAR =====
    const monthNames = ['January','February','March','April','May','June','July','August','September','October','November','December'];
    let currentDate = new Date();
    // Simulated booked dates — replace with your fetch() call
    const bookedDates = ['2026-04-18', '2026-04-22'];

    function renderCalendar() {
        const yr = currentDate.getFullYear(), mo = currentDate.getMonth();
        document.getElementById('cal-month-year').textContent = `${monthNames[mo]} ${yr}`;
        const firstDay = new Date(yr, mo, 1).getDay();
        const daysInMonth = new Date(yr, mo + 1, 0).getDate();
        const today = new Date();
        const grid = document.getElementById('calendar-days');
        grid.innerHTML = '';

        for (let i = 0; i < firstDay; i++) {
            const d = document.createElement('div'); d.className = 'day-box empty'; grid.appendChild(d);
        }
        for (let day = 1; day <= daysInMonth; day++) {
            const d = document.createElement('div'); d.className = 'day-box'; d.textContent = day;
            const dateStr = `${yr}-${String(mo+1).padStart(2,'0')}-${String(day).padStart(2,'0')}`;
            const isToday = today.getFullYear()===yr && today.getMonth()===mo && today.getDate()===day;
            if (bookedDates.includes(dateStr)) {
                d.classList.add('booked');
                d.title = 'Fully booked';
            } else {
                d.classList.add('available');
                d.addEventListener('click', function() {
                    document.querySelectorAll('.day-box.selected').forEach(el => el.classList.remove('selected'));
                    d.classList.add('selected');
                    // Update summary
                    const opts = { year:'numeric', month:'long', day:'numeric' };
                    document.getElementById('summary-date').textContent =
                        new Date(dateStr + 'T00:00:00').toLocaleDateString('en-PH', opts);
                });
            }
            if (isToday) d.classList.add('today');
            grid.appendChild(d);
        }
    }

    document.getElementById('prev-month').addEventListener('click', () => { currentDate.setMonth(currentDate.getMonth()-1); renderCalendar(); });
    document.getElementById('next-month').addEventListener('click', () => { currentDate.setMonth(currentDate.getMonth()+1); renderCalendar(); });
    renderCalendar();

    // ===== TIME SLOT SELECTION =====
    function selectTimeSlot(el, time) {
        document.querySelectorAll('.time-slot-btn').forEach(s => s.classList.remove('active'));
        el.classList.add('active');
        document.getElementById('summary-time').textContent = time;
    }

    // ===== PARTICIPANTS =====
    document.querySelector('.form-select-wave').addEventListener('change', function() {
        document.getElementById('summary-participants').textContent = this.value;
    });

    // ===== SCROLL BTN =====
    function smartScroll() {
        const icon = document.getElementById('scrollIcon');
        const atBottom = (window.innerHeight + window.scrollY) >= (document.documentElement.scrollHeight - 200);
        if (atBottom || icon.classList.contains('rotate-up')) {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        } else {
            window.scrollBy({ top: 600, behavior: 'smooth' });
        }
    }
    window.addEventListener('scroll', function() {
        const icon = document.getElementById('scrollIcon'), btn = document.getElementById('scrollBtn');
        const pct = window.scrollY / (document.documentElement.scrollHeight - window.innerHeight);
        if (pct > 0.8) {
            icon.classList.add('rotate-up');
            btn.style.background = 'var(--accent-cyan)';
            icon.style.color = 'var(--deep-blue)';
        } else {
            icon.classList.remove('rotate-up');
            btn.style.background = 'rgba(10,88,114,0.85)';
            icon.style.color = 'var(--accent-cyan)';
        }
    });
</script>

</body>
</html>