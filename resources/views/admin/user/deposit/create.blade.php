@include('admin.header')

<style>
    .create-deposit-page {
        max-width: 700px;
        margin: 0 auto;
    }

    .create-deposit-card {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        overflow: hidden;
    }

    .create-deposit-hero {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.08), rgba(16, 185, 129, 0.04));
        padding: 28px 28px 20px;
        border-bottom: 1px solid var(--border-color);
    }

    .create-deposit-hero h5 {
        margin: 0;
        color: var(--heading-color);
        font-weight: 700;
        font-size: 1.15rem;
    }

    .create-deposit-hero p {
        margin: 4px 0 0;
        color: var(--text-color);
        opacity: 0.6;
        font-size: 0.85rem;
    }

    .create-deposit-body {
        padding: 28px;
    }

    .field-group {
        margin-bottom: 20px;
    }

    .field-group label {
        display: block;
        color: var(--heading-color);
        font-weight: 500;
        font-size: 0.85rem;
        margin-bottom: 8px;
    }

    .field-group label i {
        width: 16px;
        text-align: center;
        margin-right: 6px;
        opacity: 0.7;
    }

    .field-group .admin-form-control {
        border-radius: 10px !important;
        padding: 10px 14px;
    }

    .field-group small.text-danger {
        display: block;
        margin-top: 4px;
        font-size: 0.75rem;
    }

    .create-form-footer {
        padding: 20px 28px;
        border-top: 1px solid var(--border-color);
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }
</style>

<div class="main-content">
    <div class="container-fluid">
        <div class="create-deposit-page">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="admin-page-title mb-1"><i class="fas fa-plus-circle me-2" style="color:#3b82f6;"></i>New
                        Deposit</h4>
                    <p class="admin-page-subtitle mb-0">For <strong style="color:var(--heading-color);">{{
                            $user->first_name }} {{ $user->last_name }}</strong></p>
                </div>
                <a href="{{ route('admin.users.deposits.index', $user->id) }}" class="btn btn-sm"
                    style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);border-radius:10px;">
                    <i class="fas fa-arrow-left me-1"></i> Back to Deposits
                </a>
            </div>

            <div class="create-deposit-card">
                <div class="create-deposit-hero">
                    <h5><i class="fas fa-arrow-down me-2" style="color:#3b82f6;"></i>Deposit Details</h5>
                    <p>Fill in the deposit information below</p>
                </div>

                <form id="createDepositForm" method="POST"
                    action="{{ route('admin.users.deposits.store', $user->id) }}">
                    @csrf

                    <div class="create-deposit-body">
                        <div id="formErrors" class="alert alert-danger d-none mb-4" style="border-radius:10px;"></div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="field-group mb-0">
                                    <label><i class="fas fa-dollar-sign"></i> Amount</label>
                                    <input type="number" step="0.01" name="amount" class="admin-form-control"
                                        placeholder="0.00" required>
                                    <small id="err-amount" class="text-danger"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="field-group mb-0">
                                    <label><i class="fas fa-wallet"></i> Account Type</label>
                                    <select name="account_type" class="admin-form-control" required>
                                        <option value="">Select Account Type</option>
                                        <option value="holding">Holding Account</option>
                                        <option value="trading">Trading Account</option>
                                        <option value="mining">Mining Account</option>
                                        <option value="staking">Staking Account</option>
                                    </select>
                                    <small id="err-account_type" class="text-danger"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="field-group mb-0">
                                    <label><i class="fas fa-flag"></i> Status</label>
                                    <select name="status" class="admin-form-control" required>
                                        <option value="pending">Pending</option>
                                        <option value="approved">Approved</option>
                                        <option value="rejected">Rejected</option>
                                    </select>
                                    <small id="err-status" class="text-danger"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="field-group mb-0">
                                    <label><i class="fas fa-credit-card"></i> Payment Method <small
                                            style="opacity:0.4;">(optional)</small></label>
                                    <input type="text" name="payment_method" class="admin-form-control"
                                        placeholder="e.g. Bitcoin, Bank Transfer...">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="field-group mb-0">
                                    <label><i class="fas fa-coins"></i> Crypto Amount <small
                                            style="opacity:0.4;">(optional)</small></label>
                                    <input type="text" name="crypto_amount" class="admin-form-control"
                                        placeholder="e.g. 0.0034 BTC">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="create-form-footer">
                        <a href="{{ route('admin.users.deposits.index', $user->id) }}" class="btn"
                            style="background:transparent;color:var(--text-color);border:1px solid var(--border-color);border-radius:10px;padding:10px 24px;">Cancel</a>
                        <button type="submit" class="btn btn-admin-primary" id="submitBtn"
                            style="border-radius:10px;padding:10px 28px;">
                            <i class="fas fa-plus-circle me-1"></i> Create Deposit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@include('admin.footer')

<script>
    $(document).ready(function() {
    $('#createDepositForm').submit(function(e) {
        e.preventDefault();
        const form = $(this);
        const errorContainer = $('#formErrors');
        $('[id^="err-"]').text('');
        errorContainer.addClass('d-none').empty();
        $('#submitBtn').prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span> Creating...');
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            success: function(response) {
                toastr.success(response.message || 'Deposit created!');
                setTimeout(() => { window.location.href = response.redirect; }, 1500);
            },
            error: function(xhr) {
                $('#submitBtn').prop('disabled', false).html('<i class="fas fa-plus-circle me-1"></i> Create Deposit');
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, msgs) { $(`#err-${key}`).text(msgs[0]); });
                    toastr.error('Please fix the form errors');
                } else {
                    toastr.error(xhr.responseJSON?.message || 'An error occurred');
                }
            }
        });
    });
});
</script>