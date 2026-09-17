@section('title', 'Email Verification - Tradedgepip')
@include('home.header')

<style>
    .verify-main {
        background-color: #E6F3FD;
        min-height: calc(100vh - 200px);
        padding: 40px 20px;
    }

    .dark .verify-main {
        background-color: #0b1118;
    }

    .verify-container {
        max-width: 900px;
        margin: 0 auto;
    }

    .verify-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: #1a1f2b;
        margin-bottom: 12px;
        text-align: center;
    }

    .dark .verify-title {
        color: #ffffff;
    }

    .verify-subtitle {
        font-size: 0.9rem;
        color: #6b7280;
        text-align: center;
        margin-bottom: 30px;
    }

    .dark .verify-subtitle {
        color: #a5bdd9;
    }

    .verify-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 24px;
    }

    .verify-box {
        background: #ffffff;
        padding: 32px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid #e5e7eb;
    }

    .dark .verify-box {
        background: #0b1118;
        border-color: #363c4e;
    }

    .box-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #04b3e1;
        margin-bottom: 20px;
        text-align: center;
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

    .verify-form-input {
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

    .dark .verify-form-input {
        background: #1e293b;
        border-color: #363c4e;
        color: #ffffff;
    }

    .verify-form-input:focus {
        outline: none;
        border-color: #04b3e1;
    }

    .verify-form-input[readonly] {
        background: #f3f4f6;
        cursor: not-allowed;
    }

    .dark .verify-form-input[readonly] {
        background: #2d3748;
    }

    .verify-btn {
        display: block;
        width: 100%;
        padding: 12px 20px;
        border: none;
        border-radius: 8px;
        background: #04b3e1;
        color: white;
        font-size: 0.9rem;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.3s;
        font-family: inherit;
        margin-bottom: 12px;
        text-align: center;
        text-decoration: none;
    }

    .verify-btn:hover {
        background: #039bc2;
        color: white;
    }

    .skip-btn {
        display: block;
        width: 100%;
        padding: 12px 20px;
        border: 1px solid #04b3e1;
        border-radius: 8px;
        background: transparent;
        color: #04b3e1;
        font-size: 0.9rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        font-family: inherit;
        margin-bottom: 12px;
    }

    .skip-btn:hover {
        background: rgba(4, 179, 225, 0.1);
    }

    .logout-btn {
        display: block;
        width: 50%;
        margin: 20px auto 0;
        padding: 10px 20px;
        border: 1px solid #04b3e1;
        border-radius: 8px;
        background: transparent;
        color: #04b3e1;
        font-size: 0.85rem;
        font-weight: 500;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
    }

    .logout-btn:hover {
        background: rgba(4, 179, 225, 0.1);
        color: #04b3e1;
    }

    .info-text {
        color: #6b7280;
        font-size: 0.85rem;
        text-align: center;
        margin-top: 16px;
        line-height: 1.6;
    }

    .dark .info-text {
        color: #a5bdd9;
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
        .verify-box {
            padding: 24px;
        }

        .verify-main {
            padding: 30px 16px;
        }

        .logout-btn {
            width: 70%;
        }
    }
</style>

<main class="verify-main">
    <div class="verify-container">
        <h1 class="verify-title">Email Verification</h1>
        <p class="verify-subtitle">Please verify your email address to continue</p>

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

        <div class="verify-cards">
            <!-- Email Verification Card -->
            <div class="verify-box">
                <h2 class="box-title">Email Verification</h2>
                <form action="{{ route('verify.code') }}" method="POST" id="verifyForm">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Pin</label>
                        <input type="number" name="verification_code" class="verify-form-input"
                            placeholder="Enter verification PIN" value="{{ old('verification_code') }}" required>
                    </div>
                    <button type="submit" class="verify-btn">VERIFY EMAIL</button>
                </form>

                <form action="{{ route('skip.code') }}" method="POST">
                    @csrf
                    <button type="submit" class="skip-btn">SKIP</button>
                </form>

                <p class="info-text">
                    An email containing your PIN has been sent to your email. If you have not received it in a minute or
                    two, use the resend form.
                </p>
            </div>

            <!-- Resend Pin / Update Email Card -->
            <div class="verify-box">
                <h2 class="box-title">Update Email & Resend Pin</h2>
                <form action="{{ route('update.verification.email') }}" method="POST" id="updateEmailForm">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="new_email" class="verify-form-input" value="{{ Auth::user()->email }}"
                            required>
                    </div>
                    <button type="submit" class="verify-btn" id="updateEmailBtn">
                        <span id="updateEmailText">UPDATE EMAIL & SEND CODE</span>
                        <span id="updateEmailSpinner" class="loading-spinner" style="display: none;"></span>
                    </button>
                </form>
                <a href="{{ route('resend.verification.code') }}" class="skip-btn"
                    style="text-align: center; text-decoration: none; display: block;">RESEND PIN TO CURRENT EMAIL</a>
                <a href="{{ route('logout') }}" class="skip-btn"
                    style="text-align: center; text-decoration: none; display: block;"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    LOGOUT
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <p class="info-text">
                    If you entered the wrong email, update it above and a new verification code will be sent to the new
                    address.
                </p>
            </div>
        </div>
    </div>
</main>

@include('home.footer')