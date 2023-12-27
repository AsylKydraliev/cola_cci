<?php

namespace App\Http\Controllers\Admin;

use App\Events\GamePartiesUpdateEvent;
use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Game;
use App\Models\Party;
use App\Models\PartyStage;
use App\Models\Question;
use App\Models\Round;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Pusher\PusherException;

class PartyController extends Controller
{
    /**
     * @param Game $game
     * @return RedirectResponse
     * @throws GuzzleException
     * @throws PusherException
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
        $party->status = Party::STATUS_PENDING;
        $party->game_code = $uniqueGameCode;
        $party->save();

        /** @var Round $round */
        foreach ($game->rounds as $round) {
            $partyStage = new PartyStage();
            $partyStage->type = PartyStage::TYPE_ROUND;
            $partyStage->title = $round->round_title;
            $partyStage->description = $round->description;

            $questionAnswers = Question::query()
                ->where('round_id', '=', $round->id)
                ->pluck('answer_id')
                ->toArray();
            $limitForRandomAnswers = Question::LIMIT_ON_NUMBER_OF_QUESTIONS_PER_ROUND - count($questionAnswers);
            $randomAnswers = Answer::query()
                ->whereNotIn('id', $questionAnswers)
                ->inRandomOrder()
                ->limit($limitForRandomAnswers)
                ->pluck('id')
                ->toArray();

            $roundAnswerIds = array_merge($questionAnswers, $randomAnswers);

            $roundAnswers = Answer::query()
                ->select('answers.id', 'round_answers.answer_title', 'answers.answer_width')
                ->leftJoinSub(function ($query) use ($roundAnswerIds) {
                    $query->select('id', 'answer_title')
                        ->from('answers')
                        ->whereIn('id', $roundAnswerIds);
                }, 'round_answers', 'answers.id', '=', 'round_answers.id')
                ->inRandomOrder()
                ->limit(Answer::LIMIT_OF_QUESTIONS_IN_GAME)
                ->get();

            $party->stages()->save($partyStage);

            /** @var Question $question */
            foreach ($round->questions as $question) {
                $partyStage = new PartyStage();
                $partyStage->type = PartyStage::TYPE_QUESTION_DESCRIPTION;
                $partyStage->title = $question->question_title;
                $partyStage->round_answers = $roundAnswers;

                $party->stages()->save($partyStage);

                $partyStage = new PartyStage();
                $partyStage->type = PartyStage::TYPE_QUESTION;
                $partyStage->title = $question->question_title;
                $partyStage->answer_id = $question->answer_id;
                $partyStage->points = $question->points;
                $partyStage->round_answers = $roundAnswers;

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

    /**
     * @param Party $party
     * @return Collection
     */
    private function getPoints(Party $party): Collection
    {
        $partyStages = PartyStage::query()
            ->selectRaw('SUM(points) as points, player_winner_id')
            ->where('party_id', '=', $party->id)
            ->groupBy('player_winner_id');

        return $party->players()
            ->select(['players.name', 'party_stages.points'])
            ->leftJoinSub($partyStages, 'party_stages', function ($join) {
                $join->on('party_stages.player_winner_id', '=', 'players.id');
            })
            ->orderByDesc('party_stages.points')
            ->get();
    }

    /**
     * @param Party $party
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function showPartyStages(Party $party): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $points = $this->getPoints($party);
        $partyStages = $party->stages;
        $partyStages->load('answer', 'player_winner');

        return view('admin.partyStages.partyStages', compact('partyStages', 'points'));
    }

    /**
     * @param Party $party
     * @return JsonResponse|RedirectResponse
     * @throws GuzzleException
     * @throws PusherException
     */
    public function finishGame(Party $party): JsonResponse|RedirectResponse
    {
        $party->status = Party::STATUS_FINISHED;
        $party->save();

        event(new GamePartiesUpdateEvent($party->id));

        return response()->json(['success' => 'Игра успешно завершена']);
    }
}
