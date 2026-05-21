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
        /* SIMPLE LIST STYLE ONLY */
        .ul-list-simple {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 12px 24px;
            padding: 0;
            margin-top: 30px;
        }

        .ul-list-simple li {
            list-style: none;
            position: relative;
            padding-left: 22px;
        }

        /* custom bullet */
        .ul-list-simple li::before {
            content: "";
            position: absolute;
            left: 0;
            top: 8px;
            width: 8px;
            height: 8px;
            background: var(--primary-color);
            border-radius: 50%;
        }

        /* text styling */
        .ul-list-simple li span {
            font-size: 15px;
            color: #374151;
            line-height: 1.6;
            display: block;
        }

        /* subtle hover (optional but nice) */
        .ul-list-simple li:hover span {
            color: #111827;
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
            <div class="ul ul-list-simple">
                @foreach ($items as $item)
                    <li>

                        <span>{!! html_entity_decode($item['text']) !!}</span>

                    </li>
                @endforeach

            </div>
        </div>
    </div>
</section>
