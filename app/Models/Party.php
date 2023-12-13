<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $game_id
 * @property string $moderator_uuid
 * @property string $player_uuid
 * @property string|null $players
 * @property int|null $party_stage_id
 * @property int $status
 * @property int $game_code
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read Game $game
 * @property-read PartyStage $stages
 * @property-read PartyStage $stage
 *
 * @mixin Builder
 */
class Party extends Model
{
    use HasFactory;

    public const STATUS_PENDING = 1;
    public const STATUS_STARTED = 2;
    public const STATUS_FINISHED = 3;

    /**
     * @return string[]
     */
    public static function getStatus(): array
    {
        return [
            self::STATUS_PENDING => 'Ожидание игры',
            self::STATUS_STARTED => 'Игра началась',
            self::STATUS_FINISHED => 'Игра окончена'
        ];
    }

    /**
     * @return string[]
     */
    public static function getStatusColor(): array
    {
        return [
            self::STATUS_PENDING => 'warning',
            self::STATUS_STARTED => 'success',
            self::STATUS_FINISHED => 'danger'
        ];
    }

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
    public function stages(): HasMany
    {
        return $this->hasMany(PartyStage::class);
    }

    /**
     * @return BelongsTo
     */
    public function stage(): BelongsTo
    {
        return $this->belongsTo(PartyStage::class, 'party_stage_id');
    }

    /**
     * @return HasMany
     */
    public function players(): HasMany
    {
        return $this->hasMany(Player::class);
    }
}
