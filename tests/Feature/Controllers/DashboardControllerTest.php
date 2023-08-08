<?php
namespace Tests\Feature\Controllers;

use Tests\TestCase;
use Selvah\Models\User;

class DashboardControllerTest extends TestCase
{
    public function test_index_can_be_rendered(): void
    {
        $user = User::find(1);

        $response = $this
            ->actingAs($user)
            ->get('/')
            ->assertSee('Le nombre de maintenance sur le mois');

        $response->assertOk();
    }
}