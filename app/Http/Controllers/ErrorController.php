<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class ErrorController extends Controller
{
    /**
     * Retorna status 0 de rota excluída para a validação remota do Jquery Validate.
     *
     * @return JsonResponse
     */
    public function remoteValidateDestroy()
    {
        return response()->json(['status' => 0]);
    }

    /**
     * Retorna para página 404.
     *
     * @return Factory|View
     */
    public function error404()
    {
        return abort(404);
    }
}
