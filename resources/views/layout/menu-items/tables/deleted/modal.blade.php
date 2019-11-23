@if (\App\Models\Company\Company::id() == 1)
    @if (\App\Models\User\Permission::routePermission('menu.item.view'))
        <!-- visualizar -->
        @include('layout.menu-items.modals.view.modal')
        @include('layout.menu-items.modals.view.ajax')
    @endif

    @if (\App\Models\User\Permission::routePermission('menu.item.store'))
        <!-- novo -->
        @include('layout.menu-items.modals.new.modal')
        @include('layout.menu-items.modals.new.ajax')
        @include('layout.menu-items.modals.new.validate')
    @endif

    @if (\App\Models\User\Permission::routePermission('menu.item.recover'))
        <!-- recuperar -->
        @include('layout.menu-items.modals.recover.modal')
        @include('layout.menu-items.modals.recover.ajax')
        @include('layout.menu-items.modals.recover.validate')
    @endif
@endif
