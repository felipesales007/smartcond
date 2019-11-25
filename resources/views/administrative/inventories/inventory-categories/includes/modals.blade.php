@if (\App\Models\Permission::buttonPermission('btn-modal-view-inventory-category'))
    <!-- visualizar categoria -->
    @include('inventories.inventory-categories.modals.view')
@endif

@if (\App\Models\Permission::buttonPermission('btn-modal-new-inventory-category'))
    <!-- nova categoria -->
    @include('inventories.inventory-categories.modals.new')

@endif

@if (\App\Models\Permission::buttonPermission('btn-modal-edit-inventory-category'))
    <!-- editar categoria -->
    @include('inventories.inventory-categories.modals.edit')

@endif

@if (\App\Models\Permission::buttonPermission('btn-modal-block-inventory-category'))
    <!-- bloquear categoria -->
    @include('inventories.inventory-categories.modals.block')

@endif

@if (\App\Models\Permission::buttonPermission('btn-modal-delete-inventory-category'))
    <!-- deletar categoria -->
    @include('inventories.inventory-categories.modals.delete')

@endif

@if (\App\Models\Permission::buttonPermission('btn-modal-recover-inventory-category'))
    <!-- recuperar categoria -->
    @include('inventories.inventory-categories.modals.recover')

@endif
