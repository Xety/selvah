<?php

namespace Selvah\Http\Controllers;

use Illuminate\View\View;
use Selvah\Models\Calendar;

class CalendarController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $breadcrumbs = $this->breadcrumbs->addCrumb(
            '<i class="fa-solid fa-calendar mr-2"></i> Gérer le Planning',
            route('calendars.index')
        );
    }

    /**
     * Show all the calendars.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $this->authorize('viewAny', Calendar::class);

        return view('calendar.index', ['breadcrumbs' => $this->breadcrumbs]);
    }
}
