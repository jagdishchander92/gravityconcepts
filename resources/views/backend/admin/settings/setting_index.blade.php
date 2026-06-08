<x-app>

    <div class="card card-shadow mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div>
                    <h3 class="fs-3">Settings</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <x-alert />
        <div class="col-md-6 mb-3">
            {{-- <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-heading">Website Colors</h5>
                </div>
                <form action="{{ route('admin.settings.website-color.store') }}" method="post">
                    @csrf()
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Primary Color</label>
                                    <div class="color-picker-group">
                                        <div class="input-group align-items-center">
                                            <span class="input-group-text p-1">
                                                <span class="color-preview"></span>
                                            </span>
                                            <input type="color" class="color-input">
                                            <input type="text" name="primary_color" class="form-control color-hex"
                                                value="{{ $website_color['primary_color'] ?? '' }}"
                                                placeholder="#058283">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Secondary Color</label>
                                    <div class="color-picker-group">
                                        <div class="input-group align-items-center">
                                            <span class="input-group-text p-1">
                                                <span class="color-preview"></span>
                                            </span>
                                            <input type="color" class="color-input">
                                            <input type="text" name="secondary_color" class="form-control color-hex"
                                                value="{{ $website_color['secondary_color'] ?? '' }}"
                                                placeholder="#00a6a6">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Secondary Light Color</label>
                                    <div class="color-picker-group">
                                        <div class="input-group align-items-center">
                                            <span class="input-group-text p-1">
                                                <span class="color-preview"></span>
                                            </span>
                                            <input type="color" class="color-input">
                                            <input type="text" name="secondary_light_color"
                                                class="form-control color-hex"
                                                value="{{ $website_color['secondary_light_color'] ?? '' }}"
                                                placeholder="#00a6a6">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Top nav bar bg Color</label>
                                    <div class="color-picker-group">
                                        <div class="input-group align-items-center">
                                            <span class="input-group-text p-1">
                                                <span class="color-preview"></span>
                                            </span>
                                            <input type="color" class="color-input">
                                            <input type="text" name="top_nav_bar_bg_color"
                                                class="form-control color-hex"
                                                value="{{ $website_color['top_nav_bar_bg_color'] ?? '' }}"
                                                placeholder="#21333e">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Top nav bar sub bg Color</label>
                                    <div class="color-picker-group">
                                        <div class="input-group align-items-center">
                                            <span class="input-group-text p-1">
                                                <span class="color-preview"></span>
                                            </span>
                                            <input type="color" class="color-input">
                                            <input type="text" name="top_nav_bar_sub_bg_color"
                                                class="form-control color-hex"
                                                value="{{ $website_color['top_nav_bar_sub_bg_color'] ?? '' }}"
                                                placeholder="#21333e">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Top nav holder bg Color</label>
                                    <div class="color-picker-group">
                                        <div class="input-group align-items-center">
                                            <span class="input-group-text p-1">
                                                <span class="color-preview"></span>
                                            </span>
                                            <input type="color" class="color-input">
                                            <input type="text" name="top_nav_holder_bg_color"
                                                class="form-control color-hex"
                                                value="{{ $website_color['top_nav_holder_bg_color'] ?? '' }}"
                                                placeholder="#21333e">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Footer Bg Color</label>
                                    <div class="color-picker-group">
                                        <div class="input-group align-items-center">
                                            <span class="input-group-text p-1">
                                                <span class="color-preview"></span>
                                            </span>
                                            <input type="color" class="color-input">
                                            <input type="text" name="footer_bg_color"
                                                class="form-control color-hex"
                                                value="{{ $website_color['footer_bg_color'] ?? '' }}"
                                                placeholder="#21333e">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-sm btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div> --}}
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-heading">
                        Website Information
                    </h5>
                </div>
                <form action="{{ route('admin.settings.website_info_store') }}" method="POST">
                    @csrf()
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label class="form-label">Website Name</label>
                            <input type="text" name="web_name" placeholder="Eg. Gravity It Solution"
                                value="{{ $website_common_info['web_name'] ?? '' }}" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Website Short Desc</label>
                            <input type="text" name="web_short_desc" placeholder="Website Short Desc"
                                value="{{ $website_common_info['web_short_desc'] ?? '' }}" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" placeholder="Phone"
                                value="{{ $website_common_info['phone'] ?? '' }}" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" placeholder="Email"
                                value="{{ $website_common_info['email'] ?? '' }}" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Location</label>
                            <input type="text" name="location" placeholder="Location"
                                value="{{ $website_common_info['location'] ?? '' }}" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Map Iframe Url</label>
                            <input type="text" name="map_url" placeholder="Map Iframe Url"
                                value="{{ $website_common_info['map_url'] ?? '' }}" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Latitude</label>
                            <input type="text" name="map_lat" placeholder="Latitude"
                                value="{{ $website_common_info['map_lat'] ?? '' }}" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Longitude</label>
                            <input type="text" name="map_lng" placeholder="Longitude"
                                value="{{ $website_common_info['map_lng'] ?? '' }}" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Open Hours</label>
                            <input type="text" name="open_hours" placeholder="Eg. Mon - Sat - 9:00 AM - 6:00 PM"
                                value="{{ $website_common_info['open_hours'] ?? '' }}" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Footer Copyright Text</label>
                            <input type="text" name="footer_copy_right" placeholder="Footer Copyright Text"
                                value="{{ $website_common_info['footer_copy_right'] ?? '' }}" class="form-control">
                            <small class="form-text">Use Placeholder _yyyy_ to add dynamic year</small>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Footer About</label>
                            <textarea type="text" name="footer_about" rows="4" placeholder="Footer About" class="form-control">{{ $website_common_info['footer_about'] ?? '' }}</textarea>
                        </div>

                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-sm btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-heading">
                        Working Hours
                    </h5>
                </div>

                @php
                    $working_hours = \App\Models\Setting::where('key', 'working_hours')->first();
                    $working_hours = $working_hours ? json_decode($working_hours->value, true) : [];

                    $days = [
                        'monday' => 'Monday',
                        'tuesday' => 'Tuesday',
                        'wednesday' => 'Wednesday',
                        'thursday' => 'Thursday',
                        'friday' => 'Friday',
                        'saturday' => 'Saturday',
                        'sunday' => 'Sunday',
                    ];
                @endphp

                <form action="{{ route('admin.settings.working_hours_store') }}" method="POST">

                    @csrf()

                    <div class="card-body">

                        @foreach ($days as $key => $day)
                            @php
                                $data = $working_hours[$key] ?? [];
                            @endphp

                            <div class="border rounded p-3 mb-3">

                                <div class="row align-items-end">

                                    <div class="col-md-3 mb-3">
                                        <label class="form-label fw-bold">
                                            {{ $day }}
                                        </label>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">
                                            Opening Time
                                        </label>

                                        <input type="time" name="working_hours[{{ $key }}][open]"
                                            class="form-control" value="{{ $data['open'] ?? '' }}">
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">
                                            Closing Time
                                        </label>

                                        <input type="time" name="working_hours[{{ $key }}][close]"
                                            class="form-control" value="{{ $data['close'] ?? '' }}">
                                    </div>

                                    <div class="col-md-3 mb-3">

                                        <div class="form-check mt-4">

                                            <input class="form-check-input closed-checkbox" type="checkbox"
                                                name="working_hours[{{ $key }}][closed]" value="1"
                                                id="closed_{{ $key }}"
                                                {{ isset($data['closed']) && $data['closed'] ? 'checked' : '' }}>

                                            <label class="form-check-label" for="closed_{{ $key }}">
                                                Closed
                                            </label>

                                        </div>

                                    </div>

                                </div>

                            </div>
                        @endforeach

                    </div>

                    <div class="card-footer">
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-sm btn-success">
                                Save
                            </button>
                        </div>
                    </div>

                </form>
            </div>


          

        </div>
        <div class="col-md-6 mb-3">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-heading">Logo Setting</h5>
                </div>
                <form action="{{ route('admin.settings.logos-store') }}" enctype="multipart/form-data"
                    method="post">
                    <div class="card-body">
                        @csrf()
                        <div class="form-group mb-3">
                            <label for="" class="form-label">Favicon</label>
                            <input type="file" name="favicon" class="form-control">
                            @if (isset($website_logo_setting['favicon']) && $website_logo_setting['favicon'])
                                <img src="{{ asset($website_logo_setting['favicon']) }}" class="img-fluid mt-2"
                                    width="30">
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="form-label">Logo(Light)</label>
                            <input type="file" name="logo_light" class="form-control" id="">
                            @if (isset($website_logo_setting['logo_light']) && $website_logo_setting['logo_light'])
                                <img src="{{ asset($website_logo_setting['logo_light']) }}" class="img-fluid mt-2"
                                    width="200">
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="form-label">Logo(Dark)</label>
                            <input type="file" name="logo_dark" class="form-control" id="">
                            @if (isset($website_logo_setting['logo_dark']) && $website_logo_setting['logo_dark'])
                                <img src="{{ asset($website_logo_setting['logo_dark']) }}"
                                    class="img-fluid p-2 bg-dark mt-2" width="200">
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="form-label">Footer Bg Image</label>
                            <input type="file" name="footer_bg_image" class="form-control" id="footer_bg_image">
                            @if (isset($website_logo_setting['footer_bg_image']) && $website_logo_setting['footer_bg_image'])
                                <img src="{{ asset($website_logo_setting['footer_bg_image']) }}"
                                    class="img-fluid mt-2" width="200">
                            @endif
                        </div>

                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-sm btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-heading">
                        Social Media
                    </h5>
                </div>
                <form action="{{ route('admin.settings.social.update') }}" method="POST">
                    @csrf

                    <div class="card-body">

                        <!-- Facebook -->
                        <div class="form-group mb-3">
                            <div class="input-group">
                                <span class="input-group-text text-white" style="background:#1877F2">
                                    <i class="ti ti-brand-facebook"></i>
                                </span>
                                <input type="url" name="facebook" class="form-control"
                                    placeholder="Facebook URL" value="{{ $website_social_media['facebook'] ?? '' }}">
                            </div>
                        </div>

                        <!-- Instagram -->
                        <div class="form-group mb-3">
                            <div class="input-group">
                                <span class="input-group-text text-white" style="background:#E4405F">
                                    <i class="ti ti-brand-instagram"></i>
                                </span>
                                <input type="url" name="instagram" class="form-control"
                                    placeholder="Instagram URL"
                                    value="{{ $website_social_media['instagram'] ?? '' }}">
                            </div>
                        </div>

                        <!-- Twitter / X -->
                        <div class="form-group mb-3">
                            <div class="input-group">
                                <span class="input-group-text text-white" style="background:#000000">
                                    <i class="ti ti-brand-twitter"></i>
                                </span>
                                <input type="url" name="twitter" class="form-control"
                                    placeholder="Twitter / X URL"
                                    value="{{ $website_social_media['twitter'] ?? '' }}">
                            </div>
                        </div>

                        <!-- LinkedIn -->
                        <div class="form-group mb-3">
                            <div class="input-group">
                                <span class="input-group-text text-white" style="background:#0A66C2">
                                    <i class="ti ti-brand-linkedin"></i>
                                </span>
                                <input type="url" name="linkedin" class="form-control"
                                    placeholder="LinkedIn URL" value="{{ $website_social_media['linkedin'] ?? '' }}">
                            </div>
                        </div>

                        <!-- YouTube -->
                        <div class="form-group mb-3">
                            <div class="input-group">
                                <span class="input-group-text text-white" style="background:#FF0000">
                                    <i class="ti ti-brand-youtube"></i>
                                </span>
                                <input type="url" name="youtube" class="form-control"
                                    placeholder="YouTube Channel URL"
                                    value="{{ $website_social_media['youtube'] ?? '' }}">
                            </div>
                        </div>

                        <!-- Pinterest -->
                        <div class="form-group mb-3">
                            <div class="input-group">
                                <span class="input-group-text text-white" style="background:#E60023">
                                    <i class="ti ti-brand-pinterest"></i>
                                </span>
                                <input type="url" name="pinterest" class="form-control"
                                    placeholder="Pinterest URL"
                                    value="{{ $website_social_media['pinterest'] ?? '' }}">
                            </div>
                        </div>

                        <!-- WhatsApp -->
                        <div class="form-group mb-3">
                            <div class="input-group">
                                <span class="input-group-text text-white" style="background:#25D366">
                                    <i class="ti ti-brand-whatsapp"></i>
                                </span>
                                <input type="text" name="whatsapp" class="form-control"
                                    placeholder="WhatsApp Number (+91...)"
                                    value="{{ $website_social_media['whatsapp'] ?? '' }}">
                            </div>
                        </div>

                        <!-- Telegram -->
                        <div class="form-group mb-3">
                            <div class="input-group">
                                <span class="input-group-text text-white" style="background:#0088cc">
                                    <i class="ti ti-brand-telegram"></i>
                                </span>
                                <input type="url" name="telegram" class="form-control"
                                    placeholder="Telegram Link"
                                    value="{{ $website_social_media['telegram'] ?? '' }}">
                            </div>
                        </div>


                    </div>

                    <div class="card-footer text-end">
                        <button class="btn btn-success btn-sm">Save</button>
                    </div>
                </form>
            </div>

            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-heading">Home Banner Slider</h5>
                </div>

                <form action="{{ route('admin.settings.home_banner_slider_store') }}" method="POST"
                    enctype="multipart/form-data">

                    @csrf

                    <div class="card-body">



                        <div id="slider-wrapper">

                            @if (isset($home_banner_sliders) && count($home_banner_sliders) > 0)

                                @foreach ($home_banner_sliders as $index => $slider)
                                    <div class="slider-item border rounded p-3 mb-4 bg-light">

                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h5 class="mb-0">Slider {{ $index + 1 }}</h5>

                                            <button type="button" class="btn btn-danger btn-sm remove-slider">
                                                Remove
                                            </button>
                                        </div>

                                        <div class="row">

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Background Image</label>

                                                <input type="file" name="sliders[{{ $index }}][image]"
                                                    class="form-control">

                                                @if (isset($slider['image']) && $slider['image'])
                                                    <img src="{{ asset($slider['image']) }}"
                                                        class="img-fluid mt-2 rounded" width="200">
                                                @endif
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Small Title</label>

                                                <input type="text"
                                                    name="sliders[{{ $index }}][small_title]"
                                                    class="form-control" value="{{ $slider['small_title'] ?? '' }}">
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Title 1</label>

                                                <input type="text" name="sliders[{{ $index }}][title_1]"
                                                    class="form-control" value="{{ $slider['title_1'] ?? '' }}">
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Title 2</label>

                                                <input type="text" name="sliders[{{ $index }}][title_2]"
                                                    class="form-control" value="{{ $slider['title_2'] ?? '' }}">
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Title 3</label>

                                                <input type="text" name="sliders[{{ $index }}][title_3]"
                                                    class="form-control" value="{{ $slider['title_3'] ?? '' }}">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Button Text</label>

                                                <input type="text"
                                                    name="sliders[{{ $index }}][button_text]"
                                                    class="form-control" value="{{ $slider['button_text'] ?? '' }}">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Button URL</label>

                                                <input type="text" name="sliders[{{ $index }}][button_url]"
                                                    class="form-control" value="{{ $slider['button_url'] ?? '' }}">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Since Year</label>

                                                <input type="text" name="sliders[{{ $index }}][since_year]"
                                                    class="form-control" value="{{ $slider['since_year'] ?? '' }}">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Based Location</label>

                                                <input type="text"
                                                    name="sliders[{{ $index }}][based_location]"
                                                    class="form-control"
                                                    value="{{ $slider['based_location'] ?? '' }}">
                                            </div>

                                        </div>

                                    </div>
                                @endforeach
                            @else
                                <div class="slider-item border rounded p-3 mb-4 bg-light">

                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="mb-0">Slider 1</h5>

                                        <button type="button" class="btn btn-danger btn-sm remove-slider">
                                            Remove
                                        </button>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Background Image</label>

                                            <input type="file" name="sliders[0][image]" class="form-control">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Small Title</label>

                                            <input type="text" name="sliders[0][small_title]"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Title 1</label>

                                            <input type="text" name="sliders[0][title_1]" class="form-control">
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Title 2</label>

                                            <input type="text" name="sliders[0][title_2]" class="form-control">
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Title 3</label>

                                            <input type="text" name="sliders[0][title_3]" class="form-control">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Button Text</label>

                                            <input type="text" name="sliders[0][button_text]"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Button URL</label>

                                            <input type="text" name="sliders[0][button_url]" class="form-control">
                                        </div>



                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Since Year</label>

                                            <input type="text" name="sliders[0][since_year]" class="form-control">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Based Location</label>

                                            <input type="text" name="sliders[0][based_location]"
                                                class="form-control">
                                        </div>

                                    </div>

                                </div>

                            @endif

                        </div>

                        <button type="button" class="btn btn-primary btn-sm" id="add-slider">
                            Add Slider
                        </button>

                    </div>

                    <div class="card-footer text-end">
                        <button class="btn btn-success btn-sm">
                            Save
                        </button>
                    </div>

                </form>
            </div>




            {{-- <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-heading">Slider</h5>
                </div>
                <form action="{{ route('admin.settings.particle_type_store') }}" enctype="multipart/form-data"
                    method="post">
                    <div class="card-body">
                        @csrf()
                        <div class="form-group mb-3">
                            <label for="particle_type" class="form-label">Particle Style</label>
                            <select name="particle_type" id="particle_type" class="form-select">
                                <option value="">Select Particle Style</option>
                                <option value="default"
                                    {{ $particle_js_type && $particle_js_type['type'] == 'default' ? 'selected' : '' }}>
                                    Default</option>
                                <option value="squares"
                                    {{ $particle_js_type && $particle_js_type['type'] == 'squares' ? 'selected' : '' }}>
                                    Squares</option>
                                <option value="bubble"
                                    {{ $particle_js_type && $particle_js_type['type'] == 'bubble' ? 'selected' : '' }}>
                                    Bubble</option>
                                <option value="space"
                                    {{ $particle_js_type && $particle_js_type['type'] == 'space' ? 'selected' : '' }}>
                                    Space</option>
                                <option value="network"
                                    {{ $particle_js_type && $particle_js_type['type'] == 'network' ? 'selected' : '' }}>
                                    Network</option>
                                <option value="flow"
                                    {{ $particle_js_type && $particle_js_type['type'] == 'flow' ? 'selected' : '' }}>
                                    Flow</option>
                                <option value="pulse"
                                    {{ $particle_js_type && $particle_js_type['type'] == 'pulse' ? 'selected' : '' }}>
                                    Pulse</option>
                                <option value="grid"
                                    {{ $particle_js_type && $particle_js_type['type'] == 'grid' ? 'selected' : '' }}>
                                    Grid</option>
                                <option value="network_repulse"
                                    {{ $particle_js_type && $particle_js_type['type'] == 'network_repulse' ? 'selected' : '' }}>
                                    Network Repulse</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="slider_image" class="form-label">Image</label>
                            <div class="input-group">
                                <input type="file" name="slider_image" id="slider_image" class="form-control">
                                <a href="{{ asset('frontend/images/bg-parallax.png') }}"
                                    class="btn btn-outline-warning" target="_blank">
                                    Image Sample
                                </a>
                            </div>
                            <div class="form-text">
                                Image must be of exactly same size as provided in sample.
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="title_1" class="form-label">Title 1</label>
                            <input type="text" name="title_1" id="title_1" class="form-control"
                                value="{{ isset($particle_js_type['title_1']) && $particle_js_type['title_1'] ? $particle_js_type['title_1'] : '' }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="subtitle_1" class="form-label">Subtitle 1</label>
                            <input type="text" name="subtitle_1" id="subtitle_1" class="form-control"
                                value="{{ isset($particle_js_type['subtitle_1']) && $particle_js_type['subtitle_1'] ? $particle_js_type['subtitle_1'] : '' }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="title_2" class="form-label">Title 2</label>
                            <input type="text" name="title_2" id="title_2" class="form-control"
                                value="{{ isset($particle_js_type['title_2']) && $particle_js_type['title_2'] ? $particle_js_type['title_2'] : '' }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="subtitle_2" class="form-label">Subtitle 2</label>
                            <input type="text" name="subtitle_2" id="subtitle_2" class="form-control"
                                value="{{ isset($particle_js_type['subtitle_2']) && $particle_js_type['subtitle_2'] ? $particle_js_type['subtitle_2'] : '' }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="title_3" class="form-label">Title 3</label>
                            <input type="text" name="title_3" id="title_3" class="form-control"
                                value="{{ isset($particle_js_type['title_3']) && $particle_js_type['title_3'] ? $particle_js_type['title_3'] : '' }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="subtitle_3" class="form-label">Subtitle 3</label>
                            <input type="text" name="subtitle_3" id="subtitle_3" class="form-control"
                                value="{{ isset($particle_js_type['subtitle_3']) && $particle_js_type['subtitle_3'] ? $particle_js_type['subtitle_3'] : '' }}">
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-sm btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div> --}}
        </div>
    </div>

    @push('styles')
        <style>
            .color-preview {
                width: 30px;
                height: 30px;
                border-radius: 6px;
                display: block;
                cursor: pointer;
                border: 1px solid #ddd;
            }

            .color-input {
                position: absolute;
                opacity: 0;
                pointer-events: none;
            }
        </style>
    @endpush
    @push('scripts')
        <script>
            document.querySelectorAll('.color-picker-group').forEach(group => {
                const preview = group.querySelector('.color-preview');
                const colorInput = group.querySelector('.color-input');
                const hexInput = group.querySelector('.color-hex');

                // Default value
                let defaultColor = hexInput.value ? hexInput.value : '#000000';
                preview.style.backgroundColor = defaultColor;
                colorInput.value = defaultColor;
                hexInput.value = defaultColor;

                // Click preview → open picker
                preview.addEventListener('click', () => {
                    colorInput.click();
                });

                // When color changes
                colorInput.addEventListener('input', () => {
                    preview.style.backgroundColor = colorInput.value;
                    hexInput.value = colorInput.value;
                });

                // When HEX changes
                hexInput.addEventListener('input', () => {
                    let val = hexInput.value;

                    if (/^#([0-9A-F]{3}){1,2}$/i.test(val)) {
                        preview.style.backgroundColor = val;
                        colorInput.value = val;
                    }
                });
            });
            let sliderIndex = {{ isset($home_banner_sliders) ? count($home_banner_sliders) : 1 }};

            $('#add-slider').on('click', function() {

                let html = `
        <div class="slider-item border rounded p-3 mb-4 bg-light">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">Slider ${sliderIndex + 1}</h5>

                <button type="button"
                    class="btn btn-danger btn-sm remove-slider">
                    Remove
                </button>
            </div>

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label">Background Image</label>

                    <input type="file"
                        name="sliders[${sliderIndex}][image]"
                        class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Small Title</label>

                    <input type="text"
                        name="sliders[${sliderIndex}][small_title]"
                        class="form-control">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Title 1</label>

                    <input type="text"
                        name="sliders[${sliderIndex}][title_1]"
                        class="form-control">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Title 2</label>

                    <input type="text"
                        name="sliders[${sliderIndex}][title_2]"
                        class="form-control">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Title 3</label>

                    <input type="text"
                        name="sliders[${sliderIndex}][title_3]"
                        class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Button Text</label>

                    <input type="text"
                        name="sliders[${sliderIndex}][button_text]"
                        class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Button URL</label>

                    <input type="text"
                        name="sliders[${sliderIndex}][button_url]"
                        class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Since Year</label>

                    <input type="text"
                        name="sliders[${sliderIndex}][since_year]"
                        class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Based Location</label>

                    <input type="text"
                        name="sliders[${sliderIndex}][based_location]"
                        class="form-control">
                </div>

            </div>

        </div>
        `;

                $('#slider-wrapper').append(html);

                sliderIndex++;

            });


            $(document).on('click', '.remove-slider', function() {

                $(this).closest('.slider-item').remove();

            });

             function toggleTimeFields() {

                        $('.closed-checkbox').each(function() {

                            let parent = $(this).closest('.row');

                            let isChecked = $(this).is(':checked');

                            parent.find('input[type="time"]').prop('disabled', isChecked);

                        });

                    }

                    toggleTimeFields();

                    $(document).on('change', '.closed-checkbox', function() {

                        toggleTimeFields();

                    });
        </script>
    @endpush
</x-app>
