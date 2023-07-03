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
            <x-form.text wire:model="search" placeholder="Rechercher des Incidents..." class="lg:max-w-lg" />
        </div>
        <div class="mb-4">
            @can('Gérer les Incidents')
            <div class="dropdown lg:dropdown-end">
                <label tabindex="0" class="btn btn-neutral m-1">
                    Actions
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill align-bottom" viewBox="0 0 16 16">
                        <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                    </svg>
                </label>
                <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52 z-[1]">
                    <li>
                        <button type="button" class="text-red-500" wire:click="$toggle('showDeleteModal')">
                            <i class="fa-solid fa-trash-can"></i> Supprimer
                        </button>
                    </li>
                </ul>
            </div>
            @endcan
            <a href="#" wire:click.prevent="create" class="btn btn-neutral gap-2">
                <i class="fa-solid fa-plus"></i>
                Nouvel Incident
            </a>
        </div>
    </div>

    <x-table.table class="mb-6">
        <x-slot name="head">
            @can('Gérer les Incidents')
                <x-table.heading>
                    <label>
                        <input type="checkbox" class="checkbox" wire:model="selectPage" />
                    </label>
                </x-table.heading>
            @endcan

            <x-table.heading sortable wire:click="sortBy('id')" :direction="$sortField === 'id' ? $sortDirection : null">#Id</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('material_id')" :direction="$sortField === 'material_id' ? $sortDirection : null">Matériel</x-table.heading>
            <x-table.heading>Zone</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('user_id')" :direction="$sortField === 'user_id' ? $sortDirection : null">Créateur</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('description')" :direction="$sortField === 'description' ? $sortDirection : null">Description</x-table.heading>
            <x-table.heading>Incident créé le</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('impact')" :direction="$sortField === 'impact' ? $sortDirection : null">Impact</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('solved')" :direction="$sortField === 'solved' ? $sortDirection : null">Résolu</x-table.heading>
            <x-table.heading>Résolu le</x-table.heading>
            <x-table.heading>Actions</x-table.heading>
        </x-slot>

        <x-slot name="body">
            @if ($selectPage)
            <x-table.row wire:key="row-message">
                <x-table.cell colspan="11">
                    @unless ($selectAll)
                    <div>
                        <span>Vous avez sélectionné <strong>{{ $incidents->count() }}</strong> incident(s), voulez-vous tous les selectionner <strong>{{ $incidents->count() }}</strong>?</span>
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
                    @can('Gérer les Incidents')
                        <x-table.cell>
                            <label>
                                <input type="checkbox" class="checkbox" wire:model="selected" value="{{ $incident->getKey() }}" />
                            </label>
                        </x-table.cell>
                    @endcan
                    <x-table.cell>{{ $incident->getKey() }}</x-table.cell>
                    <x-table.cell>
                        <a class="link link-hover link-primary" href="{{ route('material.show', ['id' => $incident->material->id, 'slug' => $incident->material->slug]) }}">
                            {{ $incident->material->name }}
                        </a>
                    </x-table.cell>
                    <x-table.cell>{{ $incident->material->zone->name }}</x-table.cell>
                    <x-table.cell>{{ $incident->user->username }}</x-table.cell>
                    <x-table.cell>{{ $incident->description }}</x-table.cell>
                    <x-table.cell>{{ $incident->incident_at->formatLocalized('%d %B %Y - %T') }}</x-table.cell>
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
                        @if ($incident->resolu)
                            <span class="font-bold text-green-500">Oui</span>
                        @else
                            <span class="font-bold text-red-500">Non</span>
                        @endif
                    </x-table.cell>
                    <x-table.cell>{{ $incident->solved_at?->formatLocalized('%d %B %Y - %T') }}</x-table.cell>
                    <x-table.cell>
                        <a href="#" wire:click.prevent="edit({{ $incident->getKey() }})" class="tooltip" data-tip="Modifier cet incident">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                    </x-table.cell>
                </x-table.row>
            @empty
                <x-table.row>
                    <x-table.cell colspan="9">
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
    <form wire:submit.prevent="save">
        <input type="checkbox" id="editModal" class="modal-toggle" wire:model="showModal" />
        <label for="editModal" class="modal cursor-pointer">
            <label class="modal-box relative">
                <label for="editModal" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                <h3 class="font-bold text-lg">
                    {!! $isCreating ? 'Créer un Incident' : 'Editer l\'Incident' !!}
                </h3>

                @php $message = "Sélectionnez le matériel qui a rencontrer un problème dans la liste. (<b>Si plusieurs matériels, merci de créer un incident par matériel</b>)";@endphp
                <x-form.select wire:model="model.material_id" name="model.material_id"  label="Materiel" :info="true" :infoText="$message">
                    @foreach($materials as $materialId => $materialName)
                    <option  value="{{ $materialId }}">{{$materialName}}</option>
                    @endforeach
                </x-form.select>

                @php $message = "Veuillez décrire au mieux le problème.";@endphp
                <x-form.textarea wire:model="model.description" name="model.description" label="Description de l'incident" placeholder="Description de l'incident..." :info="true" :infoText="$message" />

                @php $message = "Date à laquelle a eu lieu l'incident.";@endphp
                <x-form.date wire:model="incident_at" name="incident_at" label="Incident survenu le" placeholder="Incident survenu le..." :info="true" :infoText="$message" />

                @php $message = "Sélectionnez l'impact de l'incident :<br><b>Mineur:</b> Incident légé sans impact sur la production.<br><b>Moyen:</b> Incident moyen ayant entrainé un arrêt partiel et/ou une perte de produit.<br><b>Critique:</b> Incident grave ayant impacté la production et/ou un arrêt.";@endphp
                <x-form.select wire:model="model.impact" name="model.impact"  label="Impact de l'incident" :info="true" :infoText="$message">
                    @foreach(\Selvah\Models\Incident::IMPACT as $key => $value)
                    <option  value="{{ $key }}" class="font-bold {{ $key == 'mineur' ? 'text-yellow-500' : ($key == 'moyen' ? 'text-orange-500' : 'text-red-500') }}">{{$value}}</option>
                    @endforeach
                </x-form.select>

                <x-form.checkbox wire:model="model.solved" name="solved" label=" Incident résolu ?">
                    Cochez si l'incident est résolu
                </x-form.checkbox>

                @php $message = "Date à laquelle l'incident a été résolu.";@endphp
                <x-form.date wire:model="solved_at" name="solved_at" label="Incident résolu le" placeholder="Incident résolu le..." :info="true" :infoText="$message" />

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
