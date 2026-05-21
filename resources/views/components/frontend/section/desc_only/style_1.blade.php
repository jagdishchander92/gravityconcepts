@props([
    'section_title' => '',
    'section_subtitle' => '',
    'description' => '',
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
<section class="section-3 highlights" style="{{ $styles }}">
    <div class="container">
        <div class="row">
            <div class="col-12 align-self-center text-center text-md-left text">
                <div data-aos="fade-up" class="row intro aos-init aos-animate">
                    <div class="col-12">
                        <span class="pre-title m-auto m-md-0">{!! html_entity_decode($section_subtitle) !!}</span>
                        <h2 style="color: {{ $section_text_color }}">{!! html_entity_decode($section_title) !!}</h2>
                        {!! html_entity_decode(nl2br(e($description))) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>