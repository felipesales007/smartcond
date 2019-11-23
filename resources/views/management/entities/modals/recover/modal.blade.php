<div id="modal-recover-entity" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-recover-entity-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- título -->
            <div class="modal-header">
                <h5 id="modal-recover-entity-label" class="modal-title text-uppercase text-monospace ml-1">
                    <b>{{ __('Recuperar entidade') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- form -->
                <form id="form-recover-entity" role="form" autocomplete="off" novalidate>
                    @csrf
                    <!-- inputs -->
                    <div class="row">
                        <!-- id -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="id-recover-entity">{{ __('ID') }}</label>
                                <div class="input-group input-group-merge validate-id-recover-entity">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('id_recover_entity') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('id da entidade') }}">*</span>
                                    <input readonly type="number" id="id-recover-entity" name="id_recover_entity" class="form-control {{ $errors->has('id_recover_entity') ? 'is-invalid' : '' }}" placeholder="{{ __('ID da entidade') }}" value="{{ old('id_recover_entity') }}" maxlength="20" required onkeypress="return onlyNumbers(event);" @if ($errors->has('id_recover_entity')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('id_recover_entity'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('id_recover_entity') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- nome -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="name-recover-entity">{{ __('Nome') }}</label>
                                <div class="input-group input-group-merge validate-name-recover-entity">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('name_recover_entity') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-hotel"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('nome da entidade') }}">*</span>
                                    <input readonly type="text" id="name-recover-entity" name="name_recover_entity" class="form-control {{ $errors->has('name_recover_entity') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome da entidade') }}" value="{{ old('name_recover_entity') }}" minlength="3" maxlength="191" required onkeypress="return onlyLettersCharacters(event);" onkeyup="letterUppercase('name-recover-entity');" @if ($errors->has('name_recover_entity')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_recover_entity'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_recover_entity') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- confirmação do nome -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="name-confirmation-recover-entity">{{ __('Digite ') }}<b id="name-confirmation-recover-entity-text" class="text-success fe-block-copy" onmousedown="return false;"></b>{{ __(' para confirmar a recuperação') }}</label>
                                <div class="input-group input-group-merge validate-name-confirmation-recover-entity">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('name_confirmation_recover_entity') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-hotel"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('digite o nome da entidade que está em verde e confirme, clicando em recuperar entidade') }}">*</span>
                                    <input type="text" id="name-confirmation-recover-entity" name="name_confirmation_recover_entity" class="form-control fe-block-paste {{ $errors->has('name_confirmation_recover_entity') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome para recuperação') }}" value="{{ old('name_confirmation_recover_entity') }}" minlength="3" maxlength="191" required onkeypress="return onlyLettersCharacters(event);" onkeyup="letterUppercase('name-confirmation-recover-entity');" ondrop="return false;" @if ($errors->has('name_confirmation_recover_entity')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_confirmation_recover_entity'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_confirmation_recover_entity') }}</div>
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
                        <button type="submit" id="btn-recover-entity" class="btn btn-outline-success mr-4">{{ __('Recuperar entidade') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
