<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users | Waves Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --deep-blue: #052c39; --ocean-blue: #0a5872; --accent-cyan: #48cae4; --soft-white: #f4f9fc; --sidebar-width: 260px; }
        * { box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background: linear-gradient(180deg, var(--ocean-blue) 0%, var(--deep-blue) 60%, var(--deep-blue) 100%);}
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
        .sidebar-footer { margin-top: auto; padding: 16px 12px; border-top: 1px solid rgba(255,255,255,0.08); }
        .logout-btn { display: flex; align-items: center; gap: 12px; padding: 11px 20px; border-radius: 12px; color: #ff6b6b; text-decoration: none; font-size: 0.88rem; font-weight: 600; border: 1px solid rgba(255,107,107,0.25); transition: 0.25s; }
        .logout-btn:hover { background: #ff6b6b; color: white; text-decoration: none; }

        .main-content { margin-left: var(--sidebar-width); padding: 32px 36px; min-height: 100vh; }
        .page-topbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 28px; }
        .page-title { font-size: 1.6rem; font-weight: 700; color: white; margin: 0; }
        .page-subtitle { font-size: 0.82rem; color: rgba(255,255,255,0.5); margin: 2px 0 0; }
        .admin-pill { background: rgba(72,202,228,0.12); border: 1px solid rgba(72,202,228,0.3); color: var(--accent-cyan); border-radius: 50px; padding: 6px 18px; font-size: 0.78rem; font-weight: 600; letter-spacing: 1px; }

        .search-bar { display: flex; gap: 10px; margin-bottom: 22px; }
        .search-input { background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); border-radius: 50px; color: white; padding: 9px 20px; font-size: 0.83rem; outline: none; min-width: 280px; }
        .search-input::placeholder { color: rgba(255,255,255,0.3); }
        .search-input:focus { border-color: var(--accent-cyan); }

        .users-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 18px; }
        .user-card { background: rgba(255,255,255,0.07); backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.1); border-radius: 22px; padding: 24px; transition: 0.3s; }
        .user-card:hover { transform: translateY(-4px); border-color: rgba(72,202,228,0.3); }
        .user-avatar { width: 54px; height: 54px; border-radius: 50%; background: rgba(72,202,228,0.15); display: flex; align-items: center; justify-content: center; font-size: 1.1rem; font-weight: 700; color: var(--accent-cyan); border: 2px solid rgba(72,202,228,0.25); flex-shrink: 0; }
        .user-name { font-size: 1rem; font-weight: 700; color: white; }
        .user-email { font-size: 0.78rem; color: rgba(255,255,255,0.45); }
        .user-meta {
            display: flex;
            gap: 15px;
            margin-top: 8px;
        }

        .meta-item {
            font-size: 0.82rem;
            padding: 4px 10px;
            border-radius: 6px;
            background: rgba(255, 255, 255, 0.03); /* Halos invisible na box */
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: 0.3s ease;
        }

        /* Kulay para sa Joined Date */
        .meta-item.joined {
            color: #ffd166; /* Warm Gold */
        }
        .meta-item.joined i {
            color: #ffd166;
            margin-right: 5px;
            filter: drop-shadow(0 0 5px rgba(255, 209, 102, 0.3));
        }

        /* Kulay para sa Booking Count */
        .meta-item.bookings {
            color: #5ddb8a;
        }
        .meta-item.bookings i {
            color: #5ddb8a;
            margin-right: 5px;
            filter: drop-shadow(0 0 5px rgba(72, 202, 228, 0.3));
        }

        /* Hover Effect para hindi boring */
        .meta-item:hover {
            background: rgba(255, 255, 255, 0.08);
            transform: translateY(-1px);
        }
        .role-badge { padding: 3px 12px; border-radius: 50px; font-size: 0.7rem; font-weight: 700; }
        .role-admin { background: rgba(72,202,228,0.15); color: var(--accent-cyan); border: 1px solid rgba(72,202,228,0.4); }
        .role-user  { background: rgba(255,255,255,0.08); color: rgba(255,255,255,0.6); border: 1px solid rgba(255,255,255,0.15); }
        .empty-state { text-align: center; padding: 60px 20px; opacity: 0.5; grid-column: 1/-1; }
        .empty-state i { font-size: 2.5rem; margin-bottom: 12px; display: block; }
        @keyframes wave-motion {0% { transform: translateY(0); }50% { transform: translateY(-3px); }100% { transform: translateY(0); }}
        .brand-icon i { animation: wave-motion 3s ease-in-out infinite;display: inline-block;}
        /* Help Button & Modal */
        .help-btn { display: flex; align-items: center; gap: 12px; padding: 11px 20px; border-radius: 12px; color: var(--accent-cyan); text-decoration: none; font-size: 0.88rem; font-weight: 600; border: 1px solid rgba(72,202,228,0.25); transition: 0.25s; cursor: pointer; background: none; width: 100%; margin-top: 8px; }
        .help-btn:hover { background: rgba(72,202,228,0.15); color: white; }
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

        /* Pagination */
        .table-paginator { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px; margin-top: 14px; }
        .table-paginator .page-info { font-size: 0.74rem; color: rgba(255,255,255,0.5); }
        .table-paginator .page-size { font-size: 0.74rem; color: rgba(255,255,255,0.6); background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.12); border-radius: 8px; padding: 5px 10px; outline: none; cursor: pointer; }
        .table-paginator .page-btn { font-size: 0.74rem; color: rgba(255,255,255,0.7); background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.12); border-radius: 8px; padding: 5px 12px; cursor: pointer; transition: 0.2s; min-width: 34px; }
        .table-paginator .page-btn:hover:not(:disabled) { background: rgba(72,202,228,0.15); color: var(--accent-cyan); border-color: rgba(72,202,228,0.35); }
        .table-paginator .page-btn:disabled { opacity: 0.35; cursor: not-allowed; }
        .table-paginator .page-btn.active { background: var(--accent-cyan); color: var(--deep-blue); border-color: var(--accent-cyan); font-weight: 700; }
        .table-paginator .page-nav { display: flex; gap: 6px; align-items: center; flex-wrap: wrap; }
    </style>
