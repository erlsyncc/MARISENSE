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
        body { font-family: 'Poppins', sans-serif; background: linear-gradient(180deg, var(--ocean-blue) 0%, var(--deep-blue) 60%); background-attachment: fixed; color: var(--soft-white); margin: 0; min-height: 100vh; }
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
        .layout-row { display: grid; grid-template-columns: 1fr 1.5fr; gap: 22px; align-items: start; }
        .panel { background: rgba(255,255,255,0.07); backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.1); border-radius: 22px; padding: 26px; }
        .panel-title { font-size: 0.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: rgba(255,255,255,0.55); margin-bottom: 20px; display: flex; align-items: center; gap: 8px; }
        .panel-title i { color: var(--accent-cyan); }
        /* Activity cards list */
        .act-list { display: flex; flex-direction: column; gap: 11px; }
        .act-row { background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 16px; padding: 14px 18px; display: flex; align-items: center; gap: 14px; transition: 0.22s; }
        .act-row:hover { border-color: rgba(72,202,228,0.3); background: rgba(255,255,255,0.08); }
        .act-img { width: 52px; height: 52px; border-radius: 12px; object-fit: cover; flex-shrink: 0; background: rgba(72,202,228,0.1); display: flex; align-items: center; justify-content: center; color: var(--accent-cyan); font-size: 1.3rem; overflow: hidden; }
        .act-img img { width: 100%; height: 100%; object-fit: cover; border-radius: 12px; }
        .act-info { flex: 1; min-width: 0; }
        .act-name { font-size: 0.92rem; font-weight: 700; color: white; }
        .act-price { font-size: 0.8rem; color: var(--accent-cyan); font-weight: 600; }
        .act-meta { font-size: 0.72rem; color: rgba(255,255,255,0.45); }
        .act-actions { display: flex; gap: 6px; flex-shrink: 0; }
        .btn-edit { background: rgba(72,202,228,0.12); color: var(--accent-cyan); border: 1px solid rgba(72,202,228,0.3); border-radius: 8px; padding: 5px 11px; font-size: 0.76rem; cursor: pointer; transition: 0.2s; }
        .btn-edit:hover { background: rgba(72,202,228,0.25); }
        .btn-del { background: rgba(220,53,69,0.1); color: #ff8888; border: 1px solid rgba(220,53,69,0.25); border-radius: 8px; padding: 5px 11px; font-size: 0.76rem; cursor: pointer; transition: 0.2s; }
        .btn-del:hover { background: #dc3545; color: white; }
        .status-active { background: rgba(40,167,69,0.12); color: #5ddb8a; border: 1px solid rgba(40,167,69,0.35); padding: 3px 10px; border-radius: 50px; font-size: 0.68rem; font-weight: 700; }
        .status-paused { background: rgba(255,193,7,0.12); color: #ffc107; border: 1px solid rgba(255,193,7,0.35); padding: 3px 10px; border-radius: 50px; font-size: 0.68rem; font-weight: 700; }
        /* Form */
        .field-label { display: block; font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: var(--accent-cyan); margin-bottom: 7px; }
        .form-control-wave { width: 100%; background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.15); border-radius: 12px; color: white; padding: 11px 14px; font-size: 0.88rem; font-family: 'Poppins',sans-serif; transition: 0.3s; outline: none; }
        .form-control-wave:focus { border-color: rgba(72,202,228,0.6); background: rgba(255,255,255,0.1); }
        .form-control-wave::placeholder { color: rgba(255,255,255,0.3); }
        .form-select-wave { width: 100%; background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.15); border-radius: 12px; color: white; padding: 11px 14px; font-size: 0.88rem; font-family: 'Poppins',sans-serif; outline: none; -webkit-appearance: none; }
        .form-select-wave option { background: #073d52; }
        textarea.form-control-wave { resize: vertical; min-height: 80px; }
        .form-row-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
        .mb-field { margin-bottom: 14px; }
        .btn-save { background: var(--accent-cyan); color: var(--deep-blue); font-weight: 700; border: none; border-radius: 12px; padding: 12px 28px; font-size: 0.9rem; cursor: pointer; transition: 0.3s; }
        .btn-save:hover { background: white; transform: translateY(-2px); }
        .btn-reset { background: rgba(255,255,255,0.08); color: rgba(255,255,255,0.6); border: 1px solid rgba(255,255,255,0.15); border-radius: 12px; padding: 11px 20px; font-size: 0.88rem; cursor: pointer; transition: 0.2s; margin-left: 8px; }
        .btn-reset:hover { background: rgba(255,255,255,0.14); color: white; }
        .editing-banner { background: rgba(72,202,228,0.1); border: 1px solid rgba(72,202,228,0.3); border-radius: 12px; padding: 10px 16px; font-size: 0.82rem; color: var(--accent-cyan); margin-bottom: 18px; display: none; }
        .editing-banner.show { display: flex; align-items: center; gap: 8px; }
        /* Image preview */
        .img-preview { width: 80px; height: 60px; border-radius: 10px; object-fit: cover; border: 1px solid rgba(255,255,255,0.15); display: none; }
        .img-preview.show { display: block; }
        /* Multi-image upload hints */
        .img-note { font-size: 0.72rem; color: rgba(255,255,255,0.4); margin-top: 4px; }
        .empty-state { text-align: center; padding: 40px 20px; opacity: 0.5; }
        .empty-state i { font-size: 2.2rem; display: block; margin-bottom: 10px; }
        /* Animation para sa alon icon */
        @keyframes wave-motion {0% { transform: translateY(0); }50% { transform: translateY(-3px); }100% { transform: translateY(0); }}
        .brand-icon i { animation: wave-motion 3s ease-in-out infinite;display: inline-block;}
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
    <a href="<?= base_url('admin/users') ?>" class="nav-item"><i class="fa-solid fa-users"></i> Users</a>
    <div class="sidebar-section-label">Operations</div>
    <a href="<?= base_url('admin/sea-conditions') ?>" class="nav-item"><i class="fa-solid fa-tower-broadcast"></i> Sea Conditions</a>
    <a href="<?= base_url('admin/reviews') ?>" class="nav-item"><i class="fa-solid fa-star"></i> Reviews</a>
    <div class="sidebar-section-label">System</div>
    <a href="<?= base_url('admin/activities') ?>" class="nav-item active"><i class="fa-solid fa-person-swimming"></i> Activities</a>
    <a href="<?= base_url('admin/sales') ?>" class="nav-item"><i class="fa-solid fa-peso-sign"></i> Sales</a>
    <div class="sidebar-footer">
        <a href="<?= base_url('logout') ?>" class="logout-btn"><i class="fa-solid fa-power-off"></i> Logout</a>
    </div>
</aside>

<main class="main-content">
    <div class="page-topbar">
        <div>
            <h1 class="page-title">Activities Management</h1>
            <p class="page-subtitle">Add, edit, or remove water activities. Changes reflect instantly on the user side.</p>
        </div>
        <span class="admin-pill"><i class="fa-solid fa-person-swimming me-2"></i>ACTIVITIES</span>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success rounded-4 mb-3"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger rounded-4 mb-3"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <div class="layout-row">

        <!-- LEFT: Activity List -->
        <div class="panel">
            <div class="panel-title"><i class="fa-solid fa-list"></i> Current Activities (<?= count($activities ?? []) ?>)</div>
            <div class="act-list">
                <?php if (!empty($activities)): ?>
                    <?php foreach ($activities as $act): ?>
                        <div class="act-row">
                            <div class="act-img">
                                <?php if (!empty($act['image'])): ?>
                                    <img src="<?= base_url('images/'.$act['image']) ?>" alt="<?= esc($act['name']) ?>" onerror="this.style.display='none'">
                                <?php else: ?>
                                    <i class="fa-solid fa-person-swimming"></i>
                                <?php endif; ?>
                            </div>
                            <div class="act-info">
                                <div class="act-name"><?= esc($act['name']) ?></div>
                                <div class="act-price">₱<?= number_format($act['price'], 2) ?></div>
                                <div class="act-meta"><?= esc($act['duration'] ?? '—') ?> mins · <?= esc($act['max_riders'] ?? '—') ?> · <?= esc($act['difficulty']) ?></div>
                            </div>
                            <div style="display:flex;flex-direction:column;align-items:flex-end;gap:6px;">
                                <span class="<?= $act['status'] === 'active' ? 'status-active' : 'status-paused' ?>"><?= ucfirst($act['status']) ?></span>
                                <div class="act-actions">
                                    <button class="btn-edit" onclick="editActivity(<?= htmlspecialchars(json_encode($act), ENT_QUOTES) ?>)">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                    <button class="btn-del delete-act-btn" data-id="<?= $act['id'] ?>" data-name="<?= esc($act['name']) ?>">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="empty-state">
                        <i class="fa-solid fa-person-swimming"></i>
                        <p>No activities yet. Add one using the form.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- RIGHT: Add/Edit Form -->
        <div class="panel">
            <div class="panel-title"><i class="fa-solid fa-plus-circle"></i> <span id="form-panel-title">Add New Activity</span></div>

            <div class="editing-banner" id="editing-banner">
                <i class="fa-solid fa-pen"></i> <span id="editing-name">Editing…</span>
                <button type="button" onclick="resetForm()" style="margin-left:auto;background:rgba(255,255,255,0.1);border:1px solid rgba(255,255,255,0.2);color:white;border-radius:50px;padding:3px 12px;font-size:0.72rem;cursor:pointer;">✕ Cancel Edit</button>
            </div>

            <form action="<?= base_url('admin/activities/save') ?>" method="POST" enctype="multipart/form-data" id="activityForm">
                <?= csrf_field() ?>
                <input type="hidden" name="activity_id" id="activity_id" value="">

                <div class="mb-field">
                    <label class="field-label">Activity Name</label>
                    <input type="text" name="name" id="f_name" class="form-control-wave" placeholder="e.g. Jet Ski" required maxlength="100">
                </div>

                <div class="mb-field">
                    <label class="field-label">Description</label>
                    <textarea name="description" id="f_description" class="form-control-wave" placeholder="Describe the activity — what to expect, who it's for…"></textarea>
                </div>

                <div class="form-row-2">
                    <div class="mb-field">
                        <label class="field-label">Price (₱)</label>
                        <input type="number" name="price" id="f_price" class="form-control-wave" placeholder="e.g. 2500" required min="0" step="0.01">
                    </div>
                    <div class="mb-field">
                        <label class="field-label">Duration (minutes)</label>
                        <input type="number" name="duration" id="f_duration" class="form-control-wave" placeholder="e.g. 15">
                    </div>
                </div>

                <div class="form-row-2">
                    <div class="mb-field">
                        <label class="field-label">Max Riders</label>
                        <input type="text" name="max_riders" id="f_max_riders" class="form-control-wave" placeholder="e.g. 1-2 persons">
                    </div>
                    <div class="mb-field">
                        <label class="field-label">Difficulty</label>
                        <select name="difficulty" id="f_difficulty" class="form-select-wave">
                            <option value="Easy">Easy</option>
                            <option value="Moderate" selected>Moderate</option>
                            <option value="Hard">Hard</option>
                        </select>
                    </div>
                </div>

                <div class="form-row-2">
                    <div class="mb-field">
                        <label class="field-label">Status</label>
                        <select name="status" id="f_status" class="form-select-wave">
                            <option value="active">Active (visible to users)</option>
                            <option value="paused">Paused (hidden)</option>
                        </select>
                    </div>
                    <div class="mb-field">
                        <label class="field-label">Price Type</label>
                        <select name="price_type" id="f_price_type" class="form-select-wave">
                            <option value="flat">Flat (per session)</option>
                            <option value="per_person">Per Person</option>
                        </select>
                    </div>
                </div>

                <div class="mb-field">
                    <label class="field-label">Activity Images <span style="font-weight:400;text-transform:none;opacity:0.6;">(up to 4 photos)</span></label>
                    <input type="file" name="images[]" id="f_images" accept="image/*" multiple class="form-control form-control-sm" style="background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.15);color:white;border-radius:12px;padding:10px;" onchange="previewImages(this)">
                    <p class="img-note">Images will appear in the user Activities page as a gallery. Upload up to 4 images.</p>
                    <div id="img-preview-row" style="display:flex;gap:8px;margin-top:8px;flex-wrap:wrap;"></div>
                    <img id="current-img" class="img-preview" src="" alt="Current Image">
                </div>

                <div style="display:flex;align-items:center;">
                    <button type="submit" class="btn-save">
                        <i class="fa-solid fa-floppy-disk me-2"></i> <span id="save-btn-text">Save Activity</span>
                    </button>
                    <button type="button" class="btn-reset" onclick="resetForm()">
                        <i class="fa-solid fa-rotate-left me-1"></i> Reset
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete forms (hidden) -->
    <?php if (!empty($activities)): ?>
        <?php foreach ($activities as $act): ?>
        <form id="del-form-<?= $act['id'] ?>" action="<?= base_url('admin/activities/delete') ?>" method="POST" style="display:none;">
            <?= csrf_field() ?>
            <input type="hidden" name="activity_id" value="<?= $act['id'] ?>">
        </form>
        <?php endforeach; ?>
    <?php endif; ?>

</main>

<script>
function editActivity(act) {
    document.getElementById('activity_id').value = act.id;
    document.getElementById('f_name').value        = act.name || '';
    document.getElementById('f_description').value = act.description || '';
    document.getElementById('f_price').value        = act.price || '';
    document.getElementById('f_duration').value     = act.duration || '';
    document.getElementById('f_max_riders').value   = act.max_riders || '';
    document.getElementById('f_difficulty').value   = act.difficulty || 'Moderate';
    document.getElementById('f_status').value       = act.status || 'active';

    // Show current image if exists
    var imgEl = document.getElementById('current-img');
    if (act.image) {
        imgEl.src = '<?= base_url('images/') ?>' + act.image;
        imgEl.classList.add('show');
    } else {
        imgEl.classList.remove('show');
    }

    document.getElementById('form-panel-title').textContent = 'Edit Activity';
    document.getElementById('save-btn-text').textContent = 'Update Activity';
    var banner = document.getElementById('editing-banner');
    document.getElementById('editing-name').textContent = 'Editing: ' + act.name;
    banner.classList.add('show');

    // Scroll to form
    document.querySelector('.layout-row').scrollIntoView({ behavior: 'smooth', block: 'start' });
}

function resetForm() {
    document.getElementById('activityForm').reset();
    document.getElementById('activity_id').value = '';
    document.getElementById('form-panel-title').textContent = 'Add New Activity';
    document.getElementById('save-btn-text').textContent = 'Save Activity';
    document.getElementById('editing-banner').classList.remove('show');
    document.getElementById('current-img').classList.remove('show');
    document.getElementById('img-preview-row').innerHTML = '';
}

function previewImages(input) {
    var row = document.getElementById('img-preview-row');
    row.innerHTML = '';
    var files = Array.from(input.files).slice(0, 4);
    files.forEach(function(file) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var img = document.createElement('img');
            img.src = e.target.result;
            img.style.cssText = 'width:70px;height:55px;border-radius:10px;object-fit:cover;border:1px solid rgba(255,255,255,0.15);';
            row.appendChild(img);
        };
        reader.readAsDataURL(file);
    });
}

// Delete with SweetAlert
document.querySelectorAll('.delete-act-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
        var id   = this.dataset.id;
        var name = this.dataset.name;
        Swal.fire({
            title: 'Delete "' + name + '"?',
            text: 'This activity will be removed from the user-facing activities page.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!',
            background: '#fff',
            color: '#052c39',
            backdrop: 'rgba(5,44,57,0.6)',
        }).then(function(result) {
            if (result.isConfirmed) {
                document.getElementById('del-form-' + id).submit();
            }
        });
    });
});
</script>
</body>
</html>