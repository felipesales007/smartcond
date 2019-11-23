@if (\App\Models\Company\Company::id() == 1)
    @if (\App\Models\User\Permission::routePermission('route.view'))
        <!-- visualizar -->
        @include('layout.routes.modals.view.modal')
        @include('layout.routes.modals.view.ajax')
    @endif

    @if (\App\Models\User\Permission::routePermission('route.store'))
        <!-- nova -->
        @include('layout.routes.modals.new.modal')
        @include('layout.routes.modals.new.ajax')
        @include('layout.routes.modals.new.validate')
    @endif

    @if (\App\Models\User\Permission::routePermission('route.edit'))
        <!-- editar -->
        @include('layout.routes.modals.edit.modal')
        @include('layout.routes.modals.edit.ajax')
        @include('layout.routes.modals.edit.validate')
    @endif

    @if (\App\Models\User\Permission::routePermission('route.ban'))
        <!-- bloquear -->
        @include('layout.routes.modals.block.modal')
        @include('layout.routes.modals.block.ajax')
        @include('layout.routes.modals.block.validate')
    @endif

    @if (\App\Models\User\Permission::routePermission('route.delete'))
        <!-- deletar -->
        @include('layout.routes.modals.delete.modal')
        @include('layout.routes.modals.delete.ajax')
        @include('layout.routes.modals.delete.validate')
    @endif
@endif
