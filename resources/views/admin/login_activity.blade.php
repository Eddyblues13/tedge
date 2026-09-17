@include('admin.header')

<div class="main-content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="admin-page-title">{{ $user->first_name }} {{ $user->last_name }} Login Activities</h4>
                <p class="admin-page-subtitle">View login history and sessions</p>
            </div>
            <div class="d-flex gap-2">
                <a class="btn btn-sm btn-danger" href=""><i class="fas fa-trash me-1"></i> Clear Data</a>
                <a class="btn btn-sm btn-outline-secondary" href=""><i class="fas fa-arrow-left me-1"></i> Back</a>
            </div>
        </div>

        <div class="admin-card p-0">
            <div class="table-responsive">
                <table class="admin-table" id="ShipTable">
                    <thead>
                        <tr>
                            <th>IP Address</th>
                            <th>Device/OS/Browser</th>
                            <th>Date/Time Logged In</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($activity as $activity)
                        <tr>
                            <td>{{ $activity->ip_address }}</td>
                            <td>{{ $activity->user_agent }}</td>
                            <td>{{ \Carbon\Carbon::parse($activity->last_activity)->format('D, M j, Y g:i A') }}</td>
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