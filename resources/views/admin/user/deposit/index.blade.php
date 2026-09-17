@include('admin.header')

<style>
    .deposit-page-header {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.08), rgba(99, 91, 255, 0.04));
        border: 1px solid var(--border-color);
        border-radius: 14px;
        padding: 24px 28px;
        margin-bottom: 24px;
    }

    .deposit-stat {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 10px;
        padding: 14px 18px;
        text-align: center;
        min-width: 120px;
    }

    .deposit-stat .stat-val {
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--heading-color);
    }

    .deposit-stat .stat-lbl {
        font-size: 0.72rem;
        color: var(--text-color);
        opacity: 0.6;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .deposit-row {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 16px 20px;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        transition: all 0.2s;
    }

    .deposit-row:hover {
        border-color: var(--accent-color);
        box-shadow: 0 2px 12px rgba(99, 91, 255, 0.08);
    }

    .deposit-amount {
        font-weight: 700;
        font-size: 1rem;
        color: var(--heading-color);
    }

    .deposit-detail {
        font-size: 0.8rem;
        color: var(--text-color);
        opacity: 0.6;
    }

    .deposit-badge {
        font-size: 0.7rem;
        padding: 3px 10px;
        border-radius: 20px;
        font-weight: 600;
    }

    .deposit-badge.approved {
        background: rgba(16, 185, 129, 0.12);
        color: #10b981;
    }

    .deposit-badge.pending {
        background: rgba(245, 158, 11, 0.12);
        color: #f59e0b;
    }

    .deposit-badge.rejected {
        background: rgba(239, 68, 68, 0.12);
        color: #ef4444;
    }

    .deposit-type-badge {
        font-size: 0.7rem;
        padding: 3px 10px;
        border-radius: 20px;
        font-weight: 600;
        background: rgba(99, 91, 255, 0.1);
        color: var(--accent-color);
    }

    .deposit-actions .btn {
        border-radius: 8px;
        font-size: 0.78rem;
    }

    .create-deposit-card {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 14px;
        overflow: hidden;
    }

    .create-deposit-header {
        padding: 18px 24px;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        justify-content: space-between;
        cursor: pointer;
        user-select: none;
    }

    .create-deposit-header:hover {
        background: rgba(59, 130, 246, 0.03);
    }

    .create-deposit-header h6 {
        margin: 0;
        color: var(--heading-color);
        font-weight: 600;
        font-size: 0.95rem;
    }

    .create-deposit-body {
        padding: 24px;
    }

    .field-group {
        margin-bottom: 18px;
    }

    .field-group label {
        display: block;
        color: var(--heading-color);
        font-weight: 500;
        font-size: 0.82rem;
        margin-bottom: 6px;
    }

    .field-group .admin-form-control {
        border-radius: 10px !important;
    }

    .field-group small.text-danger {
        display: block;
        margin-top: 4px;
        font-size: 0.75rem;
    }

    .modal-content.deposit-modal {
        background: var(--card-bg);
        color: var(--text-color);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
    }

    .modal-content.deposit-modal .modal-header {
        border-bottom: 1px solid var(--border-color);
        padding: 20px 24px;
    }

    .modal-content.deposit-modal .modal-body {
        padding: 24px;
    }

    .modal-content.deposit-modal .modal-footer {
        border-top: 1px solid var(--border-color);
        padding: 16px 24px;
    }

    .modal-content.deposit-modal .modal-title {
        color: var(--heading-color);
        font-weight: 600;
    }

    .modal-content.deposit-modal .btn-close {
        filter: invert(1) grayscale(100%) brightness(200%);
    }

    .empty-deposits {
        text-align: center;
        padding: 60px 20px;
        color: var(--text-color);
        opacity: 0.5;
    }

    .empty-deposits i {
        font-size: 3rem;
        margin-bottom: 16px;
        display: block;
    }

    @media (max-width: 768px) {
        .deposit-row {
            flex-direction: column;
            align-items: flex-start;
        }

        .deposit-stat {
            min-width: 80px;
            padding: 10px 12px;
        }

        .deposit-stat .stat-val {
            font-size: 0.95rem;
        }

        .deposit-page-header {
            padding: 18px;
        }
    }
</style>

<div class="main-content">
    <div class="container-fluid">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-3">{{ session('success') }}<button type="button"
                class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-3">{{ session('error') }}<button type="button"
                class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif

        <!-- Page Header -->
        <div class="deposit-page-header">
            <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-3">
                <div>
                    <h4 class="admin-page-title mb-1"><i class="fas fa-arrow-down me-2"
                            style="color:#3b82f6;"></i>Deposit Manager</h4>
                    <p class="admin-page-subtitle mb-0">Managing deposits for <strong
                            style="color:var(--heading-color);">{{ $user->first_name }} {{ $user->last_name }}</strong>
                    </p>
                </div>
                <a href="{{ route('admin.user.view', $user->id) }}" class="btn btn-sm"
                    style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);border-radius:10px;">
                    <i class="fas fa-arrow-left me-1"></i> Back to User
                </a>
            </div>
            <div class="d-flex gap-3 flex-wrap">
                <div class="deposit-stat">
                    <div class="stat-val">{{ $deposits->count() }}</div>
                    <div class="stat-lbl">Total</div>
                </div>
                <div class="deposit-stat">
                    <div class="stat-val" style="color:#10b981;">{{ $deposits->where('status', 'approved')->count() }}
                    </div>
                    <div class="stat-lbl">Approved</div>
                </div>
                <div class="deposit-stat">
                    <div class="stat-val" style="color:#f59e0b;">{{ $deposits->where('status', 'pending')->count() }}
                    </div>
                    <div class="stat-lbl">Pending</div>
                </div>
                <div class="deposit-stat">
                    <div class="stat-val" style="color:var(--heading-color);">${{
                        number_format($deposits->where('status', 'approved')->sum('amount'), 2) }}</div>
                    <div class="stat-lbl">Total Approved</div>
                </div>
            </div>
        </div>

        <!-- Create Deposit Section -->
        <div class="create-deposit-card mb-4">
            <div class="create-deposit-header" id="toggleCreateForm">
                <h6><i class="fas fa-plus-circle me-2" style="color:#3b82f6;"></i>Add New Deposit</h6>
                <i class="fas fa-chevron-down toggle-icon" style="color:var(--text-color);opacity:0.5;"></i>
            </div>
            <div class="create-deposit-body d-none" id="createDepositBody">
                <form id="createDepositForm" action="{{ route('admin.users.deposits.store', $user->id) }}"
                    method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="field-group mb-0">
                                <label><i class="fas fa-dollar-sign me-1"></i> Amount</label>
                                <input type="number" step="0.01" name="amount" class="admin-form-control"
                                    placeholder="0.00" required>
                                <small id="create-amount-error" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="field-group mb-0">
                                <label><i class="fas fa-wallet me-1"></i> Account Type</label>
                                <select name="account_type" class="admin-form-control" required>
                                    <option value="">Select Type</option>
                                    <option value="holding">Holding Account</option>
                                    <option value="trading">Trading Account</option>
                                    <option value="mining">Mining Account</option>
                                    <option value="staking">Staking Account</option>
                                </select>
                                <small id="create-account_type-error" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="field-group mb-0">
                                <label><i class="fas fa-flag me-1"></i> Status</label>
                                <select name="status" class="admin-form-control" required>
                                    <option value="pending">Pending</option>
                                    <option value="approved">Approved</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                                <small id="create-status-error" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="field-group mb-0">
                                <label><i class="fas fa-credit-card me-1"></i> Payment Method <small
                                        style="opacity:0.5;">(optional)</small></label>
                                <input type="text" name="payment_method" class="admin-form-control"
                                    placeholder="e.g. Bitcoin, Bank Transfer...">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="field-group mb-0">
                                <label><i class="fas fa-coins me-1"></i> Crypto Amount <small
                                        style="opacity:0.5;">(optional)</small></label>
                                <input type="text" name="crypto_amount" class="admin-form-control"
                                    placeholder="e.g. 0.0034 BTC">
                            </div>
                        </div>
                    </div>
                    <div class="d-flex gap-2 mt-3">
                        <button type="submit" class="btn btn-admin-primary" id="createBtn"
                            style="border-radius:10px;padding:10px 28px;">
                            <i class="fas fa-plus-circle me-1"></i> Create Deposit
                        </button>
                        <button type="reset" class="btn"
                            style="border-radius:10px;padding:10px 20px;background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);">
                            <i class="fas fa-undo me-1"></i> Reset
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Deposit History -->
        <div class="admin-card" style="border-radius:14px;">
            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2" style="padding:0 4px;">
                <h6 style="color:var(--heading-color);font-weight:600;margin:0;">
                    <i class="fas fa-history me-2" style="color:#3b82f6;"></i>Deposit History
                </h6>
                <div class="d-flex gap-2 align-items-center">
                    <select id="statusFilter" class="admin-form-control"
                        style="max-width:160px;border-radius:10px;font-size:0.85rem;">
                        <option value="">All Status</option>
                        <option value="approved">Approved</option>
                        <option value="pending">Pending</option>
                        <option value="rejected">Rejected</option>
                    </select>
                    <input type="text" id="depositSearch" class="admin-form-control" placeholder="Search..."
                        style="max-width:180px;border-radius:10px;font-size:0.85rem;">
                </div>
            </div>

            @if($deposits->count() > 0)
            <div id="depositsList">
                @foreach($deposits as $deposit)
                <div class="deposit-row" id="deposit-row-{{ $deposit->id }}" data-status="{{ $deposit->status }}">
                    <div class="d-flex align-items-center gap-3" style="min-width:180px;">
                        <div
                            style="width:40px;height:40px;border-radius:10px;background:rgba(59,130,246,0.1);display:flex;align-items:center;justify-content:center;">
                            <i class="fas fa-arrow-down" style="color:#3b82f6;font-size:0.85rem;"></i>
                        </div>
                        <div>
                            <div class="deposit-amount">${{ number_format($deposit->amount, 2) }}</div>
                            <div class="deposit-detail">{{ $deposit->created_at->format('M j, Y · g:i A') }}</div>
                        </div>
                    </div>
                    <div class="d-flex gap-2 align-items-center flex-wrap">
                        <span class="deposit-type-badge">{{ ucfirst($deposit->account_type ?? 'N/A') }}</span>
                        <span class="deposit-badge {{ $deposit->status }}">
                            <i
                                class="fas fa-{{ $deposit->status === 'approved' ? 'check-circle' : ($deposit->status === 'pending' ? 'clock' : 'times-circle') }} me-1"></i>{{
                            ucfirst($deposit->status) }}
                        </span>
                    </div>
                    @if($deposit->payment_method)
                    <div style="min-width:100px;">
                        <div class="deposit-detail" style="opacity:1;"><i class="fas fa-credit-card me-1"
                                style="opacity:0.5;"></i>{{ $deposit->payment_method }}</div>
                        @if($deposit->crypto_amount)
                        <div class="deposit-detail">{{ $deposit->crypto_amount }}</div>
                        @endif
                    </div>
                    @endif
                    <div class="deposit-actions d-flex gap-1">
                        <button class="btn btn-sm edit-deposit-btn" title="Edit"
                            style="background:rgba(99,91,255,0.1);color:var(--accent-color);border:none;"
                            data-deposit='@json($deposit)' data-user-id="{{ $user->id }}">
                            <i class="fas fa-pen"></i>
                        </button>
                        @if($deposit->status === 'pending')
                        <button class="btn btn-sm approve-btn" title="Approve"
                            style="background:rgba(16,185,129,0.1);color:#10b981;border:none;"
                            data-deposit-id="{{ $deposit->id }}" data-user-id="{{ $user->id }}">
                            <i class="fas fa-check"></i>
                        </button>
                        <button class="btn btn-sm reject-btn" title="Reject"
                            style="background:rgba(239,68,68,0.1);color:#ef4444;border:none;"
                            data-deposit-id="{{ $deposit->id }}" data-user-id="{{ $user->id }}">
                            <i class="fas fa-times"></i>
                        </button>
                        @endif
                        <button class="btn btn-sm delete-deposit-btn" title="Delete"
                            style="background:rgba(239,68,68,0.1);color:#ef4444;border:none;"
                            data-deposit-id="{{ $deposit->id }}" data-user-id="{{ $user->id }}"
                            data-deposit-amount="${{ number_format($deposit->amount, 2) }}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="empty-deposits">
                <i class="fas fa-inbox"></i>
                <h6 style="color:var(--heading-color);">No deposits yet</h6>
                <p>Add the first deposit for this user using the form above.</p>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Edit Deposit Modal -->
