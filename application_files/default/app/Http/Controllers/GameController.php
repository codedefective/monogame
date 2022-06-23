<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Web\BaseController;
use Illuminate\Http\Request;

class GameController extends BaseController
{
    public function init(Request $request){
        $bearerToken = current($request->session()->get('bearer'));
        return view('game.initGame',['bearer' => $bearerToken]);
    }

    public function play(Request $request, string $token){
        $walletUrl = $request->user()->wallet->host;
        return view('game.play.play',['token' => $token,'walletUrl' => $walletUrl]);
    }
}
