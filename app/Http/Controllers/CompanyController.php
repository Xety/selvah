<?php

namespace Selvah\Http\Controllers;

use Illuminate\View\View;

class CompanyController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $breadcrumbs = $this->breadcrumbs->addCrumb(
            '<i class="fa-solid fa-briefcase mr-2"></i> Gérer les Entreprises',
            route('company.index')
        );
    }

    /**
     * Show all the companies.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('company.index', ['breadcrumbs' => $this->breadcrumbs]);
    }
}
