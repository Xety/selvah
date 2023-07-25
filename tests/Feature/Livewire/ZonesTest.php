<?php
namespace Tests\Feature\Livewire;

use Illuminate\Support\Str;
use Livewire\Livewire;
use Tests\TestCase;
use Selvah\Http\Livewire\Zones;
use Selvah\Models\Zone;
use Selvah\Models\User;

class ZonesTest extends TestCase
{
    public function test_page_contains_livewire_component()
    {
        $user = User::find(1);

        $this->actingAs($user);
        $this->get('/zones')->assertSeeLivewire(Zones::class);
    }

    public function test_create_modal()
    {
        $this->actingAs(User::find(1));

        Livewire::test(Zones::class)
            ->call('create')
            ->assertSet('isCreating', true)
            ->assertSet('showModal', true);
    }

    public function test_create_modal_with_edit_model_before()
    {
        $this->actingAs(User::find(1));
        $model = Zone::find(1);

        Livewire::test(Zones::class)
            ->call('edit', 1)
            ->assertSet('model.name', $model->name)
            ->assertSet('model.slug', $model->slug)

            ->call('create')
            ->assertSet('isCreating', true)
            ->assertSet('showModal', true)
            ->assertSet('name', '')
            ->assertSet('slug', '')
            ->assertSet('model', Zone::make());
    }

    public function test_edit_modal()
    {
        $this->actingAs(User::find(1));
        $model = Zone::find(1);

        Livewire::test(Zones::class)
            ->assertSet('model.name', '')
            ->assertSet('model.slug', '')
            ->assertSet('model', Zone::make())

            ->call('edit', 1)
            ->assertSet('isCreating', false)
            ->assertSet('showModal', true)
            ->assertSet('model.name', $model->name)
            ->assertSet('model.slug', $model->slug)
            ->assertSet('model', $model);
    }

    public function test_generate_slug()
    {
        $this->actingAs(User::find(1));

        Livewire::test(Zones::class)
            ->call('edit', 1)
            ->set('model.name', 'Test Zone')
            ->call('generateSlug')
            ->assertSet('model.slug', Str::slug('Test Zone', '-'));
    }

    public function test_save_new_model()
    {
        $this->actingAs(User::find(1));

        Livewire::test(Zones::class)
            ->call('create')
            ->set('model.name', 'Test Zone')
            ->set('model.slug', 'test-zone')

            ->call('save')
            ->assertSet('showModal', false)
            ->assertEmitted('alert')
            ->assertHasNoErrors();

            $last = Zone::orderBy('id', 'desc')->first();
            $this->assertSame('Test Zone', $last->name);
            $this->assertSame('test-zone', $last->slug);
    }

    public function test_delete_selected()
    {
        $this->actingAs(User::find(1));

        Livewire::test(Zones::class)
            ->set('selected', [1])
            ->call('deleteSelected')
            ->assertEmitted('alert')
            ->assertSeeHtml('<b>1</b> zone(s) ont été supprimé(s) avec succès !')
            ->assertHasNoErrors();
    }

    public function test_with_search_with_result()
    {
        Livewire::withQueryParams(['s' => 'broyage'])
            ->test(Zones::class)
            ->assertSet('search', 'broyage')
            ->assertDontSee('Aucune zone trouvée');
    }

    public function test_with_search_no_rows()
    {
        Livewire::withQueryParams(['s' => 'xx'])
            ->test(Zones::class)
            ->assertSet('search', 'xx')
            ->assertSee('Aucune zone trouvée');
    }

    public function test_with_sort_field_allowed()
    {
        Livewire::test(Zones::class)
            ->set('sortField', 'name')
            ->assertSet('sortField', 'name');
    }

    public function test_with_sort_field_not_allowed()
    {
        Livewire::test(Zones::class)
            ->set('sortField', 'notallowed')
            ->assertSet('sortField', 'created_at');
    }

    public function test_with_sort_field_not_allowed_on_mount()
    {
        Livewire::withQueryParams(['f' => 'notallowed'])
            ->test(Zones::class)
            ->assertSet('sortField', 'created_at');
    }
}
