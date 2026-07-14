<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('asset_id')
                ->constrained()
                ->restrictOnDelete();

            $table->enum('type', ['compra', 'venta']);

            $table->decimal('quantity', 18, 8);
            $table->decimal('unit_price', 18, 2);
            $table->decimal('total', 18, 2);

            $table->dateTime('operation_date');

            // En operaciones financieras es mejor cancelar
            // que eliminar definitivamente el registro.
            $table->enum('status', ['activa', 'cancelada'])
                ->default('activa');

            $table->timestamps();

            $table->index([
                'user_id',
                'asset_id',
                'status',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};