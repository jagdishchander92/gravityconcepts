<div class="accordion custom-faq" id="faqAccordion">

    @if (isset($p['items']) && !empty($p['items']))
        @foreach ($p['items'] as $index => $item)

            <div class="accordion-item border-0 shadow-sm mb-3 rounded-3 overflow-hidden">

                <h2 class="accordion-header" id="heading{{ $index }}">

                    <button class="accordion-button fw-semibold {{ $index != 0 ? 'collapsed' : '' }}"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapse{{ $index }}"
                        aria-expanded="{{ $index == 0 ? 'true' : 'false' }}">

                        {{ $item['q'] ?? '' }}

                    </button>

                </h2>

                <div id="collapse{{ $index }}"
                    class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}"
                    data-bs-parent="#faqAccordion">

                    <div class="accordion-body text-muted">
                        {{ $item['a'] ?? '' }}
                    </div>

                </div>

            </div>

        @endforeach
    @endif

</div>
