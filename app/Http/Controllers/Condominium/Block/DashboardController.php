<?php

namespace App\Http\Controllers\Condominium\Block;

use App\Helpers\PageHelpers;
use App\Http\Controllers\Controller;
use App\Models\Condominium\CondominiumBlock;
use App\Models\Department;
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
        $page = PageHelpers::page('118');
        $list = PageHelpers::page('119');

        return view('condominium.blocks.dashboard.page', compact('page', 'list'));
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
            'getCount'        => CondominiumBlock::where('entity_id', '=', Entity::id())->count(),
            'getCountDeleted' => CondominiumBlock::onlyTrashed()->where('entity_id', '=', Entity::id())->count()
        ];
    }
}
