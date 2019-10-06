<!-- foto -->
<div class="col-lg-6 mt-2 mb--4">
    <div class="form-group">
        <div class="input-group-none validate-fe-image-0-profile">
            <!-- botão de remover foto -->
            <div class="fe-remove-preview-0 fe-remove-preview-medium-round {{ auth()->user()['photo'] ? '' : 'fe-hidden' }}">
                <i class="far fa-times-circle"></i>
            </div>
            <!-- imagem do perfil estilizada -->
            <div class="fe-grid-preview-0">
                <div class="fe-grid-preview-item-0 fe-preview-medium fe-preview-round">
                    <div class="fe-preview-0 fe-preview-medium fe-preview-round fe-default-user">
                        @if (auth()->user()['photo'])
                            <img class="fe-img-preview-0 fe-img-preview-cover" src="{{ url('storage/img/users/photo/' . auth()->user()['photo']) }}" alt="">
                        @endif
                    </div>
                    <div class="fe-grid-preview-text-0 text-monospace">
                        <span>Selecionar</span>
                        <p>Imagem</p>
                    </div>
                </div>
            </div>
            <!-- alerta de erro -->
            @if ($errors->has('image_0'))
                <div class="invalid-feedback" role="alert">{{ $errors->first('image_0') }}</div>
            @endif
            <!-- arquivo do perfil oculto -->
            <input type="file" id="fe-image-0-profile" name="image_0" class="fe-image-0" accept="image/jpg, image/jpeg, image/png, image/gif">
            <label for="fe-image-url-0-profile"></label>
            <input type="text" id="fe-image-url-0-profile" name="photo_edit_profile" class="fe-image-url-0" value="{{ \App\Helpers\FileHelpers::destination_url(auth()->user()['id'], 'png') }}">
        </div>
    </div>
</div>
<!-- capa -->
<div class="col-lg-6 mt-2 mb--4">
    <div class="form-group">
        <div class="input-group-none validate-fe-image-1-profile">
            <!-- botão de remover capa -->
            <div class="fe-remove-preview-1 fe-remove-preview-rectangle {{ auth()->user()['background'] ? '' : 'fe-hidden' }}">
                <i class="far fa-times-circle"></i>
            </div>
            <!-- imagem do perfil estilizada -->
            <div class="fe-grid-preview-1">
                <div class="fe-grid-preview-item-1 fe-preview-rectangle">
                    <div class="fe-preview-1 fe-preview-rectangle fe-default-background">
                        @if (auth()->user()['background'])
                            <img class="fe-img-preview-1 fe-img-preview-cover" src="{{ url('storage/img/users/background/' . auth()->user()['background']) }}" alt="">
                        @endif
                    </div>
                    <div class="fe-grid-preview-text-1 text-monospace">
                        <span>Selecionar</span>
                        <p>Imagem</p>
                    </div>
                </div>
            </div>
            <!-- alerta de erro -->
            @if ($errors->has('image_1'))
                <div class="invalid-feedback" role="alert">{{ $errors->first('image_1') }}</div>
            @endif
            <!-- arquivo do perfil oculto -->
            <input type="file" id="fe-image-1-profile" name="image_1" class="fe-image-1" accept="image/jpg, image/jpeg, image/png, image/gif">
            <label for="fe-image-url-1-profile"></label>
            <input type="text" id="fe-image-url-1-profile" name="background_edit_profile" class="fe-image-url-1" value="{{ \App\Helpers\FileHelpers::destination_url(auth()->user()['id'], 'png') }}">
        </div>
    </div>
</div>
