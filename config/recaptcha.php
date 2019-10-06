<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Chaves de API
    |--------------------------------------------------------------------------
    |
    | Defina as chaves de API públicas e privadas, conforme fornecidas pelo reCAPTCHA.
    |
    | Na versão 2 do reCAPTCHA, public_key é a chave do site,
    | e private_key é a chave secreta.
    |
    */
    'public_key' => env('RECAPTCHA_PUBLIC_KEY', '6LdEopsUAAAAAB-DSVR1aebUpCklraghMkkXij0c'),
    'private_key' => env('RECAPTCHA_PRIVATE_KEY', '6LdEopsUAAAAAG7e7hKm7vlUgUd87xfV0SIWUMu7'),

    /*
    |--------------------------------------------------------------------------
    | Template
    |--------------------------------------------------------------------------
    |
    | Defina um modelo para usar se você não quiser usar o modelo padrão.
    |
    */
    'template' => '',

    /*
    |--------------------------------------------------------------------------
    | Driver
    |--------------------------------------------------------------------------
    |
    | Determine como chamar para obter resposta; os valores são 'curl' ou 'native'.
    | Aplica-se apenas a v2.
    |
    */
    'driver' => 'curl',

    /*
    |--------------------------------------------------------------------------
    | Opções
    |--------------------------------------------------------------------------
    |
    | Várias opções para o motorista
    |
    */
    'options' => [

        'curl_timeout' => 10,
        'curl_verify' => true,
        'lang' => 'pt-BR',

    ],

    /*
    |--------------------------------------------------------------------------
    | Versão
    |--------------------------------------------------------------------------
    |
    | Defina qual versão do ReCaptcha usar.
    |
    */

    'version' => 2,

];
