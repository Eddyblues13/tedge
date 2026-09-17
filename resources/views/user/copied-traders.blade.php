@include('user.layouts.header')

<style>
    .page-title {
        color: var(--heading-color);
        font-weight: 700;
    }

    .page-subtitle {
        color: var(--text-color);
    }

    .trades-card {
        background-color: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .custom-table {
        color: var(--heading-color);
        margin-bottom: 0;
        --bs-table-bg: transparent;
        --bs-table-hover-bg: var(--input-bg);
        --bs-table-hover-color: var(--heading-color);
        --bs-table-striped-bg: var(--input-bg);
        --bs-table-color: var(--heading-color);
        background-color: var(--card-bg);
    }

    .custom-table th {
        border-bottom: 2px solid var(--border-color);
        border-top: none;
        color: var(--text-color);
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        padding: 1rem;
        background-color: var(--card-bg);
    }

    .custom-table td {
        border-top: 1px solid var(--border-color);
        border-bottom: none;
        vertical-align: middle;
        padding: 1rem;
        color: var(--heading-color);
        background-color: var(--card-bg);
    }

    .custom-table tbody tr:hover td {
        background-color: var(--input-bg);
        color: var(--heading-color);
    }

    .trader-name {
        color: var(--heading-color);
        font-weight: 600;
    }

    .filter-btn {
        border-radius: 8px;
        margin-right: 5px;
        font-weight: 500;
        transition: all 0.2s;
    }

    .filter-btn.active {
        color: #fff !important;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .table-container {
        border-radius: 12px;
        overflow: hidden;
    }

    /* Override Bootstrap table defaults for dark mode */
    .dark .custom-table,
    .dark .custom-table th,
    .dark .custom-table td {
        border-color: var(--border-color);
    }

    .dark .card.trades-card {
        background-color: var(--card-bg);
    }
</style>

<div class="main-content" style="padding-bottom: 100px;">
    <div class="container py-4">
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="page-title">My Copied Trades</h2>
                <p class="page-subtitle">View all traders you're currently copying</p>
            </div>
        </div>

        <!-- Status Filters -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-outline-primary filter-btn active"
                        data-status="all">All</button>
                    <button type="button" class="btn btn-outline-success filter-btn"
                        data-status="active">Active</button>
                    <button type="button" class="btn btn-outline-warning filter-btn"
                        data-status="pending">Pending</button>
                    <button type="button" class="btn btn-outline-danger filter-btn" data-status="closed">Closed</button>
                </div>
            </div>
        </div>

        <!-- Copied Trades Table -->
        <div class="card trades-card border-0">
            <div class="card-body p-0">
                <div class="table-responsive table-container">
                    <table class="table custom-table table-hover">
                        <thead>
                            <tr>
                                <th>Trader</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tradingHistory as $history)
                            <tr class="trade-row" data-status="{{ strtolower($history->status) }}">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset($history->trader->picture) }}"
                                            alt="{{ $history->trader->name }}" class="rounded-circle me-3" width="40"
                                            height="40" style="object-fit: cover;">
                                        <div>
                                            <div class="trader-name">{{ $history->trader->name }}</div>
                                            <div class="small" style="color: var(--text-color);">
                                                Return: <span class="text-success">{{ $history->trader->return_rate
                                                    }}%</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="fw-bold text-nowrap">${{ number_format($history->amount, 2) }}</td>
                                <td>
                                    <span class="badge rounded-pill px-3 py-2
                                    @if($history->status == 'active') bg-success
                                    @elseif($history->status == 'pending') bg-warning text-dark
                                    @elseif($history->status == 'closed') bg-secondary
                                    @else bg-info @endif">
                                        {{ ucfirst($history->status) }}
                                    </span>
                                </td>
                                <td style="color: var(--text-color);" class="text-nowrap">{{
                                    $history->created_at->format('M d, Y H:i') }}</td>
                                <td class="text-nowrap">
                                    @if($history->status == 'active')
                                    <button class="btn btn-sm btn-outline-danger stop-trade"
                                        data-trade-id="{{ $history->id }}" title="Stop Copying">
                                        <i class="fas fa-stop"></i>
                                    </button>
                                    @endif
                                    <a href="#" class="btn btn-sm btn-outline-info" title="View Trader">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="fas fa-exchange-alt fa-3x mb-3" style="color: var(--text-color);"></i>
                                        <p class="mb-3">You haven't copied any traders yet</p>
                                        <a href="{{route('copy.trade')}}" class="btn btn-primary px-4 rounded-pill">
                                            Browse Traders
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($tradingHistory->hasPages())
                <div class="d-flex justify-content-center mt-4 mb-3">
                    {{ $tradingHistory->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@include('user.layouts.footer')

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    $(document).ready(function() {
    // Filter trades by status
    $('.filter-btn').click(function() {
        const status = $(this).data('status');
        
        // Update active button
        $('.filter-btn').removeClass('active');
        $(this).addClass('active');
        
        // Show/hide rows
        if (status === 'all') {
            $('.trade-row').show();
        } else {
            $('.trade-row').hide();
            $(`.trade-row[data-status="${status}"]`).show();
        }
    });

    // Stop trade functionality
    $('.stop-trade').click(function() {
        const button = $(this);
        const tradeId = button.data('trade-id');
        
        if (!confirm('Are you sure you want to stop copying this trader?')) {
            return;
        }

        button.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');

        $.ajax({
            url: '{{ route("copied.traders.stop") }}',
            type: 'POST',
            data: {
                trade_id: tradeId,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    toastr.success(response.message);
                    // Reload after 1 second
                    setTimeout(() => location.reload(), 1000);
                } else {
                    toastr.error(response.message);
                    button.prop('disabled', false).html('<i class="fas fa-stop"></i>');
                }
            },
            error: function(xhr) {
                toastr.error('An error occurred. Please try again.');
                button.prop('disabled', false).html('<i class="fas fa-stop"></i>');
            }
        });
    });

    // Toastr configuration
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "5000"
    };
});
</script>