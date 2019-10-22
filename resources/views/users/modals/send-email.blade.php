<div id="modal-send-email-user" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-send-email-user-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <!-- título -->
            <div class="modal-header">
                <h5 id="modal-send-email-user-label" class="modal-title text-uppercase text-monospace ml-1">
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
                <form id="form-send-email-user" role="form" autocomplete="off" novalidate>
                    @csrf
                    <!-- inputs -->
                    <div class="row">
                        <!-- foto -->
                        <span class="avatar avatar-sm rounded-circle float-left fe-img-send-email">
                            <img id="photo-send-email-user" src="" class="fe-img-center" alt="">
                        </span>
                        <!-- nome -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="name-send-email-user">{{ __('Nome') }}</label>
                                <div class="input-group input-group-merge validate-name-send-email-user">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('name_send_email_user') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-user"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                    <input readonly type="text" id="name-send-email-user" name="name_send_email_user" class="form-control {{ $errors->has('name_send_email_user') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome completo') }}" value="{{ old('name_send_email_user') }}" minlength="3" maxlength="191" required onkeypress="return soLetras(event);" onkeyup="letraMaiuscula('name-send-email-user');" @if ($errors->has('name_send_email_user')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_send_email_user'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_send_email_user') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- e-mail -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="email-send-email-user">{{ __('E-mail') }}</label>
                                <div class="input-group input-group-merge validate-email-send-email-user">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('email_send_email_user') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('e-mail válido') }}">*</span>
                                    <input readonly type="email" id="email-send-email-user" name="email_send_email_user" class="form-control {{ $errors->has('email_send_email_user') ? 'is-invalid' : '' }}" placeholder="{{ __('E-mail') }}" value="{{ old('email_send_email_user') }}" maxlength="191" required @if ($errors->has('email_send_email_user')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('email_send_email_user'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('email_send_email_user') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- mensagem -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label id="text-name-send-email-user" class="form-control-label" for="message-send-email-user">{{ __('Mensagem') }}</label>
                                <div class="input-group-none validate-message-send-email-user">
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 10 caracteres') }}">*</span>
                                    <textarea id="message-send-email-user" name="message_send_email_user" rows="4" resize="none" class="form-control {{ $errors->has('message_send_email_user') ? 'is-invalid' : '' }}" placeholder="{{ __('Mensagem') }}" minlength="10" maxlength="1500" required onkeyup="primeiraLetraMaiuscula(this);" @if ($errors->has('message_send_email_user')) autofocus @endif>{{ old('message_send_email_user') }}</textarea>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('message_send_email_user'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('message_send_email_user') }}</div>
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
                        @if (app('router')->has('user.send.email') && \App\Models\Permission::routePermission('user.send.email'))
                            <button type="submit" id="btn-send-email-user" class="btn btn-outline-success mr-4">{{ __('Enviar e-mail') }}</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
