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

    @if (\App\Models\User\Permission::routePermission('admin.recover'))
        <!-- recuperar -->
        @include('management.admins.modals.recover.modal')
        @include('management.admins.modals.recover.ajax')
        @include('management.admins.modals.recover.validate')
    @endif
@endif
