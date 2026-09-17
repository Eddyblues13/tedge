@include('admin.header')

<div class="main-content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="admin-page-title">Add Trading History</h4>
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
                        <form id="createHistoryForm" method="POST"
                            action="{{ route('admin.users.trading-histories.store', $user->id) }}">
                            @csrf

                            <div id="formErrors" class="alert alert-danger d-none"></div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" style="color:var(--heading-color);">Trader</label>
                                    <select name="trader_name" class="admin-form-control" required>
                                        <option value="">Select Trader</option>
                                        @foreach($traders as $trader)
                                        <option value="{{ $trader->name }}">{{ $trader->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" style="color:var(--heading-color);">Symbol</label>
                                    <input type="text" name="symbol" class="admin-form-control" placeholder="e.g. BTCUSDT, TSLA, EURUSD" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" style="color:var(--heading-color);">Direction</label>
                                    <select name="direction" class="admin-form-control" required>
                                        <option value="up">Long (UP)</option>
                                        <option value="down">Short (DOWN)</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" style="color:var(--heading-color);">Status</label>
                                    <select name="status" class="admin-form-control" id="formStatus" required>
                                        <option value="active">Active</option>
                                        <option value="closed">Closed</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" style="color:var(--heading-color);">Amount</label>
                                    <input type="number" step="0.01" name="amount" class="admin-form-control" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" style="color:var(--heading-color);">Entry Price</label>
                                    <input type="number" step="0.0001" name="entry_price" class="admin-form-control" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" style="color:var(--heading-color);">Profit</label>
                                    <input type="number" step="0.01" name="profit" class="admin-form-control" placeholder="0.00" required>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" style="color:var(--heading-color);">Entry Date</label>
                                    <input type="datetime-local" class="admin-form-control" name="entry_date" required>
                                </div>
                                <div class="col-md-6 mb-3 form-closed-field" style="display:none;">
                                    <label class="form-label" style="color:var(--heading-color);">Exit Price</label>
                                    <input type="number" step="0.0001" name="exit_price" class="admin-form-control">
                                </div>
                                <div class="col-md-6 mb-3 form-closed-field" style="display:none;">
                                    <label class="form-label" style="color:var(--heading-color);">Exit Date</label>
                                    <input type="datetime-local" name="exit_date" class="admin-form-control">
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-admin-primary">Create History</button>
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
    document.getElementById('formStatus').addEventListener('change', function() {
        const isClosed = this.value === 'closed';
        document.querySelectorAll('.form-closed-field').forEach(field => {
            field.style.display = isClosed ? 'block' : 'none';
        });
    });

    $(document).ready(function() {
    $('#createHistoryForm').submit(function(e) {
        e.preventDefault();
        const form = $(this);
        const submitBtn = form.find('[type="submit"]');
        const errorContainer = $('#formErrors');
        errorContainer.addClass('d-none').empty();
        submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Creating...');
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
                submitBtn.prop('disabled', false).html('Create History');
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