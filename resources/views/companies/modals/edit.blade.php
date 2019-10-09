<div id="modal-edit-company" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-edit-company-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <!-- título -->
            <div class="modal-header">
                <h5 id="modal-edit-company-label" class="modal-title text-uppercase text-monospace ml-1">
                    <b>{{ __('Editar condomínio') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- form -->
                <form id="form-edit-company" role="form" autocomplete="off" novalidate>
                    @csrf
                    <!-- inputs -->
                    <h6 class="heading-small text-muted mb-3">{{ __('Informações cadastrais') }}</h6>
                    <div class="row">
                        <!-- id -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="id-edit-company">{{ __('ID') }}</label>
                                <div class="input-group input-group-merge validate-id-edit-company">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('id_edit_company') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('id do usuário') }}">*</span>
                                    <input readonly type="number" id="id-edit-company" name="id_edit_company" class="form-control {{ $errors->has('id_edit_company') ? 'is-invalid' : '' }}" placeholder="{{ __('ID do usuário') }}" value="{{ old('id_edit_company') }}" maxlength="20" required onkeypress="return soNumeros(event);" @if ($errors->has('id_edit_company')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('id_edit_company'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('id_edit_company') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- logo -->
                        <div class="col-lg-2 mt-1 mb--4 mb-lg--5">
                            <div class="form-group">
                                <div class="input-group-none validate-fe-image-5-company">
                                    <!-- botão de remover foto -->
                                    <div class="fe-remove-preview-5 fe-remove-preview-small">
                                        <i class="far fa-times-circle"></i>
                                    </div>
                                    <!-- imagem do perfil estilizada -->
                                    <div class="fe-grid-preview-5">
                                        <div class="fe-grid-preview-item-5 fe-preview-small">
                                            <div class="fe-preview-5 fe-preview-small fe-default-logo">
                                                <img class="fe-img-preview-5 fe-img-preview-cover" src="" alt="">
                                            </div>
                                            <div class="fe-grid-preview-text-5 text-monospace small">
                                                <span>Selecionar</span>
                                                <p>Logo</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- alerta de erro -->
                                    @if ($errors->has('image_5'))
                                        <div class="invalid-feedback" role="alert">{{ $errors->first('image_5') }}</div>
                                    @endif
                                    <!-- arquivo do perfil oculto -->
                                    <input type="file" id="fe-image-5-company" name="image_5" class="fe-image-5" accept="image/jpg, image/jpeg, image/png, image/gif">
                                    <label for="fe-image-url-5-company"></label>
                                    <input type="text" id="fe-image-url-5-company" name="logo_edit_company" class="fe-image-url-5" value="">
                                </div>
                            </div>
                        </div>
                        <!-- nome fantasia -->
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="form-control-label" for="name-edit-company">{{ __('Nome fantasia') }}</label>
                                <div class="input-group input-group-merge validate-name-edit-company">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('name_edit_company') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-hotel"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                    <input type="text" id="name-edit-company" name="name_edit_company" class="form-control {{ $errors->has('name_edit_company') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome fantasia do condomínio') }}" value="{{ old('name_edit_company') }}" minlength="3" maxlength="191" required onkeypress="return soLetrasCaracteres(event);" onkeyup="letraMaiuscula('name-edit-company');" @if ($errors->has('name_edit_company')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_edit_company'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_edit_company') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- razão social -->
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="form-control-label" for="corporate-name-edit-company">{{ __('Razão social') }}</label>
                                <div class="input-group input-group-merge validate-corporate-name-edit-company">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('corporate_name_edit_company') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-hotel"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                    <input type="text" id="corporate-name-edit-company" name="corporate_name_edit_company" class="form-control {{ $errors->has('corporate_name_edit_company') ? 'is-invalid' : '' }}" placeholder="{{ __('Razão social do condomínio') }}" value="{{ old('corporate_name_edit_company') }}" minlength="3" maxlength="191" required onkeypress="return soLetrasCaracteres(event);" onkeyup="letraMaiuscula('corporate-name-edit-company');" @if ($errors->has('corporate_name_edit_company')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('corporate_name_edit_company'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('corporate_name_edit_company') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- cnpj -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="cnpj-edit-company">{{ __('CNPJ') }}</label>
                                <div class="input-group input-group-merge validate-cnpj-edit-company">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('cnpj_edit_company') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-credit-card"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('cnpj válido de 14 dígitos') }}">*</span>
                                    <input type="tel" id="cnpj-edit-company" name="cnpj_edit_company" class="form-control mask-cnpj {{ $errors->has('cnpj_edit_company') ? 'is-invalid' : '' }}" placeholder="{{ __('CNPJ do condomínio') }}" value="{{ old('cnpj_edit_company') }}" minlength="18" maxlength="18" required @if ($errors->has('cnpj_edit_company')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('cnpj_edit_company'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('cnpj_edit_company') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- e-mail -->
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="form-control-label" for="email-edit-company">{{ __('E-mail') }}</label>
                                <div class="input-group input-group-merge validate-email-edit-company">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('email_edit_company') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('e-mail válido') }}">*</span>
                                    <input type="email" id="email-edit-company" name="email_edit_company" class="form-control {{ $errors->has('email_edit_company') ? 'is-invalid' : '' }}" placeholder="{{ __('E-mail') }}" value="{{ old('email_edit_company') }}" maxlength="191" @if ($errors->has('email_edit_company')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('email_edit_company'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('email_edit_company') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- contato -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label" for="contact-edit-company">{{ __('Contato') }}</label>
                                <div class="input-group input-group-merge validate-contact-edit-company">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('contact_edit_company') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-phone"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('número do celular com o ddd e 9º dígito') }}">*</span>
                                    <input type="tel" id="contact-edit-company" name="contact_edit_company" class="form-control mask-phones {{ $errors->has('contact_edit_company') ? 'is-invalid' : '' }}" placeholder="{{ __('(xx) xxxxx-xxxx') }}" value="{{ old('contact_edit_company') }}" minlength="14" maxlength="15" @if ($errors->has('contact_edit_company')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('contact_edit_company'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('contact_edit_company') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <h6 class="heading-small text-muted mb-3">{{ __('Informações residenciais') }}</h6>
                    <div class="row">
                        <!-- cep -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label" for="postal-code-edit-company">{{ __('CEP') }}</label>
                                <div class="input-group input-group-merge validate-postal-code-edit-company">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('postal_code_edit_company') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-tag"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('cep válido') }}">*</span>
                                    <input type="tel" id="postal-code-edit-company" name="postal_code_edit_company" class="form-control mask-cep {{ $errors->has('postal_code_edit_company') ? 'is-invalid' : '' }}" placeholder="{{ __('CEP') }}" value="{{ old('postal_code_edit_company') }}" minlength="9" maxlength="9" required onkeyup="viacepCompanyEdit(this.value);" onclick="viacepCompanyEdit(this.value);" @if ($errors->has('postal_code_edit_company')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('postal_code_edit_company'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('postal_code_edit_company') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- endereço -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="address-edit-company">{{ __('Endereço') }}</label>
                                <div class="input-group input-group-merge validate-address-edit-company">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('address_edit_company') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                    <input type="text" id="address-edit-company" name="address_edit_company" class="form-control {{ $errors->has('address_edit_company') ? 'is-invalid' : '' }}" placeholder="{{ __('Endereço') }}" value="{{ old('address_edit_company') }}" minlength="3" maxlength="191" required onkeyup="letraMaiuscula('address-edit-company');" @if ($errors->has('address_edit_company')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('address_edit_company'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('address_edit_company') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- nº -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label" for="house-number-edit-company">{{ __('nº') }}</label>
                                <div class="input-group input-group-merge validate-house-number-edit-company">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('house_number_edit_company') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-map-signs"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('nº da residência') }}">*</span>
                                    <input type="text" id="house-number-edit-company" name="house_number_edit_company" class="form-control {{ $errors->has('house_number_edit_company') ? 'is-invalid' : '' }}" placeholder="{{ __('nº') }}" value="{{ old('house_number_edit_company') }}" maxlength="191" @if ($errors->has('house_number_edit_company')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('house_number_edit_company'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('house_number_edit_company') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- complemento -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="complement-edit-company">{{ __('Complemento') }}</label>
                                <div class="input-group input-group-merge validate-complement-edit-company">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('complement_edit_company') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-plus-circle"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                    <input type="text" id="complement-edit-company" name="complement_edit_company" class="form-control {{ $errors->has('complement_edit_company') ? 'is-invalid' : '' }}" placeholder="{{ __('Complemento') }}" value="{{ old('complement_edit_company') }}" minlength="3" maxlength="191" onkeyup="primeiraLetraMaiuscula(this);" @if ($errors->has('complement_edit_company')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('complement_edit_company'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('complement_edit_company') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- bairro -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="neighborhood-edit-company">{{ __('Bairro') }}</label>
                                <div class="input-group input-group-merge validate-neighborhood-edit-company">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('neighborhood_edit_company') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-map-marked-alt"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                    <input type="text" id="neighborhood-edit-company" name="neighborhood_edit_company" class="form-control {{ $errors->has('neighborhood_edit_company') ? 'is-invalid' : '' }}" placeholder="{{ __('Bairro') }}" value="{{ old('neighborhood_edit_company') }}" minlength="3" maxlength="191" required onkeyup="letraMaiuscula('neighborhood-edit-company');" @if ($errors->has('neighborhood_edit_company')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('neighborhood_edit_company'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('neighborhood_edit_company') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- cidade -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="city-edit-company">{{ __('Cidade') }}</label>
                                <div class="input-group input-group-merge validate-city-edit-company">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('city_edit_company') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-city"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                    <input type="text" id="city-edit-company" name="city_edit_company" class="form-control {{ $errors->has('city_edit_company') ? 'is-invalid' : '' }}" placeholder="{{ __('Cidade') }}" value="{{ old('city_edit_company') }}" onkeypress="return soLetras(event);" minlength="3" maxlength="191" required onkeyup="letraMaiuscula('city-edit-company');" @if ($errors->has('city_edit_company')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('city_edit_company'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('city_edit_company') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- estado -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="state-id-edit-company">{{ __('Estado') }}</label>
                                <div class="input-group-none validate-state-id-edit-company">
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('selecione o estado') }}">*</span>
                                    {{ Form::select(
                                        "name",
                                        \App\Models\State::getStatesOptions(),
                                        old("state_id_edit_company"),
                                        ["id" => "state-id-edit-company", "name" => "state_id_edit_company", "class" => "form-control", "placeholder" => "Selecione", "required"]
                                    )}}
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('state_id_edit_company'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('state_id_edit_company') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- país -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="country-edit-company">{{ __('País') }}</label>
                                <div class="input-group input-group-merge validate-country-edit-company">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('country_edit_company') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-globe-americas"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                    <input type="text" id="country-edit-company" name="country_edit_company" class="form-control {{ $errors->has('country_edit_company') ? 'is-invalid' : '' }}" placeholder="{{ __('País') }}" value="{{ old('country_edit_company') }}" onkeypress="return soLetras(event);" minlength="3" maxlength="191" required onkeyup="letraMaiuscula('country-edit-company');" @if ($errors->has('country_edit_company')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('country_edit_company'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('country_edit_company') }}</div>
                                @endif
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
                            <small class="text-light">{{ __('ao realizar uma edição de condomínio, se houver um endereço de e-mail cadastrado no condomínio o e-mail irá receber uma notificação de e-mail com os dados alterados') }}</small>
                        </div>
                    </div>
                    <!-- botões -->
                    <div class="text-right float-right fe-form-footer">
                        <a href="javascript:void(0)" class="mr-4" data-dismiss="modal">{{ __('Cancelar') }}</a>
                        @if (app('router')->has('company.update') && \App\Models\Permission::routePermission('company.update'))
                            <button type="submit" id="btn-edit-company" class="btn btn-outline-success mr-4">{{ __('Editar condomínio') }}</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
