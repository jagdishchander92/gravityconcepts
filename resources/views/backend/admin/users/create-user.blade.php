<x-app>
    <div class="container-fluid">
        <div class="card card-shadow mb-4">
            <div class="card-body">

                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h3 class="fs-3">Create User</h3>
                            </div>
                            <div>
                                <a href="{{ route('admin.user-index') }}">
                                    <button class="btn btn-primary">
                                        <i class="ti ti-users"></i>
                                        Users
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <form action="{{ $user ? route('admin.user-update', $user->id) : route('admin.user-store') }}"
                            method="POST">
                            @if ($user)
                                @method('PUT')
                            @endif
                            @csrf()

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="name" class="form-label">Full Name <strong
                                                class="text-danger ">*</strong> </label>
                                        <input type="text" name="name" class="form-control"
                                            placeholder="Full Name *" id="name"
                                            value="{{ old('name', $user ? $user->name : '') }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="username" class="form-label">Username <strong
                                                class="text-danger ">*</strong> </label>
                                        <input type="text" name="username" class="form-control"
                                            placeholder="Username *" id="username"
                                            value="{{ old('username', $user ? $user->username : '') }}">
                                        @error('username')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="email" class="form-label">Email <strong
                                                class="text-danger ">*</strong> </label>
                                        <input type="email" name="email" id="email" placeholder="Email *"
                                            class="form-control" value="{{ old('email', $user ? $user->email : '') }}">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="role_select" class="form-label">Role <strong
                                                class="text-danger ">*</strong> </label>
                                        <select name="role_id" id="role_select" class="form-select">
                                            <option value="">Select Role *</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}"
                                                    {{ $user ? ($user->role_id == $role->id ? 'selected' : '') : '' }}>
                                                    {{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('role_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Password  @if (!$user)<strong
                                                class="text-danger">*</strong>@endif</label>
                                        <div class="input-group">
                                            <input type="password" name="password" id="password" class="form-control">

                                            <span class="input-group-text toggle-password" data-target="password"
                                                style="cursor:pointer;">
                                                <i class="ti ti-eye"></i>
                                            </span>
                                        </div>
                                        @if ($user)
                                            <div class="form-text" >Leave password blank if you don't want to change it.</div>
                                        @endif
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Confirm Password @if (!$user)<strong
                                                class="text-danger">*</strong>@endif</label>

                                        <div class="input-group">
                                            <input type="password" name="password_confirmation"
                                                id="password_confirmation" class="form-control">

                                            <span class="input-group-text toggle-password"
                                                data-target="password_confirmation" style="cursor:pointer;">
                                                <i class="ti ti-eye"></i>
                                            </span>
                                        </div>
                                        @error('password_confirmation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="image" class="form-label">Image</label>
                                        <input type="file" name="image" id="image" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-end align-items-end h-100">
                                        <button class="btn btn-success text-white"> Sumbit </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).on('click', '.toggle-password', function() {

                let inputId = $(this).data('target');
                let input = $('#' + inputId);
                let icon = $(this).find('i');

                if (input.attr('type') === 'password') {
                    input.attr('type', 'text');
                    icon.removeClass('ti-eye').addClass('ti-eye-off');
                } else {
                    input.attr('type', 'password');
                    icon.removeClass('ti-eye-off').addClass('ti-eye');
                }

            });
        </script>
    @endpush
</x-app>
