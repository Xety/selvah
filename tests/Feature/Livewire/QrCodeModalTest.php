<?php
namespace Tests\Feature\Livewire;

use Livewire\Livewire;
use Selvah\Http\Livewire\QrCodeModal;
use Tests\TestCase;
use Selvah\Models\User;

class QrCodeModalTest extends TestCase
{
    public function test_page_contains_livewire_component()
    {
        $user = User::find(1);

        $this->actingAs($user);
        $this->get('/')->assertSeeLivewire(QrCodeModal::class);
    }
}