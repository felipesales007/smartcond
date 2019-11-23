<!-- navbar -->
<nav class="navbar fixed-top navbar-expand navbar-dark">
    <div class="container-fluid">
        <!-- nome do website -->
        <div class="mt-3 ml-md--3 ml-lg--3 ml-xl-5 fe-mouse fe-logo-navbar">
            <span class="h2 text-white">
                <img src="{{ asset('images/default/logos/branco-transparente.png') }}" alt="" class="mt--2 mr-1" width="150px">
            </span>
        </div>

        @if (\App\Models\Entity\Entity::getEntitiesUser()->count() > 1)
            <!-- entidade -->
            <div class="col-lg-3 fe-navbar-entity ml-3">
                <form id="form-edit-entity-profile" role="form" autocomplete="off" novalidate>
                    @csrf
                    <div class="input-group-none">
                        <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('selecione a entidade em que deseja operar no sistema') }}">*</span>
                        {{ Form::select(
                            "name",
                            \App\Models\Entity\Entity::getEntitiesOptions(),
                            \App\Models\Entity\Entity::id(),
                            ["id" => "entity-id-edit-profile", "name" => "entity_id_edit_profile", "class" => "form-control select-nosearch ignore", "placeholder" => "Selecione"]
                        )}}
                    </div>
                </form>
            </div>
        @endif

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
                            <img src="{{ auth()->user()->profilePicture() }}" alt="">
                        </span>
                    </div>
                </a>
                <!-- itens do menu do usuario -->
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right mt-2 mt-md-0">
                    <div class="dropdown-header">
                        <h6 class="text-overflow m-0">{{ __('Menu') }}</h6>
                    </div>
                    <!-- itens -->
                    <span hidden>{{ $str_limit = 20 }}</span>
                    @foreach (\App\Models\Menu\Menu::getUserMenu() as $menu)
                        @foreach (\App\Models\Menu\MenuItem::getUserMenuItems() as $item)
                            @if ($menu['id'] == $item['menu_id'])
                                @if ($menu['menu_option_id'] == 2)
                                    @if ($item['button'] == null)
                                        <!-- titulo link -->
                                         <a href="{{ $item['group_blocked'] || $item['route_blocked'] || $menu['blocked'] || $item['blocked'] ? 'javascript:void(0)' : route($item['route']) }}" class="dropdown-item {{ $item['group_blocked'] || $item['route_blocked'] || $menu['blocked'] || $item['blocked'] ? '' : 'fe-loading' }} {{ $item['group_blocked'] ? 'notify-block-group' : '' }} {{ $item['route_blocked'] ? 'notify-block-route' : '' }} {{ $menu['blocked'] || $item['blocked'] ? 'fe-menu-block' : '' }} {{ Illuminate\Support\Facades\Request::is($menu['group'] . '/*') ? 'active' : '' }}">
                                            <i class="{{ $menu['icon'] }} {{ $menu['color'] }}"></i>
                                            <span class="{{ $menu['color'] }}">{{ __(substr_replace($menu['name'], (strlen($menu['name']) > $str_limit ? '...' : ''), $str_limit)) }}</span>
                                        </a>
                                    @else
                                        <!-- titulo modal -->
                                        <a href="javascript:void(0)" class="dropdown-item {{ $item['group_blocked'] ? 'notify-block-group' : '' }} {{ $item['route_blocked'] ? 'notify-block-route' : '' }} {{ $menu['blocked'] || $item['blocked'] ? 'fe-menu-block' : '' }} {{ !$item['group_blocked'] && !$item['route_blocked'] && !$menu['blocked'] && !$item['blocked'] ? $item['button'] : '' }}">
                                            <i class="{{ $menu['icon'] }} {{ $menu['color'] }}"></i>
                                            <span class="{{ $menu['color'] }}">{{ __(substr_replace($menu['name'], (strlen($menu['name']) > $str_limit ? '...' : ''), $str_limit)) }}</span>
                                        </a>
                                    @endif
                                @endif
                            @endif
                        @endforeach
                    @endforeach
                    <!-- sair -->
                    <div class="dropdown-divider"></div>
                    <a href="{{ app('router')->has('logout') ? route('logout') : url('/') }}" class="dropdown-item text-warning fe-loading" onclick="event.preventDefault(); $('#form-logout').submit();">
                        <i class="fas fa-power-off"></i>
                        <span>{{ __('Sair') }}</span>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>

@include('layouts.import.ajax')
