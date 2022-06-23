<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\Web\LoginController;
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
    return view('game.home');
})->name('home');


Route::get('/login',function (){
    if (auth()->check()){
        return redirect()->route('home');
    }
    return view('game.login');
})->name('login');

Route::post('/login',[LoginController::class,'login'])->name('loginPost');

Route::get('/logout',[LoginController::class,'logout'])->name('logout');

Route::middleware('auth')->get('/gameplay/t-rex', [GameController::class,'init'])->name('initGame');
Route::middleware('auth')->get('/run/t-rex/{token}', [GameController::class,'play'])->name('play');


