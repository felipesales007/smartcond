<div id="modal-edit-condominium-parking" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-edit-condominium-parking-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- título -->
            <div class="modal-header">
                <h5 id="modal-edit-condominium-parking-label" class="modal-title text-uppercase text-monospace ml-1">
                    <b>{{ __('Editar estacionamento') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- form -->
                <form id="form-edit-condominium-parking" role="form" autocomplete="off" novalidate>
                    @csrf
                    <!-- inputs -->
                    <div class="row">
                        <!-- id -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="id-edit-condominium-parking">{{ __('ID') }}</label>
                                <div class="input-group input-group-merge validate-id-edit-condominium-parking">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('id_edit_condominium_parking') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('id do estacionamento') }}">*</span>
                                    <input readonly type="number" id="id-edit-condominium-parking" name="id_edit_condominium_parking" class="form-control {{ $errors->has('id_edit_condominium_parking') ? 'is-invalid' : '' }}" placeholder="{{ __('ID do estacionamento') }}" value="{{ old('id_edit_condominium_parking') }}" maxlength="20" required onkeypress="return onlyNumbers(event);" @if ($errors->has('id_edit_condominium_parking')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('id_edit_condominium_parking'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('id_edit_condominium_parking') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- nome -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="name-edit-condominium-parking">{{ __('Nome do estacionamento') }}</label>
                                <div class="input-group input-group-merge validate-name-edit-condominium-parking">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('name_edit_condominium_parking') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-car"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('nome ou número') }}">*</span>
                                    <input type="text" id="name-edit-condominium-parking" name="name_edit_condominium_parking" class="form-control {{ $errors->has('name_edit_condominium_parking') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome ou número do estacionamento') }}" value="{{ old('name_edit_condominium_parking') }}" maxlength="191" required onkeypress="return onlyLettersNumbers(event);" onkeyup="letterUppercase('name-edit-condominium-parking');" @if ($errors->has('name_edit_condominium_parking')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_edit_condominium_parking'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_edit_condominium_parking') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- descrição -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="description-edit-condominium-parking">{{ __('Descrição') }}</label>
                                <div class="input-group-none validate-description-edit-condominium-parking">
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('descrição do estacionamento com no mínimo 10 caracteres') }}">*</span>
                                    <textarea id="description-edit-condominium-parking" name="description_edit_condominium_parking" rows="3" resize="none" class="form-control {{ $errors->has('description_edit_condominium_parking') ? 'is-invalid' : '' }}" placeholder="{{ __('Descrição') }}" minlength="10" maxlength="1500" onkeyup="firstLetterUppercase(this);" @if ($errors->has('description_edit_condominium_parking')) autofocus @endif>{{ old('description_edit_condominium_parking') }}</textarea>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('description_edit_condominium_parking'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('description_edit_condominium_parking') }}</div>
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
                        <button type="submit" id="btn-edit-condominium-parking" class="btn btn-outline-success mr-4">{{ __('Editar estacionamento') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
