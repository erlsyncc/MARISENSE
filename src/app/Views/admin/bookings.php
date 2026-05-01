<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookings | Waves Admin</title>
    <link rel="stylesheet" href="<?= base_url('bootstrap5/css/bootstrap.min.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --deep-blue: #052c39; --ocean-blue: #0a5872; --accent-cyan: #48cae4; --soft-white: #f4f9fc; --sidebar-width: 260px; }
        * { box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background: linear-gradient(180deg, var(--ocean-blue) 0%, var(--deep-blue) 60%, var(--deep-blue) 100%); }

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
        .help-btn { display: flex; align-items: center; gap: 12px; padding: 11px 20px; border-radius: 12px; color: var(--accent-cyan); text-decoration: none; font-size: 0.88rem; font-weight: 600; border: 1px solid rgba(72,202,228,0.25); transition: 0.25s; cursor: pointer; background: none; width: 100%; margin-top: 8px; }
        .help-btn:hover { background: rgba(72,202,228,0.15); color: white; }

        /* ── Main ── */
        .main-content { margin-left: var(--sidebar-width); padding: 32px 36px; min-height: 100vh; }
        .page-topbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 28px; }
        .page-title { font-size: 1.6rem; font-weight: 700; color: white; margin: 0; }
        .page-subtitle { font-size: 0.82rem; color: rgba(255,255,255,0.5); margin: 2px 0 0; }
        .admin-pill { background: rgba(72,202,228,0.12); border: 1px solid rgba(72,202,228,0.3); color: var(--accent-cyan); border-radius: 50px; padding: 6px 18px; font-size: 0.78rem; font-weight: 600; letter-spacing: 1px; }

        /* ── Filters ── */
        .filter-bar { display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 22px; align-items: center; }
        .filter-btn { background: rgba(255,255,255,0.08); color: rgba(255,255,255,0.7); border: 1px solid rgba(255,255,255,0.15); padding: 7px 18px; border-radius: 50px; font-size: 0.8rem; font-weight: 500; cursor: pointer; transition: 0.2s; }
        .filter-btn:hover, .filter-btn.active { background: var(--accent-cyan); color: var(--deep-blue); border-color: var(--accent-cyan); font-weight: 700; }
        .search-input { background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); border-radius: 50px; color: white; padding: 7px 18px; font-size: 0.82rem; outline: none; min-width: 220px; font-family: 'Poppins', sans-serif; }
        .search-input::placeholder { color: rgba(255,255,255,0.3); }
        .search-input:focus { border-color: var(--accent-cyan); }

        /* ── Table ── */
        .table-container { background: rgba(255,255,255,0.07); backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.1); border-radius: 24px; padding: 10px; overflow-x: auto; }
        .custom-table { width: 100%; color: white; border-collapse: separate; border-spacing: 0 8px; min-width: 960px; }
        .custom-table thead th { border: none; text-transform: uppercase; font-size: 0.7rem; letter-spacing: 1.5px; opacity: 0.5; padding: 8px 16px; font-weight: 600; }
        .custom-table tbody tr { background: rgba(255,255,255,0.04); transition: 0.25s; }
        .custom-table tbody tr:hover { background: rgba(255,255,255,0.09); transform: scale(1.003); }
        .custom-table td { padding: 14px 16px; vertical-align: middle; border: none; font-size: 0.85rem; }
        .custom-table td:first-child { border-radius: 14px 0 0 14px; }
        .custom-table td:last-child { border-radius: 0 14px 14px 0; }

        /* ── Badges ── */
        .badge-status { padding: 5px 14px; border-radius: 50px; font-size: 0.72rem; font-weight: 700; white-space: nowrap; display: inline-flex; align-items: center; gap: 5px; }
        .s-pending   { background: rgba(255,193,7,0.12);  color: #ffc107; border: 1px solid rgba(255,193,7,0.4); }
        .s-confirmed { background: rgba(40,167,69,0.12);  color: #5ddb8a; border: 1px solid rgba(40,167,69,0.4); }
        .s-completed { background: rgba(72,202,228,0.12); color: #48cae4; border: 1px solid rgba(72,202,228,0.4); }
        .s-cancelled { background: rgba(220,53,69,0.12);  color: #ff8888; border: 1px solid rgba(220,53,69,0.4); }
        .pay-paid     { background: rgba(40,167,69,0.14);  color: #5ddb8a; border: 1px solid rgba(40,167,69,0.4);  padding: 4px 12px; border-radius: 50px; font-size: 0.7rem; font-weight: 700; display: inline-flex; align-items: center; gap: 4px; }
        .pay-half     { background: rgba(255,193,7,0.12);  color: #ffc107; border: 1px solid rgba(255,193,7,0.4);  padding: 4px 12px; border-radius: 50px; font-size: 0.7rem; font-weight: 700; display: inline-flex; align-items: center; gap: 4px; }
        .pay-pending  { background: rgba(255,255,255,0.06);color: rgba(255,255,255,0.45); border: 1px solid rgba(255,255,255,0.14); padding: 4px 12px; border-radius: 50px; font-size: 0.7rem; font-weight: 700; display: inline-flex; align-items: center; gap: 4px; }
        .pay-receipt  { background: rgba(72,202,228,0.1);  color: #48cae4; border: 1px solid rgba(72,202,228,0.35); padding: 4px 12px; border-radius: 50px; font-size: 0.7rem; font-weight: 700; display: inline-flex; align-items: center; gap: 4px; }

        /* ── Action buttons ── */
        .btn-approve  { background: rgba(40,167,69,0.15);  color: #5ddb8a; border: 1px solid rgba(40,167,69,0.3);  border-radius: 8px; padding: 5px 12px; font-size: 0.75rem; font-weight: 600; cursor: pointer; transition: 0.2s; }
        .btn-approve:hover  { background: #5ddb8a; color: var(--deep-blue); }
        .btn-cancel   { background: rgba(220,53,69,0.12);  color: #ff8888; border: 1px solid rgba(220,53,69,0.3);  border-radius: 8px; padding: 5px 12px; font-size: 0.75rem; font-weight: 600; cursor: pointer; transition: 0.2s; }
        .btn-cancel:hover   { background: #dc3545; color: white; }
        .btn-complete { background: rgba(72,202,228,0.12); color: #48cae4; border: 1px solid rgba(72,202,228,0.3); border-radius: 8px; padding: 5px 12px; font-size: 0.75rem; font-weight: 600; cursor: pointer; transition: 0.2s; }
        .btn-complete:hover { background: var(--accent-cyan); color: var(--deep-blue); }
        .btn-view-booking { background: rgba(72,202,228,0.1); color: #48cae4; border: 1px solid rgba(72,202,228,0.3); border-radius: 8px; padding: 5px 12px; font-size: 0.75rem; font-weight: 600; cursor: pointer; transition: 0.2s; }
        .btn-view-booking:hover { background: var(--accent-cyan); color: var(--deep-blue); }

        .empty-state { text-align: center; padding: 50px 20px; opacity: 0.5; }
        .empty-state i { font-size: 2.5rem; margin-bottom: 12px; display: block; }
        @keyframes wave-motion { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-3px)} }
        .brand-icon i { animation: wave-motion 3s ease-in-out infinite; display: inline-block; }

        /* ════════════════════════════════════════
           BOOKING DETAIL MODAL
        ════════════════════════════════════════ */
        #detailOverlay { display: none; position: fixed; inset: 0; background: rgba(5,44,57,0.88); backdrop-filter: blur(10px); z-index: 9000; align-items: flex-start; justify-content: center; padding: 40px 20px; overflow-y: auto; }
        #detailOverlay.open { display: flex; }

        .detail-modal { background: linear-gradient(145deg, #0b3f55, #052c39); border: 1px solid rgba(72,202,228,0.3); border-radius: 28px; padding: 36px; max-width: 680px; width: 100%; box-shadow: 0 40px 80px rgba(0,0,0,0.6); position: relative; animation: slideUp 0.25s ease; }
        @keyframes slideUp { from { opacity:0; transform:translateY(20px); } to { opacity:1; transform:translateY(0); } }

        .dm-close { position: absolute; top: 20px; right: 20px; background: rgba(255,255,255,0.08); border: none; color: rgba(255,255,255,0.6); border-radius: 50%; width: 36px; height: 36px; cursor: pointer; font-size: 1rem; transition: 0.2s; display: flex; align-items: center; justify-content: center; }
        .dm-close:hover { background: rgba(220,53,69,0.3); color: #ff6b6b; }

        .dm-title { font-size: 1.2rem; font-weight: 700; color: white; margin-bottom: 2px; }
        .dm-sub { font-size: 0.78rem; color: rgba(255,255,255,0.4); margin-bottom: 24px; }

        .dm-section { font-size: 0.63rem; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; color: var(--accent-cyan); margin: 20px 0 10px; display: flex; align-items: center; gap: 7px; }

        /* Info grid */
        .dm-info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 4px; }
        .dm-info-item { background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.08); border-radius: 12px; padding: 12px 16px; }
        .dm-info-label { font-size: 0.65rem; text-transform: uppercase; letter-spacing: 1px; color: rgba(255,255,255,0.4); font-weight: 700; margin-bottom: 4px; }
        .dm-info-value { font-size: 0.88rem; font-weight: 600; color: white; }

        /* Cost table */
        .dm-cost-table { background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 14px; overflow: hidden; margin-bottom: 4px; }
        .dm-cost-header { padding: 8px 16px; background: rgba(72,202,228,0.07); font-size: 0.62rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: var(--accent-cyan); border-bottom: 1px solid rgba(72,202,228,0.12); }
        .dm-cost-row { display: flex; justify-content: space-between; align-items: center; padding: 10px 16px; border-bottom: 1px solid rgba(255,255,255,0.05); font-size: 0.84rem; }
        .dm-cost-row:last-child { border-bottom: none; }
        .dm-cost-act { display: flex; align-items: center; gap: 8px; color: rgba(255,255,255,0.8); font-weight: 500; }
        .dm-cost-act i { color: var(--accent-cyan); width: 15px; text-align: center; font-size: 0.78rem; }
        .dm-cost-formula { font-size: 0.72rem; color: rgba(255,255,255,0.35); margin-left: 4px; font-style: italic; }
        .dm-cost-amt { font-weight: 700; color: var(--accent-cyan); }
        .dm-cost-total { display: flex; justify-content: space-between; align-items: center; padding: 11px 16px; background: rgba(72,202,228,0.08); border-top: 2px solid rgba(72,202,228,0.2); font-weight: 700; font-size: 0.9rem; color: var(--accent-cyan); }
        .dm-cost-total-amt { font-size: 1.2rem; font-weight: 900; }

        /* Receipt */
        .dm-receipt-box { background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.1); border-radius: 14px; padding: 16px; margin-bottom: 4px; }
        .dm-receipt-img { width: 100%; max-height: 320px; object-fit: contain; border-radius: 10px; background: rgba(0,0,0,0.3); display: block; cursor: zoom-in; transition: 0.2s; }
        .dm-receipt-img:hover { transform: scale(1.01); }
        .dm-receipt-meta { display: flex; justify-content: space-between; align-items: center; margin-top: 10px; flex-wrap: wrap; gap: 8px; }
        .dm-ref { font-size: 0.78rem; color: rgba(255,255,255,0.5); }
        .dm-ref span { color: white; font-weight: 600; }
        .dm-no-receipt { text-align: center; padding: 28px; color: rgba(255,255,255,0.3); font-size: 0.82rem; }
        .dm-no-receipt i { font-size: 2rem; display: block; margin-bottom: 8px; opacity: 0.4; }

        /* Receipt awaiting-verification note */
        .dm-receipt-pending-note { background: rgba(255,193,7,0.08); border: 1px solid rgba(255,193,7,0.3); border-radius: 10px; padding: 10px 14px; margin-top: 10px; font-size: 0.78rem; color: #ffc107; display: flex; align-items: center; gap: 8px; }

        /* Payment action buttons */
        .dm-pay-actions { display: flex; gap: 10px; flex-wrap: wrap; margin-top: 6px; }
        .btn-mark-down { background: rgba(255,193,7,0.14); color: #ffc107; border: 1px solid rgba(255,193,7,0.4); border-radius: 10px; padding: 9px 20px; font-size: 0.82rem; font-weight: 700; cursor: pointer; transition: 0.2s; display: inline-flex; align-items: center; gap: 7px; font-family: 'Poppins', sans-serif; }
        .btn-mark-down:hover { background: rgba(255,193,7,0.3); transform: translateY(-1px); }
        .btn-mark-paid { background: rgba(40,167,69,0.14); color: #5ddb8a; border: 1px solid rgba(40,167,69,0.4); border-radius: 10px; padding: 9px 20px; font-size: 0.82rem; font-weight: 700; cursor: pointer; transition: 0.2s; display: inline-flex; align-items: center; gap: 7px; font-family: 'Poppins', sans-serif; }
        .btn-mark-paid:hover { background: rgba(40,167,69,0.3); transform: translateY(-1px); }
        .btn-reject-pay { background: rgba(220,53,69,0.1); color: #ff9999; border: 1px solid rgba(220,53,69,0.3); border-radius: 10px; padding: 9px 20px; font-size: 0.82rem; font-weight: 700; cursor: pointer; transition: 0.2s; display: inline-flex; align-items: center; gap: 7px; font-family: 'Poppins', sans-serif; }
        .btn-reject-pay:hover { background: rgba(220,53,69,0.25); transform: translateY(-1px); }
        .already-paid-note { background: rgba(40,167,69,0.1); border: 1px solid rgba(40,167,69,0.3); border-radius: 10px; padding: 12px 16px; font-size: 0.82rem; color: #5ddb8a; display: flex; align-items: center; gap: 8px; }

        /* Receipt lightbox */
        #lightbox { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.92); z-index: 99999; align-items: center; justify-content: center; cursor: zoom-out; }
        #lightbox.open { display: flex; }
        #lightbox img { max-width: 90vw; max-height: 90vh; border-radius: 12px; object-fit: contain; box-shadow: 0 0 60px rgba(0,0,0,0.8); }

        /* Help modal */
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

        /* ── CENTER TOAST ── */
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

<!-- ════ CENTER TOAST ════ -->
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

<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon"><i class="fa-solid fa-water"></i></div>
        <div class="brand-title">Waves Admin</div>
        <div class="brand-sub">Control Panel</div>
    </div>
    <div class="sidebar-section-label">Main</div>
    <a href="<?= base_url('admin/dashboard') ?>" class="nav-item"><i class="fa-solid fa-chart-line"></i> Dashboard</a>
    <a href="<?= base_url('admin/bookings') ?>" class="nav-item active">
        <i class="fa-solid fa-calendar-check"></i> Bookings
        <span class="badge-count"><?= $pendingCount ?? 0 ?></span>
    </a>
    <a href="<?= base_url('admin/users') ?>" class="nav-item"><i class="fa-solid fa-users"></i> Users</a>
    <div class="sidebar-section-label">Operations</div>
    <a href="<?= base_url('admin/sea-conditions') ?>" class="nav-item"><i class="fa-solid fa-tower-broadcast"></i> Sea Conditions</a>
    <a href="<?= base_url('admin/reviews') ?>" class="nav-item"><i class="fa-solid fa-star"></i> Reviews</a>
    <div class="sidebar-section-label">System</div>
    <a href="<?= base_url('admin/activities') ?>" class="nav-item"><i class="fa-solid fa-person-swimming"></i> Activities</a>
    <a href="<?= base_url('admin/sales') ?>" class="nav-item"><i class="fa-solid fa-peso-sign"></i> Sales</a>
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
            <h1 class="page-title">Manage Bookings</h1>
            <p class="page-subtitle">Review, verify payments, and manage all activity reservations.</p>
        </div>
        <span class="admin-pill"><i class="fa-solid fa-calendar-check me-2"></i>BOOKINGS</span>
    </div>

    <!-- Filters -->
    <div class="filter-bar">
        <input type="text" class="search-input" id="searchInput"
               placeholder="&#xf002;  Search name or booking code..."
               oninput="filterTable()">
        <button class="filter-btn active" onclick="setFilter('all',this)">All</button>
        <button class="filter-btn" onclick="setFilter('pending',this)">Pending</button>
        <button class="filter-btn" onclick="setFilter('confirmed',this)">Confirmed</button>
        <button class="filter-btn" onclick="setFilter('completed',this)">Completed</button>
        <button class="filter-btn" onclick="setFilter('cancelled',this)">Cancelled</button>
    </div>

    <!-- Table -->
    <div class="table-container shadow-lg">
        <table class="custom-table" id="bookingsTable">
            <thead>
                <tr>
                    <th>Guest</th>
                    <th>Activity</th>
                    <th>Date &amp; Time</th>
                    <th>Pax</th>
                    <th>Status</th>
                    <th>Payment</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody id="tableBody">
            <?php if (!empty($bookings)): ?>
                <?php foreach ($bookings as $b):
                    $sc = match(strtolower($b['status'])) {
                        'pending'              => 's-pending',
                        'confirmed','approved' => 's-confirmed',
                        'completed'            => 's-completed',
                        'cancelled'            => 's-cancelled',
                        default                => 's-pending',
                    };
                    $initials = strtoupper(substr($b['username'] ?? 'G', 0, 2));

                    // ── FIX: receipt can live in bookings OR payment_history (already merged in controller)
                    $hasReceipt = !empty($b['gcash_receipt']);
                    if (($b['payment_status'] ?? '') === 'paid') {
                        $payBadge = '<span class="pay-paid"><i class="fa-solid fa-check"></i> Fully Paid</span>';
                    } elseif (($b['down_payment_status'] ?? '') === 'paid') {
                        $payBadge = '<span class="pay-half"><i class="fa-solid fa-circle-half-stroke"></i> 50% Paid</span>';
                    } elseif ($hasReceipt) {
                        $payBadge = '<span class="pay-receipt"><i class="fa-solid fa-image"></i> Receipt Uploaded</span>';
                    } else {
                        $payBadge = '<span class="pay-pending"><i class="fa-solid fa-hourglass"></i> Unpaid</span>';
                    }

                    // Check if receipt is pending admin verification
                    $receiptPendingVerify = $hasReceipt
                        && ($b['payment_status'] ?? '') !== 'paid'
                        && ($b['down_payment_status'] ?? '') !== 'paid';
                ?>
                <tr data-status="<?= strtolower($b['status']) ?>"
                    data-search="<?= strtolower(($b['username'] ?? '') . ' ' . ($b['booking_code'] ?? '')) ?>">
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div style="width:34px;height:34px;border-radius:50%;background:rgba(72,202,228,0.15);display:flex;align-items:center;justify-content:center;font-size:0.7rem;font-weight:700;color:var(--accent-cyan);flex-shrink:0;">
                                <?= $initials ?>
                            </div>
                            <div>
                                <div style="font-weight:600;"><?= esc($b['username'] ?? 'Guest') ?></div>
                                <div style="font-size:0.72rem;color:rgba(255,255,255,0.4);">#<?= esc($b['booking_code'] ?? $b['id']) ?></div>
                            </div>
                        </div>
                    </td>
                    <td style="max-width:180px;">
                        <div style="font-weight:600;font-size:0.82rem;line-height:1.4;">
                            <?= esc($b['all_activities'] ?? $b['activity_name'] ?? '—') ?>
                        </div>
                    </td>
                    <td>
                        <div style="font-weight:600;"><?= date('M d, Y', strtotime($b['date'])) ?></div>
                        <div style="font-size:0.75rem;color:var(--accent-cyan);"><?= date('h:i A', strtotime($b['time'])) ?></div>
                    </td>
                    <td><?= esc($b['participants'] ?? 1) ?></td>
                    <td><span class="badge-status <?= $sc ?>"><?= ucfirst($b['status']) ?></span></td>
                    <td>
                        <?= $payBadge ?>
                        <?php if ($receiptPendingVerify): ?>
                            <div style="font-size:0.68rem;color:#ffc107;margin-top:3px;"><i class="fa-solid fa-circle-exclamation me-1"></i>Needs review</div>
                        <?php endif; ?>
                    </td>
                    <td class="text-center">
                        <div class="d-flex gap-1 justify-content-center flex-wrap">

                            <!-- View Details (always visible) -->
                            <button class="btn-view-booking"
                                onclick="openDetail(<?= htmlspecialchars(json_encode($b), ENT_QUOTES) ?>)">
                                <i class="fa-solid fa-eye me-1"></i>View
                            </button>

                            <!-- Booking status actions -->
                            <?php if (strtolower($b['status']) === 'pending'): ?>
                                <form method="POST" action="<?= base_url('admin/bookings/update-status') ?>" style="display:inline;">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="id" value="<?= $b['id'] ?>">
                                    <input type="hidden" name="status" value="confirmed">
                                    <button type="submit" class="btn-approve"><i class="fa-solid fa-check me-1"></i>Approve</button>
                                </form>
                                <form method="POST" action="<?= base_url('admin/bookings/update-status') ?>" style="display:inline;">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="id" value="<?= $b['id'] ?>">
                                    <input type="hidden" name="status" value="cancelled">
                                    <button type="submit" class="btn-cancel"><i class="fa-solid fa-xmark me-1"></i>Cancel</button>
                                </form>
                            <?php elseif (strtolower($b['status']) === 'confirmed'): ?>
                                <form method="POST" action="<?= base_url('admin/bookings/update-status') ?>" style="display:inline;">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="id" value="<?= $b['id'] ?>">
                                    <input type="hidden" name="status" value="completed">
                                    <button type="submit" class="btn-complete"><i class="fa-solid fa-flag-checkered me-1"></i>Complete</button>
                                </form>
                                <form method="POST" action="<?= base_url('admin/bookings/update-status') ?>" style="display:inline;">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="id" value="<?= $b['id'] ?>">
                                    <input type="hidden" name="status" value="cancelled">
                                    <button type="submit" class="btn-cancel"><i class="fa-solid fa-xmark me-1"></i>Cancel</button>
                                </form>
                            <?php else: ?>
                                <span style="font-size:0.75rem;color:rgba(255,255,255,0.3);font-style:italic;">—</span>
                            <?php endif; ?>

                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="7"><div class="empty-state"><i class="fa-solid fa-calendar-xmark"></i><p>No bookings found.</p></div></td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>

<!-- ════ BOOKING DETAIL MODAL ════ -->
<div id="detailOverlay" onclick="if(event.target===this) closeDetail()">
    <div class="detail-modal" id="detailModal">
        <button class="dm-close" onclick="closeDetail()"><i class="fa-solid fa-xmark"></i></button>

        <div class="dm-title" id="dm-title">Booking Details</div>
        <div class="dm-sub" id="dm-sub">—</div>

        <!-- Booking Info -->
        <div class="dm-section"><i class="fa-solid fa-circle-info"></i> Booking Information</div>
        <div class="dm-info-grid">
            <div class="dm-info-item">
                <div class="dm-info-label">Guest</div>
                <div class="dm-info-value" id="dm-guest">—</div>
            </div>
            <div class="dm-info-item">
                <div class="dm-info-label">Booking Status</div>
                <div class="dm-info-value" id="dm-status">—</div>
            </div>
            <div class="dm-info-item">
                <div class="dm-info-label">Activity Date</div>
                <div class="dm-info-value" id="dm-date">—</div>
            </div>
            <div class="dm-info-item">
                <div class="dm-info-label">Time Slot</div>
                <div class="dm-info-value" id="dm-time">—</div>
            </div>
            <div class="dm-info-item">
                <div class="dm-info-label">Contact Number</div>
                <div class="dm-info-value" id="dm-contact">—</div>
            </div>
            <div class="dm-info-item">
                <div class="dm-info-label">Booked On</div>
                <div class="dm-info-value" id="dm-booked-on">—</div>
            </div>
        </div>
        <div class="dm-info-item" id="dm-special-wrap" style="margin-top:10px;display:none;">
            <div class="dm-info-label">Special Requests</div>
            <div class="dm-info-value" id="dm-special" style="font-style:italic;opacity:0.8;"></div>
        </div>

        <!-- Cost Summary -->
        <div class="dm-section"><i class="fa-solid fa-receipt"></i> Cost Summary</div>
        <div class="dm-cost-table">
            <div class="dm-cost-header"><i class="fa-solid fa-calculator me-1"></i> Activity Breakdown</div>
            <div id="dm-cost-rows"></div>
            <div class="dm-cost-total">
                <span><i class="fa-solid fa-equals me-1"></i> Total Amount</span>
                <span class="dm-cost-total-amt" id="dm-total">—</span>
            </div>
        </div>

        <!-- GCash Receipt -->
        <div class="dm-section"><i class="fa-brands fa-google-pay"></i> GCash Payment Receipt</div>
        <div class="dm-receipt-box" id="dm-receipt-box"></div>

        <!-- Payment Actions -->
        <div class="dm-section"><i class="fa-solid fa-credit-card"></i> Payment Actions</div>
        <div id="dm-pay-actions"></div>

    </div>
</div>

<!-- Receipt lightbox -->
<div id="lightbox" onclick="this.classList.remove('open')">
    <img id="lightbox-img" src="" alt="Receipt">
</div>

<!-- Help Modal -->
<div class="help-overlay" id="helpOverlay" onclick="if(event.target===this) this.classList.remove('open')">
    <div class="help-modal">
        <button class="help-close" onclick="document.getElementById('helpOverlay').classList.remove('open')">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <div class="help-modal-title"><i class="fa-solid fa-circle-question me-2" style="color:var(--accent-cyan)"></i>Admin Help Guide</div>
        <div class="help-modal-sub">Everything you need to manage the Waves platform.</div>
        <div class="help-section">
            <div class="help-section-title">📋 Main</div>
            <div class="help-item"><div class="help-item-icon"><i class="fa-solid fa-chart-line"></i></div><div><div class="help-item-title">Dashboard</div><div class="help-item-desc">Overview of total bookings, revenue, and platform activity at a glance.</div></div></div>
            <div class="help-item"><div class="help-item-icon"><i class="fa-solid fa-calendar-check"></i></div><div><div class="help-item-title">Bookings</div><div class="help-item-desc">View all reservations. Click <strong>View</strong> to inspect GCash receipts and verify or reject payments before approving a booking.</div></div></div>
            <div class="help-item"><div class="help-item-icon"><i class="fa-solid fa-users"></i></div><div><div class="help-item-title">Users</div><div class="help-item-desc">Browse all registered accounts, check booking counts, and identify roles.</div></div></div>
        </div>
        <div class="help-section">
            <div class="help-section-title">⚙️ Operations</div>
            <div class="help-item"><div class="help-item-icon"><i class="fa-solid fa-tower-broadcast"></i></div><div><div class="help-item-title">Sea Conditions</div><div class="help-item-desc">Post live sea condition updates visible to customers before booking.</div></div></div>
            <div class="help-item"><div class="help-item-icon"><i class="fa-solid fa-star"></i></div><div><div class="help-item-title">Reviews</div><div class="help-item-desc">Monitor guest feedback. Remove inappropriate reviews using the delete button.</div></div></div>
        </div>
        <div class="help-section">
            <div class="help-section-title">🛠 System</div>
            <div class="help-item"><div class="help-item-icon"><i class="fa-solid fa-person-swimming"></i></div><div><div class="help-item-title">Activities</div><div class="help-item-desc">Add, edit, or remove water activities and manage their pricing.</div></div></div>
            <div class="help-item"><div class="help-item-icon"><i class="fa-solid fa-peso-sign"></i></div><div><div class="help-item-title">Sales</div><div class="help-item-desc">Track revenue reports and monitor payment trends over time.</div></div></div>
        </div>
        <div class="help-tip"><strong>💡 Tip:</strong> Always click <strong>View</strong> on a booking and inspect the GCash receipt before marking it as Paid or approving the booking.</div>
    </div>
</div>

<script>
let currentFilter = 'all';

function setFilter(status, btn) {
    currentFilter = status;
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    filterTable();
}
function filterTable() {
    const search = document.getElementById('searchInput').value.toLowerCase();
    document.querySelectorAll('#tableBody tr[data-status]').forEach(row => {
        const matchStatus = currentFilter === 'all' || row.dataset.status === currentFilter;
        const matchSearch = !search || row.dataset.search.includes(search);
        row.style.display = (matchStatus && matchSearch) ? '' : 'none';
    });
}

const iconMap = {
    'jet ski':       'fa-water',
    'banana boat':   'fa-ship',
    'kayaking':      'fa-sailboat',
    'flying saucer': 'fa-circle-radiation',
};
function actIcon(name) {
    return iconMap[name.trim().toLowerCase()] || 'fa-person-swimming';
}

function fmtDate(str) {
    if (!str) return '—';
    const d = new Date(str);
    return d.toLocaleDateString('en-PH', { weekday:'short', year:'numeric', month:'short', day:'numeric' });
}
function fmtTime(str) {
    if (!str) return '—';
    const d = new Date('1970-01-01T' + str);
    const from = d.toLocaleTimeString('en-PH', { hour:'2-digit', minute:'2-digit' });
    d.setHours(d.getHours() + 1);
    const to = d.toLocaleTimeString('en-PH', { hour:'2-digit', minute:'2-digit' });
    return from + ' – ' + to;
}
function fmtMoney(n) {
    return '₱' + parseFloat(n || 0).toLocaleString('en-PH', { minimumFractionDigits:2 });
}
function fmtDateTime(str) {
    if (!str) return '—';
    return new Date(str).toLocaleString('en-PH', { month:'short', day:'numeric', year:'numeric', hour:'2-digit', minute:'2-digit' });
}

/* Receipt base URL */
const RECEIPT_BASE_URL = '<?= base_url('uploads/receipts/') ?>';

function openDetail(b) {

    /* Header */
    const acts = b.all_activities || b.activity_name || '—';
    document.getElementById('dm-title').textContent = acts;
    document.getElementById('dm-sub').textContent   = 'Booking Code: ' + (b.booking_code || b.id);

    /* Booking info */
    document.getElementById('dm-guest').textContent     = b.username || 'Guest';
    document.getElementById('dm-date').textContent      = fmtDate(b.date);
    document.getElementById('dm-time').textContent      = fmtTime(b.time);
    document.getElementById('dm-contact').textContent   = b.contact_number || '—';
    document.getElementById('dm-booked-on').textContent = fmtDateTime(b.created_at);

    /* Status badge */
    const sc = { pending:'#ffc107', confirmed:'#5ddb8a', completed:'#48cae4', cancelled:'#ff9999' };
    const st = (b.status || '').toLowerCase();
    document.getElementById('dm-status').innerHTML =
        `<span style="color:${sc[st]||'white'};font-weight:700;">${b.status ? b.status.charAt(0).toUpperCase()+b.status.slice(1) : '—'}</span>`;

    /* Special requests */
    const spWrap = document.getElementById('dm-special-wrap');
    if (b.special_requests && b.special_requests.trim()) {
        document.getElementById('dm-special').textContent = b.special_requests;
        spWrap.style.display = '';
    } else {
        spWrap.style.display = 'none';
    }

    /* Cost summary */
    const actNames = (b.all_activities || b.activity_name || '')
                     .split(',').map(s => s.trim()).filter(Boolean);
    let ppaMap = {};
    try { ppaMap = JSON.parse(b.participants_per_activity || '{}'); } catch(e) {}
    if (!Object.keys(ppaMap).length) {
        const total = parseInt(b.participants) || 1;
        const per   = Math.floor(total / Math.max(actNames.length, 1));
        const rem   = total % Math.max(actNames.length, 1);
        actNames.forEach((a, i) => { ppaMap[a] = per + (i === 0 ? rem : 0); });
    }

    const lineItems = b._line_items || {};
    let costRows = '';
    let computedTotal = 0;
    actNames.forEach(an => {
        const line = lineItems[an] || {};
        const icon = actIcon(an);
        const pax  = ppaMap[an] || 0;
        const lineT = parseFloat(line.line_total || 0);
        computedTotal += lineT;
        let formula = '';
        if (line.price_type === 'per_person' && line.price > 0) {
            formula = `<span class="dm-cost-formula">₱${Number(line.price).toLocaleString()} &times; ${pax} person${pax!==1?'s':''}</span>`;
        } else if (line.price > 0) {
            formula = `<span class="dm-cost-formula">flat rate &middot; ${pax} person${pax!==1?'s':''}</span>`;
        }
        costRows += `
            <div class="dm-cost-row">
                <div class="dm-cost-act">
                    <i class="fa-solid ${icon}"></i>
                    ${an} ${formula}
                </div>
                <div class="dm-cost-amt">${fmtMoney(lineT)}</div>
            </div>`;
    });
    document.getElementById('dm-cost-rows').innerHTML = costRows || '<div class="dm-cost-row" style="color:rgba(255,255,255,0.4);">No breakdown available</div>';
    document.getElementById('dm-total').textContent = fmtMoney(b.total_amount || computedTotal);

    /* ── GCash Receipt ── */
    const receiptBox = document.getElementById('dm-receipt-box');

    /*
     * FIX: receipt can come from:
     *  1. b.gcash_receipt  — stored directly in bookings table
     *  2. b.latest_payment.gcash_receipt — stored in payment_history (merged by controller)
     * The controller already merges #2 into b.gcash_receipt, so we only need to check b.gcash_receipt.
     * But we also read b.latest_payment as a fallback for the ref/date fields.
     */
    const receiptFilename = b.gcash_receipt
        ? b.gcash_receipt.split('/').pop().split('\\').pop()
        : (b.latest_payment && b.latest_payment.gcash_receipt
            ? b.latest_payment.gcash_receipt.split('/').pop().split('\\').pop()
            : null);

    if (receiptFilename) {
        const imgUrl = RECEIPT_BASE_URL + receiptFilename;
        // Prefer gcash_ref from booking, fallback to payment_history
        const gcashRef = b.gcash_ref || (b.latest_payment && b.latest_payment.gcash_ref) || null;
        const submittedAt = b.gcash_submitted_at
            || (b.latest_payment && (b.latest_payment.created_at || b.latest_payment.gcash_submitted_at))
            || b.updated_at;

        const isVerified = b.latest_payment && b.latest_payment.is_verified == 1;
        const verifiedNote = isVerified
            ? `<div style="margin-top:8px;font-size:0.75rem;color:#5ddb8a;"><i class="fa-solid fa-circle-check me-1"></i>Receipt verified by admin</div>`
            : `<div class="dm-receipt-pending-note"><i class="fa-solid fa-clock"></i> This receipt is awaiting admin verification.</div>`;

        receiptBox.innerHTML = `
            <img src="${imgUrl}"
                 class="dm-receipt-img"
                 alt="GCash Receipt"
                 onclick="openLightbox('${imgUrl}')"
                 onerror="this.parentElement.innerHTML='<div class=\'dm-no-receipt\'><i class=\'fa-solid fa-triangle-exclamation\'></i> Image could not be loaded. Check that the file exists in <code>public/uploads/receipts/</code>.</div>'">
            <div class="dm-receipt-meta">
                <div class="dm-ref">GCash Ref: <span>${gcashRef || '—'}</span></div>
                <div class="dm-ref">Submitted: <span>${fmtDateTime(submittedAt)}</span></div>
            </div>
            ${verifiedNote}`;
    } else {
        receiptBox.innerHTML = `<div class="dm-no-receipt"><i class="fa-solid fa-image"></i>No receipt uploaded yet.</div>`;
    }

    /* Payment actions */
    const actionsEl  = document.getElementById('dm-pay-actions');
    const payStatus  = (b.payment_status || '').toLowerCase();
    const downStatus = (b.down_payment_status || '').toLowerCase();
    const csrfToken  = '<?= csrf_hash() ?>';
    const csrfName   = '<?= csrf_token() ?>';
    // ── FIX: point to the new updatePayment endpoint ──
    const payUrl     = '<?= base_url('admin/bookings/update-payment') ?>';

    if (payStatus === 'paid') {
        actionsEl.innerHTML = `
            <div class="already-paid-note">
                <i class="fa-solid fa-circle-check"></i>
                This booking has been fully paid. No further payment action needed.
            </div>`;
    } else {
        let btns = '<div class="dm-pay-actions">';

        if (downStatus !== 'paid') {
            btns += `
                <form method="POST" action="${payUrl}" style="display:inline;">
                    <input type="hidden" name="${csrfName}" value="${csrfToken}">
                    <input type="hidden" name="booking_id"     value="${b.id}">
                    <input type="hidden" name="payment_action" value="down_paid">
                    <button type="submit" class="btn-mark-down"
                        onclick="return confirm('Mark 50% down payment as confirmed for this booking?')">
                        <i class="fa-solid fa-circle-half-stroke"></i> Mark 50% Down Paid
                    </button>
                </form>`;
        }

        btns += `
            <form method="POST" action="${payUrl}" style="display:inline;">
                <input type="hidden" name="${csrfName}" value="${csrfToken}">
                <input type="hidden" name="booking_id"     value="${b.id}">
                <input type="hidden" name="payment_action" value="full_paid">
                <button type="submit" class="btn-mark-paid"
                    onclick="return confirm('Mark this booking as fully paid?')">
                    <i class="fa-solid fa-check-circle"></i> Mark as Fully Paid
                </button>
            </form>`;

        if (receiptFilename) {
            btns += `
                <form method="POST" action="${payUrl}" style="display:inline;">
                    <input type="hidden" name="${csrfName}" value="${csrfToken}">
                    <input type="hidden" name="booking_id"     value="${b.id}">
                    <input type="hidden" name="payment_action" value="reject_receipt">
                    <button type="submit" class="btn-reject-pay"
                        onclick="return confirm('Reject this receipt? The user will need to re-upload.')">
                        <i class="fa-solid fa-xmark"></i> Reject Receipt
                    </button>
                </form>`;
        }

        btns += '</div>';
        actionsEl.innerHTML = btns;
    }

    document.getElementById('detailOverlay').classList.add('open');
    document.body.style.overflow = 'hidden';
}

function closeDetail() {
    document.getElementById('detailOverlay').classList.remove('open');
    document.body.style.overflow = '';
}

function openLightbox(url) {
    document.getElementById('lightbox-img').src = url;
    document.getElementById('lightbox').classList.add('open');
}

document.addEventListener('keydown', e => {
    if (e.key === 'Escape') {
        closeDetail();
        document.getElementById('lightbox').classList.remove('open');
        document.getElementById('helpOverlay').classList.remove('open');
    }
});
</script>

<?php
/* Pre-compute line items server-side and inject into each booking row */
$db = \Config\Database::connect();

if (!empty($bookings)):
    foreach ($bookings as &$b):
        $actNames = array_values(array_filter(array_map('trim', explode(',', $b['all_activities'] ?? $b['activity_name'] ?? ''))));
        $ppaMap   = [];
        if (!empty($b['participants_per_activity'])) {
            $dec = json_decode($b['participants_per_activity'], true);
            if (is_array($dec)) $ppaMap = $dec;
        }
        if (empty($ppaMap)) {
            $tot = (int)($b['participants'] ?? 1);
            $per = (int)floor($tot / max(count($actNames), 1));
            $rem = $tot % max(count($actNames), 1);
            foreach ($actNames as $idx => $an) { $ppaMap[$an] = $per + ($idx === 0 ? $rem : 0); }
        }
        $lineItems = [];
        foreach ($actNames as $an) {
            $an    = trim($an);
            $pax   = (int)($ppaMap[$an] ?? 0);
            $row   = $db->table('activities')->where('name', $an)->get()->getRowArray();
            $price = $row ? (float)$row['price'] : 0;
            $type  = $row ? ($row['price_type'] ?? 'flat') : 'flat';
            $lineT = ($type === 'per_person') ? $price * $pax : $price;
            $lineItems[$an] = ['price' => $price, 'price_type' => $type, 'pax' => $pax, 'line_total' => $lineT];
        }
        $b['_line_items'] = $lineItems;
    endforeach;
    unset($b);
endif;
?>
<script>
/* Patch each View button with the enriched booking data (includes _line_items + merged receipt) */
(function() {
    const enriched = <?= json_encode(array_values($bookings ?? [])) ?>;
    document.querySelectorAll('#tableBody tr[data-status]').forEach((tr, i) => {
        const btn = tr.querySelector('.btn-view-booking');
        if (btn && enriched[i]) {
            btn.onclick = () => openDetail(enriched[i]);
        }
    });
})();
</script>

</body>
</html>