@php
    $website_common_info = \App\Models\Setting::where('key', 'website_common_info')->first();
    $website_common_info = $website_common_info ? json_decode($website_common_info->value, true) : [];

@endphp
<section id="contact" class="section-6 form contact">
    <div class="container">

        <div class="row">
            <div class="col-12 col-md-8 pr-md-5 align-self-center text">
                <div class="row intro">
                    <div class="col-12 p-0">
                        <span class="pre-title m-0">Send a message</span>
                        <h2>Get in <span class="featured"><span>Touch</span></span></h2>
                        <p>We will respond to your message as soon as possible.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 p-0">
                        <form action="{{ route('contact.store') }}" method="POST" id="contactForm">
                            @csrf

                            <div class="row form-group-margin">
                                <div class="col-md-6 p-2">
                                    <input type="text" name="name" class="form-control" placeholder="Name">
                                    <small class="text-danger error-name"></small>
                                </div>

                                <div class="col-md-6 p-2">
                                    <input type="email" name="email" class="form-control" placeholder="Email">
                                    <small class="text-danger error-email"></small>
                                </div>

                                <div class="col-md-6 p-2">
                                    <input type="text" name="phone" class="form-control" placeholder="Phone">
                                    <small class="text-danger error-phone"></small>
                                </div>

                                <div class="col-md-6 p-2">
                                    <input type="text" name="subject" class="form-control" placeholder="Subject">
                                    <small class="text-danger error-subject"></small>
                                </div>

                                <div class="col-12 p-2">
                                    <textarea name="message" class="form-control" placeholder="Message"></textarea>
                                    <small class="text-danger error-message"></small>
                                </div>

                                <div class="col-12 p-2">
                                    <div class="g-recaptcha" data-sitekey="6LfT8PsrAAAAAC6R-cNA3XZrA4AGVu_gz1q42fQh">
                                    </div>
                                    <small class="text-danger error-g-recaptcha-response"></small>
                                </div>
                                <div class="form-alert"></div>
                                <div class="col-12 p-2">
                                    <button type="submit" class="btn primary-button">SEND</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="contacts">
                    <h4> {!! $website_common_info['web_name'] !!}</h4>
                    <p>{!! $website_common_info['web_short_desc'] !!}</p>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-phone-alt mr-2"></i>
                                {{ $website_common_info['phone'] }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-envelope mr-2"></i>
                                {{ $website_common_info['email'] }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-map-marker-alt mr-2"></i>
                                {{ $website_common_info['location'] }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a target="_blank"
                                href="https://www.google.com/maps/dir/?api=1&destination={{ $website_common_info['map_lat'] }},{{ $website_common_info['map_lng'] }}"
                                class="mt-2 btn outline-button">Get
                                Directions</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
    {{-- <div>
        <iframe style="width: 100%;min-height: 500px;border:0;" loading="lazy" allowfullscreen
            referrerpolicy="no-referrer-when-downgrade"
            src="https://www.google.com/maps?q={{ $website_common_info['map_lat'] }},{{ $website_common_info['map_lng'] }}&z=15&output=embed">
        </iframe>
    </div> --}}

    @push('scripts')
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <script>
            $('#contactForm').on('submit', function(e) {
                e.preventDefault();

                let form = $(this);
                let btn = form.find('button[type="submit"]');

                // Clear old errors
                $('.text-danger').html('');
                $('.form-control').removeClass('is-invalid');

                // Button loading state
                btn.prop('disabled', true).html('Sending...');
                btn.html('<span class="spinner-border spinner-border-sm"></span> Sending...');

                let formData = new FormData(this);

                $.ajax({
                    url: form.attr('action'),
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,

                    success: function(res) {
                        $('.form-alert').html(
                            '<span class="text-success">Message sent successfully!</span>');

                        form[0].reset();
                        grecaptcha.reset();

                        btn.prop('disabled', false).html('SEND');
                    },

                    error: function(xhr) {
                        btn.prop('disabled', false).html('SEND');

                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;

                            $.each(errors, function(key, value) {
                                let field = $('[name="' + key + '"]');

                                field.addClass('is-invalid');
                                $('.error-' + key).html(value[0]);
                            });
                        } else {
                            $('.form-alert').html('Something went wrong. Try again.');
                        }
                    }
                });
            });
        </script>
    @endpush
</section>
