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
<section style="{{ $styles }}">
    <div class="container full">
        <div class="row text-center intro">
            <div class="col-12">
                <span class="pre-title">{!! $section_subtitle !!}</span>
                <h2>{!! $section_title !!}</h2>
            </div>
        </div>

        <div class="custom-counter">
            @foreach ($items as $item)
                <div class="custom-counter__item">
                    <div class="custom-counter__icon-wrap">
                        <i class="{{ $item['icon'] }}"></i>
                    </div>
                    <div class="custom-counter__number" data-target="{{ $item['title'] }}">0</div>
                    <div class="custom-counter__desc">{{ $item['desc'] }}</div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@push('styles')
    <style>
        .custom-counter {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 2px;
            background: #e2e8f0;
            border: 2px solid #e2e8f0;
            border-radius: 16px;
            overflow: hidden;
            margin-top: 48px;
        }

        .custom-counter__item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 12px;
            padding: 48px 32px;
            background: #fff;
            text-align: center;
            position: relative;
            transition: background 0.3s ease, transform 0.3s ease;
            cursor: default;
        }

        .custom-counter__item:hover {
            background: #f8faff;
            z-index: 1;
        }

        .custom-counter__icon-wrap {
            width: 60px;
            height: 60px;
            border-radius: 14px;
            background: var(--primary-bg-color-3);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s ease, background 0.3s ease;
        }

        .custom-counter__item:hover .custom-counter__icon-wrap {
            transform: translateY(-4px) scale(1.08);
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        }

        .custom-counter__icon-wrap i {
            font-size: 22px;
            color: var(--primary-color);
            transition: color 0.3s ease;
        }

        .custom-counter__item:hover .custom-counter__icon-wrap i {
            color: #fff;
        }


        .custom-counter__number {
            font-size: 2.6rem;
            font-weight: 800;
            line-height: 1;
            color: #1e1b4b;
            letter-spacing: -1px;
            font-variant-numeric: tabular-nums;
        }


        .custom-counter__desc {
            font-size: 0.88rem;
            font-weight: 500;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }


        @media (max-width: 600px) {
            .custom-counter {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 380px) {
            .custom-counter {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        (function() {
            function animateCounter(el) {
                const target = parseInt(el.dataset.target, 10);
                const duration = 1800;
                const start = performance.now();

                function step(now) {
                    const elapsed = now - start;
                    const progress = Math.min(elapsed / duration, 1);
                    // Ease-out cubic
                    const eased = 1 - Math.pow(1 - progress, 3);
                    el.textContent = Math.floor(eased * target).toLocaleString();
                    if (progress < 1) requestAnimationFrame(step);
                    else el.textContent = target.toLocaleString();
                }
                requestAnimationFrame(step);
            }

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        animateCounter(entry.target);
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.4
            });

            document.querySelectorAll('.custom-counter__number').forEach(el => observer.observe(el));
        })();
    </script>
@endpush
