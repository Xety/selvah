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
        $startLastMonth = Carbon::now()->startOfMonth()->toDateString();
        $endLastMonth = Carbon::now()->endOfMonth()->toDateString();
        $start2MonthsAgo = Carbon::now()->startOfMonth()->subMonthsNoOverflow()->toDateString();
        $end2MonthsAgo = Carbon::now()->subMonthsNoOverflow()->endOfMonth()->toDateString();
        $lastMonthText = Carbon::now()->translatedFormat('F');
        $last2MonthsText = Carbon::now()->subMonth()->translatedFormat('F');
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

        $percentIncidentsCount = round($last2Months == 0 ?
            $lastMonthIncidents * 100 :
            (($lastMonthIncidents - $last2Months) / $last2Months) * 100, 2);
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

        $percentMaintenancesCount = round($last2Months == 0 ?
            $lastMonthMaintenances * 100 :
            (($lastMonthMaintenances - $last2Months) / $last2Months) * 100, 2);
        array_push($viewDatas, 'percentMaintenancesCount');

        // Part
        $partInStock = Cache::remember(
            'Dashboard.parts.count.last_month',
            config('selvah.cache.parts_count'),
            function () {
                return number_format(Part::sum(DB::raw('part_entry_total - part_exit_total')));
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
                $months = 6;

                for ($i = 0; $i <= $months; $i++) {
                    $lastXMonthsText = Carbon::now()->subMonth($i)->translatedFormat('F Y');
                    $monthsData[$i] = ucfirst($lastXMonthsText);

                    $startXMonthsAgo = Carbon::now()->startOfMonth()->subMonthsNoOverflow($i)->toDateString();
                    $endXMonthsAgo = Carbon::now()->subMonthsNoOverflow($i)->endOfMonth()->toDateString();

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
                $lots = Lot::orderBy('created_at', 'desc')->take(7)->get();
                $lots = $lots->reverse();

                foreach ($lots as $lot) {
                    $array['crude_oil_yield'][] = [
                        'x' => $lot->number,
                        'y' => $lot->crude_oil_yield
                    ];
                    $array['soy_hull_yield'][] = [
                        'x' => $lot->number,
                        'y' => $lot->soy_hull_yield
                    ];
                    $array['crushed_waste'][] = [
                        'x' => $lot->number,
                        'y' => $lot->crushed_waste
                    ];
                    $array['non_compliant_bagged_tvp_yield'][] = [
                        'x' => $lot->number,
                        'y' => $lot->non_compliant_bagged_tvp_yield
                    ];
                    $array['extrusion_waste'][] = [
                        'x' => $lot->number,
                        'y' => $lot->extrusion_waste
                    ];
                    $array['lot_waste'][] = [
                        'x' => $lot->number,
                        'y' => $lot->lot_waste
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
