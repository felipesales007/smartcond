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

    @if (\App\Models\User\Permission::routePermission('company.recover'))
        <!-- recuperar -->
        @include('management.companies.modals.recover.modal')
        @include('management.companies.modals.recover.ajax')
        @include('management.companies.modals.recover.validate')
    @endif
@endif
