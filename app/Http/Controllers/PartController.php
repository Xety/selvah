<?php

namespace Selvah\Http\Controllers;

use Illuminate\View\View;

class PartController extends Controller
{
    /**
     * Show all the materials.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $breadcrumbs = $this->breadcrumbs->addCrumb(
            '<i class="fa-solid fa-gear mr-2"></i> Gérer les Pièces Détachées',
            route('part.index')
        );

        return view('part.index', compact('breadcrumbs'));
    }
}
