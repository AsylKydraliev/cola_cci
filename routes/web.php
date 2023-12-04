<?php

use App\Http\Controllers\Admin\PartyController;
use App\Http\Controllers\Client\PartyStagesController;
use App\Http\Controllers\Admin\GameController;
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
    Route::post('store_party/{game}', [PartyController::class, 'store'])->name('store_party');
});

Route::get('player-game/{uuid}', [PartyStagesController::class, 'getPartyStages']);
Route::get('moderator-game/{uuid}', [PartyStagesController::class, 'getPartyStages']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
