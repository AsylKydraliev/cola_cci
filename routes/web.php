<?php

use App\Http\Controllers\Admin\PartyController;
use App\Http\Controllers\Client\PartyStagesController;
use App\Http\Controllers\Admin\GameController;
use App\Http\Controllers\Client\PlayerController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    Route::resource('games', GameController::class);
    Route::get('parties/{game}', [PartyController::class, 'getParties'])->name('parties');
    Route::post('store_party/{game}', [PartyController::class, 'store'])->name('store_party');
});

Route::get('player_game/{player_uuid}', [PartyStagesController::class, 'partyStagesForPlayer'])->name('player_game');
Route::get('moderator_game/{moderator_uuid}', [PartyStagesController::class, 'partyStagesForModerator'])->name('moderator_game');
Route::get('next_party_stage/{party_id}', [PartyStagesController::class, 'nextPartyStage'])->name('next_party_stage');

Route::post('player_game_code', [PlayerController::class, 'signInGameWithCode'])->name('player_game_code');
Route::post('player_game_uuid/{player_uuid}', [PlayerController::class, 'signInGameWithUuid'])->name('player_game_uuid');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
