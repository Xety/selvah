<?php

namespace Selvah\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Selvah\Models\Part;

class PartController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->breadcrumbs->addCrumb(
            '<i class="fa-solid fa-gear mr-2"></i> Gérer les Pièces Détachées',
            route('parts.index')
        );
    }

    /**
     * Show all the materials.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $this->authorize('viewAny', Part::class);

        return view('part.index', ['breadcrumbs' => $this->breadcrumbs]);
    }

    /**
     * SHow the part.
     *
     * @param Part $part The part model to show.
     *
     * @return \Illuminate\View\View|Illuminate\Http\RedirectResponse
     */
    public function show(Part $part): View|RedirectResponse
    {
        $this->authorize('view', $part);

        $partEntries = $part->partEntries()->paginate(25, ['*'], 'partEntries');
        $partExits = $part->partExits()->paginate(25, ['*'], 'partExits');

        $breadcrumbs = $this->breadcrumbs->addCrumb($part->name, $part->show_url);

        return view('part.show', compact('breadcrumbs', 'part', 'partEntries', 'partExits'));
    }
}
