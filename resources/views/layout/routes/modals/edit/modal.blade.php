<div id="modal-edit-route" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-edit-route-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- título -->
            <div class="modal-header">
                <h5 id="modal-edit-route-label" class="modal-title text-uppercase text-monospace ml-1">
                    <b>{{ __('Editar rota') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- form -->
                <form id="form-edit-route" role="form" autocomplete="off" novalidate>
                    @csrf
                    <!-- inputs -->
                    <div class="row">
                        <!-- id -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="id-edit-route">{{ __('ID') }}</label>
                                <div class="input-group input-group-merge validate-id-edit-route">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('id_edit_route') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('id da rota') }}">*</span>
                                    <input readonly type="number" id="id-edit-route" name="id_edit_route" class="form-control {{ $errors->has('id_edit_route') ? 'is-invalid' : '' }}" placeholder="{{ __('ID da rota') }}" value="{{ old('id_edit_route') }}" maxlength="20" required onkeypress="return onlyNumbers(event);" @if ($errors->has('id_edit_route')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('id_edit_route'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('id_edit_route') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- grupo -->
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="form-control-label" for="group-id-edit-route">{{ __('Grupo') }}</label>
                                <div class="input-group-none validate-group-id-edit-route">
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('selecione o grupo') }}">*</span>
                                    {{ Form::select(
                                        "name",
                                        \App\Models\Route\Group::getGroupsOptions(),
                                        old("group_id_edit_route"),
                                        ["id" => "group-id-edit-route", "name" => "group_id_edit_route", "class" => "form-control select-nosearch", "placeholder" => "Selecione", "required"]
                                    )}}
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('group_id_edit_route'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('group_id_edit_route') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- tipo de rota -->
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="form-control-label" for="route-option-id-edit-route">{{ __('Tipo de rota') }}</label>
                                <div class="input-group-none validate-route-option-id-edit-route">
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('selecione o tipo de rota') }}">*</span>
                                    {{ Form::select(
                                        "name",
                                        \App\Models\Route\RouteOption::getRouteOptionsOptions(),
                                        old("route_option_id_edit_route"),
                                        ["id" => "route-option-id-edit-route", "name" => "route_option_id_edit_route", "class" => "form-control select-nosearch", "placeholder" => "Selecione", "required"]
                                    )}}
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('route_option_id_edit_route'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('route_option_id_edit_route') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- página -->
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="form-control-label" for="view-edit-route">{{ __('Página') }}</label>
                                <div class="input-group input-group-merge validate-view-edit-route">
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('selecione se a rota for para uma nova página') }}">*</span>
                                    <div class="custom-control custom-checkbox custom-checkbox-primary mt-2">
                                        <input type="checkbox" id="view-edit-route" name="view_edit_route" class="custom-control-input" {{ old('view_edit_route') ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="view-edit-route"></label>
                                    </div>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('view_edit_route'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('view_edit_route') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- url -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="url-edit-route">{{ __('URL') }}</label>
                                <div class="input-group input-group-merge validate-url-edit-route">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('url_edit_route') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-bookmark"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                    <input type="text" id="url-edit-route" name="url_edit_route" class="form-control {{ $errors->has('url_edit_route') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome da url') }}" value="{{ old('url_edit_route') }}" minlength="3" maxlength="191" required oninput="this.value = this.value.toLowerCase();" onkeypress="return urlCharacters(event);" onkeyup="this.value = noSpace(this.value);" @if ($errors->has('url_edit_route')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('url_edit_route'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('url_edit_route') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- rota -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="route-edit-route">{{ __('Rota') }}</label>
                                <div class="input-group input-group-merge validate-route-edit-route">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('route_edit_route') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-route"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('nome da rota criada no projeto') }}">*</span>
                                    <input type="text" id="route-edit-route" name="route_edit_route" class="form-control {{ $errors->has('route_edit_route') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome da rota') }}" value="{{ old('route_edit_route') }}" minlength="3" maxlength="191" required oninput="this.value = this.value.toLowerCase();" onkeypress="return routeCharacters(event);" onkeyup="this.value = noSpace(this.value);" @if ($errors->has('route_edit_route')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('route_edit_route'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('route_edit_route') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- controle -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="controller-edit-route">{{ __('Controle') }}</label>
                                <div class="input-group input-group-merge validate-controller-edit-route">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('controller_edit_route') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-chess-rook"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('caminho do arquivo do controle criado no projeto') }}">*</span>
                                    <input type="text" id="controller-edit-route" name="controller_edit_route" class="form-control {{ $errors->has('controller_edit_route') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome do controle') }}" value="{{ old('controller_edit_route') }}" minlength="3" maxlength="191" required onkeypress="return controlCharacters(event);" onkeyup="this.value = noSpace(this.value);" @if ($errors->has('controller_edit_route')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('controller_edit_route'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('controller_edit_route') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- descrição -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="description-edit-route">{{ __('Descrição') }}</label>
                                <div class="input-group-none validate-description-edit-route">
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('descrição da rota com no mínimo 10 caracteres') }}">*</span>
                                    <textarea id="description-edit-route" name="description_edit_route" rows="3" resize="none" class="form-control {{ $errors->has('description_edit_route') ? 'is-invalid' : '' }}" placeholder="{{ __('Descrição') }}" minlength="10" maxlength="1500" onkeyup="firstLetterUppercase(this);" @if ($errors->has('description_edit_route')) autofocus @endif>{{ old('description_edit_route') }}</textarea>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('description_edit_route'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('description_edit_route') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- informação -->
                    <div class="fe-mouse">
                        <div class="text-right">
                            <small class="fe-text-star">{{ __('*') }}</small>
                            <small class="text-light">{{ __('campos obrigatórios') }}</small>
                        </div>
                    </div>
                    <!-- botões -->
                    <div class="text-right float-right fe-form-footer">
                        <a href="javascript:void(0)" class="mr-4" data-dismiss="modal">{{ __('Cancelar') }}</a>
                        <button type="submit" id="btn-edit-route" class="btn btn-outline-success mr-4">{{ __('Editar rota') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
