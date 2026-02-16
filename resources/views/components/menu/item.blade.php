@props(['item'])
@if ($item->isVisible())
    @if ($item->getTitle())
        <li class="menu-title">
            <span>{{ $item->getTitle() }}</span>
        </li>
    @endif

    <li class="{{ request()->fullUrlIs($item->getLink()) || route_is($item->getRoute()) ? 'active' : '' }}">
        <a href="{{ $item->getLink() ?? ($item->getRoute() ?? '#') }}">
            @if ($item->getIcon())
                <i class="la la-{{ $item->getIcon() }}"></i>
            @endif
            <span>{{ $item->getLabel() }}</span>
        </a>
    </li>
@endif
