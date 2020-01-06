/*!
 * FE-Library Javascript and Jquery by Felipe Sales v2.0.0 (https://www.felipesales.com.br/)
 * Copyright 2016-2019 The FE-Library Authors
 * Copyright 2018-2019 FE, Inc.
 * Licensed under MIT
 */

// console.log() custom
const l = _ => console.log(_);

// loading
$(window).on('load', function () {
    $('.fe-bg-loader').fadeOut('slow');
    $('.fe-loader').fadeOut('slow');
});

// loading submit
$('button[type="submit"]').on('click', function () {
    $('form').submit(function () {
        if ($(this).valid()) {
            $('.fe-bg-loader').css('display', '');
            $('.fe-loader').css('display', '');
        }
    });
});

// loading link
$('.fe-loading').on('click', function () {
    $('.fe-bg-loader').css('display', '');
    $('.fe-loader').css('display', '');
});

// loading ajax
function loader(status) {
    if (status === 1) {
        $('.fe-bg-loader').css('display', '');
        $('.fe-loader').css('display', '');
    } else {
        $('.fe-bg-loader').fadeOut('slow');
        $('.fe-loader').fadeOut('slow');
    }
}

// identifies if access comes from PC or mobile
if (navigator.userAgent.toLowerCase().match(/(iphone|ipod|ipad|android)/)) {
    // mobile
    // ignore not to hit the mobile keyboard
    function firstLetterUppercase() {}

    // ignore not to hit the mobile keyboard
    function letterUppercase() {}
} else {
    // PC
    // first letter uppercase - onkeyup="firstLetterUppercase(this);"
    function firstLetterUppercase(letter) {
        let text     = letter.value;
        let quantity = letter.value.length;
        let first    = text.substr(0, 1);
        let rest     = text.substr(1, quantity);

        letter.value = first.toUpperCase() + rest;
    }

    // all first letter uppercase - onkeyup="letterUppercase('id');"
    function letterUppercase(letter) {
        // list of words to ignore
        let ignore = [
            'de', 'do', 'dos', 'das', 'a', 'e', 'i',
            'o', 'u', 'é', 'ou', 'ao', 'em', 'da',
        ], minLength = 2;

        let catchWord = function (str) {
            return str.match(/\S+\s*/g);
        };

        $('#' + letter).each(function () {
            let words = catchWord(this.value);

            if (this.value.length > 0) {
                $.each(words, function (i, word) {
                    // only continues if words are not in the ignore list
                    if (ignore.indexOf($.trim(word)) === -1 && $.trim(word).length > minLength) {
                        words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1).toLowerCase();
                    } else {
                        words[i] = words[i].toLowerCase();
                    }
                });
                this.value = words.join('');
            }
        });
    }
}

// show button loading icon
$('.fe-spinner').on('click', function () {
    $('form').submit(function () {
        if ($(this).valid()) {
            $('.fe-spinner').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Carregando');
        }
    });
});

// show charging icon in specific place
function sending() {
    $('.fe-spinner').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Enviando');
}

// navbar transition
if ($('.navbar-dark').length > 0) {
    $('.modal').on('show.bs.modal hidden.bs.modal', function () {
        $('.navbar-dark').removeClass('fe-transition');
    });

    $(window).on('scroll load resize', function () {
        let startY = $('.navbar-dark').height();

        window.onload = function () {
            $('.navbar-dark').removeClass('fe-transition');
        };

        if ($(window).scrollTop() > startY) {
            $('.navbar-dark').addClass('bg-primary');
        } else {
            $('.navbar-dark').removeClass('bg-primary');
            $('.navbar-dark').addClass('fe-transition');
        }
    });
}

// today's datepicker behind
$(function () {
    $('.datepicker-back').datepicker({
        language: 'pt-BR',
        autoclose: true,
        immediateUpdates: true,
        enableOnReadonly: false,
        endDate: '0d'
    }).on('hide', function () {
        $('#' + this.id).valid();
    });
});

// today's datepicker forward
$(function () {
    $('.datepicker-onwards').datepicker({
        language: 'pt-BR',
        autoclose: true,
        immediateUpdates: true,
        enableOnReadonly: false,
        startDate: '0d'
    }).on('hide', function () {
        $('#' + this.id).valid();
    });
});

// today's datepicker with clear forward button
$(function () {
    $('.datepicker-clean-onwards').datepicker({
        language: 'pt-BR',
        autoclose: true,
        immediateUpdates: true,
        enableOnReadonly: false,
        startDate: '0d',
        clearBtn: true
    }).on('hide', function () {
        $('#' + this.id).valid();
    });
});

