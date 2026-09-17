@include('user.layouts.header')

<style>
    .trader-card {
        background-color: var(--card-bg);
        border: 1px solid var(--border-color);
        transition: transform 0.2s, background-color 0.3s;
        border-radius: 12px;
    }

    .trader-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }

    .dark .trader-card:hover {
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3);
    }

    .profile-image {
        border: 3px solid var(--primary-link-colour, #0d6efd);
        object-fit: cover;
    }

    .stat-value {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--heading-color);
    }

    .stat-label {
        font-size: 0.85rem;
        color: var(--text-color);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .trader-name {
        color: var(--heading-color);
        font-weight: 700;
    }

    .trader-label {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        background-color: var(--input-bg);
        color: var(--text-color);
        border: 1px solid var(--border-color);
    }

    .search-bar {
        background-color: var(--card-bg);
        border: 1px solid var(--border-color);
        color: var(--heading-color);
        padding: 12px 20px;
        border-radius: 8px;
    }

    .search-bar:focus {
        background-color: var(--card-bg);
        color: var(--heading-color);
        border-color: var(--primary-link-colour, #0d6efd);
        box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.15);
    }

    .search-bar::placeholder {
        color: var(--text-color);
    }

    .balance-display {
        background-color: var(--card-bg);
        border: 1px solid var(--border-color);
        color: var(--heading-color);
        border-radius: 12px;
    }

    .copy-button {
        transition: all 0.3s;
        font-weight: 700;
        letter-spacing: 0.05em;
    }

    .verified-badge {
        color: var(--primary-link-colour, #0d6efd);
    }
</style>

<!-- Main Content -->
<div class="main-content" style="padding-bottom: 100px;">
    <div class="trading-main-content mx-4 my-4">

        <!-- Balance Display -->
        <div class="balance-display mb-4 p-4 d-flex align-items-center justify-content-between shadow-sm">
            <h5 class="mb-0 fw-bold">Trading Balance:</h5>
            <h4 class="mb-0 fw-bold text-success">$<span id="currentTradingBalance">{{ number_format($tradingBalance, 2)
                    }}</span></h4>
        </div>

        <!-- Search -->
        <div class="search-container mb-4 d-flex gap-3">
            <input type="text" id="searchInput" class="form-control search-bar" placeholder="Search traders by name...">
            <a href="{{ route('copied.traders') }}"
                class="btn btn-info text-white d-flex align-items-center px-4 fw-bold">
                <i class="fas fa-list-check me-2"></i> My Copies
            </a>
        </div>

        <!-- Trader Cards Container -->
        <div id="tradersContainer">
            @foreach($traders as $trader)
            <div class="row mb-3 trader-card-wrapper">
                <div class="col-12">
                    <div class="trader-card p-4">
                        <div class="row align-items-center">
                            <!-- Left Column with Image and Button -->
                            <div class="col-md-3 text-center mb-3 mb-md-0">
                                <img src="{{ asset($trader->picture_url) }}" alt="{{ $trader->name }}"
                                    class="profile-image mb-3 rounded-circle" width="90" height="90">
                                <button class="btn btn-primary copy-button w-100 py-2 rounded-3"
                                    data-trader-id="{{ $trader->id }}" data-min-amount="{{ $trader->min_amount }}"
                                    data-trader-name="{{ $trader->name }}">
                                    COPY TRADE
                                </button>
                            </div>

                            <!-- Right Column with Info and Stats -->
                            <div class="col-md-9">
                                <div class="h-100 d-flex flex-column justify-content-center">
                                    <div class="d-flex align-items-center flex-wrap mb-2">
                                        <span class="h4 me-2 mb-0 trader-name">{{ $trader->name }}</span>
                                        @if($trader->is_verified)
                                        <span class="verified-badge fs-5 me-2" title="Verified Trader">
                                            <i class="fas fa-check-circle"></i>
                                        </span>
                                        @endif
                                        <span class="trophy" title="Top Trader">🏆</span>
                                    </div>

                                    <div class="mb-4">
                                        <span class="trader-label badge rounded-pill px-3 py-2">{{ $trader->category ??
                                            'Professional Trader' }}</span>
                                    </div>

                                    <div class="row g-3">
                                        <div class="col-4 col-md-4 stat-item">
                                            <div class="stat-value text-success">{{ $trader->return_rate }}%</div>
                                            <div class="stat-label">Avg. Return</div>
                                        </div>
                                        <div class="col-4 col-md-4 stat-item text-center">
                                            <div class="stat-value">{{ number_format($trader->followers) }}</div>
                                            <div class="stat-label">Followers</div>
                                        </div>
                                        <div class="col-4 col-md-4 stat-item text-end">
                                            <div class="stat-value text-warning">{{ $trader->profit_share }}%</div>
                                            <div class="stat-label">Profit Share</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
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
        // Search functionality
        $('#searchInput').on('input', function() {
            const searchQuery = this.value.toLowerCase();
            $('.trader-card-wrapper').each(function() {
                const traderName = $(this).find('.trader-name').text().toLowerCase();
                $(this).toggle(traderName.includes(searchQuery));
            });
        });

        // Copy trade functionality
        $('.copy-button').on('click', function() {
            const button = $(this);
            const traderId = button.data('trader-id');
            const amount = parseFloat(button.data('min-amount'));
            const traderName = button.data('trader-name');
            
            // Confirm dialog with trader details
            if (!confirm(`Confirm copying ${traderName} with $${amount.toFixed(2)}?`)) {
                return;
            }

            button.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Processing...');

            $.ajax({
                url: '{{ route("copy.trader") }}',
                type: 'POST',
                data: {
                    trader_id: traderId,
                    amount: amount,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        button.removeClass('btn-primary')
                             .addClass('btn-success')
                             .html('<i class="fas fa-check"></i> Copied');
                        
                        // Update balance display
                        if (response.new_balance !== undefined) {
                            $('#currentTradingBalance').text(response.new_balance.toFixed(2));
                        }
                        
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                        button.prop('disabled', false).text('COPY TRADE');
                    }
                },
                error: function(xhr) {
                    const errorMsg = xhr.responseJSON?.message || 'Failed to process request';
                    toastr.error(errorMsg);
                    button.prop('disabled', false).text('COPY TRADE');
                }
            });
        });
    });

    // Initialize Toastr
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "5000"
    };
</script>