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

@if (\App\Models\User\Permission::routePermission('condominium.block.recover'))
    <!-- recuperar -->
    @include('condominium.blocks.modals.recover.modal')
    @include('condominium.blocks.modals.recover.ajax')
    @include('condominium.blocks.modals.recover.validate')
@endif
