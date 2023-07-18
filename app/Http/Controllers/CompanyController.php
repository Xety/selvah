<?php

namespace Selvah\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Selvah\Models\Company;

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

    /**
     * Show a company.
     *
     * @param Company $company The company model retrieved by its ID.
     *
     * @return \Illuminate\View\View|Illuminate\Http\RedirectResponse
     */
    public function show(Company $company): View|RedirectResponse
    {
        $breadcrumbs = $this->breadcrumbs->addCrumb(
            $company->name,
            route('company.show', $company)
        );

        $maintenances = $company->maintenances()->paginate(25, ['*'], 'maintenances');

        return view('company.show', compact('breadcrumbs', 'company', 'maintenances'));
    }
}
