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
                <div class="col-span-12 lg:col-span-6 h-full">
                    <div class="flex flex-col justify-between shadow-md border border-gray-200 rounded-lg p-6 h-full">
                        <i class="fa-solid fa-screwdriver-wrench text-[color:hsl(var(--er))] text-8xl"></i>
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

                <div class="col-span-12 lg:col-span-6 h-full">
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
            <div x-data="setup()">
                <ul class="tabs flex">
                    <template x-for="(tab, index) in tabs" :key="index">
                        <li class="cursor-pointer px-4 text-gray-500 border-b-8"
                            :class="activeTab===index ? 'tab tab-bordered tab-lg flex-auto tab-active' : 'tab tab-bordered tab-lg flex-auto'" @click="activeTab = index"
                            x-text="tab"></li>
                    </template>
                </ul>

                <div class="bg-white p-16 text-center mx-auto border rounded-lg">
                    <div x-show="activeTab===0">
                        Content
                    </div>
                    <div x-show="activeTab===1">
                        Content 2
                    </div>
                    <div x-show="activeTab===2">
                        Content 3
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
	function setup() {
        return {
            activeTab: 0,
            tabs: [
                "Pièces Détachées",
                "Fiches Maintenances",
                "Problèmes connus"
            ]
        };
    };
</script>
@endsection
