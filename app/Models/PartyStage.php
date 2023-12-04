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
 * @property int|null $answer_id
 * @property int $points
 * @property string|null $player_winner
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read Party $party
 *
 * @mixin Builder
 */
class PartyStage extends Model
{
    use HasFactory;

    public const TYPE_ROUND = 1;
    public const TYPE_QUESTION = 2;

    /**
     * @return BelongsTo
     */
    public function party(): BelongsTo
    {
        return $this->belongsTo(Party::class);
    }

    /**
     * @return string[]
     */
    public static function getPartyStageType(): array
    {
        return [
            self::TYPE_ROUND => 'Раунд',
            self::TYPE_QUESTION => 'Вопрос'
        ];
    }
}
