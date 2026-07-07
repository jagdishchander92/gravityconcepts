@props([
    'title' => '',
    'meta_title' => '',
    'meta_desc' => '',
])
<!DOCTYPE html>
<html lang="en">

<head>
    @php
        $logos = \App\Models\Setting::where('key', 'website_logo_setting')->first();
        if ($logos?->value) {
            $logos = json_decode($logos->value, true);
        }
        $website_info = \App\Models\Setting::where('key', 'website_common_info')->first();
        if ($website_info?->value) {
            $website_info = json_decode($website_info->value, true);
        }
        $social_medias = \App\Models\Setting::where('key', 'website_social_media')->first();
        if ($social_medias?->value) {
            $social_medias = json_decode($social_medias->value, true);
        }
    @endphp
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="index,follow">


    <title>{{ $meta_title ?? $website_info['web_name'] }}</title>
    <meta name="description" content="{{ $meta_desc ?? '' }}">
    <link rel="canonical" href="{{ request()->fullUrl() }}">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ $website_info['web_name'] ?? '' }}">
    <meta property="og:locale" content="en_US">
    <meta property="og:title" content="{{ $meta_title }}">
    <meta property="og:description" content="{{ $meta_desc }}">
    <meta property="og:url" content="{{ request()->fullUrl() }}">
    <meta property="og:image" content="">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">


    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $meta_title ?? '' }}">
    <meta name="twitter:description" content="{{ $meta_desc ?? '' }}">
    <meta name="twitter:image" content="">
    <meta name="theme-color" content="#0B4654">

    <link rel="shortcut icon" href="{{ asset($logos['favicon'] ?? '') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset($logos['favicon'] ?? '') }}" type="image/x-icon">
    <!-- Stylesheets -->

    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/lib/sweetalert2/dist/sweetalert2.min.css') }}">
    <style>
        :root {
            --text-color: #67777a;
            /* --theme-color2: #037193; */
            --xyz: #0A4F66;
            --xyz: #0A4F66;
        }

        :root {
            --theme-color1: #042A36;
            --theme-color1-rgb: 15, 126, 166;
            --theme-color2: #0A4F66;
            --theme-color2-rgb: 10, 79, 102;
            --theme-color7: #028db8;
            --theme-color4: #042A36;
            --theme-color4: #042A36;
            --heading-color: #042A36;
            --custom-bg-color: #1E2A38;
        }

        .bg-black {
            background-color: #1E2A38 !important;


        }


        .service-section-home2,
        .work-process-section-one,
        .testimonial-section-classic {
            background-color: var(--custom-bg-color);
        }

        .service-section-home2 .sub-title,
        .work-process-section-one .sub-title,
        .testimonial-section-classic .sub-title {
            color: white !important;
            border-color: white !important;
        }

        .service-section-home2 h1.sub-title img,
        .work-process-section-one h1.sub-title img,
        .testimonial-section-classic h1.sub-title img {
            filter: brightness(0) invert(1);
        }

        `` .main-footer-one {
            background-color: var(--custom-bg-color);
        }

        .main-footer-one .main-footer-section::before {
            background-color: #142335;
        }

        .service-section-home2 .single-service-box .service-thumb::before {
            background-image: url(data:image/svg+xml,%3Csvg%20width%3D%22362%22%20height%3D%22255%22%20viewBox%3D%220%200%20362%20255%22%20fill%3D%22none%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Cpath%20d%3D%22M0%2020C0%208.95431%208.9543%200%2020%200H342C353.046%200%20362%208.9543%20362%2020V234.607C362%20246.544%20351.611%20255.823%20339.749%20254.48L17.7492%20218.01C7.63905%20216.865%200%20208.312%200%20198.137V20Z%22%20fill%3D%22%230A4F66%22%2F%3E%3C%2Fsvg%3E);
        }

        h1.sub-title img {
            filter: brightness(0) saturate(100%) invert(21%) sepia(50%) saturate(1472%) hue-rotate(156deg) brightness(96%) contrast(95%);
        }
    </style>
    @stack('styles')
    @php
        $google_analytics = \App\Models\Seo::where('key', 'google_analytics')->first()?->data;
        $custom_header_codes = \App\Models\CustomCode::where('type', 'header')->get();
    @endphp
    @foreach ($custom_header_codes as $code)
        {!! html_entity_decode($code->codes) !!}
    @endforeach
    {!! html_entity_decode($google_analytics['header_codes'] ?? '') !!}
