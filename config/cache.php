<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Armazenamento de Cache Padrão
    |--------------------------------------------------------------------------
    |
    | Esta opção controla a conexão de cache padrão que é usada enquanto
    | usando esta biblioteca de cache. Esta conexão é usada quando outra é
    | não explicitamente especificado ao executar uma determinada função de armazenamento em cache.
    |
    | Suportado: "apc", "array", "database", "file",
    | "memcached", "redis", "dynamodb"
    |
    */

    'default' => env('CACHE_DRIVER', 'file'),

    /*
    |--------------------------------------------------------------------------
    | Lojas de Cache
    |--------------------------------------------------------------------------
    |
    | Aqui você pode definir todas as "lojas" de cache para seu aplicativo como
    | bem como seus drivers. Você pode até definir várias lojas para o
    | mesmo driver de cache para agrupar os tipos de itens armazenados em seus caches.
    |
    */

    'stores' => [

        'apc' => [
            'driver' => 'apc',
        ],

        'array' => [
            'driver' => 'array',
        ],

        'database' => [
            'driver' => 'database',
            'table' => 'cache',
            'connection' => null,
        ],

        'file' => [
            'driver' => 'file',
            'path' => storage_path('framework/cache/data'),
        ],

        'memcached' => [
            'driver' => 'memcached',
            'persistent_id' => env('MEMCACHED_PERSISTENT_ID'),
            'sasl' => [
                env('MEMCACHED_USERNAME'),
                env('MEMCACHED_PASSWORD'),
            ],
            'options' => [
                // Memcached::OPT_CONNECT_TIMEOUT => 2000,
            ],
            'servers' => [
                [
                    'host' => env('MEMCACHED_HOST', '127.0.0.1'),
                    'port' => env('MEMCACHED_PORT', 11211),
                    'weight' => 100,
                ],
            ],
        ],

        'redis' => [
            'driver' => 'redis',
            'connection' => 'cache',
        ],

        'dynamodb' => [
            'driver' => 'dynamodb',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
            'table' => env('DYNAMODB_CACHE_TABLE', 'cache'),
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Prefixo da chave de cache
    |--------------------------------------------------------------------------
    |
    | Ao utilizar um armazenamento baseado em RAM, como APC ou Memcached, pode
    | ser outras aplicações utilizando o mesmo cache. Então, vamos especificar um
    | valor para ser prefixado em todas as nossas chaves para que possamos evitar colisões.
    |
    */

    'prefix' => env('CACHE_PREFIX', Str::slug(env('APP_NAME', 'laravel'), '_') . '_cache'),

];