// only allow letters and accents from A to Z + space - onkeypress="return onlyLetters(event);"
function onlyLetters(event) {
    let code;

    if (event.keyCode) {
        code = event.keyCode;
    } else {
        code = event.charCode;
    }

    let validate  = 'abcdefghijlmnopqrstuvxzwykABCDEFGHIJLMNOPQRSTUVXZWYKÁÉÍÓÚáéíóúÂÊÔâêôÀàÇçÃÕãõ ';
    let character = String.fromCharCode(code);

    if (validate.indexOf(character) > -1) {
        return true;
    }

    return validate.indexOf(character) > -1 || code < 9;
}

// allow only letters and accent from A to Z + space and special characters - onkeypress="return onlyLettersCharacters(event);"
function onlyLettersCharacters(event) {
    let code;

    if (event.keyCode) {
        code = event.keyCode;
    } else {
        code = event.charCode;
    }

    let validate  = 'abcdefghijlmnopqrstuvxzwykABCDEFGHIJLMNOPQRSTUVXZWYKÁÉÍÓÚáéíóúÂÊÔâêôÀàÇçÃÕãõ-.,/ ';
    let character = String.fromCharCode(code);

    if (validate.indexOf(character) > -1) {
        return true;
    }

    return validate.indexOf(character) > -1 || code < 9;
}

// allow only letters without accent from A to Z + space - onkeypress="return lettersOnlyNoAccent(event);"
function lettersOnlyNoAccent(event) {
    let code;

    if (event.keyCode) {
        code = event.keyCode;
    } else {
        code = event.charCode;
    }

    let validate  = 'abcdefghijlmnopqrstuvxzwykABCDEFGHIJLMNOPQRSTUVXZWYK ';
    let character = String.fromCharCode(code);

    if (validate.indexOf(character) > -1) {
        return true;
    }

    return validate.indexOf(character) > -1 || code < 9;
}

// only allow characters for one group - onkeypress="return groupCharacters(event);"
function groupCharacters(event) {
    let code;

    if (event.keyCode) {
        code = event.keyCode;
    } else {
        code = event.charCode;
    }

    let validate  = 'abcdefghijlmnopqrstuvxzwyk_-';
    let character = String.fromCharCode(code);

    if (validate.indexOf(character) > -1) {
        return true;
    }

    return validate.indexOf(character) > -1 || code < 9;
}

// only allow characters for one url - onkeypress="return urlCharacters(event);"
function urlCharacters(event) {
    let code;

    if (event.keyCode) {
        code = event.keyCode;
    } else {
        code = event.charCode;
    }

    let validate  = 'abcdefghijlmnopqrstuvxzwyk/{?}_-';
    let character = String.fromCharCode(code);

    if (validate.indexOf(character) > -1) {
        return true;
    }

    return validate.indexOf(character) > -1 || code < 9;
}

// only allow characters for one route - onkeypress="return routeCharacters(event);"
function routeCharacters(event) {
    let code;

    if (event.keyCode) {
        code = event.keyCode;
    } else {
        code = event.charCode;
    }

    let validate  = 'abcdefghijlmnopqrstuvxzwyk._-';
    let character = String.fromCharCode(code);

    if (validate.indexOf(character) > -1) {
        return true;
    }

    return validate.indexOf(character) > -1 || code < 9;
}

// allow only characters for a control - onkeypress="return controlCharacters(event);"
function controlCharacters(event) {
    let code;

    if (event.keyCode) {
        code = event.keyCode;
    } else {
        code = event.charCode;
    }

    let validate  = 'abcdefghijlmnopqrstuvxzwykABCDEFGHIJLMNOPQRSTUVXZWYK@_\\';
    let character = String.fromCharCode(code);

    if (validate.indexOf(character) > -1) {
        return true;
    }

    return validate.indexOf(character) > -1 || code < 9;
}

// only allow characters for one icon - onkeypress="return charactersIcon(event);"
function charactersIcon(event) {
    let code;

    if (event.keyCode) {
        code = event.keyCode;
    } else {
        code = event.charCode;
    }

    let validate  = 'abcdefghijlmnopqrstuvxzwyk- ';
    let character = String.fromCharCode(code);

    if (validate.indexOf(character) > -1) {
        return true;
    }

    return validate.indexOf(character) > -1 || code < 9;
}

// only allow characters for one unit - onkeypress="return unitNumber(event);"
function unitNumber(event) {
    let code;

    if (event.keyCode) {
        code = event.keyCode;
    } else {
        code = event.charCode;
    }

    let validate  = '1234567890.';
    let character = String.fromCharCode(code);

    if (validate.indexOf(character) > -1) {
        return true;
    }

    return validate.indexOf(character) > -1 || code < 9;
}

