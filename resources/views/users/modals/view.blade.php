<div id="modal-view-user" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-view-user-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- título e capa -->
            <div id="background-view-user" class="modal-header fe-img-center fe-bg-view">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- collapse -->
            <div class="fe-collapse-view-link">
                <!-- visualizar informações -->
                <div class="col-6 mb-4 d-none" onclick="collapseView(this);">
                    <a href="javascript:void(0)" id="event-view-user-info" class="h5 badge badge-primary pl-3 fe-no-event-arrow" data-toggle="collapse" data-target="#collapse-view-user-info" aria-expanded="false" aria-controls="collapse-view-user-info">
                        {{ __('visualizar informações') }}
                    </a>
                </div>
                <!-- visualizar condomínio -->
                <div class="col-6 mb-4" onclick="collapseView(this);">
                    <a href="javascript:void(0)" id="event-view-user-entity" class="h5 badge badge-primary pl-3 fe-no-event-arrow" data-toggle="collapse" data-target="#collapse-view-user-entity" aria-expanded="false" aria-controls="collapse-view-user-entity">
                        {{ __('visualizar condomínio') }}
                    </a>
                </div>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- dados -->
                <div class="row fe-mouse-default">
                    <!-- status, foto e nome completo -->
                    <div class="col-lg-12 mb--2">
                        <!-- status -->
                        <span id="status-view-user" class="badge badge-dot fe-view-fix-status d-none">
                            <i data-toggle="tooltip" data-placement="right"></i>
                        </span>
                        <!-- foto -->
                        <div id="photo-view-user" class="fe-img-center avatar-xl fe-avatar-border rounded-circle mt--5-9"></div>
                        <!-- nome e sobrenome -->
                        <div id="name-view-user" class="font-weight-bold fe-view-fix-name"></div>
                        <!-- itens do condomínio -->
                        <div class="accordion">
                            <div id="collapse-view-user-entity" class="collapse" aria-labelledby="heading-view-user-entity" data-parent="#event-view-user-entity">
                                <!-- accordion para edições especiais -->
                                <div id="accordion-view-user-entity" class="accordion mt-3">
                                    <!-- condomínio do usuário via ajax -->
                                    <div id="scroll-user-view-entity" class="scroll-user-view-entity"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- itens de informações -->
                    <div class="col-lg-12">
                        <div class="accordion mx--3">
                            <div id="collapse-view-user-info" class="collapse" aria-labelledby="heading-view-user-info" data-parent="#event-view-user-info">
                                <!-- accordion para edições especiais -->
                                <div id="accordion-view-user-info" class="accordion">
                                    <!-- e-mail e contato -->
                                    <div class="col-lg-12 mt-1">
                                        <!-- e-mail -->
                                        <small id="email-view-user" class="float-right fe-view-fix-email"></small>
                                        <!-- contato -->
                                        <small id="contact-view-user" class="float-right fe-view-fix-contact"></small>
                                    </div>
                                    <br>
                                    <!-- cpf -->
                                    <div class="col-lg-12">
                                        <i id="icon-cpf-view-user" class="fas fa-credit-card mt-3 mr-1 d-none"></i>
                                        <small id="cpf-view-user"></small>
                                    </div>
                                    <!-- rg -->
                                    <div class="col-lg-12">
                                        <i id="icon-rg-view-user" class="fas fa-id-card mr-1 d-none"></i>
                                        <small id="rg-view-user"></small>
                                    </div>
                                    <!-- aniversário -->
                                    <div class="col-lg-12">
                                        <i id="icon-birthday-view-user" class="fas fa-birthday-cake mr-1 d-none"></i>
                                        <small id="birthday-view-user"></small>
                                    </div>
                                    <!-- sexo -->
                                    <div class="col-lg-12">
                                        <i id="icon-gender-view-user" class="fas fa-venus-mars mr-1 d-none"></i>
                                        <small id="gender-view-user"></small>
                                    </div>
                                    <!-- profissão -->
                                    <div class="col-lg-12">
                                        <i id="icon-profession-view-user" class="fas fa-briefcase mr-1 d-none"></i>
                                        <small id="profession-view-user"></small>
                                        <small id="company-view-user"></small>
                                    </div>
                                    <!-- formação -->
                                    <div class="col-lg-12">
                                        <i id="icon-course-view-user" class="fas fa-graduation-cap mr-1 d-none"></i>
                                        <small id="course-view-user"></small>
                                        <small id="college-view-user"></small>
                                    </div>
                                    <!-- descrição -->
                                    <div class="col-lg-12">
                                        <span id="text-description-view-user" class="h6 heading-small text-light d-none">
                                            <br>
                                            Descrição
                                            <br>
                                        </span>
                                        <small id="description-view-user"></small>
                                    </div>
                                    <!-- endereço -->
                                    <div class="col-lg-12">
                                        <div class="mb--4 mb-sm--2">
                                            <div id="residential-view-user" class="d-none">
                                                <span class="h6 heading-small text-light">
                                                    <br>
                                                    Endereço
                                                    <br>
                                                </span>
                                                <small id="postal-code-view-user"></small>
                                                <br id="br-postal-code-view-user" class="d-none">

                                                <small id="address-view-user"></small><small id="house-number-view-user"></small>
                                                <br id="br-address-view-user" class="d-none">

                                                <small id="complement-view-user"></small>
                                                <br id="br-complement-view-user" class="d-none">

                                                <small id="neighborhood-view-user"></small><small id="city-view-user"></small><small id="state-view-user"></small><small id="country-view-user"></small>
                                                <br id="br-neighborhood-view-user" class="d-none">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- último ip de acesso, data de criação e data da última atualização no sistema -->
                                    <div class="col-lg-12">
                                        <br>
                                        <small id="last-login-ip-view-user" class="text-light float-left fe-font-size-11 fe-view-fix-last-login-ip"></small>
                                        <small id="created-at-view-user" class="text-light float-right fe-font-size-11 fe-view-fix-created-at"></small>
                                        <small id="last-update-at-view-user" class="text-light float-right fe-font-size-11 fe-view-fix-last-update-at"></small>
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
