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

@if (\App\Models\User\Permission::routePermission('condominium.parking.edit'))
    <!-- editar -->
    @include('condominium.parkings.modals.edit.modal')
    @include('condominium.parkings.modals.edit.ajax')
    @include('condominium.parkings.modals.edit.validate')
@endif

@if (\App\Models\User\Permission::routePermission('condominium.parking.delete'))
    <!-- deletar -->
    @include('condominium.parkings.modals.delete.modal')
    @include('condominium.parkings.modals.delete.ajax')
    @include('condominium.parkings.modals.delete.validate')
@endif
