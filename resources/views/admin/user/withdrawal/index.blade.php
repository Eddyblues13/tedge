@include('admin.header')

<div class="main-content">
    <div class="container-fluid">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-3">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-3">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="admin-page-title">Withdrawals</h4>
                <p class="admin-page-subtitle">For {{ $user->name }}</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.users.withdrawals.create', $user->id) }}" class="btn btn-admin-primary">
                    <i class="fas fa-plus me-1"></i> Add New Withdrawal
                </a>
                <a href="{{ route('admin.users.index') }}" class="btn btn-sm"
                    style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);">
                    <i class="fas fa-arrow-left me-1"></i> Back to Users
                </a>
            </div>
        </div>

        <div class="admin-card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="WithdrawalTable" class="admin-table">
                        <thead>
                            <tr>
                                <th>Amount</th>
                                <th>Type</th>
                                <th>Details</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($withdrawals as $withdrawal)
                            <tr>
                                <td>
                                    @if($withdrawal->account_type == 'crypto')
                                    {{ number_format($withdrawal->amount, 8) }} {{
                                    strtoupper($withdrawal->crypto_currency) }}
                                    @else
                                    ${{ number_format($withdrawal->amount, 2) }}
                                    @endif
                                </td>
                                <td>{{ ucfirst($withdrawal->account_type) }}</td>
                                <td>
                                    @if($withdrawal->account_type == 'crypto')
                                    {{ $withdrawal->wallet_address }}
                                    @else
                                    Bank Transfer
                                    @endif
                                </td>
                                <td>
                                    <span
                                        class="admin-badge-{{ $withdrawal->status == 'approved' ? 'success' : ($withdrawal->status == 'rejected' ? 'danger' : 'warning') }}">
                                        {{ ucfirst($withdrawal->status) }}
                                    </span>
                                </td>
                                <td>{{ $withdrawal->created_at->format('M d, Y H:i') }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('admin.users.withdrawals.edit', [$user->id, $withdrawal->id]) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <form
                                            action="{{ route('admin.users.withdrawals.destroy', [$user->id, $withdrawal->id]) }}"
                                            method="POST" class="d-inline" data-ajax-delete>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                        @if($withdrawal->status == 'pending')
                                        <form
                                            action="{{ route('admin.users.withdrawals.approve', [$user->id, $withdrawal->id]) }}"
                                            method="POST" class="d-inline" data-ajax-form>
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                        </form>
                                        <form
                                            action="{{ route('admin.users.withdrawals.reject', [$user->id, $withdrawal->id]) }}"
                                            method="POST" class="d-inline" data-ajax-form>
                                            @csrf
                                            <button type="submit" class="btn btn-sm"
                                                style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);">Reject</button>
                                        </form>
                                        @endif
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

@include('admin.footer')

<script>
    $(document).ready(function() {
    $('#WithdrawalTable').DataTable({
        order: [[4, 'desc']],
        responsive: true,
        language: { search: "", searchPlaceholder: "Search..." }
    });

    $('form[data-ajax-delete]').submit(function(e) {
        e.preventDefault();
        const form = $(this);
        const button = form.find('[type="submit"]');
        if(confirm('Are you sure you want to delete this withdrawal?')) {
            button.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span>');
            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: form.serialize(),
                success: function(response) {
                    if(response.status === 'success') {
                        toastr.success(response.message);
                        form.closest('tr').fadeOut(300, function() { $(this).remove(); });
                    }
                },
                error: function(xhr) {
                    toastr.error(xhr.responseJSON?.message || 'An error occurred');
                    button.prop('disabled', false).html('Delete');
                }
            });
        }
    });

    $('form[data-ajax-form]').submit(function(e) {
        e.preventDefault();
        const form = $(this);
        const button = form.find('[type="submit"]');
        const action = form.attr('action').includes('approve') ? 'approve' : 'reject';
        if(confirm(`Are you sure you want to ${action} this withdrawal?`)) {
            button.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span>');
            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: form.serialize(),
                success: function(response) {
                    if(response.status === 'success') {
                        toastr.success(response.message);
                        setTimeout(() => { window.location.reload(); }, 1500);
                    }
                },
                error: function(xhr) {
                    toastr.error(xhr.responseJSON?.message || 'An error occurred');
                    button.prop('disabled', false).text(action.charAt(0).toUpperCase() + action.slice(1));
                }
            });
        }
    });
});
</script>