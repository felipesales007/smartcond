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
                    <div class="col-lg-12">
                        <!-- status, imagem e nome do item -->
                        <div class="mb--2">
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
                        <div class="mt-1">
                            <!-- departamento -->
                            <small id="department-view-inventory" class="float-right fe-view-fix-department"></small>
                            <!-- categoria -->
                            <small id="category-view-inventory" class="float-right fe-view-fix-category"></small>
                        </div>
                        <br>
                        <div class="small">
                            <!-- patrimônio -->
                            <i id="icon-patrimonial-number-view-inventory" class="fas fa-barcode mt-3 mr-1 fe-hidden"></i>
                            <span id="patrimonial-number-view-inventory"></span>
                            <hr class="my-3">

                            <!-- informações -->
                            <table>
                                <tr>
                                    <td id="voltage-view-inventory" class="pb-2"></td>
                                    <td id="state-view-inventory" class="position-absolute right-3"></td>
                                </tr>
                                <tr>
                                    <td id="brand-view-inventory" class="pb-2"></td>
                                    <td id="model-view-inventory" class="position-absolute right-3"></td>
                                </tr>
                                <tr>
                                    <td id="serial-number-view-inventory" class="pb-2"></td>
                                    <td id="invoice-view-inventory" class="position-absolute right-3"></td>
                                </tr>
                                <tr>
                                    <td id="value-view-inventory" class="pb-2"></td>
                                    <td id="purchase-date-view-inventory" class="position-absolute right-3"></td>
                                </tr>
                                <tr>
                                    <td id="warranty-date-view-inventory"></td>
                                </tr>
                            </table>

                            <!-- descrição -->
                            <span id="text-description-view-inventory" class="h6 heading-small text-light d-none">
                                <br>
                                Descrição
                                <br>
                            </span>
                            <div id="description-view-inventory"></div>
                        </div>
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
