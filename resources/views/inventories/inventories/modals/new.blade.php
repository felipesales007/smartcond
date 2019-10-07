<div id="modal-new-inventory" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-new-inventory-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <!-- título -->
            <div class="modal-header">
                <h5 id="modal-new-inventory-label" class="modal-title text-uppercase text-monospace ml-1">
                    <b>{{ __('Novo item do inventário') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- form -->
                <form id="form-new-inventory" role="form" autocomplete="off" novalidate>
                    @csrf
                    <!-- inputs -->
                    <div class="row">
                        <!-- departamento -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="department-id-new-inventory">{{ __('Departamento') }}</label>
                                <div class="input-group-none validate-department-id-new-inventory">
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('selecione o departamento') }}">*</span>
                                    {{ Form::select(
                                        "name",
                                        \App\Models\Department::getDepartmentsOptions(),
                                        old("department_id_new_inventory"),
                                        ["id" => "department-id-new-inventory", "name" => "department_id_new_inventory", "class" => "form-control", "placeholder" => "Selecione", "required"]
                                    )}}
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('department_id_new_inventory'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('department_id_new_inventory') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- categoria -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="inventory-category-id-new-inventory">{{ __('Categoria') }}</label>
                                <div class="input-group-none validate-inventory-category-id-new-inventory">
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('selecione a categoria') }}">*</span>
                                    {{ Form::select(
                                        "name",
                                        \App\Models\Inventory\InventoryCategory::getInventoyCategoriesOptions(),
                                        old("inventory_category_id_new_inventory"),
                                        ["id" => "inventory-category-id-new-inventory", "name" => "inventory_category_id_new_inventory", "class" => "form-control", "placeholder" => "Selecione", "required"]
                                    )}}
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('inventory_category_id_new_inventory'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('inventory_category_id_new_inventory') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- estado do item -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="inventory-state-id-new-inventory">{{ __('Estado do item') }}</label>
                                <div class="input-group-none validate-inventory-state-id-new-inventory">
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('selecione o estado do item') }}">*</span>
                                    {{ Form::select(
                                        "name",
                                        \App\Models\Inventory\InventoryState::getInventoyStatesOptions(),
                                        old("inventory_state_id_new_inventory"),
                                        ["id" => "inventory-state-id-new-inventory", "name" => "inventory_state_id_new_inventory", "class" => "form-control select-nosearch", "required"]
                                    )}}
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('inventory_state_id_new_inventory'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('inventory_state_id_new_inventory') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- nº patrimônio -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label" for="patrimonial-number-new-inventory">{{ __('nº do patrimônio') }}</label>
                                <div class="input-group input-group-merge validate-patrimonial-number-new-inventory">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('patrimonial_number_new_inventory') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-barcode"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('nº do patrimônio do item do inventário') }}">*</span>
                                    <input type="number" id="patrimonial-number-new-inventory" name="patrimonial_number_new_inventory" class="form-control {{ $errors->has('patrimonial_number_new_inventory') ? 'is-invalid' : '' }}" placeholder="{{ __('nº do patrimônio') }}" value="{{ old('patrimonial_number_new_inventory') }}" maxlength="191" onkeypress="return soNumeros(event);" @if ($errors->has('patrimonial_number_new_inventory')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('patrimonial_number_new_inventory'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('patrimonial_number_new_inventory') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- nome -->
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="form-control-label" for="name-new-inventory">{{ __('Nome do item') }}</label>
                                <div class="input-group input-group-merge validate-name-new-inventory">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('name_new_inventory') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-dolly-flatbed"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                    <input type="text" id="name-new-inventory" name="name_new_inventory" class="form-control {{ $errors->has('name_new_inventory') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome do item') }}" value="{{ old('name_new_inventory') }}" minlength="3" maxlength="191" required onkeypress="return soLetrasCaracteres(event);" onkeyup="letraMaiuscula('name-new-inventory');" @if ($errors->has('name_new_inventory')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_new_inventory'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_new_inventory') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- marca -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="brand-new-inventory">{{ __('Marca') }}</label>
                                <div class="input-group input-group-merge validate-brand-new-inventory">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('brand_new_inventory') ? 'is-invalid' : '' }}">
                                            <i class="fab fa-connectdevelop"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('Marca do item informado pelo fabricante') }}">*</span>
                                    <input type="text" id="brand-new-inventory" name="brand_new_inventory" class="form-control {{ $errors->has('brand_new_inventory') ? 'is-invalid' : '' }}" placeholder="{{ __('Marca') }}" value="{{ old('brand_new_inventory') }}" minlength="3" maxlength="191" onkeypress="return soLetrasCaracteres(event);" onkeyup="letraMaiuscula('brand-new-inventory');" @if ($errors->has('brand_new_inventory')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('brand_new_inventory'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('brand_new_inventory') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- modelo -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label" for="model-new-inventory">{{ __('Modelo') }}</label>
                                <div class="input-group input-group-merge validate-model-new-inventory">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('model_new_inventory') ? 'is-invalid' : '' }}">
                                            <i class="fab fa-codepen"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('Modelo do item informado pelo fabricante') }}">*</span>
                                    <input type="text" id="model-new-inventory" name="model_new_inventory" class="form-control {{ $errors->has('model_new_inventory') ? 'is-invalid' : '' }}" placeholder="{{ __('Modelo') }}" value="{{ old('model_new_inventory') }}" maxlength="191" @if ($errors->has('model_new_inventory')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('model_new_inventory'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('model_new_inventory') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- nº de série -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="serial-number-new-inventory">{{ __('nº de série') }}</label>
                                <div class="input-group input-group-merge validate-serial-number-new-inventory">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('serial_number_new_inventory') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-sort-numeric-up"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('número de série do item informado pelo fabricante') }}">*</span>
                                    <input type="text" id="serial-number-new-inventory" name="serial_number_new_inventory" class="form-control {{ $errors->has('serial_number_new_inventory') ? 'is-invalid' : '' }}" placeholder="{{ __('nº de série') }}" value="{{ old('serial_number_new_inventory') }}" maxlength="191" @if ($errors->has('serial_number_new_inventory')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('serial_number_new_inventory'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('serial_number_new_inventory') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- nº da nota fiscal -->
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="form-control-label" for="invoice-new-inventory">{{ __('nº da nota fiscal') }}</label>
                                <div class="input-group input-group-merge validate-invoice-new-inventory">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('invoice_new_inventory') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-clipboard"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('número da nota fiscal do item do inventário') }}">*</span>
                                    <input type="text" id="invoice-new-inventory" name="invoice_new_inventory" class="form-control {{ $errors->has('invoice_new_inventory') ? 'is-invalid' : '' }}" placeholder="{{ __('nº da nota fiscal') }}" value="{{ old('invoice_new_inventory') }}" maxlength="191" @if ($errors->has('invoice_new_inventory')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('invoice_new_inventory'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('invoice_new_inventory') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- valor -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label d-block" for="value-new-inventory">
                                    {{ __('R$') }}
                                    <span class="small float-right mt-1">{{ __('valor em reais') }}</span>
                                </label>
                                <div class="input-group input-group-merge validate-value-new-inventory">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('value_new_inventory') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-dollar-sign"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('valor do item do inventário') }}">*</span>
                                    <input type="text" id="value-new-inventory" name="value_new_inventory" class="form-control to-real {{ $errors->has('value_new_inventory') ? 'is-invalid' : '' }}" placeholder="{{ __('R$') }}" value="{{ old('value_new_inventory') }}" maxlength="191" @if ($errors->has('value_new_inventory')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('value_new_inventory'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('value_new_inventory') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- voltagem -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label" for="voltage-id-new-inventory">{{ __('Voltagem') }}</label>
                                <div class="input-group-none validate-voltage-id-new-inventory">
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('selecione a voltagem') }}">*</span>
                                    {{ Form::select(
                                        "name",
                                        \App\Models\Voltage::getVoltagesOptions(),
                                        old("voltage_id_new_inventory"),
                                        ["id" => "voltage-id-new-inventory", "name" => "voltage_id_new_inventory", "class" => "form-control select-nosearch", "required"]
                                    )}}
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('voltage_id_new_inventory'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('voltage_id_new_inventory') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- data de compra -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label" for="purchase-date-new-inventory">{{ __('Data de compra') }}</label>
                                <div class="input-group input-group-merge validate-purchase-date-new-inventory">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('purchase_date_new_inventory') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('data de compra do item') }}">*</span>
                                    <input type="tel" id="purchase-date-new-inventory" name="purchase_date_new_inventory" class="form-control datepicker-back mask-date {{ $errors->has('purchase_date_new_inventory') ? 'is-invalid' : '' }}" placeholder="{{ __('Data de compra') }}" value="{{ old('purchase_date_new_inventory') }}" minlength="10" maxlength="10" @if ($errors->has('purchase_date_new_inventory')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('purchase_date_new_inventory'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('purchase_date_new_inventory') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- data da garantia -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label" for="warranty-date-new-inventory">{{ __('Data da garantia') }}</label>
                                <div class="input-group input-group-merge validate-warranty-date-new-inventory">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('warranty_date_new_inventory') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('data de vencimento da garantia do item') }}">*</span>
                                    <input type="tel" id="warranty-date-new-inventory" name="warranty_date_new_inventory" class="form-control datepicker-onwards mask-date {{ $errors->has('warranty_date_new_inventory') ? 'is-invalid' : '' }}" placeholder="{{ __('Data da garantia') }}" value="{{ old('warranty_date_new_inventory') }}" minlength="10" maxlength="10" @if ($errors->has('warranty_date_new_inventory')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('warranty_date_new_inventory'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('warranty_date_new_inventory') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- descrição -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="description-new-inventory">{{ __('Descrição') }}</label>
                                <div class="input-group-none validate-description-new-inventory">
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('descrição do item do inventário com no mínimo 10 caracteres') }}">*</span>
                                    <textarea id="description-new-inventory" name="description_new_inventory" rows="3" resize="none" class="form-control {{ $errors->has('description_new_inventory') ? 'is-invalid' : '' }}" placeholder="{{ __('Descrição') }}" minlength="10" maxlength="1500" onkeyup="primeiraLetraMaiuscula(this);" @if ($errors->has('description_new_inventory')) autofocus @endif>{{ old('description_new_inventory') }}</textarea>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('description_new_inventory'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('description_new_inventory') }}</div>
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
                        @if (app('router')->has('inventory.store') && \App\Models\Permission::routePermission('inventory.store'))
                            <button type="submit" id="btn-new-inventory" class="btn btn-outline-success mr-4">{{ __('Criar item') }}</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
