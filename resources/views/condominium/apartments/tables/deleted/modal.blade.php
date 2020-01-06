@if (\App\Models\User\Permission::routePermission('condominium.apartment.view'))
    <!-- visualizar -->
    @include('condominium.apartments.modals.view.modal')
    @include('condominium.apartments.modals.view.ajax')
@endif

@if (\App\Models\User\Permission::routePermission('condominium.apartment.store'))
    <!-- novo -->
    @include('condominium.apartments.modals.new.modal')
    @include('condominium.apartments.modals.new.ajax')
    @include('condominium.apartments.modals.new.validate')
@endif

@if (\App\Models\User\Permission::routePermission('condominium.apartment.recover'))
    <!-- recuperar -->
    @include('condominium.apartments.modals.recover.modal')
    @include('condominium.apartments.modals.recover.ajax')
    @include('condominium.apartments.modals.recover.validate')
@endif
