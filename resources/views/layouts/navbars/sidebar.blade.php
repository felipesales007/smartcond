<nav id="sidenav-main" class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" onmousedown="return false;">
    <div class="scrollbar-inner">
        <!-- logo e botão do menu -->
        <div class="sidenav-header d-flex align-items-center">
            <!-- logo -->
            <a class="ml--1 mr--3 navbar-brand fe-mouse">
                <span class="h2 text-primary">
                    <img src="{{ asset('images/default/logos/azul-transparente.png') }}" alt="" class="mt--2 mr-1" width="150px">
                </span>
            </a>
            <!-- botão do menu -->
            <div class="ml-auto mt-1">
                <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- menu lateral -->
        <div class="navbar-inner">
            <div id="sidenav-collapse-main" class="collapse navbar-collapse">
                <!-- itens do menu lateral -->
                <span hidden>{{ $str_limit = 28 }}</span>
                <ul class="navbar-nav">
                    @foreach (\App\Models\Menu\Menu::getUserMenu() as $menu)
                        @if ($menu['menu_option_id'] == 1)
                            <!-- grupo em collapse -->
                            <li class="nav-item">
                                <!-- collapse titulo -->
                                <a class="nav-link {{ $menu['id'] == $sidebarMenu ? 'active text-primary' : '' }} {{ $menu['blocked'] ? 'fe-menu-block' : '' }}" href="#{{ $menu['blocked'] ? '' : explode('/', $menu['group'])[0] }}" data-toggle="collapse" role="button" aria-expanded="{{ $menu['id'] == $sidebarMenu ? 'true' : 'false' }}" aria-controls="navbar-{{ $menu['id'] }}">
                                    <i class="{{ $menu['icon'] }} {{ $menu['color'] }}"></i>
                                    <span class="nav-link-text">{{ __(substr_replace($menu['name'], (strlen($menu['name']) > $str_limit ? '...' : ''), $str_limit)) }}</span>
                                </a>
                                <!-- collapse itens -->
                                <div id="{{ explode('/', $menu['group'])[0] }}" class="collapse {{ $menu['id'] == $sidebarMenu ? 'show' : '' }}">
                                    <ul class="nav nav-sm flex-column">
                                        @foreach (\App\Models\Menu\MenuItem::getUserMenuItems() as $item)
                                            @if ($menu['id'] == $item['menu_id'])
                                                @if ($item['menu_option_id'] == 1)
                                                    <li class="nav-item">
                                                        @if (!$item['button'] && $item['hidden'] == 0)
                                                            <!-- collapse item link -->
                                                            <a href="{{ $item['group_blocked'] || $item['route_blocked'] || $menu['blocked'] || $item['blocked'] ? 'javascript:void(0)' : route($item['route']) }}" class="nav-link {{ $item['group_blocked'] || $item['route_blocked'] || $menu['blocked'] || $item['blocked'] ? '' : 'fe-loading' }} {{ $item['group_blocked'] ? 'notify-block-group' : '' }} {{ $item['route_blocked'] ? 'notify-block-route' : '' }} {{ $menu['blocked'] || $item['blocked'] ? 'fe-menu-block' : '' }} {{ $sidebarItem == $item['id'] ? 'text-primary' : '' }}">
                                                                <i class="fas fa-circle fe-fs-6 mx--3 {{ $sidebarItem == $item['id'] ? '' : 'fe-hidden' }}"></i>
                                                                {{ __(substr_replace($item['name'], (strlen($item['name']) > $str_limit ? '...' : ''), $str_limit)) }}
                                                            </a>
                                                        @elseif (!$item['button'] && $item['hidden'] == 1)
                                                            <!-- collapse item link oculto -->
                                                            <a href="{{ $item['group_blocked'] || $item['route_blocked'] || $menu['blocked'] || $item['blocked'] ? 'javascript:void(0)' : url()->full() }}" class="nav-link {{ $item['group_blocked'] || $item['route_blocked'] || $menu['blocked'] || $item['blocked'] ? '' : 'fe-loading' }} {{ $item['group_blocked'] ? 'notify-block-group' : '' }} {{ $item['route_blocked'] ? 'notify-block-route' : '' }} {{ $menu['blocked'] || $item['blocked'] ? 'fe-menu-block' : '' }} {{ $sidebarItem == $item['id'] ? 'text-primary' : 'd-none' }}">
                                                                <i class="fas fa-circle fe-fs-6 mx--3 {{ $sidebarItem == $item['id'] ? '' : 'fe-hidden' }}"></i>
                                                                {{ __(substr_replace($item['name'], (strlen($item['name']) > $str_limit ? '...' : ''), $str_limit)) }}
                                                            </a>
                                                        @else
                                                            <!-- collapse item modal -->
                                                            <a href="javascript:void(0)" class="nav-link {{ $item['group_blocked'] ? 'notify-block-group' : '' }} {{ $item['route_blocked'] ? 'notify-block-route' : '' }} {{ $menu['blocked'] || $item['blocked'] ? 'fe-menu-block' : '' }} {{ !$item['group_blocked'] && !$item['route_blocked'] && !$menu['blocked'] && !$item['blocked'] ? $item['button'] : '' }}">{{ __(substr_replace($item['name'], (strlen($item['name']) > $str_limit ? '...' : ''), $str_limit)) }}</a>
                                                        @endif
                                                    </li>
                                                @endif
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                        @elseif ($menu['menu_option_id'] == 3)
                            <!-- grupo em titulo -->
                            <li class="nav-item">
                                @foreach (\App\Models\Menu\MenuItem::getUserMenuItems() as $item)
                                    @if ($menu['id'] == $item['menu_id'])
                                        @if ($menu['hidden'] == 0)
                                            @if (!$item['button'])
                                                <!-- titulo link -->
                                                <a href="{{ $item['group_blocked'] || $item['route_blocked'] || $menu['blocked'] || $item['blocked'] ? 'javascript:void(0)' : route($item['route']) }}" class="nav-link {{ $item['group_blocked'] || $item['route_blocked'] || $menu['blocked'] || $item['blocked'] ? '' : 'fe-loading' }} {{ $item['group_blocked'] ? 'notify-block-group' : '' }} {{ $item['route_blocked'] ? 'notify-block-route' : '' }} {{ $menu['blocked'] || $item['blocked'] ? 'fe-menu-block' : '' }} {{ $sidebarItem == $item['id'] ? 'active text-primary' : '' }}">
                                                    <i class="{{ $menu['icon'] }} {{ $menu['color'] }}"></i>
                                                    <span class="nav-link-text">{{ __(substr_replace($menu['name'], (strlen($menu['name']) > $str_limit ? '...' : ''), $str_limit)) }}</span>
                                                </a>
                                            @elseif ($button['button'] == 0)
                                                <!-- titulo modal -->
                                                <a href="javascript:void(0)" class="nav-link {{ $item['group_blocked'] ? 'notify-block-group' : '' }} {{ $item['route_blocked'] ? 'notify-block-route' : '' }} {{ $menu['blocked'] || $item['blocked'] ? 'fe-menu-block' : '' }} {{ !$item['group_blocked'] && !$item['route_blocked'] && !$menu['blocked'] && !$item['blocked'] ? $item['button'] : '' }}">
                                                    <i class="{{ $menu['icon'] }} {{ $menu['color'] }}"></i>
                                                    <span class="nav-link-text">{{ __(substr_replace($menu['name'], (strlen($menu['name']) > $str_limit ? '...' : ''), $str_limit)) }}</span>
                                                </a>
                                            @endif
                                        @else
                                            <!-- titulo link oculto -->
                                            <a href="{{ $item['group_blocked'] || $item['route_blocked'] || $menu['blocked'] || $item['blocked'] ? 'javascript:void(0)' : url()->full() }}" class="nav-link {{ $item['group_blocked'] || $item['route_blocked'] || $menu['blocked'] || $item['blocked'] ? '' : 'fe-loading' }} {{ $item['group_blocked'] ? 'notify-block-group' : '' }} {{ $item['route_blocked'] ? 'notify-block-route' : '' }} {{ $menu['blocked'] || $item['blocked'] ? 'fe-menu-block' : '' }} {{ $sidebarItem == $item['id'] ? 'active text-primary' : 'd-none' }}">
                                                <i class="{{ $menu['icon'] }} {{ $menu['color'] }}"></i>
                                                <span class="nav-link-text">{{ __(substr_replace($menu['name'], (strlen($menu['name']) > $str_limit ? '...' : ''), $str_limit)) }}</span>
                                            </a>
                                        @endif
                                    @endif
                                @endforeach
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</nav>
