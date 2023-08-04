<?php
namespace Tests\Feature\Livewire;

use Livewire\Livewire;
use Selvah\Http\Livewire\QrCodeModal;
use Tests\TestCase;
use Selvah\Models\User;

class QrCodeModalTest extends TestCase
{
    public function test_redirection_with_material_create_incident()
    {
        $user = User::find(1);

        $this->actingAs($user);
        Livewire::test(QrCodeModal::class)
            ->set('qrcode', true)
            ->set('type', 'material')
            ->set('qrcodeid', 1)
            ->set('action', 'incidents')
            ->call('redirection')

            ->assertRedirect('/incidents?qrcodeid=1&qrcode=true');
    }
}