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

        /* ── Auto-cancel notice banner ── */
        .auto-cancel-banner { display: none; background: rgba(255,193,7,0.1); border: 1px solid rgba(255,193,7,0.35); border-radius: 14px; padding: 12px 18px; margin-bottom: 18px; font-size: 0.82rem; color: #ffc107; align-items: center; gap: 10px; }
        .auto-cancel-banner.show { display: flex; }
        .auto-cancel-banner i { font-size: 1rem; flex-shrink: 0; }

        /* ── Table ── */
        .table-container { background: rgba(255,255,255,0.07); backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.1); border-radius: 24px; padding: 10px; overflow-x: auto; }
        .custom-table { width: 100%; color: white; border-collapse: separate; border-spacing: 0 8px; min-width: 960px; }
        .custom-table thead th { border: none; text-transform: uppercase; font-size: 0.7rem; letter-spacing: 1.5px; opacity: 0.5; padding: 8px 16px; font-weight: 600; }
        .custom-table tbody tr { background: rgba(255,255,255,0.04); transition: 0.25s; }
        .custom-table tbody tr:hover { background: rgba(255,255,255,0.09); transform: scale(1.003); }
        .custom-table tbody tr.row-expired { background: rgba(220,53,69,0.06); opacity: 0.7; }
        .custom-table td { padding: 14px 16px; vertical-align: middle; border: none; font-size: 0.85rem; }
        .custom-table td:first-child { border-radius: 14px 0 0 14px; }
        .custom-table td:last-child { border-radius: 0 14px 14px 0; }

        /* ── Badges ── */
        .badge-status { padding: 5px 14px; border-radius: 50px; font-size: 0.72rem; font-weight: 700; white-space: nowrap; display: inline-flex; align-items: center; gap: 5px; }
        .s-pending   { background: rgba(255,193,7,0.12);  color: #ffc107; border: 1px solid rgba(255,193,7,0.4); }
        .s-confirmed { background: rgba(40,167,69,0.12);  color: #5ddb8a; border: 1px solid rgba(40,167,69,0.4); }
        .s-completed { background: rgba(72,202,228,0.12); color: #48cae4; border: 1px solid rgba(72,202,228,0.4); }
        .s-cancelled { background: rgba(220,53,69,0.12);  color: #ff8888; border: 1px solid rgba(220,53,69,0.4); }
        .pay-paid    { background: rgba(40,167,69,0.14);  color: #5ddb8a; border: 1px solid rgba(40,167,69,0.4);  padding: 4px 12px; border-radius: 50px; font-size: 0.7rem; font-weight: 700; display: inline-flex; align-items: center; gap: 4px; }
        .pay-half    { background: rgba(255,193,7,0.12);  color: #ffc107; border: 1px solid rgba(255,193,7,0.4);  padding: 4px 12px; border-radius: 50px; font-size: 0.7rem; font-weight: 700; display: inline-flex; align-items: center; gap: 4px; }
        .pay-pending { background: rgba(255,255,255,0.06);color: rgba(255,255,255,0.45); border: 1px solid rgba(255,255,255,0.14); padding: 4px 12px; border-radius: 50px; font-size: 0.7rem; font-weight: 700; display: inline-flex; align-items: center; gap: 4px; }
        .pay-receipt { background: rgba(72,202,228,0.1);  color: #48cae4; border: 1px solid rgba(72,202,228,0.35); padding: 4px 12px; border-radius: 50px; font-size: 0.7rem; font-weight: 700; display: inline-flex; align-items: center; gap: 4px; }

        /* ── Action buttons ── */
        .btn-approve  { background: rgba(40,167,69,0.15);  color: #5ddb8a; border: 1px solid rgba(40,167,69,0.3);  border-radius: 8px; padding: 5px 12px; font-size: 0.75rem; font-weight: 600; cursor: pointer; transition: 0.2s; }
        .btn-approve:hover  { background: #5ddb8a; color: var(--deep-blue); }
        .btn-cancel   { background: rgba(220,53,69,0.12);  color: #ff8888; border: 1px solid rgba(220,53,69,0.3);  border-radius: 8px; padding: 5px 12px; font-size: 0.75rem; font-weight: 600; cursor: pointer; transition: 0.2s; }
        .btn-cancel:hover   { background: #dc3545; color: white; }
        .btn-complete { background: rgba(72,202,228,0.12); color: #48cae4; border: 1px solid rgba(72,202,228,0.3); border-radius: 8px; padding: 5px 12px; font-size: 0.75rem; font-weight: 600; cursor: pointer; transition: 0.2s; }
        .btn-complete:hover { background: var(--accent-cyan); color: var(--deep-blue); }
        .btn-view-booking { background: rgba(72,202,228,0.1); color: #48cae4; border: 1px solid rgba(72,202,228,0.3); border-radius: 8px; padding: 5px 12px; font-size: 0.75rem; font-weight: 600; cursor: pointer; transition: 0.2s; }
        .btn-view-booking:hover { background: var(--accent-cyan); color: var(--deep-blue); }

        /* ── Time slots in table cell ── */
        .time-slot-single { font-size: 0.75rem; color: var(--accent-cyan); margin-top: 2px; }
        .time-slot-multi  { margin-top: 3px; }
        .time-slot-multi-row { display: flex; align-items: center; gap: 5px; font-size: 0.7rem; line-height: 1.7; color: rgba(255,255,255,0.55); }
        .time-slot-multi-row i { color: var(--accent-cyan); font-size: 0.65rem; width: 12px; flex-shrink: 0; }
        .time-slot-multi-row .tsm-name { min-width: 80px; }
        .time-slot-multi-row .tsm-val  { color: var(--accent-cyan); font-weight: 700; }

        .empty-state { text-align: center; padding: 50px 20px; opacity: 0.5; }
        .empty-state i { font-size: 2.5rem; margin-bottom: 12px; display: block; }
        @keyframes wave-motion { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-3px)} }
        .brand-icon i { animation: wave-motion 3s ease-in-out infinite; display: inline-block; }

        /* ════════════════════════════════════════
           CANCEL REASON MODAL
        ════════════════════════════════════════ */
        #cancelReasonOverlay { display: none; position: fixed; inset: 0; background: rgba(5,44,57,0.92); backdrop-filter: blur(10px); z-index: 10000; align-items: center; justify-content: center; padding: 20px; }
        #cancelReasonOverlay.open { display: flex; }
        .cancel-modal { background: linear-gradient(145deg, #0b3f55, #052c39); border: 1px solid rgba(220,53,69,0.35); border-radius: 24px; padding: 32px; max-width: 480px; width: 100%; box-shadow: 0 40px 80px rgba(0,0,0,0.6); animation: slideUp 0.25s ease; }
        .cancel-modal-title { font-size: 1.1rem; font-weight: 700; color: #ff8888; margin-bottom: 4px; display: flex; align-items: center; gap: 10px; }
        .cancel-modal-sub { font-size: 0.78rem; color: rgba(255,255,255,0.4); margin-bottom: 22px; }
        .cancel-reason-label { font-size: 0.65rem; text-transform: uppercase; letter-spacing: 1.5px; font-weight: 700; color: rgba(255,255,255,0.5); margin-bottom: 10px; }
        .cancel-reason-options { display: flex; flex-direction: column; gap: 8px; margin-bottom: 20px; }
        .cancel-reason-option { display: flex; align-items: flex-start; gap: 12px; background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.1); border-radius: 12px; padding: 12px 14px; cursor: pointer; transition: 0.2s; }
        .cancel-reason-option:hover { background: rgba(220,53,69,0.08); border-color: rgba(220,53,69,0.3); }
        .cancel-reason-option.selected { background: rgba(220,53,69,0.12); border-color: rgba(220,53,69,0.5); }
        .cancel-reason-option input[type="radio"] { margin-top: 2px; accent-color: #ff6b6b; flex-shrink: 0; }
        .cancel-reason-option .cr-text { font-size: 0.85rem; color: rgba(255,255,255,0.8); font-weight: 500; line-height: 1.4; }
        .cancel-reason-option .cr-sub { font-size: 0.72rem; color: rgba(255,255,255,0.4); margin-top: 2px; }
        .cancel-custom-wrap { margin-bottom: 20px; display: none; }
        .cancel-custom-input { width: 100%; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.15); border-radius: 10px; color: white; padding: 10px 14px; font-size: 0.83rem; font-family: 'Poppins', sans-serif; outline: none; resize: none; }
        .cancel-custom-input::placeholder { color: rgba(255,255,255,0.3); }
        .cancel-custom-input:focus { border-color: #ff8888; }
        .cancel-modal-actions { display: flex; gap: 10px; justify-content: flex-end; }
        .btn-cancel-confirm { background: rgba(220,53,69,0.2); color: #ff8888; border: 1px solid rgba(220,53,69,0.4); border-radius: 10px; padding: 10px 24px; font-size: 0.85rem; font-weight: 700; cursor: pointer; transition: 0.2s; font-family: 'Poppins', sans-serif; }
        .btn-cancel-confirm:hover { background: #dc3545; color: white; }
        .btn-cancel-dismiss { background: rgba(255,255,255,0.06); color: rgba(255,255,255,0.6); border: 1px solid rgba(255,255,255,0.15); border-radius: 10px; padding: 10px 20px; font-size: 0.85rem; font-weight: 600; cursor: pointer; transition: 0.2s; font-family: 'Poppins', sans-serif; }
        .btn-cancel-dismiss:hover { background: rgba(255,255,255,0.12); color: white; }

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
        .dm-info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 4px; }
        .dm-info-item { background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.08); border-radius: 12px; padding: 12px 16px; }
        .dm-info-label { font-size: 0.65rem; text-transform: uppercase; letter-spacing: 1px; color: rgba(255,255,255,0.4); font-weight: 700; margin-bottom: 4px; }
        .dm-info-value { font-size: 0.88rem; font-weight: 600; color: white; }
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
        .dm-time-block { background: rgba(72,202,228,0.05); border: 1px solid rgba(72,202,228,0.15); border-radius: 12px; padding: 12px 16px; }
        .dm-time-row { display: flex; align-items: center; gap: 10px; font-size: 0.82rem; margin-bottom: 6px; }
        .dm-time-row:last-child { margin-bottom: 0; }
        .dm-time-row i { color: var(--accent-cyan); font-size: 0.75rem; width: 14px; flex-shrink: 0; }
        .dm-time-row .dtr-name { color: rgba(255,255,255,0.55); font-weight: 600; min-width: 110px; flex-shrink: 0; }
        .dm-time-row .dtr-val  { color: white; font-weight: 700; }
        .dm-receipt-box { background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.1); border-radius: 14px; padding: 16px; margin-bottom: 4px; }
        .dm-receipt-img { width: 100%; max-height: 320px; object-fit: contain; border-radius: 10px; background: rgba(0,0,0,0.3); display: block; cursor: zoom-in; transition: 0.2s; }
        .dm-receipt-img:hover { transform: scale(1.01); }
        .dm-receipt-meta { display: flex; justify-content: space-between; align-items: center; margin-top: 10px; flex-wrap: wrap; gap: 8px; }
        .dm-ref { font-size: 0.78rem; color: rgba(255,255,255,0.5); }
        .dm-ref span { color: white; font-weight: 600; }
        .dm-no-receipt { text-align: center; padding: 28px; color: rgba(255,255,255,0.3); font-size: 0.82rem; }
        .dm-no-receipt i { font-size: 2rem; display: block; margin-bottom: 8px; opacity: 0.4; }
        .dm-receipt-pending-note { background: rgba(255,193,7,0.08); border: 1px solid rgba(255,193,7,0.3); border-radius: 10px; padding: 10px 14px; margin-top: 10px; font-size: 0.78rem; color: #ffc107; display: flex; align-items: center; gap: 8px; }
        .dm-pay-actions { display: flex; gap: 10px; flex-wrap: wrap; margin-top: 6px; }
        .btn-mark-down { background: rgba(255,193,7,0.14); color: #ffc107; border: 1px solid rgba(255,193,7,0.4); border-radius: 10px; padding: 9px 20px; font-size: 0.82rem; font-weight: 700; cursor: pointer; transition: 0.2s; display: inline-flex; align-items: center; gap: 7px; font-family: 'Poppins', sans-serif; }
        .btn-mark-down:hover { background: rgba(255,193,7,0.3); transform: translateY(-1px); }
        .btn-mark-paid { background: rgba(40,167,69,0.14); color: #5ddb8a; border: 1px solid rgba(40,167,69,0.4); border-radius: 10px; padding: 9px 20px; font-size: 0.82rem; font-weight: 700; cursor: pointer; transition: 0.2s; display: inline-flex; align-items: center; gap: 7px; font-family: 'Poppins', sans-serif; }
        .btn-mark-paid:hover { background: rgba(40,167,69,0.3); transform: translateY(-1px); }
        .btn-reject-pay { background: rgba(220,53,69,0.1); color: #ff9999; border: 1px solid rgba(220,53,69,0.3); border-radius: 10px; padding: 9px 20px; font-size: 0.82rem; font-weight: 700; cursor: pointer; transition: 0.2s; display: inline-flex; align-items: center; gap: 7px; font-family: 'Poppins', sans-serif; }
        .btn-reject-pay:hover { background: rgba(220,53,69,0.25); transform: translateY(-1px); }
        .already-paid-note { background: rgba(40,167,69,0.1); border: 1px solid rgba(40,167,69,0.3); border-radius: 10px; padding: 12px 16px; font-size: 0.82rem; color: #5ddb8a; display: flex; align-items: center; gap: 8px; }

        /* ── Receipt lightbox ── */
        #lightbox { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.92); z-index: 99999; align-items: center; justify-content: center; cursor: zoom-out; }
        #lightbox.open { display: flex; }
        #lightbox img { max-width: 90vw; max-height: 90vh; border-radius: 12px; object-fit: contain; box-shadow: 0 0 60px rgba(0,0,0,0.8); }

        /* ── Help modal ── */
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

    <!-- Auto-cancel notice (populated by JS after AJAX) -->
    <div class="auto-cancel-banner" id="autoCancelBanner">
        <i class="fa-solid fa-circle-exclamation"></i>
        <span id="autoCancelMsg"></span>
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
                <?php
                $db = \Config\Database::connect();
                $today = date('Y-m-d');

                function adminBuildTpaMap(array $b, array $actNames, $db): array {
                    $tpaMap = [];
                    if (!empty($b['time_per_activity'])) {
                        $dec = json_decode($b['time_per_activity'], true);
                        if (is_array($dec)) $tpaMap = $dec;
                    }
                    if (empty($tpaMap)) {
                        $cursor = strtotime('1970-01-01 ' . ($b['time'] ?? '08:00:00'));
                        foreach ($actNames as $an) {
                            $an = trim($an);
                            $tpaMap[$an] = date('H:i:s', $cursor);
                            $tRow = $db->table('activities')->where('name', $an)->get()->getRowArray();
                            $dur  = $tRow ? (int)($tRow['duration'] ?? 60) : 60;
                            $cursor += $dur * 60;
                        }
                    }
                    return $tpaMap;
                }

                function adminFmtSlot(string $timeStr, int $durationMins = 60): string {
                    $ts  = strtotime('1970-01-01 ' . $timeStr);
                    $end = $ts + ($durationMins * 60);
                    return date('g:i A', $ts) . ' – ' . date('g:i A', $end);
                }
                ?>

                <?php foreach ($bookings as $b):
                    $statusRaw = strtolower($b['status']);
                    $sc = match($statusRaw) {
                        'pending'              => 's-pending',
                        'confirmed','approved' => 's-confirmed',
                        'completed'            => 's-completed',
                        'cancelled'            => 's-cancelled',
                        default                => 's-pending',
                    };
                    $initials = strtoupper(substr($b['username'] ?? 'G', 0, 2));

                    /* ── Expired check: date passed + no payment ── */
                    $isExpired = in_array($statusRaw, ['pending','confirmed'])
                        && ($b['date'] ?? '') < $today
                        && ($b['payment_status'] ?? '') !== 'paid'
                        && ($b['down_payment_status'] ?? '') !== 'paid';

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

                    $receiptPendingVerify = $hasReceipt
                        && ($b['payment_status'] ?? '') !== 'paid'
                        && ($b['down_payment_status'] ?? '') !== 'paid';

                    /* ── Build activity list & time map for table row ── */
                    $rowActNames = array_values(array_filter(
                        array_map('trim', explode(',', $b['all_activities'] ?? $b['activity_name'] ?? ''))
                    ));
                    if (empty($rowActNames)) $rowActNames = [trim($b['activity_name'] ?? '—')];

                    $rowTpaMap = adminBuildTpaMap($b, $rowActNames, $db);

                    $iconMapPHP = [
                        'jet ski'       => 'fa-water',
                        'banana boat'   => 'fa-ship',
                        'kayaking'      => 'fa-sailboat',
                        'flying saucer' => 'fa-circle-radiation',
                    ];
                ?>
                <tr data-status="<?= $statusRaw ?>"
                    data-search="<?= strtolower(($b['username'] ?? '') . ' ' . ($b['booking_code'] ?? '')) ?>"
                    class="<?= $isExpired ? 'row-expired' : '' ?>">

                    <!-- Guest -->
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div style="width:34px;height:34px;border-radius:50%;background:rgba(72,202,228,0.15);display:flex;align-items:center;justify-content:center;font-size:0.7rem;font-weight:700;color:var(--accent-cyan);flex-shrink:0;">
                                <?= $initials ?>
                            </div>
                            <div>
                                <div style="font-weight:600;"><?= esc($b['username'] ?? 'Guest') ?></div>
                                <div style="font-size:0.72rem;color:rgba(255,255,255,0.4);">#<?= esc($b['booking_code'] ?? $b['id']) ?></div>
                                <?php if ($isExpired): ?>
                                <div style="font-size:0.65rem;color:#ff8888;margin-top:2px;"><i class="fa-solid fa-triangle-exclamation me-1"></i>Expired — no payment</div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </td>

                    <!-- Activity -->
                    <td style="max-width:180px;">
                        <div style="font-weight:600;font-size:0.82rem;line-height:1.4;">
                            <?= esc($b['all_activities'] ?? $b['activity_name'] ?? '—') ?>
                        </div>
                    </td>

                    <!-- Date & Time — per-activity staggered slots -->
                    <td>
                        <div style="font-weight:600;"><?= date('M d, Y', strtotime($b['date'])) ?></div>
                    </td>

                    <!-- Pax -->
                    <td><?= esc($b['participants'] ?? 1) ?></td>

                    <!-- Status -->
                    <td>
                        <span class="badge-status <?= $sc ?>"><?= ucfirst($b['status']) ?></span>
                        <?php if (!empty($b['cancel_reason'])): ?>
                        <div style="font-size:0.68rem;color:rgba(255,136,136,0.7);margin-top:4px;font-style:italic;max-width:160px;line-height:1.4;">
                            <i class="fa-solid fa-circle-info me-1"></i><?= esc($b['cancel_reason']) ?>
                        </div>
                        <?php endif; ?>
                    </td>

                    <!-- Payment -->
                    <td>
                        <?= $payBadge ?>
                        <?php if ($receiptPendingVerify): ?>
                            <div style="font-size:0.68rem;color:#ffc107;margin-top:3px;"><i class="fa-solid fa-circle-exclamation me-1"></i>Needs review</div>
                        <?php endif; ?>
                    </td>

                    <!-- Actions -->
                    <td class="text-center">
                        <div class="d-flex gap-1 justify-content-center flex-wrap">

                            <button class="btn-view-booking"
                                onclick="openDetail(<?= htmlspecialchars(json_encode($b), ENT_QUOTES) ?>)">
                                <i class="fa-solid fa-eye me-1"></i>View
                            </button>

                            <?php if ($statusRaw === 'pending'): ?>
                                <form method="POST" action="<?= base_url('admin/bookings/update-status') ?>" style="display:inline;">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="id" value="<?= $b['id'] ?>">
                                    <input type="hidden" name="status" value="confirmed">
                                    <button type="submit" class="btn-approve"><i class="fa-solid fa-check me-1"></i>Approve</button>
                                </form>
                                <!-- Cancel triggers modal instead of direct form submit -->
                                <button class="btn-cancel"
                                    onclick="openCancelModal(<?= $b['id'] ?>, '<?= esc(addslashes($b['username'] ?? 'Guest')) ?>')">
                                    <i class="fa-solid fa-xmark me-1"></i>Cancel
                                </button>

                            <?php elseif ($statusRaw === 'confirmed'): ?>
                                <form method="POST" action="<?= base_url('admin/bookings/update-status') ?>" style="display:inline;">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="id" value="<?= $b['id'] ?>">
                                    <input type="hidden" name="status" value="completed">
                                    <button type="submit" class="btn-complete"><i class="fa-solid fa-flag-checkered me-1"></i>Complete</button>
                                </form>
                                <button class="btn-cancel"
                                    onclick="openCancelModal(<?= $b['id'] ?>, '<?= esc(addslashes($b['username'] ?? 'Guest')) ?>')">
                                    <i class="fa-solid fa-xmark me-1"></i>Cancel
                                </button>

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

<!-- ════ CANCEL REASON MODAL ════ -->
<div id="cancelReasonOverlay" onclick="if(event.target===this) closeCancelModal()">
    <div class="cancel-modal">
        <div class="cancel-modal-title">
            <i class="fa-solid fa-ban"></i> Cancel Booking
        </div>
        <div class="cancel-modal-sub" id="cancel-modal-sub">Please select a reason for cancellation.</div>

        <div class="cancel-reason-label">Reason for Cancellation</div>
        <div class="cancel-reason-options" id="cancelReasonOptions">

            <label class="cancel-reason-option" onclick="selectReason(this)">
                <input type="radio" name="cancel_reason_radio" value="Guest requested cancellation">
                <div>
                    <div class="cr-text">Guest Requested</div>
                    <div class="cr-sub">The customer asked to cancel this booking</div>
                </div>
            </label>

            <label class="cancel-reason-option" onclick="selectReason(this)">
                <input type="radio" name="cancel_reason_radio" value="Unsafe sea conditions — activity cannot proceed safely">
                <div>
                    <div class="cr-text">Unsafe Sea Conditions</div>
                    <div class="cr-sub">Activity cannot proceed due to dangerous water conditions</div>
                </div>
            </label>

            <label class="cancel-reason-option" onclick="selectReason(this)">
                <input type="radio" name="cancel_reason_radio" value="No payment received within the required period">
                <div>
                    <div class="cr-text">No Payment Received</div>
                    <div class="cr-sub">Guest did not pay within the required timeframe</div>
                </div>
            </label>

            <label class="cancel-reason-option" onclick="selectReason(this)">
                <input type="radio" name="cancel_reason_radio" value="Equipment unavailable or under maintenance">
                <div>
                    <div class="cr-text">Equipment Unavailable</div>
                    <div class="cr-sub">Required equipment is not available or under maintenance</div>
                </div>
            </label>

            <label class="cancel-reason-option" onclick="selectReason(this)">
                <input type="radio" name="cancel_reason_radio" value="Duplicate booking — multiple reservations for same slot">
                <div>
                    <div class="cr-text">Duplicate Booking</div>
                    <div class="cr-sub">Multiple reservations were made for the same time slot</div>
                </div>
            </label>

            <label class="cancel-reason-option" onclick="selectReason(this, true)">
                <input type="radio" name="cancel_reason_radio" value="other">
                <div>
                    <div class="cr-text">Other Reason</div>
                    <div class="cr-sub">Specify a custom reason below</div>
                </div>
            </label>

        </div>

        <!-- Custom reason textarea (shown only when "Other" is selected) -->
        <div class="cancel-custom-wrap" id="cancelCustomWrap">
            <textarea class="cancel-custom-input" id="cancelCustomText"
                      rows="3" placeholder="Describe the reason for cancellation…"></textarea>
        </div>

        <div class="cancel-modal-actions">
            <button class="btn-cancel-dismiss" onclick="closeCancelModal()">
                <i class="fa-solid fa-arrow-left me-1"></i> Go Back
            </button>
            <button class="btn-cancel-confirm" id="cancelConfirmBtn" onclick="submitCancellation()" disabled>
                <i class="fa-solid fa-ban me-1"></i> Confirm Cancellation
            </button>
        </div>
    </div>
</div>

<!-- Hidden cancel form (submitted programmatically) -->
<form id="cancelForm" method="POST" action="<?= base_url('admin/bookings/update-status') ?>" style="display:none;">
    <?= csrf_field() ?>
    <input type="hidden" name="id"            id="cancel-booking-id" value="">
    <input type="hidden" name="status"        value="cancelled">
    <input type="hidden" name="cancel_reason" id="cancel-reason-value" value="">
</form>

<!-- ════ BOOKING DETAIL MODAL ════ -->
<div id="detailOverlay" onclick="if(event.target===this) closeDetail()">
    <div class="detail-modal" id="detailModal">
        <button class="dm-close" onclick="closeDetail()"><i class="fa-solid fa-xmark"></i></button>

        <div class="dm-title" id="dm-title">Booking Details</div>
        <div class="dm-sub" id="dm-sub">—</div>

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
                <div class="dm-info-label">Time Slot(s)</div>
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
        <!-- Cancel reason in modal (shown if cancelled) -->
        <div class="dm-info-item" id="dm-cancel-reason-wrap" style="margin-top:10px;display:none;">
            <div class="dm-info-label" style="color:#ff8888;"><i class="fa-solid fa-ban me-1"></i> Cancellation Reason</div>
            <div class="dm-info-value" id="dm-cancel-reason" style="color:#ff9999;font-style:italic;"></div>
        </div>

        <div class="dm-section"><i class="fa-solid fa-receipt"></i> Cost Summary</div>
        <div class="dm-cost-table">
            <div class="dm-cost-header"><i class="fa-solid fa-calculator me-1"></i> Activity Breakdown</div>
            <div id="dm-cost-rows"></div>
            <div class="dm-cost-total">
                <span><i class="fa-solid fa-equals me-1"></i> Total Amount</span>
                <span class="dm-cost-total-amt" id="dm-total">—</span>
            </div>
        </div>

        <div class="dm-section"><i class="fa-brands fa-google-pay"></i> GCash Payment Receipt</div>
        <div class="dm-receipt-box" id="dm-receipt-box"></div>

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
            <div class="help-item"><div class="help-item-icon"><i class="fa-solid fa-calendar-check"></i></div><div><div class="help-item-title">Bookings</div><div class="help-item-desc">View all reservations. Click <strong>View</strong> to inspect GCash receipts and verify or reject payments. Use the <strong>Cancel</strong> button to cancel with a reason.</div></div></div>
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
        <div class="help-tip"><strong>💡 Tip:</strong> Expired unpaid bookings are highlighted in red and auto-cancelled on page load. Always inspect the GCash receipt before marking a booking as Paid.</div>
    </div>
</div>

<script>
/* ─────────────────────────────────────
   Filter / search
───────────────────────────────────── */
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

/* ─────────────────────────────────────
   Auto-cancel expired unpaid bookings
   Called via AJAX on page load
───────────────────────────────────── */
(function autoCancelExpired() {
    fetch('<?= base_url('admin/bookings/auto-cancel-expired') ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            '<?= csrf_token() ?>': '<?= csrf_hash() ?>',
        },
        body: JSON.stringify({ '<?= csrf_token() ?>': '<?= csrf_hash() ?>' }),
    })
    .then(r => r.json())
    .then(data => {
        if (data.cancelled > 0) {
            const banner = document.getElementById('autoCancelBanner');
            document.getElementById('autoCancelMsg').textContent = data.message + ' Refresh the page to see updated statuses.';
            banner.classList.add('show');
        }
    })
    .catch(() => {});
})();

/* ─────────────────────────────────────
   Cancel reason modal
───────────────────────────────────── */
let _cancelBookingId = null;

function openCancelModal(bookingId, guestName) {
    _cancelBookingId = bookingId;
    document.getElementById('cancel-modal-sub').textContent =
        `You are cancelling booking #${bookingId} for ${guestName}. Please select a reason.`;
    // Reset previous state
    document.querySelectorAll('.cancel-reason-option').forEach(o => o.classList.remove('selected'));
    document.querySelectorAll('input[name="cancel_reason_radio"]').forEach(r => r.checked = false);
    document.getElementById('cancelCustomWrap').style.display = 'none';
    document.getElementById('cancelCustomText').value = '';
    document.getElementById('cancelConfirmBtn').disabled = true;
    document.getElementById('cancelReasonOverlay').classList.add('open');
}

function closeCancelModal() {
    document.getElementById('cancelReasonOverlay').classList.remove('open');
    _cancelBookingId = null;
}

function selectReason(labelEl, isOther = false) {
    document.querySelectorAll('.cancel-reason-option').forEach(o => o.classList.remove('selected'));
    labelEl.classList.add('selected');
    // Show/hide custom textarea
    const customWrap = document.getElementById('cancelCustomWrap');
    customWrap.style.display = isOther ? 'block' : 'none';
    if (!isOther) {
        document.getElementById('cancelConfirmBtn').disabled = false;
    } else {
        // Enable only when custom text is entered
        document.getElementById('cancelCustomText').oninput = function() {
            document.getElementById('cancelConfirmBtn').disabled = this.value.trim().length < 3;
        };
        document.getElementById('cancelConfirmBtn').disabled = true;
    }
}

function submitCancellation() {
    if (!_cancelBookingId) return;

    const selectedRadio = document.querySelector('input[name="cancel_reason_radio"]:checked');
    if (!selectedRadio) { alert('Please select a cancellation reason.'); return; }

    let reason = selectedRadio.value;
    if (reason === 'other') {
        reason = document.getElementById('cancelCustomText').value.trim();
        if (reason.length < 3) { alert('Please enter a valid cancellation reason.'); return; }
    }

    document.getElementById('cancel-booking-id').value  = _cancelBookingId;
    document.getElementById('cancel-reason-value').value = reason;
    document.getElementById('cancelForm').submit();
}

/* ─────────────────────────────────────
   Icon map
───────────────────────────────────── */
const iconMap = {
    'jet ski':       'fa-water',
    'banana boat':   'fa-ship',
    'kayaking':      'fa-sailboat',
    'flying saucer': 'fa-circle-radiation',
};
function actIcon(name) {
    return iconMap[name.trim().toLowerCase()] || 'fa-person-swimming';
}

/* ─────────────────────────────────────
   Date / time helpers
───────────────────────────────────── */
function fmtDate(str) {
    if (!str) return '—';
    const d = new Date(str);
    return d.toLocaleDateString('en-PH', { weekday:'short', year:'numeric', month:'short', day:'numeric' });
}

function normaliseTime(str) {
    if (!str) return '00:00:00';
    const parts = str.split(':');
    while (parts.length < 3) parts.push('00');
    return parts.map(p => p.padStart(2, '0')).join(':');
}

function fmtSlot(timeStr, durationMins) {
    if (!timeStr) return '—';
    const dur   = durationMins || 60;
    const start = new Date('1970-01-01T' + normaliseTime(timeStr));
    const end   = new Date(start.getTime() + dur * 60000);
    const fmt   = t => t.toLocaleTimeString('en-PH', { hour: '2-digit', minute: '2-digit' });
    return fmt(start) + ' – ' + fmt(end);
}

function buildTimeMap(b, actNames, lineItems) {
    let tpaMap = {};
    if (b.time_per_activity) {
        try { tpaMap = JSON.parse(b.time_per_activity); } catch(e) {}
    }
    if (!tpaMap || !Object.keys(tpaMap).length) {
        let cursor = new Date('1970-01-01T' + normaliseTime(b.time || '08:00:00'));
        actNames.forEach(an => {
            tpaMap[an] = cursor.toTimeString().slice(0, 8);
            const dur  = (lineItems && lineItems[an] && lineItems[an].duration)
                         ? parseInt(lineItems[an].duration) : 60;
            cursor = new Date(cursor.getTime() + dur * 60000);
        });
    }
    return tpaMap;
}

function fmtMoney(n) {
    return '₱' + parseFloat(n || 0).toLocaleString('en-PH', { minimumFractionDigits: 2 });
}
function fmtDateTime(str) {
    if (!str) return '—';
    return new Date(str).toLocaleString('en-PH', {
        month:'short', day:'numeric', year:'numeric', hour:'2-digit', minute:'2-digit'
    });
}

const RECEIPT_BASE_URL = '<?= base_url('uploads/gcash_receipts/') ?>';

/* ─────────────────────────────────────
   openDetail()
───────────────────────────────────── */
function openDetail(b) {
    const acts = b.all_activities || b.activity_name || '—';
    document.getElementById('dm-title').textContent = acts;
    document.getElementById('dm-sub').textContent   = 'Booking Code: ' + (b.booking_code || b.id);

    document.getElementById('dm-guest').textContent     = b.username || 'Guest';
    document.getElementById('dm-contact').textContent   = b.contact_number || '—';
    document.getElementById('dm-booked-on').textContent = fmtDateTime(b.created_at);
    document.getElementById('dm-date').textContent      = fmtDate(b.date);

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

    /* Cancel reason */
    const crWrap = document.getElementById('dm-cancel-reason-wrap');
    if (b.cancel_reason && b.cancel_reason.trim()) {
        document.getElementById('dm-cancel-reason').textContent = b.cancel_reason;
        crWrap.style.display = '';
    } else {
        crWrap.style.display = 'none';
    }

    /* Activity names */
    const actNames = (b.all_activities || b.activity_name || '')
                     .split(',').map(s => s.trim()).filter(Boolean);

    /* Participants per activity */
    let ppaMap = {};
    try { ppaMap = JSON.parse(b.participants_per_activity || '{}'); } catch(e) {}
    if (!Object.keys(ppaMap).length) {
        const total = parseInt(b.participants) || 1;
        const per   = Math.floor(total / Math.max(actNames.length, 1));
        const rem   = total % Math.max(actNames.length, 1);
        actNames.forEach((a, i) => { ppaMap[a] = per + (i === 0 ? rem : 0); });
    }

    const lineItems = b._line_items || {};
    const tpaMap    = buildTimeMap(b, actNames, lineItems);

    /* Time slot display */
    const timeEl = document.getElementById('dm-time');
    if (actNames.length <= 1) {
        const an  = actNames[0] || '';
        const dur = (lineItems[an] && lineItems[an].duration) ? parseInt(lineItems[an].duration) : 60;
        timeEl.textContent = fmtSlot(tpaMap[an] || b.time, dur);
    } else {
        const rows = actNames.map(an => {
            const dur  = (lineItems[an] && lineItems[an].duration) ? parseInt(lineItems[an].duration) : 60;
            const slot = fmtSlot(tpaMap[an] || b.time, dur);
            return `<div class="dm-time-row">
                        <i class="fa-solid ${actIcon(an)}"></i>
                        <span class="dtr-name">${an}</span>
                        <span class="dtr-val">${slot}</span>
                    </div>`;
        }).join('');
        timeEl.innerHTML = `<div class="dm-time-block">${rows}</div>`;
    }

    /* Cost summary */
    let costRows = '', computedTotal = 0;
    actNames.forEach(an => {
        const line  = lineItems[an] || {};
        const pax   = ppaMap[an] || 0;
        const lineT = parseFloat(line.line_total || 0);
        computedTotal += lineT;
        let formula = '';
        if (line.price_type === 'per_person' && line.price > 0) {
            formula = `<span class="dm-cost-formula">₱${Number(line.price).toLocaleString()} &times; ${pax} person${pax!==1?'s':''}</span>`;
        } else if (line.price > 0) {
            formula = `<span class="dm-cost-formula">flat rate &middot; ${pax} person${pax!==1?'s':''}</span>`;
        }
        costRows += `<div class="dm-cost-row">
            <div class="dm-cost-act"><i class="fa-solid ${actIcon(an)}"></i>${an} ${formula}</div>
            <div class="dm-cost-amt">${fmtMoney(lineT)}</div>
        </div>`;
    });
    document.getElementById('dm-cost-rows').innerHTML =
        costRows || '<div class="dm-cost-row" style="color:rgba(255,255,255,0.4);">No breakdown available</div>';
    document.getElementById('dm-total').textContent = fmtMoney(b.total_amount || computedTotal);

    /* Receipt */
    const receiptBox      = document.getElementById('dm-receipt-box');
    const receiptFilename = b.gcash_receipt
        ? b.gcash_receipt.split('/').pop().split('\\').pop()
        : (b.latest_payment && b.latest_payment.gcash_receipt
            ? b.latest_payment.gcash_receipt.split('/').pop().split('\\').pop()
            : null);

    if (receiptFilename) {
        const imgUrl      = RECEIPT_BASE_URL + receiptFilename;
        const gcashRef    = b.gcash_ref || (b.latest_payment && b.latest_payment.gcash_ref) || null;
        const submittedAt = b.gcash_submitted_at
            || (b.latest_payment && (b.latest_payment.created_at || b.latest_payment.gcash_submitted_at))
            || b.updated_at;
        const isVerified  = b.latest_payment && b.latest_payment.is_verified == 1;
        const verifiedNote = isVerified
            ? `<div style="margin-top:8px;font-size:0.75rem;color:#5ddb8a;"><i class="fa-solid fa-circle-check me-1"></i>Receipt verified by admin</div>`
            : `<div class="dm-receipt-pending-note"><i class="fa-solid fa-clock"></i> Awaiting admin verification.</div>`;
        receiptBox.innerHTML = `
            <img src="${imgUrl}" class="dm-receipt-img" alt="GCash Receipt"
                 onclick="openLightbox('${imgUrl}')"
                 onerror="this.parentElement.innerHTML='<div class=\'dm-no-receipt\'><i class=\'fa-solid fa-triangle-exclamation\'></i> Image could not be loaded.</div>'">
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
    const payUrl     = '<?= base_url('admin/bookings/update-payment') ?>';

    if (payStatus === 'paid') {
        actionsEl.innerHTML = `<div class="already-paid-note"><i class="fa-solid fa-circle-check"></i>This booking has been fully paid. No further action needed.</div>`;
    } else {
        let btns = '<div class="dm-pay-actions">';
        if (downStatus !== 'paid') {
            btns += `<form method="POST" action="${payUrl}" style="display:inline;">
                <input type="hidden" name="${csrfName}" value="${csrfToken}">
                <input type="hidden" name="booking_id"     value="${b.id}">
                <input type="hidden" name="payment_action" value="down_paid">
                <button type="submit" class="btn-mark-down"
                    onclick="return confirm('Confirm 50% down payment for this booking?')">
                    <i class="fa-solid fa-circle-half-stroke"></i> Mark 50% Down Paid
                </button>
            </form>`;
        }
        btns += `<form method="POST" action="${payUrl}" style="display:inline;">
            <input type="hidden" name="${csrfName}" value="${csrfToken}">
            <input type="hidden" name="booking_id"     value="${b.id}">
            <input type="hidden" name="payment_action" value="full_paid">
            <button type="submit" class="btn-mark-paid"
                onclick="return confirm('Mark this booking as fully paid?')">
                <i class="fa-solid fa-check-circle"></i> Mark as Fully Paid
            </button>
        </form>`;
        if (receiptFilename) {
            btns += `<form method="POST" action="${payUrl}" style="display:inline;">
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
        closeCancelModal();
        document.getElementById('lightbox').classList.remove('open');
        document.getElementById('helpOverlay').classList.remove('open');
    }
});
</script>

<?php
/* ── Server-side enrichment: _line_items + duration injected for JS ── */
if (!empty($bookings)):
    $db = \Config\Database::connect();
    foreach ($bookings as &$b):
        $actNames = array_values(array_filter(
            array_map('trim', explode(',', $b['all_activities'] ?? $b['activity_name'] ?? ''))
        ));
        $ppaMap = [];
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
            $dur   = $row ? (int)($row['duration'] ?? 60) : 60;
            $lineT = ($type === 'per_person') ? $price * $pax : $price;
            $lineItems[$an] = ['price'=>$price,'price_type'=>$type,'duration'=>$dur,'pax'=>$pax,'line_total'=>$lineT];
        }
        $b['_line_items'] = $lineItems;
    endforeach;
    unset($b);
endif;
?>
<script>
(function () {
    const enriched = <?= json_encode(array_values($bookings ?? [])) ?>;
    document.querySelectorAll('#tableBody tr[data-status]').forEach((tr, i) => {
        const btn = tr.querySelector('.btn-view-booking');
        if (btn && enriched[i]) btn.onclick = () => openDetail(enriched[i]);
    });
})();
</script>

</body>
</html>