<div class="modal fade" id="editDepositModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content deposit-modal">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-pen me-2" style="color:var(--accent-color);"></i>Edit Deposit
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editDepositForm">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="editDepositId">
                    <input type="hidden" id="editUserId">
                    <div class="field-group">
                        <label><i class="fas fa-dollar-sign me-1"></i> Amount</label>
                        <input type="number" step="0.01" name="amount" id="editAmount" class="admin-form-control"
                            required>
                        <small id="edit-amount-error" class="text-danger"></small>
                    </div>
                    <div class="field-group">
                        <label><i class="fas fa-wallet me-1"></i> Account Type</label>
                        <select name="account_type" id="editAccountType" class="admin-form-control" required>
                            <option value="holding">Holding Account</option>
                            <option value="trading">Trading Account</option>
                            <option value="mining">Mining Account</option>
                            <option value="staking">Staking Account</option>
                        </select>
                        <small id="edit-account_type-error" class="text-danger"></small>
                    </div>
                    <div class="field-group">
                        <label><i class="fas fa-flag me-1"></i> Status</label>
                        <select name="status" id="editStatus" class="admin-form-control" required>
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                        </select>
                        <small id="edit-status-error" class="text-danger"></small>
                    </div>
                    <div class="field-group">
                        <label><i class="fas fa-credit-card me-1"></i> Payment Method <small
                                style="opacity:0.5;">(optional)</small></label>
                        <input type="text" name="payment_method" id="editPaymentMethod" class="admin-form-control"
                            placeholder="e.g. Bitcoin, Bank Transfer...">
                    </div>
                    <div class="field-group mb-0">
                        <label><i class="fas fa-coins me-1"></i> Crypto Amount <small
                                style="opacity:0.5;">(optional)</small></label>
                        <input type="text" name="crypto_amount" id="editCryptoAmount" class="admin-form-control"
                            placeholder="e.g. 0.0034 BTC">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn"
                        style="background:transparent;color:var(--text-color);border:1px solid var(--border-color);border-radius:10px;padding:8px 20px;"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-admin-primary" id="updateDepositBtn"
                        style="border-radius:10px;padding:8px 24px;">
                        <i class="fas fa-save me-1"></i> Update Deposit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteDepositModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content deposit-modal">
            <div class="modal-body text-center py-4">
                <div
                    style="width:60px;height:60px;border-radius:50%;background:rgba(239,68,68,0.1);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                    <i class="fas fa-trash-alt" style="font-size:1.4rem;color:#ef4444;"></i>
                </div>
                <h6 style="color:var(--heading-color);font-weight:600;">Delete <span id="deleteDepositAmount"
                        class="fw-bold"></span> deposit?</h6>
                <p style="color:var(--text-color);opacity:0.7;font-size:0.9rem;">This action is <strong
                        style="color:#ef4444;">permanent</strong> and cannot be undone.</p>
                <div class="d-flex gap-2 justify-content-center mt-3">
                    <button type="button" class="btn"
                        style="background:transparent;color:var(--text-color);border:1px solid var(--border-color);border-radius:10px;padding:8px 24px;"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn"
                        style="border-radius:10px;padding:8px 24px;">
                        <i class="fas fa-trash me-1"></i> Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.footer')

