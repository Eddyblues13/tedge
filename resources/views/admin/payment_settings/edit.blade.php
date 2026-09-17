@include('admin.header')

<div class="main-content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="admin-page-title">Edit Payment Method</h4>
                <p class="admin-page-subtitle">Update payment method details</p>
            </div>
            <a href="{{ route('payment.settings') }}" class="btn btn-sm btn-outline-secondary"><i
                    class="fas fa-arrow-left me-1"></i> Back</a>
        </div>

        <div class="admin-card">
            <form method="POST" action="{{ route('payment.update', $payment->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row g-3">
                    @include('admin.payment_settings._form', ['payment' => $payment])
                    <div class="col-12 mt-3">
                        <button type="submit" class="btn btn-admin-primary"><i class="fas fa-save me-1"></i> Update
                            Method</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@include('admin.footer')