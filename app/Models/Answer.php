<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $answer_title
 *
 * @property-read Question $question
 *
 * @mixin Builder
 */
class Answer extends Model
{
    use HasFactory;

    public const LIMIT_OF_QUESTIONS_IN_GAME = 18;

    protected $fillable = [
        'id',
        'answer_title',
    ];

    /**
     * @return Answer[]|Collection
     */
    public static  function shuffleAnswers(): Collection|array
    {
        return self::inRandomOrder()->limit(19)->get();
    }

    /**
     * @return HasMany
     */
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    /**
     * @return BelongsToMany
     */
    public function partyStage(): BelongsToMany
    {
        return $this->belongsToMany(PartyStage::class);
    }
}
