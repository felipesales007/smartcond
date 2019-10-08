<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Controlador de login
    |--------------------------------------------------------------------------
    |
    | Este controlador lida com a autenticação de usuários para o aplicativo e
    | redirecionando-os para sua tela inicial. O controlador usa uma característica
    | para fornecer convenientemente sua funcionalidade para seus aplicativos.
    |
    */

    use AuthenticatesUsers;

    /**
     * Para onde redirecionar os usuários após o login.
     *
     * @var string
     */
    protected $redirectTo = '/home/index';

    /**
     * Construtor LoginController.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * @param Request $request
     * @param $user
     */
    protected function authenticated(Request $request, $user)
    {
        /**
         * Se o usuário estiver com o e-mail verificado e
         * não estiver bloqueado, atualiza o ip e o tempo de último acesso no banco.
         */
        if (auth()->user()['email_verified_at'] && !auth()->user()['blocked'] && auth()->user()['blocked_at'] < date('Y-m-d')) {
            $user->update([
                'last_login_at' => now()->toDateTimeString(),
                'last_login_ip' => request()->ip()
            ]);
        }
    }
}
