<div id="modal-recover-route" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-recover-route-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- título -->
            <div class="modal-header">
                <h5 id="modal-recover-route-label" class="modal-title text-uppercase text-monospace ml-1">
                    <b>{{ __('Recuperar rota') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- form -->
                <form id="form-recover-route" role="form" autocomplete="off" novalidate>
                    @csrf
                    <!-- inputs -->
                    <div class="row">
                        <!-- id -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="id-recover-route">{{ __('ID') }}</label>
                                <div class="input-group input-group-merge validate-id-recover-route">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('id_recover_route') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('id da rota') }}">*</span>
                                    <input readonly type="number" id="id-recover-route" name="id_recover_route" class="form-control {{ $errors->has('id_recover_route') ? 'is-invalid' : '' }}" placeholder="{{ __('ID da rota') }}" value="{{ old('id_recover_route') }}" maxlength="20" required onkeypress="return soNumeros(event);" @if ($errors->has('id_recover_route')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('id_recover_route'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('id_recover_route') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- rota -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="route-recover-route">{{ __('Nome') }}</label>
                                <div class="input-group input-group-merge validate-route-recover-route">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('route_recover_route') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-hotel"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('nome da rota') }}">*</span>
                                    <input readonly type="text" id="route-recover-route" name="route_recover_route" class="form-control {{ $errors->has('route_recover_route') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome da rota') }}" value="{{ old('route_recover_route') }}" minlength="3" maxlength="191" required oninput="this.value = this.value.toLowerCase();" onkeypress="return caracteresRota(event);" onkeyup="this.value = semEspaco(this.value);" @if ($errors->has('route_recover_route')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('route_recover_route'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('route_recover_route') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- confirmação da rota -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="route-confirmation-recover-route">{{ __('Digite ') }}<b id="route-confirmation-recover-route-text" class="text-success fe-block-copy" onmousedown="return false;"></b>{{ __(' para confirmar a recuperação') }}</label>
                                <div class="input-group input-group-merge validate-route-confirmation-recover-route">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('route_confirmation_recover_route') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-hotel"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('digite o nome da rota que está em verde e confirme, clicando em recuperar rota') }}">*</span>
                                    <input type="text" id="route-confirmation-recover-route" name="route_confirmation_recover_route" class="form-control fe-block-paste {{ $errors->has('route_confirmation_recover_route') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome para recuperação') }}" value="{{ old('route_confirmation_recover_route') }}" minlength="3" maxlength="191" required oninput="this.value = this.value.toLowerCase();" onkeypress="return caracteresRota(event);" onkeyup="this.value = semEspaco(this.value);" ondrop="return false;" @if ($errors->has('route_confirmation_recover_route')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('route_confirmation_recover_route'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('route_confirmation_recover_route') }}</div>
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
                        @if (app('router')->has('route.restore') && \App\Models\Permission::routePermission('route.restore'))
                            <button type="submit" id="btn-recover-route" class="btn btn-outline-success mr-4">{{ __('Recuperar rota') }}</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
