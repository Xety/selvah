<?php
namespace Tests\Feature\Livewire;

use Illuminate\Support\Str;
use Livewire\Livewire;
use Tests\TestCase;
use Selvah\Http\Livewire\Settings;
use Selvah\Models\Setting;
use Selvah\Models\User;

class SettingsTest extends TestCase
{
    public function test_page_contains_livewire_component()
    {
        $user = User::find(1);

        $this->actingAs($user);
        $this->get('/settings')->assertSeeLivewire(Settings::class);
    }

    public function test_create_modal()
    {
        $this->actingAs(User::find(1));

        Livewire::test(Settings::class)
            ->call('create')
            ->assertSet('isCreating', true)
            ->assertSet('showModal', true)
            ;
    }

    public function test_create_modal_with_edit_model_before()
    {
        $this->actingAs(User::find(1));
        $model = Setting::find(1);

        Livewire::test(Settings::class)
            ->call('edit', 1)
            ->assertSet('value', $model->value)
            ->assertSet('type', $model->type)

            ->call('create')
            ->assertSet('isCreating', true)
            ->assertSet('showModal', true)
            ->assertSet('value', '')
            ->assertSet('type', 'value_bool')
            ->assertSet('model', Setting::make())
            ;
    }

    public function test_edit_modal()
    {
        $this->actingAs(User::find(1));
        $model = Setting::find(1);

        Livewire::test(Settings::class)
            ->assertSet('value', '')
            ->assertSet('type', 'value_bool')
            ->assertSet('model', Setting::make())

            ->call('edit', 1)
            ->assertSet('isCreating', false)
            ->assertSet('showModal', true)
            ->assertSet('type', $model->type)
            ->assertSet('value', $model->value)
            ->assertSet('model', $model)
            ;
    }

    public function test_generate_slug()
    {
        $this->actingAs(User::find(1));
        $model = Setting::find(1);

        Livewire::test(Settings::class)
            ->call('edit', 1)
            ->assertSet('slug', Str::slug($model->name, '.'));
    }

    public function test_save_new_model()
    {
        $this->actingAs(User::find(1));

        Livewire::test(Settings::class)
            ->call('create')
            ->set('model.name', 'Test Setting')
            ->Set('slug', 'test.setting')
            ->set('value', 'Test value')
            ->set('type', 'value_str')
            ->set('model.description', 'Test description of setting')
            ->call('save')
            ->assertSet('showModal', false)
            ->assertEmitted('alert')
            ->assertHasNoErrors();

            $last = Setting::orderBy('id', 'desc')->first();
            $this->assertSame('test.setting', $last->name);
            $this->assertSame('Test value', $last->value);
            $this->assertSame('value_str', $last->type);
            $this->assertSame('Test description of setting', $last->description);
    }

    public function test_delete_selected()
    {
        $this->actingAs(User::find(1));
        $model = Setting::find(1);
        $model->save();

        Livewire::test(Settings::class)
            ->set('selected', [1])
            ->call('deleteSelected')
            ->assertEmitted('alert')
            ->assertSeeHtml('<b>1</b> paramètre(s) ont été supprimé(s) avec succès !')
            ->assertHasNoErrors();
    }

    public function test_with_search_with_result()
    {
        Livewire::withQueryParams(['s' => 'user'])
            ->test(Settings::class)
            ->assertSet('search', 'user')
            ->assertDontSee('Aucun paramètre trouvé.');
    }

    public function test_with_search_no_rows()
    {
        Livewire::withQueryParams(['s' => 'xx'])
            ->test(Settings::class)
            ->assertSet('search', 'xx')
            ->assertSee('Aucun paramètre trouvé.');
    }

    public function test_with_sort_field_allowed()
    {
        Livewire::test(Settings::class)
            ->set('sortField', 'name')
            ->assertSet('sortField', 'name');
    }

    public function test_with_sort_field_not_allowed()
    {
        Livewire::test(Settings::class)
            ->set('sortField', 'notallowed')
            ->assertSet('sortField', 'created_at');
    }

    public function test_with_sort_field_not_allowed_on_mount()
    {
        Livewire::withQueryParams(['f' => 'notallowed'])
            ->test(Settings::class)
            ->assertSet('sortField', 'created_at');
    }
}
