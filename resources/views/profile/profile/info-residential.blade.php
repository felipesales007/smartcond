<!-- cep -->
<div class="col-lg-3">
    <div class="form-group">
        <label class="form-control-label" for="postal-code-edit-profile">{{ __('CEP') }}</label>
        <div class="input-group input-group-merge validate-postal-code-edit-profile">
            <div class="input-group-prepend">
                <span class="input-group-text {{ $errors->has('postal_code_edit_profile') ? 'is-invalid' : '' }}">
                    <i class="fas fa-tag"></i>
                </span>
            </div>
            <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('cep válido') }}">*</span>
            <input type="tel" id="postal-code-edit-profile" name="postal_code_edit_profile" class="form-control mask-cep {{ $errors->has('postal_code_edit_profile') ? 'is-invalid' : '' }}" placeholder="{{ __('CEP') }}" value="{{ old('postal_code_edit_profile', auth()->user()['postal_code']) }}" minlength="9" maxlength="9" onkeyup="viacepProfileEdit(this.value);" onclick="viacepProfileEdit(this.value);" @if ($errors->has('postal_code_edit_profile')) autofocus @endif>
        </div>
        <!-- alerta de erro -->
        @if ($errors->has('postal_code_edit_profile'))
            <div class="invalid-feedback" role="alert">{{ $errors->first('postal_code_edit_profile') }}</div>
        @endif
    </div>
</div>
<!-- endereço -->
<div class="col-lg-7">
    <div class="form-group">
        <label class="form-control-label" for="address-edit-profile">{{ __('Endereço') }}</label>
        <div class="input-group input-group-merge validate-address-edit-profile">
            <div class="input-group-prepend">
                <span class="input-group-text {{ $errors->has('address_edit_profile') ? 'is-invalid' : '' }}">
                    <i class="fas fa-map-marker-alt"></i>
                </span>
            </div>
            <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
            <input type="text" id="address-edit-profile" name="address_edit_profile" class="form-control {{ $errors->has('address_edit_profile') ? 'is-invalid' : '' }}" placeholder="{{ __('Endereço') }}" value="{{ old('address_edit_profile', auth()->user()['address']) }}" minlength="3" maxlength="191" onkeyup="letraMaiuscula('address-edit-profile');" @if ($errors->has('address_edit_profile')) autofocus @endif>
        </div>
        <!-- alerta de erro -->
        @if ($errors->has('address_edit_profile'))
            <div class="invalid-feedback" role="alert">{{ $errors->first('address_edit_profile') }}</div>
        @endif
    </div>
</div>
<!-- nº -->
<div class="col-lg-2">
    <div class="form-group">
        <label class="form-control-label" for="house-number-edit-profile">{{ __('nº') }}</label>
        <div class="input-group input-group-merge validate-house-number-edit-profile">
            <div class="input-group-prepend">
                <span class="input-group-text {{ $errors->has('house_number_edit_profile') ? 'is-invalid' : '' }}">
                    <i class="fas fa-map-signs"></i>
                </span>
            </div>
            <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('nº da residência') }}">*</span>
            <input type="text" id="house-number-edit-profile" name="house_number_edit_profile" class="form-control {{ $errors->has('house_number_edit_profile') ? 'is-invalid' : '' }}" placeholder="{{ __('nº') }}" value="{{ old('house_number_edit_profile', auth()->user()['house_number']) }}" maxlength="191" @if ($errors->has('house_number_edit_profile')) autofocus @endif>
        </div>
        <!-- alerta de erro -->
        @if ($errors->has('house_number_edit_profile'))
            <div class="invalid-feedback" role="alert">{{ $errors->first('house_number_edit_profile') }}</div>
        @endif
    </div>
</div>
<!-- complemento -->
<div class="col-lg-6">
    <div class="form-group">
        <label class="form-control-label" for="complement-edit-profile">{{ __('Complemento') }}</label>
        <div class="input-group input-group-merge validate-complement-edit-profile">
            <div class="input-group-prepend">
                <span class="input-group-text {{ $errors->has('complement_edit_profile') ? 'is-invalid' : '' }}">
                    <i class="fas fa-plus-circle"></i>
                </span>
            </div>
            <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
            <input type="text" id="complement-edit-profile" name="complement_edit_profile" class="form-control {{ $errors->has('complement_edit_profile') ? 'is-invalid' : '' }}" placeholder="{{ __('Complemento') }}" value="{{ old('complement_edit_profile', auth()->user()['complement']) }}" minlength="3" maxlength="191" onkeyup="primeiraLetraMaiuscula(this);" @if ($errors->has('complement_edit_profile')) autofocus @endif>
        </div>
        <!-- alerta de erro -->
        @if ($errors->has('complement_edit_profile'))
            <div class="invalid-feedback" role="alert">{{ $errors->first('complement_edit_profile') }}</div>
        @endif
    </div>
