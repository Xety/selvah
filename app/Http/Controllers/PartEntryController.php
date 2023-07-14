<?php

namespace Selvah\Http\Controllers;

use Illuminate\View\View;

class PartEntryController extends Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->breadcrumbs->addCrumb(
            '<i class="fa-solid fa-gear mr-2"></i> Gérer les Pièces Détachées',
            route('part.index')
        );

        $this->breadcrumbs->addCrumb(
            '<i class="fa-solid fa-arrow-right-to-bracket mr-2"></i> Gérer les Entrées',
            route('part-entry.index')
        );
    }

    /**
     * Show all the materials.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('part-entry.index', ['breadcrumbs' => $this->breadcrumbs]);
    }
}
