<!-- testimonial section home2 -->
<section class="testimonial-section-home2">
    <div class="auto-container">
        <div class="row align-items-center">
            <div class="col-xl-6">
                <div class="sec-title">
                    <div class="section-sub-title">
                        <h1 class="sub-title"><img src="{{ asset('frontend/images/main-home/sub-title-icon.png') }}"
                                alt="sub-icon">Testimonials
                        </h1>
                    </div>
                    <div class="section-title">
                        <h1 class="title text-white title-anim">What Our Loyal Clients</h1>
                        <h1 class="title text-white title-anim"> Say About Us</h1>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="section-desc">
                    {{-- <p class="title-anim">loginet is a main-homeal organizations maintaince
                        dedicated to protecting planet through sustainable
                        community empowerment moderator</p> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="swiper testi-home2-active">
            <div class="swiper-wrapper">
                @php
                    $testimonials = \App\Models\Testimonial::where('status', 1)->get();
                @endphp
                @foreach ($testimonials as $testimonial)
                    <div class="swiper-slide">
                        <div class="col-lg-12">
                            <div class="single-testi-box" data-cursor-text="View">
                                <div class="testi-autor-box">
                                    <div class="testi-autor">
                                        <img src="{{ url($testimonial->img) }}" alt="autor">
                                    </div>
                                    <div class="testi-autor-content">
                                        <h2 class="autor-title">{{ $testimonial->name }}</h2>
                                        <p class="autor-desi">{{ $testimonial->designation }}</p>
                                    </div>
                                </div>
                                <div class="testi-ratting">
                                    <div class="testi-number">
                                        <span>{{ $testimonial->rating }}</span>
                                    </div>
                                    <div class="ratting">
                                        <ul>
                                            @php
                                                $rating = $testimonial->rating;
                                                $fullStars = floor($rating);
                                                $halfStar = $rating - $fullStars >= 0.5;
                                                $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                                            @endphp

                                 
                                            @for ($i = 0; $i < $fullStars; $i++)
                                                <li><i class="fa-solid fa-star"></i></li>
                                            @endfor

                                            
                                            @if ($halfStar)
                                                <li><i class="fa-solid fa-star-half-stroke"></i></li>
                                            @endif

                                            @for ($i = 0; $i < $emptyStars; $i++)
                                                <li><i class="fa-regular fa-star"></i></li>
                                            @endfor
                                        </ul>
                                    </div>
                                </div>
                                <div class="testi-desc">
                                    <p>“{{ $testimonial->description }}“</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="loginet-home2-arrow-box">
                <button class="slider-prev" tabindex="0" aria-label="Previous slide">
                    <i class="fa-solid fa-arrow-left-long"></i>
                </button>
                <button class="slider-next" tabindex="0" aria-label="Next slide">
                    <i class="fa-solid fa-arrow-right-long"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="testi-shape">
        <img src="{{ asset('frontend/images/home2/testi-shape.png') }}" alt="shape">
    </div>
</section>
<!-- testimonial section home2 -->
