<!-- linha no topo -->
<div class="fe-linha-theme"></div>
<div class="fe-transparencia-navbar"></div>

<!-- navbar -->
<nav class="navbar navbar-horizontal navbar-expand navbar-light mt-3 mb-2 fe-z-2">
    <div class="container">
        <!-- nome do website -->
        <div class="fe-mouse-off fe-block-copy">
            <span class="h2 text-primary">
                <img src="{{ asset('img/default/logos/logo/azul/logo-transparente.png') }}" alt="" class="mt--1 mr-1" width="28px">
                {{ config('app.name', 'Smartcond') }}
            </span>
        </div>
        <!-- navbar items -->
        <ul class="navbar-nav align-items-lg-center ml-lg-auto mt-1">
            <!-- botão de registrar-me ou login -->
            <li class="nav-item">
                @if (Illuminate\Support\Facades\Request::is('registrar') || Illuminate\Support\Facades\Request::is('resetar/*'))
                    <!-- login -->
                    <a href="{{ route('login') }}" class="btn btn-icon btn-outline-primary ml-2">
                        <span class="btn-inner--icon">
                            <i class="fas fa-share mr-2"></i>
                        </span>
                        <span class="nav-link-inner--text">{{ __('Iniciar sessão') }}</span>
                    </a>
                @elseif (Illuminate\Support\Facades\Request::is('verificar/email'))
                    <!-- login -->
                    <a href="{{ route('logout') }}" class="btn btn-icon btn-outline-primary fe-carregando ml-2" onclick="event.preventDefault(); $('#form-logout').submit();">
                        <span class="btn-inner--icon">
                            <i class="fas fa-share mr-2"></i>
                        </span>
                        <span class="nav-link-inner--text">{{ __('Iniciar sessão') }}</span>
                    </a>
                @else
                    <!-- registrar-me -->
                    <a href="{{ route('register') }}" class="btn btn-icon btn-outline-primary ml-2 fe-hidden">
                        <span class="btn-inner--icon">
                            <i class="fas fa-user mr-2"></i>
                        </span>
                        <span class="nav-link-inner--text">{{ __('Registrar-me') }}</span>
                    </a>
                @endif
            </li>
        </ul>
    </div>
</nav>
