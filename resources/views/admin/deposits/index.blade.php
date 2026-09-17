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
                <h4 class="admin-page-title mb-1">Manage Deposits</h4>
                <p class="admin-page-subtitle mb-0">Review, approve or reject user deposit requests</p>
            </div>
        </div>

        {{-- Stats Row --}}
        <div class="row g-3 mb-4">
            <div class="col-sm-6 col-lg-3">
                <div class="admin-stat-card">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon" style="background:rgba(99,102,241,.12);color:#6366f1;">
                            <i class="bi bi-receipt-cutoff"></i>
                        </div>
                        <div>
                            <div class="stat-label">Total Deposits</div>
                            <div class="stat-value">{{ $totalDeposits }}</div>
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
                        <div class="stat-icon" style="background:rgba(59,130,246,.12);color:#3b82f6;">
                            <i class="bi bi-cash-stack"></i>
                        </div>
                        <div>
                            <div class="stat-label">Total Approved Volume</div>
                            <div class="stat-value">${{ number_format($approvedVolume, 2) }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Status Filter Tabs --}}
        <div class="admin-card mb-4 p-3">
            <div class="row g-2 align-items-center">
                <div class="col-md-6">
                    <div class="d-flex gap-2 flex-wrap">
                        <button class="btn deposit-filter-btn active" data-filter="all">
                            <i class="bi bi-grid-3x3-gap me-1"></i> All <span class="deposit-filter-count">{{
                                $totalDeposits }}</span>
                        </button>
                        <button class="btn deposit-filter-btn" data-filter="pending">
                            <i class="bi bi-hourglass-split me-1"></i> Pending <span
                                class="deposit-filter-count pending-count">{{ $pendingCount }}</span>
                        </button>
                        <button class="btn deposit-filter-btn" data-filter="approved">
                            <i class="bi bi-check-circle me-1"></i> Approved <span class="deposit-filter-count">{{
                                $approvedCount }}</span>
                        </button>
                        <button class="btn deposit-filter-btn" data-filter="rejected">
                            <i class="bi bi-x-circle me-1"></i> Rejected <span class="deposit-filter-count">{{
                                $rejectedCount }}</span>
                        </button>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative">
                        <i class="bi bi-search position-absolute"
                            style="left:14px;top:50%;transform:translateY(-50%);color:var(--text-color);opacity:.5;"></i>
                        <input type="text" id="depositSearch" class="admin-form-control"
                            placeholder="Search by user name, amount, type…" style="padding-left:40px;">
                    </div>
                </div>
            </div>
        </div>

        {{-- Table --}}
        <div class="admin-card">
            <div class="admin-table">
                <div class="table-responsive">
                    <table id="DepositTable" class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User</th>
                                <th>Amount</th>
                                <th>Account Type</th>
                                <th>Payment Method</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th style="width:160px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($deposits as $deposit)
                            <tr data-status="{{ $deposit->status }}">
                                <td style="color:var(--text-color);opacity:.5;">{{ $deposit->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="deposit-user-avatar">
                                            {{ strtoupper(substr($deposit->user->first_name ?? 'U', 0, 1)) }}
                                        </div>
                                        <div>
                                            <div style="color:var(--heading-color);font-weight:600;font-size:13px;">
                                                {{ $deposit->user->first_name ?? '' }} {{ $deposit->user->last_name ??
                                                '' }}
                                            </div>
                                            <div style="color:var(--text-color);font-size:11px;opacity:.6;">
                                                {{ $deposit->user->email ?? '' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span style="color:var(--heading-color);font-weight:700;font-size:15px;">${{
                                        number_format($deposit->amount, 2) }}</span>
                                </td>
                                <td>
                                    @php
                                    $typeIcons = [
                                    'holding' => 'bi-wallet2',
                                    'trading' => 'bi-graph-up-arrow',
                                    'mining' => 'bi-cpu',
                                    'staking' => 'bi-layers',
                                    ];
                                    $typeColors = [
                                    'holding' => '#6366f1',
                                    'trading' => '#10b981',
                                    'mining' => '#f59e0b',
                                    'staking' => '#8b5cf6',
                                    ];
                                    $icon = $typeIcons[$deposit->account_type] ?? 'bi-question-circle';
                                    $color = $typeColors[$deposit->account_type] ?? '#6b7280';
                                    @endphp
                                    <span class="deposit-type-badge" style="--type-color:{{ $color }};">
                                        <i class="bi {{ $icon }} me-1"></i>{{ ucfirst($deposit->account_type) }}
                                    </span>
                                </td>
                                <td style="color:var(--text-color);font-size:13px;">
                                    {{ $deposit->payment_method ? ucfirst(str_replace('_', ' ',
                                    $deposit->payment_method)) : '—' }}
                                    @if($deposit->crypto_amount)
                                    <div style="font-size:11px;opacity:.5;">{{ $deposit->crypto_amount }}</div>
                                    @endif
                                </td>
                                <td>
                                    @php
                                    $statusMap = [
                                    'approved' => ['class' => 'success', 'icon' => 'bi-check-circle-fill'],
                                    'pending' => ['class' => 'warning', 'icon' => 'bi-hourglass-split'],
                                    'rejected' => ['class' => 'danger', 'icon' => 'bi-x-circle-fill'],
                                    ];
                                    $s = $statusMap[$deposit->status] ?? ['class' => 'warning', 'icon' =>
                                    'bi-question-circle'];
                                    @endphp
                                    <span class="admin-badge-{{ $s['class'] }}">
                                        <i class="bi {{ $s['icon'] }} me-1"></i>{{ ucfirst($deposit->status) }}
                                    </span>
                                </td>
                                <td style="color:var(--text-color);font-size:13px;">
                                    {{ $deposit->created_at->format('M d, Y') }}
                                    <div style="font-size:11px;opacity:.5;">{{ $deposit->created_at->format('h:i A') }}
                                    </div>
                                </td>
                                <td>
                                    @if($deposit->status == 'pending')
                                    <div class="d-flex gap-1">
                                        <button class="btn btn-sm deposit-approve-btn" data-id="{{ $deposit->id }}"
                                            title="Approve">
                                            <i class="bi bi-check-lg me-1"></i>Approve
                                        </button>
                                        <button class="btn btn-sm deposit-reject-btn" data-id="{{ $deposit->id }}"
                                            title="Reject">
                                            <i class="bi bi-x-lg me-1"></i>Reject
                                        </button>
                                    </div>
                                    @else
                                    <span class="deposit-processed-label">
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
<div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content"
            style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);border-radius:16px;">
            <div class="modal-body text-center py-4">
                <div id="confirmIcon" class="mb-3" style="font-size:48px;"></div>
                <h5 id="confirmTitle" style="color:var(--heading-color);font-weight:600;"></h5>
                <p id="confirmText" class="mb-0" style="color:var(--text-color);font-size:14px;"></p>
            </div>
            <div class="modal-footer justify-content-center" style="border-color:var(--border-color);">
                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-sm" id="confirmBtn"></button>
            </div>
        </div>
    </div>
</div>

<style>
    /* Filter Buttons */
    .deposit-filter-btn {
        background: var(--input-bg);
        color: var(--text-color);
        border: 1px solid var(--border-color);
        border-radius: 10px;
        font-size: 13px;
        font-weight: 500;
        padding: 6px 14px;
        transition: all .2s;
    }

    .deposit-filter-btn:hover,
    .deposit-filter-btn.active {
        background: linear-gradient(135deg, var(--accent-color), #8b5cf6);
        color: #fff;
        border-color: var(--accent-color);
    }

    .deposit-filter-count {
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

    .deposit-filter-btn:not(.active) .deposit-filter-count {
        background: var(--card-bg);
        color: var(--text-color);
    }

    /* User Avatar */
    .deposit-user-avatar {
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
    .deposit-type-badge {
        display: inline-flex;
        align-items: center;
        padding: 4px 12px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        background: color-mix(in srgb, var(--type-color) 12%, transparent);
        color: var(--type-color);
    }

    /* Action Buttons */
    .deposit-approve-btn {
        background: rgba(16, 185, 129, .12);
        color: #10b981;
        border-radius: 8px;
        font-weight: 600;
        font-size: 12px;
        transition: all .2s;
    }

    .deposit-approve-btn:hover {
        background: #10b981;
        color: #fff;
    }

    .deposit-reject-btn {
        background: rgba(239, 68, 68, .12);
        color: #ef4444;
        border-radius: 8px;
        font-weight: 600;
        font-size: 12px;
        transition: all .2s;
    }

    .deposit-reject-btn:hover {
        background: #ef4444;
        color: #fff;
    }

    .deposit-processed-label {
        color: var(--text-color);
        opacity: .4;
        font-size: 12px;
        font-weight: 500;
    }
</style>

@include('admin.footer')

<script>
    $(document).ready(function() {
    // DataTable
    const table = $('#DepositTable').DataTable({
        order: [[6, 'desc']],
        pageLength: 25,
        dom: '<"d-flex justify-content-between align-items-center mb-3"l>rt<"d-flex justify-content-between align-items-center mt-3"ip>',
        language: {
            lengthMenu: 'Show _MENU_',
            info: 'Showing _START_ to _END_ of _TOTAL_ deposits'
        }
    });

    // Style DataTables controls
    $('.dataTables_length select').addClass('admin-form-control').css({display:'inline-block', width:'auto'});

    // === Custom search ===
    $('#depositSearch').on('input', function() {
        table.search(this.value).draw();
    });

    // === Status filter tabs ===
    let activeFilter = 'all';
    $('.deposit-filter-btn').on('click', function() {
        $('.deposit-filter-btn').removeClass('active');
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

    // === Confirm Modal Logic ===
    const confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));
    let pendingAction = null;

    function showConfirm(type, depositId) {
        if (type === 'approve') {
            $('#confirmIcon').html('<i class="bi bi-check-circle" style="color:#10b981;"></i>');
            $('#confirmTitle').text('Approve Deposit');
            $('#confirmText').text('This will credit the user\'s account balance. Continue?');
            $('#confirmBtn').attr('class', 'btn btn-sm btn-success').html('<i class="bi bi-check-lg me-1"></i>Yes, Approve');
        } else {
            $('#confirmIcon').html('<i class="bi bi-x-circle" style="color:#ef4444;"></i>');
            $('#confirmTitle').text('Reject Deposit');
            $('#confirmText').text('This deposit request will be rejected. Continue?');
            $('#confirmBtn').attr('class', 'btn btn-sm btn-danger').html('<i class="bi bi-x-lg me-1"></i>Yes, Reject');
        }
        pendingAction = { type, depositId };
        confirmModal.show();
    }

    // Approve button
    $(document).on('click', '.deposit-approve-btn', function() {
        showConfirm('approve', $(this).data('id'));
    });

    // Reject button
    $(document).on('click', '.deposit-reject-btn', function() {
        showConfirm('reject', $(this).data('id'));
    });

    // Confirm action
    $('#confirmBtn').on('click', function() {
        if (!pendingAction) return;
        const btn = $(this);
        const orig = btn.html();
        btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span> Processing…');

        const url = pendingAction.type === 'approve'
            ? `/admin/deposits/${pendingAction.depositId}/approve`
            : `/admin/deposits/${pendingAction.depositId}/reject`;

        $.ajax({
            url: url,
            type: 'POST',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(r) {
                confirmModal.hide();
                toastr.success(r.message || 'Deposit processed successfully!');
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