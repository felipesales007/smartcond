<div id="modal-new-group" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-new-group-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- título -->
            <div class="modal-header">
                <h5 id="modal-new-group-label" class="modal-title text-uppercase text-monospace ml-1">
                    <b>{{ __('Novo grupo') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- form -->
                <form id="form-new-group" role="form" autocomplete="off" novalidate>
                    @csrf
                    <!-- inputs -->
                    <div class="row">
                        <!-- nome -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="name-new-group">{{ __('Nome') }}</label>
                                <div class="input-group input-group-merge validate-name-new-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('name_new_group') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-book"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                    <input type="text" id="name-new-group" name="name_new_group" class="form-control {{ $errors->has('name_new_group') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome do grupo') }}" value="{{ old('name_new_group') }}" minlength="3" maxlength="191" required oninput="this.value = this.value.toLowerCase();" onkeypress="return groupCharacters(event);" onkeyup="this.value = noSpace(this.value);" @if ($errors->has('name_new_group')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_new_group'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_new_group') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- nível de usuário -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="user-level-id-new-group">{{ __('Nível de usuário') }}</label>
                                <div class="input-group-none validate-user-level-id-new-group">
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('selecione o nível de usuário mínimo para o acesso a esse grupo') }}">*</span>
                                    {{ Form::select(
                                        "name",
                                        \App\Models\User\UserLevel::getUserLevelsOptions(),
                                        3,
                                        ["id" => "user-level-id-new-group", "name" => "user_level_id_new_group", "class" => "form-control select-nosearch", "placeholder" => "Selecione"]
                                    )}}
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('user_level_id_new_group'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('user_level_id_new_group') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- descrição -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="description-new-group">{{ __('Descrição') }}</label>
                                <div class="input-group-none validate-description-new-group">
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('descrição do grupo com no mínimo 10 caracteres') }}">*</span>
                                    <textarea id="description-new-group" name="description_new_group" rows="3" resize="none" class="form-control {{ $errors->has('description_new_group') ? 'is-invalid' : '' }}" placeholder="{{ __('Descrição') }}" minlength="10" maxlength="1500" onkeyup="firstLetterUppercase(this);" @if ($errors->has('description_new_group')) autofocus @endif>{{ old('description_new_group') }}</textarea>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('description_new_group'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('description_new_group') }}</div>
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
                        <button type="submit" id="btn-new-group" class="btn btn-outline-success mr-4">{{ __('Criar grupo') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