</head>

<body>

    <div class="page-wrapper {{ request()->is('/') ? 'bg-black' : '' }}">

        <!-- Preloader -->
        {{-- <div class="preloader">
            <div class="loader"></div>
        </div> --}}
        <div class="preloader">
            <div class="loader">
                <div class="road"></div>
                <div class="truck-container">
                    <div class="truck">
                        <div class="truck-trailer">
                            <div class="trailer-line"></div>
                            <div class="trailer-line"></div>
                            <div class="trailer-line"></div>
                        </div>
                        <div class="truck-cabin">
                            <div class="window"></div>
                            <div class="light"></div>
                        </div>
                        <div class="truck-chassis"></div>
                        <div class="wheel front">
                            <div class="wheel-inner"></div>
                        </div>
                        <div class="wheel back">
                            <div class="wheel-inner"></div>
                        </div>
                    </div>
                </div>
                <div class="loading-text">DELIVERING</div>
            </div>
        </div>


        <!--  Main Header-->
        <header
            class="main-header  {{ request()->is('/') ? 'header-home2-renewable-classic' : 'inner_page__header' }}">

            <!-- Header Lower -->
            <div class="header-lower">
                <!-- Main box -->
                <div class="main-box">
                    <div class="logo-box">
                        <div class="logo">
                            <a href="/">
                                @if (request()->is('/'))
                                    <img src="{{ $logos['logo_dark'] ? asset($logos['logo_dark']) : '' }}"
                                        alt="">
                                @else
                                    <img src="{{ $logos['logo_light'] ? asset($logos['logo_light']) : '' }}"
                                        alt="">
                                @endif
                            </a>
                        </div>
                    </div>

                    <!--Nav Box-->
                    <div class="nav-outer">

                        <nav class="nav main-menu">
                            @php
                                $menus = \App\Models\Menu::where('type', 'header')->first()?->menu;

                            @endphp
                            <ul class="navigation">
                                {!! renderMenu($menus) !!}
                            </ul>
                        </nav>

                        @php
                            function renderMenu($items)
                            {
                                $html = '';

                                foreach ($items as $item) {
                                    $hasChildren = !empty($item['children']);

                                    $html .= '<li class="' . ($hasChildren ? 'dropdown' : '') . '">';

                                    $html .= '<a href="' . url($item['url']) . '">' . e($item['label']) . '</a>';

                                    if ($hasChildren) {
                                        $html .= '<ul>';
                                        $html .= renderMenu($item['children']);
                                        $html .= '</ul>';
                                    }

                                    $html .= '</li>';
                                }

                                return $html;
                            }
                        @endphp
                        <!-- Main Menu End-->

                        <div class="outer-box">
                            <div class="menu-btn">
                                <button class="theme-btn btn-style-one" data-bs-toggle="modal"
                                    data-bs-target="#getQuoteModal"><span class="btn-title">Get a
                                        Quote <i class="fa-solid fa-arrow-right"></i></span></button>
                            </div>
                            <div class="mobile-nav-toggler"><span class="icon lnr-icon-bars"></span></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Header Lower -->

            <!-- Mobile Menu  -->
            <div class="mobile-menu">
                <div class="menu-backdrop"></div>

                <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
                <nav class="menu-box">
                    <div class="upper-box">
                        <div class="nav-logo"><a href="/"><img
                                    src="{{ $logos['logo_dark'] ? asset($logos['logo_dark']) : '' }}"
                                    alt=""></a>
                        </div>
                        <div class="close-btn"><i class="icon fa fa-times"></i></div>
                    </div>

                    <ul class="navigation clearfix">
                        <!--Keep This Empty / Menu will come through Javascript-->
                    </ul>
                    <ul class="contact-list-one">
                        <li>
                            <!-- Contact Info Box -->
                            <div class="contact-info-box">
                                <i class="icon lnr-icon-phone-handset"></i>
                                <span class="title">Call Now</span>
                                <a
                                    href="tel:{{ $website_info['phone'] ?? '' }}">{{ $website_info['phone'] ?? '' }}</a>
                            </div>
                        </li>
                        <li>
                            <!-- Contact Info Box -->
                            <div class="contact-info-box">
                                <span class="icon lnr-icon-envelope1"></span>
                                <span class="title">Send Email</span>
                                <a
                                    href="mailto:{{ $website_info['email'] ?? '' }}">{{ $website_info['email'] ?? '' }}</a>
                            </div>
                        </li>
                        <li>
                            <!-- Contact Info Box -->
                            <div class="contact-info-box">
                                <span class="icon lnr-icon-clock"></span>
                                <span class="title">Opening Hours</span>
                                {{ $website_info['open_hours'] ?? '' }}
                            </div>
                        </li>
                    </ul>


                    <ul class="social-links">
                        @if (isset($social_medias['twitter']))
                            <li><a href="{{ $social_medias['twitter'] }}"><i class="fa-brands fa-x-twitter"></i></a>
                            </li>
                        @endif
                        @if (isset($social_medias['facebook']))
                            <li><a href="{{ $social_medias['facebook'] }}"><i class="fab fa-facebook-f"></i></a></li>
                        @endif
                        @if (isset($social_medias['pinterest']))
                            <li><a href="{{ $social_medias['pinterest'] }}"><i class="fab fa-pinterest"></i></a></li>
                        @endif
                        @if (isset($social_medias['instagram']))
                            <li><a href="{{ $social_medias['instagram'] }}"><i class="fab fa-instagram"></i></a></li>
                        @endif
                    </ul>
                </nav>
            </div><!-- End Mobile Menu -->



            <!-- Sticky Header  -->
            <div class="sticky-header">
                <div class="auto-container">
                    <div class="inner-container">
                        <!--Logo-->
                        <div class="logo">
                            <a href="/"><img
                                    src="{{ $logos['logo_light'] ? asset($logos['logo_light']) : '' }}"
                                    alt=""></a>
                        </div>

                        <!--Right Col-->
                        <div class="nav-outer">
                            <!-- Main Menu -->
                            <nav class="main-menu">
                                <div class="navbar-collapse show collapse clearfix">
                                    <ul class="navigation clearfix">
                                        <!--Keep This Empty / Menu will come through Javascript-->
                                    </ul>
                                </div>
                            </nav><!-- Main Menu End-->

                            <!--Mobile Navigation Toggler-->
                            <div class="mobile-nav-toggler"><span class="icon lnr-icon-bars"></span></div>
                        </div>
                    </div>
                </div>
            </div><!-- End Sticky Menu -->
        </header>
        <!--End Main Header -->


        <!-- Sidebar area start here -->
        <div class="sidebar-area offcanvas offcanvas-end" id="menubar">
            <div class="offcanvas-header">
                <a href="index.html" class="logo"> <img src="{{ url('frontend/images') }}/logo-white.png"
                        alt="logo"></a>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"><i
                        class="fa-regular fa-xmark"></i></button>
            </div>
            <div class="offcanvas-body sidebar__body">
                <div class="mobile-menu overflow-hidden"></div>
                <div class="d-none d-lg-block">
                    <h5 class="text-white mb-20">About Us</h5>
                    <p class="sidebar__text">loginet is a nonprofit main-homeal organizations maintaince and dedicated
                        to protecting planet through sustainable and renewable community empowerment moderator.We
                        leverage real main-homeal data tailor projects that maximize ecology benefit in your region</p>
                </div>
                <div class="sidebar__contact-info mt-30">
                    <h5 class="text-white mb-20">Contact Info</h5>
                    <ul>
                        <li><i class="fa-solid fa-location-dot"></i> <a href="#0">Chicago 12, Melborne City,
                                USA</a>
                        </li>
                        <li class="py-2"><i class="fa-solid fa-phone-volume"></i> <a href="#">(+881)
                                123-456-7890</a>
                        </li>
                        <li><i class="fa-solid fa-paper-plane"></i> <a href="#">info.example@gmail.com</a></li>
                    </ul>
                </div>
                <div class="sidebar__btns my-4">
                    <a href="contact.html">Sign Up</a>
                    <a class="sign-in" href="contact.html">Sign In</a>
                </div>
                <div class="sidebar__socials">
                    <ul>
                        <li>
                            <a href="#0">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7.76562 0H8.20406C9.50719 0.0371875 10.8041 0.385625 11.9359 1.03531C13.3297 1.82094 14.4756 3.03625 15.1816 4.47188C15.6875 5.49438 15.9603 6.62656 16 7.76562V8.205C15.9647 9.38344 15.6775 10.5553 15.1419 11.6069C14.6209 12.6316 13.8803 13.5447 12.9794 14.2594C12.0306 15.0175 10.9072 15.5569 9.71937 15.8141C9.22219 15.9275 8.71313 15.9788 8.20438 16H7.795C6.40844 15.9609 5.03281 15.5628 3.84875 14.8387C2.44469 13.985 1.3125 12.6919 0.659063 11.1838C0.252187 10.255 0.0365625 9.2475 0 8.23531V7.79406C0.0359375 6.53 0.366875 5.27437 0.976875 4.16594C1.73094 2.78781 2.8975 1.64031 4.28937 0.911563C5.35844 0.34625 6.55844 0.041875 7.76562 0ZM3.40094 3.29594C4.59812 5.03813 5.79531 6.78 6.99188 8.52219C5.79563 9.91344 4.59812 11.3038 3.40219 12.6953C3.6325 12.6966 3.86313 12.695 4.09344 12.6962C4.13844 12.6884 4.20125 12.7166 4.23281 12.6722C5.27312 11.4641 6.3125 10.2553 7.35219 9.04656C8.18937 10.2625 9.02344 11.4809 9.86156 12.6962C10.7741 12.695 11.6866 12.6962 12.5988 12.6956C11.3594 10.8869 10.1119 9.08313 8.87594 7.27219C10.0203 5.94969 11.1578 4.62156 12.2987 3.29625C12.0281 3.29563 11.7578 3.29563 11.4872 3.29625C10.4987 4.44875 9.50437 5.59656 8.51844 6.75094C7.72031 5.60344 6.93437 4.44688 6.14062 3.29625C5.2275 3.29563 4.31437 3.29594 3.40094 3.29594Z"
                                        fill="white" />
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="#0">
                                <svg width="8" height="16" viewBox="0 0 8 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M5.10223 8.99555V16H1.97333V8.99555H0V6.09778H1.97333V3.89334C1.97333 1.38667 3.46666 0 5.76 0C6.85333 0 8 0.195557 8 0.195557V2.65778H6.73778C5.49334 2.65778 5.10223 3.43111 5.10223 4.22222V6.09778H7.88444L7.44 8.99555H5.10223Z"
                                        fill="white" />
                                </svg>
                            </a>
                        </li>

                        <li>
                            <a href="#0">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M3.58958 15.9911H0.222698V5.89045H3.58958V15.9911ZM3.92717 1.96389C3.92717 0.897859 3.08323 0.0361424 2.01719 0.000607979C0.933392 -0.0260429 0.0272588 0.826778 0.00060798 1.91058C-0.0260429 2.99438 0.826779 3.90051 1.91058 3.92716C3.01215 3.93605 3.9094 3.06546 3.92717 1.96389ZM15.9467 9.88807C15.9467 6.74327 13.9124 5.78383 12.1801 5.78383C10.963 5.7483 9.81701 6.34351 9.15074 7.35624V5.89932H5.89933V16H9.26622V10.7587C9.26622 10.7054 9.26622 10.6521 9.26622 10.5988C9.26622 10.5988 9.26622 10.5988 9.26622 10.5899C9.19515 9.51495 10.0124 8.58218 11.0874 8.51111C11.9668 8.51111 12.6331 9.07966 12.6331 10.6787V16H16L15.9556 9.89695L15.9467 9.88807Z"
                                        fill="white" />
                                </svg>
                            </a>
                        </li>

                        <li>
                            <a href="#0">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M15.9466 4.69593C15.8843 3.41522 15.5906 2.27682 14.6563 1.34297C13.7219 0.409114 12.5829 0.11562 11.3014 0.053363C9.97553 -0.0177877 6.01557 -0.0177877 4.69855 0.053363C3.41713 0.11562 2.28699 0.409114 1.34372 1.34297C0.400455 2.27682 0.115684 3.41522 0.0533926 4.69593C-0.0177975 6.02111 -0.0177975 9.97887 0.0533926 11.3041C0.115684 12.5848 0.409354 13.7232 1.34372 14.657C2.28699 15.5909 3.41713 15.8844 4.69855 15.9466C6.02447 16.0178 9.98443 16.0178 11.3014 15.9466C12.5829 15.8844 13.7219 15.5909 14.6563 14.657C15.5906 13.7232 15.8843 12.5848 15.9466 11.3041C16.0178 9.97887 16.0178 6.02112 15.9466 4.70483V4.69593ZM7.99111 12.2201C5.65963 12.2201 3.76419 10.3257 3.76419 7.99555C3.76419 5.66536 5.65963 3.77098 7.99111 3.77098C10.3226 3.77098 12.218 5.66536 12.218 7.99555C12.218 10.3257 10.3226 12.2201 7.99111 12.2201ZM12.9032 3.99332C12.4138 3.99332 12.0133 3.5931 12.0133 3.10394C12.0133 2.61478 12.4049 2.21456 12.9032 2.21456C13.3926 2.21456 13.7931 2.61478 13.7931 3.10394C13.7931 3.5931 13.3926 3.99332 12.9032 3.99332ZM10.8832 7.99555C10.8832 9.58754 9.58399 10.886 7.99111 10.886C6.39823 10.886 5.09901 9.58754 5.09901 7.99555C5.09901 6.40355 6.39823 5.10505 7.99111 5.10505C9.58399 5.10505 10.8832 6.40355 10.8832 7.99555Z"
                                        fill="white" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Sidebar area end here -->



        <!-- Start Search Popup -->
        <div class="search-popup">
            <button class="close-search style-two"><i class="fas fa-times"></i></button>
            <button class="close-search"><i class="fas fa-arrow-up"></i></button>
            <form method="post" action="#">
                <div class="form-group">
                    <input id="search1" type="search" name="search-field" value=""
                        placeholder="Search Here" required="">
                    <button type="submit"><i class="fas fa-search"></i></button>
                </div>
            </form>
        </div>
        <!-- End Search Popup -->



        <main class="">
            {{ $slot }}
        </main>


        <!--sign up section home2-->
        {{-- <div class="sign-up-section-home2" style="    margin: 30px 0px 0 0px;">
            <div class="auto-container">
                <div class="row align-items-center">
                    <div class="col-xl-6">
                        <div class="sign-up-title">
                            <h2>Subscribe for Logistics Insights & Updates!</h2>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="sign-up">
                            <form action="" method="POST">
                                <div class="sign-up-form">
                                    <div class="form-input-bx">
                                        <input type="email" name="email" placeholder="Enter Your E-Mail"
                                            required="">
                                        <span><i class="fa-regular fa-envelope"></i></span>
                                        <button type="submit">Subscribe <i class="fa-solid fa-arrow-right-long"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <!--sign up section home2-->

        <!-- Main Footer -->
        <footer class="main-footer-one">
            <div class="auto-container">


                <!--main footer Section-->
                <div class="main-footer-section">
                    <div class="auto-container">
                        <div class="row">
                            <!--Footer Column-->
                            <div class="col-xl-3 col-lg-12 col-md-6">
                                <div class="footer-widget-content social">
                                    <div class="logo"><a href="/"><img
                                                src="{{ asset($logos['logo_dark'] ?? '') }}" alt="logo"
                                                width="180"></a></div>
                                    <div class="footer-desc">{{ $website_info['footer_about'] ?? '' }}
                                    </div>
                                    <ul class="footer-social">
                                        @if (isset($social_medias['twitter']))
                                            <li><a href="{{ $social_medias['twitter'] }}"><i
                                                        class="fa-brands fa-x-twitter text-white"></i></a>
                                            </li>
                                        @endif
                                        @if (isset($social_medias['facebook']))
                                            <li><a href="{{ $social_medias['facebook'] }}"><i
                                                        class="fab fa-facebook-f text-white"></i></a></li>
                                        @endif
                                        @if (isset($social_medias['pinterest']))
                                            <li><a href="{{ $social_medias['pinterest'] }}"><i
                                                        class="fab fa-pinterest text-white"></i></a></li>
                                        @endif
                                        @if (isset($social_medias['instagram']))
                                            <li><a href="{{ $social_medias['instagram'] }}"><i
                                                        class="fab fa-instagram text-white"></i></a></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>

                            @php
                                $footerMenus = \App\Models\Menu::where('type', 'footer')->first()?->menu;
                                $footerMenus = collect($footerMenus)
                                    ->filter(fn($item) => !empty($item['children']))
                                    ->take(2);
                            @endphp

                            @foreach ($footerMenus as $menu)
                                <!--Footer Column-->
                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                                    <div class="footer-widget-content">

                                        {{-- Level 1 as Heading --}}
                                        <h2 class="footer-title">
                                            {{ $menu['label'] }}
                                        </h2>

                                        {{-- Children as Links --}}
                                        <ul class="footer-menu">

                                            @foreach ($menu['children'] as $child)
                                                <li>
                                                    <a href="{{ url($child['url']) }}">
                                                        {{ $child['label'] }}

                                                        <i class="fa-solid fa-arrow-right-long"></i>
                                                    </a>
                                                </li>
                                            @endforeach

                                        </ul>

                                    </div>
                                </div>
                            @endforeach

                            <!--Footer Column-->
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                                <div class="footer-widget-content mb-5">
                                    <h2 class="footer-title">Contact Us</h2>
                                    <div class="footer-content">
                                        <div class="location pb-0"><span class="pb-0 mb-0">Our
                                                Address</span>{{ $website_info['location'] ?? '' }}</div>

                                        <ul class="contact-info">
                                            <li class="email-text pb-0 mb-0"><a href="#" class="pb-0 mb-0">Send
                                                    E-Mail</a></li>
                                            @php
                                                $emails = explode(',', $website_info['email'] ?? '');
                                                $phones = explode(',', $website_info['phone'] ?? '');
                                            @endphp
                                            <li class="email-address"><a
                                                    href="mailto:{{ $emails[0] ?? '' }}">{{ $emails[0] ?? '' }}</a>
                                            </li>
                                            <li class="email-address"><a
                                                    href="mailto:{{ $emails[1] ?? '' }}">{{ $emails[1] ?? '' }}</a>
                                            </li>
                                        </ul>
                                        <ul class="contact-info">
                                            <li class="email-text pb-0 mb-0"><a class="pb-0 mb-0" href="#">Call
                                                    us</a></li>
                                            <li class="email-address"><a
                                                    href="tel:{{ $phones[0] ?? '' }}">{{ $phones[0] ?? '' }}</a>
                                            </li>
                                            <li class="email-address"><a
                                                    href="tel:{{ $phones[1] ?? '' }}">{{ $phones[1] ?? '' }}</a>
                                            </li>
                                        </ul>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="footer-shape">
                            <div class="footer-shape1">
                                <img src="{{ url('frontend/images') }}/home2/footer-shape1.png" alt="footer shape">
                            </div>
                            {{-- <div class="footer-shape2">
                            <img src="{{ url('frontend/images') }}/home2/footer-shape2.png" alt="footer shape">
                        </div> --}}
                        </div>
                    </div>

                    <!--Footer Bottom-->
                    <div class="footer-bottom">
                        <div class="auto-container">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="copyright-text">&copy;
                                        {{ $website_info['footer_copy_right'] ? str_replace('_yyyy_', date('Y'), $website_info['footer_copy_right']) : '' }}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="footer-bottom-menu">
                                        <ul>
                                            <li><a href="{{ url('privacy-policy') }}">Privacy and Policy</a></li>
                                            <li><a href="{{ url('sitemap.xml') }}" target="_blank">Sitemap</a></li>
                                            <li><a href="{{ url('faq') }}">FAQ’s</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </footer>

        <!--End Main Footer -->

        {{-- get quote modal --}}
        <div class="modal fade" id="getQuoteModal" tabindex="-1" aria-labelledby="getQuoteModalLabel"
            aria-hidden="true" style="background: rgba(0, 0, 0, 0.5);">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="getQuoteModalLabel">Get a Quote</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form action="{{ route('contact.store') }}" method="POST" id="getQuoteForm">
                        <div class="modal-body">
                            <div class="contact-section-home2-classic">
                                <div class="contact-form-box p-0">


                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-box">
                                                <input type="text" name="name" placeholder="Your Name"
                                                    required>
                                                <i class="fa-solid fa-user"></i>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-box">
                                                <input type="text" name="phone" placeholder="Phone No."
                                                    required>
                                                <i class="fa-solid fa-circle-phone"></i>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-box">
                                                <input type="email" name="email" placeholder="Enter E-Mail"
                                                    required>
                                                <i class="fa-solid fa-envelope"></i>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-box">
                                                <input type="text" name="subject" placeholder="Enter Subject"
                                                    required>
                                                <i class="fa fa-tag"></i>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-box message">
                                                <textarea name="message" id="message" cols="30" rows="10" placeholder="Write Message..." required></textarea>
                                                <i class="fa-solid fa-message"></i>
                                            </div>
                                        </div>
                                        <div class="col-12 p-2">
                                            <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}">
                                            </div>
                                            <small class="text-danger error-g-recaptcha-response"></small>
                                        </div>
                                        <div class="form-alert"></div>
                                        <div class="d-flex justify-content-end gap-2 aligin-items-center">
                                            <div class="contact-form">
                                                <button type="submit">Send Message<i
                                                        class="fa-solid fa-arrow-right"></i></button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>





        <!-- Scroll To Top -->
        <div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-up"></span></div>
    </div>
    {!! html_entity_decode($google_analytics['footer_codes'] ?? '') !!}
    <script src="{{ asset('backend/lib/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.js') }}"></script>
    <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/magnific.js') }}"></script>
    <script src="{{ asset('frontend/js/wow.js') }}"></script>
    <script src="{{ asset('frontend/js/appear.js') }}"></script>
    <script src="{{ asset('frontend/js/swiper.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('frontend/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/js/nice-select.js') }}"></script>
    <script src="{{ asset('frontend/js/gsap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/ScrollTrigger.min.js') }}"></script>
    <script src="{{ asset('frontend/js/ScrollToPlugin.min.js') }}"></script>
    <script src="{{ asset('frontend/js/ScrollSmoother.min.js') }}"></script>
    <script src="{{ asset('frontend/js/SplitText.js') }}"></script>
    <script src="{{ asset('frontend/js/cusor-text.js') }}"></script>
    <script src="{{ asset('frontend/js/script.js') }}"></script>
    <script src="{{ asset('frontend/js/custom.js') }}"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        $('#contactForm, #getQuoteForm, #quickContactForm').on('submit', function(e) {
            e.preventDefault();

            let form = $(this);
            let btn = form.find('button[type="submit"]');
            let originalBtnText = btn.html();

            // Clear old errors
            form.find('.text-danger').html('');
            form.find('.form-control').removeClass('is-invalid');

            // Button loading state
            btn.prop('disabled', true);
            btn.html('<span class="spinner-border spinner-border-sm"></span> Sending...');

            let formData = new FormData(this);

            $.ajax({
                url: form.attr('action'),
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,

                success: function(res) {

                    form.find('.form-alert').html(
                        '<span class="text-success">Message sent successfully!</span>'
                    );

                    form[0].reset();

                    if (typeof grecaptcha !== "undefined") {
                        grecaptcha.reset();
                    }

                    btn.prop('disabled', false).html(originalBtnText);
                },

                error: function(xhr) {

                    btn.prop('disabled', false).html(originalBtnText);

                    if (xhr.status === 422) {

                        let errors = xhr.responseJSON.errors;

                        $.each(errors, function(key, value) {

                            let field = form.find('[name="' + key + '"]');

                            field.addClass('is-invalid');

                            form.find('.error-' + key).html(value[0]);
                        });

                    } else {

                        form.find('.form-alert').html(
                            '<span class="text-danger">Something went wrong. Try again.</span>'
                        );
                    }
                }
            });
        });
    </script>
    @php
        $custom_header_codes = \App\Models\CustomCode::where('type', 'footer')->get();
    @endphp
    @foreach ($custom_header_codes as $code)
        {!! html_entity_decode($code->codes) !!}
    @endforeach
    @stack('scripts')


</body>

</html>
