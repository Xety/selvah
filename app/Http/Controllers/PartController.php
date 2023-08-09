<?php

namespace Selvah\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Selvah\Models\Part;
use Selvah\Models\PartEntry;
use Selvah\Models\PartExit;

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

        $viewDatas = [];

        $breadcrumbs = $this->breadcrumbs;
        array_push($viewDatas, 'breadcrumbs');

        // Price total of all part in stock
        $priceTotalAllPartInStock = Cache::remember(
            'Parts.count.price_total_all_part_in_stock',
            config('selvah.cache.parts.price_total_all_part_in_stock'),
            function () {
                return number_format(Part::sum(DB::raw('price * (part_entry_total - part_exit_total)')));
            }
        );
        array_push($viewDatas, 'priceTotalAllPartInStock');

        // Price total of all part exits
        $priceTotalAllPartExits = Cache::remember(
            'Parts.count.price_total_all_part_exits',
            config('selvah.cache.parts.price_total_all_part_exits'),
            function () {
                return number_format(Part::sum(DB::raw('price * part_exit_total')));
            }
        );
        array_push($viewDatas, 'priceTotalAllPartExits');

        // Price total of all part entries
        $priceTotalAllPartEntries = Cache::remember(
            'Parts.count.price_total_all_part_entries',
            config('selvah.cache.parts.price_total_all_part_entries'),
            function () {
                return number_format(Part::sum(DB::raw('price * part_entry_total')));
            }
        );
        array_push($viewDatas, 'priceTotalAllPartEntries');

        // Total parts in stock
        $totalPartInStock = Cache::remember(
            'Parts.count.total_part_in_stock',
            config('selvah.cache.parts.total_part_in_stock'),
            function () {
                return number_format(Part::sum(DB::raw('part_entry_total - part_exit_total')));
            }
        );
        array_push($viewDatas, 'totalPartInStock');

        // Total parts that got out of stock
        $totalPartOutOfStock = Cache::remember(
            'Parts.count.total_part_out_of_stock',
            config('selvah.cache.parts.total_part_out_of_stock'),
            function () {
                return number_format(PartExit::sum(DB::raw('number')));
            }
        );
        array_push($viewDatas, 'totalPartOutOfStock');

        // Total parts that get in stock
        $totalPartGetInStock = Cache::remember(
            'Parts.count.total_part_get_in_stock',
            config('selvah.cache.parts.total_part_get_in_stock'),
            function () {
                return number_format(PartEntry::sum(DB::raw('number')));
            }
        );
        array_push($viewDatas, 'totalPartGetInStock');

        return view('part.index', compact($viewDatas));
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
