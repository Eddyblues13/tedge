@include('admin.header')

<div class="main-content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="admin-page-title">Add Payment Method</h4>
                <p class="admin-page-subtitle">Create a new cryptocurrency payment option</p>
            </div>
            <a href="{{ route('payment.index') }}" class="btn btn-outline-secondary"><i
                    class="fas fa-arrow-left me-1"></i> Back</a>
        </div>

        <div class="admin-card">
            <form action="{{ route('payment.store') }}" method="POST" enctype="multipart/form-data" id="paymentForm">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Coin Code</label>
                        <input type="text" name="coin_code" class="admin-form-control" placeholder="e.g. BTC"
                            value="{{ old('coin_code') }}" required>
                        @error('coin_code')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Coin Name</label>
                        <input type="text" name="coin_name" class="admin-form-control" placeholder="e.g. Bitcoin"
                            value="{{ old('coin_name') }}" required>
                        @error('coin_name')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Wallet Name</label>
                        <input type="text" name="wallet_name" class="admin-form-control" placeholder="e.g. Bitcoin"
                            value="{{ old('wallet_name') }}" required>
                        @error('wallet_name')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Wallet Type</label>
                        <select name="wallet_type" class="admin-form-control" required>
                            <option value="">Select type</option>
                            <option value="crypto" {{ old('wallet_type')==='crypto' ? 'selected' : '' }}>Crypto</option>
                            <option value="fiat" {{ old('wallet_type')==='fiat' ? 'selected' : '' }}>Fiat</option>
                        </select>
                        @error('wallet_type')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Network Type</label>
                        <input type="text" name="network_type" class="admin-form-control"
                            placeholder="e.g. ERC-20, BEP-20" value="{{ old('network_type') }}">
                        @error('network_type')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Status</label>
                        <select name="status" class="admin-form-control" required>
                            <option value="enabled" {{ old('status','enabled')==='enabled' ? 'selected' : '' }}>Enabled
                            </option>
                            <option value="disabled" {{ old('status')==='disabled' ? 'selected' : '' }}>Disabled
                            </option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label" style="color:var(--heading-color);">Wallet Address</label>
                        <input type="text" name="wallet_address" class="admin-form-control"
                            placeholder="Enter wallet address" value="{{ old('wallet_address') }}" required>
                        @error('wallet_address')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Icon</label>
                        <input type="file" name="icon" class="admin-form-control" accept="image/*">
                        @error('icon')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-admin-primary"><i class="fas fa-save me-1"></i> Save
                            Payment Method</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@include('admin.footer')