<?php

namespace Selvah\Http\Controllers;

use Illuminate\View\View;
use Selvah\Models\PartExit;

class PartExitController extends Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->breadcrumbs->addCrumb(
            '<i class="fa-solid fa-gear mr-2"></i> Gérer les Pièces Détachées',
            route('parts.index')
        );

        $this->breadcrumbs->addCrumb(
            '<i class="fa-solid fa-right-from-bracket mr-2"></i> Gérer les Sorties',
            route('part-exits.index')
        );
    }

    /**
     * Show all the materials.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $this->authorize('viewAny', PartExit::class);

        return view('part-exit.index', ['breadcrumbs' => $this->breadcrumbs]);
    }
}
