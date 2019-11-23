@if (\App\Models\User\Permission::routePermission('entity.user.store'))
    <!-- novo -->
    @include('management.entities.modals.new-user.modal')
    @include('management.entities.modals.new-user.ajax')
    @include('management.entities.modals.new-user.validate')
@endif
