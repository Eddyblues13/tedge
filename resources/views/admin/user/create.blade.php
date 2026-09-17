@include('admin.header')

<div class="main-content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="admin-page-title">Create New User</h4>
                <p class="admin-page-subtitle">Add a new user to the platform</p>
            </div>
            <a href="{{ route('admin.users.index') }}" class="btn btn-sm"
                style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);">
                <i class="fas fa-arrow-left me-1"></i> Back to Users
            </a>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="admin-card">
                    <div class="card-body">
                        <form id="createUserForm" method="POST" action="{{ route('admin.users.store') }}"
                            enctype="multipart/form-data">
                            @csrf

                            <div id="formErrors" class="alert alert-danger d-none"></div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" style="color:var(--heading-color);">First Name</label>
                                    <input type="text" name="first_name" class="admin-form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" style="color:var(--heading-color);">Last Name</label>
                                    <input type="text" name="last_name" class="admin-form-control" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" style="color:var(--heading-color);">Email</label>
                                <input type="email" name="email" class="admin-form-control" required>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" style="color:var(--heading-color);">Password</label>
                                    <input type="password" name="password" class="admin-form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" style="color:var(--heading-color);">Confirm
                                        Password</label>
                                    <input type="password" name="password_confirmation" class="admin-form-control"
                                        required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" style="color:var(--heading-color);">Phone Number</label>
                                    <input type="text" name="phone_number" class="admin-form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" style="color:var(--heading-color);">Country</label>
                                    <select name="country" class="admin-form-control" required>
                                        <option value="">Select Country</option>
                                        @foreach(config('countries') as $code => $name)
                                        <option value="{{ $name }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" style="color:var(--heading-color);">City</label>
                                    <input type="text" name="city" class="admin-form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" style="color:var(--heading-color);">Currency</label>
                                    <select name="currency" class="admin-form-control">
                                        <option value="">Select Currency</option>
                                        <option value="USD">USD</option>
                                        <option value="EUR">EUR</option>
                                        <option value="GBP">GBP</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" style="color:var(--heading-color);">Profile Photo</label>
                                    <input type="file" name="profile_photo" class="admin-form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" style="color:var(--heading-color);">Referred By</label>
                                    <select name="referred_by" class="admin-form-control">
                                        <option value="">None</option>
                                        @foreach($referrers as $referrer)
                                        <option value="{{ $referrer->id }}">{{ $referrer->first_name }} {{
                                            $referrer->last_name }} ({{ $referrer->referral_code }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" style="color:var(--heading-color);">Status</label>
                                <select name="user_status" class="admin-form-control" required>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="banned">Banned</option>
                                </select>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-admin-primary">Create User</button>
                                <a href="{{ route('admin.users.index') }}" class="btn"
                                    style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.footer')

<script>
    $(document).ready(function() {
    $('#createUserForm').submit(function(e) {
        e.preventDefault();
        const form = $(this);
        const submitBtn = form.find('[type="submit"]');
        const errorContainer = $('#formErrors');
        errorContainer.addClass('d-none').empty();
        submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Creating...');
        const formData = new FormData(this);
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if(response.status === 'success') {
                    toastr.success(response.message);
                    setTimeout(() => { window.location.href = response.redirect; }, 1500);
                }
            },
            error: function(xhr) {
                submitBtn.prop('disabled', false).html('Create User');
                if(xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    let errorHtml = '<ul class="mb-0">';
                    $.each(errors, function(key, value) { errorHtml += '<li>' + value[0] + '</li>'; });
                    errorHtml += '</ul>';
                    errorContainer.html(errorHtml).removeClass('d-none');
                } else {
                    toastr.error(xhr.responseJSON?.message || 'An error occurred');
                }
            }
        });
    });
});
</script>