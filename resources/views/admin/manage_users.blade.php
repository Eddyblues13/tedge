@include('admin.header')

<style>
    .user-card-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
        gap: 16px;
    }

    .user-card-item {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 20px;
        transition: all 0.2s ease;
        position: relative;
    }

    .user-card-item:hover {
        border-color: var(--accent-color);
        box-shadow: 0 4px 20px rgba(99, 91, 255, 0.12);
        transform: translateY(-2px);
    }

    .user-avatar {
        width: 46px;
        height: 46px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--accent-color), #8b83ff);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.85rem;
        flex-shrink: 0;
    }

    .user-name {
        color: var(--heading-color);
        font-weight: 600;
        font-size: 0.95rem;
    }

    .user-email {
        color: var(--text-color);
        font-size: 0.8rem;
        opacity: 0.7;
    }

    .user-meta {
        display: flex;
        gap: 8px;
        margin-top: 12px;
        flex-wrap: wrap;
    }

    .user-meta-tag {
        font-size: 0.72rem;
        padding: 3px 10px;
        border-radius: 20px;
        background: rgba(99, 91, 255, 0.1);
        color: var(--accent-color);
        font-weight: 500;
    }

    .user-meta-tag.verified {
        background: rgba(16, 185, 129, 0.1);
        color: #10b981;
    }

    .user-meta-tag.unverified {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
    }

    .manage-user-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 18px;
        border-radius: 8px;
        font-size: 0.8rem;
        font-weight: 500;
        background: #2563eb;
        color: #fff;
        border: none;
        transition: all 0.2s;
        text-decoration: none;
    }

    .manage-user-btn:hover {
        background: #1d4ed8;
        color: #fff;
        transform: scale(1.03);
    }

    @media (max-width: 576px) {
        .manage-user-btn {
            display: none !important;
        }

        .user-card-item {
            cursor: pointer;
        }

        .user-card-grid {
            grid-template-columns: 1fr;
        }
    }

    .pagination-info {
        color: var(--text-color);
        opacity: 0.6;
        font-size: 0.82rem;
        text-align: center;
        margin-top: 8px;
    }

    .search-box-wrapper {
        position: relative;
        max-width: 360px;
        width: 100%;
    }

    .search-box-wrapper i {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-color);
        opacity: 0.4;
        font-size: 0.85rem;
    }

    .search-box-wrapper input {
        padding-left: 40px !important;
        border-radius: 10px !important;
    }

    .view-toggle-btn {
        width: 38px;
        height: 38px;
        border-radius: 8px;
        border: 1px solid var(--border-color);
        background: var(--card-bg);
        color: var(--text-color);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
    }

    .view-toggle-btn:hover,
    .view-toggle-btn.active {
        border-color: var(--accent-color);
        color: var(--accent-color);
    }

    .users-count-badge {
        background: rgba(99, 91, 255, 0.12);
        color: var(--accent-color);
        padding: 4px 14px;
        border-radius: 20px;
        font-size: 0.82rem;
        font-weight: 600;
    }

    .modal-content.admin-modal {
        background: var(--card-bg);
        color: var(--text-color);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
    }

    .modal-content.admin-modal .modal-header {
        border-bottom: 1px solid var(--border-color);
        padding: 20px 24px;
    }

    .modal-content.admin-modal .modal-body {
        padding: 24px;
    }

    .modal-content.admin-modal .modal-title {
        color: var(--heading-color);
        font-weight: 600;
        font-size: 1.05rem;
    }

    .modal-content.admin-modal .btn-close {
        filter: invert(1) grayscale(100%) brightness(200%);
    }

    .admin-table-view {
        display: none;
    }

    .admin-table-view.active,
    .user-card-grid.active {
        display: grid;
    }

    .admin-table-view.active {
        display: block;
    }
</style>

