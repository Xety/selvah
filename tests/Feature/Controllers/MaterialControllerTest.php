<?php
namespace Tests\Feature\Controllers;

use Tests\TestCase;
use Selvah\Models\User;

class MaterialControllerTest extends TestCase
{
    public function test_show_material_can_be_rendered(): void
    {
        $user = User::find(1);

        $response = $this
            ->actingAs($user)
            ->get('/materials/1')
            ->assertSee('Boisseau');

        $response->assertOk();
    }

    public function test_show_material_not_found(): void
    {
        $user = User::find(1);

        $response = $this
            ->actingAs($user)
            ->get('/materials/9999');

        $response
            ->assertSessionHas('danger')
            ->assertStatus(302);
    }
}
