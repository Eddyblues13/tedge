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
                <h4 class="admin-page-title">Process Withdrawal Request</h4>
                <p class="admin-page-subtitle">Review and process client withdrawal</p>
            </div>
            <a class="btn btn-sm btn-outline-secondary" href="{{ url('admin/manage-withdrawals') }}"><i
                    class="fas fa-arrow-left me-1"></i> Back</a>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="admin-card">
                    <div class="mb-4">
                        @if($withdrawal_details->status === "0")
                        <h5 style="color:var(--heading-color);">Send Funds to {{ $user_details->name }} through payment
                            details below</h5>
                        @elseif($withdrawal_details->status === "1")
                        <h5 class="text-success"><i class="fas fa-check-circle me-1"></i> Payment Completed</h5>
                        @endif
                    </div>

                    <!-- Payment Details -->
                    @if($withdrawal_details->method === "Bank Transfer")
                    <div class="mb-3">
                        <label class="form-label" style="color:var(--heading-color);">Bank Name</label>
                        <input type="text" class="admin-form-control" value="{{ $user_details->bank_name }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color:var(--heading-color);">Account Name</label>
                        <input type="text" class="admin-form-control" value="{{ $user_details->account_name }}"
                            readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="color:var(--heading-color);">Account Number</label>
                        <input type="text" class="admin-form-control" value="{{ $user_details->account_number }}"
                            readonly>
                    </div>
                    @elseif($withdrawal_details->method === "Bitcoin")
                    <div class="mb-3">
                        <label class="form-label" style="color:var(--heading-color);">Bitcoin Address</label>
                        <input type="text" class="admin-form-control" value="{{ $user_details->btc_address }}" readonly>
                    </div>
                    @elseif($withdrawal_details->method === "Ethereum")
                    <div class="mb-3">
                        <label class="form-label" style="color:var(--heading-color);">Ethereum Address</label>
                        <input type="text" class="admin-form-control" value="{{ $user_details->eth_address }}" readonly>
                    </div>
                    @elseif($withdrawal_details->method === "USDT coin")
                    <div class="mb-3">
                        <label class="form-label" style="color:var(--heading-color);">USDT Address</label>
                        <input type="text" class="admin-form-control" value="{{ $user_details->ltc_address }}" readonly>
                    </div>
                    @endif

                    <!-- Action Form -->
                    <form action="{{ url('admin/approve-withdrawal/'.$withdrawal_details->id) }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" style="color:var(--heading-color);">Action</label>
                            <select name="status" id="action" class="admin-form-control">
                                <option value="1">Paid</option>
                                <option value="0">Reject</option>
                            </select>
                        </div>

                        <div class="d-none mb-3" id="emailcheck">
                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="emailsend" id="dontsend"
                                        value="false" checked>
                                    <label class="form-check-label" for="dontsend"
                                        style="color:var(--text-color);">Don't Send Email</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="emailsend" id="sendemail"
                                        value="true">
                                    <label class="form-check-label" for="sendemail"
                                        style="color:var(--text-color);">Send Email</label>
                                </div>
                            </div>
                        </div>

                        <div class="d-none" id="emailtext">
                            <div class="mb-3">
                                <label class="form-label" style="color:var(--heading-color);">Subject</label>
                                <input type="text" name="subject" id="subject" class="admin-form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color:var(--heading-color);">Reason for
                                    Rejecting</label>
                                <textarea class="admin-form-control" rows="3" placeholder="Type reason here"
                                    name="reason" id="message"></textarea>
                            </div>
                        </div>

                        <input type="hidden" name="email" value="{{ $user_details->email }}">
                        <input type="hidden" name="amount" value="{{ $withdrawal_details->amount }}">

                        @if($withdrawal_details->status === "0")
                        <button type="submit" class="btn btn-admin-primary"><i class="fas fa-check me-1"></i>
                            Process</button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let action = document.getElementById('action');

$('#action').change(function(){
    if (action.value === "Reject" || action.value === "0") {
        document.getElementById('emailcheck').classList.remove('d-none');
    } else {
        document.getElementById('emailcheck').classList.add('d-none');
        document.getElementById('emailtext').classList.add('d-none');
        document.getElementById('dontsend').checked = true;
        document.getElementById('subject').removeAttribute('required');
        document.getElementById('message').removeAttribute('required');
    }
});

$('#sendemail').click(function(){
    document.getElementById('emailtext').classList.remove('d-none');
    document.getElementById('subject').setAttribute('required', '');
    document.getElementById('message').setAttribute('required', '');
});

$('#dontsend').click(function(){
    document.getElementById('emailtext').classList.add('d-none');
    document.getElementById('subject').removeAttribute('required');
    document.getElementById('message').removeAttribute('required');
});
</script>

@include('admin.footer')