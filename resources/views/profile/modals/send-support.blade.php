<div id="modal-send-support-profile" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-send-support-profile-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <!-- título -->
            <div class="modal-header">
                <h5 id="modal-send-support-profile-label" class="modal-title text-uppercase text-monospace ml-1">
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
                <form id="form-send-support-profile" role="form" autocomplete="off" novalidate>
                    @csrf
                    <!-- inputs -->
                    <div class="row">
                        <!-- motivo -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="reason-send-support-profile">{{ __('Motivo') }}</label>
                                <div class="input-group-none validate-reason-send-support-profile">
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('selecione o motivo do contato') }}">*</span>
                                    {{ Form::select(
                                        "name",
                                        \App\Models\SupportOption::getSupportOptionsOptions(),
                                        old("reason_send_support_profile"),
                                        ["id" => "reason-send-support-profile", "name" => "reason_send_support_profile", "class" => "form-control select-nosearch", "placeholder" => "Selecione", "required"]
                                    )}}
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('reason_send_support_profile'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('reason_send_support_profile') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- mensagem -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="message-send-support-profile">{{ __('Mensagem') }}</label>
                                <div class="input-group-none validate-message-send-support-profile">
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 10 caracteres') }}">*</span>
                                    <textarea id="message-send-support-profile" name="message_send_support_profile" rows="4" resize="none" class="form-control {{ $errors->has('message_send_support_profile') ? 'is-invalid' : '' }}" placeholder="{{ __('Mensagem') }}" minlength="10" maxlength="1500" required onkeyup="primeiraLetraMaiuscula(this);" @if ($errors->has('message_send_support_profile')) autofocus @endif>{{ old('message_send_support_profile') }}</textarea>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('message_send_support_profile'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('message_send_support_profile') }}</div>
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
                        @if (app('router')->has('profile.send.support') && \App\Models\Permission::routePermission('profile.send.support'))
                            <button type="submit" id="btn-send-support-profile" class="btn btn-outline-success mr-4">{{ __('Enviar e-mail') }}</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
