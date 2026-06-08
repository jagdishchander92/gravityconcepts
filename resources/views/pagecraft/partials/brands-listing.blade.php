<div class="brand-area-one {{ $classes }}" style="{{ $widgetStyle }}">
    <div class="auto-container">
        {{-- <h2 class="text-center underlined-heading">MEMBERSHIP</h2> --}}
        <div class="row">
            <div class="swiper band-active" style="overflow-y: clip;">
                <div class="swiper-wrapper">
                    @foreach ($p['images'] as $image)
                        <div class="swiper-slide">
                            <div class="col-lg-12">
                                <div class="brand-box">
                                    <div class="brand-thumb">
                                        <img src="{{ $image }}" width="200" alt="brand img">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
