<div id="modal-new-menu" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-new-menu-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- título -->
            <div class="modal-header">
                <h5 id="modal-new-menu-label" class="modal-title text-uppercase text-monospace ml-1">
                    <b>{{ __('Novo menu') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- form -->
                <form id="form-new-menu" role="form" autocomplete="off" novalidate>
                    @csrf
                    <!-- inputs -->
                    <div class="row">
                        <!-- nome -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="name-new-menu">{{ __('Nome') }}</label>
                                <div class="input-group input-group-merge validate-name-new-menu">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('name_new_menu') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-list-ul"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                    <input type="text" id="name-new-menu" name="name_new_menu" class="form-control {{ $errors->has('name_new_menu') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome do menu') }}" value="{{ old('name_new_menu') }}" minlength="3" maxlength="191" required onkeypress="return soLetras(event);" onkeyup="primeiraLetraMaiuscula(this);" @if ($errors->has('name_new_menu')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_new_menu'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_new_menu') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- tipo de menu -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="menu-option-id-new-menu">{{ __('Tipo de menu') }}</label>
                                <div class="input-group-none validate-menu-option-id-new-menu">
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('selecione o tipo de menu') }}">*</span>
                                    {{ Form::select(
                                        "name",
                                        \App\Models\Menu\MenuOption::getMenuOptionsOptions(),
                                        old("menu_option_id_new_menu"),
                                        ["id" => "menu-option-id-new-menu", "name" => "menu_option_id_new_menu", "class" => "form-control select-nosearch", "placeholder" => "Selecione", "required"]
                                    )}}
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('menu_option_id_new_menu'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('menu_option_id_new_menu') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- icone -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label d-block" for="icon-new-menu">
                                    {{ __('Ícone') }}
                                    <a href="https://fontawesome.com/icons?d=gallery&m=free" target="_blank" class="small float-right mt-1">{{ __('clique e escolha o ícone') }}</a>
                                </label>
                                <div class="input-group input-group-merge validate-icon-new-menu">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('icon_new_menu') ? 'is-invalid' : '' }}">
                                            <i class="far fa-laugh"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                    <input type="text" id="icon-new-menu" name="icon_new_menu" class="form-control {{ $errors->has('icon_new_menu') ? 'is-invalid' : '' }}" placeholder="{{ __('Ícone do menu') }}" value="{{ old('icon_new_menu') }}" minlength="3" maxlength="191" required oninput="this.value = this.value.toLowerCase();" onkeypress="return caracteresIcone(event);" @if ($errors->has('icon_new_menu')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('icon_new_menu'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('icon_new_menu') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- cor -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="color-id-new-menu">{{ __('Cor do ícone') }}</label>
                                <div class="input-group-none validate-color-id-new-menu">
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('selecione a cor do menu') }}">*</span>
                                    {{ Form::select(
                                        "name",
                                        \App\Models\Color::getColorsOptions(),
                                        old("color_id_new_menu"),
                                        ["id" => "color-id-new-menu", "name" => "color_id_new_menu", "class" => "form-control select-nosearch", "placeholder" => "Selecione", "required"]
                                    )}}
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('color_id_new_menu'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('color_id_new_menu') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- ordem -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="order-new-menu">{{ __('Ordem de listagem') }}</label>
                                <div class="input-group input-group-merge validate-order-new-menu">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('order_new_menu') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-sort-amount-down"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('nº da ordem de listagem') }}">*</span>
                                    <input type="number" id="order-new-menu" name="order_new_menu" class="form-control {{ $errors->has('order_new_menu') ? 'is-invalid' : '' }}" placeholder="{{ __('nº') }}" value="{{ old('order_new_menu') }}" maxlength="10" required onkeypress="return soNumeros(event);" @if ($errors->has('order_new_menu')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('order_new_menu'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('order_new_menu') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- oculto -->
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="form-control-label" for="hidden-new-menu">{{ __('Oculto') }}</label>
                                <div class="input-group input-group-merge validate-hidden-new-menu">
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('selecione se o menu for oculto') }}">*</span>
                                    <div class="custom-control custom-checkbox custom-checkbox-primary mt-2">
                                        <input type="checkbox" id="hidden-new-menu" name="hidden_new_menu" class="custom-control-input" {{ old('hidden_new_menu') ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="hidden-new-menu"></label>
                                    </div>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('hidden_new_menu'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('hidden_new_menu') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- descrição -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="description-new-menu">{{ __('Descrição') }}</label>
                                <div class="input-group-none validate-description-new-menu">
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('descrição do menu com no mínimo 10 caracteres') }}">*</span>
                                    <textarea id="description-new-menu" name="description_new_menu" rows="3" resize="none" class="form-control {{ $errors->has('description_new_menu') ? 'is-invalid' : '' }}" placeholder="{{ __('Descrição') }}" minlength="10" maxlength="1500" onkeyup="primeiraLetraMaiuscula(this);" @if ($errors->has('description_new_menu')) autofocus @endif>{{ old('description_new_menu') }}</textarea>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('description_new_menu'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('description_new_menu') }}</div>
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
                        @if (app('router')->has('menu.store') && \App\Models\Permission::routePermission('menu.store'))
                            <button type="submit" id="btn-new-menu" class="btn btn-outline-success mr-4">{{ __('Criar menu') }}</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
