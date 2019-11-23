@if (\App\Models\Company\Company::id() == 1)
    @if (\App\Models\User\Permission::routePermission('menu.item.view'))
        <!-- visualizar -->
        @include('layout.menu-items.modals.view.modal')
        @include('layout.menu-items.modals.view.ajax')
    @endif

    @if (\App\Models\User\Permission::routePermission('menu.item.store'))
        <!-- novo -->
        @include('layout.menu-items.modals.new.modal')
        @include('layout.menu-items.modals.new.ajax')
        @include('layout.menu-items.modals.new.validate')
    @endif

    @if (\App\Models\User\Permission::routePermission('menu.item.edit'))
        <!-- editar -->
        @include('layout.menu-items.modals.edit.modal')
        @include('layout.menu-items.modals.edit.ajax')
        @include('layout.menu-items.modals.edit.validate')
    @endif

    @if (\App\Models\User\Permission::routePermission('menu.item.ban'))
        <!-- bloquear -->
        @include('layout.menu-items.modals.block.modal')
        @include('layout.menu-items.modals.block.ajax')
        @include('layout.menu-items.modals.block.validate')
    @endif

    @if (\App\Models\User\Permission::routePermission('menu.item.delete'))
        <!-- deletar -->
        @include('layout.menu-items.modals.delete.modal')
        @include('layout.menu-items.modals.delete.ajax')
        @include('layout.menu-items.modals.delete.validate')
    @endif
@endif
