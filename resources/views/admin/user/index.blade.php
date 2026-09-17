@include('admin.header')

<div class="main-content">
    <div class="container-fluid">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-3">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-3">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="admin-page-title">Manage Users</h4>
                <p class="admin-page-subtitle">View and manage all registered users</p>
            </div>
            <a href="{{ route('admin.users.create') }}" class="btn btn-admin-primary">
                <i class="fas fa-plus me-1"></i> Add New User
            </a>
        </div>

        <div class="admin-card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="UserTable" class="admin-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Country</th>
                                <th>Status</th>
                                <th>Verification</th>
                                <th>Referred By</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($user->profile_photo)
                                        <img src="{{ asset('storage/'.$user->profile_photo) }}"
                                            class="rounded-circle me-2" width="40" height="40"
                                            style="object-fit:cover;">
                                        @else
                                        <div class="rounded-circle d-flex align-items-center justify-content-center me-2"
                                            style="width:40px;height:40px;background:var(--accent-color);color:#fff;font-weight:600;font-size:14px;">
                                            {{ substr($user->first_name, 0, 1) }}{{ substr($user->last_name, 0, 1) }}
                                        </div>
                                        @endif
                                        <div>{{ $user->first_name }} {{ $user->last_name }}</div>
                                    </div>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->country }}</td>
                                <td>
                                    <span
                                        class="admin-badge-{{ $user->user_status == 'active' ? 'success' : ($user->user_status == 'banned' ? 'danger' : 'warning') }}">
                                        {{ ucfirst($user->user_status) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <span
                                            class="admin-badge-{{ $user->email_verification ? 'success' : 'warning' }}"
                                            title="Email Verified">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                        <span class="admin-badge-{{ $user->id_verification ? 'success' : 'warning' }}"
                                            title="ID Verified">
                                            <i class="fas fa-id-card"></i>
                                        </span>
                                        <span
                                            class="admin-badge-{{ $user->address_verification ? 'success' : 'warning' }}"
                                            title="Address Verified">
                                            <i class="fas fa-home"></i>
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    @if($user->referred_by)
                                    {{ $user->referrer->first_name ?? 'N/A' }}
                                    @else
                                    None
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.users.edit', $user->id) }}"
                                        class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                        class="d-inline" data-ajax-delete>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
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
    $(document).ready(function() {
    $('#UserTable').DataTable({
        order: [[0, 'asc']],
        responsive: true,
        language: { search: "", searchPlaceholder: "Search..." }
    });

    // Handle delete with AJAX
    $('form[data-ajax-delete]').submit(function(e) {
        e.preventDefault();
        const form = $(this);
        const button = form.find('[type="submit"]');
        if(confirm('Are you sure you want to delete this user?')) {
            button.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Deleting...');
            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: form.serialize(),
                success: function(response) {
                    if(response.status === 'success') {
                        toastr.success(response.message);
                        form.closest('tr').fadeOut(300, function() { $(this).remove(); });
                    }
                },
                error: function(xhr) {
                    toastr.error(xhr.responseJSON?.message || 'An error occurred');
                    button.prop('disabled', false).html('Delete');
                }
            });
        }
    });
});
</script>