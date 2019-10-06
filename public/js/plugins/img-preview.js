/*!
 * FE-Image-View by Felipe Sales v2.0.0 (https://www.felipesales.com.br/)
 * Copyright 2018-2019 The FE-Library Authors
 * Copyright 2018-2019 FE, Inc.
 * Licensed under MIT
 */

/*!
=========================================================
* função para o gerenciamento de upload de imagens
=========================================================
*/

function destination_url(name, type) {
    let variable = '-' + moment().format('HH-mm-ss') + '.';
    return $.md5(name) + variable + type;
}

/*!
=========================================================
* imagem preview 0
=========================================================
*/

// salva a url temporariamente
let temp_0;

// salva o caminho da url em modal
$('.modal').on('shown.bs.modal', function () {
    temp_0 = $('.fe-image-url-0').val();
});

// salva o caminho da url em page
if ($('.fe-image-url-0') != null) {
    temp_0 = $('.fe-image-url-0').val();
}

// se remover a imagem
if ($('.fe-remove-preview-0')) {
    $('.fe-remove-preview-0').on('click', function () {
        $(this).addClass('fe-hidden');
        $('.fe-preview-0').html('<img class="fe-img-preview-0 fe-img-preview-cover" src="" alt="">');
        $('.fe-image-0').val('');
        $('.fe-image-url-0').val('');
        $('.fe-image-0').valid();
    });
}

// se adicionar imagem
if ($('.fe-grid-preview-item-0')) {
    $('.fe-grid-preview-item-0').on('click', function () {
        document.querySelector('.fe-image-0').click();
    });
}

// mostrando imagem adicionada
if ($('.fe-image-0')) {
    $('.fe-image-0').change(function (e) {
        let extension = $(this).val().split('.').pop().toLowerCase();
        let accepted  = ['jpg', 'jpeg', 'png', 'gif'];

        function showPreview() {
            $('.fe-preview-0').html('<img class="fe-img-preview-0 fe-img-preview-cover" src="" alt="">');
            let reader = new FileReader();

            reader.onload = function () {
                $('.fe-img-preview-0').attr('src', reader.result);
            };
            reader.readAsDataURL(e.target.files[0]);
        }

        // validação da imagem
        if (new RegExp(accepted.join('|')).test(extension)) {
            $('.fe-remove-preview-0').removeClass('fe-hidden');
            $('.fe-image-url-0').val(temp_0);
            showPreview();
        } else {
            $('.fe-remove-preview-0').addClass('fe-hidden');
            $('.fe-image-url-0').val('');
            $('.fe-preview-0').html('');
        }

        $('.fe-image-0').valid();
    });
}

/*!
=========================================================
* imagem preview 1
=========================================================
*/

// salva a url temporariamente
let temp_1;

// salva o caminho da url em modal
$('.modal').on('shown.bs.modal', function () {
    temp_1 = $('.fe-image-url-1').val();
});

// salva o caminho da url em page
if ($('.fe-image-url-1') != null) {
    temp_1 = $('.fe-image-url-1').val();
}

// se remover a imagem
if ($('.fe-remove-preview-1')) {
    $('.fe-remove-preview-1').on('click', function () {
        $(this).addClass('fe-hidden');
        $('.fe-preview-1').html('<img class="fe-img-preview-1 fe-img-preview-cover" src="" alt="">');
        $('.fe-image-1').val('');
        $('.fe-image-url-1').val('');
        $('.fe-image-1').valid();
    });
}

// se adicionar imagem
if ($('.fe-grid-preview-item-1')) {
    $('.fe-grid-preview-item-1').on('click', function () {
        document.querySelector('.fe-image-1').click();
    });
}

// mostrando imagem adicionada
if ($('.fe-image-1')) {
    $('.fe-image-1').change(function (e) {
        let extension = $(this).val().split('.').pop().toLowerCase();
        let accepted  = ['jpg', 'jpeg', 'png', 'gif'];

        function showPreview() {
            $('.fe-preview-1').html('<img class="fe-img-preview-1 fe-img-preview-cover" src="" alt="">');
            let reader = new FileReader();

            reader.onload = function () {
                $('.fe-img-preview-1').attr('src', reader.result);
            };
            reader.readAsDataURL(e.target.files[0]);
        }

        // validação da imagem
        if (new RegExp(accepted.join('|')).test(extension)) {
            $('.fe-remove-preview-1').removeClass('fe-hidden');
            $('.fe-image-url-1').val(temp_1);
            showPreview();
        } else {
            $('.fe-remove-preview-1').addClass('fe-hidden');
            $('.fe-image-url-1').val('');
            $('.fe-preview-1').html('');
        }

        $('.fe-image-1').valid();
    });
}

