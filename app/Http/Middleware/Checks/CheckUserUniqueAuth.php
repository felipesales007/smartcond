<?php

namespace App\Http\Middleware\Checks;

use App\Helpers\NotifyHelpers;
use Closure;
use Illuminate\Http\RedirectResponse;

class CheckUserUniqueAuth
{
    /**
     * Lidar com uma solicitação recebida.
     *
     * @param $request
     * @param Closure $next
     * @return RedirectResponse|mixed
     */
    public function handle($request, Closure $next)
    {
        // verifica se o token da sessão é o mesmo da do armazenamento
        if (auth()->user()['access_token'] != session()->get('access_token')) {
            auth()->logout();

            // notificar
            $data = NotifyHelpers::info_top_center('fas fa-user-times', 'A sessão desse usuário está ativa em outro local.');

            return redirect()->route('login')->with('notify', json_encode($data));
        }

        return $next($request);
    }
}
