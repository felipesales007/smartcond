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

    @if (\App\Models\User\Permission::routePermission('group.recover'))
        <!-- recuperar -->
        @include('layout.groups.modals.recover.modal')
        @include('layout.groups.modals.recover.ajax')
        @include('layout.groups.modals.recover.validate')
    @endif
@endif
