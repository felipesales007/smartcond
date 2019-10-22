<?php

namespace App\Http\Middleware;

use App\Helpers\NotifyHelpers;
use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Session\TokenMismatchException;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indica se o cookie XSRF-TOKEN deve ser definido na resposta.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * Os URIs que devem ser excluídos da verificação do CSRF.
     *
     * @var array
     */
    protected $except = [
        //
    ];

    /**
     * @param Request $request
     * @param Closure $next
     * @return RedirectResponse|mixed
     */
    public function handle($request, Closure $next)
    {
        // se o tempo da sessão expirar por inatividade
        try {
            return parent::handle($request, $next);
        } catch (TokenMismatchException $exception) {
            // notificar
            $data = NotifyHelpers::info_top_center('fas fa-bell', 'Sessão expirada por inatividade.<br>Por favor, realize o login novamente.');

            return back()->with('notify', json_encode($data));
        }
    }
}
