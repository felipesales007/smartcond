<div id="modal-view-inventory" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-view-inventory-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- título e capa -->
            <div id="background-view-inventory" class="modal-header fe-img-center fe-bg-view">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- dados -->
                <div class="row fe-mouse-default">
                    <!-- status, imagem e nome do item -->
                    <div class="col-lg-12 mb--2">
                        <!-- status -->
                        <span id="status-view-inventory" class="badge badge-dot fe-view-fix-status-square d-none">
                            <i data-toggle="tooltip" data-placement="right"></i>
                        </span>
                        <!-- imagem -->
                        <div id="image-view-inventory" class="fe-img-center avatar-xl fe-avatar-border fe-radius-max mt--5-9"></div>
                        <!-- nome do item -->
                        <div id="name-view-inventory" class="font-weight-bold fe-view-fix-name"></div>
                    </div>
                    <!-- departamento e categoria -->
                    <div class="col-lg-12 mt-1">
                        <!-- departamento -->
                        <small id="department-view-inventory" class="float-right fe-view-fix-department"></small>
                        <!-- categoria -->
                        <small id="category-view-inventory" class="float-right fe-view-fix-category"></small>
                    </div>
                    <br>
                    <!-- patrimônio -->
                    <div class="col-lg-12">
                        <i id="icon-patrimonial-number-view-inventory" class="fas fa-barcode mt-3 mr-1 d-none"></i>
                        <small id="patrimonial-number-view-inventory"></small>
                    </div>
                    <!-- marca -->
                    <div class="col-lg-12">
                        <small id="brand-view-inventory"></small>
                    </div>
                    <!-- modelo -->
                    <div class="col-lg-12">
                        <small id="model-view-inventory"></small>
                    </div>
                    <!-- nº de série -->
                    <div class="col-lg-12">
                        <small id="serial-number-view-inventory"></small>
                    </div>
                    <!-- nº da nota fiscal -->
                    <div class="col-lg-12">
                        <small id="invoice-view-inventory"></small>
                    </div>
                    <!-- valor -->
                    <div class="col-lg-12">
                        <small id="value-view-inventory"></small>
                    </div>
                    <!-- estado de conservação -->
                    <div class="col-lg-12">
                        <small id="state-view-inventory"></small>
                    </div>
                    <!-- voltagem -->
                    <div class="col-lg-12">
                        <small id="voltage-view-inventory"></small>
                    </div>
                    <!-- data de comprado -->
                    <div class="col-lg-12">
                        <small id="purchase-date-view-inventory"></small>
                    </div>
                    <!-- data da garantia -->
                    <div class="col-lg-12">
                        <small id="warranty-date-view-inventory"></small>
                    </div>
                    <!-- descrição -->
                    <div class="col-lg-12">
                        <span id="text-description-view-inventory" class="h6 heading-small text-light d-none">
                            <br>
                            Descrição
                            <br>
                        </span>
                        <small id="description-view-inventory"></small>
                    </div>
                    <!-- data de criação e data da última atualização no sistema -->
                    <div class="col-lg-12">
                            <br>
                            <small class="float-left fe-view-fix-last-login-ip">&nbsp;</small>
                            <small id="created-at-view-inventory" class="text-light float-right fe-font-size-11 fe-view-fix-created-at"></small>
                            <small id="updated-at-view-inventory" class="text-light float-right fe-font-size-11 fe-view-fix-updated-at"></small>
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
