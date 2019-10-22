window._ = require('lodash');

/**
 * Vamos carregar o jQuery e o plugin jQuery do Bootstrap que fornece suporte
 * para recursos do Bootstrap baseados em JavaScript, como modais e guias. Isso
 * O código pode ser modificado para atender às necessidades específicas do seu aplicativo.
 */

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

/**
 * Vamos carregar a biblioteca HTTP axios que nos permite emitir facilmente pedidos
 * para o nosso backend do Laravel. Esta biblioteca lida automaticamente com o envio
 * Token CSRF como um cabeçalho baseado no valor do token "XSRF"e.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * O eco expõe uma API expressiva para se inscrever em canais e ouvir
 * para eventos que são transmitidos pelo Laravel. Transmissão de eco e evento
 * permite que sua equipe crie facilmente aplicativos da Web em tempo real robustos.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true
// });
