<div id="modal-delete-group" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-delete-group-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- título -->
            <div class="modal-header">
                <h5 id="modal-delete-group-label" class="modal-title text-uppercase text-monospace ml-1">
                    <b>{{ __('Excluir grupo') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- form -->
                <form id="form-delete-group" role="form" autocomplete="off" novalidate>
                    @csrf
                    <!-- inputs -->
                    <div class="row">
                        <!-- id -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="id-delete-group">{{ __('ID') }}</label>
                                <div class="input-group input-group-merge validate-id-delete-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('id_delete_group') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('id do grupo') }}">*</span>
                                    <input readonly type="number" id="id-delete-group" name="id_delete_group" class="form-control {{ $errors->has('id_delete_group') ? 'is-invalid' : '' }}" placeholder="{{ __('ID do grupo') }}" value="{{ old('id_delete_group') }}" maxlength="20" required onkeypress="return onlyNumbers(event);" @if ($errors->has('id_delete_group')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('id_delete_group'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('id_delete_group') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- nome -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="name-delete-group">{{ __('Nome') }}</label>
                                <div class="input-group input-group-merge validate-name-delete-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('name_delete_group') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-hotel"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('nome do grupo') }}">*</span>
                                    <input readonly type="text" id="name-delete-group" name="name_delete_group" class="form-control {{ $errors->has('name_delete_group') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome do grupo') }}" value="{{ old('name_delete_group') }}" minlength="3" maxlength="191" required oninput="this.value = this.value.toLowerCase();" onkeypress="return groupCharacters(event);" onkeyup="this.value = noSpace(this.value);" @if ($errors->has('name_delete_group')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_delete_group'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_delete_group') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- confirmação do nome -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="name-confirmation-delete-group">{{ __('Digite ') }}<b id="name-confirmation-delete-group-text" class="text-danger fe-block-copy" onmousedown="return false;"></b>{{ __(' para confirmar a exclusão') }}</label>
                                <div class="input-group input-group-merge validate-name-confirmation-delete-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('name_confirmation_delete_group') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-hotel"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('digite o nome do grupo que está em vermelho e confirme, clicando em excluir grupo') }}">*</span>
                                    <input type="text" id="name-confirmation-delete-group" name="name_confirmation_delete_group" class="form-control fe-block-paste {{ $errors->has('name_confirmation_delete_group') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome para exclusão') }}" value="{{ old('name_confirmation_delete_group') }}" minlength="3" maxlength="191" required oninput="this.value = this.value.toLowerCase();" onkeypress="return groupCharacters(event);" onkeyup="this.value = noSpace(this.value);" ondrop="return false;" @if ($errors->has('name_confirmation_delete_group')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_confirmation_delete_group'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_confirmation_delete_group') }}</div>
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
                            <small class="text-light">{{ __('pense bem antes de excluir, grupos excluídos não são recuperados') }}</small>
                        </div>
                    </div>
                    <!-- botões -->
                    <div class="text-right float-right fe-form-footer">
                        <a href="javascript:void(0)" class="mr-4" data-dismiss="modal">{{ __('Cancelar') }}</a>
                        <button type="submit" id="btn-delete-group" class="btn btn-outline-danger mr-4">{{ __('Excluir grupo') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
