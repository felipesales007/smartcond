/*!
 * FE-Library Javascript and Jquery by Felipe Sales v2.0.0 (https://www.felipesales.com.br/)
 * Copyright 2016-2019 The FE-Library Authors
 * Copyright 2018-2019 FE, Inc.
 * Licensed under MIT
 */

// console.log() personalisado
const l = _ => console.log(_);

// carregando
$(window).on('load', function () {
    $('.fe-bg-loader').fadeOut('slow');
    $('.fe-loader').fadeOut('slow');
});

// carregando em submit
$('button[type="submit"]').on('click', function () {
    if ($('.input-group').hasClass('fe-recaptcha')) {
        if (grecaptcha.getResponse() !== '') {
            $('form').submit(function () {
                if ($(this).valid()) {
                    $('.fe-bg-loader').css('display', '');
                    $('.fe-loader').css('display', '');
                }
            });
        }
    } else {
        $('form').submit(function () {
            if ($(this).valid()) {
                $('.fe-bg-loader').css('display', '');
                $('.fe-loader').css('display', '');
            }
        });
    }
});

// carregando em ajax
function loader(status) {
    if (status === 1) {
        $('.fe-bg-loader').css('display', '');
        $('.fe-loader').css('display', '');
    } else {
        $('.fe-bg-loader').fadeOut('slow');
        $('.fe-loader').fadeOut('slow');
    }
}

// identifica se o acesso vem de PC ou celular
if (navigator.userAgent.toLowerCase().match(/(iphone|ipod|ipad|android)/)) {
    // celular
    // ignora para não bugar o teclado mobile
    function primeiraLetraMaiuscula() {}

    // ignora para não bugar o teclado mobile
    function letraMaiuscula() {}
} else {
    // PC
    // primeira letra maiúscula - onkeyup="primeiraLetraMaiuscula(this);"
    function primeiraLetraMaiuscula(letra) {
        let texto      = letra.value;
        let quantidade = letra.value.length;
        let primeira   = texto.substr(0, 1);
        let resto      = texto.substr(1, quantidade);

        texto       = primeira.toUpperCase() + resto;
        letra.value = texto;
    }

    // todas as primeiras letras maiúscula - onkeyup="letraMaiuscula('id');"
    function letraMaiuscula(letra) {
        // lista de palavras a serem ignoradas
        let ignore = [
            'de', 'do', 'dos', 'das', 'a', 'e', 'i',
            'o', 'u', 'é', 'ou', 'ao', 'em', 'da',
        ], minLength = 2;

        let pegaPalavra = function (str) {
            return str.match(/\S+\s*/g);
        };

        $('#' + letra).each(function () {
            let palavra = pegaPalavra(this.value);

            if (this.value.length > 0) {
                $.each(palavra, function (i, word) {
                    // só continua se a palavra não estiver na lista de ignoradas
                    if (ignore.indexOf($.trim(word)) === -1 && $.trim(word).length > minLength) {
                        palavra[i] = palavra[i].charAt(0).toUpperCase() + palavra[i].slice(1).toLowerCase();
                    } else {
                        palavra[i] = palavra[i].toLowerCase();
                    }
                });
                this.value = palavra.join('');
            }
        });
    }
}

// valida e-mail
function validaEmail(email) {
    let usuario = email.substr(0, email.indexOf('@'));
    let dominio = email.substr(email.indexOf('@') + 1, email.length);

    return  (usuario.length >= 1) &&
            (dominio.length >= 3) &&
            (usuario.search('@') === -1) &&
            (dominio.search('@') === -1) &&
            (usuario.search(' ') === -1) &&
            (dominio.search(' ') === -1) &&
            (dominio.search('.') !== -1) &&
            (dominio.indexOf('.') >= 1) &&
            (dominio.lastIndexOf('.') < dominio.length - 1);
}