// only allow numbers - onkeypress="return onlyNumbers(event);"
function onlyNumbers(number) {
    let charCode = number.charCode ? number.charCode : number.keyCode;

    if (charCode !== 8 && charCode !== 9) {
        if (charCode < 48 || charCode > 57) {
            return false;
        }
    }
}

// only allow from A to Z with accents and numbers + space - onkeypress="return onlyLettersNumbers(event);"
function onlyLettersNumbers(event) {
    let code;

    if (event.keyCode) {
        code = event.keyCode;
    } else {
        code = event.charCode;
    }

    let validate  = '0123456789abcdefghijlmnopqrstuvxzwykABCDEFGHIJLMNOPQRSTUVXZWYKÁÉÍÓÚáéíóúÂÊÔâêôÀàÇçÃÕãõ-.,/ ';
    let character = String.fromCharCode(code);

    if (validate.indexOf(character) > -1) {
        return true;
    }

    return validate.indexOf(character) > -1 || code < 9;
}

// block space - onkeyup="this.value = noSpace(this.value);"
function noSpace(letter) {
    return letter.replace(/ /g, '');
}

// prevents line break in textarea
$('textarea').on('keypress', function (event) {
    let enter = 13;
    let char  = event.which || event.keyCode;

    if (char === enter) {
        event.preventDefault();
    }
});

// prevents zero left typing
setInterval(function () {
    let digit = $('.fe-zero-left');

    for (let i = 0; i < digit.length; i++) {
        while (digit[i].value.length > 0 && digit[i].value.substr(0, 1) === '0') {
            digit[i].value = digit[i].value.substr(1);
        }
    }
}, 0);

// prevents you from entering a number first
setInterval(function () {
    let digit = $('.fe-letter-first');

    for (let i = 0; i < digit.length; i++) {
        while (digit[i].value.length > 0 &&
        digit[i].value.substr(0, 1) === '0' ||
        digit[i].value.substr(0, 1) === '1' ||
        digit[i].value.substr(0, 1) === '2' ||
        digit[i].value.substr(0, 1) === '3' ||
        digit[i].value.substr(0, 1) === '4' ||
        digit[i].value.substr(0, 1) === '5' ||
        digit[i].value.substr(0, 1) === '6' ||
        digit[i].value.substr(0, 1) === '7' ||
        digit[i].value.substr(0, 1) === '8' ||
        digit[i].value.substr(0, 1) === '9') {
            digit[i].value = digit[i].value.substr(1);
        }
    }
}, 0);

// control for page changes with window.history
if (document.referrer.indexOf(window.location.href) >= 0) {
    sessionStorage.setItem('history.back', 1 + parseInt(sessionStorage.getItem('history.back')));
} else {
    sessionStorage.setItem('history.back', '1');
}

// go back to previous screen - onclick="back();"
function back() {
    // browser actions
    if (navigator.userAgent.toLowerCase().indexOf('chrome') > -1) {
        // chrome
        window.history.go(-sessionStorage.getItem('history.back'));
    } else if (navigator.userAgent.toLowerCase().indexOf('firefox') > -1) {
        // firefox
        window.history.back();
    } else if ((!!window.opr && !!opr.addons) || !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0) {
        // opera
        window.history.back();
    } else if (/constructor/i.test(window.HTMLElement) || (function (p) { return p.toString() === '[object SafariRemoteNotification]'; })(!window['safari'] || (typeof safari !== 'undefined' && safari.pushNotification))) {
        // safari
        window.history.go(-sessionStorage.getItem('history.back'));
    } else if (navigator.userAgent.toLowerCase().indexOf('edge') > -1) {
        // edge
        window.history.back();
    } else if (/*@cc_on!@*/!!document.documentMode) {
        // ie
        window.history.back();
    } else {
        // outro
        window.history.back();
    }
}

// body transition by clicking on the side menu
$(function () {
    $(document).on('click', '.sidenav-toggler', function () {
        $('.main-content').addClass('fe-transition-default');
    });
});

// manual validations
$('form').submit(function () {
    if ($(this).html().indexOf('form-control') > 0 || $(this).html().indexOf('custom-control-input') > 0) {
        $(this).valid();
    }

    if ($(this).html().indexOf('select') > 0) {
        $('select').valid();
    }
});

