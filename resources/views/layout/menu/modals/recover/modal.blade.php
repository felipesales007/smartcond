<div id="modal-recover-menu" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-recover-menu-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- título -->
            <div class="modal-header">
                <h5 id="modal-recover-menu-label" class="modal-title text-uppercase text-monospace ml-1">
                    <b>{{ __('Recuperar menu') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- form -->
                <form id="form-recover-menu" role="form" autocomplete="off" novalidate>
                    @csrf
                    <!-- inputs -->
                    <div class="row">
                        <!-- id -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="id-recover-menu">{{ __('ID') }}</label>
                                <div class="input-group input-group-merge validate-id-recover-menu">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('id_recover_menu') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('id do menu') }}">*</span>
                                    <input readonly type="number" id="id-recover-menu" name="id_recover_menu" class="form-control {{ $errors->has('id_recover_menu') ? 'is-invalid' : '' }}" placeholder="{{ __('ID do menu') }}" value="{{ old('id_recover_menu') }}" maxlength="20" required onkeypress="return onlyNumbers(event);" @if ($errors->has('id_recover_menu')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('id_recover_menu'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('id_recover_menu') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- nome -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="name-recover-menu">{{ __('Nome') }}</label>
                                <div class="input-group input-group-merge validate-name-recover-menu">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('name_recover_menu') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-list-ul"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('nome do menu') }}">*</span>
                                    <input readonly type="text" id="name-recover-menu" name="name_recover_menu" class="form-control {{ $errors->has('name_recover_menu') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome do menu') }}" value="{{ old('name_recover_menu') }}" minlength="3" maxlength="191" required onkeypress="return onlyLetters(event);" onkeyup="firstLetterUppercase(this);" @if ($errors->has('name_recover_menu')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_recover_menu'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_recover_menu') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- confirmação do nome -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="name-confirmation-recover-menu">{{ __('Digite ') }}<b id="name-confirmation-recover-menu-text" class="text-success fe-block-copy" onmousedown="return false;"></b>{{ __(' para confirmar a recuperação') }}</label>
                                <div class="input-group input-group-merge validate-name-confirmation-recover-menu">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('name_confirmation_recover_menu') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-list-ul"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('digite o nome do menu que está em verde e confirme, clicando em recuperar menu') }}">*</span>
                                    <input type="text" id="name-confirmation-recover-menu" name="name_confirmation_recover_menu" class="form-control fe-block-paste {{ $errors->has('name_confirmation_recover_menu') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome para recuperação') }}" value="{{ old('name_confirmation_recover_menu') }}" minlength="3" maxlength="191" required onkeypress="return onlyLetters(event);" onkeyup="firstLetterUppercase(this);" ondrop="return false;" @if ($errors->has('name_confirmation_recover_menu')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_confirmation_recover_menu'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_confirmation_recover_menu') }}</div>
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
                        <button type="submit" id="btn-recover-menu" class="btn btn-outline-success mr-4">{{ __('Recuperar menu') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
