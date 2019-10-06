<?php

namespace App\Http\Controllers\Company;

use App\Models\Company\Company;
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
        $collection = Company::withTrashed()->where('email', '=', $request->email)->value('email');

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
        $myCollection     = Company::withTrashed()->where('id', '=', $request->id)->value('email');
        $verifyCollection = Company::withTrashed()->where('email', '=', $request->email)->value('email');

        if (!$verifyCollection || $verifyCollection == $myCollection) {
            return json_encode(true);
        } else {
            return json_encode(false);
        }
    }

    /**
     * Verificar se o cnpj já existe no banco de dados.
     *
     * @param Request $request
     * @return false|string
     */
    public function checkCnpj(Request $request)
    {
        $collection = Company::withTrashed()->where('cnpj', '=', $request->cnpj)->value('cnpj');

        if (!$collection) {
            return json_encode(true);
        } else {
            return json_encode(false);
        }
    }

    /**
     * Verificar se o cnpj diferente do meu já existe no banco de dados.
     *
     * @param Request $request
     * @return false|string
     */
    public function checkCnpjDifferent(Request $request)
    {
        $myCollection     = Company::withTrashed()->where('id', '=', $request->id)->value('cnpj');
        $verifyCollection = Company::withTrashed()->where('cnpj', '=', $request->cnpj)->value('cnpj');

        if (!$verifyCollection || $verifyCollection == $myCollection) {
            return json_encode(true);
        } else {
            return json_encode(false);
        }
    }
}
