<style>
    .zigzag-section .zigzag-img-wrapper {
        height: 400px;
        /* Adjust this value to your preference */
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .zigzag-section .zigzag-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* Ensures the image fills the area without distortion */
        transition: transform 0.3s ease;
    }

    .zigzag-section .zigzag-img-wrapper img:hover {
        transform: scale(1.02);
    }

    /* Extra breathing room for mobile */
    @media (max-width: 767.98px) {
        .zigzag-section .row {
            margin-bottom: 3rem;
        }

        .zigzag-section .zigzag-img-wrapper {
            height: 300px;
            margin-bottom: 1.5rem;
        }
    }
</style>
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
<section class="zigzag-section py-5" style="{{ $styles }}">
    <div class="container py-lg-4">
        <div class="row text-start  intro">
            <div class="col-12">
                <span class="pre-title w-auto"> {!! html_entity_decode($section_subtitle) !!} </span>
                <h2>{!! html_entity_decode($section_title) !!}</h2>
            </div>
        </div>
        @foreach ($items as $index => $item)
            <div class="row align-items-center mb-5 pb-lg-4">

                {{-- Image Column --}}
                <div class="col-md-6 {{ $index % 2 != 0 ? 'order-md-2' : '' }}">
                    <div class="zigzag-img-wrapper rounded  rounded-4">
                        <img src="{{ asset(imgUrl($item['img'])) }}" alt="{{ $item['title'] }}">
                    </div>
                </div>

                {{-- Content Column --}}
                <div class="col-md-6 {{ $index % 2 != 0 ? 'order-md-1 ' : 'text-right' }}">
                    <div class="{{ $index % 2 != 0 ? 'pe-md-5' : 'ps-md-5' }}">
                        <span class="fw-bold text-uppercase small letter-spacing-1">
                            {{ html_entity_decode($item['subtitle']) }}
                        </span>

                        <h2 class="fw-bold mt-2 mb-3">
                            {{ html_entity_decode($item['title']) }}
                        </h2>

                        <p class="text-secondary leading-relaxed fs-5">
                            {{ html_entity_decode($item['desc']) }}
                        </p>

                        {{-- Optional: Add a CTA if needed --}}
                        @if (isset($item['link']))
                            <a href="{{ $item['link'] }}" class="btn btn-outline-dark mt-3 px-4">Learn More</a>
                        @endif
                    </div>
                </div>

            </div>
        @endforeach
    </div>
</section>
