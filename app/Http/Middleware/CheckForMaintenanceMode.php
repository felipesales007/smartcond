<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode as Middleware;

class CheckForMaintenanceMode extends Middleware
{
    /**
     * Os URIs que devem estar acessíveis enquanto o modo de manutenção estiver ativado.
     *
     * @var array
     */
    protected $except = [
        //
    ];
}
