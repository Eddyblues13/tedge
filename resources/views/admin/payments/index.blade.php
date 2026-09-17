@include('admin.header')

<div class="main-content">
    <div class="container-fluid">
        @if(session('message'))
        <div class="alert alert-success alert-dismissible fade show">{{ session('message') }}<button type="button"
                class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="admin-page-title">Payment Methods</h4>
                <p class="admin-page-subtitle">Manage cryptocurrency payment options</p>
            </div>
            <a href="{{ route('payment.create') }}" class="btn btn-admin-primary"><i
                    class="fas fa-plus-circle me-1"></i> Add New</a>
        </div>

        @if($payments->isEmpty())
        <div class="admin-card text-center py-5">
            <i class="fas fa-wallet fa-3x mb-3" style="color:var(--text-color);opacity:0.3;"></i>
            <h5 style="color:var(--heading-color);">No payment methods found</h5>
        </div>
        @else
        <div class="row g-4">
            @foreach($payments as $payment)
            <div class="col-md-6 col-lg-4">
                <div class="admin-card h-100"
                    style="border-left: 3px solid {{ $payment->status === 'enabled' ? '#10b981' : '#ef4444' }};">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center gap-2">
                            @if($payment->icon)
                            <img src="{{ asset('storage/' . $payment->icon) }}" alt="{{ $payment->wallet_name }}"
                                style="max-height:28px;max-width:28px;">
                            @endif
                            <strong style="color:var(--heading-color);">{{ $payment->wallet_name }}</strong>
                        </div>
                        <span class="admin-badge-{{ $payment->status === 'enabled' ? 'success' : 'danger' }}">{{
                            ucfirst($payment->status) }}</span>
                    </div>
                    <div style="color:var(--text-color);font-size:0.9rem;">
                        <div class="mb-1"><small style="opacity:0.7;">Coin Code:</small><br>{{ $payment->coin_code }}
                        </div>
                        <div class="mb-1"><small style="opacity:0.7;">Coin Name:</small><br>{{ $payment->coin_name }}
                        </div>
                        <div class="mb-1"><small style="opacity:0.7;">Wallet Type:</small><br>{{ $payment->wallet_type
                            }}</div>
                        <div class="mb-1"><small style="opacity:0.7;">Network:</small><br>{{
                            ucfirst($payment->network_type) }}</div>
                        <div class="mb-1"><small style="opacity:0.7;">Address:</small><br><span
                                class="text-truncate d-block" style="max-width:100%;">{{ $payment->wallet_address
                                }}</span></div>
                    </div>
                    <div class="d-flex justify-content-between mt-3 pt-3 border-top"
                        style="border-color:var(--border-color) !important;">
                        <a href="{{ route('payment.edit', $payment->id) }}" class="btn btn-sm btn-admin-primary"><i
                                class="fa fa-edit me-1"></i>Edit</a>
                        @if(in_array($payment->wallet_name, ['Ethereum', 'Bitcoin', 'Litecoin']))
                        <button class="btn btn-sm btn-outline-secondary" disabled>Default</button>
                        @else
                        <form action="{{ route('payment.destroy', $payment->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit"
                                onclick="return confirm('Delete this payment method?')"><i
                                    class="fa fa-trash me-1"></i>Delete</button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>

@include('admin.footer')