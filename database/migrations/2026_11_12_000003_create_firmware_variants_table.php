<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('firmware_variants', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->unsignedBigInteger('item_id')->nullable();
            $table->string('rom_type', 50)->default('Global');
            $table->boolean('supports_band_4')->default(true);
            $table->boolean('gms_preinstalled')->default(true);
            $table->decimal('price_ttd', 10, 2)->default(0);
            $table->integer('stock_quantity')->default(10);
            $table->string('disclaimer_text', 500)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('firmware_variants');
    }
};
