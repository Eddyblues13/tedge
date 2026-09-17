@include('admin.header')

<div class="main-content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="admin-page-title">Create Withdrawal</h4>
                <p class="admin-page-subtitle">For {{ $user->name }}</p>
            </div>
            <a href="{{ route('admin.users.withdrawals.index', $user->id) }}" class="btn btn-sm"
                style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);">
                <i class="fas fa-arrow-left me-1"></i> Back
            </a>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="admin-card">
                    <div class="card-body">
                        <form id="createWithdrawalForm" method="POST"
                            action="{{ route('admin.users.withdrawals.store', $user->id) }}">
                            @csrf

                            <div id="formErrors" class="alert alert-danger d-none"></div>

                            <div class="mb-3">
                                <label class="form-label" style="color:var(--heading-color);">Amount</label>
                                <input type="number" step="0.00000001" name="amount" class="admin-form-control"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" style="color:var(--heading-color);">Account Type</label>
                                <select name="account_type" id="accountType" class="admin-form-control" required>
                                    <option value="">Select Account Type</option>
                                    <option value="bank">Bank</option>
                                    <option value="crypto">Crypto</option>
                                </select>
                            </div>

                            <div class="mb-3" id="cryptoCurrencyGroup" style="display:none;">
                                <label class="form-label" style="color:var(--heading-color);">Crypto Currency</label>
                                <select name="crypto_currency" class="admin-form-control">
                                    <option value="">Select Currency</option>
                                    <option value="btc">Bitcoin (BTC)</option>
                                    <option value="eth">Ethereum (ETH)</option>
                                    <option value="usdt">Tether (USDT)</option>
                                </select>
                            </div>

                            <div class="mb-3" id="walletAddressGroup" style="display:none;">
                                <label class="form-label" style="color:var(--heading-color);">Wallet Address</label>
                                <input type="text" name="wallet_address" class="admin-form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" style="color:var(--heading-color);">Status</label>
                                <select name="status" class="admin-form-control" required>
                                    <option value="pending">Pending</option>
                                    <option value="approved">Approved</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-admin-primary">Create Withdrawal</button>
                                <a href="{{ route('admin.users.withdrawals.index', $user->id) }}" class="btn"
                                    style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.footer')

<script>
    $(document).ready(function() {
    // Show/hide crypto fields
    $('#accountType').change(function() {
        if ($(this).val() === 'crypto') {
            $('#cryptoCurrencyGroup, #walletAddressGroup').show();
            $('[name="crypto_currency"], [name="wallet_address"]').prop('required', true);
        } else {
            $('#cryptoCurrencyGroup, #walletAddressGroup').hide();
            $('[name="crypto_currency"], [name="wallet_address"]').prop('required', false);
        }
    });

    $('#createWithdrawalForm').submit(function(e) {
        e.preventDefault();
        const form = $(this);
        const submitBtn = form.find('[type="submit"]');
        const errorContainer = $('#formErrors');
        errorContainer.addClass('d-none').empty();
        submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Creating...');
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            success: function(response) {
                if(response.status === 'success') {
                    toastr.success(response.message);
                    setTimeout(() => { window.location.href = response.redirect; }, 1500);
                }
            },
            error: function(xhr) {
                submitBtn.prop('disabled', false).html('Create Withdrawal');
                if(xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    let errorHtml = '<ul class="mb-0">';
                    $.each(errors, function(key, value) { errorHtml += '<li>' + value[0] + '</li>'; });
                    errorHtml += '</ul>';
                    errorContainer.html(errorHtml).removeClass('d-none');
                } else {
                    toastr.error(xhr.responseJSON?.message || 'An error occurred');
                }
            }
        });
    });
});
</script>