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
                <h4 class="admin-page-title">Update Trader</h4>
                <p class="admin-page-subtitle">Edit expert trader details</p>
            </div>
            <a href="{{ url('admin/copy-trader') }}" class="btn btn-sm btn-outline-secondary"><i
                    class="fas fa-arrow-left me-1"></i> Back</a>
        </div>

        <div class="admin-card">
            <form action="{{ url('update-trader/'.$trader->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Trader Name</label>
                        <input class="admin-form-control" value="{{ $trader->trader_name }}" type="text"
                            name="trader_name" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Trading Minimum Amount ($)</label>
                        <input class="admin-form-control" value="{{ $trader->trading_min_amount }}" type="text"
                            name="trading_min_amount" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Trading Maximum Amount ($)</label>
                        <input class="admin-form-control" value="{{ $trader->trading_max_amount }}" type="text"
                            name="trading_max_amount" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Active Traders</label>
                        <input class="admin-form-control" value="{{ $trader->active_traders }}" type="text"
                            name="active_traders" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Total Copied Traders</label>
                        <input class="admin-form-control" value="{{ $trader->total_copied_trade }}" type="text"
                            name="total_copied_trade" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Years of Experience</label>
                        <input class="admin-form-control" value="{{ $trader->trader_year_of_experience }}" type="text"
                            name="trader_year_of_experience" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Performance</label>
                        <input class="admin-form-control" value="{{ $trader->performance }}" type="text"
                            name="performance" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Return Rate (Copier ROI)</label>
                        <input class="admin-form-control" value="{{ $trader->copier_roi }}" type="text"
                            name="copier_roi" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Profit Share (Risk Index)</label>
                        <input class="admin-form-control" value="{{ $trader->risk_index }}" type="text"
                            name="risk_index" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Country</label>
                        <input class="admin-form-control" value="{{ $trader->trader_country }}" type="text"
                            name="trader_country" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">About Trader</label>
                        <textarea rows="4" class="admin-form-control" name="about_trader"
                            required>{{ $trader->about_trader }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Top up Interval</label>
                        <select class="admin-form-control" name="top_up_interval">
                            <option value="{{ $trader->top_up_interval }}">{{ $trader->top_up_interval }}</option>
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
                            <option value="{{ $trader->top_up_type }}">{{ $trader->top_up_type }}</option>
                            <option value="Percentage">Percentage</option>
                            <option value="Fixed">Fixed</option>
                        </select>
                        <small style="color:var(--text-color);opacity:0.7;">Add profit in percentage (%) or fixed
                            amount</small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Top up Amount (in % or $ as
                            specified above)</label>
                        <input class="admin-form-control" value="{{ $trader->top_up_amount }}"
                            placeholder="Top up amount" type="text" name="top_up_amount" required>
                        <small style="color:var(--text-color);opacity:0.7;">Amount the system adds as profit</small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Investment Duration</label>
                        <input class="admin-form-control" value="{{ $trader->investment_duration }}"
                            placeholder="e.g. 1 Days, 2 Weeks, 1 Months" type="text" name="investment_duration"
                            required>
                        <small style="color:var(--text-color);opacity:0.7;">How long the copied trader will run. <a
                                href="#" data-bs-toggle="modal" data-bs-target="#durationModal">Duration
                                guide</a></small>
                    </div>
                    <div class="col-12 mt-3">
                        <button type="submit" class="btn btn-admin-primary"><i class="fas fa-save me-1"></i> Update
                            Trader</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Duration Guide Modal -->
<div class="modal fade" id="durationModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content"
            style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);">
            <div class="modal-header" style="border-color:var(--border-color);">
                <h5 class="modal-title" style="color:var(--heading-color);">Duration Setup Guide</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Always precede the time frame with a digit (don't write numbers in letters).</p>
                <p>Always add a space after the number.</p>
                <p>The first letter of the timeframe should be in CAPS and always add 's' even if duration is just 1.
                </p>
                <h6 style="color:var(--heading-color);">Examples: 1 Days, 3 Weeks, 1 Hours, 48 Hours, 4 Months, 1 Years
                </h6>
            </div>
        </div>
    </div>
</div>

@include('admin.footer')