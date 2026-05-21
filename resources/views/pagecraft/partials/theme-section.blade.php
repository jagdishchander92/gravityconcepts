<!-- About Section one -->
<section class="about-section-one {{ $classes }}" style="{{ $widgetStyle.';background: #0B4654;' }}">
    <div class="auto-container">
        <div class="row about-sec">
            <div class="col-lg-6">
                <div class="sec-title fade-in">
                    <div class="section-sub-title">
                        <h1 class="sub-title"><img src="{{ asset('frontend/images') }}/main-home/sub-title-icon.png"
                                alt="sub-icon">{{ $p['subtitle'] ?? '' }}</h1>
                    </div>
                    <div class="section-title">
                        <h1 class="title text-white text-anime-3">{{ $p['title'] ?? '' }}</h1>
                    </div>
                    <div class="section-desc">
                        <p>{{ $p['desc'] ?? '' }} Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis saepe dolores neque veritatis dolorum, similique inventore iusto, quae alias quasi soluta nemo, optio sed pariatur expedita ducimus praesentium. Recusandae itaque nisi debitis animi est repellendus quam voluptates iusto dicta perspiciatis esse voluptas tenetur, ullam sint praesentium tempora totam, magnam sequi inventore! Quisquam vitae facilis provident esse ipsa quasi commodi dolorem ratione deserunt rem? Rerum ducimus earum nisi possimus, ut sit nam excepturi adipisci soluta harum quos minima placeat dolorum corrupti alias aperiam atque maxime consequatur accusamus ab nemo nihil corporis! Neque commodi temporibus consequuntur deserunt, alias corporis eum quidem eligendi.</p>
                    </div>
                    <div class="loginet-button">
                        <a href="{{ $p['btnUrl'] }}">{!! html_entity_decode($p['btnText'] ?? '') !!}<i
                                class="fa-solid fa-arrow-right"></i><span></span></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-thumb fade-in">
                    <figure class="reveal rounded-lg w-100"><img src="{{ $p['image'] }}" alt="about-thumb">
                    </figure>
                </div>

            </div>
        </div>
        <div class="row">
            @foreach ($p['cards'] as $card)
                <div class="col-xl-3 col-lg-3 col-md-6">
                    <div class="single-about-box fade-in">
                        <div class="about-icon">
                            <i class="fa {{ $card['icon'] }}"></i>
                        </div>
                        <div class="about-title">
                            <h1>{{ $card['text'] }}</h1>
                        </div>
                        <div class="about-desc">
                            <p>{{ $card['desc'] }}</p>
                        </div>
                        {{-- <div class="about-arrow">
                            <svg width="23" height="23" viewBox="0 0 23 23" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11 23C10.1 23 9.10003 22.9 8.20003 22.6C7.70003 22.5 7.30003 21.9 7.50003 21.4C7.60003 20.9 8.20003 20.5 8.70003 20.7C11.8 21.5 15.1 20.6 17.4 18.4C20.9 14.9 20.9 9.19997 17.4 5.69998C13.9 2.19998 8.20003 2.19998 4.70003 5.69998C2.40003 7.99997 1.50003 11.3 2.40003 14.4C2.50003 14.9 2.20003 15.5 1.70003 15.6C1.20003 15.7 0.600027 15.4 0.500027 14.9C-0.599973 11.1 0.500026 6.99997 3.20003 4.19998C7.50003 -0.100024 14.5 -0.100024 18.8 4.19998C23.1 8.49997 23.1 15.5 18.8 19.8C16.7 21.9 13.9 23 11 23ZM4.00003 20C3.70003 20 3.50003 19.9 3.30003 19.7C2.90003 19.3 2.90003 18.7 3.30003 18.3L11.6 9.99997H8.00003C7.40003 9.99997 7.00003 9.59997 7.00003 8.99997C7.00003 8.39997 7.40003 7.99997 8.00003 7.99997H14C14.1 7.99997 14.3 7.99998 14.4 8.09998C14.5 8.09998 14.6 8.19998 14.7 8.29997C14.8 8.39997 14.8 8.49998 14.9 8.59998C15 8.69998 15 8.89997 15 8.99997V15C15 15.6 14.6 16 14 16C13.4 16 13 15.6 13 15V11.4L4.70003 19.7C4.50003 19.9 4.30003 20 4.00003 20Z"
                                    fill="#0B4654" />
                            </svg>
                        </div> --}}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!--Emd About Section one -->
