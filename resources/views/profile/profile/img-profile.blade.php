<!-- foto -->
<div class="col-lg-6 mt-2">
    <div class="form-group">
        <div class="input-group-none validate-image-photo-edit-profile">
            <!-- botão de remover foto -->
            <div class="fe-remove-preview-0 fe-remove-preview-medium-round {{ auth()->user()['photo'] ? '' : 'fe-hidden' }}">
                <i class="far fa-times-circle"></i>
            </div>
            <!-- imagem do perfil estilizada -->
            <div class="fe-grid-preview-0">
                <div class="fe-grid-preview-item-0 fe-preview-medium fe-preview-round">
                    <div class="fe-img-center fe-preview-0 fe-preview-medium fe-preview-round fe-default-user">
                        @if (auth()->user()['photo'])
                            <img class="fe-img-preview-0 fe-img-preview-cover" src="{{ url('storage/images/users/photo/' . auth()->user()['photo']) }}" alt="">
                        @endif
                    </div>
                    <div class="fe-grid-preview-text-0 text-monospace">
                        <span>Selecionar</span>
                        <p>Foto</p>
                    </div>
                    <!-- arquivo do perfil oculto -->
                    <input type="file" id="image-photo-edit-profile" name="image_photo_edit_profile" class="fe-image-0" accept="image/jpg, image/jpeg, image/png, image/gif">
                    <label for="photo-edit-profile"></label>
                    <input type="text" id="photo-edit-profile" name="photo_edit_profile" class="fe-image-url-0" value="{{ \App\Helpers\FileHelpers::destination_url(auth()->user()['id'], 'png') }}">
                </div>
            </div>
            <!-- alerta de erro -->
            @if ($errors->has('image_photo_edit_profile'))
                <div class="invalid-feedback" role="alert">{{ $errors->first('image_photo_edit_profile') }}</div>
            @endif
        </div>
    </div>
</div>
<!-- capa -->
<div class="col-lg-6 mt-2">
    <div class="form-group">
        <div class="input-group-none validate-image-background-edit-profile">
            <!-- botão de remover capa -->
            <div class="fe-remove-preview-1 fe-remove-preview-rectangle {{ auth()->user()['background'] ? '' : 'fe-hidden' }}">
                <i class="far fa-times-circle"></i>
            </div>
            <!-- imagem do perfil estilizada -->
            <div class="fe-grid-preview-1">
                <div class="fe-grid-preview-item-1 fe-preview-rectangle">
                    <div class="fe-img-center fe-preview-1 fe-preview-rectangle fe-default-background">
                        @if (auth()->user()['background'])
                            <img class="fe-img-preview-1 fe-img-preview-cover" src="{{ url('storage/images/users/background/' . auth()->user()['background']) }}" alt="">
                        @endif
                    </div>
                    <div class="fe-grid-preview-text-1 text-monospace">
                        <span>Selecionar</span>
                        <p>Capa</p>
                    </div>
                    <!-- arquivo do perfil oculto -->
                    <input type="file" id="image-background-edit-profile" name="image_background_edit_profile" class="fe-image-1" accept="image/jpg, image/jpeg, image/png, image/gif">
                    <label for="background-edit-profile"></label>
                    <input type="text" id="background-edit-profile" name="background_edit_profile" class="fe-image-url-1" value="{{ \App\Helpers\FileHelpers::destination_url(auth()->user()['id'], 'png') }}">
                </div>
            </div>
            <!-- alerta de erro -->
            @if ($errors->has('image_background_edit_profile'))
                <div class="invalid-feedback" role="alert">{{ $errors->first('image_background_edit_profile') }}</div>
            @endif
        </div>
    </div>
</div>
