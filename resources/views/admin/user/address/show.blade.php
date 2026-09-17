@include('admin.header')

<div class="main-content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="admin-page-title">Address Verification #{{ $verification->id }}</h4>
                <p class="admin-page-subtitle">Review submitted address document</p>
            </div>
            <a href="{{ route('admin.users.address-verifications.index', $user->id) }}" class="btn btn-sm"
                style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);">
                <i class="fas fa-arrow-left me-1"></i> Back to List
            </a>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="admin-card">
                    <div class="card-body">
                        <h6 style="color:var(--heading-color);" class="mb-3">Bill</h6>
                        <div class="text-center">
                            <img src="{{ asset($verification->bill) }}" class="img-fluid rounded"
                                style="max-height:500px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="admin-card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <p style="color:var(--text-color);"><strong
                                        style="color:var(--heading-color);">Status:</strong>
                                    <span class="admin-badge-{{ $user->address_verification ? 'success' : 'danger' }}">
                                        {{ $user->address_verification ? 'Verified' : 'Not Verified' }}
                                    </span>
                                </p>
                            </div>
                            <div class="col-md-4">
                                <p style="color:var(--text-color);"><strong
                                        style="color:var(--heading-color);">Submitted At:</strong> {{
                                    $verification->created_at->format('M d, Y H:i') }}</p>
                            </div>
                            <div class="col-md-4">
                                <p style="color:var(--text-color);"><strong style="color:var(--heading-color);">Verified
                                        At:</strong>
                                    @if($verification->updated_at)
                                    {{ $verification->updated_at->format('M d, Y H:i') }}
                                    @else
                                    N/A
                                    @endif
                                </p>
                            </div>
                        </div>

                        @if($verification->status == 'rejected')
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <p style="color:var(--text-color);"><strong
                                        style="color:var(--heading-color);">Rejection Reason:</strong> {{
                                    $verification->rejection_reason }}</p>
                            </div>
                        </div>
                        @endif

                        <div class="row mt-4">
                            <div class="col-md-12 d-flex justify-content-end gap-2">
                                <form
                                    action="{{ route('admin.users.address-verifications.approve', [$user->id, $verification->id]) }}"
                                    method="POST" class="d-inline" data-ajax-form>
                                    @csrf
                                    <button type="submit" class="btn btn-success">Approve</button>
                                </form>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#rejectModal">Reject</button>
                                <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $verification->id }}">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reject Modal -->
        <div class="modal fade" id="rejectModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content"
                    style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);">
                    <div class="modal-header" style="border-color:var(--border-color);">
                        <h5 class="modal-title" style="color:var(--heading-color);">Reject Verification</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form
                        action="{{ route('admin.users.address-verifications.reject', [$user->id, $verification->id]) }}"
                        method="POST" data-ajax-form>
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label" style="color:var(--heading-color);">Reason for
                                    Rejection</label>
                                <textarea name="reason" class="admin-form-control" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer" style="border-color:var(--border-color);">
                            <button type="button" class="btn"
                                style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Confirm Rejection</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <div class="modal fade" id="deleteModal{{ $verification->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content"
                    style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);">
                    <div class="modal-header" style="border-color:var(--border-color);">
                        <h5 class="modal-title" style="color:var(--heading-color);">Confirm Deletion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form
                        action="{{ route('admin.users.address-verifications.destroy', [$user->id, $verification->id]) }}"
                        method="POST" data-ajax-form>
                        @csrf
                        @method('DELETE')
                        <div class="modal-body" style="color:var(--text-color);">
                            Are you sure you want to delete this verification record?
                        </div>
                        <div class="modal-footer" style="border-color:var(--border-color);">
                            <button type="button" class="btn"
                                style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-outline-danger">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.footer')

<script>
    $(document).ready(function() {
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