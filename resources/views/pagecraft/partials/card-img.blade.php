<div class="xc-card {{ $classes }}" style="{{ $widgetStyle }}">

    <div class="xc-card__img-wrap">
        <img class="xc-card__img" src="{{ imgUrl($p['img']) }}" alt="Waterfall in lush green forest" />
        <div class="xc-card__overlay"></div>
        {{-- <span class="xc-card__badge">Nature</span> --}}
    </div>

    <div class="xc-card__body">

        {{-- <div class="xc-card__meta">
            <span>Dec 12, 2024</span>
            <span class="xc-card__meta-dot"></span>
            <span>5 min read</span>
        </div> --}}

        <h3 class="xc-card__title">{{ $p['title'] }}</h3>

        <p class="xc-card__desc">
            {{ $p['desc'] }}
        </p>
        @if (isset($p['btnText']) && $p['btnText'])
            <div class="xc-card__divider"></div>

            <div class="xc-card__footer">

                <a href="{{ $p['btnUrl'] }}" class="xc-card__btn">
                    {{ $p['btnText'] }}
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M1 7h12M8 2l5 5-5 5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </a>

            </div>
        @endif
    </div>
</div>