// select2 validation and checkbox in submit
$('button[type="submit"]').on('click', function (e) {
    if (document.querySelector('select')) {
        let select = e.delegateTarget.form.querySelectorAll('select');

        for (let i = 0; i < select.length; i++) {
            $('#' + select[i].id).valid();
        }
    }

    if (document.querySelector('input[type="checkbox"]')) {
        let checkbox = e.delegateTarget.form.querySelectorAll('input[type="checkbox"]');

        for (let i = 0; i < checkbox.length; i++) {
            $('#' + checkbox[i].id).valid();
        }
    }
});

// select2 validation in focus
$(document).on('focusout', '.select2', function () {
    $($(this).siblings('select')).valid();
});

// initialize all select with select2 with search input, validation and custom arrow animation
$('select').select2({
    placeholder: 'Selecione',
    language: 'pt-BR',
    sorter: data => data.sort((a, b) => a.text.localeCompare(b.text)),
}).on('select2:open', function (e) {
    $('.modal').removeAttr('tabindex');

    $('.validate-' + e.currentTarget.id + ' .select2-selection').addClass('select2-selection-up');

    if (!$('.select2-selection--single').hasClass('is-invalid') && !$('.select2-selection--single').hasClass('is-valid')) {
        $('.select2-selection--single').on(function () {
            $(this).parent().addClass('border-primary');
            $('#' + this.id).valid();
        });
    }

    if (!$('.select2-selection--multiple').hasClass('is-invalid') && !$('.select2-selection--multiple').hasClass('is-valid')) {
        $('.select2-selection--multiple').on(function () {
            $(this).parent().addClass('border-primary');
            $('#' + this.id).valid();
        });
    }
}).on('select2:close', function (e) {
    $('.modal').attr('tabindex', '-1');

    $('.validate-' + e.currentTarget.id + ' .select2-selection').removeClass('select2-selection-up').removeClass('border-primary');

    $('#' + this.id).valid();
}).on('select2:select', function (e) {
    $('.validate-' + e.currentTarget.id + ' .select2-selection').removeClass('select2-selection-up').removeClass('border-primary');

    $('#' + this.id).valid();
}).on('select2:unselect', function (e) {
    $('.validate-' + e.currentTarget.id + ' .select2-selection').removeClass('select2-selection-up').removeClass('border-primary');

    let id = '#' + $('#' + e.currentTarget.id).next().prevObject[0].form.id;

    if ($(id + ' .select2-selection--multiple').find('.select2-search.select2-search--inline') && $(id + ' .select2-selection--multiple').find('li.select2-selection__choice').length === 0) {
        $(id + ' .select2-selection--multiple').html('<span class="select2-selection__rendered" role="textbox" aria-readonly="true"><span class="select2-selection__placeholder">Selecione</span></span>');
    }

    let opts = $(this).data('select2').options;
    opts.set('disabled', true);
    setTimeout(function () {
        opts.set('disabled', false);
    }, 0);

    $('#' + this.id).valid();
});

// initialize select2 without search input
$('.select-nosearch').select2({
    placeholder: 'Selecione',
    language: 'pt-BR',
    sorter: data => data.sort((a, b) => a.text.localeCompare(b.text)),
    minimumResultsForSearch: -1
});

// tabindex in select2 multiple
$(document).on('keyup', function (e) {
    if (e.which === 9) {
        $('.select2-selection--multiple').attr('tabindex', '0');
    }
});

// placeholder in select2 multiple
$('.modal').on('show.bs.modal hidden.bs.modal', function (e) {
    let id  = '#' + e.currentTarget.id;

    if ($(id + ' .select2-selection--multiple').find('.select2-search.select2-search--inline') && $(id + ' .select2-selection--multiple').find('li.select2-selection__choice').length === 0) {
        $(id + ' .select2-selection--multiple').html('<span class="select2-selection__rendered" role="textbox" aria-readonly="true"><span class="select2-selection__placeholder">Selecione</span></span>');
    }
});

// block copy and paste input
$(function () {
    $('.fe-block-paste').bind('cut copy paste', function (event) {
        event.preventDefault();
    });
});

// required fields add * not required - onkeyup="isRequired(this);"
function isRequired(input) {
    // defined fields
    if (input.id === 'password-edit-user' || input.id === 'password-confirmation-edit-user') {
        if (input.value) {
            $('.fe-star-password-edit-user').removeClass('fe-hidden');
            $('.fe-star-password-confirmation-edit-user').removeClass('fe-hidden');
        } else {
            $('.fe-star-password-edit-user').addClass('fe-hidden');
            $('.fe-star-password-confirmation-edit-user').addClass('fe-hidden');
        }
    } else {
        // undefined fields
        if (input.value) {
            $('.fe-star-' + input.id).removeClass('fe-hidden');
        } else {
            $('.fe-star-' + input.id).addClass('fe-hidden');
        }
    }
}

