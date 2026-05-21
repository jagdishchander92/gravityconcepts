 <x-app>
     <div class="container-fluid">
         <div class="card card-shadow  mb-3">
             <div class="card-body">
                 <div class="d-flex justify-content-between mb-4">
                     <div>
                         <h3 class="fs-3"> Contact Form Submission</h3>
                         <p></p>
                     </div>
                 </div>
                 <div class="row mb-3">
                     <div class="col-md-3">
                         <form action="{{ route('admin.contacts') }}" method="get">
                             <div class="input-group">
                                 <input type="text" value="{{ request('q') }}" name="q" class="form-control"
                                     placeholder="Search">
                                 <button class="btn btn-outline-success">
                                     <i class="ti ti-search"></i>
                                 </button>
                             </div>
                         </form>
                     </div>
                 </div>
                 <div class="table-responsive">
                     <table class="table table-bordered table-hover table-striped">
                         <thead>
                             <td>#Id</td>
                             <td>Name</td>
                             <td>Email</td>
                             <td>Phone</td>
                             <td>Subject</td>
                             <td>Message</td>
                             <td>Created At</td>
                         </thead>
                         <tbody>
                             @forelse ($contacts as $contact)
                                 <tr>
                                     <td> {{ $contact->id }} </td>
                                     <td> {{ $contact->name }} </td>
                                     <td> {{ $contact->email }} </td>
                                     <td> {{ $contact->phone }} </td>
                                     <td> {{ $contact->subject }} </td>
                                     <td> {{ $contact->message }} </td>
                                     <td> {{ $contact->created_at->format('Y-m-d') }} </td>
                                 </tr>
                             @empty
                                 <tr>
                                     <td colspan="7" class="text-center">No Data Found</td>
                                 </tr>
                             @endforelse
                         </tbody>
                     </table>
                     <div class="row mt-3">
                         {{ $contacts->links() }}
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </x-app>
