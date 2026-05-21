 <x-app>

     <div class="row">
         <div class="col-12">
             <div class="mb-3">
                 <h1 class="fs-3 mb-1">Create Blogs</h1>
                 <p></p>
             </div>
         </div>
     </div>

     <div class="row">
         <div class="col-12">
             <form action="{{ $blog ? route('seo.blogs.update', $blog->id) : route('seo.blogs.save') }}" method="POST">
                 @if ($blog)
                     @method('PUT')
                 @endif
                 @csrf()
                 <div class="row">
                     <div class="col-md-9">
                         <div class="card card-shadow mb-3">
                             <div class="card-body">
                                 <div class="form-group mb-3">
                                     <label for="" class="form-label">Title</label>
                                     <input type="text" name="title" class="form-control" id=""
                                         placeholder="Title" value="{{ old('title', $blog->title ?? '') }}">
                                 </div>
                                 <div class="form-group mb-3">
                                     <label for="" class="form-label">Meta Title</label>
                                     <input type="text" name="meta_title" class="form-control" id=""
                                         placeholder="Meta Title"
                                         value="{{ old('meta_title', $blog->meta_title ?? '') }}">
                                 </div>
                                 <div class="form-group mb-3">
                                     <label for="" class="form-label">Slug <small>(If you leave it blank, it
                                             will be generated automatically.)</small></label>
                                     <input type="text" name="slug" class="form-control" id=""
                                         placeholder="Slug" value="{{ old('slug', $blog->slug ?? '') }}">
                                 </div>
                                 <div class="form-group mb-3">
                                     <label for="" class="form-label">Summary</label>
                                     <textarea class="form-control" name="summary" rows="2" placeholder="Summary & Description (Meta Tag)">{{ old('summary', $blog->summary ?? '') }}</textarea>
                                 </div>
                                 <div class="form-group mb-3">
                                     <label class="form-label">Description (Meta Desc)</label>
                                     <textarea class="form-control" name="meta_desc" rows="2" placeholder="Description (Meta Desc)">{{ old('meta_desc', $blog->meta_desc ?? '') }}</textarea>
                                 </div>
                                 <div class="form-group mb-3">
                                     <label for="" class="form-label">Keywords (Meta Tag)</label>
                                     @php
                                         $tags = $blog->tags ?? [];
                                     @endphp

                                     <select name="tags[]" class="form-control select2-tags" multiple>
                                         @foreach ($tags as $tag)
                                             @if (trim($tag) !== '')
                                                 <option value="{{ trim($tag) }}" selected>
                                                     {{ trim($tag) }}
                                                 </option>
                                             @endif
                                         @endforeach
                                     </select>
                                 </div>
                             </div>
                         </div>
                         <div class="card card-shadow">
                             <div class="card-body">
                                 <label for="" class="form-label">Description</label>
                                 <textarea class="tinyMceEditor" name="description">{{ old('description', $blog->description ?? '') }}</textarea>
                             </div>
                         </div>
                     </div>
                     <div class="col-md-3">
                         <div class="card card-shadow mb-3">
                             <div class="card-body">
                                 <div class="form-group mb-3">
                                     <label for="" class="form-label d-block mb-0">Image</label>
                                     <small class="text-muted">Main post image</small>
                                     <div id="post_select_image_container" class="post-select-image-container mt-2">
                                         @if ($blog && $blog->img)
                                             <div class="position-relative d-inline-block">
                                                 <img src="{{ asset($blog->img) }}" class="img-fluid rounded border">
                                                 <a
                                                     class="btn btn-danger btn-sm btn-delete-selected-file-image position-absolute top-0 end-0">✕</a>
                                             </div>
                                         @else
                                             <a class="btn-select-image" data-bs-toggle="modal"
                                                 data-bs-target="#fileManagerModal" data-type="single">
                                                 <div class="btn-select-image-inner">
                                                     <i class="ti ti-library-photo"></i>
                                                     <button class="btn">Select Image</button>
                                                 </div>
                                             </a>
                                         @endif
                                     </div>
                                 </div>
                                 <div class="form-group mb-3">
                                     <label for="" class="form-label">Or Add Image Url</label>
                                     <input type="text" name="img" id="img_thumbnail_url" class="form-control"
                                         placeholder="Add Image Url"
                                         value="{{ old('img', $blog ? ($blog->img ? asset($blog->img) : '') : '') }}">
                                 </div>
                                 <div class="form-group mb-3">
                                     <label for="" class="form-label">Image Description</label>
                                     <input type="text" name="img_desc" id="" class="form-control"
                                         placeholder="Image Description" value="{{ old('img_desc', $blog ? ($blog->img_desc ? $blog->img_desc : '') : '') }}">
                                 </div>
                             </div>
                         </div>

                         <div class="card card-shadow mb-3">


                             <div class="card-body">
                                 <div class="form-group">
                                     <label for="" class="form-label d-block mb-0"> Additional Images</label>

                                     <small class="text-muted d-block">More main images (slider will be active)</small>
                                     <input type="hidden" id="multi_images_input" name="slider">
                                     <button class="btn  btn-primary mt-3" type="button" data-bs-toggle="modal"
                                         data-bs-target="#fileManagerModal" data-type="multiple">
                                         <i class="ti ti-photo-scan"></i> Select
                                         Images
                                     </button>
                                 </div>
                                 <div id="multi_image_container" class="mt-3 d-flex flex-wrap">
                                     @if ($blog && $blog->slider)
                                         @foreach ($blog->slider as $slider)
                                             <div class="multi-img-item position-relative me-2 mb-2"
                                                 data-url="{{ asset($slider) }}">
                                                 <img src="{{ asset($slider) }}" class="img-fluid rounded border"
                                                     style="width:100px;height:100px;object-fit:cover;">
                                                 <a
                                                     class="btn btn-danger btn-sm btn-remove-multi-img position-absolute top-0 end-0">✕</a>
                                             </div>
                                         @endforeach
                                     @endif
                                 </div>
                             </div>
                         </div>
                         <div class="card card-shadow mb-3">
                             <div class="card-body">
                                 <div class="form-group">
                                     <label for="" class="form-label">Category</label>
                                     <select id="category_id" name="category_id" class="form-select">
                                         <option value="">Select Category</option>
                                         @foreach ($categories as $category)
                                             <option value="{{ $category->id }}"
                                                 {{ old('category_id', $blog->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                                 {{ $category->title }}</option>
                                         @endforeach
                                     </select>
                                 </div>
                             </div>
                         </div>
                         <div class="card card-shadow mb-3">
                             <div class="card-body">
                                 <div class="form-group mb-3">
                                     <label for="" class="form-label">Publish</label>
                                     <div class="form-check d-flex align-items-center gap-2">
                                         <input class="form-check-input" type="checkbox" name="schedule_post"
                                             id="schedulePostCheck" style="width:25px;height:25px;">
                                         <label class="form-check-label" for="flexCheckDefault">
                                             Schedule Post
                                         </label>
                                     </div>
                                 </div>
                                 <div class="form-group mb-3 d-none" id="date-published-group">
                                     <label for="" class="form-label">Date Published</label>
                                     <input type="text" name="published_at" id="date-published"
                                         class="form-control">
                                 </div>
                                 <div class="d-flex justify-content-end gap-2">
                                     <button class="btn btn-warning" name="draft">Save as Draft</button>
                                     <button class="btn btn-primary" name="save">Submit</button>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </form>
         </div>
     </div>

     <div class="modal fade" id="fileManagerModal" tabindex="-1" aria-labelledby="fileManagerModalLabel"
         aria-hidden="true">
         <div class="modal-dialog modal-xl">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="fileManagerModalLabel">Modal title</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                 <div class="modal-body">
                     <div class="container-fluid">
                         <div class="row">
                             <div class="col-md-4">
                                 <div id="drag-and-drop-zone" class="dm-uploader custom-uploader">

                                     <input type="file" name="files[]" class="form-input d-none" multiple>

                                     <div class="upload-inner text-center">
                                         <div class="upload-types">
                                             <span>JPG</span>
                                             <span>JPEG</span>
                                             <span>WEBP</span>
                                             <span>PNG</span>
                                             <span>GIF</span>
                                         </div>

                                         <div class="upload-icon">
                                             <i class="ti ti-upload"></i>
                                         </div>

                                         <p class="upload-text">Drag and drop files here or</p>

                                         <button class="btn btn-light browse-btn">Browse Files</button>
                                     </div>
                                     <ul id="files-list" class="list-unstyled mt-3"></ul>

                                 </div>
                             </div>
                             <div class="col-md-8">
                                 <div class="row" id="fmImageList">

                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                     <button type="button" class="btn btn-primary" id="fm-btn-select-img"
                         type="button">Select</button>
                 </div>
             </div>
         </div>
     </div>
     @push('scripts')
         <script>
             window.selectType = 'single';
             window.selected_image =
                 @if (!empty($blog->img))
                     "{{ asset($blog->img) }}"
                 @else
                     ''
                 @endif ;
             window.selected_images = @json(
                 !empty($blog->slider)
                     ? collect($blog->slider)->map(function ($img) {
                         return \Illuminate\Support\Str::startsWith($img, 'http') ? $img : asset($img);
                     })
                     : []
             );

             window.currentPage = 1;
             window.nextPage = null;
             window.isLoading = false;
             // ================= MODAL OPEN =================
             $("#fileManagerModal").on('shown.bs.modal', function(event) {

                 let button = $(event.relatedTarget);
                 let type = button.data('type') || 'single';

                 window.selectType = type;

                 // reset pagination
                 window.currentPage = 1;
                 window.nextPage = null;

                 loadImages(1, false);
             });

             // ================= LOAD IMAGES =================
             function loadImages(page = 1, append = false) {

                 if (isLoading) return;

                 isLoading = true;

                 $.ajax({
                     url: BASE_URL + '/file-manager/images?page=' + page,
                     type: 'GET',
                     success: function(response) {

                         let html = '';
                         if (response.data) {
                             response.data.forEach(element => {
                                 html += getImgElm(element);
                             });
                         }

                         if (append) {
                             $('#fmImageList').append(html);
                         } else {
                             $('#fmImageList').html(html);
                         }

                         // 🔥 your backend logic
                         window.currentPage = page;
                         window.nextPage = response.next_page;

                         restoreSelectionUI();
                     },
                     error: function(xhr) {
                         console.log(xhr.responseText);
                     },
                     complete: function() {
                         isLoading = false;
                     }
                 });
             }

             // ================= SCROLL LOAD =================
             $('#fmImageList').on('scroll', function() {

                 let container = $(this)[0];

                 if (container.scrollTop + container.clientHeight >= container.scrollHeight - 50) {

                     if (nextPage && !isLoading) {
                         loadImages(nextPage, true);
                     }
                 }
             });

             // ================= IMAGE CLICK =================
             $(document).on('click', '.fm-img-item', function() {

                 let url = $(this).data('url');

                 // SINGLE
                 if (selectType === 'single') {

                     selected_image = url;

                     $('.fm-img-item').removeClass('border-primary border-2 selected');
                     $(this).addClass('border-primary border-2 selected');
                 }

                 // MULTIPLE
                 if (selectType === 'multiple') {

                     if ($(this).hasClass('selected')) {

                         $(this).removeClass('selected border-primary border-2');
                         selected_images = selected_images.filter(img => img !== url);

                     } else {

                         $(this).addClass('selected border-primary border-2');

                         if (!selected_images.includes(url)) {
                             selected_images.push(url);
                         }
                     }
                 }
             });

             // ================= SELECT BUTTON =================
             $(document).on('click', '#fm-btn-select-img', function() {

                 // SINGLE
                 if (selectType === 'single' && selected_image) {

                     $('#post_select_image_container').html(`
                        <div class="position-relative d-inline-block">
                            <img src="${selected_image}" class="img-fluid rounded border">
                            <a class="btn btn-danger btn-sm btn-delete-selected-file-image position-absolute top-0 end-0">✕</a>
                        </div>`);

                     $('#img_thumbnail_url').val(selected_image);
                 }

                 // MULTIPLE
                 if (selectType === 'multiple' && selected_images.length > 0) {
                     renderMultiImages();
                 }

                 $('#fileManagerModal').modal('hide');
             });

             // ================= RENDER MULTI =================
             function renderMultiImages() {

                 let html = '';

                 selected_images.forEach((img) => {
                     html += `
                        <div class="multi-img-item position-relative me-2 mb-2" data-url="${img}">
                            <img src="${img}" 
                                class="img-fluid rounded border"
                                style="width:100px;height:100px;object-fit:cover;">
                            <a class="btn btn-danger btn-sm btn-remove-multi-img position-absolute top-0 end-0">✕</a>
                        </div>`;
                 });

                 $('#multi_image_container').html(html);

                 $('#multi_images_input').val(JSON.stringify(selected_images));
             }

             // ================= REMOVE SINGLE =================
             $(document).on('click', '.btn-delete-selected-file-image', function() {

                 selected_image = '';

                 $('#post_select_image_container').html(`
                        <a class="btn-select-image" data-bs-toggle="modal"
                            data-bs-target="#fileManagerModal" data-type="single">
                            <div class="btn-select-image-inner">
                                <i class="ti ti-library-photo"></i>
                                <button class="btn">Select Image</button>
                            </div>
                        </a>`);

                 $('#img_thumbnail_url').val('');
             });

             // ================= REMOVE MULTI =================
             $(document).on('click', '.btn-remove-multi-img', function() {

                 let parent = $(this).closest('.multi-img-item');
                 let url = parent.data('url');

                 selected_images = selected_images.filter(img => img !== url);

                 parent.remove();

                 $('#multi_images_input').val(JSON.stringify(selected_images));
             });

             // ================= RESTORE SELECTION =================
             function restoreSelectionUI() {

                 $('.fm-img-item').each(function() {

                     let url = $(this).data('url');

                     if (selectType === 'single' && url === selected_image) {
                         $(this).addClass('border-primary border-2 selected');
                     }

                     if (selectType === 'multiple' && selected_images.includes(url)) {
                         $(this).addClass('border-primary border-2 selected');
                     }
                 });
             }

             // ================= TEMPLATE =================
             function getImgElm(img) {
                 return `
                    <div class="col-md-3 mb-3">
                        <div class="card fm-img-item cursor-pointer" data-url="${img.url}">
                            <div class="card-body p-0">
                                <img src="${img.url}" class="img-fluid">
                            </div>
                            <div class="card-footer p-0 ps-1 pe-1 bg-light">
                                <small>${img.name}</small>
                            </div>
                        </div>
                    </div>`;
             }
             $('#img_thumbnail_url').on('blur', function() {
                 const url = $("#img_thumbnail_url").val();
                 if (url) {
                     $('#post_select_image_container').html(`
                        <div class="position-relative d-inline-block">
                            <img src="${url}" class="img-fluid rounded border">
                            <a class="btn btn-danger btn-sm btn-delete-selected-file-image position-absolute top-0 end-0">✕</a>
                        </div>`);
                 }
             });
             $('#drag-and-drop-zone').dmUploader({
                 url: BASE_URL + '/file-manager/upload', // your backend route
                 method: 'POST',
                 multiple: true,
                 headers: {
                     'X-CSRF-TOKEN': '{{ csrf_token() }}'
                 },
                 allowedTypes: '*',

                 onDragEnter: function() {
                     $('#drag-and-drop-zone').addClass('active');
                 },

                 onDragLeave: function() {
                     $('#drag-and-drop-zone').removeClass('active');
                 },

                 onDrop: function() {
                     $('#drag-and-drop-zone').removeClass('active');
                 },

                 onInit: function() {
                     console.log('Uploader initialized');
                 },

                 onNewFile: function(id, file) {
                     $('#files-list').append(`
                    <li id="file-${id}" class="upload-item">
                        
                        <div class="d-flex justify-content-between">
                            <span class="file-name">${file.name}</span>
                            <span class="file-percent" id="percent-${id}">0%</span>
                        </div>

                        <div class="progress mt-1">
                            <div class="progress-bar" id="progress-${id}" role="progressbar" style="width: 0%"></div>
                        </div>

                    </li>`);
                 },

                 onUploadProgress: function(id, percent) {
                     $(`#progress-${id}`).css('width', percent + '%');
                     $(`#percent-${id}`).text(percent + '%');
                 },

                 onUploadSuccess: function(id, data) {

                     $(`#progress-${id}`)
                         .removeClass('bg-primary')
                         .addClass('bg-success')
                         .css('width', '100%');

                     $(`#percent-${id}`).text('Done');

                     // reload images
                     window.currentPage = 1;
                     window.nextPage = null;
                     loadImages(1, false);
                 },

                 onUploadError: function(id, xhr, status, message) {

                     $(`#progress-${id}`)
                         .removeClass('bg-primary')
                         .addClass('bg-danger');

                     $(`#percent-${id}`).text('Error');
                 },
             });
             $(document).on('click', '.browse-btn', function(e) {
                 e.preventDefault();
                 $('#drag-and-drop-zone input[type="file"]').trigger('click');
             });
             $("#schedulePostCheck").on('change', function() {
                 if ($(this).is(':checked')) {
                     $('#date-published-group').removeClass('d-none')
                 } else {
                     $('#date-published-group').addClass('d-none')
                 }
             });
             $('#category_id').select2({
                 theme: 'bootstrap-5',
                 placeholder: 'Select Category',
             });

             $('#date-published').flatpickr({
                 dateFormat: "Y-m-d H:i:ss",
                 allowInput: false,
                 enableTime: true,
             })

             if (window.selected_images && window.selected_images.length > 0) {
                 renderMultiImages(); // 🔥 THIS WAS MISSING
             }
             $('.select2-tags').select2({
                 tags: true,
                 tokenSeparators: [','], // press comma to create tag
                 placeholder: "Keywords (Meta Tag)"
             });
         </script>
     @endpush
 </x-app>
