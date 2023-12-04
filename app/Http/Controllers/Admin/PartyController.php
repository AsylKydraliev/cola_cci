<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Party;
use App\Models\PartyStage;
use App\Models\Question;
use App\Models\Round;
use Illuminate\Support\Str;

class PartyController extends Controller
{
    public function store(Game $game)
    {
        $game->load('rounds.questions');

        $party = new Party();
        $party->game_id = $game->id;
        $party->moderator_uuid = Str::uuid();
        $party->player_uuid = Str::uuid();
        $party->status = Party::STATUS_ACTIVE;
        $party->save();

        /** @var Round $round */
        foreach ($game->rounds as $round) {
            $partyStage = new PartyStage();
            $partyStage->type = PartyStage::TYPE_ROUND;
            $partyStage->title = $round->round_title;

            $party->stages()->save($partyStage);

            /** @var Question $question */
            foreach ($round->questions as $question) {
                $partyStage = new PartyStage();
                $partyStage->type = PartyStage::TYPE_QUESTION;
                $partyStage->title = $question->question_title;
                $partyStage->answer_id = $question->answer_id;
                $partyStage->points = $question->points;

                $party->stages()->save($partyStage);
            }
        }
        $minStageId = $party->stages()->min('id');

        $party->party_stage_id = $minStageId;
        $party->save();
    }
}