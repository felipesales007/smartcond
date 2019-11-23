@if (\App\Models\Company\Company::id() == 1)
    @if (\App\Models\User\Permission::routePermission('group.view'))
        <!-- visualizar -->
        @include('layout.groups.modals.view.modal')
        @include('layout.groups.modals.view.ajax')
    @endif

    @if (\App\Models\User\Permission::routePermission('group.store'))
        <!-- novo -->
        @include('layout.groups.modals.new.modal')
        @include('layout.groups.modals.new.ajax')
        @include('layout.groups.modals.new.validate')
    @endif

    @if (\App\Models\User\Permission::routePermission('group.edit'))
        <!-- editar -->
        @include('layout.groups.modals.edit.modal')
        @include('layout.groups.modals.edit.ajax')
        @include('layout.groups.modals.edit.validate')
    @endif

    @if (\App\Models\User\Permission::routePermission('group.ban'))
        <!-- bloquear -->
        @include('layout.groups.modals.block.modal')
        @include('layout.groups.modals.block.ajax')
        @include('layout.groups.modals.block.validate')
    @endif

    @if (\App\Models\User\Permission::routePermission('group.delete'))
        <!-- deletar -->
        @include('layout.groups.modals.delete.modal')
        @include('layout.groups.modals.delete.ajax')
        @include('layout.groups.modals.delete.validate')
    @endif
@endif
