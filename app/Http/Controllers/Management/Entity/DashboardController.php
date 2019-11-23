<?php

namespace App\Http\Controllers\Management\Entity;

use App\Http\Controllers\Controller;
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
        return view('management.entities.dashboard.page');
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
            'getCount' => Entity::join('entity_accesses', 'entity_accesses.id', 'entities.id')
                ->when(auth()->user()['admin'] == '0', function ($query) {
                    $query->whereIn('entity_accesses.entity_id', Entity::getEntitiesUser());
                })
                ->count(),

            'getCountEmail' => Entity::join('entity_accesses', 'entity_accesses.id', 'entities.id')
                ->when(auth()->user()['admin'] == '0', function ($query) {
                    $query->whereIn('entity_accesses.entity_id', Entity::getEntitiesUser());
                })
                ->where('email', '!=', null)
                ->count(),

            'getCountContact' => Entity::join('entity_accesses', 'entity_accesses.id', 'entities.id')
                ->when(auth()->user()['admin'] == '0', function ($query) {
                    $query->whereIn('entity_accesses.entity_id', Entity::getEntitiesUser());
                })
                ->where('contact', '!=', null)
                ->count(),

            'getCountBlocked' => Entity::join('entity_accesses', 'entity_accesses.id', 'entities.id')
                ->when(auth()->user()['admin'] == '0', function ($query) {
                    $query->whereIn('entity_accesses.entity_id', Entity::getEntitiesUser());
                })
                ->where('blocked', '!=', null)
                ->orWhere('blocked_at', '>=', date('Y-m-d'))
                ->count()
        ];

        return $cards;
    }
}
