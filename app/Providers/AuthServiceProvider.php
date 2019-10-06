<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Os mapeamentos de política para o aplicativo.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Registre qualquer serviço de autenticação / autorização.
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
