@auth()
    @if (Illuminate\Support\Facades\Request::is('verificar/email'))
        @include('layouts.navbars.access.guest')
    @else
        @include('layouts.navbars.access.auth')
    @endif
@endauth

@guest()
    @include('layouts.navbars.access.guest')
@endguest
