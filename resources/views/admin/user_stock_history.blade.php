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
                <h4 class="admin-page-title">Client Stock History</h4>
                <p class="admin-page-subtitle">All client stock investment records</p>
            </div>
        </div>

        <div class="admin-card p-0">
            <div class="table-responsive">
                <table class="admin-table" id="ShipTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Client Name</th>
                            <th>Stock Name</th>
                            <th>Amount</th>
                            <th>ROI</th>
                            <th>Status</th>
                            <th>Subscription Date</th>
                            <th>Expires At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stockHistories as $history)
                        <tr>
                            <td>{{ $history->id }}</td>
                            <td>{{ $history->user ? $history->user->name : 'N/A' }}</td>
                            <td>{{ $history->stock_name }}</td>
                            <td>${{ number_format($history->amount, 2, '.', ',') }}</td>
                            <td>{{ $history->roi }}%</td>
                            <td>{{ $history->status }}</td>
                            <td>{{ \Carbon\Carbon::parse($history->subscription_day)->format('D, M j, Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($history->expired_at)->format('D, M j, Y') }}</td>
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