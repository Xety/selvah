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
            <x-form.text wire:model="search" placeholder="Rechercher des Pièces..." class="lg:max-w-lg" />
        </div>
        <div class="mb-4">
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
            <a href="#" wire:click.prevent="create" class="btn btn-neutral gap-2">
                <i class="fa-solid fa-plus"></i>
                Nouvelle Pièce Détachée
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
            <x-table.heading sortable wire:click="sortBy('name')" :direction="$sortField === 'name' ? $sortDirection : null">Name</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('material_id')" :direction="$sortField === 'material_id' ? $sortDirection : null">Matériel</x-table.heading>
            <x-table.heading>Description</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('reference')" :direction="$sortField === 'reference' ? $sortDirection : null">Référence</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('supplier')" :direction="$sortField === 'supplier' ? $sortDirection : null">Fournisseur</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('price')" :direction="$sortField === 'price' ? $sortDirection : null">Prix Unitaire</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('number')" :direction="$sortField === 'number' ? $sortDirection : null">Nombre en stock</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('number_warning_enabled')" :direction="$sortField === 'number_warning_enabled' ? $sortDirection : null">Alerte activée</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('number_critical_enabled')" :direction="$sortField === 'number_critical_enabled' ? $sortDirection : null">Alerte critique activée</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('part_entry_count')" :direction="$sortField === 'part_entry_count' ? $sortDirection : null">Nombre d'entrées</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('part_exit_count')" :direction="$sortField === 'part_exit_count' ? $sortDirection : null">Nombre de sorties</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('created_at')" :direction="$sortField === 'created_at' ? $sortDirection : null">Créé le</x-table.heading>
            <x-table.heading>Actions</x-table.heading>
        </x-slot>

        <x-slot name="body">
            @if ($selectPage)
            <x-table.row wire:key="row-message">
                <x-table.cell colspan="17">
                    <div>
                        <span>Vous avez sélectionné <strong>{{ $parts->count() }}</strong> pièce(s) détachée(s).
                    </div>
                </x-table.cell>
            </x-table.row>
            @endif

            @forelse($parts as $part)
                <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $part->getKey() }}">
                    <x-table.cell>
                        <label>
                            <input type="checkbox" class="checkbox" wire:model="selected" value="{{ $part->getKey() }}" />
                        </label>
                    </x-table.cell>
                    <x-table.cell>{{ $part->getKey() }}</x-table.cell>
                    <x-table.cell>
                        <a class="link link-hover link-primary font-bold" href="{{ route('part.show', ['id' => $part->id, 'slug' => $part->slug]) }}">
                            {{ $part->name }}
                        </a>
                    </x-table.cell>
                    <x-table.cell>
                        @unless (is_null($part->material_id))
                            <a class="link link-hover link-primary font-bold" href="{{ route('material.show', ['id' => $part->material->id, 'slug' => $part->material->slug]) }}">
                                {{ $part->material->name }}
                            </a>
                        @endunless
                    </x-table.cell>
                    <x-table.cell>
                        {{ Str::limit($part->description, 150) }}
                    </x-table.cell>
                    <x-table.cell class="prose">
                        <code class="text-[color:hsl(var(--p))] bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                            {{ $part->reference}}
                        </code>
                    </x-table.cell>
                    <x-table.cell>{{ $part->supplier }}</x-table.cell>
                    <x-table.cell class="prose">
                        <code class="text-[color:hsl(var(--p))] bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                            {{ $part->price }}€
                        </code>
                    </x-table.cell>
                    <x-table.cell class="prose">
                        <code class="text-[color:hsl(var(--p))] bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                            {{ $part->number }}
                        </code>
                    </x-table.cell>
                    <x-table.cell>
                        @if ($part->number_warning_enabled)
                            <span class="font-bold text-red-500">Oui</span>
                        @else
                            <span class="font-bold text-green-500">Non</span>
                        @endif
                    </x-table.cell>
                    <x-table.cell>
                        @if ($part->number_critical_enabled)
                            <span class="font-bold text-red-500">Oui</span>
                        @else
                            <span class="font-bold text-green-500">Non</span>
                        @endif
                    </x-table.cell>
                    <x-table.cell class="prose">
                        <code class="text-[color:hsl(var(--p))] bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                            {{ $part->part_entry_count }}
                        </code>
                    </x-table.cell>
                    <x-table.cell class="prose">
                        <code class="text-[color:hsl(var(--p))] bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                            {{ $part->part_exit_count }}
                        </code>
                    </x-table.cell>
                    <x-table.cell class="capitalize">{{ $part->created_at->translatedFormat( 'D j M Y H:i') }}</x-table.cell>
                    <x-table.cell>
                        <a href="#" wire:click.prevent="edit({{ $part->getKey() }})" class="tooltip" data-tip="Modifier cette pièce détachée">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                    </x-table.cell>
                </x-table.row>
            @empty
                <x-table.row>
                    <x-table.cell colspan="17">
                        <div class="text-center p-2">
                            <span class="text-muted">Aucune pièce détachée trouvée...</span>
                        </div>
                    </x-table.cell>
                </x-table.row>
            @endforelse
        </x-slot>
    </x-table.table>

    <div class="grid grid-cols-1">
        {{ $parts->links() }}
    </div>


    <!-- Delete Parts Modal -->
    <form wire:submit.prevent="deleteSelected">
        <input type="checkbox" id="deleteModal" class="modal-toggle" wire:model="showDeleteModal" />
        <label for="deleteModal" class="modal cursor-pointer">
            <label class="modal-box relative">
                <label for="deleteModal" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                <h3 class="font-bold text-lg">
                    Supprimer les Pièces Détachées
                </h3>
                @if (empty($selected))
                    <p class="my-7">
                        Vous n'avez sélectionné aucune pièce détachée à supprimer.
                    </p>
                @else
                    <p class="my-7">
                        Voulez-vous vraiment supprimer ces pièces détachées ? <span class="font-bold text-red-500">Cette opération n'est pas réversible.</span>
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

    <!-- Edit Parts Modal -->
    <form wire:submit.prevent="save">
        <input type="checkbox" id="editModal" class="modal-toggle" wire:model="showModal" />
        <label for="editModal" class="modal cursor-pointer">
            <label class="modal-box relative">
                <label for="editModal" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                <h3 class="font-bold text-lg">
                    {!! $isCreating ? 'Créer une Pièce Détachée' : 'Editer la Pièce Détachée' !!}
                </h3>

                <x-form.text wire:model="model.name" wire:keyup='generateSlug' id="name" name="model.name" label="Nom" placeholder="Nom de la pièce détachée..." />
                <x-form.text wire:model="model.slug" id="slug" name="model.slug" label="Slug" disabled />

                @php $message = "Veuillez décrire au mieux la pièce détachée.";@endphp
                <x-form.textarea wire:model="model.description" name="model.description" label="Description" placeholder="Description de la pièce détachée..." :info="true" :infoText="$message" />

                @php $message = "Sélectionnez le matériel auquel appartient la pièce détachée.<br><i>Note: si la pièce détachée appartient à aucun matériel, sélectionnez <b>\"Aucun matériel\"</b></i> ";@endphp
                <x-form.select wire:model="model.material_id" name="model.material_id"  label="Materiel" :info="true" :infoText="$message">
                    <option  value="0">Selectionnez un matériel</option>
                    <option  value="">Aucun matériel</option>
                    @foreach($materials as $materialId => $materialName)
                    <option  value="{{ $materialId }}">{{$materialName}}</option>
                    @endforeach
                </x-form.select>

                <x-form.text wire:model="model.reference" id="reference" name="model.reference" label="Référence" placeholder="Référence de la pièce détachée..." />

                <x-form.text wire:model="model.supplier" id="supplier" name="model.supplier" label="Fournisseur" placeholder="Fournisseur de la pièce détachée..." />

                @php $message = "Prix de la pièce détachée à l'unité, sans les centimes.";@endphp
                <x-form.number wire:model="model.price" id="price" name="model.price" label="Prix" placeholder="Prix de la pièce détachée..." :info="true" :infoText="$message" />

                <x-form.checkbox wire:model="model.number_warning_enabled" wire:click="$toggle('numberWarningEnabled')" name="number_warning_enabled" label="Alerte de stock">
                    Cochez pour appliquer une alerte sur le stock
                </x-form.checkbox>

                @if ($numberWarningEnabled)
                    <x-form.number wire:model="model.number_warning_minimum" id="price" name="model.number_warning_minimum" label="Quantité pour l'alerte" placeholder="Quantité pour l'alerte..." />
                @endif

                <x-form.checkbox wire:model="model.number_critical_enabled" wire:click="$toggle('numberCriticalEnabled')" name="number_critical_enabled" label="Alerte de stock critique">
                    Cochez pour appliquer une alerte critique sur le stock
                </x-form.checkbox>

                @if ($numberCriticalEnabled)
                    <x-form.number wire:model="model.number_critical_minimum" id="price" name="model.number_critical_minimum" label="Quantité pour l'alerte critique" placeholder="Quantité pour l'alerte critique..." />
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
