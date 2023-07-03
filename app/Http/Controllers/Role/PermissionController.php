<?php

namespace Selvah\Http\Controllers\Role;

use Illuminate\View\View;
use Selvah\Http\Controllers\Controller;

class PermissionController extends Controller
{
    /**
     * Show all the permissions.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $breadcrumbs = $this->breadcrumbs->addCrumb(
            '<i class="fa-solid fa-user-shield mr-2"></i> Gérer les Permissions',
            route('role.permission.index')
        );

        return view('role.permission.index', compact('breadcrumbs'));
    }
}
