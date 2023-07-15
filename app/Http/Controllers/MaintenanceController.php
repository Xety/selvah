<?php

namespace Selvah\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Selvah\Models\Maintenance;

class MaintenanceController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $breadcrumbs = $this->breadcrumbs->addCrumb(
            '<i class="fa-solid fa-screwdriver-wrench mr-2"></i> Gérer les Maintenances',
            route('maintenance.index')
        );
    }

    /**
     * Show all the incidents.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('maintenance.index', ['breadcrumbs' => $this->breadcrumbs]);
    }

    /**
     * Show a maintenance.
     *
     * @param Maintenance $maintenance The maintenance model retrieved by its ID.
     *
     * @return \Illuminate\View\View|Illuminate\Http\RedirectResponse
     */
    public function show(Maintenance $maintenance): View|RedirectResponse
    {
        $breadcrumbs = $this->breadcrumbs->addCrumb(
            'Maintenance N° ' . $maintenance->getKey(),
            route('maintenance.show', $maintenance)
        );

        $partExits = $maintenance->partExits()->paginate(25, ['*'], 'partExits');

        return view('maintenance.show', compact('breadcrumbs', 'maintenance', 'partExits'));
    }
}
