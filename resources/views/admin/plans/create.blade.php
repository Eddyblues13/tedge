@include('admin.header')

<div class="main-content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="admin-page-title">Create New Plan</h4>
                <p class="admin-page-subtitle">Add a new subscription plan</p>
            </div>
            <a href="{{ route('admin.plans.index') }}" class="btn btn-sm btn-outline-secondary"><i
                    class="fas fa-arrow-left me-1"></i> Back</a>
        </div>

        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="admin-card">
                    <form id="createPlanForm" method="POST" action="{{ route('admin.plans.store') }}">
                        @csrf
                        <div id="formErrors" class="alert alert-danger d-none"></div>
                        <div class="mb-3">
                            <label class="form-label" style="color:var(--heading-color);">Plan Name</label>
                            <input type="text" name="name" class="admin-form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color:var(--heading-color);">Price ($)</label>
                            <input type="number" step="0.01" name="price" class="admin-form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color:var(--heading-color);">Swap Fee</label>
                            <select name="swap_fee" class="admin-form-control">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color:var(--heading-color);">Number of Trading
                                Pairs</label>
                            <input type="number" name="pairs" class="admin-form-control" value="76" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color:var(--heading-color);">Leverage (optional)</label>
                            <input type="text" name="leverage" class="admin-form-control" placeholder="e.g. 1:500">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color:var(--heading-color);">Spread (optional)</label>
                            <input type="text" name="spread" class="admin-form-control" placeholder="e.g. 0.8 pips">
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-admin-primary">Create Plan</button>
                            <a href="{{ route('admin.plans.index') }}" class="btn btn-outline-secondary">Cancel</a>
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
    $('#createPlanForm').submit(function(e) {
        e.preventDefault();
        const form = $(this); const submitBtn = form.find('[type="submit"]'); const errorContainer = $('#formErrors');
        errorContainer.addClass('d-none').empty();
        submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Creating...');
        $.ajax({
            url: form.attr('action'), type: 'POST', data: form.serialize(),
            success: function(response) { if(response.status === 'success') { toastr.success(response.message); setTimeout(() => { window.location.href = response.redirect; }, 1500); } },
            error: function(xhr) {
                submitBtn.prop('disabled', false).html('Create Plan');
                if(xhr.status === 422) {
                    let html = '<ul class="mb-0">'; $.each(xhr.responseJSON.errors, function(k, v) { html += '<li>' + v[0] + '</li>'; }); html += '</ul>';
                    errorContainer.html(html).removeClass('d-none');
                } else { toastr.error(xhr.responseJSON?.message || 'An error occurred'); }
            }
        });
    });
});
</script>