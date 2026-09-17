@include('user.layouts.header')

<!-- Main Content -->
<div class="main-content" style="padding-bottom: 100px;">
    <div class="container-fluid px-3 px-md-4">
        <div class="row justify-content-start mt-3">
            <div class="col-12 col-md-6 col-lg-5">
                <div class="theme-card-bg rounded-3 p-4">
                    <h1 class="text-center fw-black mb-1" style="font-size: 2.5rem; color: var(--heading-color);">
                        STAKE
                    </h1>
                    <h1 class="text-center fw-black mb-3" style="font-size: 2.5rem; color: var(--heading-color);">
                        {{ strtoupper($pair) }}
                    </h1>

                    <p class="text-center mb-3" style="color: var(--heading-color); font-size: 0.95rem;">
                        how much {{ $pair }} would you like to stake?
                    </p>

                    <p class="text-center fw-bold mb-4" style="color: var(--heading-color); font-size: 1rem;">
                        BALANCE: {{ config('currencies.' . Auth::user()->currency, '$') }}{{
                        number_format($stakingBalance, 2) }}
                    </p>

                    @if(session('error'))
                    <div class="alert alert-danger py-2 mb-3">{{ session('error') }}</div>
                    @endif

                    @if(session('success'))
                    <div class="alert alert-success py-2 mb-3">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('staking.submit', $pair) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label"
                                style="color: var(--text-color); font-size: 0.85rem;">amount</label>
                            <input type="number" name="amount" class="form-control staking-input"
                                placeholder="{{ Auth::user()->currency ?? 'USD' }}" step="0.01" min="0" required
                                style="background-color: var(--input-bg, #f8f9fa); color: var(--heading-color); border: 1px solid var(--border-color, #dee2e6); padding: 14px 16px; font-size: 1rem; border-radius: 8px;">
                        </div>

                        <div class="mb-4">
                            <label class="form-label" style="color: var(--text-color); font-size: 0.85rem;">Staking
                                Period Days</label>
                            <select name="period" class="form-select"
                                style="background-color: var(--input-bg, #f8f9fa); color: var(--heading-color); border: 1px solid var(--border-color, #dee2e6); padding: 14px 16px; font-size: 1rem; border-radius: 8px;">
                                <option value="30">30</option>
                                <option value="60">60</option>
                                <option value="90">90</option>
                                <option value="120">120</option>
                                <option value="180">180</option>
                                <option value="365">365</option>
                            </select>
                        </div>

                        <button type="submit" class="btn w-100 fw-bold py-3"
                            style="background-color: #0d6efd; color: white; border: none; border-radius: 8px; font-size: 1rem;">
                            Proceed
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('user.layouts.footer')