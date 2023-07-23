@extends('layouts.app')
{!! config(['app.title' => 'Mon profil']) !!}

@push('meta')
    <x-meta title="Mon profil" />
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
    <div class="grid grid-cols-12 gap-6 mb-7">
        <div class="col-span-12 border border-gray-200 rounded-lg p-3">
            <h2 class="divider text-2xl font-selvah">
                Changer votre Mot de Passe
            </h2>
            @include('profile.partials.update-password-form')
        </div>
    </div>
</section>
@endsection
