@include('admin.header')

<div class="main-content">
    <div class="container-fluid">
        @if(session('message'))
        <div class="alert alert-success alert-dismissible fade show">{{ session('message') }}<button type="button"
                class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="admin-page-title">Open Trade</h4>
                <p class="admin-page-subtitle">Create and manage trades for {{ $user->first_name }} {{ $user->last_name
                    }}</p>
            </div>
        </div>

        <!-- Trade Form -->
        <div class="admin-card mb-4">
            <form action="{{ route('admin.trades.store') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label" style="color:var(--heading-color);">Asset</label>
                        <select name="asset" class="admin-form-control" required>
                            @foreach($traders as $trader)
                            <option value="{{ $trader->trader_name }}">{{ $trader->trader_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" style="color:var(--heading-color);">Category</label>
                        <select name="category" id="category" class="admin-form-control" required>
                            <option value="stocks">Stocks</option>
                            <option value="crypto">Crypto</option>
                            <option value="currencies">Currencies</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" style="color:var(--heading-color);">Company</label>
                        <select name="company" id="company" class="admin-form-control" required></select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" style="color:var(--heading-color);">Amount</label>
                        <input type="number" name="amount" class="admin-form-control" value="1000" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" style="color:var(--heading-color);">Take Profit (Optional)</label>
                        <input type="number" name="take_profit" class="admin-form-control" value="7">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" style="color:var(--heading-color);">Stop Loss (Optional)</label>
                        <input type="number" name="stop_loss" class="admin-form-control" value="9">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-success px-4 me-2"><i
                                class="fas fa-arrow-up me-1"></i>BUY</button>
                        <button type="submit" class="btn btn-danger px-4"><i
                                class="fas fa-arrow-down me-1"></i>SELL</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Trades Table -->
        <div class="admin-card">
            <div class="admin-table">
                <div class="table-responsive">
                    <table id="ShipTable" class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Asset</th>
                                <th>Category</th>
                                <th>Company</th>
                                <th>Status</th>
                                <th>Amount</th>
                                <th>Take Profit</th>
                                <th>Stop Loss</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($trades as $trade)
                            <tr>
                                <td>{{ $trade->id }}</td>
                                <td style="color:var(--heading-color);font-weight:500;">{{ $trade->asset }}</td>
                                <td>{{ $trade->category }}</td>
                                <td>{{ $trade->company }}</td>
                                <td><span class="admin-badge-{{ $trade->status==='open' ? 'success' : 'danger' }}">{{
                                        ucfirst($trade->status) }}</span></td>
                                <td>${{ number_format($trade->amount, 2, '.', ',') }}</td>
                                <td>{{ $trade->take_profit ?? 'N/A' }}</td>
                                <td>{{ $trade->stop_loss ?? 'N/A' }}</td>
                                <td>{{ \Carbon\Carbon::parse($trade->created_at)->format('M j, Y g:i A') }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editTradeModal{{ $trade->id }}">Edit</button>
                                        <form action="{{ route('admin.trades.destroy', $trade->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <!-- Edit Trade Modal -->
                            <div class="modal fade" id="editTradeModal{{ $trade->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content"
                                        style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);">
                                        <div class="modal-header" style="border-color:var(--border-color);">
                                            <h5 class="modal-title" style="color:var(--heading-color);">Edit Trade</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="{{ route('admin.trades.update', $trade->id) }}" method="POST">
                                            @csrf @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label"
                                                        style="color:var(--heading-color);">Asset</label>
                                                    <input type="text" name="asset" class="admin-form-control"
                                                        value="{{ old('asset', $trade->asset) }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label"
                                                        style="color:var(--heading-color);">Category</label>
                                                    <input type="text" name="category" class="admin-form-control"
                                                        value="{{ old('category', $trade->category) }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label"
                                                        style="color:var(--heading-color);">Company</label>
                                                    <input type="text" name="company" class="admin-form-control"
                                                        value="{{ old('company', $trade->company) }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label"
                                                        style="color:var(--heading-color);">Amount</label>
                                                    <input type="number" name="amount" class="admin-form-control"
                                                        value="{{ old('amount', $trade->amount) }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" style="color:var(--heading-color);">Take
                                                        Profit</label>
                                                    <input type="number" name="take_profit" class="admin-form-control"
                                                        value="{{ old('take_profit', $trade->take_profit) }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" style="color:var(--heading-color);">Stop
                                                        Loss</label>
                                                    <input type="number" name="stop_loss" class="admin-form-control"
                                                        value="{{ old('stop_loss', $trade->stop_loss) }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label"
                                                        style="color:var(--heading-color);">Status</label>
                                                    <select name="status" class="admin-form-control" required>
                                                        <option value="open" {{ old('status', $trade->status)==='open' ?
                                                            'selected' : '' }}>Open</option>
                                                        <option value="close" {{ old('status', $trade->status)==='close'
                                                            ? 'selected' : '' }}>Close</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer" style="border-color:var(--border-color);">
                                                <button type="button" class="btn btn-outline-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-admin-primary">Save
                                                    Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.footer')

<script>
    const companies = {
    stocks: ['Amazon','Apple','Tesla','Microsoft','Google','Facebook','NVIDIA','Intel','Alibaba','Samsung','Sony','Toyota','Visa','Mastercard','JPMorgan Chase','Berkshire Hathaway','Walmart','Procter & Gamble','Coca-Cola','PepsiCo','Johnson & Johnson','Chevron','ExxonMobil','Pfizer','Meta Platforms','Disney','Netflix','Starbucks','Square','AMD','Nike','Zoom','PayPal','Salesforce','Shopify','Adidas','Boeing','Cisco','Oracle','IBM','Dell','Uber','Lyft'],
    crypto: ['Bitcoin','Ethereum','Ripple','Litecoin','Cardano','Polkadot','Dogecoin','Binance Coin','Tether','Solana','Avalanche','Tron','Stellar','Monero','Dash','Shiba Inu','Chainlink','Uniswap','Algorand','Cosmos','VeChain','Aave','EOS','Zcash','Tezos','SushiSwap','PancakeSwap','Filecoin','Decentraland','Axie Infinity','Sandbox','Theta','Polygon','Chiliz','Flow','Gala','Quant','Maker','Elrond','Hedera','Celo','Near Protocol'],
    currencies: ['AUD/CAD','AUD/USD','EUR/USD','GBP/USD','USD/JPY','USD/CHF','NZD/USD','EUR/GBP','EUR/JPY','GBP/JPY','CAD/JPY','AUD/NZD','USD/CNY','USD/INR','USD/SGD','EUR/AUD','GBP/AUD','USD/MXN','USD/BRL','EUR/CHF','USD/HKD','EUR/CAD','GBP/CAD','AUD/JPY','CHF/JPY','NZD/JPY','EUR/NZD','USD/ZAR','EUR/SEK','USD/NOK','GBP/NZD','EUR/DKK','USD/PLN','USD/RUB','EUR/PLN','USD/TRY','USD/THB','GBP/SEK','EUR/NOK','GBP/DKK','USD/ILS','EUR/HUF','GBP/ZAR','EUR/TRY','USD/KRW','USD/TWD']
};
document.getElementById('category').addEventListener('change', function(){
    const sel = document.getElementById('company');
    sel.innerHTML = '';
    if(companies[this.value]){
        companies[this.value].forEach(c => {
            const o = document.createElement('option');
            o.value = c.toLowerCase().replace(/\s+/g,'_');
            o.textContent = c;
            sel.appendChild(o);
        });
    }
});
document.getElementById('category').dispatchEvent(new Event('change'));
</script>