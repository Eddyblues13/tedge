@include('admin.header')

<div class="main-content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="admin-page-title">Edit Withdrawal</h4>
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
                        <form id="editWithdrawalForm" method="POST"
                            action="{{ route('admin.users.withdrawals.update', [$user->id, $withdrawal->id]) }}">
                            @csrf
                            @method('PUT')

                            <div id="formErrors" class="alert alert-danger d-none"></div>

                            <div class="mb-3">
                                <label class="form-label" style="color:var(--heading-color);">Amount</label>
                                <input type="number" step="0.00000001" name="amount" class="admin-form-control"
                                    value="{{ $withdrawal->amount }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" style="color:var(--heading-color);">Account Type</label>
                                <select name="account_type" id="accountType" class="admin-form-control" required>
                                    <option value="bank" {{ $withdrawal->account_type == 'bank' ? 'selected' : ''
                                        }}>Bank</option>
                                    <option value="crypto" {{ $withdrawal->account_type == 'crypto' ? 'selected' : ''
                                        }}>Crypto</option>
                                </select>
                            </div>

                            <div class="mb-3" id="cryptoCurrencyGroup"
                                style="{{ $withdrawal->account_type != 'crypto' ? 'display:none;' : '' }}">
                                <label class="form-label" style="color:var(--heading-color);">Crypto Currency</label>
                                <select name="crypto_currency" class="admin-form-control">
                                    <option value="btc" {{ $withdrawal->crypto_currency == 'btc' ? 'selected' : ''
                                        }}>Bitcoin (BTC)</option>
                                    <option value="eth" {{ $withdrawal->crypto_currency == 'eth' ? 'selected' : ''
                                        }}>Ethereum (ETH)</option>
                                    <option value="usdt" {{ $withdrawal->crypto_currency == 'usdt' ? 'selected' : ''
                                        }}>Tether (USDT)</option>
                                </select>
                            </div>

                            <div class="mb-3" id="walletAddressGroup"
                                style="{{ $withdrawal->account_type != 'crypto' ? 'display:none;' : '' }}">
                                <label class="form-label" style="color:var(--heading-color);">Wallet Address</label>
                                <input type="text" name="wallet_address" class="admin-form-control"
                                    value="{{ $withdrawal->wallet_address }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" style="color:var(--heading-color);">Status</label>
                                <select name="status" class="admin-form-control" required>
                                    <option value="pending" {{ $withdrawal->status == 'pending' ? 'selected' : ''
                                        }}>Pending</option>
                                    <option value="approved" {{ $withdrawal->status == 'approved' ? 'selected' : ''
                                        }}>Approved</option>
                                    <option value="rejected" {{ $withdrawal->status == 'rejected' ? 'selected' : ''
                                        }}>Rejected</option>
                                </select>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-admin-primary">Update Withdrawal</button>
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

    $('#editWithdrawalForm').submit(function(e) {
        e.preventDefault();
        const form = $(this);
        const submitBtn = form.find('[type="submit"]');
        const errorContainer = $('#formErrors');
        errorContainer.addClass('d-none').empty();
        submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Updating...');
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
                submitBtn.prop('disabled', false).html('Update Withdrawal');
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