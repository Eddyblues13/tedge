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

        {{-- Page Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <div>
                <h4 class="admin-page-title mb-1">Manage Account Plans</h4>
                <p class="admin-page-subtitle mb-0">Create and manage trading account plans</p>
            </div>
            <button class="btn btn-admin-primary" onclick="openCreateModal()">
                <i class="bi bi-plus-lg me-1"></i> New Plan
            </button>
        </div>

        {{-- Stats Row --}}
        <div class="row g-3 mb-4">
            <div class="col-sm-6 col-lg-3">
                <div class="admin-stat-card">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon" style="background:rgba(99,102,241,.12);color:#6366f1;">
                            <i class="bi bi-collection"></i>
                        </div>
                        <div>
                            <div class="stat-label">Total Plans</div>
                            <div class="stat-value">{{ $totalPlans }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="admin-stat-card">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon" style="background:rgba(16,185,129,.12);color:#10b981;">
                            <i class="bi bi-cash-coin"></i>
                        </div>
                        <div>
                            <div class="stat-label">Avg Price</div>
                            <div class="stat-value">${{ number_format($avgPrice, 2) }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="admin-stat-card">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon" style="background:rgba(245,158,11,.12);color:#f59e0b;">
                            <i class="bi bi-arrow-down-circle"></i>
                        </div>
                        <div>
                            <div class="stat-label">Lowest Price</div>
                            <div class="stat-value">${{ number_format($minPrice, 2) }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="admin-stat-card">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon" style="background:rgba(139,92,246,.12);color:#8b5cf6;">
                            <i class="bi bi-arrow-up-circle"></i>
                        </div>
                        <div>
                            <div class="stat-label">Highest Price</div>
                            <div class="stat-value">${{ number_format($maxPrice, 2) }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Plan Cards Grid --}}
        <div class="row g-4" id="planCardsContainer">
            @foreach($plans as $index => $plan)
            @php
            $gradients = [
            ['#6366f1','#8b5cf6'],
            ['#10b981','#059669'],
            ['#f59e0b','#d97706'],
            ['#ef4444','#dc2626'],
            ['#3b82f6','#2563eb'],
            ['#ec4899','#db2777'],
            ['#14b8a6','#0d9488'],
            ['#f97316','#ea580c'],
            ];
            $g = $gradients[$index % count($gradients)];
            @endphp
            <div class="col-sm-6 col-lg-4 col-xl-3 plan-card-wrapper" data-plan-id="{{ $plan->id }}">
                <div class="plan-card">
                    {{-- Gradient Header --}}
                    <div class="plan-card-header" style="background:linear-gradient(135deg,{{ $g[0] }},{{ $g[1] }});">
                        <div class="plan-card-price">${{ number_format($plan->price, 2) }}</div>
                        <div class="plan-card-name">{{ $plan->name }}</div>
                    </div>

                    {{-- Body --}}
                    <div class="plan-card-body">
                        <div class="plan-detail-row">
                            <span class="plan-detail-label"><i class="bi bi-arrow-left-right me-2"></i>Swap Fee</span>
                            <span class="plan-detail-value">
                                @if($plan->swap_fee)
                                <span class="admin-badge-success"><i class="bi bi-check-lg me-1"></i>Yes</span>
                                @else
                                <span class="admin-badge-secondary"><i class="bi bi-x-lg me-1"></i>No</span>
                                @endif
                            </span>
                        </div>
                        <div class="plan-detail-row">
                            <span class="plan-detail-label"><i class="bi bi-graph-up me-2"></i>Trading Pairs</span>
                            <span class="plan-detail-value plan-pairs-value">{{ $plan->pairs }}</span>
                        </div>
                        <div class="plan-detail-row">
                            <span class="plan-detail-label"><i class="bi bi-lightning me-2"></i>Leverage</span>
                            <span class="plan-detail-value">{{ $plan->leverage ?? '—' }}</span>
                        </div>
                        <div class="plan-detail-row">
                            <span class="plan-detail-label"><i class="bi bi-bar-chart me-2"></i>Spread</span>
                            <span class="plan-detail-value">{{ $plan->spread ?? '—' }}</span>
                        </div>
                    </div>

                    {{-- Footer Actions --}}
                    <div class="plan-card-footer">
                        <button class="btn plan-edit-btn"
                            onclick="openEditModal({{ $plan->id }}, '{{ addslashes($plan->name) }}', {{ $plan->price }}, {{ $plan->swap_fee ? 1 : 0 }}, {{ $plan->pairs }}, '{{ addslashes($plan->leverage ?? '') }}', '{{ addslashes($plan->spread ?? '') }}')">
                            <i class="bi bi-pencil-square me-1"></i>Edit
                        </button>
                        <button class="btn plan-delete-btn"
                            onclick="confirmDelete({{ $plan->id }}, '{{ addslashes($plan->name) }}')">
                            <i class="bi bi-trash3 me-1"></i>Delete
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @if($plans->isEmpty())
        <div class="admin-card text-center py-5">
            <div style="font-size:48px;opacity:.3;margin-bottom:12px;"><i class="bi bi-collection"></i></div>
            <h5 style="color:var(--heading-color);font-weight:600;">No Plans Yet</h5>
            <p style="color:var(--text-color);opacity:.6;">Create your first trading plan to get started.</p>
            <button class="btn btn-admin-primary" onclick="openCreateModal()">
                <i class="bi bi-plus-lg me-1"></i> Create Plan
            </button>
        </div>
        @endif
    </div>
</div>

{{-- Create / Edit Modal --}}
<div class="modal fade" id="planModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content"
            style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);border-radius:16px;overflow:hidden;">
            <div class="modal-header"
                style="border-color:var(--border-color);background:linear-gradient(135deg,rgba(99,102,241,.08),rgba(139,92,246,.08));">
                <h5 class="modal-title" id="planModalTitle" style="color:var(--heading-color);font-weight:700;">
                    <i class="bi bi-collection me-2"></i>Create Plan
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="planForm">
                @csrf
                <input type="hidden" id="planId" name="plan_id" value="">
                <input type="hidden" id="planMethod" name="_method" value="POST">
                <div class="modal-body p-4">
                    <div id="planFormErrors" class="alert alert-danger d-none"></div>

                    <div class="mb-3">
                        <label class="form-label"
                            style="color:var(--heading-color);font-weight:600;font-size:13px;">Plan Name <span
                                class="text-danger">*</span></label>
                        <input type="text" id="planName" name="name" class="admin-form-control"
                            placeholder="e.g. Basic, Standard, Premium" required>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label"
                                style="color:var(--heading-color);font-weight:600;font-size:13px;">Price ($) <span
                                    class="text-danger">*</span></label>
                            <div class="position-relative">
                                <span class="position-absolute"
                                    style="left:14px;top:50%;transform:translateY(-50%);color:var(--text-color);opacity:.5;font-weight:700;">$</span>
                                <input type="number" step="0.01" id="planPrice" name="price" class="admin-form-control"
                                    style="padding-left:28px;" placeholder="0.00" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"
                                style="color:var(--heading-color);font-weight:600;font-size:13px;">Trading Pairs <span
                                    class="text-danger">*</span></label>
                            <input type="number" id="planPairs" name="pairs" class="admin-form-control" value="76"
                                required>
                        </div>
                    </div>

                    <div class="row g-3 mt-1">
                        <div class="col-md-6">
                            <label class="form-label"
                                style="color:var(--heading-color);font-weight:600;font-size:13px;">Leverage</label>
                            <input type="text" id="planLeverage" name="leverage" class="admin-form-control"
                                placeholder="e.g. 1:500">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"
                                style="color:var(--heading-color);font-weight:600;font-size:13px;">Spread</label>
                            <input type="text" id="planSpread" name="spread" class="admin-form-control"
                                placeholder="e.g. 0.8 pips">
                        </div>
                    </div>

                    <div class="mt-3">
                        <label class="form-label"
                            style="color:var(--heading-color);font-weight:600;font-size:13px;">Swap Fee</label>
                        <div class="d-flex gap-3">
                            <label class="plan-radio-option">
                                <input type="radio" name="swap_fee" value="0" checked class="form-check-input me-2"> No
                            </label>
                            <label class="plan-radio-option">
                                <input type="radio" name="swap_fee" value="1" class="form-check-input me-2"> Yes
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="border-color:var(--border-color);">
                    <button type="button" class="btn btn-outline-secondary btn-sm"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-admin-primary btn-sm" id="planSubmitBtn">
                        <i class="bi bi-check-lg me-1"></i> Create Plan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Delete Confirm Modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content"
            style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);border-radius:16px;">
            <div class="modal-body text-center py-4">
                <div class="mb-3" style="font-size:48px;"><i class="bi bi-trash3" style="color:#ef4444;"></i></div>
                <h5 style="color:var(--heading-color);font-weight:600;">Delete Plan</h5>
                <p class="mb-0" style="color:var(--text-color);font-size:14px;">
                    Are you sure you want to delete <strong id="deletePlanName"></strong>? This action cannot be undone.
                </p>
            </div>
            <div class="modal-footer justify-content-center" style="border-color:var(--border-color);">
                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger btn-sm" id="confirmDeleteBtn">
                    <i class="bi bi-trash3 me-1"></i>Yes, Delete
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    /* ── Plan Cards ───────────────────────────────────── */
    .plan-card {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        overflow: hidden;
        transition: all .3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .plan-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 40px rgba(0, 0, 0, .15);
        border-color: color-mix(in srgb, var(--accent-color) 30%, transparent);
    }

    .plan-card-header {
        padding: 28px 24px 22px;
        text-align: center;
        position: relative;
    }

    .plan-card-header::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 0;
        right: 0;
        height: 20px;
        background: var(--card-bg);
        border-radius: 20px 20px 0 0;
    }

    .plan-card-price {
        font-size: 32px;
        font-weight: 800;
        color: #fff;
        line-height: 1;
        margin-bottom: 6px;
        text-shadow: 0 2px 8px rgba(0, 0, 0, .15);
    }

    .plan-card-name {
        font-size: 15px;
        font-weight: 600;
        color: rgba(255, 255, 255, .9);
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* Body */
    .plan-card-body {
        padding: 16px 24px 8px;
        flex: 1;
    }

    .plan-detail-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid var(--border-color);
    }

    .plan-detail-row:last-child {
        border-bottom: none;
    }

    .plan-detail-label {
        color: var(--text-color);
        font-size: 13px;
        font-weight: 500;
        display: flex;
        align-items: center;
    }

    .plan-detail-label i {
        color: var(--accent-color);
        font-size: 14px;
    }

    .plan-detail-value {
        color: var(--heading-color);
        font-weight: 600;
        font-size: 13px;
    }

    .plan-pairs-value {
        background: color-mix(in srgb, var(--accent-color) 12%, transparent);
        color: var(--accent-color);
        padding: 2px 10px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 700;
    }

    /* Footer */
    .plan-card-footer {
        display: flex;
        gap: 8px;
        padding: 16px 24px 20px;
        border-top: 1px solid var(--border-color);
    }

    .plan-edit-btn {
        flex: 1;
        background: color-mix(in srgb, var(--accent-color) 12%, transparent);
        color: var(--accent-color);
        border-radius: 10px;
        font-weight: 600;
        font-size: 13px;
        padding: 8px 0;
        transition: all .2s;
    }

    .plan-edit-btn:hover {
        background: var(--accent-color);
        color: #fff;
    }

    .plan-delete-btn {
        flex: 1;
        background: rgba(239, 68, 68, .1);
        color: #ef4444;
        border-radius: 10px;
        font-weight: 600;
        font-size: 13px;
        padding: 8px 0;
        transition: all .2s;
    }

    .plan-delete-btn:hover {
        background: #ef4444;
        color: #fff;
    }

    /* Radio Options */
    .plan-radio-option {
        display: flex;
        align-items: center;
        padding: 8px 16px;
        border-radius: 10px;
        border: 1px solid var(--border-color);
        background: var(--input-bg);
        color: var(--heading-color);
        font-weight: 500;
        font-size: 13px;
        cursor: pointer;
        transition: all .2s;
    }

    .plan-radio-option:hover {
        border-color: var(--accent-color);
    }

    /* Badge secondary */
    .admin-badge-secondary {
        display: inline-flex;
        align-items: center;
        padding: 3px 10px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
        background: rgba(107, 114, 128, .12);
        color: var(--text-color);
    }
</style>

@include('admin.footer')

<script>
    $(document).ready(function() {

    const planModal = new bootstrap.Modal(document.getElementById('planModal'));
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    let deletePlanId = null;

    // ── Open Create Modal ────────────────────────────
    window.openCreateModal = function() {
        $('#planModalTitle').html('<i class="bi bi-plus-circle me-2"></i>Create New Plan');
        $('#planSubmitBtn').html('<i class="bi bi-check-lg me-1"></i> Create Plan');
        $('#planId').val('');
        $('#planMethod').val('POST');
        $('#planForm')[0].reset();
        $('#planFormErrors').addClass('d-none').empty();
        $('input[name="swap_fee"][value="0"]').prop('checked', true);
        $('#planPairs').val(76);
        planModal.show();
    };

    // ── Open Edit Modal ──────────────────────────────
    window.openEditModal = function(id, name, price, swapFee, pairs, leverage, spread) {
        $('#planModalTitle').html('<i class="bi bi-pencil-square me-2"></i>Edit Plan');
        $('#planSubmitBtn').html('<i class="bi bi-check-lg me-1"></i> Update Plan');
        $('#planId').val(id);
        $('#planMethod').val('PUT');
        $('#planName').val(name);
        $('#planPrice').val(price);
        $('#planPairs').val(pairs);
        $('#planLeverage').val(leverage);
        $('#planSpread').val(spread);
        $(`input[name="swap_fee"][value="${swapFee}"]`).prop('checked', true);
        $('#planFormErrors').addClass('d-none').empty();
        planModal.show();
    };

    // ── Submit Form (Create / Update) ────────────────
    $('#planForm').on('submit', function(e) {
        e.preventDefault();
        const btn = $('#planSubmitBtn');
        const orig = btn.html();
        const isEdit = $('#planId').val() !== '';
        const url = isEdit
            ? `/admin/plans/${$('#planId').val()}`
            : '{{ route("admin.plans.store") }}';

        btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span> Saving…');
        $('#planFormErrors').addClass('d-none').empty();

        $.ajax({
            url: url,
            type: 'POST',
            data: $(this).serialize(),
            success: function(r) {
                planModal.hide();
                toastr.success(r.message || 'Plan saved successfully!');
                setTimeout(() => location.reload(), 1000);
            },
            error: function(xhr) {
                btn.prop('disabled', false).html(orig);
                if (xhr.status === 422) {
                    let html = '<ul class="mb-0">';
                    $.each(xhr.responseJSON.errors, function(k, v) { html += '<li>' + v[0] + '</li>'; });
                    html += '</ul>';
                    $('#planFormErrors').html(html).removeClass('d-none');
                } else {
                    toastr.error(xhr.responseJSON?.message || 'An error occurred');
                }
            }
        });
    });

    // ── Delete Confirm ───────────────────────────────
    window.confirmDelete = function(id, name) {
        deletePlanId = id;
        $('#deletePlanName').text(name);
        deleteModal.show();
    };

    $('#confirmDeleteBtn').on('click', function() {
        if (!deletePlanId) return;
        const btn = $(this);
        const orig = btn.html();
        btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span> Deleting…');

        $.ajax({
            url: `/admin/plans/${deletePlanId}`,
            type: 'DELETE',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(r) {
                deleteModal.hide();
                toastr.success(r.message || 'Plan deleted!');
                $(`.plan-card-wrapper[data-plan-id="${deletePlanId}"]`).fadeOut(400, function() { $(this).remove(); });
                deletePlanId = null;
            },
            error: function(xhr) {
                deleteModal.hide();
                toastr.error(xhr.responseJSON?.message || 'Error deleting plan');
                btn.prop('disabled', false).html(orig);
            }
        });
    });
});
</script>