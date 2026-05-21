@props([
    'section_title',
    'section_subtitle',
    'section_desc' => '',
    'items' => [],
    'section_bg_img' => '',
    'section_bg_color' => '',
    'section_text_color' => '',
])
@php
    $styles = '';
    if ($section_bg_color) {
        $styles .= "background-color:$section_bg_color;";
    }
    if ($section_bg_img) {
        $styles .=
            "
            background-image:
                linear-gradient(rgba(0,0,0,0.55), rgba(0,0,0,0.55)),
                url('" .
            imgUrl($section_bg_img) .
            "');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        ";
    }
    if ($section_text_color) {
        $styles .= "color:$section_text_color;";
    }
@endphp
<section id="about-3" class="section-3 highlights image-right featured" style="{{ $styles }}">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8 pr-md-5 align-self-center text-center text-md-left text">
                <div data-aos="fade-up" class="row intro aos-init aos-animate">
                    <div class="col-12 p-0">
                        <span class="pre-title m-auto m-md-0">{!! html_entity_decode($section_subtitle) !!}</span>
                        <h2>{!! html_entity_decode($section_title) !!}</h2>
                        <p>{!! html_entity_decode($section_desc) !!}</p>
                    </div>
                </div>
                <div class="row items">
                    <div data-aos="fade-up" class="col-12 col-md-6 p-0 pr-md-4 item aos-init aos-animate">
                        <h4><i class="mr-2 {{ $items[0]['icon1'] ?? '' }}"></i>{{ $items[0]['title1'] ?? '' }}</h4>
                        <p>{{ $items[0]['desc1'] ?? '' }}</p>
                    </div>
                    <div data-aos="fade-up" class="col-12 col-md-6 p-0 pr-md-4 item aos-init aos-animate">
                        <h4><i class="mr-2 {{ $items[0]['icon2'] ?? '' }}"></i>{{ $items[0]['title2'] ?? '' }}</h4>
                        <p>{{ $items[0]['desc1'] ?? '' }}</p>
                    </div>
                </div>
                <div class="row items">
                    <div data-aos="fade-up" class="col-12 col-md-6 p-0 pr-md-4 item aos-init aos-animate">
                        <h4><i class="mr-2 {{ $items[0]['icon3'] ?? '' }}"></i>{{ $items[0]['title3'] ?? '' }}</h4>
                        <p>{{ $items[0]['desc3'] ?? '' }}</p>
                    </div>
                    <div data-aos="fade-up" class="col-12 col-md-6 p-0 pr-md-4 item aos-init aos-animate">
                        <h4><i class="mr-2 {{ $items[0]['icon4'] ?? '' }}"></i>{{ $items[0]['title4'] ?? '' }}</h4>
                        <p>{{ $items[0]['desc4'] ?? '' }}</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 p-0 image">
                <img src="{{ asset(imgUrl($items[0]['img'])) }}" class="fit-image" alt="Fit Image">
            </div>
        </div>
    </div>
</section>
