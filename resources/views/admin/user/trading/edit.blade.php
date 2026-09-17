@include('admin.header')

<div class="main-content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="admin-page-title">Edit Trading History</h4>
                <p class="admin-page-subtitle">For {{ $user->name }}</p>
            </div>
            <a href="{{ route('admin.users.trading-histories.index', $user->id) }}" class="btn btn-sm"
                style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);">
                <i class="fas fa-arrow-left me-1"></i> Back
            </a>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="admin-card">
                    <div class="card-body">
                        <form id="editHistoryForm" method="POST"
                            action="{{ route('admin.users.trading-histories.update', [$user->id, $history->id]) }}">
                            @csrf
                            @method('PUT')

                            <div id="formErrors" class="alert alert-danger d-none"></div>

                            <div class="mb-3">
                                <label class="form-label" style="color:var(--heading-color);">Trader</label>
                                <select name="trader_id" class="admin-form-control" required>
                                    @foreach($traders as $trader)
                                    <option value="{{ $trader->id }}" {{ $history->trader_id == $trader->id ? 'selected'
                                        : '' }}>{{ $trader->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" style="color:var(--heading-color);">Amount</label>
                                <input type="number" step="0.01" name="amount" class="admin-form-control"
                                    value="{{ $history->amount }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" style="color:var(--heading-color);">Status</label>
                                <select name="status" class="admin-form-control" required>
                                    <option value="pending" {{ $history->status == 'pending' ? 'selected' : ''
                                        }}>Pending</option>
                                    <option value="completed" {{ $history->status == 'completed' ? 'selected' : ''
                                        }}>Completed</option>
                                    <option value="failed" {{ $history->status == 'failed' ? 'selected' : '' }}>Failed
                                    </option>
                                </select>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-admin-primary">Update History</button>
                                <a href="{{ route('admin.users.trading-histories.index', $user->id) }}" class="btn"
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
    $('#editHistoryForm').submit(function(e) {
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
                submitBtn.prop('disabled', false).html('Update History');
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