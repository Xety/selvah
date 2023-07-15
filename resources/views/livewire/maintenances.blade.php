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
            <x-form.text wire:model="search" placeholder="Rechercher des Maintenances..." class="lg:max-w-lg" />
        </div>
        <div class="mb-4">
            @if(
                auth()->user()->can('Gérer les Maintenances') ||
                auth()->user()->can('Gérer les Exports')
            )
                <div class="dropdown lg:dropdown-end">
                    <label tabindex="0" class="btn btn-neutral m-1">
                        Actions
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill align-bottom" viewBox="0 0 16 16">
                            <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                        </svg>
                    </label>
                    <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52 z-[1]">
                        <li>
                            <button type="button" class="text-blue-500" wire:click="exportSelected()">
                                <i class="fa-solid fa-download"></i> Exporter
                            </button>
                        </li>
                        @can('Gérer les Maintenances')
                            <li>
                                <button type="button" class="text-red-500" wire:click="$toggle('showDeleteModal')">
                                    <i class="fa-solid fa-trash-can"></i> Supprimer
                                </button>
                            </li>
                        @endcan
                    </ul>
                </div>
            @endif
            <a href="#" wire:click.prevent="create" class="btn btn-neutral gap-2">
                <i class="fa-solid fa-plus"></i>
                Nouvelle Maintenance
            </a>
        </div>
    </div>

    <x-table.table class="mb-6">
        <x-slot name="head">
            @if(
                auth()->user()->can('Gérer les Maintenances') ||
                auth()->user()->can('Gérer les Exports')
            )
                <x-table.heading>
                    <label>
                        <input type="checkbox" class="checkbox" wire:model="selectPage" />
                    </label>
                </x-table.heading>
            @endif
            <x-table.heading sortable wire:click="sortBy('id')" :direction="$sortField === 'id' ? $sortDirection : null">#Id</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('gmao_id')" :direction="$sortField === 'gmao_id' ? $sortDirection : null">N° GMAO</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('material_id')" :direction="$sortField === 'material_id' ? $sortDirection : null">Matériel</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('description')" :direction="$sortField === 'description' ? $sortDirection : null">Description</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('reason')" :direction="$sortField === 'reason' ? $sortDirection : null">Raison</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('user_id')" :direction="$sortField === 'user_id' ? $sortDirection : null">Créateur</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('type')" :direction="$sortField === 'type' ? $sortDirection : null">Type</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('realization')" :direction="$sortField === 'realization' ? $sortDirection : null">Réalisation</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('started_at')" :direction="$sortField === 'started_at' ? $sortDirection : null">Commencée le</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('finished_at')" :direction="$sortField === 'finished_at' ? $sortDirection : null">Finie le</x-table.heading>
            <x-table.heading>Actions</x-table.heading>
        </x-slot>

        <x-slot name="body">
            @if ($selectPage)
            <x-table.row wire:key="row-message">
                <x-table.cell colspan="14">
                    @unless ($selectAll)
                        <div>
                            <span>Vous avez sélectionné <strong>{{ $maintenances->count() }}</strong> maintenance(s), voulez-vous tous les selectionner <strong>{{ $maintenances->total() }}</strong>?</span>
                            <button type="button" wire:click="selectAll" class="btn btn-neutral btn-sm gap-2 ml-1">
                                <i class="fa-solid fa-check"></i>
                                Tout sélectionner
                            </button>
                        </div>
                    @else
                        <span>Vous sélectionnez actuellement <strong>{{ $maintenances->total() }}</strong> maintenance(s).</span>
                    @endif
                </x-table.cell>
            </x-table.row>
            @endif

            @forelse($maintenances as $maintenance)
                <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $maintenance->getKey() }}">
                    @if(
                        auth()->user()->can('Gérer les Maintenances') ||
                        auth()->user()->can('Gérer les Exports')
                    )
                        <x-table.cell>
                            <label>
                                <input type="checkbox" class="checkbox" wire:model="selected" value="{{ $maintenance->getKey() }}" />
                            </label>
                        </x-table.cell>
                    @endif
                    <x-table.cell>
                        <a class="link link-hover link-primary tooltip tooltip-right" href="{{ route('maintenance.show', $maintenance) }}" data-tip="Voir la fiche Maintenance">
                           <span class="font-bold">{{ $maintenance->getKey() }}</span>
                        </a>
                    </x-table.cell>
                    <x-table.cell class="prose">
                        @unless (is_null($maintenance->gmao_id))
                            <code class="text-[color:hsl(var(--p))] bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                            {{ $maintenance->gmao_id }}
                        </code>
                        @endunless
                    </x-table.cell>
                    <x-table.cell class="prose">
                        @unless (is_null($maintenance->material_id))
                            <a class="link link-hover link-primary font-bold" href="{{ route('material.show', ['id' => $maintenance->material->id, 'slug' => $maintenance->material->slug]) }}">
                                {{ $maintenance->material->name }}
                            </a>
                        @endunless
                    </x-table.cell>
                    <x-table.cell>
                        {{ Str::limit($maintenance->description, 80) }}
                    </x-table.cell>
                    <x-table.cell>
                        {{ Str::limit($maintenance->reason, 80) }}
                    </x-table.cell>
                    <x-table.cell>{{ $maintenance->user->username }}</x-table.cell>
                    <x-table.cell>
                        @if ($maintenance->type === 'curative')
                            <span class="font-bold text-red-500">Curative</span>
                        @else
                            <span class="font-bold text-green-500">Préventive</span>
                        @endif
                    </x-table.cell>
                    <x-table.cell>
                        @if ($maintenance->realization === 'external')
                            <span class="font-bold text-red-500">Externe</span>
                        @elseif ($maintenance->realization === 'internal')
                            <span class="font-bold text-green-500">Interne</span>
                        @else
                            <span class="font-bold text-yellow-500">Interne et Externe</span>
                        @endif
                    </x-table.cell>
                    <x-table.cell class="capitalize">
                        {{ $maintenance->started_at?->translatedFormat( 'D j M Y H:i') }}
                    </x-table.cell>
                    <x-table.cell class="capitalize">
                        {{ $maintenance->finished_at?->translatedFormat( 'D j M Y H:i') }}
                    </x-table.cell>
                    <x-table.cell>
                        <a href="#" wire:click.prevent="edit({{ $maintenance->getKey() }})" class="tooltip tooltip-left" data-tip="Modifier cette maintenance">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                    </x-table.cell>
                </x-table.row>
            @empty
                <x-table.row>
                    <x-table.cell colspan="14">
                        <div class="text-center p-2">
                            <span class="text-muted">Aucune maintenance trouvée...</span>
                        </div>
                    </x-table.cell>
                </x-table.row>
            @endforelse
        </x-slot>
    </x-table.table>

    <div class="grid grid-cols-1">
        {{ $maintenances->links() }}
    </div>


    <!-- Delete Maintenances Modal -->
    <form wire:submit.prevent="deleteSelected">
        <input type="checkbox" id="deleteModal" class="modal-toggle" wire:model="showDeleteModal" />
        <label for="deleteModal" class="modal cursor-pointer">
            <label class="modal-box relative">
                <label for="deleteModal" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                <h3 class="font-bold text-lg">
                    Supprimer les Maintenances
                </h3>
                @if (empty($selected))
                    <p class="my-7">
                        Vous n'avez sélectionné aucune maintenance à supprimer.
                    </p>
                @else
                    <p class="my-7">
                        Voulez-vous vraiment supprimer ces maintenances ? <span class="font-bold text-red-500">Cette opération n'est pas réversible.</span>
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

    <!-- Edit Maintenances Modal -->
    <div>
    <form wire:submit.prevent="save">
        <input type="checkbox" id="editModal" class="modal-toggle" wire:model="showModal" />
        <label for="editModal" class="modal cursor-pointer">
            <label class="modal-box relative">
                <label for="editModal" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                <h3 class="font-bold text-lg">
                    {!! $isCreating ? 'Créer une Maintenance' : 'Editer la Maintenance' !!}
                </h3>

                @php $message = "Indiquez le numéro de GMAO ou laissez vide si aucun numéro.";@endphp
                <x-form.text wire:model="model.gmao_id" id="name" name="model.gmao_id" label="N° GMAO" placeholder="N° GMAO..." :info="true" :infoText="$message" />

                @php $message = "Sélectionnez le matériel pour lequel la maintenance a eu lieu.<br><i>Note: si la maintenance appartient à aucun matériel, sélectionnez <b>\"Aucun matériel\"</b></i> ";@endphp
                <x-form.select wire:model="model.material_id" name="model.material_id"  label="Materiel" :info="true" :infoText="$message">
                    <option  value="0">Selectionnez un matériel</option>
                    <option  value="">Aucun matériel</option>
                    @foreach($materials as $materialId => $materialName)
                    <option  value="{{ $materialId }}">{{$materialName}}</option>
                    @endforeach
                </x-form.select>

                @php $message = "Veuillez décrire au mieux le déroulé de la maintenance.";@endphp
                <x-form.textarea wire:model="model.description" name="model.description" label="Description" placeholder="Description de la maintenance..." :info="true" :infoText="$message" />

                @php $message = "Veuillez décrire au mieux la raison de la maintenance.";@endphp
                <x-form.textarea wire:model="model.reason" name="model.reason" label="Raison" placeholder="Raison de la maintenance..." :info="true" :infoText="$message" />

                <div class="form-control">
                        <label class="label" for="type">
                            <span class="label-text">Type</span>
                            <span class="label-text-alt">
                                <div class="dropdown dropdown-hover dropdown-bottom dropdown-end">
                                    <label tabindex="0" class="hover:cursor-pointer text-info">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-4 h-4 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </label>
                                    <div tabindex="0" class="card compact dropdown-content z-[1] shadow bg-base-100 rounded-box w-64">
                                        <div class="card-body">
                                            <p>
                                                Sélectionnez le type de la maintenance : <br/>
                                                    <b>Curative</b> (Maintenance servant à réparer un accident)<br/>
                                                    <b>Préventive</b> (Maintenance servant à éviter un acccident)
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </span>
                        </label>
                </div>
                @foreach (\Selvah\Models\Maintenance::TYPES as $key => $value)
                    <x-form.radio wire:model="model.type" value="{{ $key }}" name="type">
                        {{ $value }}
                    </x-form.radio>
                @endforeach

                <div class="form-control">
                        <label class="label" for="type">
                            <span class="label-text">Réalisation</span>
                            <span class="label-text-alt">
                                <div class="dropdown dropdown-hover dropdown-bottom dropdown-end">
                                    <label tabindex="0" class="hover:cursor-pointer text-info">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-4 h-4 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </label>
                                    <div tabindex="0" class="card compact dropdown-content z-[1] shadow bg-base-100 rounded-box w-64">
                                        <div class="card-body">
                                            <p>
                                                Sélectionnez le type de réalisation: <br/>
                                                    <b>Interne</b> (Réalisé par un opérateur SELVAH)<br/>
                                                    <b>Externe</b> (Réalisé par une entreprise extérieur)<br/>
                                                    <b>Interne et Externe</b> (Réalisé par une entreprise extérieur et un/des opérateur(s) SELVAH)
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </span>
                        </label>
                </div>
                @foreach (\Selvah\Models\Maintenance::REALIZATIONS as $key => $value)
                    <x-form.radio wire:model="model.realization" value="{{ $key }}" name="type">
                        {{ $value }}
                    </x-form.radio>
                @endforeach

                @if ($model->realization == 'internal' || $model->realization == 'both')
                @php $message = "Indiquez le(s) opérateur(s) SELVAH ayant éffectué(s) la maintenance. <b>UNIQUEMENT si un opérateur est intervenu lors de la maintenance.</b>";@endphp
                <x-form.select wire:model="operatorsSelected" name="operatorsSelected"  label="Opérateur(s)" multiple>
                    @foreach($operators as $operatorId => $operatorName)
                    <option  value="{{ $operatorId }}">{{$operatorName}}</option>
                    @endforeach
                </x-form.select>
                @endif

                @if ($model->realization == 'external' || $model->realization == 'both')
                    <x-form.select wire:model="companiesSelected" name="companiesSelected"  label="Entreprise(s)" multiple>
                    @foreach($companies as $companyId => $companyName)
                        <option  value="{{ $companyId }}">{{$companyName}}</option>
                        @endforeach
                    </x-form.select>
                @endif

                @php $message = "Date à laquelle la maintenance à commencée.";@endphp
                <x-form.date wire:model="started_at" name="started_at" label="Commencée le" placeholder="Commencée le..." :info="true" :infoText="$message" />

                @php $message = "Date à laquelle la maintenance à finie.";@endphp
                <x-form.date wire:model="finished_at" name="finished_at" label="Finie le" placeholder="Finie le..." :info="true" :infoText="$message" />

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
