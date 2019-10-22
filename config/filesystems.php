<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Disco Padrão do Sistema de Arquivos
    |--------------------------------------------------------------------------
    |
    | Aqui você pode especificar o disco padrão do sistema de arquivos que deve ser usado
    | pelo quadro. O disco "local", bem como uma variedade de nuvem
    | discos baseados estão disponíveis para o seu aplicativo. Apenas guarde!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'public'),

    /*
    |--------------------------------------------------------------------------
    | Disco padrão do sistema de arquivos em nuvem
    |--------------------------------------------------------------------------
    |
    | Muitos aplicativos armazenam arquivos tanto localmente quanto na nuvem. Para isso
    | Por isso, você pode especificar um driver "nuvem" padrão aqui. Este driver
    | será ligado como a implementação do disco do Cloud no contêiner.
    |
    */

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    /*
    |--------------------------------------------------------------------------
    | Discos do sistema de arquivos
    |--------------------------------------------------------------------------
    |
    | Aqui você pode configurar quantos "discos" de sistema de arquivos desejar e
    | pode até configurar vários discos do mesmo driver. Padrões têm
    | foi configurado para cada driver como um exemplo das opções necessárias.
    |
    | Drivers Suportados: "local", "ftp", "sftp", "s3", "rackspace"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL') . '/public/storage',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
        ],

    ],

];
