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
            <x-form.text wire:model="search" placeholder="Rechercher des Entrées..." class="lg:max-w-lg" />
        </div>
        <div class="mb-4">
            @canany(['delete'], \Selvah\Models\PartEntry::class)
                <div class="dropdown lg:dropdown-end">
                    <label tabindex="0" class="btn btn-neutral m-1">
                        Actions
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill align-bottom" viewBox="0 0 16 16">
                            <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                        </svg>
                    </label>
                    <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52 z-[1]">
                        @can('delete', \Selvah\Models\PartEntry::class)
                            <li>
                                <button type="button" class="text-red-500" wire:click="$toggle('showDeleteModal')">
                                    <i class="fa-solid fa-trash-can"></i> Supprimer
                                </button>
                            </li>
                        @endcan
                    </ul>
                </div>
            @endcanany

            @can('create', \Selvah\Models\PartEntry::class)
                <a href="#" wire:click.prevent="create" class="btn btn-success gap-2">
                    <i class="fa-solid fa-plus"></i>
                    Nouvelle Entrée de Pièce
                </a>
            @endif
        </div>
    </div>

    <x-table.table class="mb-6">
        <x-slot name="head">
            @canany(['delete'], \Selvah\Models\PartEntry::class)
                <x-table.heading>
                    <label>
                        <input type="checkbox" class="checkbox" wire:model="selectPage" />
                    </label>
                </x-table.heading>
            @endcanany

            <x-table.heading sortable wire:click="sortBy('id')" :direction="$sortField === 'id' ? $sortDirection : null">#Id</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('part_id')" :direction="$sortField === 'part_id' ? $sortDirection : null">Pièce Détachée</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('user_id')" :direction="$sortField === 'user_id' ? $sortDirection : null">Entrée par</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('number')" :direction="$sortField === 'number' ? $sortDirection : null">Nombre de pièce</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('order_id')" :direction="$sortField === 'order_id' ? $sortDirection : null">Commande n°</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('created_at')" :direction="$sortField === 'created_at' ? $sortDirection : null">Créé le</x-table.heading>
            <x-table.heading>Actions</x-table.heading>
        </x-slot>

        <x-slot name="body">
            @if ($selectPage)
            <x-table.row wire:key="row-message">
                <x-table.cell colspan="8">
                    @unless ($selectAll)
                        <div>
                            <span>Vous avez sélectionné <strong>{{ $partEntries->count() }}</strong> entrée(s), voulez-vous tous les selectionner <strong>{{ $partEntries->total() }}</strong>?</span>
                            <button type="button" wire:click="selectAll" class="btn btn-neutral btn-sm gap-2 ml-1">
                                <i class="fa-solid fa-check"></i>
                                Tout sélectionner
                            </button>
                        </div>
                    @else
                        <span>Vous sélectionnez actuellement <strong>{{ $partEntries->total() }}</strong> entrée(s).</span>
                    @endif
                </x-table.cell>
            </x-table.row>
            @endif

            @forelse($partEntries as $partEntry)
                <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $partEntry->getKey() }}">
                    @canany(['delete'], \Selvah\Models\PartEntry::class)
                        <x-table.cell>
                            <label>
                                <input type="checkbox" class="checkbox" wire:model="selected" value="{{ $partEntry->getKey() }}" />
                            </label>
                        </x-table.cell>
                    @endcanany
                    <x-table.cell>{{ $partEntry->getKey() }}</x-table.cell>
                    <x-table.cell>
                        <a class="link link-hover link-primary font-bold" href="{{ $partEntry->part->show_url }}">
                            {{ $partEntry->part->name }}
                        </a>
                    </x-table.cell>
                    <x-table.cell>{{ $partEntry->user->username }}</x-table.cell>
                    <x-table.cell class="prose">
                        <code class="text-[color:hsl(var(--p))] bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                            {{ $partEntry->number }}
                        </code>
                    </x-table.cell>
                    <x-table.cell class="prose">
                        @if ($partEntry->order_id)
                            <code class="text-[color:hsl(var(--p))] bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                                {{ $partEntry->order_id}}
                            </code>
                        @endif
                    </x-table.cell>
                    <x-table.cell class="capitalize">
                        {{ $partEntry->created_at->translatedFormat( 'D j M Y H:i') }}
                    </x-table.cell>
                    <x-table.cell>
                        @can('update', $partEntry)
                            <a href="#" wire:click.prevent="edit({{ $partEntry->getKey() }})" class="tooltip tooltip-left" data-tip="Modifier cette entrée">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        @endcan
                    </x-table.cell>
                </x-table.row>
            @empty
                <x-table.row>
                    <x-table.cell colspan="8">
                        <div class="text-center p-2">
                            <span class="text-muted">Aucune entrée trouvée...</span>
                        </div>
                    </x-table.cell>
                </x-table.row>
            @endforelse
        </x-slot>
    </x-table.table>

    <div class="grid grid-cols-1">
        {{ $partEntries->links() }}
    </div>


    <!-- Delete PartEntries Modal -->
    <form wire:submit.prevent="deleteSelected">
        <input type="checkbox" id="deleteModal" class="modal-toggle" wire:model="showDeleteModal" />
        <label for="deleteModal" class="modal cursor-pointer">
            <label class="modal-box relative">
                <label for="deleteModal" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                <h3 class="font-bold text-lg">
                    Supprimer les Entrées
                </h3>
                @if (empty($selected))
                    <p class="my-7">
                        Vous n'avez sélectionné aucune entrée à supprimer.
                    </p>
                @else
                    <p class="my-7">
                        Voulez-vous vraiment supprimer ces entrées de pièces détachées ? <span class="font-bold text-red-500">Cette opération n'est pas réversible.</span>
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
                    {!! $isCreating ? 'Créer une Entrée' : 'Editer l\'Entrée' !!}
                </h3>

                {{-- Only display those fields for the creating modal --}}
                @if ($isCreating)
                    @php $message = "Sélectionnez la pièce détachée auquelle appartient l'entrée.";@endphp
                    <x-form.select wire:model="model.part_id" name="model.part_id"  label="Pièce Détachée" :info="true" :infoText="$message">
                        <option  value="0">Selectionnez une pièce détachée</option>
                        @foreach($parts as $part)
                        <option  value="{{ $part['id'] }}">{{$part['name']}} ({{ $part['material']['name'] }})</option>
                        @endforeach
                    </x-form.select>

                    @php $message = "Nombre de pièce rentrée en stock.";@endphp
                    <x-form.number wire:model="model.number" name="model.number" label="Nombre de pièce" placeholder="Nombre de pièce..." :info="true" :infoText="$message" />
                @endif

                @php $message = "N° de commande, laissez vide si aucun numéro.";@endphp
                <x-form.text wire:model="model.order_id" name="model.order_id" label="N° commande" placeholder="N° commande..." :info="true" :infoText="$message" />

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
