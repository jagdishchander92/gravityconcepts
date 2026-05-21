 <x-app>
     <div class="card card-shadow">
         <div class="card-body">
             <div class="row">
                 <div class="col-12">
                     <div class="mb-6 d-flex justify-content-between">
                         <h1 class="fs-3 mb-1">Testimonials</h1>
                         <a href="{{ route('admin.testimonials.create') }}"> <button
                                 class="btn btn-sm btn-primary">+Add</button></a>
                     </div>
                 </div>
                 <x-alert />
                 <div class="table-responsive">
                     <table class="table table-bordered table-hover table-striped">
                         <thead>
                             <td>
                                 #Id
                             </td>
                             <td>
                                 Name
                             </td>
                             <td>
                                 Image
                             </td>
                             <td>
                                 Rating
                             </td>
                             <td>
                                 Description
                             </td>
                             <td>
                                 Options
                             </td>
                         </thead>
                         <tbody>
                             @foreach ($testimonials as $testimonial)
                                 <tr>
                                     <td> {{ $testimonial->id }} </td>
                                     <td> {{ $testimonial->name }} </td>
                                     <td>
                                         <img src="{{ asset($testimonial->img) }}" class="img-fluid" width="100"
                                             height="100">
                                     </td>
                                     <td> {{ $testimonial->rating }} </td>
                                     <td> {{ $testimonial->description }} </td>
                                     <td>
                                         <div class="d-flex gap-2">
                                             <a href="{{ route('admin.testimonials.edit', $testimonial) }}">
                                                 <button class="btn btn-sm btn-warning">
                                                     <i class="ti ti-edit"></i>
                                                 </button>
                                             </a>
                                             <button class="btn btn-sm btn-danger  btn-delete-testimonial"
                                                 data-url="{{ route('admin.testimonials.delete', $testimonial->id) }}">
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
     @push('scripts')
         <script>
             $(document).on('click', '.btn-delete-testimonial', function() {
                 let url = $(this).data('url');
                 Swal.fire({
                     title: 'Are you sure?',
                     text: "This testimonial will be deleted permanently!",
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
