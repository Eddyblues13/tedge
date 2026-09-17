@include('admin.header')

<div class="main-content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="admin-page-title">Deposit Proof</h4>
                <p class="admin-page-subtitle">View payment screenshot</p>
            </div>
            <a class="btn btn-sm btn-outline-secondary" href="{{ url('admin/manage-deposit') }}"><i
                    class="fas fa-arrow-left me-1"></i> Back</a>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="admin-card text-center">
                    <img src="{{ asset($proof->proof) }}" alt="Proof of Payment" class="img-fluid rounded"
                        style="max-width:100%;">
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.footer')