<div id="modal-view-company" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-view-company-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- título e capa -->
            <div id="background-view-company" class="modal-header fe-img-center fe-bg-view">
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
                        <span id="status-view-company" class="badge badge-dot fe-view-fix-status d-none">
                            <i data-toggle="tooltip" data-placement="right"></i>
                        </span>
                        <!-- logo -->
                        <div id="logo-view-company" class="fe-img-center avatar-xl fe-avatar-border rounded-circle mt--5-9"></div>
                        <!-- nome -->
                        <div id="name-view-company" class="font-weight-bold fe-view-fix-name"></div>
                        <!-- e-mail -->
                        <small id="email-view-company" class="float-right fe-view-fix-email"></small>
                        <!-- contato -->
                        <small id="contact-view-company" class="float-right fe-view-fix-contact"></small>
                    </div>
                    <br>
                    <!-- cnpj -->
                    <div class="col-lg-12">
                        <i id="icon-profession-view-company" class="fas fa-credit-card mt-3 mr-1"></i>
                        <small id="cnpj-view-company"></small>
                    </div>
                    <!-- razão social -->
                    <div class="col-lg-12">
                        <i id="icon-course-view-company" class="fas fa-hotel mr-1"></i>
                        <small id="corporate-name-view-company"></small>
                    </div>
                    <!-- endereço -->
                    <div class="col-lg-12">
                        <div class="mb--4 mb-sm--2">
                            <div id="residential-view-company" class="d-none">
                                <span class="h6 heading-small text-light">
                                    <br>
                                    Endereço
                                    <br>
                                </span>
                                <small id="postal-code-view-company"></small>
                                <br id="br-postal-code-view-company" class="d-none">

                                <small id="address-view-company"></small><small id="house-number-view-company"></small>
                                <br id="br-address-view-company" class="d-none">

                                <small id="complement-view-company"></small>
                                <br id="br-complement-view-company" class="d-none">

                                <small id="neighborhood-view-company"></small><small id="city-view-company"></small><small id="state-view-company"></small><small id="country-view-company"></small>
                                <br id="br-neighborhood-view-company" class="d-none">
                            </div>
                        </div>
                    </div>
                    <!-- data de criação e data da última atualização no sistema -->
                    <div class="col-lg-12">
                        <br>
                        <small class="float-left fe-view-fix-last-login-ip">&nbsp;</small>
                        <small id="created-at-view-company" class="text-light float-right fe-font-size-11 fe-view-fix-created-at"></small>
                        <small id="last-update-at-view-company" class="text-light float-right fe-font-size-11 fe-view-fix-last-update-at"></small>
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
