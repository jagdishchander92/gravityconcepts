@props([
    'show_side_bar' => true,
])
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title> Backend - Gravity concepts</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('backend/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tabler-icons/3.35.0/tabler-icons.min.css"
        integrity="sha512-gzw5zNP2TRq+DKyAqZfDclaTG4dOrGJrwob2Fc8xwcJPDPVij0HowLIMZ8c1NefFM0OZZYUUUNoPfcoI5jqudw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/dm-file-uploader@1.0.2/dist/css/jquery.dm-uploader.min.css"
        rel="stylesheet">
    <link href="{{ asset('backend/lib/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/lib/select2-bootstrap-5-theme-master/dist/select2-bootstrap-5-theme.min.css') }}"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/lib/sweetalert2/dist/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/lib/flatpickr/dist/flatpickr.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/fontawesome-iconpicker/3.2.0/css/fontawesome-iconpicker.min.css" />

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/lib/grapesjs/dist/css/grapes.min.css') }}">
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        .content.fully {
            margin-left: unset;
            padding-top: 1rem !important;
        }

        .topbar.fully {
            margin-left: unset;
        }
    </style>
    @stack('styles')
</head>

<body>
    <div id="overlay" class="overlay"></div>
    @if ($show_side_bar)
        <nav id="topbar"
            class="navbar bg-white border-bottom fixed-top topbar px-3 {{ !$show_side_bar ? 'fully' : '' }}">
            <button id="toggleBtn" class="d-none d-lg-inline-flex btn btn-light btn-icon btn-sm ">
                <i class="ti ti-layout-sidebar-left-expand"></i>
            </button>


            <button id="mobileBtn" class="btn btn-light btn-icon btn-sm d-lg-none me-2">
                <i class="ti ti-layout-sidebar-left-expand"></i>
            </button>
            <div>

                <ul class="list-unstyled d-flex align-items-center mb-0 gap-1">
                    @if (auth()->user()->can('generate-sitemap'))
                        <li>
                            <a href="{{ url('/backend/seo/generate-sitemap') }}" class="btn btn-sm btn-primary"><i
                                    class="ti ti-sitemap"></i> Generate Sitemap </a>
                        </li>
                    @endif
                    <li>
                        <a href="{{ url('/') }}" target="_blank" class="btn btn-sm btn-primary"><i
                                class="ti ti-eye"></i> View Website </a>
                    </li>

                    <li class="ms-3 dropdown">
                        <a href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('backend/images/avatar/user.png') }}" alt=""
                                class="avatar avatar-sm rounded-circle" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-end p-0" style="min-width: 200px;">
                            <div>
                                <div class="d-flex gap-3 align-items-center border-dashed border-bottom px-3 py-3">
                                    <img src="{{ asset('backend/images/avatar/user.png') }}" alt=""
                                        class="avatar avatar-md rounded-circle" />
                                    <a href="{{ url('/backend/profile') }}">
                                        <div>
                                            <h4 class="mb-0 small">{{ auth()->user()->name }}</h4>
                                            <p class="mb-0  small">{{ auth()->user()->email }}</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="p-3 d-flex flex-column gap-1 small lh-lg">
                                    <a href="{{ route('backend.logout') }}" class="d-flex align-items-center">
                                        <i class="ti ti-power fs-4 mr-2"></i> <span> Log Out</span>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </li>
                </ul>
            </div>

        </nav>

        <aside id="sidebar" class="sidebar">
            <div class="logo-area">
                {{-- <span class="logo-text logo-collasped ms-2">
                <img src="{{ asset('backend/images/gravity-it-solutions-logo.png') }}" alt="" width="140">
            </span>
            <span class="logo-text ms-2">
                <img src="{{ asset('backend/images/gravity-it-solutions-logo.png') }}" alt="" width="140">
            </span> --}}

                <a href="index.html" class="d-inline-flex">
                    <img class="logo-favicon" src="{{ asset('backend/images/gravity-it-solutions-favicon.png') }}"
                        alt="" width="24">
                    <span class="logo-text ms-2">
                        <img src="{{ asset('backend/images/gravity-it-solutions-logo.png') }}" alt=""
                            width="140">
                    </span>
                </a>

            </div>
            <ul class="nav flex-column mt-2">
                @foreach (config('menu.menu.main_menu') as $parentName => $parent)
                    @php
                        // 1. Filter items based on permissions
                        $filteredItems = array_filter($parent['items'], function ($item) {
                            return auth()->user()->can($item['permission']);
                        });

                        $itemCount = count($filteredItems);
                        if ($itemCount === 0) {
                            continue;
                        }

                        // 2. Determine active state
                        $isActive = false;
                        foreach ($filteredItems as $item) {
                            if (Route::is($item['route'])) {
                                $isActive = true;
                                break;
                            }
                        }

                        $id = Str::slug($parentName);
                    @endphp

                    {{-- CASE 1: Single Item (Clickable Link, No Dropdown) --}}
                    @if ($itemCount === 1)
                        @php $singleItem = reset($filteredItems); @endphp
                        <li>
                            @php /** @var string $routeName */ $routeName = $singleItem['route']; @endphp
                            <a class="nav-link d-flex align-items-center gap-2 {{ $isActive ? 'active ' . 'text-primary' : '' }}"
                                href="{{ route($routeName) }}">
                                <i class="ti {{ $parent['icon'] }}"></i>
                                <span class="nav-text">{{ $parentName }}</span>
                            </a>
                        </li>

                        {{-- CASE 2: Multiple Items (Render Dropdown) --}}
                    @else
                        <li>
                            <a class="nav-link d-flex justify-content-between align-items-center {{ $isActive ? '' : 'collapsed' }}"
                                data-bs-toggle="collapse" href="#menu-{{ $id }}" role="button"
                                aria-expanded="{{ $isActive ? 'true' : 'false' }}">
                                <span class="d-flex align-items-center gap-2">
                                    <i class="ti {{ $parent['icon'] }}"></i>
                                    <span class="nav-text">{{ $parentName }}</span>
                                </span>
                                <i class="ti ti-chevron-right menu-arrow"></i>
                            </a>

                            <div class="collapse {{ $isActive ? 'show' : '' }}" id="menu-{{ $id }}">
                                <ul class="nav flex-column ps-3"> {{-- Added ps-3 for indentation --}}
                                    @foreach ($filteredItems as $subItem)
                                        <li>
                                            @php /** @var string $routeName */ $routeName = $subItem['route']; @endphp
                                            <a class="nav-link py-2 my-1 {{ Route::is($routeName) ? 'active text-primary' : '' }}"
                                                href="{{ route($routeName) }}">
                                                <i class="ti ti-{{ $subItem['icon'] }}"></i>
                                                <small class="nav-text">{{ $subItem['title'] }}</small>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
        </aside>
    @endif
    <main id="content" class="content py-10 {{ !$show_side_bar ? 'fully' : '' }}">
        <div class="container-fluid">
            {{ $slot }}
        </div>
    </main>

    <script src="{{ asset('backend/lib/grapesjs/dist/grapes.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="{{ asset('backend/js/sidebar.js') }}"></script>
    <script src="{{ asset('backend/lib/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('backend/lib/select2/dist/js/select2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/dm-file-uploader@1.0.2/dist/js/jquery.dm-uploader.min.js"></script>
    <script src="{{ asset('backend/lib/flatpickr/dist/flatpickr.min.js') }}"></script>

    <script src="{{ asset('backend/lib/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fontawesome-iconpicker/3.2.0/js/fontawesome-iconpicker.min.js">
    </script>

    <script>
        const BASE_URL = '{{ url('backend/') }}';
        const CSRF_TOKEN = '{{ csrf_token() }}';
        tinymce.init({
            selector: '.tinyMceEditor',
            height: 400,
            license_key: 'gpl',

            plugins: 'image link media table code lists',

            toolbar: `
                undo redo | formatselect |
                bold italic underline |
                alignleft aligncenter alignright alignjustify |
                bullist numlist |
                image media link |
                code`,

            automatic_uploads: true,
            file_picker_types: 'image',

            file_picker_callback: function(callback, value, meta) {
                let input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');

                input.onchange = function() {
                    let file = this.files[0];
                    let formData = new FormData();
                    formData.append('file', file);

                    fetch("{{ route('tinymce.upload') }}", {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: formData
                        })
                        .then(response => response.json())
                        .then(result => {
                            callback(result.location); // important
                        })
                        .catch(() => {
                            alert('Upload failed');
                        });
                };

                input.click();
            }
        });
    </script>

    @stack('scripts')

</body>

</html>
