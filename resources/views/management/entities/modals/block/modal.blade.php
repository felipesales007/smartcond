<div id="modal-block-entity" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-block-entity-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- título -->
            <div class="modal-header">
                <h5 id="modal-block-entity-label" class="modal-title text-uppercase text-monospace ml-1">
                    <b>{{ __('Bloquear entidade') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- form -->
                <form id="form-block-entity" role="form" autocomplete="off" novalidate>
                    @csrf
                    <!-- inputs -->
                    <div class="row">
                        <!-- id -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="id-block-entity">{{ __('ID') }}</label>
                                <div class="input-group input-group-merge validate-id-block-entity">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('id_block_entity') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('id da entidade') }}">*</span>
                                    <input readonly type="number" id="id-block-entity" name="id_block_entity" class="form-control {{ $errors->has('id_block_entity') ? 'is-invalid' : '' }}" placeholder="{{ __('ID da entidade') }}" value="{{ old('id_block_entity') }}" maxlength="20" required onkeypress="return onlyNumbers(event);" @if ($errors->has('id_block_entity')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('id_block_entity'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('id_block_entity') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- bloquear -->
                        <div class="col-lg-12">
                            <div class="form-group float-right mt--1 mb-0">
                                <label class="form-control-label fe-toggle-title" for="blocked-block-entity">Bloqueado </label>
                                <div class="input-group input-group-merge fe-toggle-line validate-blocked-block-entity">
                                    <label class="custom-toggle custom-toggle-warning">
                                        <input type="checkbox" id="blocked-block-entity" name="blocked_block_entity" onchange="changeCheckbox(this, 'entidade')">
                                        <span class="custom-toggle-slider rounded-circle" data-label-off="Não" data-label-on="Sim"></span>
                                    </label>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('blocked_block_entity'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('blocked_block_entity') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- bloquear por data -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label id="blocked-at-block-entity-text" class="form-control-label" for="blocked-at-block-entity"></label>
                                <div class="input-group input-group-merge validate-blocked-at-block-entity">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('blocked_at_block_entity') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('bloquear entidade até a data') }}">*</span>
                                    <input type="tel" id="blocked-at-block-entity" name="blocked_at_block_entity" class="form-control datepicker-clean-onwards mask-date {{ $errors->has('blocked_at_block_entity') ? 'is-invalid' : '' }}" placeholder="{{ __('Informe a data') }}" value="{{ old('blocked_at_block_entity') }}" minlength="10" maxlength="10" onkeyup="statusCheckbox(this, 'entidade');" onchange="statusCheckbox(this, 'entidade');" @if ($errors->has('blocked_at_block_entity')) autofocus @endif>
                                    <!-- limpar datepicker -->
                                    <div class="input-group-append" onclick="clearInputDatepicker(this);">
                                        <span class="input-group-text">
                                            <i id="blocked-at-block-entity-clean" class="fe-input-icon far fa-calendar-times"></i>
                                        </span>
                                    </div>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('blocked_at_block_entity'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('blocked_at_block_entity') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- informações -->
                    <div class="fe-mouse">
                        <div class="mt--1">
                            <small class="text-light">{{ __('bloqueie a entidade até uma data determinada ou permanentemente') }}</small>
                        </div>
                    </div>
                    <!-- botões -->
                    <div class="text-right float-right fe-form-footer">
                        <a href="javascript:void(0)" class="mr-4" data-dismiss="modal">{{ __('Cancelar') }}</a>
                        <button type="submit" id="btn-block-entity" class="btn btn-outline-warning mr-4">{{ __('Bloquear entidade') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
