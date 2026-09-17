@include('admin.header')

<div class="main-content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="admin-page-title">Edit User: {{ $user->first_name }} {{ $user->last_name }}</h4>
                <p class="admin-page-subtitle">Update user information</p>
            </div>
            <a href="{{ route('admin.user.view', $user->id) }}" class="btn btn-sm"
                style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);">
                <i class="fas fa-arrow-left me-1"></i> Back
            </a>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="admin-card">
                    <div class="card-body">
                        <form id="editUserForm" method="POST" action="{{ route('admin.users.update', $user->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div id="formErrors" class="alert alert-danger d-none"></div>

                            <div class="text-center mb-4">
                                @if($user->profile_photo)
                                <img src="{{ asset($user->profile_photo) }}" class="rounded-circle" width="120"
                                    height="120" style="object-fit:cover;">
                                @else
                                <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto"
                                    style="width:120px;height:120px;font-size:48px;background:var(--accent-color);color:#fff;font-weight:600;">
                                    {{ substr($user->first_name, 0, 1) }}{{ substr($user->last_name, 0, 1) }}
                                </div>
                                @endif
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" style="color:var(--heading-color);">First Name</label>
                                    <input type="text" name="first_name" class="admin-form-control"
                                        value="{{ $user->first_name }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" style="color:var(--heading-color);">Last Name</label>
                                    <input type="text" name="last_name" class="admin-form-control"
                                        value="{{ $user->last_name }}" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" style="color:var(--heading-color);">Email</label>
                                <input type="email" name="email" class="admin-form-control" value="{{ $user->email }}"
                                    required>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" style="color:var(--heading-color);">Phone Number</label>
                                    <input type="text" name="phone_number" class="admin-form-control"
                                        value="{{ $user->phone_number }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" style="color:var(--heading-color);">Country</label>
                                    <select name="country" class="admin-form-control" required>
                                        <option value="">Select Country</option>
                                        @foreach(config('countries') as $code => $name)
                                        <option value="{{ $name }}" {{ $user->country == $name ? 'selected' : '' }}>{{
                                            $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" style="color:var(--heading-color);">City</label>
                                    <input type="text" name="city" class="admin-form-control" value="{{ $user->city }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" style="color:var(--heading-color);">Currency</label>
                                    <select name="currency" class="admin-form-control">
                                        <option value="">Select Currency</option>
                                        <option value="USD" {{ $user->currency == 'USD' ? 'selected' : '' }}>USD
                                        </option>
                                        <option value="EUR" {{ $user->currency == 'EUR' ? 'selected' : '' }}>EUR
                                        </option>
                                        <option value="GBP" {{ $user->currency == 'GBP' ? 'selected' : '' }}>GBP
                                        </option>
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
                                        <option value="{{ $referrer->id }}" {{ $user->referred_by == $referrer->id ?
                                            'selected' : '' }}>
                                            {{ $referrer->first_name }} {{ $referrer->last_name }} ({{
                                            $referrer->referral_code }})
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" style="color:var(--heading-color);">Status</label>
                                    <select name="user_status" class="admin-form-control" required>
                                        <option value="active" {{ $user->user_status == 'active' ? 'selected' : ''
                                            }}>Active</option>
                                        <option value="inactive" {{ $user->user_status == 'inactive' ? 'selected' : ''
                                            }}>Inactive</option>
                                        <option value="banned" {{ $user->user_status == 'banned' ? 'selected' : ''
                                            }}>Banned</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" style="color:var(--heading-color);">Signal
                                        Strength</label>
                                    <select name="signal_strength" class="admin-form-control">
                                        @for($i = 1; $i <= 100; $i++) <option value="{{ $i }}" {{ $user->signal_strength
                                            == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label" style="color:var(--heading-color);">Email Verified</label>
                                    <select name="email_verification" class="admin-form-control">
                                        <option value="1" {{ $user->email_verification ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ !$user->email_verification ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" style="color:var(--heading-color);">ID Verified</label>
                                    <select name="id_verification" class="admin-form-control">
                                        <option value="1" {{ $user->id_verification ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ !$user->id_verification ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" style="color:var(--heading-color);">Address
                                        Verified</label>
                                    <select name="address_verification" class="admin-form-control">
                                        <option value="1" {{ $user->address_verification ? 'selected' : '' }}>Yes
                                        </option>
                                        <option value="0" {{ !$user->address_verification ? 'selected' : '' }}>No
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-admin-primary">Update User</button>
                                <a href="{{ route('admin.user.view', $user->id) }}" class="btn"
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
    $('#editUserForm').submit(function(e) {
        e.preventDefault();
        const form = $(this);
        const submitBtn = form.find('[type="submit"]');
        const errorContainer = $('#formErrors');
        errorContainer.addClass('d-none').empty();
        submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Updating...');
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
                submitBtn.prop('disabled', false).html('Update User');
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