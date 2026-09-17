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
                <h4 class="admin-page-title">Manage Client Deposits</h4>
                <p class="admin-page-subtitle">View and process all client deposits</p>
            </div>
        </div>

        <div class="admin-card p-0">
            <div class="p-3">
                <small style="color:var(--text-color);opacity:0.7;">If you can't see the image, try switching your
                    upload location from admin settings.</small>
            </div>
            <div class="table-responsive">
                <table class="admin-table" id="ShipTable">
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
                            <td>{{ $dep->name }}</td>
                            <td>{{ $dep->email }}</td>
                            <td>${{ number_format($dep->amount, 2, '.', ',') }}</td>
                            <td>{{ $dep->asset }}</td>
                            <td>
                                @if($dep->status == '1')
                                <span class="admin-badge-success">Processed</span>
                                @elseif($dep->status == '0')
                                <span class="admin-badge-danger">Pending</span>
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($dep->created_at)->format('D, M j, Y g:i A') }}</td>
                            <td>
                                <div class="d-flex gap-1 flex-wrap">
                                    <a href="#" class="btn btn-sm btn-outline-secondary" title="View screenshot"><i
                                            class="fa fa-eye"></i></a>
                                    <a href="{{ url('delete-deposit/'.$dep->id) }}"
                                        class="btn btn-sm btn-danger">Delete</a>
                                    @if($dep->status == '0')
                                    <a class="btn btn-sm btn-admin-primary"
                                        href="{{ url('process-deposit/'.$dep->id) }}">Process</a>
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