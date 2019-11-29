<?php

namespace App\Http\Controllers\Layout\Menu;

use App\Helpers\PageHelpers;
use App\Http\Controllers\Controller;
use App\Models\Company\Company;
use App\Models\Menu\Menu;
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
        $page = PageHelpers::page('menu.dashboard');
        $list = PageHelpers::page('menu.list');

        return view('layout.menu.dashboard.page', compact('page', 'list'));
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
        if (Company::id() == 1) {
            $cards = [
                'getCount'          => Menu::count(),
                'getCountCollapses' => Menu::where('menu_option_id', '=', '1')->count(),
                'getCountDropdowns' => Menu::where('menu_option_id', '=', '2')->count(),
                'getCountLinks'     => Menu::where('menu_option_id', '=', '3')->count(),
                'getCountBlocked'   => Menu::where('blocked', '!=', null)->count()
            ];
        } else {
            $cards = [
                'getCount'          => 0,
                'getCountCollapses' => 0,
                'getCountDropdowns' => 0,
                'getCountLinks'     => 0,
                'getCountBlocked'   => 0
            ];
        }

        return $cards;
    }
}
