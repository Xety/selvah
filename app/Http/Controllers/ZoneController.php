<?php

namespace Selvah\Http\Controllers;

use Illuminate\View\View;
use Selvah\Http\Controllers\Controller;
use Selvah\Models\Zone;

class ZoneController extends Controller
{
    /**
     * Show all the permissions.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $this->authorize('viewAny', Zone::class);

        $breadcrumbs = $this->breadcrumbs->addCrumb(
            '<i class="fa-solid fa-coins mr-2"></i> Gérer les Zones',
            route('zones.index')
        );

        return view('zone.index', compact('breadcrumbs'));
    }
}
