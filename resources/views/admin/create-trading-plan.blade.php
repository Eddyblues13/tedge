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
                <h4 class="admin-page-title">Add Trading Plan</h4>
                <p class="admin-page-subtitle">Create a new account plan</p>
            </div>
            <a href="{{ route('admin.view-trading-plans') }}" class="btn btn-sm btn-outline-secondary"><i
                    class="fas fa-arrow-left me-1"></i> Back</a>
        </div>

        <div class="admin-card">
            <form action="{{ route('admin.store-trading-plan') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Plan Name</label>
                        <input class="admin-form-control" placeholder="Enter plan name" type="text" name="name"
                            required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Minimum Amount ($)</label>
                        <input class="admin-form-control" placeholder="Enter minimum amount" type="number"
                            name="min_amount" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Maximum Amount ($)</label>
                        <input class="admin-form-control" placeholder="Enter maximum amount" type="number"
                            name="max_amount" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color:var(--heading-color);">Investment Duration</label>
                        <input class="admin-form-control" placeholder="e.g. 3 months" type="text" name="duration"
                            required>
                    </div>
                    <div class="col-12 mt-3">
                        <button type="submit" class="btn btn-admin-primary"><i class="fas fa-plus-circle me-1"></i> Add
                            Plan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@include('admin.footer')