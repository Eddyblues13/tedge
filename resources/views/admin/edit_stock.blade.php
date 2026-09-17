@include('admin.header')

<div class="main-content">
    <div class="container-fluid">
        @if(session('message'))
        <div class="alert alert-success alert-dismissible fade show mb-3">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="admin-page-title">Update Stock</h4>
                <p class="admin-page-subtitle">Edit stock details</p>
            </div>
            <a href="{{ route('admin-stocks') }}" class="btn btn-sm btn-outline-secondary"><i
                    class="fas fa-arrow-left me-1"></i> Back</a>
        </div>

        <div class="admin-card">
            <form action="{{ url('update-stock/'.$stock->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Stock Name</label>
                        <input class="admin-form-control" value="{{ $stock->stock_name }}" type="text" name="stock_name"
                            required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Minimum Amount ($)</label>
                        <input class="admin-form-control" value="{{ $stock->stock_min_amount }}" type="text"
                            name="stock_min_amount" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Maximum Amount ($)</label>
                        <input class="admin-form-control" value="{{ $stock->stock_max_amount }}" type="text"
                            name="stock_max_amount" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Status</label>
                        <select class="admin-form-control" name="top_up_status" required>
                            <option value="{{ $stock->top_up_status }}">{{ $stock->top_up_status }}</option>
                            <option value="closed">Closed</option>
                            <option value="Open">Open</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Shares</label>
                        <input class="admin-form-control" value="{{ $stock->performance }}" type="text"
                            name="performance" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Volume</label>
                        <input class="admin-form-control" value="{{ $stock->copier_roi }}" type="text" name="copier_roi"
                            required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">About Stock</label>
                        <textarea rows="4" class="admin-form-control" name="years_of_experience"
                            required>{{ $stock->years_of_experience }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Top up Interval</label>
                        <select class="admin-form-control" name="top_up_interval">
                            <option value="{{ $stock->top_up_interval }}">{{ $stock->top_up_interval }}</option>
                            <option value="Monthly">Monthly</option>
                            <option value="Weekly">Weekly</option>
                            <option value="Daily">Daily</option>
                            <option value="Hourly">Hourly</option>
                            <option value="30 Minutes">Every 30 Minutes</option>
                        </select>
                        <small style="color:var(--text-color);opacity:0.7;">How often the system adds profit
                            (ROI)</small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Top up Type</label>
                        <select class="admin-form-control" name="top_up_type">
                            <option value="{{ $stock->top_up_type }}">{{ $stock->top_up_type }}</option>
                            <option value="Percentage">Percentage</option>
                            <option value="Fixed">Fixed</option>
                        </select>
                        <small style="color:var(--text-color);opacity:0.7;">Profit in percentage (%) or fixed
                            amount</small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Top up Amount</label>
                        <input class="admin-form-control" value="{{ $stock->top_up_amount }}" type="text"
                            name="top_up_amount" required>
                        <small style="color:var(--text-color);opacity:0.7;">Amount added as profit per interval</small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Investment Duration</label>
                        <input class="admin-form-control" value="{{ $stock->investment_duration }}"
                            placeholder="e.g. 1 Day, 2 Weeks, 1 Month" type="text" name="investment_duration" required>
                        <small style="color:var(--text-color);opacity:0.7;">How long the stock investment will
                            run</small>
                    </div>
                    <div class="col-12 mt-3">
                        <button type="submit" class="btn btn-admin-primary"><i class="fas fa-save me-1"></i> Update
                            Stock</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@include('admin.footer')