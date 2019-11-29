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
        $page = PageHelpers::page('inventory.category.dashboard');
        $list = PageHelpers::page('inventory.category.list');

        return view('administrative.inventories.inventory-categories.dashboard.page', compact('page', 'list'));
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
            'getCount'        => InventoryCategory::where('entity_id', '=', Entity::id())->count(),
            'getCountBlocked' => InventoryCategory::where('entity_id', '=', Entity::id())->where('blocked', '!=', null)->count(),
        ];

        return $cards;
    }
}
