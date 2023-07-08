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
            <x-form.text wire:model="search" placeholder="Rechercher des paramètres..." class="lg:max-w-lg" />
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
                Nouveau Paramètre
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
            <x-table.heading>Valeur</x-table.heading>
            <x-table.heading>Type</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('description')" :direction="$sortField === 'description' ? $sortDirection : null">Description</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('is_deletable')" :direction="$sortField === 'is_deletable' ? $sortDirection : null">Supprimable</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('created_at')" :direction="$sortField === 'created_at' ? $sortDirection : null">Créé le</x-table.heading>
            <x-table.heading>Actions</x-table.heading>
        </x-slot>

        <x-slot name="body">
            @if ($selectPage)
            <x-table.row wire:key="row-message" >
                <x-table.cell colspan="9">
                    <div>
                        <span>Vous avez sélectionné <strong>{{ $settings->count() }}</strong> paramètre(s).
                    </div>
                </x-table.cell>
            </x-table.row>
            @endif

            @forelse($settings as $setting)
                <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $setting->getKey() }}">
                    <x-table.cell>
                        <label>
                            <input type="checkbox" class="checkbox" wire:model="selected" value="{{ $setting->getKey() }}" />
                        </label>
                    </x-table.cell>
                    <x-table.cell>{{ $setting->getKey() }}</x-table.cell>
                    <x-table.cell class="prose"><code class="text-[color:hsl(var(--p))] bg-[color:var(--tw-prose-pre-bg)] rounded-sm">{{ $setting->name }}</code></x-table.cell>
                    <x-table.cell class="prose">
                        <code class="text-[color:hsl(var(--p))] bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                            @if ($setting->type == "value_bool")
                                @if ($setting->value == false)
                                    false
                                @else
                                    true
                                @endif
                            @else
                                {{ (string)$setting->value }}
                            @endif
                        </code>
                    </x-table.cell>
                    <x-table.cell class="prose">
                        <code class="text-[color:hsl(var(--p))] bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                            @if ($setting->type == "value_bool")
                                boolean
                            @elseif ($setting->type == "value_int")
                                integer
                            @else
                                string
                            @endif
                        </code>
                    </x-table.cell>
                    <x-table.cell>{{ $setting->description }}</x-table.cell>
                    <x-table.cell>
                        @if ($setting->is_deletable)
                            <span class="font-bold text-red-500">Oui</span>
                        @else
                            <span class="font-bold text-green-500">Non</span>
                        @endif
                    </x-table.cell>
                    <x-table.cell class="capitalize">{{ $setting->created_at->translatedFormat( 'D j M Y H:i') }}</x-table.cell>
                    <x-table.cell>
                        <a href="#" wire:click.prevent="edit({{ $setting->getKey() }})" class="tooltip" data-tip="Modifier ce paramètre">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                    </x-table.cell>
                </x-table.row>
            @empty
                <x-table.row>
                    <x-table.cell colspan="9">
                        <div class="text-center p-2">
                            <span class="text-muted">Aucun paramètre trouvé...</span>
                        </div>
                    </x-table.cell>
                </x-table.row>
            @endforelse
        </x-slot>
    </x-table.table>

    <div class="grid grid-cols-1">
        {{ $settings->links() }}
    </div>


    <!-- Delete Settings Modal -->
    <form wire:submit.prevent="deleteSelected">
        <input type="checkbox" id="deleteModal" class="modal-toggle" wire:model="showDeleteModal" />
        <label for="deleteModal" class="modal cursor-pointer">
            <label class="modal-box relative">
                <label for="deleteModal" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                <h3 class="font-bold text-lg">
                    Supprimer les Paramètres
                </h3>
                @if (empty($selected))
                    <p class="my-7">
                        Vous n'avez sélectionné aucun paramètre à supprimer.
                    </p>
                @else
                    <p class="my-7">
                        Voulez-vous vraiment supprimer ces paramètres ? <span class="font-bold text-red-500">Cette opération n'est pas réversible.</span>
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

    <!-- Edit Setting Modal -->
    <form wire:submit.prevent="save">
        <input type="checkbox" id="editModal" class="modal-toggle" wire:model="showModal" />
        <label for="editModal" class="modal cursor-pointer">
            <label class="modal-box relative">
                <label for="editModal" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                <h3 class="font-bold text-lg">
                    {!! $isCreating ? 'Créer un Paramètre' : 'Editer le Paramètre' !!}
                </h3>

                <x-form.text wire:model="model.name" wire:keyup='generateName' name="model.name" label="Nom" placeholder="Nom..." />

                <x-form.text wire:model="slug" id="slug" name="slug" label="Slug" disabled />

                <x-form.text wire:model="value" id="value" name="value" label="Valeur" placeholder="Valeur..." />

                <div class="form-control w-full max-w-xs">
                        <label class="label" for="type">
                            <span class="label-text">Type</span>
                        </label>
                </div>

                @foreach (\Selvah\Models\Setting::TYPES as $key => $value)
                    <x-form.radio wire:model="type" value="{{ $key }}" name="type">
                        {{ $value }}
                    </x-form.radio>
                @endforeach

                <x-form.textarea wire:model="model.description" name="model.description" label="Description" placeholder="Description..." />

                <x-form.checkbox wire:model="model.is_deletable" name="is_deletable" label="Supprimable">
                    Cochez pour rendre ce paramètre supprimable
                </x-form.checkbox>

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