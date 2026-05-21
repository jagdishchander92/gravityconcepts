<x-app>
<div class="container-fluid">
    <div class="card card-shadow  mb-3">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div>
                    <h3 class="fs-3">Manage Menus</h3>
                </div>
                <div>
                    <a href="{{ route('menus.create') }}">
                        <button class="btn btn-primary">
                            <i class="ti ti-plus"></i>
                            Add Menu
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
                                <td>Type</td>
                                <td>Created At</td>
                                <td>Action</td>
                            </thead>
                            <tbody>
                                @foreach ($menus as $menu)
                                    <tr>
                                        <td> {{ $menu->id }} </td>
                                        <td> {{ $menu->name }} </td>
                                        <td> {{ $menu->type }} </td>
                                        <td> {{ $menu->created_at }} </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('menus.edit', $menu->id) }}"><button
                                                        class="btn btn-sm btn-warning"> <i class="ti ti-edit"></i>
                                                    </button></a>
                                                {{-- <a href="javascript:void(0);"
                                                    class="btn btn-sm btn-danger btn-delete-blog"
                                                    data-url="{{ route('admin.role-delete', $role->id) }}">
                                                    <i class="ti ti-trash"></i>
                                                </a> --}}
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
</x-app>