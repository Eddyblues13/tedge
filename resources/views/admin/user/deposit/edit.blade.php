@include('admin.header')

<style>
    .edit-deposit-page {
        max-width: 700px;
        margin: 0 auto;
    }

    .edit-deposit-card {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        overflow: hidden;
    }

    .edit-deposit-hero {
        background: linear-gradient(135deg, rgba(99, 91, 255, 0.08), rgba(59, 130, 246, 0.04));
        padding: 28px 28px 20px;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
    }

    .edit-deposit-hero h5 {
        margin: 0;
        color: var(--heading-color);
        font-weight: 700;
        font-size: 1.15rem;
    }

    .edit-deposit-hero p {
        margin: 4px 0 0;
        color: var(--text-color);
        opacity: 0.6;
        font-size: 0.85rem;
    }

    .edit-deposit-body {
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

    .deposit-info-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.75rem;
        padding: 4px 12px;
        border-radius: 20px;
        font-weight: 600;
    }

    .deposit-info-pill.status-approved {
        background: rgba(16, 185, 129, 0.12);
        color: #10b981;
    }

    .deposit-info-pill.status-pending {
        background: rgba(245, 158, 11, 0.12);
        color: #f59e0b;
    }

    .deposit-info-pill.status-rejected {
        background: rgba(239, 68, 68, 0.12);
        color: #ef4444;
    }

    .edit-form-footer {
        padding: 20px 28px;
        border-top: 1px solid var(--border-color);
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }
</style>

<div class="main-content">
    <div class="container-fluid">
        <div class="edit-deposit-page">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="admin-page-title mb-1"><i class="fas fa-pen me-2"
                            style="color:var(--accent-color);"></i>Edit Deposit</h4>
                    <p class="admin-page-subtitle mb-0">For <strong style="color:var(--heading-color);">{{
                            $user->first_name }} {{ $user->last_name }}</strong></p>
                </div>
                <a href="{{ route('admin.users.deposits.index', $user->id) }}" class="btn btn-sm"
                    style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);border-radius:10px;">
                    <i class="fas fa-arrow-left me-1"></i> Back to Deposits
                </a>
            </div>

            <div class="edit-deposit-card">
                <div class="edit-deposit-hero">
                    <div>
                        <h5>${{ number_format($deposit->amount, 2) }}</h5>
                        <p>Deposit #{{ $deposit->id }} · {{ $deposit->created_at->format('M j, Y · g:i A') }}</p>
                    </div>
                    <span class="deposit-info-pill status-{{ $deposit->status }}">
                        <i
                            class="fas fa-{{ $deposit->status === 'approved' ? 'check-circle' : ($deposit->status === 'pending' ? 'clock' : 'times-circle') }}"></i>
                        {{ ucfirst($deposit->status) }}
                    </span>
                </div>

                <form id="editDepositForm" method="POST"
                    action="{{ route('admin.users.deposits.update', [$user->id, $deposit->id]) }}">
                    @csrf
                    @method('PUT')

                    <div class="edit-deposit-body">
                        <div id="formErrors" class="alert alert-danger d-none mb-4" style="border-radius:10px;"></div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="field-group mb-0">
                                    <label><i class="fas fa-dollar-sign"></i> Amount</label>
                                    <input type="number" step="0.01" name="amount" class="admin-form-control"
                                        value="{{ $deposit->amount }}" required>
                                    <small id="err-amount" class="text-danger"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="field-group mb-0">
                                    <label><i class="fas fa-wallet"></i> Account Type</label>
                                    <select name="account_type" class="admin-form-control" required>
                                        <option value="holding" {{ $deposit->account_type == 'holding' ? 'selected' : ''
                                            }}>Holding Account</option>
                                        <option value="trading" {{ $deposit->account_type == 'trading' ? 'selected' : ''
                                            }}>Trading Account</option>
                                        <option value="mining" {{ $deposit->account_type == 'mining' ? 'selected' : ''
                                            }}>Mining Account</option>
                                        <option value="staking" {{ $deposit->account_type == 'staking' ? 'selected' : ''
                                            }}>Staking Account</option>
                                    </select>
                                    <small id="err-account_type" class="text-danger"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="field-group mb-0">
                                    <label><i class="fas fa-flag"></i> Status</label>
                                    <select name="status" class="admin-form-control" required>
                                        <option value="pending" {{ $deposit->status == 'pending' ? 'selected' : ''
                                            }}>Pending</option>
                                        <option value="approved" {{ $deposit->status == 'approved' ? 'selected' : ''
                                            }}>Approved</option>
                                        <option value="rejected" {{ $deposit->status == 'rejected' ? 'selected' : ''
                                            }}>Rejected</option>
                                    </select>
                                    <small id="err-status" class="text-danger"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="field-group mb-0">
                                    <label><i class="fas fa-credit-card"></i> Payment Method <small
                                            style="opacity:0.4;">(optional)</small></label>
                                    <input type="text" name="payment_method" class="admin-form-control"
                                        value="{{ $deposit->payment_method }}"
                                        placeholder="e.g. Bitcoin, Bank Transfer...">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="field-group mb-0">
                                    <label><i class="fas fa-coins"></i> Crypto Amount <small
                                            style="opacity:0.4;">(optional)</small></label>
                                    <input type="text" name="crypto_amount" class="admin-form-control"
                                        value="{{ $deposit->crypto_amount }}" placeholder="e.g. 0.0034 BTC">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="edit-form-footer">
                        <a href="{{ route('admin.users.deposits.index', $user->id) }}" class="btn"
                            style="background:transparent;color:var(--text-color);border:1px solid var(--border-color);border-radius:10px;padding:10px 24px;">Cancel</a>
                        <button type="submit" class="btn btn-admin-primary" id="submitBtn"
                            style="border-radius:10px;padding:10px 28px;">
                            <i class="fas fa-save me-1"></i> Update Deposit
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
    $('#editDepositForm').submit(function(e) {
        e.preventDefault();
        const form = $(this);
        const errorContainer = $('#formErrors');
        $('[id^="err-"]').text('');
        errorContainer.addClass('d-none').empty();
        $('#submitBtn').prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span> Updating...');
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            success: function(response) {
                toastr.success(response.message || 'Deposit updated!');
                setTimeout(() => { window.location.href = response.redirect; }, 1500);
            },
            error: function(xhr) {
                $('#submitBtn').prop('disabled', false).html('<i class="fas fa-save me-1"></i> Update Deposit');
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