<script>
    $(document).ready(function() {
    // Toggle create form
    $('#toggleCreateForm').on('click', function() {
        $('#createDepositBody').toggleClass('d-none');
        $(this).find('.toggle-icon').toggleClass('fa-chevron-down fa-chevron-up');
    });

    // Search & filter
    function filterDeposits() {
        const search = $('#depositSearch').val().toLowerCase();
        const status = $('#statusFilter').val();
        $('.deposit-row').each(function() {
            const text = $(this).text().toLowerCase();
            const rowStatus = $(this).data('status');
            const matchSearch = !search || text.includes(search);
            const matchStatus = !status || rowStatus === status;
            $(this).toggle(matchSearch && matchStatus);
        });
    }
    $('#depositSearch').on('input', filterDeposits);
    $('#statusFilter').on('change', filterDeposits);

    // Create deposit
    $('#createDepositForm').on('submit', function(e) {
        e.preventDefault();
        $('[id^="create-"][id$="-error"]').text('');
        $('#createBtn').prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span> Creating...');
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                toastr.success(response.message || 'Deposit created!');
                setTimeout(() => window.location.reload(), 1500);
            },
            error: function(xhr) {
                $('#createBtn').prop('disabled', false).html('<i class="fas fa-plus-circle me-1"></i> Create Deposit');
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, msgs) { $(`#create-${key}-error`).text(msgs[0]); });
                    toastr.error('Please fix the form errors');
                } else {
                    toastr.error(xhr.responseJSON?.message || 'An error occurred');
                }
            }
        });
    });

    // Edit deposit — open modal
    $(document).on('click', '.edit-deposit-btn', function() {
        const deposit = $(this).data('deposit');
        const userId = $(this).data('user-id');
        $('#editDepositId').val(deposit.id);
        $('#editUserId').val(userId);
        $('#editAmount').val(deposit.amount);
        $('#editAccountType').val(deposit.account_type);
        $('#editStatus').val(deposit.status);
        $('#editPaymentMethod').val(deposit.payment_method || '');
        $('#editCryptoAmount').val(deposit.crypto_amount || '');
        $('[id^="edit-"][id$="-error"]').text('');
        $('#editDepositModal').modal('show');
    });

    // Edit deposit — submit
    $('#editDepositForm').on('submit', function(e) {
        e.preventDefault();
        $('[id^="edit-"][id$="-error"]').text('');
        $('#updateDepositBtn').prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span> Updating...');
        const depositId = $('#editDepositId').val();
        const userId = $('#editUserId').val();
        $.ajax({
            url: `/admin/users/${userId}/deposits/${depositId}`,
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                toastr.success(response.message || 'Deposit updated!');
                $('#editDepositModal').modal('hide');
                setTimeout(() => window.location.reload(), 1500);
            },
            error: function(xhr) {
                $('#updateDepositBtn').prop('disabled', false).html('<i class="fas fa-save me-1"></i> Update Deposit');
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, msgs) { $(`#edit-${key}-error`).text(msgs[0]); });
                    toastr.error('Please fix the form errors');
                } else {
                    toastr.error(xhr.responseJSON?.message || 'An error occurred');
                }
            }
        });
    });

    // Approve deposit
    $(document).on('click', '.approve-btn', function() {
        const btn = $(this);
        const depositId = btn.data('deposit-id');
        const userId = btn.data('user-id');
        if (!confirm('Approve this deposit? Funds will be credited to the user\'s account.')) return;
        btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span>');
        $.ajax({
            url: `/admin/users/${userId}/deposits/${depositId}/approve`,
            type: 'POST',
            data: { _token: '{{ csrf_token() }}' },
            success: function(response) {
                toastr.success(response.message || 'Deposit approved!');
                setTimeout(() => window.location.reload(), 1500);
            },
            error: function(xhr) {
                toastr.error(xhr.responseJSON?.message || 'Error approving deposit');
                btn.prop('disabled', false).html('<i class="fas fa-check"></i>');
            }
        });
    });

    // Reject deposit
    $(document).on('click', '.reject-btn', function() {
        const btn = $(this);
        const depositId = btn.data('deposit-id');
        const userId = btn.data('user-id');
        if (!confirm('Reject this deposit?')) return;
        btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span>');
        $.ajax({
            url: `/admin/users/${userId}/deposits/${depositId}/reject`,
            type: 'POST',
            data: { _token: '{{ csrf_token() }}' },
            success: function(response) {
                toastr.success(response.message || 'Deposit rejected');
                setTimeout(() => window.location.reload(), 1500);
            },
            error: function(xhr) {
                toastr.error(xhr.responseJSON?.message || 'Error rejecting deposit');
                btn.prop('disabled', false).html('<i class="fas fa-times"></i>');
            }
        });
    });

    // Delete deposit — open modal
    $(document).on('click', '.delete-deposit-btn', function() {
        const depositId = $(this).data('deposit-id');
        const userId = $(this).data('user-id');
        const amount = $(this).data('deposit-amount');
        $('#deleteDepositAmount').text(amount);
        $('#confirmDeleteBtn').data({ 'deposit-id': depositId, 'user-id': userId });
        $('#deleteDepositModal').modal('show');
    });

    // Delete deposit — confirm
    $('#confirmDeleteBtn').on('click', function() {
        const depositId = $(this).data('deposit-id');
        const userId = $(this).data('user-id');
        $(this).prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span> Deleting...');
        $.ajax({
            url: `/admin/users/${userId}/deposits/${depositId}`,
            type: 'DELETE',
            data: { _token: '{{ csrf_token() }}' },
            success: function(response) {
                toastr.success(response.message || 'Deposit deleted');
                $(`#deposit-row-${depositId}`).fadeOut(300, function() { $(this).remove(); });
                $('#deleteDepositModal').modal('hide');
                $('#confirmDeleteBtn').prop('disabled', false).html('<i class="fas fa-trash me-1"></i> Delete');
            },
            error: function(xhr) {
                toastr.error(xhr.responseJSON?.message || 'Error deleting deposit');
                $('#confirmDeleteBtn').prop('disabled', false).html('<i class="fas fa-trash me-1"></i> Delete');
            }
        });
    });
});
</script>