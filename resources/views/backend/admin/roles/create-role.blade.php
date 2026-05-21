<x-app>
    <div class="container-fluid">
        <div class="card card-shadow mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="fs-3">Create/Update Role</h3>
                    </div>
                    <div>
                        <a href="{{ route('admin.roles-index') }}">
                            <button class="btn btn-primary">
                                <i class="ti ti-list"></i>
                                Roles
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('admin.role-store') }}" method="POST">
                            @csrf()

                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" name="name" id="name"
                                            value="{{ old('name', $role ? $role->name : '') }}" class="form-control">
                                        @error('name')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">

                                    <div class="d-flex align-items-end h-100">
                                        <button class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app>
