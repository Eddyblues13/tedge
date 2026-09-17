@include('user.layouts.header')

<style>
    .asset-detail-container {
        padding: 15px;
        max-width: 900px;
        margin: 0 auto;
    }

    /* Back button */
    .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: var(--text-color, #4a4a4a);
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 16px;
        padding: 6px 0;
    }

    .back-btn:hover {
        color: #04b3e1;
        text-decoration: none;
    }

    .back-btn svg {
        width: 18px;
        height: 18px;
    }

    /* Asset Header */
    .asset-header {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 8px;
    }

    .asset-header-icon {
        width: 55px;
        height: 55px;
        border-radius: 50%;
        overflow: hidden;
        flex-shrink: 0;
    }

    .asset-header-icon img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .asset-header-info .asset-detail-name {
        font-size: 1.4rem;
        font-weight: 800;
        color: var(--heading-color, #000000);
    }

    .asset-header-info .asset-detail-pair {
        font-size: 0.85rem;
        color: var(--text-color, #4a4a4a);
    }

    /* Price Section */
    .asset-price-section {
        margin-bottom: 8px;
    }

    .asset-detail-price {
        font-size: 2.2rem;
        font-weight: 800;
        color: var(--heading-color, #000000);
    }

    .asset-detail-changes {
        display: flex;
        gap: 12px;
        margin-bottom: 20px;
    }

    .asset-change-badge {
        font-weight: 700;
        font-size: 0.9rem;
        padding: 4px 14px;
        border-radius: 6px;
    }

    .asset-change-badge.positive {
        color: #10b981;
        background: rgba(16, 185, 129, 0.1);
    }

    .asset-change-badge.negative {
        color: #ef4444;
        background: rgba(239, 68, 68, 0.1);
    }

    /* Chart */
    .chart-wrapper {
        width: 100%;
        height: 300px;
        border-radius: 12px;
        overflow: hidden;
        background: var(--card-bg, #ffffff);
        border: 1px solid var(--border-color, #dbdcdf);
        margin-bottom: 12px;
    }

    .chart-wrapper canvas {
        width: 100%;
        height: 100%;
    }

    /* Time Period Buttons */
    .period-btns {
        display: flex;
        justify-content: center;
        gap: 8px;
        margin-bottom: 24px;
    }

    .period-btn {
        padding: 7px 16px;
        border: 1px solid var(--border-color, #dbdcdf);
        border-radius: 8px;
        background: var(--card-bg, #ffffff);
        color: var(--text-color, #4a4a4a);
        font-size: 0.8rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s;
    }

    .period-btn.active {
        background: #04b3e1;
        color: #ffffff;
        border-color: #04b3e1;
    }

    /* Stats Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin-bottom: 24px;
    }

    .stat-card {
        background: var(--card-bg, #ffffff);
        border: 1px solid var(--border-color, #dbdcdf);
        border-radius: 10px;
        padding: 14px 16px;
    }

    .stat-label {
        font-size: 0.78rem;
        color: var(--text-color, #4a4a4a);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        margin-bottom: 4px;
    }

    .stat-value {
        font-size: 1.1rem;
        font-weight: 800;
        color: var(--heading-color, #000000);
    }

    /* Buy Button */
    .buy-hold-btn {
        display: block;
        width: 100%;
        padding: 16px;
        background: #04b3e1;
        color: #ffffff;
        border: none;
        border-radius: 12px;
        font-size: 1.1rem;
        font-weight: 700;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        transition: background 0.2s;
    }

    .buy-hold-btn:hover {
        background: #038bb0;
        color: #ffffff;
        text-decoration: none;
    }

    @media (max-width: 600px) {
        .asset-detail-price {
            font-size: 1.8rem;
        }
        .chart-wrapper {
            height: 220px;
        }
    }
</style>

<div class="asset-detail-container">
    <!-- Back Button -->
    <a href="{{ route('holding') }}?current=holdables&where=holdable:yes" class="back-btn">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M19 12H5"/>
            <path d="M12 19l-7-7 7-7"/>
        </svg>
        Back to Assets
    </a>

    <!-- Asset Header -->
    <div class="asset-header">
        <div class="asset-header-icon" id="assetIcon"></div>
        <div class="asset-header-info">
            <div class="asset-detail-name" id="assetName"></div>
            <div class="asset-detail-pair" id="assetPair"></div>
        </div>
    </div>

    <!-- Price -->
    <div class="asset-price-section">
        <div class="asset-detail-price" id="assetPrice"></div>
    </div>
    <div class="asset-detail-changes">
        <span class="asset-change-badge" id="assetChange1"></span>
        <span class="asset-change-badge" id="assetChange2"></span>
    </div>

    <!-- Chart -->
    <div class="chart-wrapper">
        <canvas id="priceChart"></canvas>
    </div>

    <!-- Period Buttons -->
    <div class="period-btns">
        <button class="period-btn" onclick="changePeriod('1D', this)">1D</button>
        <button class="period-btn" onclick="changePeriod('1W', this)">1W</button>
        <button class="period-btn active" onclick="changePeriod('1M', this)">1M</button>
        <button class="period-btn" onclick="changePeriod('3M', this)">3M</button>
        <button class="period-btn" onclick="changePeriod('1Y', this)">1Y</button>
    </div>

    <!-- Stats -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-label">Market Cap</div>
            <div class="stat-value" id="statMarketCap">—</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Volume (24h)</div>
            <div class="stat-value" id="statVolume">—</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">High (24h)</div>
            <div class="stat-value" id="statHigh">—</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Low (24h)</div>
            <div class="stat-value" id="statLow">—</div>
        </div>
    </div>

    <!-- Buy Button -->
    <a href="{{ route('deposit.one') }}" class="buy-hold-btn">Buy / Hold</a>
</div>

<script>
    // Asset data
    const assetsData = {
        '1INCHUSD': { name: '1inch', pair: '1INCHUSD crypto', price: '0.0986', change1: '+13.75%', change2: '+4.4%', icon: 'https://cryptologos.cc/logos/1inch-1inch-logo.png', category: 'crypto' },
        'AAVEUSD': { name: 'Aave', pair: 'AAVEUSD crypto', price: '113.05', change1: '+3.48%', change2: '-8.7%', icon: 'https://cryptologos.cc/logos/aave-aave-logo.png', category: 'crypto' },
        'ALGOUSD': { name: 'Algorand', pair: 'ALGOUSD crypto', price: '0.1834', change1: '+5.21%', change2: '-2.1%', icon: 'https://cryptologos.cc/logos/algorand-algo-logo.png', category: 'crypto' },
        'AVAXUSD': { name: 'Avalanche', pair: 'AVAXUSD crypto', price: '22.45', change1: '+8.12%', change2: '+3.2%', icon: 'https://cryptologos.cc/logos/avalanche-avax-logo.png', category: 'crypto' },
        'BTCUSD': { name: 'Bitcoin', pair: 'BTCUSD crypto', price: '97245.00', change1: '+2.34%', change2: '+1.8%', icon: 'https://cryptologos.cc/logos/bitcoin-btc-logo.png', category: 'crypto' },
        'ADAUSD': { name: 'Cardano', pair: 'ADAUSD crypto', price: '0.6521', change1: '+4.56%', change2: '-1.3%', icon: 'https://cryptologos.cc/logos/cardano-ada-logo.png', category: 'crypto' },
        'LINKUSD': { name: 'Chainlink', pair: 'LINKUSD crypto', price: '14.23', change1: '+6.78%', change2: '+2.5%', icon: 'https://cryptologos.cc/logos/chainlink-link-logo.png', category: 'crypto' },
        'ATOMUSD': { name: 'Cosmos', pair: 'ATOMUSD crypto', price: '6.89', change1: '+3.21%', change2: '-4.1%', icon: 'https://cryptologos.cc/logos/cosmos-atom-logo.png', category: 'crypto' },
        'DOGEUSD': { name: 'Dogecoin', pair: 'DOGEUSD crypto', price: '0.2156', change1: '+11.45%', change2: '+6.8%', icon: 'https://cryptologos.cc/logos/dogecoin-doge-logo.png', category: 'crypto' },
        'ETHUSD': { name: 'Ethereum', pair: 'ETHUSD crypto', price: '2654.30', change1: '+3.89%', change2: '+0.9%', icon: 'https://cryptologos.cc/logos/ethereum-eth-logo.png', category: 'crypto' },
        'LTCUSD': { name: 'Litecoin', pair: 'LTCUSD crypto', price: '98.45', change1: '+2.67%', change2: '-0.5%', icon: 'https://cryptologos.cc/logos/litecoin-ltc-logo.png', category: 'crypto' },
        'DOTUSD': { name: 'Polkadot', pair: 'DOTUSD crypto', price: '4.56', change1: '+7.34%', change2: '+1.2%', icon: 'https://cryptologos.cc/logos/polkadot-new-dot-logo.png', category: 'crypto' },
        'MATICUSD': { name: 'Polygon', pair: 'MATICUSD crypto', price: '0.3245', change1: '+9.12%', change2: '+3.7%', icon: 'https://cryptologos.cc/logos/polygon-matic-logo.png', category: 'crypto' },
        'XRPUSD': { name: 'Ripple', pair: 'XRPUSD crypto', price: '2.34', change1: '+5.67%', change2: '+2.1%', icon: 'https://cryptologos.cc/logos/xrp-xrp-logo.png', category: 'crypto' },
        'SOLUSD': { name: 'Solana', pair: 'SOLUSD crypto', price: '178.90', change1: '+4.23%', change2: '+5.6%', icon: 'https://cryptologos.cc/logos/solana-sol-logo.png', category: 'crypto' },
        'XLMUSD': { name: 'Stellar', pair: 'XLMUSD crypto', price: '0.3456', change1: '+6.45%', change2: '-1.8%', icon: 'https://cryptologos.cc/logos/stellar-xlm-logo.png', category: 'crypto' },
        'AAPL': { name: 'Apple', pair: 'AAPL stock', price: '227.50', change1: '+1.23%', change2: '+0.8%', icon: 'https://logo.clearbit.com/apple.com', category: 'stock' },
        'MSFT': { name: 'Microsoft', pair: 'MSFT stock', price: '415.30', change1: '+0.89%', change2: '+1.2%', icon: 'https://logo.clearbit.com/microsoft.com', category: 'stock' },
        'TSLA': { name: 'Tesla', pair: 'TSLA stock', price: '345.20', change1: '+2.45%', change2: '-0.3%', icon: 'https://logo.clearbit.com/tesla.com', category: 'stock' },
        'NVDA': { name: 'NVIDIA', pair: 'NVDA stock', price: '890.10', change1: '+3.56%', change2: '+2.4%', icon: 'https://logo.clearbit.com/nvidia.com', category: 'stock' },
        'EURUSD': { name: 'EUR/USD', pair: 'EURUSD forex', price: '1.0845', change1: '+0.12%', change2: '-0.05%', icon: '', category: 'forex' },
        'GBPUSD': { name: 'GBP/USD', pair: 'GBPUSD forex', price: '1.2634', change1: '+0.34%', change2: '+0.15%', icon: '', category: 'forex' },
        'USDJPY': { name: 'USD/JPY', pair: 'USDJPY forex', price: '149.85', change1: '-0.23%', change2: '+0.45%', icon: '', category: 'forex' },
    };

    const symbol = '{{ $symbol }}';
    const asset = assetsData[symbol];

    if (asset) {
        // Set header
        const iconHtml = asset.icon
            ? `<img src="${asset.icon}?width=55" alt="${asset.name}" onerror="this.parentElement.innerHTML='<div style=\\'width:55px;height:55px;border-radius:50%;background:#04b3e1;display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:1.5rem\\'>${asset.name.charAt(0)}</div>'">`
            : `<div style="width:55px;height:55px;border-radius:50%;background:#04b3e1;display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:1.5rem">${asset.name.charAt(0)}</div>`;
        document.getElementById('assetIcon').innerHTML = iconHtml;
        document.getElementById('assetName').textContent = asset.name;
        document.getElementById('assetPair').textContent = asset.pair;
        document.getElementById('assetPrice').textContent = '$' + asset.price;

        const c1El = document.getElementById('assetChange1');
        const c2El = document.getElementById('assetChange2');
        c1El.textContent = asset.change1;
        c2El.textContent = asset.change2;
        c1El.className = 'asset-change-badge ' + (asset.change1.startsWith('+') ? 'positive' : 'negative');
        c2El.className = 'asset-change-badge ' + (asset.change2.startsWith('+') ? 'positive' : 'negative');

        // Stats
        const price = parseFloat(asset.price);
        document.getElementById('statMarketCap').textContent = '$' + (price * (Math.random() * 500 + 100)).toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ',') + 'M';
        document.getElementById('statVolume').textContent = '$' + (price * (Math.random() * 50 + 10)).toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ',') + 'M';
        document.getElementById('statHigh').textContent = '$' + (price * 1.05).toFixed(price < 1 ? 4 : 2);
        document.getElementById('statLow').textContent = '$' + (price * 0.95).toFixed(price < 1 ? 4 : 2);

        // Draw chart
        drawPriceChart(asset, '1M');
    }

    function changePeriod(period, btn) {
        document.querySelectorAll('.period-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        if (asset) drawPriceChart(asset, period);
    }

    function drawPriceChart(asset, period) {
        const canvas = document.getElementById('priceChart');
        const container = canvas.parentElement;
        canvas.width = container.offsetWidth * 2;
        canvas.height = container.offsetHeight * 2;
        canvas.style.width = container.offsetWidth + 'px';
        canvas.style.height = container.offsetHeight + 'px';
        const ctx = canvas.getContext('2d');
        const w = canvas.width;
        const h = canvas.height;
        ctx.clearRect(0, 0, w, h);

        const periodPoints = { '1D': 48, '1W': 84, '1M': 120, '3M': 180, '1Y': 365 };
        const numPoints = periodPoints[period] || 120;
        const basePrice = parseFloat(asset.price);
        const isPositive = asset.change1.startsWith('+');
        const volatility = basePrice * 0.08;

        // Seed from asset name
        let seed = 0;
        for (let i = 0; i < asset.name.length; i++) seed += asset.name.charCodeAt(i);
        seed += period.length * 13;
        function seededRandom() { seed = (seed * 9301 + 49297) % 233280; return seed / 233280; }

        const points = [];
        let price = basePrice - (isPositive ? volatility * 0.5 : -volatility * 0.3);
        for (let i = 0; i < numPoints; i++) {
            const trend = isPositive ? 0.006 : -0.004;
            price += (seededRandom() - 0.48 + trend) * volatility * 0.12;
            price = Math.max(price, basePrice * 0.7);
            price = Math.min(price, basePrice * 1.3);
            points.push(price);
        }
        points[points.length - 1] = basePrice;

        const minP = Math.min(...points);
        const maxP = Math.max(...points);
        const range = maxP - minP || 1;
        const padX = 20;
        const padY = 30;

        const lineColor = isPositive ? '#10b981' : '#ef4444';
        const fillTop = isPositive ? 'rgba(16,185,129,0.2)' : 'rgba(239,68,68,0.2)';
        const fillBot = isPositive ? 'rgba(16,185,129,0.01)' : 'rgba(239,68,68,0.01)';

        // Grid lines
        ctx.strokeStyle = 'rgba(128,128,128,0.1)';
        ctx.lineWidth = 1;
        for (let i = 0; i <= 4; i++) {
            const y = padY + (i / 4) * (h - padY * 2);
            ctx.beginPath();
            ctx.moveTo(padX, y);
            ctx.lineTo(w - padX, y);
            ctx.stroke();
        }

        // Area fill
        const grad = ctx.createLinearGradient(0, padY, 0, h - padY);
        grad.addColorStop(0, fillTop);
        grad.addColorStop(1, fillBot);

        ctx.beginPath();
        for (let i = 0; i < points.length; i++) {
            const x = padX + (i / (points.length - 1)) * (w - padX * 2);
            const y = padY + (1 - (points[i] - minP) / range) * (h - padY * 2);
            if (i === 0) ctx.moveTo(x, y);
            else ctx.lineTo(x, y);
        }
        ctx.lineTo(w - padX, h - padY);
        ctx.lineTo(padX, h - padY);
        ctx.closePath();
        ctx.fillStyle = grad;
        ctx.fill();

        // Line
        ctx.beginPath();
        for (let i = 0; i < points.length; i++) {
            const x = padX + (i / (points.length - 1)) * (w - padX * 2);
            const y = padY + (1 - (points[i] - minP) / range) * (h - padY * 2);
            if (i === 0) ctx.moveTo(x, y);
            else ctx.lineTo(x, y);
        }
        ctx.strokeStyle = lineColor;
        ctx.lineWidth = 3;
        ctx.lineJoin = 'round';
        ctx.stroke();

        // Endpoint dot
        const lastX = w - padX;
        const lastY = padY + (1 - (points[points.length - 1] - minP) / range) * (h - padY * 2);
        ctx.beginPath();
        ctx.arc(lastX, lastY, 8, 0, Math.PI * 2);
        ctx.fillStyle = lineColor;
        ctx.fill();
        ctx.beginPath();
        ctx.arc(lastX, lastY, 4, 0, Math.PI * 2);
        ctx.fillStyle = '#ffffff';
        ctx.fill();

        // Price labels
        ctx.fillStyle = 'rgba(128,128,128,0.6)';
        ctx.font = '20px sans-serif';
        ctx.textAlign = 'right';
        for (let i = 0; i <= 4; i++) {
            const val = maxP - (i / 4) * range;
            const y = padY + (i / 4) * (h - padY * 2);
            ctx.fillText(val.toFixed(basePrice < 1 ? 4 : 2), w - padX + 2, y - 5);
        }
    }
</script>

@include('user.layouts.footer')
