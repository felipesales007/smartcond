<div id="modal-recover-company" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-recover-company-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- título -->
            <div class="modal-header">
                <h5 id="modal-recover-company-label" class="modal-title text-uppercase text-monospace ml-1">
                    <b>{{ __('Recuperar condomínio') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- form -->
                <form id="form-recover-company" role="form" autocomplete="off" novalidate>
                    @csrf
                    <!-- inputs -->
                    <div class="row">
                        <!-- id -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="id-recover-company">{{ __('ID') }}</label>
                                <div class="input-group input-group-merge validate-id-recover-company">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('id_recover_company') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('id do condomínio') }}">*</span>
                                    <input readonly type="number" id="id-recover-company" name="id_recover_company" class="form-control {{ $errors->has('id_recover_company') ? 'is-invalid' : '' }}" placeholder="{{ __('ID do condomínio') }}" value="{{ old('id_recover_company') }}" maxlength="20" required onkeypress="return soNumeros(event);" @if ($errors->has('id_recover_company')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('id_recover_company'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('id_recover_company') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- nome -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="name-recover-company">{{ __('Nome') }}</label>
                                <div class="input-group input-group-merge validate-name-recover-company">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('name_recover_company') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-hotel"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('nome do condomínio') }}">*</span>
                                    <input readonly type="text" id="name-recover-company" name="name_recover_company" class="form-control {{ $errors->has('name_recover_company') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome do condomínio') }}" value="{{ old('name_recover_company') }}" minlength="3" maxlength="191" required onkeypress="return soLetrasCaracteres(event);" onkeyup="letraMaiuscula('name-recover-company');" @if ($errors->has('name_recover_company')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_recover_company'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_recover_company') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- confirmação do nome -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="name-confirmation-recover-company">{{ __('Digite ') }}<b id="name-confirmation-recover-company-text" class="text-success fe-block-copy" onmousedown="return false;"></b>{{ __(' para confirmar a recuperação') }}</label>
                                <div class="input-group input-group-merge validate-name-confirmation-recover-company">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('name_confirmation_recover_company') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-hotel"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('digite o nome do condomínio que está em verde e confirme, clicando em recuperar condomínio') }}">*</span>
                                    <input type="text" id="name-confirmation-recover-company" name="name_confirmation_recover_company" class="form-control fe-block-paste {{ $errors->has('name_confirmation_recover_company') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome para recuperação') }}" value="{{ old('name_confirmation_recover_company') }}" minlength="3" maxlength="191" required onkeypress="return soLetrasCaracteres(event);" onkeyup="letraMaiuscula('name-confirmation-recover-company');" ondrop="return false;" @if ($errors->has('name_confirmation_recover_company')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_confirmation_recover_company'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_confirmation_recover_company') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- informação -->
                    <div class="fe-mouse-off">
                        <div class="text-right">
                            <small class="fe-text-star">{{ __('*') }}</small>
                            <small class="text-light">{{ __('campo obrigatório') }}</small>
                        </div>
                    </div>
                    <!-- botões -->
                    <div class="text-right float-right fe-form-footer">
                        <a href="javascript:void(0)" class="mr-4" data-dismiss="modal">{{ __('Cancelar') }}</a>
                        @if (app('router')->has('company.restore') && \App\Models\Permission::routePermission('company.restore'))
                            <button type="submit" id="btn-recover-company" class="btn btn-outline-success mr-4">{{ __('Recuperar condomínio') }}</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
