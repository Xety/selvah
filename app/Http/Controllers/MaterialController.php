<?php

namespace Selvah\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Selvah\Models\Material;

class MaterialController extends Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->breadcrumbs->addCrumb(
            '<i class="fa-solid fa-microchip mr-2"></i> Gérer les Matériels',
            route('materials.index')
        );
    }

    /**
     * Show all the materials.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $this->authorize('viewAny', Material::class);

        return view('material.index', ['breadcrumbs' => $this->breadcrumbs]);
    }

    /**
     * Show a material.
     *
     * @param Material $material The material.
     *
     * @return \Illuminate\View\View|Illuminate\Http\RedirectResponse
     */
    public function show(Material $material): View|RedirectResponse
    {
        $this->authorize('view', $material);

        $parts = $material->parts()->paginate(25, ['*'], 'parts');
        $incidents = $material->incidents()->paginate(25, ['*'], 'incidents');
        $maintenances = $material->maintenances()->paginate(25, ['*'], 'maintenances');

        $breadcrumbs = $this->breadcrumbs->addCrumb($material->name, $material->show_url);

        return view('material.show', compact('breadcrumbs', 'material', 'parts', 'incidents', 'maintenances'));
    }
}
