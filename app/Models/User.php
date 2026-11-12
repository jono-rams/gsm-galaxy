<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'xp_points',
        'vip_tier',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'xp_points' => 'integer',
        ];
    }

    /**
     *  =============== RELATIONSHIPS  ===============
     */

    /**
     * The products that belong to the User in their cart.
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'cart', 'user_id', 'product_id')
            ->withPivot('id', 'firmware_variant_id', 'quantity')
            ->withTimestamps();
    }

    /**
     * Cart entries belonging to the user.
     */
    public function cartItems(): HasMany
    {
        return $this->hasMany(Cart::class, 'user_id');
    }

    /**
     * Orders placed by the user.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    /**
     * XP activity logs earned by the user.
     */
    public function xpLogs(): HasMany
    {
        return $this->hasMany(XpLog::class, 'user_id');
    }

    /**
     *  =============== FUNCTIONS  ===============
     */

    /**
     * @return array<int, int>
     */
    public function getGroups(): array
    {
        return [1];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Get the VIP discount percentage based on the user's verified database tier.
     */
    public function getVipDiscountPercentage(): int
    {
        return match ($this->vip_tier) {
            'Gold' => 10,
            'Silver' => 5,
            default => 0,
        };
    }
}
