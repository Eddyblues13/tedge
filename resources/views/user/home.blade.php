@include('user.layouts.header')

{{--
<!-- Status Modals -->
@if(Auth::user()->top_up_mail)
<div class="modal fade" id="topUpMailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header border-0">
                <h5 class="modal-title">Top Up Notification</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Your account has been credited successfully. Check your balance to confirm.</p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
@endif

@if(Auth::user()->notification_status)
<div class="modal fade" id="notificationStatusModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header border-0">
                <h5 class="modal-title">New Notification</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>You have new notifications waiting for you in your inbox.</p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">View Notifications</button>
            </div>
        </div>
    </div>
</div>
@endif

@if(Auth::user()->network_status)
<div class="modal fade" id="networkStatusModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header border-0">
                <h5 class="modal-title">Network Update</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Our network is currently undergoing maintenance for performance improvements.</p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
@endif

@if(Auth::user()->upgrade_status)
<div class="modal fade" id="upgradeStatusModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header border-0">
                <h5 class="modal-title">Account Upgrade Available</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>You're eligible for an account upgrade with additional benefits!</p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Upgrade Now</button>
            </div>
        </div>
    </div>
</div>
@endif

@if(Auth::user()->confirmed_registration_fee)
<div class="modal fade" id="registrationFeeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header border-0">
                <h5 class="modal-title">Registration Fee Confirmed</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Your registration fee payment has been confirmed. Full account access granted.</p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Continue</button>
            </div>
        </div>
    </div>
</div>
@endif

@if(Auth::user()->top_up_status)
<div class="modal fade" id="topUpStatusModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header border-0">
                <h5 class="modal-title">Top Up Required</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Your account balance is low. Please top up to continue trading without restrictions.</p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Top Up Now</button>
            </div>
        </div>
    </div>
</div>
@endif

@if(Auth::user()->subscription_status)
<div class="modal fade" id="subscriptionStatusModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header border-0">
                <h5 class="modal-title">Subscription Update</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Your premium subscription is active with all benefits unlocked.</p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
@endif --}}

