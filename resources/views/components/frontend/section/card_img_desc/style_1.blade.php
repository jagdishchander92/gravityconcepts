@props([
    'section_title',
    'section_subtitle',
    'section_desc',
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
<section id="services" class="section-1  highlights  featured" style="{{ $styles }}">
    <div class="container">

        <div class="row text-center intro">
            <div class="col-12">
                <span class="pre-title">{!! html_entity_decode($section_subtitle) !!}</span>
                <h2 class="">{!! html_entity_decode($section_title) !!}</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="image-over">
                    <img src="{{ asset(imgUrl($items[0]['img'])) }}" alt="">
                </div>
            </div>
            <div class="col-md-8">
                <div class="d-flex flex-column justify-content-center h-100">
                    <h3>{!! html_entity_decode($items[0]['title'] ?? '') !!} </h3>
                    <p>{!! html_entity_decode($section_desc ?? '') !!} </p>
                </div>
            </div>
        </div>
    </div>
</section>
