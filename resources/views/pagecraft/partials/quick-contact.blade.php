<form action="{{ route('contact.store') }}" method="POST" id="quickContactForm">
    @csrf
    <div class="row quick-contact">
        <div class="col-lg-12 col-md-12">
            <div class="form-group mb-3 input-icon">
                <input type="text" class="form-control" name="name" placeholder="Your Name" required>
                <i class="fa-solid fa-user"></i>
            </div>
            <input type="hidden" name="subject" value="{{ request()->path() }}">
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="form-group mb-3 input-icon">
                <input type="text" class="form-control" name="phone" placeholder="Phone No." required>
                <i class="fa-solid fa-phone"></i>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="form-group mb-3 input-icon">
                <input type="email" class="form-control" name="email" placeholder="Enter E-Mail" required>
                <i class="fa-solid fa-envelope"></i>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="form-group mb-3 input-icon textarea-icon">
                <textarea name="message" class="form-control" rows="3" placeholder="Write Message..." required></textarea>
                <i class="fa-solid fa-message"></i>
            </div>
        </div>
        <div class="col-md-12 mb-3">
            <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}">
            </div>
            <small class="text-danger error-g-recaptcha-response"></small>
        </div>
        <div class="col-md-6 mb-3">
            <button type="submit" class="btn btn-primary btn-lg">Send Message</button>
            <div class="form-alert"></div>
        </div>

    </div>
</form>
<div id="status"></div>
