@include('admin.header')

<style>
    .trade-page-header {
        background: linear-gradient(135deg, rgba(99, 91, 255, 0.08), rgba(139, 131, 255, 0.04));
        border: 1px solid var(--border-color);
        border-radius: 14px;
        padding: 24px 28px;
        margin-bottom: 24px;
    }

    .trade-stat-mini {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 10px;
        padding: 14px 18px;
        text-align: center;
        min-width: 120px;
    }

    .trade-stat-mini .stat-val {
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--heading-color);
    }

    .trade-stat-mini .stat-lbl {
        font-size: 0.72rem;
        color: var(--text-color);
        opacity: 0.6;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .create-trade-card {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 14px;
        overflow: hidden;
    }

    .create-trade-header {
        padding: 18px 24px;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        justify-content: space-between;
        cursor: pointer;
        user-select: none;
    }

    .create-trade-header:hover {
        background: rgba(99, 91, 255, 0.03);
    }

    .create-trade-header h6 {
        margin: 0;
        color: var(--heading-color);
        font-weight: 600;
        font-size: 0.95rem;
    }

    .create-trade-body {
        padding: 24px;
    }

    .field-group {
        margin-bottom: 20px;
    }

    .field-group label {
        display: block;
        color: var(--heading-color);
        font-weight: 500;
        font-size: 0.82rem;
        margin-bottom: 6px;
    }

    .field-group .admin-form-control {
        border-radius: 10px !important;
    }

    .field-group small.text-danger {
        display: block;
        margin-top: 4px;
        font-size: 0.75rem;
    }

    .direction-toggle {
        display: flex;
        gap: 8px;
    }

    .direction-toggle .dir-btn {
        flex: 1;
        padding: 10px;
        border-radius: 10px;
        border: 1px solid var(--border-color);
        background: var(--card-bg);
        color: var(--text-color);
        text-align: center;
        cursor: pointer;
        transition: all 0.2s;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .direction-toggle .dir-btn:hover {
        border-color: var(--accent-color);
    }

    .direction-toggle .dir-btn.active-up {
        background: rgba(16, 185, 129, 0.12);
        border-color: #10b981;
        color: #10b981;
    }

    .direction-toggle .dir-btn.active-down {
        background: rgba(239, 68, 68, 0.12);
        border-color: #ef4444;
        color: #ef4444;
    }

    .status-toggle {
        display: flex;
        gap: 8px;
    }

    .status-toggle .status-btn {
        flex: 1;
        padding: 10px;
        border-radius: 10px;
        border: 1px solid var(--border-color);
        background: var(--card-bg);
        color: var(--text-color);
        text-align: center;
        cursor: pointer;
        transition: all 0.2s;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .status-toggle .status-btn:hover {
        border-color: var(--accent-color);
    }

    .status-toggle .status-btn.active-status {
        background: rgba(99, 91, 255, 0.12);
        border-color: var(--accent-color);
        color: var(--accent-color);
    }

    .trade-row {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 16px 20px;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        transition: all 0.2s;
    }

    .trade-row:hover {
        border-color: var(--accent-color);
        box-shadow: 0 2px 12px rgba(99, 91, 255, 0.08);
    }

    .trade-symbol {
        font-weight: 700;
        font-size: 0.95rem;
        color: var(--heading-color);
    }

    .trade-detail {
        font-size: 0.8rem;
        color: var(--text-color);
        opacity: 0.7;
    }

    .trade-profit-up {
        color: #10b981;
        font-weight: 600;
    }

    .trade-profit-down {
        color: #ef4444;
        font-weight: 600;
    }

    .trade-badge {
        font-size: 0.7rem;
        padding: 3px 10px;
        border-radius: 20px;
        font-weight: 600;
    }

    .trade-badge.long {
        background: rgba(16, 185, 129, 0.12);
        color: #10b981;
    }

    .trade-badge.short {
        background: rgba(239, 68, 68, 0.12);
        color: #ef4444;
    }

    .trade-badge.active {
        background: rgba(99, 91, 255, 0.12);
        color: var(--accent-color);
    }

    .trade-badge.closed {
        background: rgba(255, 171, 0, 0.12);
        color: #ffab00;
    }

    .trade-actions .btn {
        border-radius: 8px;
        font-size: 0.78rem;
    }

    .modal-content.trade-modal {
        background: var(--card-bg);
        color: var(--text-color);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
    }

    .modal-content.trade-modal .modal-header {
        border-bottom: 1px solid var(--border-color);
        padding: 20px 24px;
    }

    .modal-content.trade-modal .modal-body {
        padding: 24px;
    }

    .modal-content.trade-modal .modal-footer {
        border-top: 1px solid var(--border-color);
        padding: 16px 24px;
    }

    .modal-content.trade-modal .modal-title {
        color: var(--heading-color);
        font-weight: 600;
    }

    .modal-content.trade-modal .btn-close {
        filter: invert(1) grayscale(100%) brightness(200%);
    }

    .empty-trades {
        text-align: center;
        padding: 60px 20px;
        color: var(--text-color);
        opacity: 0.5;
    }

    .empty-trades i {
        font-size: 3rem;
        margin-bottom: 16px;
        display: block;
    }

    @media (max-width: 768px) {
        .trade-row {
            flex-direction: column;
            align-items: flex-start;
        }

        .trade-stat-mini {
            min-width: 80px;
            padding: 10px 12px;
        }

        .trade-stat-mini .stat-val {
            font-size: 0.95rem;
        }
    }
</style>

<div class="main-content">
    <div class="container-fluid">

        <!-- Page Header with Stats -->
        <div class="trade-page-header">
            <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-3">
                <div>
                    <h4 class="admin-page-title mb-1"><i class="fas fa-chart-line me-2"
                            style="color:var(--accent-color);"></i>Trade Manager</h4>
                    <p class="admin-page-subtitle mb-0">Managing trades for <strong
                            style="color:var(--heading-color);">{{ $user->name }}</strong></p>
                </div>
                <a href="{{ route('admin.user.view', $user->id) }}" class="btn btn-sm"
                    style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);border-radius:10px;">
                    <i class="fas fa-arrow-left me-1"></i> Back to User
                </a>
            </div>
            <div class="d-flex gap-3 flex-wrap">
                <div class="trade-stat-mini">
                    <div class="stat-val">{{ $trades->total() }}</div>
                    <div class="stat-lbl">Total Trades</div>
                </div>
                <div class="trade-stat-mini">
                    <div class="stat-val" style="color:#10b981;">{{ $trades->where('status', 'active')->count() }}</div>
                    <div class="stat-lbl">Active</div>
                </div>
                <div class="trade-stat-mini">
                    <div class="stat-val" style="color:#ffab00;">{{ $trades->where('status', 'closed')->count() }}</div>
                    <div class="stat-lbl">Closed</div>
                </div>
            </div>
        </div>

        <!-- Create Trade Section -->
        <div class="create-trade-card mb-4">
            <div class="create-trade-header"
                onclick="document.getElementById('createTradeBody').classList.toggle('d-none'); this.querySelector('.toggle-icon').classList.toggle('fa-chevron-down'); this.querySelector('.toggle-icon').classList.toggle('fa-chevron-up');">
                <h6><i class="fas fa-plus-circle me-2" style="color:var(--accent-color);"></i>Create New Trade</h6>
                <i class="fas fa-chevron-down toggle-icon" style="color:var(--text-color);opacity:0.5;"></i>
            </div>
            <div class="create-trade-body d-none" id="createTradeBody">
                <form id="tradeForm" action="{{ route('admin.trade.history.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <input type="hidden" name="direction" id="directionInput" value="up">
                    <input type="hidden" name="status" id="statusInput" value="active">

                    <div class="row g-3">
                        <!-- Trader -->
                        <div class="col-md-6">
                            <div class="field-group">
                                <label><i class="fas fa-user-tie me-1"></i> Trader</label>
                                <select name="trader_name" class="admin-form-control" required>
                                    <option value="">Select Trader</option>
                                    @foreach(App\Models\Trader::all() as $trader)
                                    <option value="{{ $trader->name }}">{{ $trader->name }}</option>
                                    @endforeach
                                </select>
                                <small id="trader_name-error" class="text-danger"></small>
                            </div>
                        </div>
                        <!-- Symbol -->
                        <div class="col-md-6">
                            <div class="field-group">
                                <label><i class="fas fa-coins me-1"></i> Symbol</label>
                                <input type="text" name="symbol" class="admin-form-control" placeholder="e.g. BTCUSDT, AAPL, EURUSD" required>
                                <small id="symbol-error" class="text-danger"></small>
                            </div>
                        </div>
                        <!-- Direction -->
                        <div class="col-md-6">
                            <div class="field-group">
                                <label><i class="fas fa-arrows-alt-v me-1"></i> Direction</label>
                                <div class="direction-toggle">
                                    <div class="dir-btn active-up" data-dir="up" onclick="setDirection('up')">
                                        <i class="fas fa-arrow-up me-1"></i> Long (UP)
                                    </div>
                                    <div class="dir-btn" data-dir="down" onclick="setDirection('down')">
                                        <i class="fas fa-arrow-down me-1"></i> Short (DOWN)
                                    </div>
                                </div>
                                <small id="direction-error" class="text-danger"></small>
                            </div>
                        </div>
                        <!-- Status -->
                        <div class="col-md-6">
                            <div class="field-group">
                                <label><i class="fas fa-flag me-1"></i> Status</label>
                                <div class="status-toggle">
                                    <div class="status-btn active-status" data-status="active"
                                        onclick="setStatus('active')">
                                        <i class="fas fa-play-circle me-1"></i> Active
                                    </div>
                                    <div class="status-btn" data-status="closed" onclick="setStatus('closed')">
                                        <i class="fas fa-check-circle me-1"></i> Closed
                                    </div>
                                </div>
                                <small id="status-error" class="text-danger"></small>
                            </div>
                        </div>
                        <!-- Amount -->
                        <div class="col-md-4">
                            <div class="field-group">
                                <label><i class="fas fa-dollar-sign me-1"></i> Amount</label>
                                <input type="number" step="0.01" class="admin-form-control" name="amount"
                                    placeholder="0.00" required>
                                <small id="amount-error" class="text-danger"></small>
                            </div>
                        </div>
                        <!-- Profit -->
                        <div class="col-md-4">
                            <div class="field-group">
                                <label><i class="fas fa-chart-bar me-1"></i> Profit</label>
                                <input type="number" step="0.01" class="admin-form-control" name="profit"
                                    placeholder="0.00" required>
                                <small id="profit-error" class="text-danger"></small>
                            </div>
                        </div>
                        <!-- Entry Date -->
                        <div class="col-md-4">
                            <div class="field-group">
                                <label><i class="fas fa-calendar me-1"></i> Entry Date</label>
                                <input type="datetime-local" class="admin-form-control" name="entry_date" required>
                                <small id="entry_date-error" class="text-danger"></small>
                            </div>
                        </div>
                        <!-- Closed Fields (conditional) -->
                        <div class="col-md-4 closed-field" style="display:none;">
                            <div class="field-group">
                                <label><i class="fas fa-sign-out-alt me-1"></i> Exit Price</label>
                                <input type="number" step="0.0001" class="admin-form-control" name="exit_price"
                                    placeholder="0.0000">
                                <small id="exit_price-error" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-4 closed-field" style="display:none;">
                            <div class="field-group">
                                <label><i class="fas fa-calendar-check me-1"></i> Exit Date</label>
                                <input type="datetime-local" class="admin-form-control" name="exit_date">
                                <small id="exit_date-error" class="text-danger"></small>
                            </div>
                        </div>
                        <!-- Notes -->
                        <div class="col-12">
                            <div class="field-group">
                                <label><i class="fas fa-sticky-note me-1"></i> Notes <small
                                        style="opacity:0.5;">(optional)</small></label>
                                <textarea class="admin-form-control" name="notes" rows="2"
                                    placeholder="Add any notes about this trade..."></textarea>
                                <small id="notes-error" class="text-danger"></small>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-2">
                        <button type="submit" class="btn btn-admin-primary" id="submitBtn"
                            style="border-radius:10px;padding:10px 28px;">
                            <i class="fas fa-plus-circle me-1"></i> Create Trade
                        </button>
                        <button type="reset" class="btn"
                            style="border-radius:10px;padding:10px 20px;background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);">
                            <i class="fas fa-undo me-1"></i> Reset
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Trade History -->
        <div class="admin-card" style="border-radius:14px;">
            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2" style="padding:0 4px;">
                <h6 style="color:var(--heading-color);font-weight:600;margin:0;">
                    <i class="fas fa-history me-2" style="color:var(--accent-color);"></i>Trade History
                </h6>
                <div class="d-flex gap-2 align-items-center">
                    <input type="text" id="tradeSearch" class="admin-form-control" placeholder="Search trades..."
                        style="max-width:220px;border-radius:10px;font-size:0.85rem;">
                </div>
            </div>

            @if($trades->count() > 0)
            <div id="tradesList">
                @foreach($trades as $trade)
                <div class="trade-row" id="trade-row-{{ $trade->id }}">
                    <div class="d-flex align-items-center gap-3" style="min-width:200px;">
                        <div>
                            <div class="trade-symbol">{{ $trade->symbol }}</div>
                            <div class="trade-detail">{{ $trade->trader_name ?? 'Unknown' }} · {{ $trade->entry_date ?
                                $trade->entry_date->format('M j, Y') : 'N/A' }}</div>
                        </div>
                    </div>
                    <div class="d-flex gap-2 align-items-center flex-wrap">
                        <span class="trade-badge {{ $trade->direction === 'up' ? 'long' : 'short' }}">
                            <i class="fas fa-arrow-{{ $trade->direction === 'up' ? 'up' : 'down' }} me-1"></i>{{
                            $trade->direction === 'up' ? 'LONG' : 'SHORT' }}
                        </span>
                        <span class="trade-badge {{ $trade->status }}">
                            {{ ucfirst($trade->status) }}
                        </span>
                    </div>
                    <div class="text-end" style="min-width:120px;">
                        <div style="color:var(--heading-color);font-weight:600;font-size:0.9rem;">
                            ${{ number_format($trade->amount, 2) }}
                        </div>
                        <div class="{{ $trade->profit >= 0 ? 'trade-profit-up' : 'trade-profit-down' }}"
                            style="font-size:0.85rem;">
                            {{ $trade->profit >= 0 ? '+' : '' }}${{ number_format($trade->profit ?? 0, 2) }}
                        </div>
                    </div>
                    <div class="trade-actions d-flex gap-1">
                        <button class="btn btn-sm edit-btn"
                            style="background:rgba(99,91,255,0.1);color:var(--accent-color);border:none;"
                            data-trade-id="{{ $trade->id }}" data-trade="{{ $trade }}">
                            <i class="fas fa-pen"></i>
                        </button>
                        <button class="btn btn-sm delete-btn"
                            style="background:rgba(239,68,68,0.1);color:#ef4444;border:none;"
                            data-trade-id="{{ $trade->id }}" data-trade-symbol="{{ $trade->symbol }}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($trades->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $trades->appends(['user' => $user->id])->links('pagination::bootstrap-5') }}
            </div>
            @endif
            @else
            <div class="empty-trades">
                <i class="fas fa-chart-area"></i>
                <h6 style="color:var(--heading-color);">No trades yet</h6>
                <p>Create the first trade for this user using the form above.</p>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Edit Trade Modal -->
<div class="modal fade" id="editTradeModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content trade-modal">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-pen me-2" style="color:var(--accent-color);"></i>Edit Trade
                    #<span id="modalTradeId"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editTradeForm">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" name="id" id="editTradeId">
                    <input type="hidden" name="user_id" value="{{ $user->id }}">

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="field-group">
                                <label>Trader</label>
                                <select name="trader_name" class="admin-form-control" id="editTraderName" required>
                                    @foreach(App\Models\Trader::all() as $trader)
                                    <option value="{{ $trader->name }}">{{ $trader->name }}</option>
                                    @endforeach
                                </select>
                                <small id="edit-trader_name-error" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="field-group">
                                <label>Symbol</label>
                                <input type="text" name="symbol" class="admin-form-control" id="editSymbol" placeholder="e.g. BTCUSDT, AAPL, EURUSD" required>
                                <small id="edit-symbol-error" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="field-group">
                                <label>Direction</label>
                                <select name="direction" class="admin-form-control" id="editDirection" required>
                                    <option value="up">Long (UP)</option>
                                    <option value="down">Short (DOWN)</option>
                                </select>
                                <small id="edit-direction-error" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="field-group">
                                <label>Status</label>
                                <select name="status" class="admin-form-control" id="editStatus" required>
                                    <option value="active">Active</option>
                                    <option value="closed">Closed</option>
                                </select>
                                <small id="edit-status-error" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="field-group">
                                <label>Amount</label>
                                <input type="number" step="0.01" class="admin-form-control" name="amount"
                                    id="editAmount" placeholder="0.00" required>
                                <small id="edit-amount-error" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="field-group">
                                <label>Entry Price</label>
                                <input type="number" step="0.0001" class="admin-form-control" name="entry_price"
                                    id="editEntryPrice">
                                <small id="edit-entry_price-error" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="field-group">
                                <label>Profit</label>
                                <input type="number" step="0.01" class="admin-form-control" name="profit"
                                    id="editProfit" placeholder="0.00">
                                <small id="edit-profit-error" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="field-group">
                                <label>Entry Date</label>
                                <input type="datetime-local" class="admin-form-control" name="entry_date"
                                    id="editEntryDate" required>
                                <small id="edit-entry_date-error" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-6 edit-closed-field" style="display:none;">
                            <div class="field-group">
                                <label>Exit Price</label>
                                <input type="number" step="0.0001" class="admin-form-control" name="exit_price"
                                    id="editExitPrice">
                                <small id="edit-exit_price-error" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-6 edit-closed-field" style="display:none;">
                            <div class="field-group">
                                <label>Exit Date</label>
                                <input type="datetime-local" class="admin-form-control" name="exit_date"
                                    id="editExitDate">
                                <small id="edit-exit_date-error" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="field-group">
                                <label>Notes</label>
                                <textarea class="admin-form-control" name="notes" rows="2" id="editNotes"
                                    placeholder="Notes..."></textarea>
                                <small id="edit-notes-error" class="text-danger"></small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn"
                        style="background:transparent;color:var(--text-color);border:1px solid var(--border-color);border-radius:10px;padding:8px 20px;"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-admin-primary" id="updateTradeBtn"
                        style="border-radius:10px;padding:8px 24px;">
                        <i class="fas fa-save me-1"></i> Update Trade
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteTradeModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content trade-modal">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-exclamation-triangle me-2" style="color:#ef4444;"></i>Delete
                    Trade</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center py-4">
                <div
                    style="width:60px;height:60px;border-radius:50%;background:rgba(239,68,68,0.1);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                    <i class="fas fa-trash-alt" style="font-size:1.4rem;color:#ef4444;"></i>
                </div>
                <h6 style="color:var(--heading-color);font-weight:600;">Delete <span id="deleteTradeSymbol"
                        class="fw-bold"></span> trade?</h6>
                <p style="color:var(--text-color);opacity:0.7;font-size:0.9rem;">This action is <strong
                        style="color:#ef4444;">permanent</strong> and cannot be undone.</p>
            </div>
            <div class="modal-footer justify-content-center" style="border:none;">
                <button type="button" class="btn"
                    style="background:transparent;color:var(--text-color);border:1px solid var(--border-color);border-radius:10px;padding:8px 24px;"
                    data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn"
                    style="border-radius:10px;padding:8px 24px;">
                    <i class="fas fa-trash me-1"></i> Delete Trade
                </button>
            </div>
        </div>
    </div>
</div>

@include('admin.footer')

<script>
    // Direction & Status toggles for create form
function setDirection(dir) {
    document.getElementById('directionInput').value = dir;
    document.querySelectorAll('.direction-toggle .dir-btn').forEach(b => {
        b.classList.remove('active-up', 'active-down');
    });
    document.querySelector(`.dir-btn[data-dir="${dir}"]`).classList.add(dir === 'up' ? 'active-up' : 'active-down');
}

function setStatus(status) {
    document.getElementById('statusInput').value = status;
    document.querySelectorAll('.status-toggle .status-btn').forEach(b => b.classList.remove('active-status'));
    document.querySelector(`.status-btn[data-status="${status}"]`).classList.add('active-status');
    document.querySelectorAll('.closed-field').forEach(f => f.style.display = status === 'closed' ? '' : 'none');
}

// Search trades
document.getElementById('tradeSearch')?.addEventListener('input', function() {
    const filter = this.value.toLowerCase();
    document.querySelectorAll('.trade-row').forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(filter) ? '' : 'none';
    });
});

