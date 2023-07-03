<?php

namespace Selvah\Http\Controllers\Role;

use Illuminate\View\View;
use Selvah\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * Show all the roles.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $breadcrumbs = $this->breadcrumbs->addCrumb(
            '<i class="fa-solid fa-user-tie mr-2"></i> Gérer les Rôles',
            route('role.role.index')
        );

        return view('role.role.index', compact('breadcrumbs'));
    }
}
