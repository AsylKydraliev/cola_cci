<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Party;
use App\Models\PartyStage;
use Illuminate\Http\Request;

class PartyStagesController extends Controller
{
    public function getPartyStages(Request $request, string $uuid)
    {
        if(str_contains($request->path(), 'player-game')) {
            $party = Party::query()->where('player_uuid', '=', $uuid)->first();

            $partyStages = PartyStage::query()
                ->where('party_id', '=', $party->id)
                ->get();
        }

        if(str_contains($request->path(), 'moderator-game')) {
            $party = Party::query()->where('moderator_uuid', '=', $uuid)->first();

            $partyStages = PartyStage::query()
                ->where('party_id', '=', $party->id)
                ->get();
        }

        return view('client.partyStages', compact('partyStages'));
    }
}
