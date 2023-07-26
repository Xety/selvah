@extends('layouts.app')
{!! config(['app.title' => 'Gérer les Sorties']) !!}

@push('meta')
    <x-meta title="Gérer les Sorties" />
@endpush

@section('content')
<x-breadcrumbs :breadcrumbs="$breadcrumbs" />

<section class="m-3 lg:m-10">
    <hgroup class="text-center px-5 pb-5">
        <h1 class="text-4xl font-selvah">
            <i class="fa-solid fa-right-from-bracket"></i> Gestion des Sorties
        </h1>
        <p class="text-gray-400 ">
            Gérer les sorties des pièces détachées de l'usine.
        </p>
    </hgroup>

    <div class="grid grid-cols-12 gap-6 mb-7">
        <div class="col-span-12 shadow-md border border-gray-200 dark:border-gray-700 rounded-lg p-3 dark:bg-base-300">
            <livewire:part-exits />
        </div>
    </div>
</section>
@endsection
