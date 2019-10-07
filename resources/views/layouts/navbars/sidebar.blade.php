<nav id="sidenav-main" class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" onmousedown="return false;">
    <div class="scrollbar-inner">
        <!-- logo e botão do menu -->
        <div class="sidenav-header d-flex align-items-center">
            <!-- logo -->
            <a class="ml--1 mr--3 navbar-brand fe-mouse-off">
                <span class="h2 text-primary">
                    <img src="{{ asset('img/default/logos/azul-transparente.png') }}" alt="" class="mt--2 mr-1" width="150px">
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
                <ul class="navbar-nav">
                    @foreach (\App\Models\Menu\Menu::getUserMenu() as $menu)
                        <!-- variáveis -->
                        <span hidden>
                            {{ $str_limit = 28 }}
                            {{ $group_name = \App\Models\Route\Group::getGroup(\App\Models\Route\Route::getRoute(\App\Models\Menu\MenuItem::getMenuId($menu->id)['route_id'])['group_id'])['name'] }}
                            {{ $request = Illuminate\Support\Facades\Request::is($group_name . '/*') }}
                        </span>
                        @if ($menu->menu_option_id == 1)
                            <!-- grupo em collapse -->
                            <li class="nav-item">
                                <!-- collapse titulo -->
                                <a class="nav-link {{ $request ? 'active text-primary' : '' }} {{ $menu['blocked'] ? 'fe-menu-block' : '' }}" href="#navbar-{{ $menu['blocked'] ? '' : $group_name }}" data-toggle="collapse" role="button" aria-expanded="{{ $request ? 'true' : 'false' }}" aria-controls="navbar-{{ $group_name }}">
                                    <i class="{{ $menu->icon }} {{ \App\Models\Color::getColor($menu->color_id)['color'] }}"></i>
                                    <span class="nav-link-text">{{ __(substr_replace($menu->name, (strlen($menu->name) > $str_limit ? '...' : ''), $str_limit)) }}</span>
                                </a>
                                <!-- collapse itens -->
                                <div id="navbar-{{ $group_name }}" class="collapse {{ $request ? 'show' : '' }}">
                                    <ul class="nav nav-sm flex-column">
                                        @foreach (\App\Models\Menu\MenuItem::getUserMenuItems() as $item)
                                            <!-- variáveis -->
                                            <span hidden>
                                                {{ $url = \App\Models\Route\Route::getRoute($item->route_id)['url'] }}
                                                {{ $group_id = \App\Models\Route\Route::getRoute($item->route_id)['group_id'] }}
                                                {{ $group_blocked = \App\Models\Route\Group::getGroup($group_id)['blocked'] }}
                                                {{ $route_blocked = \App\Models\Route\Route::getRoute($item->route_id)['blocked'] }}
                                            </span>
                                            @if ($menu->id == $item->menu_id)
                                                @if (\App\Models\Menu\Menu::getMenu($item->menu_id)['menu_option_id'] == 1)
                                                    <li class="nav-item">
                                                        @if (!$item->button && $item->hidden == 0)
                                                            <!-- collapse item link -->
                                                            <a href="{{ $group_blocked || $route_blocked || $menu['blocked'] || $item['blocked'] ? 'javascript:void(0)' : route(\App\Models\Route\Route::getRoute($item->route_id)['route']) }}" class="nav-link {{ $group_blocked ? 'notify-block-group' : '' }} {{ $route_blocked ? 'notify-block-route' : '' }} {{ $menu['blocked'] || $item['blocked'] ? 'fe-menu-block' : '' }} {{ Illuminate\Support\Facades\Request::is(\App\Models\Route\Group::getGroup($group_id)['name'] . '/' . $url) ? 'text-primary' : '' }}">
                                                                @if (Illuminate\Support\Facades\Request::is($group_name . '/' . $url))
                                                                    <i class="fas fa-circle fe-fs-6 ml--3 mr--3"></i>
                                                                @endif
                                                                {{ __(substr_replace($item->name, (strlen($item->name) > $str_limit ? '...' : ''), $str_limit)) }}
                                                            </a>
                                                        @elseif (!$item->button && $item->hidden == 1)
                                                            <!-- collapse item link oculto -->
                                                            <a href="{{ $group_blocked || $route_blocked || $menu['blocked'] || $item['blocked'] ? 'javascript:void(0)' : $_SERVER['REQUEST_URI'] }}" class="nav-link {{ $group_blocked ? 'notify-block-group' : '' }} {{ $route_blocked ? 'notify-block-route' : '' }} {{ $menu['blocked'] || $item['blocked'] ? 'fe-menu-block' : '' }} {{ Illuminate\Support\Facades\Request::is(\App\Models\Route\Group::getGroup($group_id)['name'] . '/' . $url) ? 'text-primary' : 'd-none' }}">
                                                                @if (Illuminate\Support\Facades\Request::is($group_name . '/' . $url))
                                                                    <i class="fas fa-circle fe-fs-6 ml--3 mr--3"></i>
                                                                @endif
                                                                {{ __(substr_replace($item->name, (strlen($item->name) > $str_limit ? '...' : ''), $str_limit)) }}
                                                            </a>
                                                        @else
                                                            <!-- collapse item modal -->
                                                            <a href="javascript:void(0)" class="nav-link {{ $group_blocked ? 'notify-block-group' : '' }} {{ $route_blocked ? 'notify-block-route' : '' }} {{ $menu['blocked'] || $item['blocked'] ? 'fe-menu-block' : '' }} {{ !$group_blocked && !$route_blocked && !$menu['blocked'] && !$item['blocked'] ? $item->button : '' }}">{{ __(substr_replace($item->name, (strlen($item->name) > $str_limit ? '...' : ''), $str_limit)) }}</a>
                                                        @endif
                                                    </li>
                                                @endif
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                        @elseif ($menu->menu_option_id == 3)
                            <!-- variáveis -->
                            <span hidden>
                                {{ $button = \App\Models\Menu\MenuItem::getMenuId($menu->id) }}
                                {{ $route_id = \App\Models\Menu\MenuItem::getMenuId($menu->id)['route_id'] }}
                                {{ $group_blocked = \App\Models\Route\Group::getGroup(\App\Models\Route\Route::getRoute($route_id)['group_id'])['blocked'] }}
                                {{ $route_blocked = \App\Models\Route\Route::getRoute($route_id)['blocked'] }}
                                {{ $url = Illuminate\Support\Facades\Request::is($group_name . '/' . \App\Models\Route\Route::getRoute($route_id)['url']) }}
                                {{ $menu_item = \App\Models\Menu\MenuItem::getMenuItem($menu->id) }}
                            </span>
                            <!-- grupo em titulo -->
                            <li class="nav-item">
                                @if ($menu->hidden == 0)
                                    @if (!$button['button'])
                                        <!-- titulo link -->
                                        <a href="{{ $group_blocked || $route_blocked || $menu['blocked'] || $menu_item['blocked'] ? 'javascript:void(0)' : route(\App\Models\Route\Route::getRoute($route_id)['route']) }}" class="nav-link {{ $group_blocked ? 'notify-block-group' : '' }} {{ $route_blocked ? 'notify-block-route' : '' }} {{ $menu['blocked'] || $menu_item['blocked'] ? 'fe-menu-block' : '' }} {{ $url ? 'active text-primary' : '' }}">
                                            <i class="{{ $menu->icon }} {{ \App\Models\Color::getColor($menu->color_id)['color'] }}"></i>
                                            <span class="nav-link-text">{{ __(substr_replace($menu->name, (strlen($menu->name) > $str_limit ? '...' : ''), $str_limit)) }}</span>
                                        </a>
                                    @elseif ($button['list'] == 0)
                                        <!-- titulo modal -->
                                        <a href="javascript:void(0)" class="nav-link {{ $group_blocked ? 'notify-block-group' : '' }} {{ $route_blocked ? 'notify-block-route' : '' }} {{ $menu['blocked'] || $menu_item['blocked'] ? 'fe-menu-block' : '' }} {{ !$group_blocked && !$route_blocked && !$menu['blocked'] && !$menu_item['blocked'] ? $button['button'] : '' }}">
                                            <i class="{{ $menu->icon }} {{ \App\Models\Color::getColor($menu->color_id)['color'] }}"></i>
                                            <span class="nav-link-text">{{ __(substr_replace($menu->name, (strlen($menu->name) > $str_limit ? '...' : ''), $str_limit)) }}</span>
                                        </a>
                                    @endif
                                @else
                                    <!-- titulo link oculto -->
                                    <a href="{{ $group_blocked || $route_blocked || $menu['blocked'] || $menu_item['blocked'] ? 'javascript:void(0)' : url()->current() }}" class="nav-link {{ $group_blocked ? 'notify-block-group' : '' }} {{ $route_blocked ? 'notify-block-route' : '' }} {{ $menu['blocked'] || $menu_item['blocked'] ? 'fe-menu-block' : '' }} {{ $url ? 'active text-primary' : 'd-none' }}">
                                        <i class="{{ $menu->icon }} {{ \App\Models\Color::getColor($menu->color_id)['color'] }}"></i>
                                        <span class="nav-link-text">{{ __(substr_replace($menu->name, (strlen($menu->name) > $str_limit ? '...' : ''), $str_limit)) }}</span>
                                    </a>
                                @endif
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</nav>
