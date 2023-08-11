<?php

namespace Selvah\Http\Livewire;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;
use Selvah\Events\Auth\RegisteredEvent;
use Selvah\Http\Livewire\Traits\WithCachedRows;
use Selvah\Http\Livewire\Traits\WithFlash;
use Selvah\Http\Livewire\Traits\WithSorting;
use Selvah\Http\Livewire\Traits\WithBulkActions;
use Selvah\Http\Livewire\Traits\WithPerPagePagination;
use Selvah\Models\User;
use Spatie\Permission\Models\Role;

class Users extends Component
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
        'username',
        'first_name',
        'last_name',
        'email',
        'last_login',
        'created_at'
    ];

    /**
     * The model used in the component.
     *
     * @var User
     */
    public User $model;

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
     * @var bool
     */
    public bool $isCreating = false;

    /**
     * Number of rows displayed on a page.
     * @var int
     */
    public int $perPage = 10;

    /**
     * The selected roles for the editing an user or the new user.
     *
     * @var array
     */
    public array $rolesSelected = [];

    /**
     * The password of the new user.
     *
     * @var string
     */
    public string $password;

    /**
     * The password confirmation of the new user.
     *
     * @var string
     */
    public string $password_confirmation;

    /**
     * Translated attribute used in failed messages.
     *
     * @var string[]
     */
    protected $validationAttributes = [
        'username' => 'nom d\'utilisateur',
        'first_name' => 'prénom',
        'last_name' => 'nom',
        'rolesSelected' => 'rôles',
        'password' => 'mot de passe',
        'password_confirmation' => 'mot de passe confirmation'
    ];

    /**
     * Flash messages for the model.
     *
     * @var array
     */
    protected array $flashMessages = [
        'create' => [
            'success' => "L'utilisateur <b>%s</b> a été créé avec succès !",
            'danger' => "Une erreur s'est produite lors de la création de l'utilisateur !"
        ],
        'update' => [
            'success' => "L'utilisateur <b>%s</b> a été édité avec succès !",
            'danger' => "Une erreur s'est produite lors de l'édition de l'utilisateur !"
        ],
        'delete' => [
            'success' => "<b>%s</b> utilisateur(s) ont été supprimé(s) avec succès !",
            'danger' => "Une erreur s'est produite lors de la suppression des utilisateurs !"
        ],
        'restore' => [
            'success' => "L'utilisateur <b>%s</b> a été restauré avec succès !",
            'danger' => "Une erreur s'est produite lors de la restauration de l'utilisateur !"
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
     * @return array
     */
    public function rules(): array
    {
        $rules = [
            'model.username' => 'required|regex:/^[\w.]*$/|min:5|max:30|unique:users,username,' . $this->model->id,
            'model.email' => 'required|email|unique:users,email,' . $this->model->id,
            'model.first_name' => 'required',
            'model.last_name' => 'required',
            'rolesSelected' => 'required'
        ];

        // Add those rules only when creating an user.
        if ($this->isCreating) {
            $rules = array_merge($rules, [
                'password' => 'required|min:6',
                'password_confirmation' => 'required|same:password',
            ]);
        }

        return $rules;
    }

    /**
     * Create a blank model and return it.
     *
     * @return User
     */
    public function makeBlankModel(): User
    {
        return User::make();
    }

    /**
     * Function to render the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.users', [
            'users' => $this->rows,
            'roles' => Role::pluck('name', 'id')->toArray()
        ]);
    }

    /**
     * Create and return the query for the items.
     *
     * @return Builder
     */
    public function getRowsQueryProperty(): Builder
    {
        $query = User::query()
            ->with('roles')
            ->search('username', $this->search)
            ->withTrashed();

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
        $this->authorize('create', User::class);

        $this->isCreating = true;
        $this->useCachedRows();

        // Reset the model to a blank model before showing the creating modal.
        if ($this->model->getKey()) {
            $this->model = $this->makeBlankModel();
            $this->rolesSelected = [];
        }
        $this->showModal = true;
    }

    /**
     * Set the model (used in modal) to the user we want to edit.
     *
     * @param User $user The user id to update.
     * (Livewire will automatically fetch the model by the id)
     *
     * @return void
     */
    public function edit(User $user): void
    {
        $this->authorize('update', User::class);

        $this->isCreating = false;
        $this->useCachedRows();

        // Set the model to the user we want to edit.
        if ($this->model->isNot($user)) {
            $this->model = $user;
            $this->rolesSelected = $user->roles->pluck('id')->toArray();
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
        $this->authorize($this->isCreating ? 'create' : 'update', User::class);

        $this->validate();

        // Set the password only on creating an user.
        if ($this->isCreating) {
            // Hash and set the password
            $this->model->password = Hash::make($this->password);
        }

        if ($this->model->save()) {
            $this->model->syncRoles($this->rolesSelected);

            if ($this->isCreating === true) {
                event(new RegisteredEvent($this->model));
            }

            $this->fireFlash($this->isCreating ? 'create' : 'update', 'success', '', [$this->model->username]);
        } else {
            $this->fireFlash($this->isCreating ? 'create' : 'update', 'danger');
        }
        $this->showModal = false;
    }

    /**
     * Restore a model.
     *
     * @return void
     */
    public function restore(): void
    {
        $this->authorize('restore', User::class);

        if ($this->model->restore()) {
            $this->fireFlash('restore', 'success','', [$this->model->username]);
        } else {
            $this->fireFlash('restore', 'danger');
        }
    }
}
