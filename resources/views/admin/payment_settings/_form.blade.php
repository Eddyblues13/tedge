<div class="col-md-12">
    <label class="form-label" style="color:var(--heading-color);">Name</label>
    <input type="text" class="admin-form-control" name="name" value="{{ old('name', $payment->name ?? '') }}" required>
</div>
<div class="col-md-6">
    <label class="form-label" style="color:var(--heading-color);">Minimum Amount</label>
    <input type="number" class="admin-form-control" name="min_amount"
        value="{{ old('min_amount', $payment->min_amount ?? '') }}" required>
</div>
<div class="col-md-6">
    <label class="form-label" style="color:var(--heading-color);">Maximum Amount</label>
    <input type="number" class="admin-form-control" name="max_amount"
        value="{{ old('max_amount', $payment->max_amount ?? '') }}" required>
</div>
<div class="col-md-6">
    <label class="form-label" style="color:var(--heading-color);">Charges</label>
    <input type="number" class="admin-form-control" name="charges" value="{{ old('charges', $payment->charges ?? '') }}"
        required>
</div>
<div class="col-md-6">
    <label class="form-label" style="color:var(--heading-color);">Charges Type</label>
    <select name="charge_type" class="admin-form-control">
        <option value="percentage" {{ (old('charge_type', $payment->charge_type ?? '') == 'percentage') ? 'selected' :
            '' }}>Percentage(%)</option>
        <option value="fixed" {{ (old('charge_type', $payment->charge_type ?? '') == 'fixed') ? 'selected' : ''
            }}>Fixed($)</option>
    </select>
</div>
<div class="col-md-6">
    <label class="form-label" style="color:var(--heading-color);">Type</label>
    <select name="type" class="admin-form-control" required>
        <option value="currency" {{ (old('type', $payment->type ?? '') == 'currency') ? 'selected' : '' }}>Currency
        </option>
        <option value="crypto" {{ (old('type', $payment->type ?? '') == 'crypto') ? 'selected' : '' }}>Crypto</option>
    </select>
</div>
<div class="col-md-6">
    <label class="form-label" style="color:var(--heading-color);">Status</label>
    <select name="status" class="admin-form-control" required>
        <option value="enabled" {{ (old('status', $payment->status ?? '') == 'enabled') ? 'selected' : '' }}>Enabled
        </option>
        <option value="disabled" {{ (old('status', $payment->status ?? '') == 'disabled') ? 'selected' : '' }}>Disabled
        </option>
    </select>
</div>
<div class="col-md-6">
    <label class="form-label" style="color:var(--heading-color);">Type For</label>
    <select name="type_for" class="admin-form-control" required>
        <option value="withdrawal" {{ (old('type_for', $payment->type_for ?? '') == 'withdrawal') ? 'selected' : ''
            }}>Withdrawal</option>
        <option value="deposit" {{ (old('type_for', $payment->type_for ?? '') == 'deposit') ? 'selected' : '' }}>Deposit
        </option>
        <option value="both" {{ (old('type_for', $payment->type_for ?? '') == 'both') ? 'selected' : '' }}>Both</option>
    </select>
</div>
<div class="col-md-12">
    <label class="form-label" style="color:var(--heading-color);">Optional Note</label>
    <input type="text" class="admin-form-control" name="note" value="{{ old('note', $payment->note ?? '') }}">
</div>