<!-- curso -->
<div class="col-lg-6">
    <div class="form-group">
        <label class="form-control-label" for="course-edit-profile">{{ __('Curso') }}</label>
        <div class="input-group input-group-merge validate-course-edit-profile">
            <div class="input-group-prepend">
                <span class="input-group-text {{ $errors->has('course_edit_profile') ? 'is-invalid' : '' }}">
                    <i class="fas fa-graduation-cap"></i>
                </span>
            </div>
            <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
            <input type="text" id="course-edit-profile" name="course_edit_profile" class="form-control {{ $errors->has('course_edit_profile') ? 'is-invalid' : '' }}" placeholder="{{ __('Curso') }}" value="{{ old('course_edit_profile', auth()->user()['course']) }}" minlength="3" maxlength="191" onkeyup="letraMaiuscula('course-edit-profile');" @if ($errors->has('course_edit_profile')) autofocus @endif>
        </div>
        <!-- alerta de erro -->
        @if ($errors->has('course_edit_profile'))
            <div class="invalid-feedback" role="alert">{{ $errors->first('course_edit_profile') }}</div>
        @endif
    </div>
</div>
<!-- faculdade -->
<div class="col-lg-6">
    <div class="form-group">
        <label class="form-control-label" for="college-edit-profile">{{ __('Faculdade') }}</label>
        <div class="input-group input-group-merge validate-college-edit-profile">
            <div class="input-group-prepend">
                <span class="input-group-text {{ $errors->has('college_edit_profile') ? 'is-invalid' : '' }}">
                    <i class="fas fa-university"></i>
                </span>
            </div>
            <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
            <input type="text" id="college-edit-profile" name="college_edit_profile" class="form-control {{ $errors->has('college_edit_profile') ? 'is-invalid' : '' }}" placeholder="{{ __('Faculdade') }}" value="{{ old('college_edit_profile', auth()->user()['college']) }}" minlength="3" maxlength="191" onkeyup="letraMaiuscula('college-edit-profile');" @if ($errors->has('college_edit_profile')) autofocus @endif>
        </div>
        <!-- alerta de erro -->
        @if ($errors->has('college_edit_profile'))
            <div class="invalid-feedback" role="alert">{{ $errors->first('college_edit_profile') }}</div>
        @endif
    </div>
</div>
