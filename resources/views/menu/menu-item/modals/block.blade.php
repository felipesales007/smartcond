<div id="modal-block-menu-item" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-block-menu-item-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- título -->
            <div class="modal-header">
                <h5 id="modal-block-menu-item-label" class="modal-title text-uppercase text-monospace ml-1">
                    <b>{{ __('Bloquear item do menu') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- form -->
                <form id="form-block-menu-item" role="form" autocomplete="off" novalidate>
                    @csrf
                    <!-- inputs -->
                    <div class="row">
                        <!-- id -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="id-block-menu-item">{{ __('ID') }}</label>
                                <div class="input-group input-group-merge validate-id-block-menu-item">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('id_block_menu_item') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('id do item do menu') }}">*</span>
                                    <input readonly type="number" id="id-block-menu-item" name="id_block_menu_item" class="form-control {{ $errors->has('id_block_menu_item') ? 'is-invalid' : '' }}" placeholder="{{ __('ID do item do menu') }}" value="{{ old('id_block_menu_item') }}" maxlength="20" required onkeypress="return soNumeros(event);" @if ($errors->has('id_block_menu_item')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('id_block_menu_item'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('id_block_menu_item') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- bloquear -->
                        <div class="col-lg-12">
                            <div class="form-group mt--1 mb-0">
                                <label class="form-control-label fe-toggle-title" for="blocked-block-menu-item">Bloqueado </label>
                                <div class="input-group input-group-merge fe-toggle-line validate-blocked-block-menu-item">
                                    <label class="custom-toggle custom-toggle-warning">
                                        <input type="checkbox" id="blocked-block-menu-item" name="blocked_block_menu_item" onchange="changeCheckbox(this, 'item do menu')">
                                        <span class="custom-toggle-slider rounded-circle" data-label-off="Não" data-label-on="Sim"></span>
                                    </label>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('blocked_block_menu_item'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('blocked_block_menu_item') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- informação -->
                    <div class="fe-mouse-off">
                        <div class="mt--1">
                            <small class="text-light">{{ __('ao bloquear o item do menu o mesmo ficará sem ação') }}</small>
                        </div>
                    </div>
                    <!-- botões -->
                    <div class="text-right float-right fe-form-footer">
                        <a href="javascript:void(0)" class="mr-4" data-dismiss="modal">{{ __('Cancelar') }}</a>
                        @if (app('router')->has('menu.item.block') && \App\Models\Permission::routePermission('menu.item.block'))
                            <button type="submit" id="btn-block-menu-item" class="btn btn-outline-warning mr-4">{{ __('Bloquear item do menu') }}</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
