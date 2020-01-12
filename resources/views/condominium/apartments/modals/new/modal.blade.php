<div id="modal-new-condominium-apartment" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-new-condominium-apartment-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- título -->
            <div class="modal-header">
                <h5 id="modal-new-condominium-apartment-label" class="modal-title text-uppercase text-monospace ml-1">
                    <b>{{ __('Novo apartamento') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- form -->
                <form id="form-new-condominium-apartment" role="form" autocomplete="off" novalidate>
                    @csrf
                    <!-- inputs -->
                    <div class="row">
                        <!-- bloco -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="block-id-new-condominium-apartment">{{ __('Bloco do apartamento') }}</label>
                                <div class="input-group-none validate-block-id-new-condominium-apartment">
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('selecione o bloco do apartamento') }}">*</span>
                                    {{ Form::select(
                                        "name",
                                        \App\Models\Condominium\CondominiumBlock::getCondominiumBlocksOptions(),
                                        old("block_id_new_condominium_apartment"),
                                        ["id" => "block-id-new-condominium-apartment", "name" => "block_id_new_condominium_apartment", "class" => "form-control select-nosearch", "placeholder" => "Selecione", "required"]
                                    )}}
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('block_id_new_condominium_apartment'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('block_id_new_condominium_apartment') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- nome -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="name-new-condominium-apartment">{{ __('Nome do apartamento') }}</label>
                                <div class="input-group input-group-merge validate-name-new-condominium-apartment">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('name_new_condominium_apartment') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-building"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('nome ou número') }}">*</span>
                                    <input type="text" id="name-new-condominium-apartment" name="name_new_condominium_apartment" class="form-control {{ $errors->has('name_new_condominium_apartment') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome ou número') }}" value="{{ old('name_new_condominium_apartment') }}" maxlength="191" required onkeypress="return onlyLettersNumbers(event);" onkeyup="letterUppercase('name-new-condominium-apartment');" @if ($errors->has('name_new_condominium_apartment')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_new_condominium_apartment'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_new_condominium_apartment') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- estacionamento -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="parking-id-new-condominium-apartment">{{ __('Estacionamento') }}</label>
                                <div class="input-group-none validate-parking-id-new-condominium-apartment">
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('selecione o estacionamento que não esta sendo utilizado por outro apartamento') }}">*</span>
                                    {{ Form::select(
                                        "name",
                                        \App\Models\Condominium\CondominiumParking::getCondominiumParkingsFreeOptions(),
                                        old("parking_id_new_condominium_apartment"),
                                        ["id" => "parking-id-new-condominium-apartment", "name" => "parking_id_new_condominium_apartment[]", "class" => "form-control", "multiple"]
                                    )}}
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('parking_id_new_condominium_apartment'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('parking_id_new_condominium_apartment') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- descrição -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="description-new-condominium-apartment">{{ __('Descrição') }}</label>
                                <div class="input-group-none validate-description-new-condominium-apartment">
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('descrição do apartamento com no mínimo 10 caracteres') }}">*</span>
                                    <textarea id="description-new-condominium-apartment" name="description_new_condominium_apartment" rows="3" resize="none" class="form-control {{ $errors->has('description_new_condominium_apartment') ? 'is-invalid' : '' }}" placeholder="{{ __('Descrição') }}" minlength="10" maxlength="1500" onkeyup="firstLetterUppercase(this);" @if ($errors->has('description_new_condominium_apartment')) autofocus @endif>{{ old('description_new_condominium_apartment') }}</textarea>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('description_new_condominium_apartment'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('description_new_condominium_apartment') }}</div>
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
                        <button type="submit" id="btn-new-condominium-apartment" class="btn btn-outline-success mr-4">{{ __('Criar apartamento') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