</div>
<!-- bairro -->
<div class="col-lg-6">
    <div class="form-group">
        <label class="form-control-label" for="neighborhood-edit-profile">{{ __('Bairro') }}</label>
        <div class="input-group input-group-merge validate-neighborhood-edit-profile">
            <div class="input-group-prepend">
                <span class="input-group-text {{ $errors->has('neighborhood_edit_profile') ? 'is-invalid' : '' }}">
                    <i class="fas fa-map-marked-alt"></i>
                </span>
            </div>
            <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
            <input type="text" id="neighborhood-edit-profile" name="neighborhood_edit_profile" class="form-control {{ $errors->has('neighborhood_edit_profile') ? 'is-invalid' : '' }}" placeholder="{{ __('Bairro') }}" value="{{ old('neighborhood_edit_profile', auth()->user()['neighborhood']) }}" minlength="3" maxlength="191" onkeyup="letraMaiuscula('neighborhood-edit-profile');" @if ($errors->has('neighborhood_edit_profile')) autofocus @endif>
        </div>
        <!-- alerta de erro -->
        @if ($errors->has('neighborhood_edit_profile'))
            <div class="invalid-feedback" role="alert">{{ $errors->first('neighborhood_edit_profile') }}</div>
        @endif
    </div>
</div>
<!-- cidade -->
<div class="col-lg-4">
    <div class="form-group">
        <label class="form-control-label" for="city-edit-profile">{{ __('Cidade') }}</label>
        <div class="input-group input-group-merge validate-city-edit-profile">
            <div class="input-group-prepend">
                <span class="input-group-text {{ $errors->has('city_edit_profile') ? 'is-invalid' : '' }}">
                    <i class="fas fa-city"></i>
                </span>
            </div>
            <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
            <input type="text" id="city-edit-profile" name="city_edit_profile" class="form-control {{ $errors->has('city_edit_profile') ? 'is-invalid' : '' }}" placeholder="{{ __('Cidade') }}" value="{{ old('city_edit_profile', auth()->user()['city']) }}" onkeypress="return soLetras(event);" minlength="3" maxlength="191" onkeyup="letraMaiuscula('city-edit-profile');" @if ($errors->has('city_edit_profile')) autofocus @endif>
        </div>
        <!-- alerta de erro -->
        @if ($errors->has('city_edit_profile'))
            <div class="invalid-feedback" role="alert">{{ $errors->first('city_edit_profile') }}</div>
        @endif
    </div>
</div>
<!-- estado -->
<div class="col-lg-4">
    <div class="form-group">
        <label class="form-control-label" for="state-id-edit-profile">{{ __('Estado') }}</label>
        <div class="input-group-none validate-state-id-edit-profile">
            <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('selecione o estado') }}">*</span>
            {{ Form::select(
                "name",
                \App\Models\State::getStatesOptions(),
                old("state_id_edit_profile", auth()->user()['state_id']),
                ["id" => "state-id-edit-profile", "name" => "state_id_edit_profile", "class" => "form-control", "placeholder" => "Selecione"]
            )}}
        </div>
        <!-- alerta de erro -->
        @if ($errors->has('state_id_edit_profile'))
            <div class="invalid-feedback" role="alert">{{ $errors->first('state_id_edit_profile') }}</div>
        @endif
    </div>
</div>
<!-- país -->
<div class="col-lg-4">
    <div class="form-group">
        <label class="form-control-label" for="country-edit-profile">{{ __('País') }}</label>
        <div class="input-group input-group-merge validate-country-edit-profile">
            <div class="input-group-prepend">
                <span class="input-group-text {{ $errors->has('country_edit_profile') ? 'is-invalid' : '' }}">
                    <i class="fas fa-globe-americas"></i>
                </span>
            </div>
            <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
            <input type="text" id="country-edit-profile" name="country_edit_profile" class="form-control {{ $errors->has('country_edit_profile') ? 'is-invalid' : '' }}" placeholder="{{ __('País') }}" value="{{ old('country_edit_profile', auth()->user()['country']) }}" onkeypress="return soLetras(event);" minlength="3" maxlength="191" onkeyup="letraMaiuscula('country-edit-profile');" @if ($errors->has('country_edit_profile')) autofocus @endif>
        </div>
        <!-- alerta de erro -->
        @if ($errors->has('country_edit_profile'))
            <div class="invalid-feedback" role="alert">{{ $errors->first('country_edit_profile') }}</div>
        @endif
    </div>
</div>