/*!
=========================================================
* imagem preview 2
=========================================================
*/

// salva a url temporariamente
let temp_2;

// salva o caminho da url em modal
$('.modal').on('shown.bs.modal', function () {
    temp_2 = $('.fe-image-url-2').val();
});

// salva o caminho da url em page
if ($('.fe-image-url-2') != null) {
    temp_2 = $('.fe-image-url-2').val();
}

// se remover a imagem
if ($('.fe-remove-preview-2')) {
    $('.fe-remove-preview-2').on('click', function () {
        $(this).addClass('fe-hidden');
        $('.fe-preview-2').html('<img class="fe-img-preview-2 fe-img-preview-cover" src="" alt="">');
        $('.fe-image-2').val('');
        $('.fe-image-url-2').val('');
        $('.fe-image-2').valid();
    });
}

// se adicionar imagem
if ($('.fe-grid-preview-item-2')) {
    $('.fe-grid-preview-item-2').on('click', function () {
        document.querySelector('.fe-image-2').click();
    });
}

// mostrando imagem adicionada
if ($('.fe-image-2')) {
    $('.fe-image-2').change(function (e) {
        let extension = $(this).val().split('.').pop().toLowerCase();
        let accepted  = ['jpg', 'jpeg', 'png', 'gif'];

        function showPreview() {
            $('.fe-preview-2').html('<img class="fe-img-preview-2 fe-img-preview-cover" src="" alt="">');
            let reader = new FileReader();

            reader.onload = function () {
                $('.fe-img-preview-2').attr('src', reader.result);
            };
            reader.readAsDataURL(e.target.files[0]);
        }

        // validação da imagem
        if (new RegExp(accepted.join('|')).test(extension)) {
            $('.fe-remove-preview-2').removeClass('fe-hidden');
            $('.fe-image-url-2').val(temp_2);
            showPreview();
        } else {
            $('.fe-remove-preview-2').addClass('fe-hidden');
            $('.fe-image-url-2').val('');
            $('.fe-preview-2').html('');
        }

        $('.fe-image-2').valid();
    });
}

/*!
=========================================================
* imagem preview 3
=========================================================
*/

// salva a url temporariamente
let temp_3;

// salva o caminho da url em modal
$('.modal').on('shown.bs.modal', function () {
    temp_3 = $('.fe-image-url-3').val();
});

// salva o caminho da url em page
if ($('.fe-image-url-3') != null) {
    temp_3 = $('.fe-image-url-3').val();
}

// se remover a imagem
if ($('.fe-remove-preview-3')) {
    $('.fe-remove-preview-3').on('click', function () {
        $(this).addClass('fe-hidden');
        $('.fe-preview-3').html('<img class="fe-img-preview-3 fe-img-preview-cover" src="" alt="">');
        $('.fe-image-3').val('');
        $('.fe-image-url-3').val('');
        $('.fe-image-3').valid();
    });
}

// se adicionar imagem
if ($('.fe-grid-preview-item-3')) {
    $('.fe-grid-preview-item-3').on('click', function () {
        document.querySelector('.fe-image-3').click();
    });
}

// mostrando imagem adicionada
if ($('.fe-image-3')) {
    $('.fe-image-3').change(function (e) {
        let extension = $(this).val().split('.').pop().toLowerCase();
        let accepted  = ['jpg', 'jpeg', 'png', 'gif'];

        function showPreview() {
            $('.fe-preview-3').html('<img class="fe-img-preview-3 fe-img-preview-cover" src="" alt="">');
            let reader = new FileReader();

            reader.onload = function () {
                $('.fe-img-preview-3').attr('src', reader.result);
            };
            reader.readAsDataURL(e.target.files[0]);
        }

        // validação da imagem
        if (new RegExp(accepted.join('|')).test(extension)) {
            $('.fe-remove-preview-3').removeClass('fe-hidden');
            $('.fe-image-url-3').val(temp_3);
            showPreview();
        } else {
            $('.fe-remove-preview-3').addClass('fe-hidden');
            $('.fe-image-url-3').val('');
            $('.fe-preview-3').html('');
        }

        $('.fe-image-3').valid();
    });
}

