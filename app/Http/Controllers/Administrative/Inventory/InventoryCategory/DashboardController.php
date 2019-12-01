<?php

namespace App\Http\Controllers\Administrative\Inventory\InventoryCategory;

use App\Helpers\PageHelpers;
use App\Http\Controllers\Controller;
use App\Models\Entity\Entity;
use App\Models\Inventory\InventoryCategory;
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
        $page = PageHelpers::page('101');
        $list = PageHelpers::page('102');
        $sub  = PageHelpers::page('111');

        return view('administrative.inventories.inventory-categories.dashboard.page', compact('page', 'list', 'sub'));
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
            'getCount'        => InventoryCategory::where('entity_id', '=', Entity::id())->count(),
            'getCountBlocked' => InventoryCategory::where('entity_id', '=', Entity::id())->where('blocked', '!=', null)->count(),
        ];
    }
}
