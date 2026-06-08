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
                         <div class="col-md-4">
                             <form action="{{ route('seo.blogs.index') }}" method="get">
                                 <div class="input-group">
                                     <input type="text" name="q"
                                         value="{{ isset($_GET['q']) ? $_GET['q'] : '' }}" class="form-control"
                                         placeholder="Search">
                                     <select name="category_id" class="form-select">
                                         <option value="">Select Category</option>
                                         @foreach ($categories as $category)
                                             <option value="{{ $category->id }}"> {{ $category->title }} </option>
                                         @endforeach
                                     </select>
                                     <button class="btn btn-outline-success" type="submit"
                                         id="button-addon2">Search</button>
                                 </div>
                             </form>
                         </div>
                         <div class="col-md-4">

                         </div>
                         <div class="col-md-4">
                             <div class="d-flex justify-content-end gap-2">
                                 <a href="{{ route('seo.blogs.categories') }}">
                                     <button class="btn btn-info"><i class="ti ti-list"></i>Manage Categories</button>
                                 </a>
                                 <a href="{{ route('seo.blogs.create') }}">
                                     <button class="btn btn-primary"><i class="ti ti-plus"></i>Add Post</button>
                                 </a>
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
                                     Post
                                 </td>
                                 <td>
                                     Category
                                 </td>
                                 <td>
                                     Status
                                 </td>
                                 <td>
                                     Created At
                                 </td>
                                 <td>
                                     Published At
                                 </td>
                                 <td>
                                     Action
                                 </td>
                             </thead>
                             <tbody>
                                 @forelse ($blogs as $blog)
                                     <tr>
                                         <td>
                                             {{ $blog->id }}
                                         </td>
                                         <td>
                                             <div class="d-flex gap-2 p-2">
                                                 <img src="{{ asset($blog->img) }}" alt="" class="img-fluid"
                                                     width="100">
                                                 <a target="_blank" href="{{ url('blog') . '/' . $blog->slug }}">
                                                     {{ $blog->title }}
                                                 </a>
                                             </div>
                                         </td>
                                         <td>
                                             {{ $blog->category->title }}
                                         </td>
                                         <td>
                                             @if ($blog->status == 1)
                                                 <span class="badge bg-success">Active</span>
                                             @elseif($blog->status == 2)
                                                 <span class="badge bg-info">Scheduled</span>
                                             @elseif($blog->status == 3)
                                                 <span class="badge bg-warning">Draft</span>
                                             @else
                                                 <span class="badge bg-danger">In Active</span>
                                             @endif
                                         </td>
                                         <td>{{ $blog->created_at }}</td>
                                         <td>
                                             @if ($blog->published_at)
                                                 {{ $blog->published_at }}
                                             @else
                                                 Not Published
                                             @endif
                                         </td>
                                         <td>
                                             <div class="d-flex gap-2">
                                                 <a href="{{ route('seo.blogs.edit', $blog->id) }}">
                                                     <button class="btn btn-sm btn-warning">
                                                         <i class="ti ti-edit"></i>
                                                     </button>
                                                 </a>
                                                 <a href="javascript:void(0);"
                                                     class="btn btn-sm btn-danger btn-delete-blog"
                                                     data-url="{{ route('seo.blogs.delete', $blog->id) }}">
                                                     <i class="ti ti-trash"></i>
                                                 </a>
                                                 <div class="btn-group">
                                                     <button type="button"
                                                         class="btn btn-sm btn-success dropdown-toggle"
                                                         data-bs-toggle="dropdown" aria-expanded="false">
                                                         Update Status
                                                     </button>

                                                     <ul class="dropdown-menu">
                                                         <li>
                                                             <a class="dropdown-item change-status"
                                                                 href="javascript:void(0);"
                                                                 data-id="{{ $blog->id }}" data-status="1">
                                                                 Active
                                                             </a>
                                                         </li>
                                                         <li>
                                                             <a class="dropdown-item change-status"
                                                                 href="javascript:void(0);"
                                                                 data-id="{{ $blog->id }}" data-status="0">
                                                                 Inactive
                                                             </a>
                                                         </li>
                                                         <li>
                                                             <a class="dropdown-item change-status"
                                                                 href="javascript:void(0);"
                                                                 data-id="{{ $blog->id }}" data-status="3">
                                                                 Draft
                                                             </a>
                                                         </li>
                                                     </ul>

                                                 </div>
                                             </div>
                                         </td>
                                     </tr>
                                 @empty
                                     <tr>
                                         <td colspan="7" class="text-center">No Blogs Found!</td>
                                     </tr>
                                 @endforelse
                             </tbody>
                         </table>

                     </div>
                     <div class="d-flex mt-3 justify-content-end">
                         {{ $blogs->links() }}
                     </div>
                 </div>
             </div>
         </div>
     </div>
     @push('scripts')
         <script>
             $(document).on('click', '.btn-delete-blog', function() {
                 let url = $(this).data('url');
                 Swal.fire({
                     title: 'Are you sure?',
                     text: "This blog will be deleted permanently!",
                     icon: 'warning',
                     showCancelButton: true,
                     confirmButtonColor: '#d33',
                     cancelButtonColor: '#3085d6',
                     confirmButtonText: 'Yes, delete it!'
                 }).then((result) => {
                     if (result.isConfirmed) {
                         window.location.href = url;
                     }
                 });
             });


             $(document).on('click', '.change-status', function() {
                 let id = $(this).data('id');
                 let status = $(this).data('status');

                 $.ajax({
                     url: "{{ route('seo.blogs.status.change') }}",
                     type: "POST",
                     data: {
                         _token: "{{ csrf_token() }}",
                         id: id,
                         status: status
                     },
                     success: function(res) {
                         if (res.success) {
                             Swal.fire({
                                 icon: 'success',
                                 title: 'Updated!',
                                 text: 'Status changed successfully',
                                 timer: 1200,
                                 showConfirmButton: false
                             }).then(() => {
                                 location.reload(); // or update badge dynamically
                             });
                         }
                     }
                 });
             });
         </script>
     @endpush
 </x-app>
