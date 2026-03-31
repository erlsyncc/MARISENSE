<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sea Conditions | Waves Admin</title>
    <link rel="stylesheet" href="<?= base_url('bootstrap5/css/bootstrap.min.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --deep-blue: #052c39; --ocean-blue: #0a5872; --accent-cyan: #48cae4; --soft-white: #f4f9fc; --sidebar-width: 260px; }
        * { box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background: linear-gradient(180deg, var(--accent-cyan) 0%, var(--ocean-blue) 40%, var(--deep-blue) 100%); background-attachment: fixed; color: var(--soft-white); margin: 0; min-height: 100vh; }
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

        .sea-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 18px; margin-bottom: 28px; }
        .sea-card { background: rgba(255,255,255,0.08); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.12); border-radius: 20px; padding: 26px 22px; text-align: center; transition: 0.3s; }
        .sea-card:hover { transform: translateY(-4px); border-color: rgba(72,202,228,0.3); }
        .sea-card .card-icon { font-size: 2rem; color: var(--accent-cyan); margin-bottom: 12px; }
        .sea-card .card-label { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1.5px; color: rgba(255,255,255,0.5); margin-bottom: 6px; }
        .sea-card .card-value { font-size: 2.2rem; font-weight: 700; color: white; line-height: 1; }
        .sea-card .card-unit { font-size: 0.8rem; color: var(--accent-cyan); margin-top: 4px; }

        .panels-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 24px; }
        .panel { background: rgba(255,255,255,0.07); backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.1); border-radius: 24px; padding: 28px; }
        .panel-title { font-size: 0.82rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: rgba(255,255,255,0.6); margin-bottom: 20px; display: flex; align-items: center; gap: 8px; }
        .panel-title i { color: var(--accent-cyan); }

        .status-box { border-radius: 20px; padding: 28px; text-align: center; margin-bottom: 24px; }
        .status-safe     { background: rgba(40,167,69,0.12); border: 2px solid rgba(40,167,69,0.35); }
        .status-moderate { background: rgba(255,193,7,0.12); border: 2px solid rgba(255,193,7,0.35); }
        .status-unsafe   { background: rgba(220,53,69,0.12); border: 2px solid rgba(220,53,69,0.35); }
        .status-icon { font-size: 3rem; margin-bottom: 10px; }
        .status-label { font-size: 1.4rem; font-weight: 700; }
        .status-desc { font-size: 0.85rem; opacity: 0.7; margin-top: 6px; }

        /* Update form */
        .form-panel { background: rgba(255,255,255,0.07); backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.12); border-radius: 24px; padding: 30px; margin-bottom: 24px; }
        .field-label { display: block; font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: var(--accent-cyan); margin-bottom: 8px; }
        .form-control-wave { width: 100%; background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.15); border-radius: 12px; color: white; padding: 12px 16px; font-size: 0.9rem; font-family: 'Poppins', sans-serif; transition: border-color 0.3s; outline: none; }
        .form-control-wave:focus { border-color: rgba(72,202,228,0.6); background: rgba(255,255,255,0.1); }
        .form-control-wave::placeholder { color: rgba(255,255,255,0.3); }
        .form-select-wave { width: 100%; background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.15); border-radius: 12px; color: white; padding: 12px 16px; font-size: 0.9rem; font-family: 'Poppins', sans-serif; outline: none; -webkit-appearance: none; }
        .form-select-wave option { background: #073d52; color: white; }
        .form-row-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 18px; margin-bottom: 18px; }
        .form-row-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; margin-bottom: 18px; }
        .btn-update { background: var(--accent-cyan); color: var(--deep-blue); font-weight: 700; border: none; border-radius: 14px; padding: 14px 36px; font-size: 0.95rem; cursor: pointer; transition: 0.3s; }
        .btn-update:hover { background: white; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(72,202,228,0.3); }

        /* History table */
        .history-table { width: 100%; color: white; border-collapse: separate; border-spacing: 0 6px; }
        .history-table thead th { border: none; text-transform: uppercase; font-size: 0.68rem; letter-spacing: 1.5px; opacity: 0.5; padding: 6px 14px; font-weight: 600; }
        .history-table tbody tr { background: rgba(255,255,255,0.04); }
        .history-table tbody tr:hover { background: rgba(255,255,255,0.08); }
        .history-table td { padding: 10px 14px; vertical-align: middle; font-size: 0.82rem; border: none; }
        .history-table td:first-child { border-radius: 10px 0 0 10px; }
        .history-table td:last-child { border-radius: 0 10px 10px 0; }
        .dot-safe { color: #5ddb8a; }
        .dot-moderate { color: #ffc107; }
        .dot-unsafe { color: #ff6b6b; }
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
    <a href="<?= base_url('admin/sea-conditions') ?>" class="nav-item active"><i class="fa-solid fa-tower-broadcast"></i> Sea Conditions</a>
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
            <h1 class="page-title">Sea Conditions</h1>
            <p class="page-subtitle">MARISENSE live data — monitor and update sea safety status.</p>
        </div>
        <span class="admin-pill"><i class="fa-solid fa-satellite-dish me-2"></i>MARISENSE</span>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success rounded-4 mb-3"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <!-- LIVE METRICS -->
    <div class="sea-grid">
        <div class="sea-card">
            <div class="card-icon"><i class="fa-solid fa-wind"></i></div>
            <div class="card-label">Wind Speed</div>
            <div class="card-value">10</div>
            <div class="card-unit">knots</div>
        </div>
        <div class="sea-card">
            <div class="card-icon"><i class="fa-solid fa-compass"></i></div>
            <div class="card-label">Wind Direction</div>
            <div class="card-value" style="font-size:1.4rem;">NE</div>
            <div class="card-unit">Northeast</div>
        </div>
        <div class="sea-card">
            <div class="card-icon"><i class="fa-solid fa-water"></i></div>
            <div class="card-label">Wave Height</div>
            <div class="card-value">0.9</div>
            <div class="card-unit">meters</div>
        </div>
        <div class="sea-card">
            <div class="card-icon"><i class="fa-solid fa-wave-square"></i></div>
            <div class="card-label">Wave Period</div>
            <div class="card-value">5</div>
            <div class="card-unit">seconds</div>
        </div>
    </div>

    <!-- STATUS DISPLAY -->
    <div class="status-box status-safe">
        <div class="status-icon">🟢</div>
        <div class="status-label" style="color:#5ddb8a;">SAFE FOR ACTIVITIES</div>
        <div class="status-desc">All conditions are within acceptable thresholds. Activities may proceed normally.</div>
    </div>

    <div class="panels-row">
        <!-- UPDATE FORM -->
        <div class="form-panel">
            <div class="panel-title" style="margin-bottom:20px;"><i class="fa-solid fa-pen-to-square"></i> Update Sea Data</div>
            <form method="POST" action="<?= base_url('admin/sea-conditions/update') ?>">
                <?= csrf_field() ?>
                <div class="form-row-3">
                    <div>
                        <label class="field-label">Wind Speed (knots)</label>
                        <input type="number" step="0.1" name="wind_speed" class="form-control-wave" placeholder="e.g. 10" required>
                    </div>
                    <div>
                        <label class="field-label">Wind Direction</label>
                        <select name="wind_direction" class="form-select-wave">
                            <option value="North">North</option>
                            <option value="Northeast" selected>Northeast</option>
                            <option value="East">East</option>
                            <option value="Southeast">Southeast</option>
                            <option value="South">South</option>
                            <option value="Southwest">Southwest</option>
                            <option value="West">West</option>
                            <option value="Northwest">Northwest</option>
                        </select>
                    </div>
                    <div>
                        <label class="field-label">Temperature (°C)</label>
                        <input type="number" step="0.1" name="temperature" class="form-control-wave" placeholder="e.g. 28">
                    </div>
                </div>
                <div class="form-row-2">
                    <div>
                        <label class="field-label">Wave Height (meters)</label>
                        <input type="number" step="0.1" name="wave_height" class="form-control-wave" placeholder="e.g. 0.9" required>
                    </div>
                    <div>
                        <label class="field-label">Wave Period (seconds)</label>
                        <input type="number" step="0.1" name="wave_period" class="form-control-wave" placeholder="e.g. 5" required>
                    </div>
                </div>
                <div style="margin-bottom:18px;">
                    <label class="field-label">Safety Status</label>
                    <select name="safety_status" class="form-select-wave">
                        <option value="safe">🟢 Safe for Activities</option>
                        <option value="moderate">🟡 Moderate — Proceed with Caution</option>
                        <option value="unsafe">🔴 Unsafe — Operations Suspended</option>
                    </select>
                </div>
                <div style="margin-bottom:18px;">
                    <label class="field-label">Admin Notes (Optional)</label>
                    <textarea name="notes" class="form-control-wave" rows="2" placeholder="e.g. High tide expected at 3PM..."></textarea>
                </div>
                <button type="submit" class="btn-update">
                    <i class="fa-solid fa-satellite-dish me-2"></i> Update Sea Data
                </button>
            </form>
        </div>

        <!-- SAFETY THRESHOLDS -->
        <div class="panel">
            <div class="panel-title"><i class="fa-solid fa-shield-halved"></i> Safety Thresholds</div>
            <div style="font-size:0.85rem;line-height:2.2;">
                <div style="display:flex;justify-content:space-between;border-bottom:1px solid rgba(255,255,255,0.06);padding-bottom:10px;margin-bottom:10px;">
                    <span style="color:rgba(255,255,255,0.6);"><i class="fa-solid fa-wind me-2" style="color:var(--accent-cyan);"></i>Wind Speed</span>
                    <span><span style="color:#5ddb8a;">≤ 15 kts</span> = Safe &nbsp;|&nbsp; <span style="color:#ff6b6b;">{'>'} 15 kts</span> = Unsafe</span>
                </div>
                <div style="display:flex;justify-content:space-between;border-bottom:1px solid rgba(255,255,255,0.06);padding-bottom:10px;margin-bottom:10px;">
                    <span style="color:rgba(255,255,255,0.6);"><i class="fa-solid fa-water me-2" style="color:var(--accent-cyan);"></i>Wave Height</span>
                    <span><span style="color:#5ddb8a;">≤ 1.5 m</span> = Safe &nbsp;|&nbsp; <span style="color:#ff6b6b;">{'>'} 1.5 m</span> = Unsafe</span>
                </div>
                <div style="display:flex;justify-content:space-between;padding-bottom:10px;margin-bottom:10px;">
                    <span style="color:rgba(255,255,255,0.6);"><i class="fa-solid fa-stopwatch me-2" style="color:var(--accent-cyan);"></i>Wave Period</span>
                    <span><span style="color:#5ddb8a;">≥ 4 s</span> = Acceptable</span>
                </div>
                <div style="background:rgba(255,193,7,0.08);border:1px dashed rgba(255,193,7,0.3);border-radius:12px;padding:14px;margin-top:14px;font-size:0.8rem;color:rgba(255,255,255,0.65);">
                    <i class="fa-solid fa-circle-exclamation text-warning me-2"></i>
                    Operations are automatically flagged when thresholds are exceeded. Always use your judgment for final decisions.
                </div>
            </div>
        </div>
    </div>

    <!-- HISTORY LOG -->
    <div class="panel">
        <div class="panel-title" style="margin-bottom:20px;"><i class="fa-solid fa-clock-rotate-left"></i> Recent Sea Data Log</div>
        <?php if (!empty($seaHistory)): ?>
            <div style="overflow-x:auto;">
                <table class="history-table">
                    <thead>
                        <tr>
                            <th>Timestamp</th>
                            <th>Wind Speed</th>
                            <th>Direction</th>
                            <th>Wave Height</th>
                            <th>Wave Period</th>
                            <th>Status</th>
                            <th>Updated By</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($seaHistory as $h): ?>
                        <?php
                            $dotClass = match($h['safety_status'] ?? 'safe') {
                                'safe'     => 'dot-safe',
                                'moderate' => 'dot-moderate',
                                'unsafe'   => 'dot-unsafe',
                                default    => 'dot-safe'
                            };
                            $dot = match($h['safety_status'] ?? 'safe') { 'safe'=>'🟢','moderate'=>'🟡','unsafe'=>'🔴',default=>'🟢' };
                        ?>
                        <tr>
                            <td style="color:rgba(255,255,255,0.6);"><?= date('M d, Y h:i A', strtotime($h['recorded_at'] ?? $h['created_at'])) ?></td>
                            <td><?= esc($h['wind_speed']) ?> kts</td>
                            <td><?= esc($h['wind_direction'] ?? 'N/A') ?></td>
                            <td><?= esc($h['wave_height']) ?> m</td>
                            <td><?= esc($h['wave_period']) ?> s</td>
                            <td><span class="<?= $dotClass ?>"><?= $dot ?> <?= ucfirst($h['safety_status'] ?? 'safe') ?></span></td>
                            <td style="color:rgba(255,255,255,0.5);"><?= esc($h['admin_username'] ?? 'System') ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p style="text-align:center;opacity:0.4;font-size:0.85rem;">No sea data history yet.</p>
        <?php endif; ?>
    </div>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>