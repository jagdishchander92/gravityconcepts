 <x-app>
     <div class="container-fluid">
         <div class="card card-shadow  mb-3">
             <div class="card-body">
                 <div class="d-flex justify-content-between mb-4">
                     <div>
                         <h3 class="fs-3">Custom codes</h3>
                         <p></p>
                     </div>

                 </div>
                 <form action="{{ route('admin.custom_codes.store_update', $customCode->id ?? null) }}" method="POST">
                     @csrf

                     <div class="row mb-3">
                         <div class="col-md-12">
                             <div class="form-group mb-3">
                                 <label class="form-label">Select Code Type</label>

                                 <select name="type" class="form-select">
                                     <option value="">Select Code Type</option>

                                     <option value="header"
                                         {{ old('type', $customCode->type ?? '') == 'header' ? 'selected' : '' }}>
                                         Header
                                     </option>

                                     <option value="footer"
                                         {{ old('type', $customCode->type ?? '') == 'footer' ? 'selected' : '' }}>
                                         Footer
                                     </option>
                                 </select>

                                 @error('type')
                                     <small class="text-danger">{{ $message }}</small>
                                 @enderror
                             </div>
                         </div>

                         <div class="col-md-12">
                             <div class="form-group mb-3">
                                 <label class="form-label">Custom Code</label>

                                 <textarea name="codes" cols="30" rows="15" class="form-control">{{ old('codes', $customCode->codes ?? '') }}</textarea>

                                 @error('codes')
                                     <small class="text-danger">{{ $message }}</small>
                                 @enderror
                             </div>
                         </div>

                         <div class="col-md-12">
                             <div class="d-flex justify-content-end">
                                 <button type="submit" class="btn btn-success">
                                     {{ isset($customCode) ? 'Update' : 'Save' }}
                                 </button>
                             </div>
                         </div>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </x-app>
