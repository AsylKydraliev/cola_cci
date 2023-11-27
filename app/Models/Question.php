<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $question
 * @property string $answer
 *
 * @property-read Round $round
 *
 * @mixin Builder
 */
class Question extends Model
{
    use HasFactory;

    protected $fillable = [
      'id',
      'question',
      'answer'
    ];

    /**
     * @return BelongsTo
     */
    public function round(): BelongsTo
    {
        return $this->belongsTo(Round::class);
    }
}
