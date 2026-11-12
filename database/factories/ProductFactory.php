<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $brands = ['Xiaomi', 'Vivo', 'Nothing', 'Sony', 'Realme', 'OnePlus'];
        $brand = $brands[fake()->numberBetween(0, count($brands) - 1)];
        $modelName = $brand.' '.Str::ucfirst(fake()->unique()->words(2, true)).' 5G';
        $priceTtd = fake()->numberBetween(3200, 6800);
        $stockQty = fake()->numberBetween(8, 30);

        return [
            'brand_name' => $brand,
            'model_name' => $modelName,
            'title' => $modelName,
            'short_description' => fake()->text(160),
            'full_description' => fake()->text(400),
            'chipset' => fake()->randomElement([
                'Snapdragon 8 Gen 3',
                'MediaTek Dimensity 9200+',
                'MediaTek Dimensity 9300',
                'Snapdragon 8+ Gen 1',
                'Snapdragon 8 Gen 2',
            ]),
            'ram_gb' => fake()->randomElement([8, 12, 16]),
            'storage_gb' => fake()->randomElement([256, 512]),
            'display_refresh_hz' => fake()->randomElement([120, 144]),
            'main_camera_mp' => fake()->randomElement([50, 64, 200]),
            'has_ois' => fake()->boolean(85),
            'ip_rating' => fake()->randomElement(['IP68', 'IP65', 'IP54']),
            'battery_mah' => fake()->randomElement([4700, 5000, 5400, 5500]),
            'price' => $priceTtd,
            'price_ttd' => $priceTtd,
            'quantity' => $stockQty,
            'stock_quantity' => $stockQty,
            'image_path' => '/images/products/',
            'image_name' => $this->randomImage(),
            'image_url' => '/images/hero_phone.jpg',
            'category' => strtolower($brand),
            'classification' => 'default',
            'status' => 'active',
            'created_at' => fake()->dateTimeBetween(now()->subMonths(3), now()),
        ];
    }

    public function randomImage(): string
    {
        $images = Storage::disk('images')->files();

        if (empty($images)) {
            return 'no_image.jpg';
        }

        $randomIndex = array_rand($images);

        return $images[$randomIndex];
    }
}
