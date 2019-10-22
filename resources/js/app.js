/**
 * * Primeiro vamos carregar todas as dependências JavaScript deste projeto que
 * inclui o Vue e outras bibliotecas. É um ótimo ponto de partida quando
 * construção de aplicações web robustas e poderosas usando o Vue e o Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * O seguinte bloco de código pode ser usado para registrar automaticamente
 * Componentes Vue. Ele examinará recursivamente este diretório para o Vue
 * componentes e registrá-los automaticamente com seu "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Em seguida, vamos criar uma nova instância do aplicativo Vue e anexá-la a
 * a página. Então, você pode começar a adicionar componentes a este aplicativo
 * ou personalize o andaime JavaScript para atender às suas necessidades exclusivas.
 */

const app = new Vue({
    el: '#app',
});
