<section style="{{ $widgetStyle }}" class="{{ $classes }}">
    <div class="container-full">

        <div class="custom-counter">
            @foreach ($p['items'] as $item)
                <div class="custom-counter__item">
                    <div class="custom-counter__icon-wrap">
                        <i class="{{ $item['icon'] }}"></i>
                    </div>
                    <div class="custom-counter__number" data-target="{{ preg_replace('/[^0-9]/', '', $item['num']) }}"
                        data-original="{{ $item['num'] }}">
                        0
                    </div>
                    <div class="custom-counter__desc">{{ $item['label'] }}</div>
                </div>
            @endforeach
        </div>
    </div>
</section>


@push('scripts')
    <script>
        (function() {

            function animateCounter(el) {

                const target = parseInt(el.dataset.target, 10);
                const original = el.dataset.original;

                const duration = 1800;
                const start = performance.now();

                function step(now) {

                    const elapsed = now - start;
                    const progress = Math.min(elapsed / duration, 1);

                    // Ease-out cubic
                    const eased = 1 - Math.pow(1 - progress, 3);

                    el.textContent = Math.floor(eased * target).toLocaleString();

                    if (progress < 1) {
                        requestAnimationFrame(step);
                    } else {
                        // Show original formatted value
                        el.textContent = original;
                    }
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

            document.querySelectorAll('.custom-counter__number')
                .forEach(el => observer.observe(el));

        })();
    </script>
@endpush
