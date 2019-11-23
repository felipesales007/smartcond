<?php

namespace App\Http\Controllers\Layout\Group;

use App\Http\Controllers\Controller;
use App\Models\Company\Company;
use App\Models\Route\Group;
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
        return view('layout.groups.dashboard.page');
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
                'getCount'        => Group::count(),
                'getCountBlocked' => Group::where('blocked', '!=', null)->count()
            ];
        } else {
            $cards = [
                'getCount'        => 0,
                'getCountBlocked' => 0
            ];
        }

        return $cards;
    }
}
