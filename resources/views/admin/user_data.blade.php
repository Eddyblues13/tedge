@include('admin.header')

<style>
    .user-profile-hero {
        background: linear-gradient(135deg, rgba(99, 91, 255, 0.1), rgba(139, 131, 255, 0.05));
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 28px;
        margin-bottom: 24px;
        position: relative;
    }

    .user-profile-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(99, 91, 255, 0.08), transparent 70%);
        border-radius: 50%;
    }

    .user-avatar-lg {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, #635bff, #8b83ff);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        font-weight: 700;
        color: #fff;
        border: 3px solid var(--card-bg);
        box-shadow: 0 4px 16px rgba(99, 91, 255, 0.25);
        overflow: hidden;
    }

    .user-avatar-lg img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .user-meta-badges {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
        margin-top: 8px;
    }

    .meta-pill {
        font-size: 0.7rem;
        padding: 3px 10px;
        border-radius: 20px;
        font-weight: 600;
    }

    .meta-pill.verified {
        background: rgba(16, 185, 129, 0.12);
        color: #10b981;
    }

    .meta-pill.unverified {
        background: rgba(239, 68, 68, 0.12);
        color: #ef4444;
    }

    .meta-pill.info {
        background: rgba(99, 91, 255, 0.12);
        color: var(--accent-color);
    }

    .balance-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 12px;
        margin-bottom: 24px;
    }

    .balance-tile {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 16px 18px;
        transition: all 0.2s;
        cursor: default;
        position: relative;
        overflow: hidden;
    }

    .balance-tile:hover {
        border-color: var(--accent-color);
        transform: translateY(-2px);
        box-shadow: 0 4px 16px rgba(99, 91, 255, 0.1);
    }

    .balance-tile .tile-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.85rem;
        margin-bottom: 10px;
    }

    .balance-tile .tile-label {
        font-size: 0.72rem;
        color: var(--text-color);
        opacity: 0.6;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .balance-tile .tile-value {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--heading-color);
        margin-top: 2px;
    }

    .balance-tile .tile-action {
        position: absolute;
        top: 12px;
        right: 12px;
        width: 26px;
        height: 26px;
        border-radius: 6px;
        background: rgba(99, 91, 255, 0.08);
        border: none;
        color: var(--accent-color);
        font-size: 0.7rem;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        opacity: 0;
        transition: opacity 0.2s;
    }

    .balance-tile:hover .tile-action {
        opacity: 1;
    }

    .quick-links {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .quick-link-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        border-radius: 10px;
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        color: var(--text-color);
        font-size: 0.82rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s;
    }

    .quick-link-btn:hover {
        border-color: var(--accent-color);
        color: var(--accent-color);
        background: rgba(99, 91, 255, 0.05);
    }

    .quick-link-btn i {
        font-size: 0.78rem;
        opacity: 0.7;
    }

    .info-section {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 14px;
        overflow: hidden;
        margin-bottom: 24px;
    }

    .info-section-header {
        padding: 16px 22px;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .info-section-header h6 {
        margin: 0;
        color: var(--heading-color);
        font-weight: 600;
        font-size: 0.92rem;
    }

    .info-row {
        display: flex;
        align-items: center;
        padding: 12px 22px;
        border-bottom: 1px solid var(--border-color);
        transition: background 0.15s;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-row:hover {
        background: rgba(99, 91, 255, 0.02);
    }

    .info-label {
        width: 200px;
        min-width: 160px;
        font-weight: 500;
        color: var(--heading-color);
        font-size: 0.85rem;
    }

    .info-value {
        flex: 1;
        color: var(--text-color);
        font-size: 0.85rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .info-value .admin-form-control {
        border-radius: 8px !important;
        max-width: 280px;
        font-size: 0.85rem;
    }

    .info-edit-btn {
        width: 28px;
        height: 28px;
        border-radius: 6px;
        background: rgba(99, 91, 255, 0.08);
        border: none;
        color: var(--accent-color);
        font-size: 0.72rem;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
    }

    .info-edit-btn:hover {
        background: rgba(99, 91, 255, 0.15);
    }

    .info-save-btn {
        padding: 4px 14px;
        border-radius: 6px;
        background: #10b981;
        border: none;
        color: #fff;
        font-size: 0.75rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }

    .info-save-btn:hover {
        background: #059669;
    }

    .dropdown-menu.action-menu {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 6px;
        min-width: 220px;
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.3);
    }

    .dropdown-menu.action-menu .dropdown-item {
        color: var(--text-color);
        font-size: 0.84rem;
        border-radius: 8px;
        padding: 8px 14px;
        transition: all 0.15s;
    }

    .dropdown-menu.action-menu .dropdown-item:hover {
        background: rgba(99, 91, 255, 0.08);
        color: var(--accent-color);
    }

    .dropdown-menu.action-menu .dropdown-item i {
        width: 20px;
        text-align: center;
        margin-right: 8px;
        opacity: 0.6;
    }

    .dropdown-menu.action-menu .dropdown-divider {
        border-color: var(--border-color);
        margin: 4px 0;
    }

    .modal-content.admin-modal {
        background: var(--card-bg);
        color: var(--text-color);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
    }

    .modal-content.admin-modal .modal-header {
        border-bottom: 1px solid var(--border-color);
        padding: 20px 24px;
    }

    .modal-content.admin-modal .modal-body {
        padding: 24px;
    }

    .modal-content.admin-modal .modal-title {
        color: var(--heading-color);
        font-weight: 600;
        font-size: 1.05rem;
    }

    .modal-content.admin-modal .btn-close {
        filter: invert(1) grayscale(100%) brightness(200%);
    }

    .modal-content.admin-modal .admin-form-control {
        border-radius: 10px !important;
    }

    .modal-content.admin-modal .form-label {
        color: var(--heading-color);
        font-weight: 500;
        font-size: 0.88rem;
    }

    @media (max-width: 992px) {
        .balance-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 576px) {
        .balance-grid {
            grid-template-columns: 1fr 1fr;
            gap: 8px;
        }

        .balance-tile {
            padding: 12px 14px;
        }

        .balance-tile .tile-value {
            font-size: 0.95rem;
        }

        .user-profile-hero {
            padding: 20px;
        }

        .info-row {
            flex-direction: column;
            align-items: flex-start;
            gap: 6px;
        }

        .info-label {
            width: auto;
            min-width: auto;
        }
    }
</style>

<div class="main-content">
    <div class="container-fluid">
        @if(session('message'))
        <div class="alert alert-success alert-dismissible fade show mb-3">{{ session('message') }}<button type="button"
                class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-3">{{ session('error') }}<button type="button"
                class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-3">{{ session('success') }}<button type="button"
                class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif

        <!-- User Profile Hero -->
        <div class="user-profile-hero">
            <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="user-avatar-lg">
                        @if($user->profile_photo_url)
                        <img src="{{ asset($user->profile_photo_url) }}" alt="{{ $user->first_name }}">
                        @else
                        {{ strtoupper(substr($user->first_name ?? 'U', 0, 1)) }}{{ strtoupper(substr($user->last_name ??
                        '', 0, 1)) }}
                        @endif
                    </div>
                    <div>
                        <h4 style="color:var(--heading-color);font-weight:700;margin:0;">{{ $user->first_name }} {{
                            $user->last_name }}</h4>
                        <p style="color:var(--text-color);opacity:0.6;font-size:0.85rem;margin:2px 0 0;">{{ $user->email
                            }}</p>
                        <div class="user-meta-badges">
                            <span class="meta-pill {{ $user->email_verification ? 'verified' : 'unverified' }}">
                                <i
                                    class="fas fa-{{ $user->email_verification ? 'check-circle' : 'times-circle' }} me-1"></i>Email
                            </span>
                            <span class="meta-pill {{ $user->id_verification ? 'verified' : 'unverified' }}">
                                <i
                                    class="fas fa-{{ $user->id_verification ? 'check-circle' : 'times-circle' }} me-1"></i>ID
                            </span>
                            <span class="meta-pill {{ $user->address_verification ? 'verified' : 'unverified' }}">
                                <i
                                    class="fas fa-{{ $user->address_verification ? 'check-circle' : 'times-circle' }} me-1"></i>Address
                            </span>
                            <span class="meta-pill info">
                                <i class="fas fa-signal me-1"></i>{{ $user->signal_strength ?? 0 }}%
                            </span>
                        </div>
                    </div>
                </div>
                <div class="d-flex gap-2 align-items-start">
                    <a href="{{ route('manage.users.page') }}" class="btn btn-sm"
                        style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);border-radius:10px;padding:7px 16px;font-size:0.82rem;">
                        <i class="fas fa-arrow-left me-1"></i> Back
                    </a>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-admin-primary dropdown-toggle" type="button"
                            data-bs-toggle="dropdown" style="border-radius:10px;padding:7px 16px;font-size:0.82rem;">
                            <i class="fas fa-bolt me-1"></i> Actions
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end action-menu">
                            <li class="px-2 py-1"><small
                                    style="color:var(--text-color);opacity:0.4;font-size:0.7rem;text-transform:uppercase;letter-spacing:0.5px;">Balances</small>
                            </li>
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                    data-bs-target="#holdingBalanceModal"><i class="fas fa-wallet"></i>Holding
                                    Balance</a></li>
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                    data-bs-target="#tradingBalanceModal"><i class="fas fa-chart-line"></i>Trading
                                    Balance</a></li>
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                    data-bs-target="#stakingBalanceModal"><i class="fas fa-layer-group"></i>Staking
                                    Balance</a></li>
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                    data-bs-target="#miningBalanceModal"><i class="fas fa-hammer"></i>Mining Balance</a>
                            </li>
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                    data-bs-target="#referralBalanceModal"><i class="fas fa-users"></i>Referral
                                    Balance</a></li>
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                    data-bs-target="#profitBalanceModal"><i class="fas fa-coins"></i>Profit</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li class="px-2 py-1"><small
                                    style="color:var(--text-color);opacity:0.4;font-size:0.7rem;text-transform:uppercase;letter-spacing:0.5px;">Transactions</small>
                            </li>
                            <li><a class="dropdown-item"
                                    href="{{ route('admin.users.deposits.index', ['user' => $user->id]) }}"><i
                                        class="fas fa-arrow-down"></i>Edit Deposits</a></li>
                            <li><a class="dropdown-item"
                                    href="{{ route('admin.users.withdrawals.index', ['user' => $user->id]) }}"><i
                                        class="fas fa-arrow-up"></i>Edit Withdrawals</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li class="px-2 py-1"><small
                                    style="color:var(--text-color);opacity:0.4;font-size:0.7rem;text-transform:uppercase;letter-spacing:0.5px;">Account</small>
                            </li>
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                    data-bs-target="#sendmailtooneuserModal"><i class="fas fa-envelope"></i>Send
                                    Email</a></li>
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                    data-bs-target="#switchuserModal" style="color:#10b981 !important;"><i
                                        class="fas fa-user-secret"></i>Gain Access</a></li>
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                    style="color:#ef4444 !important;"><i class="fas fa-trash-alt"></i>Delete User</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Balance Tiles -->
        <div class="balance-grid">
            <div class="balance-tile">
                <div class="tile-icon" style="background:rgba(59,130,246,0.1);color:#3b82f6;"><i
                        class="fas fa-wallet"></i></div>
                <div class="tile-label">Deposit Balance</div>
                <div class="tile-value">{{ config('currencies.' . $user->currency, '$') }}{{
                    number_format($deposit_balance ?? 0, 2, '.', ',') }}</div>
            </div>
            <div class="balance-tile">
                <button class="tile-action" data-bs-toggle="modal" data-bs-target="#holdingBalanceModal"><i
                        class="fas fa-pen"></i></button>
                <div class="tile-icon" style="background:rgba(16,185,129,0.1);color:#10b981;"><i
                        class="fas fa-hand-holding-usd"></i></div>
                <div class="tile-label">Holding Balance</div>
                <div class="tile-value">{{ config('currencies.' . $user->currency, '$') }}{{
                    number_format($holding_balance, 2, '.', ',') }}</div>
            </div>
            <div class="balance-tile">
                <button class="tile-action" data-bs-toggle="modal" data-bs-target="#tradingBalanceModal"><i
                        class="fas fa-pen"></i></button>
                <div class="tile-icon" style="background:rgba(139,92,246,0.1);color:#8b5cf6;"><i
                        class="fas fa-chart-line"></i></div>
                <div class="tile-label">Trading Balance</div>
                <div class="tile-value">{{ config('currencies.' . $user->currency, '$') }}{{
                    number_format($trading_balance, 2, '.', ',') }}</div>
            </div>
            <div class="balance-tile">
                <button class="tile-action" data-bs-toggle="modal" data-bs-target="#stakingBalanceModal"><i
                        class="fas fa-pen"></i></button>
                <div class="tile-icon" style="background:rgba(245,158,11,0.1);color:#f59e0b;"><i
                        class="fas fa-layer-group"></i></div>
                <div class="tile-label">Staking Balance</div>
                <div class="tile-value">{{ config('currencies.' . $user->currency, '$') }}{{
                    number_format($staking_balance ?? 0, 2, '.', ',') }}</div>
            </div>
            <div class="balance-tile">
                <button class="tile-action" data-bs-toggle="modal" data-bs-target="#miningBalanceModal"><i
                        class="fas fa-pen"></i></button>
                <div class="tile-icon" style="background:rgba(236,72,153,0.1);color:#ec4899;"><i
                        class="fas fa-hammer"></i></div>
                <div class="tile-label">Mining Balance</div>
                <div class="tile-value">{{ config('currencies.' . $user->currency, '$') }}{{
                    number_format($mining_balance, 2, '.', ',') }}</div>
            </div>
            <div class="balance-tile">
                <button class="tile-action" data-bs-toggle="modal" data-bs-target="#referralBalanceModal"><i
                        class="fas fa-pen"></i></button>
                <div class="tile-icon" style="background:rgba(6,182,212,0.1);color:#06b6d4;"><i
                        class="fas fa-users"></i></div>
                <div class="tile-label">Referral Balance</div>
                <div class="tile-value">{{ config('currencies.' . $user->currency, '$') }}{{
                    number_format($referral_balance, 2, '.', ',') }}</div>
            </div>
            <div class="balance-tile">
                <button class="tile-action" data-bs-toggle="modal" data-bs-target="#profitBalanceModal"><i
                        class="fas fa-pen"></i></button>
                <div class="tile-icon" style="background:rgba(16,185,129,0.1);color:#10b981;"><i
                        class="fas fa-coins"></i></div>
                <div class="tile-label">Profit</div>
                <div class="tile-value">{{ config('currencies.' . $user->currency, '$') }}{{
                    number_format($profit_balance, 2, '.', ',') }}</div>
            </div>
            <div class="balance-tile">
                <div class="tile-icon" style="background:rgba(99,91,255,0.1);color:var(--accent-color);"><i
                        class="fas fa-chart-pie"></i></div>
                <div class="tile-label">Total Deposits</div>
                <div class="tile-value">{{ config('currencies.' . $user->currency, '$') }}{{
                    number_format($successful_deposits_sum, 2, '.', ',') }}</div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="admin-card mb-4" style="border-radius:14px;padding:18px 22px;">
            <h6 style="color:var(--heading-color);font-weight:600;font-size:0.88rem;margin-bottom:14px;">
                <i class="fas fa-zap me-2" style="color:var(--accent-color);"></i>Quick Actions
            </h6>
            <div class="quick-links">
                <a class="quick-link-btn"
                    href="{{ route('admin.users.trading-histories.index', ['user' => $user->id]) }}">
                    <i class="fas fa-chart-bar"></i> Add Trade
                </a>
                <a class="quick-link-btn" href="{{ route('admin.users.edit', ['user' => $user->id]) }}">
                    <i class="fas fa-user-edit"></i> Edit User
                </a>
                <a class="quick-link-btn"
                    href="{{ route('admin.users.identity-verifications.index', ['user' => $user->id]) }}">
                    <i class="fas fa-id-card"></i> ID Verification
                </a>
                <a class="quick-link-btn"
                    href="{{ route('admin.users.address-verifications.index', ['user' => $user->id]) }}">
                    <i class="fas fa-map-marker-alt"></i> Address Verification
                </a>
                <a class="quick-link-btn" href="{{ route('admin.users.deposits.index', ['user' => $user->id]) }}">
                    <i class="fas fa-arrow-down"></i> Deposits
                </a>
                <a class="quick-link-btn" href="{{ route('admin.users.withdrawals.index', ['user' => $user->id]) }}">
                    <i class="fas fa-arrow-up"></i> Withdrawals
                </a>
            </div>
        </div>

        <!-- User Information -->
        <div class="row g-3 mb-4">
            <!-- Plan Management -->
            <div class="col-12">
                <div class="info-section mb-0">
                    <div class="info-section-header">
                        <h6><i class="fas fa-layer-group me-2" style="color:var(--accent-color);"></i>Plan Management
                        </h6>
                    </div>
                    <div style="padding:20px 22px;">
                        <!-- Assign Plan Form -->
                        <form id="assignPlanForm" class="mb-4">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <div class="row g-3 align-items-end">
                                <div class="col-md-3">
                                    <label class="form-label"
                                        style="color:var(--heading-color);font-weight:500;font-size:0.85rem;">Select
                                        Plan</label>
                                    <select class="admin-form-control" name="plan_id" id="assignPlanSelect" required>
                                        <option value="">Choose a plan...</option>
                                        @foreach($plans as $plan)
                                        <option value="{{ $plan->id }}" data-price="{{ $plan->price }}">{{ $plan->name
                                            }} — {{ config('currencies.' . ($user->currency ?? 'USD'), '$') }}{{
                                            number_format($plan->price, 2) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label"
                                        style="color:var(--heading-color);font-weight:500;font-size:0.85rem;">Amount</label>
                                    <input type="number" class="admin-form-control" name="amount" id="assignPlanAmount"
                                        step="0.01" placeholder="0.00" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label"
                                        style="color:var(--heading-color);font-weight:500;font-size:0.85rem;">Source
                                        Account</label>
                                    <select class="admin-form-control" name="account_type" required>
                                        <option value="trading">Trading Balance</option>
                                        <option value="holding">Holding Balance</option>
                                        <option value="staking">Staking Balance</option>
                                        <option value="deposit">Deposit Balance</option>
                                        <option value="profit">Profit</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-admin-primary w-100"
                                        style="border-radius:10px;padding:9px 16px;font-size:0.85rem;">
                                        <i class="fas fa-plus me-1"></i> Assign Plan
                                    </button>
                                </div>
                            </div>
                        </form>

                        <!-- Plan History Table -->
                        @if(isset($planHistories) && $planHistories->count() > 0)
                        <div style="overflow-x:auto;">
                            <table class="table table-sm mb-0" style="color:var(--text-color);font-size:0.85rem;">
                                <thead>
                                    <tr style="border-bottom:2px solid var(--border-color);">
                                        <th
                                            style="color:var(--heading-color);font-weight:600;padding:10px 12px;font-size:0.78rem;text-transform:uppercase;letter-spacing:0.5px;">
                                            Plan</th>
                                        <th
                                            style="color:var(--heading-color);font-weight:600;padding:10px 12px;font-size:0.78rem;text-transform:uppercase;letter-spacing:0.5px;">
                                            Amount</th>
                                        <th
                                            style="color:var(--heading-color);font-weight:600;padding:10px 12px;font-size:0.78rem;text-transform:uppercase;letter-spacing:0.5px;">
                                            Account</th>
                                        <th
                                            style="color:var(--heading-color);font-weight:600;padding:10px 12px;font-size:0.78rem;text-transform:uppercase;letter-spacing:0.5px;">
                                            Date</th>
                                        <th
                                            style="color:var(--heading-color);font-weight:600;padding:10px 12px;font-size:0.78rem;text-transform:uppercase;letter-spacing:0.5px;text-align:right;">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($planHistories as $history)
                                    <tr style="border-bottom:1px solid var(--border-color);">
                                        <td style="padding:12px;">
                                            <div style="display:flex;align-items:center;gap:10px;">
                                                <div
                                                    style="width:32px;height:32px;border-radius:8px;background:rgba(99,91,255,0.1);display:flex;align-items:center;justify-content:center;">
                                                    <i class="fas fa-layer-group"
                                                        style="color:var(--accent-color);font-size:0.75rem;"></i>
                                                </div>
                                                <span style="font-weight:600;color:var(--heading-color);">{{
                                                    $history->plan->name ?? 'Deleted Plan' }}</span>
                                            </div>
                                        </td>
                                        <td style="padding:12px;font-weight:600;">{{ config('currencies.' .
                                            ($user->currency ?? 'USD'), '$') }}{{ number_format($history->amount, 2) }}
                                        </td>
                                        <td style="padding:12px;"><span class="meta-pill info">{{
                                                ucfirst($history->account_type) }}</span></td>
                                        <td style="padding:12px;opacity:0.7;">{{ $history->created_at->format('M d, Y
                                            h:i A') }}</td>
                                        <td style="padding:12px;text-align:right;">
                                            <button class="btn btn-sm delete-plan-btn" data-id="{{ $history->id }}"
                                                style="background:rgba(239,68,68,0.1);color:#ef4444;border:none;border-radius:8px;padding:5px 12px;font-size:0.78rem;font-weight:600;">
                                                <i class="fas fa-trash-alt me-1"></i> Remove
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div style="text-align:center;padding:20px 0;">
                            <div
                                style="width:48px;height:48px;border-radius:50%;background:rgba(99,91,255,0.08);display:flex;align-items:center;justify-content:center;margin:0 auto 12px;">
                                <i class="fas fa-layer-group"
                                    style="color:var(--accent-color);font-size:1rem;opacity:0.5;"></i>
                            </div>
                            <p style="color:var(--text-color);opacity:0.5;font-size:0.88rem;margin:0;">No plans assigned
                                yet</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Personal Information -->
        <div class="info-section">
            <div class="info-section-header">
                <h6><i class="fas fa-user-circle me-2" style="color:var(--accent-color);"></i>Personal Information</h6>
            </div>
            @php
            $personalFields = [
            'first_name' => ['label' => 'First Name', 'icon' => 'fa-user'],
            'last_name' => ['label' => 'Last Name', 'icon' => 'fa-user'],
            'email' => ['label' => 'Email Address', 'icon' => 'fa-envelope'],
            'phone_number' => ['label' => 'Phone Number', 'icon' => 'fa-phone'],
            'currency' => ['label' => 'Currency', 'icon' => 'fa-dollar-sign'],
            'active_plan' => ['label' => 'Active Plan', 'icon' => 'fa-layer-group'],
            'country' => ['label' => 'Country', 'icon' => 'fa-globe'],
            'city' => ['label' => 'City', 'icon' => 'fa-city'],
            ];
            @endphp
            @foreach($personalFields as $key => $meta)
            <div class="info-row">
                <div class="info-label"><i class="fas {{ $meta['icon'] }} me-2"
                        style="opacity:0.4;font-size:0.78rem;"></i>{{ $meta['label'] }}</div>
                <div class="info-value">
                    <span id="display-{{ $key }}" style="color:var(--text-color);">{{ $user->$key ?? '—' }}</span>
                    <input type="text" class="admin-form-control d-none" id="input-{{ $key }}"
                        value="{{ $user->$key }}">
                    <button class="info-edit-btn edit-btn" data-field="{{ $key }}" title="Edit"><i
                            class="fas fa-pen"></i></button>
                    <button class="info-save-btn save-btn d-none" data-field="{{ $key }}">Save</button>
                </div>
            </div>
            @endforeach
        </div>

        <div class="row g-3 mb-4">
            <!-- Verification & Status -->
            <div class="col-md-6">
                <div class="info-section mb-0">
                    <div class="info-section-header">
                        <h6><i class="fas fa-shield-alt me-2" style="color:var(--accent-color);"></i>Verification &
                            Status</h6>
                    </div>
                    @php
                    $verificationFields = [
                    'email_verification' => ['label' => 'Email Verification', 'icon' => 'fa-envelope-open-text'],
                    'id_verification' => ['label' => 'ID Verification', 'icon' => 'fa-id-badge'],
                    'address_verification' => ['label' => 'Address Verification', 'icon' => 'fa-map-marked-alt'],
                    'user_status' => ['label' => 'Account Status', 'icon' => 'fa-toggle-on'],
                    'signal_strength' => ['label' => 'Signal Strength', 'icon' => 'fa-signal'],
                    ];
                    @endphp
                    @foreach($verificationFields as $key => $meta)
                    <div class="info-row">
                        <div class="info-label"><i class="fas {{ $meta['icon'] }} me-2"
                                style="opacity:0.4;font-size:0.78rem;"></i>{{ $meta['label'] }}</div>
                        <div class="info-value">
                            @if(in_array($key, ['email_verification', 'id_verification', 'address_verification']))
                            <span id="display-{{ $key }}">
                                <span class="meta-pill {{ $user->$key ? 'verified' : 'unverified' }}">
                                    {{ $user->$key ? '✓ Verified' : '✗ Not Verified' }}
                                </span>
                            </span>
                            <select class="admin-form-control d-none" id="input-{{ $key }}" style="max-width:180px;">
                                <option value="1" {{ $user->$key ? 'selected' : '' }}>Verified</option>
                                <option value="0" {{ !$user->$key ? 'selected' : '' }}>Not Verified</option>
                            </select>
                            @else
                            <span id="display-{{ $key }}" style="color:var(--text-color);">{{ $user->$key ?? '—' }}{{
                                $key === 'signal_strength' ? '%' : '' }}</span>
                            <input type="text" class="admin-form-control d-none" id="input-{{ $key }}"
                                value="{{ $user->$key }}" style="max-width:180px;">
                            @endif
                            <button class="info-edit-btn edit-btn" data-field="{{ $key }}" title="Edit"><i
                                    class="fas fa-pen"></i></button>
                            <button class="info-save-btn save-btn d-none" data-field="{{ $key }}">Save</button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Account Details -->
            <div class="col-md-6">
                <div class="info-section mb-0">
                    <div class="info-section-header">
                        <h6><i class="fas fa-cog me-2" style="color:var(--accent-color);"></i>Account Details</h6>
                    </div>
                    <div class="info-row">
                        <div class="info-label"><i class="fas fa-key me-2"
                                style="opacity:0.4;font-size:0.78rem;"></i>Password</div>
                        <div class="info-value">
                            <code
                                style="background:rgba(99,91,255,0.08);color:var(--accent-color);padding:3px 10px;border-radius:6px;font-size:0.82rem;">{{ $plain }}</code>
                        </div>
                    </div>
                    <div class="info-row">
                        <div class="info-label"><i class="fas fa-link me-2"
                                style="opacity:0.4;font-size:0.78rem;"></i>Referral Code</div>
                        <div class="info-value">
                            <span id="display-referral_code" style="color:var(--text-color);">{{ $user->referral_code ??
                                '—' }}</span>
                            <input type="text" class="admin-form-control d-none" id="input-referral_code"
                                value="{{ $user->referral_code }}" style="max-width:180px;">
                            <button class="info-edit-btn edit-btn" data-field="referral_code" title="Edit"><i
                                    class="fas fa-pen"></i></button>
                            <button class="info-save-btn save-btn d-none" data-field="referral_code">Save</button>
                        </div>
                    </div>
                    <div class="info-row">
                        <div class="info-label"><i class="fas fa-user-friends me-2"
                                style="opacity:0.4;font-size:0.78rem;"></i>Referred By</div>
                        <div class="info-value">
                            <span id="display-referred_by" style="color:var(--text-color);">{{ $user->referred_by ?? '—'
                                }}</span>
                            <input type="text" class="admin-form-control d-none" id="input-referred_by"
                                value="{{ $user->referred_by }}" style="max-width:180px;">
                            <button class="info-edit-btn edit-btn" data-field="referred_by" title="Edit"><i
                                    class="fas fa-pen"></i></button>
                            <button class="info-save-btn save-btn d-none" data-field="referred_by">Save</button>
                        </div>
                    </div>
                    <div class="info-row">
                        <div class="info-label"><i class="fas fa-image me-2"
                                style="opacity:0.4;font-size:0.78rem;"></i>Profile Photo</div>
                        <div class="info-value">
                            <span id="display-profile_photo">
                                @if($user->profile_photo_url)
                                <img src="{{ asset($user->profile_photo_url) }}" alt="Photo"
                                    style="width:44px;height:44px;border-radius:8px;object-fit:cover;border:1px solid var(--border-color);">
                                @else
                                <span style="opacity:0.5;">No photo</span>
                                @endif
                            </span>
                            <input type="file" class="admin-form-control d-none" id="input-profile_photo"
                                accept="image/*" style="max-width:240px;">
                            <button class="info-edit-btn edit-btn" data-field="profile_photo" title="Edit"><i
                                    class="fas fa-pen"></i></button>
                            <button class="info-save-btn save-btn d-none" data-field="profile_photo">Save</button>
                        </div>
                    </div>
                    <div class="info-row">
                        <div class="info-label"><i class="fas fa-calendar-alt me-2"
                                style="opacity:0.4;font-size:0.78rem;"></i>Registered</div>
                        <div class="info-value" style="color:var(--text-color);">
                            {{ \Carbon\Carbon::parse($user->created_at)->format('D, M j, Y g:i A') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Balance Modals -->
@php
$balanceModals = [
['id' => 'holdingBalanceModal', 'title' => 'Holding Balance', 'route' => 'update.holding.balance', 'icon' =>
'fa-hand-holding-usd', 'color' => '#10b981'],
['id' => 'tradingBalanceModal', 'title' => 'Trading Balance', 'route' => 'update.trading.balance', 'icon' =>
'fa-chart-line', 'color' => '#8b5cf6'],
['id' => 'stakingBalanceModal', 'title' => 'Staking Balance', 'route' => 'update.staking.balance', 'icon' =>
'fa-layer-group', 'color' => '#f59e0b'],
['id' => 'miningBalanceModal', 'title' => 'Mining Balance', 'route' => 'update.mining.balance', 'icon' => 'fa-hammer',
'color' => '#ec4899'],
['id' => 'referralBalanceModal', 'title' => 'Referral Balance', 'route' => 'update.referral.balance', 'icon' =>
'fa-users', 'color' => '#06b6d4'],
['id' => 'profitBalanceModal', 'title' => 'Profit', 'route' => 'update.profit.balance', 'icon' => 'fa-coins', 'color' =>
'#10b981'],
];
@endphp

@foreach($balanceModals as $modal)
<div id="{{ $modal['id'] }}" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content admin-modal">
            <div class="modal-header">
                <div>
                    <h5 class="modal-title"><i class="fas {{ $modal['icon'] }} me-2"
                            style="color:{{ $modal['color'] }};"></i>{{ $modal['title'] }}</h5>
                    <small style="color:var(--text-color);opacity:0.6;">Update {{ $user->first_name }}'s {{
                        strtolower($modal['title']) }}</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route($modal['route']) }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <div class="mb-3">
                        <label class="form-label">Amount</label>
                        <input class="admin-form-control" type="number" step="0.01" name="amount" placeholder="0.00"
                            required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Type</label>
                        <select class="admin-form-control" name="type" required>
                            <option value="credit">💰 Credit (Add funds)</option>
                            <option value="debit">📤 Debit (Remove funds)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description <small style="opacity:0.5;">(optional)</small></label>
                        <textarea class="admin-form-control" name="description" rows="2"
                            placeholder="Reason for this adjustment..."></textarea>
                    </div>
                    <div class="d-flex gap-2 justify-content-end">
                        <button type="button" class="btn"
                            style="background:transparent;color:var(--text-color);border:1px solid var(--border-color);border-radius:10px;padding:8px 20px;"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-admin-primary"
                            style="border-radius:10px;padding:8px 24px;">
                            <i class="fas fa-check me-1"></i> Update Balance
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Send Email Modal -->
<div id="sendmailtooneuserModal" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content admin-modal">
            <div class="modal-header">
                <div>
                    <h5 class="modal-title"><i class="fas fa-envelope me-2" style="color:var(--accent-color);"></i>Send
                        Email</h5>
                    <small style="color:var(--text-color);opacity:0.6;">Send a direct email to {{ $user->first_name
                        }}</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('admin.send.mail') }}">
                    @csrf
                    <input type="hidden" name="email" value="{{ $user->email }}">
                    <div class="mb-3">
                        <label class="form-label">Subject</label>
                        <input type="text" name="subject" class="admin-form-control"
                            placeholder="Enter email subject..." required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Message</label>
                        <textarea placeholder="Write your message here..." class="admin-form-control" name="message"
                            rows="5" required></textarea>
                    </div>
                    <div class="d-flex gap-2 justify-content-end">
                        <button type="button" class="btn"
                            style="background:transparent;color:var(--text-color);border:1px solid var(--border-color);border-radius:10px;padding:8px 20px;"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-admin-primary"
                            style="border-radius:10px;padding:8px 24px;">
                            <i class="fas fa-paper-plane me-1"></i> Send Email
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Switch User Modal -->
<div id="switchuserModal" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content admin-modal">
            <div class="modal-body text-center py-4">
                <div
                    style="width:64px;height:64px;border-radius:50%;background:rgba(16,185,129,0.1);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                    <i class="fas fa-user-secret" style="font-size:1.5rem;color:#10b981;"></i>
                </div>
                <h5 style="color:var(--heading-color);font-weight:700;margin-bottom:6px;">Login as {{ $user->first_name
                    }}?</h5>
                <p style="color:var(--text-color);opacity:0.6;font-size:0.88rem;">You'll be logged in as this user and
                    can view their dashboard. You can switch back anytime.</p>
                <div class="d-flex gap-2 justify-content-center mt-4">
                    <button type="button" class="btn"
                        style="background:transparent;color:var(--text-color);border:1px solid var(--border-color);border-radius:10px;padding:8px 28px;"
                        data-bs-dismiss="modal">Cancel</button>
                    <a class="btn" style="background:#10b981;color:#fff;border-radius:10px;padding:8px 28px;"
                        href="{{ route('users.impersonate', $user->id) }}">
                        <i class="fas fa-sign-in-alt me-1"></i> Yes, Proceed
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div id="deleteModal" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content admin-modal">
            <div class="modal-body text-center py-4">
                <div
                    style="width:64px;height:64px;border-radius:50%;background:rgba(239,68,68,0.1);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                    <i class="fas fa-trash-alt" style="font-size:1.5rem;color:#ef4444;"></i>
                </div>
                <h5 style="color:var(--heading-color);font-weight:700;margin-bottom:6px;">Delete {{ $user->first_name }}
                    {{ $user->last_name }}?</h5>
                <p style="color:var(--text-color);opacity:0.6;font-size:0.88rem;">This action is <strong
                        style="color:#ef4444;">permanent</strong> and cannot be undone. All user data, balances, and
                    transaction history will be lost.</p>
                <div class="d-flex gap-2 justify-content-center mt-4">
                    <button type="button" class="btn"
                        style="background:transparent;color:var(--text-color);border:1px solid var(--border-color);border-radius:10px;padding:8px 28px;"
                        data-bs-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger" style="border-radius:10px;padding:8px 28px;"
                        href="{{ route('delete.user', $user->id) }}">
                        <i class="fas fa-trash-alt me-1"></i> Yes, Delete
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {

    // Auto-fill amount when plan is selected
    const planSelect = document.getElementById('assignPlanSelect');
    const planAmount = document.getElementById('assignPlanAmount');
    if (planSelect && planAmount) {
        planSelect.addEventListener('change', function() {
            const selected = this.options[this.selectedIndex];
            if (selected.dataset.price) {
                planAmount.value = selected.dataset.price;
            }
        });
    }

    // Assign Plan form handler
    const assignPlanForm = document.getElementById('assignPlanForm');
    if (assignPlanForm) {
        assignPlanForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalHTML = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Assigning...';

            const formData = new FormData(this);

            fetch("{{ route('admin.user.plan.update') }}", {
                method: "POST",
                headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}", "Accept": "application/json" },
                body: formData
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    toastr.success(data.message || 'Plan assigned successfully!');
                    setTimeout(() => location.reload(), 1000);
                } else {
                    toastr.error(data.message || 'Error assigning plan.');
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalHTML;
                }
            })
            .catch(() => {
                toastr.error('An error occurred.');
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalHTML;
            });
        });
    }

    // Delete plan handler
    document.querySelectorAll('.delete-plan-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            if (!confirm('Are you sure you want to remove this plan?')) return;
            const planId = this.dataset.id;
            const row = this.closest('tr');

            fetch(`/admin/user/plan/${planId}`, {
                method: "DELETE",
                headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}", "Accept": "application/json" }
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    toastr.success(data.message || 'Plan removed!');
                    row.remove();
                } else {
                    toastr.error(data.message || 'Error removing plan.');
                }
            })
            .catch(() => toastr.error('An error occurred.'));
        });
    });

    // Edit button handler
    document.querySelectorAll(".edit-btn").forEach(button => {
        button.addEventListener("click", function() {
            const field = this.dataset.field;
            const display = document.getElementById(`display-${field}`);
            const input = document.getElementById(`input-${field}`);
            if (display) display.classList.add("d-none");
            if (input) input.classList.remove("d-none");
            this.classList.add("d-none");
            document.querySelector(`.save-btn[data-field='${field}']`).classList.remove("d-none");
        });
    });

    // Save button handler
    document.querySelectorAll(".save-btn").forEach(button => {
        button.addEventListener("click", function() {
            const field = this.dataset.field;
            const saveBtn = this;
            const editBtn = document.querySelector(`.edit-btn[data-field='${field}']`);
            const display = document.getElementById(`display-${field}`);
            const input = document.getElementById(`input-${field}`);

            saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            saveBtn.disabled = true;

            if (field === 'profile_photo') {
                const file = input.files[0];
                if (!file) { toastr.error("Please select a photo."); resetSaveBtn(); return; }
                const formData = new FormData();
                formData.append('photo', file);
                formData.append('user_id', "{{ $user->id }}");
                fetch("{{ route('admin.updateUser') }}", {
                    method: "POST",
                    headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" },
                    body: formData
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        display.innerHTML = `<img src="${data.new_value}" alt="Photo" style="width:44px;height:44px;border-radius:8px;object-fit:cover;border:1px solid var(--border-color);">`;
                        resetField();
                        toastr.success(data.message || 'Photo updated!');
                    } else { toastr.error(data.message || "Error updating photo."); resetSaveBtn(); }
                })
                .catch(() => { toastr.error("An error occurred."); resetSaveBtn(); });
            } else {
                const newValue = input.value;
                fetch("{{ route('admin.updateUser') }}", {
                    method: "POST",
                    headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": "{{ csrf_token() }}" },
                    body: JSON.stringify({ field: field, value: newValue, user_id: "{{ $user->id }}" })
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        if (['email_verification', 'id_verification', 'address_verification'].includes(field)) {
                            const isVerified = newValue === '1' || newValue === 1;
                            display.innerHTML = `<span class="meta-pill ${isVerified ? 'verified' : 'unverified'}">${isVerified ? '✓ Verified' : '✗ Not Verified'}</span>`;
                        } else {
                            display.textContent = newValue + (field === 'signal_strength' ? '%' : '');
                        }
                        resetField();
                        toastr.success("Updated successfully!");
                    } else { toastr.error("Error updating."); resetSaveBtn(); }
                })
                .catch(() => { toastr.error("An error occurred."); resetSaveBtn(); });
            }

            function resetField() {
                display.classList.remove("d-none");
                input.classList.add("d-none");
                saveBtn.classList.add("d-none");
                editBtn.classList.remove("d-none");
                saveBtn.innerHTML = 'Save';
                saveBtn.disabled = false;
            }
            function resetSaveBtn() {
                saveBtn.innerHTML = 'Save';
                saveBtn.disabled = false;
            }
        });
    });
});
</script>

@include('admin.footer')