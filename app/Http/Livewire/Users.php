<?php

namespace Selvah\Http\Livewire;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;
use Selvah\Http\Livewire\Traits\WithCachedRows;
use Selvah\Http\Livewire\Traits\WithSorting;
use Selvah\Http\Livewire\Traits\WithBulkActions;
use Selvah\Http\Livewire\Traits\WithPerPagePagination;
use Selvah\Models\User;
use Spatie\Permission\Models\Role;

class Users extends Component
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
    public function render()
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
            ->search('username', $this->search);

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
        $this->validate();

        // Set the password only on creating an user.
        if ($this->isCreating) {
            // Hash and set the password
            $this->model->password = Hash::make($this->password);
        }

        if ($this->model->save()) {
            $this->model->syncRoles($this->rolesSelected);

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
     * @param int $deleteCount If set, the number of permissions that has been deleted.
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
                        $this->isCreating ? "L'utilisateur a été créé avec succès !" :
                            "L'utilisateur <b>{$this->model->title}</b> a été édité avec succès !"
                    );
                } else {
                    session()->flash('danger', "Une erreur s'est produite lors de l'enregistrement de l'utilisateur !");
                }
                break;

            case 'delete':
                if ($type == 'success') {
                    session()->flash('success', "<b>{$deleteCount}</b> utilisateur(s) ont été supprimé(s) avec succès !");
                } else {
                    session()->flash('danger', "Une erreur s'est produite lors de la suppression des utilisateurs !");
                }
                break;
        }

        // Emit the alert event to the front so the DIsmiss can trigger the flash message.
        $this->emit('alert');
    }
}
