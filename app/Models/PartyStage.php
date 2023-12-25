<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $party_id
 * @property int $type
 * @property string $title
 * @property string $description
 * @property int|null $answer_id
 * @property int $points
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property Player|null $player_winner
 * @property-read Party $party
 *
 * @mixin Builder
 */
class PartyStage extends Model
{
    use HasFactory;

    public const TYPE_ROUND = 1;
    public const TYPE_QUESTION = 2;
    public const TYPE_QUESTION_DESCRIPTION = 3;

    protected $fillable = ['player_winner_id'];

    /**
     * @return string[]
     */
    public static function getPartyStageType(): array
    {
        return [
            self::TYPE_ROUND => 'Раунд',
            self::TYPE_QUESTION => 'Вопрос',
            self::TYPE_QUESTION_DESCRIPTION => 'Описание',
        ];
    }

    /**
     * @return BelongsTo
     */
    public function party(): BelongsTo
    {
        return $this->belongsTo(Party::class);
    }

    /**
     * @return BelongsTo
     */
    public function answer(): BelongsTo
    {
        return $this->belongsTo(Answer::class);
    }

    /**
     * @return BelongsTo
     */
    public function player_winner(): BelongsTo
    {
        return $this->belongsTo(Player::class, 'player_winner_id');
    }
}
