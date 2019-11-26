<div id="modal-delete-inventory" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-delete-inventory-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- título -->
            <div class="modal-header">
                <h5 id="modal-delete-inventory-label" class="modal-title text-uppercase text-monospace ml-1">
                    <b>{{ __('Excluir item do inventário') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- form -->
                <form id="form-delete-inventory" role="form" autocomplete="off" novalidate>
                    @csrf
                    <!-- inputs -->
                    <div class="row">
                        <!-- id -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="id-delete-inventory">{{ __('ID') }}</label>
                                <div class="input-group input-group-merge validate-id-delete-inventory">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('id_delete_inventory') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('id do item do inventário') }}">*</span>
                                    <input readonly type="number" id="id-delete-inventory" name="id_delete_inventory" class="form-control {{ $errors->has('id_delete_inventory') ? 'is-invalid' : '' }}" placeholder="{{ __('ID do item do inventário') }}" value="{{ old('id_delete_inventory') }}" maxlength="20" required onkeypress="return onlyNumbers(event);" @if ($errors->has('id_delete_inventory')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('id_delete_inventory'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('id_delete_inventory') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- nome -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="name-delete-inventory">{{ __('Nome') }}</label>
                                <div class="input-group input-group-merge validate-name-delete-inventory">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('name_delete_inventory') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-hotel"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('nome do item do inventário') }}">*</span>
                                    <input readonly type="text" id="name-delete-inventory" name="name_delete_inventory" class="form-control {{ $errors->has('name_delete_inventory') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome do item do inventário') }}" value="{{ old('name_delete_inventory') }}" minlength="3" maxlength="191" required onkeypress="return onlyLettersCharacters(event);" onkeyup="letterUppercase('name-delete-inventory');" @if ($errors->has('name_delete_inventory')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_delete_inventory'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_delete_inventory') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- confirmação do nome -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="name-confirmation-delete-inventory">{{ __('Digite ') }}<b id="name-confirmation-delete-inventory-text" class="text-danger fe-block-copy" onmousedown="return false;"></b>{{ __(' para confirmar a exclusão') }}</label>
                                <div class="input-group input-group-merge validate-name-confirmation-delete-inventory">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('name_confirmation_delete_inventory') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-hotel"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('digite o nome do item do inventário que está em vermelho e confirme, clicando em excluir item do inventário') }}">*</span>
                                    <input type="text" id="name-confirmation-delete-inventory" name="name_confirmation_delete_inventory" class="form-control fe-block-paste {{ $errors->has('name_confirmation_delete_inventory') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome para exclusão') }}" value="{{ old('name_confirmation_delete_inventory') }}" minlength="3" maxlength="191" required onkeypress="return onlyLettersCharacters(event);" onkeyup="letterUppercase('name-confirmation-delete-inventory');" ondrop="return false;" @if ($errors->has('name_confirmation_delete_inventory')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_confirmation_delete_inventory'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_confirmation_delete_inventory') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- informações -->
                    <div class="fe-mouse-off">
                        <div class="text-right">
                            <small class="fe-text-star">{{ __('*') }}</small>
                            <small class="text-light">{{ __('campo obrigatório') }}</small>
                        </div>
                        <br>
                        <div class="mt--1">
                            <small class="text-light">{{ __('pense bem antes de excluir, itens do inventário excluídos não são recuperados') }}</small>
                        </div>
                    </div>
                    <!-- botões -->
                    <div class="text-right float-right fe-form-footer">
                        <a href="javascript:void(0)" class="mr-4" data-dismiss="modal">{{ __('Cancelar') }}</a>
                        <button type="submit" id="btn-delete-inventory" class="btn btn-outline-danger mr-4">{{ __('Excluir item') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
