<div id="modal-delete-condominium-block" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-delete-condominium-block-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- título -->
            <div class="modal-header">
                <h5 id="modal-delete-condominium-block-label" class="modal-title text-uppercase text-monospace ml-1">
                    <b>{{ __('Excluir bloco') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- form -->
                <form id="form-delete-condominium-block" role="form" autocomplete="off" novalidate>
                    @csrf
                    <!-- inputs -->
                    <div class="row">
                        <!-- id -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="id-delete-condominium-block">{{ __('ID') }}</label>
                                <div class="input-group input-group-merge validate-id-delete-condominium-block">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('id_delete_condominium_block') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('id do bloco') }}">*</span>
                                    <input readonly type="number" id="id-delete-condominium-block" name="id_delete_condominium_block" class="form-control {{ $errors->has('id_delete_condominium_block') ? 'is-invalid' : '' }}" placeholder="{{ __('ID do bloco') }}" value="{{ old('id_delete_condominium_block') }}" maxlength="20" required onkeypress="return onlyNumbers(event);" @if ($errors->has('id_delete_condominium_block')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('id_delete_condominium_block'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('id_delete_condominium_block') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- nome -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="name-delete-condominium-block">{{ __('Nome') }}</label>
                                <div class="input-group input-group-merge validate-name-delete-condominium-block">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('name_delete_condominium_block') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-boxes"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('nome ou número do bloco') }}">*</span>
                                    <input readonly type="text" id="name-delete-condominium-block" name="name_delete_condominium_block" class="form-control {{ $errors->has('name_delete_condominium_block') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome ou número do bloco') }}" value="{{ old('name_delete_condominium_block') }}" maxlength="191" required onkeypress="return onlyLettersNumbers(event);" onkeyup="letterUppercase('name-delete-condominium-block');" @if ($errors->has('name_delete_condominium_block')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_delete_condominium_block'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_delete_condominium_block') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- confirmação do nome -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="name-confirmation-delete-condominium-block">{{ __('Digite ') }}<b id="name-confirmation-delete-condominium-block-text" class="text-danger fe-block-copy" onmousedown="return false;"></b>{{ __(' para confirmar a exclusão') }}</label>
                                <div class="input-group input-group-merge validate-name-confirmation-delete-condominium-block">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('name_confirmation_delete_condominium_block') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-boxes"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('digite o nome ou número do bloco que está em vermelho e confirme, clicando em excluir bloco') }}">*</span>
                                    <input type="text" id="name-confirmation-delete-condominium-block" name="name_confirmation_delete_condominium_block" class="form-control fe-block-paste {{ $errors->has('name_confirmation_delete_condominium_block') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome ou número para exclusão') }}" value="{{ old('name_confirmation_delete_condominium_block') }}" maxlength="191" required onkeypress="return onlyLettersNumbers(event);" onkeyup="letterUppercase('name-confirmation-delete-condominium-block');" ondrop="return false;" @if ($errors->has('name_confirmation_delete_condominium_block')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_confirmation_delete_condominium_block'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_confirmation_delete_condominium_block') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- informações -->
                    <div class="fe-mouse">
                        <div class="text-right">
                            <small class="fe-text-star">{{ __('*') }}</small>
                            <small class="text-light">{{ __('campo obrigatório') }}</small>
                        </div>
                        <br>
                        <div class="mt--1">
                            <small class="text-light">{{ __('pense bem antes de excluir, blocos excluídos não são recuperados') }}</small>
                        </div>
                    </div>
                    <!-- botões -->
                    <div class="text-right float-right fe-form-footer">
                        <a href="javascript:void(0)" class="mr-4" data-dismiss="modal">{{ __('Cancelar') }}</a>
                        <button type="submit" id="btn-delete-condominium-block" class="btn btn-outline-danger mr-4">{{ __('Excluir bloco') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
