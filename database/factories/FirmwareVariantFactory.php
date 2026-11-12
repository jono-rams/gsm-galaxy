<?php

namespace Database\Factories;

use App\Models\FirmwareVariant;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FirmwareVariant>
 */
class FirmwareVariantFactory extends Factory
{
    protected $model = FirmwareVariant::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'rom_type' => 'Global',
            'supports_band_4' => true,
            'gms_preinstalled' => true,
            'price_ttd' => fake()->numberBetween(3200, 6800),
            'stock_quantity' => fake()->numberBetween(5, 25),
            'disclaimer_text' => 'Verified Global ROM with native Google Mobile Services (GMS) and Digicel/Bmobile AWS Band 4 LTE compatibility.',
        ];
    }

    /**
     * State for a Chinese ROM variant requiring a disclaimer modal.
     */
    public function chineseRom(): static
    {
        return $this->state(fn (array $attributes): array => [
            'rom_type' => 'CN',
            'supports_band_4' => false,
            'gms_preinstalled' => false,
            'disclaimer_text' => 'WARNING: Chinese (CN) ROM firmware. May lack AWS Band 4 for rural Digicel/Bmobile 4G LTE coverage, requires manual Google Mobile Services (GMS) installation, and carries no local return coverage for regional software incompatibility.',
        ]);
    }

    /**
     * State for a European (EEA) ROM variant.
     */
    public function eeaRom(): static
    {
        return $this->state(fn (array $attributes): array => [
            'rom_type' => 'EEA',
            'supports_band_4' => true,
            'gms_preinstalled' => true,
            'disclaimer_text' => 'European Economic Area (EEA) ROM with full GDPR compliance, native Google Play Services, and verified local LTE Band 2/4/12 support.',
        ]);
    }
}
