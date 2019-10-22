let screenViacepRequired = '';

// limpa valores do formulário de cep
function limpaFormCepRequired() {
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

// validação nos campos ao sair do campo cep
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

// atualiza os campos com os valores
let cepRequired;
cepRequired = conteudo => {
    if (!('erro' in conteudo)) {
        $('#postal-code' + screenViacepRequired).valid();
        $('#address' + screenViacepRequired).val(conteudo.logradouro).valid();
        $('#house-number' + screenViacepRequired).val('').valid();
        $('#complement' + screenViacepRequired).val(conteudo.complemento).valid();
        $('#neighborhood' + screenViacepRequired).val(conteudo.bairro).valid();
        $('#city' + screenViacepRequired).val(conteudo.localidade).valid();
        returnStateIdRequired(conteudo);
        $('#country' + screenViacepRequired).val('Brasil').valid();

        if (conteudo.complemento) {
            $('.fe-star-complement' + screenViacepRequired).removeClass('fe-hidden');
        } else {
            $('.fe-star-complement' + screenViacepRequired).addClass('fe-hidden');
        }
    } else {
        // cep não encontrado
        swal({
            title: 'CEP não encontrado',
            text: 'Por favor, insira um CEP válido',
            imageUrl: url_public('images/default/postal-code-error.png'),
            buttonsStyling: !1,
            confirmButtonClass: 'btn btn-dark pr-5 pl-5',
            confirmButtonText: 'OK'
        });

        $('#postal-code' + screenViacepRequired).val('');
        limpaFormCepRequired();
    }
};

// pesquisa o cep inserido
function viacepRequired(valor, screen) {
    screenViacepRequired = screen;

    // nova variável 'cep' somente com dígitos
    let cep = valor.replace(/\D/g, '');

    // verifica se campo cep possui valor informado
    if (cep !== '') {
        // expressão regular para validar o cep
        let validacep = /^[0-9]{8}$/;

        // valida o formato do cep
        if (validacep.test(cep)) {
            // cria um elemento javascript
            let script = document.createElement('script');

            // sincroniza com o callback
            script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=cepRequired';

            // insere script no documento e carrega o conteúdo
            document.body.appendChild(script);
        } else {
            // cep é inválido
            limpaFormCepRequired();
        }
    } else {
        // cep sem valor, limpa formulário
        limpaFormCepRequired();
    }
}

// retorna o id do estado
function returnStateIdRequired(conteudo) {
    let state_id;

    if (conteudo.uf === 'AC') {
        state_id = '1';
    } else if (conteudo.uf === 'AL') {
        state_id = '2';
    } else if (conteudo.uf === 'AP') {
        state_id = '3';
    } else if (conteudo.uf === 'AM') {
        state_id = '4';
    } else if (conteudo.uf === 'BA') {
        state_id = '5';
    } else if (conteudo.uf === 'CE') {
        state_id = '6';
    } else if (conteudo.uf === 'DF') {
        state_id = '7';
    } else if (conteudo.uf === 'ES') {
        state_id = '8';
    } else if (conteudo.uf === 'GO') {
        state_id = '9';
    } else if (conteudo.uf === 'MA') {
        state_id = '10';
    } else if (conteudo.uf === 'MT') {
        state_id = '11';
    } else if (conteudo.uf === 'MS') {
        state_id = '12';
    } else if (conteudo.uf === 'MG') {
        state_id = '13';
    } else if (conteudo.uf === 'PA') {
        state_id = '14';
    } else if (conteudo.uf === 'PB') {
        state_id = '15';
    } else if (conteudo.uf === 'PR') {
        state_id = '16';
    } else if (conteudo.uf === 'PE') {
        state_id = '17';
    } else if (conteudo.uf === 'PI') {
        state_id = '18';
    } else if (conteudo.uf === 'RJ') {
        state_id = '19';
    } else if (conteudo.uf === 'RN') {
        state_id = '20';
    } else if (conteudo.uf === 'RS') {
        state_id = '21';
    } else if (conteudo.uf === 'RO') {
        state_id = '22';
    } else if (conteudo.uf === 'RR') {
        state_id = '23';
    } else if (conteudo.uf === 'SC') {
        state_id = '24';
    } else if (conteudo.uf === 'SP') {
        state_id = '25';
    } else if (conteudo.uf === 'SE') {
        state_id = '26';
    } else if (conteudo.uf === 'TO') {
        state_id = '27';
    }

    $('#state-id' + screenViacepRequired).val(state_id);
    $('#state-id' + screenViacepRequired).select2().val(state_id).valid();
}
