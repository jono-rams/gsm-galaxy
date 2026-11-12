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
        Schema::table('cart', function (Blueprint $table): void {
            $table->foreignId('firmware_variant_id')
                ->nullable()
                ->after('product_id')
                ->constrained('firmware_variants')
                ->nullOnDelete();
        });

        Schema::table('orders', function (Blueprint $table): void {
            $table->string('order_number', 100)->nullable()->after('order_no');
            $table->decimal('subtotal_ttd', 10, 2)->default(0)->after('subtotal');
            $table->decimal('discount_ttd', 10, 2)->default(0)->after('subtotal_ttd');
            $table->decimal('total_ttd', 10, 2)->default(0)->after('total');
            $table->integer('xp_earned')->default(0)->after('total_ttd');
            $table->string('order_status', 50)->default('Processing')->after('payment_status');
            $table->string('delivery_address', 255)->nullable()->after('order_status');
            $table->string('delivery_city', 100)->nullable()->after('delivery_address');
            $table->string('contact_phone', 50)->nullable()->after('delivery_city');
            $table->unsignedBigInteger('shipping_id')->nullable()->change();
            $table->unsignedBigInteger('shipping_address_id')->nullable()->change();
            $table->unsignedBigInteger('billing_address_id')->nullable()->change();
        });

        Schema::table('order_products', function (Blueprint $table): void {
            $table->foreignId('firmware_variant_id')
                ->nullable()
                ->after('product_id')
                ->constrained('firmware_variants')
                ->nullOnDelete();
            $table->decimal('unit_price_ttd', 10, 2)->default(0)->after('price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_products', function (Blueprint $table): void {
            $table->dropConstrainedForeignId('firmware_variant_id');
            $table->dropColumn('unit_price_ttd');
        });

        Schema::table('orders', function (Blueprint $table): void {
            $table->dropColumn([
                'order_number',
                'subtotal_ttd',
                'discount_ttd',
                'total_ttd',
                'xp_earned',
                'order_status',
                'delivery_address',
                'delivery_city',
                'contact_phone',
            ]);
        });

        Schema::table('cart', function (Blueprint $table): void {
            $table->dropConstrainedForeignId('firmware_variant_id');
        });
    }
};
