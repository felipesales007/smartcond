<!-- id -->
<div hidden class="col-lg-12">
    <div class="form-group">
        <label class="form-control-label" for="id-edit-profile">{{ __('ID') }}</label>
        <div class="input-group input-group-merge validate-id-edit-profile">
            <div class="input-group-prepend">
                <span class="input-group-text bg-lighter {{ $errors->has('id_edit_profile') ? 'is-invalid' : '' }}">
                    <i class="fas fa-key"></i>
                </span>
            </div>
            <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('id do usuário') }}">*</span>
            <input readonly type="number" id="id-edit-profile" name="id_edit_profile" class="form-control {{ $errors->has('id_edit_profile') ? 'is-invalid' : '' }}" placeholder="{{ __('ID do usuário') }}" value="{{ old('id_edit_profile', auth()->user()['id']) }}" maxlength="20" required onkeypress="return soNumeros(event);" @if ($errors->has('id_edit_profile')) autofocus @endif>
        </div>
        <!-- alerta de erro -->
        @if ($errors->has('id_edit_profile'))
            <div class="invalid-feedback" role="alert">{{ $errors->first('id_edit_profile') }}</div>
        @endif
    </div>
</div>
<!-- nome -->
<div class="col-lg-12">
    <div class="form-group">
        <label class="form-control-label" for="name-edit-profile">{{ __('Nome') }}</label>
        <div class="input-group input-group-merge validate-name-edit-profile">
            <div class="input-group-prepend">
                <span class="input-group-text {{ $errors->has('name_edit_profile') ? 'is-invalid' : '' }}">
                    <i class="fas fa-user"></i>
                </span>
            </div>
            <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
            <input type="text" id="name-edit-profile" name="name_edit_profile" class="form-control {{ $errors->has('name_edit_profile') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome completo') }}" value="{{ old('name_edit_profile', auth()->user()['name']) }}" minlength="3" maxlength="191" required onkeypress="return soLetras(event);" onkeyup="letraMaiuscula('name-edit-profile');" @if ($errors->has('name_edit_profile')) autofocus @endif>
        </div>
        <!-- alerta de erro -->
        @if ($errors->has('name_edit_profile'))
            <div class="invalid-feedback" role="alert">{{ $errors->first('name_edit_profile') }}</div>
        @endif
    </div>
</div>
<!-- cpf -->
<div class="col-lg-6">
    <div class="form-group">
        <label class="form-control-label" for="cpf-edit-profile">{{ __('CPF') }}</label>
        <div class="input-group input-group-merge validate-cpf-edit-profile">
            <div class="input-group-prepend">
                <span class="input-group-text {{ $errors->has('cpf_edit_profile') ? 'is-invalid' : '' }}">
                    <i class="fas fa-credit-card"></i>
                </span>
            </div>
            <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('cpf válido de 11 dígitos') }}">*</span>
            <input type="tel" id="cpf-edit-profile" name="cpf_edit_profile" class="form-control mask-cpf {{ $errors->has('cpf_edit_profile') ? 'is-invalid' : '' }}" placeholder="{{ __('xxx.xxx.xxx-xx') }}" value="{{ old('cpf_edit_profile', auth()->user()['cpf']) }}" minlength="14" maxlength="14" @if ($errors->has('cpf_edit_profile')) autofocus @endif>
        </div>
        <!-- alerta de erro -->
        @if ($errors->has('cpf_edit_profile'))
            <div class="invalid-feedback" role="alert">{{ $errors->first('cpf_edit_profile') }}</div>
        @endif
    </div>
</div>
<!-- rg -->
<div class="col-lg-6">
    <div class="form-group">
        <label class="form-control-label" for="rg-edit-profile">{{ __('RG') }}</label>
        <div class="input-group input-group-merge validate-rg-edit-profile">
            <div class="input-group-prepend">
                <span class="input-group-text {{ $errors->has('rg_edit_profile') ? 'is-invalid' : '' }}">
                    <i class="far fa-id-card"></i>
                </span>
            </div>
            <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('rg válido') }}">*</span>
            <input type="tel" id="rg-edit-profile" name="rg_edit_profile" class="form-control {{ $errors->has('rg_edit_profile') ? 'is-invalid' : '' }}" placeholder="{{ __('RG') }}" value="{{ old('rg_edit_profile', auth()->user()['rg']) }}" minlength="8" maxlength="14" onkeypress="return soNumeros(event);" @if ($errors->has('rg_edit_profile')) autofocus @endif>
        </div>
        <!-- alerta de erro -->
        @if ($errors->has('rg_edit_profile'))
            <div class="invalid-feedback" role="alert">{{ $errors->first('rg_edit_profile') }}</div>
        @endif
    </div>
