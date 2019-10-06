<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Emissora Padrão
    |--------------------------------------------------------------------------
    |
    | Esta opção controla o radiodifusor padrão que será usado pelo
    | framework quando um evento precisa ser transmitido. Você pode definir isso para
    | qualquer uma das conexões definidas no array "connections" abaixo.
    |
    | Suportado: "pusher", "redis", "log", "null"
    |
    */

    'default' => env('BROADCAST_DRIVER', 'null'),

    /*
    |--------------------------------------------------------------------------
    | Conexões de Broadcast
    |--------------------------------------------------------------------------
    |
    | Aqui você pode definir todas as conexões de broadcast que serão usadas
    | para transmitir eventos para outros sistemas ou através de websockets. Amostras de
    | Cada tipo de conexão disponível é fornecida dentro dessa matriz.
    |
    */

    'connections' => [

        'pusher' => [
            'driver' => 'pusher',
            'key' => env('PUSHER_APP_KEY'),
            'secret' => env('PUSHER_APP_SECRET'),
            'app_id' => env('PUSHER_APP_ID'),
            'options' => [
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'encrypted' => true,
            ],
        ],

        'redis' => [
            'driver' => 'redis',
            'connection' => 'default',
        ],

        'log' => [
            'driver' => 'log',
        ],

        'null' => [
            'driver' => 'null',
        ],

    ],

];
