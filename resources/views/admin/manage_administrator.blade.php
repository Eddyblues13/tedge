@include('admin.header')

<div class="main-content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="admin-page-title">Managers List</h4>
                <p class="admin-page-subtitle">All administrator accounts</p>
            </div>
            <a href="{{ url('admin/add-manager') }}" class="btn btn-admin-primary"><i
                    class="fas fa-plus-circle me-1"></i> New Manager</a>
        </div>

        <div class="admin-card p-0">
            <div class="table-responsive">
                <table class="admin-table" id="ShipTable">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($managers as $manager)
                        <tr>
                            <td>{{ $manager->id }}</td>
                            <td>{{ $manager->fname }}</td>
                            <td>{{ $manager->l_name }}</td>
                            <td>{{ $manager->email }}</td>
                            <td>{{ $manager->phone }}</td>
                            <td>{{ $manager->type }}</td>
                            <td>
                                @if($manager->status == 'active')
                                <span class="admin-badge-success">Active</span>
                                @else
                                <span class="admin-badge-danger">Blocked</span>
                                @endif
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown">Actions</button>
                                    <ul class="dropdown-menu"
                                        style="background:var(--card-bg);border:1px solid var(--border-color);">
                                        @if($manager->status == 'active')
                                        <li><a class="dropdown-item" style="color:var(--text-color);"
                                                href="{{ url('account/admin/dashboard/ublock/'.$manager->id) }}">Block</a>
                                        </li>
                                        @else
                                        <li><a class="dropdown-item" style="color:var(--text-color);"
                                                href="{{ url('account/admin/dashboard/ublock/'.$manager->id) }}">Unblock</a>
                                        </li>
                                        @endif
                                        <li><a class="dropdown-item" style="color:var(--text-color);" href="#"
                                                data-bs-toggle="modal"
                                                data-bs-target="#resetpswdModal{{ $manager->id }}">Reset Password</a>
                                        </li>
                                        <li><a class="dropdown-item" style="color:var(--text-color);" href="#"
                                                data-bs-toggle="modal"
                                                data-bs-target="#edituser{{ $manager->id }}">Edit</a></li>
                                        <li><a class="dropdown-item" style="color:var(--text-color);" href="#"
                                                data-bs-toggle="modal"
                                                data-bs-target="#sendmailModal{{ $manager->id }}">Send Email</a></li>
                                        <li>
                                            <hr class="dropdown-divider" style="border-color:var(--border-color);">
                                        </li>
                                        <li><a class="dropdown-item text-danger" href="#" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $manager->id }}">Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>

                        <!-- Reset Password Modal -->
                        <div class="modal fade" id="resetpswdModal{{ $manager->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content"
                                    style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);">
                                    <div class="modal-header" style="border-color:var(--border-color);">
                                        <h5 class="modal-title" style="color:var(--heading-color);">Reset Password</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to reset password for {{ $manager->fname }} to <span
                                                class="text-primary fw-bold">admin01236</span>?</p>
                                        <a class="btn btn-danger"
                                            href="{{ url('account/admin/dashboard/resetadpwd/'.$manager->id) }}">Reset
                                            Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal{{ $manager->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content"
                                    style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);">
                                    <div class="modal-header" style="border-color:var(--border-color);">
                                        <h5 class="modal-title" style="color:var(--heading-color);">Delete Manager</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete {{ $manager->fname }}?</p>
                                        <a class="btn btn-danger"
                                            href="{{ url('account/admin/dashboard/deleletadmin/'.$manager->id) }}">Yes,
                                            I'm sure</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="edituser{{ $manager->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content"
                                    style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);">
                                    <div class="modal-header" style="border-color:var(--border-color);">
                                        <h5 class="modal-title" style="color:var(--heading-color);">Edit Manager Details
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{ url('account/admin/dashboard/editadmin') }}">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ $manager->id }}">
                                            <div class="mb-3">
                                                <label class="form-label" style="color:var(--heading-color);">First
                                                    Name</label>
                                                <input class="admin-form-control" value="{{ $manager->fname }}"
                                                    type="text" name="fname" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" style="color:var(--heading-color);">Last
                                                    Name</label>
                                                <input class="admin-form-control" value="{{ $manager->l_name }}"
                                                    type="text" name="l_name" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label"
                                                    style="color:var(--heading-color);">Email</label>
                                                <input class="admin-form-control" value="{{ $manager->email }}"
                                                    type="email" name="email" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" style="color:var(--heading-color);">Phone
                                                    Number</label>
                                                <input class="admin-form-control" value="{{ $manager->phone }}"
                                                    type="text" name="phone" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label"
                                                    style="color:var(--heading-color);">Type</label>
                                                <select class="admin-form-control" name="type">
                                                    <option value="{{ $manager->type }}">{{ $manager->type }}</option>
                                                    <option value="Super Admin">Super Admin</option>
                                                    <option value="Admin">Admin</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-admin-primary">Update Account</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Send Email Modal -->
                        <div class="modal fade" id="sendmailModal{{ $manager->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content"
                                    style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);">
                                    <div class="modal-header" style="border-color:var(--border-color);">
                                        <h5 class="modal-title" style="color:var(--heading-color);">Send Email Message
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>This message will be sent to {{ $manager->fname }} {{ $manager->l_name }}</p>
                                        <form method="post" action="{{ url('account/admin/dashboard/sendmail') }}">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ $manager->id }}">
                                            <div class="mb-3">
                                                <input type="text" name="subject" class="admin-form-control"
                                                    placeholder="Enter Email Subject">
                                            </div>
                                            <div class="mb-3">
                                                <textarea class="admin-form-control" name="message" rows="3"
                                                    placeholder="Type your message here" required></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-admin-primary">Send</button>
                                        </form>
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