<?php

namespace Selvah\Http\Controllers;

use Illuminate\View\View;
use Selvah\Models\Lot;

class LotController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $breadcrumbs = $this->breadcrumbs->addCrumb(
            '<i class="fa-solid fa-seedling mr-2"></i> Gérer les Lots',
            route('lots.index')
        );
    }

    /**
     * Show all the lots.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $this->authorize('viewAny', Lot::class);

        return view('lot.index', ['breadcrumbs' => $this->breadcrumbs]);
    }
}
