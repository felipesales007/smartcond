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

@if (\App\Models\User\Permission::routePermission('inventory.category.recover'))
    <!-- recuperar -->
    @include('administrative.inventories.inventory-categories.modals.recover.modal')
    @include('administrative.inventories.inventory-categories.modals.recover.ajax')
    @include('administrative.inventories.inventory-categories.modals.recover.validate')
@endif
