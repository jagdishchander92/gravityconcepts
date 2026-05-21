@props([
    'section_title',
    'section_subtitle',
    'section_desc' => '',
    'items' => [],
    'section_bg_img' => '',
    'section_bg_color' => '',
    'section_text_color' => '',
])
@push('styles')
    <style>
        .section-3.offers ol {
            list-style: none;
            counter-reset: custom-counter;
            padding-left: 0;
            margin-top: 30px;
        }

        .section-3.offers ol li {
            counter-increment: custom-counter;
            position: relative;
            padding: 18px 20px 18px 60px;
            margin-bottom: 15px;
            background: #f8f9fa;
            border-radius: 10px;
            font-size: 15px;
            line-height: 1.6;
            transition: all 0.3s ease;
        }

        .section-3.offers ol li:hover {
            background: #eef2f7;
            transform: translateY(-2px);
        }

        .section-3.offers ol li::before {
            content: counter(custom-counter);
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            width: 32px;
            height: 32px;
            background: var(--primary-color);
            color: #fff;
            font-weight: 600;
            font-size: 14px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .section-3.offers ol li span {
            display: block;
        }
    </style>
@endpush
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
<section class="section-3 offers" style="{{ $styles }}">
    <div class="overflow-holder">
        <div class="container">
            <div class="row text-center intro">
                <div class="col-12">
                    <span class="pre-title">{!! html_entity_decode($section_subtitle) !!}</span>
                    <h2>{!! html_entity_decode($section_title) !!}</h2>
                    <p class="text-max-800">{!! html_entity_decode($section_desc) !!}</p>
                </div>
            </div>
            <ol>
                @foreach ($items as $item)
                    <li>

                        <span>{!! html_entity_decode($item['text']) !!}</span>

                    </li>
                @endforeach

            </ol>
        </div>
    </div>
</section>
