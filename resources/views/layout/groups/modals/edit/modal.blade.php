<div id="modal-edit-group" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-edit-group-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- título -->
            <div class="modal-header">
                <h5 id="modal-edit-group-label" class="modal-title text-uppercase text-monospace ml-1">
                    <b>{{ __('Editar grupo') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- form -->
                <form id="form-edit-group" role="form" autocomplete="off" novalidate>
                    @csrf
                    <!-- inputs -->
                    <div class="row">
                        <!-- id -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="id-edit-group">{{ __('ID') }}</label>
                                <div class="input-group input-group-merge validate-id-edit-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('id_edit_group') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('id do grupo') }}">*</span>
                                    <input readonly type="number" id="id-edit-group" name="id_edit_group" class="form-control {{ $errors->has('id_edit_group') ? 'is-invalid' : '' }}" placeholder="{{ __('ID do grupo') }}" value="{{ old('id_edit_group') }}" maxlength="20" required onkeypress="return onlyNumbers(event);" @if ($errors->has('id_edit_group')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('id_edit_group'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('id_edit_group') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- nome -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="name-edit-group">{{ __('Nome') }}</label>
                                <div class="input-group input-group-merge validate-name-edit-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text {{ $errors->has('name_edit_group') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-book"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                    <input type="text" id="name-edit-group" name="name_edit_group" class="form-control {{ $errors->has('name_edit_group') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome do grupo') }}" value="{{ old('name_edit_group') }}" minlength="3" maxlength="191" required oninput="this.value = this.value.toLowerCase();" onkeypress="return groupCharacters(event);" onkeyup="this.value = noSpace(this.value);" @if ($errors->has('name_edit_group')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('name_edit_group'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('name_edit_group') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- nível de usuário -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="user-level-id-edit-group">{{ __('Nível de usuário') }}</label>
                                <div class="input-group-none validate-user-level-id-edit-group">
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('selecione o nível de usuário mínimo para o acesso a esse grupo') }}">*</span>
                                    {{ Form::select(
                                        "name",
                                        \App\Models\User\UserLevels::getUserLevelsOptions(),
                                        old("user_level_id_edit_group", auth()->user()['user_level_id']),
                                        ["id" => "user-level-id-edit-group", "name" => "user_level_id_edit_group", "class" => "form-control select-nosearch", "placeholder" => "Selecione"]
                                    )}}
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('user_level_id_edit_group'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('user_level_id_edit_group') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- descrição -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="description-edit-group">{{ __('Descrição') }}</label>
                                <div class="input-group-none validate-description-edit-group">
                                    <span class="fe-star fe-star-default" data-toggle="tooltip" data-placement="top" title="{{ __('descrição do grupo com no mínimo 10 caracteres') }}">*</span>
                                    <textarea id="description-edit-group" name="description_edit_group" rows="3" resize="none" class="form-control {{ $errors->has('description_edit_group') ? 'is-invalid' : '' }}" placeholder="{{ __('Descrição') }}" minlength="10" maxlength="1500" onkeyup="firstLetterUppercase(this);" @if ($errors->has('description_edit_group')) autofocus @endif>{{ old('description_edit_group') }}</textarea>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('description_edit_group'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('description_edit_group') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- informações -->
                    <div class="fe-mouse">
                        <div class="text-right">
                            <small class="fe-text-star">{{ __('*') }}</small>
                            <small class="text-light">{{ __('campo obrigatório') }}</small>
                        </div>
                        <br>
                        <div class="mt--1">
                            <small class="text-light">{{ __('ao realizar a edição do nome do grupo será necessário reiniciar a página para funcionamento do grupo') }}</small>
                        </div>
                    </div>
                    <!-- botões -->
                    <div class="text-right float-right fe-form-footer">
                        <a href="javascript:void(0)" class="mr-4" data-dismiss="modal">{{ __('Cancelar') }}</a>
                        <button type="submit" id="btn-edit-group" class="btn btn-outline-success mr-4">{{ __('Editar grupo') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
