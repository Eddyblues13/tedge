@include('admin.header')

<div class="main-content">
    <div class="container-fluid">
        @if(session('message'))
        <div class="alert alert-success alert-dismissible fade show mb-3">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="admin-page-title">Update Payment Method</h4>
                <p class="admin-page-subtitle">Edit payment method details</p>
            </div>
            <a class="btn btn-sm btn-outline-secondary" href="{{ route('payment.settings') }}"><i
                    class="fas fa-arrow-left me-1"></i> Back</a>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="admin-card">
                    <form method="POST" action="{{ route('update.payment', $payment->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label" style="color:var(--heading-color);">Name</label>
                                <input type="text" class="admin-form-control" name="name" value="{{ $payment->name }}"
                                    readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" style="color:var(--heading-color);">Minimum Amount</label>
                                <input type="number" value="{{ $payment->min_amount }}" class="admin-form-control"
                                    name="min_amount" required>
                                <small style="color:var(--text-color);opacity:0.7;">Only applies to withdrawal</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" style="color:var(--heading-color);">Maximum Amount</label>
                                <input type="number" value="{{ $payment->max_amount }}" class="admin-form-control"
                                    name="max_amount" required>
                                <small style="color:var(--text-color);opacity:0.7;">Only applies to withdrawal</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" style="color:var(--heading-color);">Charges</label>
                                <input type="number" value="{{ $payment->charges }}" class="admin-form-control"
                                    name="charges" required>
                                <small style="color:var(--text-color);opacity:0.7;">Only applies to withdrawal</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" style="color:var(--heading-color);">Charges Type</label>
                                <select name="charge_type" class="admin-form-control" required>
                                    <option value="{{ $payment->charge_type }}">{{ $payment->charge }}</option>
                                    <option value="percentage">Percentage(%)</option>
                                    <option value="fixed">Fixed($)</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" style="color:var(--heading-color);">Type</label>
                                <select name="type" id="methodtype" class="admin-form-control" required>
                                    <option value="{{ $payment->type }}">{{ $payment->type }}</option>
                                    <option value="currency">Currency</option>
                                    <option value="crypto">Crypto</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" style="color:var(--heading-color);">Image URL</label>
                                <input type="text" class="admin-form-control" name="url" value="">
                            </div>

                            <!-- Currency Fields -->
                            <div class="col-md-6 currency">
                                <label class="form-label" style="color:var(--heading-color);">Bank Name</label>
                                <input type="text" value="{{ $payment->bank_name }}"
                                    class="admin-form-control currinput" name="bank">
                            </div>
                            <div class="col-md-6 currency">
                                <label class="form-label" style="color:var(--heading-color);">Account Name</label>
                                <input type="text" value="{{ $payment->account_name }}"
                                    class="admin-form-control currinput" name="account_name">
                            </div>
                            <div class="col-md-6 currency">
                                <label class="form-label" style="color:var(--heading-color);">Account Number</label>
                                <input type="number" value="{{ $payment->account_number }}"
                                    class="admin-form-control currinput" name="account_number">
                            </div>
                            <div class="col-md-6 currency">
                                <label class="form-label" style="color:var(--heading-color);">Swift/Other Code</label>
                                <input type="text" value="{{ $payment->code }}" class="admin-form-control currinput"
                                    name="swift">
                            </div>

                            <!-- Crypto Fields -->
                            <div class="col-md-6 d-none crypto">
                                <label class="form-label" style="color:var(--heading-color);">Wallet Address</label>
                                <input type="text" value="{{ $payment->wallet_address }}"
                                    class="admin-form-control cryptoinput" name="wallet_address">
                            </div>
                            <div class="col-md-6 d-none crypto">
                                <label class="form-label" style="color:var(--heading-color);">Barcode</label>
                                <input type="file" name="bar_code" class="admin-form-control cryptoinput">
                            </div>
                            <div class="col-md-6 d-none crypto">
                                <label class="form-label" style="color:var(--heading-color);">Wallet Address Network
                                    Type</label>
                                <input type="text" value="{{ $payment->type }}" class="admin-form-control cryptoinput"
                                    name="wallet_type">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" style="color:var(--heading-color);">Status</label>
                                <select name="status" class="admin-form-control" required>
                                    <option value="{{ $payment->status }}" selected>{{ $payment->status }}</option>
                                    <option value="enabled">Enable</option>
                                    <option value="disabled">Disable</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" style="color:var(--heading-color);">Type For</label>
                                <select name="type_for" class="admin-form-control" required>
                                    <option value="{{ $payment->type_for }}" selected>{{ $payment->type_for }}</option>
                                    <option value="withdrawal">Withdrawal</option>
                                    <option value="deposit">Deposit</option>
                                    <option value="both">Both</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" style="color:var(--heading-color);">Optional Note</label>
                                <input type="text" value="{{ $payment->note }}" class="admin-form-control" name="note"
                                    placeholder="Payment may take up to 24 hours">
                            </div>
                            <div class="col-12 mt-3">
                                <button type="submit" class="btn btn-admin-primary"><i class="fas fa-save me-1"></i>
                                    Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let methodtype = document.getElementById('methodtype');
    let currtype = document.querySelectorAll('.currency');
    let currinput = document.querySelectorAll('.currinput');
    let cryptotype = document.querySelectorAll('.crypto');
    let cryptoinput = document.querySelectorAll('.cryptoinput');

    currinput[0].setAttribute('required','');
    currinput[1].setAttribute('required','');
    currinput[2].setAttribute('required','');
    methodtype.addEventListener('change', sortfields);

    if(methodtype.value == 'currency'){
        cryptotype.forEach(el => el.classList.add('d-none'));
        currinput[0].setAttribute('required','');
        currinput[1].setAttribute('required','');
        currinput[2].setAttribute('required','');
        cryptoinput[0].removeAttribute('required');
        cryptoinput[2].removeAttribute('required');
        currtype.forEach(c => c.classList.remove('d-none'));
    } else {
        cryptoinput[0].setAttribute('required','');
        cryptoinput[2].setAttribute('required','');
        currinput[0].removeAttribute('required');
        currinput[1].removeAttribute('required');
        currinput[2].removeAttribute('required');
        cryptotype.forEach(el => el.classList.remove('d-none'));
        currtype.forEach(c => c.classList.add('d-none'));
    }

    function sortfields() {
        if(methodtype.value == 'currency'){
            cryptotype.forEach(el => el.classList.add('d-none'));
            currinput[0].setAttribute('required','');
            currinput[1].setAttribute('required','');
            currinput[2].setAttribute('required','');
            cryptoinput[0].removeAttribute('required');
            cryptoinput[2].removeAttribute('required');
            currtype.forEach(c => c.classList.remove('d-none'));
        } else {
            cryptoinput[0].setAttribute('required','');
            cryptoinput[2].setAttribute('required','');
            currinput[0].removeAttribute('required');
            currinput[1].removeAttribute('required');
            currinput[2].removeAttribute('required');
            cryptotype.forEach(el => el.classList.remove('d-none'));
            currtype.forEach(c => c.classList.add('d-none'));
        }
    }
</script>

@include('admin.footer')