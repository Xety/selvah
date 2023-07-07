@extends('layouts.app')
{!! config(['app.title' => $material->name]) !!}

@push('meta')
    <x-meta title="{{ $material->name }}" />
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
        <div class="col-span-12 lg:col-span-5 mx-3 lg:mx-0">
            <div class="flex flex-col sm:flex-row text-center shadow-md border border-gray-200 rounded-lg p-6 w-full h-full">

                <div class="w-full md:w-1/2">
                    <div class="text-8xl mb-2 m-2">
                        <i class="fa-solid fa-microchip"></i>
                    </div>
                </div>

                <div class="w-full md:w-1/2">
                    <h1 class="text-4xl font-selvah pb-2 mx-5 border-dotted border-b border-slate-500">
                        {{ $material->name }}
                    </h1>
                    <p class="py-2 mx-5 border-slate-500 text-gray-400">
                        {{ $material->description }}
                    </p>
                </div>
            </div>
        </div>

        <div class="col-span-12 lg:col-span-7">
            <div class="grid grid-cols-12 gap-4 text-center h-full mx-3 lg:mx-0">
                <div class="col-span-12 lg:col-span-4 h-full">
                    <div class="flex flex-col justify-between shadow-md border border-gray-200 rounded-lg p-6 h-full">
                        <i class="fa-solid fa-triangle-exclamation text-[color:hsl(var(--er))] text-8xl"></i>
                        <div>
                            <div class="font-bold text-2xl">
                                 {{ $material->incident_count }}
                            </div>
                            <p class="text-muted font-selvah uppercase">
                                Incidents
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-span-12 lg:col-span-4 h-full">
                    <div class="flex flex-col justify-between shadow-md border border-gray-200 rounded-lg p-6 h-full">
                        <i class="fa-solid fa-screwdriver-wrench text-[color:hsl(var(--wa))] text-8xl"></i>
                        <div>
                            <div class="font-bold text-2xl">
                                {{ $material->maintenance_count }}
                            </div>
                            <p class="text-muted font-selvah uppercase">
                                Maintenances
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-span-12 lg:col-span-4 h-full">
                    <div class="flex flex-col justify-between shadow-md border border-gray-200 rounded-lg p-6 h-full">
                        <i class="fa-solid fa-gear text-primary text-8xl"></i>
                        <div>
                            <div class="font-bold text-2xl">
                                {{ $material->part_count }}
                            </div>
                            <p class="text-muted font-selvah uppercase">
                                Pièces Détachées
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-6 mb-7">
        <div class="col-span-12 bg-base-200 border border-gray-200 rounded-lg p-3">
            <div x-data="tabs()">
                <ul class="tabs flex">
                    <template x-for="(tab, index) in tabs" :key="index">
                        <li class="cursor-pointer px-4 text-gray-500 border-b-8"
                            :class="activeTab === index ? 'tab tab-bordered tab-lg flex-auto tab-active' : 'tab tab-bordered tab-lg flex-auto'" @click="activeTab = index; window.location.hash = index"
                            x-text="tab"></li>
                    </template>
                </ul>

                <div class="p-16 text-center mx-auto">
                    <div class="" x-show="activeTab === 'parts'">
                        <x-table.table class="mb-6">
                            <x-slot name="head">
                                <x-table.heading>#Id</x-table.heading>
                                <x-table.heading>Name</x-table.heading>
                                <x-table.heading>Matériel</x-table.heading>
                                <x-table.heading>Description</x-table.heading>
                                <x-table.heading>Référence</x-table.heading>
                                <x-table.heading>Fournisseur</x-table.heading>
                                <x-table.heading>Prix Unitaire</x-table.heading>
                                <x-table.heading>Nombre en stock</x-table.heading>
                                <x-table.heading>Alerte activée</x-table.heading>
                                <x-table.heading>Alerte critique activée</x-table.heading>
                                <x-table.heading>Nombre de pièces entrées</x-table.heading>
                                <x-table.heading>Nombre de pièces sorties</x-table.heading>
                                <x-table.heading>Créé le</x-table.heading>
                            </x-slot>

                            <x-slot name="body">
                                @forelse($parts as $part)
                                    <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $part->getKey() }}">
                                        <x-table.cell>{{ $part->getKey() }}</x-table.cell>
                                        <x-table.cell>
                                            <a class="link link-hover link-primary font-bold" href="{{ route('part.index', ['f' => 'created_at', 'd' => 'desc', 's' => $part->name]) }}">
                                                {{ $part->name }}
                                            </a>
                                        </x-table.cell>
                                        <x-table.cell>{{ $part->material->name }}</x-table.cell>
                                        <x-table.cell>
                                            {{ Str::limit($part->description, 150) }}
                                        </x-table.cell>
                                        <x-table.cell class="prose">
                                            <code class="text-[color:hsl(var(--p))] bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                                                {{ $part->reference}}
                                            </code>
                                        </x-table.cell>
                                        <x-table.cell>{{ $part->supplier }}</x-table.cell>
                                        <x-table.cell class="prose">
                                            <code class="text-[color:hsl(var(--p))] bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                                                {{ $part->price }}€
                                            </code>
                                        </x-table.cell>
                                        <x-table.cell class="prose">
                                            <code class="text-[color:hsl(var(--p))] bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                                                {{ $part->number }}
                                            </code>
                                        </x-table.cell>
                                        <x-table.cell>
                                            @if ($part->number_warning_enabled)
                                                <span class="font-bold text-red-500">Oui</span>
                                            @else
                                                <span class="font-bold text-green-500">Non</span>
                                            @endif
                                        </x-table.cell>
                                        <x-table.cell>
                                            @if ($part->number_critical_enabled)
                                                <span class="font-bold text-red-500">Oui</span>
                                            @else
                                                <span class="font-bold text-green-500">Non</span>
                                            @endif
                                        </x-table.cell>
                                        <x-table.cell class="prose">
                                            <code class="text-[color:hsl(var(--p))] bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                                                {{ $part->part_entry_count }}
                                            </code>
                                        </x-table.cell>
                                        <x-table.cell class="prose">
                                            <code class="text-[color:hsl(var(--p))] bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                                                {{ $part->part_exit_count }}
                                            </code>
                                        </x-table.cell>
                                        <x-table.cell>{{ $part->created_at->formatLocalized('%d %B %Y - %T') }}</x-table.cell>
                                    </x-table.row>
                                @empty
                                    <x-table.row>
                                        <x-table.cell colspan="17">
                                            <div class="text-center p-2">
                                                <span class="text-muted">Aucune pièce détachée trouvée pour le {{ $material->name }}...</span>
                                            </div>
                                        </x-table.cell>
                                    </x-table.row>
                                @endforelse
                            </x-slot>
                        </x-table.table>

                        <div class="grid grid-cols-1">
                            {{ $parts->fragment('parts')->links() }}
                        </div>

                    </div>
                    <div x-show="activeTab === 'maintenances'" style="display:none">
                        Maintenances
                    </div>
                    <div x-show="activeTab === 'incidents'" style="display:none">
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
                                <x-table.heading>Résolu le</x-table.heading>
                            </x-slot>

                            <x-slot name="body">
                                @forelse($incidents as $incident)
                                    <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $incident->getKey() }}">
                                        <x-table.cell>{{ $incident->getKey() }}</x-table.cell>
                                        <x-table.cell>
                                            <a class="link link-hover link-primary font-bold" href="{{ route('material.show', ['id' => $incident->material->id, 'slug' => $incident->material->slug]) }}">
                                                {{ $incident->material->name }}
                                            </a>
                                        </x-table.cell>
                                        <x-table.cell>{{ $incident->material->zone->name }}</x-table.cell>
                                        <x-table.cell>{{ $incident->user->username }}</x-table.cell>
                                        <x-table.cell>{{ Str::limit($incident->description, 150) }}</x-table.cell>
                                        <x-table.cell>{{ $incident->incident_at->formatLocalized('%d %B %Y - %T') }}</x-table.cell>
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
                                            @if ($incident->resolu)
                                                <span class="font-bold text-green-500">Oui</span>
                                            @else
                                                <span class="font-bold text-red-500">Non</span>
                                            @endif
                                        </x-table.cell>
                                        <x-table.cell>{{ $incident->solved_at?->formatLocalized('%d %B %Y - %T') }}</x-table.cell>
                                    </x-table.row>
                                @empty
                                    <x-table.row>
                                        <x-table.cell colspan="11">
                                            <div class="text-center p-2">
                                                <span class="text-muted">Aucun incident trouvé pour le {{ $material->name }}...</span>
                                            </div>
                                        </x-table.cell>
                                    </x-table.row>
                                @endforelse
                            </x-slot>
                        </x-table.table>

                        <div class="grid grid-cols-1">
                            {{ $incidents->fragment('incidents')->links() }}
                        </div>
                    </div>

                    <div x-show="activeTab === 'problems'" style="display:none">
                        <div class="flex w-full overflow-hidden rounded-lg shadow-md bg-white z-10 text-left">
                            <div class="flex items-center justify-center w-12 bg-blue-500">
                                <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg"><path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z"></path></svg>
                            </div>
                            <div class="px-4 py-2 -mx-3">
                                <div class="mx-3">
                                    <span class="font-semibold text-blue-500">Info</span>
                                    <p class="text-sm">A venir plus tard...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
	function tabs() {

        let activeTab = 'parts';

        if (window.location.hash) {
            activeTab = window.location.hash.substring(1);
        } else {
            window.location.hash = activeTab;
        }

        return {
            activeTab: activeTab,
            tabs: {
                "parts" : "Pièces Détachées",
                "maintenances" : "Fiches Maintenances",
                "incidents" : "Incidents",
                "problems" : "Problèmes connus"
            }
        };
    };
</script>
@endsection
