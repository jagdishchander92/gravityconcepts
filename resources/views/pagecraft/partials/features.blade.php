<!-- Service Section classic-->
<section class="service-section-classic">
    <div class="auto-container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="sec-title">
                    <div class="section-sub-title">
                        <h1 class="sub-title"><img src="{{ asset('frontend/images/main-home/sub-title-icon.png') }}"
                                alt="sub-icon">Features</h1>
                    </div>
                    <div class="section-title">
                        <h1 class="title text-anime-3">Powerfull Features of Empath Logistics</h1>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="section-desc">
                    <p></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="swiper service-classic-active">
                <div class="swiper-wrapper">
                    @php
                        $ids = array_filter(explode(',', $data));
                        if (!empty($ids)) {
                            $features = \App\Models\Card::where('card_type', 'feature_card')
                                ->whereIn('id', $ids)
                                ->get();
                        } else {
                            $features = \App\Models\Card::where('card_type', 'feature_card')->get();
                        }
                    @endphp
                    @foreach ($features as $feature)
                        <div class="swiper-slide">
                            <!-- Service box -->
                            <div class="col-xl-12">
                                <div class="single-service-box">
                                    <div class="service-thumb">
                                        <figure class="reveal"><img src="{{ asset($feature->card_img) }}"
                                                alt="service-thumb"></figure>
                                        <div class="service-content">
                                            <div class="service-icon">
                                                <img src="{{ asset($feature->card_icon) }}" alt="icon"
                                                    width="80">
                                            </div>
                                            <h2 class="service-title"> {!! html_entity_decode($feature->title) !!} </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="loginet-banner-arrow-box">
                    <button class="slider-prev" tabindex="0" aria-label="Previous slide">
                        <i class="fa-solid fa-arrow-left-long"></i>
                    </button>
                    <button class="slider-next" tabindex="0" aria-label="Next slide">
                        <i class="fa-solid fa-arrow-right-long"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Service Section classic-->
