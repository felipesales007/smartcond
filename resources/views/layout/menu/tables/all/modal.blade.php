@if (\App\Models\Company\Company::id() == 1)
    @if (\App\Models\User\Permission::routePermission('menu.view'))
        <!-- visualizar -->
        @include('layout.menu.modals.view.modal')
        @include('layout.menu.modals.view.ajax')
    @endif

    @if (\App\Models\User\Permission::routePermission('menu.store'))
        <!-- novo -->
        @include('layout.menu.modals.new.modal')
        @include('layout.menu.modals.new.ajax')
        @include('layout.menu.modals.new.validate')
    @endif

    @if (\App\Models\User\Permission::routePermission('menu.edit'))
        <!-- editar -->
        @include('layout.menu.modals.edit.modal')
        @include('layout.menu.modals.edit.ajax')
        @include('layout.menu.modals.edit.validate')
    @endif

    @if (\App\Models\User\Permission::routePermission('menu.ban'))
        <!-- bloquear -->
        @include('layout.menu.modals.block.modal')
        @include('layout.menu.modals.block.ajax')
        @include('layout.menu.modals.block.validate')
    @endif

    @if (\App\Models\User\Permission::routePermission('menu.delete'))
        <!-- deletar -->
        @include('layout.menu.modals.delete.modal')
        @include('layout.menu.modals.delete.ajax')
        @include('layout.menu.modals.delete.validate')
    @endif
@endif