/*!
=========================================================
* imagem preview 4
=========================================================
*/

// salva a url temporariamente
let temp_4;

// salva o caminho da url em modal
$('.modal').on('shown.bs.modal', function () {
    temp_4 = $('.fe-image-url-4').val();
});

// salva o caminho da url em page
if ($('.fe-image-url-4') != null) {
    temp_4 = $('.fe-image-url-4').val();
}

// se remover a imagem
if ($('.fe-remove-preview-4')) {
    $('.fe-remove-preview-4').on('click', function () {
        $(this).addClass('fe-hidden');
        $('.fe-preview-4').html('<img class="fe-img-preview-4 fe-img-preview-cover" src="" alt="">');
        $('.fe-image-4').val('');
        $('.fe-image-url-4').val('');
        $('.fe-image-4').valid();
    });
}

// se adicionar imagem
if ($('.fe-grid-preview-item-4')) {
    $('.fe-grid-preview-item-4').on('click', function () {
        document.querySelector('.fe-image-4').click();
    });
}

// mostrando imagem adicionada
if ($('.fe-image-4')) {
    $('.fe-image-4').change(function (e) {
        let extension = $(this).val().split('.').pop().toLowerCase();
        let accepted  = ['jpg', 'jpeg', 'png', 'gif'];

        function showPreview() {
            $('.fe-preview-4').html('<img class="fe-img-preview-4 fe-img-preview-cover" src="" alt="">');
            let reader = new FileReader();

            reader.onload = function () {
                $('.fe-img-preview-4').attr('src', reader.result);
            };
            reader.readAsDataURL(e.target.files[0]);
        }

        // validação da imagem
        if (new RegExp(accepted.join('|')).test(extension)) {
            $('.fe-remove-preview-4').removeClass('fe-hidden');
            $('.fe-image-url-4').val(temp_4);
            showPreview();
        } else {
            $('.fe-remove-preview-4').addClass('fe-hidden');
            $('.fe-image-url-4').val('');
            $('.fe-preview-4').html('');
        }

        $('.fe-image-4').valid();
    });
}

/*!
=========================================================
* imagem preview 5
=========================================================
*/

// salva a url temporariamente
let temp_5;

// salva o caminho da url em modal
$('.modal').on('shown.bs.modal', function () {
    temp_5 = $('.fe-image-url-5').val();
});

// salva o caminho da url em page
if ($('.fe-image-url-5') != null) {
    temp_5 = $('.fe-image-url-5').val();
}

// se remover a imagem
if ($('.fe-remove-preview-5')) {
    $('.fe-remove-preview-5').on('click', function () {
        $(this).addClass('fe-hidden');
        $('.fe-preview-5').html('<img class="fe-img-preview-5 fe-img-preview-cover" src="" alt="">');
        $('.fe-image-5').val('');
        $('.fe-image-url-5').val('');
        $('.fe-image-5').valid();
    });
}

// se adicionar imagem
if ($('.fe-grid-preview-item-5')) {
    $('.fe-grid-preview-item-5').on('click', function () {
        document.querySelector('.fe-image-5').click();
    });
}

// mostrando imagem adicionada
if ($('.fe-image-5')) {
    $('.fe-image-5').change(function (e) {
        let extension = $(this).val().split('.').pop().toLowerCase();
        let accepted  = ['jpg', 'jpeg', 'png', 'gif'];

        function showPreview() {
            $('.fe-preview-5').html('<img class="fe-img-preview-5 fe-img-preview-cover" src="" alt="">');
            let reader = new FileReader();

            reader.onload = function () {
                $('.fe-img-preview-5').attr('src', reader.result);
            };
            reader.readAsDataURL(e.target.files[0]);
        }

        // validação da imagem
        if (new RegExp(accepted.join('|')).test(extension)) {
            $('.fe-remove-preview-5').removeClass('fe-hidden');
            $('.fe-image-url-5').val(temp_5);
            showPreview();
        } else {
            $('.fe-remove-preview-5').addClass('fe-hidden');
            $('.fe-image-url-5').val('');
            $('.fe-preview-5').html('');
        }

        $('.fe-image-5').valid();
    });
}

