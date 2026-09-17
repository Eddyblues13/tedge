@include('admin.header')

<div class="main-content">
    <div class="container-fluid">

        {{-- Toast Alerts --}}
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}<button type="button"
                class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">{{ session('error') }}<button type="button"
                class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        {{-- Page Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <div>
                <h4 class="admin-page-title mb-1">Expert Traders</h4>
                <p class="admin-page-subtitle mb-0">Manage copy trading experts and their profiles</p>
            </div>
            <a href="{{ route('traders.create') }}" class="btn btn-admin-primary">
                <i class="bi bi-plus-circle me-1"></i> Add New Trader
            </a>
        </div>

        {{-- Stats Row --}}
        <div class="row g-3 mb-4">
            <div class="col-sm-6 col-lg-3">
                <div class="admin-stat-card">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon" style="background:rgba(99,102,241,.12);color:#6366f1;">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <div>
                            <div class="stat-label">Total Traders</div>
                            <div class="stat-value">{{ $traders->total() }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="admin-stat-card">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon" style="background:rgba(16,185,129,.12);color:#10b981;">
                            <i class="bi bi-patch-check-fill"></i>
                        </div>
                        <div>
                            <div class="stat-label">Verified</div>
                            <div class="stat-value">{{ $verifiedCount }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="admin-stat-card">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon" style="background:rgba(245,158,11,.12);color:#f59e0b;">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>
                        <div>
                            <div class="stat-label">Avg Return Rate</div>
                            <div class="stat-value">{{ number_format($avgReturnRate, 1) }}%</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="admin-stat-card">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon" style="background:rgba(239,68,68,.12);color:#ef4444;">
                            <i class="bi bi-heart-fill"></i>
                        </div>
                        <div>
                            <div class="stat-label">Total Followers</div>
                            <div class="stat-value">{{ number_format($totalFollowers) }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Search / Filter bar --}}
        <div class="admin-card mb-4 p-3">
            <div class="row g-2 align-items-center">
                <div class="col-md-6">
                    <div class="position-relative">
                        <i class="bi bi-search position-absolute"
                            style="left:14px;top:50%;transform:translateY(-50%);color:var(--text-color);opacity:.5;"></i>
                        <input type="text" id="traderSearch" class="admin-form-control"
                            placeholder="Search traders by name…" style="padding-left:40px;">
                    </div>
                </div>
                <div class="col-md-3">
                    <select id="verifiedFilter" class="admin-form-control">
                        <option value="all">All Status</option>
                        <option value="verified">Verified Only</option>
                        <option value="unverified">Unverified Only</option>
                    </select>
                </div>
                <div class="col-md-3 text-end">
                    <span style="color:var(--text-color);font-size:13px;" id="traderCount">Showing {{ $traders->count()
                        }} of {{ $traders->total() }} traders</span>
                </div>
            </div>
        </div>

        {{-- Trader Cards Grid --}}
        <div class="row g-4" id="traderGrid">
            @forelse($traders as $trader)
            <div class="col-xl-3 col-lg-4 col-md-6 trader-card-col" data-name="{{ strtolower($trader->name) }}"
                data-verified="{{ $trader->is_verified ? 'verified' : 'unverified' }}">
                <div class="trader-profile-card">
                    {{-- Card Header with gradient --}}
                    <div class="trader-card-header">
                        <div class="trader-card-actions">
                            <div class="dropdown">
                                <button class="btn btn-sm" data-bs-toggle="dropdown" style="color:#fff;opacity:.8;">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end"
                                    style="background:var(--card-bg);border:1px solid var(--border-color);">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('traders.edit', $trader->id) }}"
                                            style="color:var(--text-color);">
                                            <i class="bi bi-pencil-square me-2 text-primary"></i> Edit
                                        </a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider" style="border-color:var(--border-color);">
                                    </li>
                                    <li>
                                        <form action="{{ route('traders.destroy', $trader->id) }}" method="POST"
                                            class="delete-trader-form">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="bi bi-trash3 me-2"></i> Delete
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="trader-avatar-wrap">
                            <img src="{{ $trader->picture_url }}" alt="{{ $trader->name }}" class="trader-avatar"
                                onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($trader->name) }}&background=6366f1&color=fff&size=120'">
                            @if($trader->is_verified)
                            <span class="trader-verified-badge" title="Verified Trader">
                                <i class="bi bi-patch-check-fill"></i>
                            </span>
                            @endif
                        </div>
                    </div>

                    {{-- Card Body --}}
                    <div class="trader-card-body">
                        <h6 class="trader-name">{{ $trader->name }}</h6>
                        <span class="trader-role">Expert Trader</span>

                        <div class="trader-stats-grid">
                            <div class="trader-stat-item">
                                <span class="trader-stat-value text-success">{{ number_format($trader->return_rate, 1)
                                    }}%</span>
                                <span class="trader-stat-label">Return Rate</span>
                            </div>
                            <div class="trader-stat-item">
                                <span class="trader-stat-value">{{ number_format($trader->followers) }}</span>
                                <span class="trader-stat-label">Followers</span>
                            </div>
                            <div class="trader-stat-item">
                                <span class="trader-stat-value text-warning">{{ number_format($trader->profit_share, 0)
                                    }}%</span>
                                <span class="trader-stat-label">Profit Share</span>
                            </div>
                        </div>

                        <div class="trader-range">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="trader-range-label">Investment Range</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="trader-range-value">${{ number_format($trader->min_amount, 0) }}</span>
                                <i class="bi bi-arrow-right" style="color:var(--text-color);opacity:.4;"></i>
                                <span class="trader-range-value">${{ number_format($trader->max_amount, 0) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12" id="emptyState">
                <div class="admin-card text-center py-5">
                    <div class="mb-3" style="font-size:48px;opacity:.2;color:var(--text-color);">
                        <i class="bi bi-people"></i>
                    </div>
                    <h5 style="color:var(--heading-color);">No Traders Found</h5>
                    <p style="color:var(--text-color);max-width:400px;margin:0 auto;">Click the button above to add your
                        first expert trader to the platform.</p>
                    <a href="{{ route('traders.create') }}" class="btn btn-admin-primary mt-3">
                        <i class="bi bi-plus-circle me-1"></i> Add Trader
                    </a>
                </div>
            </div>
            @endforelse
        </div>

        @if($traders->hasPages())
        <div class="mt-4 d-flex justify-content-center">{{ $traders->links() }}</div>
        @endif
    </div>
</div>

<style>
    /* Trader Profile Card */
    .trader-profile-card {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        overflow: visible;
        transition: all .3s ease;
    }

    .trader-profile-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 40px rgba(99, 102, 241, .12);
        border-color: rgba(99, 102, 241, .3);
    }

    .trader-card-header {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a78bfa 100%);
        padding: 24px 20px 40px;
        position: relative;
        text-align: center;
        border-radius: 16px 16px 0 0;
    }

    .trader-card-actions {
        position: absolute;
        top: 10px;
        right: 10px;
        z-index: 2;
    }

    .trader-card-actions .dropdown-menu {
        min-width: 140px;
    }

    .trader-card-actions .dropdown-item:hover {
        background: var(--input-bg) !important;
    }

    .trader-avatar-wrap {
        position: relative;
        display: inline-block;
        margin-bottom: -50px;
    }

    .trader-avatar {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        border: 4px solid var(--card-bg);
        object-fit: cover;
        box-shadow: 0 4px 15px rgba(0, 0, 0, .15);
    }

    .trader-verified-badge {
        position: absolute;
        bottom: 2px;
        right: -2px;
        background: var(--card-bg);
        border-radius: 50%;
        width: 26px;
        height: 26px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        color: #6366f1;
    }

    .trader-card-body {
        padding: 56px 20px 20px;
        text-align: center;
    }

    .trader-name {
        color: var(--heading-color);
        font-weight: 700;
        font-size: 16px;
        margin-bottom: 2px;
    }

    .trader-role {
        color: var(--text-color);
        font-size: 12px;
        opacity: .7;
    }

    .trader-stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 8px;
        margin: 18px 0 14px;
        padding: 14px 0;
        border-top: 1px solid var(--border-color);
        border-bottom: 1px solid var(--border-color);
    }

    .trader-stat-item {
        text-align: center;
    }

    .trader-stat-value {
        display: block;
        font-weight: 700;
        font-size: 15px;
        color: var(--heading-color);
    }

    .trader-stat-label {
        display: block;
        font-size: 11px;
        color: var(--text-color);
        opacity: .6;
        margin-top: 2px;
    }

    .trader-range {
        background: var(--input-bg);
        border-radius: 10px;
        padding: 10px 14px;
    }

    .trader-range-label {
        font-size: 11px;
        color: var(--text-color);
        opacity: .6;
        text-transform: uppercase;
        letter-spacing: .5px;
        font-weight: 600;
    }

    .trader-range-value {
        font-weight: 700;
        font-size: 14px;
        color: var(--heading-color);
    }
