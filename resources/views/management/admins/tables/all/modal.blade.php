@if (auth()->user()['admin'] == 1)
    @if (\App\Models\User\Permission::routePermission('admin.view'))
        <!-- visualizar -->
        @include('management.admins.modals.view.modal')
        @include('management.admins.modals.view.ajax')
    @endif

    @if (\App\Models\User\Permission::routePermission('admin.store'))
        <!-- novo -->
        @include('management.admins.modals.new.modal')
        @include('management.admins.modals.new.ajax')
        @include('management.admins.modals.new.validate')
    @endif

    @if (\App\Models\User\Permission::routePermission('admin.edit'))
        <!-- editar -->
        @include('management.admins.modals.edit.modal')
        @include('management.admins.modals.edit.ajax')
        @include('management.admins.modals.edit.validate')
    @endif

    @if (\App\Models\User\Permission::routePermission('admin.ban'))
        <!-- bloquear -->
        @include('management.admins.modals.block.modal')
        @include('management.admins.modals.block.ajax')
        @include('management.admins.modals.block.validate')
    @endif

    @if (\App\Models\User\Permission::routePermission('admin.delete'))
        <!-- deletar -->
        @include('management.admins.modals.delete.modal')
        @include('management.admins.modals.delete.ajax')
        @include('management.admins.modals.delete.validate')
    @endif

    @if (\App\Models\User\Permission::routePermission('admin.send.email'))
        <!-- enviar e-mail -->
        @include('management.admins.modals.email.modal')
        @include('management.admins.modals.email.ajax')
        @include('management.admins.modals.email.validate')
    @endif
@endif
