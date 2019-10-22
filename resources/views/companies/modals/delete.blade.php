<div id="modal-delete-company" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-delete-company-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- título -->
            <div class="modal-header">
                <h5 id="modal-delete-company-label" class="modal-title text-uppercase text-monospace ml-1">
                    <b>{{ __('Excluir empresa') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- form -->
                <form id="form-delete-company" role="form" autocomplete="off" novalidate>
                    @csrf
                    <!-- inputs -->
                    <div class="row">
                        <!-- id -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="id-delete-company">{{ __('ID') }}</label>
                                <div class="input-group input-group-merge validate-id-delete-company">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('id_delete_company') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('id da empresa') }}">*</span>
                                    <input readonly type="number" id="id-delete-company" name="id_delete_company" class="form-control {{ $errors->has('id_delete_company') ? 'is-invalid' : '' }}" placeholder="{{ __('ID da empresa') }}" value="{{ old('id_delete_company') }}" maxlength="20" required onkeypress="return soNumeros(event);" @if ($errors->has('id_delete_company')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('id_delete_company'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('id_delete_company') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- nome -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="name-delete-company">{{ __('Nome') }}</label>
                                <div class="input-group input-group-merge validate-name-delete-company">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('name_delete_company') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-hotel"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('nome da empresa') }}">*</span>
                                    <input readonly type="text" id="name-delete-company" name="name_delete_company" class="form-control {{ $errors->has('name_delete_company') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome da empresa') }}" value="{{ old('name_delete_company') }}" minlength="3" maxlength="191" required onkeypress="return soLetrasCaracteres(event);" onkeyup="letraMaiuscula('name-delete-company');" @if ($errors->has('name_delete_company')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_delete_company'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_delete_company') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- confirmação do nome -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="name-confirmation-delete-company">{{ __('Digite ') }}<b id="name-confirmation-delete-company-text" class="text-danger fe-block-copy" onmousedown="return false;"></b>{{ __(' para confirmar a exclusão') }}</label>
                                <div class="input-group input-group-merge validate-name-confirmation-delete-company">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('name_confirmation_delete_company') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-hotel"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('digite o nome da empresa que está em vermelho e confirme, clicando em excluir empresa') }}">*</span>
                                    <input type="text" id="name-confirmation-delete-company" name="name_confirmation_delete_company" class="form-control fe-block-paste {{ $errors->has('name_confirmation_delete_company') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome para exclusão') }}" value="{{ old('name_confirmation_delete_company') }}" minlength="3" maxlength="191" required onkeypress="return soLetrasCaracteres(event);" onkeyup="letraMaiuscula('name-confirmation-delete-company');" ondrop="return false;" @if ($errors->has('name_confirmation_delete_company')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_confirmation_delete_company'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_confirmation_delete_company') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- informações -->
                    <div class="fe-mouse-off">
                        <div class="text-right">
                            <small class="fe-text-star">{{ __('*') }}</small>
                            <small class="text-light">{{ __('campo obrigatório') }}</small>
                        </div>
                        <br>
                        <div class="mt--1">
                            <small class="text-light">{{ __('pense bem antes de excluir, empresas excluídas não são recuperadas') }}</small>
                        </div>
                    </div>
                    <!-- botões -->
                    <div class="text-right float-right fe-form-footer">
                        <a href="javascript:void(0)" class="mr-4" data-dismiss="modal">{{ __('Cancelar') }}</a>
                        @if (app('router')->has('company.destroy') && \App\Models\Permission::routePermission('company.destroy'))
                            <button type="submit" id="btn-delete-company" class="btn btn-outline-danger mr-4">{{ __('Excluir empresa') }}</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
