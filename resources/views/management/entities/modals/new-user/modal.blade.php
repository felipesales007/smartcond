<div id="modal-new-user-entity" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-new-user-entity-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <!-- título -->
            <div class="modal-header">
                <h5 id="modal-new-user-entity-label" class="modal-title text-uppercase text-monospace ml-1">
                    <b>{{ __('Novo usuário') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- form -->
                <form id="form-new-user-entity" role="form" autocomplete="off" novalidate>
                    @csrf
                    <!-- inputs -->
                    <div class="row">
                        <!-- logo -->
                        <span class="avatar avatar-sm float-left fe-img-send-email mt-2">
                            <img id="logo-new-user-entity" src="" class="fe-img-center" alt="">
                        </span>
                        <!-- nome do condomínio -->
                        <div id="text-name-new-user-entity" class="form-control-label text-monospace col-lg-12 pr-4 ml-5 mt--4 mb-3"></div>
                        <!-- nome -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="name-new-user-entity">{{ __('Nome') }}</label>
                                <div class="input-group input-group-merge validate-name-new-user-entity">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('name_new_user_entity') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-user"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                    <input type="text" id="name-new-user-entity" name="name_new_user_entity" class="form-control {{ $errors->has('name_new_user_entity') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome completo') }}" value="{{ old('name_new_user_entity') }}" minlength="3" maxlength="191" required onkeypress="return onlyLetters(event);" onkeyup="letterUppercase('name-new-user-entity');" @if ($errors->has('name_new_user_entity')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_new_user_entity'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_new_user_entity') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- e-mail -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="email-new-user-entity">{{ __('E-mail') }}</label>
                                <div class="input-group input-group-merge validate-email-new-user-entity">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('email_new_user_entity') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('e-mail válido') }}">*</span>
                                    <input type="email" id="email-new-user-entity" name="email_new_user_entity" class="form-control {{ $errors->has('email_new_user_entity') ? 'is-invalid' : '' }}" placeholder="{{ __('E-mail') }}" value="{{ old('email_new_user_entity') }}" maxlength="191" required @if ($errors->has('email_new_user_entity')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('email_new_user_entity'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('email_new_user_entity') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- condomínio -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="id-entity-new-user-entity">{{ __('ID do condomínio') }}</label>
                                <div class="input-group input-group-merge validate-id-entity-new-user-entity">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('id_entity_new_user_entity') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('id do condomínio') }}">*</span>
                                    <input readonly type="number" id="id-entity-new-user-entity" name="id_entity_new_user_entity" class="form-control {{ $errors->has('id_entity_new_user_entity') ? 'is-invalid' : '' }}" placeholder="{{ __('ID do condomínio') }}" value="{{ old('id_entity_new_user_entity') }}" maxlength="20" required onkeypress="return onlyNumbers(event);" @if ($errors->has('id_entity_new_user_entity')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('id_entity_new_user_entity'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('id_entity_new_user_entity') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- informação -->
                    <div class="fe-mouse">
                        <div class="text-right">
                            <small class="fe-text-star">{{ __('*') }}</small>
                            <small class="text-light">{{ __('campos obrigatórios') }}</small>
                        </div>
                    </div>
                    <!-- botões -->
                    <div class="text-right float-right fe-form-footer">
                        <a href="javascript:void(0)" class="mr-4" data-dismiss="modal">{{ __('Cancelar') }}</a>
                        <button type="submit" id="btn-new-user-entity" class="btn btn-outline-success mr-4">{{ __('Criar usuário') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
