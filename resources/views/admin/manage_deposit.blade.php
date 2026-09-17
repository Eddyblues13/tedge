@include('admin.header')

<div class="main-content">
    <div class="container-fluid">
        @if(session('message'))
        <div class="alert alert-success alert-dismissible fade show">{{ session('message') }}<button type="button"
                class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="admin-page-title">Manage Client Deposits</h4>
                <p class="admin-page-subtitle">Review and process deposit requests</p>
            </div>
        </div>

        <div class="admin-card">
            <small style="color:var(--text-color);opacity:0.7;" class="d-block mb-3">If you can't see the image, try
                switching your uploaded location from admin settings.</small>
            <div class="admin-table">
                <div class="table-responsive">
                    <table id="ShipTable" class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Client Name</th>
                                <th>Client Email</th>
                                <th>Amount</th>
                                <th>Payment Method</th>
                                <th>Status</th>
                                <th>Date Created</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($deposits as $dep)
                            <tr>
                                <td>{{ $dep->id }}</td>
                                <td style="color:var(--heading-color);font-weight:500;">{{ $dep->first_name }} {{
                                    $dep->last_name }}</td>
                                <td>{{ $dep->email }}</td>
                                <td>${{ number_format($dep->amount, 2, '.', ',') }}</td>
                                <td>{{ $dep->deposit_type }}</td>
                                <td>
                                    @if($dep->status==='0')
                                    <span class="admin-badge-warning">Pending</span>
                                    @elseif($dep->status==='1')
                                    <span class="admin-badge-success">Processed</span>
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($dep->created_at)->format('D, M j, Y g:i A') }}</td>
                                <td>
                                    <div class="d-flex gap-1 flex-wrap">
                                        <a href="{{ url('admin/view-deposit/'.$dep->id) }}"
                                            class="btn btn-sm btn-admin-primary" title="View screenshot"><i
                                                class="fa fa-eye"></i></a>
                                        <a href="{{ url('admin/delete-deposit/'.$dep->id) }}"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Delete this deposit?')">Delete</a>
                                        @if($dep->status==='0')
                                        <a href="{{ url('admin/process-deposit/'.$dep->id) }}"
                                            class="btn btn-sm btn-success">Process</a>
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
</div>

@include('admin.footer')

<script>
    $(document).ready(function(){
    if($.fn.DataTable){
        $('#ShipTable').DataTable({ order:[[0,'desc']], responsive:true, language:{search:"",searchPlaceholder:"Search..."} });
    }
});
</script>