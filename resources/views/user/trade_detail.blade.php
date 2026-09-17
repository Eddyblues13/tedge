@include('user.layouts.header')

<style>
    .trade-detail-container {
        max-width: 600px;
        margin: 0 auto;
        padding: 0 12px;
    }

    .trade-detail-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 20px;
        border: 1px solid var(--border-color);
    }

    .trade-detail-row:nth-child(odd) {
        background-color: var(--card-bg);
    }

    .trade-detail-row:nth-child(even) {
        background-color: var(--input-bg);
    }

    .trade-detail-row:first-child {
        border-radius: 12px 12px 0 0;
    }

    .trade-detail-row:last-child {
        border-radius: 0 0 12px 12px;
    }

    .trade-detail-label {
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--text-color);
    }

    .trade-detail-value {
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--heading-color);
        text-align: right;
    }

    .trade-chart-container {
        margin-top: 16px;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid var(--border-color);
        background-color: var(--card-bg);
    }

    .trade-chart-symbol {
        font-size: 1.8rem;
        font-weight: 900;
        color: var(--heading-color);
        padding: 12px 20px 0;
    }
</style>

<div class="main-content" style="padding-bottom: 100px;">
    <div class="trade-detail-container mt-3">

        <!-- Trade Info Rows -->
        <div class="trade-detail-row">
            <span class="trade-detail-label">STATUS</span>
            <span class="trade-detail-value">{{ strtoupper($trade->status) }}</span>
        </div>

        <div class="trade-detail-row">
            <span class="trade-detail-label">PROFIT</span>
            <span class="trade-detail-value {{ $trade->profit >= 0 ? 'text-success' : 'text-danger' }}">
                {{ $trade->formattedProfit }}
            </span>
        </div>

        <div class="trade-detail-row">
            <span class="trade-detail-label">TYPE</span>
            <span class="trade-detail-value">{{ strtoupper($trade->direction ?? 'N/A') }}</span>
        </div>

        <div class="trade-detail-row">
            <span class="trade-detail-label">SYMBOL</span>
            <span class="trade-detail-value">{{ strtoupper($trade->symbol) }}</span>
        </div>

        <div class="trade-detail-row">
            <span class="trade-detail-label">OPENING PRICE</span>
            <span class="trade-detail-value">{{ $trade->formattedEntryPrice }}</span>
        </div>

        <div class="trade-detail-row">
            <span class="trade-detail-label">AMOUNT</span>
            <span class="trade-detail-value">{{ number_format($trade->amount, 4) }}</span>
        </div>

        <div class="trade-detail-row">
            <span class="trade-detail-label">LEVERAGE</span>
            <span class="trade-detail-value">{{ $trade->leverage ?? 25 }}</span>
        </div>

        <!-- Live Area Chart -->
        <div class="trade-chart-container" style="position: relative;">
            <div class="trade-chart-symbol d-flex justify-content-between align-items-center">
                <span>{{ strtoupper($trade->symbol) }}</span>
                <div class="d-flex align-items-center mt-1">
                    <div class="pulsing-dot me-2" style="width: 10px; height: 10px; background-color: #10b981; border-radius: 50%; animation: pulse-dot 1.5s infinite;"></div>
                    <span class="fw-bold" style="font-size: 0.8rem; letter-spacing: 0.5px; opacity: 0.8;">Live Activity</span>
                    <style>
                        @keyframes pulse-dot {
                            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
                            70% { transform: scale(1); box-shadow: 0 0 0 8px rgba(16, 185, 129, 0); }
                            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
                        }
                    </style>
                </div>
            </div>
            <div id="live-chart" style="height: 350px; margin-top: 10px;"></div>
        </div>
    </div>
</div>

@include('user.layouts.footer')

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const isDark = document.documentElement.classList.contains('dark');
        const symbol = '{{ strtoupper($trade->symbol) }}';
        
        let currentPriceRaw = '{{ $trade->entry_price ?? "100" }}';
        let currentPrice = parseFloat(currentPriceRaw.replace(/[^0-9.-]+/g,"")) || 100;

        let data = [];
        // Generate initial data points (250 points)
        for(let i = 0; i <= 250; i++) {
            let change = (Math.random() - 0.5) * (currentPrice * 0.0015); 
            currentPrice += change;
            data.push(currentPrice);
        }

        const chartOptions = {
            series: [{
                name: 'Price',
                data: data.slice()
            }],
            chart: {
                id: 'realtime',
                height: 350,
                type: 'area',
                animations: {
                    enabled: true,
                    easing: 'linear',
                    dynamicAnimation: {
                        speed: 200
                    }
                },
                toolbar: { show: false },
                zoom: { enabled: false },
                background: 'transparent'
            },
            dataLabels: { enabled: false },
            stroke: {
                curve: 'smooth',
                width: 2,
                colors: isDark ? ['#ffffff'] : ['#4338ca'] 
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.6,
                    opacityTo: 0.0,
                    stops: [0, 90, 100],
                    colorStops: isDark ? [
                        { offset: 0, color: '#ffffff', opacity: 0.6 },
                        { offset: 100, color: '#ffffff', opacity: 0 }
                    ] : [
                        { offset: 0, color: '#4338ca', opacity: 0.4 },
                        { offset: 100, color: '#4338ca', opacity: 0 }
                    ]
                }
            },
            markers: { size: 0 },
            xaxis: {
                type: 'numeric',
                range: 250,
                tickAmount: 5,
                labels: { 
                    style: { colors: '#8c98a4' },
                    formatter: function(val) { return Math.floor(val); }
                },
                axisBorder: { show: false },
                axisTicks: { show: false }
            },
            yaxis: {
                labels: {
                    style: { colors: '#8c98a4' },
                    formatter: function(val) { return val.toFixed(4); }
                }
            },
            legend: { show: false },
            grid: {
                borderColor: isDark ? '#2d3748' : '#e5e7eb',
                strokeDashArray: 3,
                xaxis: { lines: { show: true } },
                yaxis: { lines: { show: true } }
            }
        };

        var chart = new ApexCharts(document.querySelector("#live-chart"), chartOptions);
        chart.render();

        // Update the chart every 1 second
        window.setInterval(function () {
            let change = (Math.random() - 0.5) * (currentPrice * 0.0015);
            currentPrice += change;
            
            data.shift(); // remove first
            data.push(currentPrice); // add at end
            
            chart.updateSeries([{ data: data }]);
        }, 200);

        // Listen for theme changes to update chart colors
        document.addEventListener('themeChanged', function () {
            const nowDark = document.documentElement.classList.contains('dark');
            chart.updateOptions({
                stroke: {
                    colors: nowDark ? ['#ffffff'] : ['#4338ca']
                },
                fill: {
                    gradient: {
                        colorStops: nowDark ? [
                            { offset: 0, color: '#ffffff', opacity: 0.6 },
                            { offset: 100, color: '#ffffff', opacity: 0 }
                        ] : [
                            { offset: 0, color: '#4338ca', opacity: 0.4 },
                            { offset: 100, color: '#4338ca', opacity: 0 }
                        ]
                    }
                },
                grid: {
                    borderColor: nowDark ? '#2d3748' : '#e5e7eb'
                }
            });
        });
    });
</script>