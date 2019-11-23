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

@if (\App\Models\User\Permission::routePermission('department.edit'))
    <!-- editar -->
    @include('administrative.departments.modals.edit.modal')
    @include('administrative.departments.modals.edit.ajax')
    @include('administrative.departments.modals.edit.validate')
@endif

@if (\App\Models\User\Permission::routePermission('department.ban'))
    <!-- bloquear -->
    @include('administrative.departments.modals.block.modal')
    @include('administrative.departments.modals.block.ajax')
    @include('administrative.departments.modals.block.validate')
@endif

@if (\App\Models\User\Permission::routePermission('department.delete'))
    <!-- deletar -->
    @include('administrative.departments.modals.delete.modal')
    @include('administrative.departments.modals.delete.ajax')
    @include('administrative.departments.modals.delete.validate')
@endif
