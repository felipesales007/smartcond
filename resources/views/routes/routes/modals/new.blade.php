<div id="modal-new-route" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-new-route-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- título -->
            <div class="modal-header">
                <h5 id="modal-new-route-label" class="modal-title text-uppercase text-monospace ml-1">
                    <b>{{ __('Nova rota') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- form -->
                <form id="form-new-route" role="form" autocomplete="off" novalidate>
                    @csrf
                    <!-- inputs -->
                    <div class="row">
                        <!-- grupo -->
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="form-control-label" for="group-id-new-route">{{ __('Grupo') }}</label>
                                <div class="input-group-none validate-group-id-new-route">
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('selecione o grupo') }}">*</span>
                                    {{ Form::select(
                                        "name",
                                        \App\Models\Route\Group::getGroupsOptions(),
                                        old("group_id_new_route"),
                                        ["id" => "group-id-new-route", "name" => "group_id_new_route", "class" => "form-control select-nosearch", "placeholder" => "Selecione", "required"]
                                    )}}
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('group_id_new_route'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('group_id_new_route') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- tipo de rota -->
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="form-control-label" for="route-option-id-new-route">{{ __('Tipo de rota') }}</label>
                                <div class="input-group-none validate-route-option-id-new-route">
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('selecione o tipo de rota') }}">*</span>
                                    {{ Form::select(
                                        "name",
                                        \App\Models\Route\RouteOption::getRouteOptionsOptions(),
                                        old("route_option_id_new_route"),
                                        ["id" => "route-option-id-new-route", "name" => "route_option_id_new_route", "class" => "form-control select-nosearch", "placeholder" => "Selecione", "required"]
                                    )}}
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('route_option_id_new_route'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('route_option_id_new_route') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- página -->
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="form-control-label" for="view-new-route">{{ __('Página') }}</label>
                                <div class="input-group input-group-merge validate-view-new-route">
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('selecione se a rota for para uma nova página') }}">*</span>
                                    <div class="custom-control custom-checkbox custom-checkbox-dark mt-2">
                                        <input type="checkbox" id="view-new-route" name="view_new_route" class="custom-control-input" {{ old('view_new_route') ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="view-new-route"></label>
                                    </div>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('view_new_route'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('view_new_route') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- url -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="url-new-route">{{ __('URL') }}</label>
                                <div class="input-group input-group-merge validate-url-new-route">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('url_new_route') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-bookmark"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                    <input type="text" id="url-new-route" name="url_new_route" class="form-control {{ $errors->has('url_new_route') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome da url') }}" value="{{ old('url_new_route') }}" minlength="3" maxlength="191" required oninput="this.value = this.value.toLowerCase();" onkeypress="return caracteresUrl(event);" onkeyup="this.value = semEspaco(this.value);" @if ($errors->has('url_new_route')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('url_new_route'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('url_new_route') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- rota -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="route-new-route">{{ __('Rota') }}</label>
                                <div class="input-group input-group-merge validate-route-new-route">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('route_new_route') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-route"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                    <input type="text" id="route-new-route" name="route_new_route" class="form-control {{ $errors->has('route_new_route') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome da rota') }}" value="{{ old('route_new_route') }}" minlength="3" maxlength="191" required oninput="this.value = this.value.toLowerCase();" onkeypress="return caracteresRota(event);" onkeyup="this.value = semEspaco(this.value);" @if ($errors->has('route_new_route')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('route_new_route'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('route_new_route') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- controle -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="controller-new-route">{{ __('Controle') }}</label>
                                <div class="input-group input-group-merge validate-controller-new-route">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('controller_new_route') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-chess-rook"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                    <input type="text" id="controller-new-route" name="controller_new_route" class="form-control {{ $errors->has('controller_new_route') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome do controle') }}" value="{{ old('controller_new_route') }}" minlength="3" maxlength="191" required onkeypress="return caracteresControle(event);" onkeyup="this.value = semEspaco(this.value);" @if ($errors->has('controller_new_route')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('controller_new_route'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('controller_new_route') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- descrição -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="description-new-route">{{ __('Descrição') }}</label>
                                <div class="input-group-none validate-description-new-route">
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('descrição da rota com no mínimo 10 caracteres') }}">*</span>
                                    <textarea id="description-new-route" name="description_new_route" rows="3" resize="none" class="form-control {{ $errors->has('description_new_route') ? 'is-invalid' : '' }}" placeholder="{{ __('Descrição') }}" minlength="10" maxlength="1500" onkeyup="primeiraLetraMaiuscula(this);" @if ($errors->has('description_new_route')) autofocus @endif>{{ old('description_new_route') }}</textarea>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('description_new_route'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('description_new_route') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- informação -->
                    <div class="fe-mouse-off">
                        <div class="text-right">
                            <small class="fe-text-star">{{ __('*') }}</small>
                            <small class="text-light">{{ __('campos obrigatórios') }}</small>
                        </div>
                    </div>
                    <!-- botões -->
                    <div class="text-right float-right fe-form-footer">
                        <a href="javascript:void(0)" class="mr-4" data-dismiss="modal">{{ __('Cancelar') }}</a>
                        @if (app('router')->has('route.store') && \App\Models\Permission::routePermission('route.store'))
                            <button type="submit" id="btn-new-route" class="btn btn-outline-success mr-4">{{ __('Criar rota') }}</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
