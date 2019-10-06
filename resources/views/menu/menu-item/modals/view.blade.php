<div id="modal-view-menu-item" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-view-menu-item-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <!-- título e capa -->
            <div class="modal-header">
                <h5 id="modal-view-menu-item-label" class="modal-title text-uppercase text-monospace ml-1">
                    <b>{{ __('Visualizar item do menu') }}</b>
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
                            <!-- link de acesso e copiar -->
                            <div id="view-view-item-menu" class="d-inline-flex opacity-6">
                                <a id="link-view-tem-menu" class="mt--1 mr-3" target="_blank" data-toggle="tooltip" data-placement="top" title="clique para acessar"><i class="fas fa-share fe-body-color"></i></a>
                                <i onclick="copyToClipboard('#copy-url-view-menu-item'); animateItem(this, 'faa-burst');" class="far fa-copy fe-pointer" data-toggle="tooltip" data-placement="top" title="clique para copiar o link"></i>
                            </div>
                            <!-- status -->
                            <small id="status-view-menu-item" class="float-right d-none"></small>
                        </div>
                        <!-- copia -->
                        <label hidden for="copy-url-view-menu-item"></label>
                        <textarea hidden id="copy-url-view-menu-item" class="form-control" rows="4" resize="none"></textarea>
                        <!-- nome -->
                        <span id="name-view-menu-item"></span>
                        <!-- grupo -->
                        <div id="group-view-menu-item" class="float-right mt-5"></div>
                        <!-- menu -->
                        <div id="menu-view-menu-item" class="mt-4"></div>
                        <!-- oculto -->
                        <div id="hidden-view-menu-item" class="float-right mt-1"></div>
                        <!-- lista -->
                        <div id="list-view-menu-item" class="mt-1"></div>
                        <!-- ordem -->
                        <div id="order-view-menu-item" class="float-right mt-1"></div>
                        <!-- rota -->
                        <div id="route-view-menu-item" class="mt-1"></div>
                        <!-- botão -->
                        <div id="button-view-menu-item" class="mt-1 mb--4"></div>
                        <!-- descrição -->
                        <span id="description-view-menu-item"></span>
                    </div>
                    <!-- data de criação e data da última atualização no sistema -->
                    <div class="col-lg-12">
                        <br>
                        <small class="float-left fe-view-fix-last-login-ip">&nbsp;</small>
                        <small id="created-at-view-menu-item" class="text-light float-right fe-font-size-11 fe-view-fix-created-at"></small>
                        <small id="updated-at-view-menu-item" class="text-light float-right fe-font-size-11 fe-view-fix-updated-at"></small>
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
