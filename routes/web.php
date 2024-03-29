<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::any('ceshi',[TestController::class,'Test']);
Route::any('saoma',[TestController::class,'SaoMa']);
Route::any('saoma1',[TestController::class,'SaoMas']);
Route::any('deploy',[TestController::class,'_deploy'])->name('deploy');
