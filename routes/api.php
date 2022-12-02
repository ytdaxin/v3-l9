<?php

use Illuminate\Http\Request;
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

Route::group(['prefix' => 'v1', 'middleware' => 'throttle:5000,1'],function (){
    Route::any('login',[App\Http\Controllers\Api\LoginController::class,'_index']);
});



//机器webHook  api/webHook/bot?compress=0&robot=gaoxueya
Route::group(['prefix' => 'webHook', 'middleware' => 'throttle:5000,1'],function (){
    Route::any('bot',[App\Http\Controllers\Api\KOOKController::class,'_webHookApi']);
    Route::any('Telegram',[App\Http\Controllers\Api\TelegramController::class,'_pushmsg']);
});
