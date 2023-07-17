@extends('layouts.app')
{!! config(['app.title' => 'Gérer les Lots']) !!}

@push('meta')
    <x-meta title="Gérer les Lots" />
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
    <hgroup class="text-center px-5 pb-5">
        <h1 class="text-4xl font-selvah">
            Gestion des Lots
        </h1>
        <p class="text-gray-400 ">
            Gérer les lots de l'usine.
        </p>
    </hgroup>

    <div class="grid grid-cols-12 gap-6 mb-7">
        <div class="col-span-12 bg-base-200 border border-gray-200 rounded-lg p-3">
            <livewire:lots />
        </div>
    </div>
</section>
@endsection
