<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Login</title>

    <link rel="icon" href="account/storage/app/public/photos/uPYDzhfavicon.png1677339254" type="image/png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <style>
        :root {
            --login-bg: #0f1117;
            --card-bg: #1a1d27;
            --input-bg: #12141c;
            --border-color: #2a2d3a;
            --text-color: #a0a3b1;
            --heading-color: #e8e9ed;
            --accent-color: #635bff;
            --accent-hover: #524ae0;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: var(--login-bg);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-color);
        }

        .login-wrapper {
            width: 100%;
            max-width: 440px;
            padding: 20px;
        }

        .login-logo {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-logo img {
            max-width: 180px;
            height: auto;
        }

        .login-card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 2.5rem 2rem;
        }

        .login-card h4 {
            color: var(--heading-color);
            font-weight: 700;
            text-align: center;
            margin-bottom: 0.25rem;
            font-size: 1.5rem;
        }

        .login-subtitle {
            text-align: center;
            color: var(--text-color);
            margin-bottom: 1.75rem;
            font-size: 0.9rem;
        }

        .login-form .form-label {
            color: var(--heading-color);
            font-weight: 500;
            font-size: 0.875rem;
            margin-bottom: 0.4rem;
        }

        .login-form .form-control {
            background: var(--input-bg);
            border: 1px solid var(--border-color);
            color: var(--heading-color);
            border-radius: 8px;
            padding: 0.65rem 0.85rem 0.65rem 2.5rem;
            font-size: 0.9rem;
            transition: border-color 0.2s;
        }

        .login-form .form-control:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(99, 91, 255, 0.15);
            background: var(--input-bg);
            color: var(--heading-color);
        }

        .login-form .form-control::placeholder {
            color: #555;
        }

        .input-icon-wrap {
            position: relative;
        }

        .input-icon-wrap .input-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-color);
            font-size: 0.9rem;
        }

        .btn-login {
            background: var(--accent-color);
            border: none;
            color: #fff;
            font-weight: 600;
            padding: 0.7rem;
            border-radius: 8px;
            font-size: 0.95rem;
            width: 100%;
            transition: background 0.2s;
        }

        .btn-login:hover {
            background: var(--accent-hover);
            color: #fff;
        }

        .form-check-input {
            background-color: var(--input-bg);
            border-color: var(--border-color);
        }

        .form-check-input:checked {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
        }

        .form-check-label {
            color: var(--text-color);
            font-size: 0.85rem;
        }

        .login-link {
            color: var(--accent-color);
            text-decoration: none;
            font-weight: 500;
        }

        .login-link:hover {
            color: var(--accent-hover);
            text-decoration: underline;
        }

        .alert {
            font-size: 0.85rem;
            border-radius: 8px;
        }

        .login-footer {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.8rem;
            color: #555;
        }
    </style>
</head>

<body>
    <div class="login-wrapper">
        {{-- Logo --}}
        <div class="login-logo">
            <a href="/"><img src="account/storage/app/public/photos/uPYDzhlogo.jpg1677339253" alt="Logo"></a>
        </div>

        {{-- Login Card --}}
        <div class="login-card">
            <h4>Admin Login</h4>
            <p class="login-subtitle">Sign in to access your admin dashboard</p>

            {{-- Validation Errors --}}
            @if ($errors->any())
            <div class="alert alert-danger py-2 mb-3">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if(Session::has('error-message'))
            <div class="alert alert-info py-2 mb-3">{{ Session::get('error-message') }}</div>
            @endif

            @if (session('status'))
            <div class="alert alert-success py-2 mb-3">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('admin.login.store') }}" class="login-form">
                @csrf

                {{-- Email --}}
                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" id="email"
                            placeholder="Enter your email" required autofocus>
                    </div>
                </div>

                {{-- Password --}}
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" class="form-control" name="password" id="password"
                            placeholder="Enter your password" required>
                    </div>
                </div>

                {{-- Remember / Forgot --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="login-link" style="font-size:0.85rem;">Forgot
                        password?</a>
                    @endif
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn btn-login">
                    <i class="fas fa-sign-in-alt me-1"></i> Sign In
                </button>

                {{-- Register Link --}}
                <div class="text-center mt-3">
                    <span style="color:var(--text-color);font-size:0.85rem;">Don't have an account?</span>
                    <a href="{{ route('register') }}" class="login-link" style="font-size:0.85rem;">Sign Up</a>
                </div>
            </form>
        </div>

        {{-- Footer --}}
        <div class="login-footer">
            &copy; {{ date('Y') }} All Rights Reserved.
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>