<?php

namespace Selvah\Http\Livewire;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;
use Selvah\Http\Livewire\Traits\WithCachedRows;
use Selvah\Http\Livewire\Traits\WithSorting;
use Selvah\Http\Livewire\Traits\WithBulkActions;
use Selvah\Http\Livewire\Traits\WithPerPagePagination;
use Selvah\Models\Maintenance;
use Selvah\Models\Material;
use Selvah\Models\Part;
use Selvah\Models\PartExit;
use Selvah\Models\Zone;

class PartExits extends Component
{
    use WithPagination;
    use WithSorting;
    use WithCachedRows;
    use WithBulkActions;
    use WithPerPagePagination;

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
        'search' => ['except' => '', 'as' => 's']
    ];

    /**
     * The model used in the component.
     *
     * @var PartExit
     */
    public PartExit $model;

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
     * The Livewire Component constructor.
     *
     * @return void
     */
    public function mount(): void
    {
        $this->model = $this->makeBlankModel();
    }

    /**
     * Rules used for validating the model.
     *
     * @return string[]
     */
    public function rules()
    {
        return [
            'model.part_id' => 'required|numeric|exists:parts,id',
            'model.maintenance_id' => 'present|numeric|exists:maintenances,id|nullable',
            'model.number' => 'required|numeric|min:0|not_in:0',
            'model.description' => 'nullable|min:3',
        ];
    }

    /**
     * Create a blank model and return it.
     *
     * @return PartExit
     */
    public function makeBlankModel(): PartExit
    {
        return PartExit::make();
    }

    /**
     * Function to render the component.
     *
     * @return View
     */
    public function render()
    {
        return view('livewire.part-exits', [
            'partExits' => $this->rows,
            'parts' => Part::query()
                ->with(['material' => function ($query) {
                    $query->select('id', 'name');
                }])
                ->select('id', 'name', 'material_id')
                ->get()
                ->toArray(),
            'maintenances' => Maintenance::query()
                ->with(['material' => function ($query) {
                    $query->select('id', 'name');
                }])
                ->select('id', 'material_id')
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

        $query = PartExit::whereHas('part', function ($partQuery) use ($q) {
            $partQuery->where('name', 'LIKE', '%' . $q . '%');
        })
            ->orWhere('description', 'like', '%' . $this->search . '%');

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
     * @param PartExit $partExit The partEntry id to update.
     * (Livewire will automatically fetch the model by the id)
     *
     * @return void
     */
    public function edit(PartExit $partExit): void
    {
        $this->isCreating = false;
        $this->useCachedRows();

        // Set the model to the part we want to edit.
        if ($this->model->isNot($partExit)) {
            $this->model = $partExit;
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
        $this->validate();

        // If the maintenance_id is "", assign it to null.
        $this->model->maintenance_id = !empty($this->model->maintenance_id) ? $this->model->maintenance_id : null;

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
                        $this->isCreating ? "La sortie a été créé avec succès !" :
                            "La sortie pour la pièce <b>{$this->model->part->name}</b> a été édité avec succès !"
                    );
                } else {
                    session()->flash('danger', "Une erreur s'est produite lors de l'enregistrement de la sortie");
                }
                break;

            case 'delete':
                if ($type == 'success') {
                    session()->flash('success', "<b>{$deleteCount}</b> sortie(s) ont été supprimée(s) avec succès !");
                } else {
                    session()->flash('danger', "Une erreur s'est produite lors de la suppression des sorties !");
                }
                break;
        }

        // Emit the alert event to the front so the DIsmiss can trigger the flash message.
        $this->emit('alert');
    }
}
