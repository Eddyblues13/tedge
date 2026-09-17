@section('title', 'Address Verification - Tradedgepip')
@include('home.header')

<!-- Add Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<style>
    .verify-main {
        background-color: #E6F3FD;
        min-height: calc(100vh - 200px);
        padding: 40px 20px;
    }

    .dark .verify-main {
        background-color: #0b1118;
    }

    .verify-container {
        max-width: 1000px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 28px;
        align-items: start;
    }

    .verify-card {
        background: #ffffff;
        padding: 32px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid #e5e7eb;
    }

    .dark .verify-card {
        background: #0b1118;
        border-color: #363c4e;
    }

    .card-title {
        font-size: 1.5rem;
        font-weight: 700;
        font-style: italic;
        color: #04b3e1;
        margin-bottom: 16px;
        text-align: center;
    }

    .card-subtitle {
        font-size: 0.88rem;
        color: #374151;
        margin-bottom: 28px;
        text-align: center;
        line-height: 1.6;
    }

    .dark .card-subtitle {
        color: #a5bdd9;
    }

    /* File select row */
    .file-select-row {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 20px;
    }

    .btn-select {
        background: transparent;
        border: 1px solid #04b3e1;
        color: #04b3e1;
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 500;
        cursor: pointer;
        white-space: nowrap;
        transition: all 0.2s;
    }

    .btn-select:hover {
        background: rgba(4, 179, 225, 0.08);
    }

    .btn-select.selected {
        background: #10b981;
        border-color: #10b981;
        color: white;
    }

    .file-name-display {
        flex: 1;
        padding: 8px 12px;
        border-bottom: 1px solid #d1d5db;
        font-size: 0.85rem;
        color: #9ca3af;
        min-height: 38px;
        display: flex;
        align-items: center;
    }

    .dark .file-name-display {
        border-color: #363c4e;
        color: #718096;
    }

    /* Buttons */
    .upload-btn {
        display: block;
        width: 100%;
        padding: 12px 20px;
        border: none;
        border-radius: 8px;
        background: #04b3e1;
        color: white;
        font-size: 0.95rem;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.3s;
        font-family: inherit;
        margin-bottom: 12px;
        text-align: center;
    }

    .upload-btn:hover {
        background: #039bc2;
    }

    .skip-btn {
        display: block;
        width: 100%;
        padding: 12px 20px;
        border: 1px solid #04b3e1;
        border-radius: 8px;
        background: transparent;
        color: #04b3e1;
        font-size: 0.95rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        font-family: inherit;
        text-align: center;
        text-decoration: none;
    }

    .skip-btn:hover {
        background: rgba(4, 179, 225, 0.08);
        color: #04b3e1;
    }

    /* Floating label inputs */
    .floating-group {
        position: relative;
        margin-bottom: 20px;
    }

    .floating-group input {
        width: 100%;
        padding: 20px 14px 8px 14px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        background: #ffffff;
        font-size: 0.95rem;
        color: #1a1f2b;
        font-family: inherit;
        box-sizing: border-box;
        outline: none;
        transition: border-color 0.2s;
    }

    .dark .floating-group input {
        background: #1e293b;
        border-color: #363c4e;
        color: #ffffff;
    }

    .floating-group input:focus {
        border-color: #04b3e1;
    }

    .floating-group label {
        position: absolute;
        top: 6px;
        left: 14px;
        font-size: 0.72rem;
        color: #04b3e1;
        font-weight: 500;
        pointer-events: none;
    }

    .update-btn {
        display: block;
        width: 100%;
        padding: 12px 20px;
        border: none;
        border-radius: 8px;
        background: #04b3e1;
        color: white;
        font-size: 0.95rem;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.3s;
        font-family: inherit;
        margin-bottom: 16px;
        text-align: center;
    }

    .update-btn:hover {
        background: #039bc2;
    }

    .logout-btn {
        display: inline-block;
        padding: 8px 28px;
        border: 1px solid #04b3e1;
        border-radius: 6px;
        background: transparent;
        color: #04b3e1;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        transition: all 0.2s;
    }

    .logout-btn:hover {
        background: rgba(4, 179, 225, 0.08);
        color: #04b3e1;
    }

    .text-danger {
        color: #dc2626;
        font-size: 0.8rem;
        margin-top: 4px;
    }

    .loading-spinner {
        display: inline-block;
        width: 18px;
        height: 18px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        border-top-color: #fff;
        animation: spin 1s ease-in-out infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    @media (max-width: 768px) {
        .verify-container {
            grid-template-columns: 1fr;
        }

        .verify-main {
            padding: 24px 16px;
        }
    }
</style>

<main class="verify-main">
    <div class="verify-container">
        <!-- Left Card: Address Document Upload -->
        <div class="verify-card">
            <form id="addressVerificationForm" enctype="multipart/form-data">
                @csrf
                <h2 class="card-title">Address Verification</h2>
                <p class="card-subtitle">Please upload your utility bill for address verification.</p>

                <div class="file-select-row">
                    <input type="file" id="utilityBillInput" name="utility_bill" accept="image/*,.pdf"
                        style="display: none;">
                    <button type="button" id="billSelectBtn" class="btn-select"
                        onclick="document.getElementById('utilityBillInput').click();">
                        select bill
                    </button>
                    <div id="billFileName" class="file-name-display"></div>
                </div>

                <button type="submit" class="upload-btn" id="submitBtn">
                    <span id="submitText">Upload</span>
                    <span id="spinner" class="loading-spinner" style="display: none;"></span>
                </button>

                <button type="button" class="skip-btn" id="skipBtn">SKIP</button>
            </form>
        </div>

        <!-- Right Card: Update Address Details -->
        <div class="verify-card">
            <form id="updateAddressForm">
                @csrf
                <div class="floating-group">
                    <label>Mobile Number (Optional)</label>
                    <input type="text" name="phone_number" value="{{ Auth::user()->phone_number ?? '' }}">
                </div>

                <div class="floating-group">
                    <label>Street Address</label>
                    <input type="text" name="address" value="{{ Auth::user()->address ?? '' }}" required>
                </div>

                <div class="floating-group">
                    <label>Zip Code</label>
                    <input type="text" name="zip_code" value="{{ Auth::user()->zip_code ?? '' }}">
                </div>

                <div class="floating-group">
                    <label>City</label>
                    <input type="text" name="city" value="{{ Auth::user()->city ?? '' }}">
                </div>

                <div class="floating-group">
                    <label>State</label>
                    <input type="text" name="state" value="{{ Auth::user()->state ?? '' }}">
                </div>

                <div class="floating-group">
                    <label>Country</label>
                    <input type="text" name="country" value="{{ Auth::user()->country ?? '' }}" required>
                </div>

                <button type="submit" class="update-btn" id="updateAddressBtn">
                    <span id="updateAddressText">Update</span>
                    <span id="updateAddressSpinner" class="loading-spinner" style="display: none;"></span>
                </button>
            </form>

            <div class="text-center">
                <a href="{{ route('user.logout') }}" class="logout-btn"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    LOGOUT
                </a>
                <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</main>

@include('home.footer')

<!-- Add jQuery and Toastr JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    // Initialize Toastr
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "5000",
        "extendedTimeOut": "1000"
    };

    @if(session('success'))
        toastr.success("{{ session('success') }}");
    @endif

    @if(session('error'))
        toastr.error("{{ session('error') }}");
    @endif

    // File input display
    document.getElementById('utilityBillInput').addEventListener('change', function(e) {
        const fileName = e.target.files[0] ? e.target.files[0].name : '';
        const billFileName = document.getElementById('billFileName');
        const billSelectBtn = document.getElementById('billSelectBtn');

        billFileName.textContent = fileName;

        if (e.target.files.length > 0) {
            billSelectBtn.classList.add('selected');
            billFileName.style.color = '#1a1f2b';
        } else {
            billSelectBtn.classList.remove('selected');
            billFileName.style.color = '#9ca3af';
        }
    });

    // Address document upload AJAX
    document.getElementById('addressVerificationForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const form = e.target;
        const formData = new FormData(form);
        const submitBtn = document.getElementById('submitBtn');
        const submitText = document.getElementById('submitText');
        const spinner = document.getElementById('spinner');

        submitText.textContent = 'Uploading...';
        spinner.style.display = 'inline-block';
        submitBtn.disabled = true;

        fetch("{{ route('verifications.user.address') }}", {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                toastr.success(data.message || 'Address verification submitted successfully!');
                if (data.redirect) {
                    setTimeout(() => { window.location.href = data.redirect; }, 1500);
                }
            } else {
                toastr.error(data.message || 'Error submitting address verification');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            toastr.error('An error occurred while submitting the form');
        })
        .finally(() => {
            submitText.textContent = 'Upload';
            spinner.style.display = 'none';
            submitBtn.disabled = false;
        });
    });

    // Update address details AJAX
    document.getElementById('updateAddressForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const form = e.target;
        const formData = new FormData(form);
        const btn = document.getElementById('updateAddressBtn');
        const btnText = document.getElementById('updateAddressText');
        const btnSpinner = document.getElementById('updateAddressSpinner');

        btnText.textContent = 'Updating...';
        btnSpinner.style.display = 'inline-block';
        btn.disabled = true;

        fetch("{{ route('verifications.update.address') }}", {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                toastr.success(data.message || 'Address details updated successfully!');
            } else {
                toastr.error(data.message || 'Failed to update address details.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            toastr.error('An error occurred. Please try again.');
        })
        .finally(() => {
            btnText.textContent = 'Update';
            btnSpinner.style.display = 'none';
            btn.disabled = false;
        });
    });

    // Skip button
    document.getElementById('skipBtn').addEventListener('click', function() {
        if (confirm('Are you sure you want to skip address verification?')) {
            window.location.href = "{{ route('home') }}";
        }
    });
</script>