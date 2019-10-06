<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Controlador de verificação de e-mail
    |--------------------------------------------------------------------------
    |
    | Este controlador é responsável por lidar com a verificação de e-mail para qualquer
    | usuário que se registrou recentemente no aplicativo. E-mails também podem
    | ser reenviado se o usuário não receber a mensagem de e-mail original.
    |
    */

    use VerifiesEmails;

    /**
     * Para onde redirecionar os usuários após a verificação.
     *
     * @var string
     */
    protected $redirectTo = '/home/index';

    /**
     * Construtor VerificationController.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
}
