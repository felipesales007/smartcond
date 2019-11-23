let screenViacep = '';

// clear cep form values
function cleanViacep() {
    $('.fe-star-address' + screenViacep).addClass('fe-hidden');
    $('.fe-star-house-number' + screenViacep).addClass('fe-hidden');
    $('.fe-star-complement' + screenViacep).addClass('fe-hidden');
    $('.fe-star-neighborhood' + screenViacep).addClass('fe-hidden');
    $('.fe-star-city' + screenViacep).addClass('fe-hidden');
    $('.fe-star-state-id' + screenViacep).addClass('fe-hidden');
    $('.fe-star-country' + screenViacep).addClass('fe-hidden');

    $('#address' + screenViacep).val('').removeClass('is-invalid').removeClass('is-valid');
    $('#house-number' + screenViacep).val('').removeClass('is-invalid').removeClass('is-valid');
    $('#complement' + screenViacep).val('').removeClass('is-invalid').removeClass('is-valid');
    $('#neighborhood' + screenViacep).val('').removeClass('is-invalid').removeClass('is-valid');
    $('#city' + screenViacep).val('').removeClass('is-invalid').removeClass('is-valid');
    $('#state-id' + screenViacep).val('').removeClass('is-invalid').removeClass('is-valid');
    $('#state-id' + screenViacep).select2({placeholder: 'Selecione'}).removeClass('is-invalid').removeClass('is-valid');
    $('#country' + screenViacep).val('').removeClass('is-invalid').removeClass('is-valid');

    $('.input-group-text', '.validate-address' + screenViacep).removeClass('is-invalid').removeClass('is-valid');
    $('.input-group-text', '.validate-house-number' + screenViacep).removeClass('is-invalid').removeClass('is-valid');
    $('.input-group-text', '.validate-complement' + screenViacep).removeClass('is-invalid').removeClass('is-valid');
    $('.input-group-text', '.validate-neighborhood' + screenViacep).removeClass('is-invalid').removeClass('is-valid');
    $('.input-group-text', '.validate-city' + screenViacep).removeClass('is-invalid').removeClass('is-valid');
    $('.input-group-text', '.validate-country' + screenViacep).removeClass('is-invalid').removeClass('is-valid');

    if ($('#address' + screenViacep).parent().next('div').find('div[role="alert"]').prevObject[0]) {
        $('#address' + screenViacep).parent().next('div').find('div[role="alert"]').prevObject[0].innerHTML = '&ensp;';
    }

    if ($('#neighborhood' + screenViacep).parent().next('div').find('div[role="alert"]').prevObject[0]) {
        $('#neighborhood' + screenViacep).parent().next('div').find('div[role="alert"]').prevObject[0].innerHTML = '&ensp;';
    }

    if ($('#city' + screenViacep).parent().next('div').find('div[role="alert"]').prevObject[0]) {
        $('#city' + screenViacep).parent().next('div').find('div[role="alert"]').prevObject[0].innerHTML = '&ensp;';
    }

    if ($('#state-id' + screenViacep).parent().next('div').find('div[role="alert"]').prevObject[0]) {
        $('#state-id' + screenViacep).parent().next('div').find('div[role="alert"]').prevObject[0].innerHTML = '&ensp;';
    }

    if ($('#country' + screenViacep).parent().next('div').find('div[role="alert"]').prevObject[0]) {
        $('#country' + screenViacep).parent().next('div').find('div[role="alert"]').prevObject[0].innerHTML = '&ensp;';
    }
}

// field validation when leaving the cep field
$(document).on('focusout', '#postal-code' + screenViacep, function () {
    $('#postal-code' + screenViacep).valid();
    $('#address' + screenViacep).valid();
    $('#house-number' + screenViacep).valid();
    $('#complement' + screenViacep).valid();
    $('#neighborhood' + screenViacep).valid();
    $('#city' + screenViacep).valid();
    $('#state-id' + screenViacep).valid();
    $('#country' + screenViacep).valid();
});