// scroll top if valid
$('.fe-scroll-top').on('click', function () {
    $('form').submit(function () {
        if ($(this).valid()) {
            $('html, body, .modal').animate({
                scrollTop: 0
            }, 400);
        }
    });

    if ($('.accordion div').hasClass('show')) {
        $('form a[data-toggle="collapse"]').click();
    }

    $('.accordion').on('shown.bs.collapse', function () {
        $('form .collapse').collapse('hide');
    });
});

// scroll top if valid in ajax
function scrollTop() {
    $('html, body, .modal').animate({
        scrollTop: 0
    }, 400);

    if ($('.accordion div').hasClass('show')) {
        $('form a[data-toggle="collapse"]').click();
    }
}

// show or hide password
function viewPassword(event) {
    let icon  = event.querySelector('i');
    let input = event.parentNode.querySelector('input');

    if (input.type === 'password') {
        input.type = 'text';
    } else {
        input.type = 'password';
    }

    if ($(icon).hasClass('fa-eye')) {
        $(icon).removeClass('fa-eye');
        $(icon).addClass('fa-eye-slash');
    } else {
        $(icon).removeClass('fa-eye-slash');
        $(icon).addClass('fa-eye');
    }
}

// view and hide password assist
$('.modal').on('hidden.bs.modal', function (e) {
    let form = e.target.id;

    if ($('#' + form).find('.fa-eye-slash').length > 0) {
        let icon  = $('#' + form).find('.fa-eye-slash');
        let input = icon.parent().parent().parent().children('input');

        for (let i = 0; i < icon.length; i++) {
            icon.removeClass('fa-eye-slash');
            icon.addClass('fa-eye');
            input.prop('type', 'password');
        }
    }
});

// clear input
function clearInput(event) {
    event.parentNode.querySelector('input').value = '';
}

// clear input datepicker
function clearInputDatepicker(event) {
    let input = event.parentNode.querySelector('input').getAttribute('id');
    $('#' + input).datepicker('setDate', null);
}

// submit blocks button type submit to avoid duplication
$(document).on('submit', 'form', function () {
    $(this.querySelector('button[type="submit"]')).attr('disabled', 'disabled');
});

// ajax token
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// ajax remove validation
function removeValidate() {
    $('span').removeClass('is-invalid').removeClass('is-valid');
    $('input').removeClass('is-invalid').removeClass('is-valid');
    $('textarea').removeClass('is-invalid').removeClass('is-valid');
    $('.invalid-feedback').remove();
}

// ajax server validation
function serverValidate(data) {
    if (data.status === 422) {
        $.each(data.responseJSON.errors, function (i, error) {
            i = i.replace(/_/g, '-');
            let el = $('.validate-' + i);

            $('.validate-' + i + ' ' + '.input-group-text').removeClass('is-valid').addClass('is-invalid');
            $('[aria-labelledby="select2-' + i + '-container"]').addClass('is-invalid');
            $('#' + i).removeClass('is-valid').addClass('is-invalid');
            el.after($('<div id="' + i + '-error" class="invalid-feedback">' + error[0] + '</div>'));
        });
    }
}

// remove validation information on form
function removeInfoRequired(form) {
    if (document.querySelector(form)) {
        let tags  = document.querySelector(form);
        let input = tags.querySelectorAll(['input', 'select', 'textarea']);

        for (let i = 0; i < input.length; i++) {
            if (input[i].id) {
                $('.fe-star-' + input[i].id).addClass('fe-hidden');
            }
        }
    }
}

// format date on date br
function date_to_date_br(data) {
    if (data) {
        let date  = new Date(data);
        let day   = '' + (date.getDate() + 1);
        let month = '' + (date.getMonth() + 1);
        let year  = date.getFullYear();

        if (day.length < 2) {
            day = '0' + day;
        }

        if (month.length < 2) {
            month = '0' + month;
        }

        return [day, month, year].join('/');
    } else {
        return null;
    }
}

// format timestamp on date br on datepicker
function timestamp_to_date_br(data) {
    if (data) {
        let date  = new Date(data);
        let day   = '' + date.getDate();
        let month = '' + (date.getMonth() + 1);
        let year  = date.getFullYear();

        if (day.length < 2) {
            day = '0' + day;
        }

        if (month.length < 2) {
            month = '0' + month;
        }

        return [day, month, year].join('/');
    } else {
        return null;
    }
}

