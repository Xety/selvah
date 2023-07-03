<?php

namespace Selvah\Http\Controllers;

use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Show the search page.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $breadcrumbs = $this->breadcrumbs->addCrumb(
            '<i class="fa-solid fa-users mr-2"></i> Gérer les Utilisateurs',
            route('user.index')
        );

        return view('user.index', compact('breadcrumbs'));
    }
}
