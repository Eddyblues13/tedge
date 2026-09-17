@include('admin.header')

<div class="main-content">
    <div class="container-fluid">
        {{-- Page Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="admin-page-title">MT4 Subscription Settings</h4>
                <p class="admin-page-subtitle">Configure subscription service and fee settings</p>
            </div>
        </div>

        {{-- Success/Error Alerts --}}
        <div id="alertContainer"></div>

        {{-- Subscription Settings Card --}}
        <div class="admin-card p-4">
            <form id="subform">
                @csrf
                <input type="hidden" name="id" value="1">

                {{-- Subscription Service Toggle --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold" style="color:var(--heading-color);">Subscription
                        Service</label>
                    <div class="d-flex gap-4 mt-2">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="subscription_service" id="subscriptonoff"
                                value="on">
                            <label class="form-check-label" for="subscriptonoff"
                                style="color:var(--text-color);">On</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="subscription_service"
                                id="subscriptonoff2" value="off">
                            <label class="form-check-label" for="subscriptonoff2"
                                style="color:var(--text-color);">Off</label>
                        </div>
                    </div>
                </div>

                {{-- Monthly Fee --}}
                <div class="mb-3">
                    <label for="monthlyfee" class="form-label" style="color:var(--heading-color);">Monthly Fee
                        ($)</label>
                    <input type="number" class="form-control admin-form-control" id="monthlyfee" name="monthlyfee"
                        value="30" step="0.01" min="0">
                </div>

                {{-- Quarterly Fee --}}
                <div class="mb-3">
                    <label for="quaterlyfee" class="form-label" style="color:var(--heading-color);">Quarterly Fee
                        ($)</label>
                    <input type="number" class="form-control admin-form-control" id="quaterlyfee" name="quaterlyfee"
                        value="40" step="0.01" min="0">
                </div>

                {{-- Yearly Fee --}}
                <div class="mb-3">
                    <label for="yearlyfee" class="form-label" style="color:var(--heading-color);">Yearly Fee ($)</label>
                    <input type="number" class="form-control admin-form-control" id="yearlyfee" name="yearlyfee"
                        value="80" step="0.01" min="0">
                </div>

                {{-- Submit --}}
                <div class="mt-4">
                    <button type="submit" class="btn btn-admin-primary px-4" id="submitBtn">
                        <i class="fas fa-save me-1"></i> Save Settings
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Set default subscription state to On
    document.getElementById("subscriptonoff").checked = true;

    $('#subform').on('submit', function(e) {
        e.preventDefault();

        let btn = $('#submitBtn');
        let originalText = btn.html();
        btn.html('<span class="spinner-border spinner-border-sm me-1"></span> Saving...').prop('disabled', true);

        $.ajax({
            url: "{{ url('account/admin/dashboard/updatesubfee') }}",
            type: "POST",
            data: $('#subform').serialize(),
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(response) {
                toastr.success('Subscription settings updated successfully!');
            },
            error: function(xhr) {
                toastr.error('Failed to update subscription settings. Please try again.');
            },
            complete: function() {
                btn.html(originalText).prop('disabled', false);
            }
        });
    });
</script>

@include('admin.footer')