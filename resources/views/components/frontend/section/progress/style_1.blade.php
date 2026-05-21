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
<section id="process" class="section-3 process offers" style="{{ $styles }}">
    <div class="container full">
        <div class="row text-center intro">
            <div class="col-12">
                <span class="pre-title">{!! $section_subtitle !!}</span>
                <h2>{!! $section_title !!}</h2>
                <p class="text-max-800">{!! $section_desc !!}</p>
            </div>
        </div>
        <div class="row justify-content-center text-center items">
            @foreach ($items as $item)
                <div class="col-12 col-md-6 col-lg-2 item">
                    <div class="step"><span>{!! $item['step'] !!}</span></div>
                    <h4>{!! $item['title'] !!}</h4>
                    <p>{!! $item['desc'] !!}</p>
                </div>
            @endforeach

        </div>
    </div>
</section>
