<?php
namespace Tests\Feature\Controllers;

use Tests\TestCase;
use Selvah\Models\User;

class CompanyControllerTest extends TestCase
{
    public function test_show_company_can_be_rendered(): void
    {
        $user = User::find(1);

        $response = $this
            ->actingAs($user)
            ->get('/companies/1')
            ->assertSee('Toy');

        $response->assertOk();
    }

    public function test_show_company_not_found(): void
    {
        $user = User::find(1);

        $response = $this
            ->actingAs($user)
            ->get('/companies/9999');

        $response
            ->assertSessionHas('danger')
            ->assertStatus(302);
    }
}
