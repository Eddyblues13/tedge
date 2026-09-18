@include('user.layouts.header')

<!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<!-- Main Content -->
<div class="depost-form-main">
    <h6 class="heading text-secondary fs-6">BANK WITHDRAWAL</h6>
    <div class="withdraw-card">
        <form id="withdrawalForm">
            @csrf
            <!-- Add CSRF Token -->
            <input type="hidden" name="method" value="bank">

            <div class="input-group">
                <div class="input-label">Account</div>
                <select class="select-account" name="account">
                    <option value="holding">Holding Balance ({{ config('currencies.' . Auth::user()->currency, '$') }}{{
                        number_format($holdingBalance, 2) }})</option>
                    <option value="staking">Staking Balance ({{ config('currencies.' . Auth::user()->currency, '$') }}{{
                        number_format($stakingBalance, 2) }})</option>
                    <option value="referral">Referral Balance ({{ config('currencies.' . Auth::user()->currency, '$')
                        }}{{
                        number_format($referralBalance, 2) }})</option>
                    <option value="deposit">Deposit Balance ({{ config('currencies.' . Auth::user()->currency, '$')
                        }}{{
                        number_format($depositBalance, 2) }})</option>
                    <option value="profit">Profit Balance ({{ config('currencies.' . Auth::user()->currency, '$')
                        }}{{
                        number_format($profit, 2) }})</option>
                </select>
            </div>

            <div class="input-group">
                <div class="input-label">Amount ({{Auth::user()->currency}})</div>
                <input type="number" class="amount-input" name="amount" value="0" step="0.01" min="0.01" required>
            </div>

            <div class="input-group">
                <div class="input-label">Bank Name</div>
                <input type="text" class="amount-input" name="bank_name" maxlength="255" required>
            </div>

            <div class="input-group">
                <div class="input-label">Account Holder Name</div>
                <input type="text" class="amount-input" name="account_name" maxlength="255"
                    value="{{ trim((Auth::user()->first_name ?? '') . ' ' . (Auth::user()->last_name ?? '')) }}"
                    required>
            </div>

            <div class="input-group">
                <div class="input-label">Account Number / IBAN</div>
                <input type="text" class="amount-input" name="account_number" maxlength="50" required>
            </div>

            <div class="input-group">
                <div class="input-label">Routing Number / Sort Code (optional)</div>
                <input type="text" class="amount-input" name="routing_number" maxlength="50">
            </div>

            <div class="input-group">
                <div class="input-label">SWIFT / BIC Code (optional)</div>
                <input type="text" class="amount-input" name="swift_code" maxlength="20">
            </div>
            <button type="submit" class="withdrawal-btn">Submit</button>
        </form>
    </div>
</div>

@include('user.layouts.footer')

<!-- jQuery and Toastr JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    $(document).ready(function () {
        // Handle form submission
        $('#withdrawalForm').on('submit', function (e) {
            e.preventDefault();

            const submitBtn = $(this).find('[type="submit"]');
            submitBtn.prop('disabled', true);

            $.ajax({
                url: '{{ route("withdraw.submit") }}',
                method: 'POST',
                data: $(this).serialize(),
                success: function (response) {
                    toastr.success(response.message); // Show success message
                    $('#withdrawalForm')[0].reset(); // Reset the form
                },
                error: function (xhr) {
                    let errorMessage = (xhr.responseJSON && xhr.responseJSON.message) || 'An error occurred.';
                    toastr.error(errorMessage); // Show error message
                },
                complete: function () {
                    submitBtn.prop('disabled', false);
                }
            });
        });
    });
</script>
