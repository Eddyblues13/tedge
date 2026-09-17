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
                <h4 class="admin-page-title">Purchased Stocks</h4>
                <p class="admin-page-subtitle">All client stock purchases</p>
            </div>
        </div>

        <div class="admin-card p-0">
            <div class="table-responsive">
                <table class="admin-table" id="ShipTable">
                    <thead>
                        <tr>
                            <th>Client Name</th>
                            <th>Stock Name</th>
                            <th>Amount</th>
                            <th>Active</th>
                            <th>Duration</th>
                            <th>Created On</th>
                            <th>Expires At</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stock as $stock)
                        <tr>
                            <td>{{ $stock->name }}</td>
                            <td>{{ $stock->stock_name }}</td>
                            <td>${{ number_format($stock->amount, 2, '.', ',') }}</td>
                            <td>
                                @if($stock->status === '1')
                                <span class="admin-badge-danger">Expired</span>
                                @elseif($stock->status === '0')
                                <span class="admin-badge-success">Active</span>
                                @endif
                            </td>
                            <td>{{ $stock->stock_duration }}</td>
                            <td>{{ \Carbon\Carbon::parse($stock->created_at)->format('D, M j, Y g:i A') }}</td>
                            <td>{{ \Carbon\Carbon::parse($stock->expired_at)->format('D, M j, Y g:i A') }}</td>
                            <td>
                                <div class="d-flex gap-1 flex-wrap">
                                    <a href="{{ url('delete-stock/'.$stock->id) }}"
                                        class="btn btn-sm btn-danger">Delete</a>
                                    @if($stock->status === '0')
                                    <a href="{{ url('expired-stock/'.$stock->id) }}" class="btn btn-sm btn-warning">Mark
                                        Expired</a>
                                    @elseif($stock->status === '1')
                                    <a href="{{ url('active-stock/'.$stock->id) }}" class="btn btn-sm btn-success">Mark
                                        Active</a>
                                    @endif
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