// mostra icone de carregamento no botão
$('.fe-carregando').on('click', function () {
    $('form').submit(function () {
        if ($(this).valid()) {
            $('.fe-carregando').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Carregando');
        }
    });
});

// mostra icone de carregamento no botão em form com recaptcha
$('.fe-recaptcha-carregando').on('click', function () {
    $('form').submit(function () {
        if ($(this).valid() && grecaptcha.getResponse() !== '') {
            $('.fe-recaptcha-carregando').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Carregando');
        }
    });
});

// mostra icone de carregamento em lugar determinado
function enviando() {
    $('.fe-carregando').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Enviando');
}

// transição do navbar
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
            $('.navbar-dark').addClass('fe-bg-theme');
        } else {
            $('.navbar-dark').removeClass('fe-bg-theme');
            $('.navbar-dark').addClass('fe-transition');
        }
    });
}

// responsividade do reCAPTCHA
if (window.location.href.indexOf('/registrar') >= 0) {
    window.onload = function () {
        function reCAPTCHA() {
            let width = $('.fe-recaptcha').parent().width();
            if (width < 302) {
                let scale = width / 302;
                $('.fe-recaptcha').css('transform', 'scale(' + scale + ')');
                $('.fe-recaptcha').css('-webkit-transform', 'scale(' + scale + ')');
                $('.fe-recaptcha').css('transform-origin', '0 0');
                $('.fe-recaptcha').css('-webkit-transform-origin', '0 0');
            }

            if (grecaptcha.getResponse() !== '') {
                $('#g-recaptcha-error').html('');
            }
        }

        setInterval(reCAPTCHA, 250);
    }
}

// datepicker de hoje para trás
$(function () {
    $('.datepicker-back').datepicker({
        language: 'pt-BR',
        autoclose: true,
        immediateUpdates: true,
        enableOnReadonly: false,
        endDate: '0d'
    });
});

// datepicker com botão limpar de hoje para frente
$(function () {
    $('.datepicker-clean-onwards').datepicker({
        language: 'pt-BR',
        autoclose: true,
        immediateUpdates: true,
        enableOnReadonly: false,
        startDate: '0d',
        clearBtn: true
    });
});

// permite só letras e acentuações de A a Z + espaço - onkeypress="return soLetras(event);"
function soLetras(event) {
    let codigo;

    if (event.keyCode) {
        codigo = event.keyCode;
    } else {
        codigo = event.charCode;
    }

    let valida    = 'abcdefghijlmnopqrstuvxzwykABCDEFGHIJLMNOPQRSTUVXZWYKÁÉÍÓÚáéíóúÂÊÔâêôÀàÇçÃÕãõ ';
    let caractere = String.fromCharCode(codigo);

    if (valida.indexOf(caractere) > -1) {
        return true;
    }

    return valida.indexOf(caractere) > -1 || codigo < 9;
}

// permite só letras e acentuações de A a Z + espaço e caracteres especiais - onkeypress="return soLetrasCaracteres(event);"
function soLetrasCaracteres(event) {
    let codigo;

    if (event.keyCode) {
        codigo = event.keyCode;
    } else {
        codigo = event.charCode;
    }

    let valida    = 'abcdefghijlmnopqrstuvxzwykABCDEFGHIJLMNOPQRSTUVXZWYKÁÉÍÓÚáéíóúÂÊÔâêôÀàÇçÃÕãõ-. ';
    let caractere = String.fromCharCode(codigo);

    if (valida.indexOf(caractere) > -1) {
        return true;
    }

    return valida.indexOf(caractere) > -1 || codigo < 9;
}

// permite só letras sem acentuações de A a Z + espaço - onkeypress="return soLetrasSemAcento(event);"
function soLetrasSemAcento(event) {
    let codigo;

    if (event.keyCode) {
        codigo = event.keyCode;
    } else {
        codigo = event.charCode;
    }

    let valida    = 'abcdefghijlmnopqrstuvxzwykABCDEFGHIJLMNOPQRSTUVXZWYK ';
    let caractere = String.fromCharCode(codigo);

    if (valida.indexOf(caractere) > -1) {
        return true;
    }

    return valida.indexOf(caractere) > -1 || codigo < 9;
}

