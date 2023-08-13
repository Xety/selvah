<?php

namespace Selvah\Http\Livewire;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;
use Selvah\Http\Livewire\Traits\WithCachedRows;
use Selvah\Http\Livewire\Traits\WithFlash;
use Selvah\Http\Livewire\Traits\WithSorting;
use Selvah\Http\Livewire\Traits\WithBulkActions;
use Selvah\Http\Livewire\Traits\WithPerPagePagination;
use Selvah\Models\Part;
use Selvah\Models\PartEntry;

class PartEntries extends Component
{
    use AuthorizesRequests;
    use WithBulkActions;
    use WithCachedRows;
    use WithFlash;
    use WithPagination;
    use WithPerPagePagination;
    use WithSorting;

    /**
     * The field to sort by.
     *
     * @var string
     */
    public string $sortField = 'created_at';

    /**
     * The direction of the ordering.
     *
     * @var string
     */
    public string $sortDirection = 'desc';

    /**
     * The string to search.
     *
     * @var string
     */
    public string $search = '';

    /**
     * Used to update in URL the query string.
     *
     * @var string[]
     */
    protected $queryString = [
        'sortField' => ['as' => 'f'],
        'sortDirection' => ['as' => 'd'],
        'search' => ['except' => '', 'as' => 's'],
        'qrcode' => ['except' => ''],
        'qrcodeid' => ['except' => ''],
    ];

    /**
     * Whatever the QR COde is set or not.
     *
     * @var bool
     */
    public bool|string $qrcode = '';

    /**
     * The QR Code id if set.
     *
     * @var int
     */
    public null|int $qrcodeid = null;

    /**
     * Array of allowed fields.
     *
     * @var array
     */
    public array $allowedFields = [
        'id',
        'part_id',
        'user_id',
        'number',
        'order_id',
        'created_at'
    ];

    /**
     * The model used in the component.
     *
     * @var PartEntry
     */
    public PartEntry $model;

    /**
     * Used to show the Edit/Create modal.
     *
     * @var bool
     */
    public bool $showModal = false;

    /**
     * Used to show the delete modal.
     *
     * @var bool
     */
    public bool $showDeleteModal = false;

    /**
     * Used to set the modal to Create action (true) or Edit action (false).
     *
     * @var bool
     */
    public bool $isCreating = false;

    /**
     * Number of rows displayed on a page.
     *
     * @var int
     */
    public int $perPage = 25;

    /**
     * Translated attribute used in failed messages.
     *
     * @var array
     */
    protected array $validationAttributes = [
        'part_id' => 'pièce détachée',
        'number' => 'nombre de pièce',
        'order_id' => 'N° de commande'
    ];

    /**
     * Flash messages for the model.
     *
     * @var array
     */
    protected array $flashMessages = [
        'create' => [
            'success' => "L'entrée pour la pièce <b>%s</b> a été créé avec succès !",
            'danger' => "Une erreur s'est produite lors de la création de l'entrée."
        ],
        'update' => [
            'success' => "L'entrée pour la pièce <b>%s</b> a été édité avec succès !",
            'danger' => "Une erreur s'est produite lors de l'édition de l'entrée."
        ],
        'delete' => [
            'success' => "<b>%s</b> entrée(s) ont été supprimée(s) avec succès !",
            'danger' => "Une erreur s'est produite lors de la suppression des entrées !"
        ]
    ];

    /**
     * The Livewire Component constructor.
     *
     * @return void
     */
    public function mount(): void
    {
        $this->model = $this->makeBlankModel();

        if ($this->qrcode === true && $this->qrcodeid !== null) {
            $this->model->part_id = $this->qrcodeid;

            $this->create();
        }

        $this->applySortingOnMount();
    }

    /**
     * Rules used for validating the model.
     *
     * @return array
     */
    public function rules(): array
    {
        $rules = [
            'model.order_id' => 'nullable',
        ];

        if ($this->isCreating) {
            $rules = array_merge($rules, [
                'model.part_id' => 'required|numeric|exists:parts,id',
                'model.number' => 'required|numeric|min:0|max:1000000|not_in:0'
            ]);
        }

        return $rules;
    }

    /**
     * Create a blank model and return it.
     *
     * @return PartEntry
     */
    public function makeBlankModel(): PartEntry
    {
        return PartEntry::make();
    }

    /**
     * Function to render the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.part-entries', [
            'partEntries' => $this->rows,
            'parts' => Part::query()
                ->with(['material' => function ($query) {
                    $query->select('id', 'name');
                }])
                ->select('id', 'name', 'material_id')
                ->get()
                ->toArray()
        ]);
    }

    /**
     * Create and return the query for the items.
     *
     * @return Builder
     */
    public function getRowsQueryProperty(): Builder
    {
        $q = $this->search;

        $query = PartEntry::query()
            ->with('part', 'user')
            ->whereHas('part', function ($partQuery) use ($q) {
                $partQuery->where('name', 'LIKE', '%' . $q . '%');
            })
            ->orWhere('order_id', 'like', '%' . $this->search . '%');

        return $this->applySorting($query);
    }

    /**
     * Build the query or get it from the cache and paginate it.
     *
     * @return LengthAwarePaginator
     */
    public function getRowsProperty(): LengthAwarePaginator
    {
        return $this->cache(function () {
            return $this->applyPagination($this->rowsQuery);
        });
    }

    /**
     * Create a blank model and assign it to the model. (Used in create modal)
     *
     * @return void
     */
    public function create(): void
    {
        $this->authorize('create', PartEntry::class);

        $this->isCreating = true;
        $this->useCachedRows();

        // Reset the model to a blank model before showing the creating modal.
        if ($this->model->getKey()) {
            $this->model = $this->makeBlankModel();
        }
        $this->showModal = true;
    }

    /**
     * Set the model (used in modal) to the partEntry we want to edit.
     *
     * @param PartEntry $partEntry The partEntry id to update.
     * (Livewire will automatically fetch the model by the id)
     *
     * @return void
     */
    public function edit(PartEntry $partEntry): void
    {
        $this->authorize('update', PartEntry::class);

        $this->isCreating = false;
        $this->useCachedRows();

        // Set the model to the part we want to edit.
        if ($this->model->isNot($partEntry)) {
            $this->model = $partEntry;
        }
        $this->showModal = true;
    }

    /**
     * Validate and save the model.
     *
     * @return void
     */
    public function save(): void
    {
        $this->authorize($this->isCreating ? 'create' : 'update', PartEntry::class);

        $this->validate();

        if ($this->model->save()) {
            $this->fireFlash($this->isCreating ? 'create' : 'update', 'success','', [$this->model->part->name]);
        } else {
            $this->fireFlash($this->isCreating ? 'create' : 'update', 'danger');
        }
        $this->showModal = false;
    }
}
