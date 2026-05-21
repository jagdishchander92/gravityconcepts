@if (isset($p['listType']) && $p['listType'] == 'ol')
    <ol style="{{ $widgetStyle }}" class="{{ $classes }}">
        @if (isset($p['items']) && !empty($p['items']))
            @foreach ($p['items'] as $item)
                <li> {!! html_entity_decode($item) !!} </li>
            @endforeach
        @endif
    </ol>
@else
    <ul style="{{ $widgetStyle }}" class="{{ $classes }}">
        @if (isset($p['items']) && !empty($p['items']))
            @foreach ($p['items'] as $item)
                <li> {!! html_entity_decode($item) !!} </li>
            @endforeach
        @endif
    </ul>
@endif