$(document).ready(function() {
    // Create trade form
    $('#tradeForm').on('submit', function(e) {
        e.preventDefault();
        $('.text-danger').text('');
        $('#submitBtn').prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span> Creating...');
        let formData = new FormData(this);
        $.ajax({
            url: $(this).attr('action'),
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                toastr.success(response.message || 'Trade created successfully!');
                $('#tradeForm')[0].reset();
                setDirection('up');
                setStatus('active');
                setTimeout(() => { window.location.reload(); }, 1500);
            },
            error: function(xhr) {
                $('#submitBtn').prop('disabled', false).html('<i class="fas fa-plus-circle me-1"></i> Create Trade');
                if(xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, value) { $(`#${key}-error`).text(value[0]); });
                    toastr.error('Please fix the form errors');
                } else {
                    toastr.error(xhr.responseJSON?.message || 'An error occurred');
                }
            }
        });
    });

    // Edit Trade
    $(document).on('click', '.edit-btn', function() {
        const trade = $(this).data('trade');
        const tradeId = $(this).data('trade-id');
        $('#modalTradeId').text(tradeId);
        $('#editTradeId').val(tradeId);
        $('#editTraderName').val(trade.trader_name);
        $('#editSymbol').val(trade.symbol);
        $('#editDirection').val(trade.direction);
        $('#editAmount').val(trade.amount);
        $('#editEntryPrice').val(trade.entry_price);
        $('#editProfit').val(trade.profit);
        $('#editStatus').val(trade.status);
        $('#editEntryDate').val(trade.entry_date ? new Date(trade.entry_date).toISOString().slice(0, 16) : '');
        $('#editExitPrice').val(trade.exit_price);
        $('#editExitDate').val(trade.exit_date ? new Date(trade.exit_date).toISOString().slice(0, 16) : '');
        $('#editNotes').val(trade.notes);
        toggleEditClosedFields(trade.status);
        $('#editTradeModal').modal('show');
    });

    // Delete Trade
    $(document).on('click', '.delete-btn', function() {
        const tradeId = $(this).data('trade-id');
        const tradeSymbol = $(this).data('trade-symbol');
        $('#deleteTradeSymbol').text(tradeSymbol);
        $('#confirmDeleteBtn').data('trade-id', tradeId);
        $('#deleteTradeModal').modal('show');
    });

    // Confirm Delete
    $('#confirmDeleteBtn').click(function() {
        const tradeId = $(this).data('trade-id');
        $(this).prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span> Deleting...');
        $.ajax({
            url: "{{ route('admin.trade.history.destroy', '') }}/" + tradeId,
            type: 'DELETE',
            data: { _token: "{{ csrf_token() }}" },
            success: function(response) {
                toastr.success(response.message || 'Trade deleted');
                $('#trade-row-' + tradeId).fadeOut(300, function() { $(this).remove(); });
                $('#deleteTradeModal').modal('hide');
                $('#confirmDeleteBtn').prop('disabled', false).html('<i class="fas fa-trash me-1"></i> Delete Trade');
            },
            error: function(xhr) {
                toastr.error(xhr.responseJSON?.message || 'Error deleting trade');
                $('#confirmDeleteBtn').prop('disabled', false).html('<i class="fas fa-trash me-1"></i> Delete Trade');
            }
        });
    });

    // Edit Status Change
    $('#editStatus').change(function() { toggleEditClosedFields($(this).val()); });

    function toggleEditClosedFields(status) {
        const show = status === 'closed';
        $('.edit-closed-field').toggle(show);
        if (show && !$('#editExitDate').val()) {
            const now = new Date();
            const offset = now.getTimezoneOffset() * 60000;
            $('#editExitDate').val(new Date(now - offset).toISOString().slice(0, 16));
        }
    }

    // Edit form submit
    $('#editTradeForm').on('submit', function(e) {
        e.preventDefault();
        $('.text-danger').text('');
        $('#updateTradeBtn').prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span> Updating...');
        const tradeId = $('#editTradeId').val();
        let formData = new FormData(this);
        $.ajax({
            url: "{{ route('admin.trade.history.update', '') }}/" + tradeId,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                toastr.success(response.message || 'Trade updated!');
                $('#editTradeModal').modal('hide');
                setTimeout(() => { window.location.reload(); }, 1500);
            },
            error: function(xhr) {
                $('#updateTradeBtn').prop('disabled', false).html('<i class="fas fa-save me-1"></i> Update Trade');
                if(xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, value) { $(`#edit-${key}-error`).text(value[0]); });
                    toastr.error('Please fix the form errors');
                } else {
                    toastr.error(xhr.responseJSON?.message || 'An error occurred');
                }
            }
        });
    });
});
</script>