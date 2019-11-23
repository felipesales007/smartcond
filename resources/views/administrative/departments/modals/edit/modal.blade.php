<div id="modal-edit-department" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-edit-department-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <!-- título -->
            <div class="modal-header">
                <h5 id="modal-edit-department-label" class="modal-title text-uppercase text-monospace ml-1">
                    <b>{{ __('Editar departamento') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- form -->
                <form id="form-edit-department" role="form" autocomplete="off" novalidate>
                    @csrf
                    <!-- inputs -->
                    <div class="row">
                        <!-- id -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="id-edit-department">{{ __('ID') }}</label>
                                <div class="input-group input-group-merge validate-id-edit-department">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('id_edit_department') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('id do departamento') }}">*</span>
                                    <input readonly type="number" id="id-edit-department" name="id_edit_department" class="form-control {{ $errors->has('id_edit_department') ? 'is-invalid' : '' }}" placeholder="{{ __('ID do departamento') }}" value="{{ old('id_edit_department') }}" maxlength="20" required onkeypress="return onlyNumbers(event);" @if ($errors->has('id_edit_department')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('id_edit_department'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('id_edit_department') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- nome -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="name-edit-department">{{ __('Nome do departamento') }}</label>
                                <div class="input-group input-group-merge validate-name-edit-department">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('name_edit_department') ? 'is-invalid' : '' }}">
                                            <i class="far fa-building"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                    <input type="text" id="name-edit-department" name="name_edit_department" class="form-control {{ $errors->has('name_edit_department') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome do departamento') }}" value="{{ old('name_edit_department') }}" minlength="3" maxlength="191" required onkeypress="return onlyLettersCharacters(event);" onkeyup="letterUppercase('name-edit-department');" @if ($errors->has('name_edit_department')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_edit_department'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_edit_department') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- descrição -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="description-edit-department">{{ __('Descrição') }}</label>
                                <div class="input-group-none validate-description-edit-department">
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('descrição do departamento com no mínimo 10 caracteres') }}">*</span>
                                    <textarea id="description-edit-department" name="description_edit_department" rows="3" resize="none" class="form-control {{ $errors->has('description_edit_department') ? 'is-invalid' : '' }}" placeholder="{{ __('Descrição') }}" minlength="10" maxlength="1500" onkeyup="firstLetterUppercase(this);" @if ($errors->has('description_edit_department')) autofocus @endif>{{ old('description_edit_department') }}</textarea>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('description_edit_department'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('description_edit_department') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- informação -->
                    <div class="fe-mouse">
                        <div class="text-right">
                            <small class="fe-text-star">{{ __('*') }}</small>
                            <small class="text-light">{{ __('campo obrigatório') }}</small>
                        </div>
                    </div>
                    <!-- botões -->
                    <div class="text-right float-right fe-form-footer">
                        <a href="javascript:void(0)" class="mr-4" data-dismiss="modal">{{ __('Cancelar') }}</a>
                        <button type="submit" id="btn-edit-department" class="btn btn-outline-success mr-4">{{ __('Editar departamento') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
