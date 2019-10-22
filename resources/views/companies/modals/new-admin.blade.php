<div id="modal-new-company-admin" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-new-company-admin-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <!-- título -->
            <div class="modal-header">
                <h5 id="modal-new-company-admin-label" class="modal-title text-uppercase text-monospace ml-1">
                    <b>{{ __('Novo administrador') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- form -->
                <form id="form-new-company-admin" role="form" autocomplete="off" novalidate>
                    @csrf
                    <!-- inputs -->
                    <div class="row">
                        <!-- logo -->
                        <span class="avatar avatar-sm float-left fe-img-send-email mt-2">
                            <img id="logo-new-company-admin" src="" class="fe-img-center" alt="">
                        </span>
                        <!-- nome da empresa -->
                        <div id="text-name-new-company-admin" class="form-control-label text-monospace col-lg-12 pr-4 ml-5 mt--4 mb-3"></div>
                        <!-- nome -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="name-new-company-admin">{{ __('Nome') }}</label>
                                <div class="input-group input-group-merge validate-name-new-company-admin">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('name_new_company_admin') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-user"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                    <input type="text" id="name-new-company-admin" name="name_new_company_admin" class="form-control {{ $errors->has('name_new_company_admin') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome completo') }}" value="{{ old('name_new_company_admin') }}" minlength="3" maxlength="191" required onkeypress="return soLetras(event);" onkeyup="letraMaiuscula('name-new-company-admin');" @if ($errors->has('name_new_company_admin')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_new_company_admin'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_new_company_admin') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- e-mail -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="email-new-company-admin">{{ __('E-mail') }}</label>
                                <div class="input-group input-group-merge validate-email-new-company-admin">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('email_new_company_admin') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('e-mail válido') }}">*</span>
                                    <input type="email" id="email-new-company-admin" name="email_new_company_admin" class="form-control {{ $errors->has('email_new_company_admin') ? 'is-invalid' : '' }}" placeholder="{{ __('E-mail') }}" value="{{ old('email_new_company_admin') }}" maxlength="191" required @if ($errors->has('email_new_company_admin')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('email_new_company_admin'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('email_new_company_admin') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- empresa -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="id-company-new-company-admin">{{ __('ID da empresa') }}</label>
                                <div class="input-group input-group-merge validate-id-company-new-company-admin">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('id_company_new_company_admin') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('id da empresa') }}">*</span>
                                    <input readonly type="number" id="id-company-new-company-admin" name="id_company_new_company_admin" class="form-control {{ $errors->has('id_company_new_company_admin') ? 'is-invalid' : '' }}" placeholder="{{ __('ID da empresa') }}" value="{{ old('id_company_new_company_admin') }}" maxlength="20" required onkeypress="return soNumeros(event);" @if ($errors->has('id_company_new_company_admin')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('id_company_new_company_admin'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('id_company_new_company_admin') }}</div>
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
                        @if (app('router')->has('company.admin.store') && \App\Models\Permission::routePermission('company.admin.store'))
                            <button type="submit" id="btn-new-company-admin" class="btn btn-outline-success mr-4">{{ __('Criar administrador') }}</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
