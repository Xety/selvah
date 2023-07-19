@extends('layouts.app')
{!! config(['app.title' => 'Tableau de bord']) !!}

@push('meta')
    <x-meta title="Tableau de bord" />
@endpush

@push('scripts')
    @include('dashboard.partials._graph-scripts')
@endpush

@section('content')
<section class="m-3 lg:m-10">
    <div class="grid grid-cols-1">
        <div class="col-span-12 mx-3 ">
            {!! $breadcrumbs->render() !!}
        </div>
    </div>
</section>
<section class="m-3 lg:m-10">
    <div class="grid grid-cols-12 gap-4 mb-4">
        <div class="col-span-12 lg:col-span-6 2xl:col-span-3">
            <div class="p-6 shadow-md border border-gray-200 rounded-lg h-full">
                <div class="flex justify-between">
                    <div class="text-2xl">
                        <span class="uppercase">Incidents</span>
                        <div class="dropdown dropdown-hover dropdown-bottom dropdown-end">
                            <label tabindex="0" class="hover:cursor-pointer text-info">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-4 h-4 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </label>
                            <div tabindex="0" class="card compact dropdown-content z-[1] shadow bg-base-100 rounded-box w-64">
                                <div class="card-body">
                                    <p>
                                        Nombre d'incidents total sur le dernier mois écoulé : <span class="capitalize">{{ $lastMonthText }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <i class="fa-solid fa-triangle-exclamation text-error text-5xl"></i>
                    </div>
                </div>
                <div>
                    <span class="text-4xl font-bold">
                        {{ $lastMonthIncidents }}
                    </sapn>
                    @if ($percentIncidentsCount < 0)
                        <span class="text-success tooltip text-2xl" data-tip="{{ $percentIncidentsCount }}% d'incidents le mois de {{ $lastMonthText }} par rapport au mois de {{ $last2MonthsText }}.">
                            ({{ $percentIncidentsCount }}%)
                        </span>
                    @else
                        <span class="text-red-500 tooltip text-2xl" data-tip="+{{ $percentIncidentsCount }}% d'incidents le mois de {{ $lastMonthText }} par rapport au mois de {{ $last2MonthsText }}.">
                            +({{ $percentIncidentsCount }}%)
                        </span>
                    @endif
                </div>
                <div class="divider"></div>
                <span class="opacity-70">
                    Le nombre d'incidents sur le mois de <span class="capitalize">{{ $lastMonthText }}</span>.
                </span>
            </div>
        </div>

        <div class="col-span-12 lg:col-span-6 2xl:col-span-3">
            <div class="p-6 shadow-md border border-gray-200 rounded-lg h-full">
                <div class="flex justify-between">
                    <div class="text-2xl">
                        <span class="uppercase">Maintenances</span>
                        <div class="dropdown dropdown-hover dropdown-bottom dropdown-end">
                            <label tabindex="0" class="hover:cursor-pointer text-info">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-4 h-4 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </label>
                            <div tabindex="0" class="card compact dropdown-content z-[1] shadow bg-base-100 rounded-box w-64">
                                <div class="card-body">
                                    <p>
                                        Nombre de maintenances total sur le dernier mois écoulé : <span class="capitalize">{{ $lastMonthText }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <i class="fa-solid fa-screwdriver-wrench text-warning text-5xl"></i>
                    </div>
                </div>
                <div>
                    <span class="text-4xl font-bold">
                        {{ $lastMonthMaintenances }}
                    </sapn>
                    @if ($percentMaintenancesCount < 0)
                        <span class="text-success tooltip text-2xl" data-tip="{{ $percentMaintenancesCount }}% d'incidents le mois de {{ $lastMonthText }} par rapport au mois de {{ $last2MonthsText }}.">
                            ({{ $percentMaintenancesCount }}%)
                        </span>
                    @else
                        <span class="text-red-500 tooltip text-2xl" data-tip="+{{ $percentMaintenancesCount }}% d'incidents le mois de {{ $lastMonthText }} par rapport au mois de {{ $last2MonthsText }}.">
                            +({{ $percentMaintenancesCount }}%)
                        </span>
                    @endif

                </div>
                <div class="divider"></div>
                <span class="opacity-70">
                    Le nombre de maintenance sur le mois de <span class="capitalize">{{ $lastMonthText }}</span>.
                </span>
            </div>
        </div>

        <div class="col-span-12 lg:col-span-6 2xl:col-span-3">
            <div class="p-6 shadow-md border border-gray-200 rounded-lg h-full">
                <div class="flex justify-between">
                    <div class="text-2xl">
                        <span class="uppercase">Pièces Détachées</span>
                        <div class="dropdown dropdown-hover dropdown-bottom dropdown-end">
                            <label tabindex="0" class="hover:cursor-pointer text-info">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-4 h-4 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </label>
                            <div tabindex="0" class="card compact dropdown-content z-[1] shadow bg-base-100 rounded-box w-64">
                                <div class="card-body">
                                    <p>
                                        Nombre de pièces détachées en stocks actuellement.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <i class="fa-solid fa-cubes-stacked text-blue-500 text-5xl"></i>
                    </div>
                </div>
                <div class="text-4xl font-bold">
                    {{ $partInStock }}
                </div>
                <div class="divider"></div>
                <span class="opacity-70">
                    Le nombre de pièces détachées en stocks actuellement.
                </span>
            </div>
        </div>

        <div class="col-span-12 lg:col-span-6 2xl:col-span-3">
            <div class="p-6 shadow-md border border-gray-200 rounded-lg h-full">
                <div class="flex justify-between">
                    <div class="text-2xl">
                        <span class="uppercase">Production PVT</span>
                        <div class="dropdown dropdown-hover dropdown-bottom dropdown-end">
                            <label tabindex="0" class="hover:cursor-pointer text-info">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-4 h-4 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </label>
                            <div tabindex="0" class="card compact dropdown-content z-[1] shadow bg-base-100 rounded-box w-64">
                                <div class="card-body">
                                    <p>
                                        Nombre kilos de PVT ensachés conforme sur le lot {{ $lastMonthProduction->number }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <i class="fa-solid fa-seedling text-success text-5xl"></i>
                    </div>
                </div>
                <div>
                    <span class="text-4xl font-bold">
                        {{ number_format($lastMonthProduction->compliant_bagged_tvp) }} Kg
                    </sapn>
                    @if ($productionCount >= 0)
                        <span class="text-success tooltip text-2xl" data-tip="+{{ $productionCount }}% de PVT ensachés conforme sur le lot {{ $lastMonthProduction->number }} par rapport au lot {{ $last2LotsProduction->number }}.">
                            +({{ $productionCount }}%)
                        </span>
                    @else
                        <span class="text-red-500 tooltip text-2xl" data-tip="{{ $productionCount }}% de PVT ensachés conforme sur le lot {{ $lastMonthProduction->number }} par rapport au lot {{ $last2LotsProduction->number }}.">
                            ({{ $productionCount }}%)
                        </span>
                    @endif

                </div>
                <div class="divider"></div>
                <span class="opacity-70">
                    Le nombre de kilos de PVT ensachés conforme sur le lot {{ $lastMonthProduction->number }}.
                </span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-4 mb-4">
        <div class="col-span-12 lg:col-span-6 2xl:col-span-8">
            <div class="p-6 shadow-md border border-gray-200 rounded-lg h-full">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex-shrink-0">
                        <span class="text-xl font-bold sm:text-2xl">Incidents et Maintenances</span>
                        <h3 class="text-base font-light text-gray-500 ">Historique sur les 7 derniers mois</h3>
                    </div>
                    <div class="flex items-center justify-end text-5xl text-cyan-500">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
                </div>
                <div id="graph-maintenance-incident"></div>
            </div>
        </div>

        <div class="col-span-12 lg:col-span-6 2xl:col-span-4">
            <div class="p-6 shadow-md border border-gray-200 rounded-lg h-full">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex-shrink-0">
                        <span class="text-xl font-bold sm:text-2xl">Activité en cours</span>
                        <h3 class="hidden sm:block text-base font-light text-gray-500 ">Incidents et maintenances non résolus</h3>
                    </div>
                    <div class="flex items-center justify-end text-5xl text-purple-600">
                        <i class="fa-solid fa-list-check"></i>
                    </div>
                </div>

                <div x-data="tabs()">
                    <ul class="tabs flex pb-4">
                        <template x-for="(tab, index) in tabs" :key="index">
                            <li class="cursor-pointer px-4 text-gray-500 border-b-8"
                                :class="activeTab === index ? 'tab tab-bordered tab-lg flex-auto tab-active' : 'tab tab-bordered tab-lg flex-auto'" @click="activeTab = index; window.location.hash = index"
                                x-text="tab"></li>
                        </template>
                    </ul>

                    <div class="text-center mx-auto">
                        <div x-show="activeTab === 'incidents'">
                            @if ($incidents->isNotEmpty())
                                <x-table.table class="mb-6">
                                    <x-slot name="head">
                                        <x-table.heading>#Id</x-table.heading>
                                        <x-table.heading>Matériel</x-table.heading>
                                        <x-table.heading>Zone</x-table.heading>
                                        <x-table.heading>Créateur</x-table.heading>
                                        <x-table.heading>Description</x-table.heading>
                                        <x-table.heading>Incident créé le</x-table.heading>
                                        <x-table.heading>Impact</x-table.heading>
                                        <x-table.heading>Résolu</x-table.heading>
                                    </x-slot>

                                    <x-slot name="body">
                                        @foreach($incidents as $incident)
                                            <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $incident->getKey() }}" @class([
                                                'bg-opacity-25',
                                                'bg-yellow-500' => $incident->impact == 'mineur',
                                                'bg-orange-500' => $incident->impact == 'moyen',
                                                'bg-red-500' => $incident->impact == 'critique'
                                            ])>
                                                <x-table.cell>{{ $incident->getKey() }}</x-table.cell>
                                                <x-table.cell>
                                                    <a class="link link-hover link-primary font-bold" href="{{ $incident->material->show_url }}">
                                                        {{ $incident->material->name }}
                                                    </a>
                                                </x-table.cell>
                                                <x-table.cell>{{ $incident->material->zone->name }}</x-table.cell>
                                                <x-table.cell>{{ $incident->user->username }}</x-table.cell>
                                                <x-table.cell>
                                                    <span class="tooltip tooltip-top" data-tip="{{ $incident->description }}">{{ Str::limit($incident->description, 30) }}</span>
                                                </x-table.cell>
                                                <x-table.cell class="capitalize">{{ $incident->started_at->translatedFormat( 'D j M Y H:i') }}</x-table.cell>
                                                <x-table.cell>
                                                    @if ($incident->impact == 'mineur')
                                                        <span class="font-bold text-yellow-500">Mineur</span>
                                                    @elseif ($incident->impact == 'moyen')
                                                        <span class="font-bold text-orange-500">Moyen</span>
                                                    @else
                                                        <span class="font-bold text-red-500">Critique</span>
                                                    @endif
                                                </x-table.cell>
                                                <x-table.cell>
                                                    @if ($incident->is_finished)
                                                        <span class="font-bold text-green-500">Oui</span>
                                                    @else
                                                        <span class="font-bold text-red-500">Non</span>
                                                    @endif
                                                </x-table.cell>
                                            </x-table.row>
                                        @endforeach
                                    </x-slot>
                                </x-table.table>

                                <div class="grid grid-cols-1">
                                    {{ $incidents->fragment('incidents')->links() }}
                                </div>
                            @else
                                <div class="flex w-full overflow-hidden rounded-lg shadow-md bg-white z-10 text-left">
                                    <div class="flex items-center justify-center w-14 bg-green-500">
                                        <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg"><path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z"></path></svg>
                                    </div>
                                    <div class="relative px-2 py-2 w-full">
                                        <div class="mx-3">
                                            <span class="font-semibold text-green-500">Aucun incident</span>
                                            <p class="text-sm">
                                                Aucun incident actif en cours !
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div x-show="activeTab === 'maintenances'" style="display:none">
                            @if ($maintenances->isNotEmpty())
                                <x-table.table class="mb-6">
                                    <x-slot name="head">
                                        <x-table.heading>#Id</x-table.heading>
                                        <x-table.heading>N° GMAO</x-table.heading>
                                        <x-table.heading>Matériel</x-table.heading>
                                        <x-table.heading>Description</x-table.heading>
                                        <x-table.heading>Raison</x-table.heading>
                                        <x-table.heading>Créateur</x-table.heading>
                                        <x-table.heading>Type</x-table.heading>
                                        <x-table.heading>Réalisation</x-table.heading>
                                        <x-table.heading>Commencée le</x-table.heading>
                                    </x-slot>

                                    <x-slot name="body">
                                        @foreach($maintenances as $maintenance)
                                            <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $maintenance->getKey() }}">
                                                <x-table.cell>
                                                    <a class="link link-hover link-primary tooltip tooltip-right" href="{{ $maintenance->show_url }}"  data-tip="Voir la fiche Maintenance">
                                                        <span class="font-bold">{{ $maintenance->getKey() }}</span>
                                                    </a>
                                                </x-table.cell>
                                                <x-table.cell class="prose">
                                                    @unless (is_null($maintenance->gmao_id))
                                                        <code class="text-[color:hsl(var(--p))] bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                                                        {{ $maintenance->gmao_id }}
                                                    </code>
                                                    @endunless
                                                </x-table.cell>
                                                <x-table.cell class="prose">
                                                    @unless (is_null($maintenance->material_id))
                                                        <a class="link link-hover link-primary font-bold" href="{{ $maintenance->material_url }}">
                                                            {{ $maintenance->material->name }}
                                                        </a>
                                                    @endunless
                                                </x-table.cell>
                                                <x-table.cell>
                                                    <span class="tooltip tooltip-top" data-tip="{{ $maintenance->description }}">
                                                        {{ Str::limit($maintenance->description, 30) }}
                                                    <span>
                                                </x-table.cell>
                                                <x-table.cell>
                                                    <span class="tooltip tooltip-top" data-tip="{{ $maintenance->reason }}">
                                                        {{ Str::limit($maintenance->reason, 30) }}
                                                    </span>
                                                </x-table.cell>
                                                <x-table.cell>{{ $maintenance->user->username }}</x-table.cell>
                                                <x-table.cell>
                                                    @if ($maintenance->type === 'curative')
                                                        <span class="font-bold text-red-500">Curative</span>
                                                    @else
                                                        <span class="font-bold text-green-500">Préventive</span>
                                                    @endif
                                                </x-table.cell>
                                                <x-table.cell>
                                                    @if ($maintenance->realization === 'external')
                                                        <span class="font-bold text-red-500">Externe</span>
                                                    @elseif ($maintenance->realization === 'internal')
                                                        <span class="font-bold text-green-500">Interne</span>
                                                    @else
                                                        <span class="font-bold text-yellow-500">Interne et Externe</span>
                                                    @endif
                                                </x-table.cell>
                                                <x-table.cell class="capitalize">
                                                    {{ $maintenance->started_at?->translatedFormat( 'D j M Y H:i') }}
                                                </x-table.cell>
                                            </x-table.row>
                                        @endforeach
                                    </x-slot>
                                </x-table.table>

                                <div class="grid grid-cols-1">
                                    {{ $maintenances->fragment('maintenances')->links() }}
                                </div>
                            @else
                                <div class="flex w-full overflow-hidden rounded-lg shadow-md bg-white z-10 text-left">
                                    <div class="flex items-center justify-center w-14 bg-green-500">
                                        <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg"><path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z"></path></svg>
                                    </div>
                                    <div class="relative px-2 py-2 w-full">
                                        <div class="mx-3">
                                            <span class="font-semibold text-green-500">Aucune maintenance</span>
                                            <p class="text-sm">
                                                Aucune maintenance active en cours !
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-4 mb-4">
        <div class="col-span-12">
            <div class="p-6 shadow-md border border-gray-200 rounded-lg h-full">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex-shrink-0">
                        <span class="text-xl font-bold sm:text-2xl">Pertes et Rendements</span>
                        <h3 class="hidden sm:block text-base font-light text-gray-500 ">Historique des Pertes et Rendements de chaque lots.</h3>
                    </div>
                    <div class="flex items-center justify-end text-5xl text-teal-500">
                        <i class="fa-solid fa-chart-simple"></i>
                    </div>
                </div>
                <div id="lots"></div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
	function tabs() {

        let activeTab = 'incidents';

        if (window.location.hash) {
            activeTab = window.location.hash.substring(1);
        } else {
            window.location.hash = activeTab;
        }

        return {
            activeTab: activeTab,
            tabs: {
                "incidents" : "Incidents",
                "maintenances" : "Maintenances"
            }
        };
    };
</script>

@endsection