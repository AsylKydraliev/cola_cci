<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Party;
use App\Models\PartyStage;
use App\Models\Question;
use App\Models\Round;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class PartyController extends Controller
{
    /**
     * @param Game $game
     * @return RedirectResponse
     */
    public function store(Game $game): RedirectResponse
    {
        $game->load('rounds.questions');

        $uniqueGameCode = rand(10000, 99999);

        // Проверяем уникальность сгенерированного числа в базе данных
        while (Party::where('game_code', $uniqueGameCode)->exists()) {
            $uniqueGameCode = rand(10000, 99999);
        }

        $party = new Party();
        $party->game_id = $game->id;
        $party->moderator_uuid = Str::uuid();
        $party->player_uuid = Str::uuid();
        $party->status = Party::STATUS_ACTIVE;
        $party->game_code = $uniqueGameCode;
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

        return redirect()
            ->back()
            ->with('success', "Партия  успешно создана");
    }

    /**
     * @param Game $game
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function getParties(Game $game): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $parties = Party::query()
            ->where('game_id', '=', $game->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.games.parties', compact('parties', 'game'));
    }
}
