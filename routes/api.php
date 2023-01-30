<?php

use App\Http\Controllers\PerformanceController;
use App\Http\Controllers\PusherController;
use App\Http\Controllers\ShowdownController;
use App\Http\Controllers\StatsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('/showdown/join/{user?}', [ShowdownController::class, 'join'])->name('showdown.join');

Route::get('/showdown/{showdown}/confirm', [ShowdownController::class, 'confirm'])->name('showdown.confirm');

Route::post('/showdown/{showdown}/round/{round}/performance', [PerformanceController::class, 'store'])
    ->name('performance.store');

Route::get('/users/{user}/stats/win-loss', [StatsController::class, 'winLoss'])
    ->name('stats.win-loss');

Route::post('/pusher/channel-vacated', [PusherController::class, 'channelVacated'])
    ->name('pusher.channel-vacated');

Route::get('/health-check', function () {
    return response()->json(['status' => 'ok']);
})->name('health-check');
