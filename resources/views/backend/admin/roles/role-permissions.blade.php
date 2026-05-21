<x-app>
    <div class="container-fluid mt-4">
        <x-alert/>

        <form action="{{ route('admin.role-permissions-update', $role->id) }}" method="POST">
            @csrf
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold">Role Permissions</h3>
                    <p class="text-muted">Setting permissions for: <span
                            class="badge bg-primary-subtle text-primary">{{ $role->name }}</span></p>
                </div>
                <button type="submit" class="btn btn-primary px-4 shadow-sm">
                    <i class="ti ti-device-floppy me-1"></i> Save Permissions
                </button>
            </div>

            <div class="row">
                {{-- Group permissions by the first part of their name --}}
                @foreach ($permissions->groupBy(fn($p) => explode('-', $p->name)[0]) as $module => $group)
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div
                                class="card-header bg-white border-bottom-0 pt-3 d-flex justify-content-between align-items-center">
                                <h6 class="text-uppercase fw-bold text-secondary mb-0"
                                    style="font-size: 0.75rem; letter-spacing: 1px;">
                                    <i class="ti ti-folder me-1"></i> {{ $module }} Management
                                </h6>
                                <div class="form-check form-switch mb-0">
                                    <input class="form-check-input select-all-module" type="checkbox" role="switch"
                                        title="Select All">
                                </div>
                            </div>
                            <div class="card-body">
                                @foreach ($group as $permission)
                                    <div class="d-flex justify-content-between align-items-center py-2 mb-1">
                                        <label class="form-check-label text-dark" for="perm-{{ $permission->id }}">
                                            {{-- Removes the module prefix for a cleaner look --}}
                                            {{ ucwords(str_replace(['-', '_'], ' ', str_replace($module . '-', '', $permission->name))) }}
                                        </label>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input permission-checkbox" type="checkbox"
                                                name="permissions[]" value="{{ $permission->name }}"
                                                id="perm-{{ $permission->id }}"
                                                {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </form>
    </div>
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Select/Deselect all in a specific card
                document.querySelectorAll('.select-all-module').forEach(toggle => {
                    toggle.addEventListener('change', function() {
                        const card = this.closest('.card');
                        const checkboxes = card.querySelectorAll('.permission-checkbox');
                        checkboxes.forEach(cb => {
                            cb.checked = this.checked;
                        });
                    });
                });

                // Optional: Auto-check the "Select All" toggle if all checkboxes in card are checked manually
                document.querySelectorAll('.permission-checkbox').forEach(cb => {
                    cb.addEventListener('change', function() {
                        const card = this.closest('.card');
                        const allInCard = card.querySelectorAll('.permission-checkbox');
                        const checkedInCard = card.querySelectorAll('.permission-checkbox:checked');
                        const masterToggle = card.querySelector('.select-all-module');

                        masterToggle.checked = (allInCard.length === checkedInCard.length);
                    });
                });
            });
        </script>
    @endpush
</x-app>
