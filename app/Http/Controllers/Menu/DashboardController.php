<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Models\Menu\Menu;
use App\Models\Menu\MenuItem;
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
        return view('menu.dashboard');
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
            'getCountMenu'             => Menu::count(),
            'getCountMenuItems'        => MenuItem::count(),
            'getCountCollapses'        => Menu::where('menu_option_id', '=', '1')->count(),
            'getCountDropdowns'        => Menu::where('menu_option_id', '=', '2')->count(),
            'getCountLinks'            => Menu::where('menu_option_id', '=', '3')->count(),
            'getCountBlockedMenu'      => Menu::where('blocked', '!=', null)->count(),
            'getCountBlockedMenuItems' => MenuItem::where('blocked', '!=', null)->count()
        ];

        return $cards;
    }
}
