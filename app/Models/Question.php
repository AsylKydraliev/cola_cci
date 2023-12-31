<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $question_title
 * @property integer $points
 * @property integer $answer_id
 *
 * @property-read Round $round
 * @property-read Answer $answer
 *
 * @mixin Builder
 */
class Question extends Model
{
    use HasFactory;

    public const LIMIT_ON_NUMBER_OF_QUESTIONS_PER_ROUND = 10;

    protected $fillable = [
      'question_title',
      'answer_id',
      'round_id',
      'points'
    ];

    /**
     * @return BelongsTo
     */
    public function round(): BelongsTo
    {
        return $this->belongsTo(Round::class);
    }

    /**
     * @return BelongsTo
     */
    public function answer(): BelongsTo
    {
        return $this->belongsTo(Answer::class);
    }
}
