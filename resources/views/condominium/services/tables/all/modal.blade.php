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

@if (\App\Models\User\Permission::routePermission('condominium.service.edit'))
    <!-- editar -->
    @include('condominium.services.modals.edit.modal')
    @include('condominium.services.modals.edit.ajax')
    @include('condominium.services.modals.edit.validate')
@endif

@if (\App\Models\User\Permission::routePermission('condominium.service.delete'))
    <!-- deletar -->
    @include('condominium.services.modals.delete.modal')
    @include('condominium.services.modals.delete.ajax')
    @include('condominium.services.modals.delete.validate')
@endif
