<?php

/*
|--------------------------------------------------------------------------
| Crie o aplicativo
|--------------------------------------------------------------------------
|
| A primeira coisa que faremos é criar uma nova instância do aplicativo Laravel
| que serve como a "cola" para todos os componentes do Laravel, e é
| o contêiner IoC para o sistema que liga todas as várias partes.
|
*/

$app = new Illuminate\Foundation\Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

/*
|--------------------------------------------------------------------------
| Vincular Interfaces Importantes
|--------------------------------------------------------------------------
|
| Em seguida, precisamos vincular algumas interfaces importantes ao contêiner
| seremos capazes de resolvê-los quando necessário. Os grãos servem ao
| solicitações de entrada para este aplicativo da Web e do CLI.
|
*/

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

/*
|--------------------------------------------------------------------------
| Devolva o aplicativo
|--------------------------------------------------------------------------
|
| Este script retorna a instância do aplicativo. A instância é dada a
| o script de chamada para que possamos separar a construção das instâncias
| a partir da execução real do aplicativo e envio de respostas.
|
*/

return $app;
