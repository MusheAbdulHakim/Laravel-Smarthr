@props(['item'])

@php
    $active = collect($item->getSubItems())->contains(
        fn($sub) => request()->fullUrlIs($sub->getLink()) || route_is($sub->getRoute()),
    );
@endphp

<li class="submenu">
    <a href="{{ $item->getLink() ?? ($item->getRoute() ?? '#') }}" class="{{ $active ? 'active' : '' }}">
        @if ($item->getIcon())
            <i class="la la-{{ $item->getIcon() }}"></i>
        @endif <span>{{ $item->getLabel() }}</span><span class="menu-arrow"></span>
    </a>
    <ul>
        @foreach ($item->getSubItems() as $subItem)
            @if ($subItem->hasSubmenu())
                <x-menu.submenu :item="$subItem" />
            @else
                <x-menu.item :item="$subItem" />
            @endif
        @endforeach
    </ul>
</li>
