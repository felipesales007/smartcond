<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Este namespace é aplicado às rotas do controlador.
     *
     * Além disso, ele é definido como o namespace raiz do gerador de URL.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Defina suas ligações de modelo de rota, filtros de padrão, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Defina as rotas para o aplicativo.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Defina as rotas "web" para o aplicativo.
     * Todas estas rotas recebem estado de sessão, proteção CSRF, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Defina as rotas "api" para o aplicativo.
     * Estas rotas são tipicamente sem estado.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
