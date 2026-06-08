<!-- contact section home2 classic-->
<section class="contact-section-home2-classic my-5 inner">
    <div class="row g-0">
        <div class="col-xl-6">
            <div class="contact-thumb h-100">
                <figure class="reveal"><img src="{{ asset('frontend/images/home2-classic/contact-thumb.png') }}"
                        alt="contact thumb"></figure>
                <div class="contact-autor-info">
                    <div class="autor-img-box">
                        <div class="author-image"><img src="{{ asset('frontend/images/home2/contact-autor1.png') }}"
                                alt="Image"></div>
                        <div class="author-image"><img src="{{ asset('frontend/images/home2/contact-autor2.png') }}"
                                alt="Image"></div>
                        <div class="autor-number">5k+</div>
                    </div>
                    <p class="autor-desc">Trusted Happy Customers</p>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="contact-form-box">
                <!-- section title -->
                <div class="sec-title">
                    <div class="section-sub-title">
                        <h1 class="sub-title"><img src="{{ asset('frontend/images/main-home/sub-title-icon.png') }}"
                                alt="sub-icon">Consultations</h1>
                    </div>
                    <div class="section-title">
                        <h1 class="title title-anim">Need Help? We’re Here</h1>
                    </div>
                </div>
                <form action="{{ route('contact.store') }}" method="POST" id="contactForm">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-box">
                                <input type="text" name="name" placeholder="Your Name" required>
                                <i class="fa-solid fa-user"></i>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-box">
                                <input type="text" name="phone" placeholder="Phone No." required>
                                <i class="fa-solid fa-circle-phone"></i>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-box">
                                <input type="email" name="email" placeholder="Enter E-Mail" required>
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-box">
                                <input type="text" name="subject" placeholder="Enter Subject" required>
                                <i class="fa fa-tag"></i>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="form-box message">
                                <textarea name="message" id="message" cols="30" rows="10" placeholder="Write Message..." required></textarea>
                                <i class="fa-solid fa-message"></i>
                            </div>
                        </div>
                        <div class="col-md-6 p-2">
                            <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}">
                            </div>
                            <small class="text-danger error-g-recaptcha-response"></small>
                        </div>
                        <div class="col-md-6">
                            <div class="contact-form">
                                <button type="submit">Send Message<i class="fa-solid fa-arrow-right"></i></button>
                            </div>
                            <div class="form-alert"></div>
                        </div>

                    </div>
                </form>
                <div id="status"></div>
            </div>
        </div>
    </div>
</section>
<!-- contact section home2 classic-->
