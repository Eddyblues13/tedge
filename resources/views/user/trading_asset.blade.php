@include('user.layouts.header')

<style>
    /* Trading Asset Page - Full Layout */
    .trading-page {
        display: flex;
        height: calc(100vh - 60px);
        padding-bottom: 60px;
        overflow: hidden;
    }

    /* Left Panel */
    .trading-left {
        width: 280px;
        min-width: 280px;
        border-right: 1px solid var(--border-color, #dbdcdf);
        display: flex;
        flex-direction: column;
        background: var(--card-bg, #ffffff);
    }

    .trading-left-header {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 14px;
        border-bottom: 1px solid var(--border-color, #dbdcdf);
    }

    .tech-select {
        padding: 6px 28px 6px 10px;
        border: 1px solid var(--border-color, #dbdcdf);
        border-radius: 6px;
        background: var(--card-bg, #ffffff);
        color: var(--heading-color, #000000);
        font-size: 0.8rem;
        font-weight: 700;
        appearance: none;
        -webkit-appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10' viewBox='0 0 10 10'%3E%3Cpath fill='%23718096' d='M5 7L1 3h8z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 8px center;
        cursor: pointer;
    }

    .pair-label {
        font-weight: 700;
        font-size: 0.95rem;
        color: var(--heading-color, #000000);
        white-space: nowrap;
    }

    .star-icon-btn {
        background: none;
        border: none;
        cursor: pointer;
        color: var(--text-color, #a0aec0);
        font-size: 1.2rem;
        padding: 0;
        margin-left: auto;
    }

    .star-icon-btn.starred {
        color: #f59e0b;
    }

    .pair-icon-group {
        display: flex;
        align-items: center;
        position: relative;
        min-width: 36px;
        height: 28px;
    }

    .pair-icon-group img {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid var(--card-bg, #ffffff);
    }

    .pair-icon-group img:nth-child(2) {
        margin-left: -8px;
    }

    .pair-icon-group .pair-icon-fallback {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: #04b3e1;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 0.65rem;
        border: 2px solid var(--card-bg, #ffffff);
    }

    .no-trades-area {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--heading-color, #000000);
        font-weight: 600;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }

    /* Center - Chart */
    .trading-center {
        flex: 1;
        min-width: 0;
        display: flex;
        flex-direction: column;
    }

    .trading-center #tradingview-chart {
        flex: 1;
        width: 100%;
        min-height: 300px;
    }

    /* Right Panel */
    .trading-right {
        width: 220px;
        min-width: 220px;
        border-left: 1px solid var(--border-color, #dbdcdf);
        padding: 14px;
        display: flex;
        flex-direction: column;
        background: var(--card-bg, #ffffff);
    }

    .trade-field-label {
        font-size: 0.75rem;
        color: var(--text-color, #4a4a4a);
        margin-bottom: 4px;
        text-align: right;
    }

    .trade-field-sublabel {
        font-size: 0.7rem;
        color: var(--text-color, #a0aec0);
        margin-bottom: 4px;
        text-align: right;
    }

    .trade-input {
        width: 100%;
        padding: 8px 10px;
        border: 1px solid var(--border-color, #dbdcdf);
        border-radius: 6px;
        background: var(--input-bg, #f3f4f6);
        color: var(--heading-color, #000000);
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 14px;
        text-align: left;
        box-sizing: border-box;
    }

    .trade-input:focus {
        outline: none;
        border-color: #04b3e1;
    }

    .trade-btn-up {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 8px;
        font-size: 0.95rem;
        font-weight: 700;
        cursor: pointer;
        margin-bottom: 8px;
        background: #10b981;
        color: #ffffff;
        transition: background 0.2s;
    }

    .trade-btn-up:hover {
        background: #059669;
    }

    .trade-btn-down {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 8px;
        font-size: 0.95rem;
        font-weight: 700;
        cursor: pointer;
        background: #ef4444;
        color: #ffffff;
        transition: background 0.2s;
    }

    .trade-btn-down:hover {
        background: #dc2626;
    }

    .trade-right-spacer {
        flex: 1;
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

    /* Mobile Responsive */
    @media (max-width: 992px) {
        .trading-left {
            display: none;
        }
        .trading-right {
            width: 180px;
            min-width: 180px;
            padding: 10px;
        }
    }

    @media (max-width: 768px) {
        .trading-page {
            flex-direction: column;
            height: auto;
            min-height: calc(100vh - 60px);
        }
        .trading-right {
            width: 100%;
            min-width: 100%;
            border-left: none;
            border-top: 1px solid var(--border-color, #dbdcdf);
            padding: 14px 16px;
        }
        .trading-center #tradingview-chart {
            height: 350px;
            min-height: 350px;
        }
        .trade-btn-row-mobile {
            display: flex;
            gap: 10px;
        }
        .trade-btn-row-mobile .trade-btn-up,
        .trade-btn-row-mobile .trade-btn-down {
            flex: 1;
            margin-bottom: 0;
        }
    }

    /* Trade success/error toast */
    .trade-toast {
        position: fixed;
        top: 80px;
        right: 20px;
        padding: 14px 24px;
        border-radius: 10px;
        color: #fff;
        font-weight: 700;
        font-size: 0.9rem;
        z-index: 9999;
        opacity: 0;
        transform: translateY(-20px);
        transition: all 0.3s ease;
        pointer-events: none;
    }

    .trade-toast.show {
        opacity: 1;
        transform: translateY(0);
    }

    .trade-toast.success {
        background: #10b981;
    }

    .trade-toast.error {
        background: #ef4444;
    }
</style>

<!-- Toast Notification -->
<div class="trade-toast" id="tradeToast"></div>

<!-- Trading Page -->
<div class="trading-page">

    <!-- Left Panel -->
    <div class="trading-left">
        <div class="trading-left-header">
            <select class="tech-select" id="chartType">
                <option value="technical">TECHNICAL</option>
                <option value="simple">SIMPLE</option>
            </select>
            <div class="pair-icon-group" id="pairIconGroup"></div>
            <span class="pair-label" id="pairLabel">{{ strtoupper($symbol) }}</span>
            <button class="star-icon-btn" id="starBtn" onclick="toggleStarPair()">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                </svg>
            </button>
        </div>
        <div class="no-trades-area" id="openTradesStatus">
            @if(isset($openTrades) && $openTrades > 0)
                {{ $openTrades }} OPEN TRADE{{ $openTrades > 1 ? 'S' : '' }}
            @else
                NO OPEN TRADES
            @endif
        </div>
    </div>

    <!-- Center - Chart -->
    <div class="trading-center">
        <div id="tradingview-chart"></div>
    </div>

    <!-- Right Panel -->
    <div class="trading-right">
        <div class="trade-field-label">Amount ({{ Auth::user()->currency ?? 'CAD' }})</div>
        <input type="number" class="trade-input" id="amountUsd" value="0" min="0" step="0.01" oninput="calculateAssetAmount()">

        <div class="trade-field-sublabel" id="assetAmountLabel">Amount ({{ strtoupper($symbol) }}) (<span id="currentPrice">0</span> {{ Auth::user()->currency ?? 'CAD' }})</div>
        <input type="number" class="trade-input" id="amountAsset" value="0" min="0" step="0.00000001" oninput="calculateUsdAmount()">

        <div class="trade-field-label">Leverage (250 MAX)</div>
        <input type="number" class="trade-input" id="leverage" value="25" min="1" max="250">

        <div class="trade-field-label">Time (Minutes)</div>
        <input type="number" class="trade-input" id="tradeTime" value="5" min="1">

        <div class="trade-right-spacer"></div>

        <button class="trade-btn-up" onclick="placeTrade('up')">UP</button>
        <button class="trade-btn-down" onclick="placeTrade('down')">DOWN</button>
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
    <a href="{{route('holding')}}?current=holdables&where=holdable:yes" class="t-tab-item">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="18" y1="20" x2="18" y2="10"/>
            <line x1="12" y1="20" x2="12" y2="4"/>
            <line x1="6" y1="20" x2="6" y2="14"/>
        </svg>
        Assets
    </a>
    <a href="{{route('trading')}}" class="t-tab-item active">
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

<!-- TradingView Script -->
<script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
<script>
    const currentSymbol = '{{ strtoupper($symbol) }}';
    const userCurrency = '{{ Auth::user()->currency ?? "CAD" }}';
    const tradingBalance = {{ $tradingBalance ?? 0 }};

    // Asset prices for calculations
    const assetPrices = {
        'AUDBRL': 3.6848, 'AUDCAD': 0.961, 'AUDCHF': 0.57126, 'AUDJPY': 97.845,
        'AUDNZD': 1.10234, 'AUDUSD': 0.63456, 'CADJPY': 107.234, 'CHFZAR': 20.751,
        'EURAUD': 1.68086, 'EURBRL': 6.192, 'EURCAD': 1.61509, 'EURCHF': 0.96123,
        'EURGBP': 0.84567, 'EURJPY': 164.523, 'EURUSD': 1.06789, 'GBPAUD': 1.98765,
        'GBPCAD': 1.74523, 'GBPCHF': 1.13678, 'GBPJPY': 194.567, 'GBPUSD': 1.26345,
        'NZDUSD': 0.57567, 'USDCAD': 1.43678, 'USDCHF': 0.90123, 'USDJPY': 154.234,
        'USDZAR': 18.457,
        'BTCUSD': 97245.00, 'ETHUSD': 2654.30, 'XRPUSD': 2.34, 'SOLUSD': 178.90,
        'BNBUSD': 645.30, 'ADAUSD': 0.6521, 'DOGEUSD': 0.2156, 'TRXUSD': 0.2345,
        'DOTUSD': 4.56, 'LINKUSD': 14.23, 'MATICUSD': 0.3245, 'AVAXUSD': 22.45,
        'LTCUSD': 98.45, 'ATOMUSD': 6.89, 'UNIUSD': 7.82, 'XLMUSD': 0.3456,
        'ALGOUSD': 0.1834, 'NEARUSD': 3.45, 'FILUSD': 3.78, 'AAVEUSD': 245.67,
        'APTUSD': 5.67, 'ARBUSD': 0.5678, 'OPUSD': 1.234, 'MKRUSD': 1456.78,
        'INJUSD': 15.67, 'RNDRUSD': 4.89, 'SUIUSD': 1.345, 'SHIBUSD': 0.00001234,
        'PEPEUSD': 0.00001345, 'TONUSD': 3.45,
        'AAPL': 227.50, 'MSFT': 415.30, 'TSLA': 345.20, 'NVDA': 890.10,
        'AMZN': 178.45, 'GOOGL': 155.30, 'META': 567.80, 'BRK.B': 412.56,
        'LLY': 789.34, 'V': 278.90, 'JPM': 198.67, 'WMT': 167.45,
        'MA': 456.78, 'PG': 165.23, 'HD': 378.90, 'XOM': 108.45,
        'JNJ': 156.78, 'COST': 745.67, 'ABBV': 178.90, 'CRM': 278.34,
        'NFLX': 678.90, 'ORCL': 156.78, 'AMD': 134.56, 'INTC': 23.45,
        'DIS': 98.67, 'BA': 178.90, 'UBER': 67.89, 'PYPL': 72.34,
        'SQ': 78.90, 'COIN': 234.56,
        'SPY': 502.34, 'QQQ': 432.56, 'IWM': 198.78, 'DIA': 389.12,
        'VTI': 245.67, 'VOO': 460.23, 'VEA': 48.56, 'VWO': 42.34,
        'GLD': 198.45, 'SLV': 22.78, 'TLT': 92.34, 'XLF': 39.56,
        'XLK': 198.90, 'ARKK': 45.67, 'EEM': 40.12
    };

    // Exchange mapping for TradingView
    const exchangeMap = {
        'AUDBRL': 'OANDA', 'AUDCAD': 'OANDA', 'AUDCHF': 'OANDA', 'AUDJPY': 'OANDA',
        'AUDNZD': 'OANDA', 'AUDUSD': 'OANDA', 'CADJPY': 'OANDA', 'CHFZAR': 'OANDA',
        'EURAUD': 'OANDA', 'EURBRL': 'OANDA', 'EURCAD': 'OANDA', 'EURCHF': 'OANDA',
        'EURGBP': 'OANDA', 'EURJPY': 'OANDA', 'EURUSD': 'OANDA', 'GBPAUD': 'OANDA',
        'GBPCAD': 'OANDA', 'GBPCHF': 'OANDA', 'GBPJPY': 'OANDA', 'GBPUSD': 'OANDA',
        'NZDUSD': 'OANDA', 'USDCAD': 'OANDA', 'USDCHF': 'OANDA', 'USDJPY': 'OANDA',
        'USDZAR': 'OANDA',
        'BTCUSD': 'BINANCE', 'ETHUSD': 'BINANCE', 'XRPUSD': 'BINANCE', 'SOLUSD': 'BINANCE',
        'BNBUSD': 'BINANCE', 'ADAUSD': 'BINANCE', 'DOGEUSD': 'BINANCE', 'TRXUSD': 'BINANCE',
        'DOTUSD': 'BINANCE', 'LINKUSD': 'BINANCE', 'MATICUSD': 'BINANCE', 'AVAXUSD': 'BINANCE',
        'LTCUSD': 'BINANCE', 'ATOMUSD': 'BINANCE', 'UNIUSD': 'BINANCE', 'XLMUSD': 'BINANCE',
        'ALGOUSD': 'BINANCE', 'NEARUSD': 'BINANCE', 'FILUSD': 'BINANCE', 'AAVEUSD': 'BINANCE',
        'APTUSD': 'BINANCE', 'ARBUSD': 'BINANCE', 'OPUSD': 'BINANCE', 'MKRUSD': 'BINANCE',
        'INJUSD': 'BINANCE', 'RNDRUSD': 'BINANCE', 'SUIUSD': 'BINANCE', 'SHIBUSD': 'BINANCE',
        'PEPEUSD': 'BINANCE', 'TONUSD': 'BINANCE',
        'AAPL': 'NASDAQ', 'MSFT': 'NASDAQ', 'TSLA': 'NASDAQ', 'NVDA': 'NASDAQ',
        'AMZN': 'NASDAQ', 'GOOGL': 'NASDAQ', 'META': 'NASDAQ', 'NFLX': 'NASDAQ',
        'AMD': 'NASDAQ', 'INTC': 'NASDAQ', 'COST': 'NASDAQ', 'PYPL': 'NASDAQ',
        'COIN': 'NASDAQ', 'ORCL': 'NYSE',
        'BRK.B': 'NYSE', 'LLY': 'NYSE', 'V': 'NYSE', 'JPM': 'NYSE', 'WMT': 'NYSE',
        'MA': 'NYSE', 'PG': 'NYSE', 'HD': 'NYSE', 'XOM': 'NYSE', 'JNJ': 'NYSE',
        'ABBV': 'NYSE', 'CRM': 'NYSE', 'DIS': 'NYSE', 'BA': 'NYSE', 'UBER': 'NYSE',
        'SQ': 'NYSE',
        'SPY': 'AMEX', 'QQQ': 'NASDAQ', 'IWM': 'AMEX', 'DIA': 'AMEX',
        'VTI': 'AMEX', 'VOO': 'AMEX', 'VEA': 'AMEX', 'VWO': 'AMEX',
        'GLD': 'AMEX', 'SLV': 'AMEX', 'TLT': 'NASDAQ', 'XLF': 'AMEX',
        'XLK': 'AMEX', 'ARKK': 'AMEX', 'EEM': 'AMEX'
    };

    // Determine asset category
    function getAssetCategory(s) {
        const forexPairs = ['AUDBRL','AUDCAD','AUDCHF','AUDJPY','AUDNZD','AUDUSD','CADJPY','CHFZAR',
            'EURAUD','EURBRL','EURCAD','EURCHF','EURGBP','EURJPY','EURUSD','GBPAUD','GBPCAD',
            'GBPCHF','GBPJPY','GBPUSD','NZDUSD','USDCAD','USDCHF','USDJPY','USDZAR'];
        if (forexPairs.includes(s)) return 'forex';
        if (s.endsWith('USD') && !forexPairs.includes(s)) return 'crypto';
        return 'stocks';
    }

    document.addEventListener('DOMContentLoaded', function() {
        initializeTradingView(currentSymbol);
        updatePriceDisplay();
        loadStarState();
        renderPairIcon();
    });

    // Render the icon for the current symbol in the left panel
    function renderPairIcon() {
        const container = document.getElementById('pairIconGroup');
        if (!container) return;

        const category = getAssetCategory(currentSymbol);

        if (category === 'forex') {
            const flagMap = {
                'AUD':'au','BRL':'br','CAD':'ca','CHF':'ch','CNY':'cn','EUR':'eu',
                'GBP':'gb','HKD':'hk','JPY':'jp','MXN':'mx','NOK':'no','NZD':'nz',
                'PLN':'pl','SEK':'se','SGD':'sg','TRY':'tr','USD':'us','ZAR':'za'
            };
            const base = currentSymbol.substring(0, 3);
            const quote = currentSymbol.substring(3, 6);
            const baseFlag = flagMap[base] || '';
            const quoteFlag = flagMap[quote] || '';
            const fallback = (code) => `<div class="pair-icon-fallback">${code}</div>`;
            container.innerHTML = 
                (baseFlag ? `<img src="https://flagcdn.com/w40/${baseFlag}.png" alt="${base}" onerror="this.outerHTML='${fallback(base).replace(/'/g, "\\'")}'" >` : fallback(base)) +
                (quoteFlag ? `<img src="https://flagcdn.com/w40/${quoteFlag}.png" alt="${quote}" onerror="this.outerHTML='${fallback(quote).replace(/'/g, "\\'")}'" >` : fallback(quote));
        } else if (category === 'crypto') {
            const cryptoLogos = {
                'BTCUSD': 'bitcoin-btc', 'ETHUSD': 'ethereum-eth', 'XRPUSD': 'xrp-xrp',
                'SOLUSD': 'solana-sol', 'BNBUSD': 'bnb-bnb', 'ADAUSD': 'cardano-ada',
                'DOGEUSD': 'dogecoin-doge', 'TRXUSD': 'tron-trx', 'DOTUSD': 'polkadot-new-dot',
                'LINKUSD': 'chainlink-link', 'MATICUSD': 'polygon-matic', 'AVAXUSD': 'avalanche-avax',
                'LTCUSD': 'litecoin-ltc', 'ATOMUSD': 'cosmos-atom', 'UNIUSD': 'uniswap-uni',
                'XLMUSD': 'stellar-xlm', 'ALGOUSD': 'algorand-algo', 'NEARUSD': 'near-protocol-near',
                'FILUSD': 'filecoin-fil', 'AAVEUSD': 'aave-aave', 'APTUSD': 'aptos-apt',
                'ARBUSD': 'arbitrum-arb', 'OPUSD': 'optimism-ethereum-op', 'MKRUSD': 'maker-mkr',
                'INJUSD': 'injective-inj', 'RNDRUSD': 'render-token-rndr', 'SUIUSD': 'sui-sui',
                'SHIBUSD': 'shiba-inu-shib', 'PEPEUSD': 'pepe-pepe', 'TONUSD': 'toncoin-ton',
            };
            const slug = cryptoLogos[currentSymbol];
            const name = currentSymbol.replace('USD', '');
            if (slug) {
                container.innerHTML = `<img src="https://cryptologos.cc/logos/${slug}-logo.png" alt="${name}" onerror="this.outerHTML='<div class=pair-icon-fallback>${name.charAt(0)}</div>'">`;
            } else {
                container.innerHTML = `<div class="pair-icon-fallback">${name.charAt(0)}</div>`;
            }
        } else {
            const stockDomains = {
                'AAPL':'apple.com','MSFT':'microsoft.com','TSLA':'tesla.com','NVDA':'nvidia.com',
                'AMZN':'amazon.com','GOOGL':'google.com','META':'meta.com','BRK.B':'berkshirehathaway.com',
                'LLY':'lilly.com','V':'visa.com','JPM':'jpmorganchase.com','WMT':'walmart.com',
                'MA':'mastercard.com','PG':'pg.com','HD':'homedepot.com','XOM':'exxonmobil.com',
                'JNJ':'jnj.com','COST':'costco.com','ABBV':'abbvie.com','CRM':'salesforce.com',
                'NFLX':'netflix.com','ORCL':'oracle.com','AMD':'amd.com','INTC':'intel.com',
                'DIS':'thewaltdisneycompany.com','BA':'boeing.com','UBER':'uber.com',
                'PYPL':'paypal.com','SQ':'squareup.com','COIN':'coinbase.com'
            };
            const domain = stockDomains[currentSymbol];
            if (domain) {
                container.innerHTML = `<img src="https://logo.clearbit.com/${domain}" alt="${currentSymbol}" onerror="this.outerHTML='<div class=pair-icon-fallback>${currentSymbol.charAt(0)}</div>'">`;
            } else {
                container.innerHTML = `<div class="pair-icon-fallback">${currentSymbol.charAt(0)}</div>`;
            }
        }
    }

    // Listen for theme changes
    window.addEventListener('themeChanged', function() {
        initializeTradingView(currentSymbol);
    });

    function initializeTradingView(symbol) {
        document.getElementById('tradingview-chart').innerHTML = '';

        const isDark = document.documentElement.classList.contains('dark');
        const theme = isDark ? 'dark' : 'light';
        const toolbarBg = isDark ? '#1a1f2b' : '#f1f3f6';
        const exchange = exchangeMap[symbol] || 'OANDA';

        // Build TradingView symbol
        let tvSymbol = `${exchange}:${symbol}`;
        if (exchange === 'BINANCE') {
            tvSymbol = `${exchange}:${symbol.replace('USD', 'USDT')}`;
        }

        try {
            new TradingView.widget({
                "autosize": true,
                "symbol": tvSymbol,
                "interval": "5",
                "timezone": "Etc/UTC",
                "theme": theme,
                "style": "1",
                "locale": "en",
                "toolbar_bg": toolbarBg,
                "enable_publishing": false,
                "hide_top_toolbar": false,
                "hide_side_toolbar": true,
                "allow_symbol_change": false,
                "container_id": "tradingview-chart",
                "save_image": false
            });
        } catch(e) {
            console.error('TradingView widget error:', e);
        }
    }

    function updatePriceDisplay() {
        const price = assetPrices[currentSymbol] || 0;
        document.getElementById('currentPrice').textContent = price;
    }

    function calculateAssetAmount() {
        const usdAmount = parseFloat(document.getElementById('amountUsd').value) || 0;
        const price = assetPrices[currentSymbol] || 1;
        const assetAmount = usdAmount / price;
        document.getElementById('amountAsset').value = assetAmount.toFixed(8);
    }

    function calculateUsdAmount() {
        const assetAmount = parseFloat(document.getElementById('amountAsset').value) || 0;
        const price = assetPrices[currentSymbol] || 1;
        const usdAmount = assetAmount * price;
        document.getElementById('amountUsd').value = usdAmount.toFixed(2);
    }

    function showToast(message, type) {
        const toast = document.getElementById('tradeToast');
        toast.textContent = message;
        toast.className = 'trade-toast ' + type + ' show';
        setTimeout(() => {
            toast.classList.remove('show');
        }, 3000);
    }

    function placeTrade(direction) {
        const amount = parseFloat(document.getElementById('amountUsd').value) || 0;
        const leverage = parseInt(document.getElementById('leverage').value) || 25;
        const time = parseInt(document.getElementById('tradeTime').value) || 5;

        // Validation
        if (amount <= 0) {
            showToast('Please enter a valid amount', 'error');
            return;
        }

        if (amount > tradingBalance) {
            showToast('Insufficient trading balance', 'error');
            return;
        }

        if (leverage < 1 || leverage > 250) {
            showToast('Leverage must be between 1 and 250', 'error');
            return;
        }

        if (time < 1) {
            showToast('Time must be at least 1 minute', 'error');
            return;
        }

        // Disable buttons while processing
        const upBtn = document.querySelector('.trade-btn-up');
        const downBtn = document.querySelector('.trade-btn-down');
        upBtn.disabled = true;
        downBtn.disabled = true;
        upBtn.style.opacity = '0.6';
        downBtn.style.opacity = '0.6';

        // Send trade request
        fetch('/user/place-trade', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                symbol: currentSymbol,
                direction: direction,
                amount: amount,
                leverage: leverage,
                time: time,
                price: assetPrices[currentSymbol] || 0
            })
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(data => { throw data; });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                showToast(data.message || `Trade placed: ${direction.toUpperCase()} ${currentSymbol} - $${amount}`, 'success');
                document.getElementById('openTradesStatus').textContent = '1 OPEN TRADE';
                // Reset amount field
                document.getElementById('amountUsd').value = '0';
                document.getElementById('amountAsset').value = '0';
            } else {
                showToast(data.message || 'Trade failed', 'error');
            }
        })
        .catch(error => {
            if (error && error.message) {
                showToast(error.message, 'error');
            } else {
                showToast('An error occurred while placing the trade', 'error');
            }
        })
        .finally(() => {
            upBtn.disabled = false;
            downBtn.disabled = false;
            upBtn.style.opacity = '1';
            downBtn.style.opacity = '1';
        });
    }

    function toggleStarPair() {
        const btn = document.getElementById('starBtn');
        btn.classList.toggle('starred');
        const svg = btn.querySelector('svg');
        let starred = JSON.parse(localStorage.getItem('starredAssets') || '[]');

        if (btn.classList.contains('starred')) {
            svg.setAttribute('fill', 'currentColor');
            if (!starred.includes(currentSymbol)) {
                starred.push(currentSymbol);
            }
        } else {
            svg.setAttribute('fill', 'none');
            starred = starred.filter(s => s !== currentSymbol);
        }
        localStorage.setItem('starredAssets', JSON.stringify(starred));
    }

    function loadStarState() {
        const starred = JSON.parse(localStorage.getItem('starredAssets') || '[]');
        if (starred.includes(currentSymbol)) {
            const btn = document.getElementById('starBtn');
            btn.classList.add('starred');
            btn.querySelector('svg').setAttribute('fill', 'currentColor');
        }
    }
</script>

@include('user.layouts.footer')
