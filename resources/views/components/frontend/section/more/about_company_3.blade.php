@props([
    'section_title' => '',
    'section_subtitle' => '',
    'section_desc' => '',
    'items' => [],
])

<section id="about" class="section-2 hero p-0">
    <div
        class="swiper-container no-slider animation slider-h-100 slider-h-auto swiper-container-initialized swiper-container-horizontal">

        <div class="swiper-wrapper">
            <div class="swiper-slide slide-center swiper-slide-active" style="width: 1905px;">
                <div class="parallax-y-bg" style="background-image:url({{ asset(imgUrl($items[0]['img'] ?? '')) }})">
                </div>
                <div class="slide-content row">
                    <div class="col-12 d-flex justify-content-start justify-content-md-end inner">
                        <div class="right pb-0 text-left init">
                            <h2 class="title effect-static-text">
                                <span class="pre-title m-0">{!! html_entity_decode($section_subtitle) !!}</span>
                                {!! html_entity_decode($section_title) !!}
                            </h2>
                            <p class="description">{!! html_entity_decode($section_desc) !!}</p>
                            <div class="buttons">
                                <div class="d-sm-inline-flex">
                                    <a href="{{ url($items[0]['btn_slug'] ?? '') }}"
                                        class="mt-4 btn primary-button">{{ $items[0]['btn_text'] ?? '' }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
    </div>
</section>
