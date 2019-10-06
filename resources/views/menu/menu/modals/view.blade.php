<div id="modal-view-menu" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-view-menu-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <!-- título e capa -->
            <div class="modal-header">
                <h5 id="modal-view-menu-label" class="modal-title text-uppercase text-monospace ml-1">
                    <b>{{ __('Visualizar menu') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- dados -->
                <div class="row fe-mouse-default">
                    <div class="col-lg-12">
                        <!-- informações -->
                        <div class="mt--3 mb-4">
                            <!-- visível ou não -->
                            <div class="d-inline-flex">
                                <div id="hidden-view-menu"></div>
                            </div>
                            <!-- status -->
                            <small id="status-view-menu" class="float-right d-none"></small>
                        </div>
                        <!-- nome -->
                        <span id="name-view-menu"></span>
                        <!-- ordem -->
                        <div id="order-view-menu" class="float-right mt-5"></div>
                        <!-- tipo -->
                        <div id="type-view-menu" class="mt-4"></div>
                        <!-- icone -->
                        <div id="icon-view-menu" class="float-right mt-1"></div>
                        <!-- cor -->
                        <div id="color-view-menu" class="mt-1"></div>
                        <!-- descrição -->
                        <span id="description-view-menu"></span>
                    </div>
                    <!-- data de criação e data da última atualização no sistema -->
                    <div class="col-lg-12">
                        <br>
                        <small class="float-left fe-view-fix-last-login-ip">&nbsp;</small>
                        <small id="created-at-view-menu" class="text-light float-right fe-font-size-11 fe-view-fix-created-at"></small>
                        <small id="updated-at-view-menu" class="text-light float-right fe-font-size-11 fe-view-fix-updated-at"></small>
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
