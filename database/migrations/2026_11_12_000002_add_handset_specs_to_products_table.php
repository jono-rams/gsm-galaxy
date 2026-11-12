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
        Schema::table('products', function (Blueprint $table): void {
            $table->string('brand_name', 100)->default('Generic')->after('id');
            $table->string('model_name', 150)->nullable()->after('brand_name');
            $table->string('chipset', 150)->default('Snapdragon 8 Gen 2')->after('full_description');
            $table->integer('ram_gb')->default(8)->after('chipset');
            $table->integer('storage_gb')->default(256)->after('ram_gb');
            $table->integer('display_refresh_hz')->default(120)->after('storage_gb');
            $table->integer('main_camera_mp')->default(50)->after('display_refresh_hz');
            $table->boolean('has_ois')->default(true)->after('main_camera_mp');
            $table->string('ip_rating', 20)->default('IP68')->after('has_ois');
            $table->integer('battery_mah')->default(5000)->after('ip_rating');
            $table->decimal('price_ttd', 10, 2)->default(0)->after('price');
            $table->integer('stock_quantity')->default(20)->after('quantity');
            $table->string('image_url', 255)->nullable()->after('image_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table): void {
            $table->dropColumn([
                'brand_name',
                'model_name',
                'chipset',
                'ram_gb',
                'storage_gb',
                'display_refresh_hz',
                'main_camera_mp',
                'has_ois',
                'ip_rating',
                'battery_mah',
                'price_ttd',
                'stock_quantity',
                'image_url',
            ]);
        });
    }
};
