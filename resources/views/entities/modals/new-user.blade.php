<div id="modal-new-entity-user" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-new-entity-user-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <!-- título -->
            <div class="modal-header">
                <h5 id="modal-new-entity-user-label" class="modal-title text-uppercase text-monospace ml-1">
                    <b>{{ __('Novo usuário') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- form -->
                <form id="form-new-entity-user" role="form" autocomplete="off" novalidate>
                    @csrf
                    <!-- inputs -->
                    <div class="row">
                        <!-- logo -->
                        <span class="avatar avatar-sm float-left fe-img-send-email mt-2">
                            <img id="logo-new-entity-user" src="" class="fe-img-center" alt="">
                        </span>
                        <!-- nome do condomínio -->
                        <div id="text-name-new-entity-user" class="form-control-label text-monospace col-lg-12 pr-4 ml-5 mt--4 mb-3"></div>
                        <!-- nome -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="name-new-entity-user">{{ __('Nome') }}</label>
                                <div class="input-group input-group-merge validate-name-new-entity-user">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('name_new_entity_user') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-user"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                    <input type="text" id="name-new-entity-user" name="name_new_entity_user" class="form-control {{ $errors->has('name_new_entity_user') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome completo') }}" value="{{ old('name_new_entity_user') }}" minlength="3" maxlength="191" required onkeypress="return soLetras(event);" onkeyup="letraMaiuscula('name-new-entity-user');" @if ($errors->has('name_new_entity_user')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_new_entity_user'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_new_entity_user') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- e-mail -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="email-new-entity-user">{{ __('E-mail') }}</label>
                                <div class="input-group input-group-merge validate-email-new-entity-user">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('email_new_entity_user') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('e-mail válido') }}">*</span>
                                    <input type="email" id="email-new-entity-user" name="email_new_entity_user" class="form-control {{ $errors->has('email_new_entity_user') ? 'is-invalid' : '' }}" placeholder="{{ __('E-mail') }}" value="{{ old('email_new_entity_user') }}" maxlength="191" required @if ($errors->has('email_new_entity_user')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('email_new_entity_user'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('email_new_entity_user') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- condomínio -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="id-company-new-entity-user">{{ __('ID do condomínio') }}</label>
                                <div class="input-group input-group-merge validate-id-company-new-entity-user">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('id_entity_new_entity_user') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('id do condomínio') }}">*</span>
                                    <input readonly type="number" id="id-company-new-entity-user" name="id_entity_new_entity_user" class="form-control {{ $errors->has('id_entity_new_entity_user') ? 'is-invalid' : '' }}" placeholder="{{ __('ID do condomínio') }}" value="{{ old('id_entity_new_entity_user') }}" maxlength="20" required onkeypress="return soNumeros(event);" @if ($errors->has('id_entity_new_entity_user')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('id_entity_new_entity_user'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('id_entity_new_entity_user') }}</div>
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
                            <button type="submit" id="btn-new-entity-user" class="btn btn-outline-success mr-4">{{ __('Criar usuário') }}</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
