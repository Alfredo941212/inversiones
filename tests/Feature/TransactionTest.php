<?php

namespace Tests\Feature;

use App\Models\Asset;
use App\Models\AssetType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_cannot_sell_more_than_available(): void
    {
        $user = User::factory()->create();

        $assetType = AssetType::create([
            'name' => 'Criptomoneda',
            'description' => 'Activo digital.',
            'is_active' => true,
        ]);

        $asset = Asset::create([
            'asset_type_id' => $assetType->id,
            'name' => 'Bitcoin',
            'symbol' => 'BTC',
            'api_id' => 'bitcoin',
            'current_price' => 1000000,
            'is_active' => true,
        ]);

        $response = $this
            ->actingAs($user)
            ->from(route('transactions.create'))
            ->post(route('transactions.store'), [
                'asset_id' => $asset->id,
                'type' => 'venta',
                'quantity' => 2,
                'unit_price' => 1000000,
                'operation_date' => now()->format('Y-m-d H:i:s'),
            ]);

        $response->assertRedirect(
            route('transactions.create')
        );

        $response->assertSessionHasErrors('quantity');

        $this->assertDatabaseCount('transactions', 0);
    }
}