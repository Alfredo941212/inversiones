<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AssetTypeTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_create_asset_type(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post(route('asset-types.store'), [
                'name' => 'Fondo de inversión',
                'description' => 'Fondo administrado.',
                'is_active' => true,
            ]);

        $response->assertRedirect(
            route('asset-types.index')
        );

        $this->assertDatabaseHas('asset_types', [
            'name' => 'Fondo de inversión',
        ]);
    }
}