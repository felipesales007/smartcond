@if (\App\Models\Company\Company::id() == 1)
    @if (\App\Models\User\Permission::routePermission('menu.view'))
        <!-- visualizar -->
        @include('layout.menu.modals.view.modal')
        @include('layout.menu.modals.view.ajax')
    @endif

    @if (\App\Models\User\Permission::routePermission('menu.store'))
        <!-- novo -->
        @include('layout.menu.modals.new.modal')
        @include('layout.menu.modals.new.ajax')
        @include('layout.menu.modals.new.validate')
    @endif

    @if (\App\Models\User\Permission::routePermission('menu.recover'))
        <!-- recuperar -->
        @include('layout.menu.modals.recover.modal')
        @include('layout.menu.modals.recover.ajax')
        @include('layout.menu.modals.recover.validate')
    @endif
@endif
