<?php

namespace App\Http\Controllers\Entity;

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
        return view('entities.dashboard');
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
            'getCount'        => Entity::count(),
            'getCountEmail'   => Entity::where('email', '!=', null)->count(),
            'getCountContact' => Entity::where('contact', '!=', null)->count(),
            'getCountBlocked' => Entity::where('blocked', '!=', null)->orWhere('blocked_at', '>=', date('Y-m-d'))->count()
        ];

        return $cards;
    }
}
