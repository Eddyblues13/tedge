@include('admin.header')

<div class="main-content">
    <div class="container-fluid">
        @if(session('success') || session('message'))
        <div class="alert alert-success alert-dismissible fade show">{{ session('success') ?? session('message')
            }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul><button
                type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="admin-page-title">Edit Stock</h4>
                <p class="admin-page-subtitle">Update {{ $stock->stock_name }} details</p>
            </div>
            <a href="{{ route('stock.index') }}" class="btn btn-outline-secondary"><i
                    class="fas fa-arrow-left me-1"></i> Back</a>
        </div>

        <div class="admin-card">
            <form action="{{ route('stock.update', $stock->id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Stock Name</label>
                        <input type="text" name="stock_name" class="admin-form-control"
                            value="{{ old('stock_name', $stock->stock_name) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Maximum Amount</label>
                        <input type="number" name="stock_max_amount" class="admin-form-control"
                            value="{{ old('stock_max_amount', $stock->stock_max_amount) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Minimum Amount</label>
                        <input type="number" name="stock_min_amount" class="admin-form-control"
                            value="{{ old('stock_min_amount', $stock->stock_min_amount) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Stock JS</label>
                        <input type="text" name="stock_js" class="admin-form-control"
                            value="{{ old('stock_js', $stock->stock_js) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Stock Graph</label>
                        <input type="text" name="stock_graph" class="admin-form-control"
                            value="{{ old('stock_graph', $stock->stock_graph) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Top Up Amount</label>
                        <input type="number" name="top_up_amount" class="admin-form-control"
                            value="{{ old('top_up_amount', $stock->top_up_amount) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Top Up Interval</label>
                        <select name="top_up_interval" class="admin-form-control">
                            @foreach(['Monthly','Weekly','Daily','Hourly','Every 30 Minutes'] as $opt)
                            <option value="{{ $opt }}" {{ old('top_up_interval', $stock->top_up_interval)==$opt ?
                                'selected' : '' }}>{{ $opt }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Top Up Type</label>
                        <select name="top_up_type" class="admin-form-control">
                            <option value="Percentage" {{ old('top_up_type', $stock->top_up_type)=='Percentage' ?
                                'selected' : '' }}>Percentage</option>
                            <option value="Fixed" {{ old('top_up_type', $stock->top_up_type)=='Fixed' ? 'selected' : ''
                                }}>Fixed</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Investment Duration</label>
                        <input type="number" name="investment_duration" class="admin-form-control"
                            value="{{ old('investment_duration', $stock->investment_duration) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Top Up Status</label>
                        <select name="top_up_status" class="admin-form-control" required>
                            <option value="active" {{ old('top_up_status', $stock->top_up_status)=='active' ? 'selected'
                                : '' }}>Active</option>
                            <option value="inactive" {{ old('top_up_status', $stock->top_up_status)=='inactive' ?
                                'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Performance</label>
                        <input type="text" name="performance" class="admin-form-control"
                            value="{{ old('performance', $stock->performance) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Copier ROI</label>
                        <input type="number" step="0.01" name="copier_roi" class="admin-form-control"
                            value="{{ old('copier_roi', $stock->copier_roi) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Years of Experience</label>
                        <input type="number" name="years_of_experience" class="admin-form-control"
                            value="{{ old('years_of_experience', $stock->years_of_experience) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Stock Picture</label>
                        <input type="file" name="picture" class="admin-form-control">
                        @if($stock->picture)
                        <img src="{{ asset('storage/' . $stock->picture) }}" alt="Stock Picture" class="mt-2"
                            style="max-width:100px;">
                        @endif
                    </div>
                    <div class="col-12">
                        <label class="form-label" style="color:var(--heading-color);">Description</label>
                        <textarea name="description" class="admin-form-control" rows="4"
                            required>{{ old('description', $stock->description) }}</textarea>
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