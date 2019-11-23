<?php

namespace App\Http\Controllers\Layout\Route;

use App\Models\Route\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CheckController extends Controller
{
    /**
     * Verificar se o nome da rota já existe no banco de dados.
     *
     * @param Request $request
     * @return false|string
     */
    public function checkRouteRoute(Request $request)
    {
        $collection = Route::withTrashed()->where('route', '=', $request->route)->value('route');

        if (!$collection) {
            return json_encode(true);
        } else {
            return json_encode(false);
        }
    }

    /**
     * Verificar se o nome da rota diferente do meu já existe no banco de dados.
     *
     * @param Request $request
     * @return false|string
     */
    public function checkRouteRouteDifferent(Request $request)
    {
        $myCollection     = Route::withTrashed()->where('id', '=', $request->id)->value('route');
        $verifyCollection = Route::withTrashed()->where('route', '=', $request->route)->value('route');

        if (!$verifyCollection || $verifyCollection == $myCollection) {
            return json_encode(true);
        } else {
            return json_encode(false);
        }
    }
}
