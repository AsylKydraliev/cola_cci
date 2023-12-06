<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePlayerRequest;
use App\Models\Party;
use App\Models\PartyStage;
use App\Models\Player;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class PlayerController extends Controller
{

    /**
     * @param StorePlayerRequest $request
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function signInGame(StorePlayerRequest $request): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $game_code = $request->get('game_code');
        $session_id = session()->getId();

        $party = Party::where('game_code', '=', $game_code)->first();
        $partyStage = PartyStage::find($party->party_stage_id);

        $existingPlayer = Player::where('session_id', '=', $session_id)->first();

        if ($existingPlayer) {
            // Если тип Раунд, то возвращаем страницу ожидания игры
            if ($partyStage->type == PartyStage::TYPE_ROUND) {
                return view('player.roundGame', compact('partyStage'));
            }

            // Если тип Вопрос, то возвращаем страницу игры
            return view('player.questionGame', compact('partyStage'));
        } else {
            $player = new Player();
            $player->name = $request->get('name');
            $player->game_code = $request->get('game_code');
            $player->session_id = $session_id;
            $player->party_id = $party->id;
            $player->save();


            // Если тип Раунд, то возвращаем страницу ожидания игры
            if ($partyStage->type == PartyStage::TYPE_ROUND) {
                return view('player.roundGame', compact('partyStage'));
            }

            // Если тип Вопрос, то возвращаем страницу игры
            return view('player.questionGame', compact('partyStage'));
        }
    }
}
