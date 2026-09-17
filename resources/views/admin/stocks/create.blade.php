@include('admin.header')

<div class="main-content">
    <div class="container-fluid">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}<button type="button"
                class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul><button
                type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="admin-page-title">Add Stock</h4>
                <p class="admin-page-subtitle">Create a new stock investment option</p>
            </div>
            <a href="{{ route('stock.index') }}" class="btn btn-outline-secondary"><i
                    class="fas fa-arrow-left me-1"></i> Back</a>
        </div>

        <div class="admin-card">
            <form action="{{ route('stock.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Stock Name</label>
                        <input type="text" name="stock_name" class="admin-form-control" placeholder="Enter stock name"
                            value="{{ old('stock_name') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Maximum Amount</label>
                        <input type="number" name="stock_max_amount" class="admin-form-control"
                            placeholder="Enter max amount" value="{{ old('stock_max_amount') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Minimum Amount</label>
                        <input type="number" name="stock_min_amount" class="admin-form-control"
                            placeholder="Enter min amount" value="{{ old('stock_min_amount') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Stock JS</label>
                        <input type="text" name="stock_js" class="admin-form-control" placeholder="Enter stock JS"
                            value="{{ old('stock_js') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Stock Graph</label>
                        <input type="text" name="stock_graph" class="admin-form-control"
                            placeholder="Enter stock graph URL" value="{{ old('stock_graph') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Top Up Amount</label>
                        <input type="number" name="top_up_amount" class="admin-form-control"
                            placeholder="Enter top-up amount" value="{{ old('top_up_amount') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Top Up Interval</label>
                        <select name="top_up_interval" class="admin-form-control">
                            <option value="Monthly">Monthly</option>
                            <option value="Weekly">Weekly</option>
                            <option value="Daily">Daily</option>
                            <option value="Hourly">Hourly</option>
                            <option value="Every 30 Minutes">Every 30 Minutes</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Top Up Type</label>
                        <select name="top_up_type" class="admin-form-control">
                            <option value="Percentage">Percentage</option>
                            <option value="Fixed">Fixed</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Investment Duration</label>
                        <input type="number" name="investment_duration" class="admin-form-control"
                            placeholder="Enter duration" value="{{ old('investment_duration') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Top Up Status</label>
                        <select name="top_up_status" class="admin-form-control" required>
                            <option value="Open" {{ old('top_up_status')=='Open' ? 'selected' : '' }}>Active</option>
                            <option value="Closed" {{ old('top_up_status')=='Closed' ? 'selected' : '' }}>Inactive
                            </option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Performance</label>
                        <input type="text" name="performance" class="admin-form-control" placeholder="Enter performance"
                            value="{{ old('performance') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Copier ROI</label>
                        <input type="number" step="0.01" name="copier_roi" class="admin-form-control"
                            placeholder="Enter copier ROI" value="{{ old('copier_roi') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Years of Experience</label>
                        <input type="number" name="years_of_experience" class="admin-form-control"
                            placeholder="Enter years" value="{{ old('years_of_experience') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Stock Picture</label>
                        <input type="file" name="picture" class="admin-form-control" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label" style="color:var(--heading-color);">Description</label>
                        <textarea name="description" class="admin-form-control" rows="4"
                            placeholder="Enter stock description" required>{{ old('description') }}</textarea>
                    </div>
                    <div class="col-12 mt-3">
                        <button type="submit" class="btn btn-admin-primary"><i class="fas fa-save me-1"></i> Add
                            Stock</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@include('admin.footer')