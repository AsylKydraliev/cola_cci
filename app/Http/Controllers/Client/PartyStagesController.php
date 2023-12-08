<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Party;
use App\Models\PartyStage;
use App\Models\Player;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PartyStagesController extends Controller
{
    /**
     * @param Party $party
     * @return \Illuminate\Foundation\Application|View|Factory|Application
     */
    public function partyStagesForPlayer(Party $party): \Illuminate\Foundation\Application|View|Factory|Application
    {
        $session_id = session()->getId();
        $existingPlayer = Player::where('session_id', '=', $session_id)->first();

        // если $party->status = STATUS_STARTED и сессии нет то возвращаем view о том что игра началась
        if ($party->status == Party::STATUS_STARTED && !$existingPlayer) {
            return view('player.gameWasStarted');
        }

        // если статус STATUS_COMPLETED то возвращаем view о том что игра закончилась
        if ($party->status == Party::STATUS_FINISHED) {
            return view('player.gameOver');
        }

        // если статус STATUS_PENDING и сессии нет то возвращаем на страницу входа
        if ($party->status == Party::STATUS_PENDING && !$existingPlayer) {
            return view('welcome');
        }

        if ($existingPlayer) {
            //если игрок авторизовался возвращаем старницу игры
            $partyStage = PartyStage::query()->find($party->party_stage_id);

            // Если тип Раунд, то возвращаем страницу ожидания игры
            if ($partyStage->type == PartyStage::TYPE_ROUND) {
                return view('player.roundGame', compact('partyStage'));
            }

            // Если тип Вопрос, то возвращаем страницу игры
            return view('player.questionGame', compact('partyStage'));
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

        // Если тип Раунд, то возвращаем страницу ожидания игры
        if ($partyStage->type == PartyStage::TYPE_ROUND) {
            return view('moderator.roundGame', compact('partyStage'));
        }

        // Если тип Вопрос, то возвращаем страницу игры
        return view('moderator.questionGame', compact('partyStage'));
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

        if (!$partyStage && $party->status === Party::STATUS_STARTED ||
            !$partyStage && $party->status === Party::STATUS_FINISHED)
        {
            $party->status = Party::STATUS_FINISHED;
            $party->save();

            return redirect()->back()->with('finish', 'Игра окончена');
        }

        $party->party_stage_id = $partyStage->id;
        $party->save();

        return redirect()->back();
    }
}
