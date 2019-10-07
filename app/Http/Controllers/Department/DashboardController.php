<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use App\Models\Company\Company;
use App\Models\Department;
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
        return view('departments.dashboard');
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
            'getCount'        => Department::where('company_id', '=', Company::id())->count(),
            'getCountBlocked' => Department::where('company_id', '=', Company::id())->where('blocked', '!=', null)->count()
        ];

        return $cards;
    }
}
