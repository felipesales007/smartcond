<div id="modal-edit-user" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-edit-user-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- título -->
            <div class="modal-header">
                <h5 id="modal-edit-user-label" class="modal-title text-uppercase text-monospace ml-1">
                    <b>{{ __('Editar usuário') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- form -->
                <form id="form-edit-user" role="form" autocomplete="off" novalidate>
                    @csrf
                    <!-- inputs -->
                    <div class="row">
                        <!-- id -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="id-edit-user">{{ __('ID') }}</label>
                                <div class="input-group input-group-merge validate-id-edit-user">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('id_edit_user') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('id do usuário') }}">*</span>
                                    <input readonly type="number" id="id-edit-user" name="id_edit_user" class="form-control {{ $errors->has('id_edit_user') ? 'is-invalid' : '' }}" placeholder="{{ __('ID do usuário') }}" value="{{ old('id_edit_user') }}" maxlength="20" required onkeypress="return onlyNumbers(event);" @if ($errors->has('id_edit_user')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('id_edit_user'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('id_edit_user') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- nome -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="name-edit-user">{{ __('Nome') }}</label>
                                <div class="input-group input-group-merge validate-name-edit-user">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('name_edit_user') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-user"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                    <input type="text" id="name-edit-user" name="name_edit_user" class="form-control {{ $errors->has('name_edit_user') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome completo') }}" value="{{ old('name_edit_user') }}" minlength="3" maxlength="191" required onkeypress="return onlyLetters(event);" onkeyup="letterUppercase('name-edit-user');" @if ($errors->has('name_edit_user')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_edit_user'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_edit_user') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- e-mail -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="email-edit-user">{{ __('E-mail') }}</label>
                                <div class="input-group input-group-merge validate-email-edit-user">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('email_edit_user') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('e-mail válido') }}">*</span>
                                    <input type="email" id="email-edit-user" name="email_edit_user" class="form-control {{ $errors->has('email_edit_user') ? 'is-invalid' : '' }}" placeholder="{{ __('E-mail') }}" value="{{ old('email_edit_user') }}" maxlength="191" required @if ($errors->has('email_edit_user')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('email_edit_user'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('email_edit_user') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- condomínio -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="entity-id-edit-user">{{ __('Condomínio') }}</label>
                                <div class="input-group-none validate-entity-id-edit-user">
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('selecione o condomínio') }}">*</span>
                                    {{ Form::select(
                                        "name",
                                        \App\Models\Entity\Entity::getEntitiesOptions(),
                                        old("entity_id_edit_user"),
                                        ["id" => "entity-id-edit-user", "name" => "entity_id_edit_user[]", "class" => "form-control", "required", "multiple"]
                                    )}}
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('entity_id_edit_user'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('entity_id_edit_user') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- senha -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="password-edit-user">{{ __('Senha') }}</label>
                                <div class="input-group input-group-merge validate-password-edit-user">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('password_edit_user') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 8 caracteres') }}">*</span>
                                    <input type="password" id="password-edit-user" name="password_edit_user" class="form-control {{ $errors->has('password_edit_user') ? 'is-invalid' : '' }}" placeholder="{{ __('Senha') }}" minlength="8" maxlength="191" autocomplete="password-edit-user" @if ($errors->has('password_edit_user')) autofocus @endif>
                                    <!-- visualizar ou ocultar senha -->
                                    <div class="input-group-append" onclick="viewPassword(this);">
                                        <span class="input-group-text {{ $errors->has('password_edit_user') ? 'is-invalid' : '' }}">
                                            <i class="fe-input-icon far fa-eye"></i>
                                        </span>
                                    </div>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('password_edit_user'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('password_edit_user') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- confirmação de senha -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="password-confirmation-edit-user">{{ __('Confirme a senha') }}</label>
                                <div class="input-group input-group-merge validate-password-confirmation-edit-user">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('password_confirmation_edit_user') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('repetir a senha') }}">*</span>
                                    <input type="password" id="password-confirmation-edit-user" name="password_confirmation_edit_user" class="form-control {{ $errors->has('password_confirmation_edit_user') ? 'is-invalid' : '' }}" placeholder="{{ __('Confirme a senha') }}" minlength="8" maxlength="191" autocomplete="password-confirmation-edit-user">
                                    <!-- visualizar ou ocultar senha -->
                                    <div class="input-group-append" onclick="viewPassword(this);">
                                        <span class="input-group-text {{ $errors->has('password_confirmation_edit_user') ? 'is-invalid' : '' }}">
                                            <i class="fe-input-icon far fa-eye"></i>
                                        </span>
                                    </div>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('password_confirmation_edit_user'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('password_confirmation_edit_user') }}</div>
                                @endif
                            </div>
                        </div>

                        <!-- sessão especial -->
                        <div class="col-6 mb-4">
                            <a href="javascript:void(0)" id="event-edit-user-special-session" class="h5 text-muted text-primary fe-transition-default" data-toggle="collapse" data-target="#collapse-edit-user-special-session" aria-expanded="false" aria-controls="collapse-edit-user-special-session">
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
                        @if (app('router')->has('permission.user.edit') && \App\Models\User\Permission::routePermission('permission.user.edit'))
                            <div class="col-6 mb-4 mt-1">
                                <a href="javascript:void(0)" {{ $group || $route['blocked'] ? '' : 'id=link-permission-edit-user target=_blank' }} class="h5 text-muted text-primary fe-transition-default float-right {{ $group ? 'notify-block-group' : '' }} {{ $route['blocked'] ? 'notify-block-route' : '' }} {{ \App\Models\Menu\Menu::getMenuBlocked('permission.user.edit') || \App\Models\Menu\MenuItem::getMenuItemBlocked('permission.user.edit') ? 'fe-menu-block' : '' }}">
                                    <i class="fas fa-lock ml-1 mr-2"></i>
                                    {{ __('permissões') }}
                                </a>
                            </div>
                        @endif
                        <!-- itens da sessão especial -->
                        <div class="col-lg-12">
                            <div class="accordion">
                                <div id="collapse-edit-user-special-session" class="collapse" aria-labelledby="heading-edit-user-special-session" data-parent="#event-edit-user-special-session">
                                    <!-- accordion para edições especiais -->
                                    <div id="accordion-edit-user-special-session" class="accordion">
                                        <!-- imagens do perfil -->
                                        <div class="card">
                                            <div id="heading-edit-user-special-session-1" class="card-header" data-toggle="collapse" data-target="#collapse-edit-user-special-session-1" aria-expanded="false" aria-controls="collapse-edit-user-special-session-1">
                                                <h5 class="small text-muted mb-0">
                                                    <i class="far fa-images mr-2"></i>
                                                    {{ __('Imagens do perfil') }}
                                                </h5>
                                            </div>
                                            <div id="collapse-edit-user-special-session-1" class="collapse" aria-labelledby="heading-edit-user-special-session-1" data-parent="#accordion-edit-user-special-session">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <!-- foto -->
                                                        <div class="col-lg-6 mt-2">
                                                            <div class="form-group">
                                                                <div class="input-group-none validate-image-photo-edit-user">
                                                                    <!-- botão de remover foto -->
                                                                    <div class="fe-remove-preview-2 fe-remove-preview-medium-round">
                                                                        <i class="far fa-times-circle"></i>
                                                                    </div>
                                                                    <!-- imagem do perfil estilizada -->
                                                                    <div class="fe-grid-preview-2">
                                                                        <div class="fe-grid-preview-item-2 fe-preview-medium fe-preview-round">
                                                                            <div class="fe-img-center fe-preview-2 fe-preview-medium fe-preview-round fe-default-user">
                                                                                <img class="fe-img-preview-2 fe-img-preview-cover" src="" alt="">
                                                                            </div>
                                                                            <div class="fe-grid-preview-text-2 text-monospace">
                                                                                <span>Selecionar</span>
                                                                                <p>Foto</p>
                                                                            </div>
                                                                            <!-- arquivo do perfil oculto -->
                                                                            <input type="file" id="image-photo-edit-user" name="image_photo_edit_user" class="fe-image-2" accept="image/jpg, image/jpeg, image/png, image/gif">
                                                                            <label for="photo-edit-user"></label>
                                                                            <input type="text" id="photo-edit-user" name="photo_edit_user" class="fe-image-url-2" value="">
                                                                        </div>
                                                                    </div>
                                                                    <!-- alerta de erro -->
                                                                    @if ($errors->has('image_photo_edit_user'))
                                                                        <div class="invalid-feedback" role="alert">{{ $errors->first('image_photo_edit_user') }}</div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- capa -->
                                                        <div class="col-lg-6 mt-2">
                                                            <div class="form-group">
                                                                <div class="input-group-none validate-image-background-edit-user">
                                                                    <!-- botão de remover capa -->
                                                                    <div class="fe-remove-preview-3 fe-remove-preview-rectangle">
                                                                        <i class="far fa-times-circle"></i>
                                                                    </div>
                                                                    <!-- imagem do perfil estilizada -->
                                                                    <div class="fe-grid-preview-3">
                                                                        <div class="fe-grid-preview-item-3 fe-preview-rectangle">
                                                                            <div class="fe-img-center fe-preview-3 fe-preview-rectangle fe-default-background">
                                                                                <img class="fe-img-preview-3 fe-img-preview-cover" src="" alt="">
                                                                            </div>
                                                                            <div class="fe-grid-preview-text-3 text-monospace">
                                                                                <span>Selecionar</span>
                                                                                <p>Capa</p>
                                                                            </div>
                                                                            <!-- arquivo do perfil oculto -->
                                                                            <input type="file" id="image-background-edit-user" name="image_background_edit_user" class="fe-image-3" accept="image/jpg, image/jpeg, image/png, image/gif">
                                                                            <label for="background-edit-user"></label>
                                                                            <input type="text" id="background-edit-user" name="background_edit_user" class="fe-image-url-3" value="">
                                                                        </div>
                                                                    </div>
                                                                    <!-- alerta de erro -->
                                                                    @if ($errors->has('image_background_edit_user'))
                                                                        <div class="invalid-feedback" role="alert">{{ $errors->first('image_background_edit_user') }}</div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- informações do usuário -->
                                        <div class="card">
                                            <div id="heading-edit-user-special-session-2" class="card-header" data-toggle="collapse" data-target="#collapse-edit-user-special-session-2" aria-expanded="false" aria-controls="collapse-edit-user-special-session-2">
                                                <h5 class="small text-muted mb-0">
                                                    <i class="far fa-id-card mr-2"></i>
                                                    {{ __('Informações do usuário') }}
                                                </h5>
                                            </div>
                                            <div id="collapse-edit-user-special-session-2" class="collapse" aria-labelledby="heading-edit-user-special-session-2" data-parent="#accordion-edit-user-special-session">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <!-- cpf -->
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label" for="cpf-edit-user">{{ __('CPF') }}</label>
                                                                <div class="input-group input-group-merge validate-cpf-edit-user">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text {{ $errors->has('cpf_edit_user') ? 'is-invalid' : '' }}">
                                                                            <i class="fas fa-credit-card"></i>
                                                                        </span>
                                                                    </div>
                                                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('cpf válido de 11 dígitos') }}">*</span>
                                                                    <input type="tel" id="cpf-edit-user" name="cpf_edit_user" class="form-control mask-cpf {{ $errors->has('cpf_edit_user') ? 'is-invalid' : '' }}" placeholder="{{ __('xxx.xxx.xxx-xx') }}" value="{{ old('cpf_edit_user') }}" minlength="14" maxlength="14" @if ($errors->has('cpf_edit_user')) autofocus @endif>
                                                                </div>
                                                                <!-- alerta de erro -->
                                                                @if ($errors->has('cpf_edit_user'))
                                                                    <div class="invalid-feedback" role="alert">{{ $errors->first('cpf_edit_user') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <!-- rg -->
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label" for="rg-edit-user">{{ __('RG') }}</label>
                                                                <div class="input-group input-group-merge validate-rg-edit-user">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text {{ $errors->has('rg_edit_user') ? 'is-invalid' : '' }}">
                                                                            <i class="far fa-id-card"></i>
                                                                        </span>
                                                                    </div>
                                                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('rg válido') }}">*</span>
                                                                    <input type="tel" id="rg-edit-user" name="rg_edit_user" class="form-control {{ $errors->has('rg_edit_user') ? 'is-invalid' : '' }}" placeholder="{{ __('RG') }}" value="{{ old('rg_edit_user') }}" minlength="8" maxlength="14" onkeypress="return onlyNumbers(event);" @if ($errors->has('rg_edit_user')) autofocus @endif>
                                                                </div>
                                                                <!-- alerta de erro -->
                                                                @if ($errors->has('rg_edit_user'))
                                                                    <div class="invalid-feedback" role="alert">{{ $errors->first('rg_edit_user') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <!-- data de nascimento -->
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label" for="birthday-edit-user">{{ __('Data de nascimento') }}</label>
                                                                <div class="input-group input-group-merge validate-birthday-edit-user">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text {{ $errors->has('birthday_edit_user') ? 'is-invalid' : '' }}">
                                                                            <i class="fas fa-calendar-alt"></i>
                                                                        </span>
                                                                    </div>
                                                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('data de nascimento válida') }}">*</span>
                                                                    <input type="tel" id="birthday-edit-user" name="birthday_edit_user" class="form-control datepicker-back mask-date {{ $errors->has('birthday_edit_user') ? 'is-invalid' : '' }}" placeholder="{{ __('Informe a data') }}" value="{{ old('birthday_edit_user') }}" minlength="10" maxlength="10" @if ($errors->has('birthday_edit_user')) autofocus @endif>
                                                                </div>
                                                                <!-- alerta de erro -->
                                                                @if ($errors->has('birthday_edit_user'))
                                                                    <div class="invalid-feedback" role="alert">{{ $errors->first('birthday_edit_user') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <!-- telefone -->
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label" for="contact-edit-user">{{ __('Telefone') }}</label>
                                                                <div class="input-group input-group-merge validate-contact-edit-user">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text {{ $errors->has('contact_edit_user') ? 'is-invalid' : '' }}">
                                                                            <i class="fas fa-phone"></i>
                                                                        </span>
                                                                    </div>
                                                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('número do celular com o ddd e 9º dígito') }}">*</span>
                                                                    <input type="tel" id="contact-edit-user" name="contact_edit_user" class="form-control mask-phones {{ $errors->has('contact_edit_user') ? 'is-invalid' : '' }}" placeholder="{{ __('(xx) xxxxx-xxxx') }}" value="{{ old('contact_edit_user') }}" minlength="14" maxlength="15" @if ($errors->has('contact_edit_user')) autofocus @endif>
                                                                </div>
                                                                <!-- alerta de erro -->
                                                                @if ($errors->has('contact_edit_user'))
                                                                    <div class="invalid-feedback" role="alert">{{ $errors->first('contact_edit_user') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <!-- sexo -->
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label" for="gender-id-edit-user">{{ __('Sexo') }}</label>
                                                                <div class="input-group-none validate-gender-id-edit-user">
                                                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('selecione seu sexo') }}">*</span>
                                                                    {{ Form::select(
                                                                        "name",
                                                                        \App\Models\User\Gender::getGendersOptions(),
                                                                        old("gender_id_edit_user"),
                                                                        ["id" => "gender-id-edit-user", "name" => "gender_id_edit_user", "class" => "form-control select-nosearch", "placeholder" => "Selecione"]
                                                                    )}}
                                                                </div>
                                                                <!-- alerta de erro -->
                                                                @if ($errors->has('gender_id_edit_user'))
                                                                    <div class="invalid-feedback" role="alert">{{ $errors->first('gender_id_edit_user') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <!-- descrição -->
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-control-label" for="description-edit-user">{{ __('Descrição') }}</label>
                                                                <div class="input-group-none validate-description-edit-user">
                                                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('descrição sobre você com no mínimo 10 caracteres') }}">*</span>
                                                                    <textarea id="description-edit-user" name="description_edit_user" rows="3" resize="none" class="form-control {{ $errors->has('description_edit_user') ? 'is-invalid' : '' }}" placeholder="{{ __('Descrição') }}" minlength="10" maxlength="1500" onkeyup="firstLetterUppercase(this);" @if ($errors->has('description_edit_user')) autofocus @endif>{{ old('description_edit_user') }}</textarea>
                                                                </div>
                                                                <!-- alerta de erro -->
                                                                @if ($errors->has('description_edit_user'))
                                                                    <div class="invalid-feedback" role="alert">{{ $errors->first('description_edit_user') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- informações acadêmicas -->
                                        <div class="card">
                                            <div id="heading-edit-user-special-session-3" class="card-header" data-toggle="collapse" data-target="#collapse-edit-user-special-session-3" aria-expanded="false" aria-controls="collapse-edit-user-special-session-3">
                                                <h5 class="small text-muted mb-0">
                                                    <i class="fas fa-graduation-cap mr-2"></i>
                                                    {{ __('Informações acadêmicas') }}
                                                </h5>
                                            </div>
                                            <div id="collapse-edit-user-special-session-3" class="collapse" aria-labelledby="heading-edit-user-special-session-3" data-parent="#accordion-edit-user-special-session">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <!-- curso -->
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-control-label" for="course-edit-user">{{ __('Curso') }}</label>
                                                                <div class="input-group input-group-merge validate-course-edit-user">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text {{ $errors->has('course_edit_user') ? 'is-invalid' : '' }}">
                                                                            <i class="fas fa-graduation-cap"></i>
                                                                        </span>
                                                                    </div>
                                                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                                                    <input type="text" id="course-edit-user" name="course_edit_user" class="form-control {{ $errors->has('course_edit_user') ? 'is-invalid' : '' }}" placeholder="{{ __('Curso') }}" value="{{ old('course_edit_user') }}" minlength="3" maxlength="191" onkeyup="letterUppercase('course-edit-user');" @if ($errors->has('course_edit_user')) autofocus @endif>
                                                                </div>
                                                                <!-- alerta de erro -->
                                                                @if ($errors->has('course_edit_user'))
                                                                    <div class="invalid-feedback" role="alert">{{ $errors->first('course_edit_user') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <!-- faculdade -->
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-control-label" for="college-edit-user">{{ __('Faculdade') }}</label>
                                                                <div class="input-group input-group-merge validate-college-edit-user">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text {{ $errors->has('college_edit_user') ? 'is-invalid' : '' }}">
                                                                            <i class="fas fa-university"></i>
                                                                        </span>
                                                                    </div>
                                                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                                                    <input type="text" id="college-edit-user" name="college_edit_user" class="form-control {{ $errors->has('college_edit_user') ? 'is-invalid' : '' }}" placeholder="{{ __('Faculdade') }}" value="{{ old('college_edit_user') }}" minlength="3" maxlength="191" onkeyup="letterUppercase('college-edit-user');" @if ($errors->has('college_edit_user')) autofocus @endif>
                                                                </div>
                                                                <!-- alerta de erro -->
                                                                @if ($errors->has('college_edit_user'))
                                                                    <div class="invalid-feedback" role="alert">{{ $errors->first('college_edit_user') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- informações profissionais -->
                                        <div class="card">
                                            <div id="heading-edit-user-special-session-4" class="card-header" data-toggle="collapse" data-target="#collapse-edit-user-special-session-4" aria-expanded="false" aria-controls="collapse-edit-user-special-session-4">
                                                <h5 class="small text-muted mb-0">
                                                    <i class="fas fa-user-tie mr-2"></i>
                                                    {{ __('Informações profissionais') }}
                                                </h5>
                                            </div>
                                            <div id="collapse-edit-user-special-session-4" class="collapse" aria-labelledby="heading-edit-user-special-session-4" data-parent="#accordion-edit-user-special-session">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <!-- profissão -->
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-control-label" for="profession-edit-user">{{ __('Profissão') }}</label>
                                                                <div class="input-group input-group-merge validate-profession-edit-user">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text {{ $errors->has('profession_edit_user') ? 'is-invalid' : '' }}">
                                                                            <i class="fas fa-briefcase"></i>
                                                                        </span>
                                                                    </div>
                                                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                                                    <input type="text" id="profession-edit-user" name="profession_edit_user" class="form-control {{ $errors->has('profession_edit_user') ? 'is-invalid' : '' }}" placeholder="{{ __('Profissão') }}" value="{{ old('profession_edit_user') }}" minlength="3" maxlength="191" onkeyup="letterUppercase('profession-edit-user');" @if ($errors->has('profession_edit_user')) autofocus @endif>
                                                                </div>
                                                                <!-- alerta de erro -->
                                                                @if ($errors->has('profession_edit_user'))
                                                                    <div class="invalid-feedback" role="alert">{{ $errors->first('profession_edit_user') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <!-- empresa -->
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-control-label" for="company-edit-user">{{ __('Empresa') }}</label>
                                                                <div class="input-group input-group-merge validate-company-edit-user">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text {{ $errors->has('company_edit_user') ? 'is-invalid' : '' }}">
                                                                            <i class="fas fa-building"></i>
                                                                        </span>
                                                                    </div>
                                                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                                                    <input type="text" id="company-edit-user" name="company_edit_user" class="form-control {{ $errors->has('company_edit_user') ? 'is-invalid' : '' }}" placeholder="{{ __('Empresa') }}" value="{{ old('company_edit_user') }}" minlength="3" maxlength="191" onkeyup="letterUppercase('company-edit-user');" @if ($errors->has('company_edit_user')) autofocus @endif>
                                                                </div>
                                                                <!-- alerta de erro -->
                                                                @if ($errors->has('company_edit_user'))
                                                                    <div class="invalid-feedback" role="alert">{{ $errors->first('company_edit_user') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- informações residenciais -->
                                        <div class="card">
                                            <div id="heading-edit-user-special-session-5" class="card-header" data-toggle="collapse" data-target="#collapse-edit-user-special-session-5" aria-expanded="false" aria-controls="collapse-edit-user-special-session-5">
                                                <h5 class="small text-muted mb-0">
                                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                                    {{ __('Informações residenciais') }}
                                                </h5>
                                            </div>
                                            <div id="collapse-edit-user-special-session-5" class="collapse" aria-labelledby="heading-edit-user-special-session-5" data-parent="#accordion-edit-user-special-session">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <!-- cep -->
                                                        <div class="col-lg-5">
                                                            <div class="form-group">
                                                                <label class="form-control-label" for="postal-code-edit-user">{{ __('CEP') }}</label>
                                                                <div class="input-group input-group-merge validate-postal-code-edit-user">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text {{ $errors->has('postal_code_edit_user') ? 'is-invalid' : '' }}">
                                                                            <i class="fas fa-tag"></i>
                                                                        </span>
                                                                    </div>
                                                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('cep válido') }}">*</span>
                                                                    <input type="tel" id="postal-code-edit-user" name="postal_code_edit_user" class="form-control mask-cep {{ $errors->has('postal_code_edit_user') ? 'is-invalid' : '' }}" placeholder="{{ __('CEP') }}" value="{{ old('postal_code_edit_user') }}" minlength="9" maxlength="9" onkeyup="viacep(this.value, '-edit-user');" onclick="viacep(this.value, '-edit-user');" @if ($errors->has('postal_code_edit_user')) autofocus @endif>
                                                                </div>
                                                                <!-- alerta de erro -->
                                                                @if ($errors->has('postal_code_edit_user'))
                                                                    <div class="invalid-feedback" role="alert">{{ $errors->first('postal_code_edit_user') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <!-- endereço -->
                                                        <div class="col-lg-7">
                                                            <div class="form-group">
                                                                <label class="form-control-label" for="address-edit-user">{{ __('Endereço') }}</label>
                                                                <div class="input-group input-group-merge validate-address-edit-user">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text {{ $errors->has('address_edit_user') ? 'is-invalid' : '' }}">
                                                                            <i class="fas fa-map-marker-alt"></i>
                                                                        </span>
                                                                    </div>
                                                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                                                    <input type="text" id="address-edit-user" name="address_edit_user" class="form-control {{ $errors->has('address_edit_user') ? 'is-invalid' : '' }}" placeholder="{{ __('Endereço') }}" value="{{ old('address_edit_user') }}" minlength="3" maxlength="191" onkeyup="letterUppercase('address-edit-user');" @if ($errors->has('address_edit_user')) autofocus @endif>
                                                                </div>
                                                                <!-- alerta de erro -->
                                                                @if ($errors->has('address_edit_user'))
                                                                    <div class="invalid-feedback" role="alert">{{ $errors->first('address_edit_user') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <!-- nº -->
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label class="form-control-label" for="house-number-edit-user">{{ __('nº') }}</label>
                                                                <div class="input-group input-group-merge validate-house-number-edit-user">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text {{ $errors->has('house_number_edit_user') ? 'is-invalid' : '' }}">
                                                                            <i class="fas fa-map-signs"></i>
                                                                        </span>
                                                                    </div>
                                                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('nº da residência') }}">*</span>
                                                                    <input type="text" id="house-number-edit-user" name="house_number_edit_user" class="form-control {{ $errors->has('house_number_edit_user') ? 'is-invalid' : '' }}" placeholder="{{ __('nº') }}" value="{{ old('house_number_edit_user') }}" maxlength="191" @if ($errors->has('house_number_edit_user')) autofocus @endif>
                                                                </div>
                                                                <!-- alerta de erro -->
                                                                @if ($errors->has('house_number_edit_user'))
                                                                    <div class="invalid-feedback" role="alert">{{ $errors->first('house_number_edit_user') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <!-- complemento -->
                                                        <div class="col-lg-8">
                                                            <div class="form-group">
                                                                <label class="form-control-label" for="complement-edit-user">{{ __('Complemento') }}</label>
                                                                <div class="input-group input-group-merge validate-complement-edit-user">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text {{ $errors->has('complement_edit_user') ? 'is-invalid' : '' }}">
                                                                            <i class="fas fa-plus-circle"></i>
                                                                        </span>
                                                                    </div>
                                                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                                                    <input type="text" id="complement-edit-user" name="complement_edit_user" class="form-control {{ $errors->has('complement_edit_user') ? 'is-invalid' : '' }}" placeholder="{{ __('Complemento') }}" value="{{ old('complement_edit_user') }}" minlength="3" maxlength="191" onkeyup="firstLetterUppercase(this);" @if ($errors->has('complement_edit_user')) autofocus @endif>
                                                                </div>
                                                                <!-- alerta de erro -->
                                                                @if ($errors->has('complement_edit_user'))
                                                                    <div class="invalid-feedback" role="alert">{{ $errors->first('complement_edit_user') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <!-- bairro -->
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label" for="neighborhood-edit-user">{{ __('Bairro') }}</label>
                                                                <div class="input-group input-group-merge validate-neighborhood-edit-user">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text {{ $errors->has('neighborhood_edit_user') ? 'is-invalid' : '' }}">
                                                                            <i class="fas fa-map-marked-alt"></i>
                                                                        </span>
                                                                    </div>
                                                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                                                    <input type="text" id="neighborhood-edit-user" name="neighborhood_edit_user" class="form-control {{ $errors->has('neighborhood_edit_user') ? 'is-invalid' : '' }}" placeholder="{{ __('Bairro') }}" value="{{ old('neighborhood_edit_user') }}" minlength="3" maxlength="191" onkeyup="letterUppercase('neighborhood-edit-user');" @if ($errors->has('neighborhood_edit_user')) autofocus @endif>
                                                                </div>
                                                                <!-- alerta de erro -->
                                                                @if ($errors->has('neighborhood_edit_user'))
                                                                    <div class="invalid-feedback" role="alert">{{ $errors->first('neighborhood_edit_user') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <!-- cidade -->
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label" for="city-edit-user">{{ __('Cidade') }}</label>
                                                                <div class="input-group input-group-merge validate-city-edit-user">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text {{ $errors->has('city_edit_user') ? 'is-invalid' : '' }}">
                                                                            <i class="fas fa-city"></i>
                                                                        </span>
                                                                    </div>
                                                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                                                    <input type="text" id="city-edit-user" name="city_edit_user" class="form-control {{ $errors->has('city_edit_user') ? 'is-invalid' : '' }}" placeholder="{{ __('Cidade') }}" value="{{ old('city_edit_user') }}" onkeypress="return onlyLetters(event);" minlength="3" maxlength="191" onkeyup="letterUppercase('city-edit-user');" @if ($errors->has('city_edit_user')) autofocus @endif>
                                                                </div>
                                                                <!-- alerta de erro -->
                                                                @if ($errors->has('city_edit_user'))
                                                                    <div class="invalid-feedback" role="alert">{{ $errors->first('city_edit_user') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <!-- estado -->
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label" for="state-id-edit-user">{{ __('Estado') }}</label>
                                                                <div class="input-group-none validate-state-id-edit-user">
                                                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('selecione o estado') }}">*</span>
                                                                    {{ Form::select(
                                                                        "name",
                                                                        \App\Models\State::getStatesOptions(),
                                                                        old("state_id_edit_user"),
                                                                        ["id" => "state-id-edit-user", "name" => "state_id_edit_user", "class" => "form-control", "placeholder" => "Selecione"]
                                                                    )}}
                                                                </div>
                                                                <!-- alerta de erro -->
                                                                @if ($errors->has('state_id_edit_user'))
                                                                    <div class="invalid-feedback" role="alert">{{ $errors->first('state_id_edit_user') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <!-- país -->
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label" for="country-edit-user">{{ __('País') }}</label>
                                                                <div class="input-group input-group-merge validate-country-edit-user">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text {{ $errors->has('country_edit_user') ? 'is-invalid' : '' }}">
                                                                            <i class="fas fa-globe-americas"></i>
                                                                        </span>
                                                                    </div>
                                                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                                                    <input type="text" id="country-edit-user" name="country_edit_user" class="form-control {{ $errors->has('country_edit_user') ? 'is-invalid' : '' }}" placeholder="{{ __('País') }}" value="{{ old('country_edit_user') }}" onkeypress="return onlyLetters(event);" minlength="3" maxlength="191" onkeyup="letterUppercase('country-edit-user');" @if ($errors->has('country_edit_user')) autofocus @endif>
                                                                </div>
                                                                <!-- alerta de erro -->
                                                                @if ($errors->has('country_edit_user'))
                                                                    <div class="invalid-feedback" role="alert">{{ $errors->first('country_edit_user') }}</div>
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
                    <div class="fe-mouse">
                        <div class="text-right">
                            <small class="fe-text-star">{{ __('*') }}</small>
                            <small class="text-light">{{ __('campos obrigatórios') }}</small>
                        </div>
                        <br>
                        <div class="mt--1">
                            <small class="text-light">{{ __('ao realizar uma edição de usuário, o usuário editado irá receber uma notificação de e-mail com os dados alterados') }}</small>
                        </div>
                    </div>
                    <!-- botões -->
                    <div class="text-right float-right fe-form-footer">
                        <a href="javascript:void(0)" class="mr-4" data-dismiss="modal">{{ __('Cancelar') }}</a>
                        <button type="submit" id="btn-edit-user" class="btn btn-outline-success mr-4">{{ __('Editar usuário') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
