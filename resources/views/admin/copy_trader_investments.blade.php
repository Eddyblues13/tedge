@include('admin.header')

<div class="main-content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="admin-page-title">Copy Trader Investments</h4>
                <p class="admin-page-subtitle">All copy trader investment records</p>
            </div>
        </div>

        <div class="admin-card p-0">
            <div class="table-responsive">
                <table class="admin-table" id="ShipTable">
                    <thead>
                        <tr>
                            <th>Client Name</th>
                            <th>Trader Name</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Duration</th>
                            <th>Created</th>
                            <th>Expired</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($trade as $trader)
                        <tr>
                            <td>{{ $trader->client_name }}</td>
                            <td>{{ $trader->trader_name }}</td>
                            <td>{{ $trader->amount }}</td>
                            <td>
                                @if($trader->active == 1)
                                <span class="admin-badge-success">Active</span>
                                @else
                                <span class="admin-badge-danger">Expired</span>
                                @endif
                            </td>
                            <td>{{ $trader->trade_duration }}</td>
                            <td>{{ $trader->created_at }}</td>
                            <td>{{ $trader->expired_at }}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ url('delete-trade/'.$trader->id) }}" class="btn btn-sm btn-danger"
                                        title="Delete"><i class="fa fa-trash"></i></a>
                                    <a href="{{ url('expired-trade/'.$trader->id) }}" class="btn btn-sm btn-warning"
                                        title="Mark Expired"><i class="fa fa-times-circle"></i></a>
                                    <a href="{{ url('active-trade/'.$trader->id) }}" class="btn btn-sm btn-success"
                                        title="Mark Active"><i class="fa fa-check-circle"></i></a>
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