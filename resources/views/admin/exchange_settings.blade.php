@include('admin.header')

<div class="main-content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="admin-page-title">Crypto Assets/Exchange Settings</h4>
                <p class="admin-page-subtitle">Configure exchange fees and manage crypto assets</p>
            </div>
        </div>

        <div class="admin-card">
            <div class="row">
                <div class="col-12 mb-4">
                    <label class="form-label" style="color:var(--heading-color);">Use This Feature</label>
                    <div class="d-flex gap-2">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="crypto" id="cryptoyes" value="true"
                                checked>
                            <label class="form-check-label" for="cryptoyes" style="color:var(--text-color);">On</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="crypto" id="cryptono" value="false">
                            <label class="form-check-label" for="cryptono" style="color:var(--text-color);">Off</label>
                        </div>
                    </div>
                    <small style="color:var(--text-color);opacity:0.7;">Users won't be able to see/use this service if
                        turned off</small>
                </div>

                <div class="col-md-6 offset-md-3 mb-4">
                    <form action="account/admin/dashboard/exchangefee" method="post">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" style="color:var(--heading-color);">Exchange Fee</label>
                            <input type="text" name="fee" value="2" class="admin-form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color:var(--heading-color);">ZAR/USD Rate</label>
                            <input type="number" name="rate" value="500" step=".0" class="admin-form-control"
                                placeholder="450">
                            <small style="color:var(--text-color);opacity:0.7;">This rate will be used to calculate
                                crypto equivalent in your chosen currency.</small>
                        </div>
                        <button type="submit" class="btn btn-admin-primary"><i class="fas fa-save me-1"></i>
                            Save</button>
                    </form>
                </div>

                <div class="col-12">
                    <div class="table-responsive">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Asset Name</th>
                                    <th>Asset Symbol</th>
                                    <th>Status</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $assets = [
                                ['Bitcoin','BTC','btc'],['Ethereum','ETH','eth'],['Litecoin','LTC','ltc'],
                                ['Chainlink','LINK','link'],['Binance Coin','BNB','bnb'],['Aave','AAVE','aave'],
                                ['Tether','USDT','usdt'],['Bitcoin Cash','BCH','bch'],['Ripple','XRP','xrp'],
                                ['Stellar','XLM','xlm'],['Ada','ADA','ada']
                                ];
                                @endphp
                                @foreach($assets as $asset)
                                <tr>
                                    <td>{{ $asset[0] }}</td>
                                    <td>{{ $asset[1] }}</td>
                                    <td><span class="admin-badge-success">enabled</span></td>
                                    <td>
                                        <a href="account/admin/dashboard/setcryptostatus/{{ $asset[2] }}/disabled"
                                            class="btn btn-sm btn-danger">Disable</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <small style="color:var(--text-color);opacity:0.7;">Be sure that none of your users have balances
                        greater than 0 in their asset account before you disable the asset.</small>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.footer')