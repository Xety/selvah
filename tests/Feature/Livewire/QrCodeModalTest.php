<?php
namespace Tests\Feature\Livewire;

use Livewire\Livewire;
use Selvah\Http\Livewire\QrCodeModal;
use Tests\TestCase;
use Selvah\Models\User;

class QrCodeModalTest extends TestCase
{
    /*public function test_page_contains_livewire_component()
    {
        $user = User::find(1);

        $this->actingAs($user);
        $this->get('/')->assertSeeLivewire(QrCodeModal::class);
    }

    public function test_qrcode_open_modal_with_material()
    {
        $user = User::find(1);

        $this->actingAs($user);
        Livewire::withQueryParams(['qrcode' => true, 'type' => 'material', 'id' => 1])
            ->test(QrCodeModal::class)
            ->assertSet('type', 'material')
            ->assertSet('showQrCodeModal', true)
            ->assertSee('BMP1');
    }

    public function test_qrcode_open_modal_with_part()
    {
        $user = User::find(1);

        $this->actingAs($user);
        Livewire::withQueryParams(['qrcode' => true, 'type' => 'part', 'id' => 1])
            ->test(QrCodeModal::class)
            ->assertSet('type', 'part')
            ->assertSet('showQrCodeModal', true)
            ->assertSee('Ventouse 40mm');
    }

    public function test_qrcode_open_modal_with_unknown()
    {
        $user = User::find(1);

        $this->actingAs($user);
        Livewire::withQueryParams(['qrcode' => true, 'type' => 'unknown', 'id' => 1])
            ->test(QrCodeModal::class)
            ->assertSet('type', null)
            ->assertSet('showQrCodeModal', false);
    }*/
}
