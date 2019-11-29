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
        $page = PageHelpers::page('department.dashboard');
        $list = PageHelpers::page('department.list');

        return view('administrative.departments.dashboard.page', compact('page', 'list'));
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
            'getCount'        => Department::where('entity_id', '=', Entity::id())->count(),
            'getCountBlocked' => Department::where('entity_id', '=', Entity::id())->where('blocked', '!=', null)->count()
        ];

        return $cards;
    }
}
