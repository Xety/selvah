<?php

namespace Tests\Feature;

use Selvah\Models\User;
use Tests\TestCase;

class ProfileControllerTest extends TestCase
{
    public function test_profile_page_is_displayed(): void
    {
        $user = User::find(1);

        $response = $this
            ->actingAs($user)
            ->get('/profile');

        $response->assertOk();
    }
}