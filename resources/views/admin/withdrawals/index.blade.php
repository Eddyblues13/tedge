@include('admin.header')

<div class="main-content">
    <div class="container-fluid">

        {{-- Toast Alerts --}}
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}<button type="button"
                class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">{{ session('error') }}<button type="button"
                class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif

        {{-- Page Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <div>
                <h4 class="admin-page-title mb-1">Manage Withdrawals</h4>
                <p class="admin-page-subtitle mb-0">Review, approve or reject user withdrawal requests</p>
            </div>
        </div>

        {{-- Stats Row --}}
        <div class="row g-3 mb-4">
            <div class="col-sm-6 col-lg-3">
                <div class="admin-stat-card">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon" style="background:rgba(99,102,241,.12);color:#6366f1;">
                            <i class="bi bi-arrow-up-right-circle"></i>
                        </div>
                        <div>
                            <div class="stat-label">Total Withdrawals</div>
                            <div class="stat-value">{{ $totalWithdrawals }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="admin-stat-card">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon" style="background:rgba(245,158,11,.12);color:#f59e0b;">
                            <i class="bi bi-hourglass-split"></i>
                        </div>
                        <div>
                            <div class="stat-label">Pending</div>
                            <div class="stat-value">{{ $pendingCount }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="admin-stat-card">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon" style="background:rgba(16,185,129,.12);color:#10b981;">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                        <div>
                            <div class="stat-label">Approved</div>
                            <div class="stat-value">{{ $approvedCount }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="admin-stat-card">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon" style="background:rgba(239,68,68,.12);color:#ef4444;">
                            <i class="bi bi-cash-stack"></i>
                        </div>
                        <div>
                            <div class="stat-label">Pending Volume</div>
                            <div class="stat-value">${{ number_format($pendingVolume, 2) }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Status Filter Tabs + Search --}}
        <div class="admin-card mb-4 p-3">
            <div class="row g-2 align-items-center">
                <div class="col-md-6">
                    <div class="d-flex gap-2 flex-wrap">
                        <button class="btn wd-filter-btn active" data-filter="all">
                            <i class="bi bi-grid-3x3-gap me-1"></i> All <span class="wd-filter-count">{{
                                $totalWithdrawals }}</span>
                        </button>
                        <button class="btn wd-filter-btn" data-filter="pending">
                            <i class="bi bi-hourglass-split me-1"></i> Pending <span
                                class="wd-filter-count pending-count">{{ $pendingCount }}</span>
                        </button>
                        <button class="btn wd-filter-btn" data-filter="approved">
                            <i class="bi bi-check-circle me-1"></i> Approved <span class="wd-filter-count">{{
                                $approvedCount }}</span>
                        </button>
                        <button class="btn wd-filter-btn" data-filter="rejected">
                            <i class="bi bi-x-circle me-1"></i> Rejected <span class="wd-filter-count">{{ $rejectedCount
                                }}</span>
                        </button>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative">
                        <i class="bi bi-search position-absolute"
                            style="left:14px;top:50%;transform:translateY(-50%);color:var(--text-color);opacity:.5;"></i>
                        <input type="text" id="wdSearch" class="admin-form-control"
                            placeholder="Search by user name, wallet, amount…" style="padding-left:40px;">
                    </div>
                </div>
            </div>
        </div>

        {{-- Table --}}
        <div class="admin-card">
            <div class="admin-table">
                <div class="table-responsive">
                    <table id="WithdrawalTable" class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User</th>
                                <th>Amount</th>
                                <th>Account Type</th>
                                <th>Crypto</th>
                                <th>Wallet Address</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th style="width:160px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($withdrawals as $withdrawal)
                            <tr data-status="{{ $withdrawal->status }}">
                                <td style="color:var(--text-color);opacity:.5;">{{ $withdrawal->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="wd-user-avatar">
                                            {{ strtoupper(substr($withdrawal->user->first_name ?? 'U', 0, 1)) }}
                                        </div>
                                        <div>
                                            <div style="color:var(--heading-color);font-weight:600;font-size:13px;">
                                                {{ $withdrawal->user->first_name ?? '' }} {{
                                                $withdrawal->user->last_name ?? '' }}
                                            </div>
                                            <div style="color:var(--text-color);font-size:11px;opacity:.6;">
                                                {{ $withdrawal->user->email ?? '' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span style="color:var(--heading-color);font-weight:700;font-size:15px;">
                                        ${{ number_format($withdrawal->amount, 2) }}
                                    </span>
                                </td>
                                <td>
                                    @php
                                    $typeIcons = [
                                    'holding' => 'bi-wallet2',
                                    'trading' => 'bi-graph-up-arrow',
                                    'mining' => 'bi-cpu',
                                    'staking' => 'bi-layers',
                                    'profit' => 'bi-trophy',
                                    'deposit' => 'bi-box-arrow-in-down',
                                    'referral'=> 'bi-people',
                                    ];
                                    $typeColors = [
                                    'holding' => '#6366f1',
                                    'trading' => '#10b981',
                                    'mining' => '#f59e0b',
                                    'staking' => '#8b5cf6',
                                    'profit' => '#ec4899',
                                    'deposit' => '#3b82f6',
                                    'referral'=> '#14b8a6',
                                    ];
                                    $icon = $typeIcons[$withdrawal->account_type] ?? 'bi-question-circle';
                                    $color = $typeColors[$withdrawal->account_type] ?? '#6b7280';
                                    @endphp
                                    <span class="wd-type-badge" style="--type-color:{{ $color }};">
                                        <i class="bi {{ $icon }} me-1"></i>{{ ucfirst($withdrawal->account_type) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="wd-crypto-badge">
                                        {{ strtoupper($withdrawal->crypto_currency ?? '—') }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-1">
                                        <span class="wd-wallet-text text-truncate"
                                            title="{{ $withdrawal->wallet_address }}">
                                            {{ $withdrawal->wallet_address }}
                                        </span>
                                        <button class="btn btn-sm wd-copy-btn p-0 ms-1"
                                            data-clipboard-text="{{ $withdrawal->wallet_address }}"
                                            title="Copy address">
                                            <i class="bi bi-clipboard"></i>
                                        </button>
                                    </div>
                                </td>
                                <td>
                                    @php
                                    $statusMap = [
                                    'approved' => ['class' => 'success', 'icon' => 'bi-check-circle-fill'],
                                    'pending' => ['class' => 'warning', 'icon' => 'bi-hourglass-split'],
                                    'rejected' => ['class' => 'danger', 'icon' => 'bi-x-circle-fill'],
                                    ];
                                    $s = $statusMap[$withdrawal->status] ?? ['class' => 'warning', 'icon' =>
                                    'bi-question-circle'];
                                    @endphp
                                    <span class="admin-badge-{{ $s['class'] }}">
                                        <i class="bi {{ $s['icon'] }} me-1"></i>{{ ucfirst($withdrawal->status) }}
                                    </span>
                                </td>
                                <td style="color:var(--text-color);font-size:13px;">
                                    {{ $withdrawal->created_at->format('M d, Y') }}
                                    <div style="font-size:11px;opacity:.5;">{{ $withdrawal->created_at->format('h:i A')
                                        }}</div>
                                </td>
                                <td>
                                    @if($withdrawal->status == 'pending')
                                    <div class="d-flex gap-1">
                                        <button class="btn btn-sm wd-approve-btn" data-id="{{ $withdrawal->id }}"
                                            title="Approve">
                                            <i class="bi bi-check-lg me-1"></i>Approve
                                        </button>
                                        <button class="btn btn-sm wd-reject-btn" data-id="{{ $withdrawal->id }}"
                                            title="Reject">
                                            <i class="bi bi-x-lg me-1"></i>Reject
                                        </button>
                                    </div>
                                    @else
                                    <span class="wd-processed-label">
                                        <i class="bi bi-check2-all me-1"></i>Processed
                                    </span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Confirm Modal --}}
<div class="modal fade" id="wdConfirmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content"
            style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);border-radius:16px;">
            <div class="modal-body text-center py-4">
                <div id="wdConfirmIcon" class="mb-3" style="font-size:48px;"></div>
                <h5 id="wdConfirmTitle" style="color:var(--heading-color);font-weight:600;"></h5>
                <p id="wdConfirmText" class="mb-0" style="color:var(--text-color);font-size:14px;"></p>
            </div>
            <div class="modal-footer justify-content-center" style="border-color:var(--border-color);">
                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-sm" id="wdConfirmBtn"></button>
            </div>
        </div>
    </div>
</div>

<style>
    /* Filter Buttons */
    .wd-filter-btn {
        background: var(--input-bg);
        color: var(--text-color);
        border: 1px solid var(--border-color);
        border-radius: 10px;
        font-size: 13px;
        font-weight: 500;
        padding: 6px 14px;
        transition: all .2s;
    }

    .wd-filter-btn:hover,
    .wd-filter-btn.active {
        background: linear-gradient(135deg, var(--accent-color), #8b5cf6);
        color: #fff;
        border-color: var(--accent-color);
    }

    .wd-filter-count {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 22px;
        height: 20px;
        border-radius: 10px;
        background: rgba(255, 255, 255, .2);
        font-size: 11px;
        font-weight: 700;
        padding: 0 6px;
        margin-left: 4px;
    }

    .wd-filter-btn:not(.active) .wd-filter-count {
        background: var(--card-bg);
        color: var(--text-color);
    }

    /* User Avatar */
    .wd-user-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--accent-color), #8b5cf6);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 14px;
        flex-shrink: 0;
    }

    /* Type Badge */
    .wd-type-badge {
        display: inline-flex;
        align-items: center;
        padding: 4px 12px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        background: color-mix(in srgb, var(--type-color) 12%, transparent);
        color: var(--type-color);
    }

    /* Crypto Badge */
    .wd-crypto-badge {
        display: inline-flex;
        align-items: center;
        padding: 3px 10px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .5px;
        background: color-mix(in srgb, var(--accent-color) 12%, transparent);
        color: var(--accent-color);
    }

    /* Wallet Address */
    .wd-wallet-text {
        max-width: 120px;
        font-size: 12px;
        color: var(--text-color);
        font-family: 'Courier New', monospace;
    }

    .wd-copy-btn {
        color: var(--accent-color);
        font-size: 13px;
        transition: all .2s;
        line-height: 1;
    }

    .wd-copy-btn:hover {
        color: var(--accent-color);
        transform: scale(1.15);
    }

    /* Action Buttons */
    .wd-approve-btn {
        background: rgba(16, 185, 129, .12);
        color: #10b981;
        border-radius: 8px;
        font-weight: 600;
        font-size: 12px;
        transition: all .2s;
    }

    .wd-approve-btn:hover {
        background: #10b981;
        color: #fff;
    }

    .wd-reject-btn {
        background: rgba(239, 68, 68, .12);
        color: #ef4444;
        border-radius: 8px;
        font-weight: 600;
        font-size: 12px;
        transition: all .2s;
    }

    .wd-reject-btn:hover {
        background: #ef4444;
        color: #fff;
    }

    .wd-processed-label {
        color: var(--text-color);
        opacity: .4;
        font-size: 12px;
        font-weight: 500;
    }
</style>

@include('admin.footer')

<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.11/clipboard.min.js"></script>
<script>
    $(document).ready(function() {

    // ── Clipboard ────────────────────────────────────
    const clipboard = new ClipboardJS('.wd-copy-btn');
    clipboard.on('success', function() {
        toastr.success('Wallet address copied!');
    });

    // ── DataTable ────────────────────────────────────
    const table = $('#WithdrawalTable').DataTable({
        order: [[7, 'desc']],
        pageLength: 25,
        dom: '<"d-flex justify-content-between align-items-center mb-3"l>rt<"d-flex justify-content-between align-items-center mt-3"ip>',
        language: {
            lengthMenu: 'Show _MENU_',
            info: 'Showing _START_ to _END_ of _TOTAL_ withdrawals'
        }
    });

    // Style DataTables length select
    $('.dataTables_length select').addClass('admin-form-control').css({display:'inline-block', width:'auto'});

    // ── Custom search ────────────────────────────────
    $('#wdSearch').on('input', function() {
        table.search(this.value).draw();
    });

    // ── Status filter tabs ───────────────────────────
    let activeFilter = 'all';
    $('.wd-filter-btn').on('click', function() {
        $('.wd-filter-btn').removeClass('active');
        $(this).addClass('active');
        activeFilter = $(this).data('filter');

        if (activeFilter === 'all') {
            $.fn.dataTable.ext.search.pop();
        } else {
            $.fn.dataTable.ext.search = [];
            $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                const row = table.row(dataIndex).node();
                return $(row).data('status') === activeFilter;
            });
        }
        table.draw();
    });

    // ── Confirm Modal Logic ──────────────────────────
    const confirmModal = new bootstrap.Modal(document.getElementById('wdConfirmModal'));
    let pendingAction = null;

    function showConfirm(type, withdrawalId) {
        if (type === 'approve') {
            $('#wdConfirmIcon').html('<i class="bi bi-check-circle" style="color:#10b981;"></i>');
            $('#wdConfirmTitle').text('Approve Withdrawal');
            $('#wdConfirmText').text('The withdrawal will be marked as approved. Continue?');
            $('#wdConfirmBtn').attr('class', 'btn btn-sm btn-success').html('<i class="bi bi-check-lg me-1"></i>Yes, Approve');
        } else {
            $('#wdConfirmIcon').html('<i class="bi bi-x-circle" style="color:#ef4444;"></i>');
            $('#wdConfirmTitle').text('Reject Withdrawal');
            $('#wdConfirmText').text('The amount will be refunded to the user\'s account. Continue?');
            $('#wdConfirmBtn').attr('class', 'btn btn-sm btn-danger').html('<i class="bi bi-x-lg me-1"></i>Yes, Reject');
        }
        pendingAction = { type, withdrawalId };
        confirmModal.show();
    }

    // Approve button
    $(document).on('click', '.wd-approve-btn', function() {
        showConfirm('approve', $(this).data('id'));
    });

    // Reject button
    $(document).on('click', '.wd-reject-btn', function() {
        showConfirm('reject', $(this).data('id'));
    });

    // Confirm action
    $('#wdConfirmBtn').on('click', function() {
        if (!pendingAction) return;
        const btn = $(this);
        const orig = btn.html();
        btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span> Processing…');

        const url = pendingAction.type === 'approve'
            ? `/admin/withdrawals/${pendingAction.withdrawalId}/approve`
            : `/admin/withdrawals/${pendingAction.withdrawalId}/reject`;

        $.ajax({
            url: url,
            type: 'POST',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(r) {
                confirmModal.hide();
                toastr.success(r.message || 'Withdrawal processed successfully!');
                setTimeout(() => location.reload(), 1200);
            },
            error: function(xhr) {
                confirmModal.hide();
                toastr.error(xhr.responseJSON?.message || 'An error occurred');
                btn.prop('disabled', false).html(orig);
            }
        });
    });
});
</script>