<div id="modal-new-admin" class="modal fade"  role="dialog" aria-labelledby="modal-new-admin-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- título -->
            <div class="modal-header">
                <h5 id="modal-new-admin-label" class="modal-title text-uppercase text-monospace ml-1">
                    <b>{{ __('Novo administrador') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- form -->
                <form id="form-new-admin" role="form" autocomplete="off" novalidate>
                    @csrf
                    <!-- inputs -->
                    <div class="row">
                        <!-- nome -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="name-new-admin">{{ __('Nome') }}</label>
                                <div class="input-group input-group-merge validate-name-new-admin">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('name_new_admin') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-user"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                    <input type="text" id="name-new-admin" name="name_new_admin" class="form-control {{ $errors->has('name_new_admin') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome completo') }}" value="{{ old('name_new_admin') }}" minlength="3" maxlength="191" required onkeypress="return soLetras(event);" onkeyup="letraMaiuscula('name-new-admin');" @if ($errors->has('name_new_admin')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_new_admin'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_new_admin') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- e-mail -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="email-new-admin">{{ __('E-mail') }}</label>
                                <div class="input-group input-group-merge validate-email-new-admin">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('email_new_admin') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('e-mail válido') }}">*</span>
                                    <input type="email" id="email-new-admin" name="email_new_admin" class="form-control {{ $errors->has('email_new_admin') ? 'is-invalid' : '' }}" placeholder="{{ __('E-mail') }}" value="{{ old('email_new_admin') }}" maxlength="191" required @if ($errors->has('email_new_admin')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('email_new_admin'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('email_new_admin') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- empresa -->
                        @if (\App\Models\Company\Company::id() == 1)
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="company-id-new-admin">{{ __('Empresa') }}</label>
                                    <div class="input-group-none validate-company-id-new-admin">
                                        <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('selecione a empresa') }}">*</span>
                                        {{ Form::select(
                                            "name",
                                            \App\Models\Company\Company::getCompaniesOptions(),
                                            old("company_id_new_admin"),
                                            ["id" => "company-id-new-admin", "name" => "company_id_new_admin", "class" => "form-control select-nosearch", "placeholder" => "Selecione", "required"]
                                        )}}
                                    </div>
                                    <!-- alerta de erro -->
                                    @if ($errors->has('company_id_new_admin'))
                                        <div class="invalid-feedback" role="alert">{{ $errors->first('company_id_new_admin') }}</div>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div hidden class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="company-id-new-admin">{{ __('Empresa') }}</label>
                                    <div class="input-group-none validate-company-id-new-admin">
                                        <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('selecione a empresa') }}">*</span>
                                        {{ Form::select(
                                            "name",
                                            \App\Models\Company\Company::getCompaniesOptions(),
                                            \App\Models\Company\Company::id(),
                                            ["id" => "company-id-new-admin", "name" => "company_id_new_admin", "class" => "form-control select-nosearch", "placeholder" => "Selecione", "required"]
                                        )}}
                                    </div>
                                    <!-- alerta de erro -->
                                    @if ($errors->has('company_id_new_admin'))
                                        <div class="invalid-feedback" role="alert">{{ $errors->first('company_id_new_admin') }}</div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                    <!-- informações -->
                    <div class="fe-mouse-off">
                        <div class="text-right">
                            <small class="fe-text-star">{{ __('*') }}</small>
                            <small class="text-light">{{ __('campos obrigatórios') }}</small>
                        </div>
                        <br>
                        <div class="mt--1">
                            <small class="text-light">{{ __('ao criar um novo administrador, o administrador criado irá receber uma notificação de e-mail para confirmação e definição da senha') }}</small>
                        </div>
                    </div>
                    <!-- botões -->
                    <div class="text-right float-right fe-form-footer">
                        <a href="javascript:void(0)" class="mr-4" data-dismiss="modal">{{ __('Cancelar') }}</a>
                        @if (app('router')->has('admin.store') && \App\Models\Permission::routePermission('admin.store'))
                            <button type="submit" id="btn-new-admin" class="btn btn-outline-success mr-4">{{ __('Criar administrador') }}</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
