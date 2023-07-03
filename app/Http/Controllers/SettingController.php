<?php

namespace Selvah\Http\Controllers;

use Illuminate\View\View;

class SettingController extends Controller
{
    /**
     * Show all the settings.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $breadcrumbs = $this->breadcrumbs->addCrumb(
            '<i class="fa-solid fa-wrench mr-2"></i> Gérer les Paramètres',
            route('setting.index')
        );

        return view('setting.index', compact('breadcrumbs'));
    }
}
