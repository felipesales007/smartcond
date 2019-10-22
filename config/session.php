<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Driver de Sessão Padrão
    |--------------------------------------------------------------------------
    |
    | Esta opção controla a sessão padrão "driver" que será usada em
    | solicitações. Por padrão, usaremos o driver nativo leve, mas
    | Você pode especificar qualquer um dos outros drivers maravilhosos fornecidos aqui.
    |
    | Suportado: "arquivo", "cookie", "banco de dados", "apc", "memcached", "redis", "dynamodb", "array"
    |
    */

    'driver' => env('SESSION_DRIVER', 'file'),

    /*
    |--------------------------------------------------------------------------
    | Sessão Vitalícia
    |--------------------------------------------------------------------------
    |
    | Aqui você pode especificar o número de minutos que você deseja que a sessão
    | ser permitido permanecer ocioso antes de expirar. Se você quiser
    | para expirar imediatamente no fechamento do navegador, defina essa opção.
    |
    */

    'lifetime' => env('SESSION_LIFETIME', 120),

    'expire_on_close' => false,

    /*
    |--------------------------------------------------------------------------
    | Criptografia de Sessão
    |--------------------------------------------------------------------------
    |
    | Esta opção permite que você especifique facilmente que todos os dados da sua sessão
    | deve ser criptografado antes de ser armazenado. Toda a criptografia será executada
    | automaticamente pelo Laravel e você pode usar a sessão como normal.
    |
    */

    'encrypt' => false,

    /*
    |--------------------------------------------------------------------------
    | Localização do Arquivo de Sessão
    |--------------------------------------------------------------------------
    |
    | Ao usar o driver de sessão nativa, precisamos de um local onde a sessão
    | arquivos podem ser armazenados. Um padrão foi definido para você, mas um diferente
    | localização pode ser especificada. Isso é necessário apenas para sessões de arquivos.
    |
    */

    'files' => storage_path('framework/sessions'),

    /*
    |--------------------------------------------------------------------------
    | Conexão de banco de dados de sessão
    |--------------------------------------------------------------------------
    |
    | Ao usar os drivers de sessão "banco de dados" ou "redis", você pode especificar um
    | conexão que deve ser usada para gerenciar essas sessões. Isso deve
    | corresponde a uma conexão nas opções de configuração do seu banco de dados.
    |
    */

    'connection' => env('SESSION_CONNECTION', null),

    /*
    |--------------------------------------------------------------------------
    | Tabela de banco de dados de sessão
    |--------------------------------------------------------------------------
    |
    | Ao usar o driver de sessão "banco de dados", você pode especificar a tabela que
    | deve usar para gerenciar as sessões. Claro, um padrão sensato é
    | fornecido para você; no entanto, você está livre para alterar isso conforme necessário.
    |
    */

    'table' => 'sessions',

    /*
    |--------------------------------------------------------------------------
    | Armazenamento de cache de sessão
    |--------------------------------------------------------------------------
    |
    | Ao usar os drivers de sessão "apc", "memcached" ou "dynamodb", você pode
    | liste um armazenamento de cache que deve ser usado para essas sessões. Este valor
    | deve corresponder a um dos "armazenamentos" de cache configurados do aplicativo.
    |
    */

    'store' => env('SESSION_STORE', null),

    /*
    |--------------------------------------------------------------------------
    | Loteria arrebatadora de sessão
    |--------------------------------------------------------------------------
    |
    | Alguns drivers de sessão devem varrer manualmente seu local de armazenamento para obter
    | livrar de sessões antigas de armazenamento. Aqui estão as chances de que isso
    | acontecer em um determinado pedido. Por padrão, as chances são de 2 em 100.
    |
    */

    'lottery' => [2, 100],

    /*
    |--------------------------------------------------------------------------
    | Nome do Cookie da Sessão
    |--------------------------------------------------------------------------
    |
    | Aqui você pode alterar o nome do cookie usado para identificar uma sessão
    | instância por ID. O nome especificado aqui será usado toda vez que
    | Um novo cookie de sessão é criado pelo framework para cada driver.
    |
    */

    'cookie' => env(
        'SESSION_COOKIE',
        Str::slug(env('APP_NAME', 'laravel'), '_') . '_session'
    ),

    /*
    |--------------------------------------------------------------------------
    | Caminho do Cookie da Sessão
    |--------------------------------------------------------------------------
    |
    | O caminho do cookie da sessão determina o caminho para o qual o cookie
    | ser considerado como disponível. Normalmente, este será o caminho da raiz de
    | sua aplicação, mas você está livre para mudar isso quando necessário.
    |
    */

    'path' => '/',

    /*
    |--------------------------------------------------------------------------
    | Domínio do cookie de sessão
    |--------------------------------------------------------------------------
    |
    | Aqui você pode alterar o domínio do cookie usado para identificar uma sessão
    | na sua aplicação. Isso determinará quais domínios o cookie é
    | disponível em sua aplicação. Um padrão confidencial foi definido.
    |
    */

    'domain' => env('SESSION_DOMAIN', null),

    /*
    |--------------------------------------------------------------------------
    | Cookies somente HTTPS
    |--------------------------------------------------------------------------
    |
    | Ao definir esta opção como verdadeira, os cookies de sessão só serão enviados de volta
    | para o servidor se o navegador tiver uma conexão HTTPS. Isso vai manter
    | o cookie seja enviado para você se não puder ser feito com segurança.
    |
    */

    'secure' => env('SESSION_SECURE_COOKIE', false),

    /*
    |--------------------------------------------------------------------------
    | Apenas acesso HTTP
    |--------------------------------------------------------------------------
    |
    | Definir este valor como true impedirá que o JavaScript acesse o
    | O valor do cookie e do cookie só será acessível através de
    | o protocolo HTTP Você está livre para modificar esta opção, se necessário.
    |
    */

    'http_only' => true,

    /*
    |--------------------------------------------------------------------------
    | Cookies no Mesmo Site
    |--------------------------------------------------------------------------
    |
    | Esta opção determina como seus cookies se comportam quando solicitações entre sites
    | ocorrer e pode ser usado para mitigar ataques de CSRF. Por padrão, nós
    | não habilite isso, pois outros serviços de proteção contra CSRF estão em vigor.
    |
    | Suportado: "lax", "strict"
    |
    */

    'same_site' => null,

];
