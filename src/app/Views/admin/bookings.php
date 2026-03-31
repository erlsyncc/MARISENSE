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
        body { font-family: 'Poppins', sans-serif; background: linear-gradient(180deg, var(--accent-cyan) 0%, var(--ocean-blue) 40%, var(--deep-blue) 100%); background-attachment: fixed; color: var(--soft-white); margin: 0; min-height: 100vh; }

        /* SIDEBAR — same as dashboard */
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

        .main-content { margin-left: var(--sidebar-width); padding: 32px 36px; min-height: 100vh; }
        .page-topbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 28px; }
        .page-title { font-size: 1.6rem; font-weight: 700; color: white; margin: 0; }
        .page-subtitle { font-size: 0.82rem; color: rgba(255,255,255,0.5); margin: 2px 0 0; }
        .admin-pill { background: rgba(72,202,228,0.12); border: 1px solid rgba(72,202,228,0.3); color: var(--accent-cyan); border-radius: 50px; padding: 6px 18px; font-size: 0.78rem; font-weight: 600; letter-spacing: 1px; }

        /* FILTERS */
        .filter-bar { display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 22px; align-items: center; }
        .filter-btn { background: rgba(255,255,255,0.08); color: rgba(255,255,255,0.7); border: 1px solid rgba(255,255,255,0.15); padding: 7px 18px; border-radius: 50px; font-size: 0.8rem; font-weight: 500; cursor: pointer; transition: 0.2s; }
        .filter-btn:hover, .filter-btn.active { background: var(--accent-cyan); color: var(--deep-blue); border-color: var(--accent-cyan); font-weight: 700; }
        .search-input { background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); border-radius: 50px; color: white; padding: 7px 18px; font-size: 0.82rem; outline: none; min-width: 220px; }
        .search-input::placeholder { color: rgba(255,255,255,0.3); }
        .search-input:focus { border-color: var(--accent-cyan); }

        /* TABLE */
        .table-container { background: rgba(255,255,255,0.07); backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.1); border-radius: 24px; padding: 10px; overflow-x: auto; }
        .custom-table { width: 100%; color: white; border-collapse: separate; border-spacing: 0 8px; min-width: 900px; }
        .custom-table thead th { border: none; text-transform: uppercase; font-size: 0.7rem; letter-spacing: 1.5px; opacity: 0.5; padding: 8px 16px; font-weight: 600; }
        .custom-table tbody tr { background: rgba(255,255,255,0.04); transition: 0.25s; }
        .custom-table tbody tr:hover { background: rgba(255,255,255,0.09); transform: scale(1.005); }
        .custom-table td { padding: 14px 16px; vertical-align: middle; border: none; font-size: 0.85rem; }
        .custom-table td:first-child { border-radius: 14px 0 0 14px; }
        .custom-table td:last-child { border-radius: 0 14px 14px 0; }

        .badge-status { padding: 5px 14px; border-radius: 50px; font-size: 0.72rem; font-weight: 700; white-space: nowrap; }
        .s-pending   { background: rgba(255,193,7,0.12); color: #ffc107; border: 1px solid rgba(255,193,7,0.4); }
        .s-confirmed { background: rgba(40,167,69,0.12); color: #5ddb8a; border: 1px solid rgba(40,167,69,0.4); }
        .s-completed { background: rgba(72,202,228,0.12); color: #48cae4; border: 1px solid rgba(72,202,228,0.4); }
        .s-cancelled { background: rgba(220,53,69,0.12); color: #ff8888; border: 1px solid rgba(220,53,69,0.4); }

        .btn-approve { background: rgba(40,167,69,0.15); color: #5ddb8a; border: 1px solid rgba(40,167,69,0.3); border-radius: 8px; padding: 5px 12px; font-size: 0.75rem; font-weight: 600; cursor: pointer; transition: 0.2s; }
        .btn-approve:hover { background: #5ddb8a; color: var(--deep-blue); }
        .btn-cancel  { background: rgba(220,53,69,0.12); color: #ff8888; border: 1px solid rgba(220,53,69,0.3); border-radius: 8px; padding: 5px 12px; font-size: 0.75rem; font-weight: 600; cursor: pointer; transition: 0.2s; }
        .btn-cancel:hover { background: #dc3545; color: white; }
        .btn-complete { background: rgba(72,202,228,0.12); color: #48cae4; border: 1px solid rgba(72,202,228,0.3); border-radius: 8px; padding: 5px 12px; font-size: 0.75rem; font-weight: 600; cursor: pointer; transition: 0.2s; }
        .btn-complete:hover { background: var(--accent-cyan); color: var(--deep-blue); }

        .empty-state { text-align: center; padding: 50px 20px; opacity: 0.5; }
        .empty-state i { font-size: 2.5rem; margin-bottom: 12px; display: block; }
    </style>
</head>
<body>

<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon"><i class="fa-solid fa-anchor"></i></div>
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
    <div class="sidebar-footer">
        <a href="<?= base_url('logout') ?>" class="logout-btn"><i class="fa-solid fa-power-off"></i> Logout</a>
    </div>
</aside>

<main class="main-content">
    <div class="page-topbar">
        <div>
            <h1 class="page-title">Manage Bookings</h1>
            <p class="page-subtitle">Review, approve, and manage all activity reservations.</p>
        </div>
        <span class="admin-pill"><i class="fa-solid fa-calendar-check me-2"></i>BOOKINGS</span>
    </div>

    <!-- Flash messages -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success rounded-4 mb-3"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger rounded-4 mb-3"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <!-- FILTERS -->
    <div class="filter-bar">
        <input type="text" class="search-input" id="searchInput" placeholder="&#xf002;  Search name or booking ID..." oninput="filterTable()">
        <button class="filter-btn active" onclick="setFilter('all', this)">All</button>
        <button class="filter-btn" onclick="setFilter('pending', this)">Pending</button>
        <button class="filter-btn" onclick="setFilter('confirmed', this)">Confirmed</button>
        <button class="filter-btn" onclick="setFilter('completed', this)">Completed</button>
        <button class="filter-btn" onclick="setFilter('cancelled', this)">Cancelled</button>
    </div>

    <!-- TABLE -->
    <div class="table-container shadow-lg">
        <table class="custom-table" id="bookingsTable">
            <thead>
                <tr>
                    <th>Guest</th>
                    <th>Activity</th>
                    <th>Date & Time</th>
                    <th>Participants</th>
                    <th>Status</th>
                    <th>Payment</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody id="tableBody">
            <?php if (!empty($bookings)): ?>
                <?php foreach ($bookings as $b): ?>
                    <?php
                        $sc = match(strtolower($b['status'])) {
                            'pending'             => 's-pending',
                            'confirmed','approved'=> 's-confirmed',
                            'completed'           => 's-completed',
                            'cancelled'           => 's-cancelled',
                            default               => 's-pending'
                        };
                        $initials = strtoupper(substr($b['username'] ?? 'G', 0, 2));
                        $payLabel = ($b['payment_status'] ?? '') === 'paid'
                            ? '<span style="color:#5ddb8a;font-weight:700;">Paid</span>'
                            : '<span style="color:#ffc107;font-weight:700;">Unpaid</span>';
                    ?>
                    <tr data-status="<?= strtolower($b['status']) ?>" data-search="<?= strtolower($b['username'] ?? '') . ' ' . strtolower($b['booking_code'] ?? '') ?>">
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
                        <td><?= esc($b['activity_name'] ?? '—') ?></td>
                        <td>
                            <div style="font-weight:600;"><?= date('M d, Y', strtotime($b['date'])) ?></div>
                            <div style="font-size:0.75rem;color:var(--accent-cyan);"><?= date('h:i A', strtotime($b['time'])) ?></div>
                        </td>
                        <td><?= esc($b['participants'] ?? 1) ?> person(s)</td>
                        <td><span class="badge-status <?= $sc ?>"><?= ucfirst($b['status']) ?></span></td>
                        <td><?= $payLabel ?></td>
                        <td class="text-center">
                            <div class="d-flex gap-1 justify-content-center flex-wrap">
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
                                    <span style="font-size:0.75rem;color:rgba(255,255,255,0.35);font-style:italic;">No actions</span>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
</script>
</body>
</html>