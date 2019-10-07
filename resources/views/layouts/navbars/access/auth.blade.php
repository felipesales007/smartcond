<!-- navbar -->
<nav class="navbar fixed-top navbar-expand navbar-dark">
    <div class="container-fluid">
        <!-- nome do website -->
        <div class="mt-3 ml-md--3 ml-lg--3 ml-xl-5 fe-mouse-default fe-logo-navbar">
            <span class="h2 text-white">
                <img src="{{ asset('img/default/logos/branco-transparente.png') }}" alt="" class="mt--2 mr-1" width="150px">
            </span>
        </div>
        <!-- botão do menu lateral -->
        <ul class="navbar-nav align-items-center ml-md-auto fe-btn-navbar">
            <li class="nav-item d-xl-none">
                <!-- icone do botão -->
                <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                    </div>
                </div>
            </li>
        </ul>
        <!-- menu do usuário -->
        <ul class="navbar-nav align-items-center mb-0 mr-md--3">
            <li class="nav-item dropdown">
                <!-- nome e foto do usuário -->
                <a href="javascript:void(0)" class="nav-link pr-0 fe-img-navbar" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <!-- nome -->
                        <div class="media-body mr-3 d-none d-lg-block">
                            <span class="mb-0 text-sm font-weight-bold">{{ \App\Helpers\FormatHelpers::first_word(auth()->user()['name']) }}</span>
                        </div>
                        <!-- foto -->
                        <span class="avatar avatar-sm rounded-circle">
                            <img src="{{ auth()->user()['photo'] ? url('storage/img/users/photo/' . auth()->user()['photo']) : url('img/default/default-user.png') }}" alt="">
                        </span>
                    </div>
                </a>
                <!-- itens do menu do usuario -->
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right mt-2 mt-md-0">
                    <div class="dropdown-header">
                        <h6 class="text-overflow m-0">{{ __('Menu') }}</h6>
                    </div>
                    <!-- itens -->
                    @foreach (\App\Models\Menu\Menu::getUserMenu() as $menu)
                        <!-- variáveis -->
                        <span hidden>
                            {{ $str_limit = 20 }}
                            {{ $button = \App\Models\Menu\MenuItem::getMenuId($menu->id)['button'] }}
                            {{ $route_id = \App\Models\Menu\MenuItem::getMenuId($menu->id)['route_id'] }}
                            {{ $group_id = \App\Models\Route\Route::getRoute($route_id)['group_id'] }}
                            {{ $group_blocked = \App\Models\Route\Group::getGroup($group_id)['blocked'] }}
                            {{ $route_blocked = \App\Models\Route\Route::getRoute($route_id)['blocked'] }}
                            {{ $menu_item = \App\Models\Menu\MenuItem::getMenuItem($menu->id) }}
                        </span>
                        @if ($menu->menu_option_id == 2)
                            @if ($button == null)
                                <!-- titulo link -->
                                <a href="{{ $group_blocked || $route_blocked || $menu['blocked'] || $menu_item['blocked'] ? 'javascript:void(0)' : route(\App\Models\Route\Route::getRoute($route_id)['route']) }}" class="dropdown-item {{ $group_blocked ? 'notify-block-group' : '' }} {{ $route_blocked ? 'notify-block-route' : '' }} {{ $menu['blocked'] || $menu_item['blocked'] ? 'fe-menu-block' : '' }} {{ Illuminate\Support\Facades\Request::is(\App\Models\Route\Group::getGroup($group_id)['name'] . '/*') ? 'active' : '' }}">
                                    <i class="{{ \App\Models\Color::getColor($menu->color_id)['color'] }} {{ $menu->icon }}"></i>
                                    <span class="{{ \App\Models\Color::getColor($menu->color_id)['color'] }}">{{ __(substr_replace($menu->name, (strlen($menu->name) > $str_limit ? '...' : ''), $str_limit)) }}</span>
                                </a>
                            @else
                                <!-- titulo modal -->
                                <a href="javascript:void(0)" class="dropdown-item {{ $group_blocked ? 'notify-block-group' : '' }} {{ $route_blocked ? 'notify-block-route' : '' }} {{ $menu['blocked'] || $menu_item['blocked'] ? 'fe-menu-block' : '' }} {{ !$group_blocked && !$route_blocked && !$menu['blocked'] && !$menu_item['blocked'] ? $button : '' }}">
                                    <i class="{{ \App\Models\Color::getColor($menu->color_id)['color'] }} {{ $menu->icon }}"></i>
                                    <span class="{{ \App\Models\Color::getColor($menu->color_id)['color'] }}">{{ __(substr_replace($menu->name, (strlen($menu->name) > $str_limit ? '...' : ''), $str_limit)) }}</span>
                                </a>
                            @endif
                        @endif
                    @endforeach
                    <!-- sair -->
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item text-warning" onclick="event.preventDefault(); $('#form-logout').submit();">
                        <i class="fas fa-power-off"></i>
                        <span>{{ __('Sair') }}</span>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>