</head>
<body>

<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon">
            <i class="fa-solid fa-water"></i> </div>
        <div class="brand-title">Waves Admin</div>
        <div class="brand-sub">Control Panel</div>
    </div>
    <div class="sidebar-section-label">Main</div>
    <a href="<?= base_url('admin/dashboard') ?>" class="nav-item"><i class="fa-solid fa-chart-line"></i> Dashboard</a>
    <a href="<?= base_url('admin/bookings') ?>" class="nav-item"><i class="fa-solid fa-calendar-check"></i> Bookings</a>
    <a href="<?= base_url('admin/users') ?>" class="nav-item active"><i class="fa-solid fa-users"></i> Users</a>
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
            <h1 class="page-title">Manage Users</h1>
            <p class="page-subtitle"><?= count($users ?? []) ?> registered accounts in the system.</p>
        </div>
        <span class="admin-pill"><i class="fa-solid fa-users me-2"></i>USERS</span>
    </div>

    <div class="search-bar">
        <input type="text" class="search-input" id="searchInput" placeholder="&#xf002;  Search by name or email..." oninput="searchUsers()">
    </div>

    <div class="users-grid" id="usersGrid">
        <?php if (!empty($users)): ?>
            <?php foreach ($users as $u): ?>
                <?php
                    $initials = strtoupper(substr($u['username'] ?? 'U', 0, 2));
                    $email    = $u['email'] ?? 'N/A';
                    $role     = $u['role'] ?? 'user';
                    $joined   = isset($u['created_at']) ? date('M Y', strtotime($u['created_at'])) : 'Unknown';
                    $bookingCount = $u['booking_count'] ?? 0;
                    $emailVerified = $u['email_verified'] ?? false;
                ?>
                <div class="user-card" data-search="<?= strtolower($u['username'] . ' ' . $email) ?>">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="user-avatar"><?= $initials ?></div>
                        <div style="flex:1;min-width:0;">
                            <div class="user-name"><?= esc($u['username']) ?></div>
                            <div class="user-email"><?= esc($email) ?></div>
                            <?php if (!$emailVerified): ?>
                                <span style="font-size: 0.75rem; color: #ff6b6b; font-weight: 600;">
                                    <i class="fa-solid fa-exclamation-circle"></i> Unverified
                                </span>
                            <?php endif; ?>
                        </div>
                        <span class="role-badge role-<?= $role ?>"><?= ucfirst($role) ?></span>
                    </div>
                    <div class="user-meta">
                        <span class="meta-item joined">
                            <i class="fa-solid fa-calendar-check"></i> Joined <?= $joined ?>
                        </span>
                        <span class="meta-item bookings">
                            <i class="fa-solid fa-ticket"></i> <?= $bookingCount ?> booking/<?= $bookingCount !== 1 ? 's' : '' ?>
                        </span>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="empty-state">
                <i class="fa-solid fa-users-slash"></i>
                <p>No users found.</p>
            </div>
        <?php endif; ?>
    </div>
    <div class="table-paginator" id="usersPaginator">
        <div style="display:flex;align-items:center;gap:10px;">
            <span class="page-info" id="usersPageInfo"></span>
            <select class="page-size" id="usersPageSize">
                <option value="8" selected>8 / page</option>
                <option value="16">16 / page</option>
                <option value="32">32 / page</option>
                <option value="64">64 / page</option>
            </select>
        </div>
        <div class="page-nav" id="usersPageNav"></div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function searchUsers() {
    const q = document.getElementById('searchInput').value.toLowerCase();
    document.querySelectorAll('.user-card').forEach(c => {
        c.style.display = (!q || c.dataset.search.includes(q)) ? '' : 'none';
    });
}

