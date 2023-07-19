<?php

namespace Selvah\Http\Livewire;

use Carbon\Carbon;
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
use Selvah\Models\Lot;

class Lots extends Component
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
        'search' => ['except' => '', 'as' => 's']
    ];

    /**
     * The model used in the component.
     *
     * @var Lot
     */
    public Lot $model;

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
     * @var int
     */
    public int $perPage = 10;

    /**
     * The date when the trituration started.
     *
     * @var string
     */
    public string $crushedSeedsStartedAt;

    /**
     * The date when the trituration finished.
     *
     * @var string
     */
    public string $crushedSeedsFinishedAt;

    /**
     * The date when the extrusion started.
     *
     * @var string
     */
    public string $extrusionStartedAt;

    /**
     * The date when the extrusion finished.
     *
     * @var string
     */
    public string $extrusionFinishedAt;

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
            'model.number' => 'required|min:7|max:7|unique:lots,number,' . $this->model->id,
            'model.description' => 'nullable',
            'model.crushed_seeds' => 'required|numeric',
            'model.harvest' => 'required|numeric',
            'crushedSeedsStartedAt' => 'required|date_format:"d-m-Y H:i"',
            'crushedSeedsFinishedAt' => 'required|date_format:"d-m-Y H:i"',
            'model.crude_oil_production' => 'required|numeric',
            'model.soy_hull' => 'required|numeric',
            'extrusionStartedAt' => 'required|date_format:"d-m-Y H:i"',
            'extrusionFinishedAt' => 'required|date_format:"d-m-Y H:i"',
            'model.extruded_flour' => 'required|numeric',
            'model.bagged_tvp' => 'required|numeric',
            'model.compliant_bagged_tvp' => 'required|numeric',
        ];
    }

    /**
     * Create a blank model and return it.
     *
     * @return Lot
     */
    public function makeBlankModel(): Lot
    {
        return Lot::make();
    }

    /**
     * Function to render the component.
     *
     * @return View
     */
    public function render()
    {
        return view('livewire.lots', [
            'lots' => $this->rows
        ]);
    }

    /**
     * Create and return the query for the items.
     *
     * @return Builder
     */
    public function getRowsQueryProperty(): Builder
    {
        $query = Lot::query()
            ->search('number', $this->search);

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
        $this->authorize('create', Lot::class);

        $this->isCreating = true;
        $this->useCachedRows();

        // Reset the model to a blank model before showing the creating modal.
        if ($this->model->getKey()) {
            $this->model = $this->makeBlankModel();
            $this->crushedSeedsStartedAt = '';
            $this->crushedSeedsFinishedAt = '';
            $this->extrusionStartedAt = '';
            $this->extrusionFinishedAt = '';
        }
        $this->showModal = true;
    }

    /**
     * Set the model (used in modal) to the lot we want to edit.
     *
     * @param Lot $lot The lot id to update.
     * (Livewire will automatically fetch the model by the id)
     *
     * @return void
     */
    public function edit(Lot $lot): void
    {
        $this->authorize('update', $lot);

        $this->isCreating = false;
        $this->useCachedRows();

        // Set the model to the lot we want to edit.
        if ($this->model->isNot($lot)) {
            $this->model = $lot;
            $this->crushedSeedsStartedAt = $this->model->crushed_seeds_started_at->format('d-m-Y H:i');
            $this->crushedSeedsFinishedAt = $this->model->crushed_seeds_finished_at->format('d-m-Y H:i');
            $this->extrusionStartedAt = $this->model->extrusion_started_at->format('d-m-Y H:i');
            $this->extrusionFinishedAt = $this->model->extrusion_finished_at->format('d-m-Y H:i');
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
            $this->authorize('create', Lot::class);
        } else {
            $this->authorize('update', $this->model);
        }

        $this->validate();

        $this->model->crushed_seeds_started_at = Carbon::createFromFormat('d-m-Y H:i', $this->crushedSeedsStartedAt);
        $this->model->crushed_seeds_finished_at = Carbon::createFromFormat('d-m-Y H:i', $this->crushedSeedsFinishedAt);
        $this->model->extrusion_started_at = Carbon::createFromFormat('d-m-Y H:i', $this->extrusionStartedAt);
        $this->model->extrusion_finished_at = Carbon::createFromFormat('d-m-Y H:i', $this->extrusionFinishedAt);

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
     * @param int $deleteCount If set, the number of rows that has been deleted.
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
                        $this->isCreating ? "Le lot a été créé avec succès !" :
                            "Le lot <b>{$this->model->number}</b> a été édité avec succès !"
                    );
                } else {
                    session()->flash('danger', "Une erreur s'est produite lors de l'enregistrement du lot !");
                }
                break;

            case 'delete':
                if ($type == 'success') {
                    session()->flash('success', "<b>{$deleteCount}</b> lot(s) ont été supprimé(s) avec succès !");
                } else {
                    session()->flash('danger', "Une erreur s'est produite lors de la suppression des lots !");
                }
                break;
        }

        // Emit the alert event to the front so the DIsmiss can trigger the flash message.
        $this->emit('alert');
    }
}
