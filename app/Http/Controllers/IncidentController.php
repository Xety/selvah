<?php

namespace Selvah\Http\Controllers;

use Illuminate\View\View;
use Selvah\Models\Incident;

class IncidentController extends Controller
{
    /**
     * Show all the incidents.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $this->authorize('viewAny', Incident::class);

        $breadcrumbs = $this->breadcrumbs->addCrumb(
            '<i class="fa-solid fa-triangle-exclamation mr-2"></i> Gérer les Incidents',
            route('incident.index')
        );

        return view('incident.index', compact('breadcrumbs'));
    }
}
