@props([
    'section_title' => '',
    'section_subtitle' => '',
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
<section class="section-1 offers featured" style="{{ $styles }}">

    <div class="container">
        <div class="row text-start  intro">
            <div class="col-12">
                <span class="pre-title w-auto"> {!! html_entity_decode($section_subtitle) !!} </span>
                <h2 class="">{!! html_entity_decode($section_title) !!}</h2>
            </div>
        </div>
        <div class="row justify-content-center items">
            @foreach ($items as $item)
                <div data-aos="fade-up" class="col-12 col-md-6 col-lg-4  item aos-init aos-animate">
                    <div class="card  p-4 mb-3">
                        <div class="col-12">
                            <i class="icon featured  {{ $item['icon'] }}" style="margin:unset !important;"></i>
                            <h4>{!! html_entity_decode($item['title']) !!} </h4>
                            <p>{!! html_entity_decode($item['desc']) !!} </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
