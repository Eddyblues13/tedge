@include('user.layouts.header')

<style>
    :root {
        --primary-link-colour: #00b4d8; /* Fallback if not defined */
        --primary-button: #0077b6; /* Fallback */
        --background-colour: #f8f9fa;
        --card-bg-light: #ffffff;
        --card-bg-dark: #0b1118;
    }

    /* Custom styles to match homepage Tailwind design */
    .plans-section {
        padding: 4rem 0;
        background-color: var(--background-colour);
    }

    .pricing-card {
        background-color: var(--card-bg-light);
        border-radius: 32px;
        padding: 2.5rem;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        border: 1px solid #e5e7eb;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        transition: transform 0.3s ease;
    }

    /* Dark mode support - assuming body has data-bs-theme="dark" or similar class */
    [data-bs-theme="dark"] .pricing-card {
        background-color: var(--card-bg-dark);
        border-color: #1f2937;
    }

    .pricing-card:hover {
        transform: translateY(-5px);
    }

    .plan-name {
        color: #9ca3af;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        font-size: 0.875rem;
        margin-bottom: 1rem;
    }

    .plan-price {
        color: var(--primary-link-colour, #00b4d8);
        font-size: 2.25rem;
        font-weight: 900;
        margin-bottom: 2rem;
    }

    @media (min-width: 768px) {
        .plan-price {
            font-size: 2.5rem;
        }
    }

    .feature-list {
        width: 100%;
        margin-bottom: 2rem;
        padding: 0;
        list-style: none;
    }

    .feature-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-weight: 700;
        color: #000;
        margin-bottom: 1rem;
        font-size: 0.875rem;
    }

    [data-bs-theme="dark"] .feature-item {
        color: #fff;
    }

    .feature-icon {
        width: 1.5rem;
        height: 1.5rem;
        color: var(--primary-link-colour, #00b4d8);
    }

    .fund-btn {
        width: 100%;
        height: 3rem;
        background-color: var(--primary-button, #0077b6);
        color: white;
        font-weight: 900;
        font-size: 0.875rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 0.5rem;
        transition: opacity 0.2s;
        text-decoration: none;
        border: none;
        margin-top: auto;
    }

    .fund-btn:hover {
        opacity: 0.9;
        color: white;
    }

    .modal-content {
        background-color: var(--card-bg-light);
        border-radius: 1rem;
    }
    
    [data-bs-theme="dark"] .modal-content {
        background-color: var(--card-bg-dark);
        color: white;
    }
    
    [data-bs-theme="dark"] .form-control, 
    [data-bs-theme="dark"] .form-select {
        background-color: #1f2937;
        border-color: #374151;
        color: white;
    }
</style>

<div class="container mt-4 mb-5">
    <div class="text-center mb-5">
        <h2 class="display-4 fw-bold mb-2">Plans</h2>
        <h3 class="h2 fw-bold">Trading</h3>
    </div>

    <div class="row g-4">
        @foreach($plans as $plan)
        <div class="col-12 col-md-6 col-lg-4">
            <div class="pricing-card">
                <div class="plan-name">{{ $plan->name }}</div>
                <div class="plan-price">
                    {{ config('currencies.' . $localCurrency, '$') }}{{ number_format($plan->local_amount, 2) }}
                </div>
                
                <div class="feature-list">
                    <div class="feature-item">
                        <span>{{ $plan->pairs }}+ Pairs</span>
                        <svg class="feature-icon" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    </div>
                    <div class="feature-item">
                        <span>Leverage up to {{ $plan->leverage }}</span>
                        <svg class="feature-icon" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    </div>
                    <div class="feature-item">
                        <span>Spreads from {{ $plan->spread }}</span>
                        <svg class="feature-icon" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    </div>
                    @if(!$plan->swap_fee)
                    <div class="feature-item">
                        <span>No Swap Fees</span>
                        <svg class="feature-icon" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    </div>
                    @endif
                </div>

                <button class="fund-btn" data-plan-id="{{ $plan->id }}" data-bs-toggle="modal" data-bs-target="#fundTradingModal">
                    FUND TRADING
                </button>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="fundTradingModal" tabindex="-1" aria-labelledby="fundTradingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold" id="fundTradingModalLabel">Fund Trading Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="fundTradingForm">
                    @csrf
                    <input type="hidden" id="planId" name="plan_id">
                    <div class="mb-3">
                        <label for="amount" class="form-label fw-bold">Amount</label>
                        <input type="number" class="form-control" id="amount" name="amount" required step="0.01">
                    </div>
                    <div class="mb-3">
                        <label for="account" class="form-label fw-bold">Select Account</label>
                        <select class="form-select" id="account" name="account" required>
                            <option value="holding">Holding Account</option>
                            <option value="staking">Staking Account</option>
                            <option value="trading">Trading Account</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 fw-bold py-2 mt-2">SUBMIT PAYMENT</button>
                </form>
            </div>
        </div>
    </div>
</div>

@include('user.layouts.footer')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fundButtons = document.querySelectorAll('.fund-btn');
        const planIdInput = document.getElementById('planId');
        const fundForm = document.getElementById('fundTradingForm');

        fundButtons.forEach(button => {
            button.addEventListener('click', function() {
                const planId = this.getAttribute('data-plan-id');
                planIdInput.value = planId;
            });
        });

        fundForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            
            submitBtn.disabled = true;
            submitBtn.textContent = 'Processing...';

            fetch('{{ route("fund.trading") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    alert('Funds transferred successfully!');
                    // Close modal proper way in BS5
                    const modal = bootstrap.Modal.getInstance(document.getElementById('fundTradingModal'));
                    modal.hide();
                    fundForm.reset();
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.textContent = originalText;
            });
        });
    });
</script>