<?php
namespace Tests\Feature\Livewire;

use Illuminate\Support\Str;
use Livewire\Livewire;
use Tests\TestCase;
use Selvah\Http\Livewire\Parts;
use Selvah\Models\Part;
use Selvah\Models\User;

class PartsTest extends TestCase
{
    public function test_page_contains_livewire_component()
    {
        $user = User::find(1);

        $this->actingAs($user);
        $this->get('/parts')->assertSeeLivewire(Parts::class);
    }

    public function test_create_modal()
    {
        $this->actingAs(User::find(1));

        Livewire::test(Parts::class)
            ->call('create')
            ->assertSet('isCreating', true)
            ->assertSet('showModal', true);
    }

    public function test_create_modal_with_edit_model_before()
    {
        $this->actingAs(User::find(1));
        $model = Part::find(1);

        $emptyModel = Part::make();
        $emptyModel->number_warning_enabled = false;
        $emptyModel->number_critical_enabled = false;

        Livewire::test(Parts::class)
            ->call('edit', 1)
            ->assertSet('model.name', $model->name)
            ->assertSet('model.slug', $model->slug)
            ->assertSet('model.description', $model->description)
            ->assertSet('model.material_id', $model->material_id)
            ->assertSet('model.reference', $model->reference)
            ->assertSet('model.supplier', $model->supplier)
            ->assertSet('model.price', $model->price)
            ->assertSet('model.number_warning_enabled', $model->number_warning_enabled)
            ->assertSet('model.number_warning_minimum', $model->number_warning_minimum)
            ->assertSet('model.number_critical_enabled', $model->number_critical_enabled)
            ->assertSet('model.number_critical_minimum', $model->number_critical_minimum)

            ->call('create')
            ->assertSet('isCreating', true)
            ->assertSet('showModal', true)
            ->assertSet('model.name', '')
            ->assertSet('model.slug', '')
            ->assertSet('model.description', '')
            ->assertSet('model.material_id', '')
            ->assertSet('model.reference', '')
            ->assertSet('model.supplier', '')
            ->assertSet('model.price', '')
            ->assertSet('model.number_warning_enabled', '')
            ->assertSet('model.number_warning_minimum', '')
            ->assertSet('model.number_critical_enabled', '')
            ->assertSet('model.number_critical_minimum', '')
            ->assertSet('model', $emptyModel);
    }

    public function test_edit_modal()
    {
        $this->actingAs(User::find(1));
        $model = Part::find(1);

        $emptyModel = Part::make();
        $emptyModel->number_warning_enabled = false;
        $emptyModel->number_critical_enabled = false;

        Livewire::test(Parts::class)
            ->assertSet('model.name', '')
            ->assertSet('model.slug', '')
            ->assertSet('model.description', '')
            ->assertSet('model.material_id', '')
            ->assertSet('model.reference', '')
            ->assertSet('model.supplier', '')
            ->assertSet('model.price', '')
            ->assertSet('model.number_warning_enabled', '')
            ->assertSet('model.number_warning_minimum', '')
            ->assertSet('model.number_critical_enabled', '')
            ->assertSet('model.number_critical_minimum', '')
            ->assertSet('model', $emptyModel)

            ->call('edit', 1)
            ->assertSet('isCreating', false)
            ->assertSet('showModal', true)
            ->assertSet('model.name', $model->name)
            ->assertSet('model.slug', $model->slug)
            ->assertSet('model.description', $model->description)
            ->assertSet('model.material_id', $model->material_id)
            ->assertSet('model.reference', $model->reference)
            ->assertSet('model.supplier', $model->supplier)
            ->assertSet('model.price', $model->price)
            ->assertSet('model.number_warning_enabled', $model->number_warning_enabled)
            ->assertSet('model.number_warning_minimum', $model->number_warning_minimum)
            ->assertSet('model.number_critical_enabled', $model->number_critical_enabled)
            ->assertSet('model.number_critical_minimum', $model->number_critical_minimum)
            ->assertSet('model', $model);
    }

    public function test_generate_slug()
    {
        $this->actingAs(User::find(1));
        $model = Part::find(1);

        Livewire::test(Parts::class)
            ->call('edit', 1)
            ->assertSet('model.slug', Str::slug($model->name, '-'));
    }

    public function test_save_new_model()
    {
        $this->actingAs(User::find(1));

        Livewire::test(Parts::class)
            ->call('create')
            ->set('model.name', 'Ventouse 50mm')
            ->set('model.slug', 'ventouse-50mm')
            ->set('model.description', 'Test de description')
            ->set('model.material_id', 2)
            ->set('model.reference', 'REF123')
            ->set('model.supplier', 'ORRECA')
            ->set('model.price', 10)
            ->set('model.number_warning_enabled', true)
            ->set('model.number_warning_minimum', 18)
            ->set('model.number_critical_enabled', true)
            ->set('model.number_critical_minimum', 9)

            ->call('save')
            ->assertSet('showModal', false)
            ->assertEmitted('alert')
            ->assertHasNoErrors();

            $last = Part::orderBy('id', 'desc')->first();
            $this->assertSame('Ventouse 50mm', $last->name);
            $this->assertSame('ventouse-50mm', $last->slug);
            $this->assertSame('Test de description', $last->description);
            $this->assertSame(2, $last->material_id);
            $this->assertSame('REF123', $last->reference);
            $this->assertSame('ORRECA', $last->supplier);
            $this->assertSame(10, $last->price);
            $this->assertSame(true, (bool)$last->number_warning_enabled);
            $this->assertSame(18, $last->number_warning_minimum);
            $this->assertSame(true, (bool)$last->number_critical_enabled);
            $this->assertSame(9, $last->number_critical_minimum);
    }

    public function test_delete_selected()
    {
        $this->actingAs(User::find(1));

        Livewire::test(Parts::class)
            ->set('selected', [1])
            ->call('deleteSelected')
            ->assertEmitted('alert')
            ->assertSeeHtml('<b>1</b> pièce(s) détachée(s) ont été supprimée(s) avec succès !')
            ->assertHasNoErrors();
    }

    public function test_with_search_with_result()
    {
        Livewire::test(Parts::class)
            ->set('filters.search', 'ventouse')
            ->assertDontSee('Aucune pièce détachée trouvée');
    }

    public function test_with_search_no_rows()
    {
        Livewire::test(Parts::class)
            ->set('filters.search', 'xxzz')
            ->assertSee('Aucune pièce détachée trouvée');
    }

    public function test_with_sort_field_allowed()
    {
        Livewire::test(Parts::class)
            ->set('sortField', 'name')
            ->assertSet('sortField', 'name');
    }

    public function test_with_sort_field_not_allowed()
    {
        Livewire::test(Parts::class)
            ->set('sortField', 'notallowed')
            ->assertSet('sortField', 'created_at');
    }

    public function test_with_sort_field_not_allowed_on_mount()
    {
        Livewire::withQueryParams(['f' => 'notallowed'])
            ->test(Parts::class)
            ->assertSet('sortField', 'created_at');
    }
}
