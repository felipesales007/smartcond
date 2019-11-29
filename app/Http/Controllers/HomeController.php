<?php

namespace App\Http\Controllers;

use App\Helpers\PageHelpers;
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
        $page = PageHelpers::page('home.index');

        return view('home', compact('page'));
    }
}
