let screenViacep = '';

// limpa valores do formulário de cep
function limpaFormCep() {
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

// validação nos campos ao sair do campo cep
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

// atualiza os campos com os valores
let cep;
cep = conteudo => {
    if (!('erro' in conteudo)) {
        $('#postal-code' + screenViacep).valid();
        $('#address' + screenViacep).val(conteudo.logradouro).valid();
        $('#house-number' + screenViacep).val('').valid();
        $('#complement' + screenViacep).val(conteudo.complemento).valid();
        $('#neighborhood' + screenViacep).val(conteudo.bairro).valid();
        $('#city' + screenViacep).val(conteudo.localidade).valid();
        returnStateId(conteudo);
        $('#country' + screenViacep).val('Brasil').valid();

        if (conteudo.logradouro) {
            $('.fe-star-address' + screenViacep).removeClass('fe-hidden');
        } else {
            $('.fe-star-address' + screenViacep).addClass('fe-hidden');
        }

        if (conteudo.complemento) {
            $('.fe-star-complement' + screenViacep).removeClass('fe-hidden');
        } else {
            $('.fe-star-complement' + screenViacep).addClass('fe-hidden');
        }

        if (conteudo.bairro) {
            $('.fe-star-neighborhood' + screenViacep).removeClass('fe-hidden');
        } else {
            $('.fe-star-neighborhood' + screenViacep).addClass('fe-hidden');
        }

        if (conteudo.localidade) {
            $('.fe-star-city' + screenViacep).removeClass('fe-hidden');
        } else {
            $('.fe-star-city' + screenViacep).addClass('fe-hidden');
        }

        if (conteudo.uf) {
            $('.fe-star-state-id' + screenViacep).removeClass('fe-hidden');
        } else {
            $('.fe-star-state-id' + screenViacep).addClass('fe-hidden');
        }

        $('.fe-star-country' + screenViacep).removeClass('fe-hidden');
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

        $('#postal-code' + screenViacep).val('');
        limpaFormCep();
    }
};

// pesquisa o cep inserido
function viacep(valor, screen) {
    screenViacep = screen;

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
            script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=cep';

            // insere script no documento e carrega o conteúdo
            document.body.appendChild(script);
        } else {
            // cep é inválido
            limpaFormCep();
        }
    } else {
        // cep sem valor, limpa formulário
        limpaFormCep();
    }
}

// retorna o id do estado
function returnStateId(conteudo) {
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

    $('#state-id' + screenViacep).val(state_id);
    $('#state-id' + screenViacep).select2().val(state_id).valid();
}
