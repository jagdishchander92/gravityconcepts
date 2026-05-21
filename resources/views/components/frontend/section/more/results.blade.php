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
<section id="about-2" class="section-2 odd highlights image-right counter funfacts featured" style="{{ $styles }}">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 pr-md-5 align-self-top text">
                <div data-aos="fade-up" class="row intro m-0 m-md-auto aos-init aos-animate">
                    <div class="col-12 p-0">
                        <span class="pre-title m-0">{!! html_entity_decode($section_subtitle) !!}</span>
                        <h2>{!! html_entity_decode($section_title) !!}</h2>
                        {!! html_entity_decode($section_desc) !!}
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 pr-md-5 align-self-top text">
                <div class="row items">
                    <div data-aos="fade-up" class="col-12 col-md-6 p-0 pr-md-4 mb-2 item aos-init aos-animate">
                        <div data-percent="{{ $items[0]['count1'] ?? '' }}" class="radial left w-100 "><canvas width="70"
                                height="70"></canvas>
                            <span>{{ $items[0]['count1'] ?? '' }}</span>
                        </div>
                        <h4 class="text-center">{{ $items[0]['title1'] ?? '' }}</h4>
                        <p class="text-center">{{ $items[0]['desc1'] ?? '' }}</p>
                    </div>
                    <div data-aos="fade-up" class="col-12 col-md-6 p-0 pr-md-4 mb-2 item aos-init aos-animate">
                        <div data-percent="{{ $items[0]['count2'] ?? '' }}" class="radial left  w-100"><canvas width="70"
                                height="70"></canvas>
                            <span>{{ $items[0]['count2'] ?? '' }}</span>
                        </div>
                        <h4 class="text-center">{{ $items[0]['title2'] ?? '' }}</h4>
                        <p class="text-center">{{ $items[0]['desc2'] ?? '' }}</p>
                    </div>
                </div>
                <div class="row items">
                    <div data-aos="fade-up" class="col-12 col-md-6 p-0 pr-md-4 mb-2 item aos-init aos-animate">
                        <div data-percent="{{ $items[0]['count3'] ?? '' }}" class="radial left  w-100"><canvas width="70"
                                height="70"></canvas>
                            <span>{{ $items[0]['count3'] ?? '' }}</span>
                        </div>
                        <h4 class="text-center">{{ $items[0]['title3'] ?? '' }}</h4>
                        <p class="text-center">{{ $items[0]['desc3'] ?? '' }}</p>
                    </div>
                    <div data-aos="fade-up" class="col-12 col-md-6 p-0 pr-md-4 mb-2 item aos-init aos-animate">
                        <div data-percent="{{ $items[0]['count4'] ?? '' }}" class="radial left  w-100"><canvas width="70"
                                height="70"></canvas>
                            <span>{{ $items[0]['count4'] ?? '' }}</span>
                        </div>
                        <h4 class="text-center">{{ $items[0]['title4'] ?? '' }}</h4>
                        <p class="text-center">{{ $items[0]['desc4'] ?? '' }}</p>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>
