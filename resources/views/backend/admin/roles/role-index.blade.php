<x-app>
    <div class="container-fluid">
        <div class="card card-shadow  mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="fs-3">Manage Roles</h3>
                    </div>
                    <div>
                        <a href="{{ route('admin.role-create') }}">
                            <button class="btn btn-primary">
                                <i class="ti ti-plus"></i>
                                Add Role
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-shadow">
            <div class="card-body">
                <div class="row">
                    <x-alert />
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <td>#Id</td>
                                    <td>Name</td>
                                    <td>Guard Name</td>
                                    <td>Created At</td>
                                    <td>Action</td>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td> {{ $role->id }} </td>
                                            <td> {{ $role->name }} </td>
                                            <td> {{ $role->guard_name }} </td>
                                            <td> {{ $role->created_at }} </td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('admin.role-permissions', $role->id) }}"
                                                        class="btn btn-sm btn-outline-primary"
                                                        title="Manage Permissions">
                                                        <i class="ti ti-shield-lock"></i>
                                                    </a>
                                                    <a href="{{ route('admin.role-edit', $role->id) }}"><button
                                                            class="btn btn-sm btn-warning"> <i class="ti ti-edit"></i>
                                                        </button></a>
                                                    <a href="javascript:void(0);"
                                                        class="btn btn-sm btn-danger btn-delete-blog"
                                                        data-url="{{ route('admin.role-delete', $role->id) }}">
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
    </div>
    @push('scripts')
        <script>
            $(document).on('click', '.btn-delete-blog', function() {
                let url = $(this).data('url');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This role will be deleted!",
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