<div class="main-content">
    <div class="container-fluid">
        @if(session('message'))
        <div class="alert alert-success alert-dismissible fade show mb-3" style="border-radius:10px;">
            <i class="fas fa-check-circle me-2"></i>{{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            <div class="d-flex align-items-center gap-3">
                <div>
                    <h4 class="admin-page-title mb-1">Manage Users</h4>
                    <p class="admin-page-subtitle mb-0">Overview of all registered users</p>
                </div>
                <span class="users-count-badge">{{ count($users) }} users</span>
            </div>
            <button type="button" class="btn btn-admin-primary" style="border-radius:10px;padding:9px 22px;"
                data-bs-toggle="modal" data-bs-target="#sendmailModal">
                <i class="fas fa-paper-plane me-2"></i> Message All Users
            </button>
        </div>

        <!-- Toolbar -->
        <div class="admin-card mb-4" style="border-radius:12px;">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div class="d-flex gap-2 align-items-center flex-wrap">
                    <div class="search-box-wrapper">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchInput" placeholder="Search users by name or email..."
                            class="admin-form-control">
                    </div>
                    <select class="admin-form-control" id="numofrecord" style="width:auto;border-radius:10px;">
                        <option value="5">5 per page</option>
                        <option value="10" selected>10 per page</option>
                        <option value="20">20 per page</option>
                        <option value="50">50 per page</option>
                        <option value="100">100 per page</option>
                    </select>
                    <select class="admin-form-control" id="order" style="width:auto;border-radius:10px;">
                        <option value="desc">Newest First</option>
                        <option value="asc">Oldest First</option>
                    </select>
                </div>
                <div class="d-flex gap-2">
                    <button class="view-toggle-btn active" id="gridViewBtn" title="Grid View" onclick="setView('grid')">
                        <i class="fas fa-th-large"></i>
                    </button>
                    <button class="view-toggle-btn" id="listViewBtn" title="List View" onclick="setView('list')">
                        <i class="fas fa-list"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Grid View -->
        <div class="user-card-grid active" id="gridView">
            @foreach($users as $user)
            <div class="user-card-item user-item"
                data-name="{{ strtolower($user->first_name . ' ' . $user->last_name) }}"
                data-email="{{ strtolower($user->email) }}"
                onclick="if(window.innerWidth<=576)window.location='{{ route('admin.user.view', $user->id) }}'">
                <div class="d-flex align-items-start justify-content-between mb-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="user-avatar">
                            {{ strtoupper(substr($user->first_name, 0, 1)) }}{{ strtoupper(substr($user->last_name, 0,
                            1)) }}
                        </div>
                        <div>
                            <div class="user-name">{{ $user->first_name }} {{ $user->last_name }}</div>
                            <div class="user-email">{{ strtolower($user->email) }}</div>
                        </div>
                    </div>
                </div>
                <div class="user-meta">
                    <span class="user-meta-tag {{ $user->email_verification ? 'verified' : 'unverified' }}">
                        <i class="fas fa-{{ $user->email_verification ? 'check-circle' : 'times-circle' }} me-1"></i>
                        {{ $user->email_verification ? 'Verified' : 'Unverified' }}
                    </span>
                    @if($user->country)
                    <span class="user-meta-tag">{{ $user->country }}</span>
                    @endif
                    <span class="user-meta-tag">{{ $user->currency ?? 'USD' }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-3 pt-3"
                    style="border-top:1px solid var(--border-color);">
                    <small style="color:var(--text-color);opacity:0.5;">
                        <i class="far fa-clock me-1"></i>Joined {{
                        \Carbon\Carbon::parse($user->created_at)->diffForHumans() }}
                    </small>
                    <a class="manage-user-btn" href="{{ route('admin.user.view', $user->id) }}">
                        <i class="fas fa-cog"></i> Manage
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <!-- List/Table View -->
        <div class="admin-table-view" id="listView">
            <div class="admin-card" style="border-radius:12px;">
                <div class="admin-table">
                    <div class="table-responsive">
                        <table class="table" id="userTable">
                            <thead>
                                <tr>
                                    <th style="width:50px;">#</th>
                                    <th>User</th>
                                    <th>Status</th>
                                    <th>Country</th>
                                    <th>Joined</th>
                                    <th style="width:120px;">Action</th>
                                </tr>
                            </thead>
                            <tbody id="userslisttbl">
                                @foreach($users as $user)
                                <tr class="user-item"
                                    data-name="{{ strtolower($user->first_name . ' ' . $user->last_name) }}"
                                    data-email="{{ strtolower($user->email) }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="user-avatar" style="width:36px;height:36px;font-size:0.75rem;">
                                                {{ strtoupper(substr($user->first_name, 0, 1)) }}{{
                                                strtoupper(substr($user->last_name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <div class="user-name" style="font-size:0.88rem;">{{ $user->first_name
                                                    }} {{ $user->last_name }}</div>
                                                <div class="user-email">{{ strtolower($user->email) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span
                                            class="user-meta-tag {{ $user->email_verification ? 'verified' : 'unverified' }}">
                                            {{ $user->email_verification ? 'Verified' : 'Unverified' }}
                                        </span>
                                    </td>
                                    <td><span style="color:var(--text-color);font-size:0.85rem;">{{ $user->country ??
                                            '—' }}</span></td>
                                    <td><small style="color:var(--text-color);opacity:0.6;">{{
                                            \Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</small></td>
                                    <td>
                                        <a class="manage-user-btn" style="padding:5px 14px;font-size:0.78rem;"
                                            href="{{ route('admin.user.view', $user->id) }}">
                                            <i class="fas fa-cog"></i> Manage
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div id="pagination" class="d-flex justify-content-center mt-4 gap-1 flex-wrap"></div>
        <div id="paginationInfo" class="pagination-info"></div>
    </div>
</div>

<!-- Send Mail to All Modal -->
<div id="sendmailModal" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content admin-modal">
            <div class="modal-header">
                <div>
                    <h5 class="modal-title"><i class="fas fa-paper-plane me-2"
                            style="color:var(--accent-color);"></i>Message All Users</h5>
                    <small style="color:var(--text-color);opacity:0.6;">This will send an email to all registered
                        users</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('admin.send.mail') }}" id="sendAllMailForm">
                    @csrf
                    <input type="hidden" name="send_to_all" value="1">
                    <div class="mb-3">
                        <label class="form-label" style="color:var(--heading-color);font-weight:500;">Subject</label>
                        <input type="text" name="subject" class="admin-form-control" style="border-radius:10px;"
                            placeholder="Enter email subject..." required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label" style="color:var(--heading-color);font-weight:500;">Message</label>
                        <textarea placeholder="Write your message here..." class="admin-form-control"
                            style="border-radius:10px;" name="message" rows="6" required></textarea>
                    </div>
                    <div class="d-flex gap-2 justify-content-end">
                        <button type="button" class="btn btn-outline-secondary"
                            style="border-radius:10px;padding:8px 20px;" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-admin-primary" style="border-radius:10px;padding:8px 24px;"
                            id="sendAllBtn">
                            <i class="fas fa-paper-plane me-2"></i>Send to All
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function setView(view) {
    const gridView = document.getElementById('gridView');
    const listView = document.getElementById('listView');
    const gridBtn = document.getElementById('gridViewBtn');
    const listBtn = document.getElementById('listViewBtn');
    if (view === 'grid') {
        gridView.classList.add('active');
        listView.classList.remove('active');
        gridBtn.classList.add('active');
        listBtn.classList.remove('active');
    } else {
        gridView.classList.remove('active');
        listView.classList.add('active');
        gridBtn.classList.remove('active');
        listBtn.classList.add('active');
    }
    localStorage.setItem('userViewPref', view);
    filterAndPaginate();
}

document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.getElementById("searchInput");
    const numOfRecord = document.getElementById("numofrecord");
    const orderSelect = document.getElementById("order");
    const paginationDiv = document.getElementById("pagination");

    // Restore view preference
    const savedView = localStorage.getItem('userViewPref');
    if (savedView === 'list') setView('list');

    const paginationInfoDiv = document.getElementById('paginationInfo');

    window.filterAndPaginate = function() {
        const filter = searchInput.value.toLowerCase();
        const rowsPerPage = parseInt(numOfRecord.value);
        const order = orderSelect.value;

        const gridItems = Array.from(document.querySelectorAll('#gridView .user-item'));
        const listItems = Array.from(document.querySelectorAll('#listView .user-item'));

        // Build ordered list of matched user keys from grid
        let matchedKeys = [];
        gridItems.forEach(item => {
            const name = item.dataset.name || '';
            const email = item.dataset.email || '';
            if (name.includes(filter) || email.includes(filter)) {
                matchedKeys.push({ name, email, key: name + '|' + email });
            }
        });
        matchedKeys.sort((a, b) => order === 'asc' ? a.name.localeCompare(b.name) : b.name.localeCompare(a.name));

        const totalMatched = matchedKeys.length;
        const totalPages = Math.max(1, Math.ceil(totalMatched / rowsPerPage));
        let currentPage = parseInt(paginationDiv.dataset.page || '1');
        if (currentPage > totalPages) currentPage = 1;

        const start = (currentPage - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        const visibleKeys = new Set(matchedKeys.slice(start, end).map(m => m.key));

        [gridItems, listItems].forEach(viewItems => {
            viewItems.forEach(item => {
                const key = (item.dataset.name || '') + '|' + (item.dataset.email || '');
                item.style.display = visibleKeys.has(key) ? '' : 'none';
            });
        });

        // Pagination info
        const showStart = totalMatched > 0 ? start + 1 : 0;
        const showEnd = Math.min(end, totalMatched);
        paginationInfoDiv.textContent = totalMatched > 0
            ? 'Showing ' + showStart + '–' + showEnd + ' of ' + totalMatched + ' user' + (totalMatched !== 1 ? 's' : '')
            : 'No users found';

        // Pagination buttons
        paginationDiv.innerHTML = '';
        paginationDiv.dataset.page = currentPage;
        if (totalPages <= 1) return;

        const createBtn = (text, page, isActive, isDisabled) => {
            const btn = document.createElement('button');
            btn.innerHTML = text;
            btn.className = 'btn btn-sm ' + (isActive ? 'btn-admin-primary' : '');
            if (!isActive) btn.style.cssText = 'background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);';
            btn.style.borderRadius = '8px';
            btn.style.minWidth = '36px';
            if (isDisabled) { btn.disabled = true; btn.style.opacity = '0.4'; btn.style.cursor = 'default'; }
            else btn.addEventListener('click', () => { paginationDiv.dataset.page = page; filterAndPaginate(); });
            return btn;
        };

        paginationDiv.appendChild(createBtn('‹ Prev', currentPage - 1, false, currentPage <= 1));
        for (let i = 1; i <= totalPages; i++) {
            if (totalPages > 7) {
                if (i === 1 || i === totalPages || Math.abs(i - currentPage) <= 1) {
                    paginationDiv.appendChild(createBtn(i, i, i === currentPage, false));
                } else if ((i === 2 && currentPage > 4) || (i === totalPages - 1 && currentPage < totalPages - 3)) {
                    const dots = document.createElement('span');
                    dots.textContent = '\u2026';
                    dots.style.cssText = 'color:var(--text-color);padding:0 8px;display:flex;align-items:center;';
                    paginationDiv.appendChild(dots);
                }
            } else {
                paginationDiv.appendChild(createBtn(i, i, i === currentPage, false));
            }
        }
        paginationDiv.appendChild(createBtn('Next ›', currentPage + 1, false, currentPage >= totalPages));
    };

    searchInput.addEventListener("input", () => { paginationDiv.dataset.page = 1; filterAndPaginate(); });
    numOfRecord.addEventListener("change", () => { paginationDiv.dataset.page = 1; filterAndPaginate(); });
    orderSelect.addEventListener("change", () => { paginationDiv.dataset.page = 1; filterAndPaginate(); });

    filterAndPaginate();

    // Send form spinner
    document.getElementById('sendAllMailForm').addEventListener('submit', function() {
        const btn = document.getElementById('sendAllBtn');
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Sending...';
        btn.disabled = true;
    });
});
</script>

@include('admin.footer')