<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $round_title
 * @property string $description
 * @property int $game_id
 *
 * @property-read Game $game
 * @property-read Question $questions
 *
 * @mixin Builder
 */
class Round extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'round_title',
        'description',
        'game_id'
    ];

    /**
     * @return BelongsTo
     */
    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    /**
     * @return HasMany
     */
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }
}
