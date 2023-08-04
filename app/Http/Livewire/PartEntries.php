<?php

namespace Selvah\Http\Livewire;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;
use Selvah\Http\Livewire\Traits\WithCachedRows;
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
    use WithPagination;
    use WithPerPagePagination;
    use WithSorting;

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
    public bool $qrcode = false;

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
     * @var string[]
     */
    protected $validationAttributes = [
        'part_id' => 'pièce détachée',
        'number' => 'nombre de pièce',
        'order_id' => 'N° de commande'
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
     * @return string[]
     */
    public function rules()
    {
        $rules = [
            'model.order_id' => 'required|min:3',
        ];

        if ($this->isCreating) {
            $rules = array_merge($rules, [
                'model.part_id' => 'required|numeric|exists:parts,id',
                'model.number' => 'required|numeric|min:0|not_in:0'
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
    public function render()
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
        $this->authorize('update', $partEntry);

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
        if ($this->isCreating === true) {
            $this->authorize('create', PartEntry::class);
        } else {
            $this->authorize('update', $this->model);
        }

        $this->validate();

        if ($this->model->save()) {
            $this->fireFlash('save', 'success');
        } else {
            $this->fireFlash('save', 'danger');
        }
        $this->showModal = false;
    }

    /**
     * Display a flash message regarding the action that fire it and the type of the message, then emit an
     * `alert ` event.
     *
     * @param string $action The action that fire the flash message.
     * @param string $type The type of the message, success or danger.
     * @param int $deleteCount If set, the number of parts that has been deleted.
     *
     * @return void
     */
    public function fireFlash(string $action, string $type, int $deleteCount = 0)
    {
        switch ($action) {
            case 'save':
                if ($type == 'success') {
                    session()->flash(
                        'success',
                        $this->isCreating ? "L'entrée a été créé avec succès !" :
                            "L'entrée pour la pièce <b>{$this->model->part->name}</b> a été édité avec succès !"
                    );
                } else {
                    session()->flash('danger', "Une erreur s'est produite lors de l'enregistrement de l'entrée");
                }
                break;

            case 'delete':
                if ($type == 'success') {
                    session()->flash('success', "<b>{$deleteCount}</b> entrée(s) ont été supprimée(s) avec succès !");
                } else {
                    session()->flash('danger', "Une erreur s'est produite lors de la suppression des entrées !");
                }
                break;
        }

        // Emit the alert event to the front so the DIsmiss can trigger the flash message.
        $this->emit('alert');
    }
}
