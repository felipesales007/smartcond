<div id="modal-edit-category" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-edit-category-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <!-- título -->
            <div class="modal-header">
                <h5 id="modal-edit-category-label" class="modal-title text-uppercase text-monospace ml-1">
                    <b>{{ __('Editar categoria') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- form -->
                <form id="form-edit-category" role="form" autocomplete="off" novalidate>
                @csrf
                <!-- inputs -->
                    <div class="row">
                        <!-- id -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="id-edit-category">{{ __('ID') }}</label>
                                <div class="input-group input-group-merge validate-id-edit-category">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('id_edit_category') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('id da categoria') }}">*</span>
                                    <input readonly type="number" id="id-edit-category" name="id_edit_category" class="form-control {{ $errors->has('id_edit_category') ? 'is-invalid' : '' }}" placeholder="{{ __('ID da categoria') }}" value="{{ old('id_edit_category') }}" maxlength="20" required onkeypress="return soNumeros(event);" @if ($errors->has('id_edit_category')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('id_edit_category'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('id_edit_category') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- nome -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="name-edit-category">{{ __('Nome da categoria') }}</label>
                                <div class="input-group input-group-merge validate-name-edit-category">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('name_edit_category') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-boxes"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                    <input type="text" id="name-edit-category" name="name_edit_category" class="form-control {{ $errors->has('name_edit_category') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome da categoria') }}" value="{{ old('name_edit_category') }}" minlength="3" maxlength="191" required onkeypress="return soLetrasCaracteres(event);" onkeyup="letraMaiuscula('name-edit-category');" @if ($errors->has('name_edit_category')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_edit_category'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_edit_category') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- descrição -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="description-edit-category">{{ __('Descrição') }}</label>
                                <div class="input-group-none validate-description-edit-category">
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('descrição da categoria com no mínimo 10 caracteres') }}">*</span>
                                    <textarea id="description-edit-category" name="description_edit_category" rows="3" resize="none" class="form-control {{ $errors->has('description_edit_category') ? 'is-invalid' : '' }}" placeholder="{{ __('Descrição') }}" minlength="10" maxlength="1500" onkeyup="primeiraLetraMaiuscula(this);" @if ($errors->has('description_edit_category')) autofocus @endif>{{ old('description_edit_category') }}</textarea>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('description_edit_category'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('description_edit_category') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- informação -->
                    <div class="fe-mouse-off">
                        <div class="text-right">
                            <small class="fe-text-star">{{ __('*') }}</small>
                            <small class="text-light">{{ __('campo obrigatório') }}</small>
                        </div>
                    </div>
                    <!-- botões -->
                    <div class="text-right float-right fe-form-footer">
                        <a href="javascript:void(0)" class="mr-4" data-dismiss="modal">{{ __('Cancelar') }}</a>
                        @if (app('router')->has('category.edit') && \App\Models\Permission::routePermission('category.edit'))
                            <button type="submit" id="btn-edit-category" class="btn btn-outline-success mr-4">{{ __('Editar categoria') }}</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