// calculate age
function calculateAge(date) {
    if (date) {
        let birthday = +new Date(date);
        return ~~((Date.now() - birthday) / (31557600000));
    } else {
        return null;
    }
}

// check whether block input is active or not - onkeyup="statusCheckbox(this);"
function statusCheckbox(input, string) {
    let icon = '#' + input.id;
    let checkbox;
    let button;

    if ($(input).parent().parent().parent().parent().find('input[type="checkbox"]')[0]) {
        checkbox = '#' + $(input).parent().parent().parent().parent().find('input[type="checkbox"]')[0].id;
    }

    if ($(input).parent().parent().parent().parent().parent().find('button[type="submit"]')[0]) {
        button = '#' + $(input).parent().parent().parent().parent().parent().find('button[type="submit"]')[0].id;
    }

    if ($(input).val().length === 0 && !$(checkbox).prop('checked')) {
        $(button).html('Desbloquear ' + string);
        $(icon + '-clean').addClass('fe-hidden');
    } else if ($(input).val().length === 0) {
        $(button).html('Bloquear ' + string);
        $(icon + '-clean').addClass('fe-hidden');
    } else {
        $(icon + '-clean').removeClass('fe-hidden');
        $(checkbox).prop('checked', false).removeAttr('checked', 'checked');
        $(button).html('Bloquear ' + string);
    }
}

// helper checks whether the block input is active or not
function changeCheckbox(checkbox, string) {
    let input;
    let button;

    if ($(checkbox).parent().parent().parent().parent().parent().find('input[type="tel"]')[0]) {
        input = '#' + $(checkbox).parent().parent().parent().parent().parent().find('input[type="tel"]')[0].id;
    }

    if ($(checkbox).parent().parent().parent().parent().parent().parent().find('button[type="submit"]')[0]) {
        button = '#' + $(checkbox).parent().parent().parent().parent().parent().parent().find('button[type="submit"]')[0].id;
    }

    if ($(checkbox).prop('checked')) {
        $(input).datepicker('setDate', null);
        $(button).html('Bloquear ' + string);
    } else {
        if ($(input).val()) {
            if ($(input).val().length === 0) {
                $(button).html('Desbloquear ' + string);
            }
        } else {
            $(button).html('Desbloquear ' + string);
        }
    }
}

// assign true or false value in clicked checkbox
$('input[type="checkbox"]').change(function () {
    if ($(this).prop('checked')) {
        $(this).attr('checked', 'checked');
    } else {
        $(this).removeAttr('checked', 'checked');
    }
});

// returns the first word of a sentence
function first_word(word) {
    if (word !== null && typeof word !== 'undefined') {
        return word.split(' ')[0];
    }
}

// returns the first two words of a sentence
function two_word(word) {
    if (word !== null && typeof word !== 'undefined') {
        if (word.indexOf(' ') > 1) {
            return word.split(' ')[0] + ' ' + word.split(' ')[1];
        } else {
            return word;
        }
    }
}

// return current date and time
$(function () {
    let date   = new Date();
    let day    = date.getDate();
    let hour   = date.getHours();
    let minute = date.getMinutes();
    let year   = date.getFullYear();
    let week   = date.getDay();
    let month  = date.getMonth();
    let weeks  = ['Domingo', 'Segunda-Feira', 'Terça-Feira', 'Quarta-Feira', 'Quinta-Feira', 'Sexta-Feira', 'Sábado'];
    let months = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novenmbro', 'Dezembro'];

    if (hour.toString().length < 2) {
        hour = '0' + hour;
    }

    if (minute.toString().length < 2) {
        minute = '0' + minute;
    }

    $('.date-now').html(day + ' de ' + months[month] + ' de ' + year);
    $('.time-now').html(hour + ':' + minute);
    $('.week-now').html(weeks[week]);
    $('.date-time-now').html(day + ' de ' + months[month] + ' de ' + year + ' - ' + hour + ':' + minute);
    $('.week-date-time-now').html(weeks[week] + ', ' + day + ' de ' + months[month] + ' de ' + year + ' - ' + hour + ':' + minute);
});

// check if it's number
function isNumber(e) {
    return !isNaN(parseFloat(e)) && isFinite(e);
}

// returns value in pt-BR
function to_real(value) {
    let number = value;

    if (number) {
        if (!isNumber(number.toString().replace('R$ ', '')) ||
            !isNumber(number.toString().replace('R$', '')) ||
            number === '' || number === null || number === typeof 'undefined') {
            return '0,00'
        } else {
            number = number.toString().replace('R$', '');
            number = number.toString().replace('R$ ', '');
            number = parseFloat(number).toLocaleString('pt-br', { minimumFractionDigits: 2 });

            return number;
        }
    } else {
        return null;
    }
}

