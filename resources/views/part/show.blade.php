@extends('layouts.app')
{!! config(['app.title' => $part->name]) !!}

@push('meta')
    <x-meta title="{{ $part->name }}" />
@endpush

@section('content')
<x-breadcrumbs :breadcrumbs="$breadcrumbs" />

<section class="m-3 lg:m-10">
    <div class="grid grid-cols-12 gap-4 mb-4">
        <div class="col-span-12">
            <div class="grid grid-cols-12 gap-4 h-full">
                <div class="col-span-12 xl:col-span-9 h-full">
                    <div class="flex flex-col text-center shadow-md border rounded-lg p-6 w-full h-full border-gray-200 dark:border-gray-700 bg-base-100 dark:bg-base-300">
                        <div class="w-full">
                            <div class="text-5xl m-2 mb-4">
                                <i class="fa-solid fa-gear"></i>
                            </div>
                        </div>

                        <div class="w-full">
                            <h1 class="text-2xl xl:text-4xl font-selvah pb-2 mx-5 xl:border-dotted xl:border-b xl:border-slate-500">
                                {{ $part->name }}
                            </h1>
                            <p class="hidden xl:block py-2 mx-5 text-gray-400">
                                {{ $part->description }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-span-12 xl:col-span-3 h-full">
                    <div class="flex flex-col shadow-md border rounded-lg p-6 h-full border-gray-200 dark:border-gray-700 bg-base-100 dark:bg-base-300">
                        <div class="flex flex-col-reverse 2xl:flex-row justify-between">
                            <div class="text-2xl font-bold">
                                <h2 class="mb-4">
                                    Informations
                                </h2>
                            </div>
                            <div class="text-right">
                                @if (
                                    Gate::any(['update', 'generateQrCode'], \Selvah\Models\Part::class) ||
                                    Gate::any(['create'], \Selvah\Models\PartEntry::class) ||
                                    Gate::any(['create'], \Selvah\Models\PartExit::class))
                                    <div class="dropdown dropdown-end">
                                        <label tabindex="0" class="btn btn-neutral mb-2">
                                            Actions
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill align-bottom" viewBox="0 0 16 16">
                                                <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                                            </svg>
                                        </label>
                                        <ul tabindex="0" class="dropdown-content menu items-start p-2 shadow bg-base-100 rounded-box w-52 z-[1]">
                                            @can('update', \Selvah\Models\Part::class)
                                                <li class="w-full">
                                                    <a href="{{ route('parts.index', ['editid' => $part->getKey(), 'edit' => 'true']) }}" class="text-blue-500 tooltip tooltip-top text-left" data-tip="Modifier cette pièce détachée">
                                                        <i class="fa-solid fa-pen-to-square"></i> Modifier cette pièce
                                                    </a>
                                                </li>
                                            @endcan
                                            @can('generateQrCode', \Selvah\Models\Part::class)
                                                <li class="w-full">
                                                    <a href="{{ route('parts.index', ['qrcodeid' => $part->getKey(), 'qrcode' => 'true']) }}" class="text-purple-500 tooltip tooltip-top text-left" data-tip="Générer un QR Code pour cette pièce détachée">
                                                        <i class="fa-solid fa-qrcode"></i> Générer un QR Code
                                                    </a>
                                                </li>
                                            @endcan
                                            @can('create', \Selvah\Models\PartEntry::class)
                                                <li class="w-full">
                                                    <a href="{{ route('part-entries.index', ['qrcodeid' => $part->getKey(), 'qrcode' => 'true']) }}" class="text-green-500 tooltip tooltip-top text-left" data-tip="Créer une entrée pour cette pièce détachée">
                                                        <i class="fa-solid fa-arrow-right-to-bracket"></i> Créer une Entrée
                                                    </a>
                                                </li>
                                            @endcan
                                            @can('create', \Selvah\Models\PartExit::class)
                                                <li class="w-full">
                                                    <a href="{{ route('part-exits.index', ['qrcodeid' => $part->getKey(), 'qrcode' => 'true']) }}" class="text-yellow-500 tooltip tooltip-top text-left" data-tip="Créer une sortie pour cette pièce détachée">
                                                        <i class="fa-solid fa-right-from-bracket"></i> Créer une Sortie
                                                    </a>
                                                </li>
                                            @endcan
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>


                        <div class="grid grid-cols-12 gap-2 mb-4">
                            <div class="col-span-12">
                                <div class="inline-block font-bold min-w-[140px]">Référence : </div>
                                <div class="inline-block prose">
                                    @if ($part->reference)
                                        <code class="text-neutral-content bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                                            {{ $part->reference }}
                                        </code>
                                    @endif
                                </div>
                            </div>

                            <div class="col-span-12">
                                <div class="inline-block font-bold min-w-[140px]">Fournisseur : </div>
                                <div class="inline-block prose">
                                    @if ($part->supplier)
                                        <code class="text-neutral-content bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                                            {{ $part->supplier }}
                                        </code>
                                    @endif
                                </div>
                            </div>

                            <div class="col-span-12">
                                <div class="inline-block font-bold min-w-[140px]">Prix Unitaire : </div>
                                <div class="inline-block prose">
                                    @if ($part->price)
                                        <code class="text-neutral-content bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                                            {{ $part->price }}€
                                        </code>
                                    @endif
                                </div>
                            </div>

                            <div class="col-span-12">
                                <div class="inline-block font-bold min-w-[140px]">Alerte : </div>
                                <div class="inline-block prose">
                                    @if ($part->number_warning_enabled)
                                        <code class="font-bold text-red-500 bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                                            Oui
                                        </code>
                                    @else
                                        <code class="font-bold text-green-500 bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                                            Non
                                        </code>
                                    @endif
                                </div>
                            </div>

                            @if ($part->number_warning_enabled)
                            <div class="col-span-12">
                                <div class="inline-block font-bold min-w-[140px]">Nb mini alerte : </div>
                                <div class="inline-block prose">
                                    <code class="text-neutral-content bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                                        {{ number_format($part->number_warning_minimum) }}
                                    </code>
                                </div>
                            </div>
                            @endif

                            <div class="col-span-12">
                                <div class="inline-block font-bold min-w-[140px]">Alerte critique : </div>
                                <div class="inline-block prose">
                                    @if ($part->number_critical_enabled)
                                        <code class="font-bold text-red-500 bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                                            Oui
                                        </code>
                                    @else
                                        <code class="font-bold text-green-500 bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                                            Non
                                        </code>
                                    @endif
                                </div>
                            </div>


                            @if ($part->number_critical_enabled)
                                <div class="col-span-12">
                                    <div class="inline-block font-bold min-w-[140px]">Nb mini critique : </div>
                                    <div class="inline-block prose">
                                        <code class="text-neutral-content bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                                            {{ number_format($part->number_critical_minimum) }}
                                        </code>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-12">
            <div class="grid grid-cols-12 gap-4 text-center h-full">
                <div class="col-span-12 xl:col-span-2 h-full">
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
                        <i class="fa-solid fa-euro text-info text-8xl"></i>
                        <div>
                            <div class="font-bold text-2xl">
                                {{ number_format($part->stock_total * $part->price) }}€
                            </div>
                            <p class="text-muted font-selvah uppercase">
                                Prix des pièces en stock
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
                                            @if ($partEntry->order_id)
                                                <code class="text-neutral-content  bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                                                    {{ $partEntry->order_id}}
                                                </code>
                                            @endif
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
