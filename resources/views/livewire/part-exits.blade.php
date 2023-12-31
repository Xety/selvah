<div>
    @include('elements.flash')

    <div class="flex flex-col lg:flex-row gap-6 justify-between">
        <div class="mb-4 w-full lg:w-auto lg:min-w-[350px]">
            <x-form.text wire:model="search" placeholder="Rechercher des Sorties..." class="lg:max-w-lg" />
        </div>
        <div class="mb-4">
            @canany(['delete'], \Selvah\Models\PartExit::class)
                <div class="dropdown lg:dropdown-end">
                    <label tabindex="0" class="btn btn-neutral m-1">
                        Actions
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill align-bottom" viewBox="0 0 16 16">
                            <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                        </svg>
                    </label>
                    <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52 z-[1]">
                        @can('delete', \Selvah\Models\PartExit::class)
                            <li>
                                <button type="button" class="text-red-500" wire:click="$toggle('showDeleteModal')">
                                    <i class="fa-solid fa-trash-can"></i> Supprimer
                                </button>
                            </li>
                        @endcan
                    </ul>
                </div>
            @endcanany

            @can('create', \Selvah\Models\PartExit::class)
                <a href="#" wire:click.prevent="create" class="btn btn-success gap-2">
                    <i class="fa-solid fa-plus"></i>
                    Nouvelle Sortie de Pièce
                </a>
            @endcan
        </div>
    </div>

    <x-table.table class="mb-6">
        <x-slot name="head">
            @canany(['delete'], \Selvah\Models\PartExit::class)
                <x-table.heading>
                    <label>
                        <input type="checkbox" class="checkbox" wire:model="selectPage" />
                    </label>
                </x-table.heading>
            @endcanany
            @can('update', \Selvah\Models\PartExit::class)
                <x-table.heading>Actions</x-table.heading>
            @endcan
            <x-table.heading sortable wire:click="sortBy('maintenance_id')" :direction="$sortField === 'maintenance_id' ? $sortDirection : null">Maintenance n°</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('part_id')" :direction="$sortField === 'part_id' ? $sortDirection : null">Pièce Détachée</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('user_id')" :direction="$sortField === 'user_id' ? $sortDirection : null">Sortie par</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('description')" :direction="$sortField === 'description' ? $sortDirection : null">Description</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('number')" :direction="$sortField === 'number' ? $sortDirection : null">Nombre de pièce</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('created_at')" :direction="$sortField === 'created_at' ? $sortDirection : null">Créé le</x-table.heading>
        </x-slot>

        <x-slot name="body">
            @if ($selectPage)
            <x-table.row wire:key="row-message">
                <x-table.cell colspan="8">
                    @unless ($selectAll)
                        <div>
                            <span>Vous avez sélectionné <strong>{{ $partExits->count() }}</strong> sortie(s), voulez-vous tous les selectionner <strong>{{ $partExits->total() }}</strong>?</span>
                            <button type="button" wire:click="selectAll" class="btn btn-neutral btn-sm gap-2 ml-1">
                                <i class="fa-solid fa-check"></i>
                                Tout sélectionner
                            </button>
                        </div>
                    @else
                        <span>Vous sélectionnez actuellement <strong>{{ $partExits->total() }}</strong> sortie(s).</span>
                    @endif
                </x-table.cell>
            </x-table.row>
            @endif

            @forelse($partExits as $partExit)
                <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $partExit->getKey() }}">
                    @canany(['delete'], \Selvah\Models\PartExit::class)
                        <x-table.cell>
                            <label>
                                <input type="checkbox" class="checkbox" wire:model="selected" value="{{ $partExit->getKey() }}" />
                            </label>
                        </x-table.cell>
                    @endcanany
                    @can('update', \Selvah\Models\PartExit::class)
                        <x-table.cell>
                            <a href="#" wire:click.prevent="edit({{ $partExit->getKey() }})" class="tooltip tooltip-right" data-tip="Modifier cette sortie">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </x-table.cell>
                    @endcan
                    <x-table.cell>
                        @unless (is_null($partExit->maintenance))
                            <a class="link link-hover link-primary tooltip tooltip-right text-left" href="{{ $partExit->maintenance->show_url }}" data-tip="Voir la fiche Maintenance">
                           <span class="font-bold">{{ $partExit->maintenance->getKey() }}</span>
                        </a>
                        @endunless
                    </x-table.cell>
                    <x-table.cell>
                        <a class="link link-hover link-primary font-bold" href="{{ $partExit->part->show_url }}">
                            {{ $partExit->part->name }}
                        </a>
                    </x-table.cell>
                    <x-table.cell>{{ $partExit->user->username }}</x-table.cell>
                    <x-table.cell>
                        {{ Str::limit($partExit->description, 80) }}
                    </x-table.cell>
                    <x-table.cell class="prose">
                        <code class="text-neutral-content bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                            {{ $partExit->number }}
                        </code>
                    </x-table.cell>
                    <x-table.cell class="capitalize">
                        {{ $partExit->created_at->translatedFormat( 'D j M Y H:i') }}
                    </x-table.cell>
                </x-table.row>
            @empty
                <x-table.row>
                    <x-table.cell colspan="8">
                        <div class="text-center p-2">
                            <span class="text-muted">Aucune sortie trouvée...</span>
                        </div>
                    </x-table.cell>
                </x-table.row>
            @endforelse
        </x-slot>
    </x-table.table>

    <div class="grid grid-cols-1">
        {{ $partExits->links() }}
    </div>


    <!-- Delete PartExits Modal -->
    <form wire:submit.prevent="deleteSelected">
        <input type="checkbox" id="deleteModal" class="modal-toggle" wire:model="showDeleteModal" />
        <label for="deleteModal" class="modal cursor-pointer">
            <label class="modal-box relative">
                <label for="deleteModal" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                <h3 class="font-bold text-lg">
                    Supprimer les Sorties
                </h3>
                @if (empty($selected))
                    <p class="my-7">
                        Vous n'avez sélectionné aucune sortie à supprimer.
                    </p>
                @else
                    <p class="my-7">
                        Voulez-vous vraiment supprimer ces sorties de pièces détachées ? <span class="font-bold text-red-500">Cette opération n'est pas réversible.</span>
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

    <!-- Edit PartEntries Modal -->
    <form wire:submit.prevent="save">
        <input type="checkbox" id="editModal" class="modal-toggle" wire:model="showModal" />
        <label for="editModal" class="modal cursor-pointer">
            <label class="modal-box relative">
                <label for="editModal" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                <h3 class="font-bold text-lg">
                    {!! $isCreating ? 'Créer une Sortie' : 'Editer la Sortie' !!}
                </h3>

                @if ($isCreating)
                    @php $message = "Sélectionnez la pièce détachée auquelle appartient la sortie.";@endphp
                    <x-form.select wire:model.defer="model.part_id" name="model.part_id"  label="Pièce Détachée" :info="true" :infoText="$message">
                        <option  value="0">Sélectionnez une pièce détachée</option>
                        @foreach($parts as $part)
                        <option  value="{{ $part['id'] }}">{{$part['name']}} @if (isset($part['material'])) ({{ $part['material']['name'] }}) @endif</option>
                        @endforeach
                    </x-form.select>
                @endif

                @php $message = "Sélectionnez la maintenance auquelle appartient la sortie.<br>Si la sortie n'est pas liée à une maintenance, sélectionnez <b>\"Aucune maintenance\"</b>";@endphp
                <x-form.select wire:model.defer="model.maintenance_id" name="model.maintenance_id"  label="N° de Maintenance" :info="true" :infoText="$message">
                    <option  value="0">Sélectionnez une maintenance</option>
                    <option  value="">Aucune maintenance</option>
                    @foreach($maintenances as $maintenance)
                    <option  value="{{ $maintenance['id'] }}">{{ $maintenance['id'] }}
                        @if (isset($maintenance['material']))
                            ({{ $maintenance['material']['name'] }})
                        @else
                            (Aucun matériel lié)
                        @endif
                    </option>
                    @endforeach
                </x-form.select>

                @if ($isCreating)
                    @php $message = "Nombre de pièce sortie du stock.";@endphp
                    <x-form.number wire:model.defer="model.number" name="model.number" label="Nombre de pièce" placeholder="Nombre de pièce..." :info="true" :infoText="$message" />
                @endif

                @php $message = "Renseignez ici toute information utile sur la sortie de la pièce si aucune maintenance n'est liée ou si besoin de plus de précision.";@endphp
                <x-form.textarea wire:model.defer="model.description" name="model.description" label="Description de la sortie" placeholder="Description du matériel..." :info="true" :infoText="$message" />

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
