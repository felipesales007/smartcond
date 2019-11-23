<div id="modal-view-admin" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-view-admin-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- título e capa -->
            <div id="background-view-admin" class="modal-header fe-img-center fe-bg-view">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- collapse -->
            <div class="fe-collapse-view-link">
                <!-- visualizar informações -->
                <div class="col-6 mb-4 d-none" onclick="collapseView(this);">
                    <a href="javascript:void(0)" id="event-view-admin-info" class="h5 badge badge-primary pl-3 fe-no-event-arrow" data-toggle="collapse" data-target="#collapse-view-admin-info" aria-expanded="false" aria-controls="collapse-view-admin-info">
                        {{ __('visualizar informações') }}
                    </a>
                </div>
                <!-- visualizar empresa -->
                <div class="col-6 mb-4" onclick="collapseView(this);">
                    <a href="javascript:void(0)" id="event-view-admin-company" class="h5 badge badge-primary pl-3 fe-no-event-arrow" data-toggle="collapse" data-target="#collapse-view-admin-company" aria-expanded="false" aria-controls="collapse-view-admin-company">
                        {{ __('visualizar empresa') }}
                    </a>
                </div>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- dados -->
                <div class="row fe-mouse">
                    <!-- status, foto e nome completo -->
                    <div class="col-lg-12 mb--2">
                        <!-- status -->
                        <span id="status-view-admin" class="badge badge-dot fe-view-fix-status d-none">
                            <i data-toggle="tooltip" data-placement="right"></i>
                        </span>
                        <!-- foto -->
                        <div id="photo-view-admin" class="fe-img-center avatar-xl fe-avatar-border rounded-circle mt--5-9"></div>
                        <!-- nome e sobrenome -->
                        <div id="name-view-admin" class="font-weight-bold fe-view-fix-name"></div>
                        <!-- itens da empresa -->
                        <div class="accordion">
                            <div id="collapse-view-admin-company" class="collapse" aria-labelledby="heading-view-admin-company" data-parent="#event-view-admin-company">
                                <!-- accordion para edições especiais -->
                                <div id="accordion-view-admin-company" class="accordion mt-3">
                                    <!-- empresa do administrador -->
                                    <a href="javascript:void(0)" class="list-group-item list-group-item-action fe-mouse">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <div class="avatar avatar-sm">
                                                    <img id="companies-logo-admin" src="" class="fe-img-list-view" alt="">
                                                </div>
                                            </div>
                                            <div class="col ml--2">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h4 id="companies-company-admin" class="mb-0 text-sm"></h4>
                                                </div>
                                                <p id="companies-cnpj-admin" class="text-sm mb-0"></p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- itens de informações -->
                    <div class="col-lg-12">
                        <div class="accordion mx--3">
                            <div id="collapse-view-admin-info" class="collapse" aria-labelledby="heading-view-admin-info" data-parent="#event-view-admin-info">
                                <!-- accordion para edições especiais -->
                                <div id="accordion-view-admin-info" class="accordion">
                                    <!-- e-mail e telefone -->
                                    <div class="col-lg-12 mt-1">
                                        <!-- e-mail -->
                                        <small id="email-view-admin" class="float-right fe-view-fix-email"></small>
                                        <!-- telefone -->
                                        <small id="contact-view-admin" class="float-right fe-view-fix-contact"></small>
                                    </div>
                                    <br>
                                    <!-- cpf -->
                                    <div class="col-lg-12">
                                        <i id="icon-cpf-view-admin" class="fas fa-credit-card mt-3 mr-1 d-none"></i>
                                        <small id="cpf-view-admin"></small>
                                    </div>
                                    <!-- rg -->
                                    <div class="col-lg-12">
                                        <i id="icon-rg-view-admin" class="fas fa-id-card mr-1 d-none"></i>
                                        <small id="rg-view-admin"></small>
                                    </div>
                                    <!-- aniversário -->
                                    <div class="col-lg-12">
                                        <i id="icon-birthday-view-admin" class="fas fa-birthday-cake mr-1 d-none"></i>
                                        <small id="birthday-view-admin"></small>
                                    </div>
                                    <!-- sexo -->
                                    <div class="col-lg-12">
                                        <i id="icon-gender-view-admin" class="fas fa-venus-mars mr-1 d-none"></i>
                                        <small id="gender-view-admin"></small>
                                    </div>
                                    <!-- profissão -->
                                    <div class="col-lg-12">
                                        <i id="icon-profession-view-admin" class="fas fa-briefcase mr-1 d-none"></i>
                                        <small id="profession-view-admin"></small>
                                        <small id="company-view-admin"></small>
                                    </div>
                                    <!-- formação -->
                                    <div class="col-lg-12">
                                        <i id="icon-course-view-admin" class="fas fa-graduation-cap mr-1 d-none"></i>
                                        <small id="course-view-admin"></small>
                                        <small id="college-view-admin"></small>
                                    </div>
                                    <!-- descrição -->
                                    <div class="col-lg-12">
                                        <span id="text-description-view-admin" class="h6 heading-small text-light d-none">
                                            <br>
                                            Descrição
                                            <br>
                                        </span>
                                        <small id="description-view-admin"></small>
                                    </div>
                                    <!-- endereço -->
                                    <div class="col-lg-12">
                                        <div class="mb--4 mb-sm--2">
                                            <div id="residential-view-admin" class="d-none">
                                                <span class="h6 heading-small text-light">
                                                    <br>
                                                    Endereço
                                                    <br>
                                                </span>
                                                <small id="postal-code-view-admin"></small>
                                                <br id="br-postal-code-view-admin" class="d-none">

                                                <small id="address-view-admin"></small><small id="house-number-view-admin"></small>
                                                <br id="br-address-view-admin" class="d-none">

                                                <small id="complement-view-admin"></small>
                                                <br id="br-complement-view-admin" class="d-none">

                                                <small id="neighborhood-view-admin"></small><small id="city-view-admin"></small><small id="state-view-admin"></small><small id="country-view-admin"></small>
                                                <br id="br-neighborhood-view-admin" class="d-none">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- último ip de acesso, data de criação e data da última atualização no sistema -->
                                    <div class="col-lg-12">
                                        <br>
                                        <small id="last-login-ip-view-admin" class="text-light float-left fe-font-size-11 fe-view-fix-last-login-ip"></small>
                                        <small id="created-at-view-admin" class="text-light float-right fe-font-size-11 fe-view-fix-created-at"></small>
                                        <small id="last-update-at-view-admin" class="text-light float-right fe-font-size-11 fe-view-fix-last-update-at"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- fechar -->
                <div class="text-right float-right fe-form-footer">
                    <a href="javascript:void(0)" class="mr-4" data-dismiss="modal">{{ __('Fechar') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