// permite só caracteres para um grupo - onkeypress="return caracteresGrupo(event);"
function caracteresGrupo(event) {
    let codigo;

    if (event.keyCode) {
        codigo = event.keyCode;
    } else {
        codigo = event.charCode;
    }

    let valida    = 'abcdefghijlmnopqrstuvxzwyk_-';
    let caractere = String.fromCharCode(codigo);

    if (valida.indexOf(caractere) > -1) {
        return true;
    }

    return valida.indexOf(caractere) > -1 || codigo < 9;
}

// permite só caracteres para uma url - onkeypress="return caracteresUrl(event);"
function caracteresUrl(event) {
    let codigo;

    if (event.keyCode) {
        codigo = event.keyCode;
    } else {
        codigo = event.charCode;
    }

    let valida    = 'abcdefghijlmnopqrstuvxzwyk/{?}_-';
    let caractere = String.fromCharCode(codigo);

    if (valida.indexOf(caractere) > -1) {
        return true;
    }

    return valida.indexOf(caractere) > -1 || codigo < 9;
}

// permite só caracteres para uma rota - onkeypress="return caracteresRota(event);"
function caracteresRota(event) {
    let codigo;

    if (event.keyCode) {
        codigo = event.keyCode;
    } else {
        codigo = event.charCode;
    }

    let valida    = 'abcdefghijlmnopqrstuvxzwyk._-';
    let caractere = String.fromCharCode(codigo);

    if (valida.indexOf(caractere) > -1) {
        return true;
    }

    return valida.indexOf(caractere) > -1 || codigo < 9;
}

// permite só caracteres para um controle - onkeypress="return caracteresControle(event);"
function caracteresControle(event) {
    let codigo;

    if (event.keyCode) {
        codigo = event.keyCode;
    } else {
        codigo = event.charCode;
    }

    let valida    = 'abcdefghijlmnopqrstuvxzwykABCDEFGHIJLMNOPQRSTUVXZWYK@_\\';
    let caractere = String.fromCharCode(codigo);

    if (valida.indexOf(caractere) > -1) {
        return true;
    }

    return valida.indexOf(caractere) > -1 || codigo < 9;
}

// permite só caracteres para um ícone - onkeypress="return caracteresIcone(event);"
function caracteresIcone(event) {
    let codigo;

    if (event.keyCode) {
        codigo = event.keyCode;
    } else {
        codigo = event.charCode;
    }

    let valida    = 'abcdefghijlmnopqrstuvxzwyk- ';
    let caractere = String.fromCharCode(codigo);

    if (valida.indexOf(caractere) > -1) {
        return true;
    }

    return valida.indexOf(caractere) > -1 || codigo < 9;
}

// permite só números - onkeypress="return soNumeros(event);"
function soNumeros(digito) {
    let charCode = digito.charCode ? digito.charCode : digito.keyCode;

    if (charCode !== 8 && charCode !== 9) {
        if (charCode < 48 || charCode > 57) {
            return false;
        }
    }
}

// permite só de A a Z com acentuações e números + espaço - onkeypress="return soLetrasNumeros(event);"
function soLetrasNumeros(event) {
    let codigo;

    if (event.keyCode) {
        codigo = event.keyCode;
    } else {
        codigo = event.charCode;
    }

    let valida    = '0123456789abcdefghijlmnopqrstuvxzwykABCDEFGHIJLMNOPQRSTUVXZWYKÁÉÍÓÚáéíóúÂÊÔâêôÀàÇçÃÕãõ ';
    let caractere = String.fromCharCode(codigo);

    if (valida.indexOf(caractere) > -1) {
        return true;
    }

    return valida.indexOf(caractere) > -1 || codigo < 9;
}

