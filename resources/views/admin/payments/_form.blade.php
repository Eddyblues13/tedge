<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" style="color:var(--heading-color);">Name</label>
        <input type="text" name="name" class="admin-form-control" value="{{ old('name', $paymentSetting->name ?? '') }}"
            required>
        @error('name')<small class="text-danger">{{ $message }}</small>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label" style="color:var(--heading-color);">Type</label>
        <select name="type" class="admin-form-control" required>
            <option value="">Select type</option>
            <option value="currency" {{ old('type', $paymentSetting->type ?? '') === 'currency' ? 'selected' : ''
                }}>Currency</option>
            <option value="crypto" {{ old('type', $paymentSetting->type ?? '') === 'crypto' ? 'selected' : '' }}>Crypto
            </option>
        </select>
        @error('type')<small class="text-danger">{{ $message }}</small>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label" style="color:var(--heading-color);">Min Amount</label>
        <input type="number" name="min_amount" class="admin-form-control" step="0.01"
            value="{{ old('min_amount', $paymentSetting->min_amount ?? '') }}">
        @error('min_amount')<small class="text-danger">{{ $message }}</small>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label" style="color:var(--heading-color);">Max Amount</label>
        <input type="number" name="max_amount" class="admin-form-control" step="0.01"
            value="{{ old('max_amount', $paymentSetting->max_amount ?? '') }}">
        @error('max_amount')<small class="text-danger">{{ $message }}</small>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label" style="color:var(--heading-color);">Charges</label>
        <input type="number" name="charges" class="admin-form-control" step="0.01"
            value="{{ old('charges', $paymentSetting->charges ?? '') }}">
        @error('charges')<small class="text-danger">{{ $message }}</small>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label" style="color:var(--heading-color);">Charge Type</label>
        <select name="charge_type" class="admin-form-control">
            <option value="percentage" {{ old('charge_type', $paymentSetting->charge_type ?? '') === 'percentage' ?
                'selected' : '' }}>Percentage</option>
            <option value="fixed" {{ old('charge_type', $paymentSetting->charge_type ?? '') === 'fixed' ? 'selected' :
                '' }}>Fixed</option>
        </select>
        @error('charge_type')<small class="text-danger">{{ $message }}</small>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label" style="color:var(--heading-color);">Status</label>
        <select name="status" class="admin-form-control" required>
            <option value="enabled" {{ old('status', $paymentSetting->status ?? 'enabled') === 'enabled' ? 'selected' :
                '' }}>Enabled</option>
            <option value="disabled" {{ old('status', $paymentSetting->status ?? '') === 'disabled' ? 'selected' : ''
                }}>Disabled</option>
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label" style="color:var(--heading-color);">Used For</label>
        <select name="type_for" class="admin-form-control" required>
            <option value="both" {{ old('type_for', $paymentSetting->type_for ?? 'both') === 'both' ? 'selected' : ''
                }}>Both</option>
            <option value="withdrawal" {{ old('type_for', $paymentSetting->type_for ?? '') === 'withdrawal' ? 'selected'
                : '' }}>Withdrawal</option>
            <option value="deposit" {{ old('type_for', $paymentSetting->type_for ?? '') === 'deposit' ? 'selected' : ''
                }}>Deposit</option>
        </select>
        @error('type_for')<small class="text-danger">{{ $message }}</small>@enderror
    </div>
    <div class="col-12">
        <label class="form-label" style="color:var(--heading-color);">Note</label>
        <textarea name="note" class="admin-form-control"
            rows="3">{{ old('note', $paymentSetting->note ?? '') }}</textarea>
        @error('note')<small class="text-danger">{{ $message }}</small>@enderror
    </div>
</div>