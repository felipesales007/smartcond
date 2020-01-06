<div id="modal-recover-condominium-apartment" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-recover-condominium-apartment-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- título -->
            <div class="modal-header">
                <h5 id="modal-recover-condominium-apartment-label" class="modal-title text-uppercase text-monospace ml-1">
                    <b>{{ __('Recuperar apartamento') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- form -->
                <form id="form-recover-condominium-apartment" role="form" autocomplete="off" novalidate>
                    @csrf
                    <!-- inputs -->
                    <div class="row">
                        <!-- id -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="id-recover-condominium-apartment">{{ __('ID') }}</label>
                                <div class="input-group input-group-merge validate-id-recover-condominium-apartment">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('id_recover_condominium_apartment') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('id do apartamento') }}">*</span>
                                    <input readonly type="number" id="id-recover-condominium-apartment" name="id_recover_condominium_apartment" class="form-control {{ $errors->has('id_recover_condominium_apartment') ? 'is-invalid' : '' }}" placeholder="{{ __('ID do apartamento') }}" value="{{ old('id_recover_condominium_apartment') }}" maxlength="20" required onkeypress="return onlyNumbers(event);" @if ($errors->has('id_recover_condominium_apartment')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('id_recover_condominium_apartment'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('id_recover_condominium_apartment') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- nome -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="name-recover-condominium-apartment">{{ __('Nome') }}</label>
                                <div class="input-group input-group-merge validate-name-recover-condominium-apartment">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('name_recover_condominium_apartment') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-building"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('nome ou número do apartamento') }}">*</span>
                                    <input readonly type="text" id="name-recover-condominium-apartment" name="name_recover_condominium_apartment" class="form-control {{ $errors->has('name_recover_condominium_apartment') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome ou número do apartamento') }}" value="{{ old('name_recover_condominium_apartment') }}" maxlength="191" required onkeypress="return onlyLettersNumbers(event);" onkeyup="letterUppercase('name-recover-condominium-apartment');" @if ($errors->has('name_recover_condominium_apartment')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_recover_condominium_apartment'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_recover_condominium_apartment') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- confirmação do nome -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="name-confirmation-recover-condominium-apartment">{{ __('Digite ') }}<b id="name-confirmation-recover-condominium-apartment-text" class="text-success fe-apartment-copy" onmousedown="return false;"></b>{{ __(' para confirmar a recuperação') }}</label>
                                <div class="input-group input-group-merge validate-name-confirmation-recover-condominium-apartment">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('name_confirmation_recover_condominium_apartment') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-building"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('digite o nome ou número do apartamento que está em verde e confirme, clicando em recuperar apartamento') }}">*</span>
                                    <input type="text" id="name-confirmation-recover-condominium-apartment" name="name_confirmation_recover_condominium_apartment" class="form-control fe-apartment-paste {{ $errors->has('name_confirmation_recover_condominium_apartment') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome ou número para recuperação') }}" value="{{ old('name_confirmation_recover_condominium_apartment') }}" maxlength="191" required onkeypress="return onlyLettersNumbers(event);" onkeyup="letterUppercase('name-confirmation-recover-condominium-apartment');" ondrop="return false;" @if ($errors->has('name_confirmation_recover_condominium_apartment')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_confirmation_recover_condominium_apartment'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_confirmation_recover_condominium_apartment') }}</div>
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
                        <button type="submit" id="btn-recover-condominium-apartment" class="btn btn-outline-success mr-4">{{ __('Recuperar apartamento') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
