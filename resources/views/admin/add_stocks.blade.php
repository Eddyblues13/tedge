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
                <h4 class="admin-page-title">Add Stock</h4>
                <p class="admin-page-subtitle">Create a new stock listing</p>
            </div>
            <a href="{{ route('admin-stocks') }}" class="btn btn-sm btn-outline-secondary"><i
                    class="fas fa-arrow-left me-1"></i> Back</a>
        </div>

        <div class="admin-card">
            <form action="{{ route('save-stock') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Stock Name</label>
                        <input class="admin-form-control" placeholder="Enter stock name" type="text" name="stock_name"
                            required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Minimum Buying Amount ($)</label>
                        <input class="admin-form-control" placeholder="Enter minimum price" type="text"
                            name="stock_min_amount" required>
                        <small style="color:var(--text-color);opacity:0.7;">Minimum amount a user can pay</small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Maximum Buying Amount ($)</label>
                        <input class="admin-form-control" placeholder="Enter maximum price" type="text"
                            name="stock_max_amount" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Stock JS</label>
                        <input class="admin-form-control" placeholder="Paste stock JS" type="text" name="stock_js"
                            required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Stock Graph</label>
                        <input class="admin-form-control" placeholder="Stock graph" type="text" name="stock_graph"
                            required>
                    </div>

                    <input type="hidden" name="gift" value="0">

                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Top up Interval</label>
                        <select class="admin-form-control" name="top_up_interval">
                            <option value="Monthly">Monthly</option>
                            <option value="Weekly">Weekly</option>
                            <option value="Daily">Daily</option>
                            <option value="Hourly">Hourly</option>
                            <option value="Every 30 Minutes">Every 30 Minutes</option>
                        </select>
                        <small style="color:var(--text-color);opacity:0.7;">How often the system adds profit
                            (ROI)</small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Top up Type</label>
                        <select class="admin-form-control" name="top_up_type">
                            <option value="Percentage">Percentage</option>
                            <option value="Fixed">Fixed</option>
                        </select>
                        <small style="color:var(--text-color);opacity:0.7;">Profit in percentage (%) or fixed
                            amount</small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Top up Amount</label>
                        <input class="admin-form-control" placeholder="Top up amount" type="text" name="top_up_amount"
                            required>
                        <small style="color:var(--text-color);opacity:0.7;">Amount added as profit per interval</small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Investment Duration</label>
                        <select class="admin-form-control" name="investment_duration" required>
                            <option value="">Choose</option>
                            <option value="2 Weeks">2 Weeks</option>
                            <option value="1 Days">1 Day</option>
                            <option value="1 Weeks">1 Week</option>
                            <option value="1 Months">1 Month</option>
                            <option value="2 Months">2 Months</option>
                            <option value="1 years">1 Year</option>
                            <option value="3 Months">3 Months</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Status</label>
                        <select class="admin-form-control" name="top_up_status" required>
                            <option value="">Choose</option>
                            <option value="closed">Closed</option>
                            <option value="Open">Open</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Shares</label>
                        <input class="admin-form-control" placeholder="Enter shares" type="text" name="performance"
                            required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Volume</label>
                        <input class="admin-form-control" placeholder="Volume" type="text" name="copier_roi" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">About Stock</label>
                        <input class="admin-form-control" placeholder="Enter about stock" type="text"
                            name="years_of_experience" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Picture</label>
                        <input class="admin-form-control" type="file" name="image" required>
                    </div>
                    <div class="col-12 mt-3">
                        <button type="submit" class="btn btn-admin-primary"><i class="fas fa-plus-circle me-1"></i> Add
                            Stock</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@include('admin.footer')