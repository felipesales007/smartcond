<?php

namespace App\Http\Controllers\Layout\Route;

use App\Helpers\PageHelpers;
use App\Http\Controllers\Controller;
use App\Models\Company\Company;
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
        $page = PageHelpers::page('65');
        $list = PageHelpers::page('66');

        return view('layout.routes.dashboard.page', compact('page', 'list'));
    }

    /**
     * @return array
     */
    public function data()
    {
        return [
            'counts' => $this->getCounts()
        ];
    }

    /**
     * @return array
     */
    public function getCounts()
    {
        if (Company::id() == 1) {
            $cards = [
                'getCount'        => Route::count(),
                'getCountGet'     => Route::where('route_option_id', '=', '1')->count(),
                'getCountPost'    => Route::where('route_option_id', '=', '2')->count(),
                'getCountBlocked' => Route::where('blocked', '!=', null)->count()
            ];
        } else {
            $cards = [
                'getCount'        => 0,
                'getCountGet'     => 0,
                'getCountPost'    => 0,
                'getCountBlocked' => 0
            ];
        }

        return $cards;
    }
}
