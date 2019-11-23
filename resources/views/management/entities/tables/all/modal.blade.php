@if (\App\Models\User\Permission::routePermission('entity.view'))
    <!-- visualizar -->
    @include('management.entities.modals.view.modal')
    @include('management.entities.modals.view.ajax')
@endif

@if (\App\Models\User\Permission::routePermission('entity.user.store'))
    <!-- novo usuário -->
    @include('management.entities.modals.new-user.modal')
    @include('management.entities.modals.new-user.ajax')
    @include('management.entities.modals.new-user.validate')
@endif

@if (\App\Models\User\Permission::routePermission('entity.edit'))
    <!-- editar -->
    @include('management.entities.modals.edit.modal')
    @include('management.entities.modals.edit.ajax')
    @include('management.entities.modals.edit.validate')
@endif

@if (\App\Models\User\Permission::routePermission('entity.send.email'))
    <!-- enviar e-mail -->
    @include('management.entities.modals.email.modal')
    @include('management.entities.modals.email.ajax')
    @include('management.entities.modals.email.validate')
@endif

@if (auth()->user()['admin'] == 1)
    @if (\App\Models\User\Permission::routePermission('entity.store'))
        <!-- nova -->
        @include('management.entities.modals.new.modal')
        @include('management.entities.modals.new.ajax')
        @include('management.entities.modals.new.validate')
    @endif

    @if (\App\Models\User\Permission::routePermission('entity.ban'))
        <!-- bloquear -->
        @include('management.entities.modals.block.modal')
        @include('management.entities.modals.block.ajax')
        @include('management.entities.modals.block.validate')
    @endif

    @if (\App\Models\User\Permission::routePermission('entity.delete'))
        <!-- deletar -->
        @include('management.entities.modals.delete.modal')
        @include('management.entities.modals.delete.ajax')
        @include('management.entities.modals.delete.validate')
    @endif
@endif
