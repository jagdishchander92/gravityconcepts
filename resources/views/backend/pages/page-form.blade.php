<x-app>
    <div class="container-fluid component">
        <div class="card card-shadow mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="fs-3 mb-0">{{ $page ? 'Edit' : 'Create' }} Pages</h3>
                    </div>
                    <div>
                        <a href="{{ route('pages.index') }}">
                            <button class="btn btn-primary">
                                <i class="ti ti-list"></i>
                                Pages
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        @php
            $sections = old('sections', $page->blocks ?? []);
            $faqSection = collect($sections)->firstWhere('type', 'faq');
        @endphp

        <div class="row">
            <x-alert/>
            <form action="{{ $page ? route('pages.update', $page->id) : route('pages.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf

                <div class="col-md-12">
                    <div class="card card-shadow mb-4">
                        <div class="card-body">
                            <div class="row g-4">

                                {{-- ===== PAGE META ===== --}}
                                <div class="col-md-6">
                                    <div class="card border-success h-100">
                                        <div class="card-header bg-success text-white">
                                            <strong class="card-title mb-0">Page Details</strong>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="title" class="form-label fw-semibold">Title</label>
                                                <input type="text" name="title" id="title"
                                                    class="form-control @error('title') is-invalid @enderror"
                                                    value="{{ old('title', $page ? $page->title : '') }}"
                                                    placeholder="Page title" required>
                                                @error('title')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="slug" class="form-label fw-semibold">Slug</label>
                                                <input type="text" name="slug" id="slug"
                                                    class="form-control @error('slug') is-invalid @enderror"
                                                    value="{{ old('slug', $page ? $page->slug : '') }}"
                                                    placeholder="page-slug">
                                                @error('slug')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="meta_title" class="form-label fw-semibold">Meta
                                                    Title</label>
                                                <input type="text" name="meta_title" id="meta_title"
                                                    class="form-control @error('meta_title') is-invalid @enderror"
                                                    value="{{ old('meta_title', $page ? $page->meta_title : '') }}"
                                                    placeholder="SEO meta title">
                                                @error('meta_title')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-0">
                                                <label for="meta_desc" class="form-label fw-semibold">Meta
                                                    Description</label>
                                                <textarea name="meta_desc" id="meta_desc" class="form-control @error('meta_desc') is-invalid @enderror" rows="3"
                                                    placeholder="SEO meta description">{{ old('meta_desc', $page ? $page->meta_description : '') }}</textarea>
                                                @error('meta_desc')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- ===== PAGE HEADER ===== --}}
                                <div class="col-md-6">
                                    <div class="card border-success h-100">
                                        <div class="card-header bg-success text-white">
                                            <strong class="mb-0">Page Header</strong>
                                        </div>
                                        <div class="card-body">
                                            @php
                                                $bread_title = null;
                                                $bread_sub_title = null;
                                                $sec_title = null;
                                                $sec_desc = null;
                                                $bread_image = null; // ADD THIS LINE
                                                if ($page && $page->header_section) {
                                                    info('the header section is', $page->header_section);
                                                    $bread_title = data_get(
                                                        $page->header_section,
                                                        'breadcrumb_title',
                                                        null,
                                                    );
                                                    $bread_sub_title = data_get(
                                                        $page->header_section,
                                                        'breadcrumb_subtitle',
                                                        null,
                                                    );
                                                    $sec_title = data_get($page->header_section, 'section_title', null);
                                                    $sec_desc = data_get(
                                                        $page->header_section,
                                                        'section_description',
                                                        null,
                                                    );
                                                    $bread_image = data_get($page->header_section, 'image', null); // ADD THIS LINE
                                                }
                                            @endphp
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Page Header Image</label>
                                                <div class="image-wrapper">
                                                    <button type="button" class="btn btn-primary btn-sm image-picker">
                                                        <i class="ti ti-photo me-1"></i> Select Image
                                                    </button>
                                                    <input type="hidden" name="breadcrumb_image" class="image-content"
                                                        value="{{ old('breadcrumb_image', $bread_image ?: '') }}">
                                                    <div class="image-preview mt-2">
                                                        @if ($bread_image)
                                                            <div class="position-relative d-inline-block">
                                                                <img src="{{ imgUrl($bread_image) }}" class="img-thumbnail"
                                                                    style="max-height:120px; max-width:100%;">
                                                                <button type="button"
                                                                    class="btn btn-danger btn-sm position-absolute top-0 end-0 remove-image">&times;</button>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row g-3 mb-3">
                                                <div class="col-md-6">
                                                    <label for="breadcrumb_title" class="form-label fw-semibold">Header
                                                        Title</label>
                                                    <input type="text" name="breadcrumb_title" id="breadcrumb_title"
                                                        class="form-control" placeholder="Breadcrumb Title"
                                                        value="{{ old('breadcrumb_title', $bread_title ?: '') }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="breadcrumb_subtitle"
                                                        class="form-label fw-semibold">Header Sub Title</label>
                                                    <input type="text" name="breadcrumb_subtitle"
                                                        id="breadcrumb_subtitle" class="form-control"
                                                        placeholder="Breadcrumb Sub Title"
                                                        value="{{ old('breadcrumb_subtitle', $bread_sub_title ?: '') }}">
                                                </div>
                                            </div>

                                            <div class="card bg-light border-0 p-3 mb-0">
                                                <p class="fw-semibold mb-2 text-muted small text-uppercase ls-1">
                                                    Section
                                                    1</p>
                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold">Section Title</label>
                                                    <input type="text" name="section_title" class="form-control"
                                                        placeholder="Section Title"
                                                        value="{{ old('section_title', $sec_title ?: '') }}">
                                                </div>
                                                <div class="mb-0">
                                                    <label class="form-label fw-semibold">Section Description</label>
                                                    <textarea name="section_description" class="form-control" rows="3" placeholder="Section Description">{{ old('section_description', $sec_desc ?: '') }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>{{-- end .row --}}
                        </div>
                    </div>
                </div>

                {{-- ===== DYNAMIC SECTIONS ===== --}}
                <div id="main-sections-container" class="col-md-12"></div>

                {{-- ===== ADD SECTION BUTTON ===== --}}
                <div class="col-md-12 text-center mb-5 mt-2">
                    <div class="dropdown">
                        <button class="btn btn-dark dropdown-toggle btn-lg" type="button" data-bs-toggle="dropdown">
                            + Add New Section
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item add-section-btn" href="#" data-type="card_basic">1.
                                    Card (Title &amp; Desc)</a></li>
                            <li><a class="dropdown-item add-section-btn" href="#" data-type="card_icon">2. Card
                                    (Icon, Title, Desc)</a></li>
                            <li><a class="dropdown-item add-section-btn" href="#" data-type="ul_list">3.
                                    Unordered List</a></li>
                            <li><a class="dropdown-item add-section-btn" href="#" data-type="ol_list">4.
                                    Ordered List</a></li>
                            <li><a class="dropdown-item add-section-btn" href="#" data-type="icon_list">5. List
                                    with Icon &amp; Text</a></li>
                            <li><a class="dropdown-item add-section-btn" href="#" data-type="desc_only">6.
                                    Description Only</a></li>
                            <li><a class="dropdown-item add-section-btn" href="#" data-type="card_img">7. Card
                                    (Img, Title, Desc)</a></li>
                            <li><a class="dropdown-item add-section-btn" href="#" data-type="zig_zag">8.
                                    Zig-Zag</a></li>
                            <li><a class="dropdown-item add-section-btn" href="#" data-type="counter_icon">9.
                                    Counter</a></li>
                            <li><a class="dropdown-item add-section-btn" href="#" data-type="faq">10. FAQ
                                    Section</a></li>
                            <li><a class="dropdown-item add-section-btn" href="#" data-type="gallary">11.
                                    gallary</a></li>
                            <li><a class="dropdown-item add-section-btn" href="#"
                                    data-type="about_section_1">13.
                                    About Section</a></li>
                            <li><a class="dropdown-item add-section-btn" href="#"
                                    data-type="company_about_section_1">14.
                                    Company About Section 1 (Light)</a></li>
                            <li><a class="dropdown-item add-section-btn" href="#"
                                    data-type="company_about_section_2">15.
                                    Company About Section 2 (Light)</a></li>
                            <li><a class="dropdown-item add-section-btn" href="#"
                                    data-type="results_counter">17.
                                    Results With Counter (Dark)</a></li>
                            <li><a class="dropdown-item add-section-btn" href="#" data-type="contact_form">18.
                                    Contact Form</a></li>
                            <li><a class="dropdown-item add-section-btn" href="#"
                                    data-type="home_page_slider">19.
                                    Homepage Slider</a></li>
                            <li><a class="dropdown-item add-section-btn" href="#" data-type="card_img_desc">20.
                                    Card Img Desc</a></li>
                            <li><a class="dropdown-item add-section-btn" href="#" data-type="testimonials">21.
                                    Testimonials</a></li>
                            <li><a class="dropdown-item add-section-btn" href="#" data-type="progress">22.
                                    Progress</a></li>
                            <li><a class="dropdown-item add-section-btn" href="#" data-type="latest_blogs">23.
                                    Latest Blogs</a></li>
                            <li><a class="dropdown-item add-section-btn" href="#"
                                    data-type="company_about_section_3">24.
                                    Company About Section 3</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="d-flex gap-2 justify-content-end floating-button-group">
                        <a href="{{ route('pages.index') }}" class="btn btn-sm btn-danger">
                            <i class="ti ti-arrow-back-up"></i> Cancel</a>
                        <button type="button" class="btn btn-sm btn-secondary" id="preview-btn">
                            <i class="ti ti-eye me-1"></i> Preview
                        </button>
                        <button type="submit" class="btn btn-sm btn-warning" name="draft">
                            <i class="ti ti-file me-1"></i> Draft
                        </button>
                        <button type="submit" class="btn btn-sm btn-primary text-white">
                            <i class="ti ti-device-floppy me-1"></i> Save
                        </button>
                        <button type="submit" class="btn btn-sm btn-success text-white" name="publish">
                            <i class="ti ti-send me-1"></i> Save & Publish
                        </button>
                    </div>
                </div>

            </form>
        </div>

        <template id="tpl-progress">
            <div class="card card-add-component mb-4 section-block border-primary" data-type="progress">
                <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                    <span class="drag-handle" style="cursor:grab; font-size:18px; opacity:0.7;">⠿</span>
                    <strong>Section: Progress</strong>
                    <button type="button" class="btn btn-danger btn-sm remove-block">Remove Section</button>
                </div>
                <div class="card-body">
                    <input type="hidden" name="sections[S_IDX][type]" value="progress">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">Section Title</label>
                                <input type="text" name="sections[S_IDX][section_title]" class="form-control"
                                    placeholder="Section title">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">Section Subtitle</label>
                                <input type="text" name="sections[S_IDX][section_subtitle]" class="form-control"
                                    placeholder="Subtitle">
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="" class="form-label">Section Description</label>
                                <input name="sections[S_IDX][section_description]" rows="6"
                                    class="form-control" />
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">Section Style</label>
                                <div class="input-group">
                                    <select name="sections[S_IDX][section_style]" class="form-select">
                                        <option value="style_1">Style 1</option>
                                        <option value="style_2">Style 2</option>
                                        <option value="style_3">Style 3</option>
                                    </select>


                                    <button class="btn btn-info text-white" type="button" data-bs-toggle="modal"
                                        data-bs-target="#stylesProgress">
                                        <i class="ti ti-progress-help"></i>
                                    </button>


                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Image</label>
                            <div class="image-wrapper">
                                <button class="btn btn-primary btn-sm image-picker w-100" type="button">
                                    <i class="ti ti-photo"></i> Select Image
                                </button>
                                <div class="image-preview mt-2"></div>
                                <input type="hidden" class="image-content" name="sections[S_IDX][section_bg_img]">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Bg Color</label>
                            {{-- <input type="text" name="sections[S_IDX][section_bg_color]" class="form-control"> --}}

                            <div class="color-picker-group">
                                <div class="input-group align-items-center">
                                    <span class="input-group-text p-1">
                                        <span class="color-preview"></span>
                                    </span>
                                    <input type="color" class="color-input">
                                    <input type="text" name="sections[S_IDX][section_bg_color]"
                                        class="form-control color-hex" placeholder="#00a6a6">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Text Color</label>
                            {{-- <input type="text" name="sections[S_IDX][section_bg_color]" class="form-control"> --}}

                            <div class="color-picker-group">
                                <div class="input-group align-items-center">
                                    <span class="input-group-text p-1">
                                        <span class="color-preview"></span>
                                    </span>
                                    <input type="color" class="color-input">
                                    <input type="text" name="sections[S_IDX][section_text_color]"
                                        class="form-control color-hex" placeholder="#00a6a6">
                                </div>
                            </div>
                        </div>

                    </div>
                    <hr>
                    <div class="items-wrapper"></div>
                    <button type="button" class="btn btn-success btn-sm mt-2 add-item-btn">+ Add Card</button>
                </div>
            </div>
        </template>

        <template id="tpl-progress-item">
            <div class="card mb-3 item-row border-0 bg-light">
                <div class="card-body">
                    <div class="row g-3 align-items-start">
                        <div class="col-md-5">
                            <label class="form-label fw-semibold">Step</label>
                            <input type="text" name="sections[S_IDX][items][I_IDX][step]" class="form-control"
                                placeholder="Step">
                        </div>
                        <div class="col-md-5">
                            <label class="form-label fw-semibold">Title</label>
                            <input type="text" name="sections[S_IDX][items][I_IDX][title]" class="form-control"
                                placeholder="Title">
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="button"
                                class="btn btn-outline-danger btn-sm w-100 remove-item">Remove</button>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Image</label>
                            <div class="image-wrapper">
                                <button class="btn btn-primary btn-sm image-picker w-100" type="button">
                                    <i class="ti ti-photo"></i> Select Image
                                </button>
                                <div class="image-preview mt-2"></div>
                                <input type="hidden" class="image-content" name="sections[S_IDX][section_bg_img]">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Bg Color</label>
                            {{-- <input type="text" name="sections[S_IDX][section_bg_color]" class="form-control"> --}}

                            <div class="color-picker-group">
                                <div class="input-group align-items-center">
                                    <span class="input-group-text p-1">
                                        <span class="color-preview"></span>
                                    </span>
                                    <input type="color" class="color-input">
                                    <input type="text" name="sections[S_IDX][section_bg_color]"
                                        class="form-control color-hex" placeholder="#00a6a6">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Text Color</label>
                            {{-- <input type="text" name="sections[S_IDX][section_bg_color]" class="form-control"> --}}

                            <div class="color-picker-group">
                                <div class="input-group align-items-center">
                                    <span class="input-group-text p-1">
                                        <span class="color-preview"></span>
                                    </span>
                                    <input type="color" class="color-input">
                                    <input type="text" name="sections[S_IDX][section_text_color]"
                                        class="form-control color-hex" placeholder="#00a6a6">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Card Description</label>
                            <input type="text" name="sections[S_IDX][items][I_IDX][desc]" class="form-control"
                                rows="3" placeholder="Card description..." />
                        </div>
                    </div>
                </div>
            </div>
        </template>




        <template id="tpl-card_basic">
            <div class="card card-add-component mb-4 section-block border-primary" data-type="card_basic">
                <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                    <span class="drag-handle" style="cursor:grab; font-size:18px; opacity:0.7;">⠿</span>
                    <strong>Section: Card with Title &amp; Description</strong>
                    <button type="button" class="btn btn-danger btn-sm remove-block">Remove Section</button>
                </div>
                <div class="card-body">
                    <input type="hidden" name="sections[S_IDX][type]" value="card_basic">
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Section Title</label>
                            <input type="text" name="sections[S_IDX][section_title]" class="form-control"
                                placeholder="Section title">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Section Subtitle</label>
                            <input type="text" name="sections[S_IDX][section_subtitle]" class="form-control"
                                placeholder="Subtitle">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Section Style</label>
                            <div class="input-group">
                                <select name="sections[S_IDX][section_style]" class="form-select">
                                    <option value="style_1">Style 1</option>
                                    {{-- <option value="style_2">Style 2</option>
                                <option value="style_3">Style 3</option> --}}
                                </select>
                                <button class="btn btn-info text-white" type="button" data-bs-toggle="modal"
                                    data-bs-target="#stylesCardBasic">
                                    <i class="ti ti-progress-help"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Image</label>
                            <div class="image-wrapper">
                                <button class="btn btn-primary btn-sm image-picker w-100" type="button">
                                    <i class="ti ti-photo"></i> Select Image
                                </button>
                                <div class="image-preview mt-2"></div>
                                <input type="hidden" class="image-content" name="sections[S_IDX][section_bg_img]">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Bg Color</label>
                            {{-- <input type="text" name="sections[S_IDX][section_bg_color]" class="form-control"> --}}

                            <div class="color-picker-group">
                                <div class="input-group align-items-center">
                                    <span class="input-group-text p-1">
                                        <span class="color-preview"></span>
                                    </span>
                                    <input type="color" class="color-input">
                                    <input type="text" name="sections[S_IDX][section_bg_color]"
                                        class="form-control color-hex" placeholder="#00a6a6">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Text Color</label>
                            {{-- <input type="text" name="sections[S_IDX][section_bg_color]" class="form-control"> --}}

                            <div class="color-picker-group">
                                <div class="input-group align-items-center">
                                    <span class="input-group-text p-1">
                                        <span class="color-preview"></span>
                                    </span>
                                    <input type="color" class="color-input">
                                    <input type="text" name="sections[S_IDX][section_text_color]"
                                        class="form-control color-hex" placeholder="#00a6a6">
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <hr>
                    <div class="items-wrapper"></div>
                    <button type="button" class="btn btn-success btn-sm mt-2 add-item-btn">+ Add Card</button>
                </div>
            </div>
        </template>

        <template id="tpl-card_basic-item">
            <div class="card mb-3 item-row border-0 bg-light">
                <div class="card-body">
                    <div class="row g-3 align-items-start">
                        <div class="col-md-5">
                            <label class="form-label fw-semibold">Card Title</label>
                            <input type="text" name="sections[S_IDX][items][I_IDX][title]" class="form-control"
                                placeholder="Card title">
                        </div>
                        <div class="col-md-5">
                            <label class="form-label fw-semibold">Slug (if any)</label>
                            <input type="text" name="sections[S_IDX][items][I_IDX][slug]" class="form-control"
                                placeholder="card-slug">
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="button"
                                class="btn btn-outline-danger btn-sm w-100 remove-item">Remove</button>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Card Description</label>
                            <textarea name="sections[S_IDX][items][I_IDX][desc]" class="form-control" rows="3"
                                placeholder="Card description..."></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </template>

        <template id="tpl-card_icon">
            <div class="card card-add-component mb-4 section-block border-info" data-type="card_icon">
                <div class="card-header d-flex justify-content-between align-items-center bg-info text-white">
                    <span class="drag-handle" style="cursor:grab; font-size:18px; opacity:0.7;">⠿</span>
                    <strong>Section: Card with Icon, Title &amp; Desc</strong>
                    <button type="button" class="btn btn-danger btn-sm remove-block">Remove Section</button>
                </div>
                <div class="card-body">
                    <input type="hidden" name="sections[S_IDX][type]" value="card_icon">
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Section Title</label>
                            <input type="text" name="sections[S_IDX][section_title]" class="form-control"
                                placeholder="Section title">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Section Subtitle</label>
                            <input type="text" name="sections[S_IDX][section_subtitle]" class="form-control"
                                placeholder="Subtitle">
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label fw-semibold">Style</label>
                                <div class="input-group">
                                    <select name="sections[S_IDX][section_style]" class="form-select">
                                        <option value="style_1">Style 1</option>
                                        <option value="style_2">Style 2</option>
                                        <option value="style_3">Style 3</option>
                                        <option value="style_4">Style 4</option>
                                        <option value="style_5">Style 5</option>
                                    </select>
                                    <button class="btn btn-info text-white" type="button" data-bs-toggle="modal"
                                        data-bs-target="#stylesCardIcon">
                                        <i class="ti ti-progress-help"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Image</label>
                            <div class="image-wrapper">
                                <button class="btn btn-primary btn-sm image-picker w-100" type="button">
                                    <i class="ti ti-photo"></i> Select Image
                                </button>
                                <div class="image-preview mt-2"></div>
                                <input type="hidden" class="image-content" name="sections[S_IDX][section_bg_img]">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Bg Color</label>
                            {{-- <input type="text" name="sections[S_IDX][section_bg_color]" class="form-control"> --}}

                            <div class="color-picker-group">
                                <div class="input-group align-items-center">
                                    <span class="input-group-text p-1">
                                        <span class="color-preview"></span>
                                    </span>
                                    <input type="color" class="color-input">
                                    <input type="text" name="sections[S_IDX][section_bg_color]"
                                        class="form-control color-hex" placeholder="#00a6a6">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Text Color</label>
                            {{-- <input type="text" name="sections[S_IDX][section_bg_color]" class="form-control"> --}}

                            <div class="color-picker-group">
                                <div class="input-group align-items-center">
                                    <span class="input-group-text p-1">
                                        <span class="color-preview"></span>
                                    </span>
                                    <input type="color" class="color-input">
                                    <input type="text" name="sections[S_IDX][section_text_color]"
                                        class="form-control color-hex" placeholder="#00a6a6">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="items-wrapper"></div>
                    <button type="button" class="btn btn-success btn-sm mt-2 add-item-btn">+ Add Icon Card</button>
                </div>
            </div>
        </template>

        <template id="tpl-card_icon-item">
            <div class="card mb-3 item-row border-0 bg-light">
                <div class="card-body">
                    <div class="row g-3 align-items-start">
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Icon (Class)</label>
                            <div class="input-group iconpicker-group">
                                <input type="text" name="sections[S_IDX][items][I_IDX][icon]"
                                    class="form-control iconpicker-input" placeholder="fa fa-star" />
                                <span class="input-group-text"><i class="fa fa-icons"></i></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Title</label>
                            <input type="text" name="sections[S_IDX][items][I_IDX][title]" class="form-control"
                                placeholder="Card title">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Slug</label>
                            <input type="text" name="sections[S_IDX][items][I_IDX][slug]" class="form-control"
                                placeholder="card-slug">
                        </div>
                        <div class="col-md-1 d-flex align-items-end">
                            <button type="button" class="btn btn-outline-danger btn-sm w-100 remove-item">X</button>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Description</label>
                            <textarea name="sections[S_IDX][items][I_IDX][desc]" class="form-control" rows="2"
                                placeholder="Card description..."></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </template>

        <template id="tpl-ul_list">
            <div class="card card-add-component mb-4 section-block border-warning" data-type="ul_list">
                <div class="card-header d-flex justify-content-between align-items-center bg-warning text-dark">
                    <span class="drag-handle" style="cursor:grab; font-size:18px; opacity:0.7;">⠿</span>
                    <strong>Section: List (Unordered)</strong>
                    <button type="button" class="btn btn-danger btn-sm remove-block">Remove Section</button>
                </div>
                <div class="card-body">
                    <input type="hidden" name="sections[S_IDX][type]" value="ul_list">
                    <div class="row g-3 mb-3">
                        <div class="col-md-5">
                            <label class="form-label fw-semibold">Section Title</label>
                            <input type="text" name="sections[S_IDX][section_title]" class="form-control"
                                placeholder="Section title">
                        </div>
                        <div class="col-md-5">
                            <label class="form-label fw-semibold">Section Subtitle</label>
                            <input type="text" name="sections[S_IDX][section_subtitle]" class="form-control"
                                placeholder="Subtitle">
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-info text-white mt-4" type="button" data-bs-toggle="modal"
                                data-bs-target="#stylesUl">
                                <i class="ti ti-progress-help"></i>
                            </button>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Image</label>
                            <div class="image-wrapper">
                                <button class="btn btn-primary btn-sm image-picker w-100" type="button">
                                    <i class="ti ti-photo"></i> Select Image
                                </button>
                                <div class="image-preview mt-2"></div>
                                <input type="hidden" class="image-content" name="sections[S_IDX][section_bg_img]">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Bg Color</label>
                            {{-- <input type="text" name="sections[S_IDX][section_bg_color]" class="form-control"> --}}

                            <div class="color-picker-group">
                                <div class="input-group align-items-center">
                                    <span class="input-group-text p-1">
                                        <span class="color-preview"></span>
                                    </span>
                                    <input type="color" class="color-input">
                                    <input type="text" name="sections[S_IDX][section_bg_color]"
                                        class="form-control color-hex" placeholder="#00a6a6">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Text Color</label>
                            {{-- <input type="text" name="sections[S_IDX][section_bg_color]" class="form-control"> --}}

                            <div class="color-picker-group">
                                <div class="input-group align-items-center">
                                    <span class="input-group-text p-1">
                                        <span class="color-preview"></span>
                                    </span>
                                    <input type="color" class="color-input">
                                    <input type="text" name="sections[S_IDX][section_text_color]"
                                        class="form-control color-hex" placeholder="#00a6a6">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="items-wrapper"></div>
                    <button type="button" class="btn btn-success btn-sm mt-2 add-item-btn">+ Add List Item</button>
                </div>
            </div>
        </template>

        <template id="tpl-ul_list-item">
            <div class="item-row row g-2 mb-2 align-items-center">
                <div class="col-md-10">
                    <input type="text" name="sections[S_IDX][items][I_IDX][text]" class="form-control"
                        placeholder="List item text...">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-outline-danger btn-sm w-100 remove-item">Remove</button>
                </div>
            </div>
        </template>

        <template id="tpl-ol_list">
            <div class="card card-add-component mb-4 section-block border-warning" data-type="ol_list">
                <div class="card-header d-flex justify-content-between align-items-center bg-warning text-dark">
                    <span class="drag-handle" style="cursor:grab; font-size:18px; opacity:0.7;">⠿</span>
                    <strong>Section: List (Ordered)</strong>
                    <button type="button" class="btn btn-danger btn-sm remove-block">Remove Section</button>
                </div>
                <div class="card-body">
                    <input type="hidden" name="sections[S_IDX][type]" value="ol_list">
                    <div class="row g-3 mb-3">
                        <div class="col-md-5">
                            <label class="form-label fw-semibold">Section Title</label>
                            <input type="text" name="sections[S_IDX][section_title]" class="form-control"
                                placeholder="Section title">
                        </div>
                        <div class="col-md-5">
                            <label class="form-label fw-semibold">Section Subtitle</label>
                            <input type="text" name="sections[S_IDX][section_subtitle]" class="form-control"
                                placeholder="Subtitle">
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-info text-white mt-4" type="button" data-bs-toggle="modal"
                                data-bs-target="#stylesOl">
                                <i class="ti ti-progress-help"></i>
                            </button>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Image</label>
                            <div class="image-wrapper">
                                <button class="btn btn-primary btn-sm image-picker w-100" type="button">
                                    <i class="ti ti-photo"></i> Select Image
                                </button>
                                <div class="image-preview mt-2"></div>
                                <input type="hidden" class="image-content" name="sections[S_IDX][section_bg_img]">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Bg Color</label>
                            {{-- <input type="text" name="sections[S_IDX][section_bg_color]" class="form-control"> --}}

                            <div class="color-picker-group">
                                <div class="input-group align-items-center">
                                    <span class="input-group-text p-1">
                                        <span class="color-preview"></span>
                                    </span>
                                    <input type="color" class="color-input">
                                    <input type="text" name="sections[S_IDX][section_bg_color]"
                                        class="form-control color-hex" placeholder="#00a6a6">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Text Color</label>
                            {{-- <input type="text" name="sections[S_IDX][section_bg_color]" class="form-control"> --}}

                            <div class="color-picker-group">
                                <div class="input-group align-items-center">
                                    <span class="input-group-text p-1">
                                        <span class="color-preview"></span>
                                    </span>
                                    <input type="color" class="color-input">
                                    <input type="text" name="sections[S_IDX][section_text_color]"
                                        class="form-control color-hex" placeholder="#00a6a6">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="items-wrapper"></div>
                    <button type="button" class="btn btn-success btn-sm mt-2 add-item-btn">+ Add List Item</button>
                </div>
            </div>
        </template>

        <template id="tpl-ol_list-item">
            <div class="item-row row g-2 mb-2 align-items-center">
                <div class="col-md-10">
                    <input type="text" name="sections[S_IDX][items][I_IDX][text]" class="form-control"
                        placeholder="List item text...">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-outline-danger btn-sm w-100 remove-item">Remove</button>
                </div>
            </div>
        </template>

        <template id="tpl-icon_list">
            <div class="card card-add-component mb-4 section-block border-success" data-type="icon_list">
                <div class="card-header d-flex justify-content-between align-items-center bg-success text-white">
                    <span class="drag-handle" style="cursor:grab; font-size:18px; opacity:0.7;">⠿</span>
                    <strong>Section: List with Icon &amp; Text</strong>
                    <button type="button" class="btn btn-danger btn-sm remove-block">Remove Section</button>
                </div>
                <div class="card-body">
                    <input type="hidden" name="sections[S_IDX][type]" value="icon_list">
                    <div class="row g-3 mb-3">
                        <div class="col-md-5">
                            <label class="form-label fw-semibold">Section Title</label>
                            <input type="text" name="sections[S_IDX][section_title]" class="form-control"
                                placeholder="Section title">
                        </div>
                        <div class="col-md-5">
                            <label class="form-label fw-semibold">Section Subtitle</label>
                            <input type="text" name="sections[S_IDX][section_subtitle]" class="form-control"
                                placeholder="Subtitle">
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-info text-white mt-4" type="button" data-bs-toggle="modal"
                                data-bs-target="#stylesIconList">
                                <i class="ti ti-progress-help"></i>
                            </button>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Image</label>
                            <div class="image-wrapper">
                                <button class="btn btn-primary btn-sm image-picker w-100" type="button">
                                    <i class="ti ti-photo"></i> Select Image
                                </button>
                                <div class="image-preview mt-2"></div>
                                <input type="hidden" class="image-content" name="sections[S_IDX][section_bg_img]">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Bg Color</label>
                            {{-- <input type="text" name="sections[S_IDX][section_bg_color]" class="form-control"> --}}

                            <div class="color-picker-group">
                                <div class="input-group align-items-center">
                                    <span class="input-group-text p-1">
                                        <span class="color-preview"></span>
                                    </span>
                                    <input type="color" class="color-input">
                                    <input type="text" name="sections[S_IDX][section_bg_color]"
                                        class="form-control color-hex" placeholder="#00a6a6">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Text Color</label>
                            {{-- <input type="text" name="sections[S_IDX][section_bg_color]" class="form-control"> --}}

                            <div class="color-picker-group">
                                <div class="input-group align-items-center">
                                    <span class="input-group-text p-1">
                                        <span class="color-preview"></span>
                                    </span>
                                    <input type="color" class="color-input">
                                    <input type="text" name="sections[S_IDX][section_text_color]"
                                        class="form-control color-hex" placeholder="#00a6a6">
                                </div>
                            </div>
                        </div>

                    </div>
                    <hr>
                    <div class="items-wrapper"></div>
                    <button type="button" class="btn btn-success btn-sm mt-2 add-item-btn">+ Add Item</button>
                </div>
            </div>
        </template>

        <template id="tpl-icon_list-item">
            <div class="item-row row g-2 mb-2 align-items-center">
                <div class="col-md-3">
                    <div class="input-group iconpicker-group">
                        <input type="text" name="sections[S_IDX][items][I_IDX][icon]"
                            class="form-control iconpicker-input" placeholder="Icon class" />
                        <span class="input-group-text"><i class="fa fa-icons"></i></span>
                    </div>
                </div>
                <div class="col-md-7">
                    <input type="text" name="sections[S_IDX][items][I_IDX][text]" class="form-control"
                        placeholder="Text">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-outline-danger btn-sm w-100 remove-item">Remove</button>
                </div>
            </div>
        </template>
        <!-- #region Description Only Template -->
        <template id="tpl-desc_only">
            <div class="card card-add-component mb-4 section-block border-secondary" data-type="desc_only">
                <div class="card-header d-flex justify-content-between align-items-center bg-secondary text-white">
                    <span class="drag-handle" style="cursor:grab; font-size:18px; opacity:0.7;">⠿</span>
                    <strong>Section: Description Only</strong>
                    <button type="button" class="btn btn-danger btn-sm remove-block">Remove Section</button>
                </div>
                <div class="card-body">
                    <input type="hidden" name="sections[S_IDX][type]" value="desc_only">
                    <div class="row g-3 mb-3">
                        <div class="col-md-5">
                            <label class="form-label fw-semibold">Section Title</label>
                            <input type="text" name="sections[S_IDX][section_title]" class="form-control"
                                placeholder="Section title">
                        </div>
                        <div class="col-md-5">
                            <label class="form-label fw-semibold">Section Subtitle</label>
                            <input type="text" name="sections[S_IDX][section_subtitle]" class="form-control"
                                placeholder="Subtitle">
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-info text-white mt-4" type="button" data-bs-toggle="modal"
                                data-bs-target="#stylesDescOnly">
                                <i class="ti ti-progress-help"></i>
                            </button>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Image</label>
                            <div class="image-wrapper">
                                <button class="btn btn-primary btn-sm image-picker w-100" type="button">
                                    <i class="ti ti-photo"></i> Select Image
                                </button>
                                <div class="image-preview mt-2"></div>
                                <input type="hidden" class="image-content" name="sections[S_IDX][section_bg_img]">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Bg Color</label>
                            {{-- <input type="text" name="sections[S_IDX][section_bg_color]" class="form-control"> --}}

                            <div class="color-picker-group">
                                <div class="input-group align-items-center">
                                    <span class="input-group-text p-1">
                                        <span class="color-preview"></span>
                                    </span>
                                    <input type="color" class="color-input">
                                    <input type="text" name="sections[S_IDX][section_bg_color]"
                                        class="form-control color-hex" placeholder="#00a6a6">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Text Color</label>
                            {{-- <input type="text" name="sections[S_IDX][section_bg_color]" class="form-control"> --}}

                            <div class="color-picker-group">
                                <div class="input-group align-items-center">
                                    <span class="input-group-text p-1">
                                        <span class="color-preview"></span>
                                    </span>
                                    <input type="color" class="color-input">
                                    <input type="text" name="sections[S_IDX][section_text_color]"
                                        class="form-control color-hex" placeholder="#00a6a6">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Description Content</label>
                            <textarea name="sections[S_IDX][section_description]" class="form-control" rows="5"
                                placeholder="Enter description..."></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        <!-- #endregion -->
        <!-- #region card img  Template -->
        <template id="tpl-card_img">
            <div class="card card-add-component mb-4 section-block border-info" data-type="card_img">
                <div class="card-header d-flex justify-content-between align-items-center bg-info text-white">
                    <span class="drag-handle" style="cursor:grab; font-size:18px; opacity:0.7;">⠿</span>
                    <strong>Section: Card with Img, Title &amp; Desc</strong>
                    <button type="button" class="btn btn-danger btn-sm remove-block">Remove Section</button>
                </div>
                <div class="card-body">
                    <input type="hidden" name="sections[S_IDX][type]" value="card_img">
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Section Title</label>
                            <input type="text" name="sections[S_IDX][section_title]" class="form-control"
                                placeholder="Section title">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Section Subtitle</label>
                            <input type="text" name="sections[S_IDX][section_subtitle]" class="form-control"
                                placeholder="Subtitle">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Style</label>
                            <div class="input-group">
                                <select name="sections[S_IDX][section_style]" class="form-select">
                                    <option value="style_1">Style 1</option>
                                    <option value="style_2">Style 2</option>
                                    <option value="style_3">Style 3</option>
                                    <option value="style_4">Style 4</option>
                                </select>
                                <button class="btn btn-info text-white" type="button" data-bs-toggle="modal"
                                    data-bs-target="#stylesCardImg">
                                    <i class="ti ti-progress-help"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Image</label>
                            <div class="image-wrapper">
                                <button class="btn btn-primary btn-sm image-picker w-100" type="button">
                                    <i class="ti ti-photo"></i> Select Image
                                </button>
                                <div class="image-preview mt-2"></div>
                                <input type="hidden" class="image-content" name="sections[S_IDX][section_bg_img]">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Bg Color</label>
                            {{-- <input type="text" name="sections[S_IDX][section_bg_color]" class="form-control"> --}}

                            <div class="color-picker-group">
                                <div class="input-group align-items-center">
                                    <span class="input-group-text p-1">
                                        <span class="color-preview"></span>
                                    </span>
                                    <input type="color" class="color-input">
                                    <input type="text" name="sections[S_IDX][section_bg_color]"
                                        class="form-control color-hex" placeholder="#00a6a6">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Text Color</label>
                            {{-- <input type="text" name="sections[S_IDX][section_bg_color]" class="form-control"> --}}

                            <div class="color-picker-group">
                                <div class="input-group align-items-center">
                                    <span class="input-group-text p-1">
                                        <span class="color-preview"></span>
                                    </span>
                                    <input type="color" class="color-input">
                                    <input type="text" name="sections[S_IDX][section_text_color]"
                                        class="form-control color-hex" placeholder="#00a6a6">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="items-wrapper"></div>
                    <button type="button" class="btn btn-success btn-sm mt-2 add-item-btn">+ Add Image Card</button>
                </div>
            </div>
        </template>
        <!-- #endregion -->

        <template id="tpl-card_img-item">
            <div class="card mb-3 item-row border-0 bg-light">
                <div class="card-body">
                    <div class="row g-3 align-items-start">
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Image</label>
                            <div class="image-wrapper">
                                <button class="btn btn-primary btn-sm image-picker w-100" type="button">
                                    <i class="ti ti-photo"></i> Select Image
                                </button>
                                <div class="image-preview mt-2"></div>
                                <input type="hidden" class="image-content"
                                    name="sections[S_IDX][items][I_IDX][img]">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Title</label>
                            <input type="text" name="sections[S_IDX][items][I_IDX][title]" class="form-control"
                                placeholder="Card title">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Slug(if any)</label>
                            <input type="text" name="sections[S_IDX][items][I_IDX][slug]" class="form-control"
                                placeholder="slug">
                        </div>

                        <div class="col-md-1 d-flex align-items-end">
                            <button type="button" class="btn btn-outline-danger btn-sm w-100 remove-item">X</button>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Description</label>
                            <textarea type="text" name="sections[S_IDX][items][I_IDX][desc]" class="form-control"
                                placeholder="Card description"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </template>

        <template id="tpl-zig_zag">
            <div class="card card-add-component mb-4 section-block border-info" data-type="zig_zag">
                <div class="card-header d-flex justify-content-between align-items-center bg-info text-white">
                    <span class="drag-handle" style="cursor:grab; font-size:18px; opacity:0.7;">⠿</span>
                    <strong>Section: Zig-Zag</strong>
                    <button type="button" class="btn btn-danger btn-sm remove-block">Remove Section</button>
                </div>
                <div class="card-body">
                    <input type="hidden" name="sections[S_IDX][type]" value="zig_zag">
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Section Title</label>
                            <input type="text" name="sections[S_IDX][section_title]" class="form-control"
                                placeholder="Section title">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Section Subtitle</label>
                            <input type="text" name="sections[S_IDX][section_subtitle]" class="form-control"
                                placeholder="Subtitle">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Style</label>
                            <div class="input-group">
                                <select name="sections[S_IDX][section_style]" class="form-select">
                                    <option value="style_1">Style 1</option>
                                    <option value="style_2">Style 2</option>
                                    <option value="style_3">Style 3</option>
                                    <option value="style_4">Style 4</option>
                                </select>
                                <button class="btn btn-info text-white" type="button" data-bs-toggle="modal"
                                    data-bs-target="#stylesZigZag">
                                    <i class="ti ti-progress-help"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Image</label>
                            <div class="image-wrapper">
                                <button class="btn btn-primary btn-sm image-picker w-100" type="button">
                                    <i class="ti ti-photo"></i> Select Image
                                </button>
                                <div class="image-preview mt-2"></div>
                                <input type="hidden" class="image-content" name="sections[S_IDX][section_bg_img]">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Bg Color</label>
                            {{-- <input type="text" name="sections[S_IDX][section_bg_color]" class="form-control"> --}}

                            <div class="color-picker-group">
                                <div class="input-group align-items-center">
                                    <span class="input-group-text p-1">
                                        <span class="color-preview"></span>
                                    </span>
                                    <input type="color" class="color-input">
                                    <input type="text" name="sections[S_IDX][section_bg_color]"
                                        class="form-control color-hex" placeholder="#00a6a6">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Text Color</label>
                            {{-- <input type="text" name="sections[S_IDX][section_bg_color]" class="form-control"> --}}

                            <div class="color-picker-group">
                                <div class="input-group align-items-center">
                                    <span class="input-group-text p-1">
                                        <span class="color-preview"></span>
                                    </span>
                                    <input type="color" class="color-input">
                                    <input type="text" name="sections[S_IDX][section_text_color]"
                                        class="form-control color-hex" placeholder="#00a6a6">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="items-wrapper"></div>
                    <button type="button" class="btn btn-success btn-sm mt-2 add-item-btn">+ Add Zig-Zag
                        Item</button>
                </div>
            </div>
        </template>

        <template id="tpl-zig_zag-item">
            <div class="card mb-3 item-row border-0 bg-light">
                <div class="card-body">
                    <div class="row g-3 align-items-start">
                        <div class="col-md-2">
                            <label class="form-label fw-semibold">Image</label>
                            <div class="image-wrapper">
                                <button class="btn btn-primary btn-sm image-picker w-100" type="button">
                                    <i class="ti ti-photo"></i> Select
                                </button>
                                <div class="image-preview mt-2"></div>
                                <input type="hidden" class="image-content"
                                    name="sections[S_IDX][items][I_IDX][img]">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-semibold">Title</label>
                            <input type="text" name="sections[S_IDX][items][I_IDX][title]" class="form-control"
                                placeholder="Title">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-semibold">Sub Title</label>
                            <input type="text" name="sections[S_IDX][items][I_IDX][subtitle]" class="form-control"
                                placeholder="Subtitle">
                        </div>
                        <div class="col-md-5">
                            <label class="form-label fw-semibold">Description</label>
                            <textarea name="sections[S_IDX][items][I_IDX][desc]" class="form-control" rows="3"
                                placeholder="Description..."></textarea>
                        </div>
                        <div class="col-md-1 d-flex align-items-end">
                            <button type="button" class="btn btn-outline-danger btn-sm w-100 remove-item">X</button>
                        </div>
                    </div>
                </div>
            </div>
        </template>

        <template id="tpl-faq">
            <div class="card card-add-component mb-4 section-block border-dark" data-type="faq">
                <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white">
                    <span class="drag-handle" style="cursor:grab; font-size:18px; opacity:0.7;">⠿</span>
                    <strong>Section: FAQ</strong>
                    <button type="button" class="btn btn-danger btn-sm remove-block">Remove Section</button>
                </div>
                <div class="card-body">
                    <input type="hidden" name="sections[S_IDX][type]" value="faq">
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Section Title</label>
                            <input type="text" name="sections[S_IDX][section_title]" class="form-control"
                                placeholder="Section title">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Section Subtitle</label>
                            <input type="text" name="sections[S_IDX][section_subtitle]" class="form-control"
                                placeholder="Subtitle">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Section Style</label>
                            <div class="input-group">
                                <select name="sections[S_IDX][section_style]" class="form-select">
                                    <option value="style_1">Style 1</option>
                                    <option value="style_2">Style 2</option>
                                </select>
                                <button class="btn btn-info text-white" type="button" data-bs-toggle="modal"
                                    data-bs-target="#stylesFaq">
                                    <i class="ti ti-progress-help"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="items-wrapper"></div>
                    <button type="button" class="btn btn-success btn-sm mt-2 add-item-btn">+ Add FAQ</button>
                </div>
            </div>
        </template>

        <template id="tpl-faq-item">
            <div class="card mb-3 item-row border-0 bg-light">
                <div class="card-body">
                    <div class="row g-3 align-items-start">
                        <div class="col-md-5">
                            <label class="form-label fw-semibold">Question</label>
                            <input type="text" name="sections[S_IDX][items][I_IDX][question]" class="form-control"
                                placeholder="FAQ question?">
                        </div>
                        <div class="col-md-5">
                            <label class="form-label fw-semibold">Answer</label>
                            <textarea name="sections[S_IDX][items][I_IDX][answer]" class="form-control" rows="2"
                                placeholder="FAQ answer..."></textarea>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="button"
                                class="btn btn-outline-danger btn-sm w-100 remove-item">Remove</button>
                        </div>
                    </div>
                </div>
            </div>
        </template>

        <template id="tpl-counter_icon">
            <div class="card card-add-component mb-4 section-block border-info" data-type="counter_icon">
                <div class="card-header d-flex justify-content-between align-items-center bg-info text-white">
                    <span class="drag-handle" style="cursor:grab; font-size:18px; opacity:0.7;">⠿</span>
                    <strong>Section: Counter with Icon</strong>
                    <button type="button" class="btn btn-danger btn-sm remove-block">Remove Section</button>
                </div>
                <div class="card-body">
                    <input type="hidden" name="sections[S_IDX][type]" value="counter_icon">
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Section Title</label>
                            <input type="text" name="sections[S_IDX][section_title]" class="form-control"
                                placeholder="Section title">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Section Subtitle</label>
                            <input type="text" name="sections[S_IDX][section_subtitle]" class="form-control"
                                placeholder="Subtitle">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Style</label>
                            <div class="input-group">
                                <select name="sections[S_IDX][section_style]" class="form-select">
                                    <option value="style_1">Style 1</option>
                                </select>
                                <button class="btn btn-info text-white" type="button" data-bs-toggle="modal"
                                    data-bs-target="#stylesCounter">
                                    <i class="ti ti-progress-help"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Image</label>
                            <div class="image-wrapper">
                                <button class="btn btn-primary btn-sm image-picker w-100" type="button">
                                    <i class="ti ti-photo"></i> Select Image
                                </button>
                                <div class="image-preview mt-2"></div>
                                <input type="hidden" class="image-content" name="sections[S_IDX][section_bg_img]">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Bg Color</label>
                            {{-- <input type="text" name="sections[S_IDX][section_bg_color]" class="form-control"> --}}

                            <div class="color-picker-group">
                                <div class="input-group align-items-center">
                                    <span class="input-group-text p-1">
                                        <span class="color-preview"></span>
                                    </span>
                                    <input type="color" class="color-input">
                                    <input type="text" name="sections[S_IDX][section_bg_color]"
                                        class="form-control color-hex" placeholder="#00a6a6">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Text Color</label>
                            {{-- <input type="text" name="sections[S_IDX][section_bg_color]" class="form-control"> --}}

                            <div class="color-picker-group">
                                <div class="input-group align-items-center">
                                    <span class="input-group-text p-1">
                                        <span class="color-preview"></span>
                                    </span>
                                    <input type="color" class="color-input">
                                    <input type="text" name="sections[S_IDX][section_text_color]"
                                        class="form-control color-hex" placeholder="#00a6a6">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="items-wrapper"></div>
                    <button type="button" class="btn btn-success btn-sm mt-2 add-item-btn">+ Add Counter</button>
                </div>
            </div>
        </template>

        <template id="tpl-counter_icon-item">
            <div class="card mb-3 item-row border-0 bg-light">
                <div class="card-body">
                    <div class="row g-3 align-items-start">
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Icon (Class)</label>
                            <div class="input-group iconpicker-group">
                                <input type="text" name="sections[S_IDX][items][I_IDX][icon]"
                                    class="form-control iconpicker-input" placeholder="fa fa-user" />
                                <span class="input-group-text"><i class="fa fa-icons"></i></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Count</label>
                            <input type="text" name="sections[S_IDX][items][I_IDX][title]" class="form-control"
                                placeholder="e.g. 1500+">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Label</label>
                            <input type="text" name="sections[S_IDX][items][I_IDX][desc]" class="form-control"
                                placeholder="e.g. Happy Clients">
                        </div>
                        <div class="col-md-1 d-flex align-items-end">
                            <button type="button" class="btn btn-outline-danger btn-sm w-100 remove-item">X</button>
                        </div>
                    </div>
                </div>
            </div>
        </template>

        <template id="tpl-gallary">
            <div class="card card-add-component mb-4 section-block border-purple" data-type="gallary">
                <div class="card-header d-flex justify-content-between align-items-center bg-purple text-white">
                    <span class="drag-handle" style="cursor:grab; font-size:18px; opacity:0.7;">⠿</span>
                    <strong>Section: Your Label</strong>
                    <button type="button" class="btn btn-danger btn-sm remove-block">Remove Section</button>
                </div>
                <div class="card-body">
                    <input type="hidden" name="sections[S_IDX][type]" value="gallary">
                    <div class="row g-3 mb-3">
                        <div class="col-md-5">
                            <label class="form-label fw-semibold">Section Title</label>
                            <input type="text" name="sections[S_IDX][section_title]" class="form-control">
                        </div>
                        <div class="col-md-5">
                            <label class="form-label fw-semibold">Section Subtitle</label>
                            <input type="text" name="sections[S_IDX][section_subtitle]" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-info text-white mt-4" type="button" data-bs-toggle="modal"
                                data-bs-target="#stylesGallary">
                                <i class="ti ti-progress-help"></i>
                            </button>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Image</label>
                            <div class="image-wrapper">
                                <button class="btn btn-primary btn-sm image-picker w-100" type="button">
                                    <i class="ti ti-photo"></i> Select Image
                                </button>
                                <div class="image-preview mt-2"></div>
                                <input type="hidden" class="image-content" name="sections[S_IDX][section_bg_img]">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Bg Color</label>
                            {{-- <input type="text" name="sections[S_IDX][section_bg_color]" class="form-control"> --}}

                            <div class="color-picker-group">
                                <div class="input-group align-items-center">
                                    <span class="input-group-text p-1">
                                        <span class="color-preview"></span>
                                    </span>
                                    <input type="color" class="color-input">
                                    <input type="text" name="sections[S_IDX][section_bg_color]"
                                        class="form-control color-hex" placeholder="#00a6a6">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Text Color</label>
                            {{-- <input type="text" name="sections[S_IDX][section_bg_color]" class="form-control"> --}}

                            <div class="color-picker-group">
                                <div class="input-group align-items-center">
                                    <span class="input-group-text p-1">
                                        <span class="color-preview"></span>
                                    </span>
                                    <input type="color" class="color-input">
                                    <input type="text" name="sections[S_IDX][section_text_color]"
                                        class="form-control color-hex" placeholder="#00a6a6">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="items-wrapper"></div> {{-- MUST be empty --}}
                    <button type="button" class="btn btn-success btn-sm mt-2 add-item-btn">+ Add Item</button>
                </div>
            </div>
        </template>

        <template id="tpl-gallary-item">
            <div class="card mb-3 item-row border-0 bg-light">
                <div class="card-body">
                    <div class="row g-3 align-items-start">
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Image</label>
                            <div class="image-wrapper">
                                <button class="btn btn-primary btn-sm image-picker w-100" type="button">
                                    <i class="ti ti-photo"></i> Select Image
                                </button>
                                <div class="image-preview mt-2"></div>
                                <input type="hidden" class="image-content"
                                    name="sections[S_IDX][items][I_IDX][img]">
                            </div>
                        </div>
                        <div class="col-md-1 d-flex align-items-end">
                            <button type="button" class="btn btn-outline-danger btn-sm w-100 remove-item">X</button>
                        </div>
                    </div>
                </div>
            </div>
        </template>


        <template id="tpl-about_section_1">
            <div class="card card-add-component mb-4 section-block border-purple" data-type="gallary">
                <div class="card-header d-flex justify-content-between align-items-center bg-purple text-white">
                    <span class="drag-handle" style="cursor:grab; font-size:18px; opacity:0.7;">⠿</span>
                    <strong>Section: About Section 1</strong>
                    <button type="button" class="btn btn-danger btn-sm remove-block">Remove Section</button>
                </div>
                <div class="card-body">
                    <input type="hidden" name="sections[S_IDX][type]" value="about_section_1">
                    <div class="row g-3 mb-3">
                        <div class="col-md-5">
                            <label class="form-label fw-semibold">Section Title</label>
                            <input type="text" name="sections[S_IDX][section_title]" class="form-control">
                        </div>
                        <div class="col-md-5">
                            <label class="form-label fw-semibold">Section Subtitle</label>
                            <input type="text" name="sections[S_IDX][section_subtitle]" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-info text-white mt-4" type="button" data-bs-toggle="modal"
                                data-bs-target="#stylesAboutSec1">
                                <i class="ti ti-progress-help"></i>
                            </button>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Image</label>
                            <div class="image-wrapper">
                                <button class="btn btn-primary btn-sm image-picker w-100" type="button">
                                    <i class="ti ti-photo"></i> Select Image
                                </button>
                                <div class="image-preview mt-2"></div>
                                <input type="hidden" class="image-content" name="sections[S_IDX][section_bg_img]">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Bg Color</label>
                            {{-- <input type="text" name="sections[S_IDX][section_bg_color]" class="form-control"> --}}

                            <div class="color-picker-group">
                                <div class="input-group align-items-center">
                                    <span class="input-group-text p-1">
                                        <span class="color-preview"></span>
                                    </span>
                                    <input type="color" class="color-input">
                                    <input type="text" name="sections[S_IDX][section_bg_color]"
                                        class="form-control color-hex" placeholder="#00a6a6">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Text Color</label>
                            {{-- <input type="text" name="sections[S_IDX][section_bg_color]" class="form-control"> --}}

                            <div class="color-picker-group">
                                <div class="input-group align-items-center">
                                    <span class="input-group-text p-1">
                                        <span class="color-preview"></span>
                                    </span>
                                    <input type="color" class="color-input">
                                    <input type="text" name="sections[S_IDX][section_text_color]"
                                        class="form-control color-hex" placeholder="#00a6a6">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="items-wrapper"></div> {{-- MUST be empty --}}
                    {{-- <button type="button" class="btn btn-success btn-sm mt-2 add-item-btn">+ Add Item</button> --}}
                </div>
            </div>
        </template>

        <template id="tpl-about_section_1-item">
            <div class="card mb-3 item-row border-0 bg-light">
                <div class="card-body">
                    <div class="row g-3 align-items-start">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="sections[S_IDX][items][I_IDX][desc]" placeholder="Description" class="form-control"></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Button Text </label>
                                            <input name="sections[S_IDX][items][I_IDX][btn_text]"
                                                placeholder="Button Text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Button URl </label>
                                            <input name="sections[S_IDX][items][I_IDX][btn_url]"
                                                placeholder="Button URl" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Side Card Heading </label>
                                <input name="sections[S_IDX][items][I_IDX][card_heading]"
                                    placeholder="Side Card Heading" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Side Card Description </label>
                                <textarea name="sections[S_IDX][items][I_IDX][card_desc]" placeholder="Side Card Heading" class="form-control"></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Side Card Footer </label>
                                <input name="sections[S_IDX][items][I_IDX][card_footer]"
                                    placeholder="Side Card Footer" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>

        <template id="tpl-company_about_section_1">
            <div class="card card-add-component mb-4 section-block border-success" data-type="gallary">
                <div class="card-header d-flex justify-content-between align-items-center bg-success text-white">
                    <span class="drag-handle" style="cursor:grab; font-size:18px; opacity:0.7;">⠿</span>
                    <strong>Section: Company About Section 1 (Light)</strong>
                    <button type="button" class="btn btn-danger btn-sm remove-block">Remove Section</button>
                </div>
                <div class="card-body">
                    <input type="hidden" name="sections[S_IDX][type]" value="company_about_section_1">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <div class="form-group mb-3">

                                <label class="form-label fw-semibold">Section Title</label>
                                <input type="text" name="sections[S_IDX][section_title]" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">Section Subtitle</label>
                                <input type="text" name="sections[S_IDX][section_subtitle]"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Section Description</label>
                            <textarea type="text" name="sections[S_IDX][section_description]" class="form-control" rows="5"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Image</label>
                            <div class="image-wrapper">
                                <button class="btn btn-primary btn-sm image-picker w-100" type="button">
                                    <i class="ti ti-photo"></i> Select Image
                                </button>
                                <div class="image-preview mt-2"></div>
                                <input type="hidden" class="image-content" name="sections[S_IDX][section_bg_img]">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Bg Color</label>
                            {{-- <input type="text" name="sections[S_IDX][section_bg_color]" class="form-control"> --}}

                            <div class="color-picker-group">
                                <div class="input-group align-items-center">
                                    <span class="input-group-text p-1">
                                        <span class="color-preview"></span>
                                    </span>
                                    <input type="color" class="color-input">
                                    <input type="text" name="sections[S_IDX][section_bg_color]"
                                        class="form-control color-hex" placeholder="#00a6a6">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Text Color</label>
                            {{-- <input type="text" name="sections[S_IDX][section_bg_color]" class="form-control"> --}}

                            <div class="color-picker-group">
                                <div class="input-group align-items-center">
                                    <span class="input-group-text p-1">
                                        <span class="color-preview"></span>
                                    </span>
                                    <input type="color" class="color-input">
                                    <input type="text" name="sections[S_IDX][section_text_color]"
                                        class="form-control color-hex" placeholder="#00a6a6">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-info text-white mt-4" type="button" data-bs-toggle="modal"
                                    data-bs-target="#stylesCompanyAboutSec1">
                                    <i class="ti ti-progress-help"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="items-wrapper"></div> {{-- MUST be empty --}}
                    {{-- <button type="button" class="btn btn-success btn-sm mt-2 add-item-btn">+ Add Item</button> --}}
                </div>
            </div>
        </template>

        <template id="tpl-company_about_section_1-item">
            <div class="card mb-3 item-row border-0 bg-light">
                <div class="card-body">
                    <div class="row g-3 align-items-start">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">Image</label>
                                <div class="image-wrapper">
                                    <button class="btn btn-primary btn-sm image-picker w-100" type="button">
                                        <i class="ti ti-photo"></i> Select Image
                                    </button>
                                    <div class="image-preview mt-2"></div>
                                    <input type="hidden" class="image-content"
                                        name="sections[S_IDX][items][I_IDX][img]">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">Icon (Class)</label>
                                <div class="input-group iconpicker-group">
                                    <input type="text" name="sections[S_IDX][items][I_IDX][icon1]"
                                        class="form-control iconpicker-input" placeholder="fa fa-user" />
                                    <span class="input-group-text"><i class="fa fa-icons"></i></span>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">Title</label>
                                <div class="input-group iconpicker-group">
                                    <input type="text" name="sections[S_IDX][items][I_IDX][title1]"
                                        class="form-control" placeholder="Title" />
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">Description(small)</label>
                                <div class="input-group iconpicker-group">
                                    <input type="text" name="sections[S_IDX][items][I_IDX][desc1]"
                                        class="form-control" placeholder="Description" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">Icon (Class)</label>
                                <div class="input-group iconpicker-group">
                                    <input type="text" name="sections[S_IDX][items][I_IDX][icon2]"
                                        class="form-control iconpicker-input" placeholder="fa fa-user" />
                                    <span class="input-group-text"><i class="fa fa-icons"></i></span>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">Title</label>
                                <div class="input-group iconpicker-group">
                                    <input type="text" name="sections[S_IDX][items][I_IDX][title2]"
                                        class="form-control" placeholder="Title" />
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">Description(small)</label>
                                <div class="input-group iconpicker-group">
                                    <input type="text" name="sections[S_IDX][items][I_IDX][desc2]"
                                        class="form-control" placeholder="Description" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">Icon (Class)</label>
                                <div class="input-group iconpicker-group">
                                    <input type="text" name="sections[S_IDX][items][I_IDX][icon3]"
                                        class="form-control iconpicker-input" placeholder="fa fa-user" />
                                    <span class="input-group-text"><i class="fa fa-icons"></i></span>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">Title</label>
                                <div class="input-group iconpicker-group">
                                    <input type="text" name="sections[S_IDX][items][I_IDX][title3]"
                                        class="form-control" placeholder="Title" />
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">Description(small)</label>
                                <div class="input-group iconpicker-group">
                                    <input type="text" name="sections[S_IDX][items][I_IDX][desc3]"
                                        class="form-control" placeholder="Description" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">Icon (Class)</label>
                                <div class="input-group iconpicker-group">
                                    <input type="text" name="sections[S_IDX][items][I_IDX][icon4]"
                                        class="form-control iconpicker-input" placeholder="fa fa-user" />
                                    <span class="input-group-text"><i class="fa fa-icons"></i></span>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">Title</label>
                                <div class="input-group iconpicker-group">
                                    <input type="text" name="sections[S_IDX][items][I_IDX][title4]"
                                        class="form-control" placeholder="Title" />
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">Description(small)</label>
                                <div class="input-group iconpicker-group">
                                    <input type="text" name="sections[S_IDX][items][I_IDX][desc4]"
                                        class="form-control" placeholder="Description" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        <template id="tpl-company_about_section_2">
            <div class="card card-add-component mb-4 section-block border-dark" data-type="gallary">
                <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white">
                    <span class="drag-handle" style="cursor:grab; font-size:18px; opacity:0.7;">⠿</span>
                    <strong>Section: Company About Section 2 (Dark)</strong>
                    <button type="button" class="btn btn-danger btn-sm remove-block">Remove Section</button>
                </div>
                <div class="card-body">
                    <input type="hidden" name="sections[S_IDX][type]" value="company_about_section_2">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">Section Title</label>
                                <input type="text" name="sections[S_IDX][section_title]" class="form-control">
                            </div>
                            <div class="form-group mb-3"> <label class="form-label fw-semibold">Section
                                    Subtitle</label>
                                <input type="text" name="sections[S_IDX][section_subtitle]"
                                    class="form-control">
                            </div>

                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Section Description</label>
                            <textarea type="text" name="sections[S_IDX][section_description]" class="form-control" rows="5"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Image</label>
                            <div class="image-wrapper">
                                <button class="btn btn-primary btn-sm image-picker w-100" type="button">
                                    <i class="ti ti-photo"></i> Select Image
                                </button>
                                <div class="image-preview mt-2"></div>
                                <input type="hidden" class="image-content" name="sections[S_IDX][section_bg_img]">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Bg Color</label>
                            {{-- <input type="text" name="sections[S_IDX][section_bg_color]" class="form-control"> --}}

                            <div class="color-picker-group">
                                <div class="input-group align-items-center">
                                    <span class="input-group-text p-1">
                                        <span class="color-preview"></span>
                                    </span>
                                    <input type="color" class="color-input">
                                    <input type="text" name="sections[S_IDX][section_bg_color]"
                                        class="form-control color-hex" placeholder="#00a6a6">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Text Color</label>
                            {{-- <input type="text" name="sections[S_IDX][section_bg_color]" class="form-control"> --}}

                            <div class="color-picker-group">
                                <div class="input-group align-items-center">
                                    <span class="input-group-text p-1">
                                        <span class="color-preview"></span>
                                    </span>
                                    <input type="color" class="color-input">
                                    <input type="text" name="sections[S_IDX][section_text_color]"
                                        class="form-control color-hex" placeholder="#00a6a6">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-info text-white mt-4" type="button" data-bs-toggle="modal"
                                    data-bs-target="#stylesCompanyAboutSec2">
                                    <i class="ti ti-progress-help"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="items-wrapper"></div> {{-- MUST be empty --}}
                    {{-- <button type="button" class="btn btn-success btn-sm mt-2 add-item-btn">+ Add Item</button> --}}
                </div>
            </div>
        </template>

        <template id="tpl-company_about_section_2-item">
            <div class="card mb-3 item-row border-0 bg-light">
                <div class="card-body">
                    <div class="row g-3 align-items-start">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">Image</label>
                                <div class="image-wrapper">
                                    <button class="btn btn-primary btn-sm image-picker w-100" type="button">
                                        <i class="ti ti-photo"></i> Select Image
                                    </button>
                                    <div class="image-preview mt-2"></div>
                                    <input type="hidden" class="image-content"
                                        name="sections[S_IDX][items][I_IDX][img]">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">Icon (Class)</label>
                                <div class="input-group iconpicker-group">
                                    <input type="text" name="sections[S_IDX][items][I_IDX][icon1]"
                                        class="form-control iconpicker-input" placeholder="fa fa-user" />
                                    <span class="input-group-text"><i class="fa fa-icons"></i></span>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">Title</label>
                                <div class="input-group iconpicker-group">
                                    <input type="text" name="sections[S_IDX][items][I_IDX][title1]"
                                        class="form-control" placeholder="Title" />
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">Description(small)</label>
                                <div class="input-group iconpicker-group">
                                    <input type="text" name="sections[S_IDX][items][I_IDX][desc1]"
                                        class="form-control" placeholder="Description" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">Icon (Class)</label>
                                <div class="input-group iconpicker-group">
                                    <input type="text" name="sections[S_IDX][items][I_IDX][icon2]"
                                        class="form-control iconpicker-input" placeholder="fa fa-user" />
                                    <span class="input-group-text"><i class="fa fa-icons"></i></span>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">Title</label>
                                <div class="input-group iconpicker-group">
                                    <input type="text" name="sections[S_IDX][items][I_IDX][title2]"
                                        class="form-control" placeholder="Title" />
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">Description(small)</label>
                                <div class="input-group iconpicker-group">
                                    <input type="text" name="sections[S_IDX][items][I_IDX][desc2]"
                                        class="form-control" placeholder="Description" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">Icon (Class)</label>
                                <div class="input-group iconpicker-group">
                                    <input type="text" name="sections[S_IDX][items][I_IDX][icon3]"
                                        class="form-control iconpicker-input" placeholder="fa fa-user" />
                                    <span class="input-group-text"><i class="fa fa-icons"></i></span>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">Title</label>
                                <div class="input-group iconpicker-group">
                                    <input type="text" name="sections[S_IDX][items][I_IDX][title3]"
                                        class="form-control" placeholder="Title" />
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">Description(small)</label>
                                <div class="input-group iconpicker-group">
                                    <input type="text" name="sections[S_IDX][items][I_IDX][desc3]"
                                        class="form-control" placeholder="Description" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">Icon (Class)</label>
                                <div class="input-group iconpicker-group">
                                    <input type="text" name="sections[S_IDX][items][I_IDX][icon4]"
                                        class="form-control iconpicker-input" placeholder="fa fa-user" />
                                    <span class="input-group-text"><i class="fa fa-icons"></i></span>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">Title</label>
                                <div class="input-group iconpicker-group">
                                    <input type="text" name="sections[S_IDX][items][I_IDX][title4]"
                                        class="form-control" placeholder="Title" />
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">Description(small)</label>
                                <div class="input-group iconpicker-group">
                                    <input type="text" name="sections[S_IDX][items][I_IDX][desc4]"
                                        class="form-control" placeholder="Description" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>


        <template id="tpl-results_counter">
            <div class="card card-add-component mb-4 section-block border-dark" data-type="gallary">
                <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white">
                    <span class="drag-handle" style="cursor:grab; font-size:18px; opacity:0.7;">⠿</span>
                    <strong>Section: Result Counter (Dark)</strong>
                    <button type="button" class="btn btn-danger btn-sm remove-block">Remove Section</button>
                </div>
                <div class="card-body">
                    <input type="hidden" name="sections[S_IDX][type]" value="results_counter">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">Section Title</label>
                                <input type="text" name="sections[S_IDX][section_title]" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">Section Subtitle</label>
                                <input type="text" name="sections[S_IDX][section_subtitle]"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Section Description</label>
                            <textarea type="text" name="sections[S_IDX][section_description]" rows="5" class="form-control"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Image</label>
                            <div class="image-wrapper">
                                <button class="btn btn-primary btn-sm image-picker w-100" type="button">
                                    <i class="ti ti-photo"></i> Select Image
                                </button>
                                <div class="image-preview mt-2"></div>
                                <input type="hidden" class="image-content" name="sections[S_IDX][section_bg_img]">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Bg Color</label>
                            {{-- <input type="text" name="sections[S_IDX][section_bg_color]" class="form-control"> --}}

                            <div class="color-picker-group">
                                <div class="input-group align-items-center">
                                    <span class="input-group-text p-1">
                                        <span class="color-preview"></span>
                                    </span>
                                    <input type="color" class="color-input">
                                    <input type="text" name="sections[S_IDX][section_bg_color]"
                                        class="form-control color-hex" placeholder="#00a6a6">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Text Color</label>
                            {{-- <input type="text" name="sections[S_IDX][section_bg_color]" class="form-control"> --}}

                            <div class="color-picker-group">
                                <div class="input-group align-items-center">
                                    <span class="input-group-text p-1">
                                        <span class="color-preview"></span>
                                    </span>
                                    <input type="color" class="color-input">
                                    <input type="text" name="sections[S_IDX][section_text_color]"
                                        class="form-control color-hex" placeholder="#00a6a6">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-info text-white mt-4" type="button" data-bs-toggle="modal"
                                    data-bs-target="#stylesResultsCounter">
                                    <i class="ti ti-progress-help"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="items-wrapper"></div> {{-- MUST be empty --}}
                    {{-- <button type="button" class="btn btn-success btn-sm mt-2 add-item-btn">+ Add Item</button> --}}
                </div>
            </div>
        </template>

        <template id="tpl-results_counter-item">
            <div class="card mb-3 item-row border-0 bg-light">
                <div class="card-body">
                    <div class="row g-3 align-items-start">
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">Count</label>

                                <input type="number" name="sections[S_IDX][items][I_IDX][count1]"
                                    class="form-control" placeholder="Count" />


                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">Title</label>
                                <div class="input-group iconpicker-group">
                                    <input type="text" name="sections[S_IDX][items][I_IDX][title1]"
                                        class="form-control" placeholder="Title" />
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">Description(small)</label>
                                <div class="input-group iconpicker-group">
                                    <input type="text" name="sections[S_IDX][items][I_IDX][desc1]"
                                        class="form-control" placeholder="Description" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">Count</label>

                                <input type="number" name="sections[S_IDX][items][I_IDX][count2]"
                                    class="form-control" placeholder="Count" />
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">Title</label>
                                <div class="input-group iconpicker-group">
                                    <input type="text" name="sections[S_IDX][items][I_IDX][title2]"
                                        class="form-control" placeholder="Title" />
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">Description(small)</label>
                                <div class="input-group iconpicker-group">
                                    <input type="text" name="sections[S_IDX][items][I_IDX][desc2]"
                                        class="form-control" placeholder="Description" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">Count</label>

                                <input type="number" name="sections[S_IDX][items][I_IDX][count3]"
                                    class="form-control" placeholder="Count" />
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">Title</label>
                                <div class="input-group iconpicker-group">
                                    <input type="text" name="sections[S_IDX][items][I_IDX][title3]"
                                        class="form-control" placeholder="Title" />
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">Description(small)</label>
                                <div class="input-group iconpicker-group">
                                    <input type="text" name="sections[S_IDX][items][I_IDX][desc3]"
                                        class="form-control" placeholder="Description" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">Count</label>

                                <input type="number" name="sections[S_IDX][items][I_IDX][count4]"
                                    class="form-control" placeholder="Count" />
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">Title</label>
                                <div class="input-group iconpicker-group">
                                    <input type="text" name="sections[S_IDX][items][I_IDX][title4]"
                                        class="form-control" placeholder="Title" />
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">Description(small)</label>
                                <div class="input-group iconpicker-group">
                                    <input type="text" name="sections[S_IDX][items][I_IDX][desc4]"
                                        class="form-control" placeholder="Description" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        <template id="tpl-contact_form">
            <div class="card card-add-component mb-4 section-block border-dark" data-type="gallary">
                <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white">
                    <span class="drag-handle" style="cursor:grab; font-size:18px; opacity:0.7;">⠿</span>
                    <strong>Section: Contact Form</strong>
                    <button type="button" class="btn btn-danger btn-sm remove-block">Remove Section</button>
                </div>
                <div class="card-body">
                    <input type="hidden" name="sections[S_IDX][type]" value="contact_form">
                    <div class="alert alert-info d-flex align-items-center mb-0 py-2 px-3">
                        <i class="ti ti-circle-check mr-2"></i>
                        <span>
                            The form will be automatically added with all required predefined fields.
                        </span>
                    </div>
                </div>
            </div>
        </template>
        <template id="tpl-home_page_slider">
            <div class="card card-add-component mb-4 section-block border-dark">
                <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white">
                    <span class="drag-handle" style="cursor:grab; font-size:18px; opacity:0.7;">⠿</span>
                    <strong>Section: Home Page Slider</strong>
                    <button type="button" class="btn btn-danger btn-sm remove-block">Remove Section</button>
                </div>
                <div class="card-body">
                    <input type="hidden" name="sections[S_IDX][type]" value="home_page_slider">
                    <div class="alert alert-info d-flex align-items-center mb-0 py-2 px-3">
                        <i class="ti ti-circle-check mr-2"></i>
                        <span>
                            The section will be autoload on view.
                        </span>
                    </div>
                </div>
            </div>
        </template>
        <template id="tpl-latest_blogs">
            <div class="card card-add-component mb-4 section-block border-dark">
                <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white">
                    <span class="drag-handle" style="cursor:grab; font-size:18px; opacity:0.7;">⠿</span>
                    <strong>Section: Latest Blogs Section</strong>
                    <button type="button" class="btn btn-danger btn-sm remove-block">Remove Section</button>
                </div>
                <div class="card-body">
                    <input type="hidden" name="sections[S_IDX][type]" value="latest_blogs">
                    @php
                        $categories = \App\Models\Category::where('status', 1)->get();
                    @endphp

                    <div class="mb-3">
                        <select name="sections[S_IDX][blog_category]" class="form-select">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"> {{ $category->title }} </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="alert alert-info d-flex align-items-center mb-0 py-2 px-3">
                        <i class="ti ti-circle-check mr-2"></i>
                        <span>
                            The section will be autoload on view.
                        </span>
                    </div>
                </div>
            </div>
        </template>
        <template id="tpl-testimonials">
            <div class="card card-add-component mb-4 section-block border-dark">
                <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white">
                    <span class="drag-handle" style="cursor:grab; font-size:18px; opacity:0.7;">⠿</span>
                    <strong>Section: Testimonials</strong>
                    <button type="button" class="btn btn-danger btn-sm remove-block">Remove Section</button>
                </div>
                <div class="card-body">
                    <input type="hidden" name="sections[S_IDX][type]" value="testimonials">
                    <div class="alert alert-info d-flex align-items-center mb-0 py-2 px-3">
                        <i class="ti ti-circle-check mr-2"></i>
                        <span>
                            The section will be autoload on view.
                        </span>
                    </div>
                </div>
            </div>
        </template>


        <template id="tpl-card_img_desc">
            <div class="card card-add-component mb-4 section-block border-dark" data-type="gallary">
                <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white">
                    <span class="drag-handle" style="cursor:grab; font-size:18px; opacity:0.7;">⠿</span>
                    <strong>Section: Card Img Desc</strong>
                    <button type="button" class="btn btn-danger btn-sm remove-block">Remove Section</button>
                </div>
                <div class="card-body">
                    <input type="hidden" name="sections[S_IDX][type]" value="card_img_desc">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">Section Title</label>
                                <input type="text" name="sections[S_IDX][section_title]" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">Section Subtitle</label>
                                <input type="text" name="sections[S_IDX][section_subtitle]"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Section Description</label>
                            <textarea type="text" name="sections[S_IDX][section_description]" rows="5" class="form-control"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Image</label>
                            <div class="image-wrapper">
                                <button class="btn btn-primary btn-sm image-picker w-100" type="button">
                                    <i class="ti ti-photo"></i> Select Image
                                </button>
                                <div class="image-preview mt-2"></div>
                                <input type="hidden" class="image-content" name="sections[S_IDX][section_bg_img]">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Bg Color</label>
                            {{-- <input type="text" name="sections[S_IDX][section_bg_color]" class="form-control"> --}}

                            <div class="color-picker-group">
                                <div class="input-group align-items-center">
                                    <span class="input-group-text p-1">
                                        <span class="color-preview"></span>
                                    </span>
                                    <input type="color" class="color-input">
                                    <input type="text" name="sections[S_IDX][section_bg_color]"
                                        class="form-control color-hex" placeholder="#00a6a6">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Text Color</label>
                            {{-- <input type="text" name="sections[S_IDX][section_bg_color]" class="form-control"> --}}

                            <div class="color-picker-group">
                                <div class="input-group align-items-center">
                                    <span class="input-group-text p-1">
                                        <span class="color-preview"></span>
                                    </span>
                                    <input type="color" class="color-input">
                                    <input type="text" name="sections[S_IDX][section_text_color]"
                                        class="form-control color-hex" placeholder="#00a6a6">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-info text-white mt-4" type="button" data-bs-toggle="modal"
                                    data-bs-target="#stylesCardImgDesc">
                                    <i class="ti ti-progress-help"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="items-wrapper"></div> {{-- MUST be empty --}}
                    {{-- <button type="button" class="btn btn-success btn-sm mt-2 add-item-btn">+ Add Item</button> --}}
                </div>
            </div>
        </template>

        <template id="tpl-card_img_desc-item">
            <div class="card mb-3 item-row border-0 bg-light">
                <div class="card-body">
                    <div class="row g-3 align-items-start">
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">Image</label>
                                <div class="image-wrapper">
                                    <button class="btn btn-primary btn-sm image-picker w-100" type="button">
                                        <i class="ti ti-photo"></i> Select Image
                                    </button>
                                    <div class="image-preview mt-2"></div>
                                    <input type="hidden" class="image-content"
                                        name="sections[S_IDX][items][I_IDX][img]">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">Title</label>
                                <input type="text" name="sections[S_IDX][items][I_IDX][title]"
                                    class="form-control" placeholder="Title" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">Button Text</label>
                                <input type="text" name="sections[S_IDX][items][I_IDX][btn_text]"
                                    class="form-control" placeholder="Button Text" />
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </template>


        <template id="tpl-company_about_section_3">
            <div class="card card-add-component mb-4 section-block border-dark" data-type="gallary">
                <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white">
                    <span class="drag-handle" style="cursor:grab; font-size:18px; opacity:0.7;">⠿</span>
                    <strong>Section: Company About Section 3</strong>
                    <button type="button" class="btn btn-danger btn-sm remove-block">Remove Section</button>
                </div>
                <div class="card-body">
                    <input type="hidden" name="sections[S_IDX][type]" value="company_about_section_3">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">Section Title</label>
                                <input type="text" name="sections[S_IDX][section_title]" class="form-control">
                            </div>
                            <div class="form-group mb-3"> <label class="form-label fw-semibold">Section
                                    Subtitle</label>
                                <input type="text" name="sections[S_IDX][section_subtitle]"
                                    class="form-control">
                            </div>

                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Section Description</label>
                            <textarea type="text" name="sections[S_IDX][section_description]" class="form-control" rows="5"></textarea>
                        </div>
                        <div class="col-md-12">
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-info text-white mt-4" type="button" data-bs-toggle="modal"
                                    data-bs-target="#stylesCompAboutSec">
                                    <i class="ti ti-progress-help"></i>
                                </button>
                            </div>

                        </div>

                    </div>
                    <hr>
                    <div class="items-wrapper"></div> {{-- MUST be empty --}}
                    {{-- <button type="button" class="btn btn-success btn-sm mt-2 add-item-btn">+ Add Item</button> --}}
                </div>
            </div>
        </template>
        <template id="tpl-company_about_section_3-item">
            <div class="card mb-3 item-row border-0 bg-light">
                <div class="card-body">
                    <div class="row g-3 align-items-start">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">Image</label>
                                <div class="image-wrapper">
                                    <button class="btn btn-primary btn-sm image-picker w-100" type="button">
                                        <i class="ti ti-photo"></i> Select Image
                                    </button>
                                    <div class="image-preview mt-2"></div>
                                    <input type="hidden" class="image-content"
                                        name="sections[S_IDX][items][I_IDX][img]">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="" class="form-label fw-semibold">Button Text</label>
                            <input type="text" class="form-control"
                                name="sections[S_IDX][items][I_IDX][btn_text]">
                        </div>
                        <div class="col-md-4">
                            <label for="" class="form-label fw-semibold">Button Slug</label>
                            <input type="text" class="form-control"
                                name="sections[S_IDX][items][I_IDX][btn_slug]">
                        </div>
                    </div>
                </div>
            </div>
        </template>
        <div class="modal fade" id="fileManagerModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Select Image</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-4">
                                    <div id="drag-and-drop-zone" class="dm-uploader custom-uploader">
                                        <input type="file" name="files[]" class="form-input d-none" multiple>
                                        <div class="upload-inner text-center">
                                            <div class="upload-types">
                                                <span>JPG</span><span>JPEG</span><span>WEBP</span><span>PNG</span><span>GIF</span>
                                            </div>
                                            <div class="upload-icon"><i class="ti ti-upload"></i></div>
                                            <p class="upload-text">Drag and drop files here or</p>
                                            <button class="btn btn-light browse-btn">Browse Files</button>
                                        </div>
                                        <ul id="files-list" class="list-unstyled mt-3"></ul>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="row" id="fmImageList"
                                        style="max-height: 500px; overflow-y: auto;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="fm-btn-select-img">Select</button>
                    </div>
                </div>
            </div>
        </div>
        @include('backend.pages.partials.styles_modals')
    </div>

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.2/Sortable.min.js"></script>
        <script>
            let existingSections = @json(old('sections', $page->blocks ?? []));
            let sectionCount = 0;
            let nearestInput = null;
            let nearestWrapper = null;
            let selected_image = null;


            function buildItemRow(type, sIdx, iIdx, data = {}) {


                const itemTplMap = {
                    ol_list: 'ul_list'
                };
                let tplType = itemTplMap[type] || type;

                let tplId = 'tpl-' + tplType + '-item';
                let tpl = document.getElementById(tplId);

                if (!tpl) {
                    console.warn('Item template not found:', tplId);
                    return null;
                }


                let html = tpl.innerHTML;
                html = html.replace(/S_IDX/g, sIdx).replace(/I_IDX/g, iIdx);

                let $item = $(html);


                Object.keys(data).forEach(key => {
                    let $field = $item.find(`[name$="[${key}]"]`);
                    if ($field.is('textarea')) {
                        $field.val(data[key]);
                    } else {
                        $field.val(data[key]);
                    }


                    if (key === 'img' && data[key]) {
                        $item.find('.image-preview').html(buildImagePreviewHtml(data[key]));
                        $item.find('.image-content').val(data[key]);
                    }
                });

                return $item;
            }

            function buildImagePreviewHtml(url) {
                return `
            <div class="position-relative d-inline-block">
                <img src="${url}" class="img-thumbnail" style="max-height:120px; max-width:100%;">
                <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 remove-image">×</button>
            </div>`;
            }

            function initIconPicker(context = document) {
                $(context).find('.iconpicker-input').each(function() {
                    if ($(this).data('iconpicker')) {
                        $(this).iconpicker('destroy');
                    }
                    $(this).iconpicker({
                        placement: 'bottom',
                        animation: false,
                        hideOnSelect: true,
                        showFooter: true,
                        searchInFooter: true,
                        container: 'body',
                        fullClassFormatter: val => val
                    });
                });
            }


            $('.add-section-btn').on('click', function(e) {
                e.preventDefault();
                let type = $(this).data('type');


                let tplId = 'tpl-' + type;
                let tpl = document.getElementById(tplId);
                if (!tpl) {
                    console.warn('Section template not found:', tplId);
                    return;
                }

                let html = tpl.innerHTML.replace(/S_IDX/g, sectionCount);
                let $section = $(html);


                let $item = buildItemRow(type, sectionCount, 0);
                if ($item) {
                    $section.find('.items-wrapper').append($item);
                    initIconPicker($item);
                }

                $('#main-sections-container').append($section);
                sectionCount++;

                toastr.success('New ' + type.replace('_', ' ') + ' section created.', 'Section Added');
            });


            $(document).on('click', '.add-item-btn', function() {
                let $section = $(this).closest('.section-block');
                let type = $section.data('type');
                let sIdx = $section.find('input[type="hidden"][name*="[type]"]')
                    .attr('name').match(/\[(\d+)\]/)[1];
                let $wrapper = $section.find('.items-wrapper');
                let iIdx = $wrapper.find('.item-row').length;

                let $item = buildItemRow(type, sIdx, iIdx);
                if ($item) {
                    $wrapper.append($item);
                    initIconPicker($item);
                }
            });


            $(document).on('click', '.remove-block', function() {
                let $block = $(this).closest('.section-block');
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This will remove the entire section and all items inside it!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel',
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d'
                }).then(result => {
                    if (result.isConfirmed) {
                        $block.remove();
                        Swal.fire({
                            title: 'Deleted!',
                            text: 'Section removed.',
                            icon: 'success'
                        });
                    }
                });
            });


            $(document).on('click', '.remove-item', function() {
                let $wrapper = $(this).closest('.items-wrapper');
                if ($wrapper.find('.item-row').length > 1) {
                    $(this).closest('.item-row').remove();
                } else {
                    Swal.fire({
                        title: 'Action Denied',
                        text: 'Each section must have at least one item.',
                        icon: 'info'
                    });
                }
            });


            $(document).on('click', '.image-picker', function() {
                nearestWrapper = $(this).closest('.image-wrapper');
                nearestInput = nearestWrapper.find('.image-content');
                selected_image = null;
                $('#fileManagerModal').modal('show');
            });

            $(document).on('click', '.remove-image', function() {
                let $wrapper = $(this).closest('.image-wrapper');
                $wrapper.find('.image-content').val('');
                $wrapper.find('.image-preview').html('');
            });

            $(document).on('click', '#fm-btn-select-img', function() {
                if (nearestInput && selected_image) {
                    nearestInput.val(selected_image);
                    nearestWrapper.find('.image-preview').html(buildImagePreviewHtml(selected_image));
                }
                $('#fileManagerModal').modal('hide');
            });


            function renderExistingSections(sections) {
                sections.forEach((section, sIdx) => {
                    let type = section.type;
                    let tplId = 'tpl-' + type;
                    let tpl = document.getElementById(tplId);
                    if (!tpl) {
                        console.warn('Template not found:', tplId);
                        return;
                    }

                    let html = tpl.innerHTML.replace(/S_IDX/g, sIdx);
                    let $section = $(html);

                    // Fill section-level fields
                    $section.find('[name*="[section_title]"]').val(section.section_title || '');
                    $section.find('[name*="[section_subtitle]"]').val(section.section_subtitle || '');
                    $section.find('[name*="[section_style]"]').val(section.section_style || '');
                    $section.find('[name*="[section_description]"]').val(section.section_description || '');
                    // $section.find('[name*="[section_bg_img]"]').val(section.blog_category || '');
                    $section.find('[name*="[section_bg_color]"]').val(section.section_bg_color || '');
                    $section.find('[name*="[section_text_color]"]').val(section.section_text_color || '');

                    $section.find('.image-preview').html(buildImagePreviewHtml(section.section_bg_img));
                    $section.find('.image-content').val(section.section_bg_img);

                    let $wrapper = $section.find('.items-wrapper');
                    $wrapper.html(''); // ensure empty before filling

                    // Build item rows from data
                    let items = section.items || [];
                    if (items.length === 0) {
                        // add one blank row
                        let $item = buildItemRow(type, sIdx, 0);
                        if ($item) $wrapper.append($item);
                    } else {
                        items.forEach((item, iIdx) => {
                            let $item = buildItemRow(type, sIdx, iIdx, item);
                            if ($item) $wrapper.append($item);
                        });
                    }

                    $('#main-sections-container').append($section);

                    // Init icon pickers, then set icon values
                    initIconPicker($section);
                    setTimeout(() => {
                        $section.find('.iconpicker-input').each(function(i) {
                            let iconVal = items[i]?.icon || '';
                            if (iconVal) $(this).iconpicker('setIcon', iconVal);
                        });
                    }, 200);
                });
            }


            window.currentPage = 1;
            window.nextPage = null;
            window.isLoading = false;

            $('#fileManagerModal').on('shown.bs.modal', function() {
                window.currentPage = 1;
                window.nextPage = null;
                selected_image = null;
                loadImages(1, false);
            });

            function loadImages(page = 1, append = false) {
                if (isLoading) return;
                isLoading = true;

                $.ajax({
                    url: BASE_URL + '/file-manager/images?page=' + page,
                    type: 'GET',
                    success: function(response) {
                        let html = '';
                        if (response.data) {
                            response.data.forEach(el => {
                                html += getImgElm(el);
                            });
                        }
                        append ? $('#fmImageList').append(html) : $('#fmImageList').html(html);
                        window.currentPage = page;
                        window.nextPage = response.next_page;
                    },
                    error: xhr => console.log(xhr.responseText),
                    complete: () => {
                        isLoading = false;
                    }
                });
            }

            $('#fmImageList').on('scroll', function() {
                let c = this;
                if (c.scrollTop + c.clientHeight >= c.scrollHeight - 50 && nextPage && !isLoading) {
                    loadImages(nextPage, true);
                }
            });

            $(document).on('click', '.fm-img-item', function() {
                selected_image = $(this).data('url');
                $('.fm-img-item').removeClass('border-primary border-2 selected');
                $(this).addClass('border-primary border-2 selected');
            });

            function getImgElm(img) {
                return `
                <div class="col-md-3 mb-3">
                    <div class="card fm-img-item cursor-pointer" data-url="${img.url}">
                        <div class="card-body p-0">
                            <img src="${img.url}" class="img-fluid w-100">
                        </div>
                        <div class="card-footer p-0 ps-1 pe-1 bg-light">
                            <small>${img.name}</small>
                        </div>
                    </div>
                </div>`;
            }


            function initDmUploader() {
                let $zone = $('#drag-and-drop-zone');
                let $fileInput = $zone.find('input[type="file"]');
                let $filesList = $('#files-list');

                // "Browse Files" button triggers the hidden file input
                $zone.find('.browse-btn').off('click').on('click', function(e) {
                    e.preventDefault();
                    $fileInput.trigger('click');
                });

                // Drag-over styling
                $zone.off('dragover dragleave drop');

                $zone.on('dragover', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    $(this).addClass('drag-over');
                });

                $zone.on('dragleave', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    $(this).removeClass('drag-over');
                });

                // Drop event
                $zone.on('drop', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    $(this).removeClass('drag-over');

                    let files = e.originalEvent.dataTransfer.files;
                    if (files && files.length) {
                        handleFiles(files);
                    }
                });

                // File input change
                $fileInput.off('change').on('change', function() {
                    if (this.files && this.files.length) {
                        handleFiles(this.files);
                        // Reset so same file can be picked again
                        $(this).val('');
                    }
                });

                function handleFiles(files) {
                    let allowed = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];

                    Array.from(files).forEach(file => {
                        if (!allowed.includes(file.type)) {
                            toastr.error('File type not allowed: ' + file.name, 'Upload Error');
                            return;
                        }

                        if (file.size > 10 * 1024 * 1024) { // 10 MB limit
                            toastr.error('File too large (max 10MB): ' + file.name, 'Upload Error');
                            return;
                        }

                        uploadFile(file);
                    });
                }

                function uploadFile(file) {
                    let $item = $(`
                <li class="upload-item d-flex align-items-center gap-2 mb-2 p-2 border rounded bg-light">
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between mb-1">
                            <small class="text-truncate" style="max-width:180px;">${file.name}</small>
                            <small class="upload-status text-muted">Uploading…</small>
                        </div>
                        <div class="progress" style="height:6px;">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary upload-progress"
                                 role="progressbar" style="width:0%"></div>
                        </div>
                    </div>
                </li>
                `);
                    $filesList.append($item);

                    let formData = new FormData();
                    formData.append('file', file);
                    formData.append('_token', $('meta[name="csrf-token"]').attr('content') ||
                        '{{ csrf_token() }}');

                    $.ajax({
                        url: BASE_URL + '/file-manager/upload',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        xhr: function() {
                            let xhr = new window.XMLHttpRequest();
                            xhr.upload.addEventListener('progress', function(e) {
                                if (e.lengthComputable) {
                                    let pct = Math.round((e.loaded / e.total) * 100);
                                    $item.find('.upload-progress').css('width', pct + '%');
                                }
                            }, false);
                            return xhr;
                        },
                        success: function(response) {
                            $item.find('.upload-status').text('Done').removeClass('text-muted').addClass(
                                'text-success');
                            $item.find('.upload-progress').removeClass(
                                'progress-bar-animated progress-bar-striped bg-primary').addClass('bg-success');

                            // Prepend the new image into the gallery
                            if (response && response.url) {
                                $('#fmImageList').prepend(getImgElm({
                                    url: response.url,
                                    name: response.name || file.name
                                }));
                            }

                            // Auto-remove the item from the list after 2s
                            setTimeout(() => $item.fadeOut(300, () => $item.remove()), 2000);
                            loadImages(1, false);
                            toastr.success(file.name + ' uploaded successfully.', 'Upload Complete');
                        },
                        error: function(xhr) {
                            $item.find('.upload-status').text('Failed').removeClass('text-muted').addClass(
                                'text-danger');
                            $item.find('.upload-progress').removeClass(
                                'progress-bar-animated progress-bar-striped bg-primary').addClass('bg-danger');

                            let msg = xhr.responseJSON?.message || 'Upload failed.';
                            toastr.error(msg, 'Upload Error');
                        }
                    });
                }
            }

            // Re-init uploader every time the modal opens (so events are fresh)
            $('#fileManagerModal').on('shown.bs.modal', function() {
                initDmUploader();
            });


            $(document).ready(function() {
                if (existingSections && existingSections.length > 0) {
                    renderExistingSections(existingSections);
                    sectionCount = existingSections.length;
                }
            });

            function initSortable() {
                if (window._sortableInstance) {
                    window._sortableInstance.destroy();
                }
                window._sortableInstance = new Sortable(
                    document.getElementById('main-sections-container'), {
                        animation: 150,
                        handle: '.drag-handle',
                        ghostClass: 'sortable-ghost',
                        chosenClass: 'sortable-chosen',
                        onEnd: function() {
                            reindexSections();
                        }
                    }
                );
            }

            function reindexSections() {
                $('#main-sections-container .section-block').each(function(sIdx) {
                    $(this).find('input, textarea, select').each(function() {
                        let name = $(this).attr('name');
                        if (name) {
                            $(this).attr('name', name.replace(/sections\[\d+\]/, 'sections[' + sIdx + ']'));
                        }
                    });
                });
            }
            $(document).ready(function() {
                initSortable();
            });

            $('#preview-btn').on('click', function() {
                // Create a hidden form pointing to preview route, target _blank
                let $previewForm = $('<form>', {
                    action: '{{ route('pages.preview') }}',
                    method: 'POST',
                    target: '_blank',
                    style: 'display:none'
                });

                // Copy ALL inputs/textareas/selects from the main form
                $('form').find('input, textarea, select').each(function() {
                    let $el = $(this);
                    let name = $el.attr('name');
                    if (!name) return;

                    // Skip the method spoofing file inputs
                    if ($el.attr('type') === 'file') return;

                    $previewForm.append(
                        $('<input>').attr({
                            type: 'hidden',
                            name: name,
                            value: $el.val()
                        })
                    );
                });

                // Add CSRF
                $previewForm.append(
                    $('<input>').attr({
                        type: 'hidden',
                        name: '_token',
                        value: '{{ csrf_token() }}'
                    })
                );

                $('body').append($previewForm);
                $previewForm.submit();
                $previewForm.remove();
            });
            //color picker 
            function setupColorPicker(group) {

                if (group.dataset.initialized) return;

                const preview = group.querySelector('.color-preview');
                const colorInput = group.querySelector('.color-input');
                const hexInput = group.querySelector('.color-hex');

                let defaultColor = hexInput.value || '';

                preview.style.backgroundColor = defaultColor;
                colorInput.value = defaultColor;
                hexInput.value = defaultColor;

                group.dataset.initialized = 'true';
            }


            // Initialize existing ones
            document.querySelectorAll('.color-picker-group').forEach(setupColorPicker);


            // Watch future DOM changes automatically
            const observer = new MutationObserver((mutations) => {

                mutations.forEach((mutation) => {

                    mutation.addedNodes.forEach((node) => {

                        if (node.nodeType !== 1) return;

                        // If added node itself is picker
                        if (node.classList?.contains('color-picker-group')) {
                            setupColorPicker(node);
                        }

                        // If picker exists inside added HTML
                        node.querySelectorAll?.('.color-picker-group')
                            .forEach(setupColorPicker);
                    });
                });
            });

            observer.observe(document.body, {
                childList: true,
                subtree: true
            });


            // GLOBAL EVENTS

            document.addEventListener('click', function(e) {

                if (e.target.classList.contains('color-preview')) {

                    const group = e.target.closest('.color-picker-group');
                    group.querySelector('.color-input').click();
                }
            });


            document.addEventListener('input', function(e) {

                // Color picker change
                if (e.target.classList.contains('color-input')) {

                    const group = e.target.closest('.color-picker-group');

                    group.querySelector('.color-preview').style.backgroundColor = e.target.value;
                    group.querySelector('.color-hex').value = e.target.value;
                }

                // HEX input change
                if (e.target.classList.contains('color-hex')) {

                    let val = e.target.value;

                    if (/^#([0-9A-F]{3}){1,2}$/i.test(val)) {

                        const group = e.target.closest('.color-picker-group');

                        group.querySelector('.color-preview').style.backgroundColor = val;
                        group.querySelector('.color-input').value = val;
                    }
                }
            });
        </script>
    @endpush
    @push('styles')
        <style>
            /* Drag-over highlight */
            .sortable-ghost {
                opacity: 0.4;
                border: 2px dashed #6c757d !important;
            }

            .sortable-chosen {
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            }

            .drag-handle:active {
                cursor: grabbing;
            }

            #drag-and-drop-zone.drag-over {
                border: 2px dashed #0d6efd !important;
                background-color: #e8f0fe !important;
            }

            #drag-and-drop-zone {
                border: 2px dashed #dee2e6;
                border-radius: 8px;
                padding: 20px;
                transition: background-color 0.2s, border-color 0.2s;
                min-height: 200px;
            }

            .upload-item {
                font-size: 0.85rem;
            }

            .color-preview {
                width: 30px;
                height: 30px;
                border-radius: 6px;
                display: block;
                cursor: pointer;
                border: 1px solid #ddd;
            }

            .color-input {
                position: absolute;
                opacity: 0;
                pointer-events: none;
            }
        </style>
    @endpush
</x-app>
