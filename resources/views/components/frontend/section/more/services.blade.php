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
<section id="services" class="section-2 odd offers" style="{{ $styles }}">
    <div class="container">
        <div class="row intro">
            <div class="col-12 col-md-9 align-self-center text-center text-md-left">
                <span class="pre-title m-auto ml-md-0">{!! html_entity_decode($section_subtitle) !!}</span>
                <h2 class="mb-0">{!! html_entity_decode($section_title) !!}</h2>
            </div>
            {{-- <div class="col-12 col-md-3 align-self-end">
                <a href="#contact" class="smooth-anchor btn mx-auto mr-md-0 ml-md-auto outline-button">GET IN TOUCH</a>
            </div> --}}
        </div>
        <div class="row justify-content-center items">
            @foreach ($items as $item)
                <div data-aos="fade-up" class="col-12 col-md-6 item aos-init aos-animate">
                    <div class="card">
                        <i class="icon {{ $item['icon'] }}"></i>
                        <h4>{!! html_entity_decode($item['title']) !!}</h4>
                        <p>{!! html_entity_decode($item['desc']) !!}</p>
                        @if ($item['slug'])
                            <a href="{{ url($item['slug']) }}"><i class="btn-icon pulse fas fas fa-arrow-right"></i></a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
