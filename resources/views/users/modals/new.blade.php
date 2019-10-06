<div id="modal-new-user" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-new-user-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- título -->
            <div class="modal-header">
                <h5 id="modal-new-user-label" class="modal-title text-uppercase text-monospace ml-1">
                    <b>{{ __('Novo usuário') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- form -->
                <form id="form-new-user" role="form" autocomplete="off" novalidate>
                    @csrf
                    <!-- inputs -->
                    <div class="row">
                        <!-- nome -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="name-new-user">{{ __('Nome') }}</label>
                                <div class="input-group input-group-merge validate-name-new-user">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('name_new_user') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-user"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                    <input type="text" id="name-new-user" name="name_new_user" class="form-control {{ $errors->has('name_new_user') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome completo') }}" value="{{ old('name_new_user') }}" minlength="3" maxlength="191" required onkeypress="return soLetras(event);" onkeyup="letraMaiuscula('name-new-user');" @if ($errors->has('name_new_user')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_new_user'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_new_user') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- e-mail -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="email-new-user">{{ __('E-mail') }}</label>
                                <div class="input-group input-group-merge validate-email-new-user">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('email_new_user') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('e-mail válido') }}">*</span>
                                    <input type="email" id="email-new-user" name="email_new_user" class="form-control {{ $errors->has('email_new_user') ? 'is-invalid' : '' }}" placeholder="{{ __('E-mail') }}" value="{{ old('email_new_user') }}" maxlength="191" required @if ($errors->has('email_new_user')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('email_new_user'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('email_new_user') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- empresa -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="company-id-new-user">{{ __('Empresa') }}</label>
                                <div class="input-group-none validate-company-id-new-user">
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('selecione a empresa') }}">*</span>
                                    {{ Form::select(
                                        "name",
                                        \App\Models\Company\Company::getCompaniesOptions(),
                                        old("company_id_new_user"),
                                        ["id" => "company-id-new-user", "name" => "company_id_new_user[]", "class" => "form-control", "required", "multiple"]
                                    )}}
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('company_id_new_user'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('company_id_new_user') }}</div>
                                @endif
                            </div>
                        </div>
                        {{--
                        <!-- senha -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="password-new-user">{{ __('Senha') }}</label>
                                <div class="input-group input-group-merge validate-password-new-user">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('password_new_user') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 8 caracteres') }}">*</span>
                                    <input type="password" id="password-new-user" name="password_new_user" class="form-control {{ $errors->has('password_new_user') ? 'is-invalid' : '' }}" placeholder="{{ __('Senha') }}" minlength="8" maxlength="191" required autocomplete="password-new-user" @if ($errors->has('password_new_user')) autofocus @endif>
                                    <!-- visualizar ou ocultar senha -->
                                    <div class="input-group-append" onclick="verSenha(this);">
                                        <span class="input-group-text">
                                            <i class="fe-input-icone far fa-eye"></i>
                                        </span>
                                    </div>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('password_new_user'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('password_new_user') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- confirmação de senha -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="password-confirmation-new-user">{{ __('Confirme a senha') }}</label>
                                <div class="input-group input-group-merge validate-password-confirmation-new-user">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('password_confirmation_new_user') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('repetir a senha') }}">*</span>
                                    <input type="password" id="password-confirmation-new-user" name="password_confirmation_new_user" class="form-control {{ $errors->has('password_confirmation_new_user') ? 'is-invalid' : '' }}" placeholder="{{ __('Confirme a senha') }}" minlength="8" maxlength="191" required autocomplete="password-confirmation-new-user">
                                    <!-- visualizar ou ocultar senha -->
                                    <div class="input-group-append" onclick="verSenha(this);">
                                        <span class="input-group-text">
                                            <i class="fe-input-icone far fa-eye"></i>
                                        </span>
                                    </div>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('password_confirmation_new_user'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('password_confirmation_new_user') }}</div>
                                @endif
                            </div>
                        </div>
                        --}}
                    </div>
                    <!-- informações -->
                    <div class="fe-mouse-off">
                        <div class="text-right">
                            <small class="fe-text-star">{{ __('*') }}</small>
                            <small class="text-light">{{ __('campos obrigatórios') }}</small>
                        </div>
                        <br>
                        <div class="mt--1">
                            <small class="text-light">{{ __('ao criar um novo usuário, o usuário criado irá receber uma notificação de e-mail para confirmação e definição da senha') }}</small>
                        </div>
                    </div>
                    <!-- botões -->
                    <div class="text-right float-right fe-form-footer">
                        <a href="javascript:void(0)" class="mr-4" data-dismiss="modal">{{ __('Cancelar') }}</a>
                        @if (app('router')->has('user.store') && \App\Models\Permission::routePermission('user.store'))
                            <button type="submit" id="btn-new-user" class="btn btn-outline-success mr-4">{{ __('Criar usuário') }}</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
