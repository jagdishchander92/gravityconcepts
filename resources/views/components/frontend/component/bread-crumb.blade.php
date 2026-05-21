@props([
    'title' => '',
    'subtitle' => '',
    'img' => '',
])
<section id="slider" class="hero p-0 odd featured">
    <div
        class="swiper-container no-slider animation slider-h-50 slider-h-auto swiper-container-initialized swiper-container-horizontal">
        <div class="swiper-wrapper" style="transform: translate3d(0px, 0px, 0px);">
            <!-- Item 1 -->
            <div class="swiper-slide slide-center swiper-slide-active" style="width: 1905px;">
                <!-- Media -->
                <img src="{{ asset(imgUrl($img)) }}" alt="Full Image" class="full-image" data-mask="80">

                <div class="slide-content row text-center">
                    <div class="col-12 mx-auto inner">
                        <h1 class="mb-0 title effect-static-text">{!! $title !!}</h1>
                        <p class="mt-2">{!! $subtitle !!}</p>
                    </div>
                </div>
            </div>
        </div>
        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
    </div>
</section>
