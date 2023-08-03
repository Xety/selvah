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
            @canany(['export', 'delete'], \Selvah\Models\Material::class)
                <div class="dropdown lg:dropdown-end">
                    <label tabindex="0" class="btn btn-neutral m-1">
                        Actions
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill align-bottom" viewBox="0 0 16 16">
                            <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                        </svg>
                    </label>
                    <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52 z-[1]">
                        @can('export', \Selvah\Models\Material::class)
                            <li>
                                <button type="button" class="text-blue-500" wire:click="exportSelected()">
                                    <i class="fa-solid fa-download"></i> Exporter
                                </button>
                            </li>
                        @endcan
                        @can('delete', \Selvah\Models\Material::class)
                            <li>
                                <button type="button" class="text-red-500" wire:click="$toggle('showDeleteModal')">
                                    <i class="fa-solid fa-trash-can"></i> Supprimer
                                </button>
                            </li>
                        @endcan
                    </ul>
                </div>
            @endcanany

            @can('create', \Selvah\Models\Material::class)
                <a href="#" wire:click.prevent="create" class="btn btn-success gap-2">
                    <i class="fa-solid fa-plus"></i>
                    Nouveau Matériel
                </a>
            @endcan
        </div>
    </div>

    <div>
    <x-table.table class="mb-6">
        <x-slot name="head">
            @canany(['export', 'delete'], \Selvah\Models\Material::class)
                <x-table.heading>
                    <label>
                        <input type="checkbox" class="checkbox" wire:model="selectPage" />
                    </label>
                </x-table.heading>
            @endcanany

            <x-table.heading sortable wire:click="sortBy('id')" :direction="$sortField === 'id' ? $sortDirection : null">#Id</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('name')" :direction="$sortField === 'name' ? $sortDirection : null">Nom</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('zone_id')" :direction="$sortField === 'zone_id' ? $sortDirection : null">Zone</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('user_id')" :direction="$sortField === 'user_id' ? $sortDirection : null">Créateur</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('description')" :direction="$sortField === 'description' ? $sortDirection : null">Description</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('incident_count')" :direction="$sortField === 'incident_count' ? $sortDirection : null">Nombre d'incidents</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('part_count')" :direction="$sortField === 'part_count' ? $sortDirection : null">Nombre de pièces détachées</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('maintenance_count')" :direction="$sortField === 'maintenance_count' ? $sortDirection : null">Nombre de maintenances</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('created_at')" :direction="$sortField === 'created_at' ? $sortDirection : null">Créé le</x-table.heading>
            <x-table.heading>Actions</x-table.heading>
        </x-slot>

        <x-slot name="body">
            @if ($selectPage)
            <x-table.row wire:key="row-message">
                <x-table.cell colspan="11">
                    @unless ($selectAll)
                        <div>
                            <span>Vous avez sélectionné <strong>{{ $materials->count() }}</strong> matériel(s), voulez-vous tous les selectionner <strong>{{ $materials->total() }}</strong>?</span>
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
                    @canany(['export', 'delete'], \Selvah\Models\Material::class)
                        <x-table.cell>
                            <label>
                                <input type="checkbox" class="checkbox" wire:model="selected" value="{{ $material->getKey() }}" />
                            </label>
                        </x-table.cell>
                    @endcanany
                    <x-table.cell>{{ $material->getKey() }}</x-table.cell>
                    <x-table.cell>
                        <a class="link link-hover link-primary font-bold" href="{{ $material->show_url }}">
                            {{ $material->name }}
                        </a>
                    </x-table.cell>
                    <x-table.cell>{{ $material->zone->name }}</x-table.cell>
                    <x-table.cell>{{ $material->user->username }}</x-table.cell>
                    <x-table.cell>
                        <span class="tooltip tooltip-top text-left" data-tip="{{ $material->description }}">
                            {{ Str::limit($material->description, 50) }}
                        </span>
                    </x-table.cell>
                    <x-table.cell class="prose">
                        <code class="text-[color:hsl(var(--p))] bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                            {{ $material->incident_count }}
                        </code>
                    </x-table.cell>
                    <x-table.cell class="prose">
                        <code class="text-[color:hsl(var(--p))] bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                            {{ $material->part_count }}
                        </code>
                    </x-table.cell>
                    <x-table.cell class="prose">
                        <code class="text-[color:hsl(var(--p))] bg-[color:var(--tw-prose-pre-bg)] rounded-sm">
                            {{ $material->maintenance_count }}
                        </code>
                    </x-table.cell>
                    <x-table.cell class="capitalize">{{ $material->created_at->translatedFormat( 'D j M Y H:i') }}</x-table.cell>
                    <x-table.cell>
                        @canany(['update', 'generateQrCode'], \Selvah\Models\Material::class)
                            <div class="dropdown dropdown-end">
                                <label tabindex="0" class="btn btn-ghost btn-sm m-1">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </label>
                                <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52 z-[1]">
                                    @can('update', \Selvah\Models\Material::class)
                                        <li>
                                            <a href="#" wire:click.prevent="edit({{ $material->getKey() }})" class="text-blue-500 tooltip tooltip-left" data-tip="Modifier ce matériel">
                                                <i class="fa-solid fa-pen-to-square"></i> Modifier ce matériel
                                            </a>
                                        </li>
                                    @endcan
                                    @can('generateQrCode', \Selvah\Models\Material::class)
                                        <li>
                                            <button type="button" class="text-green-500 tooltip tooltip-left" wire:click="showQrCode({{ $material->getKey() }})" data-tip="Générer un QR Code pour ce matériel">
                                                <i class="fa-solid fa-qrcode"></i> Générer un QR Code
                                            </button>
                                        </li>
                                    @endcan
                                </ul>
                            </div>
                        @endcanany
                    </x-table.cell>
                </x-table.row>
            @empty
                <x-table.row>
                    <x-table.cell colspan="11">
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
    </div>


    <div>
    <!-- Delete Materials Modal -->
    <form wire:submit.prevent="deleteSelected">
        <input type="checkbox" id="deleteModal" class="modal-toggle" wire:model="showDeleteModal" />
        <label for="deleteModal" class="modal cursor-pointer">
            <label class="modal-box relative">
                <label for="deleteModal" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                <h3 class="font-bold text-lg">
                    Supprimer les Matériels
                </h3>
                @if (empty($selected))
                    <p class="my-7">
                        Vous n'avez sélectionné aucun matériel à supprimer.
                    </p>
                @else
                    <p class="my-7">
                        Voulez-vous vraiment supprimer ces matériels ? <span class="font-bold text-red-500">Cette opération n'est pas réversible.</span>
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
    </div>

    <!-- Edit Matériels Modal -->
    <div>
    <form wire:submit.prevent="save">
        <input type="checkbox" id="editModal" class="modal-toggle" wire:model="showModal" />
        <label for="editModal" class="modal cursor-pointer">
            <label class="modal-box relative">
                <label for="editModal" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                <h3 class="font-bold text-lg">
                    {!! $isCreating ? 'Créer un Matériel' : 'Editer le Matériel' !!}
                </h3>

                <x-form.text wire:model="model.name" wire:keyup='generateSlug' id="name" name="model.name" label="Nom" placeholder="Nom..." />

                <x-form.text wire:model="model.slug" id="slug" name="model.slug" label="Slug" disabled />

                @php $message = "Sélectionnez la zone dans laquelle le matériel appartient.";@endphp
                <x-form.select wire:model="model.zone_id" name="model.zone_id"  label="Zone" :info="true" :infoText="$message">
                    <option  value="0">Selectionnez la Zone</option>
                    @foreach($zones as $zoneId => $zoneName)
                    <option  value="{{ $zoneId }}">{{$zoneName}}</option>
                    @endforeach
                </x-form.select>

                @php $message = "Veuillez décrire au mieux le matériel.";@endphp
                <x-form.textarea wire:model="model.description" name="model.description" label="Description du matériel" placeholder="Description du matériel..." :info="true" :infoText="$message" />

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

    <!-- QrCode Matériels Modal -->
    <div>
    <form onsubmit="return false;">
        <input type="checkbox" id="QrCodeModal" class="modal-toggle" wire:model="showQrCodeModal" />
        <label for="QrCodeModal" class="modal cursor-pointer">
            <label class="modal-box relative">
                <label for="QrCodeModal" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                <h3 class="font-bold text-lg mb-2">
                    Générer un QR Code
                </h3>

                <span class="text-gray-600 text-sm mb-3">
                    Le QR Code sera généré pour le matériel <span class="font-bold">{{ $modelQrCode?->name }}</span>
                </span>


                <div class="form-control">
                    <label class="label" for="size">
                        <span class="label-text">Taille</span>
                        <span class="label-text-alt">
                            <div class="dropdown dropdown-hover dropdown-bottom dropdown-end">
                                <label tabindex="0" class="hover:cursor-pointer text-info">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-4 h-4 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </label>
                                <div tabindex="0" class="card compact dropdown-content z-[1] shadow bg-base-100 dark:bg-base-200 rounded-box w-64">
                                    <div class="card-body">
                                        <p>
                                            Sélectionnez la taille du QR Code généré : <br/>
                                                <b>Très Petit</b> (100 pixels)<br/>
                                                <b>Petit</b> (150 pixels)<br/>
                                                <b>Normal</b> (200 pixels)<br/>
                                                <b>Moyen</b> (300 pixels)<br/>
                                                <b>Grand</b> (400 pixels)<br/>
                                                <b>Très Grand</b> (500 pixels)<br/>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </span>
                    </label>
                </div>
                @foreach ($allowedQrCodeSize as $key => $value)
                    <x-form.radio wire:model="qrCodeSize" value="{{ $key }}" name="size">
                        {{ $value['text'] }}
                    </x-form.radio>
                @endforeach

                <x-form.text wire:model="qrCodeLabel" id="label" name="label" label="Label du QR Code" placeholder="Texte du label..." />

                <div>
                    <div class="flex justify-center my-3">
                        <img id="qrCodeImg" src="{{ $qrCodeImg }}" />
                    </div>
                </div>

                <div class="modal-action flex-col md:flex-row gap-2">
                    <a href="#" class="btn btn-info gap-2 !ml-0" onclick="printJS(document.getElementById('qrCodeImg').src, 'image');return false;">
                        <i class="fa-solid fa-print"></i> Imprimer
                    </a>
                    <a href="{{ $qrCodeImg }}" download="qrcode_{{ \Illuminate\Support\Str::slug($modelQrCode?->name) }}.png" class="btn btn-success gap-2 !ml-0">
                        <i class="fa-solid fa-download"></i> Télécharger
                    </a>
                    <label for="QrCodeModal" class="btn btn-neutral !ml-0">Fermer</label>
                </div>
            </label>
        </label>
    </form>
    </div>

</div>
