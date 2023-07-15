@extends('layouts.app')
{!! config(['app.title' => 'Tableau de bord']) !!}

@push('meta')
    <x-meta title="Tableau de bord" />
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
        <div class="col-span-12 lg:col-span-6 xl:col-span-3">
            <div class="p-6 rounded-lg bg-error text-white h-full">
                <div class="flex justify-between">
                    <div class="text-2xl uppercase">
                        Incidents
                        <div class="dropdown dropdown-hover dropdown-bottom dropdown-end">
                            <label tabindex="0" class="hover:cursor-pointer text-info">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-4 h-4 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </label>
                            <div tabindex="0" class="card compact dropdown-content z-[1] shadow bg-base-100 rounded-box w-64">
                                <div class="card-body text-primary">
                                    <p>
                                        Sélectionnez le type de réalisation: <br/>
                                            <b>Interne</b> (Réalisé par un opérateur SELVAH)<br/>
                                            <b>Externe</b> (Réalisé par une entreprise extérieur)<br/>
                                            <b>Interne et Externe</b> (Réalisé par une entreprise extérieur et un/des opérateur(s) SELVAH)
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <i class="fa-solid fa-triangle-exclamation opacity-50 text-5xl"></i>
                    </div>
                </div>
                <div class="text-4xl font-bold">
                    {{ $incidentsCount }}
                    @if ($percent < 0)
                        <span class="text-success tooltip" data-tip="{{ $percent }}% d'incidents le mois de {{ \Carbon\Carbon::now()->subMonth()->translatedFormat('F'); }} dernier par rapport au mois de {{ \Carbon\Carbon::now()->subMonth(2)->translatedFormat('F'); }}.">({{ $percent }}%)</span>
                    @else
                        <span class="text-red-500 tooltip" data-tip="+{{ $percent }}% d'incidents le mois de {{ \Carbon\Carbon::now()->subMonth()->translatedFormat('F'); }} dernier par rapport au mois de {{ \Carbon\Carbon::now()->subMonth(2)->translatedFormat('F'); }}.">+({{ $percent }}%)</span>
                    @endif

                </div>
                <div class="divider"></div>
                <span class="opacity-70">
                    The nombre d'incidents total de l'usine.
                </span>
            </div>
        </div>

    </div>
</section>

@endsection
