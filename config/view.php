<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Visualizar caminhos de armazenamento
    |--------------------------------------------------------------------------
    |
    | A maioria dos sistemas de templates carrega modelos do disco. Aqui você pode especificar
    | uma matriz de caminhos que devem ser verificados para suas visualizações. Claro
    | o caminho usual do Laravel já foi registrado para você.
    |
    */

    'paths' => [
        resource_path('views'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Caminho de Visualização Compilado
    |--------------------------------------------------------------------------
    |
    | Esta opção determina onde todos os modelos do Blade compilados serão
    | armazenado para sua aplicação. Normalmente, isso está dentro do armazenamento
    | diretório. No entanto, como de costume, você está livre para alterar esse valor.
    |
    */

    'compiled' => env(
        'VIEW_COMPILED_PATH',
        realpath(storage_path('framework/views'))
    ),

];
