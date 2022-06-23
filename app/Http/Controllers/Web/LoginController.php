<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\Web\LoginRequest;
use Auth;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LoginController extends BaseController
{

    /**
     * @return Application|Factory|View
     */
    public function index(){
        return view('game.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $credential = $request->safe()->only(['email', 'password']);
        if (Auth::attempt($credential)){
            $request->session()->regenerate();
            $user = Auth::getUser();
            $tkn = $user->createToken('web_token',['web','game_play'])->plainTextToken;
            $request->session()->push('bearer',$tkn);
            return redirect()->route('home');
        }
        return redirect()->refresh()->withInput($request->input())->withErrors(['Invalid Credentials']);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->pull('bearer');
        return redirect()->route('home');
    }
}
