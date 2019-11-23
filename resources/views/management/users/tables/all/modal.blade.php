@if (\App\Models\User\Permission::routePermission('user.view'))
    <!-- visualizar -->
    @include('management.users.modals.view.modal')
    @include('management.users.modals.view.ajax')
@endif

@if (\App\Models\User\Permission::routePermission('user.store'))
    <!-- novo -->
    @include('management.users.modals.new.modal')
    @include('management.users.modals.new.ajax')
    @include('management.users.modals.new.validate')
@endif

@if (\App\Models\User\Permission::routePermission('user.edit'))
    <!-- editar -->
    @include('management.users.modals.edit.modal')
    @include('management.users.modals.edit.ajax')
    @include('management.users.modals.edit.validate')
@endif

@if (\App\Models\User\Permission::routePermission('user.ban'))
    <!-- bloquear -->
    @include('management.users.modals.block.modal')
    @include('management.users.modals.block.ajax')
    @include('management.users.modals.block.validate')
@endif

@if (\App\Models\User\Permission::routePermission('user.delete'))
    <!-- deletar -->
    @include('management.users.modals.delete.modal')
    @include('management.users.modals.delete.ajax')
    @include('management.users.modals.delete.validate')
@endif

@if (\App\Models\User\Permission::routePermission('user.send.email'))
    <!-- enviar e-mail -->
    @include('management.users.modals.email.modal')
    @include('management.users.modals.email.ajax')
    @include('management.users.modals.email.validate')
@endif
