<div id="modal-new-menu-item" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-new-menu-item-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- título -->
            <div class="modal-header">
                <h5 id="modal-new-menu-item-label" class="modal-title text-uppercase text-monospace ml-1">
                    <b>{{ __('Novo item do menu') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- form -->
                <form id="form-new-menu-item" role="form" autocomplete="off" novalidate>
                    @csrf
                    <!-- inputs -->
                    <div class="row">
                        <!-- menu -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="menu-id-new-menu-item">{{ __('Menu') }}</label>
                                <div class="input-group-none validate-menu-id-new-menu-item">
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('selecione o menu') }}">*</span>
                                    {{ Form::select(
                                        "name",
                                        \App\Models\Menu\Menu::getMenuOptions(),
                                        old("menu_id_new_menu_item"),
                                        ["id" => "menu-id-new-menu-item", "name" => "menu_id_new_menu_item", "class" => "form-control select-nosearch", "placeholder" => "Selecione", "required"]
                                    )}}
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('menu_id_new_menu_item'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('menu_id_new_menu_item') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- rota -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="route-id-new-menu-item">{{ __('Rota') }}</label>
                                <div class="input-group-none validate-route-id-new-menu-item">
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('selecione a rota do item do menu') }}">*</span>
                                    {{ Form::select(
                                        "name",
                                        \App\Models\Route\Route::getRoutesOptions(),
                                        old("route_id_new_menu_item"),
                                        ["id" => "route-id-new-menu-item", "name" => "route_id_new_menu_item", "class" => "form-control", "placeholder" => "Selecione", "required"]
                                    )}}
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('route_id_new_menu_item'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('route_id_new_menu_item') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- nome -->
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label class="form-control-label" for="name-new-menu-item">{{ __('Nome') }}</label>
                                <div class="input-group input-group-merge validate-name-new-menu-item">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('name_new_menu_item') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-genderless"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                    <input type="text" id="name-new-menu-item" name="name_new_menu_item" class="form-control {{ $errors->has('name_new_menu_item') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome do item do menu') }}" value="{{ old('name_new_menu_item') }}" minlength="3" maxlength="191" required onkeypress="return soLetrasCaracteres(event);" onkeyup="primeiraLetraMaiuscula(this);" @if ($errors->has('name_new_menu_item')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_new_menu_item'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_new_menu_item') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- ordem -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="order-new-menu-item">{{ __('Ordem de listagem') }}</label>
                                <div class="input-group input-group-merge validate-order-new-menu-item">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('order_new_menu_item') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-sort-amount-down"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('nº da ordem de listagem') }}">*</span>
                                    <input type="number" id="order-new-menu-item" name="order_new_menu_item" class="form-control {{ $errors->has('order_new_menu_item') ? 'is-invalid' : '' }}" placeholder="{{ __('nº') }}" value="{{ old('order_new_menu_item') }}" maxlength="10" required onkeypress="return soNumeros(event);" @if ($errors->has('order_new_menu_item')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('order_new_menu_item'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('order_new_menu_item') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- botão -->
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label class="form-control-label" for="button-new-menu-item">{{ __('Botão') }}</label>
                                <div class="input-group input-group-merge validate-button-new-menu-item">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('button_new_menu_item') ? 'is-invalid' : '' }}">
                                            <i class="far fa-hand-pointer"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                    <input type="text" id="button-new-menu-item" name="button_new_menu_item" class="form-control {{ $errors->has('button_new_menu_item') ? 'is-invalid' : '' }}" placeholder="{{ __('Botão do item do menu') }}" value="{{ old('button_new_menu_item') }}" minlength="3" maxlength="191" oninput="this.value = this.value.toLowerCase();" onkeypress="return caracteresGrupo(event);" @if ($errors->has('button_new_menu_item')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('button_new_menu_item'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('button_new_menu_item') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- lista -->
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="form-control-label" for="list-new-menu-item">{{ __('Lista') }}</label>
                                <div class="input-group input-group-merge validate-list-new-menu-item">
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('selecione se o item do menu for de uma tabela de listagem') }}">*</span>
                                    <div class="custom-control custom-checkbox mt-2">
                                        <input type="checkbox" id="list-new-menu-item" name="list_new_menu_item" class="custom-control-input" {{ old('list_new_menu_item') ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="list-new-menu-item"></label>
                                    </div>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('list_new_menu_item'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('list_new_menu_item') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- oculto -->
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="form-control-label" for="hidden-new-menu-item">{{ __('Oculto') }}</label>
                                <div class="input-group input-group-merge validate-hidden-new-menu-item">
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('selecione se o item do menu for oculto') }}">*</span>
                                    <div class="custom-control custom-checkbox custom-checkbox-dark mt-2">
                                        <input type="checkbox" id="hidden-new-menu-item" name="hidden_new_menu_item" class="custom-control-input" {{ old('hidden_new_menu_item') ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="hidden-new-menu-item"></label>
                                    </div>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('hidden_new_menu_item'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('hidden_new_menu_item') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- descrição -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="description-new-menu-item">{{ __('Descrição') }}</label>
                                <div class="input-group-none validate-description-new-menu-item">
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('descrição do item do menu com no mínimo 10 caracteres') }}">*</span>
                                    <textarea id="description-new-menu-item" name="description_new_menu_item" rows="3" resize="none" class="form-control {{ $errors->has('description_new_menu_item') ? 'is-invalid' : '' }}" placeholder="{{ __('Descrição') }}" minlength="10" maxlength="1500" onkeyup="primeiraLetraMaiuscula(this);" @if ($errors->has('description_new_menu_item')) autofocus @endif>{{ old('description_new_menu_item') }}</textarea>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('description_new_menu_item'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('description_new_menu_item') }}</div>
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
                        @if (app('router')->has('menu.item.store') && \App\Models\Permission::routePermission('menu.item.store'))
                            <button type="submit" id="btn-new-menu-item" class="btn btn-outline-success mr-4">{{ __('Criar item do menu') }}</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
