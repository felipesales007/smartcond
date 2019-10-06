// limpa valores do formulário de cep
function limpaFormCepProfileEdit() {
    let screen = '-edit-profile';

    $('.fe-star-address' + screen).addClass('fe-hidden');
    $('.fe-star-house-number' + screen).addClass('fe-hidden');
    $('.fe-star-complement' + screen).addClass('fe-hidden');
    $('.fe-star-neighborhood' + screen).addClass('fe-hidden');
    $('.fe-star-city' + screen).addClass('fe-hidden');
    $('.fe-star-state-id' + screen).addClass('fe-hidden');
    $('.fe-star-country' + screen).addClass('fe-hidden');

    $('#address' + screen).val('').removeClass('is-invalid').removeClass('is-valid');
    $('#house-number' + screen).val('').removeClass('is-invalid').removeClass('is-valid');
    $('#complement' + screen).val('').removeClass('is-invalid').removeClass('is-valid');
    $('#neighborhood' + screen).val('').removeClass('is-invalid').removeClass('is-valid');
    $('#city' + screen).val('').removeClass('is-invalid').removeClass('is-valid');
    $('#state-id' + screen).val('').removeClass('is-invalid').removeClass('is-valid');
    $('#state-id' + screen).select2({placeholder: 'Selecione'}).removeClass('is-invalid').removeClass('is-valid');
    $('#country' + screen).val('').removeClass('is-invalid').removeClass('is-valid');

    $('.input-group-text', '.validate-address' + screen).removeClass('is-invalid').removeClass('is-valid');
    $('.input-group-text', '.validate-house-number' + screen).removeClass('is-invalid').removeClass('is-valid');
    $('.input-group-text', '.validate-complement' + screen).removeClass('is-invalid').removeClass('is-valid');
    $('.input-group-text', '.validate-neighborhood' + screen).removeClass('is-invalid').removeClass('is-valid');
    $('.input-group-text', '.validate-city' + screen).removeClass('is-invalid').removeClass('is-valid');
    $('.input-group-text', '.validate-country' + screen).removeClass('is-invalid').removeClass('is-valid');

    if ($('#address' + screen).parent().next('div').find('div[role="alert"]').prevObject[0]) {
        $('#address' + screen).parent().next('div').find('div[role="alert"]').prevObject[0].innerHTML = '&ensp;';
    }

    if ($('#neighborhood' + screen).parent().next('div').find('div[role="alert"]').prevObject[0]) {
        $('#neighborhood' + screen).parent().next('div').find('div[role="alert"]').prevObject[0].innerHTML = '&ensp;';
    }

    if ($('#city' + screen).parent().next('div').find('div[role="alert"]').prevObject[0]) {
        $('#city' + screen).parent().next('div').find('div[role="alert"]').prevObject[0].innerHTML = '&ensp;';
    }

    if ($('#state-id' + screen).parent().next('div').find('div[role="alert"]').prevObject[0]) {
        $('#state-id' + screen).parent().next('div').find('div[role="alert"]').prevObject[0].innerHTML = '&ensp;';
    }

    if ($('#country' + screen).parent().next('div').find('div[role="alert"]').prevObject[0]) {
        $('#country' + screen).parent().next('div').find('div[role="alert"]').prevObject[0].innerHTML = '&ensp;';
    }
}

// validação nos campos ao sair do campo cep
$(document).on('focusout', '#postal-code-edit-profile', function () {
    let screen = '-edit-profile';

    $('#postal-code' + screen).valid();
    $('#address' + screen).valid();
    $('#house-number' + screen).valid();
    $('#complement' + screen).valid();
    $('#neighborhood' + screen).valid();
    $('#city' + screen).valid();
    $('#state-id' + screen).valid();
    $('#country' + screen).valid();
});

// atualiza os campos com os valores
let cepProfileEdit;
cepProfileEdit = conteudo => {
    let screen = '-edit-profile';

    if (!('erro' in conteudo)) {
        $('#postal-code' + screen).valid();
        $('#address' + screen).val(conteudo.logradouro).valid();
        $('#house-number' + screen).val('').valid();
        $('#complement' + screen).val(conteudo.complemento).valid();
        $('#neighborhood' + screen).val(conteudo.bairro).valid();
        $('#city' + screen).val(conteudo.localidade).valid();
        returnStateIdProfileEdit(conteudo);
        $('#country' + screen).val('Brasil').valid();

        if (conteudo.logradouro) {
            $('.fe-star-address' + screen).removeClass('fe-hidden');
        } else {
            $('.fe-star-address' + screen).addClass('fe-hidden');
        }

        if (conteudo.complemento) {
            $('.fe-star-complement' + screen).removeClass('fe-hidden');
        } else {
            $('.fe-star-complement' + screen).addClass('fe-hidden');
        }

        if (conteudo.bairro) {
            $('.fe-star-neighborhood' + screen).removeClass('fe-hidden');
        } else {
            $('.fe-star-neighborhood' + screen).addClass('fe-hidden');
        }

        if (conteudo.localidade) {
            $('.fe-star-city' + screen).removeClass('fe-hidden');
        } else {
            $('.fe-star-city' + screen).addClass('fe-hidden');
        }

        if (conteudo.uf) {
            $('.fe-star-state-id' + screen).removeClass('fe-hidden');
        } else {
            $('.fe-star-state-id' + screen).addClass('fe-hidden');
        }

        $('.fe-star-country' + screen).removeClass('fe-hidden');
    } else {
        // cep não encontrado
        swal({
            title: 'CEP não encontrado',
            text: 'Por favor, insira um CEP válido',
            imageUrl: url_public('img/default/postal-code-error.png'),
            buttonsStyling: !1,
            confirmButtonClass: 'btn btn-primary pr-5 pl-5',
            confirmButtonText: 'OK'
        });

        $('#postal-code' + screen).val('');
        limpaFormCepProfileEdit();
    }
};

// pesquisa o cep inserido
function viacepProfileEdit(valor) {
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
            script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=cepProfileEdit';

            // insere script no documento e carrega o conteúdo
            document.body.appendChild(script);
        } else {
            // cep é inválido
            limpaFormCepProfileEdit();
        }
    } else {
        // cep sem valor, limpa formulário
        limpaFormCepProfileEdit();
    }
}

// retorna o id do estado
function returnStateIdProfileEdit(conteudo) {
    let screen = '-edit-profile';
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

    $('#state-id' + screen).val(state_id);
    $('#state-id' + screen).select2().val(state_id).valid();
}
