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
        <div class="flex flex-col lg:flex-row  gap-4 mb-2">
            <x-form.text wire:model="filters.search" placeholder="Rechercher des Incidents..." class="lg:max-w-lg" />
            <button type="button" wire:click="$toggle('showFilters')" class="btn">
                <i class="fa-solid fa-magnifying-glass"></i>@if ($showFilters) Cacher la @endif Recherche Avancée @if (!$showFilters)... @endif
            </button>
        </div>
        <div class="flex flex-col md:flex-row gap-2 mb-4">
            @canany(['export', 'delete'], \Selvah\Models\Incident::class)
                <div class="dropdown lg:dropdown-end">
                    <label tabindex="0" class="btn btn-neutral mb-2">
                        Actions
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill align-bottom" viewBox="0 0 16 16">
                            <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                        </svg>
                    </label>
                    <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52 z-[1]">
                        @can('export', \Selvah\Models\Incident::class)
                            <li>
                                <button type="button" class="text-blue-500" wire:click="exportSelected()">
                                    <i class="fa-solid fa-download"></i> Exporter
                                </button>
                            </li>
                        @endcan
                        @can('delete', \Selvah\Models\Incident::class)
                            <li>
                                <button type="button" class="text-red-500" wire:click="$toggle('showDeleteModal')">
                                    <i class="fa-solid fa-trash-can"></i> Supprimer
                                </button>
                            </li>
                        @endcan
                    </ul>
                </div>
            @endcanany

            @if (config('settings.incident.create.enabled') && auth()->user()->can('create', \Selvah\Models\Incident::class))
                <a href="#" wire:click.prevent="create" class="btn btn-success gap-2">
                    <i class="fa-solid fa-plus"></i>
                    Nouvel Incident
                </a>
            @endif
        </div>
    </div>

    <div>
        @if ($showFilters)
            <div class="flex flex-col md:flex-row rounded shadow-inner relative mb-4 bg-slate-100 dark:bg-base-200">
                <div class="w-full md:w-1/2 p-4">
                    <x-form.select wire:model="filters.impact" label="Impact de l'incident">
                        <option value="" disabled>Selectionnez l'impact</option>
                        @foreach(\Selvah\Models\Incident::IMPACT as $key => $value)
                        <option  value="{{ $key }}" class="font-bold {{ $key == 'mineur' ? 'text-yellow-500' : ($key == 'moyen' ? 'text-orange-500' : 'text-red-500') }}">{{$value}}</option>
                        @endforeach
                    </x-form.select>

                    <x-form.select wire:model="filters.creator" label="Créateur">
                        <option value="" disabled>Selectionnez un créateur</option>
                        @foreach($users as $userId => $userUsername)
                            <option  value="{{ $userId }}">{{$userUsername}}</option>
                        @endforeach
                    </x-form.select>

                    <x-form.select wire:model="filters.material" label="Matériel">
                        <option  value="" disabled>Selectionnez le matériel</option>
                        @foreach($materials as $materialId => $materialName)
                            <option  value="{{ $materialId }}">{{$materialName}}</option>
                        @endforeach
                    </x-form.select>

                    <x-form.select wire:model="filters.zone" label="Zone">
                        <option  value="" disabled>Selectionnez la zone</option>
                        @foreach($zones as $zoneId => $zoneName)
                            <option  value="{{ $zoneId }}">{{$zoneName}}</option>
                        @endforeach
                    </x-form.select>

                    <x-form.select wire:model="filters.finished" label="Incident résolu">
                        <option  value="" disabled>Selectionnez une option</option>
                            <option  value="true">Oui</option>
                            <option  value="false">Non</option>
                    </x-form.select>
                </div>

                <div class="w-full md:w-1/2 p-4 mb-11 md:mb-0">
                    <x-form.date wire:model="filters.started-min" label="Minimum date de création"  :join="true" :joinIcon="'fa-solid fa-calendar'" placeholder="Selectionnez une date..." />
                    <x-form.date wire:model="filters.started-max" label="Maximum date de création"  :join="true" :joinIcon="'fa-solid fa-calendar'" placeholder="Selectionnez une date..." />

                    <x-form.date wire:model="filters.finished-min" label="Minimum date de résolution"  :join="true" :joinIcon="'fa-solid fa-calendar'" placeholder="Selectionnez une date..." />
                    <x-form.date wire:model="filters.finished-max" label="Maximum date de résolution"  :join="true" :joinIcon="'fa-solid fa-calendar'" placeholder="Selectionnez une date..." />

                    <button wire:click="resetFilters" type="button" class="btn btn-error btn-sm absolute right-4 bottom-4">
                        <i class="fa-solid fa-eraser"></i>Réinitialiser les filtres
                    </button>
                </div>
            </div>
        @endif
    </div>

    <x-table.table class="mb-6">
        <x-slot name="head">
            @canany(['export', 'delete'], \Selvah\Models\Incident::class)
                <x-table.heading>
                    <label>
                        <input type="checkbox" class="checkbox" wire:model="selectPage" />
                    </label>
                </x-table.heading>
            @endcanany
            @can('update', \Selvah\Models\Incident::class)
                <x-table.heading>Actions</x-table.heading>
            @endcan
            <x-table.heading sortable wire:click="sortBy('id')" :direction="$sortField === 'id' ? $sortDirection : null">#Id</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('material_id')" :direction="$sortField === 'material_id' ? $sortDirection : null">Matériel</x-table.heading>
            <x-table.heading>Zone</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('user_id')" :direction="$sortField === 'user_id' ? $sortDirection : null">Créateur</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('description')" :direction="$sortField === 'description' ? $sortDirection : null">Description</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('started_at')" :direction="$sortField === 'started_at' ? $sortDirection : null">Incident créé le</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('impact')" :direction="$sortField === 'impact' ? $sortDirection : null">Impact</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('is_finished')" :direction="$sortField === 'is_finished' ? $sortDirection : null">Résolu</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('finished_at')" :direction="$sortField === 'finished_at' ? $sortDirection : null">Résolu le</x-table.heading>
        </x-slot>

        <x-slot name="body">
            @if ($selectPage)
                <x-table.row wire:key="row-message">
                    <x-table.cell colspan="11">
                        @unless ($selectAll)
                            <div>
                                <span>Vous avez sélectionné <strong>{{ $incidents->count() }}</strong> incident(s), voulez-vous tous les selectionner <strong>{{ $incidents->total() }}</strong>?</span>
                                <button type="button" wire:click="selectAll" class="btn btn-neutral btn-sm gap-2 ml-1">
                                    <i class="fa-solid fa-check"></i>
                                    Tout sélectionner
                                </button>
                            </div>
                        @else
                            <span>Vous sélectionnez actuellement <strong>{{ $incidents->total() }}</strong> incident(s).</span>
                        @endif
                    </x-table.cell>
                </x-table.row>
            @endif

            @forelse($incidents as $incident)
                <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $incident->getKey() }}">
                    @canany(['export', 'delete'], \Selvah\Models\Incident::class)
                        <x-table.cell>
                            <label>
                                <input type="checkbox" class="checkbox" wire:model="selected" value="{{ $incident->getKey() }}" />
                            </label>
                        </x-table.cell>
                    @endcanany
                    @can('update', \Selvah\Models\Incident::class)
                        <x-table.cell>
                            <a href="#" wire:click.prevent="edit({{ $incident->getKey() }})" class="tooltip tooltip-right" data-tip="Modifier cet incident">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </x-table.cell>
                    @endcan
                    <x-table.cell>{{ $incident->getKey() }}</x-table.cell>
                    <x-table.cell>
                        <a class="link link-hover link-primary font-bold" href="{{ $incident->material->show_url }}">
                            {{ $incident->material->name }}
                        </a>
                    </x-table.cell>
                    <x-table.cell>{{ $incident->material->zone->name }}</x-table.cell>
                    <x-table.cell>{{ $incident->user->username }}</x-table.cell>
                    <x-table.cell>
                        <span class="tooltip tooltip-top text-left" data-tip="{{ $incident->description }}">
                            {{ Str::limit($incident->description, 50) }}
                        </span>
                    </x-table.cell>
                    <x-table.cell class="capitalize">{{ $incident->started_at->translatedFormat( 'D j M Y H:i') }}</x-table.cell>
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
                        @if ($incident->is_finished)
                            <span class="font-bold text-green-500">Oui</span>
                        @else
                            <span class="font-bold text-red-500">Non</span>
                        @endif
                    </x-table.cell>
                    <x-table.cell class="capitalize">{{ $incident->finished_at?->translatedFormat( 'D j M Y H:i') }}</x-table.cell>
                </x-table.row>
            @empty
                <x-table.row>
                    <x-table.cell colspan="11">
                        <div class="text-center p-2">
                            <span class="text-muted">Aucun incident trouvé...</span>
                        </div>
                    </x-table.cell>
                </x-table.row>
            @endforelse
        </x-slot>
    </x-table.table>

    <div class="grid grid-cols-1">
        {{ $incidents->links() }}
    </div>


    <!-- Delete Incidents Modal -->
    <form wire:submit.prevent="deleteSelected">
        <input type="checkbox" id="deleteModal" class="modal-toggle" wire:model="showDeleteModal" />
        <label for="deleteModal" class="modal cursor-pointer">
            <label class="modal-box relative">
                <label for="deleteModal" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                <h3 class="font-bold text-lg">
                    Supprimer les Incidents
                </h3>
                @if (empty($selected))
                    <p class="my-7">
                        Vous n'avez sélectionné aucun incident à supprimer.
                    </p>
                @else
                    <p class="my-7">
                        Voulez-vous vraiment supprimer ces incidents ? <span class="font-bold text-red-500">Cette opération n'est pas réversible.</span>
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

    <!-- Edit Incidents Modal -->
    <div>
    <form wire:submit.prevent="save">
        <input type="checkbox" id="editModal" class="modal-toggle" wire:model="showModal" />
        <label for="editModal" class="modal cursor-pointer">
            <label class="modal-box relative">
                <label for="editModal" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                <h3 class="font-bold text-lg">
                    {!! $isCreating ? 'Créer un Incident' : 'Editer l\'Incident' !!}
                </h3>

                @php $message = "Sélectionnez le matériel qui a rencontrer un problème dans la liste. (<b>Si plusieurs matériels, merci de créer un incident par matériel</b>)";@endphp
                <x-form.select wire:model.defer="model.material_id" name="model.material_id"  label="Materiel" :info="true" :infoText="$message">
                    <option  value="0">Selectionnez la matériel</option>
                    @foreach($materials as $materialId => $materialName)
                    <option  value="{{ $materialId }}">{{$materialName}}</option>
                    @endforeach
                </x-form.select>

                @php $message = "Veuillez décrire au mieux le problème.";@endphp
                <x-form.textarea wire:model.defer="model.description" name="model.description" label="Description de l'incident" placeholder="Description de l'incident..." :info="true" :infoText="$message" />

                @php $message = "Date à laquelle a eu lieu l'incident.";@endphp
                <x-form.date wire:model.defer="started_at" name="started_at" label="Incident survenu le" placeholder="Incident survenu le..." value="{{ $started_at }}" :info="true" :infoText="$message" />

                @php $message = "Sélectionnez l'impact de l'incident :<br><b>Mineur:</b> Incident légé sans impact sur la production.<br><b>Moyen:</b> Incident moyen ayant entrainé un arrêt partiel et/ou une perte de produit.<br><b>Critique:</b> Incident grave ayant impacté la production et/ou un arrêt.";@endphp
                <x-form.select wire:model.defer="model.impact" name="model.impact"  label="Impact de l'incident" :info="true" :infoText="$message">
                    <option  value="0">Selectionnez l'impact</option>
                    @foreach(\Selvah\Models\Incident::IMPACT as $key => $value)
                    <option  value="{{ $key }}" class="font-bold {{ $key == 'mineur' ? 'text-yellow-500' : ($key == 'moyen' ? 'text-orange-500' : 'text-red-500') }}">{{$value}}</option>
                    @endforeach
                </x-form.select>

                <x-form.checkbox wire:model="model.is_finished" name="is_finished" label=" Incident résolu ?">
                    Cochez si l'incident est résolu
                </x-form.checkbox>

                @if ($model->is_finished)
                    @php $message = "Date à laquelle l'incident a été résolu.";@endphp
                    <x-form.date wire:model.defer="finished_at" name="finished_at" label="Incident résolu le" placeholder="Incident résolu le..." value="{{ $finished_at }}" :info="true" :infoText="$message" />
                @endif

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

</div>
