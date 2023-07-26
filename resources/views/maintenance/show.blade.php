@extends('layouts.app')
{!! config(['app.title' => 'Maintenance N° ' . $maintenance->getKey()]) !!}

@push('meta')
    <x-meta title="{{ 'Maintenance N° ' . $maintenance->getKey() }}" />
@endpush

@section('content')
<x-breadcrumbs :breadcrumbs="$breadcrumbs" />

<section class="m-3 lg:m-10">
    <hgroup class="text-center px-5 pb-5">
        <h1 class="text-4xl font-selvah">
            <div class="text-5xl">
                <i class="fa-solid fa-screwdriver-wrench"></i>
            </div>
            Maintenance N°
            <span class="prose text-4xl">
                <code class="text-[color:hsl(var(--p))] bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                    {{ $maintenance->getKey() }}
                </code>
            <span>
        </h1>
    </hgroup>

    <div class="flex flex-col shadow-md border rounded-lg p-6 w-full h-full border-gray-200 dark:border-gray-700 dark:bg-base-300">

        <div class="grid grid-cols-12 gap-4 mb-4 2xl:mb-8 h-full">
            <div class="col-span-12 md:col-span-6 2xl:col-span-4">
                <div class="inline-block font-bold min-w-[120px]">N° GMAO : </div>
                <div class="inline-block prose">
                    <code class="text-[color:hsl(var(--p))] bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                    @if ($maintenance->gmao_id)
                        {{ $maintenance->gmao_id }}
                    @else
                        Aucune
                    @endif
                    </code>
                </div>
            </div>

            <div class="col-span-12 md:col-span-6 2xl:col-span-4">
                <div class="inline-block font-bold min-w-[120px]">Matériel : </div>
                <div class="inline-block prose">
                    @if ($maintenance->material_id)
                        <a class="link link-hover link-primary font-bold" href="{{ $maintenance->material->show_url }}">
                        <code class="text-[color:hsl(var(--p))] bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                                {{ $maintenance->material->name }}
                            </code>
                        </a>
                    @else
                        <code class="text-[color:hsl(var(--p))] bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                            Aucun
                        </code>
                    @endif
                </div>
            </div>

            <div class="col-span-12 md:col-span-6 2xl:col-span-4">
                <div class="inline-block font-bold min-w-[120px]">Créé par : </div>
                <div class="inline-block prose">
                        <code class="text-[color:hsl(var(--p))] bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                            {{ $maintenance->user->username }}
                        </code>
                </div>
            </div>

            <div class="col-span-12 md:col-span-6 2xl:col-span-4">
                <div class="inline-block font-bold min-w-[120px]">Type : </div>
                <div class="inline-block prose">
                    @if ($maintenance->type === 'curative')
                        <code class="text-red-500 bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                        Curative
                    @else
                        <code class="text-green-500 bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                        Préventive
                    @endif
                    </code>
                </div>
            </div>

            <div class="col-span-12 md:col-span-6 2xl:col-span-4">
                <div class="inline-block font-bold min-w-[120px]">Réalisation : </div>
                <div class="inline-block prose">
                    @if ($maintenance->realization === 'external')
                        <code class="text-red-500 bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                        Externe
                    @elseif ($maintenance->realization === 'internal')
                        <code class="text-green-500 bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                        Interne
                    @else
                        <code class="text-yellow-500 bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                        Interne et Externe
                    @endif
                    </code>
                </div>
            </div>

            <div class="col-span-12 md:col-span-6 2xl:col-span-4">
                <div class="inline-block font-bold min-w-[120px]">Opérateurs : </div>
                <div class="inline-block prose">
                    <code class="text-[color:hsl(var(--p))] bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                        @forelse ($maintenance->operators as $operator)
                            {{ $operator->username }}@if (!$loop->last),@endif
                        @empty
                            <span class="text-gray-400">Aucun</span>
                        @endforelse
                    </code>
                </div>
            </div>

            <div class="col-span-12 md:col-span-6 2xl:col-span-4">
                <div class="inline-block font-bold min-w-[120px]">Commencée le : </div>
                <div class="inline-block prose">
                    <code class="text-[color:hsl(var(--p))] bg-[color:var(--tw-prose-pre-bg)] rounded-sm capitalize">
                        {{ $maintenance->started_at?->translatedFormat( 'D j M Y H:i') }}
                    </code>
                </div>
            </div>

            <div class="col-span-12 md:col-span-6 2xl:col-span-4">
                <div class="inline-block font-bold min-w-[120px]">Finie le : </div>
                <div class="inline-block prose">
                    <code class="text-[color:hsl(var(--p))] bg-[color:var(--tw-prose-pre-bg)] rounded-sm capitalize">
                        {{ $maintenance->finished_at?->translatedFormat( 'D j M Y H:i') }}
                    </code>
                </div>
            </div>

            <div class="col-span-12 md:col-span-6 2xl:col-span-4">
                <div class="inline-block font-bold min-w-[120px]">Terminée : </div>
                <div class="inline-block prose">
                    @if (is_null($maintenance->finished_at))
                        <code class="text-red-500 bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                        Non
                    @else
                        <code class="text-green-500 bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                        Oui
                    @endif
                    </code>
                </div>
            </div>

            <div class="col-span-12">
                <div class="font-bold">Entreprise(s) extérieure(s) intervenue(s): </div>
                <div>
                    @forelse ($maintenance->companies as $company)
                        <a class="link link-hover link-primary tooltip tooltip-right" href="{{ $company->show_url }}"  data-tip="Voir la fiche Entreprise"><span class="font-bold">{{ $company->name }}</span></a>@if (!$loop->last),@endif
                    @empty
                        <span class="text-gray-400">Aucune</span>
                    @endforelse
                </div>
            </div>

            <div class="col-span-12">
                <div class="font-bold">Description : </div>
                <div >
                    {{ $maintenance->description }}
                </div>
            </div>

            <div class="col-span-12">
                <div class="font-bold">Raison : </div>
                <div >
                    {{ $maintenance->reason }}
                </div>
            </div>

            <div class="col-span-12">
                <div class="font-bold">Pièce(s) détachée(s) sortie(s) du stock : </div>
                <x-table.table class="mb-6">
                    <x-slot name="head">
                        <x-table.heading>#Id</x-table.heading>
                        <x-table.heading>Maintenance n°</x-table.heading>
                        <x-table.heading>Pièce Détachée</x-table.heading>
                        <x-table.heading>Sortie par</x-table.heading>
                        <x-table.heading>Description</x-table.heading>
                        <x-table.heading>Nombre</x-table.heading>
                        <x-table.heading>Créé le</x-table.heading>
                    </x-slot>

                    <x-slot name="body">
                        @forelse($partExits as $partExit)
                            <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $partExit->getKey() }}">
                                <x-table.cell>{{ $partExit->getKey() }}</x-table.cell>
                                <x-table.cell>
                                    @unless (is_null($partExit->maintenance))
                                        <a class="link link-hover link-primary tooltip tooltip-right" href="{{ $partExit->maintenance->show_url }}"  data-tip="Voir la fiche Maintenance">
                                            <span class="font-bold">{{ $partExit->maintenance->getKey() }}</span>
                                        </a>
                                    @endunless
                                </x-table.cell>
                                <x-table.cell>
                                    <a class="link link-hover link-primary font-bold" href="{{ $partExit->part->show_url }}">
                                        {{ $partExit->part->name }}
                                    </a>
                                </x-table.cell>
                                <x-table.cell>{{ $partExit->user->username }}</x-table.cell>
                                <x-table.cell>
                                    <span class="tooltip tooltip-top" data-tip="{{ $partExit->description }}">
                                        {{ Str::limit($partExit->description, 50) }}
                                    </span>
                                </x-table.cell>
                                <x-table.cell class="prose">
                                    <code class="text-[color:hsl(var(--p))] bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                                        {{ $partExit->number }}
                                    </code>
                                </x-table.cell>
                                <x-table.cell class="capitalize">
                                    {{ $partExit->created_at->translatedFormat( 'D j M Y H:i') }}
                                </x-table.cell>
                            </x-table.row>
                        @empty
                            <x-table.row>
                                <x-table.cell colspan="17">
                                    <div class="text-center p-2">
                                        <span class="text-muted">Aucune sortie de pièce détachée trouvée pour cette maintenance...</span>
                                    </div>
                                </x-table.cell>
                            </x-table.row>
                        @endforelse
                    </x-slot>
                </x-table.table>

                <div class="grid grid-cols-1">
                    {{ $partExits->fragment('partExits')->links() }}
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
