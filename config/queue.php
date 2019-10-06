<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Nome da conexão de fila padrão
    |--------------------------------------------------------------------------
    |
    | A API de filas do Laravel suporta uma variedade de back-end através de um único
    | API, dando-lhe acesso conveniente a cada back-end usando o mesmo
    | sintaxe para cada um. Aqui você pode definir uma conexão padrão.
    |
    */

    'default' => env('QUEUE_CONNECTION', 'sync'),

    /*
    |--------------------------------------------------------------------------
    | Conexões de fila
    |--------------------------------------------------------------------------
    |
    | Aqui você pode configurar as informações de conexão para cada servidor que
    | é usado pelo seu aplicativo. Uma configuração padrão foi adicionada
    | para cada back-end enviado com o Laravel. Você é livre para adicionar mais.
    |
    | Drivers: "sync", "database", "beanstalkd", "sqs", "redis", "null"
    |
    */

    'connections' => [

        'sync' => [
            'driver' => 'sync',
        ],

        'database' => [
            'driver' => 'database',
            'table' => 'jobs',
            'queue' => 'default',
            'retry_after' => 90,
        ],

        'beanstalkd' => [
            'driver' => 'beanstalkd',
            'host' => 'localhost',
            'queue' => 'default',
            'retry_after' => 90,
            'block_for' => 0,
        ],

        'sqs' => [
            'driver' => 'sqs',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'prefix' => env('SQS_PREFIX', 'https://sqs.us-east-1.amazonaws.com/your-account-id'),
            'queue' => env('SQS_QUEUE', 'your-queue-name'),
            'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
        ],

        'redis' => [
            'driver' => 'redis',
            'connection' => 'default',
            'queue' => env('REDIS_QUEUE', 'default'),
            'retry_after' => 90,
            'block_for' => null,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Tarefas de Filas com Falha
    |--------------------------------------------------------------------------
    |
    | Essas opções configuram o comportamento do registro de tarefas da fila com falha,
    | pode controlar qual banco de dados e tabela são usados para armazenar os trabalhos que
    | falharam. Você pode alterá-los para qualquer banco de dados / tabela que desejar.
    |
    */

    'failed' => [
        'database' => env('DB_CONNECTION', 'mysql'),
        'table' => 'failed_jobs',
    ],

];