// update fields with values
let cep;
cep = content => {
    if (!('erro' in content)) {
        $('#postal-code' + screenViacep).valid();
        $('#address' + screenViacep).val(content.logradouro).valid();
        $('#house-number' + screenViacep).val('').valid();
        $('#complement' + screenViacep).val(content.complemento).valid();
        $('#neighborhood' + screenViacep).val(content.bairro).valid();
        $('#city' + screenViacep).val(content.localidade).valid();
        returnStateId(content);
        $('#country' + screenViacep).val('Brasil').valid();

        if (content.logradouro) {
            $('.fe-star-address' + screenViacep).removeClass('fe-hidden');
        } else {
            $('.fe-star-address' + screenViacep).addClass('fe-hidden');
        }

        if (content.complemento) {
            $('.fe-star-complement' + screenViacep).removeClass('fe-hidden');
        } else {
            $('.fe-star-complement' + screenViacep).addClass('fe-hidden');
        }

        if (content.bairro) {
            $('.fe-star-neighborhood' + screenViacep).removeClass('fe-hidden');
        } else {
            $('.fe-star-neighborhood' + screenViacep).addClass('fe-hidden');
        }

        if (content.localidade) {
            $('.fe-star-city' + screenViacep).removeClass('fe-hidden');
        } else {
            $('.fe-star-city' + screenViacep).addClass('fe-hidden');
        }

        if (content.uf) {
            $('.fe-star-state-id' + screenViacep).removeClass('fe-hidden');
        } else {
            $('.fe-star-state-id' + screenViacep).addClass('fe-hidden');
        }

        $('.fe-star-country' + screenViacep).removeClass('fe-hidden');
    } else {
        // cep code not found
        swal({
            title: 'CEP não encontrado',
            text: 'Por favor, insira um CEP válido',
            imageUrl: url_public('images/default/postal-code-error.png'),
            buttonsStyling: !1,
            confirmButtonClass: 'btn btn-primary pr-5 pl-5',
            confirmButtonText: 'OK'
        });

        $('#postal-code' + screenViacep).val('');
        cleanViacep();
    }
};

// search the inserted cep
function viacep(valor, screen) {
    screenViacep = screen;

    // new digit-only cep variable
    let cep = valor.replace(/\D/g, '');

    // check if cep field has entered value
    if (cep !== '') {
        // regular expression to validate cep code
        let validate = /^[0-9]{8}$/;

        // validates cep format
        if (validate.test(cep)) {
            // create a javascript element
            let script = document.createElement('script');

            // syncs with callback
            script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=cep';

            // insert script into document and load content
            document.body.appendChild(script);
        } else {
            // cep code is invalid
            cleanViacep();
        }
    } else {
        // worthless cep code, clear form
        cleanViacep();
    }
}

// return state id
function returnStateId(content) {
    let state_id;

    if (content.uf === 'AC') {
        state_id = '1';
    } else if (content.uf === 'AL') {
        state_id = '2';
    } else if (content.uf === 'AP') {
        state_id = '3';
    } else if (content.uf === 'AM') {
        state_id = '4';
    } else if (content.uf === 'BA') {
        state_id = '5';
    } else if (content.uf === 'CE') {
        state_id = '6';
    } else if (content.uf === 'DF') {
        state_id = '7';
    } else if (content.uf === 'ES') {
        state_id = '8';
    } else if (content.uf === 'GO') {
        state_id = '9';
    } else if (content.uf === 'MA') {
        state_id = '10';
    } else if (content.uf === 'MT') {
        state_id = '11';
    } else if (content.uf === 'MS') {
        state_id = '12';
    } else if (content.uf === 'MG') {
        state_id = '13';
    } else if (content.uf === 'PA') {
        state_id = '14';
    } else if (content.uf === 'PB') {
        state_id = '15';
    } else if (content.uf === 'PR') {
        state_id = '16';
    } else if (content.uf === 'PE') {
        state_id = '17';
    } else if (content.uf === 'PI') {
        state_id = '18';
    } else if (content.uf === 'RJ') {
        state_id = '19';
    } else if (content.uf === 'RN') {
        state_id = '20';
    } else if (content.uf === 'RS') {
        state_id = '21';
    } else if (content.uf === 'RO') {
        state_id = '22';
    } else if (content.uf === 'RR') {
        state_id = '23';
    } else if (content.uf === 'SC') {
        state_id = '24';
    } else if (content.uf === 'SP') {
        state_id = '25';
    } else if (content.uf === 'SE') {
        state_id = '26';
    } else if (content.uf === 'TO') {
        state_id = '27';
    }

    $('#state-id' + screenViacep).val(state_id);
    $('#state-id' + screenViacep).select2().val(state_id).valid();
}