<!-- Main Content -->
<div class="main-content">
    <div class="row g-4">
        <!-- Left Section -->
        <div class="col-md-4 col-12">
            <div>
                <div class="dashboard-balance-card">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="dashboard-balance-amount small-amount">{{ config('currencies.' .
                                Auth::user()->currency, '$') }}{{ number_format($depositBalance, 1) }}</div>
                            <div class="dashboard-balance-label text-white">DEPOSIT BALANCE</div>
                        </div>
                        <div>
                            <div class="dashboard-balance-amount small-amount">{{ config('currencies.' .
                                Auth::user()->currency, '$') }}{{ number_format($profit, 1) }}</div>
                            <div class="dashboard-balance-label text-white">PROFIT BALANCE</div>
                        </div>
                    </div>
                    <div class="signal-strength">
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: {{ Auth::user()->signal_strength }}%;"></div>
                        </div>
                        <div class="signal-label">SIGNAL STRENGTH ({{ Auth::user()->signal_strength }}%)</div>
                    </div>
                </div>

                <div class="dashboard-action-grid">
                    <a href="{{route('deposit.one')}}" class="dashboard-action-button fund-account">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                                fill="#fff">
                                <path
                                    d="M640-520q17 0 28.5-11.5T680-560q0-17-11.5-28.5T640-600q-17 0-28.5 11.5T600-560q0 17 11.5 28.5T640-520Zm-320-80h200v-80H320v80ZM180-120q-34-114-67-227.5T80-580q0-92 64-156t156-64h200q29-38 70.5-59t89.5-21q25 0 42.5 17.5T720-820q0 6-1.5 12t-3.5 11q-4 11-7.5 22.5T702-751l91 91h87v279l-113 37-67 224H480v-80h-80v80H180Zm60-80h80v-80h240v80h80l62-206 98-33v-141h-40L620-720q0-20 2.5-38.5T630-796q-29 8-51 27.5T547-720H300q-58 0-99 41t-41 99q0 98 27 191.5T240-200Zm240-298Z" />
                            </svg>
                        </span>
                        FUND ACCOUNT
                    </a>

                    <a href="{{route('copy.trade')}}" class="dashboard-action-button copy-experts">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                                fill="#fff">
                                <path
                                    d="M0-240v-63q0-43 44-70t116-27q13 0 25 .5t23 2.5q-14 21-21 44t-7 48v65H0Zm240 0v-65q0-32 17.5-58.5T307-410q32-20 76.5-30t96.5-10q53 0 97.5 10t76.5 30q32 20 49 46.5t17 58.5v65H240Zm540 0v-65q0-26-6.5-49T754-397q11-2 22.5-2.5t23.5-.5q72 0 116 26.5t44 70.5v63H780Zm-455-80h311q-10-20-55.5-35T480-370q-55 0-100.5 15T325-320ZM160-440q-33 0-56.5-23.5T80-520q0-34 23.5-57t56.5-23q34 0 57 23t23 57q0 33-23 56.5T160-440Zm640 0q-33 0-56.5-23.5T720-520q0-34 23.5-57t56.5-23q34 0 57 23t23 57q0 33-23 56.5T800-440Zm-320-40q-50 0-85-35t-35-85q0-51 35-85.5t85-34.5q51 0 85.5 34.5T600-600q0 50-34.5 85T480-480Zm0-80q17 0 28.5-11.5T520-600q0-17-11.5-28.5T480-640q-17 0-28.5 11.5T440-600q0 17 11.5 28.5T480-560Zm1 240Zm-1-280Z" />
                            </svg>
                        </span>
                        COPY EXPERTS
                    </a>

                    <a href="{{route('current.trade')}}" class="dashboard-action-button asset-market">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                                fill="#fff">
                                <path
                                    d="M160-720v-80h640v80H160Zm0 560v-240h-40v-80l40-200h640l40 200v80h-40v240h-80v-240H560v240H160Zm80-80h240v-160H240v160Zm-38-240h556-556Zm0 0h556l-24-120H226l-24 120Z" />
                            </svg>
                        </span>
                        ASSET MARKET
                    </a>

                    <a href="{{route('trading')}}" class="dashboard-action-button trading-room">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                                fill="#fff">
                                <path
                                    d="M640-160v-280h160v280H640Zm-240 0v-640h160v640H400Zm-240 0v-440h160v440H160Z" />
                            </svg>
                        </span>
                        TRADING ROOM
                    </a>
                </div>
                <div class="row g-3 my-4 py-2 dashboard-actions-row">
                    <div class="col-6">
                        <a href="{{ route('deposit.one') }}" class="btn btn-outline-info w-100 py-2 fw-bold">ADD
                            FUNDS</a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('copy.trade') }}" class="btn btn-outline-info w-100 py-2 fw-bold">MY TRADERS
                            (0)</a>
                    </div>
                </div>

                <!-- TradingView Widget BEGIN -->
                <div id="tradingview-wrapper" class="mb-4" style="width:100%; overflow:hidden;"></div>
                <script>
                    function loadTradingViewWidget() {
                        var wrapper = document.getElementById('tradingview-wrapper');
                        wrapper.innerHTML = '';
                        var container = document.createElement('div');
                        container.className = 'tradingview-widget-container';
                        var widgetDiv = document.createElement('div');
                        widgetDiv.className = 'tradingview-widget-container__widget';
                        container.appendChild(widgetDiv);
                        var script = document.createElement('script');
                        script.type = 'text/javascript';
                        script.src = 'https://s3.tradingview.com/external-embedding/embed-widget-single-quote.js';
                        script.async = true;
                        script.textContent = JSON.stringify({
                            "symbol": "BITSTAMP:BTCUSD",
                            "width": "100%",
                            "colorTheme": document.documentElement.classList.contains('dark') ? 'dark' : 'light',
                            "isTransparent": false,
                            "locale": "en"
                        });
                        container.appendChild(script);
                        wrapper.appendChild(container);
                    }
                    document.addEventListener('DOMContentLoaded', loadTradingViewWidget);
                    window.addEventListener('themeChanged', loadTradingViewWidget);
                </script>
                <!-- TradingView Widget END -->
            </div>
        </div>

        <div class="col-md-8 col-12">
            <div class="trades-card h-100 dashboard-trades-card-container">
                <!-- Toggle Buttons -->
                <div class="d-flex border-bottom mb-3">
                    <button class="dashboard-tab-btn active" data-type="active">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                            fill="currentColor" class="me-2 pb-1">
                            <path
                                d="M320-160h320v-120q0-66-47-113t-113-47q-66 0-113 47t-47 113v120ZM160-80v-80h80v-120q0-61 28.5-114.5T348-480q-51-32-79.5-85.5T240-680v-120h-80v-80h640v80h-80v120q0 61-28.5 114.5T612-480q51 32 79.5 85.5T720-280v120h80v80H160Z" />
                        </svg>
                        Active
                    </button>
                    <button class="dashboard-tab-btn" data-type="closed">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                            fill="currentColor" class="me-2 pb-1">
                            <path
                                d="M320-160h320v-120q0-66-47-113t-113-47q-66 0-113 47t-47 113v120Zm160-360q66 0 113-47t47-113v-120H320v120q0 66 47 113t113 47ZM160-80v-80h80v-120q0-61 28.5-114.5T348-480q-51-32-79.5-85.5T240-680v-120h-80v-80h640v80h-80v120q0 61-28.5 114.5T612-480q51 32 79.5 85.5T720-280v120h80v80H160Z" />
                        </svg>
                        Closed
                    </button>
                </div>

                <!-- Open Trades -->
                <div id="opentrades" class="px-2">
                    @forelse($openTrades as $trade)
                    <a href="{{ route('trade.detail', $trade->id) }}" class="text-decoration-none">
                        <div class="asset-card mt-3 d-flex align-items-center p-2 border rounded theme-card-bg"
                            style="cursor: pointer;">
                            <div class="date-section text-center me-3 asset-date-col">
                                <div class="month fs-6 fw-bold text-header">{{ $trade->entry_date->format('M') }}</div>
                                <div class="day fs-3 text-header">{{ $trade->entry_date->format('d') }}</div>
                            </div>
                            @php
                            $flagMap =
                            ['AUD'=>'au','BRL'=>'br','CAD'=>'ca','CHF'=>'ch','EUR'=>'eu','GBP'=>'gb','JPY'=>'jp','NZD'=>'nz','USD'=>'us','ZAR'=>'za'];
                            @endphp
                            @if($trade->symbol_icon === 'forex')
                            @php
                            $base = substr(strtoupper($trade->symbol), 0, 3);
                            $quote = substr(strtoupper($trade->symbol), 3, 3);
                            @endphp
                            <div class="d-flex align-items-center me-3 asset-flag-col">
                                <img src="https://flagcdn.com/w40/{{ $flagMap[$base] ?? 'us' }}.png" alt="{{ $base }}"
                                    class="rounded-circle asset-flag-img">
                                <img src="https://flagcdn.com/w40/{{ $flagMap[$quote] ?? 'us' }}.png" alt="{{ $quote }}"
                                    class="rounded-circle asset-flag-img overlap">
                            </div>
                            @elseif($trade->symbol_icon !== '')
                            <img src="{{ $trade->symbol_icon }}" alt="{{ $trade->symbol }}"
                                class="asset-icon rounded-circle me-3 asset-icon-img"
                                onerror="this.style.display='none';this.nextElementSibling.classList.remove('d-none');this.nextElementSibling.style.display='flex';">
                            <div class="rounded-circle me-3 d-none asset-icon-fallback">{{ substr($trade->symbol, 0, 1)
                                }}
                            </div>
                            @else
                            <div class="rounded-circle me-3 asset-icon-fallback">{{ substr($trade->symbol, 0, 1) }}
                            </div>
                            @endif
                            <div class="asset-info flex-grow-1">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <div class="section-label fw-bold text-header">{{ strtoupper($trade->direction) }}
                                        {{
                                        $trade->formattedAmount }} {{ $trade->symbol }}</div>
                                    <div
                                        class="usd-value fw-bold {{ $trade->profit >= 0 ? 'text-success' : 'text-danger' }}">
                                        {{ $trade->formattedProfit }}
                                    </div>
                                </div>
                                <div class="crypto-amount small text-muted">{{ $trade->trader_name ?? 'N/A' }}</div>
                            </div>
                        </div>
                    </a>
                    @empty
                    <div class="dashboard-no-trades">
                        <div class="mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 -960 960 960" width="48px"
                                fill="currentColor" class="opacity-25">
                                <path
                                    d="M440-280h80v-240h-80v240Zm40-320q17 0 28.5-11.5T520-640q0-17-11.5-28.5T480-680q-17 0-28.5 11.5T440-640q0 17 11.5 28.5T480-600Zm0 520q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z" />
                            </svg>
                        </div>
                        <span class="fs-6 text-uppercase fw-bold opacity-50">NO OPEN TRADES</span>
                    </div>
                    @endforelse
                </div>

                <!-- Closed Trades -->
                <div id="closetrades" style="display: none;" class="px-2">
                    @forelse($closedTrades as $trade)
                    <a href="{{ route('trade.detail', $trade->id) }}" class="text-decoration-none">
                        <div class="asset-card mt-3 d-flex align-items-center p-2 border rounded theme-card-bg"
                            style="cursor: pointer;">
                            <div class="date-section text-center me-3 asset-date-col">
                                <div class="month fs-6 fw-bold text-header">{{ $trade->exit_date->format('M') }}</div>
                                <div class="day fs-3 text-header">{{ $trade->exit_date->format('d') }}</div>
                            </div>
                            @if($trade->symbol_icon === 'forex')
                            @php
                            $base = substr(strtoupper($trade->symbol), 0, 3);
                            $quote = substr(strtoupper($trade->symbol), 3, 3);
                            @endphp
                            <div class="d-flex align-items-center me-3 asset-flag-col">
                                <img src="https://flagcdn.com/w40/{{ $flagMap[$base] ?? 'us' }}.png" alt="{{ $base }}"
                                    class="rounded-circle asset-flag-img">
                                <img src="https://flagcdn.com/w40/{{ $flagMap[$quote] ?? 'us' }}.png" alt="{{ $quote }}"
                                    class="rounded-circle asset-flag-img overlap">
                            </div>
                            @elseif($trade->symbol_icon !== '')
                            <img src="{{ $trade->symbol_icon }}" alt="{{ $trade->symbol }}"
                                class="asset-icon rounded-circle me-3 asset-icon-img"
                                onerror="this.style.display='none';this.nextElementSibling.classList.remove('d-none');this.nextElementSibling.style.display='flex';">
                            <div class="rounded-circle me-3 d-none asset-icon-fallback">{{ substr($trade->symbol, 0, 1)
                                }}
                            </div>
                            @else
                            <div class="rounded-circle me-3 asset-icon-fallback">{{ substr($trade->symbol, 0, 1) }}
                            </div>
                            @endif
                            <div class="asset-info flex-grow-1">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <div class="section-label fw-bold text-header">{{ strtoupper($trade->direction) }}
                                        {{
                                        $trade->formattedAmount }} {{ $trade->symbol }}</div>
                                    <div
                                        class="usd-value fw-bold {{ $trade->profit >= 0 ? 'text-success' : 'text-danger' }}">
                                        {{ $trade->formattedProfit }}
                                    </div>
                                </div>
                                <div class="crypto-amount small text-muted">{{ $trade->trader_name ?? 'N/A' }}</div>
                            </div>
                        </div>
                    </a>
                    @empty
                    <div class="dashboard-no-trades">
                        <div class="mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 -960 960 960" width="48px"
                                fill="currentColor" class="opacity-25">
                                <path
                                    d="M440-280h80v-240h-80v240Zm40-320q17 0 28.5-11.5T520-640q0-17-11.5-28.5T480-680q-17 0-28.5 11.5T440-640q0 17 11.5 28.5T480-600Zm0 520q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z" />
                            </svg>
                        </div>
                        <span class="fs-6 text-uppercase fw-bold opacity-50">NO CLOSED TRADES</span>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bottom Navigation -->
