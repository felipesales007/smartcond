<div id="modal-view-condominium-parking" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-view-condominium-parking-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- título e capa -->
            <div class="modal-header">
                <h5 id="modal-view-condominium-parking-label" class="modal-title text-uppercase text-monospace ml-1">
                    <b>{{ __('Visualizar estacionamento') }}</b>
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
                        <!-- status -->
                        <small id="status-view-condominium-parking" class="float-right mt--4 d-none"></small>
                        <!-- nome -->
                        <div id="name-view-condominium-parking" class="fe-text-badge-fix mt--3"></div>
                        <!-- descrição -->
                        <span id="description-view-condominium-parking"></span>
                    </div>
                    <!-- data de criação e data da última atualização no sistema -->
                    <div class="col-lg-12">
                        <br>
                        <small class="float-left fe-view-fix-last-login-ip">&nbsp;</small>
                        <small id="created-at-view-condominium-parking" class="text-light float-right fe-font-size-11 fe-view-fix-created-at"></small>
                        <small id="updated-at-view-condominium-parking" class="text-light float-right fe-font-size-11 fe-view-fix-updated-at"></small>
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
