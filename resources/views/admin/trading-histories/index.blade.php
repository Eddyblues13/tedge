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
                <h4 class="admin-page-title mb-1">Copy Trade History</h4>
                <p class="admin-page-subtitle mb-0">View and manage all user copy trading records</p>
            </div>
            <button class="btn btn-admin-primary" data-bs-toggle="modal" data-bs-target="#createHistoryModal">
                <i class="bi bi-plus-circle me-1"></i> Add Record
            </button>
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
                            <div class="stat-label">Total Records</div>
                            <div class="stat-value">{{ $histories->count() }}</div>
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
                            <div class="stat-label">Active</div>
                            <div class="stat-value">{{ $histories->where('status', 'active')->count() }}</div>
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
                            <div class="stat-value">{{ $histories->where('status', 'pending')->count() }}</div>
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
                            <div class="stat-label">Total Volume</div>
                            <div class="stat-value">${{ number_format($histories->sum('amount'), 2) }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Table --}}
        <div class="admin-card">
            <div class="admin-table">
                <div class="table-responsive">
                    <table id="HistoryTable" class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User</th>
                                <th>Trader</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th style="width:120px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($histories as $history)
                            <tr>
                                <td style="color:var(--text-color);opacity:.5;">{{ $history->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="history-user-avatar">
                                            {{ strtoupper(substr($history->user->first_name ?? 'U', 0, 1)) }}
                                        </div>
                                        <div>
                                            <div style="color:var(--heading-color);font-weight:600;font-size:13px;">
                                                {{ $history->user->first_name ?? '' }} {{ $history->user->last_name ??
                                                '' }}
                                            </div>
                                            <div style="color:var(--text-color);font-size:11px;opacity:.6;">
                                                {{ $history->user->email ?? '' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        @if($history->trader && $history->trader->picture_url)
                                        <img src="{{ $history->trader->picture_url }}" class="rounded-circle" width="30"
                                            height="30" style="object-fit:cover;"
                                            onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($history->trader->name ?? 'T') }}&background=6366f1&color=fff&size=30'">
                                        @else
                                        <div class="history-trader-avatar">T</div>
                                        @endif
                                        <span style="color:var(--heading-color);font-weight:500;">{{
                                            $history->trader->name ?? 'N/A' }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span style="color:var(--heading-color);font-weight:700;">${{
                                        number_format($history->amount, 2) }}</span>
                                </td>
                                <td>
                                    @php
                                    $statusMap = [
                                    'active' => 'success',
                                    'completed' => 'success',
                                    'pending' => 'warning',
                                    'failed' => 'danger',
                                    'closed' => 'secondary',
                                    ];
                                    $badgeClass = $statusMap[$history->status] ?? 'warning';
                                    @endphp
                                    <span class="admin-badge-{{ $badgeClass }}">
                                        {{ ucfirst($history->status) }}
                                    </span>
                                </td>
                                <td style="color:var(--text-color);font-size:13px;">
                                    {{ $history->created_at->format('M d, Y') }}
                                    <div style="font-size:11px;opacity:.5;">{{ $history->created_at->format('h:i A') }}
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <button class="btn btn-sm btn-outline-primary edit-btn" title="Edit"
                                            data-id="{{ $history->id }}" data-user_id="{{ $history->user_id }}"
                                            data-trader_id="{{ $history->trader_id }}"
                                            data-amount="{{ $history->amount }}" data-status="{{ $history->status }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <form action="{{ route('admin.trading-histories.destroy', $history->id) }}"
                                            method="POST" class="d-inline delete-form">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger delete-btn"
                                                title="Delete">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </form>
                                    </div>
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

{{-- Create Modal --}}
<div class="modal fade" id="createHistoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content"
            style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);border-radius:16px;">
            <div class="modal-header" style="border-color:var(--border-color);">
                <div>
                    <h5 class="modal-title" style="color:var(--heading-color);font-weight:600;">Add Copy Trade Record
                    </h5>
                    <small style="color:var(--text-color);">Create a new trading history entry</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="createHistoryForm">
                @csrf
                <div class="modal-body">
                    <div id="createErrors" class="alert alert-danger d-none"></div>
                    <div class="mb-3">
                        <label class="form-label" style="color:var(--heading-color);font-weight:500;">User <span
                                class="text-danger">*</span></label>
                        <select name="user_id" class="admin-form-control" required>
                            <option value="">Select User</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }} ({{
                                $user->email }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color:var(--heading-color);font-weight:500;">Trader <span
                                class="text-danger">*</span></label>
                        <select name="trader_id" class="admin-form-control" required>
                            <option value="">Select Trader</option>
                            @foreach($traders as $trader)
                            <option value="{{ $trader->id }}">{{ $trader->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color:var(--heading-color);font-weight:500;">Amount ($) <span
                                class="text-danger">*</span></label>
                        <input type="number" step="0.01" min="0" name="amount" class="admin-form-control"
                            placeholder="0.00" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color:var(--heading-color);font-weight:500;">Status</label>
                        <select name="status" class="admin-form-control" required>
                            <option value="pending">Pending</option>
                            <option value="active">Active</option>
                            <option value="completed">Completed</option>
                            <option value="closed">Closed</option>
                            <option value="failed">Failed</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer" style="border-color:var(--border-color);">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-admin-primary" id="createBtn">
                        <i class="bi bi-plus-circle me-1"></i> Create
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Edit Modal --}}
<div class="modal fade" id="editHistoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content"
            style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);border-radius:16px;">
            <div class="modal-header" style="border-color:var(--border-color);">
                <div>
                    <h5 class="modal-title" style="color:var(--heading-color);font-weight:600;">Edit Copy Trade Record
                    </h5>
                    <small style="color:var(--text-color);">Update the trading history entry</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editHistoryForm">
                @csrf @method('PUT')
                <input type="hidden" name="history_id" id="editHistoryId">
                <div class="modal-body">
                    <div id="editErrors" class="alert alert-danger d-none"></div>
                    <div class="mb-3">
                        <label class="form-label" style="color:var(--heading-color);font-weight:500;">User <span
                                class="text-danger">*</span></label>
                        <select name="user_id" id="editUserId" class="admin-form-control" required>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }} ({{
                                $user->email }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color:var(--heading-color);font-weight:500;">Trader <span
                                class="text-danger">*</span></label>
                        <select name="trader_id" id="editTraderId" class="admin-form-control" required>
                            @foreach($traders as $trader)
                            <option value="{{ $trader->id }}">{{ $trader->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color:var(--heading-color);font-weight:500;">Amount ($) <span
                                class="text-danger">*</span></label>
                        <input type="number" step="0.01" min="0" name="amount" id="editAmount"
                            class="admin-form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color:var(--heading-color);font-weight:500;">Status</label>
                        <select name="status" id="editStatus" class="admin-form-control" required>
                            <option value="pending">Pending</option>
                            <option value="active">Active</option>
                            <option value="completed">Completed</option>
                            <option value="closed">Closed</option>
                            <option value="failed">Failed</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer" style="border-color:var(--border-color);">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-admin-primary" id="editBtn">
                        <i class="bi bi-check-circle me-1"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .history-user-avatar {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 13px;
        flex-shrink: 0;
    }

    .history-trader-avatar {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: linear-gradient(135deg, #f59e0b, #ef4444);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 12px;
        flex-shrink: 0;
    }

    .admin-badge-secondary {
        display: inline-flex;
        align-items: center;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        background-color: rgba(107, 114, 128, 0.12);
        color: #6b7280;
    }
</style>

@include('admin.footer')

<script>
    $(document).ready(function() {
    // DataTable
    $('#HistoryTable').DataTable({
        order: [[5, 'desc']],
        dom: '<"d-flex justify-content-between align-items-center mb-3"lf>rt<"d-flex justify-content-between align-items-center mt-3"ip>',
        language: {
            search: '',
            searchPlaceholder: 'Search records…',
            lengthMenu: 'Show _MENU_'
        }
    });

    // Style the DataTables search/length inputs
    $('.dataTables_filter input').addClass('admin-form-control').css('display','inline-block').css('width','auto');
    $('.dataTables_length select').addClass('admin-form-control').css('display','inline-block').css('width','auto');

    // === Create ===
    $('#createHistoryForm').submit(function(e) {
        e.preventDefault();
        const form = $(this);
        const btn = $('#createBtn');
        const orig = btn.html();
        btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span> Creating…');
        $('#createErrors').addClass('d-none');

        $.ajax({
            url: "{{ route('admin.trading-histories.store') }}",
            type: 'POST',
            data: form.serialize(),
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(r) {
                toastr.success(r.message || 'Record created!');
                $('#createHistoryModal').modal('hide');
                setTimeout(() => location.reload(), 1200);
            },
            error: function(xhr) {
                btn.prop('disabled', false).html(orig);
                if (xhr.status === 422 && xhr.responseJSON?.errors) {
                    let h = '<ul class="mb-0">';
                    $.each(xhr.responseJSON.errors, (k, v) => h += '<li>' + v[0] + '</li>');
                    h += '</ul>';
                    $('#createErrors').html(h).removeClass('d-none');
                } else {
                    toastr.error(xhr.responseJSON?.message || 'An error occurred');
                }
            }
        });
    });

    // === Edit (populate) ===
    $(document).on('click', '.edit-btn', function() {
        $('#editHistoryId').val($(this).data('id'));
        $('#editUserId').val($(this).data('user_id'));
        $('#editTraderId').val($(this).data('trader_id'));
        $('#editAmount').val($(this).data('amount'));
        $('#editStatus').val($(this).data('status'));
        $('#editErrors').addClass('d-none');
        new bootstrap.Modal(document.getElementById('editHistoryModal')).show();
    });

    // === Edit (submit) ===
    $('#editHistoryForm').submit(function(e) {
        e.preventDefault();
        const form = $(this);
        const btn = $('#editBtn');
        const orig = btn.html();
        btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span> Updating…');
        $('#editErrors').addClass('d-none');

        $.ajax({
            url: "/admin/trading-histories/" + $('#editHistoryId').val(),
            type: 'POST',
            data: form.serialize(),
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(r) {
                toastr.success(r.message || 'Record updated!');
                $('#editHistoryModal').modal('hide');
                setTimeout(() => location.reload(), 1200);
            },
            error: function(xhr) {
                btn.prop('disabled', false).html(orig);
                if (xhr.status === 422 && xhr.responseJSON?.errors) {
                    let h = '<ul class="mb-0">';
                    $.each(xhr.responseJSON.errors, (k, v) => h += '<li>' + v[0] + '</li>');
                    h += '</ul>';
                    $('#editErrors').html(h).removeClass('d-none');
                } else {
                    toastr.error(xhr.responseJSON?.message || 'An error occurred');
                }
            }
        });
    });

    // === Delete ===
    $(document).on('click', '.delete-btn', function(e) {
        e.preventDefault();
        if (!confirm('Are you sure you want to delete this record?')) return;
        const form = $(this).closest('form');
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(r) {
                toastr.success(r.message || 'Record deleted!');
                form.closest('tr').fadeOut(300, function() { $(this).remove(); });
            },
            error: function(xhr) {
                toastr.error(xhr.responseJSON?.message || 'An error occurred');
            }
        });
    });
});
</script>