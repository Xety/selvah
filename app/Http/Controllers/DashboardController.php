<?php

namespace Selvah\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Selvah\Models\Incident;
use Selvah\Models\Maintenance;

class DashboardController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $breadcrumbs = $this->breadcrumbs->addCrumb(
            '<i class="fa-solid fa-gauge mr-2"></i> Tableau de bord',
            route('dashboard.index')
        );
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $viewDatas = [];

        $incidentsCount = Cache::remember('Dashboard.incidents.count', (config('selvah.cache.incidents_count')), function () {
            return Incident::count();
        });
        array_push($viewDatas, 'incidentsCount');

        $startLastMonth = new Carbon('first day of last month');
        $endLastMonth = new Carbon('last day of last month');
        $lastMonth = Incident::whereDate('created_at', '>=', $startLastMonth)->whereDate('created_at', '<=', $endLastMonth)->count();

        $start2MonthsAgo = Carbon::now()->startOfMonth()->subMonth(2)->toDateString();
        $end2MonthsAgo = Carbon::now()->endOfMonth()->subMonth(2)->toDateString();
        $last2Months = Incident::whereDate('created_at', '>=', $start2MonthsAgo)->whereDate('created_at', '<=', $end2MonthsAgo)->count();
        //dd($last2Months);
        $percent = 100 - (($last2Months * 100) / $lastMonth);
        //$percent = $percent >= 100 ? -$percent : $percent;
        //dd($incidentsCount, $lastMonth, $last2Months);
        array_push($viewDatas, 'percent');

        $maintenancesCount = Cache::remember('Dashboard.maintenances.count', (config('selvah.cache.maintenances_count')), function () {
            return Maintenance::count();
        });
        array_push($viewDatas, 'maintenancesCount');

        $breadcrumbs = $this->breadcrumbs;
        array_push($viewDatas, 'breadcrumbs');

        return view('dashboard.index', compact($viewDatas));
    }
}
