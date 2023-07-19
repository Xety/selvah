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
            <x-form.text wire:model="search" placeholder="Rechercher des Utilisateurs..." class="lg:max-w-lg" />
        </div>
        <div class="mb-4">
            @canany(['delete'], \Selvah\Models\User::class)
                <div class="dropdown lg:dropdown-end">
                    <label tabindex="0" class="btn btn-neutral m-1">
                        Actions
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill align-bottom" viewBox="0 0 16 16">
                            <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                        </svg>
                    </label>
                    <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52 z-[1]">
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

            @can('create', \Selvah\Models\User::class)
                <a href="#" wire:click.prevent="create" class="btn btn-success gap-2">
                    <i class="fa-solid fa-plus"></i>
                    Nouvel Utilisateur
                </a>
            @endcan
        </div>
    </div>

    <x-table.table class="mb-6">
        <x-slot name="head">
            @canany(['delete'], \Selvah\Models\User::class)
                <x-table.heading>
                    <label>
                        <input type="checkbox" class="checkbox" wire:model="selectPage" />
                    </label>
                </x-table.heading>
            @endcanany
            <x-table.heading sortable wire:click="sortBy('id')" :direction="$sortField === 'id' ? $sortDirection : null">#Id</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('username')" :direction="$sortField === 'username' ? $sortDirection : null">Nom d'Utilisateur</x-table.heading>
            <x-table.heading>Nom</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('email')" :direction="$sortField === 'email' ? $sortDirection : null">Email</x-table.heading>
            <x-table.heading>Rôles</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('last_login')" :direction="$sortField === 'last_login' ? $sortDirection : null">Dernière connexion</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('created_at')" :direction="$sortField === 'created_at' ? $sortDirection : null">Créé le</x-table.heading>
            <x-table.heading>Actions</x-table.heading>
        </x-slot>

        <x-slot name="body">
            @if ($selectPage)
                <x-table.row wire:key="row-message">
                    <x-table.cell colspan="9">
                        @unless ($selectAll)
                            <div>
                                <span>Vous avez sélectionné <strong>{{ $users->count() }}</strong> utilisateur(s), voulez-vous tous les selectionner <strong>{{ $users->total() }}</strong>?</span>
                                <button type="button" wire:click="selectAll" class="btn btn-neutral btn-sm gap-2 ml-1">
                                    <i class="fa-solid fa-check"></i>
                                    Tout sélectionner
                                </button>
                            </div>
                        @else
                            <span>Vous sélectionnez actuellement <strong>{{ $users->total() }}</strong> utilisateur(s).</span>
                        @endif
                    </x-table.cell>
                </x-table.row>
            @endif

            @forelse($users as $user)
                <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $user->getKey() }}">
                    @canany(['delete'], \Selvah\Models\User::class)
                        <x-table.cell>
                            <label>
                                <input type="checkbox" class="checkbox" wire:model="selected" value="{{ $user->getKey() }}" />
                            </label>
                        </x-table.cell>
                    @endcanany
                    <x-table.cell>{{ $user->getKey() }}</x-table.cell>
                    <x-table.cell>
                        <span class="text-primary">
                            {{ $user->username }}
                        </span>
                    </x-table.cell>
                    <x-table.cell>
                        {{ $user->full_name }}
                    </x-table.cell>
                    <x-table.cell>{{ $user->email }}</x-table.cell>
                    <x-table.cell>
                        @forelse ($user->roles as $role)
                            <span style="{{ $role->css }}">
                                {{ $role->name }}
                            </span>
                            <br />
                        @empty
                            Cet utilisateur n'a pas de rôle.
                        @endforelse
                    </x-table.cell>
                    <x-table.cell class="capitalize">
                        {{ $user->last_login?->translatedFormat( 'D j M Y H:i') }}
                    </x-table.cell>
                    <x-table.cell class="capitalize">
                        {{ $user->created_at->translatedFormat( 'D j M Y H:i') }}
                    </x-table.cell>
                    <x-table.cell>
                        @can('update', $user)
                            <a href="#" wire:click.prevent="edit({{ $user->getKey() }})" class="tooltip tooltip-left" data-tip="Modifier cet utilisateur">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        @endcan
                    </x-table.cell>
                </x-table.row>
            @empty
                <x-table.row>
                    <x-table.cell colspan="9">
                        <div class="text-center p-2">
                            <span class="text-muted">Aucun utilisateur trouvé...</span>
                        </div>
                    </x-table.cell>
                </x-table.row>
            @endforelse
        </x-slot>
    </x-table.table>

    <div class="grid grid-cols-1">
        {{ $users->links() }}
    </div>


    <!-- Delete Users Modal -->
    <form wire:submit.prevent="deleteSelected">
        <input type="checkbox" id="deleteModal" class="modal-toggle" wire:model="showDeleteModal" />
        <label for="deleteModal" class="modal cursor-pointer">
            <label class="modal-box relative">
                <label for="deleteModal" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                <h3 class="font-bold text-lg">
                    Supprimer les Utilisateurs
                </h3>
                @if (empty($selected))
                    <p class="my-7">
                        Vous n'avez sélectionné aucun utilisateur à supprimer.
                    </p>
                @else
                    <p class="my-7">
                        Voulez-vous vraiment supprimer ces utilisateurs ? <span class="font-bold text-red-500">Cette opération n'est pas réversible.</span>
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

    <!-- Edit Users Modal -->
    <form wire:submit.prevent="save">
        <input type="checkbox" id="editModal" class="modal-toggle" wire:model="showModal" />
        <label for="editModal" class="modal cursor-pointer">
            <label class="modal-box relative">
                <label for="editModal" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                <h3 class="font-bold text-lg">
                    {!! $isCreating ? 'Créer un Utilisateur' : 'Editer le Utilisateur' !!}
                </h3>

                <x-form.text wire:model="model.username" name="model.username" label="Nom d'Utilisateur" placeholder="Nom d'Utilisateur..." />

                <x-form.text wire:model="model.first_name" name="model.first_name" label="Prénom" placeholder="Prénom..." />
                <x-form.text wire:model="model.last_name" name="model.last_name" label="Nom" placeholder="Nom..." />

                <x-form.email wire:model="model.email" name="model.email" label="Email" placeholder="Email..." />

                <x-form.select wire:model="rolesSelected" name="rolesSelected"  label="Rôles" multiple>
                    @foreach($roles as $roleId => $roleName)
                    <option  value="{{ $roleId }}">{{$roleName}}</option>
                    @endforeach
                </x-form.select>
                @if ($isCreating)
                    <x-form.password wire:model="password" name="password" label="Mot de Passe" placeholder="Mot de Passe..." />
                    <x-form.password wire:model="password_confirmation" name="password_confirmation" label="Mot de Passe Confirmation" placeholder="Confirmation du Mot de Passe..." />
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
