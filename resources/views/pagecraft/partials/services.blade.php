<!-- service Section home2 -->

<div class="bg-black">
    <section class="service-section-home2">
        <div class="auto-container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="sec-title">
                        <div class="section-sub-title">
                            <h1 class="sub-title"><img src="{{ asset('frontend/images/main-home/sub-title-icon.png') }}"
                                    alt="sub-icon">Services</h1>
                        </div>
                        <div class="section-title">
                            <h1 class="title title-anim text-white">Special Services</h1>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="section-desc">
                        <p class="title-anim">Globally known for our ability to handle every last detail of our customers’ particular logistics and forwarding needs, Empath Logistics Special Services team takes care of all your logistics.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="swiper service-home2-active">
                <div class="swiper-wrapper">
                    @php
                        $ids = array_filter(explode(',', $data));
                        if (!empty($ids)) {
                            $services = \App\Models\Card::where('card_type', 'service_card')
                                ->whereIn('id', explode(',', $data))
                                ->get();
                        } else {
                            $services = \App\Models\Card::where('card_type', 'service_card')->get();
                        }
                    @endphp
                    @foreach ($services as $service)
                        <div class="swiper-slide">
                            <div class="col-xl-12">
                                <div class="single-service-box">
                                    <div class="service-thumb">
                                        <figure class="reveal"><img src="{{ url($service->card_img ?? '/') }}"
                                                alt="service-thumb">
                                        </figure>
                                        <div class="service-icon">
                                            <img src="{{ asset($service->card_icon) }}" alt="icon" width="60">
                                        </div>
                                    </div>
                                    <div class="service-content">
                                        <h2 class="service-title">
                                            <a href="{{ $service->btn_url }}">
                                                {{ $service->title }}
                                            </a>
                                        </h2>
                                        <p> {{ $service->sub_title }}</p>
                                        <a class="service-btn"
                                            href="{{ $service->btn_url }}">{{ $service->btn_title }}<i
                                                class="fa-solid fa-arrow-right-long"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="loginet-service-arrow-box">
                    <button class="slider-prev" tabindex="0" aria-label="Previous slide">
                        <i class="fa-solid fa-arrow-left-long"></i>
                    </button>
                    <button class="slider-next" tabindex="0" aria-label="Next slide">
                        <i class="fa-solid fa-arrow-right-long"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- service Section home2 -->
