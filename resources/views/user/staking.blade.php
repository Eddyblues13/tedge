@include('user.layouts.header')

<!-- Main Content -->
<div class="main-content" style="padding-bottom: 100px;">
    <div class="container-fluid px-3 px-md-4">
        <div class="row g-3 mt-2">
            <!-- Left Section -->
            <div class="col-12 col-lg-4">
                <div class="balance-section py-4">
                    <div class="balance-amount fs-5">{{ config('currencies.' . Auth::user()->currency, '$') }}{{
                        number_format($stakingBalance, 2) }}</div>
                    <div class="balance-label">STAKING BALANCE</div>
                </div>
                <div class="action-buttons">
                    <a href="{{route('deposit.one')}}" class="action-button">DEPOSIT</a>
                    <a href="{{route('plans')}}" class="action-button">PLANS</a>
                </div>
            </div>

            <!-- Right Section -->
            <div class="col-12 col-lg-8">
                @php
                $userCurrency = Auth::user()->currency ?? 'USD';
                $currencySymbol = config('currencies.' . $userCurrency, '$');
                $cryptoAssets = [
                ['symbol' => 'ADA', 'name' => 'Cardano', 'icon' =>
                'https://s3-symbol-logo.tradingview.com/crypto/XTVCADA--big.svg', 'bg' => '#0033AD'],
                ['symbol' => 'ATOM', 'name' => 'Cosmos', 'icon' =>
                'https://s3-symbol-logo.tradingview.com/crypto/XTVCATOM--big.svg', 'bg' => '#2E3148'],
                ['symbol' => 'AVAX', 'name' => 'Avalanche', 'icon' =>
                'https://s3-symbol-logo.tradingview.com/crypto/XTVCAVAX--big.svg', 'bg' => '#E84142'],
                ['symbol' => 'DOT', 'name' => 'Polkadot', 'icon' =>
                'https://s3-symbol-logo.tradingview.com/crypto/XTVCDOT--big.svg', 'bg' => '#E6007A'],
                ['symbol' => 'ETH', 'name' => 'Ethereum', 'icon' =>
                'https://s3-symbol-logo.tradingview.com/crypto/XTVCETH--big.svg', 'bg' => '#627EEA'],
                ['symbol' => 'SOL', 'name' => 'Solana', 'icon' =>
                'https://s3-symbol-logo.tradingview.com/crypto/XTVCSOL--big.svg', 'bg' => '#9945FF'],
                ['symbol' => 'BTC', 'name' => 'Bitcoin', 'icon' =>
                'https://s3-symbol-logo.tradingview.com/crypto/XTVCBTC--big.svg', 'bg' => '#F7931A'],
                ['symbol' => 'MATIC', 'name' => 'Polygon', 'icon' =>
                'https://s3-symbol-logo.tradingview.com/crypto/XTVCMATIC--big.svg', 'bg' => '#8247E5'],
                ];
                @endphp

                @foreach($cryptoAssets as $asset)
                <a href="{{ route('staking.detail', strtolower($asset['symbol']) . strtolower($userCurrency)) }}"
                    class="text-decoration-none">
                    <div class="asset-card theme-card-bg mt-3 p-3 rounded" style="cursor: pointer;">
                        <div class="asset-icon-wrapper" style="background-color: {{ $asset['bg'] }};">
                            <img src="{{ $asset['icon'] }}" alt="{{ $asset['symbol'] }}" class="asset-icon-img">
                        </div>
                        <div class="asset-info">
                            <div class="staked-section">
                                <div class="section-label">STAKED</div>
                                <div class="amount">0.00 {{ $userCurrency }}</div>
                                <div class="crypto-amount">0.0000 {{ $asset['symbol'] }}</div>
                            </div>
                            <div class="earned-section">
                                <div class="section-label">EARNED</div>
                                <div class="amount">0.00 {{ $userCurrency }}</div>
                                <div class="crypto-amount">0.0000 {{ $asset['symbol'] }}</div>
                            </div>
                            <div class="usd-value">{{ $userCurrency }}</div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

@include('user.layouts.footer')