@if (\App\Models\User\Permission::routePermission('condominium.service.view'))
    <!-- visualizar -->
    @include('condominium.services.modals.view.modal')
    @include('condominium.services.modals.view.ajax')
@endif

@if (\App\Models\User\Permission::routePermission('condominium.service.store'))
    <!-- novo -->
    @include('condominium.services.modals.new.modal')
    @include('condominium.services.modals.new.ajax')
    @include('condominium.services.modals.new.validate')
@endif

@if (\App\Models\User\Permission::routePermission('condominium.service.recover'))
    <!-- recuperar -->
    @include('condominium.services.modals.recover.modal')
    @include('condominium.services.modals.recover.ajax')
    @include('condominium.services.modals.recover.validate')
@endif
