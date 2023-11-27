<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property string $title
 * @property integer $rounds_quantity
 * @property string $uuid
 *
 * @property-read Round $rounds
 *
 * @mixin Builder
 */
class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'rounds_quantity',
        'uuid',
        'round_id'
    ];

    /**
     * @return HasMany
     */
    public function rounds(): HasMany
    {
        return $this->hasMany(Round::class);
    }

    /**
     * @return void
     */
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($game) {
            $game->uuid = (string) Str::uuid();
        });
    }
}
