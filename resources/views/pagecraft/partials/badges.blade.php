<div class="d-flex gap-2 {{ $classes }}" style="{{ $widgetStyle }}">
    @if (isset($p['items']) && !empty($p['items']))
        @foreach ($p['items'] as $item)
            <span class="badge badge-primary">{!! html_entity_decode($item) !!}</span>
        @endforeach
    @endif
</div>
