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
        body {font-family: 'Poppins', sans-serif; background: linear-gradient(180deg, var(--ocean-blue) 0%, var(--deep-blue) 100%); background-attachment: fixed; color: var(--soft-white); margin: 0; min-height: 100vh}
        
        .highlight-brand { font-weight: 700; color: #48cae4; text-shadow: 0 0 10px rgba(72, 202, 228, 0.4); letter-spacing: 1px; }
        
        /* Navbar */
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
        #helpModal { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(5,44,57,0.88); backdrop-filter: blur(8px); z-index: 9999; display: flex; align-items: center; justify-content: center; padding: 20px; animation: fadeInModal 0.25s ease; }
        #helpModal.d-none { display: none !important; }
        @keyframes fadeInModal { from { opacity: 0; transform: scale(0.96); } to { opacity: 1; transform: scale(1); } }
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
        .social-icons { display: flex; justify-content: center; gap: 20px; margin-bottom: 20px; }
        .social-icons a { color: rgba(255,255,255,0.7); font-size: 1.4rem; transition: 0.3s; }
        .social-icons a:hover { color: var(--accent-cyan); transform: scale(1.2); }
        .booking-layout { display: grid; grid-template-columns: 1.6fr 1fr; gap: 24px; max-width: 1200px; margin: 0 auto 80px; padding: 0 24px; align-items: start; }
        .step-card { background: rgba(255,255,255,0.08); backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.15); border-radius: 24px; padding: 28px; margin-bottom: 20px; }
        .step-label { display: inline-flex; align-items: center; gap: 8px; font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: var(--accent-cyan); margin-bottom: 6px; }
        .section-sep { width: 40px; height: 2px; background: linear-gradient(90deg, var(--accent-cyan), transparent); border-radius: 2px; margin-bottom: 18px; }
        /* Activity picker */
        .activity-highlight { background: linear-gradient(135deg, rgba(10,88,114,0.5), rgba(5,44,57,0.7)); border-left: 4px solid var(--accent-cyan); border-radius: 16px; padding: 20px 24px; position: relative; margin-bottom: 10px; }
        .activity-highlight h3 { font-size: 1.4rem; font-weight: 700; margin-bottom: 4px; padding-right: 120px; }
        .activity-meta { display: grid; grid-template-columns: 1fr 1fr; gap: 6px 16px; font-size: 0.8rem; color: rgba(255,255,255,0.7); }
        .activity-meta span { display: flex; align-items: center; gap: 6px; }
        .activity-meta i { color: var(--accent-cyan); width: 12px; }
        .act-card-actions { position: absolute; top: 12px; right: 12px; }
        .btn-cancel-act { background: rgba(255,107,107,0.15); border: 1px solid rgba(255,107,107,0.35); color: #ff9999; border-radius: 50%; width: 28px; height: 28px; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: 0.2s; }
        .btn-cancel-act:hover { background: #ff6b6b; color: white; }
        .activity-picker { display: none; }
        .activity-picker.show { display: block; }
        .activity-grid { display: grid; grid-template-columns: repeat(2,1fr); gap: 10px; margin-top: 12px; }
        .activity-option { background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.15); border-radius: 14px; padding: 14px 16px; cursor: pointer; transition: 0.2s; display: flex; align-items: center; gap: 10px; color: white; font-size: 0.88rem; font-weight: 500; }
        .activity-option:hover { background: rgba(72,202,228,0.15); border-color: var(--accent-cyan); color: var(--accent-cyan); }
        .activity-option.already-selected { opacity: 0.3; pointer-events: none; }
        .activity-option i { color: var(--accent-cyan); }
        .act-opt-price { font-size: 0.72rem; color: rgba(255,255,255,0.5); margin-left: auto; }
        .btn-add-activity { display: inline-flex; align-items: center; gap: 8px; background: rgba(72,202,228,0.1); border: 1px dashed rgba(72,202,228,0.5); color: var(--accent-cyan); border-radius: 50px; padding: 8px 20px; font-size: 0.8rem; font-weight: 600; cursor: pointer; transition: 0.2s; margin-top: 12px; width: 100%; justify-content: center; }
        .btn-add-activity:hover { background: rgba(72,202,228,0.22); border-style: solid; }
        /* Calendar */
        .calendar-header-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; }
        .calendar-header-row h4 { font-size: 1rem; font-weight: 700; }
        .cal-nav button { background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); color: white; width: 32px; height: 32px; border-radius: 50%; cursor: pointer; transition: 0.2s; }
        .cal-nav button:hover { background: var(--accent-cyan); color: var(--deep-blue); }
        .cal-day-headers { display: grid; grid-template-columns: repeat(7,1fr); text-align: center; margin-bottom: 6px; }
        .cal-day-headers span { font-size: 0.68rem; font-weight: 700; text-transform: uppercase; color: var(--accent-cyan); padding: 4px 0; }
        .calendar-days-grid { display: grid; grid-template-columns: repeat(7,1fr); gap: 5px; }
        .day-box { aspect-ratio: 1; display: flex; align-items: center; justify-content: center; border-radius: 10px; font-size: 0.8rem; font-weight: 600; cursor: default; min-height: 34px; transition: all 0.2s; position: relative; }
        .day-box.empty { background: transparent; }
        .day-box.available { background: rgba(40,167,69,0.15); border: 1px solid rgba(40,167,69,0.35); color: #5ddb8a; cursor: pointer; }
        .day-box.available:hover { background: rgba(40,167,69,0.35); transform: scale(1.08); }
        .day-box.past { background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05); color: rgba(255,255,255,0.2); cursor: not-allowed; }
        .day-box.partial { background: rgba(255,193,7,0.15); border: 1px solid rgba(255,193,7,0.4); color: #ffc107; cursor: pointer; }
        .day-box.partial:hover { background: rgba(255,193,7,0.3); transform: scale(1.08); }
        .day-box.booked { background: rgba(220,53,69,0.2); border: 1px solid rgba(220,53,69,0.4); color: #ff9999; cursor: not-allowed; }
        .day-box.today { outline: 2px solid var(--accent-cyan); }
        .day-box.selected { background: var(--accent-cyan) !important; color: var(--deep-blue) !important; border: none !important; font-weight: 700 !important; box-shadow: 0 4px 12px rgba(72,202,228,0.4) !important; }
        .cal-legend { display: flex; flex-wrap: wrap; gap: 14px; margin-top: 14px; padding-top: 14px; border-top: 1px solid rgba(255,255,255,0.08); font-size: 0.75rem; color: rgba(255,255,255,0.6); }
        .cal-legend-item { display: flex; align-items: center; gap: 6px; }
        .cal-dot { width: 11px; height: 11px; border-radius: 3px; }
        .cal-dot.avail { background: rgba(40,167,69,0.5); border: 1px solid rgba(40,167,69,0.6); }
        .cal-dot.partial { background: rgba(255,193,7,0.5); border: 1px solid rgba(255,193,7,0.6); }
        .cal-dot.full { background: rgba(220,53,69,0.5); border: 1px solid rgba(220,53,69,0.6); }
        .cal-dot.today { outline: 2px solid var(--accent-cyan); background: transparent; }
        /* Time slots */
        .time-slots-wrapper { max-height: 230px; overflow-y: auto; border: 1px solid rgba(255,255,255,0.12); border-radius: 12px; padding: 10px; background: rgba(255,255,255,0.03); }
        .time-slot-btn { display: flex; align-items: center; justify-content: space-between; width: 100%; padding: 11px 14px; margin-bottom: 7px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.12); border-radius: 10px; color: white; cursor: pointer; transition: 0.2s; font-size: 0.86rem; font-weight: 500; }
        .time-slot-btn:last-child { margin-bottom: 0; }
        .time-slot-btn:hover { border-color: rgba(72,202,228,0.5); background: rgba(72,202,228,0.1); }
        .time-slot-btn.active { background: var(--accent-cyan); color: var(--deep-blue); border-color: var(--accent-cyan); font-weight: 700; }
        .time-slot-btn.unavailable { background: rgba(255,107,107,0.06); color: rgba(255,255,255,0.3); border-color: rgba(255,107,107,0.15); cursor: not-allowed; }
        .slot-status { font-size: 0.7rem; padding: 3px 10px; border-radius: 50px; font-weight: 600; }
        .slot-status.open { background: rgba(40,167,69,0.2); color: #5ddb8a; }
        .slot-status.taken { background: rgba(255,107,107,0.2); color: #ff9999; }
        .slots-loading { text-align: center; padding: 20px; opacity: 0.5; font-size: 0.85rem; }
        /* Form fields */
        .form-row-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .field-group { margin-bottom: 16px; }
        .field-label { display: block; font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: var(--accent-cyan); margin-bottom: 6px; }
        .field-sublabel { font-size: 0.7rem; color: rgba(255,255,255,0.45); font-weight: 400; text-transform: none; letter-spacing: 0; margin-bottom: 6px; display: block; }
        .form-control-wave, .form-select-wave { width: 100%; background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.15); border-radius: 12px; color: white; padding: 11px 14px; font-family: 'Poppins',sans-serif; font-size: 0.88rem; transition: 0.3s; -webkit-appearance: none; outline: none; }
        .form-control-wave:focus, .form-select-wave:focus { border-color: rgba(72,202,228,0.6); background: rgba(255,255,255,0.1); box-shadow: 0 0 0 3px rgba(72,202,228,0.12); color: white; }
        .form-control-wave::placeholder { color: rgba(255,255,255,0.3); }
        .form-select-wave option { background: #073d52; color: white; }
        textarea.form-control-wave { resize: vertical; min-height: 80px; }
        .form-hint { font-size: 0.73rem; color: rgba(255,255,255,0.45); margin-top: 4px; }
        /* Sea conditions */
        .conditions-box { background: rgba(72,202,228,0.06); border: 1px solid rgba(72,202,228,0.2); border-radius: 14px; padding: 18px 22px; }
        .conditions-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 12px; text-align: center; }
        .condition-item strong { display: block; font-size: 1.1rem; color: var(--accent-cyan); margin-bottom: 2px; }
        .condition-item span { color: rgba(255,255,255,0.5); font-size: 0.72rem; text-transform: uppercase; }
        .safety-badge { display: inline-flex; align-items: center; gap: 8px; padding: 8px 18px; border-radius: 50px; font-weight: 700; font-size: 0.83rem; }
        .safe-bg { background: rgba(40,167,69,0.15); color: #5ddb8a; border: 1px solid rgba(40,167,69,0.35); }
        .moderate-bg { background: rgba(255,193,7,0.15); color: #ffc107; border: 1px solid rgba(255,193,7,0.35); }
        .unsafe-bg { background: rgba(220,53,69,0.15); color: #ff9999; border: 1px solid rgba(220,53,69,0.35); }
        /* Summary card */
        .summary-sidebar { position: sticky; top: 82px; }
        .summary-card { background: var(--soft-white); color: var(--deep-blue); border-radius: 24px; padding: 28px; box-shadow: 0 20px 50px rgba(0,0,0,0.3); margin-bottom: 18px; }
        .summary-card h4 { font-size: 1.1rem; font-weight: 900; border-bottom: 2px solid rgba(10,88,114,0.12); padding-bottom: 12px; margin-bottom: 18px; }
        .summary-row { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 11px; font-size: 0.84rem; }
        .summary-row .s-label { color: rgba(5,44,57,0.5); flex-shrink: 0; }
        .summary-row .s-value { font-weight: 600; color: var(--deep-blue); text-align: right; max-width: 60%; }
        .summary-divider { border: none; border-top: 1px solid rgba(10,88,114,0.1); margin: 14px 0; }
        .summary-total-box { background: linear-gradient(135deg, rgba(10,88,114,0.08), rgba(72,202,228,0.1)); border: 1px solid rgba(10,88,114,0.12); border-radius: 12px; padding: 14px 16px; margin-bottom: 16px; }
        .price-breakdown { font-size: 0.8rem; color: rgba(5,44,57,0.6); margin-bottom: 8px; }
        .price-total-row { display: flex; justify-content: space-between; align-items: center; border-top: 1px solid rgba(10,88,114,0.12); padding-top: 8px; }
        .price-total-row .total-label { font-weight: 700; font-size: 0.88rem; color: var(--deep-blue); }
        .price-total-row .total-amount { font-size: 1.5rem; font-weight: 900; color: var(--ocean-blue); }
        .form-check-label { font-size: 0.8rem; color: rgba(5,44,57,0.7); }
        .form-check-input:checked { background-color: var(--ocean-blue); border-color: var(--ocean-blue); }
        .btn-confirm { display: block; width: 100%; padding: 14px; background: linear-gradient(135deg, var(--ocean-blue), var(--deep-blue)); color: white; border: none; border-radius: 14px; font-size: 0.95rem; font-weight: 700; cursor: pointer; transition: all 0.3s; box-shadow: 0 6px 20px rgba(10,88,114,0.3); }
        .btn-confirm:hover { background: linear-gradient(135deg, var(--accent-cyan), var(--ocean-blue)); color: var(--deep-blue); transform: translateY(-2px); }
        .btn-confirm:disabled { opacity: 0.55; cursor: not-allowed; transform: none; }
        .slots-info-card { background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); border-radius: 18px; padding: 18px 20px; }
        .slots-info-card p { font-size: 0.8rem; color: rgba(255,255,255,0.6); margin: 0 0 5px; }
        .slots-info-card i { color: var(--accent-cyan); margin-right: 5px; }
        .alert-wave { border-radius: 12px; padding: 12px 16px; margin-bottom: 18px; font-size: 0.88rem; }
        .alert-wave-danger { background: rgba(220,53,69,0.15); border: 1px solid rgba(220,53,69,0.4); color: #ff9999; }
        .sum-activity-line { background: rgba(10,88,114,0.06); border-radius: 8px; padding: 8px 10px; margin-bottom: 6px; }
        .sum-activity-line:last-child { margin-bottom: 0; }
        .sal-name { font-size: 0.82rem; font-weight: 700; color: var(--ocean-blue); margin-bottom: 3px; }
        .sal-detail { display: flex; justify-content: space-between; font-size: 0.75rem; color: rgba(5,44,57,0.55); }
        .sal-price { font-weight: 700; color: var(--ocean-blue); }
        @media (max-width: 992px) { .booking-layout { grid-template-columns: 1fr; } .summary-sidebar { position: static; } .form-row-2 { grid-template-columns: 1fr; } }
        html { scroll-behavior: smooth; }
        footer { background: var(--deep-blue); padding: 100px 0 40px 0; color: rgba(255,255,255,0.6) !important; border-top: 1px solid rgba(255,255,255,0.1); width: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; }
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
        <h1 class="display-5 fw-bold mb-2">Book Your Water Adventure</h1>
        <p class="lead mb-5 opacity-90 mx-auto" style="max-width: 800px;">
            Explore exciting water activities at Matabungkay Beach and choose your perfect adventure.
            Pick your schedule and book for a fun and hassle-free experience.
        </p>
    </div>
</header>

<?php
/* ─────────────────────────────────────────────────────────────
   Build a JS-friendly array from the DB $activities rows.
   Icons are mapped by name; anything unknown gets a default.
   ───────────────────────────────────────────────────────────── */
$iconMap = [
    'jet ski'       => 'fa-water',
    'banana boat'   => 'fa-ship',
    'kayaking'      => 'fa-sailboat',
    'flying saucer' => 'fa-circle-radiation',
];

$jsActivities = [];
foreach (($activities ?? []) as $act) {
    $key = strtolower($act['name']);
    $jsActivities[$act['name']] = [
        'desc'       => $act['description'] ?? '',
        'difficulty' => $act['difficulty']  ?? 'Moderate',
        'duration'   => (int)($act['duration']  ?? 0),
        'max'        => (int)(preg_match('/(\d+)\s*(?:persons?)?$/u', $act['max_riders'] ?? '', $m) ? $m[1] : 1),
        'price'      => (float)$act['price'],
        'price_type' => $act['price_type'] ?? 'flat',
        'gear'       => $act['gear'] ?? '',
        'icon'       => $iconMap[$key] ?? 'fa-person-swimming',
    ];
}
$perPersonActivities = array_keys(array_filter($jsActivities, fn($a) => $a['price_type'] === 'per_person'));
?>

<script>
    const BOOKING_SLOTS_URL    = "<?= base_url('user/booking/slots') ?>";
    const BOOKED_DATES_URL     = "<?= base_url('user/booking/booked-dates') ?>";
    /* ── DB-driven activity data ── */
    const ACTIVITY_DATA        = <?= json_encode($jsActivities) ?>;
    const ACTIVITY_PRICING     = <?= json_encode($pricing) ?>;
    const ACTIVITY_MAX         = <?= json_encode($maxRiders) ?>;
    const ACTIVITY_DURATION    = <?= json_encode($durations) ?>;
    const PER_PERSON_ACTIVITIES= <?= json_encode($perPersonActivities) ?>;

    let selectedActivity  = "<?= esc($selectedActivity) ?>";
    let bookedDates       = <?= json_encode($bookedDates) ?>;
    let selectedDate      = '';
    let selectedTime      = '';
</script>

<form action="<?= base_url('user/booking/store') ?>" method="POST" id="bookingForm">
    <?= csrf_field() ?>
    <input type="hidden" name="activity"       id="f_activity"       value="<?= esc($selectedActivity) ?>">
    <input type="hidden" name="all_activities" id="f_all_activities" value="<?= esc($selectedActivity) ?>">
    <input type="hidden" name="date"           id="f_date"           value="">
    <input type="hidden" name="time"           id="f_time"           value="">
    <input type="hidden" name="participants"   id="f_participants"   value="1">

<div class="booking-layout">
<div class="steps-column">

    <?php if (session()->getFlashdata('error')): ?>
    <div class="alert-wave alert-wave-danger"><i class="fa-solid fa-circle-exclamation me-2"></i><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('errors')): ?>
    <div class="alert-wave alert-wave-danger"><?php foreach(session()->getFlashdata('errors') as $e): ?><div><i class="fa-solid fa-circle-exclamation me-2"></i><?= esc($e) ?></div><?php endforeach; ?></div>
    <?php endif; ?>

    <!-- STEP 1: Activity -->
    <div class="step-card">
        <div class="step-label"><i class="fa-solid fa-person-surfing"></i> Step 1 — Choose Your Activity</div>
        <div class="section-sep"></div>
        <div id="activity-display"></div>
        <div id="activity-empty" style="display:none;">
            <p class="opacity-50 mb-0" style="font-size:0.88rem;"><i class="fa-solid fa-circle-info me-2"></i>No activity selected. Pick one below.</p>
        </div>
        <!-- ── Dynamic activity picker (DB-driven) ── -->
        <div class="activity-picker" id="activity-picker">
            <p style="font-size:0.78rem;color:rgba(255,255,255,0.5);margin-bottom:8px;">Choose an activity to add:</p>
            <div class="activity-grid" id="activity-grid">
                <?php foreach (($activities ?? []) as $act): ?>
                    <?php
                        $aKey  = strtolower($act['name']);
                        $icon  = $iconMap[$aKey] ?? 'fa-person-swimming';
                        $pp    = ($act['price_type'] ?? 'flat') === 'per_person';
                        $pLabel= '₱' . number_format((float)$act['price'], 0) . ($pp ? '/person' : '');
                    ?>
                    <div class="activity-option"
                         data-activity="<?= esc($act['name']) ?>"
                         onclick="pickActivity('<?= esc(addslashes($act['name'])) ?>')">
                        <i class="fa-solid <?= $icon ?>"></i>
                        <?= esc($act['name']) ?>
                        <span class="act-opt-price"><?= $pLabel ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div id="btn-add-wrapper" style="display:none;">
            <button type="button" class="btn-add-activity" onclick="showPicker()">
                <i class="fa-solid fa-plus"></i> Add Another Activity
            </button>
        </div>
    </div>

    <!-- STEP 2: Calendar -->
    <div class="step-card">
        <div class="step-label"><i class="fa-regular fa-calendar-days"></i> Step 2 — Choose Your Date</div>
        <div class="section-sep"></div>
        <div class="calendar-header-row">
            <h4 id="cal-month-year">Loading…</h4>
            <div class="cal-nav d-flex gap-2">
                <button type="button" id="prev-month">&#9664;</button>
                <button type="button" id="next-month">&#9654;</button>
            </div>
        </div>
        <div class="cal-day-headers">
            <span>S</span><span>M</span><span>T</span><span>W</span><span>T</span><span>F</span><span>S</span>
        </div>
        <div class="calendar-days-grid" id="calendar-days"></div>
        <div class="cal-legend">
            <div class="cal-legend-item"><div class="cal-dot avail"></div> Available</div>
            <div class="cal-legend-item"><div class="cal-dot partial"></div> Partially Booked</div>
            <div class="cal-legend-item"><div class="cal-dot full"></div> Fully Booked</div>
            <div class="cal-legend-item"><div class="cal-dot today" style="width:11px;height:11px;border-radius:3px;"></div> Today</div>
        </div>
    </div>

    <!-- STEP 3: Time Slots -->
    <div class="step-card">
        <div class="step-label"><i class="fa-regular fa-clock"></i> Step 3 — Select Time Slot</div>
        <div class="section-sep"></div>
        <div class="time-slots-wrapper" id="time-slots-container">
            <div class="slots-loading"><i class="fa-solid fa-calendar-days me-2"></i>Please select a date first.</div>
        </div>
        <p class="form-hint mt-2" id="slots-count-hint"></p>
    </div>

    <!-- STEP 4: Details -->
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
                <label class="field-label">Contact Number</label>
                <span class="field-sublabel">— For booking confirmation &amp; updates</span>
                <input type="text" name="contact_number" id="f_contact" class="form-control-wave"
                       placeholder="e.g. 09XX-XXX-XXXX" required
                       pattern="[0-9+\s\-()]+"
                       oninput="updateSummaryContact()">
                <p class="form-hint">We'll use this to contact you about your reservation.</p>
            </div>
        </div>
        <div class="field-group">
            <label class="field-label">Special Requests <span style="font-weight:400;text-transform:none;letter-spacing:0;opacity:0.6;">— Optional</span></label>
            <textarea class="form-control-wave" name="special_requests" rows="3" placeholder="Any health concerns, special needs, or requests…"></textarea>
        </div>
    </div>

    <!-- STEP 5: Sea Conditions -->
    <div class="step-card" style="border-color:rgba(72,202,228,0.2);">
        <div class="step-label"><i class="fa-solid fa-tower-broadcast"></i> Step 5 — Current Sea Conditions (MARISENSE)</div>
        <div class="section-sep"></div>
        <div class="conditions-box">
            <?php
                $wind   = $seaCondition['wind_speed']   ?? '—';
                $wave   = $seaCondition['wave_height']  ?? '—';
                $period = $seaCondition['wave_period']  ?? '—';
                $safety = strtolower($seaCondition['safety_status'] ?? 'safe');
                $safetyClass = match($safety) { 'moderate'=>'moderate-bg','unsafe'=>'unsafe-bg',default=>'safe-bg' };
                $safetyText  = match($safety) { 'moderate'=>'Conditions Moderate — Proceed with Caution','unsafe'=>'Unsafe Conditions — Activity Not Recommended',default=>'Conditions Safe for All Activities' };
                $safetyIcon  = match($safety) { 'unsafe'=>'fa-triangle-exclamation','moderate'=>'fa-circle-exclamation',default=>'fa-circle-check' };
            ?>
            <div class="conditions-grid mb-4">
                <div class="condition-item"><strong><?= esc($wind) ?> kts</strong><span>Wind Speed</span></div>
                <div class="condition-item"><strong><?= esc($wave) ?> m</strong><span>Wave Height</span></div>
                <div class="condition-item"><strong><?= esc($period) ?> s</strong><span>Wave Period</span></div>
            </div>
            <div class="text-center">
                <div class="safety-badge <?= $safetyClass ?>">
                    <i class="fa-solid <?= $safetyIcon ?>"></i> <?= $safetyText ?>
                </div>
            </div>
        </div>
    </div>

</div><!-- /steps-column -->

<!-- SUMMARY SIDEBAR -->
<div class="summary-sidebar">
    <div class="summary-card">
        <div class="step-label" style="color:var(--ocean-blue);"><i class="fa-solid fa-clipboard-check"></i> Step 6 — Confirm Booking</div>
        <h4>Booking Summary</h4>

        <div class="summary-row"><span class="s-label">Activity</span><span class="s-value" id="summary-activity">—</span></div>
        <div class="summary-row"><span class="s-label">Location</span><span class="s-value">Matabungkay Beach</span></div>
        <div class="summary-row"><span class="s-label">Date</span><span class="s-value" id="summary-date">Not selected</span></div>
        <div class="summary-row"><span class="s-label">Time</span><span class="s-value" id="summary-time">Not selected</span></div>
        <div class="summary-row"><span class="s-label">Duration</span><span class="s-value" id="summary-duration">—</span></div>
        <div class="summary-row"><span class="s-label">Participants</span><span class="s-value" id="summary-participants">—</span></div>
        <div class="summary-row"><span class="s-label">Contact No.</span><span class="s-value" id="summary-contact">—</span></div>

        <hr class="summary-divider">

        <div class="summary-total-box">
            <div class="price-breakdown" id="summary-base-price"></div>
            <div class="price-total-row">
                <span class="total-label">Total Amount</span>
                <span class="total-amount" id="summary-total">—</span>
            </div>
        </div>

        <div style="background:rgba(72,202,228,0.08);border:1px solid rgba(72,202,228,0.25);border-radius:12px;padding:12px 14px;margin-bottom:14px;font-size:0.78rem;color:rgba(5,44,57,0.65);">
            <i class="fa-solid fa-circle-info me-1" style="color:var(--ocean-blue);"></i>
            Payment can be made after booking — visit <strong>My Bookings</strong> to pay half or full via GCash.
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="guidelines" id="guidelines" value="1" required>
            <label class="form-check-label" for="guidelines">
                I have read and agree to the safety guidelines and activity rules.
            </label>
        </div>

        <button type="submit" class="btn-confirm" id="confirm-btn" disabled>
            <i class="fas fa-check-circle me-2"></i> Confirm Reservation
        </button>
        <p class="form-hint text-center mt-2" id="confirm-hint" style="color:rgba(5,44,57,0.5);">Please complete all steps to continue.</p>
    </div>

    <div class="slots-info-card">
        <p><i class="fas fa-shield-halved"></i> Safety gear provided for all activities</p>
        <p><i class="fas fa-rotate-left"></i> Free cancellation up to 24 hrs before</p>
        <p><i class="fas fa-headset"></i> On-site crew available at all times</p>
        <p class="mb-0"><i class="fas fa-mobile-screen-button"></i> GCash down payment available</p>
    </div>
</div>

</div><!-- /booking-layout -->
</form>

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
// ============================================================
// STATE
// ============================================================
let selectedActivities = selectedActivity ? [selectedActivity] : [];
let participantCounts  = {};
let pickerVisible      = false;

// ============================================================
// INIT
// ============================================================
function initActivityDisplay() {
    renderActivityList();
    renderSummaryActivities();
    if (selectedActivities.length === 0) showPicker();
    else hidePicker();
}

// ============================================================
// PICKER
// ============================================================
function showPicker() {
    pickerVisible = true;
    document.getElementById('activity-picker').classList.add('show');
    document.getElementById('btn-add-wrapper').style.display = 'none';
    refreshPickerOptions();
}

function hidePicker() {
    pickerVisible = false;
    document.getElementById('activity-picker').classList.remove('show');
    if (selectedActivities.length > 0) document.getElementById('btn-add-wrapper').style.display = 'block';
}

function refreshPickerOptions() {
    document.querySelectorAll('.activity-option').forEach(el => {
        const act = el.getAttribute('data-activity');
        el.classList.toggle('already-selected', selectedActivities.includes(act));
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

    // Refresh booked dates for primary activity
    fetch(BOOKED_DATES_URL + '?activity=' + encodeURIComponent(selectedActivities[0]))
        .then(r => r.json())
        .then(data => {
            bookedDates  = data.bookedDates || [];
            selectedDate = '';
            selectedTime = '';
            document.getElementById('f_date').value          = '';
            document.getElementById('f_time').value          = '';
            document.getElementById('summary-date').textContent = 'Not selected';
            document.getElementById('summary-time').textContent = 'Not selected';
            document.getElementById('time-slots-container').innerHTML = '<div class="slots-loading"><i class="fa-solid fa-calendar-days me-2"></i>Please select a date first.</div>';
            renderCalendar();
            checkConfirmReady();
        });
}

function removeActivity(act) {
    selectedActivities = selectedActivities.filter(a => a !== act);
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

// ============================================================
// RENDER SELECTED ACTIVITY CARDS
// ============================================================
function renderActivityList() {
    const container = document.getElementById('activity-display');
    const emptyEl   = document.getElementById('activity-empty');

    if (selectedActivities.length === 0) {
        container.innerHTML = '';
        emptyEl.style.display = 'block';
        return;
    }
    emptyEl.style.display = 'none';

    container.innerHTML = selectedActivities.map(act => {
        const data  = ACTIVITY_DATA[act] || {};
        const max   = data.max   || 1;
        const dur   = data.duration || 0;
        const price = data.price  || 0;
        const pp    = PER_PERSON_ACTIVITIES.includes(act);
        const gear  = data.gear  || '';
        return `<div class="activity-highlight">
            <div class="act-card-actions">
                <div class="btn-cancel-act" onclick="removeActivity('${act}')" title="Remove"><i class="fa-solid fa-xmark"></i></div>
            </div>
            <h3>${act}</h3>
            <p style="color:rgba(255,255,255,0.6);font-size:0.82rem;margin-bottom:14px;">${data.desc || ''}</p>
            <div class="activity-meta">
                <span><i class="fa-solid fa-clock"></i> ${dur} mins</span>
                <span><i class="fa-solid fa-users"></i> Max ${max} person${max>1?'s':''}</span>
                ${gear ? `<span><i class="fa-solid fa-vest"></i> ${gear}</span>` : ''}
                <span><i class="fa-solid fa-gauge-high"></i> ${data.difficulty || '—'}</span>
                <span><i class="fa-solid fa-tag"></i> ₱${price.toLocaleString()}${pp?' / person':''}</span>
            </div>
        </div>`;
    }).join('');
}

// ============================================================
// PARTICIPANTS
// ============================================================
function updateActivityParticipants(act, val) {
    participantCounts[act] = parseInt(val);
    var total = Object.values(participantCounts).reduce((s,v) => s + v, 0);
    document.getElementById('f_participants').value = total;
    updateSummaryParticipants();
    recalcTotal();
}

function updateSummaryParticipants() {
    if (selectedActivities.length === 0) { document.getElementById('summary-participants').textContent = '—'; return; }
    var parts = selectedActivities.map(act => {
        var c = participantCounts[act] || 1;
        return `${act}: ${c} person${c>1?'s':''}`;
    });
    document.getElementById('summary-participants').textContent = parts.join(' · ');
}

function updateSummaryContact() {
    var val = document.getElementById('f_contact').value;
    document.getElementById('summary-contact').textContent = val || '—';
}

function renderParticipantsDropdowns() {
    var container = document.getElementById('participants-container');
    if (selectedActivities.length === 0) {
        container.innerHTML = '<p class="form-hint" style="opacity:0.5;">Select an activity first.</p>';
        return;
    }
    container.innerHTML = selectedActivities.map(act => {
        var max     = ACTIVITY_DATA[act] ? ACTIVITY_DATA[act].max : (ACTIVITY_MAX[act] || 1);
        var current = Math.min(participantCounts[act] || 1, max);
        participantCounts[act] = current;
        var options = '';
        for (var i = 1; i <= max; i++) {
            options += `<option value="${i}"${i===current?' selected':''}>` + i + ` Person${i>1?'s':''}</option>`;
        }
        return `<div style="margin-bottom:10px;">
            <p style="font-size:0.75rem;color:rgba(255,255,255,0.6);margin-bottom:4px;font-weight:600;">
                <i class="fa-solid fa-person-swimming me-1" style="color:var(--accent-cyan);"></i>${act}
                <span style="opacity:0.5;">(max ${max})</span>
            </p>
            <select class="form-select-wave" onchange="updateActivityParticipants('${act}', this.value)">${options}</select>
        </div>`;
    }).join('');
    updateSummaryParticipants();
    var totalP = Object.values(participantCounts).reduce((s,v) => s + v, 0);
    document.getElementById('f_participants').value = totalP || 1;
}

function cleanParticipantCounts() {
    Object.keys(participantCounts).forEach(act => { if (!selectedActivities.includes(act)) delete participantCounts[act]; });
    selectedActivities.forEach(act => { if (!participantCounts[act]) participantCounts[act] = 1; });
}

function recalcTotal() {
    var total = 0;
    selectedActivities.forEach(act => {
        var price = (ACTIVITY_DATA[act] && ACTIVITY_DATA[act].price) ? ACTIVITY_DATA[act].price : (ACTIVITY_PRICING[act] || 0);
        var count = participantCounts[act] || 1;
        total += PER_PERSON_ACTIVITIES.includes(act) ? price * count : price;
    });
    document.getElementById('summary-total').textContent = total ? '₱' + total.toLocaleString() : '—';
    return total;
}

function renderSummaryActivities() {
    cleanParticipantCounts();
    renderParticipantsDropdowns();

    document.getElementById('summary-activity').textContent =
        selectedActivities.length > 0 ? selectedActivities.join(', ') : '—';

    document.getElementById('summary-duration').textContent =
        selectedActivities.length > 0
            ? selectedActivities.map(a => a + ': ' + ((ACTIVITY_DATA[a] && ACTIVITY_DATA[a].duration) || 0) + ' mins').join(' · ')
            : '—';

    var total = 0, html = '';
    selectedActivities.forEach(act => {
        var data  = ACTIVITY_DATA[act] || {};
        var price = data.price || (ACTIVITY_PRICING[act] || 0);
        var pp    = PER_PERSON_ACTIVITIES.includes(act);
        var count = participantCounts[act] || 1;
        var dur   = data.duration || 0;
        var line  = pp ? price * count : price;
        total += line;
        html += `<div class="sum-activity-line">
            <div class="sal-name">${act}</div>
            <div class="sal-detail">
                <span>${dur} mins · ${count} person${count>1?'s':''}${pp?' · ₱'+price.toLocaleString()+'×'+count:''}</span>
                <span class="sal-price">₱${line.toLocaleString()}</span>
            </div>
        </div>`;
    });
    document.getElementById('summary-base-price').innerHTML = html;
    document.getElementById('summary-total').textContent = total ? '₱' + total.toLocaleString() : '—';
    updateSummaryParticipants();
}

// ============================================================
// CALENDAR
// ============================================================
const monthNames = ['January','February','March','April','May','June','July','August','September','October','November','December'];
let currentDate = new Date();

function renderCalendar() {
    const yr = currentDate.getFullYear(), mo = currentDate.getMonth();
    document.getElementById('cal-month-year').textContent = `${monthNames[mo]} ${yr}`;
    const firstDay     = new Date(yr, mo, 1).getDay();
    const daysInMonth  = new Date(yr, mo+1, 0).getDate();
    const todayStr     = formatDate(new Date());
    const grid         = document.getElementById('calendar-days');
    grid.innerHTML     = '';

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
        const isTodayAllSlotsPast = isToday && (() => { return new Date().getHours() >= 17; })();

        if (isPast || isTodayAllSlotsPast) {
            d.classList.add('past');
            d.title = isPast ? 'Past date' : 'No more slots today';
        } else if (bookedDates.includes(dateStr)) {
            d.classList.add('booked');
            d.title = 'Fully booked';
        } else {
            d.classList.add('available');
            if (isToday) d.classList.add('today');
            d.title = 'Available — Click to select';
            d.addEventListener('click', function() {
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
    const opts = {year:'numeric', month:'long', day:'numeric'};
    document.getElementById('summary-date').textContent = new Date(dateStr+'T00:00:00').toLocaleDateString('en-PH', opts);
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
        document.getElementById('time-slots-container').innerHTML = '<div class="slots-loading"><i class="fa-solid fa-circle-exclamation me-2 text-warning"></i>Please select an activity first.</div>';
        return;
    }
    const container = document.getElementById('time-slots-container');
    container.innerHTML = '<div class="slots-loading"><i class="fa-solid fa-spinner fa-spin me-2"></i>Loading slots…</div>';
    document.getElementById('slots-count-hint').textContent = '';

    const staticSlots = [];
    for (var h = 7; h < 17; h++) {
        var ampm1 = h < 12 ? 'AM' : 'PM'; var ampm2 = (h+1) < 12 ? 'AM' : 'PM';
        var h1 = h > 12 ? h-12 : h; var h2 = (h+1) > 12 ? h+1-12 : h+1;
        staticSlots.push({ label: `${h1}:00 ${ampm1} – ${h2}:00 ${ampm2}`, value: `${String(h).padStart(2,'0')}:00` });
    }

    fetch(`${BOOKING_SLOTS_URL}?activity=${encodeURIComponent(actForSlots)}&date=${date}`)
        .then(r => r.json())
        .then(data => {
            var taken = new Set();
            (data.slots || []).forEach(s => { if (!s.available) taken.add(s.value); });
            container.innerHTML = '';
            var avail = 0;
            staticSlots.forEach(slot => {
                var isTaken = taken.has(slot.value + ':00') || taken.has(slot.value);
                var btn = document.createElement('div');
                btn.className = 'time-slot-btn' + (isTaken ? ' unavailable' : '');
                btn.innerHTML = `<span>${slot.label}</span><span class="slot-status ${isTaken?'taken':'open'}">${isTaken?'Taken':'Available'}</span>`;
                if (!isTaken) {
                    avail++;
                    btn.addEventListener('click', function() {
                        document.querySelectorAll('.time-slot-btn.active').forEach(b => b.classList.remove('active'));
                        btn.classList.add('active');
                        selectTime(slot.value, slot.label);
                    });
                }
                container.appendChild(btn);
            });
            var hint = document.getElementById('slots-count-hint');
            hint.innerHTML = avail === 0
                ? '<i class="fas fa-circle-xmark me-1 text-danger"></i> No slots available for this date.'
                : `<i class="fas fa-circle-info me-1" style="color:var(--accent-cyan);"></i> ${avail} slot${avail!==1?'s':''} available`;
        })
        .catch(() => {
            container.innerHTML = '';
            staticSlots.forEach(slot => {
                var btn = document.createElement('div');
                btn.className = 'time-slot-btn';
                btn.innerHTML = `<span>${slot.label}</span><span class="slot-status open">Available</span>`;
                btn.addEventListener('click', function() {
                    document.querySelectorAll('.time-slot-btn.active').forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');
                    selectTime(slot.value, slot.label);
                });
                container.appendChild(btn);
            });
            document.getElementById('slots-count-hint').innerHTML = `<i class="fas fa-circle-info me-1" style="color:var(--accent-cyan);"></i> ${staticSlots.length} slots available`;
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
    if (selectedActivities.length === 0) { btn.disabled = true; hint.textContent = 'Please select at least one activity.'; }
    else if (!selectedDate)              { btn.disabled = true; hint.textContent = 'Please select a date.'; }
    else if (!selectedTime)              { btn.disabled = true; hint.textContent = 'Please select a time slot.'; }
    else                                 { btn.disabled = false; hint.textContent = ''; }
}

document.getElementById('bookingForm').addEventListener('submit', function(e) {
    const contact = document.getElementById('f_contact').value.trim();
    if (!contact) { e.preventDefault(); alert('Please provide your contact number.'); return; }
    if (selectedActivities.length === 0 || !selectedDate || !selectedTime) {
        e.preventDefault(); alert('Please complete all required steps.'); return;
    }
    if (!document.getElementById('guidelines').checked) {
        e.preventDefault(); alert('Please agree to the safety guidelines.'); return;
    }
});

document.getElementById('helpModal').addEventListener('click', function(e) {
    if (e.target === this) this.classList.add('d-none');
});

initActivityDisplay();
renderCalendar();
</script>
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