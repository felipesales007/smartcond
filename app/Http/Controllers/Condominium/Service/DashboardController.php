<?php

namespace App\Http\Controllers\Condominium\Service;

use App\Helpers\PageHelpers;
use App\Http\Controllers\Controller;
use App\Models\Condominium\CondominiumService;
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
        $page = PageHelpers::page('142');
        $list = PageHelpers::page('143');

        return view('condominium.services.dashboard.page', compact('page', 'list'));
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
            'getCount'        => CondominiumService::where('entity_id', '=', Entity::id())->count(),
            'getCountDeleted' => CondominiumService::onlyTrashed()->where('entity_id', '=', Entity::id())->count()
        ];
    }
}