// returns value in USD
function to_usd(value) {
    let number = value;

    if (!isNumber(number.toString().replace(".", '').replace(',', '.').replace('R$ ', '')) ||
        !isNumber(number.toString().replace(".", '').replace(',', '.').replace('R$', '')) ||
        number === '' || number === null || number === typeof 'undefined') {
        return '0.00';
    } else {
        number = number.toString().replace('R$', '');
        number = number.toString().replace('R$ ', '');
        number = number.replace(".", '').replace(',', '.');

        return number;
    }
}

// return to url
function url_public($destination) {
    let protocol  = window.location.protocol + '//';
    let hostname  = window.location.hostname + '/';

    return protocol + hostname + $destination;
}

// JQuery Mask masks for the system
$(function () {
    // mask for phone and cellphone
    let maskPhones = function (val) {
        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    }, mask = {
        onKeyPress: function(val, e, field, options) {
            field.mask(maskPhones.apply({}, arguments), options);
        }
    };

    // mask
    $('.mask-date').mask('00/00/0000');
    $('.mask-time').mask('00:00:00');
    $('.mask-date-time').mask('00/00/0000 00:00:00');
    $('.mask-cep').mask('00000-000');
    $('.mask-phone').mask('0000-0000');
    $('.mask-cell-phone').mask('00000-0000');
    $('.mask-phone-ddd').mask('(00) 0000-0000');
    $('.mask-cell-phone-ddd').mask('(00) 00000-0000');
    $('.mask-phones').mask(maskPhones, mask);
    $('.mask-cpf').mask('000.000.000-00', {reverse: true});
    $('.mask-cnpj').mask('00.000.000/0000-00', {reverse: true});
    $('.mask-money').mask('000.000.000.000.000,00', {reverse: true});
    $('.mask-money-2').mask('#.##0,00', {reverse: true});
    $('.mask-ip-address').mask('0ZZ.0ZZ.0ZZ.0ZZ', {
        translation: {
            'Z': {
                pattern: /[0-9]/, optional: true
            }
        }
    });
    $('.mask-ip-address').mask('099.099.099.099');
    $('.mask-percent').mask('##0,00%', {reverse: true});
    $('.mask-date-clear-if-not-match').mask('00/00/0000', {clearIfNotMatch: true});
    $('.mask-date-placeholder').mask('00/00/0000', {placeholder: '__/__/____'});
    $('.mask-fallback').mask('00r00r0000', {
        translation: {
            'r': {
                pattern: /[\/]/,
                fallback: '/'
            },
            placeholder: '__/__/____'
        }
    });
    $('.mask-date-selectonfocus').mask('00/00/0000', {selectOnFocus: true});
});

// animate item - onclick="animateItem(this, 'fa-pulse');"
function animateItem(item, animation) {
    /*
     * types of animations:
     * pulse, faa-wrench, faa-ring, faa-horizontal,
     * faa-pulse, faa-shake, faa-burst, faa-tada
     */

    $(item).addClass(animation + ' animated');

    let interval = setInterval(function () {
        $(item).removeClass(animation + ' animated');
        clearInterval(interval);
    }, 1000);
}

// copy the text
function copyToClipboard(string) {
    let textarea = document.createElement('textarea');

    textarea.textContent = $(string).text();
    document.body.appendChild(textarea);

    let selection = document.getSelection();
    let range = document.createRange();

    range.selectNode(textarea);
    selection.removeAllRanges();
    selection.addRange(range);

    document.execCommand('copy');

    selection.removeAllRanges();
    document.body.removeChild(textarea);

    let data = {
        'from'   : 'bottom',
        'align'  : 'right',
        'type'   : 'success',
        'icon'   : 'far fa-copy',
        'title'  : 'Notificação',
        'message': 'Copia realizada com sucesso.'
    };

    this.notify(data);
}

// disable click when menu is locked
$('.fe-menu-block').on('click', function () {
    return false;
});

// enter click submit button automatically
$(function () {
    $('.modal').on('shown.bs.modal', function () {
        $(this).on('keypress', function (e) {
            if (e.which === 13) {
                $(this).find('button[type="submit"]').click();
            }
        });
    });

    $(document).on('keypress', function (e) {
        if (!document.querySelector('.modal.show')) {
            if (e.which === 13) {
                $(this).find('form[method="post"][role="form"]').find('button[type="submit"]').click();
            }
        }
    });
});

