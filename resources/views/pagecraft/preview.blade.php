@extends('layouts.pagecraft')

@section('title', 'PageCraft - Live Render')

@push('styles')
    <!-- Bootstrap 5 + FontAwesome + Swiper -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

    <!-- COMPLETE PAGECRAFT CSS (paste your FULL original CSS here) -->
    <style>
        :root {
            --bg: #f0f2f5;
            --surface: #ffffff;
            --surface2: #f7f8fa;
            --surface3: #edf0f4;
            --border: #d6dae4;
            --border2: #c2c8d6;
            --accent: #5b52f0;
            --accent2: #e05252;
            --accent3: #22c069;
            --text: #1a1d2e;
            --text2: #4a5270;
            --text3: #8a90a8;
            --panel-w: 280px;
            --prop-w: 320px;
            --toolbar-h: 48px;
            --radius: 8px;
            --font: 'Segoe UI', system-ui, sans-serif;
        }

        /* ALL YOUR ORIGINAL CSS GOES HERE - Copy entire <style> from your HTML */
        /* ... (paste everything from your original PageCraft <style> tag) ... */

        /* Home2 Theme Styles - COMPLETE */
        .w-banner-home2 {
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #1a1d27 0%, #2d3142 100%);
            padding: 100px 0;
            color: white;
        }

        .banner-slide {
            min-height: 500px;
            display: flex;
            align-items: center;
            position: relative;
        }

        .banner-content {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
            padding: 0 20px;
            width: 100%;
        }

        .banner-title h2 {
            font-size: 48px;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 20px;
            background: linear-gradient(45deg, #fff, #6c63ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .banner-title img {
            height: 50px;
            vertical-align: middle;
        }

        .banner-btn a {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 15px 30px;
            background: #6c63ff;
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 700;
            font-size: 16px;
            transition: all 0.3s;
        }

        .banner-autor-info {
            margin-top: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }

        .autor-img-box {
            position: relative;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .author-image img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border: 3px solid #6c63ff;
        }

        .autor-number {
            background: #6c63ff;
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 14px;
        }

        /* Swiper Navigation */
        .swiper-button-prev,
        .swiper-button-next {
            color: #6c63ff !important;
            background: rgba(255, 255, 255, 0.1);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-top: -25px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .banner-title h2 {
                font-size: 32px;
            }
        }

        /* Widget Styles - Essential ones */
        .w-heading h1,
        .w-heading h2,
        .w-heading h3 {
            color: var(--text);
            line-height: 1.2;
            margin: 0;
        }

        .w-heading p {
            color: var(--text2);
            font-size: 13px;
            margin-top: 4px;
        }

        .w-text p {
            color: var(--text2);
            line-height: 1.6;
            font-size: 13px;
            margin: 0;
        }

        .w-btn a {
            display: inline-block;
            padding: 8px 18px;
            background: var(--accent);
            color: #fff;
            border-radius: 6px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: opacity .15s;
        }

        .w-btn a.outline {
            background: none;
            border: 2px solid var(--accent);
            color: var(--accent);
        }

        .w-image img {
            width: 100%;
            border-radius: 6px;
            display: block;
        }

        .w-spacer {
            background: repeating-linear-gradient(45deg, transparent, transparent 4px, rgba(0, 0, 0, .03) 4px, rgba(0, 0, 0, .03) 8px);
            border: 1px dashed var(--border);
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text3);
            font-size: 10px;
        }

        /* PageCraft Section Styling */
        .pb-section {
            border: 1px solid var(--border);
            border-radius: 8px;
            margin-bottom: 10px;
            background: var(--surface);
            transition: border-color .15s;
        }

        .pb-section:hover {
            border-color: var(--accent);
        }

        .pb-section.nested {
            background: var(--surface2);
            border-style: dashed;
            margin: 4px 0;
        }
    </style>
@endpush

@section('content')
    @if (empty($sections))
        <div class="bg-white p-5 rounded-3 text-center shadow-lg mb-5">
            <i class="fa fa-file-import fs-1 text-muted mb-4"></i>
            <h2 class="text-dark mb-2">No JSON Data</h2>
            <p class="text-muted mb-4">Upload a PageCraft JSON file to see the live preview</p>
            <a href="{{ route('pagecraft.index') }}" class="btn btn-primary px-4 py-2">
                <i class="fa fa-upload me-2"></i> Upload JSON
            </a>
        </div>
    @else
        <div id="pagecraft-render" class="pagecraft-container">
            @foreach ($sections as $section)
                {!! pagecraft_render_bootstrap_section($section) !!}
            @endforeach
        </div>
    @endif
