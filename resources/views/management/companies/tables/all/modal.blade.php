@if (auth()->user()['admin'] == 1)
    @if (\App\Models\User\Permission::routePermission('company.view'))
        <!-- visualizar -->
        @include('management.companies.modals.view.modal')
        @include('management.companies.modals.view.ajax')
    @endif

    @if (\App\Models\Company\Company::id() == 1)
        @if (\App\Models\User\Permission::routePermission('company.store'))
            <!-- nova -->
            @include('management.companies.modals.new.modal')
            @include('management.companies.modals.new.ajax')
            @include('management.companies.modals.new.validate')
        @endif
    @endif

    @if (\App\Models\User\Permission::routePermission('company.admin.store'))
        <!-- novo administrador -->
        @include('management.companies.modals.new-admin.modal')
        @include('management.companies.modals.new-admin.ajax')
        @include('management.companies.modals.new-admin.validate')
    @endif

    @if (\App\Models\User\Permission::routePermission('company.edit'))
        <!-- editar -->
        @include('management.companies.modals.edit.modal')
        @include('management.companies.modals.edit.ajax')
        @include('management.companies.modals.edit.validate')
    @endif

    @if (\App\Models\User\Permission::routePermission('company.ban'))
        <!-- bloquear -->
        @include('management.companies.modals.block.modal')
        @include('management.companies.modals.block.ajax')
        @include('management.companies.modals.block.validate')
    @endif

    @if (\App\Models\User\Permission::routePermission('company.delete'))
        <!-- deletar -->
        @include('management.companies.modals.delete.modal')
        @include('management.companies.modals.delete.ajax')
        @include('management.companies.modals.delete.validate')
    @endif

    @if (\App\Models\User\Permission::routePermission('company.send.email'))
        <!-- enviar e-mail -->
        @include('management.companies.modals.email.modal')
        @include('management.companies.modals.email.ajax')
        @include('management.companies.modals.email.validate')
    @endif
@endif
