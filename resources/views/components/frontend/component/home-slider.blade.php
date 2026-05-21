@php
    $particle_js_type1 = \App\Models\Setting::where('key', 'particle_js_type')->first();
    $particle_js_type1 = $particle_js_type1->value ? json_decode($particle_js_type1->value, true) : [];
    $particle_js_type = $particle_js_type1['type'] ?? 'default';
@endphp
@push('scripts')
    @if ($particle_js_type)
        @if ($particle_js_type == 'default')
            <script>
                particles('default', 'particles-1');
            </script>
        @elseif ($particle_js_type == 'squares')
            <script>
                particles('squares', 'particles-1');
            </script>
        @elseif ($particle_js_type == 'bubble')
            <script>
                particles('bubble', 'particles-1');
            </script>
        @elseif ($particle_js_type == 'space')
            <script>
                particles('space', 'particles-1');
            </script>
        @elseif ($particle_js_type == 'network')
            <script>
                particles('network', 'particles-1');
            </script>
        @elseif ($particle_js_type == 'flow')
            <script>
                particles('flow', 'particles-1');
            </script>
        @elseif ($particle_js_type == 'pulse')
            <script>
                particles('pulse', 'particles-1');
            </script>
        @elseif ($particle_js_type == 'grid')
            <script>
                particles('grid', 'particles-1');
            </script>
        @elseif ($particle_js_type == 'network_repulse')
            <script>
                particles('network_repulse', 'particles-1');
            </script>
        @else
            <script>
                particles('default', 'particles-1');
            </script>
        @endif
    @endif
@endpush
<section id="slider" class="hero p-0">
    <div class="swiper-container full-slider animation slider-h-100 slider-h-auto">

        <!-- Particles -->
        <div id="particles-1" class="full-image" data-mask="50"></div>

        <!-- Media -->
        <div class="parallax-x-bg" style="background-image:url({{ asset($particle_js_type1['slider_image'] ?? '') }})"
            data-swiper-parallax="-50%">
        </div>

        <div class="swiper-wrapper">

            <!-- Item 1 -->
            <div class="swiper-slide slide-center">

                <div class="slide-content row">
                    <div class="col-12 d-flex justify-content-start inner">
                        <div class="left text-left">

                            <!-- Content -->
                            <h1 data-aos="zoom-in" data-aos-delay="2000" class="title effect-static-text">
                                {!! html_entity_decode($particle_js_type1['title_1'] ?? '') !!}
                            </h1>
                            <p data-aos="zoom-in" data-aos-delay="2400" class="description"> {!! html_entity_decode($particle_js_type1['subtitle_1'] ?? '') !!}</p>

                            <!-- Action -->
                            <div data-aos="fade-up" data-aos-delay="2800" class="buttons">
                                <div class="d-sm-inline-flex">
                                    <a href="{{ url('/contact-us') }}" class="mt-4 btn primary-button">GET IN TOUCH</a>
                                    <a href="{{ url('/services') }}" class="ml-sm-4 mt-4 btn outline-button">READ
                                        MORE</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Item 2 -->
            <div class="swiper-slide slide-center">
                <div class="slide-content row">
                    <div class="col-12 d-flex justify-content-start justify-content-md-center inner">
                        <div class="center text-left text-md-center">

                            <!-- Content -->
                            <h2 data-aos="zoom-in" data-aos-delay="2000" class="title effect-static-text">
                                {!! html_entity_decode($particle_js_type1['title_2'] ?? '') !!}</h2>
                            <p data-aos="zoom-in" data-aos-delay="800" class="description smaller mr-auto ml-auto">
                                {!! html_entity_decode($particle_js_type1['subtitle_2'] ?? '') !!}</p>

                            <!-- Action -->
                            <div data-aos="fade-up" data-aos-delay="1200" class="buttons">
                                <div class="d-sm-inline-flex">
                                    <a href="{{ url('/contact-us') }}" class="mt-4 btn primary-button">GET IN TOUCH</a>
                                    <a href="{{ url('/services') }}" class="ml-sm-4 mt-4 btn outline-button">READ
                                        MORE</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Item 3 -->
            <div class="swiper-slide slide-center">
                <div class="slide-content row">
                    <div class="col-12 d-flex justify-content-start justify-content-md-end inner">
                        <div class="right text-left">

                            <!-- Content -->
                            <h2 data-aos="zoom-in" data-aos-delay="400" class="title effect-static-text">
                                {!! html_entity_decode($particle_js_type1['title_3'] ?? '') !!}</h2>
                            <p data-aos="zoom-in" data-aos-delay="800" class="description">{!! html_entity_decode($particle_js_type1['subtitle_3'] ?? '') !!}</p>

                            <!-- Action -->
                            <div data-aos="fade-up" data-aos-delay="1200" class="buttons">
                                <div class="d-sm-inline-flex">
                                    <a href="{{ url('/contact-us') }}" class="mt-4 btn primary-button">GET IN TOUCH</a>
                                    <a href="{{ url('/services') }}" class="ml-sm-4 mt-4 btn outline-button">READ
                                        MORE</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="swiper-pagination"></div>
    </div>
</section>
