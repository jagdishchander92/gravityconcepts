<!-- =====================================================
     CONTACT MAP SECTION
     Class prefix: .cmap-  (isolated, won't collide)
     Drop anywhere in your page — self-contained styles
     ===================================================== -->

<link rel="preconnect" href="https://fonts.googleapis.com">
<style>
    /* ── Reset scope ── */
    .cmap-section * {
        box-sizing: border-box;
        margin: 0;
        padding: 0
    }

    /* ── Section shell ── */
    .cmap-section {
        width: 100%;
        font-family: var(--title-font, "Outfit", sans-serif);
        overflow: hidden;
    }

    /* ── Map wrapper ── */
    .cmap-map-wrap {
        position: relative;
        width: 100%;
        height: 500px;
    }

    .cmap-map-wrap iframe {
        width: 100%;
        height: 100%;
        border: none;
        display: block;
        filter: saturate(0.8) hue-rotate(5deg);
    }

    /* ── Gradient fade at bottom of map ── */
    .cmap-map-wrap::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(240, 253, 254, 0) 55%, var(--theme-bg-color1, #F0FDFE) 100%);
        pointer-events: none;
    }

    /* ── Pulse marker ── */
    .cmap-pulse {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 5;
        pointer-events: none;
    }

    .cmap-pulse-dot {
        width: 18px;
        height: 18px;
        border-radius: 50%;
        background: var(--theme-color2, #FF6D45);
        position: relative;
        z-index: 2;
    }

    .cmap-pulse-ring {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 18px;
        height: 18px;
        border-radius: 50%;
        border: 2px solid var(--theme-color2, #FF6D45);
        animation: cmap-pulse-anim 2s ease-out infinite;
    }

    .cmap-pulse-ring:nth-child(2) {
        animation-delay: .65s
    }

    .cmap-pulse-ring:nth-child(3) {
        animation-delay: 1.3s
    }

    @keyframes cmap-pulse-anim {
        0% {
            width: 18px;
            height: 18px;
            opacity: .9
        }

        100% {
            width: 72px;
            height: 72px;
            opacity: 0
        }
    }

    /* ── Cards row — overlaps map by 90px ── */
    .cmap-cards-row {
        position: relative;
        z-index: 10;
        margin-top: -90px;
        padding: 0 40px 80px;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 22px;
    }

    /* ── Individual card ── */
    .cmap-card {
        background: #fff;
        border-radius: 20px;
        padding: 30px 24px;
        display: flex;
        flex-direction: column;
        gap: 14px;
        border: 1px solid rgba(11, 70, 84, 0.07);
        height: 220px;
        /* all cards same height */
        opacity: 0;
        transform: translateY(36px);
        transition:
            opacity .55s ease,
            transform .55s ease,
            box-shadow .3s ease;
        will-change: transform;
    }

    .cmap-card.cmap-visible {
        opacity: 1;
        transform: translateY(0);
    }

    .cmap-card:hover {
        box-shadow: 0 16px 48px rgba(11, 70, 84, 0.13);
        transform: translateY(-6px) !important;
    }

    /* ── Icon circle ── */
    .cmap-icon-wrap {
        width: 46px;
        height: 46px;
        border-radius: 13px;
        background: linear-gradient(135deg, var(--theme-color1, #0B4654), var(--theme-color5, #1F5A68));
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: background .3s;
    }

    .cmap-card:hover .cmap-icon-wrap {
        background: linear-gradient(135deg, var(--theme-color2, #FF6D45), var(--theme-color7, #FF853F));
    }

    .cmap-icon-wrap i {
        color: #fff;
        font-size: 21px;
    }

    /* ── Text ── */
    .cmap-card-label {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .09em;
        text-transform: uppercase;
        color: var(--theme-color3, #9DAAA4);
        font-family: var(--text-font, "Noto Sans", sans-serif);
    }

    .cmap-card-value {
        font-size: 14.5px;
        font-weight: 500;
        color: var(--heading-color, #0B4654);
        line-height: 1.5;
        margin-top: 4px;
    }

    .cmap-card-value a {
        color: var(--link-color, #0B4654);
        text-decoration: none;
        transition: color .2s;
        font-weight: 500;
    }

    .cmap-card-value a:hover {
        color: var(--theme-color2, #FF6D45);
    }

    /* ── Bottom accent bar ── */
    .cmap-accent-bar {
        height: 3px;
        border-radius: 3px;
        background: linear-gradient(90deg, var(--theme-color2, #FF6D45), var(--theme-color7, #FF853F));
        width: 30px;
        margin-top: auto;
        transition: width .3s;
    }

    .cmap-card:hover .cmap-accent-bar {
        width: 56px;
    }

    /* ── Responsive ── */
    @media(max-width:1100px) {
        .cmap-cards-row {
            grid-template-columns: repeat(2, 1fr);
            padding: 0 28px 60px
        }
    }

    @media(max-width:640px) {
        .cmap-map-wrap {
            height: 320px
        }

        .cmap-cards-row {
            grid-template-columns: 1fr;
            padding: 0 18px 40px;
            margin-top: -60px
        }

        .cmap-card {
            height: auto
        }
    }

    .map-wrap {
        height: 100%;
    }

    .map-wrap iframe {
        pointer-events: none;

    }

    .status-badge {
        position: relative;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: .35em .75em .35em .55em;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: .04em;
        white-space: nowrap;
    }

    .status-badge .pulse-dot {
        position: relative;
        width: 9px;
        height: 9px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .status-badge .pulse-ring {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 9px;
        height: 9px;
        border-radius: 50%;
        border-width: 1.5px;
        border-style: solid;
        animation: badge-pulse 2s ease-out infinite;
        pointer-events: none;
    }

    .status-badge .pulse-ring:nth-child(2) {
        animation-delay: .65s;
    }

    .status-badge .pulse-ring:nth-child(3) {
        animation-delay: 1.3s;
    }

    @keyframes badge-pulse {
        0% {
            width: 9px;
            height: 9px;
            opacity: .85;
        }

        100% {
            width: 28px;
            height: 28px;
            opacity: 0;
        }
    }

    .badge-open {
        background: #e6f7ef;
        color: #166534;
    }

    .badge-open .pulse-dot {
        background: #22c55e;
    }

    .badge-open .pulse-ring {
        border-color: #22c55e;
    }

    .badge-closing {
        background: #fefce8;
        color: #854d0e;
    }

    .badge-closing .pulse-dot {
        background: #eab308;
    }

    .badge-closing .pulse-ring {
        border-color: #eab308;
    }

    .badge-opening {
        background: #eff6ff;
        color: #1e40af;
    }

    .badge-opening .pulse-dot {
        background: #3b82f6;
    }

    .badge-opening .pulse-ring {
        border-color: #3b82f6;
    }

    .badge-closed {
        background: #f3f4f6;
        color: #6b7280;
    }

    .badge-closed .pulse-dot {
        background: #9ca3af;
    }
</style>
@php
    $website_common_info = \App\Models\Setting::where('key', 'website_common_info')->first();
    $website_common_info = $website_common_info ? json_decode($website_common_info->value, true) : [];

@endphp
<section class="cmap-section" aria-label="Contact information and location">

    <!-- MAP -->
    <div class="cmap-map-wrap">
        <div class="map-wrap">
            <iframe src="{{ $website_common_info['map_url'] ?? '' }}" loading="lazy">
            </iframe>
        </div>

        <!-- Animated pulse marker (visually on top of map) -->
        <div class="cmap-pulse" aria-hidden="true">
            <div class="cmap-pulse-dot"></div>
            <div class="cmap-pulse-ring"></div>
            <div class="cmap-pulse-ring"></div>
            <div class="cmap-pulse-ring"></div>
        </div>
    </div>

    <!-- CARDS -->
    <div class="cmap-cards-row">

        <!-- Email -->
        <div class="cmap-card" data-cmap-delay="0">
            <div class="cmap-icon-wrap"><i class="fa fa-envelope" aria-hidden="true"></i></div>
            <div>
                <div class="cmap-card-label">Email us</div>
                <div class="cmap-card-value">
                    <a
                        href="mailto:{{ $website_common_info['email'] ?? '' }}">{{ $website_common_info['email'] ?? '' }}</a>
                </div>
            </div>
            <div class="cmap-accent-bar"></div>
        </div>

        <!-- Address -->
        <div class="cmap-card" data-cmap-delay="120">
            <div class="cmap-icon-wrap"><i class="fa fa-map-pin" aria-hidden="true"></i></div>
            <div>
                <div class="cmap-card-label">Our address</div>
                <div class="cmap-card-value">
                    {{ $website_common_info['location'] ?? '' }}
                    @if (isset($website_common_info['map_lat']) &&
                            $website_common_info['map_lat'] &&
                            isset($website_common_info['map_lng']) &&
                            $website_common_info['map_lng']
                    )
                        <a href="https://www.google.com/maps/dir/?api=1&destination={{ $website_common_info['map_lat'] }},{{ $website_common_info['map_lng'] }}"
                            target="_blank" class="ms-3"
                            style="color: var(--theme-color2);text-decoration: underline;">
                            Get Directions <i class="fa-solid fa-arrow-right-long"></i>

                        </a>
                    @endif
                </div>
            </div>
            <div class="cmap-accent-bar"></div>
        </div>

        <!-- Phone -->
        <div class="cmap-card" data-cmap-delay="240">
            <div class="cmap-icon-wrap"><i class="fa fa-phone" aria-hidden="true"></i></div>
            <div>
                <div class="cmap-card-label">Call us</div>
                <div class="cmap-card-value">
                    <a
                        href="tel:{{ $website_common_info['phone'] ?? '' }}">{{ $website_common_info['phone'] ?? '' }}</a>
                </div>
            </div>
            <div class="cmap-accent-bar"></div>
        </div>

        @php

            $working_hours = \App\Models\Setting::where('key', 'working_hours')->first();
            $working_hours = $working_hours ? json_decode($working_hours->value, true) : [];

        @endphp


        <div class="cmap-card" data-cmap-delay="360">
            <div class="cmap-icon-wrap">
                <i class="fa fa-clock" aria-hidden="true"></i>
            </div>
            <div>
                <div class="cmap-card-label">
                    Working hours

                </div>
                <div class="cmap-card-value">
                    <div class="cmap-card-value">
                        {{ $website_common_info['open_hours'] ?? '' }}
                    </div>
                    <span id="working-status"></span>
                </div>
            </div>
            <div class="cmap-accent-bar"></div>
        </div>
    </div>
</section>
@push('scripts')
    <script>
        (function() {
            var cards = document.querySelectorAll('.cmap-card');
            var io = new IntersectionObserver(function(entries) {
                entries.forEach(function(e) {
                    if (e.isIntersecting) {
                        var delay = parseInt(e.target.getAttribute('data-cmap-delay') || 0);
                        setTimeout(function() {
                            e.target.classList.add('cmap-visible');
                        }, delay);
                        io.unobserve(e.target);
                    }
                });
            }, {
                threshold: 0.12
            });
            cards.forEach(function(c) {
                io.observe(c);
            });
        })();
        const workingHours = @json($working_hours);

        function checkWorkingStatus() {
            const now = new Date();
            const days = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
            const today = workingHours[days[now.getDay()]];

            let label = 'Closed',
                cls = 'badge-closed',
                rings = '';

            if (today && !today.closed) {
                const cur = now.getHours() * 60 + now.getMinutes();

                const [openH, openM] = today.open.split(':').map(Number);
                const [closeH, closeM] = today.close.split(':').map(Number);
                const open = openH * 60 + openM;
                const close = closeH * 60 + closeM;

                const ringsHtml = '<span class="pulse-ring"></span>'.repeat(3);

                if (cur >= open && cur < close) {
                    label = (close - cur) <= 60 ? 'Closing Soon' : 'Open Now';
                    cls = (close - cur) <= 60 ? 'badge-closing' : 'badge-open';
                    rings = ringsHtml;
                } else if (cur < open && (open - cur) <= 60) {
                    label = 'Opening Soon';
                    cls = 'badge-opening';
                    rings = ringsHtml;
                }
            }

            $('#working-status').attr('class', 'status-badge ' + cls).html(
                `<span class="pulse-dot">${rings}</span>${label}`
            );
        }

        checkWorkingStatus();
    </script>
@endpush
