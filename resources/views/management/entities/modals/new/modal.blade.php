<div id="modal-new-entity" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-new-entity-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <!-- título -->
            <div class="modal-header">
                <h5 id="modal-new-entity-label" class="modal-title text-uppercase text-monospace ml-1">
                    <b>{{ __('Novo condomínio') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- form -->
                <form id="form-new-entity" role="form" autocomplete="off" novalidate>
                    @csrf
                    <!-- inputs -->
                    <h6 class="heading-small text-muted mb-3">{{ __('Informações') }}</h6>
                    <div class="row">
                        <!-- logo -->
                        <div class="col-lg-2 mt-1">
                            <div class="form-group">
                                <div class="input-group-none validate-image-logo-new-entity">
                                    <!-- botão de remover foto -->
                                    <div class="fe-remove-preview-4 fe-remove-preview-small">
                                        <i class="far fa-times-circle"></i>
                                    </div>
                                    <!-- imagem do perfil estilizada -->
                                    <div class="fe-grid-preview-4">
                                        <div class="fe-grid-preview-item-4 fe-preview-small">
                                            <div class="fe-img-center fe-preview-4 fe-preview-small fe-default-logo">
                                                <img class="fe-img-preview-4 fe-img-preview-cover" src="" alt="">
                                            </div>
                                            <div class="fe-grid-preview-text-4 text-monospace small">
                                                <span>Selecionar</span>
                                                <p>Logo</p>
                                            </div>
                                            <!-- arquivo do perfil oculto -->
                                            <input type="file" id="image-logo-new-entity" name="image_logo_new_entity" class="fe-image-4" accept="image/jpg, image/jpeg, image/png, image/gif">
                                            <label for="logo-new-entity"></label>
                                            <input type="text" id="logo-new-entity" name="logo_new_entity" class="fe-image-url-4" value="">
                                        </div>
                                    </div>
                                    <!-- alerta de erro -->
                                    @if ($errors->has('image_logo_new_entity'))
                                        <div class="invalid-feedback" role="alert">{{ $errors->first('image_logo_new_entity') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- nome fantasia -->
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="form-control-label" for="name-new-entity">{{ __('Nome fantasia') }}</label>
                                <div class="input-group input-group-merge validate-name-new-entity">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('name_new_entity') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-hotel"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                    <input type="text" id="name-new-entity" name="name_new_entity" class="form-control {{ $errors->has('name_new_entity') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome fantasia do condomínio') }}" value="{{ old('name_new_entity') }}" minlength="3" maxlength="191" required onkeypress="return onlyLettersCharacters(event);" onkeyup="letterUppercase('name-new-entity');" @if ($errors->has('name_new_entity')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_new_entity'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_new_entity') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- razão social -->
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="form-control-label" for="corporate-name-new-entity">{{ __('Razão social') }}</label>
                                <div class="input-group input-group-merge validate-corporate-name-new-entity">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('corporate_name_new_entity') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-hotel"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                    <input type="text" id="corporate-name-new-entity" name="corporate_name_new_entity" class="form-control {{ $errors->has('corporate_name_new_entity') ? 'is-invalid' : '' }}" placeholder="{{ __('Razão social do condomínio') }}" value="{{ old('corporate_name_new_entity') }}" minlength="3" maxlength="191" required onkeypress="return onlyLettersCharacters(event);" onkeyup="letterUppercase('corporate-name-new-entity');" @if ($errors->has('corporate_name_new_entity')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('corporate_name_new_entity'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('corporate_name_new_entity') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- cnpj -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="cnpj-new-entity">{{ __('CNPJ') }}</label>
                                <div class="input-group input-group-merge validate-cnpj-new-entity">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('cnpj_new_entity') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-credit-card"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('cnpj válido de 14 dígitos') }}">*</span>
                                    <input type="tel" id="cnpj-new-entity" name="cnpj_new_entity" class="form-control mask-cnpj {{ $errors->has('cnpj_new_entity') ? 'is-invalid' : '' }}" placeholder="{{ __('CNPJ do condomínio') }}" value="{{ old('cnpj_new_entity') }}" minlength="18" maxlength="18" required @if ($errors->has('cnpj_new_entity')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('cnpj_new_entity'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('cnpj_new_entity') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- e-mail -->
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="form-control-label" for="email-new-entity">{{ __('E-mail') }}</label>
                                <div class="input-group input-group-merge validate-email-new-entity">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('email_new_entity') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('e-mail válido') }}">*</span>
                                    <input type="email" id="email-new-entity" name="email_new_entity" class="form-control {{ $errors->has('email_new_entity') ? 'is-invalid' : '' }}" placeholder="{{ __('E-mail') }}" value="{{ old('email_new_entity') }}" maxlength="191" @if ($errors->has('email_new_entity')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('email_new_entity'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('email_new_entity') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- telefone -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label" for="contact-new-entity">{{ __('Telefone') }}</label>
                                <div class="input-group input-group-merge validate-contact-new-entity">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('contact_new_entity') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-phone"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('número do celular com o ddd e 9º dígito') }}">*</span>
                                    <input type="tel" id="contact-new-entity" name="contact_new_entity" class="form-control mask-phones {{ $errors->has('contact_new_entity') ? 'is-invalid' : '' }}" placeholder="{{ __('(xx) xxxxx-xxxx') }}" value="{{ old('contact_new_entity') }}" minlength="14" maxlength="15" @if ($errors->has('contact_new_entity')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('contact_new_entity'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('contact_new_entity') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <h6 class="heading-small text-muted mb-3">{{ __('Localização') }}</h6>
                    <div class="row">
                        <!-- cep -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label" for="postal-code-new-entity">{{ __('CEP') }}</label>
                                <div class="input-group input-group-merge validate-postal-code-new-entity">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('postal_code_new_entity') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-tag"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('cep válido') }}">*</span>
                                    <input type="tel" id="postal-code-new-entity" name="postal_code_new_entity" class="form-control mask-cep {{ $errors->has('postal_code_new_entity') ? 'is-invalid' : '' }}" placeholder="{{ __('CEP') }}" value="{{ old('postal_code_new_entity') }}" minlength="9" maxlength="9" required onkeyup="viacepRequired(this.value, '-new-entity');" onclick="viacepRequired(this.value, '-new-entity');" @if ($errors->has('postal_code_new_entity')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('postal_code_new_entity'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('postal_code_new_entity') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- endereço -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="address-new-entity">{{ __('Endereço') }}</label>
                                <div class="input-group input-group-merge validate-address-new-entity">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('address_new_entity') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                    <input type="text" id="address-new-entity" name="address_new_entity" class="form-control {{ $errors->has('address_new_entity') ? 'is-invalid' : '' }}" placeholder="{{ __('Endereço') }}" value="{{ old('address_new_entity') }}" minlength="3" maxlength="191" required onkeyup="letterUppercase('address-new-entity');" @if ($errors->has('address_new_entity')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('address_new_entity'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('address_new_entity') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- nº -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label" for="house-number-new-entity">{{ __('nº') }}</label>
                                <div class="input-group input-group-merge validate-house-number-new-entity">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('house_number_new_entity') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-map-signs"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('nº da residência') }}">*</span>
                                    <input type="text" id="house-number-new-entity" name="house_number_new_entity" class="form-control {{ $errors->has('house_number_new_entity') ? 'is-invalid' : '' }}" placeholder="{{ __('nº') }}" value="{{ old('house_number_new_entity') }}" maxlength="191" @if ($errors->has('house_number_new_entity')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('house_number_new_entity'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('house_number_new_entity') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- complemento -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="complement-new-entity">{{ __('Complemento') }}</label>
                                <div class="input-group input-group-merge validate-complement-new-entity">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('complement_new_entity') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-plus-circle"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                    <input type="text" id="complement-new-entity" name="complement_new_entity" class="form-control {{ $errors->has('complement_new_entity') ? 'is-invalid' : '' }}" placeholder="{{ __('Complemento') }}" value="{{ old('complement_new_entity') }}" minlength="3" maxlength="191" onkeyup="firstLetterUppercase(this);" @if ($errors->has('complement_new_entity')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('complement_new_entity'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('complement_new_entity') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- bairro -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="neighborhood-new-entity">{{ __('Bairro') }}</label>
                                <div class="input-group input-group-merge validate-neighborhood-new-entity">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('neighborhood_new_entity') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-map-marked-alt"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                    <input type="text" id="neighborhood-new-entity" name="neighborhood_new_entity" class="form-control {{ $errors->has('neighborhood_new_entity') ? 'is-invalid' : '' }}" placeholder="{{ __('Bairro') }}" value="{{ old('neighborhood_new_entity') }}" minlength="3" maxlength="191" required onkeyup="letterUppercase('neighborhood-new-entity');" @if ($errors->has('neighborhood_new_entity')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('neighborhood_new_entity'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('neighborhood_new_entity') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- cidade -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="city-new-entity">{{ __('Cidade') }}</label>
                                <div class="input-group input-group-merge validate-city-new-entity">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('city_new_entity') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-city"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                    <input type="text" id="city-new-entity" name="city_new_entity" class="form-control {{ $errors->has('city_new_entity') ? 'is-invalid' : '' }}" placeholder="{{ __('Cidade') }}" value="{{ old('city_new_entity') }}" onkeypress="return onlyLetters(event);" minlength="3" maxlength="191" required onkeyup="letterUppercase('city-new-entity');" @if ($errors->has('city_new_entity')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('city_new_entity'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('city_new_entity') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- estado -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="state-id-new-entity">{{ __('Estado') }}</label>
                                <div class="input-group-none validate-state-id-new-entity">
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('selecione o estado') }}">*</span>
                                    {{ Form::select(
                                        "name",
                                        \App\Models\State::getStatesOptions(),
                                        old("state_id_new_entity"),
                                        ["id" => "state-id-new-entity", "name" => "state_id_new_entity", "class" => "form-control", "placeholder" => "Selecione", "required"]
                                    )}}
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('state_id_new_entity'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('state_id_new_entity') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- país -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="country-new-entity">{{ __('País') }}</label>
                                <div class="input-group input-group-merge validate-country-new-entity">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('country_new_entity') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-globe-americas"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                    <input type="text" id="country-new-entity" name="country_new_entity" class="form-control {{ $errors->has('country_new_entity') ? 'is-invalid' : '' }}" placeholder="{{ __('País') }}" value="{{ old('country_new_entity') }}" onkeypress="return onlyLetters(event);" minlength="3" maxlength="191" required onkeyup="letterUppercase('country-new-entity');" @if ($errors->has('country_new_entity')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('country_new_entity'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('country_new_entity') }}</div>
                                @endif
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
                            <small class="text-light">{{ __('ao adicionar um endereço de e-mail no condomínio o e-mail informado irá receber uma notificação de e-mail com os dados do condomínio criado') }}</small>
                        </div>
                    </div>
                    <!-- botões -->
                    <div class="text-right float-right fe-form-footer">
                        <a href="javascript:void(0)" class="mr-4" data-dismiss="modal">{{ __('Cancelar') }}</a>
                        <button type="submit" id="btn-new-entity" class="btn btn-outline-success mr-4">{{ __('Criar condomínio') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
