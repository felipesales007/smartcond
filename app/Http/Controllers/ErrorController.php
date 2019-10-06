<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

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
}
