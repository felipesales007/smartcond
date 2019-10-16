<div id="modal-view-resident" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-view-resident-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- título e capa -->
            <div id="background-view-resident" class="modal-header fe-img-center fe-bg-view">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- collapse -->
            <div class="fe-collapse-view-link">
                <!-- visualizar informações -->
                <div class="col-6 mb-4 d-none" onclick="collapseView(this);">
                    <a href="javascript:void(0)" id="event-view-resident-info" class="h5 badge badge-primary pl-2" data-toggle="collapse" data-target="#collapse-view-resident-info" aria-expanded="false" aria-controls="collapse-view-resident-info">
                        {{ __('visualizar informações') }}
                        <i class="fas fa-chevron-down ml-1"></i>
                    </a>
                </div>
                <!-- visualizar condomínio -->
                <div class="col-6 mb-4" onclick="collapseView(this);">
                    <a href="javascript:void(0)" id="event-view-resident-company" class="h5 badge badge-primary pl-2" data-toggle="collapse" data-target="#collapse-view-resident-company" aria-expanded="false" aria-controls="collapse-view-resident-company">
                        {{ __('visualizar condomínio') }}
                        <i class="fas fa-chevron-down ml-1"></i>
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
                        <span id="status-view-resident" class="badge badge-dot fe-view-fix-status d-none">
                            <i data-toggle="tooltip" data-placement="right"></i>
                        </span>
                        <!-- foto -->
                        <div id="photo-view-resident" class="fe-img-center avatar-xl fe-avatar-border rounded-circle mt--5-9"></div>
                        <!-- nome e sobrenome -->
                        <div id="name-view-resident" class="font-weight-bold fe-view-fix-name"></div>
                        <!-- itens do condomínio -->
                        <div class="accordion">
                            <div id="collapse-view-resident-company" class="collapse" aria-labelledby="heading-view-resident-company" data-parent="#event-view-resident-company">
                                <!-- accordion para edições especiais -->
                                <div id="accordion-view-resident-company" class="accordion mt-3">
                                    <!-- condomínio do morador via ajax -->
                                    <div id="scroll-resident-view-company" class="scroll-resident-view-company"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- itens de informações -->
                    <div class="col-lg-12">
                        <div class="accordion mx--3">
                            <div id="collapse-view-resident-info" class="collapse" aria-labelledby="heading-view-resident-info" data-parent="#event-view-resident-info">
                                <!-- accordion para edições especiais -->
                                <div id="accordion-view-resident-info" class="accordion">
                                    <!-- e-mail e contato -->
                                    <div class="col-lg-12 mt-1">
                                        <!-- e-mail -->
                                        <small id="email-view-resident" class="float-right fe-view-fix-email"></small>
                                        <!-- contato -->
                                        <small id="contact-view-resident" class="float-right fe-view-fix-contact"></small>
                                    </div>
                                    <br>
                                    <!-- cpf -->
                                    <div class="col-lg-12">
                                        <i id="icon-cpf-view-resident" class="fas fa-credit-card mt-3 mr-1 d-none"></i>
                                        <small id="cpf-view-resident"></small>
                                    </div>
                                    <!-- rg -->
                                    <div class="col-lg-12">
                                        <i id="icon-rg-view-resident" class="fas fa-id-card mr-1 d-none"></i>
                                        <small id="rg-view-resident"></small>
                                    </div>
                                    <!-- aniversário -->
                                    <div class="col-lg-12">
                                        <i id="icon-birthday-view-resident" class="fas fa-birthday-cake mr-1 d-none"></i>
                                        <small id="birthday-view-resident"></small>
                                    </div>
                                    <!-- sexo -->
                                    <div class="col-lg-12">
                                        <i id="icon-gender-view-resident" class="fas fa-venus-mars mr-1 d-none"></i>
                                        <small id="gender-view-resident"></small>
                                    </div>
                                    <!-- profissão -->
                                    <div class="col-lg-12">
                                        <i id="icon-profession-view-resident" class="fas fa-briefcase mr-1 d-none"></i>
                                        <small id="profession-view-resident"></small>
                                        <small id="company-view-resident"></small>
                                    </div>
                                    <!-- formação -->
                                    <div class="col-lg-12">
                                        <i id="icon-course-view-resident" class="fas fa-graduation-cap mr-1 d-none"></i>
                                        <small id="course-view-resident"></small>
                                        <small id="college-view-resident"></small>
                                    </div>
                                    <!-- descrição -->
                                    <div class="col-lg-12">
                                        <span id="text-description-view-resident" class="h6 heading-small text-light d-none">
                                            <br>
                                            Descrição
                                            <br>
                                        </span>
                                        <small id="description-view-resident"></small>
                                    </div>
                                    <!-- endereço -->
                                    <div class="col-lg-12">
                                        <div class="mb--4 mb-sm--2">
                                            <div id="residential-view-resident" class="d-none">
                                                <span class="h6 heading-small text-light">
                                                    <br>
                                                    Endereço
                                                    <br>
                                                </span>
                                                <small id="postal-code-view-resident"></small>
                                                <br id="br-postal-code-view-resident" class="d-none">

                                                <small id="address-view-resident"></small><small id="house-number-view-resident"></small>
                                                <br id="br-address-view-resident" class="d-none">

                                                <small id="complement-view-resident"></small>
                                                <br id="br-complement-view-resident" class="d-none">

                                                <small id="neighborhood-view-resident"></small><small id="city-view-resident"></small><small id="state-view-resident"></small><small id="country-view-resident"></small>
                                                <br id="br-neighborhood-view-resident" class="d-none">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- último ip de acesso, data de criação e data da última atualização no sistema -->
                                    <div class="col-lg-12">
                                        <br>
                                        <small id="last-login-ip-view-resident" class="text-light float-left fe-font-size-11 fe-view-fix-last-login-ip"></small>
                                        <small id="created-at-view-resident" class="text-light float-right fe-font-size-11 fe-view-fix-created-at"></small>
                                        <small id="last-update-at-view-resident" class="text-light float-right fe-font-size-11 fe-view-fix-last-update-at"></small>
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
