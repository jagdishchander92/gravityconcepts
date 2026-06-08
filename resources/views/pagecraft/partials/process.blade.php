<section class="process-section">
    <div class="process-section__inner">

        <!-- Heading -->
        {{-- <div class="section-header">
            <div class="section-label">How It Works</div>
            <h2 class="section-title">Our Simple <span>Step-by-Step</span> Process</h2>
            <p class="section-desc">From quote to delivery, we make every step transparent, efficient, and stress-free
                for your business.</p>
        </div> --}}

        <!-- Cards grid -->
        <div class="process-grid" style="position:relative;">
            <svg id="connector-svg" aria-hidden="true"></svg>
            @foreach ($p['items'] as $index => $item)
                <!-- 01 -->
                <div class="process-card">
                    <div class="process-card__step">{{ $index + 1 }}</div>
                    <div class="process-card__icon-wrap">
                        <i class="fa-solid {{ $item['icon'] ?? '-' }} process-card__icon" aria-hidden="true"></i>
                    </div>
                    <h3 class="process-card__title">{{ $item['text'] ?? '-' }}</h3>
                    <p class="process-card__text">{{ $item['desc'] ?? '-' }}</p>
                    {{-- <span class="process-card__tag"><i class="fa-solid fa-clock"
                            style="margin-right:5px;font-size:11px;"></i> ~2 min</span> --}}
                </div>
            @endforeach
        </div>
    </div>
</section>
