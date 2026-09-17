@include('user.layouts.header')

<style>
    /* Trading Page Styles */
    .trading-container {
        padding: 10px;
        padding-bottom: 80px;
        min-height: calc(100vh - 60px);
    }

    /* Filters Row */
    .t-filters-row {
        display: flex;
        gap: 10px;
        margin-bottom: 12px;
    }

    .t-filter-select {
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
    .t-search-bar {
        width: 100%;
        padding: 10px 14px;
        border: 1px solid var(--border-color, #dbdcdf);
        border-radius: 8px;
        background: var(--input-bg, #f3f4f6);
        color: var(--input-text, #1a1f2b);
        font-size: 0.9rem;
        margin-bottom: 12px;
    }

    .t-search-bar::placeholder {
        color: var(--text-color, #4a4a4a);
    }

    /* Pagination */
    .t-pagination-row {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 10px;
        margin-bottom: 12px;
        color: var(--text-color, #4a4a4a);
        font-size: 0.85rem;
    }

    .t-pagination-row button {
        background: none;
        border: none;
        cursor: pointer;
        color: var(--heading-color, #000000);
        font-size: 1.2rem;
        padding: 4px 8px;
    }

    /* Asset List Items */
    .t-asset-item {
        background: var(--card-bg, #ffffff);
        border: 1px solid var(--border-color, #dbdcdf);
        border-radius: 12px;
        padding: 18px 16px;
        display: flex;
        align-items: center;
        margin-bottom: 10px;
        transition: box-shadow 0.2s;
        cursor: pointer;
    }

    .t-asset-item:hover {
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }

    .t-asset-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        overflow: hidden;
        margin-right: 14px;
        flex-shrink: 0;
        position: relative;
    }

    .t-asset-icon img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Overlapping flag icons for forex pairs */
    .t-asset-icon.forex-pair {
        width: 60px;
        height: 50px;
        border-radius: 0;
        overflow: visible;
    }

    .t-asset-icon.forex-pair .flag-first {
        position: absolute;
        width: 42px;
        height: 42px;
        border-radius: 50%;
        overflow: hidden;
        border: 2px solid var(--card-bg, #ffffff);
        z-index: 2;
        top: 4px;
        left: 0;
    }

    .t-asset-icon.forex-pair .flag-second {
        position: absolute;
        width: 42px;
        height: 42px;
        border-radius: 50%;
        overflow: hidden;
        border: 2px solid var(--card-bg, #ffffff);
        z-index: 1;
        top: 4px;
        left: 22px;
    }

    .t-asset-icon.forex-pair .flag-first img,
    .t-asset-icon.forex-pair .flag-second img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .t-asset-name {
        flex: 1;
        min-width: 0;
    }

    .t-asset-name .symbol {
        font-weight: 700;
        font-size: 0.95rem;
        color: var(--heading-color, #000000);
    }

    .t-asset-name .category {
        font-size: 0.8rem;
        color: var(--text-color, #4a4a4a);
    }

    .t-asset-price {
        text-align: right;
        flex: 0 0 140px;
        font-weight: 600;
        font-size: 0.88rem;
        color: var(--heading-color, #000000);
    }

    .t-asset-change {
        text-align: center;
        flex: 0 0 65px;
        font-weight: 700;
        font-size: 0.82rem;
    }

    .t-asset-change.positive {
        color: #10b981;
    }

    .t-asset-change.negative {
        color: #ef4444;
    }

    .t-star-btn {
        flex: 0 0 30px;
        background: none;
        border: none;
        cursor: pointer;
        color: var(--text-color, #a0aec0);
        font-size: 1.2rem;
        padding: 0;
        margin-left: 8px;
    }

    .t-star-btn.starred {
        color: #f59e0b;
    }

    .t-star-btn svg {
        width: 20px;
        height: 20px;
    }

    /* Bottom Tab Bar */
    .t-bottom-tab-bar {
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

    .t-tab-item {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 6px 0;
        cursor: pointer;
        color: var(--text-color, #a0aec0);
        text-decoration: none;
        font-size: 0.7rem;
        font-weight: 600;
        transition: color 0.2s;
        border: none;
        background: none;
    }

    .t-tab-item:hover {
        text-decoration: none;
    }

    .t-tab-item.active {
        color: #04b3e1;
    }

    .t-tab-item svg {
        width: 22px;
        height: 22px;
        margin-bottom: 3px;
    }

    @media (max-width: 768px) {
        .t-asset-price {
            flex: 0 0 100px;
            font-size: 0.78rem;
        }
        .t-asset-change {
            flex: 0 0 50px;
            font-size: 0.75rem;
        }
    }

    @media (max-width: 480px) {
        .t-asset-price {
            flex: 0 0 80px;
            font-size: 0.72rem;
        }
        .t-asset-change {
            flex: 0 0 42px;
            font-size: 0.7rem;
        }
    }
</style>

<!-- Main Content -->
<div class="trading-container">
    <!-- Filter Dropdowns -->
    <div class="t-filters-row">
        <select class="t-filter-select" id="tCategoryFilter">
            <option value="all">DEFAULT</option>
            <option value="etfs">ETFS (3407)</option>
            <option value="forex">FOREX (95)</option>
            <option value="crypto">CRYPTO (403)</option>
            <option value="stocks">STOCKS (4833)</option>
        </select>
        <select class="t-filter-select" id="tSortFilter">
            <option value="default">DEFAULT</option>
            <option value="name_asc">Name A-Z</option>
            <option value="name_desc">Name Z-A</option>
            <option value="price_asc">Price Low-High</option>
            <option value="price_desc">Price High-Low</option>
        </select>
    </div>

    <!-- Search Bar -->
    <input type="text" class="t-search-bar" id="tSearch" placeholder="Search">

    <!-- Pagination -->
    <div class="t-pagination-row">
        <span id="tPaginationInfo">(1 / 15)</span>
        <button id="tNextPage">&gt;</button>
    </div>

    <!-- Assets List -->
    <div id="tAssetsList">
        <!-- Assets dynamically loaded via JS -->
    </div>
</div>

<!-- Bottom Tab Bar -->
<div class="t-bottom-tab-bar">
    <a href="{{route('home')}}" class="t-tab-item">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
            <polyline points="9 22 9 12 15 12 15 22"/>
        </svg>
        Home
    </a>
    <a href="{{route('holding')}}?current=holdables&where=holdable:yes" class="t-tab-item active">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="18" y1="20" x2="18" y2="10"/>
            <line x1="12" y1="20" x2="12" y2="4"/>
            <line x1="6" y1="20" x2="6" y2="14"/>
        </svg>
        Assets
    </a>
    <a href="{{route('trading')}}" class="t-tab-item">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="2" y="3" width="20" height="14" rx="2" ry="2"/>
            <line x1="8" y1="21" x2="16" y2="21"/>
            <line x1="12" y1="17" x2="12" y2="21"/>
        </svg>
        Trade
    </a>
    <a href="{{route('current.trade')}}" class="t-tab-item">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
            <polyline points="22 4 12 14.01 9 11.01"/>
        </svg>
        Closed Trades
    </a>
    <a href="#" class="t-tab-item" id="tStarTab">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
        </svg>
        Star
    </a>
</div>

<script>
    // Forex pairs with country code mappings
    const tradingAssets = [
        // Forex (25 key pairs)
        { symbol: 'AUDBRL', category: 'forex', price: '3.68476360933355', c1: '+0%', c2: '+0.83%', c3: '-0.36%', flag1: 'au', flag2: 'br' },
        { symbol: 'AUDCAD', category: 'forex', price: '0.961', c1: '+0%', c2: '-0.66%', c3: '-0.01%', flag1: 'au', flag2: 'ca' },
        { symbol: 'AUDCHF', category: 'forex', price: '0.57126', c1: '+0%', c2: '+0.15%', c3: '-0.22%', flag1: 'au', flag2: 'ch' },
        { symbol: 'AUDJPY', category: 'forex', price: '97.845', c1: '+0%', c2: '+0.42%', c3: '-0.18%', flag1: 'au', flag2: 'jp' },
        { symbol: 'AUDNZD', category: 'forex', price: '1.10234', c1: '+0%', c2: '-0.31%', c3: '+0.12%', flag1: 'au', flag2: 'nz' },
        { symbol: 'AUDUSD', category: 'forex', price: '0.63456', c1: '+0%', c2: '+0.28%', c3: '-0.15%', flag1: 'au', flag2: 'us' },
        { symbol: 'CADJPY', category: 'forex', price: '107.234', c1: '+0%', c2: '+0.55%', c3: '+0.08%', flag1: 'ca', flag2: 'jp' },
        { symbol: 'CHFZAR', category: 'forex', price: '20.75132640155062', c1: '+0%', c2: '-0.11%', c3: '-1.27%', flag1: 'ch', flag2: 'za' },
        { symbol: 'EURAUD', category: 'forex', price: '1.68086', c1: '+0%', c2: '+0.33%', c3: '-0.03%', flag1: 'eu', flag2: 'au' },
        { symbol: 'EURBRL', category: 'forex', price: '6.19195046439629', c1: '+0%', c2: '+1.05%', c3: '-0.44%', flag1: 'eu', flag2: 'br' },
        { symbol: 'EURCAD', category: 'forex', price: '1.61509', c1: '+0%', c2: '-0.38%', c3: '-0.13%', flag1: 'eu', flag2: 'ca' },
        { symbol: 'EURCHF', category: 'forex', price: '0.96123', c1: '+0%', c2: '+0.08%', c3: '-0.05%', flag1: 'eu', flag2: 'ch' },
        { symbol: 'EURGBP', category: 'forex', price: '0.84567', c1: '+0%', c2: '-0.12%', c3: '+0.04%', flag1: 'eu', flag2: 'gb' },
        { symbol: 'EURJPY', category: 'forex', price: '164.523', c1: '+0%', c2: '+0.67%', c3: '-0.21%', flag1: 'eu', flag2: 'jp' },
        { symbol: 'EURUSD', category: 'forex', price: '1.06789', c1: '+0%', c2: '+0.22%', c3: '-0.08%', flag1: 'eu', flag2: 'us' },
        { symbol: 'GBPAUD', category: 'forex', price: '1.98765', c1: '+0%', c2: '-0.45%', c3: '+0.11%', flag1: 'gb', flag2: 'au' },
        { symbol: 'GBPCAD', category: 'forex', price: '1.74523', c1: '+0%', c2: '+0.18%', c3: '-0.33%', flag1: 'gb', flag2: 'ca' },
        { symbol: 'GBPCHF', category: 'forex', price: '1.13678', c1: '+0%', c2: '+0.09%', c3: '-0.14%', flag1: 'gb', flag2: 'ch' },
        { symbol: 'GBPJPY', category: 'forex', price: '194.567', c1: '+0%', c2: '+0.78%', c3: '-0.42%', flag1: 'gb', flag2: 'jp' },
        { symbol: 'GBPUSD', category: 'forex', price: '1.26345', c1: '+0%', c2: '+0.34%', c3: '+0.15%', flag1: 'gb', flag2: 'us' },
        { symbol: 'NZDUSD', category: 'forex', price: '0.57567', c1: '+0%', c2: '-0.18%', c3: '+0.07%', flag1: 'nz', flag2: 'us' },
        { symbol: 'USDCAD', category: 'forex', price: '1.43678', c1: '+0%', c2: '-0.15%', c3: '+0.22%', flag1: 'us', flag2: 'ca' },
        { symbol: 'USDCHF', category: 'forex', price: '0.90123', c1: '+0%', c2: '+0.06%', c3: '-0.09%', flag1: 'us', flag2: 'ch' },
        { symbol: 'USDJPY', category: 'forex', price: '154.234', c1: '+0%', c2: '+0.45%', c3: '-0.31%', flag1: 'us', flag2: 'jp' },
        { symbol: 'USDZAR', category: 'forex', price: '18.45678', c1: '+0%', c2: '-0.67%', c3: '+0.34%', flag1: 'us', flag2: 'za' },
        // Crypto (30)
        { symbol: 'BTCUSD', category: 'crypto', price: '97245.00', c1: '+0%', c2: '+2.34%', c3: '+1.8%', flag1: '', flag2: '' },
        { symbol: 'ETHUSD', category: 'crypto', price: '2654.30', c1: '+0%', c2: '+3.89%', c3: '+0.9%', flag1: '', flag2: '' },
        { symbol: 'XRPUSD', category: 'crypto', price: '2.34', c1: '+0%', c2: '+5.67%', c3: '+2.1%', flag1: '', flag2: '' },
        { symbol: 'SOLUSD', category: 'crypto', price: '178.90', c1: '+0%', c2: '+4.23%', c3: '+5.6%', flag1: '', flag2: '' },
        { symbol: 'BNBUSD', category: 'crypto', price: '645.30', c1: '+0%', c2: '+1.56%', c3: '+0.7%', flag1: '', flag2: '' },
        { symbol: 'ADAUSD', category: 'crypto', price: '0.6521', c1: '+0%', c2: '+4.56%', c3: '-1.3%', flag1: '', flag2: '' },
        { symbol: 'DOGEUSD', category: 'crypto', price: '0.2156', c1: '+0%', c2: '+11.45%', c3: '+6.8%', flag1: '', flag2: '' },
        { symbol: 'TRXUSD', category: 'crypto', price: '0.2345', c1: '+0%', c2: '+2.12%', c3: '+0.8%', flag1: '', flag2: '' },
        { symbol: 'DOTUSD', category: 'crypto', price: '4.56', c1: '+0%', c2: '+7.34%', c3: '+1.2%', flag1: '', flag2: '' },
        { symbol: 'LINKUSD', category: 'crypto', price: '14.23', c1: '+0%', c2: '+6.78%', c3: '+2.5%', flag1: '', flag2: '' },
        { symbol: 'MATICUSD', category: 'crypto', price: '0.3245', c1: '+0%', c2: '+9.12%', c3: '+3.7%', flag1: '', flag2: '' },
        { symbol: 'AVAXUSD', category: 'crypto', price: '22.45', c1: '+0%', c2: '+8.12%', c3: '+3.2%', flag1: '', flag2: '' },
        { symbol: 'LTCUSD', category: 'crypto', price: '98.45', c1: '+0%', c2: '+2.67%', c3: '-0.5%', flag1: '', flag2: '' },
        { symbol: 'ATOMUSD', category: 'crypto', price: '6.89', c1: '+0%', c2: '+3.21%', c3: '-4.1%', flag1: '', flag2: '' },
        { symbol: 'UNIUSD', category: 'crypto', price: '7.82', c1: '+0%', c2: '+5.34%', c3: '+1.9%', flag1: '', flag2: '' },
        { symbol: 'XLMUSD', category: 'crypto', price: '0.3456', c1: '+0%', c2: '+6.45%', c3: '-1.8%', flag1: '', flag2: '' },
        { symbol: 'ALGOUSD', category: 'crypto', price: '0.1834', c1: '+0%', c2: '+5.21%', c3: '-2.1%', flag1: '', flag2: '' },
        { symbol: 'NEARUSD', category: 'crypto', price: '3.45', c1: '+0%', c2: '+8.67%', c3: '+4.2%', flag1: '', flag2: '' },
        { symbol: 'FILUSD', category: 'crypto', price: '3.78', c1: '+0%', c2: '+4.89%', c3: '-2.3%', flag1: '', flag2: '' },
        { symbol: 'AAVEUSD', category: 'crypto', price: '245.67', c1: '+0%', c2: '+3.48%', c3: '-1.7%', flag1: '', flag2: '' },
        { symbol: 'APTUSD', category: 'crypto', price: '5.67', c1: '+0%', c2: '+6.23%', c3: '+3.1%', flag1: '', flag2: '' },
        { symbol: 'ARBUSD', category: 'crypto', price: '0.5678', c1: '+0%', c2: '+7.89%', c3: '+2.8%', flag1: '', flag2: '' },
        { symbol: 'OPUSD', category: 'crypto', price: '1.234', c1: '+0%', c2: '+4.56%', c3: '-1.5%', flag1: '', flag2: '' },
        { symbol: 'MKRUSD', category: 'crypto', price: '1456.78', c1: '+0%', c2: '+2.34%', c3: '+1.1%', flag1: '', flag2: '' },
        { symbol: 'INJUSD', category: 'crypto', price: '15.67', c1: '+0%', c2: '+9.45%', c3: '+5.3%', flag1: '', flag2: '' },
        { symbol: 'RNDRUSD', category: 'crypto', price: '4.89', c1: '+0%', c2: '+12.34%', c3: '+7.8%', flag1: '', flag2: '' },
        { symbol: 'SUIUSD', category: 'crypto', price: '1.345', c1: '+0%', c2: '+15.67%', c3: '+9.2%', flag1: '', flag2: '' },
        { symbol: 'SHIBUSD', category: 'crypto', price: '0.00001234', c1: '+0%', c2: '+8.56%', c3: '+4.3%', flag1: '', flag2: '' },
        { symbol: 'PEPEUSD', category: 'crypto', price: '0.00001345', c1: '+0%', c2: '+18.90%', c3: '+11.5%', flag1: '', flag2: '' },
        { symbol: 'TONUSD', category: 'crypto', price: '3.45', c1: '+0%', c2: '+5.12%', c3: '+2.1%', flag1: '', flag2: '' },
        // Stocks (30)
        { symbol: 'AAPL', category: 'stocks', price: '227.50', c1: '+0%', c2: '+1.23%', c3: '+0.8%', flag1: '', flag2: '' },
        { symbol: 'MSFT', category: 'stocks', price: '415.30', c1: '+0%', c2: '+0.89%', c3: '+1.2%', flag1: '', flag2: '' },
        { symbol: 'TSLA', category: 'stocks', price: '345.20', c1: '+0%', c2: '+2.45%', c3: '-0.3%', flag1: '', flag2: '' },
        { symbol: 'NVDA', category: 'stocks', price: '890.10', c1: '+0%', c2: '+3.56%', c3: '+2.4%', flag1: '', flag2: '' },
        { symbol: 'AMZN', category: 'stocks', price: '178.45', c1: '+0%', c2: '+1.12%', c3: '+0.6%', flag1: '', flag2: '' },
        { symbol: 'GOOGL', category: 'stocks', price: '155.30', c1: '+0%', c2: '+0.78%', c3: '-0.2%', flag1: '', flag2: '' },
        { symbol: 'META', category: 'stocks', price: '567.80', c1: '+0%', c2: '+1.45%', c3: '+0.9%', flag1: '', flag2: '' },
        { symbol: 'BRK.B', category: 'stocks', price: '412.56', c1: '+0%', c2: '+0.34%', c3: '+0.15%', flag1: '', flag2: '' },
        { symbol: 'LLY', category: 'stocks', price: '789.34', c1: '+0%', c2: '+1.89%', c3: '+1.1%', flag1: '', flag2: '' },
        { symbol: 'V', category: 'stocks', price: '278.90', c1: '+0%', c2: '+0.56%', c3: '+0.3%', flag1: '', flag2: '' },
        { symbol: 'JPM', category: 'stocks', price: '198.67', c1: '+0%', c2: '+0.78%', c3: '+0.4%', flag1: '', flag2: '' },
        { symbol: 'WMT', category: 'stocks', price: '167.45', c1: '+0%', c2: '+0.45%', c3: '+0.2%', flag1: '', flag2: '' },
        { symbol: 'MA', category: 'stocks', price: '456.78', c1: '+0%', c2: '+0.67%', c3: '+0.35%', flag1: '', flag2: '' },
        { symbol: 'PG', category: 'stocks', price: '165.23', c1: '+0%', c2: '+0.34%', c3: '-0.1%', flag1: '', flag2: '' },
        { symbol: 'HD', category: 'stocks', price: '378.90', c1: '+0%', c2: '+0.89%', c3: '+0.5%', flag1: '', flag2: '' },
        { symbol: 'XOM', category: 'stocks', price: '108.45', c1: '+0%', c2: '-0.45%', c3: '-0.2%', flag1: '', flag2: '' },
        { symbol: 'JNJ', category: 'stocks', price: '156.78', c1: '+0%', c2: '+0.23%', c3: '+0.1%', flag1: '', flag2: '' },
        { symbol: 'COST', category: 'stocks', price: '745.67', c1: '+0%', c2: '+1.12%', c3: '+0.6%', flag1: '', flag2: '' },
        { symbol: 'ABBV', category: 'stocks', price: '178.90', c1: '+0%', c2: '+0.56%', c3: '+0.3%', flag1: '', flag2: '' },
        { symbol: 'CRM', category: 'stocks', price: '278.34', c1: '+0%', c2: '+1.34%', c3: '+0.7%', flag1: '', flag2: '' },
        { symbol: 'NFLX', category: 'stocks', price: '678.90', c1: '+0%', c2: '+2.12%', c3: '+1.5%', flag1: '', flag2: '' },
        { symbol: 'ORCL', category: 'stocks', price: '156.78', c1: '+0%', c2: '+0.45%', c3: '+0.2%', flag1: '', flag2: '' },
        { symbol: 'AMD', category: 'stocks', price: '134.56', c1: '+0%', c2: '+2.89%', c3: '+1.8%', flag1: '', flag2: '' },
        { symbol: 'INTC', category: 'stocks', price: '23.45', c1: '+0%', c2: '-1.23%', c3: '-0.8%', flag1: '', flag2: '' },
        { symbol: 'DIS', category: 'stocks', price: '98.67', c1: '+0%', c2: '+0.67%', c3: '+0.3%', flag1: '', flag2: '' },
        { symbol: 'BA', category: 'stocks', price: '178.90', c1: '+0%', c2: '+1.45%', c3: '-0.5%', flag1: '', flag2: '' },
        { symbol: 'UBER', category: 'stocks', price: '67.89', c1: '+0%', c2: '+2.34%', c3: '+1.2%', flag1: '', flag2: '' },
        { symbol: 'PYPL', category: 'stocks', price: '72.34', c1: '+0%', c2: '+1.56%', c3: '+0.8%', flag1: '', flag2: '' },
        { symbol: 'SQ', category: 'stocks', price: '78.90', c1: '+0%', c2: '+3.45%', c3: '+2.1%', flag1: '', flag2: '' },
        { symbol: 'COIN', category: 'stocks', price: '234.56', c1: '+0%', c2: '+4.56%', c3: '+3.2%', flag1: '', flag2: '' },
        // ETFs (15)
        { symbol: 'SPY', category: 'etfs', price: '502.34', c1: '+0%', c2: '+0.45%', c3: '+0.12%', flag1: '', flag2: '' },
        { symbol: 'QQQ', category: 'etfs', price: '432.56', c1: '+0%', c2: '+0.67%', c3: '+0.23%', flag1: '', flag2: '' },
        { symbol: 'IWM', category: 'etfs', price: '198.78', c1: '+0%', c2: '-0.34%', c3: '-0.15%', flag1: '', flag2: '' },
        { symbol: 'DIA', category: 'etfs', price: '389.12', c1: '+0%', c2: '+0.22%', c3: '+0.08%', flag1: '', flag2: '' },
        { symbol: 'VTI', category: 'etfs', price: '245.67', c1: '+0%', c2: '+0.38%', c3: '+0.11%', flag1: '', flag2: '' },
        { symbol: 'VOO', category: 'etfs', price: '460.23', c1: '+0%', c2: '+0.42%', c3: '+0.15%', flag1: '', flag2: '' },
        { symbol: 'VEA', category: 'etfs', price: '48.56', c1: '+0%', c2: '-0.12%', c3: '+0.06%', flag1: '', flag2: '' },
        { symbol: 'VWO', category: 'etfs', price: '42.34', c1: '+0%', c2: '-0.28%', c3: '-0.11%', flag1: '', flag2: '' },
        { symbol: 'GLD', category: 'etfs', price: '198.45', c1: '+0%', c2: '+0.56%', c3: '+0.28%', flag1: '', flag2: '' },
        { symbol: 'SLV', category: 'etfs', price: '22.78', c1: '+0%', c2: '+1.23%', c3: '+0.56%', flag1: '', flag2: '' },
        { symbol: 'TLT', category: 'etfs', price: '92.34', c1: '+0%', c2: '-0.45%', c3: '-0.22%', flag1: '', flag2: '' },
        { symbol: 'XLF', category: 'etfs', price: '39.56', c1: '+0%', c2: '+0.34%', c3: '+0.15%', flag1: '', flag2: '' },
        { symbol: 'XLK', category: 'etfs', price: '198.90', c1: '+0%', c2: '+0.78%', c3: '+0.34%', flag1: '', flag2: '' },
        { symbol: 'ARKK', category: 'etfs', price: '45.67', c1: '+0%', c2: '+1.56%', c3: '+0.78%', flag1: '', flag2: '' },
        { symbol: 'EEM', category: 'etfs', price: '40.12', c1: '+0%', c2: '-0.34%', c3: '-0.15%', flag1: '', flag2: '' },
    ];

    // Flag URL map for the EU flag
    const flagUrlMap = {
        'eu': 'https://flagcdn.com/w80/eu.png',
    };

    function getFlagUrl(code) {
        if (flagUrlMap[code]) return flagUrlMap[code];
        return `https://flagcdn.com/w80/${code}.png`;
    }

    const T_ITEMS_PER_PAGE = 50;
    let tCurrentPage = 1;
    let tFilteredAssets = [...tradingAssets];
    let starredSymbols = JSON.parse(localStorage.getItem('starredAssets') || '[]');

    function renderTradingAssets() {
        const list = document.getElementById('tAssetsList');
        const totalPages = Math.max(1, Math.ceil(tFilteredAssets.length / T_ITEMS_PER_PAGE));
        const start = (tCurrentPage - 1) * T_ITEMS_PER_PAGE;
        const end = start + T_ITEMS_PER_PAGE;
        const pageItems = tFilteredAssets.slice(start, end);

        document.getElementById('tPaginationInfo').textContent = `(${tCurrentPage} / ${totalPages})`;

        let html = '';
        pageItems.forEach(asset => {
            const c1Class = asset.c1.startsWith('+') && asset.c1 !== '+0%' ? 'positive' : (asset.c1 === '+0%' ? 'positive' : 'negative');
            const c2Class = asset.c2.startsWith('+') ? 'positive' : 'negative';
            const c3Class = asset.c3.startsWith('+') ? 'positive' : 'negative';
            const isStarred = starredSymbols.includes(asset.symbol);

            let iconHtml = '';
            if (asset.category === 'forex' && asset.flag1 && asset.flag2) {
                iconHtml = `
                    <div class="t-asset-icon forex-pair">
                        <div class="flag-first"><img src="${getFlagUrl(asset.flag1)}" alt="${asset.flag1}" onerror="this.src='https://flagcdn.com/w80/us.png'"></div>
                        <div class="flag-second"><img src="${getFlagUrl(asset.flag2)}" alt="${asset.flag2}" onerror="this.src='https://flagcdn.com/w80/us.png'"></div>
                    </div>`;
            } else if (asset.category === 'crypto') {
                const logoMap = {
                    'BTCUSD': 'https://cryptologos.cc/logos/bitcoin-btc-logo.png',
                    'ETHUSD': 'https://cryptologos.cc/logos/ethereum-eth-logo.png',
                    'XRPUSD': 'https://cryptologos.cc/logos/xrp-xrp-logo.png',
                    'SOLUSD': 'https://cryptologos.cc/logos/solana-sol-logo.png',
                    'BNBUSD': 'https://cryptologos.cc/logos/bnb-bnb-logo.png',
                    'ADAUSD': 'https://cryptologos.cc/logos/cardano-ada-logo.png',
                    'DOGEUSD': 'https://cryptologos.cc/logos/dogecoin-doge-logo.png',
                    'TRXUSD': 'https://cryptologos.cc/logos/tron-trx-logo.png',
                    'DOTUSD': 'https://cryptologos.cc/logos/polkadot-new-dot-logo.png',
                    'LINKUSD': 'https://cryptologos.cc/logos/chainlink-link-logo.png',
                    'MATICUSD': 'https://cryptologos.cc/logos/polygon-matic-logo.png',
                    'AVAXUSD': 'https://cryptologos.cc/logos/avalanche-avax-logo.png',
                    'LTCUSD': 'https://cryptologos.cc/logos/litecoin-ltc-logo.png',
                    'ATOMUSD': 'https://cryptologos.cc/logos/cosmos-atom-logo.png',
                    'UNIUSD': 'https://cryptologos.cc/logos/uniswap-uni-logo.png',
                    'XLMUSD': 'https://cryptologos.cc/logos/stellar-xlm-logo.png',
                    'ALGOUSD': 'https://cryptologos.cc/logos/algorand-algo-logo.png',
                    'NEARUSD': 'https://cryptologos.cc/logos/near-protocol-near-logo.png',
                    'FILUSD': 'https://cryptologos.cc/logos/filecoin-fil-logo.png',
                    'AAVEUSD': 'https://cryptologos.cc/logos/aave-aave-logo.png',
                    'APTUSD': 'https://cryptologos.cc/logos/aptos-apt-logo.png',
                    'ARBUSD': 'https://cryptologos.cc/logos/arbitrum-arb-logo.png',
                    'OPUSD': 'https://cryptologos.cc/logos/optimism-ethereum-op-logo.png',
                    'MKRUSD': 'https://cryptologos.cc/logos/maker-mkr-logo.png',
                    'INJUSD': 'https://cryptologos.cc/logos/injective-inj-logo.png',
                    'RNDRUSD': 'https://cryptologos.cc/logos/render-token-rndr-logo.png',
                    'SUIUSD': 'https://cryptologos.cc/logos/sui-sui-logo.png',
                    'SHIBUSD': 'https://cryptologos.cc/logos/shiba-inu-shib-logo.png',
                    'PEPEUSD': 'https://cryptologos.cc/logos/pepe-pepe-logo.png',
                    'TONUSD': 'https://cryptologos.cc/logos/toncoin-ton-logo.png',
                };
                const logoUrl = logoMap[asset.symbol] || '';
                iconHtml = logoUrl
                    ? `<div class="t-asset-icon"><img src="${logoUrl}?width=50" alt="${asset.symbol}" onerror="this.parentElement.innerHTML='<div style=\\'width:50px;height:50px;border-radius:50%;background:#04b3e1;display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:1.2rem\\'>${asset.symbol.charAt(0)}</div>'"></div>`
                    : `<div class="t-asset-icon"><div style="width:50px;height:50px;border-radius:50%;background:#04b3e1;display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:1.2rem">${asset.symbol.charAt(0)}</div></div>`;
            } else {
                const stockLogoMap = {
                    'AAPL': 'apple.com', 'MSFT': 'microsoft.com', 'TSLA': 'tesla.com',
                    'NVDA': 'nvidia.com', 'AMZN': 'amazon.com', 'GOOGL': 'google.com', 'META': 'meta.com',
                    'BRK.B': 'berkshirehathaway.com', 'LLY': 'lilly.com', 'V': 'visa.com',
                    'JPM': 'jpmorganchase.com', 'WMT': 'walmart.com', 'MA': 'mastercard.com',
                    'PG': 'pg.com', 'HD': 'homedepot.com', 'XOM': 'exxonmobil.com',
                    'JNJ': 'jnj.com', 'COST': 'costco.com', 'ABBV': 'abbvie.com', 'CRM': 'salesforce.com',
                    'NFLX': 'netflix.com', 'ORCL': 'oracle.com', 'AMD': 'amd.com', 'INTC': 'intel.com',
                    'DIS': 'thewaltdisneycompany.com', 'BA': 'boeing.com', 'UBER': 'uber.com',
                    'PYPL': 'paypal.com', 'SQ': 'squareup.com', 'COIN': 'coinbase.com',
                    'SPY': '', 'QQQ': '', 'IWM': '', 'DIA': '', 'VTI': '',
                    'VOO': '', 'VEA': '', 'VWO': '', 'GLD': '', 'SLV': '',
                    'TLT': '', 'XLF': '', 'XLK': '', 'ARKK': '', 'EEM': '',
                };
                const domain = stockLogoMap[asset.symbol] || '';
                iconHtml = domain
                    ? `<div class="t-asset-icon"><img src="https://logo.clearbit.com/${domain}" alt="${asset.symbol}" onerror="this.parentElement.innerHTML='<div style=\\'width:50px;height:50px;border-radius:50%;background:#04b3e1;display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:1.2rem\\'>${asset.symbol.charAt(0)}</div>'"></div>`
                    : `<div class="t-asset-icon"><div style="width:50px;height:50px;border-radius:50%;background:#04b3e1;display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:1.2rem">${asset.symbol.charAt(0)}</div></div>`;
            }

            html += `
                <div class="t-asset-item" onclick="window.location.href='/user/trading/${asset.symbol}'">
                    ${iconHtml}
                    <div class="t-asset-name">
                        <div class="symbol">${asset.symbol}</div>
                        <div class="category">${asset.category}</div>
                    </div>
                    <div class="t-asset-price">${asset.price}</div>
                    <div class="t-asset-change ${c1Class}">${asset.c1}</div>
                    <div class="t-asset-change ${c2Class}">${asset.c2}</div>
                    <div class="t-asset-change ${c3Class}">${asset.c3}</div>
                    <button class="t-star-btn ${isStarred ? 'starred' : ''}" onclick="event.stopPropagation(); toggleStar('${asset.symbol}', this)">
                        <svg viewBox="0 0 24 24" fill="${isStarred ? 'currentColor' : 'none'}" stroke="currentColor" stroke-width="2">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                        </svg>
                    </button>
                </div>`;
        });
        list.innerHTML = html;
    }

    function toggleStar(symbol, btn) {
        const idx = starredSymbols.indexOf(symbol);
        if (idx > -1) {
            starredSymbols.splice(idx, 1);
            btn.classList.remove('starred');
            btn.querySelector('svg').setAttribute('fill', 'none');
        } else {
            starredSymbols.push(symbol);
            btn.classList.add('starred');
            btn.querySelector('svg').setAttribute('fill', 'currentColor');
        }
        localStorage.setItem('starredAssets', JSON.stringify(starredSymbols));
    }

    // Search
    document.getElementById('tSearch').addEventListener('input', function() {
        applyTradingFilters();
    });

    // Category filter
    document.getElementById('tCategoryFilter').addEventListener('change', function() {
        applyTradingFilters();
    });

    // Sort filter
    document.getElementById('tSortFilter').addEventListener('change', function() {
        applyTradingFilters();
    });

    function applyTradingFilters() {
        const category = document.getElementById('tCategoryFilter').value;
        const sort = document.getElementById('tSortFilter').value;
        const q = document.getElementById('tSearch').value.toLowerCase();
        const starTab = document.getElementById('tStarTab').classList.contains('active-filter');

        tFilteredAssets = tradingAssets.filter(a => {
            const matchCategory = category === 'all' || a.category === category;
            const matchSearch = a.symbol.toLowerCase().includes(q) || a.category.toLowerCase().includes(q);
            const matchStar = starTab ? starredSymbols.includes(a.symbol) : true;
            return matchCategory && matchSearch && matchStar;
        });

        if (sort === 'name_asc') tFilteredAssets.sort((a, b) => a.symbol.localeCompare(b.symbol));
        if (sort === 'name_desc') tFilteredAssets.sort((a, b) => b.symbol.localeCompare(a.symbol));
        if (sort === 'price_asc') tFilteredAssets.sort((a, b) => parseFloat(a.price) - parseFloat(b.price));
        if (sort === 'price_desc') tFilteredAssets.sort((a, b) => parseFloat(b.price) - parseFloat(a.price));

        tCurrentPage = 1;
        renderTradingAssets();
    }

    // Pagination
    document.getElementById('tNextPage').addEventListener('click', function() {
        const totalPages = Math.max(1, Math.ceil(tFilteredAssets.length / T_ITEMS_PER_PAGE));
        tCurrentPage = tCurrentPage < totalPages ? tCurrentPage + 1 : 1;
        renderTradingAssets();
    });

    // Check URL params
    const tUrlParams = new URLSearchParams(window.location.search);
    if (tUrlParams.get('current') === 'tradeables') {
        // Already on assets view
    }

    // Initial render
    renderTradingAssets();
</script>

@include('user.layouts.footer')