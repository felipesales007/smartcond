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

@if (\App\Models\User\Permission::routePermission('condominium.apartment.edit'))
    <!-- editar -->
    @include('condominium.apartments.modals.edit.modal')
    @include('condominium.apartments.modals.edit.ajax')
    @include('condominium.apartments.modals.edit.validate')
@endif

@if (\App\Models\User\Permission::routePermission('condominium.apartment.delete'))
    <!-- deletar -->
    @include('condominium.apartments.modals.delete.modal')
    @include('condominium.apartments.modals.delete.ajax')
    @include('condominium.apartments.modals.delete.validate')
@endif
