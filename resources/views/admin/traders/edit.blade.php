@include('admin.header')

<div class="main-content">
    <div class="container-fluid" style="max-width:900px;">

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">{{ session('error') }}<button type="button"
                class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        {{-- Page Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <div>
                <h4 class="admin-page-title mb-1">Edit Trader</h4>
                <p class="admin-page-subtitle mb-0">Update {{ $trader->name }}'s profile information</p>
            </div>
            <a href="{{ route('traders.index') }}" class="btn btn-sm btn-outline-secondary" style="border-radius:10px;">
                <i class="bi bi-arrow-left me-1"></i> Back to Traders
            </a>
        </div>

        <form id="editTraderForm" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Photo Upload Card --}}
            <div class="ct-card ct-card-photo mb-4">
                <div class="ct-section-badge"><i class="bi bi-person-badge me-1"></i> Profile Photo</div>
                <div class="ct-photo-zone" id="photoDropZone">
                    <input type="file" id="editPictureInput" name="picture" accept="image/*" class="d-none">
                    <input type="hidden" id="removePictureInput" name="remove_picture" value="0">

                    {{-- Default/placeholder state --}}
                    <div id="photoPlaceholder" class="ct-photo-placeholder"
                        style="{{ $trader->picture_url ? 'display:none' : '' }}">
                        <div class="ct-photo-icon-ring">
                            <i class="bi bi-cloud-arrow-up"></i>
                        </div>
                        <p class="ct-photo-label">Drag & drop or click to upload</p>
                        <span class="ct-photo-hint">JPG, PNG or GIF — max 2 MB</span>
                    </div>

                    {{-- Preview state --}}
                    <div id="photoPreviewState" class="ct-photo-preview-state"
                        style="{{ $trader->picture_url ? 'display:flex' : 'display:none' }}">
                        <div class="ct-avatar-ring">
                            <img id="editPreviewImg"
                                src="{{ $trader->picture_url ?: 'https://ui-avatars.com/api/?name=' . urlencode($trader->name) . '&background=6366f1&color=fff&size=120' }}"
                                class="ct-avatar-img">
                            <div class="ct-avatar-change"><i class="bi bi-pencil-fill"></i></div>
                        </div>
                        <div class="ct-file-meta">
                            <span id="fileName" class="ct-file-name">{{ $trader->picture_url ? 'Current photo' : ''
                                }}</span>
                            <span id="fileSize" class="ct-file-size">{{ $trader->picture_url ? 'Click to change' : ''
                                }}</span>
                        </div>
                        <button type="button" id="removePhoto" class="ct-remove-btn"><i class="bi bi-x-lg"></i></button>
                    </div>
                </div>
            </div>

            {{-- Details Card --}}
            <div class="ct-card mb-4">
                <div class="ct-section-badge"><i class="bi bi-info-circle me-1"></i> Trader Details</div>
                <div class="row g-4 mt-1">
                    <div class="col-md-6">
                        <div class="ct-field">
                            <label class="ct-label">Trader Name <span class="text-danger">*</span></label>
                            <div class="ct-input-wrap">
                                <i class="bi bi-person ct-input-icon"></i>
                                <input class="ct-input" placeholder="e.g. John Smith" type="text" name="name"
                                    value="{{ old('name', $trader->name) }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="ct-field">
                            <label class="ct-label">Followers</label>
                            <div class="ct-input-wrap">
                                <i class="bi bi-people ct-input-icon"></i>
                                <input class="ct-input" placeholder="0" type="number" name="followers"
                                    value="{{ old('followers', $trader->followers) }}" min="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="ct-field">
                            <label class="ct-label">Verification Status</label>
                            <div class="ct-input-wrap">
                                <i class="bi bi-patch-check ct-input-icon"></i>
                                <select class="ct-input ct-select" name="is_verified">
                                    <option value="1" {{ old('is_verified', $trader->is_verified) == 1 ? 'selected' : ''
                                        }}>Verified</option>
                                    <option value="0" {{ old('is_verified', $trader->is_verified) == 0 ? 'selected' : ''
                                        }}>Not Verified</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Financial Card --}}
            <div class="ct-card mb-4">
                <div class="ct-section-badge"><i class="bi bi-graph-up-arrow me-1"></i> Financial Info</div>
                <div class="row g-4 mt-1">
                    <div class="col-md-6">
                        <div class="ct-field">
                            <label class="ct-label">Return Rate <span class="text-danger">*</span></label>
                            <div class="ct-input-wrap">
                                <i class="bi bi-percent ct-input-icon"></i>
                                <input class="ct-input" placeholder="e.g. 15.5" type="number" step="any"
                                    name="return_rate" value="{{ old('return_rate', $trader->return_rate) }}" min="0"
                                    required>
                                <span class="ct-input-suffix">%</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="ct-field">
                            <label class="ct-label">Profit Share <span class="text-danger">*</span></label>
                            <div class="ct-input-wrap">
                                <i class="bi bi-pie-chart ct-input-icon"></i>
                                <input class="ct-input" placeholder="e.g. 20" type="number" step="any"
                                    name="profit_share" value="{{ old('profit_share', $trader->profit_share) }}" min="0"
                                    required>
                                <span class="ct-input-suffix">%</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="ct-field">
                            <label class="ct-label">Minimum Amount <span class="text-danger">*</span></label>
                            <div class="ct-input-wrap">
                                <span class="ct-input-prefix">$</span>
                                <input class="ct-input ct-input-has-prefix" placeholder="e.g. 100" type="number"
                                    step="any" name="min_amount" value="{{ old('min_amount', $trader->min_amount) }}"
                                    min="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="ct-field">
                            <label class="ct-label">Maximum Amount <span class="text-danger">*</span></label>
                            <div class="ct-input-wrap">
                                <span class="ct-input-prefix">$</span>
                                <input class="ct-input ct-input-has-prefix" placeholder="e.g. 50000" type="number"
                                    step="any" name="max_amount" value="{{ old('max_amount', $trader->max_amount) }}"
                                    min="0" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Upload Progress Overlay --}}
            <div id="uploadOverlay" class="ct-upload-overlay" style="display:none;">
                <div class="ct-upload-card">
                    <div class="ct-progress-ring-wrap">
                        <svg class="ct-progress-ring" viewBox="0 0 120 120">
                            <circle class="ct-ring-bg" cx="60" cy="60" r="52" />
                            <circle id="progressCircle" class="ct-ring-fg" cx="60" cy="60" r="52" />
                        </svg>
                        <span id="progressText" class="ct-progress-text">0%</span>
                    </div>
                    <p class="ct-upload-label" id="uploadLabel">Updating trader...</p>
                    <div class="ct-progress-bar-wrap">
                        <div id="progressBar" class="ct-progress-bar"></div>
                    </div>
                </div>
            </div>

            {{-- Submit --}}
            <div class="d-flex gap-3 mb-5">
                <button type="submit" class="ct-submit-btn" id="editTraderBtn">
                    <i class="bi bi-check-circle me-2"></i> Update Trader
                </button>
                <a href="{{ route('traders.index') }}" class="ct-cancel-btn">Cancel</a>
            </div>
        </form>
    </div>
