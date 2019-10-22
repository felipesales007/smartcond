<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Nome do aplicativo
    |--------------------------------------------------------------------------
    |
    | Esse valor é o nome do seu aplicativo. Este valor é usado quando o
    | framework precisa colocar o nome do aplicativo em uma notificação ou
    | qualquer outro local, conforme exigido pelo aplicativo ou por seus pacotes.
    |
    */

    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Ambiente de Aplicação
    |--------------------------------------------------------------------------
    |
    | Esse valor determina o "ambiente" que seu aplicativo está atualmente
    | correndo dentro Isso pode determinar como você prefere configurar vários
    | serviços que o aplicativo utiliza. Coloque isso no seu arquivo ".env".
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Modo de Depuração de Aplicativo
    |------------------------------------------------ -------------------------
    |
    | Quando seu aplicativo está no modo de depuração, mensagens de erro detalhadas com
    | rastreamentos de pilha serão mostrados em cada erro que ocorre dentro do seu
    | aplicação. Se desativado, uma página de erro genérica simples é mostrada.
    |
    */

    'debug' => env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | URL do aplicativo
    |--------------------------------------------------------------------------
    |
    | Esse URL é usado pelo console para gerar URLs corretamente ao usar
    | a ferramenta de linha de comando do Artisan. Você deve definir isso para a raiz de
    | seu aplicativo para que ele seja usado durante a execução de tarefas do Artisan.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    'asset_url' => env('ASSET_URL', null),

    /*
    |--------------------------------------------------------------------------
    | Fuso Horário de Aplicação
    |--------------------------------------------------------------------------
    |
    | Aqui você pode especificar o fuso horário padrão para seu aplicativo, que
    | será usado pelas funções de data e hora do PHP. Nós fomos
    | à frente e definir isso como um padrão sensato para você fora da caixa.
    |
    */

    'timezone' => 'America/Bahia',

    /*
    |--------------------------------------------------------------------------
    |Configuração do local de aplicação
    | --------------------------------------------------------------------------
    |
    | A localidade do aplicativo determina a localidade padrão que será usada
    | pelo fornecedor do serviço de tradução. Você é livre para definir este valor
    | a qualquer uma das instalações que serão apoiadas pela aplicação.
    |
    */

    'locale' => 'pt-BR',

    /*
    |--------------------------------------------------------------------------
    | Local de retorno de aplicativo
    |--------------------------------------------------------------------------
    |
    | A localidade de fallback determina a localidade a ser usada quando a atual
    | não está disponível. Você pode alterar o valor para corresponder a qualquer
    | as pastas de idioma que são fornecidas por meio do seu aplicativo.
    |
    */

    'fallback_locale' => 'pt-BR',

    /*
    |--------------------------------------------------------------------------
    | Faker Locale
    |--------------------------------------------------------------------------
    |
    | Esta localidade será usada pela biblioteca PHP do Faker ao gerar falsas
    | dados para as sementes do seu banco de dados. Por exemplo, isso será usado para obter
    | números de telefone localizados, informações de endereços e muito mais.
    |
    */

    'faker_locale' => 'en_US',

    /*
    |--------------------------------------------------------------------------
    | Chave de Criptografia
    |--------------------------------------------------------------------------
    |
    | Essa chave é usada pelo serviço Illuminate encrypter e deve ser definida
    | para uma seqüência aleatória de 32 caracteres, caso contrário, essas seqüências de caracteres criptografadas
    | não será seguro. Por favor, faça isso antes de implantar um aplicativo!
    |
    */

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Provedores de Serviços Autoloaded
    |--------------------------------------------------------------------------
    |
    | Os provedores de serviços listados aqui serão carregados automaticamente no
    | pedido ao seu aplicativo. Sinta-se à vontade para adicionar seus próprios serviços para
    | essa matriz para conceder funcionalidade expandida aos seus aplicativos.
    |
    */

    'providers' => [

        /*
         * Fornecedores do Laravel Framework Service ...
         */
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
        Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
        Illuminate\Cookie\CookieServiceProvider::class,
        Illuminate\Database\DatabaseServiceProvider::class,
        Illuminate\Encryption\EncryptionServiceProvider::class,
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        Illuminate\Foundation\Providers\FoundationServiceProvider::class,
        Illuminate\Hashing\HashServiceProvider::class,
        Illuminate\Mail\MailServiceProvider::class,
        Illuminate\Notifications\NotificationServiceProvider::class,
        Illuminate\Pagination\PaginationServiceProvider::class,
        Illuminate\Pipeline\PipelineServiceProvider::class,
        Illuminate\Queue\QueueServiceProvider::class,
        Illuminate\Redis\RedisServiceProvider::class,
        Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
        Illuminate\Session\SessionServiceProvider::class,
        Illuminate\Translation\TranslationServiceProvider::class,
        Illuminate\Validation\ValidationServiceProvider::class,
        Illuminate\View\ViewServiceProvider::class,

        /*
         * Provedores de serviços de pacote ...
         */
        Yajra\DataTables\DataTablesServiceProvider::class,
        Collective\Html\HtmlServiceProvider::class,

        /*
         * Fornecedores de serviços de aplicativos ...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,

    ],

    /*
    |--------------------------------------------------------------------------
    | Alias de Classe
    |--------------------------------------------------------------------------
    |
    | Essa matriz de aliases de classe será registrada quando este aplicativo
    | é iniciado No entanto, sinta-se à vontade para registrar quantos desejar
    | os aliases são "lazy" carregados para não atrapalhar o desempenho.
    |
    */

    'aliases' => [

        'App'          => Illuminate\Support\Facades\App::class,
        'Arr'          => Illuminate\Support\Arr::class,
        'Artisan'      => Illuminate\Support\Facades\Artisan::class,
        'Auth'         => Illuminate\Support\Facades\Auth::class,
        'Blade'        => Illuminate\Support\Facades\Blade::class,
        'Broadcast'    => Illuminate\Support\Facades\Broadcast::class,
        'Bus'          => Illuminate\Support\Facades\Bus::class,
        'Cache'        => Illuminate\Support\Facades\Cache::class,
        'Config'       => Illuminate\Support\Facades\Config::class,
        'Cookie'       => Illuminate\Support\Facades\Cookie::class,
        'Crypt'        => Illuminate\Support\Facades\Crypt::class,
        'DB'           => Illuminate\Support\Facades\DB::class,
        'Eloquent'     => Illuminate\Database\Eloquent\Model::class,
        'Event'        => Illuminate\Support\Facades\Event::class,
        'File'         => Illuminate\Support\Facades\File::class,
        'Gate'         => Illuminate\Support\Facades\Gate::class,
        'Hash'         => Illuminate\Support\Facades\Hash::class,
        'Lang'         => Illuminate\Support\Facades\Lang::class,
        'Log'          => Illuminate\Support\Facades\Log::class,
        'Mail'         => Illuminate\Support\Facades\Mail::class,
        'Notification' => Illuminate\Support\Facades\Notification::class,
        'Password'     => Illuminate\Support\Facades\Password::class,
        'Queue'        => Illuminate\Support\Facades\Queue::class,
        'Redirect'     => Illuminate\Support\Facades\Redirect::class,
        'Redis'        => Illuminate\Support\Facades\Redis::class,
        'Request'      => Illuminate\Support\Facades\Request::class,
        'Response'     => Illuminate\Support\Facades\Response::class,
        'Route'        => Illuminate\Support\Facades\Route::class,
        'Schema'       => Illuminate\Support\Facades\Schema::class,
        'Session'      => Illuminate\Support\Facades\Session::class,
        'Storage'      => Illuminate\Support\Facades\Storage::class,
        'Str'          => Illuminate\Support\Str::class,
        'URL'          => Illuminate\Support\Facades\URL::class,
        'Validator'    => Illuminate\Support\Facades\Validator::class,
        'View'         => Illuminate\Support\Facades\View::class,
        'DataTables'   => Yajra\DataTables\Facades\DataTables::class,
        'Form'         => Collective\Html\FormFacade::class,
        'Html'         => Collective\Html\HtmlFacade::class,

    ],

];
