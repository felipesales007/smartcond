let screenViacepRequired = '';

// clear cep form values
function cleanViacepRequired() {
    $('.fe-star-house-number' + screenViacepRequired).addClass('fe-hidden');
    $('.fe-star-complement' + screenViacepRequired).addClass('fe-hidden');

    $('#address' + screenViacepRequired).val('').removeClass('is-invalid').removeClass('is-valid');
    $('#house-number' + screenViacepRequired).val('').removeClass('is-invalid').removeClass('is-valid');
    $('#complement' + screenViacepRequired).val('').removeClass('is-invalid').removeClass('is-valid');
    $('#neighborhood' + screenViacepRequired).val('').removeClass('is-invalid').removeClass('is-valid');
    $('#city' + screenViacepRequired).val('').removeClass('is-invalid').removeClass('is-valid');
    $('#state-id' + screenViacepRequired).val('').removeClass('is-invalid').removeClass('is-valid');
    $('#state-id' + screenViacepRequired).select2({placeholder: 'Selecione'}).removeClass('is-invalid').removeClass('is-valid');
    $('#country' + screenViacepRequired).val('').removeClass('is-invalid').removeClass('is-valid');

    $('.input-group-text', '.validate-address' + screenViacepRequired).removeClass('is-invalid').removeClass('is-valid');
    $('.input-group-text', '.validate-house-number' + screenViacepRequired).removeClass('is-invalid').removeClass('is-valid');
    $('.input-group-text', '.validate-complement' + screenViacepRequired).removeClass('is-invalid').removeClass('is-valid');
    $('.input-group-text', '.validate-neighborhood' + screenViacepRequired).removeClass('is-invalid').removeClass('is-valid');
    $('.input-group-text', '.validate-city' + screenViacepRequired).removeClass('is-invalid').removeClass('is-valid');
    $('.input-group-text', '.validate-country' + screenViacepRequired).removeClass('is-invalid').removeClass('is-valid');

    if ($('#address' + screenViacepRequired).parent().next('div').find('div[role="alert"]').prevObject[0]) {
        $('#address' + screenViacepRequired).parent().next('div').find('div[role="alert"]').prevObject[0].innerHTML = '&ensp;';
    }

    if ($('#neighborhood' + screenViacepRequired).parent().next('div').find('div[role="alert"]').prevObject[0]) {
        $('#neighborhood' + screenViacepRequired).parent().next('div').find('div[role="alert"]').prevObject[0].innerHTML = '&ensp;';
    }

    if ($('#city' + screenViacepRequired).parent().next('div').find('div[role="alert"]').prevObject[0]) {
        $('#city' + screenViacepRequired).parent().next('div').find('div[role="alert"]').prevObject[0].innerHTML = '&ensp;';
    }

    if ($('#state-id' + screenViacepRequired).parent().next('div').find('div[role="alert"]').prevObject[0]) {
        $('#state-id' + screenViacepRequired).parent().next('div').find('div[role="alert"]').prevObject[0].innerHTML = '&ensp;';
    }

    if ($('#country' + screenViacepRequired).parent().next('div').find('div[role="alert"]').prevObject[0]) {
        $('#country' + screenViacepRequired).parent().next('div').find('div[role="alert"]').prevObject[0].innerHTML = '&ensp;';
    }
}

// field validation when leaving the cep field
$(document).on('focusout', '#postal-code' + screenViacepRequired, function () {
    $('#postal-code' + screenViacepRequired).valid();
    $('#address' + screenViacepRequired).valid();
    $('#house-number' + screenViacepRequired).valid();
    $('#complement' + screenViacepRequired).valid();
    $('#neighborhood' + screenViacepRequired).valid();
    $('#city' + screenViacepRequired).valid();
    $('#state-id' + screenViacepRequired).valid();
    $('#country' + screenViacepRequired).valid();
});

// update fields with values
let cepRequired;
cepRequired = content => {
    if (!('erro' in content)) {
        $('#postal-code' + screenViacepRequired).valid();
        $('#address' + screenViacepRequired).val(content.logradouro).valid();
        $('#house-number' + screenViacepRequired).val('').valid();
        $('#complement' + screenViacepRequired).val(content.complemento).valid();
        $('#neighborhood' + screenViacepRequired).val(content.bairro).valid();
        $('#city' + screenViacepRequired).val(content.localidade).valid();
        returnStateIdRequired(content);
        $('#country' + screenViacepRequired).val('Brasil').valid();

        if (content.complemento) {
            $('.fe-star-complement' + screenViacepRequired).removeClass('fe-hidden');
        } else {
            $('.fe-star-complement' + screenViacepRequired).addClass('fe-hidden');
        }
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

        $('#postal-code' + screenViacepRequired).val('');
        cleanViacepRequired();
    }
};

// search the inserted cep
function viacepRequired(valor, screen) {
    screenViacepRequired = screen;

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
            script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=cepRequired';

            // insert script into document and load content
            document.body.appendChild(script);
        } else {
            // cep code is invalid
            cleanViacepRequired();
        }
    } else {
        // worthless cep code, clear form
        cleanViacepRequired();
    }
}

// return state id
function returnStateIdRequired(content) {
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

    $('#state-id' + screenViacepRequired).val(state_id);
    $('#state-id' + screenViacepRequired).select2().val(state_id).valid();
}
