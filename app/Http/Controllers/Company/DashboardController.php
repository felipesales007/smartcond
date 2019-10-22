<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company\Company;
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
        return view('companies.dashboard');
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
            'getCount'        => Company::count(),
            'getCountEmail'   => Company::where('email', '!=', null)->count(),
            'getCountContact' => Company::where('contact', '!=', null)->count(),
            'getCountBlocked' => Company::where('blocked', '!=', null)->orWhere('blocked_at', '>=', date('Y-m-d'))->count()
        ];

        return $cards;
    }
}
