<x-app>
    <div class="container-fluid">
        <div class="card card-shadow mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="fs-3">Manage Pages</h3>
                    </div>
                    <div class="d-flex gap-3">
                        <a href="{{ route('cards.index') }}">
                            <button class="btn btn-secondary">
                                <i class="ti ti-list"></i>
                                Manage Cards
                            </button>
                        </a>
                        <a href="{{ route('pages.create') }}">
                            <button class="btn btn-primary">
                                <i class="ti ti-plus"></i>
                                Add Page
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-shadow">
            <x-alert />
            <div class="card-body">
                <form action="" method="get">
                    <div class="row mb-3">
                        <div class="col-md-5">
                            <div class="input-group">
                                <input type="text" name="q" class="form-control" placeholder="Search"
                                    value="{{ request('q') }}">

                                <select name="status" class="form-select">
                                    <option value="">Select Status</option>

                                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>
                                        Active
                                    </option>

                                    <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>
                                        Draft
                                    </option>

                                    <option value="3" {{ request('status') == '3' ? 'selected' : '' }}>
                                        Inactive
                                    </option>
                                </select>

                                <button class="btn btn-primary" type="submit">
                                    Filter
                                </button>

                                <a href="{{ route('pages.index') }}" class="btn btn-secondary">
                                    Reset
                                </a>
                            </div>

                        </div>

                    </div>
                </form>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <td>#Id</td>
                                <td>Title</td>
                                <td>Slug</td>
                                <td>Status</td>
                                <td>Created At</td>
                                <td>Action</td>
                            </thead>
                            <tbody>
                                @forelse ($pages as $page)
                                    <tr>
                                        <td> {{ $page->id }} </td>
                                        <td> {{ $page->title }} </td>
                                        <td> {{ $page->slug }} </td>
                                        <td>
                                            @if ($page->status == 1)
                                                <span class="badge bg-success"> Active </span>
                                            @elseif($page->status == 2)
                                                <span class="badge bg-warning">Draft</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td> {{ $page->created_at }} </td>
                                        <td>
                                            <div class="d-flex gap-2">

                                                <a href="{{ route('pages.edit', $page->id) }}"><button
                                                        class="btn btn-sm btn-warning" title="Edit"> <i
                                                            class="ti ti-edit"></i>
                                                    </button></a>
                                                <a href="javascript:void(0);"
                                                    class="btn btn-sm btn-danger btn-delete-page"
                                                    data-url="{{ route('pages.delete', $page->id) }}" title="Delete">
                                                    <i class="ti ti-trash"></i>
                                                </a>
                                                <a href="{{ route('pages.clone', $page->id) }}">
                                                    <button class="btn btn-sm btn-info" title="Clone"> <i
                                                            class="ti ti-copy"></i>
                                                    </button>
                                                </a>
                                                <a href="{{ url("$page->slug") }}" target="_blank">
                                                    <button class="btn btn-sm btn-success" title="View"> <i
                                                            class="ti ti-eye"></i>
                                                    </button>
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
                                                                data-id="{{ $page->id }}" data-status="1">
                                                                Active
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item change-status"
                                                                href="javascript:void(0);"
                                                                data-id="{{ $page->id }}" data-status="2">
                                                                Draft
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item change-status"
                                                                href="javascript:void(0);"
                                                                data-id="{{ $page->id }}" data-status="0">
                                                                Inactive
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No Pages Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).on('click', '.btn-delete-page', function() {
                let url = $(this).data('url');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This page will be deleted permanently!",
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
                    url: "{{ route('pages.status.change') }}",
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
