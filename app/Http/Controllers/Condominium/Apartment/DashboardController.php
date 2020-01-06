<?php

namespace App\Http\Controllers\Condominium\Apartment;

use App\Helpers\PageHelpers;
use App\Http\Controllers\Controller;
use App\Models\Condominium\CondominiumApartment;
use App\Models\Entity\Entity;
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
        $page = PageHelpers::page('134');
        $list = PageHelpers::page('135');

        return view('condominium.apartments.dashboard.page', compact('page', 'list'));
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
            'getCount'        => CondominiumApartment::where('entity_id', '=', Entity::id())->count(),
            'getCountDeleted' => CondominiumApartment::onlyTrashed()->where('entity_id', '=', Entity::id())->count()
        ];
    }
}
