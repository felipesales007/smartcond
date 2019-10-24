<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Padrões de Autenticação
    |--------------------------------------------------------------------------
    |
    | Esta opção controla a autenticação padrão "guarda" e senha
    | redefinir opções para seu aplicativo. Você pode alterar esses padrões
    | conforme necessário, mas eles são um começo perfeito para a maioria dos aplicativos.
    |
    */

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Guardas de Autenticação
    |--------------------------------------------------------------------------
    |
    | Em seguida, você pode definir cada guarda de autenticação para seu aplicativo.
    | Claro, uma ótima configuração padrão foi definida para você
    | aqui que usa armazenamento de sessão e o provedor de usuários do Eloquent.
    |
    | Todos os drivers de autenticação possuem um provedor de usuário. Isso define como o
    | os usuários são realmente recuperados de seu banco de dados ou outro armazenamento
    | mecanismos utilizados por este aplicativo para manter os dados do usuário.
    |
    | Suportado: "session", "token"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'api' => [
            'driver' => 'token',
            'provider' => 'users',
            'hash' => false,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Provedores de Usuários
    |--------------------------------------------------------------------------
    |
    | Todos os drivers de autenticação possuem um provedor de usuário. Isso define como o
    | os usuários são realmente recuperados de seu banco de dados ou outro armazenamento
    | mecanismos utilizados por este aplicativo para manter os dados do usuário.
    |
    | Se você tiver várias tabelas de usuários ou modelos, poderá configurar vários
    | fontes que representam cada modelo / tabela. Estas fontes podem então
    | ser atribuído a quaisquer proteções de autenticação extras que você definiu.
    |
    | Suportado: "banco de dados", "eloquente"
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Redefinindo Senhas
    |--------------------------------------------------------------------------
    |
    | Você pode especificar várias configurações de redefinição de senha se tiver mais
    | de uma tabela de usuário ou modelo no aplicativo e você quer ter
    | configurações de redefinição de senha separadas com base nos tipos de usuários específicos.
    |
    | O tempo de expiração é o número de minutos que o token de redefinição deve ser
    | considerado válido. Esse recurso de segurança mantém os tokens de curta duração,
    | eles têm menos tempo para serem adivinhados. Você pode mudar isso conforme necessário.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60 * 48, // 2 dias
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Tempo limite de confirmação de senha
    |--------------------------------------------------------------------------
    |
    | Aqui você pode definir a quantidade de segundos antes da confirmação da senha
    | expira e o usuário é solicitado a redigitar sua senha via
    | tela de confirmação. Por padrão, o tempo limite dura três horas.
    |
    */

    'password_timeout' => 10800,

];
