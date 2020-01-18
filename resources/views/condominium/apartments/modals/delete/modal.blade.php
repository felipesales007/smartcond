<div id="modal-delete-condominium-apartment" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-delete-condominium-apartment-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- título -->
            <div class="modal-header">
                <h5 id="modal-delete-condominium-apartment-label" class="modal-title text-uppercase text-monospace ml-1">
                    <b>{{ __('Excluir apartamento') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- form -->
                <form id="form-delete-condominium-apartment" role="form" autocomplete="off" novalidate>
                    @csrf
                    <!-- inputs -->
                    <div class="row">
                        <!-- id -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="id-delete-condominium-apartment">{{ __('ID') }}</label>
                                <div class="input-group input-group-merge validate-id-delete-condominium-apartment">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('id_delete_condominium_apartment') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('id do apartamento') }}">*</span>
                                    <input readonly type="number" id="id-delete-condominium-apartment" name="id_delete_condominium_apartment" class="form-control {{ $errors->has('id_delete_condominium_apartment') ? 'is-invalid' : '' }}" placeholder="{{ __('ID do apartamento') }}" value="{{ old('id_delete_condominium_apartment') }}" maxlength="20" required onkeypress="return onlyNumbers(event);" @if ($errors->has('id_delete_condominium_apartment')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('id_delete_condominium_apartment'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('id_delete_condominium_apartment') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- nome -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="name-delete-condominium-apartment">{{ __('Nome') }}</label>
                                <div class="input-group input-group-merge validate-name-delete-condominium-apartment">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('name_delete_condominium_apartment') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-building"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('nome ou número do apartamento') }}">*</span>
                                    <input readonly type="text" id="name-delete-condominium-apartment" name="name_delete_condominium_apartment" class="form-control {{ $errors->has('name_delete_condominium_apartment') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome ou número do apartamento') }}" value="{{ old('name_delete_condominium_apartment') }}" maxlength="191" required onkeypress="return onlyLettersNumbers(event);" onkeyup="letterUppercase('name-delete-condominium-apartment');" @if ($errors->has('name_delete_condominium_apartment')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_delete_condominium_apartment'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_delete_condominium_apartment') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- confirmação do nome -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="name-confirmation-delete-condominium-apartment">{{ __('Digite ') }}<b id="name-confirmation-delete-condominium-apartment-text" class="text-danger fe-block-copy" onmousedown="return false;"></b>{{ __(' para confirmar a exclusão') }}</label>
                                <div class="input-group input-group-merge validate-name-confirmation-delete-condominium-apartment">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('name_confirmation_delete_condominium_apartment') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-building"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('digite o nome ou número do apartamento que está em vermelho e confirme, clicando em excluir apartamento') }}">*</span>
                                    <input type="text" id="name-confirmation-delete-condominium-apartment" name="name_confirmation_delete_condominium_apartment" class="form-control fe-block-paste {{ $errors->has('name_confirmation_delete_condominium_apartment') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome ou número para exclusão') }}" value="{{ old('name_confirmation_delete_condominium_apartment') }}" maxlength="191" required onkeypress="return onlyLettersNumbers(event);" onkeyup="letterUppercase('name-confirmation-delete-condominium-apartment');" ondrop="return false;" @if ($errors->has('name_confirmation_delete_condominium_apartment')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_confirmation_delete_condominium_apartment'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_confirmation_delete_condominium_apartment') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- informações -->
                    <div class="fe-mouse">
                        <div class="text-right">
                            <small class="fe-text-star">{{ __('*') }}</small>
                            <small class="text-light">{{ __('campo obrigatório') }}</small>
                        </div>
                        <br>
                        <div class="mt--1">
                            <small class="text-light">{{ __('pense bem antes de excluir, apartamentos excluídos não são recuperados') }}</small>
                        </div>
                    </div>
                    <!-- botões -->
                    <div class="text-right float-right fe-form-footer">
                        <a href="javascript:void(0)" class="mr-4" data-dismiss="modal">{{ __('Cancelar') }}</a>
                        <button type="submit" id="btn-delete-condominium-apartment" class="btn btn-outline-danger mr-4">{{ __('Excluir apartamento') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
