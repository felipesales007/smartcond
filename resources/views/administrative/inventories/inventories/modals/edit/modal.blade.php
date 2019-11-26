<div id="modal-edit-inventory" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-edit-inventory-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <!-- título -->
            <div class="modal-header">
                <h5 id="modal-edit-inventory-label" class="modal-title text-uppercase text-monospace ml-1">
                    <b>{{ __('Editar item do inventário') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- form -->
                <form id="form-edit-inventory" role="form" autocomplete="off" novalidate>
                    @csrf
                    <!-- inputs -->
                    <div class="row">
                        <!-- id -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="id-edit-inventory">{{ __('ID') }}</label>
                                <div class="input-group input-group-merge validate-id-edit-inventory">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('id_edit_inventory') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('id do item do inventário') }}">*</span>
                                    <input readonly type="number" id="id-edit-inventory" name="id_edit_inventory" class="form-control {{ $errors->has('id_edit_inventory') ? 'is-invalid' : '' }}" placeholder="{{ __('ID do inventário') }}" value="{{ old('id_edit_inventory') }}" maxlength="20" required onkeypress="return onlyNumbers(event);" @if ($errors->has('id_edit_inventory')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('id_edit_inventory'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('id_edit_inventory') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- imagem -->
                        <div class="col-lg-2 mt-1">
                            <div class="form-group">
                                <div class="input-group-none validate-image-image-edit-inventory">
                                    <!-- botão de remover foto -->
                                    <div class="fe-remove-preview-11 fe-remove-preview-small">
                                        <i class="far fa-times-circle"></i>
                                    </div>
                                    <!-- imagem do perfil estilizada -->
                                    <div class="fe-grid-preview-11">
                                        <div class="fe-grid-preview-item-11 fe-preview-small">
                                            <div class="fe-preview-11 fe-preview-small fe-default-image fe-img-center">
                                                <img class="fe-img-preview-11 fe-img-preview-cover" src="" alt="">
                                            </div>
                                            <div class="fe-grid-preview-text-11 text-monospace small">
                                                <span>Selecionar</span>
                                                <p>Imagem</p>
                                            </div>
                                            <!-- arquivo do perfil oculto -->
                                            <input type="file" id="image-image-edit-inventory" name="image_image_edit_inventory" class="fe-image-11" accept="image/jpg, image/jpeg, image/png, image/gif">
                                            <label for="image-edit-inventory"></label>
                                            <input type="text" id="image-edit-inventory" name="image_edit_inventory" class="fe-image-url-11" value="">
                                        </div>
                                    </div>
                                    <!-- alerta de erro -->
                                    @if ($errors->has('image_image_edit_inventory'))
                                        <div class="invalid-feedback" role="alert">{{ $errors->first('image_image_edit_inventory') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- departamento -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="department-id-edit-inventory">{{ __('Departamento') }}</label>
                                <div class="input-group-none validate-department-id-edit-inventory">
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('selecione o departamento') }}">*</span>
                                    {{ Form::select(
                                        "name",
                                        \App\Models\Department::getDepartmentsOptions(),
                                        old("department_id_edit_inventory"),
                                        ["id" => "department-id-edit-inventory", "name" => "department_id_edit_inventory", "class" => "form-control", "placeholder" => "Selecione", "required"]
                                    )}}
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('department_id_edit_inventory'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('department_id_edit_inventory') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- categoria -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label" for="inventory-category-id-edit-inventory">{{ __('Categoria') }}</label>
                                <div class="input-group-none validate-inventory-category-id-edit-inventory">
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('selecione a categoria') }}">*</span>
                                    {{ Form::select(
                                        "name",
                                        \App\Models\Inventory\InventoryCategory::getInventoyCategoriesOptions(),
                                        old("inventory_category_id_edit_inventory"),
                                        ["id" => "inventory-category-id-edit-inventory", "name" => "inventory_category_id_edit_inventory", "class" => "form-control", "placeholder" => "Selecione", "required"]
                                    )}}
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('inventory_category_id_edit_inventory'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('inventory_category_id_edit_inventory') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- estado do item -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label" for="inventory-state-id-edit-inventory">{{ __('Estado do item') }}</label>
                                <div class="input-group-none validate-inventory-state-id-edit-inventory">
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('selecione o estado do item') }}">*</span>
                                    {{ Form::select(
                                        "name",
                                        \App\Models\Inventory\InventoryState::getInventoyStatesOptions(),
                                        old("inventory_state_id_edit_inventory"),
                                        ["id" => "inventory-state-id-edit-inventory", "name" => "inventory_state_id_edit_inventory", "class" => "form-control select-nosearch", "required"]
                                    )}}
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('inventory_state_id_edit_inventory'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('inventory_state_id_edit_inventory') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- nº patrimônio -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label" for="patrimonial-number-edit-inventory">{{ __('nº do patrimônio') }}</label>
                                <div class="input-group input-group-merge validate-patrimonial-number-edit-inventory">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('patrimonial_number_edit_inventory') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-barcode"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('nº do patrimônio do item do inventário') }}">*</span>
                                    <input type="number" id="patrimonial-number-edit-inventory" name="patrimonial_number_edit_inventory" class="form-control {{ $errors->has('patrimonial_number_edit_inventory') ? 'is-invalid' : '' }}" placeholder="{{ __('nº do patrimônio') }}" value="{{ old('patrimonial_number_edit_inventory') }}" maxlength="191" onkeypress="return onlyNumbers(event);" @if ($errors->has('patrimonial_number_edit_inventory')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('patrimonial_number_edit_inventory'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('patrimonial_number_edit_inventory') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- nome -->
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="form-control-label" for="name-edit-inventory">{{ __('Nome do item') }}</label>
                                <div class="input-group input-group-merge validate-name-edit-inventory">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('name_edit_inventory') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-dolly-flatbed"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                    <input type="text" id="name-edit-inventory" name="name_edit_inventory" class="form-control {{ $errors->has('name_edit_inventory') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome do item') }}" value="{{ old('name_edit_inventory') }}" minlength="3" maxlength="191" required onkeypress="return onlyLettersCharacters(event);" onkeyup="letterUppercase('name-edit-inventory');" @if ($errors->has('name_edit_inventory')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_edit_inventory'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_edit_inventory') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- marca -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="brand-edit-inventory">{{ __('Marca') }}</label>
                                <div class="input-group input-group-merge validate-brand-edit-inventory">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('brand_edit_inventory') ? 'is-invalid' : '' }}">
                                            <i class="fab fa-connectdevelop"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('Marca do item informado pelo fabricante') }}">*</span>
                                    <input type="text" id="brand-edit-inventory" name="brand_edit_inventory" class="form-control {{ $errors->has('brand_edit_inventory') ? 'is-invalid' : '' }}" placeholder="{{ __('Marca') }}" value="{{ old('brand_edit_inventory') }}" minlength="3" maxlength="191" onkeypress="return onlyLettersCharacters(event);" onkeyup="letterUppercase('brand-edit-inventory');" @if ($errors->has('brand_edit_inventory')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('brand_edit_inventory'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('brand_edit_inventory') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- modelo -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label" for="model-edit-inventory">{{ __('Modelo') }}</label>
                                <div class="input-group input-group-merge validate-model-edit-inventory">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('model_edit_inventory') ? 'is-invalid' : '' }}">
                                            <i class="fab fa-codepen"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('Modelo do item informado pelo fabricante') }}">*</span>
                                    <input type="text" id="model-edit-inventory" name="model_edit_inventory" class="form-control {{ $errors->has('model_edit_inventory') ? 'is-invalid' : '' }}" placeholder="{{ __('Modelo') }}" value="{{ old('model_edit_inventory') }}" maxlength="191" @if ($errors->has('model_edit_inventory')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('model_edit_inventory'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('model_edit_inventory') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- nº de série -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="serial-number-edit-inventory">{{ __('nº de série') }}</label>
                                <div class="input-group input-group-merge validate-serial-number-edit-inventory">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('serial_number_edit_inventory') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-sort-numeric-up"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('número de série do item informado pelo fabricante') }}">*</span>
                                    <input type="text" id="serial-number-edit-inventory" name="serial_number_edit_inventory" class="form-control {{ $errors->has('serial_number_edit_inventory') ? 'is-invalid' : '' }}" placeholder="{{ __('nº de série') }}" value="{{ old('serial_number_edit_inventory') }}" maxlength="191" @if ($errors->has('serial_number_edit_inventory')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('serial_number_edit_inventory'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('serial_number_edit_inventory') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- nº da nota fiscal -->
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="form-control-label" for="invoice-edit-inventory">{{ __('nº da nota fiscal') }}</label>
                                <div class="input-group input-group-merge validate-invoice-edit-inventory">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('invoice_edit_inventory') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-clipboard"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('número da nota fiscal do item do inventário') }}">*</span>
                                    <input type="text" id="invoice-edit-inventory" name="invoice_edit_inventory" class="form-control {{ $errors->has('invoice_edit_inventory') ? 'is-invalid' : '' }}" placeholder="{{ __('nº da nota fiscal') }}" value="{{ old('invoice_edit_inventory') }}" maxlength="191" @if ($errors->has('invoice_edit_inventory')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('invoice_edit_inventory'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('invoice_edit_inventory') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- valor -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label d-block" for="value-edit-inventory">
                                    {{ __('R$') }}
                                    <span class="small float-right mt-1">{{ __('valor em reais') }}</span>
                                </label>
                                <div class="input-group input-group-merge validate-value-edit-inventory">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('value_edit_inventory') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-dollar-sign"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('valor do item do inventário') }}">*</span>
                                    <input type="text" id="value-edit-inventory" name="value_edit_inventory" class="form-control to-real {{ $errors->has('value_edit_inventory') ? 'is-invalid' : '' }}" placeholder="{{ __('R$') }}" value="{{ old('value_edit_inventory') }}" maxlength="191" @if ($errors->has('value_edit_inventory')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('value_edit_inventory'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('value_edit_inventory') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- voltagem -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label" for="voltage-id-edit-inventory">{{ __('Voltagem') }}</label>
                                <div class="input-group-none validate-voltage-id-edit-inventory">
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('selecione a voltagem') }}">*</span>
                                    {{ Form::select(
                                        "name",
                                        \App\Models\Voltage::getVoltagesOptions(),
                                        old("voltage_id_edit_inventory"),
                                        ["id" => "voltage-id-edit-inventory", "name" => "voltage_id_edit_inventory", "class" => "form-control select-nosearch", "required"]
                                    )}}
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('voltage_id_edit_inventory'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('voltage_id_edit_inventory') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- data de compra -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label" for="purchase-date-edit-inventory">{{ __('Data de compra') }}</label>
                                <div class="input-group input-group-merge validate-purchase-date-edit-inventory">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('purchase_date_edit_inventory') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('data de compra do item') }}">*</span>
                                    <input type="tel" id="purchase-date-edit-inventory" name="purchase_date_edit_inventory" class="form-control datepicker-back mask-date {{ $errors->has('purchase_date_edit_inventory') ? 'is-invalid' : '' }}" placeholder="{{ __('Data de compra') }}" value="{{ old('purchase_date_edit_inventory') }}" minlength="10" maxlength="10" @if ($errors->has('purchase_date_edit_inventory')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('purchase_date_edit_inventory'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('purchase_date_edit_inventory') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- data da garantia -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label" for="warranty-date-edit-inventory">{{ __('Data da garantia') }}</label>
                                <div class="input-group input-group-merge validate-warranty-date-edit-inventory">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('warranty_date_edit_inventory') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('data de vencimento da garantia do item') }}">*</span>
                                    <input type="tel" id="warranty-date-edit-inventory" name="warranty_date_edit_inventory" class="form-control datepicker-onwards mask-date {{ $errors->has('warranty_date_edit_inventory') ? 'is-invalid' : '' }}" placeholder="{{ __('Data da garantia') }}" value="{{ old('warranty_date_edit_inventory') }}" minlength="10" maxlength="10" @if ($errors->has('warranty_date_edit_inventory')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('warranty_date_edit_inventory'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('warranty_date_edit_inventory') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- descrição -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="description-edit-inventory">{{ __('Descrição') }}</label>
                                <div class="input-group-none validate-description-edit-inventory">
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('descrição do item do inventário com no mínimo 10 caracteres') }}">*</span>
                                    <textarea id="description-edit-inventory" name="description_edit_inventory" rows="3" resize="none" class="form-control {{ $errors->has('description_edit_inventory') ? 'is-invalid' : '' }}" placeholder="{{ __('Descrição') }}" minlength="10" maxlength="1500" onkeyup="firstLetterUppercase(this);" @if ($errors->has('description_edit_inventory')) autofocus @endif>{{ old('description_edit_inventory') }}</textarea>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('description_edit_inventory'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('description_edit_inventory') }}</div>
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
                        <button type="submit" id="btn-edit-inventory" class="btn btn-outline-success mr-4">{{ __('Editar item') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
