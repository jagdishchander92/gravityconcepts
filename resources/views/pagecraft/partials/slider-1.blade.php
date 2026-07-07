<!-- Banner Section home3 classic-->
<div class="swiper banner-classic-active2">
    <div class="swiper-wrapper">
        @php
            $home_banner_sliders = \App\Models\Setting::where('key', 'home_banner_slider')->first();
            $home_banner_sliders = $home_banner_sliders ? json_decode($home_banner_sliders->value, true) : [];

        @endphp
        @foreach ($home_banner_sliders as $slider)
            <div class="swiper-slide">
                <div class="banner-section-home3-classic"
                    style="background: url({{ asset($slider['image'] ?? '') }});background-repeat: no-repeat;background-position: center;background-size: cover;">
                    <div class="auto-container">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="banner-content-wrap">
                                    <div class="banner-title">
                                        <h1>{!! html_entity_decode($slider['small_title']) !!}</h1>
                                        <h2 class="text-anime-3">{!! html_entity_decode($slider['title_1'] ?? '') !!}</h2>
                                        <h2 class="text-anime-3 text-ani-2">{!! html_entity_decode($slider['title_2'] ?? '') !!}</h2>
                                        <h2 class="text-anime-3 text-ani-2">{!! html_entity_decode($slider['title_3'] ?? '') !!}</h2>
                                    </div>
                                    <div class="banner-autor-info">
                                        <div class="auto-info">
                                            <div class="banner-btn">
                                                <a href="donation.html">{!! html_entity_decode($slider['button_text'] ?? '') !!}<i
                                                        class="fa-solid fa-arrow-right"></i></a>
                                            </div>
                                        </div>
                                        <div class="banner-botton-since">
                                            <div class="since-icon">
                                                <img src="{{ asset('frontend/images/transport-classic/since.png') }}"
                                                    alt="since">
                                            </div>
                                            <div class="since-title">
                                                <h3>{!! html_entity_decode($slider['since_year'] ?? '') !!}</h3>
                                                <h4>{!! html_entity_decode($slider['based_location'] ?? '') !!}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="loginet-banner-arrow-box2">
        <button class="slider-prev" tabindex="0" aria-label="Previous slide">
            <i class="fa-solid fa-arrow-left-long"></i>
        </button>
        <button class="slider-next" tabindex="0" aria-label="Next slide">
            <i class="fa-solid fa-arrow-right-long"></i>
        </button>
    </div>
</div>
<!--Banner Section home3 classic -->
