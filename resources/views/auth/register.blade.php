@section('title', 'Sign Up - Tradedgepip')
@include('home.header')

<style>
    .register-main {
        background-color: #E6F3FD;
        min-height: calc(100vh - 200px);
        padding: 40px 20px;
    }

    .dark .register-main {
        background-color: #0b1118;
    }

    .register-container {
        max-width: 1000px;
        margin: 0 auto;
    }

    .register-title {
        font-size: 2rem;
        font-weight: 700;
        color: #1a1f2b;
        margin-bottom: 24px;
        text-align: left;
    }

    .dark .register-title {
        color: #ffffff;
    }

    /* White content box like About page */
    .register-box {
        background: #ffffff;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid #e5e7eb;
    }

    .dark .register-box {
        background: #0b1118;
        border-color: #363c4e;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px 24px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-label {
        color: #6b7280;
        font-size: 0.8rem;
        margin-bottom: 6px;
        font-weight: 400;
    }

    .dark .form-label {
        color: #a5bdd9;
    }

    .register-form-input,
    .register-form-select {
        width: 100%;
        padding: 12px 14px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        background: #ffffff;
        font-size: 0.9rem;
        color: #1a1f2b;
        font-family: inherit;
    }

    .dark .register-form-input,
    .dark .register-form-select {
        background: #1e293b;
        border-color: #363c4e;
        color: #ffffff;
    }

    .register-form-input:focus,
    .register-form-select:focus {
        outline: none;
        border-color: #04b3e1;
    }

    .register-form-select {
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 12px center;
        background-repeat: no-repeat;
        background-size: 16px 12px;
    }

    /* Terms checkbox section */
    .terms-section {
        display: flex;
        align-items: center;
        gap: 12px;
        margin: 28px 0 24px;
    }

    .register-checkbox {
        width: 18px;
        height: 18px;
        accent-color: #04b3e1;
        flex-shrink: 0;
    }

    .terms-text {
        font-size: 0.85rem;
        color: #04b3e1;
        font-weight: 500;
    }

    .terms-link {
        color: #04b3e1;
        text-decoration: none;
        font-weight: 600;
    }

    .terms-link:hover {
        text-decoration: underline;
    }

    /* Password input wrapper */
    .password-wrapper {
        position: relative;
        width: 100%;
    }

    .password-toggle {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        cursor: pointer;
        padding: 0;
        color: #6b7280;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .password-toggle:hover {
        color: #04b3e1;
    }

    .password-toggle svg {
        width: 20px;
        height: 20px;
    }

    .dark .password-toggle {
        color: #a5bdd9;
    }

    /* Submit button */
    .register-submit-btn {
        display: block;
        width: 100%;
        padding: 14px 24px;
        border: none;
        border-radius: 8px;
        background: #04b3e1;
        color: white;
        font-size: 0.9rem;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.3s;
        font-family: inherit;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .register-submit-btn:hover {
        background: #039bc2;
    }

    /* Login prompt */
    .login-prompt {
        text-align: center;
        color: #6b7280;
        font-size: 0.85rem;
        margin-top: 20px;
    }

    .dark .login-prompt {
        color: #a5bdd9;
    }

    .login-link {
        color: #04b3e1;
        text-decoration: none;
        font-weight: 500;
        margin-left: 4px;
    }

    .login-link:hover {
        text-decoration: underline;
    }

    /* Loading spinner */
    .loading-spinner {
        display: inline-block;
        width: 18px;
        height: 18px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        border-top-color: #fff;
        animation: spin 1s ease-in-out infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    .honeypot-field {
        position: absolute;
        left: -9999px;
    }

    @media (max-width: 900px) {
        .form-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .register-box {
            padding: 24px;
        }
    }

    @media (max-width: 600px) {
        .form-grid {
            grid-template-columns: 1fr;
        }

        .terms-section {
            flex-direction: column;
            align-items: flex-start;
        }

        .register-submit-btn {
            max-width: 100%;
        }

        .register-main {
            padding: 20px 16px;
        }
    }

    /* Error display */
    .alert-error {
        background: #fee2e2;
        border: 1px solid #ef4444;
        color: #dc2626;
        padding: 12px 16px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 0.85rem;
    }

    .dark .alert-error {
        background: rgba(239, 68, 68, 0.1);
        border-color: #ef4444;
    }

    .alert-success {
        background: #dcfce7;
        border: 1px solid #22c55e;
        color: #16a34a;
        padding: 12px 16px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 0.85rem;
    }

    .dark .alert-success {
        background: rgba(34, 197, 94, 0.1);
        border-color: #22c55e;
    }

    /* Profile Photo Upload */
    .photo-upload-section {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 28px;
        gap: 12px;
    }

    .photo-preview-wrapper {
        position: relative;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        overflow: hidden;
        border: 3px solid #04b3e1;
        cursor: pointer;
        background: #edf2f7;
    }

    .dark .photo-preview-wrapper {
        background: #2d3748;
        border-color: #04b3e1;
    }

    .photo-preview-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .photo-preview-wrapper .upload-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.55);
        color: #fff;
        text-align: center;
        font-size: 0.65rem;
        padding: 4px 0;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .photo-upload-label {
        font-size: 0.8rem;
        color: #6b7280;
        cursor: pointer;
    }

    .dark .photo-upload-label {
        color: #a5bdd9;
    }

    .photo-upload-label span {
        color: #04b3e1;
        font-weight: 600;
    }
</style>

<main class="register-main">
    <div class="register-container">
        <h1 class="register-title">Create An Account</h1>

        @if(session('success'))
        <script>
            toastr.success("{{ session('success') }}");
        </script>
        @endif

        @if(session('error'))
        <script>
            toastr.error("{{ session('error') }}");
        </script>
        @endif

        @if($errors->any())
        <div class="alert-error">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <script>
            @foreach($errors->all() as $error)
            toastr.error("{{ $error }}");
            @endforeach
        </script>
        @endif

        <div class="register-box">
            <form id="registerForm">
                @csrf

                <!-- Hidden spam protection fields -->
                <input type="hidden" name="js_enabled" id="js_enabled" value="0">
                <input type="hidden" name="form_token" value="{{ $formToken }}">
                <input type="hidden" name="timestamp" id="timestamp" value="{{ now()->timestamp }}">
                <input type="hidden" name="time_check" id="time_check" value="0">
                <input type="hidden" name="referral_code" value="{{ $referral_code ?? '' }}">

                <div class="honeypot-field">
                    <input type="text" name="website" id="website">
                </div>

                <script>
                    document.getElementById('js_enabled').value = 1;
                    setTimeout(function() { document.getElementById('time_check').value = 1; }, 5000);
                </script>

                <!-- Profile Photo Upload -->
                <div class="photo-upload-section">
                    <div class="photo-preview-wrapper" onclick="document.getElementById('profile_photo').click()">
                        <img id="photoPreview"
                            src="https://ui-avatars.com/api/?name=User&background=04b3e1&color=fff&size=200"
                            alt="Profile Photo">
                        <div class="upload-overlay">Upload</div>
                    </div>
                    <label class="photo-upload-label" for="profile_photo">
                        <span>Choose a profile photo</span> (optional)
                    </label>
                    <input type="file" name="profile_photo" id="profile_photo"
                        accept="image/jpeg,image/png,image/jpg,image/gif" style="display:none;">
                </div>

                <div class="form-grid">
                    <!-- Row 1 -->
                    <div class="form-group">
                        <label class="form-label">Currency</label>
                        <select name="currency" class="register-form-select" required>
                            <option value="USD" {{ old('currency')=='USD' ? 'selected' : '' }}>USD</option>
                            <option value="EUR" {{ old('currency')=='EUR' ? 'selected' : '' }}>EUR</option>
                            <option value="GBP" {{ old('currency')=='GBP' ? 'selected' : '' }}>GBP</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="register-form-input" value="{{ old('email') }}"
                            required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <div class="password-wrapper">
                            <input type="password" name="password" id="password" class="register-form-input" required>
                            <button type="button" class="password-toggle" onclick="togglePassword('password', this)">
                                <svg class="eye-open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg class="eye-closed" style="display:none" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Row 2 -->
                    <div class="form-group">
                        <label class="form-label">Confirm Password</label>
                        <div class="password-wrapper">
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="register-form-input" required>
                            <button type="button" class="password-toggle"
                                onclick="togglePassword('password_confirmation', this)">
                                <svg class="eye-open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg class="eye-closed" style="display:none" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">First Name</label>
                        <input type="text" name="first_name" class="register-form-input" value="{{ old('first_name') }}"
                            required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="last_name" class="register-form-input" value="{{ old('last_name') }}"
                            required>
                    </div>

                    <!-- Row 3 -->
                    <div class="form-group">
                        <label class="form-label">Mobile Number</label>
                        <input type="tel" name="phone_number" class="register-form-input"
                            value="{{ old('phone_number') }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Date Of Birth</label>
                        <input type="date" name="date_of_birth" class="register-form-input"
                            value="{{ old('date_of_birth') }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">State</label>
                        <input type="text" name="state" class="register-form-input" value="{{ old('state') }}" required>
                    </div>

                    <!-- Row 4 -->
                    <div class="form-group">
                        <label class="form-label">City</label>
                        <input type="text" name="city" class="register-form-input" value="{{ old('city') }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Address</label>
                        <input type="text" name="address" class="register-form-input" value="{{ old('address') }}"
                            required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Country</label>
                        <select name="country" class="register-form-select" required>
                            @php
                            $countries = [
                            "Afghanistan", "Albania", "Algeria", "Anguilla", "Antigua and Barbuda", "Argentina",
                            "Aruba", "Australia", "Austria", "Bahamas", "Bangladesh", "Barbados", "Belgium",
                            "Belize", "Bermuda", "Bonaire, Sint Eustatius and Saba", "Brazil",
                            "British Virgin Islands", "Canada", "Cayman Islands", "Chile", "China", "Colombia",
                            "Cuba", "Curaçao", "Czech Republic", "Denmark", "Dominica", "Dominican Republic",
                            "Egypt", "Finland", "France", "Germany", "Ghana", "Greece", "Grenada", "Guadeloupe",
                            "Guyana", "Haiti", "Hungary", "India", "Indonesia", "Iran", "Iraq", "Ireland",
                            "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kenya", "Kuwait", "Malaysia",
                            "Martinique", "Mexico", "Montserrat", "Morocco", "Netherlands", "New Zealand",
                            "Nigeria", "Norway", "Pakistan", "Peru", "Philippines", "Poland", "Portugal",
                            "Puerto Rico", "Qatar", "Romania", "Russia", "Saint Barthélemy",
                            "Saint Kitts and Nevis", "Saint Lucia", "Saint Martin",
                            "Saint Vincent and the Grenadines", "Saudi Arabia", "Singapore", "Sint Maarten",
                            "South Africa", "South Korea", "Spain", "Suriname", "Sweden", "Switzerland", "Taiwan",
                            "Thailand", "Trinidad and Tobago", "Turkey", "Turks and Caicos Islands",
                            "U.S. Virgin Islands", "Ukraine", "United Arab Emirates", "United Kingdom",
                            "United States", "Venezuela", "Vietnam", "Zimbabwe"
                            ];
                            $selectedCountry = old('country', 'United States');
                            @endphp
                            @foreach($countries as $country)
                            <option value="{{ $country }}" {{ $selectedCountry==$country ? 'selected' : '' }}>{{
                                $country }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Terms checkbox -->
                <div class="terms-section">
                    <input type="checkbox" name="terms" class="register-checkbox" {{ old('terms') ? 'checked' : '' }}
                        required>
                    <span class="terms-text">
                        I Declare That The Information Provided Is Correct And Accept All <a href="/terms-of-service"
                            class="terms-link">Terms Of Service</a>
                    </span>
                </div>

                <!-- Submit button -->
                <button type="submit" id="submitButton" class="register-submit-btn">
                    <span id="buttonText">CREATE MY ACCOUNT</span>
                    <span id="loadingSpinner" class="loading-spinner" style="display: none;"></span>
                </button>

                <!-- Login link -->
                <div class="login-prompt">
                    Already have an account?<a href="{{ route('login') }}" class="login-link">Sign In</a>
                </div>
            </form>
        </div>
    </div>
</main>

@include('home.footer')

<script>
    // Password toggle function
    function togglePassword(inputId, button) {
        const input = document.getElementById(inputId);
        const eyeOpen = button.querySelector('.eye-open');
        const eyeClosed = button.querySelector('.eye-closed');
        
        if (input.type === 'password') {
            input.type = 'text';
            eyeOpen.style.display = 'none';
            eyeClosed.style.display = 'block';
        } else {
            input.type = 'password';
            eyeOpen.style.display = 'block';
            eyeClosed.style.display = 'none';
        }
    }

    // Profile photo preview
    document.getElementById('profile_photo').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            // Validate file size (max 2MB)
            if (file.size > 2 * 1024 * 1024) {
                toastr.error('Photo must be less than 2MB.');
                this.value = '';
                return;
            }
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('photoPreview').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    $(document).ready(function () {
        $('#registerForm').on('submit', function (e) {
            e.preventDefault();
            $('#buttonText').hide();
            $('#loadingSpinner').show();
            $('#submitButton').prop('disabled', true);

            // Use FormData to support file uploads
            var formData = new FormData(this);

            $.ajax({
                url: '{{ route("register") }}',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function (response) {
                    $('#buttonText').show();
                    $('#loadingSpinner').hide();
                    $('#submitButton').prop('disabled', false);
                    if (response.success) {
                        toastr.success(response.message);
                        window.location.href = response.redirect;
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function (xhr) {
                    $('#buttonText').show();
                    $('#loadingSpinner').hide();
                    $('#submitButton').prop('disabled', false);
                    toastr.error(xhr.responseJSON.message || 'An error occurred. Please try again.');
                }
            });
        });
    });
</script>