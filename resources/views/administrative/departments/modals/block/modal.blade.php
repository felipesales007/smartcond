<div id="modal-block-department" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-block-department-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- título -->
            <div class="modal-header">
                <h5 id="modal-block-department-label" class="modal-title text-uppercase text-monospace ml-1">
                    <b>{{ __('Bloquear departamento') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- form -->
                <form id="form-block-department" role="form" autocomplete="off" novalidate>
                    @csrf
                    <!-- inputs -->
                    <div class="row">
                        <!-- id -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="id-block-department">{{ __('ID') }}</label>
                                <div class="input-group input-group-merge validate-id-block-department">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('id_block_department') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('id do departamento') }}">*</span>
                                    <input readonly type="number" id="id-block-department" name="id_block_department" class="form-control {{ $errors->has('id_block_department') ? 'is-invalid' : '' }}" placeholder="{{ __('ID do departamento') }}" value="{{ old('id_block_department') }}" maxlength="20" required onkeypress="return onlyNumbers(event);" @if ($errors->has('id_block_department')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('id_block_department'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('id_block_department') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- bloquear -->
                        <div class="col-lg-12">
                            <div class="form-group mt--1 mb-0">
                                <label class="form-control-label fe-toggle-title" for="blocked-block-department">Bloqueado </label>
                                <div class="input-group input-group-merge fe-toggle-line validate-blocked-block-department">
                                    <label class="custom-toggle custom-toggle-warning">
                                        <input type="checkbox" id="blocked-block-department" name="blocked_block_department" onchange="changeCheckbox(this, 'departamento')">
                                        <span class="custom-toggle-slider rounded-circle" data-label-off="Não" data-label-on="Sim"></span>
                                    </label>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('blocked_block_department'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('blocked_block_department') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- informação -->
                    <div class="fe-mouse">
                        <div class="mt--1">
                            <small class="text-light">{{ __('bloqueie o departamento para ela ficar impossibilitada de ações') }}</small>
                        </div>
                    </div>
                    <!-- botões -->
                    <div class="text-right float-right fe-form-footer">
                        <a href="javascript:void(0)" class="mr-4" data-dismiss="modal">{{ __('Cancelar') }}</a>
                        <button type="submit" id="btn-block-department" class="btn btn-outline-warning mr-4">{{ __('Bloquear departamento') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
