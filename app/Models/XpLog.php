<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class XpLog extends Model
{
    use HasFactory;

    protected $table = 'xp_logs';

    protected $fillable = [
        'user_id',
        'action_type',
        'xp_awarded',
        'description',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'xp_awarded' => 'integer',
        ];
    }

    /**
     * The user who earned this XP entry.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
