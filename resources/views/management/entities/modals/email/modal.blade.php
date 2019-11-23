<div id="modal-send-email-entity" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-send-email-entity-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <!-- título -->
            <div class="modal-header">
                <h5 id="modal-send-email-entity-label" class="modal-title text-uppercase text-monospace ml-1">
                    <b>{{ __('Enviar e-mail') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <img src="{{ asset('images/default/email.png') }}" class="fe-img-email" onmousedown="return false;" alt="">
                <!-- form -->
                <form id="form-send-email-entity" role="form" autocomplete="off" novalidate>
                    @csrf
                    <!-- inputs -->
                    <div class="row">
                        <!-- logo -->
                        <span class="avatar avatar-sm float-left fe-img-send-email">
                            <img id="logo-send-email-entity" src="" class="fe-img-center" alt="">
                        </span>
                        <!-- nome -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="name-send-email-entity">{{ __('Nome') }}</label>
                                <div class="input-group input-group-merge validate-name-send-email-entity">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('name_send_email_entity') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-entity"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                    <input readonly type="text" id="name-send-email-entity" name="name_send_email_entity" class="form-control {{ $errors->has('name_send_email_entity') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome completo') }}" value="{{ old('name_send_email_entity') }}" minlength="3" maxlength="191" required onkeypress="return onlyLetters(event);" onkeyup="letterUppercase('name-send-email-entity');" @if ($errors->has('name_send_email_entity')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_send_email_entity'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_send_email_entity') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- e-mail -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="email-send-email-entity">{{ __('E-mail') }}</label>
                                <div class="input-group input-group-merge validate-email-send-email-entity">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('email_send_email_entity') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('e-mail válido') }}">*</span>
                                    <input readonly type="email" id="email-send-email-entity" name="email_send_email_entity" class="form-control {{ $errors->has('email_send_email_entity') ? 'is-invalid' : '' }}" placeholder="{{ __('E-mail') }}" value="{{ old('email_send_email_entity') }}" maxlength="191" required @if ($errors->has('email_send_email_entity')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('email_send_email_entity'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('email_send_email_entity') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- mensagem -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label id="text-name-send-email-entity" class="form-control-label" for="message-send-email-entity">{{ __('Mensagem') }}</label>
                                <div class="input-group-none validate-message-send-email-entity">
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 10 caracteres') }}">*</span>
                                    <textarea id="message-send-email-entity" name="message_send_email_entity" rows="4" resize="none" class="form-control {{ $errors->has('message_send_email_entity') ? 'is-invalid' : '' }}" placeholder="{{ __('Mensagem') }}" minlength="10" maxlength="1500" required onkeyup="firstLetterUppercase(this);" @if ($errors->has('message_send_email_entity')) autofocus @endif>{{ old('message_send_email_entity') }}</textarea>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('message_send_email_entity'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('message_send_email_entity') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- informação -->
                    <div class="fe-mouse">
                        <div class="text-right">
                            <small class="fe-text-star">{{ __('*') }}</small>
                            <small class="text-light">{{ __('campo obrigatório') }}</small>
                        </div>
                    </div>
                    <!-- botões -->
                    <div class="text-right float-right fe-form-footer">
                        <a href="javascript:void(0)" class="mr-4" data-dismiss="modal">{{ __('Cancelar') }}</a>
                        <button type="submit" id="btn-send-email-entity" class="btn btn-outline-success mr-4">{{ __('Enviar e-mail') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
