<?php

namespace App\Http\Controllers\Condominium\Parking;

use App\Helpers\PageHelpers;
use App\Http\Controllers\Controller;
use App\Models\Condominium\CondominiumParking;
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
        $page = PageHelpers::page('126');
        $list = PageHelpers::page('127');

        return view('condominium.parkings.dashboard.page', compact('page', 'list'));
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
            'getCount'        => CondominiumParking::where('entity_id', '=', Entity::id())->count(),
            'getCountDeleted' => CondominiumParking::onlyTrashed()->where('entity_id', '=', Entity::id())->count()
        ];
    }
}
