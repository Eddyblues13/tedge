<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tradedgepip - Admin</title>
    <meta name="robots" content="noindex, nofollow">
    <meta name="googlebot" content="noindex, nofollow">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            corePlugins: { preflight: false },
            darkMode: 'class',
            theme: { extend: {} }
        }
    </script>
    <script>
        if (localStorage.theme === 'dark') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }

        function toggleTheme() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.theme = 'light';
                updateThemeButton('Light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.theme = 'dark';
                updateThemeButton('Dark');
            }
            window.dispatchEvent(new CustomEvent('themeChanged', { detail: { theme: localStorage.theme } }));
        }

        function updateThemeButton(mode) {
            const btnText = document.getElementById('theme-toggle-text');
            const icon = document.getElementById('theme-toggle-icon');
            if (mode === 'Dark') {
                btnText.innerText = 'Light Mode';
                icon.innerHTML = '<path d="M480-120q-150 0-255-105T120-480q0-150 105-255t255-105q14 0 27.5 1t26.5 3q-41 29-65.5 75.5T444-660q0 90 63 153t153 63q55 0 101-24.5t75-65.5q2 13 3 26.5t1 27.5q0 150-105 255T480-120Z"/>';
            } else {
                btnText.innerText = 'Dark Mode';
                icon.innerHTML = '<path d="M480-360q50 0 85-35t35-85q0-50-35-85t-85-35q-50 0-85 35t-35 85q0 50 35 85t85 35Z"/>';
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            if (localStorage.theme === 'dark') { updateThemeButton('Dark'); }
            else { updateThemeButton('Light'); }
        });
    </script>

    <style>
        .admin-table {
            border-radius: 12px;
            overflow: hidden;
        }

        .admin-table .table {
            margin-bottom: 0;
            color: var(--text-color) !important;
        }

        .admin-table .table thead th {
            background-color: var(--card-bg);
            color: var(--heading-color);
            border-bottom: 2px solid var(--border-color);
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 14px 16px;
        }

        .admin-table .table tbody td {
            padding: 14px 16px;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
            color: var(--text-color);
        }

        .admin-table .table tbody tr:hover {
            background-color: rgba(99, 102, 241, 0.04);
        }

        .admin-stat-card {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 14px;
            padding: 20px;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .admin-stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .admin-stat-card .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .admin-stat-card .stat-label {
            color: var(--text-color);
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 4px;
        }

        .admin-stat-card .stat-value {
            color: var(--heading-color);
            font-size: 22px;
            font-weight: 700;
        }

        .admin-page-title {
            color: var(--heading-color);
            font-weight: 700;
            font-size: 24px;
        }

        .admin-page-subtitle {
            color: var(--text-color);
            font-size: 14px;
        }

        .admin-card {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 14px;
            padding: 24px;
        }

        .dataTables_wrapper .dataTables_length label,
        .dataTables_wrapper .dataTables_filter label,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            color: var(--text-color) !important;
            font-size: 13px;
        }

        .dataTables_wrapper .dataTables_length select,
        .dataTables_wrapper .dataTables_filter input {
            background-color: var(--input-bg) !important;
            color: var(--input-text) !important;
            border: 1px solid var(--border-color) !important;
            border-radius: 8px !important;
            padding: 6px 10px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            color: var(--text-color) !important;
            border: 1px solid var(--border-color) !important;
            border-radius: 6px !important;
            background: var(--card-bg) !important;
            margin: 0 2px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: linear-gradient(135deg, #6366f1, #8b5cf6) !important;
            color: #fff !important;
            border-color: #6366f1 !important;
        }

        .admin-form-control {
            background-color: var(--input-bg) !important;
            color: var(--input-text) !important;
            border: 1px solid var(--border-color) !important;
            border-radius: 10px;
            padding: 10px 14px;
        }

        .admin-form-control:focus {
            border-color: #6366f1 !important;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15) !important;
        }

        .btn-admin-primary {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 10px 24px;
            font-weight: 600;
            transition: all 0.2s;
        }

        .btn-admin-primary:hover {
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: #fff;
            transform: translateY(-1px);
        }

        .admin-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .admin-badge-success {
            background: rgba(34, 197, 94, 0.15);
            color: #22c55e;
        }

        .admin-badge-danger {
            background: rgba(239, 68, 68, 0.15);
            color: #ef4444;
        }

        .admin-badge-warning {
            background: rgba(234, 179, 8, 0.15);
            color: #eab308;
        }

        .admin-badge-info {
            background: rgba(59, 130, 246, 0.15);
            color: #3b82f6;
        }

        .admin-nav-item {
            padding: 12px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--sidebar-text);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            border-radius: 10px;
            margin: 2px 10px;
            transition: all 0.2s;
        }

        .admin-nav-item:hover {
            background: rgba(99, 102, 241, 0.08);
            color: #6366f1;
        }

        .admin-nav-item.active {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: #fff !important;
        }

        .admin-nav-item i {
            width: 22px;
            text-align: center;
            font-size: 16px;
        }

        .admin-nav-divider {
            height: 1px;
            background: var(--border-color);
            margin: 8px 20px;
        }

        .admin-nav-label {
            padding: 10px 20px 4px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text-color);
            opacity: 0.6;
        }

        /* ── Dark-mode global helpers ─────────────────── */
        .dark .btn-close {
            filter: invert(1) grayscale(100%) brightness(200%);
        }

        .dark .modal-content {
            background: var(--card-bg) !important;
            color: var(--text-color) !important;
            border-color: var(--border-color) !important;
        }

        .dark .modal-header,
        .dark .modal-footer {
            border-color: var(--border-color) !important;
        }

        .dark .table {
            --bs-table-bg: transparent;
            --bs-table-color: var(--text-color);
            --bs-table-border-color: var(--border-color);
            --bs-table-striped-bg: rgba(255, 255, 255, .02);
            --bs-table-hover-bg: rgba(99, 102, 241, .06);
        }

        .dark .table> :not(caption)>*>* {
            background-color: transparent !important;
            color: var(--text-color);
            border-bottom-color: var(--border-color);
        }

        .dark .table thead th {
            background-color: var(--card-bg) !important;
            color: var(--heading-color) !important;
        }

        .dark .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: rgba(99, 102, 241, .15) !important;
            color: #818cf8 !important;
        }

        .dark .btn-outline-secondary {
            color: var(--text-color);
            border-color: var(--border-color);
        }

        .dark .btn-outline-secondary:hover {
            background: var(--input-bg);
            color: var(--heading-color);
            border-color: var(--border-color);
        }

        .dark .alert {
            border-color: var(--border-color);
        }

        .dark .form-check-input {
            background-color: var(--input-bg);
            border-color: var(--border-color);
        }

        .dark .form-check-input:checked {
            background-color: #6366f1;
            border-color: #6366f1;
        }

        /* ── Notification Bell ────────────────── */
        .notif-bell {
            position: relative;
            cursor: pointer;
            padding: 6px;
            border-radius: 8px;
            transition: background 0.2s;
        }

        .notif-bell:hover {
            background: rgba(255, 255, 255, 0.12);
        }

        .notif-badge {
            position: absolute;
            top: 2px;
            right: 2px;
            min-width: 18px;
            height: 18px;
            border-radius: 50%;
            background: #ef4444;
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            line-height: 1;
            padding: 0 4px;
        }

        .notif-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            width: 380px;
            max-height: 460px;
            background: var(--card-bg, #fff);
            border: 1px solid var(--border-color, #e5e7eb);
            border-radius: 14px;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
            z-index: 9999;
            display: none;
            overflow: hidden;
        }

        .notif-dropdown.show {
            display: block;
        }

        .notif-dropdown-header {
            padding: 16px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--border-color, #e5e7eb);
        }

        .notif-dropdown-header h6 {
            margin: 0;
            font-weight: 700;
            font-size: 15px;
            color: var(--heading-color, #1e1b4b);
        }

        .notif-dropdown-body {
            max-height: 360px;
            overflow-y: auto;
        }

        .notif-item {
            padding: 14px 20px;
            display: flex;
            gap: 12px;
            align-items: flex-start;
            border-bottom: 1px solid var(--border-color, #f0f0f0);
            transition: background 0.15s;
            cursor: pointer;
        }

        .notif-item:hover {
            background: rgba(99, 102, 241, 0.04);
        }

        .notif-item.unread {
            background: rgba(99, 102, 241, 0.06);
        }

        .notif-item-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 16px;
        }

        .notif-item-content {
            flex: 1;
            min-width: 0;
        }

        .notif-item-title {
            font-size: 13px;
            font-weight: 600;
            color: var(--heading-color, #1e1b4b);
            margin-bottom: 2px;
        }

        .notif-item-msg {
            font-size: 12px;
            color: var(--text-color, #6b7280);
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .notif-item-time {
            font-size: 11px;
            color: #9ca3af;
            margin-top: 3px;
        }

        .notif-empty {
            padding: 40px 20px;
            text-align: center;
            color: var(--text-color, #9ca3af);
        }

        .notif-empty i {
            font-size: 32px;
            margin-bottom: 8px;
            opacity: 0.4;
        }

        @media (max-width: 480px) {
            .notif-dropdown {
                width: calc(100vw - 24px);
                right: -60px;
            }
        }

        /* Toast popup */
        .notif-toast {
            position: fixed;
            top: 70px;
            right: 20px;
            width: 360px;
            background: var(--card-bg, #fff);
            border: 1px solid var(--border-color, #e5e7eb);
            border-radius: 14px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
            z-index: 99999;
            padding: 16px 20px;
            display: flex;
            gap: 12px;
            align-items: flex-start;
            animation: slideInRight 0.35s ease;
            transition: opacity 0.3s, transform 0.3s;
        }

        .notif-toast.hide {
            opacity: 0;
            transform: translateX(40px);
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(40px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
    </style>
</head>

<body>
    <!-- Top Navigation -->
    <div class="top-nav">
        <div class="d-flex align-items-center">
            <button class="btn mobile-menu me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#adminSidebar"
                aria-controls="adminSidebar">
                <i class="bi bi-list fs-4"></i>
            </button>
            <div class="mt-1">
                <a href="{{ route('admin.home') }}" class="text-decoration-none text-white fw-bold fs-5">
                    Tradedgepip <span class="admin-badge admin-badge-info ms-1"
                        style="font-size:10px;">ADMIN</span>
                </a>
            </div>
        </div>
        <div class="text-white d-flex align-items-center gap-3">
            <!-- Notification Bell -->
            <div class="position-relative" id="notifBellWrap">
                <div class="notif-bell" onclick="toggleNotifDropdown(event)">
                    <i class="bi bi-bell-fill" style="font-size:18px;"></i>
                    <span class="notif-badge" id="notifBadge" style="display:none;">0</span>
                </div>
                <div class="notif-dropdown" id="notifDropdown">
                    <div class="notif-dropdown-header">
                        <h6><i class="bi bi-bell me-1"></i> Notifications</h6>
                        <button class="btn btn-sm" onclick="markAllRead()"
                            style="font-size:12px;color:#6366f1;font-weight:600;background:none;border:none;padding:0;">Mark
                            all read</button>
                    </div>
                    <div class="notif-dropdown-body" id="notifList">
                        <div class="notif-empty">
                            <i class="bi bi-bell-slash d-block"></i>
                            <span style="font-size:13px;">No notifications yet</span>
                        </div>
                    </div>
                </div>
            </div>

            <span class="d-none d-md-block" style="font-size:14px;">{{ Auth::guard('admin')->user()->name ?? 'Admin'
                }}</span>
            <a href="{{ route('logout') }}" class="btn btn-sm"
                style="background: rgba(239,68,68,0.15); color:#ef4444; border-radius:8px; font-size:12px; font-weight:600;">
                <i class="bi bi-box-arrow-right me-1"></i>Logout
            </a>
        </div>
    </div>

    <!-- Admin Sidebar -->
    <div class="sidebar offcanvas offcanvas-start" tabindex="-1" id="adminSidebar" data-bs-scroll="true"
        data-bs-backdrop="true">
        <div
            class="profile-section mb-0 d-flex flex-column align-items-center justify-content-center border-bottom border-light border-opacity-10">
            <div class="d-block align-items-center text-center gap-3 w-100">
                <div class="d-flex justify-content-end p-2">
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="py-2">
                    <div
                        style="width:50px;height:50px;border-radius:50%;background:linear-gradient(135deg,#6366f1,#8b5cf6);display:inline-flex;align-items:center;justify-content:center;">
                        <i class="bi bi-shield-lock-fill text-white fs-4"></i>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="fw-bold text-white fs-5">{{ Auth::guard('admin')->user()->name ?? 'Admin' }}</div>
                    <div class="small text-white opacity-75">Administrator</div>
                </div>
            </div>
        </div>

        <!-- Theme Toggle -->
        <div class="nav-section mt-2 cursor-pointer" onclick="toggleTheme()" style="cursor: pointer;">
            <div class="nav-section-title d-flex align-items-center">
                <svg id="theme-toggle-icon" xmlns="http://www.w3.org/2000/svg" height="23px" viewBox="0 -960 960 960"
                    width="23px" fill="currentColor">
                    <path d="M480-360q50 0 85-35t35-85q0-50-35-85t-85-35q-50 0-85 35t-35 85q0 50 35 85t85 35Z" />
                </svg>
                <span class="px-2" id="theme-toggle-text">Dark Mode</span>
            </div>
        </div>

        <div class="admin-nav-label">Main</div>
        <a href="{{ route('admin.home') }}"
            class="admin-nav-item {{ request()->routeIs('admin.home') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2-fill"></i> Dashboard
        </a>

        <div class="admin-nav-label">Management</div>
        <a href="{{ route('manage.users.page') }}"
            class="admin-nav-item {{ request()->routeIs('manage.users.page') ? 'active' : '' }}">
            <i class="bi bi-people-fill"></i> Manage Users
        </a>
        <a href="{{ route('admin.deposits.index') }}"
            class="admin-nav-item {{ request()->routeIs('admin.deposits.*') ? 'active' : '' }}">
            <i class="bi bi-box-arrow-in-down"></i> Manage Deposits
        </a>
        <a href="{{ route('admin.withdrawals.index') }}"
            class="admin-nav-item {{ request()->routeIs('admin.withdrawals.*') ? 'active' : '' }}">
            <i class="bi bi-box-arrow-up"></i> Manage Withdrawals
        </a>

        <div class="admin-nav-label">Trading</div>
        <a href="{{ route('admin.plans.index') }}"
            class="admin-nav-item {{ request()->routeIs('admin.plans.*') ? 'active' : '' }}">
            <i class="bi bi-layers-fill"></i> Manage Plans
        </a>
        <a href="{{ route('traders.index') }}"
            class="admin-nav-item {{ request()->routeIs('traders.*') ? 'active' : '' }}">
            <i class="bi bi-arrow-left-right"></i> Manage Copy Traders
        </a>
        <a href="{{ route('admin.trading-histories.index') }}"
            class="admin-nav-item {{ request()->routeIs('admin.trading-histories.*') ? 'active' : '' }}">
            <i class="bi bi-clock-history"></i> Trading History
        </a>

        <div class="admin-nav-label">Settings</div>
        <a href="{{ route('payment.index') }}"
            class="admin-nav-item {{ request()->routeIs('payment.*') ? 'active' : '' }}">
            <i class="bi bi-credit-card-fill"></i> Payment Settings
        </a>
        <a href="{{ route('admin.profile') }}"
            class="admin-nav-item {{ request()->routeIs('admin.profile') ? 'active' : '' }}">
            <i class="bi bi-gear-fill"></i> Admin Settings
        </a>
        @if(Auth::guard('admin')->user()->role === 'super_admin')
        <a href="{{ route('admin.administrators.index') }}"
            class="admin-nav-item {{ request()->routeIs('admin.administrators.*') ? 'active' : '' }}">
            <i class="bi bi-person-fill-lock"></i> Manage Admins
        </a>
        @endif

        <div class="admin-nav-divider"></div>
        <a href="{{ route('logout') }}" class="admin-nav-item" style="color: #ef4444;">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </div>