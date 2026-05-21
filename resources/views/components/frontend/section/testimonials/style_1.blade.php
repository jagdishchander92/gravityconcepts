@php
    $testimonials = \App\Models\Testimonial::limit(16)->where('status', 1)->latest('id')->get();
@endphp
<section class="custom-testimonial py-5">
    <div class="container">
        <div class="text-center mb-5 intro">
            <span class="pre-title">Testimonials</span>
            <h2>What Our Clients Say</h2>
            {{-- <p class="text-muted">Trusted by thousands of innovators worldwide</p> --}}
        </div>

        <div class="swiper mid-slider">
            <div class="swiper-wrapper">
                @foreach ($testimonials as $testimonial)
                    <div class="swiper-slide h-100">
                        <div class="testimonial-card h-100">
                            <div class="quote-icon"><i class="fas fa-quote-left"></i></div>
                            <p class="review-text">"{!! html_entity_decode($testimonial->description) !!}"</p>
                            <div class="user-info">
                                <img src="{{ asset($testimonial->img) }}" alt="User" class="user-img">
                                <h5 class="mb-0">{!! html_entity_decode($testimonial->name) !!}</h5>
                                <small class="text-muted">{!! html_entity_decode($testimonial->designation) !!}</small>
                                <div class="rating mt-2">
                                    @php
                                        $rating = (float) $testimonial->rating;
                                        $fullStars = floor($rating);
                                        $hasHalfStar = $rating - $fullStars >= 0.5;
                                        $emptyStars = 5 - $fullStars - ($hasHalfStar ? 1 : 0);
                                    @endphp
                                    @for ($i = 0; $i < $fullStars; $i++)
                                        <i class="fas fa-star"></i>
                                    @endfor

                                    @if ($hasHalfStar)
                                        <i class="fas fa-star-half-alt"></i>
                                    @endif
                                    @for ($i = 0; $i < $emptyStars; $i++)
                                        <i class="far fa-star"></i>
                                    @endfor
                                    <span class="ms-2 text-muted">({{ $rating }})</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>
@push('styles')
    <style>
        .custom-testimonial {
            background-color: #f8f9fa;
            overflow: hidden;
        }

        .custom-testimonial .testimonialSwiper {
            padding: 40px 20px;
        }

        .custom-testimonial .testimonial-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 40px 30px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
            margin: 15px;
            position: relative;
            border: 1px solid rgba(0, 0, 0, 0.03);
        }

        .custom-testimonial .testimonial-card:hover {
            transform: translateY(-10px);
        }

        .custom-testimonial .quote-icon {
            font-size: 2rem;
            color: var(--primary-color);
            opacity: 0.2;
            margin-bottom: 20px;
        }

        .custom-testimonial .review-text {
            font-style: italic;
            color: #555;
            font-size: 1.1rem;
            line-height: 1.7;
            margin-bottom: 30px;
        }

        .custom-testimonial .user-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #fff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
        }

        .custom-testimonial .rating i {
            color: #ffc107;
            font-size: 0.9rem;
        }
    </style>
@endpush
