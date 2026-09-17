@include('admin.header')

<div class="main-content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="admin-page-title">Expert Traders</h4>
                <p class="admin-page-subtitle">Manage copy trading experts</p>
            </div>
            <a href="{{ url('add-trader') }}" class="btn btn-admin-primary"><i class="fas fa-plus-circle me-1"></i> New
                Plan</a>
        </div>

        <div class="row g-4">
            @foreach($traders as $trader)
            <div class="col-md-6 col-lg-4">
                <div class="admin-card h-100">
                    <div class="text-center mb-3">
                        @if($trader->picture)
                        <img src="{{ asset('uploads/trader/'.$trader->picture) }}" alt="{{ $trader->trader_name }}"
                            class="rounded-circle mb-2" style="width:80px;height:80px;object-fit:cover;">
                        @endif
                        <h6 style="color:var(--heading-color);">{{ $trader->trader_name }}</h6>
                        <small style="color:var(--text-color);opacity:0.7;">Expert Trader</small>
                    </div>
                    <div style="color:var(--text-color);font-size:0.9rem;">
                        <div class="d-flex justify-content-between mb-1"><span
                                style="opacity:0.7;">Experience:</span><span>{{ $trader->trader_year_of_experience
                                }}</span></div>
                        <div class="d-flex justify-content-between mb-1"><span style="opacity:0.7;">Active
                                Traders:</span><span>{{ $trader->active_traders }}</span></div>
                        <div class="d-flex justify-content-between mb-1"><span style="opacity:0.7;">Total
                                Copied:</span><span>{{ $trader->total_copied_trade }}</span></div>
                        <div class="d-flex justify-content-between mb-1"><span style="opacity:0.7;">Copiers
                                ROI:</span><span>{{ $trader->copier_roi }}</span></div>
                        <div class="d-flex justify-content-between mb-1"><span style="opacity:0.7;">Risk
                                Index:</span><span>{{ $trader->risk_index }}</span></div>
                        <div class="d-flex justify-content-between mb-1"><span
                                style="opacity:0.7;">Performance:</span><span>{{ $trader->performance }}</span></div>
                        <div class="d-flex justify-content-between mb-1"><span
                                style="opacity:0.7;">Country:</span><span>{{ $trader->trader_country }}</span></div>
                        <div class="d-flex justify-content-between mb-1"><span
                                style="opacity:0.7;">Duration:</span><span>{{ $trader->investment_duration }}</span>
                        </div>
                        <div class="mt-2"><small style="opacity:0.7;">About:</small><br>{{ $trader->about_trader }}
                        </div>
                    </div>
                    <div class="d-flex justify-content-center gap-2 mt-3 pt-3 border-top"
                        style="border-color:var(--border-color) !important;">
                        <a href="{{ url('edit_trader/'.$trader->id) }}" class="btn btn-sm btn-admin-primary"><i
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