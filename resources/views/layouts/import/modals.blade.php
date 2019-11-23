@if (\App\Models\User\Permission::routePermission('profile.password.reset'))
    <!-- editar senha do usuário logado -->
    @include('profile.modals.password-reset.modal')
    @include('profile.modals.password-reset.ajax')
    @include('profile.modals.password-reset.validate')
@endif

@if (\App\Models\User\Permission::routePermission('profile.send.support'))
    <!-- enviar e-mail para o suporte -->
    @include('profile.modals.email.modal')
    @include('profile.modals.email.ajax')
    @include('profile.modals.email.validate')
@endif
