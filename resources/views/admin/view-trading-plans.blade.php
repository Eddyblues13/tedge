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
                <h4 class="admin-page-title">Manage Account Plans</h4>
                <p class="admin-page-subtitle">View and manage trading plans</p>
            </div>
            <a href="{{ route('admin.create-trading-plan') }}" class="btn btn-admin-primary"><i
                    class="fas fa-plus-circle me-1"></i> Create New Plan</a>
        </div>

        <div class="admin-card p-0">
            <div class="table-responsive">
                <table class="admin-table" id="ShipTable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Price ($)</th>
                            <th>Swap Fee</th>
                            <th>Trading Pairs</th>
                            <th>Leverage</th>
                            <th>Spread</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($plans as $plan)
                        <tr>
                            <td>{{ $plan->name }}</td>
                            <td>{{ number_format($plan->price, 2) }}</td>
                            <td>{{ $plan->swap_fee ? 'Yes' : 'No' }}</td>
                            <td>{{ $plan->pairs }}</td>
                            <td>{{ $plan->leverage ?? 'N/A' }}</td>
                            <td>{{ $plan->spread ?? 'N/A' }}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('admin.edit-trading-plan', $plan->id) }}"
                                        class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                    <form action="{{ route('admin.delete-trading-plan', $plan->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i
                                                class="fa fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
    $('#ShipTable').DataTable({
        order:[[0,'desc']],
        responsive:true,
        language:{search:"",searchPlaceholder:"Search..."}
    });
});
</script>

@include('admin.footer')