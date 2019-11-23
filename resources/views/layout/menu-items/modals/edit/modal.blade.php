<div id="modal-edit-menu-item" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-edit-menu-item-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- título -->
            <div class="modal-header">
                <h5 id="modal-edit-menu-item-label" class="modal-title text-uppercase text-monospace ml-1">
                    <b>{{ __('Editar item do menu') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- form -->
                <form id="form-edit-menu-item" role="form" autocomplete="off" novalidate>
                    @csrf
                    <!-- inputs -->
                    <div class="row">
                        <!-- id -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="id-edit-menu-item">{{ __('ID') }}</label>
                                <div class="input-group input-group-merge validate-id-edit-menu-item">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('id_edit_menu_item') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('id do item do menu') }}">*</span>
                                    <input readonly type="number" id="id-edit-menu-item" name="id_edit_menu_item" class="form-control {{ $errors->has('id_edit_menu_item') ? 'is-invalid' : '' }}" placeholder="{{ __('ID do item do menu') }}" value="{{ old('id_edit_menu_item') }}" maxlength="20" required onkeypress="return onlyNumbers(event);" @if ($errors->has('id_edit_menu_item')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('id_edit_menu_item'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('id_edit_menu_item') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- menu -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="menu-id-edit-menu-item">{{ __('Menu') }}</label>
                                <div class="input-group-none validate-menu-id-edit-menu-item">
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('selecione o menu') }}">*</span>
                                    {{ Form::select(
                                        "name",
                                        \App\Models\Menu\Menu::getMenuOptions(),
                                        old("menu_id_edit_menu_item"),
                                        ["id" => "menu-id-edit-menu-item", "name" => "menu_id_edit_menu_item", "class" => "form-control select-nosearch", "placeholder" => "Selecione", "required"]
                                    )}}
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('menu_id_edit_menu_item'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('menu_id_edit_menu_item') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- rota -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="route-id-edit-menu-item">{{ __('Rota') }}</label>
                                <div class="input-group-none validate-route-id-edit-menu-item">
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('selecione a rota do item do menu') }}">*</span>
                                    {{ Form::select(
                                        "name",
                                        \App\Models\Route\Route::getRoutesOptions(),
                                        old("route_id_edit_menu_item"),
                                        ["id" => "route-id-edit-menu-item", "name" => "route_id_edit_menu_item", "class" => "form-control", "placeholder" => "Selecione", "required"]
                                    )}}
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('route_id_edit_menu_item'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('route_id_edit_menu_item') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- nome -->
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label class="form-control-label" for="name-edit-menu-item">{{ __('Nome') }}</label>
                                <div class="input-group input-group-merge validate-name-edit-menu-item">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('name_edit_menu_item') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-genderless"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                    <input type="text" id="name-edit-menu-item" name="name_edit_menu_item" class="form-control {{ $errors->has('name_edit_menu_item') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome do item do menu') }}" value="{{ old('name_edit_menu_item') }}" minlength="3" maxlength="191" required onkeypress="return onlyLettersCharacters(event);" onkeyup="firstLetterUppercase(this);" @if ($errors->has('name_edit_menu_item')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_edit_menu_item'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_edit_menu_item') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- ordem -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="order-edit-menu-item">{{ __('Ordem de listagem') }}</label>
                                <div class="input-group input-group-merge validate-order-edit-menu-item">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('order_edit_menu_item') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-sort-amount-down"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('nº da ordem de listagem') }}">*</span>
                                    <input type="number" id="order-edit-menu-item" name="order_edit_menu_item" class="form-control {{ $errors->has('order_edit_menu_item') ? 'is-invalid' : '' }}" placeholder="{{ __('nº') }}" value="{{ old('order_edit_menu_item') }}" maxlength="10" required onkeypress="return onlyNumbers(event);" @if ($errors->has('order_edit_menu_item')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('order_edit_menu_item'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('order_edit_menu_item') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- botão -->
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label class="form-control-label" for="button-edit-menu-item">{{ __('Botão') }}</label>
                                <div class="input-group input-group-merge validate-button-edit-menu-item">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('button_edit_menu_item') ? 'is-invalid' : '' }}">
                                            <i class="far fa-hand-pointer"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                    <input type="text" id="button-edit-menu-item" name="button_edit_menu_item" class="form-control {{ $errors->has('button_edit_menu_item') ? 'is-invalid' : '' }}" placeholder="{{ __('Botão do item do menu') }}" value="{{ old('button_edit_menu_item') }}" minlength="3" maxlength="191" oninput="this.value = this.value.toLowerCase();" onkeypress="return groupCharacters(event);" @if ($errors->has('button_edit_menu_item')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('button_edit_menu_item'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('button_edit_menu_item') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- principal -->
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="form-control-label" for="main-edit-menu-item">{{ __('Principal') }}</label>
                                <div class="input-group input-group-merge validate-main-edit-menu-item">
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('selecione se o item do menu for a página principal do grupo') }}">*</span>
                                    <div class="custom-control custom-checkbox custom-checkbox-primary mt-2">
                                        <input type="checkbox" id="main-edit-menu-item" name="main_edit_menu_item" class="custom-control-input" {{ old('main_edit_menu_item') ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="main-edit-menu-item"></label>
                                    </div>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('main_edit_menu_item'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('main_edit_menu_item') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- oculto -->
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="form-control-label" for="hidden-edit-menu-item">{{ __('Oculto') }}</label>
                                <div class="input-group input-group-merge validate-hidden-edit-menu-item">
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('selecione se o item do menu for oculto') }}">*</span>
                                    <div class="custom-control custom-checkbox custom-checkbox-primary mt-2">
                                        <input type="checkbox" id="hidden-edit-menu-item" name="hidden_edit_menu_item" class="custom-control-input" {{ old('hidden_edit_menu_item') ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="hidden-edit-menu-item"></label>
                                    </div>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('hidden_edit_menu_item'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('hidden_edit_menu_item') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- descrição -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="description-edit-menu-item">{{ __('Descrição') }}</label>
                                <div class="input-group-none validate-description-edit-menu-item">
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('descrição do item do menu com no mínimo 10 caracteres') }}">*</span>
                                    <textarea id="description-edit-menu-item" name="description_edit_menu_item" rows="3" resize="none" class="form-control {{ $errors->has('description_edit_menu_item') ? 'is-invalid' : '' }}" placeholder="{{ __('Descrição') }}" minlength="10" maxlength="1500" onkeyup="firstLetterUppercase(this);" @if ($errors->has('description_edit_menu_item')) autofocus @endif>{{ old('description_edit_menu_item') }}</textarea>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('description_edit_menu_item'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('description_edit_menu_item') }}</div>
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
                        <button type="submit" id="btn-edit-menu-item" class="btn btn-outline-success mr-4">{{ __('Editar item do menu') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