// event for opening and closing double collapses
$(function () {
    let item;

    $('.collapse').on('show.bs.collapse', function (e) {
        let collapse = e.target.dataset.parent;

        if (collapse) {
            if (collapse.indexOf('event') !== -1) {
                if (item === collapse) {
                    item = collapse;
                } else {
                    if (item) {
                        $(item).click();
                        item = collapse;
                    } else {
                        item = collapse;
                    }
                }
            }
        }
    });

    $('.collapse').on('hidden.bs.collapse', function (e) {
        let collapse = e.target.dataset.parent;

        if (collapse) {
            if (collapse.indexOf('event') !== -1) {
                if (item !== collapse) {
                    $(item).click();
                } else {
                    item = null;
                }
            }
        }
    });

    $('.modal').on('hidden.bs.modal', function () {
        if (item) {
            $(item).click();
        }
    });
});

// collapse view and hide event - onclick="collapseView(this);"
function collapseView(e) {
    $(e).parent().find('.d-none').removeClass('d-none');
    $(e).addClass('d-none');
}

// avoid events
$('.no-event').click(function (e) {
    e.stopPropagation();
});

// check and uncheck all checkboxes - onclick="checkboxAll(this);"
function checkboxAll(checkbox) {
    let checkboxes = $(document).find('[data-check="' + checkbox.id + '"]');

    for (let i = 0; i < checkboxes.length; i++) {
        if (!$('#' + checkbox.id).attr('checked')) {
            $('#' + checkboxes[i].id).prop('checked', true).attr('checked', 'checked');
            $(checkbox).closest('form').find('.' + checkbox.id).html(checkboxes.length + '/' + checkboxes.length);
        } else {
            $('#' + checkboxes[i].id).prop('checked', false).removeAttr('checked', 'checked');
            $(checkbox).closest('form').find('.' + checkbox.id).html('0/' + checkboxes.length);
        }
    }
}

// check if all checkboxes are checked - onclick="checkboxOne(this);"
function checkboxOne(checkbox) {
    let checkboxAll = $(checkbox).data('check');
    let checkboxes  = $(document).find('[data-check="' + checkboxAll + '"]').length;
    let checked     = $(document).find('[data-check="' + checkboxAll + '"]:checked').length;

    $(checkbox).closest('form').find('.' + checkboxAll).html(checked + '/' + checkboxes);

    if (checkboxes === checked) {
        $('#' + checkboxAll).prop('checked', true).attr('checked', 'checked');
    } else {
        $('#' + checkboxAll).prop('checked', false).removeAttr('checked', 'checked');
    }
}

// open or closed item event
function eventExpanded(e, first, second) {
    if ($(e).attr('aria-expanded') === 'false') {
        $(e).html(first + ' ');
    } else {
        $(e).html(second + ' ');
    }
}

// mask for values in real
$(".to-real").maskMoney({prefix:'', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});

// animation when form is invalid
function formInvalidAnimate(form) {
    let interval = setInterval(function () {
        form.removeClass('shake animated');
        clearInterval(interval);
    }, 1000);

    form.addClass('shake animated');
}

// event for animation when form is invalid
$('button[type="submit"]').on('click', function () {
    let form = $(this).parent().parent().parent().parent();

    form.find(':input').filter('[required]:visible').each(function (index, e) {
        if (e.value === null || e.value === '') {
            formInvalidAnimate(form);
        }
    });

    if (form.find('.invalid-feedback').length > 0) {
        formInvalidAnimate(form);
        form.find('.invalid-feedback').addClass('valid-feedback').removeClass('invalid-feedback');
    }
});

// event for animation when form is invalid
$('.fe-animation-invalid').on('click', function () {
    let form = $(this).parent().parent().parent().parent();

    form.find(':input').filter('[required]:visible').each(function (index, e) {
        if (e.value === null || e.value === '') {
            formInvalidAnimate(form);
        }
    });

    if (form.find('.invalid-feedback').length > 0) {
        formInvalidAnimate(form);
        form.find('.invalid-feedback').addClass('valid-feedback').removeClass('invalid-feedback');
    }
});

// event for animation when form is invalid via post
$(window).on('load', function () {
    let form = $('button[type="submit"]').parent().parent().parent().parent();

    if (form.find('.invalid-feedback').length > 0) {
        formInvalidAnimate(form);
    }
});

// enable tooltip
$('body').tooltip({
    selector: '[data-toggle="tooltip"]'
});

// zero left
function zero_left(value, quantity) {
    if (quantity) {
        if (value) {
            return value.toString().padStart(quantity, '0');
        }

        return null;
    } else {
        return value;
    }
}
