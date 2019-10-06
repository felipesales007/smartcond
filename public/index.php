<?php

/**
 * Laravel - Um framework PHP para artesãos da Web
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 */

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Registre o Auto Loader
|--------------------------------------------------------------------------
|
| O Composer fornece um carregador de classes conveniente e gerado automaticamente
| nossa aplicação. Nós só precisamos usá-lo! Nós vamos simplesmente exigir
| no roteiro aqui para que não tenhamos que nos preocupar com manual
| carregando qualquer uma das nossas aulas mais tarde. É ótimo relaxar.
|
*/

require __DIR__ . '/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Ligue as luzes
|--------------------------------------------------------------------------
|
| Precisamos iluminar o desenvolvimento do PHP, então vamos acender as luzes.
| Isso inicializa o framework e o deixa pronto para uso, então ele
| irá carregar este aplicativo para que possamos executá-lo e enviá-lo
| as respostas de volta ao navegador e encantar nossos usuários.
|
*/

$app = require_once __DIR__ . '/../bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| Executar o aplicativo
|--------------------------------------------------------------------------
|
| Assim que tivermos o aplicativo, podemos lidar com o pedido recebido
| através do kernel, e enviar a resposta associada de volta para
| o navegador do cliente, permitindo-lhes desfrutar do criativo
| e maravilhosa aplicação que preparamos para eles.
|
*/

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