@endsection

@push('scripts')
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize ALL Swipers
            initAllSwipers();

            // Initialize Accordions
            initAccordions();
        });

        function initAllSwipers() {
            document.querySelectorAll('.swiper').forEach((el, index) => {
                if (!el.swiper) {
                    new Swiper(el, {
                        slidesPerView: 1,
                        spaceBetween: 30,
                        loop: true,
                        autoplay: {
                            delay: 5000,
                            disableOnInteraction: false
                        },
                        navigation: {
                            nextEl: `.swiper-button-next-${index}`,
                            prevEl: `.swiper-button-prev-${index}`,
                        },
                        pagination: {
                            el: `.swiper-pagination-${index}`,
                            clickable: true,
                        },
                        breakpoints: {
                            576: {
                                slidesPerView: 1
                            },
                            768: {
                                slidesPerView: 1
                            },
                            992: {
                                slidesPerView: 1.5
                            },
                            1200: {
                                slidesPerView: 2
                            },
                        }
                    });
                }
            });
        }

        function initAccordions() {
            document.addEventListener('click', function(e) {
                if (e.target.closest('.acc-q')) {
                    const item = e.target.closest('.acc-item');
                    item.classList.toggle('open');
                }
            });
        }
    </script>
@endpush

{{-- BOOTSTRAP-ENHANCED GLOBAL HELPER FUNCTIONS --}}
@php
    function pagecraft_render_bootstrap_section($section, $nestLevel = 0)
    {
        // Container type
        $containerClass = 'container';
        if (isset($section['style']['fullWidth']) && $section['style']['fullWidth']) {
            $containerClass = 'container-fluid';
        }

        // Section styling
        $sectionStyle = '';
        if (isset($section['style']['background'])) {
            $sectionStyle .= 'background: ' . $section['style']['background'] . ' !important;';
        }
        if (isset($section['style']['padding'])) {
            $sectionStyle .= 'padding: ' . $section['style']['padding'] . ' !important;';
        }
        if (isset($section['style']['margin'])) {
            $sectionStyle .= 'margin: ' . $section['style']['margin'] . ' !important;';
        }
        if (isset($section['style']['borderRadius'])) {
            $sectionStyle .= 'border-radius: ' . $section['style']['borderRadius'] . ' !important;';
        }
        if (isset($section['style']['border'])) {
            $sectionStyle .= 'border: ' . $section['style']['border'] . ' !important;';
        }

        $sectionClass = $nestLevel > 0 ? 'pb-section nested' : 'pb-section';
        $sectionClass .= isset($section['style']['fullWidth']) ? ' full-width-section' : '';
        if($section['style']['classes']){
        $containerClass  =$section['style']['classes'];
    }
        $html = '<div class="' . $containerClass . '">';
        $html .= '<div class="row g-3 g-md-4 ' . $sectionClass . '" style="' . $sectionStyle . '">';

        foreach ($section['cols'] as $colIndex => $col) {
            $bootstrapCol = pagecraft_width_to_bootstrap($col['width'] ?? 100);

            $colStyle = 'padding: 12px; min-height: 60px;';
            if (isset($col['flex']['background'])) {
                $colStyle .= 'background: ' . $col['flex']['background'] . ';';
            }

            $html .= '<div class="col ' . $bootstrapCol . '" style="' . $colStyle . '">';

            foreach ($col['widgets'] as $widget) {
                if ($widget['type'] === 'section') {
                    $html .= pagecraft_render_bootstrap_section($widget, $nestLevel + 1);
                } else {
                    $html .= pagecraft_render_widget($widget);
                }
            }

            $html .= '</div>';
        }

        $html .= '</div>'; // Close row
        $html .= '</div>'; // Close container
        return $html;
    }

    function pagecraft_width_to_bootstrap($widthPercent)
    {
        $width = (int) round($widthPercent);

        // Smart Bootstrap column mapping
        if ($width >= 95) {
            return 'col-12';
        }
        if ($width >= 66) {
            return 'col-12 col-md-8';
        }
        if ($width >= 58) {
            return 'col-12 col-md-7';
        }
        if ($width >= 50) {
            return 'col-12 col-md-6';
        }
        if ($width >= 42) {
            return 'col-12 col-md-5';
        }
        if ($width >= 34) {
            return 'col-12 col-md-4';
        }
        if ($width >= 25) {
            return 'col-12 col-sm-6 col-md-3';
        }
        if ($width >= 20) {
            return 'col-12 col-lg-2';
        }

        // Fallback
        return 'col';
    }

    function pagecraft_render_widget($widget)
    {
        $props = $widget['props'] ?? [];
        $style = $widget['style'] ?? [];

        $widgetStyle = '';
        if (isset($style['background'])) {
            $widgetStyle .= 'background: ' . $style['background'] . ' !important;';
        }
        if (isset($style['padding'])) {
            $widgetStyle .= 'padding: ' . $style['padding'] . ' !important;';
        }
        if (isset($style['margin'])) {
            $widgetStyle .= 'margin: ' . $style['margin'] . ' !important;';
        }
        if (isset($style['border'])) {
            $widgetStyle .= 'border: ' . $style['border'] . ' !important;';
        }
        if (isset($style['borderRadius'])) {
            $widgetStyle .= 'border-radius: ' . $style['borderRadius'] . ' !important;';
        }
        if (isset($style['color'])) {
            $widgetStyle .= 'color: ' . $style['color'] . ' !important;';
        }
        if (isset($style['fontSize'])) {
            $widgetStyle .= 'font-size: ' . $style['fontSize'] . ' !important;';
        }
        if (isset($style['fontWeight'])) {
            $widgetStyle .= 'font-weight: ' . $style['fontWeight'] . ' !important;';
        }
        if (isset($style['textAlign'])) {
            $widgetStyle .= 'text-align: ' . $style['textAlign'] . ' !important;';
        }
        if (isset($style['boxShadow'])) {
            $widgetStyle .= 'box-shadow: ' . $style['boxShadow'] . ' !important;';
        }

        switch ($widget['type']) {
            case 'card-img':
                return '<div class="card">
  <img src="' .
                    $widget['props']['img'] .
                    '" class="card-img-top img-fluid" alt="...">
  <div class="card-body">
    <h5 class="card-title">' .
                    $widget['props']['title'] .
                    '</h5>
    <p class="card-text">' .
                    $widget['props']['desc'] .
                    '</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>';

            case 'heading':
                $level = $props['level'] ?? 'h2';
                $headingClass = 'w-heading mb-0';
                // return '<div class="' .
                //     $headingClass .
                //     '" style="' .
                //     $widgetStyle .
                //     '">
            // <' .
                //     $level .
                //     ' class="mb-1">' .
                //     e($props['text'] ?? '') .
                //     '</' .
                //     $level .
                //     '>' .
                //     (isset($props['sub']) ? '<p class="mb-0 small">' . e($props['sub']) . '</p>' : '') .
                //     '</div>';

                return '<div class="sec-title">
							<div class="section-sub-title">
								<h1 class="sub-title"><img src="' .
                    asset('frontend/images/main-home/sub-title-icon.png') .
                    '" alt="sub-icon">' .
                    e($props['sub']) .
                    '</h1>
							</div>
							<div class="section-title">
								<h1 class="title title-anim" style="perspective: 400px;"><div style="display: block; text-align: start; position: relative; translate: none; rotate: none; scale: none; transform-origin: 324px 29px; transform: translate3d(0px, 0px, 0px); opacity: 1;">' .
                    e($props['text'] ?? '') .
                    '</div></h1>
							</div>
						</div>';

            case 'text':
                return '<div class="w-text" style="' .
                    $widgetStyle .
                    '"><p class="mb-0">' .
                    nl2br(e($props['content'] ?? '')) .
                    '</p></div>';

            case 'button':
                $btnClass = $props['style'] === 'outline' ? 'btn-outline-primary' : 'btn-primary';
                $btnStyle = 'border-radius: 6px; font-weight: 600;';
                return '<div class="w-btn" style="' .
                    $widgetStyle .
                    '">
                <a href="' .
                    e($props['href'] ?? '#') .
                    '" class="btn ' .
                    $btnClass .
                    '" style="' .
                    $btnStyle .
                    '">' .
                    e($props['label'] ?? 'Button') .
                    '</a></div>';

            case 'image':
                //     return '<div class="w-image" style="' .
                //         $widgetStyle .
                //         '">
            //     <img src="' .
                //         e($props['src'] ?? '') .
                //         '" alt="' .
                //         e($props['alt'] ?? '') .
                //         '" class="img-fluid rounded" loading="lazy">
            // </div>';

                return '<div class="about-thumb">
							<figure class="reveal" style="opacity: 1; visibility: inherit; translate: none; rotate: none; scale: none; transform: translate(0px, 0px);"><img src="' .
                    $props['src'] .
                    '" alt="about thumb" style="translate: none; rotate: none; scale: none; transform: translate(0px, 0px);"></figure>
						</div>';
            case 'html':
                return $props['code'] ?? '';

            case 'divider':
                $styleClass = $props['style'] ?? 'solid';
                return '<div class="w-divider my-3"><hr class="' . $styleClass . '"></div>';

            case 'spacer':
                $height = $props['height'] ?? 40;
                return '<div class="w-spacer" style="height: ' . $height . 'px; ' . $widgetStyle . '"></div>';

            case 'banner-home2-classic':
                return pagecraft_render_banner_home2($props, $widgetStyle);

            case 'stats':
                return pagecraft_render_stats($props, $widgetStyle);

            default:
                return '<div class="pb-widget p-3 border border-dashed border-secondary rounded text-center text-muted small" style="' .
                    $widgetStyle .
                    '">
                ' .
                    strtoupper($widget['type']) .
                    '
            </div>';
        }
    }

    function pagecraft_render_banner_home2($props, $widgetStyle)
    {
        $swiperId = 'banner-swiper-' . uniqid();
        $slides = '';

        foreach ($props['slides'] ?? [] as $index => $slide) {
            $slides .=
                '<div class="swiper-slide">
            <div class="banner-content">
                <div class="banner-title">
                    <h2>' .
                e($slide['title1'] ?? '') .
                (isset($slide['titleImg1'])
                    ? '<img src="' .
                        e($slide['titleImg1']) .
                        '" alt="" class="img-fluid" style="height:50px;vertical-align:middle;">'
                    : '') .
                e($slide['title2'] ?? '') .
                '</h2>
                    <h2 class="mb-4">' .
                e($slide['title3'] ?? '') .
                '</h2>
                </div>
                <div class="banner-btn mb-5">
                    <a href="' .
                e($slide['btnUrl'] ?? '#') .
                '" class="btn btn-lg btn-primary rounded-pill px-5 py-3">' .
                e($slide['btnText'] ?? 'Explore Services') .
                ' <i class="fa-solid fa-arrow-right ms-2"></i></a>
                </div>
                <div class="banner-autor-info">
                    <div class="autor-img-box d-flex align-items-center gap-3">
                        <div class="author-image">
                            <img src="' .
                e($slide['autor1'] ?? '') .
                '" alt="" class="rounded-circle border border-3 border-primary" style="width:60px;height:60px;object-fit:cover;">
                        </div>
                        <div class="autor-number bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold fs-6" style="width:60px;height:60px;">
                            ' .
                e($slide['autorNumber'] ?? '5k+') .
                '
                        </div>
                    </div>
                    <p class="autor-desc mt-3 mb-0">' .
                e($slide['autorDesc'] ?? '') .
                '</p>
                </div>
            </div>
        </div>';
        }

        return '<div class="w-banner-home2 position-relative" style="' .
            $widgetStyle .
            '">
        <div class="swiper ' .
            $swiperId .
            '" data-swiper-id="' .
            $swiperId .
            '">
            <div class="swiper-wrapper">' .
            $slides .
            '</div>
            <div class="loginet-banner-arrow-box2 position-absolute top-50 end-0 translate-middle-y me-4 d-flex gap-2 z-3">
                <button class="swiper-button-prev btn btn-sm btn-light rounded-circle p-0" style="width:50px;height:50px;">
                    <i class="fa-solid fa-arrow-left-long"></i>
                </button>
                <button class="swiper-button-next btn btn-sm btn-light rounded-circle p-0" style="width:50px;height:50px;">
                    <i class="fa-solid fa-arrow-right-long"></i>
                </button>
            </div>
        </div>
    </div>';
    }

    function pagecraft_render_stats($props, $widgetStyle)
    {
        $items = '';
        foreach ($props['items'] ?? [] as $stat) {
            $items .=
                '<div class="col-auto text-center">
            <div class="num fs-1 fw-bold text-primary mb-1">' .
                e($stat['num'] ?? '0') .
                '</div>
            <div class="lbl text-muted small">' .
                e($stat['label'] ?? '') .
                '</div>
        </div>';
        }

        return '<div class="w-stats" style="' .
            $widgetStyle .
            '">
        <div class="row g-3 justify-content-center">' .
            $items .
            '</div>
    </div>';
    }
@endphp
