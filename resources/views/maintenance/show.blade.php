@extends('layouts.app')
{!! config(['app.title' => 'Maintenance N° ' . $maintenance->getKey()]) !!}

@push('meta')
    <x-meta title="{{ 'Maintenance N° ' . $maintenance->getKey() }}" />
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
        <p class="text-gray-400 ">
            {{ $maintenance->description }}
        </p>
    </hgroup>

    <div class="flex flex-col text-center shadow-md border border-gray-200 rounded-lg p-6 w-full h-full">
        <div class="grid grid-cols-12 gap-4 mb-4 h-full">
            <div class="col-span-12 xl:col-span-4">
                <label>N° GMAO</label>
                <div class="prose">
                    <code class="text-[color:hsl(var(--p))] bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                    @if ($maintenance->gmao_id)
                        {{ $maintenance->gmao_id }}
                    @else
                        Aucune
                    @endif
                    </code>
                </div>
            </div>

            <div class="col-span-12 xl:col-span-4">
                <label>Matériel</label>
                <div class="prose">
                    @if ($maintenance->material_id)
                        <a class="link link-hover link-primary font-bold" href="{{ route('material.show', ['id' => $maintenance->material->id, 'slug' => $maintenance->material->slug]) }}">
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

            <div class="col-span-12 xl:col-span-4">
                <label>Créé par</label>
                <div class="prose">
                        <code class="text-[color:hsl(var(--p))] bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                            {{ $maintenance->user->username }}
                        </code>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-4 mb-4 h-full">
            <div class="col-span-12 xl:col-span-4">
                <label>Type</label>
                <div class="prose">
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

            <div class="col-span-12 xl:col-span-4">
                <label>Réalisation</label>
                <div class="prose">
                    @if ($maintenance->realization === 'external')
                        <code class="text-yellow-500 bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                        Externe
                    @else
                        <code class="text-green-500 bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                        Interne
                    @endif
                    </code>
                </div>
            </div>

            <div class="col-span-12 xl:col-span-4">
                <label>Réalisation Opérateurs</label>
                <div class="prose">
                    <code class="text-[color:hsl(var(--p))] bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                        {{ $maintenance->realization_operators }}
                    </code>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-4 mb-4 h-full">
            <div class="col-span-12 xl:col-span-4">
                <label>Commencée le</label>
                <div class="prose">
                    <code class="text-[color:hsl(var(--p))] bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                        {{ $maintenance->started_at?->translatedFormat( 'D j M Y H:i') }}
                    </code>
                </div>
            </div>

            <div class="col-span-12 xl:col-span-4">
                <label>Finie le</label>
                <div class="prose">
                    <code class="text-[color:hsl(var(--p))] bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                        {{ $maintenance->finished_at?->translatedFormat( 'D j M Y H:i') }}
                    </code>
                </div>
            </div>

            <div class="col-span-12 xl:col-span-4">
                <label>Mainteannce finie</label>
                <div class="prose">
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
        </div>

    </div>
</section>
@endsection