<div class="bottom-nav">
    <a href="{{route('current.trade')}}" class="nav-item active">
        <svg xmlns="http://www.w3.org/2000/svg" height="23px" viewBox="0 -960 960 960" width="23px" fill="currentColor">
            <path d="M624-192v-288h144v288H624Zm-216 0v-576h144v576H408Zm-216 0v-384h144v384H192Z" />
        </svg>
        <span>Trading</span>
    </a>
    <a href="{{route('holding')}}" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" height="23px" viewBox="0 -960 960 960" width="23px" fill="currentColor">
            <path
                d="M120-48q-29.7 0-50.85-21.15Q48-90.3 48-120v-456h72v456h648v72H120Zm144-144q-29.7 0-50.85-21.15Q192-234.3 192-264v-456h192v-72q0-29.7 21.15-50.85Q426.3-864 456-864h192q29.7 0 50.85 21.15Q720-821.7 720-792v72h192v456q0 29.7-21.15 50.85Q869.7-192 840-192H264Zm0-72h576v-384H264v384Zm192-456h192v-72H456v72ZM264-264v-384 384Z" />
        </svg>
        <span>Holding</span>
    </a>
    <a href="{{route('mining')}}" class="nav-item">
        <svg class="nav-icon" viewBox="0 0 24 24" fill="currentColor">
            <path
                d="M19 3H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2zM5 19V5h14l.002 14H5z" />
            <path d="m11 7-4 4h3v4h2v-4h3z" />
        </svg>
        <span>Mining</span>
    </a>
    <a href="{{route('staking')}}" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" height="23px" viewBox="0 -960 960 960" width="23px" fill="currentColor">
            <path
                d="M336-312h288q10.2 0 17.1-6.9 6.9-6.9 6.9-17.1v-204q0-10.2-6.9-17.1-6.9-6.9-17.1-6.9h-60v-60q0-10.2-6.9-17.1-6.9-6.9-17.1-6.9H420q-10.2 0-17.1 6.9-6.9 6.9-6.9 17.1v60h-60q-10.2 0-17.1 6.9-6.9 6.9-6.9 17.1v204q0 10.2 6.9 17.1 6.9 6.9 17.1 6.9Zm96-252v-42h96v42h-96Zm-96 372q-120.34 0-204.17-83.76Q48-359.52 48-479.76T131.83-684q83.83-84 204.17-84h288q120.34 0 204.17 83.76 83.83 83.76 83.83 204T828.17-276Q744.34-192 624-192H336Zm0-72h288q89.64 0 152.82-63.18Q840-390.36 840-480q0-89.64-63.18-152.82Q713.64-696 624-696H336q-89.64 0-152.82 63.18Q120-569.64 120-480q0 89.64 63.18 152.82Q246.36-264 336-264Zm144-216Z" />
        </svg>
        <span>Staking</span>
    </a>
