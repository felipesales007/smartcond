<div id="modal-new-department" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-new-department-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <!-- título -->
            <div class="modal-header">
                <h5 id="modal-new-department-label" class="modal-title text-uppercase text-monospace ml-1">
                    <b>{{ __('Novo departamento') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- form -->
                <form id="form-new-department" role="form" autocomplete="off" novalidate>
                    @csrf
                    <!-- inputs -->
                    <div class="row">
                        <!-- nome -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="name-new-department">{{ __('Nome do departamento') }}</label>
                                <div class="input-group input-group-merge validate-name-new-department">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('name_new_department') ? 'is-invalid' : '' }}">
                                            <i class="far fa-building"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                    <input type="text" id="name-new-department" name="name_new_department" class="form-control {{ $errors->has('name_new_department') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome do departamento') }}" value="{{ old('name_new_department') }}" minlength="3" maxlength="191" required onkeypress="return onlyLettersCharacters(event);" onkeyup="letterUppercase('name-new-department');" @if ($errors->has('name_new_department')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_new_department'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_new_department') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- descrição -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="description-new-department">{{ __('Descrição') }}</label>
                                <div class="input-group-none validate-description-new-department">
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('descrição do departamento com no mínimo 10 caracteres') }}">*</span>
                                    <textarea id="description-new-department" name="description_new_department" rows="3" resize="none" class="form-control {{ $errors->has('description_new_department') ? 'is-invalid' : '' }}" placeholder="{{ __('Descrição') }}" minlength="10" maxlength="1500" onkeyup="firstLetterUppercase(this);" @if ($errors->has('description_new_department')) autofocus @endif>{{ old('description_new_department') }}</textarea>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('description_new_department'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('description_new_department') }}</div>
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
                        <button type="submit" id="btn-new-department" class="btn btn-outline-success mr-4">{{ __('Criar departamento') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
