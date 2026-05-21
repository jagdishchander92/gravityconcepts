 <x-app>

     <div class="card card-shadow">
         <div class="card-body">
             <div class="row">
                 <div class="col-12">
                     <div class="mb-6">
                         <h1 class="fs-3 mb-1">Comments</h1>
                         <p></p>
                     </div>
                 </div>
             </div>

             <div class="row">

                 <div class="row">
                     <div class="col-md-3">
                         <form action="{{ route('seo.blogs.comments') }}" method="get">
                             <div class="input-group mb-3">
                                 <select name="status" class="form-select">
                                     <option value="">Select Status</option>
                                     <option value="0"
                                         {{ isset($_GET['status']) && $_GET['status'] == 0 ? 'selected' : '' }}>
                                         Pending</option>
                                     <option value="1"
                                         {{ isset($_GET['status']) && $_GET['status'] == 1 ? 'selected' : '' }}>Approved
                                     </option>
                                     <option value="2"
                                         {{ isset($_GET['status']) && $_GET['status'] == 2 ? 'selected' : '' }}>
                                         Disapproved
                                     </option>
                                 </select>
                                 <button class="btn btn-outline-success" type="submit"
                                     id="button-addon2">Button</button>
                             </div>
                         </form>
                     </div>
                 </div>
                 <div class="table-responsive">
                     <table class="table table-bordered table-hover table-striped">
                         <thead>
                             <td>
                                 Id
                             </td>
                             <td>
                                 Name
                             </td>
                             <td>
                                 Email
                             </td>
                             <td>
                                 Phone
                             </td>
                             <td>
                                 City
                             </td>
                             <td>
                                 Comment
                             </td>
                             <td>
                                 Post
                             </td>
                             <td>
                                 Date
                             </td>
                             <td>
                                 Status
                             </td>
                             <td>
                                 Options
                             </td>
                         </thead>
                         <tbody>
                             @forelse ($comments as $comment)
                                 <tr>
                                     <td>
                                         {{ $comment->id }}
                                     </td>
                                     <td>
                                         {{ $comment->name }}
                                     </td>
                                     <td>
                                         {{ $comment->email }}
                                     </td>
                                     <td>
                                         {{ $comment->phone }}
                                     </td>
                                     <td>
                                         {{ $comment->address }}
                                     </td>
                                     <td>
                                         {{ $comment->message }}
                                     </td>
                                     <td>
                                         {{ $comment->blog?->title }}
                                     </td>
                                     <td>
                                         {{ $comment->created_at }}
                                     </td>
                                     <td>
                                         @php
                                             echo match ($comment->status) {
                                                 0 => 'Pending',
                                                 1 => 'Approved',
                                                 2 => 'Disapproved',
                                                 default => '-',
                                             };
                                         @endphp
                                     </td>
                                     <td>
                                         @if ($comment->status == 0)
                                             <button class="btn btn-sm btn-success btn-approve"
                                                 data-id="{{ $comment->id }}">
                                                 <i class="ti ti-checks"></i>
                                             </button>
                                             <button class="btn btn-sm btn-danger btn-disapprove"
                                                 data-id="{{ $comment->id }}">
                                                 <i class="ti ti-ban"></i>
                                             </button>
                                         @elseif($comment->status == 1)
                                             <button class="btn btn-sm btn-danger btn-disapprove"
                                                 data-id="{{ $comment->id }}">
                                                 <i class="ti ti-ban"></i>
                                             </button>
                                         @elseif($comment->status == 2)
                                             <button class="btn btn-sm btn-success btn-approve"
                                                 data-id="{{ $comment->id }}">
                                                 <i class="ti ti-checks"></i>
                                             </button>
                                         @else
                                         @endif
                                     </td>

                                 </tr>
                             @empty
                                 <tr>
                                     <td colspan="10" class="text-center">No Comments Found</td>
                                 </tr>
                             @endforelse
                         </tbody>
                     </table>
                     <div class="row mt-3">
                         {{ $comments->links() }}
                     </div>
                 </div>
             </div>
         </div>
     </div>
     @push('scripts')
         <script>
             $(document).on('click', '.btn-approve', function() {
                 let id = $(this).data('id');

                 Swal.fire({
                     title: 'Are you sure?',
                     text: "You want to approve this comment?",
                     icon: 'warning',
                     showCancelButton: true,
                     confirmButtonText: 'Yes, approve it!',
                     cancelButtonText: 'No'
                 }).then((result) => {
                     if (result.isConfirmed) {
                         changeStatus(id, 1);
                     }
                 });
             });

             $(document).on('click', '.btn-disapprove', function() {
                 let id = $(this).data('id');

                 Swal.fire({
                     title: 'Are you sure?',
                     text: "You want to disapprove this comment?",
                     icon: 'warning',
                     showCancelButton: true,
                     confirmButtonText: 'Yes, disapprove it!',
                     cancelButtonText: 'No'
                 }).then((result) => {
                     if (result.isConfirmed) {
                         changeStatus(id, 0);
                     }
                 });
             });

             function changeStatus(comment_id, status) {
                 let formData = new FormData();
                 formData.append('status', status);
                 formData.append('comment_id', comment_id);
                 formData.append('_token', '{{ csrf_token() }}');

                 $.ajax({
                     url: '{{ route('seo.blogs.comments.status') }}',
                     method: "POST",
                     data: formData,
                     processData: false,
                     contentType: false,
                     success: function(response) {
                         if (response.status == 1) {
                             Swal.fire({
                                 'icon': 'success',
                                 'title': 'Success',
                                 'text': response.message
                             }).then(() => {
                                 location.reload()
                             })
                         } else {
                             Swal.fire({
                                 'icon': 'error',
                                 'title': 'Error',
                                 'text': response.message
                             })
                         }
                     },
                     error: function(xhr) {
                         Swal.fire({
                             'icon': 'error',
                             'title': 'Internal Server Error',
                             'text': xhr.responseText
                         })
                     }
                 });
             }
         </script>
     @endpush
 </x-app>
