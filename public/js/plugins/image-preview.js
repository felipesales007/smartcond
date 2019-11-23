/*!
 * FE-Image-Preview by Felipe Sales v3.0.0 (https://www.felipesales.com.br/)
 * Copyright 2018-2019 The FE-Library Authors
 * Copyright 2018-2019 FE, Inc.
 * Licensed under MIT
 */

/*!
=========================================================
* image upload management function
=========================================================
*/

function destination_url(name, type) {
    let variable = '-' + moment().format('HH-mm-ss') + '.';
    return $.md5(name) + variable + type;
}

/*!
=========================================================
* js preview images
=========================================================
*/

for (let i = 0; i < 20; i++) {
    // save url temporarily
    let temp;

    // save url path in modal
    $('.modal').on('shown.bs.modal', function () {
        temp = $('.fe-image-url-' + i).val();
    });

    // save url path to page
    if ($('.fe-image-url-' + i) != null) {
        temp = $('.fe-image-url-' + i).val();
    }

    // if you remove the image
    if ($('.fe-remove-preview-' + i)) {
        $('.fe-remove-preview-' + i).on('click', function () {
            $(this).addClass('fe-hidden');
            $('.fe-preview-' + i).html('<img class="fe-img-preview-' + i + ' fe-img-preview-cover" src="" alt="">');
            $('.fe-image-' + i).val('');
            $('.fe-image-url-' + i).val('');
            $('.fe-image-' + i).valid();
        });
    }

    // if you add picture
    if ($('.fe-grid-preview-item-' + i)) {
        $('.fe-grid-preview-item-' + i).on('click', function () {
            document.querySelector('.fe-image-' + i).click();
        });
    }

    // showing added image
    if ($('.fe-image-' + i)) {
        $('.fe-image-' + i).change(function (e) {
            let extension = $(this).val().split('.').pop().toLowerCase();
            let accepted  = ['jpg', 'jpeg', 'png', 'gif'];

            function showPreview() {
                $('.fe-preview-' + i).html('<img class="fe-img-preview-' + i + ' fe-img-preview-cover" src="" alt="">');
                let reader = new FileReader();

                reader.onload = function () {
                    $('.fe-img-preview-' + i).attr('src', reader.result);
                };
                reader.readAsDataURL(e.target.files[0]);
            }

            // image validation
            if (new RegExp(accepted.join('|')).test(extension)) {
                $('.fe-remove-preview-' + i).removeClass('fe-hidden');
                $('.fe-image-url-' + i).val(temp);
                showPreview();
            } else {
                $('.fe-remove-preview-' + i).addClass('fe-hidden');
                $('.fe-image-url-' + i).val('');
                $('.fe-preview-' + i).html('');
            }

            $('.fe-image-' + i).valid();
        });
    }
}
