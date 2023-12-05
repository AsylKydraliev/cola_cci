<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Party;
use App\Models\PartyStage;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class PartyStagesController extends Controller
{
    /**
     * @param Party $party
     * @return \Illuminate\Foundation\Application|View|Factory|Application
     */
    public function partyStagesForPlayer(Party $party): \Illuminate\Foundation\Application|View|Factory|Application
    {
        $partyStage = PartyStage::query()->find($party->party_stage_id);

        // Если тип Раунд, то возвращаем страницу ожидания игры
        if ($partyStage->type == PartyStage::TYPE_ROUND) {
            return view('player.roundGame', compact('partyStage'));
        }

        // Если тип Вопрос, то возвращаем страницу игры
        return view('player.questionGame', compact('partyStage'));
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

        $party->party_stage_id = $partyStage->id;
        $party->save();

        return redirect()->back();
    }

    public function playerSignInGame(Request $request)
    {
        $request->session()->put('player_' . $request->session()->getId(), [
            'game_code' => $request->get('game_code'),
            'name' => $request->get('name')
        ]);

        // Получение данных из сессии
        $playerKey = 'player_' . $request->session()->getId();
        $playerData = $request->session()->get($playerKey);
        dd(session()->all());
    }
}
