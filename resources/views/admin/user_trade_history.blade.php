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
                <h4 class="admin-page-title">Client Trade Histories</h4>
                <p class="admin-page-subtitle">All client trade investment records</p>
            </div>
        </div>

        <div class="admin-card p-0">
            <div class="table-responsive">
                <table class="admin-table" id="ShipTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Client Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Trader Name</th>
                            <th>Asset</th>
                            <th>Amount</th>
                            <th>ROI</th>
                            <th>Duration</th>
                            <th>Sub. Day</th>
                            <th>Sub. Hour</th>
                            <th>Expired At</th>
                            <th>Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tradeHistories as $trade)
                        <tr>
                            <td>{{ $trade->id }}</td>
                            <td>{{ $trade->user->name ?? 'N/A' }}</td>
                            <td>{{ $trade->user_email }}</td>
                            <td>{{ $trade->status }}</td>
                            <td>{{ $trade->trader_name }}</td>
                            <td>{{ $trade->asset }}</td>
                            <td>${{ number_format($trade->amount, 2, '.', ',') }}</td>
                            <td>{{ $trade->roi }}%</td>
                            <td>{{ $trade->trade_duration }} days</td>
                            <td>{{ $trade->subscription_day }}</td>
                            <td>{{ $trade->subscription_hour }}</td>
                            <td>{{ \Carbon\Carbon::parse($trade->expired_at)->format('D, M j, Y g:i A') }}</td>
                            <td>{{ \Carbon\Carbon::parse($trade->created_at)->format('D, M j, Y g:i A') }}</td>
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