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
                             <form action="{{ route('seo.blogs.index') }}" method="get">
                                 <div class="input-group">
                                     <input type="text" name="q"
                                         value="{{ isset($_GET['q']) ? $_GET['q'] : '' }}" class="form-control"
                                         placeholder="Search">
                                     <button class="btn btn-outline-success" type="submit"
                                         id="button-addon2">Search</button>
                                 </div>
                             </form>
                         </div>
                         <div class="col-md-6">

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
                                     Action
                                 </td>
                             </thead>
                             <tbody>
                                 @foreach ($blogs as $blog)
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
                                                 <span class="badge bg-warning">Draft</span>
                                             @else
                                                 <span class="badge bg-warning">In Active</span>
                                             @endif
                                         </td>
                                         <td>{{ $blog->created_at }}</td>
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
         </script>
     @endpush
 </x-app>