/*!
=========================================================
* imagem preview 6
=========================================================
*/

// salva a url temporariamente
let temp_6;

// salva o caminho da url em modal
$('.modal').on('shown.bs.modal', function () {
    temp_6 = $('.fe-image-url-6').val();
});

// salva o caminho da url em page
if ($('.fe-image-url-6') != null) {
    temp_6 = $('.fe-image-url-6').val();
}

// se remover a imagem
if ($('.fe-remove-preview-6')) {
    $('.fe-remove-preview-6').on('click', function () {
        $(this).addClass('fe-hidden');
        $('.fe-preview-6').html('<img class="fe-img-preview-6 fe-img-preview-cover" src="" alt="">');
        $('.fe-image-6').val('');
        $('.fe-image-url-6').val('');
        $('.fe-image-6').valid();
    });
}

// se adicionar imagem
if ($('.fe-grid-preview-item-6')) {
    $('.fe-grid-preview-item-6').on('click', function () {
        document.querySelector('.fe-image-6').click();
    });
}

// mostrando imagem adicionada
if ($('.fe-image-6')) {
    $('.fe-image-6').change(function (e) {
        let extension = $(this).val().split('.').pop().toLowerCase();
        let accepted  = ['jpg', 'jpeg', 'png', 'gif'];

        function showPreview() {
            $('.fe-preview-6').html('<img class="fe-img-preview-6 fe-img-preview-cover" src="" alt="">');
            let reader = new FileReader();

            reader.onload = function () {
                $('.fe-img-preview-6').attr('src', reader.result);
            };
            reader.readAsDataURL(e.target.files[0]);
        }

        // validação da imagem
        if (new RegExp(accepted.join('|')).test(extension)) {
            $('.fe-remove-preview-6').removeClass('fe-hidden');
            $('.fe-image-url-6').val(temp_6);
            showPreview();
        } else {
            $('.fe-remove-preview-6').addClass('fe-hidden');
            $('.fe-image-url-6').val('');
            $('.fe-preview-6').html('');
        }

        $('.fe-image-6').valid();
    });
}

/*!
=========================================================
* imagem preview 7
=========================================================
*/

// salva a url temporariamente
let temp_7;

// salva o caminho da url em modal
$('.modal').on('shown.bs.modal', function () {
    temp_7 = $('.fe-image-url-7').val();
});

// salva o caminho da url em page
if ($('.fe-image-url-7') != null) {
    temp_7 = $('.fe-image-url-7').val();
}

// se remover a imagem
if ($('.fe-remove-preview-7')) {
    $('.fe-remove-preview-7').on('click', function () {
        $(this).addClass('fe-hidden');
        $('.fe-preview-7').html('<img class="fe-img-preview-7 fe-img-preview-cover" src="" alt="">');
        $('.fe-image-7').val('');
        $('.fe-image-url-7').val('');
        $('.fe-image-7').valid();
    });
}

// se adicionar imagem
if ($('.fe-grid-preview-item-7')) {
    $('.fe-grid-preview-item-7').on('click', function () {
        document.querySelector('.fe-image-7').click();
    });
}

// mostrando imagem adicionada
if ($('.fe-image-7')) {
    $('.fe-image-7').change(function (e) {
        let extension = $(this).val().split('.').pop().toLowerCase();
        let accepted  = ['jpg', 'jpeg', 'png', 'gif'];

        function showPreview() {
            $('.fe-preview-7').html('<img class="fe-img-preview-7 fe-img-preview-cover" src="" alt="">');
            let reader = new FileReader();

            reader.onload = function () {
                $('.fe-img-preview-7').attr('src', reader.result);
            };
            reader.readAsDataURL(e.target.files[0]);
        }

        // validação da imagem
        if (new RegExp(accepted.join('|')).test(extension)) {
            $('.fe-remove-preview-7').removeClass('fe-hidden');
            $('.fe-image-url-7').val(temp_7);
            showPreview();
        } else {
            $('.fe-remove-preview-7').addClass('fe-hidden');
            $('.fe-image-url-7').val('');
            $('.fe-preview-7').html('');
        }

        $('.fe-image-7').valid();
    });
}

