@include('admin.header')

<div class="main-content">
    <div class="container-fluid">

        {{-- Page Header --}}
        <div class="mb-4">
            <h4 class="admin-page-title mb-1">Admin Settings</h4>
            <p class="admin-page-subtitle mb-0">Manage your profile and account security</p>
        </div>

        <div class="row g-4">
            {{-- Profile Card --}}
            <div class="col-lg-4">
                <div class="admin-card text-center h-100">
                    <div class="settings-avatar mx-auto mb-3">
                        {{ strtoupper(substr($admin->name, 0, 1)) }}
                    </div>
                    <h5 class="fw-bold mb-1" style="color:var(--heading-color);">{{ $admin->name }}</h5>
                    <p class="mb-2" style="color:var(--text-color);font-size:13px;">{{ $admin->email }}</p>
                    <span class="settings-role-badge">
                        <i class="bi bi-shield-fill-check me-1"></i>
                        {{ $admin->role === 'super_admin' ? 'Super Admin' : 'Admin' }}
                    </span>
                    <div class="mt-3 pt-3" style="border-top:1px solid var(--border-color);">
                        <div class="d-flex justify-content-between mb-2">
                            <span style="color:var(--text-color);font-size:13px;">Phone</span>
                            <span class="fw-semibold" style="color:var(--heading-color);font-size:13px;">{{
                                $admin->phone ?? 'Not set' }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span style="color:var(--text-color);font-size:13px;">Member Since</span>
                            <span class="fw-semibold" style="color:var(--heading-color);font-size:13px;">{{
                                $admin->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span style="color:var(--text-color);font-size:13px;">Last Login</span>
                            <span class="fw-semibold" style="color:var(--heading-color);font-size:13px;">{{
                                $admin->last_login_at ? $admin->last_login_at->diffForHumans() : 'N/A' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Settings Forms --}}
            <div class="col-lg-8">
                {{-- Update Profile --}}
                <div class="admin-card mb-4">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div
                            style="width:36px;height:36px;border-radius:10px;background:color-mix(in srgb, var(--accent-color) 12%, transparent);display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-person-fill" style="color:var(--accent-color);font-size:16px;"></i>
                        </div>
                        <h6 class="fw-bold mb-0" style="color:var(--heading-color);">Update Profile</h6>
                    </div>

                    <form id="profileForm">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold"
                                    style="color:var(--text-color);font-size:13px;">Full Name</label>
                                <input type="text" class="form-control admin-form-control" id="firstname"
                                    name="firstname" value="{{ $admin->name }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold"
                                    style="color:var(--text-color);font-size:13px;">Middle Name</label>
                                <input type="text" class="form-control admin-form-control" id="middlename"
                                    name="middlename" placeholder="Optional">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold"
                                    style="color:var(--text-color);font-size:13px;">Last Name</label>
                                <input type="text" class="form-control admin-form-control" id="lastname" name="lastname"
                                    value="{{ $admin->name }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold"
                                    style="color:var(--text-color);font-size:13px;">Phone Number</label>
                                <input type="text" class="form-control admin-form-control" id="phone" name="phone"
                                    value="{{ $admin->phone }}" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold"
                                    style="color:var(--text-color);font-size:13px;">Email Address</label>
                                <input type="email" class="form-control admin-form-control" id="email" name="email"
                                    value="{{ $admin->email }}" required>
                            </div>
                        </div>
                        <div class="mt-3 text-end">
                            <button type="submit" class="btn btn-admin-primary">
                                <i class="bi bi-check-lg me-1"></i> Save Profile
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Update Password --}}
                <div class="admin-card">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div
                            style="width:36px;height:36px;border-radius:10px;background:rgba(234,179,8,.12);display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-lock-fill" style="color:#eab308;font-size:16px;"></i>
                        </div>
                        <h6 class="fw-bold mb-0" style="color:var(--heading-color);">Change Password</h6>
                    </div>

                    <form id="passwordForm">
                        @csrf
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label fw-semibold"
                                    style="color:var(--text-color);font-size:13px;">Current Password</label>
                                <div class="position-relative">
                                    <input type="password" class="form-control admin-form-control pe-5"
                                        id="old_password" name="old_password" placeholder="Enter current password"
                                        required>
                                    <button type="button" class="btn settings-eye-btn"
                                        onclick="togglePwdVis('old_password', this)">
                                        <i class="bi bi-eye-slash"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold"
                                    style="color:var(--text-color);font-size:13px;">New Password</label>
                                <div class="position-relative">
                                    <input type="password" class="form-control admin-form-control pe-5"
                                        id="new_password" name="new_password" placeholder="Min 8 characters" required>
                                    <button type="button" class="btn settings-eye-btn"
                                        onclick="togglePwdVis('new_password', this)">
                                        <i class="bi bi-eye-slash"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold"
                                    style="color:var(--text-color);font-size:13px;">Confirm New Password</label>
                                <div class="position-relative">
                                    <input type="password" class="form-control admin-form-control pe-5"
                                        id="new_password_confirmation" name="new_password_confirmation"
                                        placeholder="Re-enter new password" required>
                                    <button type="button" class="btn settings-eye-btn"
                                        onclick="togglePwdVis('new_password_confirmation', this)">
                                        <i class="bi bi-eye-slash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 text-end">
                            <button type="submit" class="btn btn-admin-primary">
                                <i class="bi bi-shield-lock me-1"></i> Update Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .settings-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--accent-color), #8b5cf6);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 32px;
    }

    .settings-role-badge {
        display: inline-flex;
        align-items: center;
        padding: 4px 14px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        background: color-mix(in srgb, var(--accent-color) 12%, transparent);
        color: var(--accent-color);
    }

    .settings-eye-btn {
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

    .settings-eye-btn:hover {
        color: var(--accent-color);
    }
</style>

@include('admin.footer')

<script>
    function togglePwdVis(inputId, btn) {
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

// Profile Form
document.getElementById('profileForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const data = {
        _token: '{{ csrf_token() }}',
        firstname: document.getElementById('firstname').value,
        middlename: document.getElementById('middlename').value,
        lastname: document.getElementById('lastname').value,
        phone: document.getElementById('phone').value,
        email: document.getElementById('email').value,
    };

    fetch('{{ route("admin.profile.update") }}', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
        body: JSON.stringify(data)
    })
    .then(r => r.json())
    .then(res => {
        if (res.status === 'success') {
            toastr.success(res.message);
            setTimeout(() => location.reload(), 1200);
        } else {
            toastr.error(res.message);
        }
    })
    .catch(() => toastr.error('Something went wrong.'));
});

// Password Form
document.getElementById('passwordForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const newPwd = document.getElementById('new_password').value;
    const confirmPwd = document.getElementById('new_password_confirmation').value;

    if (newPwd !== confirmPwd) {
        toastr.error('Passwords do not match.');
        return;
    }

    const data = {
        _token: '{{ csrf_token() }}',
        old_password: document.getElementById('old_password').value,
        new_password: newPwd,
        new_password_confirmation: confirmPwd,
    };

    fetch('{{ route("admin.profile.password.update") }}', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
        body: JSON.stringify(data)
    })
    .then(r => r.json())
    .then(res => {
        if (res.status === 'success') {
            toastr.success(res.message);
            document.getElementById('passwordForm').reset();
        } else {
            toastr.error(res.message);
        }
    })
    .catch(() => toastr.error('Something went wrong.'));
});
</script>