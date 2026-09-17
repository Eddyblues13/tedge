@include('admin.header')

<div class="main-content">
    <div class="container-fluid">
        @if(session('message'))
        <div class="alert alert-success alert-dismissible fade show">{{ session('message') }}<button type="button"
                class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="admin-page-title">KYC Verification List</h4>
                <p class="admin-page-subtitle">Review and process identity verifications</p>
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
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>KYC Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kyc as $k)
                            <tr>
                                <td>{{ $k->real_user_id }}</td>
                                <td style="color:var(--heading-color);font-weight:500;">{{ $k->first_name }} {{
                                    $k->last_name }}</td>
                                <td>{{ $k->email }}</td>
                                <td>
                                    @if($k->kyc_status === '1')
                                    <span class="admin-badge-success">Verified</span>
                                    @elseif($k->kyc_status === '0')
                                    <span class="admin-badge-danger">Not Verified</span>
                                    @elseif($k->kyc_status === '2')
                                    <span class="admin-badge-warning">Declined</span>
                                    @else
                                    <span class="admin-badge-info">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-1 flex-wrap">
                                        <button class="btn btn-sm btn-admin-primary" data-bs-toggle="modal"
                                            data-bs-target="#viewkycIModal{{ $k->id }}"><i
                                                class="fa fa-eye me-1"></i>ID</button>
                                        <button class="btn btn-sm btn-admin-primary" data-bs-toggle="modal"
                                            data-bs-target="#viewkycPModal{{ $k->id }}"><i
                                                class="fa fa-eye me-1"></i>Passport</button>
                                        <a href="{{ url('admin/accept-kyc/'.$k->real_user_id) }}"
                                            class="btn btn-sm btn-success">Accept</a>
                                        <a href="{{ url('admin/reject-kyc/'.$k->real_user_id) }}"
                                            class="btn btn-sm btn-danger">Reject</a>
                                    </div>
                                </td>
                            </tr>

                            <!-- View KYC ID Modal -->
                            <div class="modal fade" id="viewkycIModal{{ $k->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content"
                                        style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);">
                                        <div class="modal-header" style="border-color:var(--border-color);">
                                            <h5 class="modal-title" style="color:var(--heading-color);">KYC - ID Card
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            @if($k->id_card_path)
                                            <img src="{{ asset('uploads/documents/id_cards/'.$k->id_card_path) }}"
                                                alt="ID Card" class="img-fluid">
                                            @else
                                            <p>No ID card uploaded.</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- View KYC Passport Modal -->
                            <div class="modal fade" id="viewkycPModal{{ $k->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content"
                                        style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);">
                                        <div class="modal-header" style="border-color:var(--border-color);">
                                            <h5 class="modal-title" style="color:var(--heading-color);">KYC - Passport
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            @if($k->passport_photo_path)
                                            <img src="{{ asset('uploads/documents/passport_photos/'.$k->passport_photo_path) }}"
                                                alt="Passport" class="img-fluid">
                                            @else
                                            <p>No passport uploaded.</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
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
        $('#ShipTable').DataTable({ responsive:true, language:{search:"",searchPlaceholder:"Search..."} });
    }
});
</script>