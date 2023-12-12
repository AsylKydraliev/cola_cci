<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Party;
use App\Models\PartyStage;
use App\Models\Player;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PartyStagesController extends Controller
{
    /**
     * @param Party $party
     * @return \Illuminate\Foundation\Application|View|Factory|Application
     */
    public function partyStagesForPlayer(Party $party): \Illuminate\Foundation\Application|View|Factory|Application
    {
        $session_id = session()->getId();
        $existingPlayer = Player::query()
            ->where('session_id', '=', $session_id)
            ->where('party_id', '=', $party->id)
            ->first();

        // если $party->status = STATUS_STARTED и сессии нет то возвращаем view о том что игра началась
        if ($party->status == Party::STATUS_STARTED && !$existingPlayer) {
            return view('player.gameWasStarted');
        }

        // если статус STATUS_FINISH то возвращаем view о том что игра закончилась
        if ($party->status == Party::STATUS_FINISHED) {
            $points = $this->getPoints($party);

            return view('player.gameOver', ['points' => $points]);
        }

        // если статус STATUS_PENDING и сессии нет то возвращаем на страницу входа
        if ($party->status == Party::STATUS_PENDING && !$existingPlayer) {
            return view('player.playerLogin');
        }

        if ($existingPlayer) {
            //если игрок авторизовался возвращаем старницу игры
            $partyStage = PartyStage::query()->find($party->party_stage_id);

            $points = $this->getPoints($party);

            // Если тип Раунд, то возвращаем страницу ожидания игры
            if ($partyStage->type == PartyStage::TYPE_ROUND) {
                return view('player.roundGame', compact('partyStage'));
            }

            // Если тип Вопрос, то возвращаем страницу игры
            return view('player.questionGame', compact('partyStage', 'existingPlayer', 'points'));
        }

        return view('player.playerLogin', compact('party'));
    }

    /**
     * @param Party $party
     * @return \Illuminate\Foundation\Application|View|Factory|Application
     */
    public function partyStagesForModerator(Party $party): \Illuminate\Foundation\Application|View|Factory|Application
    {
        $partyStage = PartyStage::query()->find($party->party_stage_id);

        $points = $this->getPoints($party);
        // Если тип Раунд, то возвращаем страницу ожидания игры
        if ($partyStage->type == PartyStage::TYPE_ROUND) {
            return view('moderator.roundGame', compact('partyStage'));
        }

        // Если тип Вопрос, то возвращаем страницу игры
        return view('moderator.questionGame', compact('partyStage', 'points'));
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
            ->leftJoinSub($partyStages, 'party_stages', function ($join) {
                $join->on('party_stages.player_winner_id', '=', 'players.id');
            })
            ->where('party_id', '=', $party->id)
            ->orderByDesc('party_stages.points')
            ->limit(5)
            ->get(['players.name', 'party_stages.points']);
    }

    /**
     * @param Party $party
     * @return RedirectResponse
     */
    public function nextPartyStage(Party $party): RedirectResponse
    {
        $partyStage = PartyStage::query()
            ->where('party_id', '=', $party->id)
            ->where('id', '>', $party->party_stage_id)
            ->orderBy('id')
            ->first();

        if ($party->status === Party::STATUS_PENDING) {
            $party->status = Party::STATUS_STARTED;
        }

        if (!$partyStage && $party->status === Party::STATUS_STARTED) {
            $party->status = Party::STATUS_FINISHED;
            $party->save();

            $points = $this->getPoints($party);

            return redirect()->back()->with(['points' => $points]);
        }

        $party->party_stage_id = $partyStage->id;
        $party->save();

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @param PartyStage $partyStage
     * @return JsonResponse
     */
    public function savePlayerWinner(Request $request, PartyStage $partyStage): JsonResponse
    {
        $player = Player::find($request->get('player_id'));

        if ($player) {
            $partyStage->player_winner()->associate($player);
            $partyStage->save();

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Игрок не найден'], 404);
        }
    }
}
