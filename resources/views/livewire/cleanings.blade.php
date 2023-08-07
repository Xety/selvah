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
            <x-form.text wire:model="filters.search" placeholder="Rechercher des Nettoyages..." class="lg:max-w-lg" />
            <button type="button" wire:click="$toggle('showFilters')" class="btn">
                <i class="fa-solid fa-magnifying-glass"></i>@if ($showFilters) Cacher la @endif Recherche Avancée @if (!$showFilters)... @endif
            </button>
        </div>
        <div class="flex flex-col md:flex-row gap-2 mb-4">
            @canany(['export', 'delete'], \Selvah\Models\Cleaning::class)
                <div class="dropdown lg:dropdown-end">
                    <label tabindex="0" class="btn btn-neutral mb-2">
                        Actions
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill align-bottom" viewBox="0 0 16 16">
                            <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                        </svg>
                    </label>
                    <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52 z-[1]">
                        @can('export', \Selvah\Models\Cleaning::class)
                            <li>
                                <button type="button" class="text-blue-500" wire:click="exportSelected()">
                                    <i class="fa-solid fa-download"></i> Exporter
                                </button>
                            </li>
                        @endcan
                        @can('delete', \Selvah\Models\Cleaning::class)
                            <li>
                                <button type="button" class="text-red-500" wire:click="$toggle('showDeleteModal')">
                                    <i class="fa-solid fa-trash-can"></i> Supprimer
                                </button>
                            </li>
                        @endcan
                    </ul>
                </div>
            @endcanany

            @if (config('settings.cleaning.create.enabled') && auth()->user()->can('create', \Selvah\Models\Cleaning::class))
                <a href="#" wire:click.prevent="create" class="btn btn-success gap-2">
                    <i class="fa-solid fa-plus"></i>
                    Nouveau Nettoyage
                </a>
            @endif
        </div>
    </div>

    <div>
        @if ($showFilters)
            <div class="flex flex-col md:flex-row rounded shadow-inner relative mb-4 bg-slate-100 dark:bg-base-200">
                <div class="w-full md:w-1/2 p-4">
                    <x-form.select wire:model="filters.type"  label="Type de nettoyage">
                        <option value="" disabled>Selectionnez le type</option>
                        @foreach(\Selvah\Models\Cleaning::TYPES as $key => $value)
                        <option  value="{{ $key }}">{{$value}}</option>
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
                </div>

                <div class="w-full md:w-1/2 p-4 mb-9 md:mb-0">
                    <x-form.number wire:model="filters.ph-test-water-min" label="PH minimum de l'eau"/>

                    <x-form.date wire:model="filters.created-min" label="Date minimum de création"  :join="true" :joinIcon="'fa-solid fa-calendar'" placeholder="Selectionnez une date..." />
                    <x-form.date wire:model="filters.created-max" label="Date maximum de création"  :join="true" :joinIcon="'fa-solid fa-calendar'" placeholder="Selectionnez une date..." />

                    <button wire:click="resetFilters" type="button" class="btn btn-error btn-sm absolute right-2 bottom-2">
                        <i class="fa-solid fa-eraser"></i>Réinitialiser les filtres
                    </button>
                </div>
            </div>
        @endif
    </div>

    <x-table.table class="mb-6">
        <x-slot name="head">
            @canany(['export', 'delete'], \Selvah\Models\Cleaning::class)
                <x-table.heading>
                    <label>
                        <input type="checkbox" class="checkbox" wire:model="selectPage" />
                    </label>
                </x-table.heading>
            @endcanany
            <x-table.heading sortable wire:click="sortBy('id')" :direction="$sortField === 'id' ? $sortDirection : null">#Id</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('material_id')" :direction="$sortField === 'material_id' ? $sortDirection : null">Matériel</x-table.heading>
            <x-table.heading>Zone</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('user_id')" :direction="$sortField === 'user_id' ? $sortDirection : null">Créateur</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('description')" :direction="$sortField === 'description' ? $sortDirection : null">Description</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('type')" :direction="$sortField === 'type' ? $sortDirection : null">Type</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('ph_test_water')" :direction="$sortField === 'ph_test_water' ? $sortDirection : null">PH de l'eau</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('ph_test_water_after_cleaning')" :direction="$sortField === 'ph_test_water_after_cleaning' ? $sortDirection : null">PH de l'eau <br>après nettoyage</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('created_at')" :direction="$sortField === 'created_at' ? $sortDirection : null">Créé le</x-table.heading>
            <x-table.heading>Actions</x-table.heading>
        </x-slot>

        <x-slot name="body">
            @if ($selectPage)
                <x-table.row wire:key="row-message">
                    <x-table.cell colspan="11">
                        @unless ($selectAll)
                            <div>
                                <span>Vous avez sélectionné <strong>{{ $cleanings->count() }}</strong> nettoyage(s), voulez-vous tous les selectionner <strong>{{ $cleanings->total() }}</strong>?</span>
                                <button type="button" wire:click="selectAll" class="btn btn-neutral btn-sm gap-2 ml-1">
                                    <i class="fa-solid fa-check"></i>
                                    Tout sélectionner
                                </button>
                            </div>
                        @else
                            <span>Vous sélectionnez actuellement <strong>{{ $cleanings->total() }}</strong> nettoyage(s).</span>
                        @endif
                    </x-table.cell>
                </x-table.row>
            @endif

            @forelse($cleanings as $cleaning)
                <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $cleaning->getKey() }}">
                    @canany(['export', 'delete'], \Selvah\Models\Cleaning::class)
                        <x-table.cell>
                            <label>
                                <input type="checkbox" class="checkbox" wire:model="selected" value="{{ $cleaning->getKey() }}" />
                            </label>
                        </x-table.cell>
                    @endcanany
                    <x-table.cell>{{ $cleaning->getKey() }}</x-table.cell>
                    <x-table.cell>
                        <a class="link link-hover link-primary font-bold" href="{{ $cleaning->material->show_url }}">
                            {{ $cleaning->material->name }}
                        </a>
                    </x-table.cell>
                    <x-table.cell>{{ $cleaning->material->zone->name }}</x-table.cell>
                    <x-table.cell>{{ $cleaning->user->username }}</x-table.cell>
                    <x-table.cell>
                        <span class="tooltip tooltip-top text-left" data-tip="{{ $cleaning->description }}">
                            {{ Str::limit($cleaning->description, 50) }}
                        </span>
                    </x-table.cell>
                    <x-table.cell>
                        {{ \Selvah\Models\Cleaning::TYPES[$cleaning->type] }}
                    </x-table.cell>
                    <x-table.cell class="prose">
                        @if ($cleaning->type == 'weekly' && $cleaning->ph_test_water !== 0.0)
                             <code class="text-[color:hsl(var(--p))] bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                                @if ($cleaning->ph_test_water !== $cleaning->ph_test_water_after_cleaning)
                                    <span class="font-bold text-red-500">
                                        {{ $cleaning->ph_test_water }}
                                    </span>
                                @else
                                    <span class="font-bold text-green-500">
                                        {{ $cleaning->ph_test_water }}
                                    </span>
                                @endif
                            </code>
                        @endif
                    </x-table.cell>
                    <x-table.cell class="prose">
                        @if ($cleaning->type == 'weekly' && $cleaning->ph_test_water_after_cleaning !== 0.0)
                            <code class="text-[color:hsl(var(--p))] bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                                @if ($cleaning->ph_test_water_after_cleaning !== $cleaning->ph_test_water)
                                    <span class="font-bold text-red-500">
                                        {{ $cleaning->ph_test_water_after_cleaning }}
                                    </span>
                                @else
                                    <span class="font-bold text-green-500">
                                        {{ $cleaning->ph_test_water_after_cleaning }}
                                    </span>
                                @endif
                            </code>
                        @endif
                    </x-table.cell>
                    <x-table.cell class="capitalize">{{ $cleaning->created_at->translatedFormat( 'D j M Y H:i') }}</x-table.cell>
                    <x-table.cell>
                        @can('update', $cleaning)
                            <a href="#" wire:click.prevent="edit({{ $cleaning->getKey() }})" class="tooltip tooltip-left" data-tip="Modifier ce nettoyage">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        @endcan
                    </x-table.cell>
                </x-table.row>
            @empty
                <x-table.row>
                    <x-table.cell colspan="11">
                        <div class="text-center p-2">
                            <span class="text-muted">Aucun nettoyage trouvé...</span>
                        </div>
                    </x-table.cell>
                </x-table.row>
            @endforelse
        </x-slot>
    </x-table.table>

    <div class="grid grid-cols-1">
        {{ $cleanings->links() }}
    </div>


    <!-- Delete Cleanings Modal -->
    <form wire:submit.prevent="deleteSelected">
        <input type="checkbox" id="deleteModal" class="modal-toggle" wire:model="showDeleteModal" />
        <label for="deleteModal" class="modal cursor-pointer">
            <label class="modal-box relative">
                <label for="deleteModal" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                <h3 class="font-bold text-lg">
                    Supprimer les Nettoyages
                </h3>
                @if (empty($selected))
                    <p class="my-7">
                        Vous n'avez sélectionné aucun nettoyage à supprimer.
                    </p>
                @else
                    <p class="my-7">
                        Voulez-vous vraiment supprimer ces nettoyages ? <span class="font-bold text-red-500">Cette opération n'est pas réversible.</span>
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

    <!-- Edit Cleanings Modal -->
    <div>
    <form wire:submit.prevent="save">
        <input type="checkbox" id="editModal" class="modal-toggle" wire:model="showModal" />
        <label for="editModal" class="modal cursor-pointer">
            <label class="modal-box relative">
                <label for="editModal" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                <h3 class="font-bold text-lg">
                    {!! $isCreating ? 'Créer un Nettoyage' : 'Editer le Nettoyage' !!}
                </h3>

                @php $message = "Sélectionnez le matériel que vous venez de nettoyer.";@endphp
                <x-form.select wire:model="model.material_id" name="model.material_id"  label="Materiel" :info="true" :infoText="$message">
                    <option  value="0">Selectionnez la matériel</option>
                    @foreach($materials as $materialId => $materialName)
                        <option  value="{{ $materialId }}">{{$materialName}}</option>
                    @endforeach
                </x-form.select>

                @php $message = "Si vous avez des informations complémentaires à renseigner, veuillez le faire dans la case ci-dessous.";@endphp
                <x-form.textarea wire:model="model.description" name="model.description" label="Description du nettoyage" placeholder="Informations complémentaires..." :info="true" :infoText="$message" />

                @php $message = "Sélectionnez le type de nettoyage.";@endphp
                <x-form.select wire:model="model.type" name="model.type"  label="Type de nettoyage" :info="true" :infoText="$message">
                    <option  value="0">Selectionnez le type</option>
                    @foreach(\Selvah\Models\Cleaning::TYPES as $key => $value)
                        <option  value="{{ $key }}">{{$value}}</option>
                    @endforeach
                </x-form.select>

                @if ($model->type == 'weekly' && $materialCleaningTestPhEnabled == true)
                    @php $message = "Veuillez renseigner le PH de l'eau du réseau.";@endphp
                    <x-form.number step="0.5" wire:model="model.ph_test_water" name="model.ph_test_water" label="Test PH de l'eau du réseau" placeholder="PH..." value="7" :info="true" :infoText="$message" />

                    @php $message = "Veuillez renseigner le PH de l'eau après nettoyage.";@endphp
                    <x-form.number step="0.5" wire:model="model.ph_test_water_after_cleaning" name="model.ph_test_water_after_cleaning" label="Test PH après nettoyage" placeholder="PH..." value="7" :info="true" :infoText="$message" />
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
