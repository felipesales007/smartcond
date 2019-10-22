<div id="modal-view-entity" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-view-entity-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- título e capa -->
            <div id="background-view-entity" class="modal-header fe-img-center fe-bg-view">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- dados -->
                <div class="row fe-mouse-default">
                    <!-- status, logo, nome, e-mail e contato -->
                    <div class="col-lg-12">
                        <!-- status -->
                        <span id="status-view-entity" class="badge badge-dot fe-view-fix-status d-none">
                            <i data-toggle="tooltip" data-placement="right"></i>
                        </span>
                        <!-- logo -->
                        <div id="logo-view-entity" class="fe-img-center avatar-xl fe-avatar-border rounded-circle mt--5-9"></div>
                        <!-- nome -->
                        <div id="name-view-entity" class="font-weight-bold fe-view-fix-name"></div>
                        <!-- e-mail -->
                        <small id="email-view-entity" class="float-right fe-view-fix-email"></small>
                        <!-- contato -->
                        <small id="contact-view-entity" class="float-right fe-view-fix-contact"></small>
                    </div>
                    <br>
                    <!-- cnpj -->
                    <div class="col-lg-12">
                        <i id="icon-profession-view-entity" class="fas fa-credit-card mt-3 mr-1"></i>
                        <small id="cnpj-view-entity"></small>
                    </div>
                    <!-- razão social -->
                    <div class="col-lg-12">
                        <i id="icon-course-view-entity" class="fas fa-hotel mr-1"></i>
                        <small id="corporate-name-view-entity"></small>
                    </div>
                    <!-- endereço -->
                    <div class="col-lg-12">
                        <div class="mb--4 mb-sm--2">
                            <div id="residential-view-entity" class="d-none">
                                <span class="h6 heading-small text-light">
                                    <br>
                                    Endereço
                                    <br>
                                </span>
                                <small id="postal-code-view-entity"></small>
                                <br id="br-postal-code-view-entity" class="d-none">

                                <small id="address-view-entity"></small><small id="house-number-view-entity"></small>
                                <br id="br-address-view-entity" class="d-none">

                                <small id="complement-view-entity"></small>
                                <br id="br-complement-view-entity" class="d-none">

                                <small id="neighborhood-view-entity"></small><small id="city-view-entity"></small><small id="state-view-entity"></small><small id="country-view-entity"></small>
                                <br id="br-neighborhood-view-entity" class="d-none">
                            </div>
                        </div>
                    </div>
                    <!-- data de criação e data da última atualização no sistema -->
                    <div class="col-lg-12">
                        <br>
                        <small class="float-left fe-view-fix-last-login-ip">&nbsp;</small>
                        <small id="created-at-view-entity" class="text-light float-right fe-font-size-11 fe-view-fix-created-at"></small>
                        <small id="last-update-at-view-entity" class="text-light float-right fe-font-size-11 fe-view-fix-last-update-at"></small>
                    </div>
                </div>
                <!-- variáveis -->
                <span hidden>
                    {{ $route = \App\Models\Route\Route::getRouteRoute('entity.list.users') }}
                    {{ $group = \App\Models\Route\Group::getGroup($route['group_id'])['blocked'] }}
                </span>
                <!-- botões -->
                <div class="text-right float-right fe-form-footer">
                    <a href="javascript:void(0)" class="mr-4" data-dismiss="modal">{{ __('Fechar') }}</a>
                    @if (app('router')->has('entity.list.users') && \App\Models\Permission::routePermission('entity.list.users'))
                        <a href="javascript:void(0)" {{ $group || $route['blocked'] ? '' : 'id=link-entity-list-users target=_blank' }} class="btn btn-outline-primary mr-4 px-3 {{ $group ? 'notify-block-group' : '' }} {{ $route['blocked'] ? 'notify-block-route' : '' }} {{ \App\Models\Menu\Menu::getMenuBlocked('entity.list.users') || \App\Models\Menu\MenuItem::getMenuItemBlocked('entity.list.users') ? 'fe-menu-block' : '' }}">
                            <i class="fas fa-share mr-2"></i>
                            {{ __('Lista de usuários') }}
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
