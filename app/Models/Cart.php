<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'cart';

    protected $fillable = [
        'user_id',
        'product_id',
        'firmware_variant_id',
        'quantity',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'quantity' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function firmwareVariant(): BelongsTo
    {
        return $this->belongsTo(FirmwareVariant::class, 'firmware_variant_id');
    }

    /**
     * Get the effective unit price in TTD for this cart item.
     */
    public function getUnitPriceTtd(): float
    {
        if ($this->firmwareVariant && $this->firmwareVariant->price_ttd > 0) {
            return (float) $this->firmwareVariant->price_ttd;
        }

        return $this->product ? $this->product->getPrice() : 0.0;
    }

    /**
     * Get the line subtotal in TTD for this cart item.
     */
    public function getSubtotalTtd(): float
    {
        return $this->getUnitPriceTtd() * $this->quantity;
    }
}
