@php
    $current = \Request::route()->getName();
@endphp
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}">Work Order</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard') }}">WO</a>
        </div>
        <ul class="sidebar-menu">
            <li class="{{ $current == 'dashboard' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            @foreach ($menus as $menu)
                @if (!isset($menu['child']))
                    <li class="{{ $current == $menu['url'] ? 'active' : '' }}">
                        <a class="nav-link" href="{{ Route::has($menu['url']) ? route($menu['url']) : '#' }}">
                            <i class="{{ $menu['icon'] }}"></i>
                            <span>{{ $menu['name'] }}</span>
                        </a>
                    </li>
                @else
                    <li class="nav-item dropdown {{ in_array($current, getAllMenuUrl($menu, [])) ? 'active' : '' }}">
                        <a href="#" class="nav-link has-dropdown">
                            <i class="{{ $menu['icon'] }}"></i><span>{{ $menu['name'] }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            @foreach ($menu['child'] as $child)
                                @if (isset($child['url']))
                                    <li class="{{ $current == $child['url'] ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route($child['url']) }}">{{ $child['name'] }}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                @endif
            @endforeach
        </ul>
    </aside>
</div>
