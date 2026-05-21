<x-app>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.css">

    <div class="container py-5">
        <form action="{{ $menu ? route('menus.update', $menu->id) : route('menus.store') }}" method="POST" id="menu-form">
            @csrf

            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-dark text-white">
                            <h5 class="mb-0">Menu Details</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Menu Name<span class="text-danger fw-bold">*</span></label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ $menu ? $menu->name : '' }}" placeholder="e.g. Main Header" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Display Location (Type)<span class="text-danger fw-bold">*</span></label>
                                <select name="type" class="form-select" required>
                                    <option value="header" {{ $menu && $menu->type == 'header' ? 'selected' : '' }}>
                                        Header
                                    </option>
                                    <option value="footer" {{ $menu && $menu->type == 'footer' ? 'selected' : '' }}>
                                        Footer
                                    </option>
                                    <option value="sidebar" {{ $menu && $menu->type == 'sidebar' ? 'selected' : '' }}>
                                        Sidebar
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Add New Link</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Label<span class="text-danger fw-bold">*</span></label>
                                <input type="text" id="link-label" class="form-control" placeholder="Services">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">URL</label>
                                <input type="text" id="link-url" class="form-control" placeholder="/services">
                            </div>
                            <button type="button" onclick="addToMenu()" class="btn btn-primary w-100">Add to
                                List</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card shadow-sm">
                        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Menu Structure</h5>
                            <button type="submit" class="btn btn-success btn-sm px-4">Update Menu</button>
                        </div>
                        <div class="card-body">
                            <div class="dd" id="nestable">
                                <ol class="dd-list">
                                    @if ($menu && $menu->menu)
                                        @foreach ($menu->menu as $item)
                                            @include('backend.menus.menu-item', ['item' => $item])
                                        @endforeach
                                    @else
                                        <div class="text-muted text-center py-4" id="empty-msg">No items added yet.
                                        </div>
                                    @endif
                                </ol>
                            </div>

                            <input type="hidden" name="menu" id="nestable-output">
                        </div>
                        <div class="card-footer text-muted small">
                            Drag items horizontally to nest them (up to 3 levels deep).
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.js"></script>

        <script>
            $(document).ready(function() {
                // Initialize Nestable
                $('#nestable').nestable({
                    group: 1,
                    maxDepth: 3
                }).on('change', function() {
                    updateSerializedOutput();
                });

                // Set initial data
                updateSerializedOutput();
            });

            function updateSerializedOutput() {
                const data = $('#nestable').nestable('serialize');
                $('#nestable-output').val(JSON.stringify(data));
            }

            function addToMenu() {
                const label = $('#link-label').val();
                const url = $('#link-url').val();
                if (!label) {
                    Swal.fire({
                        'icon': 'warning',
                        'title': 'Label is required!',
                        'text': 'Please Provide a label'
                    });
                    
                    return;
                }

                $('#empty-msg').remove();

                const html = `
                    <li class="dd-item" data-label="${label}" data-url="${url}">
                        <button type="button" class="btn-remove-item" onclick="removeItem(this)">×</button>
                        <div class="dd-handle">
                            <strong>${label}</strong> <span class="text-muted ms-2 small">(${url})</span>
                        </div>
                    </li>`;

                $('#nestable > .dd-list').append(html);
                updateSerializedOutput();
                $('#link-label, #link-url').val('');
            }

            // Ensure the remove function refreshes the data
            function removeItem(btn) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This will remove the item and all its sub-menus!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545', // Danger color
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Perform the removal
                        $(btn).closest('li').fadeOut(300, function() {
                            $(this).remove();
                            updateSerializedOutput();
                        });

                        // Optional: Show a success toast/alert
                        Swal.fire(
                            'Deleted!',
                            'Menu item has been removed.',
                            'success'
                        );
                    }
                });
            }
        </script>
    @endpush

    @push('styles')
        <style>
            .dd-item {
                position: relative;
                margin-bottom: 8px;
            }

            .dd-handle {
                height: 45px;
                padding: 12px 15px;
                background: #f8f9fa;
                border: 1px solid #dee2e6;
                border-radius: 4px;
                cursor: grab;
                padding-right: 50px;

            }


            .dd-item>button {

                position: absolute !important;
                right: 0px !important;
                top: 0px !important;
                width: 30px !important;
                height: 30px !important;
                margin: 0 !important;
                padding: 0 !important;
                text-indent: 0 !important;
                overflow: visible !important;
                white-space: normal !important;
                background: #dc3545 !important;
                color: white !important;
                border: none !important;
                border-radius: 4px !important;
                font-size: 18px !important;
                line-height: 30px !important;
                cursor: pointer;
                z-index: 999;
                display: block !important;
            }

            .dd-item>button.btn-remove-item:hover {
                background: #a71d2a !important;
            }


            .dd-handle {
                padding-right: 45px;
            }

            .btn-remove-item:hover {
                background-color: #a71d2a;
            }

            .dd-handle:active {
                cursor: grabbing;
            }

            .dd-placeholder {
                background: #e9ecef;
                border: 1px dashed #ced4da;
                height: 45px;
                margin-bottom: 8px;
            }
        </style>
    @endpush
</x-app>
