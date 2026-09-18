@include('user.layouts.header')


<!-- Main Content -->
<div class="mx-3 my-4">
    <!-- Notification (only shown if session flag is set) -->
    @if(session('show_notification'))
    <div class="notification" id="withdrawal-notification">
        <div class="notification-text">
            @if(session('withdrawal_method') === 'bank')
            Withdrawal will be pending until the bank transfer has been processed.
            @else
            Withdrawal will be pending until there are sufficient confirmations on the blockchain.
            @endif
        </div>
        <button class="close-button" id="close-notification">&times;</button>
    </div>
    @endif

    <!-- New Withdrawal Buttons -->
    <div class="d-flex justify-content-center gap-2 mb-3">
        <a href="{{ route('crypto.withdrawal') }}" class="withdrawal-btn-up text-center text-decoration-none">
            <i class="bi bi-currency-bitcoin me-1"></i>CRYPTO WITHDRAWAL
        </a>
        <a href="{{ route('bank.withdrawal') }}" class="withdrawal-btn-up text-center text-decoration-none">
            <i class="bi bi-bank me-1"></i>BANK WITHDRAWAL
        </a>
    </div>

    <!-- Withdrawal List -->
    @if($withdrawals->isEmpty())
    <div class="deposit-card text-white text-center py-5">
        NO WITHDRAWAL YET
    </div>
    @else
    @foreach($withdrawals as $withdrawal)
    <div class="transaction-card">
        <div class="date-section">
            <div class="month fs-6 fw-bold">{{ $withdrawal->created_at->format('M') }}</div>
            <div class="day fs-2">{{ $withdrawal->created_at->format('d') }}</div>
        </div>
        <div class="transaction-details">
            <div class="amount text-silverish">FUND {{ config('currencies.' . Auth::user()->currency, '$') }}{{
                number_format($withdrawal->amount, 2) }}</div>
            <div class="deposit-description">{{ strtoupper($withdrawal->account_type) }} BALANCE TOTAL</div>
            <div class="deposit-description">
                @if($withdrawal->isBank())
                VIA BANK &middot; {{ strtoupper($withdrawal->bank_name) }} &middot; ****{{
                substr($withdrawal->account_number, -4) }}
                @else
                VIA {{ strtoupper($withdrawal->crypto_currency) }}
                @endif
            </div>
        </div>
        <div class="deposit-status">{{ ucfirst($withdrawal->status) }}</div>
    </div>
    @endforeach
    @endif
</div>

@include('user.layouts.footer')

<!-- JavaScript to handle the close button -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const notification = document.getElementById('withdrawal-notification');
        const closeButton = document.getElementById('close-notification');

        if (notification && closeButton) {
            closeButton.addEventListener('click', function () {
                notification.style.display = 'none'; // Hide the notification
            });
        }
    });
</script>