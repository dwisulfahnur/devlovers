<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests;

use App\Http\Controllers\Controller;

class LoginController extends Controller
{

    public function login()
    {
        return view('user.login');
    }

    public function postLogin(LoginRequest $request)
    {
        $email = $request->email;
        $password = $request->password;

        $user = DB::table('users')->where('email', $email)->first();

        if($user And Hash::check($password, $user->password)){
            $request->session()->put('username', $user->username);
            return redirect('/');
        }
        else{
            return redirect('login')->withErrors('Invalid Email or Password');
        }
    }

    public function logout(Request $request){
        $request->session()->flush();
        return redirect('login');
    }

}
