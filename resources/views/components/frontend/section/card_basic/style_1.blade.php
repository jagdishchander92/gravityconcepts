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
<section style="{{ $styles }}">
    <div class="col-12 align-self-top text-center text-md-left text">
        <div class="row text-center intro">
            <div class="col-12">
                <span class="pre-title m-auto"> {!! $section_subtitle !!} </span>
                <h2>{!! $section_title !!}</h2>
            </div>
        </div>
        <div class="container">
            <div class="row items text-left">
                @foreach ($items as $item)
                    <div data-aos="fade-up" class="col-12 col-md-6 col-lg-4 item aos-init aos-animate mb-3">
                        <div class="card border p-4 mb-3 h-100">
                            <div class="col-12">
                                <h4>{!! $item['title'] !!} </h4>
                                <p>{!! $item['desc'] !!} </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
