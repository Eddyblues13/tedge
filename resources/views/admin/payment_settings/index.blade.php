@include('admin.header')

<div class="main-content">
    <div class="container-fluid">
        @if(session('message'))
        <div class="alert alert-success alert-dismissible fade show">{{ session('message') }}<button type="button"
                class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">{{ session('error') }}<button type="button"
                class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="admin-page-title">Payment Settings</h4>
                <p class="admin-page-subtitle">Configure payment method settings</p>
            </div>
            <a href="{{ route('payment.create') }}" class="btn btn-admin-primary"><i
                    class="fas fa-plus-circle me-1"></i> Add Method</a>
        </div>

        <div class="admin-card">
            <div class="admin-table">
                <div class="table-responsive">
                    <table class="table" id="paymentSettingsTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Used For</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($payments as $key => $pm)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td style="color:var(--heading-color);font-weight:500;">{{ $pm->name ?? $pm->wallet_name
                                    }}</td>
                                <td>{{ ucfirst($pm->type ?? $pm->wallet_type ?? '-') }}</td>
                                <td>{{ ucfirst($pm->type_for ?? 'Both') }}</td>
                                <td>
                                    <span class="admin-badge-{{ $pm->status === 'enabled' ? 'success' : 'danger' }}">{{
                                        ucfirst($pm->status) }}</span>
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('payment.edit', $pm->id) }}"
                                            class="btn btn-sm btn-admin-primary"><i class="fa fa-edit"></i></a>
                                        <form action="{{ route('payment.destroy', $pm->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-danger" type="submit"
                                                onclick="return confirm('Delete this payment method?')"><i
                                                    class="fa fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-4" style="color:var(--text-color);opacity:0.5;">No
                                    payment settings found</td>
                            </tr>
                            @endforelse
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
        $('#paymentSettingsTable').DataTable({
            responsive: true,
            pageLength: 25,
            language: { search: "", searchPlaceholder: "Search..." }
        });
    }
});
</script>