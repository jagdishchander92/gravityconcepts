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
<section id="services" class="section-4 odd offers" style="{{ $styles }}">
    <div class="container">
        <div class="row items">

            <div class="col-12 col-md-4 pr-md-5 text">
                <div data-aos="fade-up" class="row intro aos-init aos-animate">
                    <div class="col-12 p-0">
                        <span class="pre-title m-0">{!! html_entity_decode($section_subtitle) !!}</span>
                        <h2 class="mb-0">
                            {!! html_entity_decode($section_title) !!}
                        </h2>
                    </div>
                </div>
            </div>
            @foreach ($items as $index => $item)
                @if ($index == 0)
                    <div data-aos="fade-up" class="col-12 col-md-8 item aos-init aos-animate">
                        <div class="card">
                            <i class="icon featured  {{ $item['icon'] }}"></i>
                            <h4> {!! html_entity_decode($item['title']) !!}</h4>
                            <p>{!! html_entity_decode($item['desc']) !!}</p>
                            <a href="{{$item['slug']?  url($item['slug'] ?? '/'):'javascript:void(0);' }}">
                                <i class="btn-icon pulse fas fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                @else
                    <div data-aos="fade-up" class="col-12 col-md-4 item aos-init aos-animate">
                        <div class="card">
                            <i class="icon featured  {{ $item['icon'] }}"></i>
                            <h4> {!! html_entity_decode($item['title']) !!}</h4>
                            <p>{!! html_entity_decode($item['desc']) !!}</p>
                            <a href="{{$item['slug']?  url($item['slug'] ?? '/'):'javascript:void(0);' }}"><i
                                    class="btn-icon pulse fas fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>
