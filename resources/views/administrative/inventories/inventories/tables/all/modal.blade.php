@if (\App\Models\User\Permission::routePermission('inventory.view'))
    <!-- visualizar -->
    @include('administrative.inventories.inventories.modals.view.modal')
    @include('administrative.inventories.inventories.modals.view.ajax')
@endif

@if (\App\Models\User\Permission::routePermission('inventory.store'))
    <!-- novo -->
    @include('administrative.inventories.inventories.modals.new.modal')
    @include('administrative.inventories.inventories.modals.new.ajax')
    @include('administrative.inventories.inventories.modals.new.validate')
@endif

@if (\App\Models\User\Permission::routePermission('inventory.edit'))
    <!-- editar -->
    @include('administrative.inventories.inventories.modals.edit.modal')
    @include('administrative.inventories.inventories.modals.edit.ajax')
    @include('administrative.inventories.inventories.modals.edit.validate')
@endif

@if (\App\Models\User\Permission::routePermission('inventory.delete'))
    <!-- deletar -->
    @include('administrative.inventories.inventories.modals.delete.modal')
    @include('administrative.inventories.inventories.modals.delete.ajax')
    @include('administrative.inventories.inventories.modals.delete.validate')
@endif
