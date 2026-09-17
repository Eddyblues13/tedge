@include('admin.header')

<div class="main-content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="admin-page-title">Edit Payment Method</h4>
                <p class="admin-page-subtitle">Update {{ $payment->wallet_name }} details</p>
            </div>
            <a href="{{ route('payment.index') }}" class="btn btn-outline-secondary"><i
                    class="fas fa-arrow-left me-1"></i> Back</a>
        </div>

        <div class="admin-card">
            <form action="{{ route('payment.update', $payment->id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Coin Code</label>
                        <input type="text" name="coin_code" class="admin-form-control"
                            value="{{ old('coin_code', $payment->coin_code) }}" required>
                        @error('coin_code')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Coin Name</label>
                        <input type="text" name="coin_name" class="admin-form-control"
                            value="{{ old('coin_name', $payment->coin_name) }}" required>
                        @error('coin_name')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Wallet Name</label>
                        <input type="text" name="wallet_name" class="admin-form-control"
                            value="{{ old('wallet_name', $payment->wallet_name) }}" required>
                        @error('wallet_name')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Wallet Type</label>
                        <select name="wallet_type" class="admin-form-control" required>
                            <option value="">Select type</option>
                            <option value="crypto" {{ old('wallet_type', $payment->wallet_type) === 'crypto' ?
                                'selected' : '' }}>Crypto</option>
                            <option value="fiat" {{ old('wallet_type', $payment->wallet_type) === 'fiat' ? 'selected' :
                                '' }}>Fiat</option>
                        </select>
                        @error('wallet_type')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Network Type</label>
                        <input type="text" name="network_type" class="admin-form-control"
                            value="{{ old('network_type', $payment->network_type) }}">
                        @error('network_type')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Status</label>
                        <select name="status" class="admin-form-control" required>
                            <option value="enabled" {{ old('status', $payment->status) === 'enabled' ? 'selected' : ''
                                }}>Enabled</option>
                            <option value="disabled" {{ old('status', $payment->status) === 'disabled' ? 'selected' : ''
                                }}>Disabled</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label" style="color:var(--heading-color);">Wallet Address</label>
                        <input type="text" name="wallet_address" class="admin-form-control"
                            value="{{ old('wallet_address', $payment->wallet_address) }}" required>
                        @error('wallet_address')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Icon</label>
                        @if($payment->icon)
                        <div class="mb-2 d-flex align-items-center gap-2">
                            <img src="{{ asset('storage/' . $payment->icon) }}" alt="current icon" style="height:32px;">
                            <label class="form-check-label" style="color:var(--text-color);">
                                <input type="checkbox" name="remove_icon" value="1" class="form-check-input"> Remove
                                current icon
                            </label>
                        </div>
                        @endif
                        <input type="file" name="icon" class="admin-form-control" accept="image/*">
                        @error('icon')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-admin-primary"><i class="fas fa-save me-1"></i> Update
                            Payment Method</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@include('admin.footer')