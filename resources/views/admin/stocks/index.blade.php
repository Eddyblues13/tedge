@include('admin.header')

<div class="main-content">
    <div class="container-fluid">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}<button type="button"
                class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="admin-page-title">Available Stocks</h4>
                <p class="admin-page-subtitle">Manage stock investment options</p>
            </div>
            <a href="{{ route('stock.create') }}" class="btn btn-admin-primary"><i class="fas fa-plus-circle me-1"></i>
                Add New Stock</a>
        </div>

        <div class="row g-4">
            @foreach($stocks as $stock)
            <div class="col-md-6 col-lg-4">
                <div class="admin-card h-100">
                    <div class="text-center mb-3">
                        <strong style="color:var(--heading-color);font-size:1.15rem;">{{ $stock->stock_name }}</strong>
                    </div>
                    <div style="color:var(--text-color);font-size:0.9rem;">
                        <div class="d-flex justify-content-between mb-1"><span style="opacity:0.7;">Max
                                Investment:</span><span>${{ $stock->stock_max_amount }}</span></div>
                        <div class="d-flex justify-content-between mb-1"><span style="opacity:0.7;">Min
                                Investment:</span><span>${{ $stock->stock_min_amount }}</span></div>
                        <div class="d-flex justify-content-between mb-1"><span style="opacity:0.7;">Top-up
                                Amount:</span><span>${{ $stock->top_up_amount }}</span></div>
                        <div class="d-flex justify-content-between mb-1"><span style="opacity:0.7;">Top-up
                                Interval:</span><span>{{ $stock->top_up_interval }}</span></div>
                        <div class="d-flex justify-content-between mb-1"><span style="opacity:0.7;">Top-up
                                Type:</span><span>{{ $stock->top_up_type }}</span></div>
                        <div class="d-flex justify-content-between mb-1"><span
                                style="opacity:0.7;">Duration:</span><span>{{ $stock->investment_duration }}
                                months</span></div>
                        <div class="d-flex justify-content-between mb-1"><span
                                style="opacity:0.7;">Performance:</span><span>{{ $stock->performance }}</span></div>
                        <div class="d-flex justify-content-between mb-1"><span style="opacity:0.7;">Copier
                                ROI:</span><span>{{ $stock->copier_roi }}%</span></div>
                        <div class="d-flex justify-content-between mb-1"><span
                                style="opacity:0.7;">Experience:</span><span>{{ $stock->years_of_experience }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-1"><span style="opacity:0.7;">Top-up
                                Status:</span>
                            <span class="admin-badge-{{ $stock->top_up_status ? 'success' : 'danger' }}">{{
                                $stock->top_up_status ? 'Active' : 'Inactive' }}</span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center gap-2 mt-3 pt-3 border-top"
                        style="border-color:var(--border-color) !important;">
                        <a href="{{ route('stock.edit', $stock->id) }}" class="btn btn-sm btn-admin-primary"><i
                                class="fa fa-edit me-1"></i>Edit</a>
                        <form action="{{ route('stock.destroy', $stock->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure?')"><i
                                    class="fa fa-trash me-1"></i>Delete</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@include('admin.footer')