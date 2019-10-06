<div id="modal-delete-menu-item" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-delete-menu-item-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- título -->
            <div class="modal-header">
                <h5 id="modal-delete-menu-item-label" class="modal-title text-uppercase text-monospace ml-1">
                    <b>{{ __('Excluir item do menu') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- form -->
                <form id="form-delete-menu-item" role="form" autocomplete="off" novalidate>
                    @csrf
                    <!-- inputs -->
                    <div class="row">
                        <!-- id -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="id-delete-menu-item">{{ __('ID') }}</label>
                                <div class="input-group input-group-merge validate-id-delete-menu-item">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('id_delete_menu_item') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('id do item do menu') }}">*</span>
                                    <input readonly type="number" id="id-delete-menu-item" name="id_delete_menu_item" class="form-control {{ $errors->has('id_delete_menu_item') ? 'is-invalid' : '' }}" placeholder="{{ __('ID do item do menu') }}" value="{{ old('id_delete_menu_item') }}" maxlength="20" required onkeypress="return soNumeros(event);" @if ($errors->has('id_delete_menu_item')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('id_delete_menu_item'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('id_delete_menu_item') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- nome -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="name-delete-menu-item">{{ __('Nome') }}</label>
                                <div class="input-group input-group-merge validate-name-delete-menu-item">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('name_delete_menu_item') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-list-ul"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('nome do item do menu') }}">*</span>
                                    <input readonly type="text" id="name-delete-menu-item" name="name_delete_menu_item" class="form-control {{ $errors->has('name_delete_menu_item') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome do item do menu') }}" value="{{ old('name_delete_menu_item') }}" minlength="3" maxlength="191" required onkeypress="return soLetrasCaracteres(event);" onkeyup="primeiraLetraMaiuscula(this);" @if ($errors->has('name_delete_menu_item')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_delete_menu_item'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_delete_menu_item') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- confirmação da nome -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="name-confirmation-delete-menu-item">{{ __('Digite ') }}<b id="name-confirmation-delete-menu-item-text" class="text-danger fe-block-copy" onmousedown="return false;"></b>{{ __(' para confirmar a exclusão') }}</label>
                                <div class="input-group input-group-merge validate-name-confirmation-delete-menu-item">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('name_confirmation_delete_menu_item') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-list-ul"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('digite o nome do menu que está em vermelho e confirme, clicando em excluir item do menu') }}">*</span>
                                    <input type="text" id="name-confirmation-delete-menu-item" name="name_confirmation_delete_menu_item" class="form-control fe-block-paste {{ $errors->has('name_confirmation_delete_menu_item') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome para exclusão') }}" value="{{ old('name_confirmation_delete_menu_item') }}" minlength="3" maxlength="191" required onkeypress="return soLetrasCaracteres(event);" onkeyup="primeiraLetraMaiuscula(this);" ondrop="return false;" @if ($errors->has('name_confirmation_delete_menu_item')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_confirmation_delete_menu_item'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_confirmation_delete_menu_item') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- informações -->
                    <div class="fe-mouse-off">
                        <div class="text-right">
                            <small class="fe-text-star">{{ __('*') }}</small>
                            <small class="text-light">{{ __('campo obrigatório') }}</small>
                        </div>
                        <br>
                        <div class="mt--1">
                            <small class="text-light">{{ __('pense bem antes de excluir, itens do menu excluídos não são recuperados') }}</small>
                        </div>
                    </div>
                    <!-- botões -->
                    <div class="text-right float-right fe-form-footer">
                        <a href="javascript:void(0)" class="mr-4" data-dismiss="modal">{{ __('Cancelar') }}</a>
                        @if (app('router')->has('menu.item.destroy') && \App\Models\Permission::routePermission('menu.item.destroy'))
                            <button type="submit" id="btn-delete-menu-item" class="btn btn-outline-danger mr-4">{{ __('Excluir item do menu') }}</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
