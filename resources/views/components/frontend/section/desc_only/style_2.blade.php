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
            <div class="col-md-8 align-self-center text-center text-md-left text">
                <div data-aos="fade-up" class="row intro aos-init aos-animate">
                    <div class="col-12">
                        <span class="pre-title m-auto m-md-0">{!! html_entity_decode($section_subtitle) !!}</span>
                        <h2 style="color: {{ $section_text_color }}">{!! html_entity_decode($section_title) !!}</h2>
                        {!! html_entity_decode(nl2br(e($description))) !!}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow p-4 shadow-sm">

                    <h5 class="card-heading">Get In Touch</h5>

                    <form action="">
                        <div class="form-group mb-3">
                            <input type="text" class="form-control" placeholder="Name">
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" class="form-control" placeholder="Email">
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" class="form-control" placeholder="Phone">
                        </div>
                        <div class="form-group mb-3">
                            <textarea class="form-control" rows="3" placeholder="Message"></textarea>
                        </div>
                        <button class="btn btn-sm primary-button" type="button">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
