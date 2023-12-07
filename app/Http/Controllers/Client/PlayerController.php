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
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class PlayerController extends Controller
{
    /**
     * @param StorePlayerRequest $request
     * @return RedirectResponse
     */
    function signInGameWithCode(StorePlayerRequest $request): RedirectResponse
    {
        $game_code = $request->get('game_code');
        $session_id = session()->getId();

        $existingPlayer = Player::where('session_id', '=', $session_id)->first();
        $party = Party::where('game_code', '=', $game_code)->firstOrFail();

        if (!$existingPlayer) {
            $player = new Player();
            $player->name = $request->get('name');
            $player->session_id = $session_id;
            $player->party_id = $party->id;
            $player->save();
        }

        return Redirect::route('player_game', ['player_uuid' => $party->player_uuid]);
    }

    /**
     * @param StorePlayerRequest $request
     * @param Party $party
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function signInGameWithUuid(StorePlayerRequest $request, Party $party): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $session_id = session()->getId();

        $existingPlayer = Player::where('session_id', '=', $session_id)->first();
        $partyStage = $party->stage;

        // если игрока с такой сессией нет, то создаем его и пропускаем к партии
        if (!$existingPlayer) {
            $player = new Player();
            $player->name = $request->get('name');
            $player->session_id = $session_id;
            $player->party_id = $party->id;
            $player->save();
        }

        // Если тип Раунд, то возвращаем страницу ожидания игры
        if ($partyStage->type == PartyStage::TYPE_ROUND) {
            return view('player.roundGame', compact('partyStage'));
        }
        // Если тип Вопрос, то возвращаем страницу игры
        return view('player.questionGame', compact('partyStage'));
    }
}
