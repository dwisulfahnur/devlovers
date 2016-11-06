<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Libraries\DevLovers\UserObject;

class LoginController extends Controller
{

    public function login()
    {
        return view('auth.login');
    }

    public function postLogin(LoginRequest $request)
    {
        $email = $request->email;

        $password = $request->password;

        $user = UserObject::getUserByEmail($email);

        if($user And Hash::check($password, $user->password))
        {
            $request->session()->put('id', $user->id);
            $request->session()->put('username', $user->username);
            $request->session()->put('full_name', $user->full_name);
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
