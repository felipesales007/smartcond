<?php

namespace App\Http\Controllers\Administrative\Inventory\Inventory;

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
        return view('administrative.inventories.inventories.dashboard.page');
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
            'getCount'        => Inventory::where('entity_id', '=', Entity::id())->count(),
            'getCountDeleted' => Inventory::where('entity_id', '=', Entity::id())->where('deleted_at', '!=', null)->count(),
        ];

        return $cards;
    }
}
