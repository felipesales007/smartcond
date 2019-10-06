<div id="modal-recover-group" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-recover-group-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- título -->
            <div class="modal-header">
                <h5 id="modal-recover-group-label" class="modal-title text-uppercase text-monospace ml-1">
                    <b>{{ __('Recuperar grupo') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- form -->
                <form id="form-recover-group" role="form" autocomplete="off" novalidate>
                    @csrf
                    <!-- inputs -->
                    <div class="row">
                        <!-- id -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="id-recover-group">{{ __('ID') }}</label>
                                <div class="input-group input-group-merge validate-id-recover-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('id_recover_group') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('id do grupo') }}">*</span>
                                    <input readonly type="number" id="id-recover-group" name="id_recover_group" class="form-control {{ $errors->has('id_recover_group') ? 'is-invalid' : '' }}" placeholder="{{ __('ID do grupo') }}" value="{{ old('id_recover_group') }}" maxlength="20" required onkeypress="return soNumeros(event);" @if ($errors->has('id_recover_group')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('id_recover_group'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('id_recover_group') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- nome -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="name-recover-group">{{ __('Nome') }}</label>
                                <div class="input-group input-group-merge validate-name-recover-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('name_recover_group') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-hotel"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('nome do grupo') }}">*</span>
                                    <input readonly type="text" id="name-recover-group" name="name_recover_group" class="form-control {{ $errors->has('name_recover_group') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome do grupo') }}" value="{{ old('name_recover_group') }}" minlength="3" maxlength="191" required oninput="this.value = this.value.toLowerCase();" onkeypress="return caracteresGrupo(event);" onkeyup="this.value = semEspaco(this.value);" @if ($errors->has('name_recover_group')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_recover_group'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_recover_group') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- confirmação do nome -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="name-confirmation-recover-group">{{ __('Digite ') }}<b id="name-confirmation-recover-group-text" class="text-success fe-block-copy" onmousedown="return false;"></b>{{ __(' para confirmar a recuperação') }}</label>
                                <div class="input-group input-group-merge validate-name-confirmation-recover-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('name_confirmation_recover_group') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-hotel"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('digite o nome do grupo que está em verde e confirme, clicando em recuperar grupo') }}">*</span>
                                    <input type="text" id="name-confirmation-recover-group" name="name_confirmation_recover_group" class="form-control fe-block-paste {{ $errors->has('name_confirmation_recover_group') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome para recuperação') }}" value="{{ old('name_confirmation_recover_group') }}" minlength="3" maxlength="191" required oninput="this.value = this.value.toLowerCase();" onkeypress="return caracteresGrupo(event);" onkeyup="this.value = semEspaco(this.value);" ondrop="return false;" @if ($errors->has('name_confirmation_recover_group')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_confirmation_recover_group'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_confirmation_recover_group') }}</div>
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
                        @if (app('router')->has('group.restore') && \App\Models\Permission::routePermission('group.restore'))
                            <button type="submit" id="btn-recover-group" class="btn btn-outline-success mr-4">{{ __('Recuperar grupo') }}</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