/*!
=========================================================
* imagem preview 8
=========================================================
*/

// salva a url temporariamente
let temp_8;

// salva o caminho da url em modal
$('.modal').on('shown.bs.modal', function () {
    temp_8 = $('.fe-image-url-8').val();
});

// salva o caminho da url em page
if ($('.fe-image-url-8') != null) {
    temp_8 = $('.fe-image-url-8').val();
}

// se remover a imagem
if ($('.fe-remove-preview-8')) {
    $('.fe-remove-preview-8').on('click', function () {
        $(this).addClass('fe-hidden');
        $('.fe-preview-8').html('<img class="fe-img-preview-8 fe-img-preview-cover" src="" alt="">');
        $('.fe-image-8').val('');
        $('.fe-image-url-8').val('');
        $('.fe-image-8').valid();
    });
}

// se adicionar imagem
if ($('.fe-grid-preview-item-8')) {
    $('.fe-grid-preview-item-8').on('click', function () {
        document.querySelector('.fe-image-8').click();
    });
}

// mostrando imagem adicionada
if ($('.fe-image-8')) {
    $('.fe-image-8').change(function (e) {
        let extension = $(this).val().split('.').pop().toLowerCase();
        let accepted  = ['jpg', 'jpeg', 'png', 'gif'];

        function showPreview() {
            $('.fe-preview-8').html('<img class="fe-img-preview-8 fe-img-preview-cover" src="" alt="">');
            let reader = new FileReader();

            reader.onload = function () {
                $('.fe-img-preview-8').attr('src', reader.result);
            };
            reader.readAsDataURL(e.target.files[0]);
        }

        // validação da imagem
        if (new RegExp(accepted.join('|')).test(extension)) {
            $('.fe-remove-preview-8').removeClass('fe-hidden');
            $('.fe-image-url-8').val(temp_8);
            showPreview();
        } else {
            $('.fe-remove-preview-8').addClass('fe-hidden');
            $('.fe-image-url-8').val('');
            $('.fe-preview-8').html('');
        }

        $('.fe-image-8').valid();
    });
}

/*!
=========================================================
* imagem preview 9
=========================================================
*/

// salva a url temporariamente
let temp_9;

// salva o caminho da url em modal
$('.modal').on('shown.bs.modal', function () {
    temp_9 = $('.fe-image-url-9').val();
});

// salva o caminho da url em page
if ($('.fe-image-url-9') != null) {
    temp_9 = $('.fe-image-url-9').val();
}

// se remover a imagem
if ($('.fe-remove-preview-9')) {
    $('.fe-remove-preview-9').on('click', function () {
        $(this).addClass('fe-hidden');
        $('.fe-preview-9').html('<img class="fe-img-preview-9 fe-img-preview-cover" src="" alt="">');
        $('.fe-image-9').val('');
        $('.fe-image-url-9').val('');
        $('.fe-image-9').valid();
    });
}

// se adicionar imagem
if ($('.fe-grid-preview-item-9')) {
    $('.fe-grid-preview-item-9').on('click', function () {
        document.querySelector('.fe-image-9').click();
    });
}

// mostrando imagem adicionada
if ($('.fe-image-9')) {
    $('.fe-image-9').change(function (e) {
        let extension = $(this).val().split('.').pop().toLowerCase();
        let accepted  = ['jpg', 'jpeg', 'png', 'gif'];

        function showPreview() {
            $('.fe-preview-9').html('<img class="fe-img-preview-9 fe-img-preview-cover" src="" alt="">');
            let reader = new FileReader();

            reader.onload = function () {
                $('.fe-img-preview-9').attr('src', reader.result);
            };
            reader.readAsDataURL(e.target.files[0]);
        }

        // validação da imagem
        if (new RegExp(accepted.join('|')).test(extension)) {
            $('.fe-remove-preview-9').removeClass('fe-hidden');
            $('.fe-image-url-9').val(temp_9);
            showPreview();
        } else {
            $('.fe-remove-preview-9').addClass('fe-hidden');
            $('.fe-image-url-9').val('');
            $('.fe-preview-9').html('');
        }

        $('.fe-image-9').valid();
    });
}
