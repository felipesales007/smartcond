<?php

namespace App\Http\Controllers\Management\Company;

use App\Helpers\PageHelpers;
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
        $page = PageHelpers::page('28');
        $list = PageHelpers::page('29');

        return view('management.companies.dashboard.page', compact('page', 'list'));
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
        return [
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
    }
}
