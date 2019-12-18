<div id="modal-recover-inventory-category" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-recover-inventory-category-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- título -->
            <div class="modal-header">
                <h5 id="modal-recover-inventory-category-label" class="modal-title text-uppercase text-monospace ml-1">
                    <b>{{ __('Recuperar categoria') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- form -->
                <form id="form-recover-inventory-category" role="form" autocomplete="off" novalidate>
                    @csrf
                    <!-- inputs -->
                    <div class="row">
                        <!-- id -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="id-recover-inventory-category">{{ __('ID') }}</label>
                                <div class="input-group input-group-merge validate-id-recover-inventory-category">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('id_recover_inventory_category') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('id da categoria') }}">*</span>
                                    <input readonly type="number" id="id-recover-inventory-category" name="id_recover_inventory_category" class="form-control {{ $errors->has('id_recover_inventory_category') ? 'is-invalid' : '' }}" placeholder="{{ __('ID da categoria') }}" value="{{ old('id_recover_inventory_category') }}" maxlength="20" required onkeypress="return onlyNumbers(event);" @if ($errors->has('id_recover_inventory_category')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('id_recover_inventory_category'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('id_recover_inventory_category') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- nome -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="name-recover-inventory-category">{{ __('Nome') }}</label>
                                <div class="input-group input-group-merge validate-name-recover-inventory-category">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('name_recover_inventory_category') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-hotel"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('nome da categoria') }}">*</span>
                                    <input readonly type="text" id="name-recover-inventory-category" name="name_recover_inventory_category" class="form-control {{ $errors->has('name_recover_inventory_category') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome da categoria') }}" value="{{ old('name_recover_inventory_category') }}" minlength="3" maxlength="191" required onkeypress="return onlyLettersCharacters(event);" onkeyup="letterUppercase('name-recover-inventory-category');" @if ($errors->has('name_recover_inventory_category')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_recover_inventory_category'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_recover_inventory_category') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- confirmação do nome -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="name-confirmation-recover-inventory-category">{{ __('Digite ') }}<b id="name-confirmation-recover-inventory-category-text" class="text-success fe-block-copy" onmousedown="return false;"></b>{{ __(' para confirmar a recuperação') }}</label>
                                <div class="input-group input-group-merge validate-name-confirmation-recover-inventory-category">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('name_confirmation_recover_inventory_category') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-hotel"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('digite o nome da categoria que está em verde e confirme, clicando em recuperar categoria') }}">*</span>
                                    <input type="text" id="name-confirmation-recover-inventory-category" name="name_confirmation_recover_inventory_category" class="form-control fe-block-paste {{ $errors->has('name_confirmation_recover_inventory_category') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome para recuperação') }}" value="{{ old('name_confirmation_recover_inventory_category') }}" minlength="3" maxlength="191" required onkeypress="return onlyLettersCharacters(event);" onkeyup="letterUppercase('name-confirmation-recover-inventory-category');" ondrop="return false;" @if ($errors->has('name_confirmation_recover_inventory_category')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_confirmation_recover_inventory_category'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_confirmation_recover_inventory_category') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- informação -->
                    <div class="fe-mouse">
                        <div class="text-right">
                            <small class="fe-text-star">{{ __('*') }}</small>
                            <small class="text-light">{{ __('campo obrigatório') }}</small>
                        </div>
                    </div>
                    <!-- botões -->
                    <div class="text-right float-right fe-form-footer">
                        <a href="javascript:void(0)" class="mr-4" data-dismiss="modal">{{ __('Cancelar') }}</a>
                        <button type="submit" id="btn-recover-inventory-category" class="btn btn-outline-success mr-4">{{ __('Recuperar categoria') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
