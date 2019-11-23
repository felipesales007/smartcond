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

@if (\App\Models\User\Permission::routePermission('user.recover'))
    <!-- recuperar -->
    @include('management.users.modals.recover.modal')
    @include('management.users.modals.recover.ajax')
    @include('management.users.modals.recover.validate')
@endif
