@include('admin.header')

<div class="main-content">
    <div class="container-fluid">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-3">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="admin-page-title">Identity Verifications</h4>
                <p class="admin-page-subtitle">For {{ $user->name }}</p>
            </div>
            <a href="{{ route('admin.users.index') }}" class="btn btn-sm"
                style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);">
                <i class="fas fa-arrow-left me-1"></i> Back to Users
            </a>
        </div>

        <div class="admin-card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="VerificationTable" class="admin-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Status</th>
                                <th>Submitted At</th>
                                <th>Verified At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($verifications as $verification)
                            <tr>
                                <td>#{{ $verification->id }}</td>
                                <td>
                                    <span class="admin-badge-{{ $user->id_verification ? 'success' : 'danger' }}">
                                        {{ $user->id_verification ? 'Verified' : 'Not Verified' }}
                                    </span>
                                </td>
                                <td>{{ $verification->created_at->format('M d, Y H:i') }}</td>
                                <td>
                                    @if($verification->updated_at)
                                    {{ $verification->updated_at->format('M d, Y H:i') }}
                                    @else
                                    N/A
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.users.identity-verifications.show', [$user->id, $verification->id]) }}"
                                        class="btn btn-sm btn-info">View</a>
                                    @if($user->id_verification)
                                    <form
                                        action="{{ route('admin.users.identity-verifications.approve', [$user->id, $verification->id]) }}"
                                        method="POST" class="d-inline ms-1" data-ajax-form>
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                    </form>
                                    <button type="button" class="btn btn-sm btn-danger ms-1" data-bs-toggle="modal"
                                        data-bs-target="#rejectModal{{ $verification->id }}">Reject</button>

                                    <!-- Reject Modal -->
                                    <div class="modal fade" id="rejectModal{{ $verification->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content"
                                                style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);">
                                                <div class="modal-header" style="border-color:var(--border-color);">
                                                    <h5 class="modal-title" style="color:var(--heading-color);">Reject
                                                        Verification</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <form
                                                    action="{{ route('admin.users.identity-verifications.reject', [$user->id, $verification->id]) }}"
                                                    method="POST" data-ajax-form>
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                style="color:var(--heading-color);">Reason for
                                                                Rejection</label>
                                                            <textarea name="reason" class="admin-form-control" rows="3"
                                                                required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer" style="border-color:var(--border-color);">
                                                        <button type="button" class="btn"
                                                            style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-danger">Confirm
                                                            Rejection</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
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

@include('admin.footer')

<script>
    $(document).ready(function() {
    $('#VerificationTable').DataTable({
        order: [[2, 'desc']],
        responsive: true,
        language: { search: "", searchPlaceholder: "Search..." }
    });

    $('form[data-ajax-form]').submit(function(e) {
        e.preventDefault();
        const form = $(this);
        const button = form.find('[type="submit"]');
        button.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Processing...');
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
                button.prop('disabled', false).text('Submit');
            }
        });
    });
});
</script>