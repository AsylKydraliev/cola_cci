<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Party;
use App\Models\PartyStage;
use Illuminate\Http\Request;

class PartyStagesController extends Controller
{
    public function getPartyStages(Request $request, Party $party)
    {
        $path = $request->path();

        $partyStages = PartyStage::query()->where('party_id', '=', $party->id);

        return view('client.partyStages', compact('partyStages'));
    }
}
