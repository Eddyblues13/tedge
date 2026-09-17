@section('title', 'Forgot Password - Tradedgepip')
@include('home.header')

<style>
    .forgot-main {
        background-color: #E6F3FD;
        min-height: calc(100vh - 200px);
        padding: 60px 20px;
    }

    .dark .forgot-main {
        background-color: #0b1118;
    }

    .forgot-container {
        max-width: 500px;
        margin: 0 auto;
    }

    .forgot-title {
        font-size: 2rem;
        font-weight: 700;
        color: #1a1f2b;
        margin-bottom: 24px;
        text-align: left;
    }

    .dark .forgot-title {
        color: #ffffff;
    }

    .forgot-box {
        background: #ffffff;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid #e5e7eb;
    }

    .dark .forgot-box {
        background: #0b1118;
        border-color: #363c4e;
    }

    .forgot-description {
        color: #6b7280;
        font-size: 0.9rem;
        margin-bottom: 24px;
        line-height: 1.6;
    }

    .dark .forgot-description {
        color: #a5bdd9;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        color: #6b7280;
        font-size: 0.8rem;
        margin-bottom: 6px;
        font-weight: 400;
    }

    .dark .form-label {
        color: #a5bdd9;
    }

    .forgot-form-input {
        width: 100%;
        padding: 12px 14px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        background: #ffffff;
        font-size: 0.9rem;
        color: #1a1f2b;
        font-family: inherit;
        box-sizing: border-box;
    }

    .dark .forgot-form-input {
        background: #1e293b;
        border-color: #363c4e;
        color: #ffffff;
    }

    .forgot-form-input:focus {
        outline: none;
        border-color: #04b3e1;
    }

    .forgot-submit-btn {
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
        margin-top: 24px;
        margin-bottom: 20px;
    }

    .forgot-submit-btn:hover {
        background: #039bc2;
    }

    .back-to-login {
        text-align: center;
        color: #6b7280;
        font-size: 0.85rem;
    }

    .dark .back-to-login {
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

    @media (max-width: 600px) {
        .forgot-box {
            padding: 24px;
        }

        .forgot-main {
            padding: 40px 16px;
        }
    }
</style>

<main class="forgot-main">
    <div class="forgot-container">
        <h1 class="forgot-title">Forgot Password</h1>

        <div class="forgot-box">
            <p class="forgot-description">
                Enter your email address and we'll send you a link to reset your password.
            </p>

            <form id="forgotPasswordForm">
                @csrf

                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="forgot-form-input" placeholder="Enter your email" required>
                </div>

                <button type="submit" class="forgot-submit-btn" id="submitButton">
                    <span id="buttonText">Send Reset Link</span>
                    <span id="loadingSpinner" class="loading-spinner" style="display: none;"></span>
                </button>

                <div class="back-to-login">
                    Remember your password?<a href="{{ route('login') }}" class="login-link">Sign In</a>
                </div>
            </form>
        </div>
    </div>
</main>

@include('home.footer')

<script>
    $(document).ready(function () {
        $('#forgotPasswordForm').on('submit', function (e) {
            e.preventDefault();
            $('#buttonText').hide();
            $('#loadingSpinner').show();
            $('#submitButton').prop('disabled', true);

            $.ajax({
                url: '{{ route("password.email") }}',
                method: 'POST',
                data: $(this).serialize(),
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function (response) {
                    $('#buttonText').show();
                    $('#loadingSpinner').hide();
                    $('#submitButton').prop('disabled', false);
                    if (response.success) {
                        toastr.success(response.message);
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