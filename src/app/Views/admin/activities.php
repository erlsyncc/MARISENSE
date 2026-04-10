<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activities | Waves Admin</title>
    <link rel="stylesheet" href="<?= base_url('bootstrap5/css/bootstrap.min.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

        .layout-row { display: grid; grid-template-columns: 1fr 1.4fr; gap: 24px; }
        .panel { background: rgba(255,255,255,0.07); backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.1); border-radius: 24px; padding: 28px; }
        .panel-title { font-size: 0.82rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: rgba(255,255,255,0.6); margin-bottom: 22px; display: flex; align-items: center; gap: 8px; }
        .panel-title i { color: var(--accent-cyan); }

        /* Activity cards */
        .activity-list { display: flex; flex-direction: column; gap: 12px; }
        .activity-row { background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 16px; padding: 16px 20px; display: flex; align-items: center; gap: 14px; transition: 0.25s; }
        .activity-row:hover { border-color: rgba(72,202,228,0.3); background: rgba(255,255,255,0.08); }
        .act-img { width: 56px; height: 56px; border-radius: 12px; background-size: cover; background-position: center; flex-shrink: 0; }
        .act-name { font-size: 0.95rem; font-weight: 700; color: white; }
        .act-price { font-size: 0.82rem; color: var(--accent-cyan); font-weight: 600; }
        .act-status { margin-left: auto; }
        .status-active { background: rgba(40,167,69,0.12); color: #5ddb8a; border: 1px solid rgba(40,167,69,0.4); padding: 4px 12px; border-radius: 50px; font-size: 0.72rem; font-weight: 700; }
        .status-paused { background: rgba(255,193,7,0.12); color: #ffc107; border: 1px solid rgba(255,193,7,0.4); padding: 4px 12px; border-radius: 50px; font-size: 0.72rem; font-weight: 700; }

        /* Add/Edit form */
        .field-label { display: block; font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: var(--accent-cyan); margin-bottom: 8px; }
        .form-control-wave { width: 100%; background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.15); border-radius: 12px; color: white; padding: 12px 16px; font-size: 0.9rem; font-family: 'Poppins', sans-serif; transition: border-color 0.3s; outline: none; }
        .form-control-wave:focus { border-color: rgba(72,202,228,0.6); background: rgba(255,255,255,0.1); }
        .form-control-wave::placeholder { color: rgba(255,255,255,0.3); }
        .form-select-wave { width: 100%; background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.15); border-radius: 12px; color: white; padding: 12px 16px; font-size: 0.9rem; font-family: 'Poppins', sans-serif; outline: none; -webkit-appearance: none; }
        .form-select-wave option { background: #073d52; }
        .form-row-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .mb-field { margin-bottom: 16px; }
        .btn-save { background: var(--accent-cyan); color: var(--deep-blue); font-weight: 700; border: none; border-radius: 12px; padding: 12px 32px; font-size: 0.9rem; cursor: pointer; transition: 0.3s; }
        .btn-save:hover { background: white; transform: translateY(-2px); }
        /* Para consistent sa review delete button */
        .btn-delete-activity { background: rgba(220, 53, 69, 0.1); color: #ff8888; border: 1px solid rgba(220, 53, 69, 0.25); border-radius: 8px; padding: 6px 10px; font-size: 0.85rem; cursor: pointer; transition: 0.2s; text-decoration: none;display: inline-flex;align-items: center;justify-content: center;}
        .btn-delete-activity:hover { background: #dc3545; color: white; transform: translateY(-1px);box-shadow: 0 4px 12px rgba(220, 53, 69, 0.2);}
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
    <a href="<?= base_url('admin/reviews') ?>" class="nav-item"><i class="fa-solid fa-star"></i> Reviews</a>
    <div class="sidebar-section-label">System</div>
    <a href="<?= base_url('admin/activities') ?>" class="nav-item active"><i class="fa-solid fa-person-swimming"></i> Activities</a>
    <div class="sidebar-footer">
        <a href="<?= base_url('logout') ?>" class="logout-btn"><i class="fa-solid fa-power-off"></i> Logout</a>
    </div>
</aside>

<main class="main-content">
    <div class="page-topbar">
        <div>
            <h1 class="page-title">Activities</h1>
            <p class="page-subtitle">Manage water sports offerings, pricing, and availability.</p>
        </div>
        <span class="admin-pill"><i class="fa-solid fa-person-swimming me-2"></i>ACTIVITIES</span>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success rounded-4 mb-3"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <div class="layout-row">

        <!-- ACTIVITY LIST -->
        <div class="panel">
        <div class="panel-title"><i class="fa-solid fa-list"></i> Current Activities</div>
        <div class="activity-list">
            <?php if (!empty($activities)): ?>
                <?php foreach ($activities as $a): ?>
                    <div class="activity-row">
                        <div class="act-img" style="background-image:url('<?= base_url('images/' . ($a['image'] ?? $a['img'] ?? 'default.jpg')) ?>');"></div>
                        
                        <div>
                            <div class="act-name"><?= esc($a['name']) ?></div>
                            <div class="act-price">₱<?= number_format((float)$a['price'], 0) ?> / session</div>
                        </div>

                        <div class="act-status ms-auto d-flex align-items-center gap-3">
                            <span class="status-<?= esc($a['status']) ?>">
                                <?= ucfirst(esc($a['status'])) ?>
                            </span>

                            <a href="<?= base_url('admin/activities/delete/' . $a['id']) ?>" 
                            class="btn-delete-activity ms-auto delete-btn" 
                            data-name="<?= esc($a['name']) ?>">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="text-center py-4 text-white-50">
                    <i class="fa-solid fa-cloud-sun fa-3x mb-3"></i>
                    <p>No activities found in the database.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

        <!-- ADD/EDIT FORM -->
        <div class="panel">
            <div class="panel-title"><i class="fa-solid fa-plus-circle"></i> Add / Edit Activity</div>
            <form method="POST" action="<?= base_url('admin/activities/save') ?>" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="activity_id" id="activityId" value="">

                <div class="mb-field">
                    <label class="field-label">Activity Name</label>
                    <input type="text" name="name" class="form-control-wave" placeholder="e.g. Jet Ski" required>
                </div>
                <div class="mb-field">
                    <label class="field-label">Description</label>
                    <textarea name="description" class="form-control-wave" rows="2" placeholder="Brief description of the activity..."></textarea>
                </div>
                <div class="form-row-2 mb-field">
                    <div>
                        <label class="field-label">Price (₱)</label>
                        <input type="number" name="price" class="form-control-wave" placeholder="e.g. 2500" required>
                    </div>
                    <div>
                        <label class="field-label">Duration (minutes)</label>
                        <input type="number" name="duration" class="form-control-wave" placeholder="e.g. 15">
                    </div>
                </div>
                <div class="form-row-2 mb-field">
                    <div>
                        <label class="field-label">Max Riders</label>
                        <input type="text" name="max_riders" class="form-control-wave" placeholder="e.g. 1–2 persons">
                    </div>
                    <div>
                        <label class="field-label">Difficulty</label>
                        <select name="difficulty" class="form-select-wave">
                            <option value="Easy">Easy</option>
                            <option value="Moderate" selected>Moderate</option>
                            <option value="Hard">Hard</option>
                        </select>
                    </div>
                </div>
                <div class="form-row-2 mb-field">
                    <div>
                        <label class="field-label">Status</label>
                        <select name="status" class="form-select-wave">
                            <option value="active">Active</option>
                            <option value="paused">Paused</option>
                        </select>
                    </div>
                    <div>
                        <label class="field-label">Upload Image</label>
                        <input type="file" name="image" class="form-control-wave" accept="image/*" style="padding:9px 14px;">
                    </div>
                </div>
                <button type="submit" class="btn-save">
                    <i class="fa-solid fa-floppy-disk me-2"></i> Save Activity
                </button>
            </form>
        </div>

    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // 1. SUCCESS MESSAGE (Pagka-redirect galing sa Controller)
    <?php if (session()->getFlashdata('success')) : ?>
        Swal.fire({
            title: 'Success!',
            text: "<?= session()->getFlashdata('success') ?>",
            icon: 'success',
            iconColor: '#a5dc86',
            confirmButtonText: 'Great!',
            confirmButtonColor: '#0a5a73',
            background: '#ffffff',
            color: '#545454'
        });
    <?php endif; ?>

    // 2. SAVE CONFIRMATION (Kapag clinick ang Save Activity)
    const saveForm = document.querySelector('form[action$="activities/save"]');
    if (saveForm) {
        saveForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            Swal.fire({
                title: 'Save Activity?',
                text: "Do you want to apply these changes to the activity list?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#0a5a73',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, Save it!',
                background: '#ffffff',
                color: '#545454'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    }

    // 3. DELETE CONFIRMATION (Gaya ng dati pero white theme na rin)
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const url = this.getAttribute('href');
            const activityName = this.getAttribute('data-name');

            Swal.fire({
                title: 'Are you sure?',
                text: `You are about to delete "${activityName}". This action cannot be undone!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!',
                background: '#ffffff',
                color: '#545454',
                backdrop: `rgba(5,44,57,0.6)`
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        });
    });
</script>
</body>
</html>