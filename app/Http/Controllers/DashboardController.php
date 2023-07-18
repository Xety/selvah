<?php

namespace Selvah\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Selvah\Models\Incident;
use Selvah\Models\Lot;
use Selvah\Models\Maintenance;
use Selvah\Models\Part;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $viewDatas = [];

        // Initialize all carbon instances.
        $startLastMonth = new Carbon('first day of last month');
        $endLastMonth = new Carbon('last day of last month');
        $start2MonthsAgo = Carbon::now()->startOfMonth()->subMonth(2)->toDateString();
        $end2MonthsAgo = Carbon::now()->endOfMonth()->subMonth(2)->toDateString();
        $lastMonthText = Carbon::now()->subMonth()->translatedFormat('F');
        $last2MonthsText = Carbon::now()->subMonth(2)->translatedFormat('F');
        array_push($viewDatas, 'lastMonthText');
        array_push($viewDatas, 'last2MonthsText');

        // Incidents
        $lastMonthIncidents = Cache::remember(
            'Dashboard.incidents.count.last_month',
            config('selvah.cache.incidents_count'),
            function () use ($startLastMonth, $endLastMonth) {
                return Incident::
                    whereDate('created_at', '>=', $startLastMonth)
                    ->whereDate('created_at', '<=', $endLastMonth)
                    ->count();
            }
        );
        array_push($viewDatas, 'lastMonthIncidents');

        $last2Months = Cache::remember(
            'Dashboard.incidents.count.last_2months',
            config('selvah.cache.incidents_count'),
            function () use ($start2MonthsAgo, $end2MonthsAgo) {
                return Incident::
                    whereDate('created_at', '>=', $start2MonthsAgo)
                    ->whereDate('created_at', '<=', $end2MonthsAgo)
                    ->count();
            }
        );

        $percentIncidentsCount = $last2Months == 0 ?
            $lastMonthIncidents * 100 :
            (($lastMonthIncidents - $last2Months) / $last2Months) * 100;
        array_push($viewDatas, 'percentIncidentsCount');

        // Maintenances
        $lastMonthMaintenances = Cache::remember(
            'Dashboard.maintenances.count.last_month',
            config('selvah.cache.maintenances_count'),
            function () use ($startLastMonth, $endLastMonth) {
                return Maintenance::
                    whereDate('created_at', '>=', $startLastMonth)
                    ->whereDate('created_at', '<=', $endLastMonth)
                    ->count();
            }
        );
        array_push($viewDatas, 'lastMonthMaintenances');

        $last2Months = Cache::remember(
            'Dashboard.maintenances.count.last_2months',
            config('selvah.cache.maintenances_count'),
            function () use ($start2MonthsAgo, $end2MonthsAgo) {
                return Maintenance::
                    whereDate('created_at', '>=', $start2MonthsAgo)
                    ->whereDate('created_at', '<=', $end2MonthsAgo)
                    ->count();
            }
        );

        $percentMaintenancesCount = $last2Months == 0 ?
            $lastMonthMaintenances * 100 :
            (($lastMonthMaintenances - $last2Months) / $last2Months) * 100;
        array_push($viewDatas, 'percentMaintenancesCount');

        // Part
        $partInStock = Cache::remember(
            'Dashboard.parts.count.last_month',
            config('selvah.cache.parts_count'),
            function () {
                return Part::sum(DB::raw('part_entry_total - part_exit_total'));
            }
        );
        array_push($viewDatas, 'partInStock');

        // Production
        $lastMonthProduction = Cache::remember(
            'Dashboard.production.last_lot',
            config('selvah.cache.production_count'),
            function () {
                return Lot::orderBy('created_at', 'desc')->first();
            }
        );
        array_push($viewDatas, 'lastMonthProduction');

        $last2LotsProduction = Cache::remember(
            'Dashboard.production.last_2lots',
            config('selvah.cache.production_count'),
            function () {
                return Lot::orderBy('created_at', 'desc')->skip(1)->first();
            }
        );
        array_push($viewDatas, 'last2LotsProduction');

        $productionCount = $last2LotsProduction->compliant_bagged_tvp == 0 ?
            $lastMonthProduction->compliant_bagged_tvp * 100 :
            (($lastMonthProduction->compliant_bagged_tvp - $last2LotsProduction->compliant_bagged_tvp) / $last2LotsProduction->compliant_bagged_tvp) * 100;
        $productionCount = round($productionCount, 2);
        array_push($viewDatas, 'productionCount');


        // Graph Incidents/Maintenances
        $mainGraphData = Cache::remember(
            'Dashboard.maintenances.count.last_7months',
            config('selvah.cache.graph_maintenance_incident'),
            function () {
                $maintenancesData = [];
                $incidentsData = [];
                $monthsData = [];
                $array = [];
                $months = 7;

                for ($i = 1; $i <= $months; $i++) {
                    $lastXMonthsText = Carbon::now()->subMonth($i)->translatedFormat('F Y');
                    $monthsData[$i] = ucfirst($lastXMonthsText);

                    $startXMonthsAgo = Carbon::now()->startOfMonth()->subMonth($i)->toDateString();
                    $endXMonthsAgo = Carbon::now()->endOfMonth()->subMonth($i)->toDateString();

                    $maintenancesData[$i] = Maintenance::
                        whereDate('created_at', '>=', $startXMonthsAgo)
                        ->whereDate('created_at', '<=', $endXMonthsAgo)
                        ->count();
                    $incidentsData[$i] = Incident::
                        whereDate('created_at', '>=', $startXMonthsAgo)
                        ->whereDate('created_at', '<=', $endXMonthsAgo)
                        ->count();
                }
                $array['months'] = array_reverse($monthsData);
                $array['maintenances'] = array_reverse($maintenancesData);
                $array['incidents'] = array_reverse($incidentsData);

                return $array;
            }
        );
        array_push($viewDatas, 'mainGraphData');


        // Incidents & Maintenances
        $incidents = Incident::where('is_finished', false)
            ->orderBy('created_at', 'desc')
            ->paginate(2, ['*'], 'incidents');
        $maintenances = Maintenance::where('finished_at', null)
            ->orderBy('created_at', 'desc')
            ->paginate(2, ['*'], 'maintenances');
        array_push($viewDatas, 'incidents', 'maintenances');

        // Lots
        $lotsGraphData = Cache::remember(
            'Dashboard.lots.graph.',
            config('selvah.cache.graph_lots'),
            function () {
                $array = [];
                $lots = Lot::all();

                foreach ($lots as $lot) {
                    $array['crude_oil_yield'][] = [
                        'lot' => $lot->number,
                        'data' => $lot->crude_oil_yield
                    ];
                    $array['soy_hull_yield'][] = [
                        'lot' => $lot->number,
                        'data' => $lot->soy_hull_yield
                    ];
                    $array['crushed_waste'][] = [
                        'lot' => $lot->number,
                        'data' => $lot->crushed_waste
                    ];
                    $array['non_compliant_bagged_tvp_yield'][] = [
                        'lot' => $lot->number,
                        'data' => $lot->non_compliant_bagged_tvp_yield
                    ];
                    $array['extrusion_waste'][] = [
                        'lot' => $lot->number,
                        'data' => $lot->extrusion_waste
                    ];
                    $array['lot_waste'][] = [
                        'lot' => $lot->number,
                        'data' => $lot->lot_waste
                    ];

                    $array['lots'][] = $lot->number;
                }

                return $array;
            }
        );
        array_push($viewDatas, 'lotsGraphData');

        $breadcrumbs = $this->breadcrumbs;
        array_push($viewDatas, 'breadcrumbs');

        return view('dashboard.index', compact($viewDatas));
    }
}
