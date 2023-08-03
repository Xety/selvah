<?php
namespace Tests\Feature\Livewire;

use Livewire\Livewire;
use Tests\TestCase;
use Selvah\Http\Livewire\PartEntries;
use Selvah\Models\Part;
use Selvah\Models\PartEntry;
use Selvah\Models\User;

class PartEntriesTest extends TestCase
{
    public function test_page_contains_livewire_component()
    {
        $user = User::find(1);

        $this->actingAs($user);
        $this->get('/part-entries')->assertSeeLivewire(PartEntries::class);
    }

    public function test_qrcode_open_create_modal()
    {
        $user = User::find(1);

        $this->actingAs($user);
        Livewire::withQueryParams(['qrcode' => true, 'id' => 1])
            ->test(PartEntries::class)
            ->assertSet('model.part_id', 1)
            ->assertSet('isCreating', true)
            ->assertSet('showModal', true);
    }

    public function test_create_modal()
    {
        $this->actingAs(User::find(1));

        Livewire::test(PartEntries::class)
            ->call('create')
            ->assertSet('isCreating', true)
            ->assertSet('showModal', true)
            ;
    }

    public function test_create_modal_with_edit_model_before()
    {
        $this->actingAs(User::find(1));
        $model = PartEntry::find(1);

        Livewire::test(PartEntries::class)
            ->call('edit', 1)
            ->assertSet('model.part_id', $model->part_id)
            ->assertSet('model.number', $model->number)
            ->assertSet('model.order_id', $model->order_id)

            ->call('create')
            ->assertSet('isCreating', true)
            ->assertSet('showModal', true)
            ->assertSet('model.part_id', '')
            ->assertSet('model.number', '')
            ->assertSet('model.order_id', '')
            ->assertSet('model', PartEntry::make());
    }

    public function test_edit_modal()
    {
        $this->actingAs(User::find(1));
        $model = PartEntry::find(1);

        Livewire::test(PartEntries::class)
            ->assertSet('model.part_id', '')
            ->assertSet('model.number', '')
            ->assertSet('model.order_id', '')
            ->assertSet('model', PartEntry::make())

            ->call('edit', 1)
            ->assertSet('isCreating', false)
            ->assertSet('showModal', true)
            ->assertSet('model.part_id', $model->part_id)
            ->assertSet('model.number', $model->number)
            ->assertSet('model.order_id', $model->order_id)
            ->assertSet('model', $model);
    }

    public function test_save_new_model()
    {
        $this->actingAs(User::find(1));

        $part = Part::find(1);
        Livewire::test(PartEntries::class)
            ->call('create')
            ->set('model.part_id', 1)
            ->set('model.number', 20)
            ->set('model.order_id', '123456789')

            ->call('save')
            ->assertSet('showModal', false)
            ->assertEmitted('alert')
            ->assertHasNoErrors();

            $last = PartEntry::orderBy('id', 'desc')->first();
            $this->assertSame(1, $last->part_id);
            $this->assertSame(20, $last->number);
            $this->assertSame('123456789', $last->order_id);
            // Test the count_cache is working well.
            $this->assertSame($last->part->stock_total, ($part->stock_total + $last->number));
    }

    public function test_save_edit()
    {
        $this->actingAs(User::find(1));
        $model = PartEntry::find(1);

        Livewire::test(PartEntries::class)
            ->call('edit', 1)
            ->set('model.order_id', '123456789')

            ->call('save')
            ->assertSet('showModal', false)
            ->assertEmitted('alert')
            ->assertHasNoErrors();

            $model = PartEntry::find(1);
            $this->assertSame('123456789', $model->order_id);
    }

    public function test_delete_selected()
    {
        $this->actingAs(User::find(1));

        Livewire::test(PartEntries::class)
            ->set('selected', [1])
            ->call('deleteSelected')
            ->assertEmitted('alert')
            ->assertSeeHtml('<b>1</b> entrée(s) ont été supprimée(s) avec succès !')
            ->assertHasNoErrors();
    }

    public function test_with_search_with_result()
    {
        Livewire::withQueryParams(['s' => 'ventouse'])
            ->test(PartEntries::class)
            ->assertSet('search', 'ventouse')
            ->assertDontSee('Aucune entrée trouvée');
    }

    public function test_with_search_no_rows()
    {
        Livewire::withQueryParams(['s' => 'xxzz'])
            ->test(PartEntries::class)
            ->assertSet('search', 'xxzz')
            ->assertSee('Aucune entrée trouvée');
    }

    public function test_with_sort_field_allowed()
    {
        Livewire::test(PartEntries::class)
            ->set('sortField', 'number')
            ->assertSet('sortField', 'number');
    }

    public function test_with_sort_field_not_allowed()
    {
        Livewire::test(PartEntries::class)
            ->set('sortField', 'notallowed')
            ->assertSet('sortField', 'created_at');
    }

    public function test_with_sort_field_not_allowed_on_mount()
    {
        Livewire::withQueryParams(['f' => 'notallowed'])
            ->test(PartEntries::class)
            ->assertSet('sortField', 'created_at');
    }
}
