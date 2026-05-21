@props([
    'section_subtitle' => '',
    'section_title' => '',
    'items' => [],
    'section_bg_img' => '',
    'section_bg_color' => '',
    'section_text_color' => '',
])
@push('styles')
    <style>
        /* ── FAQ Section ── */
        .faq-section {
            background: var(--primary-bg-color);
            padding: 96px 0 112px;
            position: relative;
            overflow: hidden;
        }

        .faq-section::before {
            content: '';
            position: absolute;
            top: -180px;
            right: -180px;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, var(--primary-bg-color-3) 0%, transparent 70%);
            pointer-events: none;
        }

        .faq-container {
            max-width: 860px;
            margin: 0 auto;
            padding: 0 24px;
        }

        /* ── Header ── */
        .faq-section .intro {
            margin-bottom: 56px;
        }

        .faq-section .pre-title {
            display: inline-block;
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: var(--primary-color);
            background: var(--primary-bg-color-3);
            border: 1px solid var(--secondary-color);
            border-radius: 100px;
            padding: 5px 14px;
            margin-bottom: 18px;
        }

        .faq-section h2 {
            font-size: clamp(1.8rem, 3.5vw, 2.6rem);
            font-weight: 700;
            color: var(--primary-t-color);
            line-height: 1.2;
            margin: 0;
            max-width: 580px;
        }

        /* ── FAQ List ── */
        .faq-list {
            display: flex;
            flex-direction: column;
            border-top: 1px solid var(--primary-bg-color-2);
        }

        /* ── FAQ Item ── */
        .faq-item {
            border-bottom: 1px solid var(--primary-bg-color-2);
            transition: background 0.32s ease, box-shadow 0.32s ease, border-color 0.32s ease;
        }

        .faq-item.open {
            background: var(--card-bg-color);
            border-color: transparent;
            border-radius: 12px;
            margin: 4px 0;
            box-shadow: 0 2px 24px var(--primary-l-color);
        }

        /* ── Question row ── */
        .faq-question {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 22px 20px;
            cursor: pointer;
            user-select: none;
            -webkit-tap-highlight-color: transparent;
        }

        .faq-q-text {
            display: flex;
            align-items: baseline;
            gap: 12px;
            flex: 1;
        }

        .faq-q-num {
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            color: var(--secondary-color);
            flex-shrink: 0;
        }

        .faq-q-label {
            font-size: 1rem;
            font-weight: 600;
            color: var(--primary-t-color);
            line-height: 1.45;
            transition: color 0.25s ease;
        }

        .faq-item.open .faq-q-label {
            color: var(--primary-color);
        }

        /* ── Toggle icon ── */
        .faq-icon {
            width: 32px;
            height: 32px;
            flex-shrink: 0;
            border: 1.5px solid var(--secondary-color);
            border-radius: 50%;
            display: grid;
            place-items: center;
            position: relative;
            transition: background 0.3s ease, border-color 0.3s ease, transform 0.3s ease;
            background: transparent;
        }

        .faq-icon::before,
        .faq-icon::after {
            content: '';
            position: absolute;
            background: var(--primary-color);
            border-radius: 2px;
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        .faq-icon::before {
            width: 11px;
            height: 1.5px;
        }

        .faq-icon::after {
            width: 1.5px;
            height: 11px;
        }

        .faq-item.open .faq-icon {
            background: var(--primary-color);
            border-color: var(--primary-color);
            transform: rotate(45deg);
        }

        .faq-item.open .faq-icon::before,
        .faq-item.open .faq-icon::after {
            background: var(--white-color);
        }

        /* ── Answer panel — CSS grid trick for smooth expand ── */
        .faq-answer {
            display: grid;
            grid-template-rows: 0fr;
            transition: grid-template-rows 0.36s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .faq-item.open .faq-answer {
            grid-template-rows: 1fr;
        }

        .faq-answer-inner {
            overflow: hidden;
        }

        .faq-answer-content {
            padding: 0 20px 24px calc(20px + 12px + 0.68rem + 12px);
            font-size: 0.93rem;
            font-weight: 400;
            line-height: 1.75;
            color: var(--primary-p-color);
        }

        .faq-answer-content a {
            color: var(--secondary-color);
            text-decoration: underline;
            text-underline-offset: 3px;
        }

        .faq-answer-content p {
            margin: 0 0 0.7em;
        }

        .faq-answer-content p:last-child {
            margin-bottom: 0;
        }

        /* ── Hover ── */
        .faq-item:not(.open) .faq-question:hover .faq-q-label {
            color: var(--primary-color);
        }

        .faq-item:not(.open) .faq-question:hover .faq-icon {
            border-color: var(--primary-color);
            background: var(--primary-bg-color-3);
        }

        /* ── Responsive ── */
        @media (max-width: 600px) {
            .faq-section {
                padding: 60px 0 72px;
            }

            .faq-section .intro {
                margin-bottom: 36px;
            }

            .faq-answer-content {
                padding-left: 20px;
            }
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
<section class="faq-section" style="{{ $styles }}">
    <div class="container faq-container">

        {{-- Header --}}
        <div class="row text-start intro">
            <div class="col-12">
                <span class="pre-title w-auto">{!! $section_subtitle !!}</span>
                <h2>{!! $section_title !!}</h2>
            </div>
        </div>

        {{-- FAQ Items --}}
        <div class="faq-list">
            @foreach ($items as $index => $item)
                <div class="faq-item">

                    <div class="faq-question" onclick="toggleFaq(this)" role="button" aria-expanded="false"
                        tabindex="0" onkeydown="if(event.key==='Enter'||event.key===' ')toggleFaq(this)">
                        <div class="faq-q-text">
                            <span class="faq-q-num">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            <span class="faq-q-label">{{ $item['question'] }}</span>
                        </div>
                        <span class="faq-icon" aria-hidden="true"></span>
                    </div>

                    <div class="faq-answer" role="region">
                        <div class="faq-answer-inner">
                            <div class="faq-answer-content">
                                {!! $item['answer'] !!}
                            </div>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>

    </div>
</section>
@push('scripts')
    <script>
        function toggleFaq(questionEl) {
            const item = questionEl.closest('.faq-item');
            const isOpen = item.classList.contains('open');

            document.querySelectorAll('.faq-item.open').forEach(el => {
                el.classList.remove('open');
                el.querySelector('.faq-question').setAttribute('aria-expanded', 'false');
            });

            if (!isOpen) {
                item.classList.add('open');
                questionEl.setAttribute('aria-expanded', 'true');
            }
        }
    </script>
@endpush
