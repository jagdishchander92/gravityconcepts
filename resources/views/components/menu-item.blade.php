@php $level = $level ?? 0; @endphp

@foreach ($menus as $menu)

    @php
        $hasChildren = !empty($menu['children']) && is_array($menu['children']);
    @endphp

    <li class="nav-item {{ $hasChildren ? 'dropdown' : '' }}">

        <a href="{{ url($menu['url'] ?? '#') }}" class="nav-link">

            {{ strtoupper($menu['label'] ?? '') }}

            @if ($hasChildren)
                <i class="{{ $level === 0 ? 'icon-arrow-down' : 'icon-arrow-right' }}"></i>
            @endif
        </a>

        @if ($hasChildren)
            <ul class="dropdown-menu">
                @include('components.menu-item', [
                    'menus' => $menu['children'],
                    'level' => $level + 1
                ])
            </ul>
        @endif

    </li>

@endforeach