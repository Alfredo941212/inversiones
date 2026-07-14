<?php

namespace Database\Seeders;

use App\Models\Asset;
use App\Models\AssetType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $crypto = AssetType::updateOrCreate(
            ['name' => 'Criptomoneda'],
            [
                'description' =>
                    'Activos digitales basados en blockchain.',
                'is_active' => true,
            ]
        );

        AssetType::updateOrCreate(
            ['name' => 'Acción'],
            [
                'description' =>
                    'Participación en una empresa.',
                'is_active' => true,
            ]
        );

        AssetType::updateOrCreate(
            ['name' => 'ETF'],
            [
                'description' =>
                    'Fondo de inversión cotizado.',
                'is_active' => true,
            ]
        );

        Asset::updateOrCreate(
            ['symbol' => 'BTC'],
            [
                'asset_type_id' => $crypto->id,
                'name' => 'Bitcoin',
                'api_id' => 'bitcoin',
                'current_price' => 0,
                'is_active' => true,
            ]
        );

        Asset::updateOrCreate(
            ['symbol' => 'ETH'],
            [
                'asset_type_id' => $crypto->id,
                'name' => 'Ethereum',
                'api_id' => 'ethereum',
                'current_price' => 0,
                'is_active' => true,
            ]
        );

        Asset::updateOrCreate(
            ['symbol' => 'SOL'],
            [
                'asset_type_id' => $crypto->id,
                'name' => 'Solana',
                'api_id' => 'solana',
                'current_price' => 0,
                'is_active' => true,
            ]
        );
    }
}