<div id="modal-recover-user" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-recover-user-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- título -->
            <div class="modal-header">
                <h5 id="modal-recover-user-label" class="modal-title text-uppercase text-monospace ml-1">
                    <b>{{ __('Recuperar usuário') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- form -->
                <form id="form-recover-user" role="form" autocomplete="off" novalidate>
                    @csrf
                    <!-- inputs -->
                    <div class="row">
                        <!-- id -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="id-recover-user">{{ __('ID') }}</label>
                                <div class="input-group input-group-merge validate-id-recover-user">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('id_recover_user') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('id do usuário') }}">*</span>
                                    <input readonly type="number" id="id-recover-user" name="id_recover_user" class="form-control {{ $errors->has('id_recover_user') ? 'is-invalid' : '' }}" placeholder="{{ __('ID do usuário') }}" value="{{ old('id_recover_user') }}" maxlength="20" required onkeypress="return soNumeros(event);" @if ($errors->has('id_recover_user')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('id_recover_user'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('id_recover_user') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- nome -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="name-recover-user">{{ __('Nome') }}</label>
                                <div class="input-group input-group-merge validate-name-recover-user">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('name_recover_user') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-user"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('nome do usuário') }}">*</span>
                                    <input readonly type="text" id="name-recover-user" name="name_recover_user" class="form-control {{ $errors->has('name_recover_user') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome do usuário') }}" value="{{ old('name_recover_user') }}" minlength="3" maxlength="191" required onkeypress="return soLetras(event);" onkeyup="letraMaiuscula('name-recover-user'); this.value = semEspaco(this.value);" @if ($errors->has('name_recover_user')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_recover_user'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_recover_user') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- confirmação do nome -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="name-confirmation-recover-user">{{ __('Digite ') }}<b id="name-confirmation-recover-user-text" class="text-success fe-block-copy" onmousedown="return false;"></b>{{ __(' para confirmar a recuperação') }}</label>
                                <div class="input-group input-group-merge validate-name-confirmation-recover-user">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('name_confirmation_recover_user') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-user"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('digite o nome do usuário que está em verde e confirme, clicando em recuperar usuário') }}">*</span>
                                    <input type="text" id="name-confirmation-recover-user" name="name_confirmation_recover_user" class="form-control fe-block-paste {{ $errors->has('name_confirmation_recover_user') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome para recuperação') }}" value="{{ old('name_confirmation_recover_user') }}" minlength="3" maxlength="191" required onkeypress="return soLetras(event);" onkeyup="letraMaiuscula('name-confirmation-recover-user'); this.value = semEspaco(this.value);" ondrop="return false;" @if ($errors->has('name_confirmation_recover_user')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_confirmation_recover_user'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_confirmation_recover_user') }}</div>
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
                        @if (app('router')->has('user.restore') && \App\Models\Permission::routePermission('user.restore'))
                            <button type="submit" id="btn-recover-user" class="btn btn-outline-success mr-4">{{ __('Recuperar usuário') }}</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
