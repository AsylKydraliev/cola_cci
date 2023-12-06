<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property int $id
 * @property string $name
 * @property string $game_code
 * @property integer $session_id
 * @property integer $party_id
 *
 * @mixin Builder
 */
class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'game_code',
    ];
}
