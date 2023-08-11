<?php

namespace Selvah\Http\Livewire;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;
use Selvah\Http\Livewire\Traits\WithCachedRows;
use Selvah\Http\Livewire\Traits\WithFlash;
use Selvah\Http\Livewire\Traits\WithSorting;
use Selvah\Http\Livewire\Traits\WithBulkActions;
use Selvah\Http\Livewire\Traits\WithPerPagePagination;
use Selvah\Models\Setting;

class Settings extends Component
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
     * @var array
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
        'name',
        'description',
        'created_at'
    ];

    /**
     * The model used in the component.
     *
     * @var Setting
     */
    public Setting $model;

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
     * The slug displayed in the form and used to replace the name.
     *
     * @var string
     */
    public string $slug = '';

    /**
     * The type of value.
     *
     * @see Setting::TYPES
     *
     * @var string
     */
    public $type = 'value_bool';

    /**
     * The value of the setting.
     *
     * @var string
     */
    public $value = '';

    /**
     * Translated attribute used in failed messages.
     *
     * @var string[]
     */
    protected $validationAttributes = [
        'name' => 'nom',
        'value' => 'valeur'
    ];

    /**
     * Flash messages for the model.
     *
     * @var array
     */
    protected array $flashMessages = [
        'create' => [
            'success' => "Le paramètre <b>%s</b> a été créé avec succès !",
            'danger' => "Une erreur s'est produite lors de la création du paramètre !"
        ],
        'update' => [
            'success' => "Le paramètre <b>%s</b> a été édité avec succès !",
            'danger' => "Une erreur s'est produite lors de l'édition du paramètre !"
        ],
        'delete' => [
            'success' => "<b>%s</b> paramètre(s) ont été supprimé(s) avec succès !",
            'danger' => "Une erreur s'est produite lors de la suppression des paramètres !"
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
            'model.name' => 'required|min:5|max:30|unique:settings,name,' . $this->model->id,
            'value' => 'required',
            'type' => 'required|in:' . collect(Setting::TYPES)->keys()->implode(','),
            'model.description' => 'required|min:5|max:150',
        ];
    }

    /**
     * Create a blank model and return it.
     *
     * @return Setting
     */
    public function makeBlankModel(): Setting
    {
        return Setting::make();
    }

    /**
     * Generate the slug from the name and assign it to the slug variable.
     *
     * @return void
     */
    public function generateName(): void
    {
        $this->slug = Str::slug($this->model->name, '.');
    }

    /**
     * Function to render the component.
     *
     * @return View
     */
    public function render()
    {
        return view('livewire.settings', [
            'settings' => $this->rows
        ]);
    }

    /**
     * Create and return the query for the items.
     *
     * @return Builder
     */
    public function getRowsQueryProperty(): Builder
    {
        $query = Setting::query()
            ->search('name', $this->search);

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
        $this->authorize('create', Setting::class);

        $this->isCreating = true;
        $this->useCachedRows();

        // Reset the model to a blank model before showing the creating modal.
        if ($this->model->getKey()) {
            $this->model = $this->makeBlankModel();
            $this->value = '';
            $this->type = 'value_bool';
            //Reset the slug too.
            $this->generateName();
        }
        $this->showModal = true;
    }

    /**
     * Set the model (used in modal) to the setting we want to edit.
     *
     * @param Setting $setting The setting id to update.
     * (Livewire will automatically fetch the model by the id)
     *
     * @return void
     */
    public function edit(Setting $setting): void
    {
        $this->authorize('update', Setting::class);

        $this->isCreating = false;
        $this->useCachedRows();

        // Set the model to the setting we want to edit.
        if ($this->model->isNot($setting)) {
            $this->model = $setting;
            $this->type = $this->model->type;
            $this->value = $this->model->value;
            $this->generateName();
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
        $this->model->name = $this->slug;

        $this->authorize($this->isCreating ? 'create' : 'update', Setting::class);

        $this->validate();

        $this->model = Setting::castValue($this->value, $this->type, $this->model);

        unset($this->model->type, $this->model->value);

        if ($this->model->save()) {
            $this->fireFlash($this->isCreating ? 'create' : 'update', 'success', '', [$this->model->name]);
        } else {
            $this->fireFlash($this->isCreating ? 'create' : 'update', 'danger');
        }
        $this->showModal = false;
    }
}