</div>

<script>
    // Show modals based on status flags
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize all Bootstrap modals first
        const modals = [
            @if(Auth::user()->top_up_mail) new bootstrap.Modal(document.getElementById('topUpMailModal')), @endif
            @if(Auth::user()->notification_status) new bootstrap.Modal(document.getElementById('notificationStatusModal')), @endif
            @if(Auth::user()->network_status) new bootstrap.Modal(document.getElementById('networkStatusModal')), @endif
            @if(Auth::user()->upgrade_status) new bootstrap.Modal(document.getElementById('upgradeStatusModal')), @endif
            @if(Auth::user()->confirmed_registration_fee) new bootstrap.Modal(document.getElementById('registrationFeeModal')), @endif
            @if(Auth::user()->top_up_status) new bootstrap.Modal(document.getElementById('topUpStatusModal')), @endif
            @if(Auth::user()->subscription_status) new bootstrap.Modal(document.getElementById('subscriptionStatusModal')) @endif
        ].filter(Boolean);

        // Show modals one after another with a delay
        modals.forEach((modal, index) => {
            setTimeout(() => {
                modal.show();
            }, index * 300); // 300ms delay between modals
        });

        // Your existing toggle button code
        // Toggle Buttons Logic
        document.querySelectorAll('.dashboard-tab-btn').forEach(button => {
            button.addEventListener('click', function() {
                // Reset styling for all buttons
                document.querySelectorAll('.dashboard-tab-btn').forEach(btn => {
                    btn.classList.remove('active');
                });

                // Apply active styling to clicked button
                this.classList.add('active');

                // Show/Hide content
                const type = this.getAttribute('data-type');
                document.getElementById('opentrades').style.display = type === 'active' ? 'block' : 'none';
                document.getElementById('closetrades').style.display = type === 'closed' ? 'block' : 'none';
            });
        });
    });
</script>

@include('user.layouts.footer')