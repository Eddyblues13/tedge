<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Tradedgepip</title>
    <meta name="robots" content="noindex, nofollow">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">

    <script>
        if (localStorage.theme === 'dark') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg-color);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        /* Animated background orbs */
        .error-bg-orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.15;
            animation: orbFloat 20s ease-in-out infinite;
            z-index: 0;
        }

        .error-bg-orb:nth-child(1) {
            width: 400px;
            height: 400px;
            background: #6366f1;
            top: -100px;
            left: -100px;
            animation-duration: 18s;
        }

        .error-bg-orb:nth-child(2) {
            width: 350px;
            height: 350px;
            background: #8b5cf6;
            bottom: -80px;
            right: -80px;
            animation-duration: 22s;
            animation-delay: -5s;
        }

        .error-bg-orb:nth-child(3) {
            width: 250px;
            height: 250px;
            background: #ec4899;
            top: 50%;
            left: 60%;
            animation-duration: 25s;
            animation-delay: -10s;
        }

        @keyframes orbFloat {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            25% {
                transform: translate(30px, -40px) scale(1.1);
            }

            50% {
                transform: translate(-20px, 20px) scale(0.95);
            }

            75% {
                transform: translate(40px, 30px) scale(1.05);
            }
        }

        .error-container {
            position: relative;
            z-index: 1;
            text-align: center;
            padding: 40px 20px;
            max-width: 560px;
            width: 100%;
        }

        .error-code {
            font-size: clamp(100px, 20vw, 180px);
            font-weight: 900;
            line-height: 1;
            background: linear-gradient(135deg, #6366f1, #8b5cf6, #ec4899);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 8px;
            position: relative;
            animation: errorPulse 3s ease-in-out infinite;
        }

        @keyframes errorPulse {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.85;
                transform: scale(1.02);
            }
        }

        .error-icon-ring {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.15), rgba(139, 92, 246, 0.15));
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
            border: 2px solid rgba(99, 102, 241, 0.2);
        }

        .error-icon-ring i {
            font-size: 32px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .error-title {
            font-size: 22px;
            font-weight: 700;
            color: var(--heading-color);
            margin-bottom: 12px;
        }

        .error-message {
            font-size: 15px;
            color: var(--text-color);
            line-height: 1.7;
            margin-bottom: 32px;
            max-width: 420px;
            margin-left: auto;
            margin-right: auto;
        }

        .error-actions {
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .error-btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 28px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            text-decoration: none;
            transition: all 0.3s;
            cursor: pointer;
        }

        .error-btn-primary:hover {
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.3);
        }

        .error-btn-secondary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 28px;
            background: var(--card-bg);
            color: var(--heading-color);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            text-decoration: none;
            transition: all 0.3s;
            cursor: pointer;
        }

        .error-btn-secondary:hover {
            border-color: #6366f1;
            color: #6366f1;
            transform: translateY(-2px);
        }

        .error-footer {
            position: fixed;
            bottom: 24px;
            left: 0;
            right: 0;
            text-align: center;
            z-index: 1;
        }

        .error-footer a {
            color: var(--text-color);
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            opacity: 0.7;
            transition: all 0.2s;
        }

        .error-footer a:hover {
            opacity: 1;
            color: #6366f1;
        }

        /* Floating particles */
        .error-particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
            overflow: hidden;
        }

        .error-particle {
            position: absolute;
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background: var(--accent-color);
            opacity: 0.3;
            animation: particleFloat linear infinite;
        }

        @keyframes particleFloat {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }

            10% {
                opacity: 0.3;
            }

            90% {
                opacity: 0.3;
            }

            100% {
                transform: translateY(-10vh) rotate(720deg);
                opacity: 0;
            }
        }
    </style>
</head>

<body>
    <!-- Background orbs -->
    <div class="error-bg-orb"></div>
    <div class="error-bg-orb"></div>
    <div class="error-bg-orb"></div>

    <!-- Floating particles -->
    <div class="error-particles" id="particles"></div>

    <div class="error-container">
        <div class="error-code">@yield('code')</div>
        <div class="error-icon-ring">
            <i class="bi @yield('icon')"></i>
        </div>
        <h1 class="error-title">@yield('heading')</h1>
        <p class="error-message">@yield('description')</p>
        <div class="error-actions">
            @yield('actions')
        </div>
    </div>

    <div class="error-footer">
        <a href="/">Tradedgepip &copy; {{ date('Y') }}</a>
    </div>

    <script>
        // Generate floating particles
        const container = document.getElementById('particles');
        for (let i = 0; i < 20; i++) {
            const p = document.createElement('div');
            p.className = 'error-particle';
            p.style.left = Math.random() * 100 + '%';
            p.style.width = p.style.height = (Math.random() * 4 + 2) + 'px';
            p.style.animationDuration = (Math.random() * 15 + 10) + 's';
            p.style.animationDelay = (Math.random() * 10) + 's';
            container.appendChild(p);
        }
    </script>
</body>

</html>