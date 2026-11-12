<?php

namespace App\Models;

use App\Helpers\ProductCollectionHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'price_ttd' => 'decimal:2',
            'ram_gb' => 'integer',
            'storage_gb' => 'integer',
            'display_refresh_hz' => 'integer',
            'main_camera_mp' => 'integer',
            'has_ois' => 'boolean',
            'battery_mah' => 'integer',
            'quantity' => 'integer',
            'stock_quantity' => 'integer',
        ];
    }

    /**
     * Create a new Eloquent Collection instance.
     *
     * @param  array<int, \Illuminate\Database\Eloquent\Model>  $models
     * @return \Illuminate\Database\Eloquent\Collection<int, \Illuminate\Database\Eloquent\Model>
     */
    public function newCollection(array $models = []): Collection
    {
        return new ProductCollectionHelper($models);
    }

    /**
     *  =============== RELATIONSHIPS  ===============
     */

    /**
     * Regional ROM firmware variants available for this handset.
     */
    public function firmwareVariants(): HasMany
    {
        return $this->hasMany(FirmwareVariant::class, 'product_id');
    }

    /**
     *  =============== SCOPES  ===============
     */
    public function scopeWithPrices(Builder $query, array $group_ids = [1]): void
    {
        $query->where('products.id', '>', 0);
    }

    public function scopeSingleProduct(Builder $query, int $id): void
    {
        $query->where('products.id', $id);
    }

    /**
     *  =============== FUNCTIONS  ===============
     */
    public function getImage(): string
    {
        if (! empty($this->image_url)) {
            if (str_starts_with($this->image_url, 'http://') || str_starts_with($this->image_url, 'https://')) {
                return $this->image_url;
            }

            return asset(ltrim($this->image_url, '/'));
        }

        if (! empty($this->image_name) && $this->image_name !== 'no_image.jpg') {
            $storagePath = storage_path('app/public'.$this->image_path.$this->image_name);
            if (file_exists($storagePath)) {
                return asset('storage'.$this->image_path.$this->image_name);
            }
        }

        return asset('images/hero_phone.jpg');
    }

    public function getPrice(): float
    {
        return (float) ($this->price_ttd > 0 ? $this->price_ttd : $this->price);
    }

    public function getStockPrice(): float
    {
        return $this->getPrice();
    }

    public function getCartQuantityPrice(): float
    {
        return $this->getPrice() * $this->pivot->quantity;
    }

    public function getLink(): string
    {
        return route('shop.details', ['id' => $this->id]);
    }
}
