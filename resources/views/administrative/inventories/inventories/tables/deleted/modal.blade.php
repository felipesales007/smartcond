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

@if (\App\Models\User\Permission::routePermission('inventory.recover'))
    <!-- recuperar -->
    @include('administrative.inventories.inventories.modals.recover.modal')
    @include('administrative.inventories.inventories.modals.recover.ajax')
    @include('administrative.inventories.inventories.modals.recover.validate')
@endif
