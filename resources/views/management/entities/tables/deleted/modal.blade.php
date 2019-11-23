@if (\App\Models\User\Permission::routePermission('entity.view'))
    <!-- visualizar -->
    @include('management.entities.modals.view.modal')
    @include('management.entities.modals.view.ajax')
@endif

@if (auth()->user()['admin'] == 1)
    @if (\App\Models\User\Permission::routePermission('entity.store'))
        <!-- nova -->
        @include('management.entities.modals.new.modal')
        @include('management.entities.modals.new.ajax')
        @include('management.entities.modals.new.validate')
    @endif

    @if (\App\Models\User\Permission::routePermission('entity.recover'))
        <!-- recuperar -->
        @include('management.entities.modals.recover.modal')
        @include('management.entities.modals.recover.ajax')
        @include('management.entities.modals.recover.validate')
    @endif
@endif
