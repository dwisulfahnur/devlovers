<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\City;
use App\Country;
use App\Roles;
use App\Users;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;

use App\Http\Requests;

class UserController extends Controller
{
    public function home(){
        $name = session('username');
        return view('user.home', ['name'=>$name]);
    }

    public function register()
    {
        $roles = Roles::all();
        $city = City::all();
        $data = [$roles, $city];
        return view('user.register', ["roles"=>$roles, "cities"=>$city]);
    }

    public function postRegister(RegisterRequest $request)
    {
        //hashing password of Password field
        $password = Hash::make($request->password);

        //Set Name of Profile_piture File
        $imageName = time().'.'.$request->image->getClientOriginalExtension();

        //Create Object of User
        $user = new Users(
                        $full_name  = $request->full_name,
                        $email      = $request->email,
                        $username   = $request->username,
                        $password   = $password,
                        $dob        = $request->dob,
                        $gender     = $request->gender,
                        $roles_id   = $request->roles,
                        $city_id    = $request->city,
                        $profile_picture = 'images/' . $imageName
                    );

        //Save User data and Profile picture to Storage if not Fail.
        if($user->save() And $request->image->move(public_path('images'), $imageName))
        {
            return redirect('/login');
        }
        else{
            return "Failed to Save";
        }
    }

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
            return redirect('home');
        }
        else{
            return redirect('login');
        }
    }

    public function logout(Request $request){
        $request->session()->flush();
        return redirect('login');
    }
}
