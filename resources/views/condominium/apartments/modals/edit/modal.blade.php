<div id="modal-edit-condominium-apartment" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-edit-condominium-apartment-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- título -->
            <div class="modal-header">
                <h5 id="modal-edit-condominium-apartment-label" class="modal-title text-uppercase text-monospace ml-1">
                    <b>{{ __('Editar apartamento') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- form -->
                <form id="form-edit-condominium-apartment" role="form" autocomplete="off" novalidate>
                    @csrf
                    <!-- inputs -->
                    <div class="row">
                        <!-- id -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="id-edit-condominium-apartment">{{ __('ID') }}</label>
                                <div class="input-group input-group-merge validate-id-edit-condominium-apartment">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('id_edit_condominium_apartment') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('id do apartamento') }}">*</span>
                                    <input readonly type="number" id="id-edit-condominium-apartment" name="id_edit_condominium_apartment" class="form-control {{ $errors->has('id_edit_condominium_apartment') ? 'is-invalid' : '' }}" placeholder="{{ __('ID do apartamento') }}" value="{{ old('id_edit_condominium_apartment') }}" maxlength="20" required onkeypress="return onlyNumbers(event);" @if ($errors->has('id_edit_condominium_apartment')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('id_edit_condominium_apartment'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('id_edit_condominium_apartment') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- bloco -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="block-id-edit-condominium-apartment">{{ __('Bloco do apartamento') }}</label>
                                <div class="input-group-none validate-block-id-edit-condominium-apartment">
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('selecione o bloco do apartamento') }}">*</span>
                                    {{ Form::select(
                                        "name",
                                        \App\Models\Condominium\CondominiumBlock::getCondominiumBlocksOptions(),
                                        old("block_id_edit_condominium_apartment"),
                                        ["id" => "block-id-edit-condominium-apartment", "name" => "block_id_edit_condominium_apartment", "class" => "form-control select-nosearch", "placeholder" => "Selecione", "required"]
                                    )}}
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('block_id_edit_condominium_apartment'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('block_id_edit_condominium_apartment') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- nome -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="name-edit-condominium-apartment">{{ __('Nome do apartamento') }}</label>
                                <div class="input-group input-group-merge validate-name-edit-condominium-apartment">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('name_edit_condominium_apartment') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-building"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('nome ou número') }}">*</span>
                                    <input type="text" id="name-edit-condominium-apartment" name="name_edit_condominium_apartment" class="form-control {{ $errors->has('name_edit_condominium_apartment') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome ou número') }}" value="{{ old('name_edit_condominium_apartment') }}" maxlength="191" required onkeypress="return onlyLettersNumbers(event);" onkeyup="letterUppercase('name-edit-condominium-apartment');" @if ($errors->has('name_edit_condominium_apartment')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_edit_condominium_apartment'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_edit_condominium_apartment') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- estacionamento -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="parking-id-edit-condominium-apartment">{{ __('Estacionamento') }}</label>
                                <div class="input-group-none validate-parking-id-edit-condominium-apartment">
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('selecione o estacionamento') }}">*</span>
                                    {{ Form::select(
                                        "name",
                                        \App\Models\Condominium\CondominiumParking::getCondominiumParkingsOptions(),
                                        old("parking_id_edit_condominium_apartment"),
                                        ["id" => "parking-id-edit-condominium-apartment", "name" => "parking_id_edit_condominium_apartment[]", "class" => "form-control", "required", "multiple"]
                                    )}}
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('parking_id_edit_condominium_apartment'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('parking_id_edit_condominium_apartment') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- descrição -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="description-edit-condominium-apartment">{{ __('Descrição') }}</label>
                                <div class="input-group-none validate-description-edit-condominium-apartment">
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('descrição do apartamento com no mínimo 10 caracteres') }}">*</span>
                                    <textarea id="description-edit-condominium-apartment" name="description_edit_condominium_apartment" rows="3" resize="none" class="form-control {{ $errors->has('description_edit_condominium_apartment') ? 'is-invalid' : '' }}" placeholder="{{ __('Descrição') }}" minlength="10" maxlength="1500" onkeyup="firstLetterUppercase(this);" @if ($errors->has('description_edit_condominium_apartment')) autofocus @endif>{{ old('description_edit_condominium_apartment') }}</textarea>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('description_edit_condominium_apartment'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('description_edit_condominium_apartment') }}</div>
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
                        <button type="submit" id="btn-edit-condominium-apartment" class="btn btn-outline-success mr-4">{{ __('Editar apartamento') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
