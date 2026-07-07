<x-app>
    <div class="container-fluid component">
        <div class="card card-shadow mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-0 fw-bold">{{ $page ? 'Edit' : 'Create' }} Page</h4>
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
        <form action="{{ $page ? route('pages.update', $page->id) : route('pages.store') }}" method="post"
            id="pageForm">
            @csrf
            <div class="row g-4">

                {{-- ===== PAGE META ===== --}}
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-white border-bottom py-3">
                            <h5 class="mb-0 fw-bold">
                                <i class="ti ti-file-text me-2 text-primary"></i>
                                Page Information
                            </h5>
                        </div>

                        <div class="card-body p-4">

                            <div class="mb-4">
                                <label for="title" class="form-label fw-semibold">
                                    Page Name
                                </label>
                                <input type="text" name="title" id="title"
                                    class="form-control @error('title') is-invalid @enderror"
                                    value="{{ old('title', $page ? $page->title : '') }}" placeholder="Enter page title"
                                    required>

                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="slug" class="form-label fw-semibold">
                                    Page Slug
                                </label>

                                <div class="input-group">
                                    <span class="input-group-text">/</span>

                                    <input type="text" name="slug" id="slug"
                                        class="form-control @error('slug') is-invalid @enderror"
                                        value="{{ old('slug', $page ? $page->slug : '') }}" placeholder="page-slug">
                                </div>

                                @error('slug')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr class="my-4">

                            <h6 class="fw-bold text-muted mb-3">
                                SEO Information
                            </h6>

                            <div class="mb-4">
                                <label for="meta_title" class="form-label fw-semibold">
                                    Meta Title
                                </label>

                                <input type="text" name="meta_title" id="meta_title"
                                    class="form-control @error('meta_title') is-invalid @enderror"
                                    value="{{ old('meta_title', $page ? $page->meta_title : '') }}"
                                    placeholder="SEO meta title">

                                @error('meta_title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-0">
                                <label for="meta_desc" class="form-label fw-semibold">
                                    Meta Description
                                </label>

                                <textarea name="meta_desc" id="meta_desc" class="form-control @error('meta_desc') is-invalid @enderror" rows="5"
                                    placeholder="Enter SEO meta description">{{ old('meta_desc', $page ? $page->meta_description : '') }}</textarea>

                                @error('meta_desc')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>
                </div>

                {{-- ===== PAGE HEADER ===== --}}
                <div class="col-lg-6">

                    @php
                        $bread_title = null;
                        $bread_sub_title = null;
                        $sec_title = null;
                        $sec_desc = null;
                        $bread_image = null;

                        if ($page && $page->header_section) {
                            $bread_title = data_get($page->header_section, 'breadcrumb_title', null);
                            $bread_sub_title = data_get($page->header_section, 'breadcrumb_subtitle', null);
                            $sec_title = data_get($page->header_section, 'section_title', null);
                            $sec_desc = data_get($page->header_section, 'section_description', null);
                            $bread_image = data_get($page->header_section, 'image', null);
                        }
                    @endphp

                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-white border-bottom py-3">
                            <h5 class="mb-0 fw-bold">
                                <i class="ti ti-layout-navbar me-2 text-primary"></i>
                                Header Section
                            </h5>
                        </div>

                        <div class="card-body p-4 d-flex flex-column">

                            <div>

                                <div class="mb-4">
                                    <label class="form-label fw-semibold">
                                        Header Banner Image
                                    </label>

                                    <div class="image-wrapper border rounded-3 p-3 bg-light-subtle">

                                        <button type="button" class="btn btn-primary btn-sm image-picker">
                                            <i class="ti ti-photo me-1"></i>
                                            Select Image
                                        </button>

                                        <input type="hidden" name="breadcrumb_image" class="image-content"
                                            value="{{ old('breadcrumb_image', $bread_image ?: '') }}">

                                        <div class="image-preview mt-3">
                                            @if ($bread_image)
                                                <div class="position-relative d-inline-block">
                                                    <img src="{{ imgUrl($bread_image) }}" class="img-thumbnail rounded"
                                                        style="max-height:140px; max-width:100%;">

                                                    <button type="button"
                                                        class="btn btn-danger btn-sm position-absolute top-0 end-0 remove-image">
                                                        &times;
                                                    </button>
                                                </div>
                                            @endif
                                        </div>

                                    </div>
                                </div>

                                <div class="row g-3">

                                    <div class="col-md-6">
                                        <label for="breadcrumb_title" class="form-label fw-semibold">
                                            Header Title
                                        </label>

                                        <input type="text" name="breadcrumb_title" id="breadcrumb_title"
                                            class="form-control" placeholder="Enter header title"
                                            value="{{ old('breadcrumb_title', $bread_title ?: '') }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="breadcrumb_subtitle" class="form-label fw-semibold">
                                            Header Subtitle
                                        </label>

                                        <input type="text" name="breadcrumb_subtitle" id="breadcrumb_subtitle"
                                            class="form-control" placeholder="Enter subtitle"
                                            value="{{ old('breadcrumb_subtitle', $bread_sub_title ?: '') }}">
                                    </div>

                                </div>

                            </div>

                            {{-- BUTTON --}}
                            <div class="mt-auto pt-4 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary px-4" id="savePageBtn">
                                    <span class="btn-text">
                                        Save & Continue to Page Builder
                                        <i class="ti ti-arrow-narrow-right"></i>
                                    </span>

                                    <span class="btn-loader d-none">
                                        <span class="spinner-border spinner-border-sm me-1"></span>
                                        Saving...
                                    </span>
                                </button>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </form>

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
    </div>
    @push('scripts')
        <script>
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

            function buildImagePreviewHtml(url) {
                return `
            <div class="position-relative d-inline-block">
                <img src="${url}" class="img-thumbnail" style="max-height:120px; max-width:100%;">
                <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 remove-image">×</button>
            </div>`;
            }
            // Re-init uploader every time the modal opens (so events are fresh)
            $('#fileManagerModal').on('shown.bs.modal', function() {
                initDmUploader();
            });

            $(document).ready(function() {

                $('#pageForm').on('submit', function(e) {
                    e.preventDefault();

                    let form = $(this);
                    let btn = $('#savePageBtn');

                    // Button loading state
                    btn.prop('disabled', true);
                    btn.find('.btn-text').addClass('d-none');
                    btn.find('.btn-loader').removeClass('d-none');

                    // Clear validation
                    $('.is-invalid').removeClass('is-invalid');
                    $('.invalid-feedback').remove();

                    $.ajax({
                        url: form.attr('action'),
                        type: 'POST',
                        data: form.serialize(),

                        success: function(response) {

                            if (response.status) {

                                window.location.href =
                                    `/backend/page-editor/${response.page_id}`;
                            }
                        },

                        error: function(xhr) {

                            btn.prop('disabled', false);
                            btn.find('.btn-text').removeClass('d-none');
                            btn.find('.btn-loader').addClass('d-none');

                            // Validation errors
                            if (xhr.status === 422) {

                                let errors = xhr.responseJSON.errors;

                                $.each(errors, function(field, messages) {

                                    let input = $('[name="' + field + '"]');

                                    input.addClass('is-invalid');

                                    input.after(
                                        `<div class="invalid-feedback">${messages[0]}</div>`
                                    );
                                });
                            }
                        }
                    });

                });

            });
        </script>
    @endpush
</x-app>
