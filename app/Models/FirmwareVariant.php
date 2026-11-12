<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FirmwareVariant extends Model
{
    /** @use HasFactory<\Database\Factories\FirmwareVariantFactory> */
    use HasFactory;

    protected $table = 'firmware_variants';

    protected $fillable = [
        'product_id',
        'item_id',
        'rom_type',
        'supports_band_4',
        'gms_preinstalled',
        'price_ttd',
        'stock_quantity',
        'disclaimer_text',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'supports_band_4' => 'boolean',
            'gms_preinstalled' => 'boolean',
            'price_ttd' => 'decimal:2',
            'stock_quantity' => 'integer',
        ];
    }

    /**
     * The handset product this firmware variant belongs to.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * Determine whether this variant requires a Chinese ROM warning modal.
     */
    public function isChineseRom(): bool
    {
        return strtoupper($this->rom_type) === 'CN' || str_contains(strtoupper($this->rom_type), 'CHINESE');
    }
}
