<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePlayerRequest;
use App\Models\Party;
use App\Models\Player;
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
     * @return RedirectResponse
     */
    public function signInGameWithUuid(StorePlayerRequest $request, Party $party): RedirectResponse
    {
        $session_id = session()->getId();

        $existingPlayer = Player::query()
            ->where('session_id', '=', $session_id)
            ->where('party_id', '=', $party->id)
            ->first();
        if (!$existingPlayer) {
            $player = new Player();
            $player->name = $request->get('name');
            $player->session_id = $session_id;
            $player->party_id = $party->id;
            $player->save();
        }

        return Redirect::route('player_game', ['player_uuid' => $party->player_uuid]);
    }
}
