<div id="modal-delete-admin" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-delete-admin-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- título -->
            <div class="modal-header">
                <h5 id="modal-delete-admin-label" class="modal-title text-uppercase text-monospace ml-1">
                    <b>{{ __('Excluir administrador') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- form -->
                <form id="form-delete-admin" role="form" autocomplete="off" novalidate>
                    @csrf
                    <!-- inputs -->
                    <div class="row">
                        <!-- id -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="id-delete-admin">{{ __('ID') }}</label>
                                <div class="input-group input-group-merge validate-id-delete-admin">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('id_delete_admin') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('id do administrador') }}">*</span>
                                    <input readonly type="number" id="id-delete-admin" name="id_delete_admin" class="form-control {{ $errors->has('id_delete_admin') ? 'is-invalid' : '' }}" placeholder="{{ __('ID do administrador') }}" value="{{ old('id_delete_admin') }}" maxlength="20" required onkeypress="return soNumeros(event);" @if ($errors->has('id_delete_admin')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('id_delete_admin'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('id_delete_admin') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- nome -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="name-delete-admin">{{ __('Nome') }}</label>
                                <div class="input-group input-group-merge validate-name-delete-admin">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('name_delete_admin') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-user"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('nome do administrador') }}">*</span>
                                    <input readonly type="text" id="name-delete-admin" name="name_delete_admin" class="form-control {{ $errors->has('name_delete_admin') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome do administrador') }}" value="{{ old('name_delete_admin') }}" minlength="3" maxlength="191" required onkeypress="return soLetras(event);" onkeyup="letraMaiuscula('name-delete-admin'); this.value = semEspaco(this.value);" @if ($errors->has('name_delete_admin')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_delete_admin'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_delete_admin') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- confirmação do nome -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="name-confirmation-delete-admin">{{ __('Digite ') }}<b id="name-confirmation-delete-admin-text" class="text-danger fe-block-copy" onmousedown="return false;"></b>{{ __(' para confirmar a exclusão') }}</label>
                                <div class="input-group input-group-merge validate-name-confirmation-delete-admin">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('name_confirmation_delete_admin') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-user"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('digite o nome do administrador que está em vermelho e confirme, clicando em excluir administrador') }}">*</span>
                                    <input type="text" id="name-confirmation-delete-admin" name="name_confirmation_delete_admin" class="form-control fe-block-paste {{ $errors->has('name_confirmation_delete_admin') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome para exclusão') }}" value="{{ old('name_confirmation_delete_admin') }}" minlength="3" maxlength="191" required onkeypress="return soLetras(event);" onkeyup="letraMaiuscula('name-confirmation-delete-admin'); this.value = semEspaco(this.value);" ondrop="return false;" @if ($errors->has('name_confirmation_delete_admin')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_confirmation_delete_admin'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_confirmation_delete_admin') }}</div>
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
                            <small class="text-light">{{ __('pense bem antes de excluir, administradores excluídos não são recuperados') }}</small>
                        </div>
                    </div>
                    <!-- botões -->
                    <div class="text-right float-right fe-form-footer">
                        <a href="javascript:void(0)" class="mr-4" data-dismiss="modal">{{ __('Cancelar') }}</a>
                        @if (app('router')->has('admin.destroy') && \App\Models\Permission::routePermission('admin.destroy'))
                            <button type="submit" id="btn-delete-admin" class="btn btn-outline-danger mr-4">{{ __('Excluir administrador') }}</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
