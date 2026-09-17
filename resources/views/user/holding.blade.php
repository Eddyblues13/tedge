@include('user.layouts.header')

<style>
    /* Holdings Page Styles */
    .holdings-container {
        padding: 10px;
        padding-bottom: 80px;
        min-height: calc(100vh - 60px);
    }

    /* Two-column layout for My Holdings */
    .holdings-row {
        display: flex;
        gap: 15px;
        align-items: stretch;
    }

    .holdings-left {
        flex: 0 0 33%;
        max-width: 33%;
    }

    .holdings-right {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    /* Portfolio Value Card */
    .portfolio-card {
        background: linear-gradient(135deg, #0d1b2a 0%, #1b2838 40%, #0f2744 100%);
        border-radius: 12px;
        padding: 30px 20px;
        text-align: center;
        position: relative;
        overflow: hidden;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .portfolio-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image:
            /* Candlestick bodies (green/bullish) */
            linear-gradient(to bottom, #10b981 0%, #10b981 100%),
            linear-gradient(to bottom, #10b981 0%, #10b981 100%),
            linear-gradient(to bottom, #10b981 0%, #10b981 100%),
            /* Candlestick bodies (red/bearish) */
            linear-gradient(to bottom, #ef4444 0%, #ef4444 100%),
            linear-gradient(to bottom, #ef4444 0%, #ef4444 100%),
            linear-gradient(to bottom, #ef4444 0%, #ef4444 100%),
            /* Wicks */
            linear-gradient(to bottom, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0.15) 100%),
            linear-gradient(to bottom, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0.15) 100%),
            linear-gradient(to bottom, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0.15) 100%),
            linear-gradient(to bottom, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0.15) 100%),
            linear-gradient(to bottom, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0.15) 100%),
            linear-gradient(to bottom, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0.15) 100%);
        background-size:
            8px 35px, 8px 25px, 8px 40px,
            8px 30px, 8px 20px, 8px 35px,
            1px 55px, 1px 45px, 1px 60px,
            1px 50px, 1px 40px, 1px 55px;
        background-position:
            15% 55%, 40% 40%, 85% 50%,
            28% 60%, 60% 45%, 72% 55%,
            19% 35%, 44% 25%, 89% 30%,
            32% 40%, 64% 30%, 76% 35%;
        background-repeat: no-repeat;
        opacity: 0.4;
    }

    .portfolio-value {
        font-size: 2.2rem;
        font-weight: 800;
        color: #ffffff;
        position: relative;
        z-index: 1;
    }

    .portfolio-label {
        color: #a0aec0;
        font-size: 0.9rem;
        font-weight: 500;
        position: relative;
        z-index: 1;
        margin-top: 5px;
    }

    /* Balance Row */
    .balance-row {
        background: var(--card-bg, #ffffff);
        border: 1px solid var(--border-color, #dbdcdf);
        border-radius: 12px;
        padding: 15px 18px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .balance-row-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .flag-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid var(--border-color, #dbdcdf);
        flex-shrink: 0;
    }

    .flag-icon img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .balance-info {
        display: flex;
        flex-direction: column;
    }

    .balance-amount {
        font-weight: 700;
        font-size: 1rem;
        color: var(--heading-color, #000000);
    }

    .balance-label-text {
        font-size: 0.85rem;
        color: var(--text-color, #4a4a4a);
    }

    .deposit-link {
        color: #04b3e1;
        font-weight: 700;
        font-size: 0.9rem;
        text-decoration: none;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .deposit-link:hover {
        color: #038bb0;
        text-decoration: none;
    }

    /* Empty State */
    .empty-state-card {
        background: var(--card-bg, #ffffff);
        border: 1px solid var(--border-color, #dbdcdf);
        border-radius: 12px;
        padding: 25px 20px;
        text-align: center;
    }

    .empty-state-text {
        color: var(--heading-color, #000000);
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .empty-state-text a {
        color: #04b3e1;
        font-weight: 700;
        text-decoration: none;
    }

    .empty-state-text a:hover {
        text-decoration: underline;
    }

    /* Assets List View */
    .assets-view {
        display: none;
    }

    .assets-view.active {
        display: block;
    }

    .holdings-view.active {
        display: block;
    }

    .holdings-view {
        display: none;
    }

    /* Filters Row */
    .filters-row {
        display: flex;
        gap: 10px;
        margin-bottom: 12px;
    }

    .filter-select {
        flex: 1;
        padding: 10px 14px;
        border: 1px solid var(--border-color, #dbdcdf);
        border-radius: 8px;
        background: var(--input-bg, #f3f4f6);
        color: var(--input-text, #1a1f2b);
        font-size: 0.9rem;
        font-weight: 600;
        appearance: none;
        -webkit-appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23718096' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
        cursor: pointer;
    }

    /* Search Bar */
    .search-bar {
        width: 100%;
        padding: 10px 14px;
        border: 1px solid var(--border-color, #dbdcdf);
        border-radius: 8px;
        background: var(--input-bg, #f3f4f6);
        color: var(--input-text, #1a1f2b);
        font-size: 0.9rem;
        margin-bottom: 12px;
    }

    .search-bar::placeholder {
        color: var(--text-color, #4a4a4a);
    }

    /* Pagination */
    .pagination-row {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 10px;
        margin-bottom: 12px;
        color: var(--text-color, #4a4a4a);
        font-size: 0.85rem;
    }

    .pagination-row button {
        background: none;
        border: none;
        cursor: pointer;
        color: var(--heading-color, #000000);
        font-size: 1.2rem;
        padding: 4px 8px;
    }

    /* Asset List Items */
    .asset-list-item {
        background: var(--card-bg, #ffffff);
        border: 1px solid var(--border-color, #dbdcdf);
        border-radius: 12px;
        padding: 16px 18px;
        display: flex;
        align-items: center;
        margin-bottom: 10px;
        transition: box-shadow 0.2s;
    }

    .asset-list-item:hover {
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        cursor: pointer;
    }

    .asset-icon-col {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        overflow: hidden;
        margin-right: 14px;
        flex-shrink: 0;
    }

    .asset-icon-col img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .asset-name-col {
        flex: 1;
        min-width: 0;
    }

    .asset-name-col .name {
        font-weight: 700;
        font-size: 0.95rem;
        color: var(--heading-color, #000000);
    }

    .asset-name-col .pair {
        font-size: 0.8rem;
        color: var(--text-color, #4a4a4a);
    }

    .asset-price-col {
        text-align: center;
        flex: 0 0 80px;
        font-weight: 600;
        font-size: 0.9rem;
        color: var(--heading-color, #000000);
    }

    .asset-change-col {
        text-align: center;
        flex: 0 0 70px;
        font-weight: 700;
        font-size: 0.85rem;
    }

    .asset-change-col.positive {
        color: #10b981;
    }

    .asset-change-col.negative {
        color: #ef4444;
    }

    /* Bottom Tab Bar */
    .bottom-tab-bar {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background: var(--card-bg, #ffffff);
        border-top: 1px solid var(--border-color, #dbdcdf);
        display: flex;
        z-index: 100;
        padding: 8px 0;
    }

    .tab-item {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 8px 0;
        cursor: pointer;
        color: var(--background-font-colour, #a0aec0);
        text-decoration: none;
        font-size: 0.75rem;
        font-weight: 600;
        transition: color 0.2s;
        border: none;
        background: none;
    }

    .tab-item.active {
        color: #04b3e1;
    }

    .tab-item svg {
        width: 24px;
        height: 24px;
        margin-bottom: 4px;
    }

    /* Asset Detail Modal */
    .asset-modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 200;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .asset-modal-overlay.show {
        display: flex;
    }

    .asset-modal {
        background: var(--card-bg, #ffffff);
        border-radius: 16px;
        padding: 30px 24px;
        max-width: 420px;
        width: 100%;
        position: relative;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
    }

    .asset-modal-close {
        position: absolute;
        top: 14px;
        right: 16px;
        background: none;
        border: none;
        font-size: 1.6rem;
        color: var(--text-color, #4a4a4a);
        cursor: pointer;
        line-height: 1;
    }

    .asset-modal-icon {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        overflow: hidden;
        margin: 0 auto 16px;
    }

    .asset-modal-icon img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .asset-modal-name {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--heading-color, #000000);
        text-align: center;
        margin-bottom: 4px;
    }

    .asset-modal-pair {
        font-size: 0.85rem;
        color: var(--text-color, #4a4a4a);
        text-align: center;
        margin-bottom: 20px;
    }

    .asset-modal-price {
        font-size: 2rem;
        font-weight: 800;
        color: var(--heading-color, #000000);
        text-align: center;
        margin-bottom: 6px;
    }

    .asset-modal-changes {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-bottom: 24px;
    }

    .asset-modal-change {
        font-weight: 700;
        font-size: 0.95rem;
        padding: 4px 12px;
        border-radius: 6px;
    }

    .asset-modal-change.positive {
        color: #10b981;
        background: rgba(16, 185, 129, 0.1);
    }

    .asset-modal-change.negative {
        color: #ef4444;
        background: rgba(239, 68, 68, 0.1);
    }

    .asset-modal-btn {
        display: block;
        width: 100%;
        padding: 14px;
        background: #04b3e1;
        color: #ffffff;
        border: none;
        border-radius: 10px;
        font-size: 1rem;
        font-weight: 700;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        transition: background 0.2s;
    }

    .asset-modal-btn:hover {
        background: #038bb0;
        color: #ffffff;
        text-decoration: none;
    }

    @media (max-width: 768px) {
        .holdings-row {
            flex-direction: column;
        }

        .holdings-left {
            flex: none;
            max-width: 100%;
        }

        .portfolio-value {
            font-size: 2rem;
        }

        .asset-price-col {
            flex: 0 0 65px;
            font-size: 0.8rem;
        }

        .asset-change-col {
            flex: 0 0 55px;
            font-size: 0.78rem;
        }
    }
</style>

<!-- Main Content -->
<div class="holdings-container">

    <!-- ========== MY HOLDINGS VIEW ========== -->
    <div id="holdingsView" class="holdings-view active">
        <div class="holdings-row">
            <!-- Left Column - Portfolio Value Card -->
            <div class="holdings-left">
                <div class="portfolio-card">
                    <div class="portfolio-value">{{ config('currencies.' . Auth::user()->currency, '$') }}{{
                        number_format($holdingBalance, 2) }}</div>
                    <div class="portfolio-label">portfolio value</div>
                </div>
            </div>

            <!-- Right Column - Balance + Empty State -->
            <div class="holdings-right">
                @php
                $currencyCode = strtoupper(Auth::user()->currency ?? 'USD');
                // Map currency codes to flag country codes (ISO 3166-1 alpha-2)
                $currencyFlagMap = [
                'USD' => 'us', 'EUR' => 'eu', 'GBP' => 'gb', 'JPY' => 'jp',
                'AUD' => 'au', 'CAD' => 'ca', 'CHF' => 'ch', 'CNY' => 'cn',
                'INR' => 'in', 'NGN' => 'ng', 'ZAR' => 'za', 'GHS' => 'gh',
                'KES' => 'ke', 'BRL' => 'br', 'MXN' => 'mx', 'AED' => 'ae',
                'SAR' => 'sa', 'SGD' => 'sg', 'HKD' => 'hk', 'NZD' => 'nz',
                'SEK' => 'se', 'NOK' => 'no', 'DKK' => 'dk', 'PLN' => 'pl',
                'TRY' => 'tr', 'RUB' => 'ru', 'KRW' => 'kr', 'THB' => 'th',
                'IDR' => 'id', 'MYR' => 'my', 'PHP' => 'ph', 'VND' => 'vn',
                'EGP' => 'eg', 'PKR' => 'pk', 'BDT' => 'bd', 'UAH' => 'ua',
                'COP' => 'co', 'ARS' => 'ar', 'CLP' => 'cl', 'PEN' => 'pe',
                'CZK' => 'cz', 'HUF' => 'hu', 'RON' => 'ro', 'BGN' => 'bg',
                'ISK' => 'is', 'JMD' => 'jm', 'TTD' => 'tt', 'KWD' => 'kw',
                'QAR' => 'qa', 'OMR' => 'om', 'BHD' => 'bh', 'JOD' => 'jo',
                'LKR' => 'lk', 'MMK' => 'mm', 'KZT' => 'kz', 'UGX' => 'ug',
                'TZS' => 'tz', 'RWF' => 'rw', 'ETB' => 'et', 'XOF' => 'sn',
                'XAF' => 'cm', 'XCD' => 'ag', 'TWD' => 'tw', 'ILS' => 'il',
                ];
                // Try explicit map first, then derive from first 2 chars of currency code
                $flagCode = $currencyFlagMap[$currencyCode] ?? strtolower(substr($currencyCode, 0, 2));
                @endphp

                <!-- Balance Row -->
                <div class="balance-row">
                    <div class="balance-row-left">
                        <div class="flag-icon">
                            <img src="https://flagcdn.com/w80/{{ $flagCode }}.png" alt="{{ $currencyCode }}"
                                onerror="this.src='https://flagcdn.com/w80/us.png'">
                        </div>
                        <div class="balance-info">
                            <span class="balance-amount">{{ config('currencies.' . Auth::user()->currency, '$') }}{{
                                number_format($holdingBalance, 2) }}</span>
                            <span class="balance-label-text">Holding Balance</span>
                        </div>
                    </div>
                    <a href="{{ route('deposit.one') }}" class="deposit-link">DEPOSIT</a>
                </div>

                <!-- Empty State / Holdings Content -->
                @if($holdingBalance <= 0) <div class="empty-state-card">
                    <p class="empty-state-text">
                        YOU ARE NOT CURRENTLY HOLDING ANY ASSETS, CLICK <a href="{{ route('deposit.one') }}">HERE</a> TO
                        BUY ASSETS
                    </p>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- ========== ASSETS LIST VIEW ========== -->
<div id="assetsView" class="assets-view">
    <!-- Filter Dropdowns -->
    <div class="filters-row">
        <select class="filter-select" id="categoryFilter">
            <option value="all">DEFAULT</option>
            <option value="crypto">Crypto</option>
            <option value="stock">Stocks</option>
            <option value="forex">Forex</option>
        </select>
        <select class="filter-select" id="sortFilter">
            <option value="default">DEFAULT</option>
            <option value="name_asc">Name A-Z</option>
            <option value="name_desc">Name Z-A</option>
            <option value="price_asc">Price Low-High</option>
            <option value="price_desc">Price High-Low</option>
        </select>
    </div>

    <!-- Search Bar -->
    <input type="text" class="search-bar" id="assetSearch" placeholder="Search">

    <!-- Pagination -->
    <div class="pagination-row">
        <span id="paginationInfo">(1 / 1)</span>
        <button id="nextPage">&gt;</button>
    </div>

    <!-- Assets List -->
    <div id="assetsList">
        <!-- Assets loaded dynamically via JS -->
    </div>
</div>
</div>

<!-- Bottom Tab Bar -->
<div class="bottom-tab-bar">
    <button class="tab-item active" id="holdingsTab" onclick="switchTab('holdings')">
        <!-- Wallet Icon -->
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round">
            <rect x="2" y="5" width="20" height="15" rx="2" />
            <path d="M16 12h.01" />
            <path d="M2 10h20" />
        </svg>
        My Holdings
    </button>
    <button class="tab-item" id="assetsTab" onclick="switchTab('assets')">
        <!-- Bar Chart Icon -->
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round">
            <line x1="18" y1="20" x2="18" y2="10" />
            <line x1="12" y1="20" x2="12" y2="4" />
            <line x1="6" y1="20" x2="6" y2="14" />
        </svg>
        Assets List
    </button>
</div>


<script>
    // Crypto assets data
    const allAssets = [
        { name: '1inch', pair: '1INCHUSD crypto', price: '0.0986', change1: '+13.75%', change2: '+4.4%', icon: 'https://cryptologos.cc/logos/1inch-1inch-logo.png', category: 'crypto' },
        { name: 'Aave', pair: 'AAVEUSD crypto', price: '113.05', change1: '+3.48%', change2: '-8.7%', icon: 'https://cryptologos.cc/logos/aave-aave-logo.png', category: 'crypto' },
        { name: 'Algorand', pair: 'ALGOUSD crypto', price: '0.1834', change1: '+5.21%', change2: '-2.1%', icon: 'https://cryptologos.cc/logos/algorand-algo-logo.png', category: 'crypto' },
        { name: 'Avalanche', pair: 'AVAXUSD crypto', price: '22.45', change1: '+8.12%', change2: '+3.2%', icon: 'https://cryptologos.cc/logos/avalanche-avax-logo.png', category: 'crypto' },
        { name: 'Bitcoin', pair: 'BTCUSD crypto', price: '97245.00', change1: '+2.34%', change2: '+1.8%', icon: 'https://cryptologos.cc/logos/bitcoin-btc-logo.png', category: 'crypto' },
        { name: 'Cardano', pair: 'ADAUSD crypto', price: '0.6521', change1: '+4.56%', change2: '-1.3%', icon: 'https://cryptologos.cc/logos/cardano-ada-logo.png', category: 'crypto' },
        { name: 'Chainlink', pair: 'LINKUSD crypto', price: '14.23', change1: '+6.78%', change2: '+2.5%', icon: 'https://cryptologos.cc/logos/chainlink-link-logo.png', category: 'crypto' },
        { name: 'Cosmos', pair: 'ATOMUSD crypto', price: '6.89', change1: '+3.21%', change2: '-4.1%', icon: 'https://cryptologos.cc/logos/cosmos-atom-logo.png', category: 'crypto' },
        { name: 'Dogecoin', pair: 'DOGEUSD crypto', price: '0.2156', change1: '+11.45%', change2: '+6.8%', icon: 'https://cryptologos.cc/logos/dogecoin-doge-logo.png', category: 'crypto' },
        { name: 'Ethereum', pair: 'ETHUSD crypto', price: '2654.30', change1: '+3.89%', change2: '+0.9%', icon: 'https://cryptologos.cc/logos/ethereum-eth-logo.png', category: 'crypto' },
        { name: 'Litecoin', pair: 'LTCUSD crypto', price: '98.45', change1: '+2.67%', change2: '-0.5%', icon: 'https://cryptologos.cc/logos/litecoin-ltc-logo.png', category: 'crypto' },
        { name: 'Polkadot', pair: 'DOTUSD crypto', price: '4.56', change1: '+7.34%', change2: '+1.2%', icon: 'https://cryptologos.cc/logos/polkadot-new-dot-logo.png', category: 'crypto' },
        { name: 'Polygon', pair: 'MATICUSD crypto', price: '0.3245', change1: '+9.12%', change2: '+3.7%', icon: 'https://cryptologos.cc/logos/polygon-matic-logo.png', category: 'crypto' },
        { name: 'Ripple', pair: 'XRPUSD crypto', price: '2.34', change1: '+5.67%', change2: '+2.1%', icon: 'https://cryptologos.cc/logos/xrp-xrp-logo.png', category: 'crypto' },
        { name: 'Solana', pair: 'SOLUSD crypto', price: '178.90', change1: '+4.23%', change2: '+5.6%', icon: 'https://cryptologos.cc/logos/solana-sol-logo.png', category: 'crypto' },
        { name: 'Stellar', pair: 'XLMUSD crypto', price: '0.3456', change1: '+6.45%', change2: '-1.8%', icon: 'https://cryptologos.cc/logos/stellar-xlm-logo.png', category: 'crypto' },
        { name: 'Apple', pair: 'AAPL stock', price: '227.50', change1: '+1.23%', change2: '+0.8%', icon: 'https://logo.clearbit.com/apple.com', category: 'stock' },
        { name: 'Microsoft', pair: 'MSFT stock', price: '415.30', change1: '+0.89%', change2: '+1.2%', icon: 'https://logo.clearbit.com/microsoft.com', category: 'stock' },
        { name: 'Tesla', pair: 'TSLA stock', price: '345.20', change1: '+2.45%', change2: '-0.3%', icon: 'https://logo.clearbit.com/tesla.com', category: 'stock' },
        { name: 'NVIDIA', pair: 'NVDA stock', price: '890.10', change1: '+3.56%', change2: '+2.4%', icon: 'https://logo.clearbit.com/nvidia.com', category: 'stock' },
        { name: 'EUR/USD', pair: 'EURUSD forex', price: '1.0845', change1: '+0.12%', change2: '-0.05%', icon: '', category: 'forex' },
        { name: 'GBP/USD', pair: 'GBPUSD forex', price: '1.2634', change1: '+0.34%', change2: '+0.15%', icon: '', category: 'forex' },
        { name: 'USD/JPY', pair: 'USDJPY forex', price: '149.85', change1: '-0.23%', change2: '+0.45%', icon: '', category: 'forex' },
    ];

    const ITEMS_PER_PAGE = 6;
    let currentPage = 1;
    let filteredAssets = [...allAssets];

    function switchTab(tab) {
        const holdingsView = document.getElementById('holdingsView');
        const assetsView = document.getElementById('assetsView');
        const holdingsTab = document.getElementById('holdingsTab');
        const assetsTab = document.getElementById('assetsTab');

        if (tab === 'holdings') {
            holdingsView.classList.add('active');
            assetsView.classList.remove('active');
            holdingsTab.classList.add('active');
            assetsTab.classList.remove('active');

            // Update URL without reload
            window.history.pushState({}, '', '{{ route("holding") }}');
        } else {
            holdingsView.classList.remove('active');
            assetsView.classList.add('active');
            holdingsTab.classList.remove('active');
            assetsTab.classList.add('active');
            renderAssets();

            // Update URL without reload
            window.history.pushState({}, '', '{{ route("holding") }}?current=holdables&where=holdable:yes');
        }
    }

    function renderAssets() {
        const list = document.getElementById('assetsList');
        const totalPages = Math.ceil(filteredAssets.length / ITEMS_PER_PAGE);
        const start = (currentPage - 1) * ITEMS_PER_PAGE;
        const end = start + ITEMS_PER_PAGE;
        const pageItems = filteredAssets.slice(start, end);

        document.getElementById('paginationInfo').textContent = `(${currentPage} / ${totalPages})`;

        let html = '';
        pageItems.forEach(asset => {
            const c1Class = asset.change1.startsWith('+') ? 'positive' : 'negative';
            const c2Class = asset.change2.startsWith('+') ? 'positive' : 'negative';
            const iconHtml = asset.icon
                ? `<img src="${asset.icon}?width=40" alt="${asset.name}" onerror="this.parentElement.innerHTML='<div style=\\'width:45px;height:45px;border-radius:50%;background:#04b3e1;display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:1.1rem\\'>${asset.name.charAt(0)}</div>'">`
                : `<div style="width:45px;height:45px;border-radius:50%;background:#04b3e1;display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:1.1rem">${asset.name.charAt(0)}</div>`;

            const assetSymbol = asset.pair.split(' ')[0];
            html += `
                <div class="asset-list-item" onclick="window.location.href='/user/holding/asset/${assetSymbol}'">
                    <div class="asset-icon-col">${iconHtml}</div>
                    <div class="asset-name-col">
                        <div class="name">${asset.name}</div>
                        <div class="pair">${asset.pair}</div>
                    </div>
                    <div class="asset-price-col">${asset.price}</div>
                    <div class="asset-change-col ${c1Class}">${asset.change1}</div>
                    <div class="asset-change-col ${c2Class}">${asset.change2}</div>
                </div>`;
        });
        list.innerHTML = html;
    }

    // Search
    document.getElementById('assetSearch').addEventListener('input', function() {
        const q = this.value.toLowerCase();
        filteredAssets = allAssets.filter(a =>
            a.name.toLowerCase().includes(q) || a.pair.toLowerCase().includes(q)
        );
        applyFilters();
    });

    // Category filter
    document.getElementById('categoryFilter').addEventListener('change', function() {
        applyFilters();
    });

    // Sort filter
    document.getElementById('sortFilter').addEventListener('change', function() {
        applyFilters();
    });

    function applyFilters() {
        const category = document.getElementById('categoryFilter').value;
        const sort = document.getElementById('sortFilter').value;
        const q = document.getElementById('assetSearch').value.toLowerCase();

        filteredAssets = allAssets.filter(a => {
            const matchCategory = category === 'all' || a.category === category;
            const matchSearch = a.name.toLowerCase().includes(q) || a.pair.toLowerCase().includes(q);
            return matchCategory && matchSearch;
        });

        if (sort === 'name_asc') filteredAssets.sort((a, b) => a.name.localeCompare(b.name));
        if (sort === 'name_desc') filteredAssets.sort((a, b) => b.name.localeCompare(a.name));
        if (sort === 'price_asc') filteredAssets.sort((a, b) => parseFloat(a.price) - parseFloat(b.price));
        if (sort === 'price_desc') filteredAssets.sort((a, b) => parseFloat(b.price) - parseFloat(a.price));

        currentPage = 1;
        renderAssets();
    }

    // Pagination
    document.getElementById('nextPage').addEventListener('click', function() {
        const totalPages = Math.ceil(filteredAssets.length / ITEMS_PER_PAGE);
        currentPage = currentPage < totalPages ? currentPage + 1 : 1;
        renderAssets();
    });

    // Check URL params on load to show correct tab
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('current') === 'holdables') {
        switchTab('assets');
    }
</script>

@include('user.layouts.footer')