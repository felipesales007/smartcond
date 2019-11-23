<div id="modal-password-reset-profile" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-password-reset-profile-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-secondary">
            <!-- título -->
            <div class="modal-header bg-white border-0">
                <h5 id="modal-password-reset-profile-label" class="modal-title text-uppercase text-monospace ml-1 mt-1">
                    <b>{{ __('Alterar senha') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- form -->
                <form id="form-password-reset-profile" role="form" autocomplete="off" novalidate>
                    @csrf
                    <!-- inputs -->
                    <div class="row">
                        <!-- senha atual -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="old-password-reset-profile">{{ __('Senha atual') }}</label>
                                <div class="input-group input-group-merge validate-old-password-reset-profile">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('old_password_reset_profile') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 8 caracteres') }}">*</span>
                                    <input type="password" id="old-password-reset-profile" name="old_password_reset_profile" class="form-control {{ $errors->has('old_password_reset_profile') ? 'is-invalid' : '' }}" placeholder="{{ __('Senha atual') }}" minlength="8" maxlength="191" required autocomplete="old-password-reset-profile" @if ($errors->has('old_password_reset_profile')) autofocus @endif>
                                    <!-- visualizar ou ocultar senha -->
                                    <div class="input-group-append" onclick="viewPassword(this);">
                                        <span class="input-group-text {{ $errors->has('old_password_reset_profile') ? 'is-invalid' : '' }}">
                                            <i class="fe-input-icon far fa-eye"></i>
                                        </span>
                                    </div>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('old_password_reset_profile'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('old_password_reset_profile') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- nova senha -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="password-reset-profile">{{ __('Nova senha') }}</label>
                                <div class="input-group input-group-merge validate-password-reset-profile">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('password_reset_profile') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 8 caracteres') }}">*</span>
                                    <input type="password" id="password-reset-profile" name="password_reset_profile" class="form-control {{ $errors->has('password_reset_profile') ? 'is-invalid' : '' }}" placeholder="{{ __('Nova senha') }}" minlength="8" maxlength="191" required autocomplete="password-reset-profile" @if ($errors->has('password_reset_profile')) autofocus @endif>
                                    <!-- visualizar ou ocultar senha -->
                                    <div class="input-group-append" onclick="viewPassword(this);">
                                        <span class="input-group-text {{ $errors->has('password_reset_profile') ? 'is-invalid' : '' }}">
                                            <i class="fe-input-icon far fa-eye"></i>
                                        </span>
                                    </div>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('password_reset_profile'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('password_reset_profile') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- confirmação de senha -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="password-confirmation-reset-profile">{{ __('Confirme a nova senha') }}</label>
                                <div class="input-group input-group-merge validate-password-confirmation-reset-profile">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('password_confirmation_reset_profile') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('repetir a nova senha') }}">*</span>
                                    <input type="password" id="password-confirmation-reset-profile" name="password_confirmation_reset_profile" class="form-control {{ $errors->has('password_confirmation_reset_profile') ? 'is-invalid' : '' }}" placeholder="{{ __('Confirme a senha') }}" minlength="8" maxlength="191" required autocomplete="password-confirmation-reset-profile">
                                    <!-- visualizar ou ocultar senha -->
                                    <div class="input-group-append" onclick="viewPassword(this);">
                                        <span class="input-group-text {{ $errors->has('password_confirmation_reset_profile') ? 'is-invalid' : '' }}">
                                            <i class="fe-input-icon far fa-eye"></i>
                                        </span>
                                    </div>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('password_confirmation_reset_profile'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('password_confirmation_reset_profile') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- informação -->
                    <div class="fe-mouse">
                        <div class="text-right">
                            <small class="fe-text-star">{{ __('*') }}</small>
                            <small class="text-light">{{ __('campos obrigatórios') }}</small>
                        </div>
                    </div>
                    <!-- botões -->
                    <div class="text-right float-right fe-form-footer">
                        <a href="javascript:void(0)" class="mr-4" data-dismiss="modal">{{ __('Cancelar') }}</a>
                        <button type="submit" id="btn-password-reset-profile" class="btn btn-outline-success mr-4">{{ __('Alterar senha') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
