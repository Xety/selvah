@extends('layouts.app')
{!! config(['app.title' => $part->name]) !!}

@push('meta')
    <x-meta title="{{ $part->name }}" />
@endpush

@section('content')
<x-breadcrumbs :breadcrumbs="$breadcrumbs" />

<section class="m-3 lg:m-10">
    <div class="grid grid-cols-12 gap-4 mb-4">
        <div class="col-span-12 2xl:col-span-3">
            <div class="flex flex-col 2xl:flex-row text-center shadow-md border rounded-lg p-6 w-full h-full border-gray-200 dark:border-gray-700 bg-base-100 dark:bg-base-300">

                <div class="w-full 2xl:w-1/3">
                    <div class="text-5xl m-2 mb-4 2xl:text-8xl 2xl:mb-2">
                        <i class="fa-solid fa-gear"></i>
                    </div>
                </div>

                <div class="w-full 2xl:w-2/3">
                    <h1 class="text-2xl font-selvah pb-2 mx-5 2xl:border-dotted 2xl:border-b 2xl:border-slate-500">
                        {{ $part->name }}
                    </h1>
                    <p class="hidden xl:block py-2 mx-5 text-gray-400">
                        {{ $part->description }}
                    </p>
                </div>
            </div>
        </div>

        <div class="col-span-12 2xl:col-span-9">
            <div class="grid grid-cols-12 gap-4 text-center h-full">
                <div class="col-span-12 xl:col-span-4 h-full">
                    <div class="flex flex-col justify-between shadow-md border rounded-lg p-6 h-full border-gray-200 dark:border-gray-700 bg-base-100 dark:bg-base-300">
                        <i class="fa-solid fa-microchip text-primary text-8xl"></i>
                        <div>
                            <div class="text-muted text-xl">
                                 Matériel
                            </div>
                            <p class="font-bold font-selvah uppercase">
                                @unless (is_null($part->material_id))
                                    <a class="link link-hover link-primary font-bold" href="{{ $part->material->show_url }}">
                                        {{ $part->material->name }}
                                    </a>
                                @endunless
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-span-12 xl:col-span-2 h-full">
                    <div class="flex flex-col justify-between shadow-md border rounded-lg p-6 h-full border-gray-200 dark:border-gray-700 bg-base-100 dark:bg-base-300">
                        <i class="fa-solid fa-cubes-stacked text-success text-8xl"></i>
                        <div>
                            <div class="font-bold text-2xl">
                                {{ $part->stock_total }}
                            </div>
                            <p class="text-muted font-selvah uppercase">
                                Nombre(s) en stock
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-span-12 xl:col-span-2 h-full">
                    <div class="flex flex-col justify-between shadow-md border rounded-lg p-6 h-full border-gray-200 dark:border-gray-700 bg-base-100 dark:bg-base-300">
                        <i class="fa-solid fa-arrow-right-to-bracket text-warning text-8xl"></i>
                        <div>
                            <div class="font-bold text-2xl">
                                {{ $part->part_entry_count }}
                            </div>
                            <p class="text-muted font-selvah uppercase">
                                Entrée(s) de pièce(s)
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-span-12 xl:col-span-2 h-full">
                    <div class="flex flex-col justify-between shadow-md border rounded-lg p-6 h-full border-gray-200 dark:border-gray-700 bg-base-100 dark:bg-base-300">
                        <i class="fa-solid fa-right-from-bracket text-error text-8xl"></i>
                        <div>
                            <div class="font-bold text-2xl">
                                {{ $part->part_exit_count }}
                            </div>
                            <p class="text-muted font-selvah uppercase">
                                Sortie(s) de pièce(s)
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-span-12 xl:col-span-2 h-full">
                    <div class="flex flex-col justify-between shadow-md border rounded-lg p-6 h-full border-gray-200 dark:border-gray-700 bg-base-100 dark:bg-base-300">
                        <i class="fa-solid fa-qrcode text-purple-600 text-8xl"></i>
                        <div>
                            <div class="font-bold text-2xl">
                                {{ $part->qrcode_flash_count }}
                            </div>
                            <p class="text-muted font-selvah uppercase">
                                Nombre de flash QR Code
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-6 mb-7">
        <div class="col-span-12 border rounded-lg p-3 border-gray-200 dark:border-gray-700 bg-base-100 dark:bg-base-300">

                <part-tabs>
                    <template v-slot:part-entries>
                        <x-table.table class="mb-6">
                            <x-slot name="head">
                                <x-table.heading>#Id</x-table.heading>
                                <x-table.heading>Pièce Détachée</x-table.heading>
                                <x-table.heading>Entrée par</x-table.heading>
                                <x-table.heading>Nombre</x-table.heading>
                                <x-table.heading>Commande n°</x-table.heading>
                                <x-table.heading>Créé le</x-table.heading>
                            </x-slot>

                            <x-slot name="body">
                                @forelse($partEntries as $partEntry)
                                    <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $partEntry->getKey() }}">
                                        <x-table.cell>{{ $partEntry->getKey() }}</x-table.cell>
                                        <x-table.cell>
                                            <a class="link link-hover link-primary font-bold" href="{{ $partEntry->part->show_url }}">
                                                {{ $partEntry->part->name }}
                                            </a>
                                        </x-table.cell>
                                        <x-table.cell>{{ $partEntry->user->username }}</x-table.cell>
                                        <x-table.cell class="prose">
                                            <code class="text-neutral-content bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                                                {{ $partEntry->number }}
                                            </code>
                                        </x-table.cell>
                                        <x-table.cell class="prose">
                                            <code class="text-neutral-content bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                                                {{ $partEntry->order_id}}
                                            </code>
                                        </x-table.cell>
                                        <x-table.cell class="capitalize">
                                            {{ $partEntry->created_at->translatedFormat( 'D j M Y H:i') }}
                                        </x-table.cell>
                                    </x-table.row>
                                @empty
                                    <x-table.row>
                                        <x-table.cell colspan="17">
                                            <div class="text-center p-2">
                                                <span class="text-muted">Aucune entrée trouvée pour la pièce détachée {{ $part->name }}...</span>
                                            </div>
                                        </x-table.cell>
                                    </x-table.row>
                                @endforelse
                            </x-slot>
                        </x-table.table>

                        <div class="grid grid-cols-1">
                            {{ $partEntries->fragment('partEntries')->links() }}
                        </div>
                    </template>

                    <template v-slot:part-exits>
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
                                            <span class="tooltip tooltip-top" data-tip="{{ $part->description }}">
                                                {{ Str::limit($partExit->description, 50) }}
                                            </span>
                                        </x-table.cell>
                                        <x-table.cell class="prose">
                                            <code class="text-neutral-content bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
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
                                                <span class="text-muted">Aucune sortie trouvée pour la pièce détachée {{ $part->name }}...</span>
                                            </div>
                                        </x-table.cell>
                                    </x-table.row>
                                @endforelse
                            </x-slot>
                        </x-table.table>

                        <div class="grid grid-cols-1">
                            {{ $partExits->fragment('partExits')->links() }}
                        </div>
                    </template>
                </part-tabs>

        </div>
    </div>
</section>
@endsection