/* ══════════════ USERS PAGINATION ══════════════ */
(function () {
    const grid = document.getElementById('usersGrid');
    if (!grid) return;
    const allCards = Array.from(grid.querySelectorAll('.user-card'));
    if (!allCards.length) return;
    const pageInfo = document.getElementById('usersPageInfo');
    const pageNav = document.getElementById('usersPageNav');
    const pageSizeSelect = document.getElementById('usersPageSize');
    let currentPage = 1;
    let pageSize = parseInt(pageSizeSelect?.value || '8', 10);

    function renderPage() {
        const total = allCards.length;
        const totalPages = Math.max(1, Math.ceil(total / pageSize));
        currentPage = Math.min(currentPage, totalPages);
        const start = (currentPage - 1) * pageSize;
        const end = Math.min(start + pageSize, total);
        allCards.forEach((card, i) => { card.style.display = (i >= start && i < end) ? '' : 'none'; });
        if (pageInfo) pageInfo.textContent = `Showing ${start + 1}–${end} of ${total} entries`;
        if (pageNav) {
            const maxButtons = 5;
            let startPage = Math.max(1, currentPage - Math.floor(maxButtons / 2));
            let endPage = startPage + maxButtons - 1;
            if (endPage > totalPages) { endPage = totalPages; startPage = Math.max(1, endPage - maxButtons + 1); }
            let html = '';
            html += `<button type="button" class="page-btn" data-page="prev" ${currentPage === 1 ? 'disabled' : ''}>Prev</button>`;
            for (let p = startPage; p <= endPage; p++) {
                html += `<button type="button" class="page-btn${p === currentPage ? ' active' : ''}" data-page="${p}">${p}</button>`;
            }
            html += `<button type="button" class="page-btn" data-page="next" ${currentPage === totalPages ? 'disabled' : ''}>Next</button>`;
            pageNav.innerHTML = html;
            pageNav.querySelectorAll('button[data-page]').forEach(btn => {
                btn.addEventListener('click', () => {
                    const action = btn.getAttribute('data-page');
                    if (action === 'prev') { if (currentPage > 1) currentPage--; }
                    else if (action === 'next') { if (currentPage < totalPages) currentPage++; }
                    else { currentPage = parseInt(action, 10); }
                    renderPage();
                });
            });
        }
    }
    if (pageSizeSelect) {
        pageSizeSelect.addEventListener('change', () => {
            pageSize = parseInt(pageSizeSelect.value, 10);
            currentPage = 1;
            renderPage();
        });
    }
    renderPage();
})();
</script>
<!-- HELP MODAL -->
<div class="help-overlay" id="helpOverlay" onclick="if(event.target===this) this.classList.remove('open')">
    <div class="help-modal">
        <button class="help-close" onclick="document.getElementById('helpOverlay').classList.remove('open')">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <div class="help-modal-title"><i class="fa-solid fa-circle-question me-2" style="color:var(--accent-cyan)"></i>Admin Help Guide</div>
        <div class="help-modal-sub">Everything you need to manage the Waves platform.</div>

        <div class="help-section">
            <div class="help-section-title">📋 Main</div>
            <div class="help-item">
                <div class="help-item-icon"><i class="fa-solid fa-chart-line"></i></div>
                <div>
                    <div class="help-item-title">Dashboard</div>
                    <div class="help-item-desc">Overview of total bookings, revenue, and platform activity at a glance.</div>
                </div>
            </div>
            <div class="help-item">
                <div class="help-item-icon"><i class="fa-solid fa-calendar-check"></i></div>
                <div>
                    <div class="help-item-title">Bookings</div>
                    <div class="help-item-desc">View and manage all customer reservations. Update statuses, track schedules, and cancel bookings here.</div>
                </div>
            </div>
            <div class="help-item">
                <div class="help-item-icon"><i class="fa-solid fa-users"></i></div>
                <div>
                    <div class="help-item-title">Users</div>
                    <div class="help-item-desc">Browse all registered accounts, check booking counts, and identify roles (Admin vs User).</div>
                </div>
            </div>
        </div>

        <div class="help-section">
            <div class="help-section-title">⚙️ Operations</div>
            <div class="help-item">
                <div class="help-item-icon"><i class="fa-solid fa-tower-broadcast"></i></div>
                <div>
                    <div class="help-item-title">Sea Conditions</div>
                    <div class="help-item-desc">View live buoy_data telemetry and trend charts used for customer-facing sea condition status.</div>
                </div>
            </div>
            <div class="help-item">
                <div class="help-item-icon"><i class="fa-solid fa-star"></i></div>
                <div>
                    <div class="help-item-title">Reviews</div>
                    <div class="help-item-desc">Monitor guest feedback. Filter by activity and remove inappropriate reviews using the delete button on each card.</div>
                </div>
            </div>
        </div>

        <div class="help-section">
            <div class="help-section-title">🛠 System</div>
            <div class="help-item">
                <div class="help-item-icon"><i class="fa-solid fa-person-swimming"></i></div>
                <div>
                    <div class="help-item-title">Activities</div>
                    <div class="help-item-desc">Add, edit, or remove available water activities (Jet Ski, Kayaking, etc.) and manage their pricing.</div>
                </div>
            </div>
            <div class="help-item">
                <div class="help-item-icon"><i class="fa-solid fa-peso-sign"></i></div>
                <div>
                    <div class="help-item-title">Sales</div>
                    <div class="help-item-desc">Track revenue reports, view earnings per activity, and monitor payment trends over time.</div>
                </div>
            </div>
        </div>

        <div class="help-tip">
            <strong>💡 Tip:</strong> Sea conditions you post are shown to customers on the booking page — always keep them updated before opening hours to help guests make informed decisions.
        </div>
    </div>
</div>
</body>
</html>
