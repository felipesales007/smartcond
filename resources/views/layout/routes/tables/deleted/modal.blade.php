@if (\App\Models\Company\Company::id() == 1)
    @if (\App\Models\User\Permission::routePermission('route.view'))
        <!-- visualizar -->
        @include('layout.routes.modals.view.modal')
        @include('layout.routes.modals.view.ajax')
    @endif

    @if (\App\Models\User\Permission::routePermission('route.store'))
        <!-- nova -->
        @include('layout.routes.modals.new.modal')
        @include('layout.routes.modals.new.ajax')
        @include('layout.routes.modals.new.validate')
    @endif

    @if (\App\Models\User\Permission::routePermission('route.recover'))
        <!-- recuperar -->
        @include('layout.routes.modals.recover.modal')
        @include('layout.routes.modals.recover.ajax')
        @include('layout.routes.modals.recover.validate')
    @endif
@endif
