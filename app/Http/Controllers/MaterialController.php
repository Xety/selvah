<?php

namespace Selvah\Http\Controllers;

use Illuminate\View\View;

class MaterialController extends Controller
{
    /**
     * Show all the materials.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $breadcrumbs = $this->breadcrumbs->addCrumb(
            '<i class="fa-solid fa-microchip mr-2"></i> Gérer les Matériels',
            route('material.index')
        );

        return view('material.index', compact('breadcrumbs'));
    }
}
