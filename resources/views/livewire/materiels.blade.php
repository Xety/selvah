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
            <x-form.text wire:model="search" placeholder="Rechercher des Matériels..." class="lg:max-w-lg" />
        </div>
        <div class="mb-4">
            @can('Gérer les Matériels')
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
                Nouveau Matériel
            </a>
        </div>
    </div>

    <x-table.table class="mb-6">
        <x-slot name="head">
            <x-table.heading>
                <label>
                    <input type="checkbox" class="checkbox" wire:model="selectPage" />
                </label>
            </x-table.heading>
            <x-table.heading sortable wire:click="sortBy('id')" :direction="$sortField === 'id' ? $sortDirection : null">#Id</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('name')" :direction="$sortField === 'name' ? $sortDirection : null">Nom</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('zone_id')" :direction="$sortField === 'zone_id' ? $sortDirection : null">Zone</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('user_id')" :direction="$sortField === 'user_id' ? $sortDirection : null">Créateur</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('description')" :direction="$sortField === 'description' ? $sortDirection : null">Description</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('incident_count')" :direction="$sortField === 'incident_count' ? $sortDirection : null">Nombre d'incident</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('created_at')" :direction="$sortField === 'created_at' ? $sortDirection : null">Créé le</x-table.heading>
            <x-table.heading>Actions</x-table.heading>
        </x-slot>

        <x-slot name="body">
            @if ($selectPage)
            <x-table.row wire:key="row-message">
                <x-table.cell colspan="11">
                    @unless ($selectAll)
                    <div>
                        <span>Vous avez sélectionné <strong>{{ $materials->count() }}</strong> matériel(s), voulez-vous tous les selectionner <strong>{{ $materials->count() }}</strong>?</span>
                        <button type="button" wire:click="selectAll" class="btn btn-neutral btn-sm gap-2 ml-1">
                            <i class="fa-solid fa-check"></i>
                            Tout sélectionner
                        </button>
                    </div>
                    @else
                    <span>Vous sélectionnez actuellement <strong>{{ $materials->total() }}</strong> matériel(s).</span>
                    @endif
                </x-table.cell>
            </x-table.row>
            @endif

            @forelse($materials as $material)
                <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $material->getKey() }}">
                    <x-table.cell>
                        <label>
                            <input type="checkbox" class="checkbox" wire:model="selected" value="{{ $material->getKey() }}" />
                        </label>
                    </x-table.cell>
                    <x-table.cell>{{ $material->getKey() }}</x-table.cell>
                    <x-table.cell>
                        <a class="link link-hover link-primary font-bold" href="{{ route('material.show', ['id' => $material->id, 'slug' => $material->slug]) }}">
                            {{ $material->name }}
                        </a>
                    </x-table.cell>
                    <x-table.cell>{{ $material->zone->name }}</x-table.cell>
                    <x-table.cell>{{ $material->user->username }}</x-table.cell>
                    <x-table.cell>{{ $material->description }}</x-table.cell>
                    <x-table.cell>{{ $material->incident_count }}</x-table.cell>
                    <x-table.cell>{{ $material->created_at->formatLocalized('%d %B %Y - %T') }}</x-table.cell>
                    <x-table.cell>
                        <a href="#" wire:click.prevent="edit({{ $material->getKey() }})" class="tooltip" data-tip="Modifier ce matériel">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                    </x-table.cell>
                </x-table.row>
            @empty
                <x-table.row>
                    <x-table.cell colspan="9">
                        <div class="text-center p-2">
                            <span class="text-muted">Aucun matériel trouvé...</span>
                        </div>
                    </x-table.cell>
                </x-table.row>
            @endforelse
        </x-slot>
    </x-table.table>

    <div class="grid grid-cols-1">
        {{ $materials->links() }}
    </div>


    <!-- Delete Materials Modal -->
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
