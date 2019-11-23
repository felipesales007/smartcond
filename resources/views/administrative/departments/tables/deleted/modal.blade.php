@if (\App\Models\User\Permission::routePermission('department.view'))
    <!-- visualizar -->
    @include('administrative.departments.modals.view.modal')
    @include('administrative.departments.modals.view.ajax')
@endif

@if (\App\Models\User\Permission::routePermission('department.store'))
    <!-- novo -->
    @include('administrative.departments.modals.new.modal')
    @include('administrative.departments.modals.new.ajax')
    @include('administrative.departments.modals.new.validate')
@endif

@if (\App\Models\User\Permission::routePermission('department.recover'))
    <!-- recuperar -->
    @include('administrative.departments.modals.recover.modal')
    @include('administrative.departments.modals.recover.ajax')
    @include('administrative.departments.modals.recover.validate')
@endif