// bloqueia espaço - onkeyup="this.value = semEspaco(this.value);"
function semEspaco(letra) {
    return letra.replace(/ /g, '');
}

// evita quebra de linha em textarea
$('textarea').on('keypress', function (event) {
    let enter = 13;
    let char  = event.which || event.keyCode;

    if (char === enter) {
        event.preventDefault();
    }
});

// evita que seja digitado zero a esquerda
setInterval(function () {
    let digito = $('.fe-zero-esquerda');

    for (let i = 0; i < digito.length; i++) {
        while (digito[i].value.length > 0 && digito[i].value.substr(0, 1) === '0') {
            digito[i].value = digito[i].value.substr(1);
        }
    }
}, 0);

// evita que seja digitado um número primeiro
setInterval(function () {
    let digito = $('.fe-letra-primeiro');

    for (let i = 0; i < digito.length; i++) {
        while (digito[i].value.length > 0 &&
        digito[i].value.substr(0, 1) === '0' ||
        digito[i].value.substr(0, 1) === '1' ||
        digito[i].value.substr(0, 1) === '2' ||
        digito[i].value.substr(0, 1) === '3' ||
        digito[i].value.substr(0, 1) === '4' ||
        digito[i].value.substr(0, 1) === '5' ||
        digito[i].value.substr(0, 1) === '6' ||
        digito[i].value.substr(0, 1) === '7' ||
        digito[i].value.substr(0, 1) === '8' ||
        digito[i].value.substr(0, 1) === '9') {
            digito[i].value = digito[i].value.substr(1);
        }
    }
}, 0);

// formatação para telefone, data, RG, CPF e etc - maxlength="15" onkeypress="return formatar(event, this, '(##) ####-####');"
function formatar(event, id, mask) {
    let tecla = (event.code) ? event.keyCode : event.which;

    if (tecla > 47 && tecla < 58) {
        mascara(id, mask);
        return true;
    } else {
        if (tecla === 8 || tecla === 0) {
            mascara(id, mask);
            return true;
        } else {
            return false;
        }
    }
}

// auxiliar de formatação para telefone, data, RG, CPF e etc
function mascara(id, mask) {
    let i         = id.value.length;
    let carac     = mask.substring(i, i + 1);
    let prox_char = mask.substring(i + 1, i + 2);

    if (i === 0 && carac !== '#') {
        insereCaracter(id, carac);
        if (prox_char !== '#') {
            insereCaracter(id, prox_char);
        }
    } else if (carac !== '#') {
        insereCaracter(id, carac);
        if (prox_char !== '#') {
            insereCaracter(id, prox_char);
        }
    }

    function insereCaracter(id, char) {
        id.value += char;
    }
}

// controle para mudanças de páginas com window.history
if (document.referrer.indexOf(window.location.href) >= 0) {
    sessionStorage.setItem('history.back', 1 + parseInt(sessionStorage.getItem('history.back')));
} else {
    sessionStorage.setItem('history.back', '1');
}

// volta para a tela anterior - onclick="voltar();"
function voltar() {
    // ações em navegadores
    if (!!window.chrome && (!!window.chrome.webstore || !!window.chrome.runtime)) {
        // chrome
        window.history.go(-sessionStorage.getItem('history.back'));
    } else if (typeof InstallTrigger !== 'undefined') {
        // firefox
        window.history.go(-1);
    } else if ((!!window.opr && !!opr.addons) || !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0) {
        // opera
        window.history.go(-1);
    } else if (/constructor/i.test(window.HTMLElement) || (function (p) { return p.toString() === '[object SafariRemoteNotification]'; })(!window['safari'] || (typeof safari !== 'undefined' && safari.pushNotification))) {
        // safari
        window.history.go(-sessionStorage.getItem('history.back'));
    } else if (/Edge/.test(navigator.userAgent)) {
        // edge
        window.history.go(-1);
    } else if (/*@cc_on!@*/!!document.documentMode) {
        // ie
        window.history.go(-1);
    } else {
        // outro
        window.history.go(-1);
    }
}

