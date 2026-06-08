 <x-app>
     <div class="card card-shadow">
         <div class="card-body">
             <div class="row">
                 <div class="col-12">
                     <div class="mb-6">
                         <h1 class="fs-3 mb-1">Blogs</h1>
                         <p></p>
                     </div>
                 </div>
             </div>

             <div class="row">
                 <div class="col-12">
                     <div class="row mb-3">
                         <div class="col-md-2">
                             <div class="input-group">
                                 <input type="text" name="q" id="" class="form-control"
                                     placeholder="Search">
                                
                                 <button class="btn btn-outline-secondary" type="button"
                                     id="button-addon2">Button</button>
                             </div>
                         </div>
                         <div class="col-md-6">

                         </div>
                         <div class="col-md-4">
                             <div class="d-flex justify-content-end gap-2">
                                 <a href="{{ route('seo.blogs.index') }}">
                                     <button class="btn btn-info"><i class="ti ti-list"></i>Blogs</button>
                                 </a>

                                 <button class="btn btn-primary" data-bs-toggle="modal"
                                     data-bs-target="#addEditCategory">
                                     <i class="ti ti-plus"></i>
                                     Add Category
                                 </button>
                             </div>
                         </div>
                     </div>
                     <div class="table-responsive">
                         <table class="table table-bordered table-hover table-striped">
                             <thead>
                                 <td>
                                     #Id
                                 </td>
                                 <td>
                                     Image
                                 </td>
                                 <td>
                                     Category Name
                                 </td>
                                 <td>
                                     Parent Category
                                 </td>
                                 <td>
                                     Blogs
                                 </td>
                                 <td>
                                     Status
                                 </td>
                                 <td>
                                     Options
                                 </td>
                             </thead>
                             <tbody>
                                 @foreach ($categories as $category)
                                     <tr>
                                         <td>{{ $category->id }} </td>
                                         <td>
                                             <div>
                                                 @if ($category->img)
                                                     <img class="img-fluid" width="100" height="100"
                                                         src="{{ asset($category->img) }}" alt="">
                                                 @else
                                                 <span>No Image</span>
                                                 @endif
                                             </div>
                                         </td>
                                         <td>{{ $category->title }} </td>
                                         <td>{{ $category?->parent?->title ?? '-' }}</td>
                                         <td>{{$category->blogs->count()}}</td>
                                         <td>
                                             @if ($category->status == 1)
                                                 <span class="badge  bg-success">Active</span>
                                             @else
                                                 <span class="badge  bg-danger">InActive</span>
                                             @endif
                                         </td>
                                         <td>
                                             <div class="d-flex gap-2">
                                                 <button class="btn btn-icon btn-xs btn-warning btn-category-edit"
                                                     data-id="{{ $category->id }}"> <i class="ti ti-edit"></i> </button>
                                                 <button class="btn btn-icon btn-xs btn-danger btn-delete"
                                                     data-id="{{ $category->id }}">
                                                     <i class="ti ti-trash"></i>
                                                 </button>
                                             </div>
                                         </td>
                                     </tr>
                                 @endforeach
                             </tbody>
                         </table>
                     </div>
                 </div>
             </div>
         </div>
     </div>

     <div class="modal fade" id="addEditCategory" tabindex="-1" aria-labelledby="addEditCategoryLabel"
         aria-hidden="true">
         <div class="modal-dialog">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="addEditCategoryLabel">Add Category</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>

                 <div class="modal-body">
                     <div class="form-group mb-3">
                         <label for="" class="form-label">Select Parent Category</label>
                         <select name="" id="categorySelect" class="form-control">

                         </select>
                     </div>
                     <div class="form-group mb-3">
                         <label for="" class="form-label">Category Name</label>
                         <input type="text" name="" id="categoryName" class="form-control">
                     </div>
                     <input type="hidden" id="categoryId">

                     <div class="form-group mb-3">
                         <label class="form-label">Category Image</label>
                         <input type="file" id="categoryImage" class="form-control">
                     </div>
                     <div class="form-group mb-3">
                         <label for="" class="form-label">Meta Title</label>
                         <input type="text" name="meta_title" id="metaTitle" class="form-control">
                     </div>
                     <div class="form-group mb-3">
                         <label for="" class="form-label">Meta Description</label>
                         <input type="text" name="meta_desc" id="metaDesc" class="form-control">
                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                     <button type="button" class="btn btn-primary" id="saveCategory">Save </button>
                 </div>
             </div>
         </div>
     </div>

     @push('scripts')
         <script>
             $('#addEditCategory').on('shown.bs.modal', function() {

                 $('#categorySelect').select2({
                     dropdownParent: $('#addEditCategory'),
                     theme: 'bootstrap-5',
                     placeholder: 'Select Parent Category',
                     allowClear: true,
                     ajax: {
                         url: BASE_URL + '/seo/blogs/ajax-categories',
                         dataType: 'json',
                         delay: 250,
                         data: function(params) {
                             return {
                                 search: params.term,
                                 page: params.page || 1
                             };
                         },
                         processResults: function(response, params) {

                             params.page = params.page || 1;

                             return {
                                 results: response.data.map(function(item) {
                                     return {
                                         id: item.id,
                                         text: item.title
                                     };
                                 }),

                                 pagination: {
                                     more: response.next_page !== null
                                 }
                             };
                         },

                         cache: true
                     }
                 });

             });

             $('#saveCategory').on('click', () => {

                 const id = $("#categoryId").val();
                 const parent_id = $("#categorySelect").val();
                 const category_title = $("#categoryName").val();
                 const image = $('#categoryImage')[0].files[0];
                 const metaTitle = $('#metaTitle').val();
                 const metaDesc = $('#metaDesc').val();
                 // return;
                 let formData = new FormData();
                 formData.append('parent_id', parent_id);
                 formData.append('title', category_title);
                 formData.append('meta_title', metaTitle);
                 formData.append('meta_desc', metaDesc);

                 if (image) {
                     formData.append('img', image);
                 }

                 if (id) {
                     formData.append('id', id); // for update
                 }

                 $.ajax({
                     url: BASE_URL + '/seo/blogs/ajax-category-save',
                     type: 'POST',
                     headers: {
                         'X-CSRF-TOKEN': '{{ csrf_token() }}'
                     },
                     data: formData,
                     processData: false,
                     contentType: false,
                     success: function(response) {
                         if (response.status) {
                             Swal.fire('Success!', response.message, 'success');
                             location.reload();
                         } else {
                             Swal.fire('Error!', response.message, 'error');
                         }
                     }
                 });
             });
             $(document).on('click', '.btn-category-edit', function() {
                 let id = $(this).data('id');

                 $.get(BASE_URL + '/seo/blogs/ajax-category-get/' + id, function(res) {

                     $('#categoryId').val(res.id);
                     $('#categoryName').val(res.title);

                     // 🔥 Reset select2 properly
                     $('#categorySelect').empty().trigger('change');
                     console.log("RESP", res);
                     if (res.parent_id && res.parent) {
                         let option = new Option(res.parent.title, res.parent_id, true, true);
                         $('#categorySelect').append(option).trigger('change');
                     } else {
                         // Important: add default empty option
                         let option = new Option('No Parent', 0, true, true);
                         $('#categorySelect').append(option).trigger('change');
                     }

                     $('#addEditCategoryLabel').text('Edit Category');
                     $('#addEditCategory').modal('show');
                 });
             });
             $('#addEditCategory').on('hidden.bs.modal', function() {
                 $('#categoryId').val('');
                 $('#categoryName').val('');
                 $('#categorySelect').val(null).trigger('change');
                 $('#categoryImage').val('');
                 $('#addEditCategoryLabel').text('Add Category');
             });

             $(document).on('click', '.btn-delete', function() {

                 let id = $(this).data('id');

                 Swal.fire({
                     title: 'Are you sure?',
                     text: "This category will be deleted!",
                     icon: 'warning',
                     showCancelButton: true,
                     confirmButtonColor: '#d33',
                     cancelButtonColor: '#6c757d',
                     confirmButtonText: 'Yes, delete it!'
                 }).then((result) => {

                     if (result.isConfirmed) {

                         $.ajax({
                             url: BASE_URL + '/seo/blogs/ajax-category-delete/' + id,
                             type: 'DELETE',
                             headers: {
                                 'X-CSRF-TOKEN': '{{ csrf_token() }}'
                             },
                             success: function(response) {
                                 if (response.status) {
                                     Swal.fire('Deleted!', response.message, 'success');
                                     location.reload();
                                 } else {
                                     Swal.fire('Error!', response.message, 'error');
                                 }
                             },
                             error: function(xhr) {
                                 console.log(xhr.responseText);
                             }
                         });

                     }
                 });
             });
         </script>
     @endpush
 </x-app>
