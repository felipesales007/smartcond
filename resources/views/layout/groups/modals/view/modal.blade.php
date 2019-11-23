<div id="modal-view-group" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-view-group-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content bg-dark">
            <!-- título e capa -->
            <div class="modal-header">
                <h5 id="modal-view-group-label" class="modal-title text-uppercase text-monospace text-white ml-1">
                    <b>{{ __('Visualizar grupo') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- dados -->
                <div class="row fe-mouse opacity-7">
                    <div class="col-lg-12">
                        <!-- status -->
                        <small id="status-view-group" class="float-right mt--4 d-none"></small>
                        <!-- nome -->
                        <div id="name-view-group" class="text-yellow mt-3"></div>
                        <!-- nível -->
                        <div id="user-level-view-group" class="text-success mt--4 mr-3 position-absolute right-0"></div>
                        <!-- descrição -->
                        <span id="description-view-group"></span>
                    </div>
                    <!-- data de criação e data da última atualização no sistema -->
                    <div class="col-lg-12">
                        <br>
                        <small class="float-left fe-view-fix-last-login-ip">&nbsp;</small>
                        <small id="created-at-view-group" class="text-light float-right fe-font-size-11 fe-view-fix-created-at"></small>
                        <small id="updated-at-view-group" class="text-light float-right fe-font-size-11 fe-view-fix-updated-at"></small>
                    </div>
                </div>
                <!-- fechar -->
                <div class="text-right float-right fe-form-footer fe-line-footer-white">
                    <a href="javascript:void(0)" class="mr-4 text-white" data-dismiss="modal">{{ __('Fechar') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
