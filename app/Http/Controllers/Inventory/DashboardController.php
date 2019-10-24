<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Entity\Entity;
use App\Models\Inventory\Inventory;
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
        return view('inventories.dashboard');
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
            'getCountInventories'                => Inventory::where('entity_id', '=', Entity::id())->count(),
            'getCountDeletedInventories'         => Inventory::where('entity_id', '=', Entity::id())->where('deleted_at', '!=', null)->count(),
            'getCountInventoryCategories'        => InventoryCategory::where('entity_id', '=', Entity::id())->count(),
            'getCountBlockedInventoryCategories' => InventoryCategory::where('entity_id', '=', Entity::id())->where('blocked', '!=', null)->count(),
        ];

        return $cards;
    }
}
