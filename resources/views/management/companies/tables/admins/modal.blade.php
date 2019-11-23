@if (auth()->user()['admin'] == 1)
    @if (\App\Models\User\Permission::routePermission('company.admin.store'))
        <!-- novo -->
        @include('management.companies.modals.new-admin.modal')
        @include('management.companies.modals.new-admin.ajax')
        @include('management.companies.modals.new-admin.validate')
    @endif
@endif
