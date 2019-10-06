<div id="modal-block-company" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-block-company-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- título -->
            <div class="modal-header">
                <h5 id="modal-block-company-label" class="modal-title text-uppercase text-monospace ml-1">
                    <b>{{ __('Bloquear empresa') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- form -->
                <form id="form-block-company" role="form" autocomplete="off" novalidate>
                    @csrf
                    <!-- inputs -->
                    <div class="row">
                        <!-- id -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="id-block-company">{{ __('ID') }}</label>
                                <div class="input-group input-group-merge validate-id-block-company">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('id_block_company') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('id da empresa') }}">*</span>
                                    <input readonly type="number" id="id-block-company" name="id_block_company" class="form-control {{ $errors->has('id_block_company') ? 'is-invalid' : '' }}" placeholder="{{ __('ID da empresa') }}" value="{{ old('id_block_company') }}" maxlength="20" required onkeypress="return soNumeros(event);" @if ($errors->has('id_block_company')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('id_block_company'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('id_block_company') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- bloquear -->
                        <div class="col-lg-12">
                            <div class="form-group float-right mt--1 mb-0">
                                <label class="form-control-label fe-toggle-title" for="blocked-block-company">Bloqueado </label>
                                <div class="input-group input-group-merge fe-toggle-line validate-blocked-block-company">
                                    <label class="custom-toggle custom-toggle-warning">
                                        <input type="checkbox" id="blocked-block-company" name="blocked_block_company" onchange="changeCheckbox(this, 'empresa')">
                                        <span class="custom-toggle-slider rounded-circle" data-label-off="Não" data-label-on="Sim"></span>
                                    </label>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('blocked_block_company'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('blocked_block_company') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- bloquear por data -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label id="blocked-at-block-company-text" class="form-control-label" for="blocked-at-block-company"></label>
                                <div class="input-group input-group-merge validate-blocked-at-block-company">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('blocked_at_block_company') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('bloquear empresa até a data') }}">*</span>
                                    <input type="tel" id="blocked-at-block-company" name="blocked_at_block_company" class="form-control datepicker-clean-onwards mask-date {{ $errors->has('blocked_at_block_company') ? 'is-invalid' : '' }}" placeholder="{{ __('Informe a data') }}" value="{{ old('blocked_at_block_company') }}" minlength="10" maxlength="10" onkeyup="statusCheckbox(this, 'empresa');" onchange="statusCheckbox(this, 'empresa');" @if ($errors->has('blocked_at_block_company')) autofocus @endif>
                                    <!-- limpar datepicker -->
                                    <div class="input-group-append" onclick="limparInputDatepicker(this);">
                                        <span class="input-group-text">
                                            <i id="blocked-at-block-company-clean" class="fe-input-icone far fa-calendar-times"></i>
                                        </span>
                                    </div>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('blocked_at_block_company'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('blocked_at_block_company') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- informações -->
                    <div class="fe-mouse-off">
                        <div class="mt--1">
                            <small class="text-light">{{ __('bloqueie a empresa até uma data determinada ou permanentemente') }}</small>
                        </div>
                    </div>
                    <!-- botões -->
                    <div class="text-right float-right fe-form-footer">
                        <a href="javascript:void(0)" class="mr-4" data-dismiss="modal">{{ __('Cancelar') }}</a>
                        @if (app('router')->has('company.block') && \App\Models\Permission::routePermission('company.block'))
                            <button type="submit" id="btn-block-company" class="btn btn-outline-warning mr-4">{{ __('Bloquear empresa') }}</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
