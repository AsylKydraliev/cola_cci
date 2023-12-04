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
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read Game $game
 * @property-read PartyStage $stages
 *
 * @mixin Builder
 */
class Party extends Model
{
    use HasFactory;

    public const STATUS_ACTIVE = 1;
    public const STATUS_STARTED = 2;
    public const STATUS_COMPLETED = 3;

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
}
