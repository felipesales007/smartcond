@if (\App\Models\User\Permission::routePermission('condominium.parking.view'))
    <!-- visualizar -->
    @include('condominium.parkings.modals.view.modal')
    @include('condominium.parkings.modals.view.ajax')
@endif

@if (\App\Models\User\Permission::routePermission('condominium.parking.store'))
    <!-- novo -->
    @include('condominium.parkings.modals.new.modal')
    @include('condominium.parkings.modals.new.ajax')
    @include('condominium.parkings.modals.new.validate')
@endif

@if (\App\Models\User\Permission::routePermission('condominium.parking.recover'))
    <!-- recuperar -->
    @include('condominium.parkings.modals.recover.modal')
    @include('condominium.parkings.modals.recover.ajax')
    @include('condominium.parkings.modals.recover.validate')
@endif
