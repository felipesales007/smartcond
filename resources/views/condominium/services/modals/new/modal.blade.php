<div id="modal-new-condominium-service" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-new-condominium-service-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <!-- título -->
            <div class="modal-header">
                <h5 id="modal-new-condominium-service-label" class="modal-title text-uppercase text-monospace ml-1">
                    <b>{{ __('Novo prestador de serviços') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- form -->
                <form id="form-new-condominium-service" role="form" autocomplete="off" novalidate>
                    @csrf
                    <!-- inputs -->
                    <div class="row">
                        <!-- nome -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="name-new-condominium-service">{{ __('Nome') }}</label>
                                <div class="input-group input-group-merge validate-name-new-condominium-service">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('name_new_condominium_service') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-wrench"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('nome da pessoa que presta o serviço') }}">*</span>
                                    <input type="text" id="name-new-condominium-service" name="name_new_condominium_service" class="form-control {{ $errors->has('name_new_condominium_service') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome da pessoa') }}" value="{{ old('name_new_condominium_service') }}" minlength="3" maxlength="191" required onkeypress="return onlyLetters(event);" onkeyup="letterUppercase('name-new-condominium-service');" @if ($errors->has('name_new_condominium_service')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_new_condominium_service'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_new_condominium_service') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- rg -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="rg-new-condominium-service">{{ __('RG') }}</label>
                                <div class="input-group input-group-merge validate-rg-new-condominium-service">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('rg_new_condominium_service') ? 'is-invalid' : '' }}">
                                            <i class="far fa-id-card"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('rg válido') }}">*</span>
                                    <input type="tel" id="rg-new-condominium-service" name="rg_new_condominium_service" class="form-control {{ $errors->has('rg_new_condominium_service') ? 'is-invalid' : '' }}" placeholder="{{ __('RG') }}" value="{{ old('rg_new_condominium_service') }}" minlength="8" maxlength="14" onkeypress="return onlyNumbers(event);" @if ($errors->has('rg_new_condominium_service')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('rg_new_condominium_service'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('rg_new_condominium_service') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- telefone -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="contact-new-condominium-service">{{ __('Telefone') }}</label>
                                <div class="input-group input-group-merge validate-contact-new-condominium-service">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('contact_new_condominium_service') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-phone"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('número do celular com o ddd e 9º dígito') }}">*</span>
                                    <input type="tel" id="contact-new-condominium-service" name="contact_new_condominium_service" class="form-control mask-phones {{ $errors->has('contact_new_condominium_service') ? 'is-invalid' : '' }}" placeholder="{{ __('(xx) xxxxx-xxxx') }}" value="{{ old('contact_new_condominium_service') }}" minlength="14" maxlength="15" @if ($errors->has('contact_new_condominium_service')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('contact_new_condominium_service'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('contact_new_condominium_service') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- profissão -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="profession-new-condominium-service">{{ __('Profissão') }}</label>
                                <div class="input-group input-group-merge validate-profession-new-condominium-service">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('profession_new_condominium_service') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-briefcase"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                    <input type="text" id="profession-new-condominium-service" name="profession_new_condominium_service" class="form-control {{ $errors->has('profession_new_condominium_service') ? 'is-invalid' : '' }}" placeholder="{{ __('Profissão') }}" value="{{ old('profession_new_condominium_service') }}" minlength="3" maxlength="191" onkeyup="letterUppercase('profession-new-condominium-service');" @if ($errors->has('profession_new_condominium_service')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('profession_new_condominium_service'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('profession_new_condominium_service') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- observação -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="note-new-condominium-service">{{ __('Observação') }}</label>
                                <div class="input-group-none validate-note-new-condominium-service">
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('observação do prestador de serviços com no mínimo 10 caracteres') }}">*</span>
                                    <textarea id="note-new-condominium-service" name="note_new_condominium_service" rows="3" resize="none" class="form-control {{ $errors->has('note_new_condominium_service') ? 'is-invalid' : '' }}" placeholder="{{ __('Observação') }}" minlength="10" maxlength="1500" onkeyup="firstLetterUppercase(this);" @if ($errors->has('note_new_condominium_service')) autofocus @endif>{{ old('note_new_condominium_service') }}</textarea>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('note_new_condominium_service'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('note_new_condominium_service') }}</div>
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
                        <button type="submit" id="btn-new-condominium-service" class="btn btn-outline-success mr-4">{{ __('Criar prestador de serviços') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
