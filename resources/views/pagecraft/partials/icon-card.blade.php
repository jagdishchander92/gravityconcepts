<div class="about-section-one icon-card {{ $classes }}" style="{{ $widgetStyle}}">
    <div class="single-about-box fade-in"
        style="translate: none; rotate: none; scale: none; transform: translate(0px, 0px); opacity: 1;">
        <div class="about-icon">
            <i class="fa {{ $p['icon'] ?? '' }}"></i>
        </div>
        <div class="about-title">
            <h1>{{ $p['title'] ?? '' }}</h1>
        </div>
        <div class="about-desc">
            <p>{{ $p['desc'] ?? '' }}</p>
        </div>
    </div>
</div>
