<?php

namespace App\Http\Controllers;

use Illuminate\View\Factory;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Mostrar a página solicitada.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('home');
    }
}
