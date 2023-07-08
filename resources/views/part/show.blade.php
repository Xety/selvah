@extends('layouts.app')
{!! config(['app.title' => $part->name]) !!}

@push('meta')
    <x-meta title="{{ $part->name }}" />
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
        <div class="col-span-12 lg:col-span-3 mx-3 lg:mx-0">
            <div class="flex flex-col sm:flex-row text-center shadow-md border border-gray-200 rounded-lg p-6 w-full h-full">

                <div class="w-full md:w-1/2">
                    <div class="text-8xl mb-2 m-2">
                        <i class="fa-solid fa-gear"></i>
                    </div>
                </div>

                <div class="w-full md:w-1/2">
                    <h1 class="text-4xl font-selvah pb-2 mx-5 border-dotted border-b border-slate-500">
                        {{ $part->name }}
                    </h1>
                    <p class="py-2 mx-5 border-slate-500 text-gray-400">
                        {{ $part->description }}
                    </p>
                </div>
            </div>
        </div>

        <div class="col-span-12 lg:col-span-9">
            <div class="grid grid-cols-12 gap-4 text-center h-full mx-3 lg:mx-0">
                <div class="col-span-12 lg:col-span-4 h-full">
                    <div class="flex flex-col justify-between shadow-md border border-gray-200 rounded-lg p-6 h-full">
                        <i class="fa-solid fa-microchip text-primary text-8xl"></i>
                        <div>
                            <div class="text-muted text-xl">
                                 Matériel
                            </div>
                            <p class="font-bold font-selvah uppercase">
                                @unless (is_null($part->material_id))
                                    <a class="link link-hover link-primary font-bold" href="{{ route('material.show', ['id' => $part->material->id, 'slug' => $part->material->slug]) }}">
                                        {{ $part->material->name }}
                                    </a>
                                @endunless
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-span-12 lg:col-span-4 h-full">
                    <div class="flex flex-col justify-between shadow-md border border-gray-200 rounded-lg p-6 h-full">
                        <i class="fa-solid fa-arrow-right-to-bracket text-success text-8xl"></i>
                        <div>
                            <div class="font-bold text-2xl">
                                {{ $part->part_entry_count }}
                            </div>
                            <p class="text-muted font-selvah uppercase">
                                Entrées de pièces
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-span-12 lg:col-span-4 h-full">
                    <div class="flex flex-col justify-between shadow-md border border-gray-200 rounded-lg p-6 h-full">
                        <i class="fa-solid fa-right-from-bracket text-error text-8xl"></i>
                        <div>
                            <div class="font-bold text-2xl">
                                {{ $part->part_exit_count }}
                            </div>
                            <p class="text-muted font-selvah uppercase">
                                Sorties de pièces
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-6 mb-7">
        <div class="col-span-12 bg-base-200 border border-gray-200 rounded-lg p-3">

        </div>
    </div>
</section>
@endsection
