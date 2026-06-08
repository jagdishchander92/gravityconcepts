 <x-app>
     <div class="container-fluid">
         <div class="card card-shadow  mb-3">
             <div class="card-body">
                 <div class="d-flex justify-content-between mb-4">
                     <div>
                         <h3 class="fs-3">Custom codes</h3>
                         <p></p>
                     </div>
                     <div>
                         <a href="{{ route('admin.custom_codes.create') }}">
                             <button class="btn btn-sm btn-primary">+ Add Code
                             </button>
                         </a>
                     </div>
                 </div>
                 <div class="table-responsive">
                      <x-alert/>
                     <table class="table table-bordered table-hover table-striped">
                         <thead>
                             <td>#Id</td>
                             <td>Type</td>
                             <td>Codes</td>
                             <td>Created At</td>
                             <td>Action</td>
                         </thead>
                         <tbody>
                             @forelse ($custom_codes as $code)
                                 <tr>
                                     <td> {{ $code->id }} </td>
                                     <td> {{ $code->type }} </td>
                                     <td> {{ $code->codes }} </td>
                                     <td> {{ $code->created_at->format('Y-m-d') }} </td>
                                     <td>
                                         <div class="d-flex">
                                             <a href="{{ route('admin.custom_codes.edit', $code->id) }}">
                                                 <button class="btn btn-sm btn-warning">
                                                     <i class="ti ti-edit"></i>
                                                 </button>
                                             </a>
                                         </div>
                                     </td>
                                 </tr>
                             @empty
                                 <tr>
                                     <td colspan="7" class="text-center">No Data Found</td>
                                 </tr>
                             @endforelse
                         </tbody>
                     </table>
                     <div class="row mt-3">
                         {{ $custom_codes->links() }}
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </x-app>