</div>

<style>
    /* ── Cards ── */
    .ct-card {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 28px 28px 24px;
        position: relative;
    }

    .ct-card-photo {
        padding-bottom: 20px;
    }

    .ct-section-badge {
        display: inline-flex;
        align-items: center;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .8px;
        color: #6366f1;
        background: rgba(99, 102, 241, .1);
        padding: 5px 14px;
        border-radius: 20px;
        margin-bottom: 8px;
    }

    /* ── Photo Upload Zone ── */
    .ct-photo-zone {
        border: 2px dashed var(--border-color);
        border-radius: 14px;
        padding: 32px 20px;
        text-align: center;
        cursor: pointer;
        transition: all .3s ease;
        position: relative;
        min-height: 180px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .ct-photo-zone:hover,
    .ct-photo-zone.dragover {
        border-color: #6366f1;
        background: rgba(99, 102, 241, .04);
    }

    .ct-photo-zone.dragover {
        transform: scale(1.01);
    }

    .ct-photo-placeholder {
        text-align: center;
    }

    .ct-photo-icon-ring {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        background: linear-gradient(135deg, rgba(99, 102, 241, .12), rgba(139, 92, 246, .12));
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 14px;
        font-size: 28px;
        color: #6366f1;
        transition: transform .3s;
    }

    .ct-photo-zone:hover .ct-photo-icon-ring {
        transform: translateY(-3px);
    }

    .ct-photo-label {
        color: var(--heading-color);
        font-weight: 600;
        font-size: 15px;
        margin-bottom: 4px;
    }

    .ct-photo-hint {
        color: var(--text-color);
        opacity: .55;
        font-size: 13px;
    }

    /* preview state */
    .ct-photo-preview-state {
        display: flex;
        align-items: center;
        gap: 20px;
        width: 100%;
    }

    .ct-avatar-ring {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        position: relative;
        flex-shrink: 0;
        border: 3px solid rgba(99, 102, 241, .3);
        overflow: hidden;
    }

    .ct-avatar-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .ct-avatar-change {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, .45);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 18px;
        opacity: 0;
        transition: opacity .2s;
        cursor: pointer;
    }

    .ct-avatar-ring:hover .ct-avatar-change {
        opacity: 1;
    }

    .ct-file-meta {
        display: flex;
        flex-direction: column;
        gap: 2px;
        flex: 1;
        min-width: 0;
        text-align: left;
    }

    .ct-file-name {
        color: var(--heading-color);
        font-weight: 600;
        font-size: 14px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .ct-file-size {
        color: var(--text-color);
        opacity: .6;
        font-size: 12px;
    }

    .ct-remove-btn {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        border: 1px solid var(--border-color);
        background: var(--card-bg);
        color: #ef4444;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all .2s;
        flex-shrink: 0;
    }

    .ct-remove-btn:hover {
        background: #ef4444;
        color: #fff;
        border-color: #ef4444;
    }

    /* ── Form Fields ── */
    .ct-field {
        margin-bottom: 0;
    }

    .ct-label {
        display: block;
        color: var(--heading-color);
        font-weight: 600;
        font-size: 13px;
        margin-bottom: 8px;
        letter-spacing: .2px;
    }

    .ct-input-wrap {
        position: relative;
        display: flex;
        align-items: center;
    }

    .ct-input-icon {
        position: absolute;
        left: 14px;
        color: var(--text-color);
        opacity: .4;
        font-size: 16px;
        z-index: 1;
        pointer-events: none;
    }

    .ct-input {
        width: 100%;
        padding: 12px 14px 12px 42px;
        background: var(--input-bg, var(--card-bg));
        border: 1.5px solid var(--border-color);
        border-radius: 12px;
        color: var(--heading-color);
        font-size: 14px;
        transition: all .25s;
        outline: none;
    }

    .ct-input:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, .12);
    }

    .ct-input::placeholder {
        color: var(--text-color);
        opacity: .4;
    }

    .ct-input-suffix {
        position: absolute;
        right: 14px;
        font-weight: 700;
        font-size: 13px;
        color: var(--text-color);
        opacity: .5;
    }

    .ct-input-prefix {
        position: absolute;
        left: 14px;
        font-weight: 700;
        font-size: 15px;
        color: var(--text-color);
        opacity: .5;
        z-index: 1;
    }

    .ct-input-has-prefix {
        padding-left: 34px;
    }

    .ct-select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%236b7280' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 01.753 1.659l-4.796 5.48a1 1 0 01-1.506 0z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 14px center;
        padding-right: 36px;
    }

    /* ── Buttons ── */
    .ct-submit-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 14px 36px;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: #fff;
        border: none;
        border-radius: 14px;
        font-weight: 700;
        font-size: 15px;
        cursor: pointer;
        transition: all .3s;
        box-shadow: 0 4px 20px rgba(99, 102, 241, .25);
    }

    .ct-submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(99, 102, 241, .35);
    }

    .ct-submit-btn:disabled {
        opacity: .6;
        cursor: not-allowed;
        transform: none;
    }

    .ct-cancel-btn {
        display: inline-flex;
        align-items: center;
        padding: 14px 28px;
        background: transparent;
        color: var(--text-color);
        border: 1.5px solid var(--border-color);
        border-radius: 14px;
        font-weight: 600;
        font-size: 15px;
        text-decoration: none;
        transition: all .25s;
    }

    .ct-cancel-btn:hover {
        border-color: var(--heading-color);
        color: var(--heading-color);
    }

    /* ── Upload Progress Overlay ── */
    .ct-upload-overlay {
        position: fixed;
        inset: 0;
        z-index: 9999;
        background: rgba(0, 0, 0, .55);
        backdrop-filter: blur(6px);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .ct-upload-card {
        background: var(--card-bg);
        border-radius: 20px;
        padding: 40px 48px;
        text-align: center;
        min-width: 320px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, .3);
        animation: ctSlideUp .35s ease;
    }

    @keyframes ctSlideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .ct-progress-ring-wrap {
        width: 120px;
        height: 120px;
        margin: 0 auto 20px;
        position: relative;
    }

    .ct-progress-ring {
        transform: rotate(-90deg);
        width: 120px;
        height: 120px;
    }

    .ct-ring-bg {
        fill: none;
        stroke: var(--border-color);
        stroke-width: 8;
    }

    .ct-ring-fg {
        fill: none;
        stroke: url(#progressGrad);
        stroke-width: 8;
        stroke-linecap: round;
        stroke-dasharray: 326.73;
        stroke-dashoffset: 326.73;
        transition: stroke-dashoffset .15s linear;
    }

    .ct-progress-text {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 22px;
        color: var(--heading-color);
    }

    .ct-upload-label {
        color: var(--text-color);
        font-size: 14px;
        margin-bottom: 16px;
    }

    .ct-progress-bar-wrap {
        width: 100%;
        height: 6px;
        background: var(--border-color);
        border-radius: 6px;
        overflow: hidden;
    }

    .ct-progress-bar {
        height: 100%;
        width: 0%;
        background: linear-gradient(90deg, #6366f1, #8b5cf6, #a78bfa);
        border-radius: 6px;
        transition: width .15s linear;
    }
</style>

{{-- SVG defs for gradient --}}
<svg width="0" height="0" style="position:absolute;">
    <defs>
        <linearGradient id="progressGrad" x1="0%" y1="0%" x2="100%" y2="0%">
            <stop offset="0%" stop-color="#6366f1" />
            <stop offset="100%" stop-color="#a78bfa" />
        </linearGradient>
    </defs>
</svg>

@include('admin.footer')

<script>
    document.addEventListener('DOMContentLoaded', function() {
    const fileInput    = document.getElementById('editPictureInput');
    const dropZone     = document.getElementById('photoDropZone');
    const placeholder  = document.getElementById('photoPlaceholder');
    const previewState = document.getElementById('photoPreviewState');
    const previewImg   = document.getElementById('editPreviewImg');
    const fileNameEl   = document.getElementById('fileName');
    const fileSizeEl   = document.getElementById('fileSize');
    const removeBtn    = document.getElementById('removePhoto');
    const removePicInput = document.getElementById('removePictureInput');

    // -- Click to upload
    dropZone.addEventListener('click', (e) => {
        if (e.target.closest('#removePhoto')) return;
        fileInput.click();
    });

    // -- Drag & drop
    ['dragenter','dragover'].forEach(evt => {
        dropZone.addEventListener(evt, e => { e.preventDefault(); dropZone.classList.add('dragover'); });
    });
    ['dragleave','drop'].forEach(evt => {
        dropZone.addEventListener(evt, e => { e.preventDefault(); dropZone.classList.remove('dragover'); });
    });
    dropZone.addEventListener('drop', e => {
        if (e.dataTransfer.files.length) {
            fileInput.files = e.dataTransfer.files;
            fileInput.dispatchEvent(new Event('change'));
        }
    });

    // -- Preview selected file
    fileInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const file = this.files[0];
            const reader = new FileReader();
            reader.onload = e => {
                previewImg.src = e.target.result;
                fileNameEl.textContent = file.name;
                fileSizeEl.textContent = formatSize(file.size);
                placeholder.style.display = 'none';
                previewState.style.display = 'flex';
                removePicInput.value = '0';
            };
            reader.readAsDataURL(file);
        }
    });

    // -- Remove photo
    removeBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        fileInput.value = '';
        previewImg.src = '';
        placeholder.style.display = '';
        previewState.style.display = 'none';
        removePicInput.value = '1';
    });

    function formatSize(bytes) {
        if (bytes < 1024) return bytes + ' B';
        if (bytes < 1048576) return (bytes / 1024).toFixed(1) + ' KB';
        return (bytes / 1048576).toFixed(2) + ' MB';
    }

    // ── Upload with XHR + two-phase progress ──
    const form         = document.getElementById('editTraderForm');
    const overlay      = document.getElementById('uploadOverlay');
    const progressCirc = document.getElementById('progressCircle');
    const progressText = document.getElementById('progressText');
    const progressBar  = document.getElementById('progressBar');
    const uploadLabel  = document.getElementById('uploadLabel');
    const circumference = 2 * Math.PI * 52; // r=52
    const traderId     = {{ $trader->id }};

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const btn = document.getElementById('editTraderBtn');
        btn.disabled = true;

        // Show overlay at 0%
        overlay.style.display = 'flex';
        setProgress(0);
        uploadLabel.textContent = 'Uploading changes...';

        const xhr = new XMLHttpRequest();
        const formData = new FormData(form);

        let currentProgress = 0;
        let processingTimer = null;
        let serverDone = false;

        // Phase 1: Real upload progress mapped to 0–50%
        xhr.upload.addEventListener('progress', function(ev) {
            if (ev.lengthComputable) {
                const uploadPct = (ev.loaded / ev.total);
                const mapped = Math.round(uploadPct * 50);
                currentProgress = mapped;
                setProgress(currentProgress);
                if (uploadPct >= 1) {
                    uploadLabel.textContent = 'Processing on server...';
                    startProcessingPhase();
                }
            }
        });

        // Phase 2: Animated progress 50% → 95%
        function startProcessingPhase() {
            currentProgress = Math.max(currentProgress, 50);
            setProgress(currentProgress);

            processingTimer = setInterval(() => {
                if (serverDone) {
                    clearInterval(processingTimer);
                    return;
                }
                const remaining = 95 - currentProgress;
                const step = Math.max(0.3, remaining * 0.04);
                currentProgress = Math.min(95, currentProgress + step);
                setProgress(Math.round(currentProgress));

                if (currentProgress >= 70 && currentProgress < 85) {
                    uploadLabel.textContent = 'Uploading to cloud...';
                } else if (currentProgress >= 85) {
                    uploadLabel.textContent = 'Almost done...';
                }
            }, 200);
        }

        xhr.addEventListener('load', function() {
            serverDone = true;
            if (processingTimer) clearInterval(processingTimer);

            // Phase 3: Animate from current to 100%
            animateTo100(function() {
                try {
                    const data = JSON.parse(xhr.responseText);
                    if (xhr.status >= 200 && xhr.status < 300) {
                        uploadLabel.textContent = 'Trader updated successfully!';
                        if (typeof toastr !== 'undefined') toastr.success(data.message || 'Trader updated!');
                        setTimeout(() => {
                            window.location.href = data.redirect_url || "{{ route('traders.index') }}";
                        }, 900);
                    } else {
                        overlay.style.display = 'none';
                        btn.disabled = false;
                        if (data.errors) {
                            Object.values(data.errors).forEach(msgs => msgs.forEach(m => {
                                if (typeof toastr !== 'undefined') toastr.error(m);
                            }));
                        } else {
                            if (typeof toastr !== 'undefined') toastr.error(data.message || 'Error updating trader');
                        }
                    }
                } catch {
                    overlay.style.display = 'none';
                    btn.disabled = false;
                    if (typeof toastr !== 'undefined') toastr.error('Unexpected server error');
                }
            });
        });

        xhr.addEventListener('error', function() {
            serverDone = true;
            if (processingTimer) clearInterval(processingTimer);
            overlay.style.display = 'none';
            btn.disabled = false;
            if (typeof toastr !== 'undefined') toastr.error('Network error. Please try again.');
        });

        xhr.open('POST', `/admin/traders/${traderId}`);
        xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);
        xhr.setRequestHeader('Accept', 'application/json');
        xhr.setRequestHeader('X-HTTP-Method-Override', 'PUT');
        xhr.send(formData);

        // Smoothly count from current to 100
        function animateTo100(callback) {
            uploadLabel.textContent = 'Finalizing...';
            const start = Math.round(currentProgress);
            const steps = 100 - start;
            if (steps <= 0) { setProgress(100); callback(); return; }
            let i = 0;
            const interval = setInterval(() => {
                i++;
                setProgress(start + i);
                if (start + i >= 100) {
                    clearInterval(interval);
                    callback();
                }
            }, 18);
        }
    });

    function setProgress(pct) {
        const offset = circumference - (pct / 100) * circumference;
        progressCirc.style.strokeDashoffset = offset;
        progressText.textContent = pct + '%';
        progressBar.style.width = pct + '%';
    }
});
</script>