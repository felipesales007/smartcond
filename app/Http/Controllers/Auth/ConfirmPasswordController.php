<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ConfirmsPasswords;

class ConfirmPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Confirmar controlador de senha
    |--------------------------------------------------------------------------
    |
    | Este controlador é responsável por manipular confirmações de senha e
    | usa uma característica simples para incluir o comportamento. Você é livre para explorar
    | essa característica e substitui quaisquer funções que exijam personalização.
    |
    */

    use ConfirmsPasswords;

    /**
     * Para onde redirecionar os usuários quando o URL pretendido falha.
     *
     * @var string
     */
    protected $redirectTo = '/home/index';

    /**
     * Crie uma nova instância do controlador.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
}
