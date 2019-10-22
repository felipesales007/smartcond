<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Obtenha o caminho para o qual o usuário deve ser redirecionado quando não estiver autenticado.
     *
     * @param Request $request
     * @return string
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('login');
        } else {
            return abort(404);
        }
    }
}
