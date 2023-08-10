<div>
    @push('scripts')
        <script type="text/javascript">
            Livewire.on('alert', () => {
                document.querySelectorAll('[data-dismiss-target]').forEach(triggerEl => {
                    const targetEl = document.querySelector(triggerEl.getAttribute('data-dismiss-target'))

                    new Dismiss(targetEl, {
                        triggerEl
                    })
                });
            });
        </script>
    @endpush
    @include('elements.flash')

    <div class="flex flex-col lg:flex-row gap-6 justify-between">
        <div class="mb-4 w-full lg:w-auto lg:min-w-[350px]">
            <x-form.text wire:model="search" placeholder="Rechercher des lots..." class="lg:max-w-lg" />
        </div>
        <div class="mb-4">
            @canany(['export', 'delete'], \Selvah\Models\Lot::class)
                <div class="dropdown lg:dropdown-end">
                    <label tabindex="0" class="btn btn-neutral m-1">
                        Actions
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill align-bottom" viewBox="0 0 16 16">
                            <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                        </svg>
                    </label>
                    <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52 z-[1]">
                        @can('delete', \Selvah\Models\Lot::class)
                            <li>
                                <button type="button" class="text-red-500" wire:click="$toggle('showDeleteModal')">
                                    <i class="fa-solid fa-trash-can"></i> Supprimer
                                </button>
                            </li>
                        @endcan
                    </ul>
                </div>
            @endcanany

            @can('create', \Selvah\Models\Lot::class)
                <a href="#" wire:click.prevent="create" class="btn btn-success gap-2">
                    <i class="fa-solid fa-plus"></i>
                    Nouveau Lot
                </a>
            @endcan
        </div>
    </div>

    <x-table.table class="mb-6">
        <x-slot name="head">
            @canany(['delete'], \Selvah\Models\Lot::class)
                <x-table.heading>
                    <label>
                        <input type="checkbox" class="checkbox" wire:model="selectPage" />
                    </label>
                </x-table.heading>
            @endcanany
            @can('update', \Selvah\Models\Lot::class)
                <x-table.heading>Actions</x-table.heading>
            @endcan
            <x-table.heading sortable wire:click="sortBy('number')" :direction="$sortField === 'number' ? $sortDirection : null">Numéro de Lot</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('crushed_seeds')" :direction="$sortField === 'crushed_seeds' ? $sortDirection : null">Graines Broyées (Kg)</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('crude_oil_production')" :direction="$sortField === 'crude_oil_production' ? $sortDirection : null">Production huile<br/> brute (Kg)</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('soy_hull')" :direction="$sortField === 'soy_hull' ? $sortDirection : null">Production<br/> coques (Kg)</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('extruded_flour')" :direction="$sortField === 'extruded_flour' ? $sortDirection : null">Tonnage farine<br/> extrudée (Kg)</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('bagged_tvp')" :direction="$sortField === 'bagged_tvp' ? $sortDirection : null">Tonnage ensaché (Kg)</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('compliant_bagged_tvp')" :direction="$sortField === 'compliant_bagged_tvp' ? $sortDirection : null">Tonnage ensaché<br/> conforme (Kg)</x-table.heading>
        </x-slot>

        <x-slot name="body">
            @if ($selectPage)
            <x-table.row wire:key="row-message">
                <x-table.cell colspan="9">
                    @unless ($selectAll)
                    <div>
                        <span>Vous avez sélectionné <strong>{{ $lots->count() }}</strong> lot(s), voulez-vous tous les selectionner <strong>{{ $lots->total() }}</strong>?</span>
                        <button type="button" wire:click="selectAll" class="btn btn-neutral btn-sm gap-2 ml-1">
                            <i class="fa-solid fa-check"></i>
                            Tout sélectionner
                        </button>
                    </div>
                    @else
                    <span>Vous sélectionnez actuellement <strong>{{ $lots->total() }}</strong> lot(s).</span>
                    @endif
                </x-table.cell>
            </x-table.row>
            @endif

            @forelse($lots as $lot)
                <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $lot->getKey() }}">
                    @canany(['delete'], \Selvah\Models\Lot::class)
                        <x-table.cell>
                            <label>
                                <input type="checkbox" class="checkbox" wire:model="selected" value="{{ $lot->getKey() }}" />
                            </label>
                        </x-table.cell>
                    @endcanany
                    @can('update', \Selvah\Models\Lot::class)
                        <x-table.cell>
                            <a href="#" wire:click.prevent="edit({{ $lot->getKey() }})" class="tooltip tooltip-right" data-tip="Modifier ce lot">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </x-table.cell>
                    @endcan
                    <x-table.cell class="prose">
                        <code class="text-neutral-content  bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                            {{ $lot->number }}
                        </code>
                    </x-table.cell>
                    <x-table.cell>
                        <span class="font-bold">
                            {{ number_format($lot->crushed_seeds) }}
                        </span>
                    </x-table.cell>
                    <x-table.cell>
                        <span class="font-bold">
                            {{ number_format($lot->crude_oil_production) }}
                        </span>
                    </x-table.cell>
                    <x-table.cell>
                        <span class="font-bold">
                            {{ number_format($lot->soy_hull) }}
                        </span>
                    </x-table.cell>
                    <x-table.cell>
                        <span class="font-bold">
                            {{ number_format($lot->extruded_flour) }}
                        </span>
                    </x-table.cell>
                    <x-table.cell>
                        <span class="font-bold">
                            {{ number_format($lot->bagged_tvp, 1) }}
                        </span>
                    </x-table.cell>
                    <x-table.cell>
                        <span class="font-bold">
                            {{ number_format($lot->compliant_bagged_tvp, 1) }}
                        </span>
                    </x-table.cell>
                </x-table.row>
            @empty
                <x-table.row>
                    <x-table.cell colspan="9">
                        <div class="text-center p-2">
                            <span class="text-muted">Aucun lot trouvé...</span>
                        </div>
                    </x-table.cell>
                </x-table.row>
            @endforelse
        </x-slot>
    </x-table.table>

    <div class="grid grid-cols-1">
        {{ $lots->links() }}
    </div>


    <!-- Delete Lots Modal -->
    <form wire:submit.prevent="deleteSelected">
        <input type="checkbox" id="deleteModal" class="modal-toggle" wire:model="showDeleteModal" />
        <label for="deleteModal" class="modal cursor-pointer">
            <label class="modal-box relative">
                <label for="deleteModal" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                <h3 class="font-bold text-lg">
                    Supprimer des Lots
                </h3>
                @if (empty($selected))
                    <p class="my-7">
                        Vous n'avez sélectionné aucun lot à supprimer.
                    </p>
                @else
                    <p class="my-7">
                        Voulez-vous vraiment supprimer ces lots ? <span class="font-bold text-red-500">Cette opération n'est pas réversible.</span>
                    </p>
                @endif
                <div class="modal-action">
                    <button type="submit" class="btn btn-error gap-2" @if (empty($selected)) disabled @endif>
                        <i class="fa-solid fa-trash-can"></i>
                        Supprimer
                    </button>
                    <label for="deleteModal" class="btn btn-neutral">Fermer</label>
                </div>
            </label>
        </label>
    </form>

    <!-- Edit Lot Modal -->
    <form wire:submit.prevent="save">
        <input type="checkbox" id="editModal" class="modal-toggle" wire:model="showModal" />
        <label for="editModal" class="modal cursor-pointer">
            <label class="modal-box relative">
                <label for="editModal" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                <h3 class="font-bold text-lg">
                    {!! $isCreating ? 'Créer un Lot' : 'Editer le Lot' !!}
                </h3>

                <x-form.text wire:model.defer="model.number" name="model.number" label="N° de lot" placeholder="519-XXX..." />

                @php $message = "Si vous avez des informations spécifiques liées au lot, veuillez les ajouter ici.";@endphp
                <x-form.textarea wire:model.defer="model.description" name="model.description" label="Description" placeholder="Description du lot..." :info="true" :infoText="$message" />

                @php $message = "Tonnage total de la graines broyées en kilos.";@endphp
                <x-form.number wire:model.defer="model.crushed_seeds" name="model.crushed_seeds" label="Graines Broyées (Kg)" placeholder="Graines Broyées..." :info="true" :infoText="$message" />

                @php $message = "Année de la récolte de la graine.";@endphp
                <x-form.number wire:model.defer="model.harvest" name="model.harvest" label="Année de la récolte" placeholder="Année..." :info="true" :infoText="$message" />

                 @php $message = "Date à laquelle la trituration à commencée.";@endphp
                <x-form.date wire:model.defer="crushedSeedsStartedAt" name="crushedSeedsStartedAt" label="Trituration commencé le" placeholder="Trituration commencé le..." :info="true" :infoText="$message" value="{{ $crushedSeedsStartedAt }}" />

                 @php $message = "Date à laquelle la trituration à finie.";@endphp
                <x-form.date wire:model.defer="crushedSeedsFinishedAt" name="crushedSeedsFinishedAt" label="Trituration finie le" placeholder="Trituration finie le..." :info="true" :infoText="$message" value="{{ $crushedSeedsFinishedAt }}" />

                @php $message = "Quantité d'huile brute produite en kilos.";@endphp
                <x-form.number wire:model.defer="model.crude_oil_production" name="model.crude_oil_production" label="Production huile brute (Kg)" placeholder="Production huile brute..." :info="true" :infoText="$message" />

                @php $message = "Quantité de coques produite en kilos.";@endphp
                <x-form.number wire:model.defer="model.soy_hull" name="model.soy_hull" label="Production coques (Kg)" placeholder="Production coques..." :info="true" :infoText="$message" />

                @php $message = "Date à laquelle l'extrusion à commencée.";@endphp
                <x-form.date wire:model.defer="extrusionStartedAt" name="extrusionStartedAt" label="Extrusion commencé le" placeholder="Extrusion commencé le..." :info="true" :infoText="$message" value="{{ $extrusionStartedAt }}" />

                 @php $message = "Date à laquelle l'extrusion à finie.";@endphp
                <x-form.date wire:model.defer="extrusionFinishedAt" name="extrusionFinishedAt" label="Extrusion finie le" placeholder="Extrusion finie le..." :info="true" :infoText="$message" value="{{ $extrusionFinishedAt }}" />

                @php $message = "Quantité de farine extrudée en kilos.";@endphp
                <x-form.number wire:model.defer="model.extruded_flour" name="model.extruded_flour" label="Farine extrudée (Kg)" placeholder="Farine extrudée..." :info="true" :infoText="$message" />

                @php $message = "Quantité de PVT ensaché en kilos.";@endphp
                <x-form.number step="0.5" wire:model.defer="model.bagged_tvp" name="model.bagged_tvp" label="PVT Ensachés (Kg)" placeholder="PVT Ensachés..." :info="true" :infoText="$message" />

                @php $message = "Quantité de PVT ensaché conforme en kilos.";@endphp
                <x-form.number step="0.5" wire:model.defer="model.compliant_bagged_tvp" name="model.compliant_bagged_tvp" label="PVT Ensachés Conformes (Kg)" placeholder="PVT Ensachés Conformes..." :info="true" :infoText="$message" />

                <div class="modal-action">
                    <button type="submit" class="btn btn-success gap-2">
                        {!! $isCreating ? '<i class="fa-solid fa-plus"></i> Créer' : '<i class="fa-solid fa-pen-to-square"></i> Editer' !!}
                    </button>
                    <label for="editModal" class="btn btn-neutral">Fermer</label>
                </div>
            </label>
        </label>
    </form>

</div>
