@if (\App\Models\User\Permission::routePermission('condominium.block.view'))
    <!-- visualizar -->
    @include('condominium.blocks.modals.view.modal')
    @include('condominium.blocks.modals.view.ajax')
@endif

@if (\App\Models\User\Permission::routePermission('condominium.block.store'))
    <!-- novo -->
    @include('condominium.blocks.modals.new.modal')
    @include('condominium.blocks.modals.new.ajax')
    @include('condominium.blocks.modals.new.validate')
@endif

@if (\App\Models\User\Permission::routePermission('condominium.block.edit'))
    <!-- editar -->
    @include('condominium.blocks.modals.edit.modal')
    @include('condominium.blocks.modals.edit.ajax')
    @include('condominium.blocks.modals.edit.validate')
@endif

@if (\App\Models\User\Permission::routePermission('condominium.block.delete'))
    <!-- deletar -->
    @include('condominium.blocks.modals.delete.modal')
    @include('condominium.blocks.modals.delete.ajax')
    @include('condominium.blocks.modals.delete.validate')
@endif
