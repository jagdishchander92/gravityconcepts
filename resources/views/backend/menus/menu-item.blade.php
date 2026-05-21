<li class="dd-item" data-label="{{ $item['label'] }}" data-url="{{ $item['url'] }}">
    <button type="button" class="btn-remove-item" onclick="removeItem(this)">×</button>
    
    <div class="dd-handle">
        <div>
            <strong>{{ $item['label'] }}</strong> 
            <span class="text-muted ms-2 small">({{ $item['url'] }})</span>
        </div>
    </div>
    
    @if(isset($item['children']) && count($item['children']) > 0)
        <ol class="dd-list">
            @foreach($item['children'] as $child)
                @include('backend.menus.menu-item', ['item' => $child])
            @endforeach
        </ol>
    @endif
</li>