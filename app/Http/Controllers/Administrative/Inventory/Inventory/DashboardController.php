<?php

namespace App\Http\Controllers\Administrative\Inventory\Inventory;

use App\Helpers\PageHelpers;
use App\Http\Controllers\Controller;
use App\Models\Entity\Entity;
use App\Models\Inventory\Inventory;
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
        $page = PageHelpers::page('110');
        $list = PageHelpers::page('111');

        return view('administrative.inventories.inventories.dashboard.page', compact('page', 'list'));
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
            'getCount'        => Inventory::where('entity_id', '=', Entity::id())->count(),
            'getCountDeleted' => Inventory::where('entity_id', '=', Entity::id())->where('deleted_at', '!=', null)->count(),
        ];
    }
}
