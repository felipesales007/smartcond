<!-- profissão -->
<div class="col-lg-6">
    <div class="form-group">
        <label class="form-control-label" for="profession-edit-profile">{{ __('Profissão') }}</label>
        <div class="input-group input-group-merge validate-profession-edit-profile">
            <div class="input-group-prepend">
                <span class="input-group-text {{ $errors->has('profession_edit_profile') ? 'is-invalid' : '' }}">
                    <i class="fas fa-briefcase"></i>
                </span>
            </div>
            <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
            <input type="text" id="profession-edit-profile" name="profession_edit_profile" class="form-control {{ $errors->has('profession_edit_profile') ? 'is-invalid' : '' }}" placeholder="{{ __('Profissão') }}" value="{{ old('profession_edit_profile', auth()->user()['profession']) }}" minlength="3" maxlength="191" onkeyup="letraMaiuscula('profession-edit-profile');" @if ($errors->has('profession_edit_profile')) autofocus @endif>
        </div>
        <!-- alerta de erro -->
        @if ($errors->has('profession_edit_profile'))
            <div class="invalid-feedback" role="alert">{{ $errors->first('profession_edit_profile') }}</div>
        @endif
    </div>
</div>
<!-- condomínio -->
<div class="col-lg-6">
    <div class="form-group">
        <label class="form-control-label" for="company-edit-profile">{{ __('Condomínio') }}</label>
        <div class="input-group input-group-merge validate-company-edit-profile">
            <div class="input-group-prepend">
                <span class="input-group-text {{ $errors->has('company_edit_profile') ? 'is-invalid' : '' }}">
                    <i class="fas fa-building"></i>
                </span>
            </div>
            <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
            <input type="text" id="company-edit-profile" name="company_edit_profile" class="form-control {{ $errors->has('company_edit_profile') ? 'is-invalid' : '' }}" placeholder="{{ __('Condomínio') }}" value="{{ old('company_edit_profile', auth()->user()['company']) }}" minlength="3" maxlength="191" onkeyup="letraMaiuscula('company-edit-profile');" @if ($errors->has('company_edit_profile')) autofocus @endif>
        </div>
        <!-- alerta de erro -->
        @if ($errors->has('company_edit_profile'))
            <div class="invalid-feedback" role="alert">{{ $errors->first('company_edit_profile') }}</div>
        @endif
    </div>
</div>
