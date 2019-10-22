<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Driver de hash padrão
    |--------------------------------------------------------------------------
    |
    | Esta opção controla o driver hash padrão que será usado para o hash
    | senhas para seu aplicativo. Por padrão, o algoritmo bcrypt é
    | usado; no entanto, você permanece livre para modificar essa opção, se desejar.
    |
    | Suportado: "bcrypt", "argon", "argon2id"
    |
    */

    'driver' => 'bcrypt',

    /*
    |--------------------------------------------------------------------------
    | Opções do Bcrypt
    |--------------------------------------------------------------------------
    |
    | Aqui você pode especificar as opções de configuração que devem ser usadas quando
    | as senhas são codificadas usando o algoritmo Bcrypt. Isso permitirá que você
    | para controlar a quantidade de tempo que leva para hash a senha dada.
    |
    */

    'bcrypt' => [
        'rounds' => env('BCRYPT_ROUNDS', 10),
    ],

    /*
    |--------------------------------------------------------------------------
    | Opções de argônio
    |--------------------------------------------------------------------------
    |
    | Aqui você pode especificar as opções de configuração que devem ser usadas quando
    | as senhas são divididas usando o algoritmo de argônio. Estes permitirão que você
    | para controlar a quantidade de tempo que leva para hash a senha dada.
    |
    */

    'argon' => [
        'memory' => 1024,
        'threads' => 2,
        'time' => 2,
    ],

];
