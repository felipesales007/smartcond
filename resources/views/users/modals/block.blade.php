<div id="modal-block-user" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-block-user-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- título -->
            <div class="modal-header">
                <h5 id="modal-block-user-label" class="modal-title text-uppercase text-monospace ml-1">
                    <b>{{ __('Bloquear usuário') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- form -->
                <form id="form-block-user" role="form" autocomplete="off" novalidate>
                    @csrf
                    <!-- inputs -->
                    <div class="row">
                        <!-- id -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="id-block-user">{{ __('ID') }}</label>
                                <div class="input-group input-group-merge validate-id-block-user">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('id_block_user') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('id do usuário') }}">*</span>
                                    <input readonly type="number" id="id-block-user" name="id_block_user" class="form-control {{ $errors->has('id_block_user') ? 'is-invalid' : '' }}" placeholder="{{ __('ID do usuário') }}" value="{{ old('id_block_user') }}" maxlength="20" required onkeypress="return soNumeros(event);" @if ($errors->has('id_block_user')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('id_block_user'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('id_block_user') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- bloquear -->
                        <div class="col-lg-12">
                            <div class="form-group float-right mt--1 mb-0">
                                <label class="form-control-label fe-toggle-title" for="blocked-block-user">Bloqueado </label>
                                <div class="input-group input-group-merge fe-toggle-line validate-blocked-block-user">
                                    <label class="custom-toggle custom-toggle-warning">
                                        <input type="checkbox" id="blocked-block-user" name="blocked_block_user" onchange="changeCheckbox(this, 'usuário')">
                                        <span class="custom-toggle-slider rounded-circle" data-label-off="Não" data-label-on="Sim"></span>
                                    </label>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('blocked_block_user'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('blocked_block_user') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- bloquear por data -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label id="blocked-at-block-user-text" class="form-control-label" for="blocked-at-block-user"></label>
                                <div class="input-group input-group-merge validate-blocked-at-block-user">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('blocked_at_block_user') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('bloquear usuário até a data') }}">*</span>
                                    <input type="tel" id="blocked-at-block-user" name="blocked_at_block_user" class="form-control datepicker-clean-onwards mask-date {{ $errors->has('blocked_at_block_user') ? 'is-invalid' : '' }}" placeholder="{{ __('Informe a data') }}" value="{{ old('blocked_at_block_user') }}" minlength="10" maxlength="10" onkeyup="statusCheckbox(this, 'usuário');" onchange="statusCheckbox(this, 'usuário');" @if ($errors->has('blocked_at_block_user')) autofocus @endif>
                                    <!-- limpar datepicker -->
                                    <div class="input-group-append" onclick="limparInputDatepicker(this);">
                                        <span class="input-group-text">
                                            <i id="blocked-at-block-user-clean" class="fe-input-icone far fa-calendar-times"></i>
                                        </span>
                                    </div>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('blocked_at_block_user'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('blocked_at_block_user') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- informações -->
                    <div class="fe-mouse-off">
                        <div class="mt--1">
                            <small class="text-light">{{ __('bloqueie o usuário até uma data determinada ou permanentemente') }}</small>
                        </div>
                    </div>
                    <!-- botões -->
                    <div class="text-right float-right fe-form-footer">
                        <a href="javascript:void(0)" class="mr-4" data-dismiss="modal">{{ __('Cancelar') }}</a>
                        @if (app('router')->has('user.block') && \App\Models\Permission::routePermission('user.block'))
                            <button type="submit" id="btn-block-user" class="btn btn-outline-warning mr-4">{{ __('Bloquear usuário') }}</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
