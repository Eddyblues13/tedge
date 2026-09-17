@include('admin.header')

<div class="main-content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="admin-page-title">Add New Manager</h4>
                <p class="admin-page-subtitle">Create a new administrator account</p>
            </div>
            <a href="{{ url('admin/manage-administrator') }}" class="btn btn-sm btn-outline-secondary"><i
                    class="fas fa-arrow-left me-1"></i> Back</a>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="admin-card">
                    <form method="POST" action="{{ url('account/admin/dashboard/saveadmin') }}">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label" style="color:var(--heading-color);">First Name</label>
                                <input type="text" class="admin-form-control" name="fname" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" style="color:var(--heading-color);">Last Name</label>
                                <input type="text" class="admin-form-control" name="l_name" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" style="color:var(--heading-color);">E-Mail Address</label>
                                <input type="email" class="admin-form-control" name="email" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" style="color:var(--heading-color);">Phone Number</label>
                                <input type="number" class="admin-form-control" name="phone" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" style="color:var(--heading-color);">Type</label>
                                <select class="admin-form-control" name="type">
                                    <option value="Super Admin">Super Admin</option>
                                    <option value="Admin">Admin</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" style="color:var(--heading-color);">Password</label>
                                <input type="password" class="admin-form-control" name="password" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" style="color:var(--heading-color);">Confirm Password</label>
                                <input type="password" class="admin-form-control" name="password_confirmation" required>
                            </div>
                            <div class="col-12 mt-3">
                                <button type="submit" class="btn btn-admin-primary"><i class="fas fa-plus me-1"></i>
                                    Save User</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.footer')