@include('admin.header')

<div class="main-content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="admin-page-title">Add New Payment Method</h4>
                <p class="admin-page-subtitle">Create a new payment option</p>
            </div>
            <a href="{{ route('payment.settings') }}" class="btn btn-sm btn-outline-secondary"><i
                    class="fas fa-arrow-left me-1"></i> Back</a>
        </div>

        <div class="admin-card">
            <form method="POST" action="{{ route('payment.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    @include('admin.payment_settings._form')
                    <div class="col-12 mt-3">
                        <button type="submit" class="btn btn-admin-primary"><i class="fas fa-plus-circle me-1"></i> Save
                            Method</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@include('admin.footer')