@props([
    'section_title' => '',
    'section_subtitle' => '',
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
<section class="showcase" style="{{ $styles }}">
    <div class="container">
        <div class="row text-start  intro">
            <div class="col-12">
                <span class="pre-title w-auto"> {!! html_entity_decode($section_subtitle) !!} </span>
                <h2>{!! html_entity_decode($section_title) !!}</h2>
            </div>
        </div>
        <div class="row">
            @foreach ($items as $item)
                <div class="col-12 col-md-6 col-lg-4 mb-3">
                    <div class="row card p-0 text-center">
                        <div class="image-over">
                            <img src="{{ asset(imgUrl($item['img'])) }}" alt="Lorem ipsum">
                        </div>
                        <div class="card-caption col-12 p-0">
                            <div class="card-body">
                                <a href="{{ url($item['slug'] ?? '#') }}">
                                    <h4> {!! html_entity_decode($item['title']) !!} </h4>
                                    <p>{!! html_entity_decode($item['desc']) !!}</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>
    </div>
</section>
