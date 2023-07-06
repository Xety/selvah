<?php

namespace Selvah\Http\Controllers;

use Illuminate\Contracts\Container\BindingResolutionException;
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
            route('material.index')
        );
    }
    /**
     * Show all the materials.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {

        return view('material.index', ['breadcrumbs' => $this->breadcrumbs]);
    }

    /**
     *
     * @param mixed $slug
     * @param mixed $id
     *
     * @return \Illuminate\View\View|Illuminate\Http\RedirectResponse
     */
    public function show($slug, $id): View|RedirectResponse
    {
        $material = Material::with('zone', 'user', 'incidents', 'parts')
            ->where('id', $id)
            ->first();

        if (is_null($material)) {
            return redirect()
                ->route('material.index')
                ->with('danger', 'Ce matériel n\'existe pas ou à été supprimé !');
        }

        $breadcrumbs = $this->breadcrumbs->addCrumb($material->name, $material->material_url);

        return view('material.show', compact('breadcrumbs', 'material'));
    }
}
