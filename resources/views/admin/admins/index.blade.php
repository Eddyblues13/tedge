@include('admin.header')

<div class="main-content">
    <div class="container-fluid">

        {{-- Toast Alerts --}}
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}<button type="button"
                class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">{{ session('error') }}<button type="button"
                class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif

        {{-- Page Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <div>
                <h4 class="admin-page-title mb-1">Manage Administrators</h4>
                <p class="admin-page-subtitle mb-0">Add, edit and manage admin accounts</p>
            </div>
            <button class="btn btn-admin-primary" onclick="openCreateModal()">
                <i class="bi bi-person-plus-fill me-1"></i> New Admin
            </button>
        </div>

        {{-- Stats Row --}}
        <div class="row g-3 mb-4">
            <div class="col-sm-6 col-lg-3">
                <div class="admin-stat-card">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon" style="background:rgba(99,102,241,.12);color:#6366f1;">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <div>
                            <div class="stat-label">Total Admins</div>
                            <div class="stat-value">{{ $totalAdmins }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="admin-stat-card">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon" style="background:rgba(16,185,129,.12);color:#10b981;">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                        <div>
                            <div class="stat-label">Active</div>
                            <div class="stat-value">{{ $activeAdmins }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="admin-stat-card">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon" style="background:rgba(234,179,8,.12);color:#eab308;">
                            <i class="bi bi-shield-fill-check"></i>
                        </div>
                        <div>
                            <div class="stat-label">Super Admins</div>
                            <div class="stat-value">{{ $superAdmins }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="admin-stat-card">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon" style="background:rgba(59,130,246,.12);color:#3b82f6;">
                            <i class="bi bi-person-fill-gear"></i>
                        </div>
                        <div>
                            <div class="stat-label">Regular Admins</div>
                            <div class="stat-value">{{ $regularAdmins }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Admins Table --}}
        <div class="admin-card">
            <div class="admin-table">
                <table class="table" id="AdminsTable" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Admin</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Last Login</th>
                            <th style="width:120px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($admins as $i => $admin)
                        <tr data-id="{{ $admin->id }}">
                            <td>{{ $i + 1 }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="adm-avatar">{{ strtoupper(substr($admin->name, 0, 1)) }}</div>
                                    <div>
                                        <div class="fw-semibold" style="color:var(--heading-color);">{{ $admin->name }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td style="color:var(--text-color);">{{ $admin->email }}</td>
                            <td style="color:var(--text-color);">{{ $admin->phone ?? '—' }}</td>
                            <td>
                                @if($admin->role === 'super_admin')
                                <span class="adm-role-badge adm-role-super"><i
                                        class="bi bi-shield-fill-check me-1"></i>Super Admin</span>
                                @else
                                <span class="adm-role-badge adm-role-regular"><i
                                        class="bi bi-person-fill-gear me-1"></i>Admin</span>
                                @endif
                            </td>
                            <td>
                                @if($admin->is_active)
                                <span class="admin-badge admin-badge-success">Active</span>
                                @else
                                <span class="admin-badge admin-badge-danger">Inactive</span>
                                @endif
                            </td>
                            <td style="color:var(--text-color);font-size:13px;">{{ $admin->created_at->format('M d, Y')
                                }}</td>
                            <td style="color:var(--text-color);font-size:13px;">{{ $admin->last_login_at ?
                                $admin->last_login_at->diffForHumans() : 'Never' }}</td>
                            <td>
                                <div class="d-flex gap-1 flex-nowrap">
                                    <button class="btn btn-sm adm-action-btn adm-edit-btn"
                                        onclick="openEditModal({{ json_encode($admin) }})" title="Edit">
                                        <i class="bi bi-pencil-fill"></i>
                                    </button>
                                    <button class="btn btn-sm adm-action-btn adm-key-btn"
                                        onclick="openResetPasswordModal({{ $admin->id }}, '{{ addslashes($admin->name) }}')"
                                        title="Reset Password">
                                        <i class="bi bi-key-fill"></i>
                                    </button>
                                    @if($admin->id !== Auth::guard('admin')->user()->id)
                                    <button
                                        class="btn btn-sm adm-action-btn {{ $admin->is_active ? 'adm-deactivate-btn' : 'adm-activate-btn' }}"
                                        onclick="toggleStatus({{ $admin->id }})"
                                        title="{{ $admin->is_active ? 'Deactivate' : 'Activate' }}">
                                        <i
                                            class="bi bi-{{ $admin->is_active ? 'pause-circle-fill' : 'play-circle-fill' }}"></i>
                                    </button>
                                    <button class="btn btn-sm adm-action-btn adm-delete-btn"
                                        onclick="openDeleteModal({{ $admin->id }}, '{{ addslashes($admin->name) }}')"
                                        title="Delete">
                                        <i class="bi bi-trash3-fill"></i>
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

{{-- Create / Edit Admin Modal --}}
<div class="modal fade" id="adminModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content"
            style="background:var(--card-bg);border:1px solid var(--border-color);border-radius:16px;">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" id="adminModalTitle" style="color:var(--heading-color);"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body pt-3">
                <form id="adminForm">
                    @csrf
                    <input type="hidden" id="admin_id" name="admin_id">

                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="color:var(--text-color);font-size:13px;">Full
                            Name</label>
                        <input type="text" class="form-control admin-form-control" id="admin_name" name="name"
                            placeholder="Enter full name" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="color:var(--text-color);font-size:13px;">Email
                            Address</label>
                        <input type="email" class="form-control admin-form-control" id="admin_email" name="email"
                            placeholder="admin@example.com" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="color:var(--text-color);font-size:13px;">Phone
                            Number</label>
                        <input type="text" class="form-control admin-form-control" id="admin_phone" name="phone"
                            placeholder="+1 234 567 8900">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold"
                            style="color:var(--text-color);font-size:13px;">Role</label>
                        <select class="form-select admin-form-control" id="admin_role" name="role" required>
                            <option value="admin">Admin</option>
                            <option value="super_admin">Super Admin</option>
                        </select>
                    </div>

                    <div id="passwordFields">
                        <div class="mb-3">
                            <label class="form-label fw-semibold"
                                style="color:var(--text-color);font-size:13px;">Password</label>
                            <div class="position-relative">
                                <input type="password" class="form-control admin-form-control pe-5" id="admin_password"
                                    name="password" placeholder="Min 8 characters">
                                <button type="button" class="btn adm-eye-btn"
                                    onclick="togglePasswordVisibility('admin_password', this)">
                                    <i class="bi bi-eye-slash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold"
                                style="color:var(--text-color);font-size:13px;">Confirm Password</label>
                            <div class="position-relative">
                                <input type="password" class="form-control admin-form-control pe-5"
                                    id="admin_password_confirmation" name="password_confirmation"
                                    placeholder="Re-enter password">
                                <button type="button" class="btn adm-eye-btn"
                                    onclick="togglePasswordVisibility('admin_password_confirmation', this)">
                                    <i class="bi bi-eye-slash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn px-4" data-bs-dismiss="modal"
                    style="color:var(--text-color);border:1px solid var(--border-color);border-radius:10px;">Cancel</button>
                <button type="button" class="btn btn-admin-primary px-4" id="adminSaveBtn" onclick="saveAdmin()">
                    <i class="bi bi-check-lg me-1"></i> <span id="adminSaveBtnText">Create Admin</span>
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Reset Password Modal --}}
<div class="modal fade" id="resetPasswordModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content"
            style="background:var(--card-bg);border:1px solid var(--border-color);border-radius:16px;">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" style="color:var(--heading-color);">Reset Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body pt-3">
                <p style="color:var(--text-color);font-size:13px;">Set new password for <strong
                        id="resetAdminName"></strong></p>
                <input type="hidden" id="reset_admin_id">
                <div class="mb-3">
                    <label class="form-label fw-semibold" style="color:var(--text-color);font-size:13px;">New
                        Password</label>
                    <div class="position-relative">
                        <input type="password" class="form-control admin-form-control pe-5" id="reset_password"
                            placeholder="Min 8 characters">
                        <button type="button" class="btn adm-eye-btn"
                            onclick="togglePasswordVisibility('reset_password', this)">
                            <i class="bi bi-eye-slash"></i>
                        </button>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold" style="color:var(--text-color);font-size:13px;">Confirm
                        Password</label>
                    <div class="position-relative">
                        <input type="password" class="form-control admin-form-control pe-5"
                            id="reset_password_confirmation" placeholder="Re-enter password">
                        <button type="button" class="btn adm-eye-btn"
                            onclick="togglePasswordVisibility('reset_password_confirmation', this)">
                            <i class="bi bi-eye-slash"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn px-3" data-bs-dismiss="modal"
                    style="color:var(--text-color);border:1px solid var(--border-color);border-radius:10px;">Cancel</button>
                <button type="button" class="btn btn-admin-primary px-3" onclick="resetAdminPassword()">
                    <i class="bi bi-key-fill me-1"></i> Reset
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Delete Confirmation Modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content"
            style="background:var(--card-bg);border:1px solid var(--border-color);border-radius:16px;">
            <div class="modal-body text-center py-4">
                <div
                    style="width:56px;height:56px;border-radius:50%;background:rgba(239,68,68,.12);display:inline-flex;align-items:center;justify-content:center;margin-bottom:16px;">
                    <i class="bi bi-exclamation-triangle-fill" style="font-size:24px;color:#ef4444;"></i>
                </div>
                <h6 class="fw-bold mb-2" style="color:var(--heading-color);">Delete Administrator?</h6>
                <p class="mb-0" style="color:var(--text-color);font-size:13px;">Are you sure you want to delete <strong
                        id="deleteAdminName"></strong>? This action cannot be undone.</p>
                <input type="hidden" id="delete_admin_id">
            </div>
            <div class="modal-footer border-0 pt-0 justify-content-center">
                <button type="button" class="btn px-4" data-bs-dismiss="modal"
                    style="color:var(--text-color);border:1px solid var(--border-color);border-radius:10px;">Cancel</button>
                <button type="button" class="btn px-4" onclick="deleteAdmin()"
                    style="background:#ef4444;color:#fff;border-radius:10px;font-weight:600;">
                    <i class="bi bi-trash3 me-1"></i>Delete
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .adm-avatar {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--accent-color), #8b5cf6);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 15px;
        flex-shrink: 0;
    }

    .adm-role-badge {
        display: inline-flex;
        align-items: center;
        padding: 4px 12px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
    }

    .adm-role-super {
        background: rgba(234, 179, 8, .12);
        color: #eab308;
    }

    .adm-role-regular {
        background: color-mix(in srgb, var(--accent-color) 12%, transparent);
        color: var(--accent-color);
    }

    .adm-action-btn {
        width: 30px;
        height: 30px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        font-size: 13px;
        transition: all .2s;
        border: none;
    }

    .adm-edit-btn {
        background: color-mix(in srgb, var(--accent-color) 12%, transparent);
        color: var(--accent-color);
    }

    .adm-edit-btn:hover {
        background: var(--accent-color);
        color: #fff;
    }

    .adm-key-btn {
        background: rgba(234, 179, 8, .12);
        color: #eab308;
    }

    .adm-key-btn:hover {
        background: #eab308;
        color: #fff;
    }

    .adm-activate-btn {
        background: rgba(16, 185, 129, .12);
        color: #10b981;
    }

    .adm-activate-btn:hover {
        background: #10b981;
        color: #fff;
    }

    .adm-deactivate-btn {
        background: rgba(245, 158, 11, .12);
        color: #f59e0b;
    }

    .adm-deactivate-btn:hover {
        background: #f59e0b;
        color: #fff;
    }

    .adm-delete-btn {
        background: rgba(239, 68, 68, .12);
        color: #ef4444;
    }

    .adm-delete-btn:hover {
        background: #ef4444;
        color: #fff;
    }

    .adm-eye-btn {
        position: absolute;
        right: 8px;
        top: 50%;
        transform: translateY(-50%);
        border: none;
        background: transparent;
        color: var(--text-color);
        padding: 4px 8px;
        font-size: 16px;
        z-index: 5;
    }

    .adm-eye-btn:hover {
        color: var(--accent-color);
    }
</style>

@include('admin.footer')

<script>
    $(document).ready(function() {
    $('#AdminsTable').DataTable({
        order: [[6, 'desc']],
        pageLength: 25,
        dom: '<"d-flex justify-content-between align-items-center mb-3"l>rt<"d-flex justify-content-between align-items-center mt-3"ip>',
        language: {
            lengthMenu: 'Show _MENU_',
            info: 'Showing _START_ to _END_ of _TOTAL_',
            paginate: { previous: '<i class="bi bi-chevron-left"></i>', next: '<i class="bi bi-chevron-right"></i>' }
        },
        columnDefs: [{ orderable: false, targets: [8] }]
    });
});

const adminModal = new bootstrap.Modal(document.getElementById('adminModal'));
const resetPasswordModal = new bootstrap.Modal(document.getElementById('resetPasswordModal'));
const deleteModalInstance = new bootstrap.Modal(document.getElementById('deleteModal'));

function togglePasswordVisibility(inputId, btn) {
    const input = document.getElementById(inputId);
    const icon = btn.querySelector('i');
    if (input.type === 'password') {
        input.type = 'text';
        icon.className = 'bi bi-eye';
    } else {
        input.type = 'password';
        icon.className = 'bi bi-eye-slash';
    }
}

function openCreateModal() {
    document.getElementById('adminModalTitle').textContent = 'Add New Administrator';
    document.getElementById('adminSaveBtnText').textContent = 'Create Admin';
    document.getElementById('adminForm').reset();
    document.getElementById('admin_id').value = '';
    document.getElementById('passwordFields').style.display = 'block';
    document.getElementById('admin_password').setAttribute('required', true);
    document.getElementById('admin_password_confirmation').setAttribute('required', true);
    adminModal.show();
}

function openEditModal(admin) {
    document.getElementById('adminModalTitle').textContent = 'Edit Administrator';
    document.getElementById('adminSaveBtnText').textContent = 'Save Changes';
    document.getElementById('admin_id').value = admin.id;
    document.getElementById('admin_name').value = admin.name;
    document.getElementById('admin_email').value = admin.email;
    document.getElementById('admin_phone').value = admin.phone || '';
    document.getElementById('admin_role').value = admin.role;
    document.getElementById('passwordFields').style.display = 'none';
    document.getElementById('admin_password').removeAttribute('required');
    document.getElementById('admin_password_confirmation').removeAttribute('required');
    adminModal.show();
}

function openResetPasswordModal(id, name) {
    document.getElementById('reset_admin_id').value = id;
    document.getElementById('resetAdminName').textContent = name;
    document.getElementById('reset_password').value = '';
    document.getElementById('reset_password_confirmation').value = '';
    resetPasswordModal.show();
}

function openDeleteModal(id, name) {
    document.getElementById('delete_admin_id').value = id;
    document.getElementById('deleteAdminName').textContent = name;
    deleteModalInstance.show();
}

function saveAdmin() {
    const id = document.getElementById('admin_id').value;
    const isEdit = !!id;

    const data = {
        _token: '{{ csrf_token() }}',
        name: document.getElementById('admin_name').value,
        email: document.getElementById('admin_email').value,
        phone: document.getElementById('admin_phone').value,
        role: document.getElementById('admin_role').value,
    };

    if (!isEdit) {
        data.password = document.getElementById('admin_password').value;
        data.password_confirmation = document.getElementById('admin_password_confirmation').value;
    }

    const url = isEdit ? `/admin/administrators/${id}` : '/admin/administrators';
    const method = isEdit ? 'PUT' : 'POST';

    fetch(url, {
        method: method,
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
        body: JSON.stringify(data)
    })
    .then(r => r.json())
    .then(res => {
        if (res.status === 'success') {
            adminModal.hide();
            toastr.success(res.message);
            setTimeout(() => location.reload(), 1000);
        } else {
            toastr.error(res.message);
        }
    })
    .catch(() => toastr.error('Something went wrong.'));
}

function resetAdminPassword() {
    const id = document.getElementById('reset_admin_id').value;

    fetch(`/admin/administrators/${id}/reset-password`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
        body: JSON.stringify({
            _token: '{{ csrf_token() }}',
            password: document.getElementById('reset_password').value,
            password_confirmation: document.getElementById('reset_password_confirmation').value,
        })
    })
    .then(r => r.json())
    .then(res => {
        if (res.status === 'success') {
            resetPasswordModal.hide();
            toastr.success(res.message);
        } else {
            toastr.error(res.message);
        }
    })
    .catch(() => toastr.error('Something went wrong.'));
}

function toggleStatus(id) {
    fetch(`/admin/administrators/${id}/toggle-status`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
        body: JSON.stringify({ _token: '{{ csrf_token() }}' })
    })
    .then(r => r.json())
    .then(res => {
        if (res.status === 'success') {
            toastr.success(res.message);
            setTimeout(() => location.reload(), 1000);
        } else {
            toastr.error(res.message);
        }
    })
    .catch(() => toastr.error('Something went wrong.'));
}

function deleteAdmin() {
    const id = document.getElementById('delete_admin_id').value;

    fetch(`/admin/administrators/${id}`, {
        method: 'DELETE',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
        body: JSON.stringify({ _token: '{{ csrf_token() }}' })
    })
    .then(r => r.json())
    .then(res => {
        if (res.status === 'success') {
            deleteModalInstance.hide();
            toastr.success(res.message);
            setTimeout(() => location.reload(), 1000);
        } else {
            toastr.error(res.message);
        }
    })
    .catch(() => toastr.error('Something went wrong.'));
}
</script>