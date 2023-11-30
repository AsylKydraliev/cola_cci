<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $game_title
 * @property integer $rounds_quantity
 *
 * @mixin Builder
 */
class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'game_title',
        'rounds_quantity'
    ];

    /**
     * @return HasMany
     */
    public function rounds(): HasMany
    {
        return $this->hasMany(Round::class);
    }
}