// transição do corpo ao clicar no menu lateral
$(function () {
    $(document).on('click', '.sidenav-toggler', function () {
        $('.main-content').addClass('fe-transition-default');
    });
});

// validações manuais
$('form').submit(function () {
    if ($(this).html().indexOf('form-control') > 0 || $(this).html().indexOf('custom-control-input') > 0) {
        $('input').valid();
    }

    if ($(this).html().indexOf('select') > 0) {
        $('select').valid();
    }

    if ($('.input-group').hasClass('fe-recaptcha')) {
        if (grecaptcha.getResponse() === '') {
            $('#g-recaptcha-error').html('<span class="invalid-feedback" role="alert">O campo recaptcha é obrigatório.</span>');
        }
    }
});

// validação em select2 e checkbox no submit
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

// validação em select2 no focus
$(document).on('focusout', '.select2', function () {
    $($(this).siblings('select')).valid();
});

// inicializa todos os select com select2 com input de busca, validação e com animação da seta personalizada
$('select').select2({
    placeholder: 'Selecione',
    language: 'pt-BR',
    sorter: data => data.sort((a, b) => a.text.localeCompare(b.text)),
}).on('select2:open', function () {
    $('.modal').removeAttr('tabindex');

    $('.select2-selection--single').one('click', function () {
        $(this).addClass('select2-selection--single-up');
    });

    if (!$('.select2-selection--single').hasClass('is-invalid') && !$('.select2-selection--single').hasClass('is-valid')) {
        $('.select2-selection--single').on(function () {
            $(this).parent().addClass('fe-focus-select2');
            $('#' + this.id).valid();
        });
    }
}).on('select2:close', function () {
    $('.modal').attr('tabindex', '-1');

    $('.select2-selection--single').removeClass('select2-selection--single-up');
    $('.select2-selection--single').removeClass('fe-focus-select2');
    $('#' + this.id).valid();
}).on('select2:select', function () {
    $('.select2-selection--single').removeClass('select2-selection--single-up');
    $('.select2-selection--single').removeClass('fe-focus-select2');
    $('#' + this.id).valid();
}).on('select2:unselect', function () {
    $('.select2-selection--single').removeClass('select2-selection--single-up');
    $('.select2-selection--single').removeClass('fe-focus-select2');
    $('#' + this.id).valid();
});

// inicializa o select2 sem input de busca
$('.select-nosearch').select2({
    placeholder: 'Selecione',
    language: 'pt-BR',
    sorter: data => data.sort((a, b) => a.text.localeCompare(b.text)),
    minimumResultsForSearch: -1
});

// bloqueia o input de copiar e colar
$(function () {
    $('.fe-block-paste').bind('cut copy paste', function (event) {
        event.preventDefault();
    });
});

// add * de campos required não obrigatório - onkeyup="isRequired(this);"
function isRequired(input) {
    // campos definidos
    if (input.id === 'password-edit-user' || input.id === 'password-confirmation-edit-user') {
        if (input.value) {
            $('.fe-star-password-edit-user').removeClass('fe-hidden');
            $('.fe-star-password-confirmation-edit-user').removeClass('fe-hidden');
        } else {
            $('.fe-star-password-edit-user').addClass('fe-hidden');
            $('.fe-star-password-confirmation-edit-user').addClass('fe-hidden');
        }
    } else {
        // campos não definidos
        if (input.value) {
            $('.fe-star-' + input.id).removeClass('fe-hidden');
        } else {
            $('.fe-star-' + input.id).addClass('fe-hidden');
        }
    }
}

// scroll top se form válido
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

// scroll top se form válido em ajax
function scrollTop() {
    $('html, body, .modal').animate({
        scrollTop: 0
    }, 400);

    if ($('.accordion div').hasClass('show')) {
        $('form a[data-toggle="collapse"]').click();
    }
}

