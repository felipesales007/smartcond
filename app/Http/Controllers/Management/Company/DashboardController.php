<?php

namespace App\Http\Controllers\Management\Company;

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
        return view('management.companies.dashboard.page');
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
            'getCount' => Company::when(Company::id() != '1', function ($query) {
                    $query->where('companies.id', '=', Company::id());
                })
                ->count(),

            'getCountEmail' => Company::when(Company::id() != '1', function ($query) {
                    $query->where('companies.id', '=', Company::id());
                })
                ->where('email', '!=', null)
                ->count(),

            'getCountContact' => Company::when(Company::id() != '1', function ($query) {
                    $query->where('companies.id', '=', Company::id());
                })
                ->where('contact', '!=', null)
                ->count(),

            'getCountBlocked' => Company::when(Company::id() != '1', function ($query) {
                    $query->where('companies.id', '=', Company::id());
                })
                ->where('blocked', '!=', null)
                ->orWhere('blocked_at', '>=', date('Y-m-d'))
                ->count()
        ];

        return $cards;
    }
}