</div>
<!-- e-mail -->
<div class="col-lg-6">
    <div class="form-group">
        <label class="form-control-label" for="email-edit-profile">{{ __('E-mail') }}</label>
        <div class="input-group input-group-merge validate-email-edit-profile">
            <div class="input-group-prepend">
                <span class="input-group-text {{ $errors->has('email_edit_profile') ? 'is-invalid' : '' }}">
                    <i class="fas fa-envelope"></i>
                </span>
            </div>
            <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('e-mail válido') }}">*</span>
            <input type="email" id="email-edit-profile" name="email_edit_profile" class="form-control {{ $errors->has('email_edit_profile') ? 'is-invalid' : '' }}" placeholder="{{ __('E-mail') }}" value="{{ old('email_edit_profile', auth()->user()['email']) }}" maxlength="191" required @if ($errors->has('email_edit_profile')) autofocus @endif>
        </div>
        <!-- alerta de erro -->
        @if ($errors->has('email_edit_profile'))
            <div class="invalid-feedback" role="alert">{{ $errors->first('email_edit_profile') }}</div>
        @endif
    </div>
</div>
<!-- data de nascimento -->
<div class="col-lg-6">
    <div class="form-group">
        <label class="form-control-label" for="birthday-edit-profile">{{ __('Data de nascimento') }}</label>
        <div class="input-group input-group-merge validate-birthday-edit-profile">
            <div class="input-group-prepend">
                <span class="input-group-text {{ $errors->has('birthday_edit_profile') ? 'is-invalid' : '' }}">
                    <i class="fas fa-calendar-alt"></i>
                </span>
            </div>
            <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('data de nascimento válida') }}">*</span>
            <input type="tel" id="birthday-edit-profile" name="birthday_edit_profile" class="form-control datepicker-back mask-date {{ $errors->has('birthday_edit_profile') ? 'is-invalid' : '' }}" placeholder="{{ __('Informe a data') }}" value="{{ old('birthday_edit_profile', \App\Helpers\FormatHelpers::date_to_date_br(auth()->user()['birthday'])) }}" minlength="10" maxlength="10" @if ($errors->has('birthday_edit_profile')) autofocus @endif>
        </div>
        <!-- alerta de erro -->
        @if ($errors->has('birthday_edit_profile'))
            <div class="invalid-feedback" role="alert">{{ $errors->first('birthday_edit_profile') }}</div>
        @endif
    </div>
</div>
<!-- contato -->
<div class="col-lg-6">
    <div class="form-group">
        <label class="form-control-label" for="contact-edit-profile">{{ __('Contato') }}</label>
        <div class="input-group input-group-merge validate-contact-edit-profile">
            <div class="input-group-prepend">
                <span class="input-group-text {{ $errors->has('contact_edit_profile') ? 'is-invalid' : '' }}">
                    <i class="fas fa-phone"></i>
                </span>
            </div>
            <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('número do celular com o ddd e 9º dígito') }}">*</span>
            <input type="tel" id="contact-edit-profile" name="contact_edit_profile" class="form-control mask-phones {{ $errors->has('contact_edit_profile') ? 'is-invalid' : '' }}" placeholder="{{ __('(xx) xxxxx-xxxx') }}" value="{{ old('contact_edit_profile', auth()->user()['contact']) }}" minlength="14" maxlength="15" @if ($errors->has('contact_edit_profile')) autofocus @endif>
        </div>
        <!-- alerta de erro -->
        @if ($errors->has('contact_edit_profile'))
            <div class="invalid-feedback" role="alert">{{ $errors->first('contact_edit_profile') }}</div>
        @endif
    </div>
</div>
<!-- sexo -->
<div class="col-lg-6">
    <div class="form-group">
        <label class="form-control-label" for="gender-id-edit-profile">{{ __('Sexo') }}</label>
        <div class="input-group-none validate-gender-id-edit-profile">
            <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('selecione seu sexo') }}">*</span>
            {{ Form::select(
                "name",
                \App\Models\Gender::getGendersOptions(),
                old("gender_id_edit_profile", auth()->user()['gender_id']),
                ["id" => "gender-id-edit-profile", "name" => "gender_id_edit_profile", "class" => "form-control select-nosearch", "placeholder" => "Selecione"]
            )}}
        </div>
        <!-- alerta de erro -->
        @if ($errors->has('gender_id_edit_profile'))
            <div class="invalid-feedback" role="alert">{{ $errors->first('gender_id_edit_profile') }}</div>
        @endif
    </div>
</div>
<!-- descrição -->
<div class="col-lg-12">
    <div class="form-group">
        <label class="form-control-label" for="description-edit-profile">{{ __('Descrição') }}</label>
        <div class="input-group-none validate-description-edit-profile">
            <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('descrição sobre você com no mínimo 10 caracteres') }}">*</span>
            <textarea id="description-edit-profile" name="description_edit_profile" rows="3" resize="none" class="form-control {{ $errors->has('description_edit_profile') ? 'is-invalid' : '' }}" placeholder="{{ __('Descrição') }}" minlength="10" maxlength="1500" onkeyup="primeiraLetraMaiuscula(this);" @if ($errors->has('description_edit_profile')) autofocus @endif>{{ old('description_edit_profile', auth()->user()['description']) }}</textarea>
        </div>
        <!-- alerta de erro -->
        @if ($errors->has('description_edit_profile'))
            <div class="invalid-feedback" role="alert">{{ $errors->first('description_edit_profile') }}</div>
        @endif
    </div>
</div>
