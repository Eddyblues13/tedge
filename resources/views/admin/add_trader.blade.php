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
                <h4 class="admin-page-title">Add Expert Trader</h4>
                <p class="admin-page-subtitle">Create a new copy trading expert</p>
            </div>
            <a href="{{ url('admin/copy-trader') }}" class="btn btn-sm btn-outline-secondary"><i
                    class="fas fa-arrow-left me-1"></i> Back</a>
        </div>

        <div class="admin-card">
            <form action="{{ url('add-expert') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Trader Name</label>
                        <input class="admin-form-control" placeholder="Enter trader name" type="text" name="trader_name"
                            required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Trading Minimum Amount ($)</label>
                        <input class="admin-form-control" placeholder="Enter minimum price" type="text"
                            name="trading_min_amount" required>
                        <small style="color:var(--text-color);opacity:0.7;">Minimum amount a user can pay to copy this
                            trader</small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Trading Maximum Amount ($)</label>
                        <input class="admin-form-control" placeholder="Enter maximum price" type="text"
                            name="trading_max_amount" required>
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
                        <small style="color:var(--text-color);opacity:0.7;">How often the system adds profit (ROI) to
                            user account</small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Top up Type</label>
                        <select class="admin-form-control" name="top_up_type">
                            <option value="Percentage">Percentage</option>
                            <option value="Fixed">Fixed</option>
                        </select>
                        <small style="color:var(--text-color);opacity:0.7;">Add profit in percentage (%) or fixed
                            amount</small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Top up Amount (in % or $ as
                            specified above)</label>
                        <input class="admin-form-control" placeholder="Top up amount" type="text" name="top_up_amount"
                            required>
                        <small style="color:var(--text-color);opacity:0.7;">Amount the system adds as profit based on
                            topup type and interval</small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Investment Duration</label>
                        <select class="admin-form-control" name="investment_duration" required>
                            <option value="">Choose</option>
                            <option value="2 Weeks">2 Weeks</option>
                            <option value="1 Day">1 Day</option>
                            <option value="1 Week">1 Week</option>
                            <option value="1 Month">1 Month</option>
                            <option value="2 Months">2 Months</option>
                            <option value="1 Year">1 Year</option>
                            <option value="3 Months">3 Months</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Years of Experience</label>
                        <input class="admin-form-control" placeholder="Enter years of experience" type="text"
                            name="trader_year_of_experience" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Return Rate (Copier ROI)</label>
                        <input class="admin-form-control" placeholder="Enter copier ROI" type="text" name="copier_roi"
                            required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Profit Share (Risk Index)</label>
                        <input class="admin-form-control" placeholder="Enter risk index" type="text" name="risk_index"
                            required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Performance</label>
                        <input class="admin-form-control" placeholder="Enter trader performance" type="text"
                            name="performance" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Total Copied Traders</label>
                        <input class="admin-form-control" placeholder="Enter total copied traders" type="text"
                            name="total_copied_trade" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Active Traders</label>
                        <input class="admin-form-control" placeholder="Enter active traders" type="text"
                            name="active_traders" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Trader Country</label>
                        <input class="admin-form-control" placeholder="Enter trader country" type="text"
                            name="trader_country" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">About Trader</label>
                        <input class="admin-form-control" placeholder="Enter about trader" type="text"
                            name="about_trader" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Picture</label>
                        <input class="admin-form-control" type="file" name="image" required>
                    </div>
                    <div class="col-12 mt-3">
                        <button type="submit" class="btn btn-admin-primary"><i class="fas fa-plus-circle me-1"></i> Add
                            Trader</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@include('admin.footer')