</style>

@include('admin.footer')

<script>
    document.addEventListener('DOMContentLoaded', function() {

    // === Search & Filter ===
    const searchInput = document.getElementById('traderSearch');
    const filterSelect = document.getElementById('verifiedFilter');
    const countEl = document.getElementById('traderCount');

    function filterCards() {
        const query = searchInput.value.toLowerCase();
        const status = filterSelect.value;
        const cards = document.querySelectorAll('.trader-card-col');
        let shown = 0;
        cards.forEach(card => {
            const name = card.dataset.name;
            const verified = card.dataset.verified;
            const matchSearch = !query || name.includes(query);
            const matchStatus = status === 'all' || verified === status;
            card.style.display = (matchSearch && matchStatus) ? '' : 'none';
            if (matchSearch && matchStatus) shown++;
        });
        if (countEl) countEl.textContent = `Showing ${shown} trader${shown !== 1 ? 's' : ''}`;
    }

    if (searchInput) searchInput.addEventListener('input', filterCards);
    if (filterSelect) filterSelect.addEventListener('change', filterCards);

    // === Delete Trader ===
    document.querySelectorAll('.delete-trader-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            if (!confirm('Are you sure you want to delete this trader? This cannot be undone.')) return;
            const formData = new FormData(this);
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(async r => {
                if (r.redirected) { location.href = r.url; return; }
                const j = await r.json();
                return j;
            })
            .then(data => {
                if (data) {
                    toastr.success(data.message || 'Trader deleted!');
                    const col = form.closest('.trader-card-col');
                    if (col) {
                        col.style.transition = 'opacity .3s';
                        col.style.opacity = '0';
                        setTimeout(() => col.remove(), 300);
                    }
                }
            })
            .catch(() => toastr.error('Error deleting trader'));
        });
    });
});
</script>