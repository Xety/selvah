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
            route('part.index')
        );
    }

    /**
     * Show all the materials.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('part.index', ['breadcrumbs' => $this->breadcrumbs]);
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
        $part = Part::with('partEntries', 'partExits', 'material', 'editedUser', 'user')
            ->where('id', $id)
            ->first();

        if (is_null($part)) {
            return redirect()
                ->route('part.index')
                ->with('danger', 'Cette pièce détachée n\'existe pas ou à été supprimée !');
        }

        $partEntries = $part->partEntries()->paginate(25, ['*'], 'partEntries');
        $partExits = $part->partExits()->paginate(25, ['*'], 'partExits');

        $breadcrumbs = $this->breadcrumbs->addCrumb($part->name, $part->part_url);

        return view('part.show', compact('breadcrumbs', 'part', 'partEntries', 'partExits'));
    }
}
