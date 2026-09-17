@include('admin.header')

<div class="main-content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="admin-page-title">Referral/Bonus Settings</h4>
                <p class="admin-page-subtitle">Configure referral commissions and registration bonus</p>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="admin-card">
                    <form method="post" action="javascript:void(0)" id="refform">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label" style="color:var(--heading-color);">Direct Referral Commission
                                    (%)</label>
                                <input type="text" class="admin-form-control" name="ref_commission" value="40" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" style="color:var(--heading-color);">Indirect Referral
                                    Commission 1 (%)</label>
                                <input type="text" class="admin-form-control" name="ref_commission1" value="30"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" style="color:var(--heading-color);">Indirect Referral
                                    Commission 2 (%)</label>
                                <input type="text" class="admin-form-control" name="ref_commission2" value="20"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" style="color:var(--heading-color);">Indirect Referral
                                    Commission 3 (%)</label>
                                <input type="text" class="admin-form-control" name="ref_commission3" value="10"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" style="color:var(--heading-color);">Indirect Referral
                                    Commission 4 (%)</label>
                                <input type="text" class="admin-form-control" name="ref_commission4" value="5" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" style="color:var(--heading-color);">Indirect Referral
                                    Commission 5 (%)</label>
                                <input type="text" class="admin-form-control" name="ref_commission5" value="1" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" style="color:var(--heading-color);">Registration Bonus
                                    ($)</label>
                                <input type="text" class="admin-form-control" name="signup_bonus" value="0" required>
                            </div>
                            <input type="hidden" name="id" value="1">
                            <div class="col-12 mt-3">
                                <button type="submit" class="btn btn-admin-primary"><i class="fas fa-save me-1"></i>
                                    Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#refform').on('submit', function() {
    $.ajax({
        url: "account/admin/dashboard/update-bonus",
        type: 'POST',
        data: $('#refform').serialize(),
        success: function(response) {
            if (response.status === 200) {
                toastr.success(response.success);
            }
        },
        error: function(error) {
            console.log(error);
        },
    });
});
</script>

@include('admin.footer')