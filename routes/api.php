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

//机器webHook  api/webHook/bot?compress=0&robot=gaoxueya
Route::group(['prefix' => 'webHook', 'middleware' => 'throttle:5000,1'],function (){
    Route::any('bot',[App\Http\Controllers\Api\KOOKController::class,'_webHookApi']);
});
