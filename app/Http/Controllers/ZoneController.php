<?php

namespace Selvah\Http\Controllers;

use Illuminate\View\View;
use Selvah\Http\Controllers\Controller;

class ZoneController extends Controller
{
    /**
     * Show all the permissions.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $breadcrumbs = $this->breadcrumbs->addCrumb(
            '<i class="fa-solid fa-coins mr-2"></i> Gérer les Zones',
            route('zone.index')
        );

        return view('zone.index', compact('breadcrumbs'));
    }
}
