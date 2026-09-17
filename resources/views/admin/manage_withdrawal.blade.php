@include('admin.header')

<div class="main-content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="admin-page-title">Manage Client Withdrawals</h4>
                <p class="admin-page-subtitle">Review withdrawal requests</p>
            </div>
        </div>

        <div class="admin-card">
            <div class="admin-table">
                <div class="table-responsive">
                    <table id="ShipTable" class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Client Name</th>
                                <th>Amount</th>
                                <th>Payment Method</th>
                                <th>Details</th>
                                <th>Date Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($withdrawals as $with)
                            <tr>
                                <td>{{ $with->id }}</td>
                                <td style="color:var(--heading-color);font-weight:500;">{{ $with->first_name }} {{
                                    $with->last_name }}</td>
                                <td>${{ number_format($with->amount, 2, '.', ',') }}</td>
                                <td>{{ $with->method }}</td>
                                <td>{{ $with->details }}</td>
                                <td>{{ \Carbon\Carbon::parse($with->created_at)->format('D, M j, Y g:i A') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.footer')

<script>
    $(document).ready(function(){
    if($.fn.DataTable){
        $('#ShipTable').DataTable({ order:[[0,'desc']], responsive:true, language:{search:"",searchPlaceholder:"Search..."} });
    }
});
</script>