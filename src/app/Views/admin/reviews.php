<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews | Waves Admin</title>
    <link rel="stylesheet" href="<?= base_url('bootstrap5/css/bootstrap.min.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --deep-blue: #052c39; --ocean-blue: #0a5872; --accent-cyan: #48cae4; --soft-white: #f4f9fc; --sidebar-width: 260px; }
        * { box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background: linear-gradient(180deg, var(--ocean-blue) 0%, var(--deep-blue) 60%, var(--deep-blue) 100%);
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

        .stats-row { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 26px; }
        .mini-stat { background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.1); border-radius: 18px; padding: 20px; text-align: center; }
        .mini-stat .ms-value { font-size: 1.8rem; font-weight: 700; color: var(--accent-cyan); }
        .mini-stat .ms-label { font-size: 0.72rem; text-transform: uppercase; letter-spacing: 1px; color: rgba(255,255,255,0.5); margin-top: 4px; }

        .filter-bar { display: flex; gap: 10px; margin-bottom: 22px; flex-wrap: wrap; }
        .filter-btn { background: rgba(255,255,255,0.08); color: rgba(255,255,255,0.7); border: 1px solid rgba(255,255,255,0.15); padding: 7px 18px; border-radius: 50px; font-size: 0.8rem; font-weight: 500; cursor: pointer; transition: 0.2s; }
        .filter-btn:hover, .filter-btn.active { background: var(--accent-cyan); color: var(--deep-blue); border-color: var(--accent-cyan); font-weight: 700; }

        .reviews-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 18px; }
        .review-card { background: rgba(255,255,255,0.07); backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.1); border-radius: 22px; padding: 24px; transition: 0.3s; position: relative; }
        .review-card:hover { transform: translateY(-4px); border-color: rgba(72,202,228,0.25); }
        .review-avatar { width: 42px; height: 42px; border-radius: 50%; background: rgba(72,202,228,0.15); display: flex; align-items: center; justify-content: center; font-size: 0.9rem; font-weight: 700; color: var(--accent-cyan); flex-shrink: 0; }
        .reviewer-name { font-size: 0.95rem; font-weight: 700; color: white; }
        .review-date { font-size: 0.75rem; color: rgba(255,255,255,0.4); }
        .stars { color: #ffc107; font-size: 0.85rem; }
        .review-text { font-size: 0.85rem; color: rgba(255,255,255,0.75); line-height: 1.65; margin: 12px 0; }
        .badge-activity { background: rgba(10,88,114,0.6); color: var(--accent-cyan); border: 1px solid rgba(72,202,228,0.25); padding: 3px 12px; border-radius: 50px; font-size: 0.72rem; font-weight: 600; }
        .badge-safe { background: rgba(40,167,69,0.12); color: #5ddb8a; border: 1px solid rgba(40,167,69,0.3); padding: 3px 12px; border-radius: 50px; font-size: 0.72rem; font-weight: 600; }
        .badge-moderate { background: rgba(255,193,7,0.12); color: #ffc107; border: 1px solid rgba(255,193,7,0.3); padding: 3px 12px; border-radius: 50px; font-size: 0.72rem; font-weight: 600; }
        .btn-delete { position: absolute; top: 18px; right: 18px; background: rgba(220,53,69,0.1); color: #ff8888; border: 1px solid rgba(220,53,69,0.25); border-radius: 8px; padding: 4px 10px; font-size: 0.72rem; cursor: pointer; transition: 0.2s; }
        .btn-delete:hover { background: #dc3545; color: white; }
        .empty-state { text-align: center; padding: 60px 20px; opacity: 0.5; grid-column: 1/-1; }
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
    <a href="<?= base_url('admin/bookings') ?>" class="nav-item"><i class="fa-solid fa-calendar-check"></i> Bookings</a>
    <a href="<?= base_url('admin/users') ?>" class="nav-item"><i class="fa-solid fa-users"></i> Users</a>
    <div class="sidebar-section-label">Operations</div>
    <a href="<?= base_url('admin/sea-conditions') ?>" class="nav-item"><i class="fa-solid fa-tower-broadcast"></i> Sea Conditions</a>
    <a href="<?= base_url('admin/reviews') ?>" class="nav-item active"><i class="fa-solid fa-star"></i> Reviews</a>
    <div class="sidebar-section-label">System</div>
    <a href="<?= base_url('admin/activities') ?>" class="nav-item"><i class="fa-solid fa-person-swimming"></i> Activities</a>
    <div class="sidebar-footer">
        <a href="<?= base_url('logout') ?>" class="logout-btn"><i class="fa-solid fa-power-off"></i> Logout</a>
    </div>
</aside>

<main class="main-content">
    <div class="page-topbar">
        <div>
            <h1 class="page-title">Reviews</h1>
            <p class="page-subtitle">Monitor guest feedback and manage published reviews.</p>
        </div>
        <span class="admin-pill"><i class="fa-solid fa-star me-2"></i>REVIEWS</span>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success rounded-4 mb-3"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <!-- STATS -->
    <div class="stats-row">
        <div class="mini-stat">
            <div class="ms-value"><?= count($reviews ?? []) ?></div>
            <div class="ms-label">Total Reviews</div>
        </div>
        <div class="mini-stat">
            <div class="ms-value" style="color:#ffc107;">4.9</div>
            <div class="ms-label">Avg Rating</div>
        </div>
        <div class="mini-stat">
            <div class="ms-value" style="color:#5ddb8a;"><?= $safeCount ?? 0 ?></div>
            <div class="ms-label">Felt Safe</div>
        </div>
        <div class="mini-stat">
            <div class="ms-value" style="color:#ffc107;"><?= $moderateCount ?? 0 ?></div>
            <div class="ms-label">Felt Moderate</div>
        </div>
    </div>

    <!-- FILTERS -->
    <div class="filter-bar">
        <button class="filter-btn active" onclick="setFilter('all', this)">All Activities</button>
        <button class="filter-btn" onclick="setFilter('jet ski', this)">Jet Ski</button>
        <button class="filter-btn" onclick="setFilter('banana boat', this)">Banana Boat</button>
        <button class="filter-btn" onclick="setFilter('kayaking', this)">Kayaking</button>
        <button class="filter-btn" onclick="setFilter('flying saucer', this)">Flying Saucer</button>
    </div>

    <!-- REVIEWS GRID -->
    <div class="reviews-grid" id="reviewsGrid">
        <?php if (!empty($reviews)): ?>
            <?php foreach ($reviews as $r): ?>
                <?php
                    $stars    = (int)($r['rating'] ?? 5);
                    $initials = strtoupper(substr($r['username'] ?? 'U', 0, 2));
                    $safeClass = match(strtolower($r['safe_feel'] ?? 'yes')) {
                        'yes' => 'badge-safe',
                        'no', 'moderate' => 'badge-moderate',
                        default => 'badge-safe'
                    };
                ?>
                <div class="review-card" data-activity="<?= strtolower($r['activity'] ?? '') ?>">
                    <form method="POST" action="<?= base_url('admin/reviews/delete') ?>" style="display:inline;">
                        <?= csrf_field() ?>
                        <input type="hidden" name="id" value="<?= $r['id'] ?>">
                        <button type="submit" class="btn-delete" onclick="return confirm('Delete this review?')">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </form>

                    <div class="d-flex align-items-center gap-3 mb-2">
                        <div class="review-avatar"><?= $initials ?></div>
                        <div>
                            <div class="reviewer-name"><?= esc($r['username'] ?? 'Anonymous') ?></div>
                            <div class="review-date"><?= isset($r['created_at']) ? date('M d, Y', strtotime($r['created_at'])) : '' ?></div>
                        </div>
                    </div>

                    <div class="stars mb-2">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <i class="fa-<?= $i <= $stars ? 'solid' : 'regular' ?> fa-star"></i>
                        <?php endfor; ?>
                    </div>

                    <p class="review-text"><?= esc($r['review_text'] ?? '') ?></p>

                    <div class="d-flex gap-2 flex-wrap">
                        <span class="badge-activity"><?= esc($r['activity'] ?? 'N/A') ?></span>
                        <span class="<?= $safeClass ?>">
                            <i class="fa-solid fa-shield-halved me-1"></i>Felt: <?= esc($r['safe_feel'] ?? 'Safe') ?>
                        </span>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="empty-state">
                <i class="fa-solid fa-star-half-stroke"></i>
                <p>No reviews yet.</p>
            </div>
        <?php endif; ?>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function setFilter(activity, btn) {
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    document.querySelectorAll('.review-card').forEach(c => {
        c.style.display = (activity === 'all' || c.dataset.activity.includes(activity)) ? '' : 'none';
    });
}
</script>
</body>
</html>