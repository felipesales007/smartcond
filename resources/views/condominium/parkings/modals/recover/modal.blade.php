<div id="modal-recover-condominium-parking" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-recover-condominium-parking-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <!-- título -->
            <div class="modal-header">
                <h5 id="modal-recover-condominium-parking-label" class="modal-title text-uppercase text-monospace ml-1">
                    <b>{{ __('Recuperar estacionamento') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- form -->
                <form id="form-recover-condominium-parking" role="form" autocomplete="off" novalidate>
                    @csrf
                    <!-- inputs -->
                    <div class="row">
                        <!-- id -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="id-recover-condominium-parking">{{ __('ID') }}</label>
                                <div class="input-group input-group-merge validate-id-recover-condominium-parking">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('id_recover_condominium_parking') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('id do estacionamento') }}">*</span>
                                    <input readonly type="number" id="id-recover-condominium-parking" name="id_recover_condominium_parking" class="form-control {{ $errors->has('id_recover_condominium_parking') ? 'is-invalid' : '' }}" placeholder="{{ __('ID do estacionamento') }}" value="{{ old('id_recover_condominium_parking') }}" maxlength="20" required onkeypress="return onlyNumbers(event);" @if ($errors->has('id_recover_condominium_parking')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('id_recover_condominium_parking'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('id_recover_condominium_parking') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- nome -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="name-recover-condominium-parking">{{ __('Nome') }}</label>
                                <div class="input-group input-group-merge validate-name-recover-condominium-parking">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('name_recover_condominium_parking') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-car"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('nome ou número do estacionamento') }}">*</span>
                                    <input readonly type="text" id="name-recover-condominium-parking" name="name_recover_condominium_parking" class="form-control {{ $errors->has('name_recover_condominium_parking') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome ou número do estacionamento') }}" value="{{ old('name_recover_condominium_parking') }}" maxlength="191" required onkeypress="return onlyLettersNumbers(event);" onkeyup="letterUppercase('name-recover-condominium-parking');" @if ($errors->has('name_recover_condominium_parking')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_recover_condominium_parking'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_recover_condominium_parking') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- confirmação do nome -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="name-confirmation-recover-condominium-parking">{{ __('Digite ') }}<b id="name-confirmation-recover-condominium-parking-text" class="text-success fe-block-copy" onmousedown="return false;"></b>{{ __(' para confirmar a recuperação') }}</label>
                                <div class="input-group input-group-merge validate-name-confirmation-recover-condominium-parking">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('name_confirmation_recover_condominium_parking') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-car"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('digite o nome ou número do estacionamento que está em verde e confirme, clicando em recuperar estacionamento') }}">*</span>
                                    <input type="text" id="name-confirmation-recover-condominium-parking" name="name_confirmation_recover_condominium_parking" class="form-control fe-block-paste {{ $errors->has('name_confirmation_recover_condominium_parking') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome ou número para recuperação') }}" value="{{ old('name_confirmation_recover_condominium_parking') }}" maxlength="191" required onkeypress="return onlyLettersNumbers(event);" onkeyup="letterUppercase('name-confirmation-recover-condominium-parking');" ondrop="return false;" @if ($errors->has('name_confirmation_recover_condominium_parking')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_confirmation_recover_condominium_parking'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_confirmation_recover_condominium_parking') }}</div>
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
                        <button type="submit" id="btn-recover-condominium-parking" class="btn btn-outline-success mr-4">{{ __('Recuperar estacionamento') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