// visualizar ou esconder password
function verSenha(event) {
    let icone = event.querySelector('i');
    let input = event.parentNode.querySelector('input');

    if (input.type === 'password') {
        input.type = 'text';
    } else {
        input.type = 'password';
    }

    if ($(icone).hasClass('fa-eye')) {
        $(icone).removeClass('fa-eye');
        $(icone).addClass('fa-eye-slash');
    } else {
        $(icone).removeClass('fa-eye-slash');
        $(icone).addClass('fa-eye');
    }
}

// auxiliar de visualizar ou esconder password
$('.modal').on('hidden.bs.modal', function (e) {
    let form = e.target.id;

    if ($('#' + form).find('.fa-eye-slash').length > 0) {
        let icon = $('#' + form).find('.fa-eye-slash');
        let input = icon.parent().parent().parent().children('input');

        for (let i = 0; i < icon.length; i++) {
            icon.removeClass('fa-eye-slash');
            icon.addClass('fa-eye');
            input.prop('type', 'password');
        }
    }
});

// limpa o input
function limparInput(event) {
    let input   = event.parentNode.querySelector('input');
    input.value = '';
}

// limpa o input datepicker
function limparInputDatepicker(event) {
    let input = event.parentNode.querySelector('input').getAttribute('id');
    $('#' + input).datepicker('setDate', null);
}

// submit bloquea button type submit, para evitar duplicidade
$(document).on('submit', 'form', function () {
    $(this.querySelector('button[type="submit"]')).attr('disabled', 'disabled');

    if ($(this.querySelector('.fe-recaptcha-carregando')).length) {
        if (grecaptcha.getResponse() === '') {
            $(this.querySelector('button[type="submit"]')).removeAttr('disabled', 'disabled');
        }
    }
});

// ajax token
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// ajax remove validações
function removeValidate() {
    $('span').removeClass('is-invalid').removeClass('is-valid');
    $('input').removeClass('is-invalid').removeClass('is-valid');
    $('textarea').removeClass('is-invalid').removeClass('is-valid');
    $('.invalid-feedback').remove();
}

// ajax validações do servidor
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

// remove informações de validações no formulário
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

// formata date em data br
function date_to_date_br(data) {
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
}

// formata timestamp em data br em datepicker
function timestamp_to_date_br(data) {
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
}

// calcula a idade
function calcularIdade(date) {
    let birthday = +new Date(date);
    return ~~((Date.now() - birthday) / (31557600000));
}

// verifica se o input de bloquear está ativo ou não - onkeyup="statusCheckbox(this);"
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

// auxiliar de verifica se o input de bloquear está ativo ou não
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

// atribui valor true ou false em checkbox clicado
$('input[type="checkbox"]').change(function () {
    if ($(this).prop('checked')) {
        $(this).attr('checked', 'checked');
    } else {
        $(this).removeAttr('checked', 'checked');
    }
});

// retorna a primeira palavra de uma frase
function first_word(word) {
    if (word !== null && typeof word !== 'undefined') {
        return word.split(' ')[0];
    }
}

// retorna as duas primeiras palavras de uma frase
function two_word(word) {
    if (word !== null && typeof word !== 'undefined') {
        if (word.indexOf(' ') > 1) {
            return word.split(' ')[0] + ' ' + word.split(' ')[1];
        } else {
            return word;
        }
    }
}

// retorna data e hora atual
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

// retorna valor em pt-BR
function to_real(value) {
    let number   = parseFloat(value);
    let standard = { minimumFractionDigits: 2, style: 'currency', currency: 'BRL' };
    return number.toLocaleString('pt-BR', standard);
}

