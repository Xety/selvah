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
use Selvah\Http\Livewire\Traits\WithFlash;
use Selvah\Http\Livewire\Traits\WithSorting;
use Selvah\Http\Livewire\Traits\WithBulkActions;
use Selvah\Http\Livewire\Traits\WithPerPagePagination;
use Selvah\Models\Lot;

class Lots extends Component
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
        'search' => ['except' => '', 'as' => 's']
    ];

    /**
     * Array of allowed fields.
     *
     * @var array
     */
    public array $allowedFields = [
        'id',
        'number',
        'crushed_seeds',
        'crude_oil_production',
        'soy_hull',
        'extruded_flour',
        'bagged_tvp',
        'compliant_bagged_tvp',
        'created_at'
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
     * Translated attribute used in failed messages.
     *
     * @var string[]
     */
    protected $validationAttributes = [
        'number' => 'N° de lot',
        'crushed_seeds' => 'graines broyées',
        'harvest' => 'année',
        'crushedSeedsStartedAt' => 'trituration commencé le',
        'crushedSeedsFinishedAt' => 'trituration finie le',
        'crude_oil_production' => 'production huile brute',
        'soy_hull' => 'production coques',
        'extrusionStartedAt' => 'extrusion commencé le',
        'extrusionFinishedAt' => 'extrusion finie le',
        'extruded_flour' => 'farine extrudée',
        'bagged_tvp' => 'PVT ensachés',
        'compliant_bagged_tvp' => 'PVT ensachés conformes',
    ];

    /**
     * Flash messages for the model.
     *
     * @var array
     */
    protected array $flashMessages = [
        'create' => [
            'success' => "Le lot <b>%s</b> a été créé avec succès !",
            'danger' => "Une erreur s'est produite lors de la création du lot !"
        ],
        'update' => [
            'success' => "Le lot <b>%s</b> a été édité avec succès !",
            'danger' => "Une erreur s'est produite lors de l'édition du lot !"
        ],
        'delete' => [
            'success' => "<b>%s</b> lot(s) ont été supprimé(s) avec succès !",
            'danger' => "Une erreur s'est produite lors de la suppression des lots !"
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

        $this->applySortingOnMount();
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
            ->with('user')
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
        $this->authorize('update', Lot::class);

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
        $this->authorize($this->isCreating ? 'create' : 'update', Lot::class);

        $this->validate();

        $this->model->crushed_seeds_started_at = Carbon::createFromFormat('d-m-Y H:i', $this->crushedSeedsStartedAt);
        $this->model->crushed_seeds_finished_at = Carbon::createFromFormat('d-m-Y H:i', $this->crushedSeedsFinishedAt);
        $this->model->extrusion_started_at = Carbon::createFromFormat('d-m-Y H:i', $this->extrusionStartedAt);
        $this->model->extrusion_finished_at = Carbon::createFromFormat('d-m-Y H:i', $this->extrusionFinishedAt);

        if ($this->model->save()) {
            $this->fireFlash($this->isCreating ? 'create' : 'update', 'success', '', [$this->model->number]);
        } else {
            $this->fireFlash($this->isCreating ? 'create' : 'update', 'danger');
        }
        $this->showModal = false;
    }
}
