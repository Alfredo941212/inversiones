<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();

            $table->foreignId('asset_type_id')
                ->constrained()
                ->restrictOnDelete();

            $table->string('name', 100);
            $table->string('symbol', 20)->unique();

            // Identificador utilizado por CoinGecko:
            // bitcoin, ethereum, solana, etc.
            $table->string('api_id', 100)->nullable()->unique();

            $table->decimal('current_price', 18, 2)->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};