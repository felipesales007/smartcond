<?php

namespace App\Http\Controllers\Route;

use App\Http\Controllers\Controller;
use App\Models\Route\Group;
use App\Models\Route\Route;
use Illuminate\View\Factory;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Mostrar a página solicitada.
     *
     * @return Factory|View
     */
    public function dashboard()
    {
        return view('routes.dashboard');
    }

    /**
     * @return array
     */
    public function data()
    {
        $data = [
            'counts' => $this->getCounts()
        ];

        return $data;
    }

    /**
     * @return array
     */
    public function getCounts()
    {
        $cards = [
            'getCountRoutes'        => Route::count(),
            'getCountGroups'        => Group::count(),
            'getCountGetRoutes'     => Route::where('route_option_id', '=', '1')->count(),
            'getCountPostRoutes'    => Route::where('route_option_id', '=', '2')->count(),
            'getCountBlockedRoutes' => Route::where('blocked', '!=', null)->count(),
            'getCountBlockedGroups' => Group::where('blocked', '!=', null)->count()
        ];

        return $cards;
    }
}
