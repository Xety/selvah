<?php
namespace Tests\Feature\Livewire\Roles;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Selvah\Livewire\Roles\Permissions;
use Selvah\Models\User;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class PermissionsTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    public function test_page_contains_livewire_component()
    {
        $user = User::find(1);

        $this->actingAs($user);
        $this->get('/roles/permissions')->assertSeeLivewire(\Selvah\Livewire\Roles\Permissions::class);
    }

    public function test_create_modal()
    {
        $this->actingAs(User::find(1));

        Livewire::test(Permissions::class)
            ->call('create')
            ->assertSet('isCreating', true)
            ->assertSet('showModal', true);
    }

    public function test_create_modal_with_edit_model_before()
    {
        $this->actingAs(User::find(1));
        $model = Permission::find(1);

        Livewire::test(\Selvah\Livewire\Roles\Permissions::class)
            ->call('edit', 1)
            ->assertSet('model.name', $model->name)
            ->assertSet('model.description', $model->description)

            ->call('create')
            ->assertSet('isCreating', true)
            ->assertSet('showModal', true)
            ->assertSet('model.name', '')
            ->assertSet('model.description', '')
            ->assertSet('model', Permission::make());
    }

    public function test_edit_modal()
    {
        $this->actingAs(User::find(1));
        $model = Permission::find(1);

        Livewire::test(\Selvah\Livewire\Roles\Permissions::class)
            ->assertSet('model.name', '')
            ->assertSet('model.description', '')
            ->assertSet('model', Permission::make())

            ->call('edit', 1)
            ->assertSet('isCreating', false)
            ->assertSet('showModal', true)
            ->assertSet('model.name', $model->name)
            ->assertSet('model.description', $model->description)
            ->assertSet('model', $model);
    }

    public function test_save_new_model()
    {
        $this->actingAs(User::find(1));

        Livewire::test(\Selvah\Livewire\Roles\Permissions::class)
            ->call('create')
            ->set('model.name', 'Test Permission')
            ->set('model.description', 'Test de description')

            ->call('save')
            ->assertSet('showModal', false)
            ->assertDispatched('alert')
            ->assertHasNoErrors();

            $last = Permission::orderBy('id', 'desc')->first();
            $this->assertSame('Test Permission', $last->name);
            $this->assertSame('Test de description', $last->description);
    }

    public function test_save_edit()
    {
        $this->actingAs(User::find(1));
        $model = Permission::find(1);

        Livewire::test(Permissions::class)
            ->call('edit', 1)
            ->set('model.name', 'Test nouveau nom')
            ->set('model.description', 'Test de description')

            ->call('save')
            ->assertSet('showModal', false)
            ->assertDispatched('alert')
            ->assertHasNoErrors();

            $model = Permission::find(1);
            $this->assertSame('Test nouveau nom', $model->name);
            $this->assertSame('Test de description', $model->description);
    }

    public function test_delete_selected()
    {
        $this->actingAs(User::find(1));

        Livewire::test(\Selvah\Livewire\Roles\Permissions::class)
            ->set('selected', [1])
            ->call('deleteSelected')
            ->assertDispatched('alert')
            ->assertSeeHtml('<b>1</b> permission(s) ont été supprimé(s) avec succès !')
            ->assertHasNoErrors();
    }

    public function test_with_search_with_result()
    {
        Livewire::withQueryParams(['s' => 'view'])
            ->test(\Selvah\Livewire\Roles\Permissions::class)
            ->assertSet('search', 'view')
            ->assertDontSee('Aucune permission trouvée');
    }

    public function test_with_search_no_rows()
    {
        Livewire::withQueryParams(['s' => 'xxzz'])
            ->test(\Selvah\Livewire\Roles\Permissions::class)
            ->assertSet('search', 'xxzz')
            ->assertSee('Aucune permission trouvée');
    }

    public function test_with_sort_field_allowed()
    {
        Livewire::test(Permissions::class)
            ->set('sortField', 'name')
            ->assertSet('sortField', 'name');
    }

    public function test_with_sort_field_not_allowed()
    {
        Livewire::test(Permissions::class)
            ->set('sortField', 'notallowed')
            ->assertSet('sortField', 'created_at');
    }

    public function test_with_sort_field_not_allowed_on_mount()
    {
        Livewire::withQueryParams(['f' => 'notallowed'])
            ->test(\Selvah\Livewire\Roles\Permissions::class)
            ->assertSet('sortField', 'created_at');
    }
}
