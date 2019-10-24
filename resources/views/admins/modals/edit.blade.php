<div id="modal-edit-admin" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-edit-admin-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- título -->
            <div class="modal-header">
                <h5 id="modal-edit-admin-label" class="modal-title text-uppercase text-monospace ml-1">
                    <b>{{ __('Editar administrador') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- form -->
                <form id="form-edit-admin" role="form" autocomplete="off" novalidate>
                    @csrf
                    <!-- inputs -->
                    <div class="row">
                        <!-- id -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="id-edit-admin">{{ __('ID') }}</label>
                                <div class="input-group input-group-merge validate-id-edit-admin">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('id_edit_admin') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('id do administrador') }}">*</span>
                                    <input readonly type="number" id="id-edit-admin" name="id_edit_admin" class="form-control {{ $errors->has('id_edit_admin') ? 'is-invalid' : '' }}" placeholder="{{ __('ID do administrador') }}" value="{{ old('id_edit_admin') }}" maxlength="20" required onkeypress="return soNumeros(event);" @if ($errors->has('id_edit_admin')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('id_edit_admin'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('id_edit_admin') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- nome -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="name-edit-admin">{{ __('Nome') }}</label>
                                <div class="input-group input-group-merge validate-name-edit-admin">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('name_edit_admin') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-user"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                    <input type="text" id="name-edit-admin" name="name_edit_admin" class="form-control {{ $errors->has('name_edit_admin') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome completo') }}" value="{{ old('name_edit_admin') }}" minlength="3" maxlength="191" required onkeypress="return soLetras(event);" onkeyup="letraMaiuscula('name-edit-admin');" @if ($errors->has('name_edit_admin')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_edit_admin'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_edit_admin') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- e-mail -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="email-edit-admin">{{ __('E-mail') }}</label>
                                <div class="input-group input-group-merge validate-email-edit-admin">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('email_edit_admin') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('e-mail válido') }}">*</span>
                                    <input type="email" id="email-edit-admin" name="email_edit_admin" class="form-control {{ $errors->has('email_edit_admin') ? 'is-invalid' : '' }}" placeholder="{{ __('E-mail') }}" value="{{ old('email_edit_admin') }}" maxlength="191" required @if ($errors->has('email_edit_admin')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('email_edit_admin'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('email_edit_admin') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- empresa -->
                        @if (\App\Models\Company\Company::id() == 1)
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="company-id-edit-admin">{{ __('Empresa') }}</label>
                                    <div class="input-group-none validate-company-id-edit-admin">
                                        <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('selecione a empresa') }}">*</span>
                                        {{ Form::select(
                                            "name",
                                            \App\Models\Company\Company::getCompaniesOptions(),
                                            old("company_id_edit_admin"),
                                            ["id" => "company-id-edit-admin", "name" => "company_id_edit_admin", "class" => "form-control select-nosearch", "placeholder" => "Selecione", "required"]
                                        )}}
                                    </div>
                                    <!-- alerta de erro -->
                                    @if ($errors->has('company_id_edit_admin'))
                                        <div class="invalid-feedback" role="alert">{{ $errors->first('company_id_edit_admin') }}</div>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div hidden class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="company-id-edit-admin">{{ __('Empresa') }}</label>
                                    <div class="input-group-none validate-company-id-edit-admin">
                                        <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('selecione a empresa') }}">*</span>
                                        {{ Form::select(
                                            "name",
                                            \App\Models\Company\Company::getCompaniesOptions(),
                                            \App\Models\Company\Company::id(),
                                            ["id" => "company-id-edit-admin", "name" => "company_id_edit_admin", "class" => "form-control select-nosearch", "placeholder" => "Selecione", "required"]
                                        )}}
                                    </div>
                                    <!-- alerta de erro -->
                                    @if ($errors->has('company_id_edit_admin'))
                                        <div class="invalid-feedback" role="alert">{{ $errors->first('company_id_edit_admin') }}</div>
                                    @endif
                                </div>
                            </div>
                        @endif
                        <!-- senha -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="password-edit-admin">{{ __('Senha') }}</label>
                                <div class="input-group input-group-merge validate-password-edit-admin">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('password_edit_admin') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 8 caracteres') }}">*</span>
                                    <input type="password" id="password-edit-admin" name="password_edit_admin" class="form-control {{ $errors->has('password_edit_admin') ? 'is-invalid' : '' }}" placeholder="{{ __('Senha') }}" minlength="8" maxlength="191" autocomplete="password-edit-admin" @if ($errors->has('password_edit_admin')) autofocus @endif>
                                    <!-- visualizar ou ocultar senha -->
                                    <div class="input-group-append" onclick="verSenha(this);">
                                        <span class="input-group-text {{ $errors->has('password_edit_admin') ? 'is-invalid' : '' }}">
                                            <i class="fe-input-icone far fa-eye"></i>
                                        </span>
                                    </div>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('password_edit_admin'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('password_edit_admin') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- confirmação de senha -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="password-confirmation-edit-admin">{{ __('Confirme a senha') }}</label>
                                <div class="input-group input-group-merge validate-password-confirmation-edit-admin">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('password_confirmation_edit_admin') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('repetir a senha') }}">*</span>
                                    <input type="password" id="password-confirmation-edit-admin" name="password_confirmation_edit_admin" class="form-control {{ $errors->has('password_confirmation_edit_admin') ? 'is-invalid' : '' }}" placeholder="{{ __('Confirme a senha') }}" minlength="8" maxlength="191" autocomplete="password-confirmation-edit-admin">
                                    <!-- visualizar ou ocultar senha -->
                                    <div class="input-group-append" onclick="verSenha(this);">
                                        <span class="input-group-text {{ $errors->has('password_confirmation_edit_admin') ? 'is-invalid' : '' }}">
                                            <i class="fe-input-icone far fa-eye"></i>
                                        </span>
                                    </div>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('password_confirmation_edit_admin'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('password_confirmation_edit_admin') }}</div>
                                @endif
                            </div>
                        </div>

                        <!-- sessão especial -->
                        <div class="col-6 mb-4">
                            <a href="javascript:void(0)" id="event-edit-admin-special-session" class="h5 text-muted fe-hover-color-theme" data-toggle="collapse" data-target="#collapse-edit-admin-special-session" aria-expanded="false" aria-controls="collapse-edit-admin-special-session">
                                <i class="fas fa-user-edit ml-1 mr-2"></i>
                                {{ __('sessão especial') }}
                            </a>
                        </div>
                        <!-- variáveis -->
                        <span hidden>
                            {{ $route = \App\Models\Route\Route::getRouteRoute('permission.user.edit') }}
                            {{ $group = \App\Models\Route\Group::getGroup($route['group_id'])['blocked'] }}
                        </span>
                        <!-- permissões -->
                        @if (app('router')->has('permission.user.edit') && \App\Models\Permission::routePermission('permission.user.edit'))
                            <div class="col-6 mb-4 mt-1">
                                <a href="javascript:void(0)" {{ $group || $route['blocked'] ? '' : 'id=link-permission-edit-admin target=_blank' }} class="h5 text-muted fe-hover-color-theme float-right {{ $group ? 'notify-block-group' : '' }} {{ $route['blocked'] ? 'notify-block-route' : '' }} {{ \App\Models\Menu\Menu::getMenuBlocked('permission.admin.edit') || \App\Models\Menu\MenuItem::getMenuItemBlocked('permission.admin.edit') ? 'fe-menu-block' : '' }}">
                                    <i class="fas fa-lock ml-1 mr-2"></i>
                                    {{ __('permissões') }}
                                </a>
                            </div>
                        @endif
                        <!-- itens da sessão especial -->
                        <div class="col-lg-12">
                            <div class="accordion">
                                <div id="collapse-edit-admin-special-session" class="collapse" aria-labelledby="heading-edit-admin-special-session" data-parent="#event-edit-admin-special-session">
                                    <!-- accordion para edições especiais -->
                                    <div id="accordion-edit-admin-special-session" class="accordion">
                                        <!-- imagens do perfil -->
                                        <div class="card">
                                            <div id="heading-edit-admin-special-session-1" class="card-header" data-toggle="collapse" data-target="#collapse-edit-admin-special-session-1" aria-expanded="false" aria-controls="collapse-edit-admin-special-session-1">
                                                <h5 class="small text-muted mb-0">
                                                    <i class="far fa-images mr-2"></i>
                                                    {{ __('Imagens do perfil') }}
                                                </h5>
                                            </div>
                                            <div id="collapse-edit-admin-special-session-1" class="collapse" aria-labelledby="heading-edit-admin-special-session-1" data-parent="#accordion-edit-admin-special-session">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <!-- foto -->
                                                        <div class="col-lg-6 mt-2">
                                                            <div class="form-group">
                                                                <div class="input-group-none validate-image-photo-edit-admin">
                                                                    <!-- botão de remover foto -->
                                                                    <div class="fe-remove-preview-8 fe-remove-preview-medium-round">
                                                                        <i class="far fa-times-circle"></i>
                                                                    </div>
                                                                    <!-- imagem do perfil estilizada -->
                                                                    <div class="fe-grid-preview-8">
                                                                        <div class="fe-grid-preview-item-8 fe-preview-medium fe-preview-round">
                                                                            <div class="fe-img-center fe-preview-8 fe-preview-medium fe-preview-round fe-default-user">
                                                                                <img class="fe-img-preview-8 fe-img-preview-cover" src="" alt="">
                                                                            </div>
                                                                            <div class="fe-grid-preview-text-8 text-monospace">
                                                                                <span>Selecionar</span>
                                                                                <p>Foto</p>
                                                                            </div>
                                                                            <!-- arquivo do perfil oculto -->
                                                                            <input type="file" id="image-photo-edit-admin" name="image_photo_edit_admin" class="fe-image-8" accept="image/jpg, image/jpeg, image/png, image/gif">
                                                                            <label for="photo-edit-admin"></label>
                                                                            <input type="text" id="photo-edit-admin" name="photo_edit_admin" class="fe-image-url-8" value="">
                                                                        </div>
                                                                    </div>
                                                                    <!-- alerta de erro -->
                                                                    @if ($errors->has('image_photo_edit_admin'))
                                                                        <div class="invalid-feedback" role="alert">{{ $errors->first('image_photo_edit_admin') }}</div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- capa -->
                                                        <div class="col-lg-6 mt-2">
                                                            <div class="form-group">
                                                                <div class="input-group-none validate-image-background-edit-admin">
                                                                    <!-- botão de remover capa -->
                                                                    <div class="fe-remove-preview-9 fe-remove-preview-rectangle">
                                                                        <i class="far fa-times-circle"></i>
                                                                    </div>
                                                                    <!-- imagem do perfil estilizada -->
                                                                    <div class="fe-grid-preview-9">
                                                                        <div class="fe-grid-preview-item-9 fe-preview-rectangle">
                                                                            <div class="fe-img-center fe-preview-9 fe-preview-rectangle fe-default-background">
                                                                                <img class="fe-img-preview-9 fe-img-preview-cover" src="" alt="">
                                                                            </div>
                                                                            <div class="fe-grid-preview-text-9 text-monospace">
                                                                                <span>Selecionar</span>
                                                                                <p>Capa</p>
                                                                            </div>
                                                                            <!-- arquivo do perfil oculto -->
                                                                            <input type="file" id="image-background-edit-admin" name="image_background_edit_admin" class="fe-image-9" accept="image/jpg, image/jpeg, image/png, image/gif">
                                                                            <label for="background-edit-admin"></label>
                                                                            <input type="text" id="background-edit-admin" name="background_edit_admin" class="fe-image-url-9" value="">
                                                                        </div>
                                                                    </div>
                                                                    <!-- alerta de erro -->
                                                                    @if ($errors->has('image_background_edit_admin'))
                                                                        <div class="invalid-feedback" role="alert">{{ $errors->first('image_background_edit_admin') }}</div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- informações do administrador -->
                                        <div class="card">
                                            <div id="heading-edit-admin-special-session-2" class="card-header" data-toggle="collapse" data-target="#collapse-edit-admin-special-session-2" aria-expanded="false" aria-controls="collapse-edit-admin-special-session-2">
                                                <h5 class="small text-muted mb-0">
                                                    <i class="far fa-id-card mr-2"></i>
                                                    {{ __('Informações do administrador') }}
                                                </h5>
                                            </div>
                                            <div id="collapse-edit-admin-special-session-2" class="collapse" aria-labelledby="heading-edit-admin-special-session-2" data-parent="#accordion-edit-admin-special-session">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <!-- cpf -->
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label" for="cpf-edit-admin">{{ __('CPF') }}</label>
                                                                <div class="input-group input-group-merge validate-cpf-edit-admin">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text {{ $errors->has('cpf_edit_admin') ? 'is-invalid' : '' }}">
                                                                            <i class="fas fa-credit-card"></i>
                                                                        </span>
                                                                    </div>
                                                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('cpf válido de 11 dígitos') }}">*</span>
                                                                    <input type="tel" id="cpf-edit-admin" name="cpf_edit_admin" class="form-control mask-cpf {{ $errors->has('cpf_edit_admin') ? 'is-invalid' : '' }}" placeholder="{{ __('xxx.xxx.xxx-xx') }}" value="{{ old('cpf_edit_admin') }}" minlength="14" maxlength="14" @if ($errors->has('cpf_edit_admin')) autofocus @endif>
                                                                </div>
                                                                <!-- alerta de erro -->
                                                                @if ($errors->has('cpf_edit_admin'))
                                                                    <div class="invalid-feedback" role="alert">{{ $errors->first('cpf_edit_admin') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <!-- rg -->
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label" for="rg-edit-admin">{{ __('RG') }}</label>
                                                                <div class="input-group input-group-merge validate-rg-edit-admin">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text {{ $errors->has('rg_edit_admin') ? 'is-invalid' : '' }}">
                                                                            <i class="far fa-id-card"></i>
                                                                        </span>
                                                                    </div>
                                                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('rg válido') }}">*</span>
                                                                    <input type="tel" id="rg-edit-admin" name="rg_edit_admin" class="form-control {{ $errors->has('rg_edit_admin') ? 'is-invalid' : '' }}" placeholder="{{ __('RG') }}" value="{{ old('rg_edit_admin') }}" minlength="8" maxlength="14" onkeypress="return soNumeros(event);" @if ($errors->has('rg_edit_admin')) autofocus @endif>
                                                                </div>
                                                                <!-- alerta de erro -->
                                                                @if ($errors->has('rg_edit_admin'))
                                                                    <div class="invalid-feedback" role="alert">{{ $errors->first('rg_edit_admin') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <!-- data de nascimento -->
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label" for="birthday-edit-admin">{{ __('Data de nascimento') }}</label>
                                                                <div class="input-group input-group-merge validate-birthday-edit-admin">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text {{ $errors->has('birthday_edit_admin') ? 'is-invalid' : '' }}">
                                                                            <i class="fas fa-calendar-alt"></i>
                                                                        </span>
                                                                    </div>
                                                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('data de nascimento válida') }}">*</span>
                                                                    <input type="tel" id="birthday-edit-admin" name="birthday_edit_admin" class="form-control datepicker-back mask-date {{ $errors->has('birthday_edit_admin') ? 'is-invalid' : '' }}" placeholder="{{ __('Informe a data') }}" value="{{ old('birthday_edit_admin') }}" minlength="10" maxlength="10" @if ($errors->has('birthday_edit_admin')) autofocus @endif>
                                                                </div>
                                                                <!-- alerta de erro -->
                                                                @if ($errors->has('birthday_edit_admin'))
                                                                    <div class="invalid-feedback" role="alert">{{ $errors->first('birthday_edit_admin') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <!-- contato -->
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label" for="contact-edit-admin">{{ __('Contato') }}</label>
                                                                <div class="input-group input-group-merge validate-contact-edit-admin">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text {{ $errors->has('contact_edit_admin') ? 'is-invalid' : '' }}">
                                                                            <i class="fas fa-phone"></i>
                                                                        </span>
                                                                    </div>
                                                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('número do celular com o ddd e 9º dígito') }}">*</span>
                                                                    <input type="tel" id="contact-edit-admin" name="contact_edit_admin" class="form-control mask-phones {{ $errors->has('contact_edit_admin') ? 'is-invalid' : '' }}" placeholder="{{ __('(xx) xxxxx-xxxx') }}" value="{{ old('contact_edit_admin') }}" minlength="14" maxlength="15" @if ($errors->has('contact_edit_admin')) autofocus @endif>
                                                                </div>
                                                                <!-- alerta de erro -->
                                                                @if ($errors->has('contact_edit_admin'))
                                                                    <div class="invalid-feedback" role="alert">{{ $errors->first('contact_edit_admin') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <!-- sexo -->
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label" for="gender-id-edit-admin">{{ __('Sexo') }}</label>
                                                                <div class="input-group-none validate-gender-id-edit-admin">
                                                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('selecione seu sexo') }}">*</span>
                                                                    {{ Form::select(
                                                                        "name",
                                                                        \App\Models\Gender::getGendersOptions(),
                                                                        old("gender_id_edit_admin"),
                                                                        ["id" => "gender-id-edit-admin", "name" => "gender_id_edit_admin", "class" => "form-control select-nosearch", "placeholder" => "Selecione"]
                                                                    )}}
                                                                </div>
                                                                <!-- alerta de erro -->
                                                                @if ($errors->has('gender_id_edit_admin'))
                                                                    <div class="invalid-feedback" role="alert">{{ $errors->first('gender_id_edit_admin') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <!-- descrição -->
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-control-label" for="description-edit-admin">{{ __('Descrição') }}</label>
                                                                <div class="input-group-none validate-description-edit-admin">
                                                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('descrição sobre você com no mínimo 10 caracteres') }}">*</span>
                                                                    <textarea id="description-edit-admin" name="description_edit_admin" rows="3" resize="none" class="form-control {{ $errors->has('description_edit_admin') ? 'is-invalid' : '' }}" placeholder="{{ __('Descrição') }}" minlength="10" maxlength="1500" onkeyup="primeiraLetraMaiuscula(this);" @if ($errors->has('description_edit_admin')) autofocus @endif>{{ old('description_edit_admin') }}</textarea>
                                                                </div>
                                                                <!-- alerta de erro -->
                                                                @if ($errors->has('description_edit_admin'))
                                                                    <div class="invalid-feedback" role="alert">{{ $errors->first('description_edit_admin') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- informações acadêmicas -->
                                        <div class="card">
                                            <div id="heading-edit-admin-special-session-3" class="card-header" data-toggle="collapse" data-target="#collapse-edit-admin-special-session-3" aria-expanded="false" aria-controls="collapse-edit-admin-special-session-3">
                                                <h5 class="small text-muted mb-0">
                                                    <i class="fas fa-graduation-cap mr-2"></i>
                                                    {{ __('Informações acadêmicas') }}
                                                </h5>
                                            </div>
                                            <div id="collapse-edit-admin-special-session-3" class="collapse" aria-labelledby="heading-edit-admin-special-session-3" data-parent="#accordion-edit-admin-special-session">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <!-- curso -->
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-control-label" for="course-edit-admin">{{ __('Curso') }}</label>
                                                                <div class="input-group input-group-merge validate-course-edit-admin">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text {{ $errors->has('course_edit_admin') ? 'is-invalid' : '' }}">
                                                                            <i class="fas fa-graduation-cap"></i>
                                                                        </span>
                                                                    </div>
                                                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                                                    <input type="text" id="course-edit-admin" name="course_edit_admin" class="form-control {{ $errors->has('course_edit_admin') ? 'is-invalid' : '' }}" placeholder="{{ __('Curso') }}" value="{{ old('course_edit_admin') }}" minlength="3" maxlength="191" onkeyup="letraMaiuscula('course-edit-admin');" @if ($errors->has('course_edit_admin')) autofocus @endif>
                                                                </div>
                                                                <!-- alerta de erro -->
                                                                @if ($errors->has('course_edit_admin'))
                                                                    <div class="invalid-feedback" role="alert">{{ $errors->first('course_edit_admin') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <!-- faculdade -->
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-control-label" for="college-edit-admin">{{ __('Faculdade') }}</label>
                                                                <div class="input-group input-group-merge validate-college-edit-admin">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text {{ $errors->has('college_edit_admin') ? 'is-invalid' : '' }}">
                                                                            <i class="fas fa-university"></i>
                                                                        </span>
                                                                    </div>
                                                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                                                    <input type="text" id="college-edit-admin" name="college_edit_admin" class="form-control {{ $errors->has('college_edit_admin') ? 'is-invalid' : '' }}" placeholder="{{ __('Faculdade') }}" value="{{ old('college_edit_admin') }}" minlength="3" maxlength="191" onkeyup="letraMaiuscula('college-edit-admin');" @if ($errors->has('college_edit_admin')) autofocus @endif>
                                                                </div>
                                                                <!-- alerta de erro -->
                                                                @if ($errors->has('college_edit_admin'))
                                                                    <div class="invalid-feedback" role="alert">{{ $errors->first('college_edit_admin') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- informações profissionais -->
                                        <div class="card">
                                            <div id="heading-edit-admin-special-session-4" class="card-header" data-toggle="collapse" data-target="#collapse-edit-admin-special-session-4" aria-expanded="false" aria-controls="collapse-edit-admin-special-session-4">
                                                <h5 class="small text-muted mb-0">
                                                    <i class="fas fa-admin-tie mr-2"></i>
                                                    {{ __('Informações profissionais') }}
                                                </h5>
                                            </div>
                                            <div id="collapse-edit-admin-special-session-4" class="collapse" aria-labelledby="heading-edit-admin-special-session-4" data-parent="#accordion-edit-admin-special-session">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <!-- profissão -->
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-control-label" for="profession-edit-admin">{{ __('Profissão') }}</label>
                                                                <div class="input-group input-group-merge validate-profession-edit-admin">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text {{ $errors->has('profession_edit_admin') ? 'is-invalid' : '' }}">
                                                                            <i class="fas fa-briefcase"></i>
                                                                        </span>
                                                                    </div>
                                                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                                                    <input type="text" id="profession-edit-admin" name="profession_edit_admin" class="form-control {{ $errors->has('profession_edit_admin') ? 'is-invalid' : '' }}" placeholder="{{ __('Profissão') }}" value="{{ old('profession_edit_admin') }}" minlength="3" maxlength="191" onkeyup="letraMaiuscula('profession-edit-admin');" @if ($errors->has('profession_edit_admin')) autofocus @endif>
                                                                </div>
                                                                <!-- alerta de erro -->
                                                                @if ($errors->has('profession_edit_admin'))
                                                                    <div class="invalid-feedback" role="alert">{{ $errors->first('profession_edit_admin') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <!-- empresa -->
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-control-label" for="company-edit-admin">{{ __('Empresa') }}</label>
                                                                <div class="input-group input-group-merge validate-company-edit-admin">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text {{ $errors->has('company_edit_admin') ? 'is-invalid' : '' }}">
                                                                            <i class="fas fa-building"></i>
                                                                        </span>
                                                                    </div>
                                                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                                                    <input type="text" id="company-edit-admin" name="company_edit_admin" class="form-control {{ $errors->has('company_edit_admin') ? 'is-invalid' : '' }}" placeholder="{{ __('Empresa') }}" value="{{ old('company_edit_admin') }}" minlength="3" maxlength="191" onkeyup="letraMaiuscula('company-edit-admin');" @if ($errors->has('company_edit_admin')) autofocus @endif>
                                                                </div>
                                                                <!-- alerta de erro -->
                                                                @if ($errors->has('company_edit_admin'))
                                                                    <div class="invalid-feedback" role="alert">{{ $errors->first('company_edit_admin') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- informações residenciais -->
                                        <div class="card">
                                            <div id="heading-edit-admin-special-session-5" class="card-header" data-toggle="collapse" data-target="#collapse-edit-admin-special-session-5" aria-expanded="false" aria-controls="collapse-edit-admin-special-session-5">
                                                <h5 class="small text-muted mb-0">
                                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                                    {{ __('Informações residenciais') }}
                                                </h5>
                                            </div>
                                            <div id="collapse-edit-admin-special-session-5" class="collapse" aria-labelledby="heading-edit-admin-special-session-5" data-parent="#accordion-edit-admin-special-session">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <!-- cep -->
                                                        <div class="col-lg-5">
                                                            <div class="form-group">
                                                                <label class="form-control-label" for="postal-code-edit-admin">{{ __('CEP') }}</label>
                                                                <div class="input-group input-group-merge validate-postal-code-edit-admin">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text {{ $errors->has('postal_code_edit_admin') ? 'is-invalid' : '' }}">
                                                                            <i class="fas fa-tag"></i>
                                                                        </span>
                                                                    </div>
                                                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('cep válido') }}">*</span>
                                                                    <input type="tel" id="postal-code-edit-admin" name="postal_code_edit_admin" class="form-control mask-cep {{ $errors->has('postal_code_edit_admin') ? 'is-invalid' : '' }}" placeholder="{{ __('CEP') }}" value="{{ old('postal_code_edit_admin') }}" minlength="9" maxlength="9" onkeyup="viacepadminEdit(this.value);" onclick="viacepadminEdit(this.value);" @if ($errors->has('postal_code_edit_admin')) autofocus @endif>
                                                                </div>
                                                                <!-- alerta de erro -->
                                                                @if ($errors->has('postal_code_edit_admin'))
                                                                    <div class="invalid-feedback" role="alert">{{ $errors->first('postal_code_edit_admin') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <!-- endereço -->
                                                        <div class="col-lg-7">
                                                            <div class="form-group">
                                                                <label class="form-control-label" for="address-edit-admin">{{ __('Endereço') }}</label>
                                                                <div class="input-group input-group-merge validate-address-edit-admin">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text {{ $errors->has('address_edit_admin') ? 'is-invalid' : '' }}">
                                                                            <i class="fas fa-map-marker-alt"></i>
                                                                        </span>
                                                                    </div>
                                                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                                                    <input type="text" id="address-edit-admin" name="address_edit_admin" class="form-control {{ $errors->has('address_edit_admin') ? 'is-invalid' : '' }}" placeholder="{{ __('Endereço') }}" value="{{ old('address_edit_admin') }}" minlength="3" maxlength="191" onkeyup="letraMaiuscula('address-edit-admin');" @if ($errors->has('address_edit_admin')) autofocus @endif>
                                                                </div>
                                                                <!-- alerta de erro -->
                                                                @if ($errors->has('address_edit_admin'))
                                                                    <div class="invalid-feedback" role="alert">{{ $errors->first('address_edit_admin') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <!-- nº -->
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label class="form-control-label" for="house-number-edit-admin">{{ __('nº') }}</label>
                                                                <div class="input-group input-group-merge validate-house-number-edit-admin">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text {{ $errors->has('house_number_edit_admin') ? 'is-invalid' : '' }}">
                                                                            <i class="fas fa-map-signs"></i>
                                                                        </span>
                                                                    </div>
                                                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('nº da residência') }}">*</span>
                                                                    <input type="text" id="house-number-edit-admin" name="house_number_edit_admin" class="form-control {{ $errors->has('house_number_edit_admin') ? 'is-invalid' : '' }}" placeholder="{{ __('nº') }}" value="{{ old('house_number_edit_admin') }}" maxlength="191" @if ($errors->has('house_number_edit_admin')) autofocus @endif>
                                                                </div>
                                                                <!-- alerta de erro -->
                                                                @if ($errors->has('house_number_edit_admin'))
                                                                    <div class="invalid-feedback" role="alert">{{ $errors->first('house_number_edit_admin') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <!-- complemento -->
                                                        <div class="col-lg-8">
                                                            <div class="form-group">
                                                                <label class="form-control-label" for="complement-edit-admin">{{ __('Complemento') }}</label>
                                                                <div class="input-group input-group-merge validate-complement-edit-admin">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text {{ $errors->has('complement_edit_admin') ? 'is-invalid' : '' }}">
                                                                            <i class="fas fa-plus-circle"></i>
                                                                        </span>
                                                                    </div>
                                                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                                                    <input type="text" id="complement-edit-admin" name="complement_edit_admin" class="form-control {{ $errors->has('complement_edit_admin') ? 'is-invalid' : '' }}" placeholder="{{ __('Complemento') }}" value="{{ old('complement_edit_admin') }}" minlength="3" maxlength="191" onkeyup="primeiraLetraMaiuscula(this);" @if ($errors->has('complement_edit_admin')) autofocus @endif>
                                                                </div>
                                                                <!-- alerta de erro -->
                                                                @if ($errors->has('complement_edit_admin'))
                                                                    <div class="invalid-feedback" role="alert">{{ $errors->first('complement_edit_admin') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <!-- bairro -->
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label" for="neighborhood-edit-admin">{{ __('Bairro') }}</label>
                                                                <div class="input-group input-group-merge validate-neighborhood-edit-admin">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text {{ $errors->has('neighborhood_edit_admin') ? 'is-invalid' : '' }}">
                                                                            <i class="fas fa-map-marked-alt"></i>
                                                                        </span>
                                                                    </div>
                                                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                                                    <input type="text" id="neighborhood-edit-admin" name="neighborhood_edit_admin" class="form-control {{ $errors->has('neighborhood_edit_admin') ? 'is-invalid' : '' }}" placeholder="{{ __('Bairro') }}" value="{{ old('neighborhood_edit_admin') }}" minlength="3" maxlength="191" onkeyup="letraMaiuscula('neighborhood-edit-admin');" @if ($errors->has('neighborhood_edit_admin')) autofocus @endif>
                                                                </div>
                                                                <!-- alerta de erro -->
                                                                @if ($errors->has('neighborhood_edit_admin'))
                                                                    <div class="invalid-feedback" role="alert">{{ $errors->first('neighborhood_edit_admin') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <!-- cidade -->
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label" for="city-edit-admin">{{ __('Cidade') }}</label>
                                                                <div class="input-group input-group-merge validate-city-edit-admin">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text {{ $errors->has('city_edit_admin') ? 'is-invalid' : '' }}">
                                                                            <i class="fas fa-city"></i>
                                                                        </span>
                                                                    </div>
                                                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                                                    <input type="text" id="city-edit-admin" name="city_edit_admin" class="form-control {{ $errors->has('city_edit_admin') ? 'is-invalid' : '' }}" placeholder="{{ __('Cidade') }}" value="{{ old('city_edit_admin') }}" onkeypress="return soLetras(event);" minlength="3" maxlength="191" onkeyup="letraMaiuscula('city-edit-admin');" @if ($errors->has('city_edit_admin')) autofocus @endif>
                                                                </div>
                                                                <!-- alerta de erro -->
                                                                @if ($errors->has('city_edit_admin'))
                                                                    <div class="invalid-feedback" role="alert">{{ $errors->first('city_edit_admin') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <!-- estado -->
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label" for="state-id-edit-admin">{{ __('Estado') }}</label>
                                                                <div class="input-group-none validate-state-id-edit-admin">
                                                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('selecione o estado') }}">*</span>
                                                                    {{ Form::select(
                                                                        "name",
                                                                        \App\Models\State::getStatesOptions(),
                                                                        old("state_id_edit_admin"),
                                                                        ["id" => "state-id-edit-admin", "name" => "state_id_edit_admin", "class" => "form-control", "placeholder" => "Selecione"]
                                                                    )}}
                                                                </div>
                                                                <!-- alerta de erro -->
                                                                @if ($errors->has('state_id_edit_admin'))
                                                                    <div class="invalid-feedback" role="alert">{{ $errors->first('state_id_edit_admin') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <!-- país -->
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label" for="country-edit-admin">{{ __('País') }}</label>
                                                                <div class="input-group input-group-merge validate-country-edit-admin">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text {{ $errors->has('country_edit_admin') ? 'is-invalid' : '' }}">
                                                                            <i class="fas fa-globe-americas"></i>
                                                                        </span>
                                                                    </div>
                                                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                                                    <input type="text" id="country-edit-admin" name="country_edit_admin" class="form-control {{ $errors->has('country_edit_admin') ? 'is-invalid' : '' }}" placeholder="{{ __('País') }}" value="{{ old('country_edit_admin') }}" onkeypress="return soLetras(event);" minlength="3" maxlength="191" onkeyup="letraMaiuscula('country-edit-admin');" @if ($errors->has('country_edit_admin')) autofocus @endif>
                                                                </div>
                                                                <!-- alerta de erro -->
                                                                @if ($errors->has('country_edit_admin'))
                                                                    <div class="invalid-feedback" role="alert">{{ $errors->first('country_edit_admin') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- informações -->
                    <div class="fe-mouse-off">
                        <div class="text-right">
                            <small class="fe-text-star">{{ __('*') }}</small>
                            <small class="text-light">{{ __('campos obrigatórios') }}</small>
                        </div>
                        <br>
                        <div class="mt--1">
                            <small class="text-light">{{ __('ao realizar uma edição de administrador, o administrador editado irá receber uma notificação de e-mail com os dados alterados') }}</small>
                        </div>
                    </div>
                    <!-- botões -->
                    <div class="text-right float-right fe-form-footer">
                        <a href="javascript:void(0)" class="mr-4" data-dismiss="modal">{{ __('Cancelar') }}</a>
                        @if (app('router')->has('admin.update') && \App\Models\Permission::routePermission('admin.update'))
                            <button type="submit" id="btn-edit-admin" class="btn btn-outline-success mr-4">{{ __('Editar administrador') }}</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
