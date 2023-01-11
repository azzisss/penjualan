<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function indexLogin(){
        return view('login.index',[
            "title" => 'Login',
            // "active" => 'login'
        ]);
        
    }

    public function login( LoginRequest $request)
    {
        
        $credentials = $request->getCredentials();

        if(!Auth::validate($credentials)):
            return redirect()->to('login')
                ->withErrors(trans('Failed Login, These credentials do not match our records.'));
        endif;

        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        Auth::login($user);

        return $this->authenticated($request, $user);
    }


    protected function authenticated(Request $request, $user) 
    {
        return redirect()->intended('/');
    }

    
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

}
