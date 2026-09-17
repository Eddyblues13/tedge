@include('admin.header')

<div class="main-content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="admin-page-title">Available Stocks</h4>
                <p class="admin-page-subtitle">Manage stock listings</p>
            </div>
            <a class="btn btn-admin-primary" href="{{ route('add-stocks') }}"><i class="fas fa-plus-circle me-1"></i>
                New Stock</a>
        </div>

        <div class="row g-4">
            @foreach($stocks as $stock)
            <div class="col-md-6 col-lg-4">
                <div class="admin-card h-100">
                    <div class="text-center mb-3">
                        @if($stock->picture)
                        <img src="{{ asset('uploads/stock/'.$stock->picture) }}" alt="{{ $stock->stock_name }}"
                            class="rounded mb-2" style="max-width:100%;height:auto;">
                        @endif
                        <h5 style="color:var(--heading-color);">{{ $stock->stock_name }}</h5>
                    </div>
                    <div style="color:var(--text-color);font-size:0.9rem;">
                        <div class="d-flex justify-content-between mb-1"><span style="opacity:0.7;">Min
                                Amount:</span><span>{{ $stock->stock_min_amount }}</span></div>
                        <div class="d-flex justify-content-between mb-1"><span style="opacity:0.7;">Max
                                Amount:</span><span>{{ $stock->stock_max_amount }}</span></div>
                        <div class="d-flex justify-content-between mb-1"><span style="opacity:0.7;">ROI:</span><span>{{
                                $stock->copier_roi }}</span></div>
                        <div class="d-flex justify-content-between mb-1"><span
                                style="opacity:0.7;">Duration:</span><span>{{ $stock->investment_duration }}</span>
                        </div>
                        <div class="mt-2"><small style="opacity:0.7;">About:</small><br>{{ $stock->years_of_experience
                            }}</div>
                    </div>
                    <div class="d-flex justify-content-center gap-2 mt-3 pt-3 border-top"
                        style="border-color:var(--border-color) !important;">
                        <a href="{{ url('edit_stock/'.$stock->id) }}" class="btn btn-sm btn-admin-primary"><i
                                class="fa fa-edit"></i></a>
                        <a href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@include('admin.footer')