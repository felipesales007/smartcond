<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CheckController extends Controller
{
    /**
     * Verificar se o e-mail já existe no banco de dados.
     *
     * @param Request $request
     * @return false|string
     */
    public function checkEmail(Request $request)
    {
        $collection = User::withTrashed()->where('email', '=', $request->email)->value('email');

        if (!$collection) {
            return json_encode(true);
        } else {
            return json_encode(false);
        }
    }

    /**
     * Verificar se o e-mail diferente do meu já existe no banco de dados.
     *
     * @param Request $request
     * @return false|string
     */
    public function checkEmailDifferent(Request $request)
    {
        $myCollection     = User::withTrashed()->where('id', '=', $request->id)->value('email');
        $verifyCollection = User::withTrashed()->where('email', '=', $request->email)->value('email');

        if (!$verifyCollection || $verifyCollection == $myCollection) {
            return json_encode(true);
        } else {
            return json_encode(false);
        }
    }

    /**
     * Verificar se o cpf já existe no banco de dados.
     *
     * @param Request $request
     * @return false|string
     */
    public function checkCpf(Request $request)
    {
        $collection = User::withTrashed()->where('cpf', '=', $request->cpf)->value('cpf');

        if (!$collection) {
            return json_encode(true);
        } else {
            return json_encode(false);
        }
    }

    /**
     * Verificar se o cpf diferente do meu já existe no banco de dados.
     *
     * @param Request $request
     * @return false|string
     */
    public function checkCpfDifferent(Request $request)
    {
        $myCollection     = User::withTrashed()->where('id', '=', $request->id)->value('cpf');
        $verifyCollection = User::withTrashed()->where('cpf', '=', $request->cpf)->value('cpf');

        if (!$verifyCollection || $verifyCollection == $myCollection) {
            return json_encode(true);
        } else {
            return json_encode(false);
        }
    }

    /**
     * Verificar se o rg já existe no banco de dados.
     *
     * @param Request $request
     * @return false|string
     */
    public function checkRg(Request $request)
    {
        $collection = User::withTrashed()->where('rg', '=', $request->rg)->value('rg');

        if (!$collection) {
            return json_encode(true);
        } else {
            return json_encode(false);
        }
    }

    /**
     * Verificar se o rg diferente do meu já existe no banco de dados.
     *
     * @param Request $request
     * @return false|string
     */
    public function checkRgDifferent(Request $request)
    {
        $myCollection     = User::withTrashed()->where('id', '=', $request->id)->value('rg');
        $verifyCollection = User::withTrashed()->where('rg', '=', $request->rg)->value('rg');

        if (!$verifyCollection || $verifyCollection == $myCollection) {
            return json_encode(true);
        } else {
            return json_encode(false);
        }
    }
}
