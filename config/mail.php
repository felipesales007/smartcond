<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Mail Driver
    |--------------------------------------------------------------------------
    |
    | O Laravel suporta a função "mail" do SMTP e do PHP como drivers para o
    | envio de e-mail. Você pode especificar qual você está usando em toda
    | sua aplicação aqui. Por padrão, o Laravel é configurado para o correio SMTP.
    |
    | Suportado: "smtp", "sendmail", "mailgun", "mandril", "ses",
    | "sparkpost", "carimbo", "log", "array"
    |
    */

    'driver' => env('MAIL_DRIVER', 'smtp'),

    /*
    |--------------------------------------------------------------------------
    | Endereço do host SMTP
    |--------------------------------------------------------------------------
    |
    | Aqui você pode fornecer o endereço do host do servidor SMTP usado pelo seu
    | aplicações. Uma opção padrão é fornecida e é compatível com
    | o serviço de correio Mailgun, que fornecerá entregas confiáveis.
    |
    */

    'host' => env('MAIL_HOST', 'smtp.mailgun.org'),

    /*
    |--------------------------------------------------------------------------
    | Porta do host SMTP
    |--------------------------------------------------------------------------
    |
    | Esta é a porta SMTP usada pelo seu aplicativo para entregar e-mails para
    | usuários do aplicativo. Como o host, definimos esse valor para
    | permaneça compatível com o aplicativo de email Mailgun por padrão.
    |
    */

    'port' => env('MAIL_PORT', 587),

    /*
    |--------------------------------------------------------------------------
    | Endereço global "De"
    |--------------------------------------------------------------------------
    |
    | Você pode desejar que todos os e-mails enviados pelo seu aplicativo sejam enviados de
    | o mesmo endereço. Aqui, você pode especificar um nome e endereço que seja
    | usado globalmente para todos os e-mails que são enviados pelo seu aplicativo.
    |
    */

    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'hello@example.com'),
        'name' => env('MAIL_FROM_NAME', 'Example'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Protocolo de Criptografia de E-mail
    |--------------------------------------------------------------------------
    |
    | Aqui você pode especificar o protocolo de criptografia que deve ser usado quando
    | o aplicativo envia mensagens de email. Um padrão sensível usando o
    | O protocolo de segurança da camada de transporte deve fornecer grande segurança.
    |
    */

    'encryption' => env('MAIL_ENCRYPTION', 'tls'),

    /*
    |--------------------------------------------------------------------------
    | Nome de Usuário do Servidor SMTP
    |--------------------------------------------------------------------------
    |
    | Se o seu servidor SMTP exigir um nome de usuário para autenticação, você deve
    | coloque aqui. Isso será usado para autenticar com seu servidor
    | conexão Você também pode definir o valor de "senha" abaixo deste.
    |
    */

    'username' => env('MAIL_USERNAME'),

    'password' => env('MAIL_PASSWORD'),

    /*
    |--------------------------------------------------------------------------
    | Caminho do Sistema Sendmail
    |--------------------------------------------------------------------------
    |
    | Ao usar o driver "sendmail" para enviar e-mails, precisaremos saber
    | o caminho para onde o Sendmail mora neste servidor. Um caminho padrão
    | foi fornecido aqui, que funcionará bem na maioria dos seus sistemas.
    |
    */

    'sendmail' => '/usr/sbin/sendmail -bs',

    /*
    |--------------------------------------------------------------------------
    | Configurações de email do Markdown
    |--------------------------------------------------------------------------
    |
    | Se você estiver usando a renderização de e-mail baseada em Markdown, poderá configurar
    | caminhos de temas e componentes aqui, permitindo que você personalize o design
    | dos e-mails. Ou você pode simplesmente ficar com os padrões do Laravel!
    |
    */

    'markdown' => [
        'theme' => 'default',

        'paths' => [
            resource_path('views/vendor/mail'),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Canal de registro
    |--------------------------------------------------------------------------
    |
    | Se você estiver usando o driver "log", você pode especificar o canal de registro
    | se você preferir manter mensagens de email separadas de outras entradas de log
    | para uma leitura mais simples. Caso contrário, o canal padrão será usado.
    |
    */

    'log_channel' => env('MAIL_LOG_CHANNEL'),

];
