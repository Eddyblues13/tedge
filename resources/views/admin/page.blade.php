@include('admin.header')

<div class="main-content">
    <div class="container-fluid">
        {{-- Page Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="admin-page-title">Edit Front Page</h4>
                <p class="admin-page-subtitle">Manage FAQs, testimonials, content and images for your website</p>
            </div>
            <div class="d-flex gap-2">
                <a href="#" data-bs-toggle="modal" data-bs-target="#faqmodal" class="btn btn-admin-primary btn-sm">
                    <i class="fas fa-plus me-1"></i> Add FAQ
                </a>
                <a href="#" data-bs-toggle="modal" data-bs-target="#testi" class="btn btn-admin-primary btn-sm">
                    <i class="fas fa-plus me-1"></i> Add Testimonial
                </a>
                <a href="#" data-bs-toggle="modal" data-bs-target="#content" class="btn btn-admin-primary btn-sm">
                    <i class="fas fa-plus me-1"></i> Add Content
                </a>
                <a href="#" data-bs-toggle="modal" data-bs-target="#images" class="btn btn-admin-primary btn-sm">
                    <i class="fas fa-plus me-1"></i> Add Image
                </a>
            </div>
        </div>

        {{-- =============================== --}}
        {{-- ADD MODALS --}}
        {{-- =============================== --}}

        {{-- Add FAQ Modal --}}
        <div id="faqmodal" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content"
                    style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);">
                    <div class="modal-header" style="border-color:var(--border-color);">
                        <h5 class="modal-title" style="color:var(--heading-color);">Add FAQ</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="account/admin/dashboard/savefaq" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" style="color:var(--heading-color);">Question</label>
                                <input type="text" name="question" placeholder="Enter the Question here"
                                    class="form-control admin-form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color:var(--heading-color);">Answer</label>
                                <textarea name="answer" placeholder="Enter the Answer to the question above"
                                    class="form-control admin-form-control" rows="4" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-admin-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Add Testimonial Modal --}}
        <div id="testi" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content"
                    style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);">
                    <div class="modal-header" style="border-color:var(--border-color);">
                        <h5 class="modal-title" style="color:var(--heading-color);">Add Testimony</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="account/admin/dashboard/savetestimony" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" style="color:var(--heading-color);">Testifier Name</label>
                                <input type="text" name="testifier" placeholder="Full name"
                                    class="form-control admin-form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color:var(--heading-color);">Position</label>
                                <input type="text" name="position" placeholder="System user or anonymous"
                                    class="form-control admin-form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color:var(--heading-color);">What Testifier
                                    Said</label>
                                <textarea name="said" class="form-control admin-form-control" rows="4"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color:var(--heading-color);">Picture</label>
                                <select name="picture" class="form-control admin-form-control">
                                    @foreach($images as $img)
                                    <option>{{ $img->image }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-admin-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Add Content Modal --}}
        <div id="content" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content"
                    style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);">
                    <div class="modal-header" style="border-color:var(--border-color);">
                        <h5 class="modal-title" style="color:var(--heading-color);">Add General Content</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="account/admin/dashboard/savecontents" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" style="color:var(--heading-color);">Title of Content</label>
                                <input type="text" name="title" placeholder="Name of Content"
                                    class="form-control admin-form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color:var(--heading-color);">Content
                                    Description</label>
                                <textarea name="content" placeholder="Describe the content"
                                    class="form-control admin-form-control" rows="2" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-admin-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Add Image Modal --}}
        <div id="images" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content"
                    style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);">
                    <div class="modal-header" style="border-color:var(--border-color);">
                        <h5 class="modal-title" style="color:var(--heading-color);">Add Image</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="account/admin/dashboard/saveimg" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" style="color:var(--heading-color);">Title of Image</label>
                                <input type="text" name="img_title" placeholder="Name of Image"
                                    class="form-control admin-form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color:var(--heading-color);">Image Description</label>
                                <textarea name="img_desc" placeholder="Describe the image"
                                    class="form-control admin-form-control" rows="2"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color:var(--heading-color);">Image</label>
                                <small class="d-block mb-1" style="color:var(--text-color);">Note: Images will be
                                    renamed by our system.</small>
                                <input name="image" class="form-control admin-form-control" type="file">
                            </div>
                            <button type="submit" class="btn btn-admin-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- =============================== --}}
        {{-- TABS --}}
        {{-- =============================== --}}
        <div class="admin-card p-4">
            <ul class="nav nav-pills mb-4" id="pageTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="admin-nav-item active" data-bs-toggle="tab" data-bs-target="#tab-faq" type="button"
                        role="tab">
                        <i class="fas fa-question-circle me-1"></i> FAQs
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="admin-nav-item" data-bs-toggle="tab" data-bs-target="#tab-testimonials" type="button"
                        role="tab">
                        <i class="fas fa-comments me-1"></i> Testimonials
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="admin-nav-item" data-bs-toggle="tab" data-bs-target="#tab-contents" type="button"
                        role="tab">
                        <i class="fas fa-file-alt me-1"></i> Website Contents
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="admin-nav-item" data-bs-toggle="tab" data-bs-target="#tab-images" type="button"
                        role="tab">
                        <i class="fas fa-images me-1"></i> Images
                    </button>
                </li>
            </ul>

            <div class="tab-content">
                {{-- ============================================= --}}
                {{-- TAB 1: FAQs --}}
                {{-- ============================================= --}}
                <div class="tab-pane fade show active" id="tab-faq" role="tabpanel">
                    <div class="row g-3">
                        @foreach($faqs as $faq)
                        <div class="col-md-4">
                            <div class="admin-card p-3 h-100">
                                <h6 class="fw-bold mb-2" style="color:var(--heading-color);">{{ $faq->question }}</h6>
                                <p class="mb-3" style="color:var(--text-color);font-size:0.9rem;">{{ $faq->answer }}</p>
                                <div class="d-flex gap-2">
                                    <a href="account/admin/dashboard/delfaq/{{ $faq->id }}" class="btn btn-sm"
                                        style="background:#dc3545;color:#fff;">
                                        <i class="fas fa-times"></i>
                                    </a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#editfaq{{ $faq->id }}"
                                        class="btn btn-admin-primary btn-sm">Edit</a>
                                </div>
                            </div>
                        </div>
                        {{-- Edit FAQ Modal --}}
                        <div id="editfaq{{ $faq->id }}" class="modal fade" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content"
                                    style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);">
                                    <div class="modal-header" style="border-color:var(--border-color);">
                                        <h5 class="modal-title" style="color:var(--heading-color);">Update FAQ</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="account/admin/dashboard/updatefaq" method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label class="form-label"
                                                    style="color:var(--heading-color);">Question</label>
                                                <input type="text" name="question" value="{{ $faq->question }}"
                                                    class="form-control admin-form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label"
                                                    style="color:var(--heading-color);">Answer</label>
                                                <textarea name="answer" class="form-control admin-form-control" rows="4"
                                                    required>{{ $faq->answer }}</textarea>
                                            </div>
                                            <input type="hidden" name="id" value="{{ $faq->id }}">
                                            <button type="submit" class="btn btn-admin-primary">Update</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- ============================================= --}}
                {{-- TAB 2: Testimonials --}}
                {{-- ============================================= --}}
                <div class="tab-pane fade" id="tab-testimonials" role="tabpanel">
                    <div class="row g-3">
                        @foreach($testimonies as $testimony)
                        <div class="col-md-4">
                            <div class="admin-card p-3 h-100">
                                <h6 class="fw-bold mb-1" style="color:var(--heading-color);">{{ $testimony->testifier }}
                                </h6>
                                <p class="mb-2" style="color:var(--text-color);font-size:0.9rem;">{{ $testimony->said }}
                                </p>
                                <ul class="list-unstyled mb-3" style="color:var(--text-color);font-size:0.85rem;">
                                    <li><i class="fas fa-briefcase me-1"></i> {{ $testimony->position }}</li>
                                    <li><i class="fas fa-image me-1"></i> {{ $testimony->picture }}</li>
                                </ul>
                                <div class="d-flex gap-2">
                                    <a href="account/admin/dashboard/deltestimony/{{ $testimony->id }}"
                                        class="btn btn-sm" style="background:#dc3545;color:#fff;">
                                        <i class="fas fa-times"></i>
                                    </a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#edittes{{ $testimony->id }}"
                                        class="btn btn-admin-primary btn-sm">Edit</a>
                                </div>
                            </div>
                        </div>
                        {{-- Edit Testimony Modal --}}
                        <div id="edittes{{ $testimony->id }}" class="modal fade" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content"
                                    style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);">
                                    <div class="modal-header" style="border-color:var(--border-color);">
                                        <h5 class="modal-title" style="color:var(--heading-color);">Update Testimony
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="account/admin/dashboard/updatetestimony" method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label class="form-label" style="color:var(--heading-color);">Testifier
                                                    Name</label>
                                                <input type="text" name="testifier" value="{{ $testimony->testifier }}"
                                                    class="form-control admin-form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label"
                                                    style="color:var(--heading-color);">Position</label>
                                                <input type="text" name="position" value="{{ $testimony->position }}"
                                                    class="form-control admin-form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" style="color:var(--heading-color);">What
                                                    Testifier Said</label>
                                                <textarea name="said" class="form-control admin-form-control"
                                                    rows="4">{{ $testimony->said }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label"
                                                    style="color:var(--heading-color);">Picture</label>
                                                <select name="picture" class="form-control admin-form-control">
                                                    <option value="{{ $testimony->picture }}">{{ $testimony->picture }}
                                                    </option>
                                                    @foreach($images as $img)
                                                    <option>{{ $img->image }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <input type="hidden" name="id" value="{{ $testimony->id }}">
                                            <button type="submit" class="btn btn-admin-primary">Update</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- ============================================= --}}
                {{-- TAB 3: Website Contents --}}
                {{-- ============================================= --}}
                <div class="tab-pane fade" id="tab-contents" role="tabpanel">
                    <div class="row g-3">
                        @foreach($contents as $cont)
                        <div class="col-md-3">
                            <div class="admin-card p-3 h-100">
                                <h6 class="fw-bold mb-2" style="color:var(--heading-color);">{{ $cont->title }}</h6>
                                <p class="mb-3" style="color:var(--text-color);font-size:0.85rem;">{{
                                    Str::limit($cont->content, 100) }}</p>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#editcont{{ $cont->id }}"
                                    class="btn btn-admin-primary btn-sm">Edit</a>
                            </div>
                        </div>
                        {{-- Edit Content Modal --}}
                        <div id="editcont{{ $cont->id }}" class="modal fade" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content"
                                    style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);">
                                    <div class="modal-header" style="border-color:var(--border-color);">
                                        <h5 class="modal-title" style="color:var(--heading-color);">Update General
                                            Content</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="account/admin/dashboard/updatecontents" method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label class="form-label" style="color:var(--heading-color);">Title of
                                                    Content</label>
                                                <input type="text" name="title" value="{{ $cont->title }}"
                                                    class="form-control admin-form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" style="color:var(--heading-color);">Content
                                                    Description</label>
                                                <textarea name="content" class="form-control admin-form-control"
                                                    rows="2" required>{{ $cont->content }}</textarea>
                                            </div>
                                            <input type="hidden" name="id" value="{{ $cont->id }}">
                                            <button type="submit" class="btn btn-admin-primary">Update</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- ============================================= --}}
                {{-- TAB 4: Images --}}
                {{-- ============================================= --}}
                <div class="tab-pane fade" id="tab-images" role="tabpanel">
                    <div class="row g-3">
                        @foreach($images as $image)
                        <div class="col-md-4">
                            <div class="admin-card p-3 h-100">
                                <img src="account/storage/app/public/photos/{{ $image->image }}" class="rounded mb-3"
                                    style="max-width:50%;height:auto;" alt="Image">
                                <h6 class="fw-bold mb-1" style="color:var(--heading-color);">{{ $image->img_title }}
                                </h6>
                                <p class="mb-3" style="color:var(--text-color);font-size:0.85rem;">{{ $image->img_desc
                                    }}</p>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#editimg{{ $image->id }}"
                                    class="btn btn-admin-primary btn-sm">Edit</a>
                            </div>
                        </div>
                        {{-- Edit Image Modal --}}
                        <div id="editimg{{ $image->id }}" class="modal fade" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content"
                                    style="background:var(--card-bg);color:var(--text-color);border:1px solid var(--border-color);">
                                    <div class="modal-header" style="border-color:var(--border-color);">
                                        <h5 class="modal-title" style="color:var(--heading-color);">Update Image</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="account/admin/dashboard/updateimg" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-3">
                                                <label class="form-label" style="color:var(--heading-color);">Title of
                                                    Image</label>
                                                <input type="text" name="img_title" value="{{ $image->img_title }}"
                                                    class="form-control admin-form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" style="color:var(--heading-color);">Image
                                                    Description</label>
                                                <textarea name="img_desc" class="form-control admin-form-control"
                                                    rows="2">{{ $image->img_desc }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label"
                                                    style="color:var(--heading-color);">Image</label>
                                                <input name="image" class="form-control admin-form-control" type="file">
                                            </div>
                                            <input type="hidden" name="id" value="{{ $image->id }}">
                                            <button type="submit" class="btn btn-admin-primary">Update</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.footer')