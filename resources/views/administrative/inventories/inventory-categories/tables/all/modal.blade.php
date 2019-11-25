@if (\App\Models\User\Permission::routePermission('inventory.category.view'))
    <!-- visualizar -->
    @include('administrative.inventories.inventory-categories.modals.view.modal')
    @include('administrative.inventories.inventory-categories.modals.view.ajax')
@endif

@if (\App\Models\User\Permission::routePermission('inventory.category.store'))
    <!-- novo -->
    @include('administrative.inventories.inventory-categories.modals.new.modal')
    @include('administrative.inventories.inventory-categories.modals.new.ajax')
    @include('administrative.inventories.inventory-categories.modals.new.validate')
@endif

@if (\App\Models\User\Permission::routePermission('inventory.category.edit'))
    <!-- editar -->
    @include('administrative.inventories.inventory-categories.modals.edit.modal')
    @include('administrative.inventories.inventory-categories.modals.edit.ajax')
    @include('administrative.inventories.inventory-categories.modals.edit.validate')
@endif

@if (\App\Models\User\Permission::routePermission('inventory.category.ban'))
    <!-- bloquear -->
    @include('administrative.inventories.inventory-categories.modals.block.modal')
    @include('administrative.inventories.inventory-categories.modals.block.ajax')
    @include('administrative.inventories.inventory-categories.modals.block.validate')
@endif

@if (\App\Models\User\Permission::routePermission('inventory.category.delete'))
    <!-- deletar -->
    @include('administrative.inventories.inventory-categories.modals.delete.modal')
    @include('administrative.inventories.inventory-categories.modals.delete.ajax')
    @include('administrative.inventories.inventory-categories.modals.delete.validate')
@endif
