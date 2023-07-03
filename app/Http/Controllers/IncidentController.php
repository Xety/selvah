<?php

namespace Selvah\Http\Controllers;

use Illuminate\View\View;

class IncidentController extends Controller
{
    /**
     * Show all the incidents.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $breadcrumbs = $this->breadcrumbs->addCrumb(
            '<i class="fa-solid fa-screwdriver-wrench mr-2"></i> Gérer les Incidents',
            route('incident.index')
        );

        return view('incident.index', compact('breadcrumbs'));
    }
}
