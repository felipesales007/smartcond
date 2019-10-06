<div id="modal-delete-route" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-delete-route-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- título -->
            <div class="modal-header">
                <h5 id="modal-delete-route-label" class="modal-title text-uppercase text-monospace ml-1">
                    <b>{{ __('Excluir rota') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- form -->
                <form id="form-delete-route" role="form" autocomplete="off" novalidate>
                    @csrf
                    <!-- inputs -->
                    <div class="row">
                        <!-- id -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="id-delete-route">{{ __('ID') }}</label>
                                <div class="input-group input-group-merge validate-id-delete-route">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('id_delete_route') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('id da rota') }}">*</span>
                                    <input readonly type="number" id="id-delete-route" name="id_delete_route" class="form-control {{ $errors->has('id_delete_route') ? 'is-invalid' : '' }}" placeholder="{{ __('ID da rota') }}" value="{{ old('id_delete_route') }}" maxlength="20" required onkeypress="return soNumeros(event);" @if ($errors->has('id_delete_route')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('id_delete_route'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('id_delete_route') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- rota -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="route-delete-route">{{ __('Nome') }}</label>
                                <div class="input-group input-group-merge validate-route-delete-route">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('route_delete_route') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-hotel"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('nome da rota') }}">*</span>
                                    <input readonly type="text" id="route-delete-route" name="route_delete_route" class="form-control {{ $errors->has('route_delete_route') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome da rota') }}" value="{{ old('route_delete_route') }}" minlength="3" maxlength="191" required oninput="this.value = this.value.toLowerCase();" onkeypress="return caracteresRota(event);" onkeyup="this.value = semEspaco(this.value);" @if ($errors->has('route_delete_route')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('route_delete_route'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('route_delete_route') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- confirmação da rota -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="route-confirmation-delete-route">{{ __('Digite ') }}<b id="route-confirmation-delete-route-text" class="text-danger fe-block-copy" onmousedown="return false;"></b>{{ __(' para confirmar a exclusão') }}</label>
                                <div class="input-group input-group-merge validate-route-confirmation-delete-route">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('route_confirmation_delete_route') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-hotel"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('digite o nome da rota que está em vermelho e confirme, clicando em excluir rota') }}">*</span>
                                    <input type="text" id="route-confirmation-delete-route" name="route_confirmation_delete_route" class="form-control fe-block-paste {{ $errors->has('route_confirmation_delete_route') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome para exclusão') }}" value="{{ old('route_confirmation_delete_route') }}" minlength="3" maxlength="191" required oninput="this.value = this.value.toLowerCase();" onkeypress="return caracteresRota(event);" onkeyup="this.value = semEspaco(this.value);" ondrop="return false;" @if ($errors->has('route_confirmation_delete_route')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('route_confirmation_delete_route'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('route_confirmation_delete_route') }}</div>
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
                            <small class="text-light">{{ __('pense bem antes de excluir, rotas excluídas não são recuperadas') }}</small>
                        </div>
                    </div>
                    <!-- botões -->
                    <div class="text-right float-right fe-form-footer">
                        <a href="javascript:void(0)" class="mr-4" data-dismiss="modal">{{ __('Cancelar') }}</a>
                        @if (app('router')->has('route.destroy') && \App\Models\Permission::routePermission('route.destroy'))
                            <button type="submit" id="btn-delete-route" class="btn btn-outline-danger mr-4">{{ __('Excluir rota') }}</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
