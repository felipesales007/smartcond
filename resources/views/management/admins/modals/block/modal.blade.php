<div id="modal-block-admin" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-block-admin-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- título -->
            <div class="modal-header">
                <h5 id="modal-block-admin-label" class="modal-title text-uppercase text-monospace ml-1">
                    <b>{{ __('Bloquear administrador') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- form -->
                <form id="form-block-admin" role="form" autocomplete="off" novalidate>
                    @csrf
                    <!-- inputs -->
                    <div class="row">
                        <!-- id -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="id-block-admin">{{ __('ID') }}</label>
                                <div class="input-group input-group-merge validate-id-block-admin">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('id_block_admin') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('id do administrador') }}">*</span>
                                    <input readonly type="number" id="id-block-admin" name="id_block_admin" class="form-control {{ $errors->has('id_block_admin') ? 'is-invalid' : '' }}" placeholder="{{ __('ID do administrador') }}" value="{{ old('id_block_admin') }}" maxlength="20" required onkeypress="return onlyNumbers(event);" @if ($errors->has('id_block_admin')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('id_block_admin'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('id_block_admin') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- bloquear -->
                        <div class="col-lg-12">
                            <div class="form-group float-right mt--1 mb-0">
                                <label class="form-control-label fe-toggle-title" for="blocked-block-admin">Bloqueado </label>
                                <div class="input-group input-group-merge fe-toggle-line validate-blocked-block-admin">
                                    <label class="custom-toggle custom-toggle-warning">
                                        <input type="checkbox" id="blocked-block-admin" name="blocked_block_admin" onchange="changeCheckbox(this, 'administrador')">
                                        <span class="custom-toggle-slider rounded-circle" data-label-off="Não" data-label-on="Sim"></span>
                                    </label>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('blocked_block_admin'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('blocked_block_admin') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- bloquear por data -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label id="blocked-at-block-admin-text" class="form-control-label" for="blocked-at-block-admin"></label>
                                <div class="input-group input-group-merge validate-blocked-at-block-admin">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('blocked_at_block_admin') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('bloquear administrador até a data') }}">*</span>
                                    <input type="tel" id="blocked-at-block-admin" name="blocked_at_block_admin" class="form-control datepicker-clean-onwards mask-date {{ $errors->has('blocked_at_block_admin') ? 'is-invalid' : '' }}" placeholder="{{ __('Informe a data') }}" value="{{ old('blocked_at_block_admin') }}" minlength="10" maxlength="10" onkeyup="statusCheckbox(this, 'administrador');" onchange="statusCheckbox(this, 'administrador');" @if ($errors->has('blocked_at_block_admin')) autofocus @endif>
                                    <!-- limpar datepicker -->
                                    <div class="input-group-append" onclick="clearInputDatepicker(this);">
                                        <span class="input-group-text">
                                            <i id="blocked-at-block-admin-clean" class="fe-input-icon far fa-calendar-times"></i>
                                        </span>
                                    </div>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('blocked_at_block_admin'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('blocked_at_block_admin') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- informações -->
                    <div class="fe-mouse">
                        <div class="mt--1">
                            <small class="text-light">{{ __('bloqueie o administrador até uma data determinada ou permanentemente') }}</small>
                        </div>
                    </div>
                    <!-- botões -->
                    <div class="text-right float-right fe-form-footer">
                        <a href="javascript:void(0)" class="mr-4" data-dismiss="modal">{{ __('Cancelar') }}</a>
                        <button type="submit" id="btn-block-admin" class="btn btn-outline-warning mr-4">{{ __('Bloquear administrador') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
