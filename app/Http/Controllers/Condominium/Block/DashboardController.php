<?php

namespace App\Http\Controllers\Administrative\Department;

use App\Helpers\PageHelpers;
use App\Http\Controllers\Controller;
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
        $page = PageHelpers::page('92');
        $list = PageHelpers::page('93');

        return view('administrative.departments.dashboard.page', compact('page', 'list'));
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
            'getCount'        => Department::where('entity_id', '=', Entity::id())->count(),
            'getCountBlocked' => Department::where('entity_id', '=', Entity::id())->where('blocked', '!=', null)->count()
        ];
    }
}