// retorna a url
function url_public($destination) {
    let protocol  = window.location.protocol + '//';
    let hostname  = window.location.hostname;
    let localhost = window.location.pathname.split('/', 2);

    if (hostname === 'localhost' || hostname === '127.0.0.1' || hostname === '127.0.0.1:8000') {
        hostname += '/' + localhost[1] + '/public/';
    } else {
        hostname += '/';
    }

    return protocol + hostname + $destination;
}

// máscaras JQuery Mask para o sistema
$(function () {
    // máscara para telefone e celular
    let maskPhones = function (val) {
        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    }, mask = {
        onKeyPress: function(val, e, field, options) {
            field.mask(maskPhones.apply({}, arguments), options);
        }
    };

    // máscaras
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

// animar item - onclick="animateItem(this, 'fa-pulse');"
function animateItem(item, animation) {
    /*
     * tipos de animações:
     * pulse, faa-wrench, faa-ring, faa-horizontal,
     * faa-pulse, faa-shake, faa-burst, faa-tada
     */

    $(item).addClass(animation + ' animated');

    let interval = setInterval(function () {
        $(item).removeClass(animation + ' animated');
        clearInterval(interval);
    }, 1000);
}

// copia o texto
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

// desabilita o clique quando o menu está bloqueado
$('.fe-menu-block').on('click', function () {
    return false;
});

// enter clica no botão submit automaticamente
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

// evento para abertura e fechamento de collapses duplo
$(function () {
    let collapse_event;

    $('.collapse').on('show.bs.collapse', function (e) {
        let collapse = e.target.dataset.parent;

        if (collapse) {
            if (collapse.indexOf('event') !== -1) {
                if (collapse_event === collapse) {
                    collapse_event = collapse;
                } else {
                    if (collapse_event) {
                        $(collapse_event).click();
                        collapse_event = collapse;
                    } else {
                        collapse_event = collapse;
                    }
                }
            }
        }
    });

    $('.collapse').on('hidden.bs.collapse', function (e) {
        let collapse = e.target.dataset.parent;

        if (collapse) {
            if (collapse.indexOf('event') !== -1) {
                if (collapse_event !== collapse) {
                    $(collapse_event).click();
                } else {
                    collapse_event = null;
                }
            }
        }
    });

    $('.modal').on('hidden.bs.modal', function () {
        if (collapse_event) {
            $(collapse_event).click();
        }
    });
});

// evento para visualização e ocultação de collapse - onclick="collapseView(this);"
function collapseView(e) {
    $(e).parent().find('.d-none').removeClass('d-none');
    $(e).addClass('d-none');
}

// evita eventos
$('.no-event').click(function (e) {
    e.stopPropagation();
});

// marca e desmarca todos os checkboxes - onclick="checkboxAll(this);"
function checkboxAll(checkbox) {
    let checkboxes = $(document).find('[data-check="' + checkbox.id + '"]');

    for (let i = 0; i < checkboxes.length; i++) {
        if (!$('#' + checkbox.id).attr('checked')) {
            $('#' + checkboxes[i].id).prop('checked', true).attr('checked', 'checked');
        } else {
            $('#' + checkboxes[i].id).prop('checked', false).removeAttr('checked', 'checked');
        }
    }
}

// verifica se todos os checkboxes estão marcados - onclick="checkboxOne(this);"
function checkboxOne(checkbox) {
    let checkboxAll = $(checkbox).data('check');
    let checkboxes  = $(document).find('[data-check="' + checkboxAll + '"]').length;
    let checked     = $(document).find('[data-check="' + checkboxAll + '"]:checked').length;

    if (checkboxes === checked) {
        $('#' + checkboxAll).prop('checked', true).attr('checked', 'checked');
    } else {
        $('#' + checkboxAll).prop('checked', false).removeAttr('checked', 'checked');
    }
}

// evento de item aberto ou fechado
function eventExpanded(e, first, second) {
    if ($(e).attr('aria-expanded') === 'false') {
        $(e).html(first);
    } else {
        $(e).html(second);
    }
}
