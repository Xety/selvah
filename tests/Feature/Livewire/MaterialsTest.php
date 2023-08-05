<?php
namespace Tests\Feature\Livewire;

use Illuminate\Support\Str;
use Livewire\Livewire;
use Tests\TestCase;
use Selvah\Http\Livewire\Materials;
use Selvah\Models\Material;
use Selvah\Models\User;
use Selvah\Models\Zone;

class MaterialsTest extends TestCase
{
    public function test_page_contains_livewire_component()
    {
        $user = User::find(1);

        $this->actingAs($user);
        $this->get('/materials')->assertSeeLivewire(Materials::class);
    }

    public function test_create_modal()
    {
        $this->actingAs(User::find(1));

        Livewire::test(Materials::class)
            ->call('create')
            ->assertSet('isCreating', true)
            ->assertSet('showModal', true)
            ;
    }

    public function test_create_modal_with_edit_model_before()
    {
        $this->actingAs(User::find(1));
        $model = Material::find(1);

        Livewire::test(Materials::class)
            ->call('edit', 1)
            ->assertSet('model.name', $model->name)
            ->assertSet('model.slug', $model->slug)
            ->assertSet('model.zone_id', $model->zone_id)
            ->assertSet('model.description', $model->description)

            ->call('create')
            ->assertSet('isCreating', true)
            ->assertSet('showModal', true)
            ->assertSet('model.name', '')
            ->assertSet('model.slug', '')
            ->assertSet('model.zone_id', '')
            ->assertSet('model.description', '')
            ->assertSet('model', Material::make());
    }

    public function test_edit_modal()
    {
        $this->actingAs(User::find(1));
        $model = Material::find(1);

        Livewire::test(Materials::class)
            ->assertSet('model.name', '')
            ->assertSet('model.slug', '')
            ->assertSet('model.zone_id', '')
            ->assertSet('model.description', '')
            ->assertSet('model', Material::make())

            ->call('edit', 1)
            ->assertSet('isCreating', false)
            ->assertSet('showModal', true)
            ->assertSet('model.name', $model->name)
            ->assertSet('model.slug', $model->slug)
            ->assertSet('model.zone_id', $model->zone_id)
            ->assertSet('model.description', $model->description)
            ->assertSet('model', $model);
    }

    public function test_generate_slug()
    {
        $this->actingAs(User::find(1));

        Livewire::test(Materials::class)
            ->call('edit', 1)
            ->set('model.name', 'Test Matériel')
            ->call('generateSlug')
            ->assertSet('model.slug', Str::slug('Test Matériel', '-'));
    }

    public function test_save_new_model()
    {
        $this->actingAs(User::find(1));

        $zone = Zone::find(1);
        Livewire::test(Materials::class)
            ->call('create')
            ->set('model.name', 'Test matériel')
            ->set('model.slug', 'test-materiel')
            ->set('model.zone_id', 1)
            ->set('model.description', 'Test de description')

            ->call('save')
            ->assertSet('showModal', false)
            ->assertEmitted('alert')
            ->assertHasNoErrors();

            $last = Material::orderBy('id', 'desc')->first();
            $this->assertSame('Test matériel', $last->name);
            $this->assertSame('test-materiel', $last->slug);
            $this->assertSame(1, $last->zone_id);
            $this->assertSame('Test de description', $last->description);
            // Test the count_cache is working well.
            $this->assertSame($last->zone->material_count, $zone->material_count + 1);
    }

    public function test_save_edit()
    {
        $this->actingAs(User::find(1));

        $oldZone = Zone::find(1);
        Livewire::test(Materials::class)
            ->call('edit', 1)
            ->set('model.name', 'Test matériel')
            ->set('model.slug', 'test-materiel')
            ->set('model.zone_id', 2)
            ->set('model.description', 'Test de description')

            ->call('save')
            ->assertSet('showModal', false)
            ->assertEmitted('alert')
            ->assertHasNoErrors();

            $newZone = Zone::find(1);
            $model = Material::find(1);
            $this->assertSame('Test matériel', $model->name);
            $this->assertSame('test-materiel', $model->slug);
            $this->assertSame(2, $model->zone_id);
            $this->assertSame('Test de description', $model->description);
            // Test the count_cache is working well.
            $this->assertSame($newZone->material_count, $oldZone->material_count - 1);
    }

    public function test_delete_selected()
    {
        $this->actingAs(User::find(1));

        Livewire::test(Materials::class)
            ->set('selected', [1])
            ->call('deleteSelected')
            ->assertEmitted('alert')
            ->assertSeeHtml('<b>1</b> matériel(s) ont été supprimé(s) avec succès !')
            ->assertHasNoErrors();
    }

    public function test_with_search_with_result()
    {
        Livewire::withQueryParams(['s' => 'bmp1'])
            ->test(Materials::class)
            ->assertSet('search', 'bmp1')
            ->assertDontSee('Aucun matériel trouvé');
    }

    public function test_with_search_no_rows()
    {
        Livewire::withQueryParams(['s' => 'xxzz'])
            ->test(Materials::class)
            ->assertSet('search', 'xxzz')
            ->assertSee('Aucun matériel trouvé');
    }

    public function test_with_sort_field_allowed()
    {
        Livewire::test(Materials::class)
            ->set('sortField', 'name')
            ->assertSet('sortField', 'name');
    }

    public function test_with_sort_field_not_allowed()
    {
        Livewire::test(Materials::class)
            ->set('sortField', 'notallowed')
            ->assertSet('sortField', 'created_at');
    }

    public function test_with_sort_field_not_allowed_on_mount()
    {
        Livewire::withQueryParams(['f' => 'notallowed'])
            ->test(Materials::class)
            ->assertSet('sortField', 'created_at');
    }

    public function test_can_export_all_materials()
    {
        $this->actingAs(User::find(1));

        Livewire::test(Materials::class)
            ->set('selected', [1, 2])
            ->call('exportSelected')
            ->assertFileDownloaded('materiels.xlsx');
    }

    public function test_can_show_qrcode_modal()
    {
        $this->actingAs(User::find(1));

        $material = Material::find(1);

        Livewire::test(Materials::class)
            ->call('showQrCode', 1)

            ->assertSet('modelQrCode.id', 1)
            ->assertSet('qrCodeLabel', $material->name)
            ->assertNotSet('qrCodeImg', '')
            ->assertSet('showQrCodeModal', true);
    }

    public function test_qrcode_size_allowed()
    {
        $this->actingAs(User::find(1));

        Livewire::test(Materials::class)
            ->call('showQrCode', 1)
            ->set('qrCodeSize', 300)

            ->assertSet('qrCodeSize', 300);
    }

    public function test_qrcode_size_not_allowed()
    {
        $this->actingAs(User::find(1));

        Livewire::test(Materials::class)
            ->call('showQrCode', 1)
            ->set('qrCodeSize', 1000)

            ->assertSet('qrCodeSize', 200);
    }
}
