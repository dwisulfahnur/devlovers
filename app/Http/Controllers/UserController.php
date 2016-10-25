<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use App\Roles;
use App\Users;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

use App\Http\Requests;

use Input;

class UserController extends Controller
{
    public function register()
    {
        $roles = Roles::all();
        $city = City::all();
        $data = [$roles, $city];
        return view('user.register', ["roles"=>$roles, "cities"=>$city]);
    }

    public function postRegister(RegisterRequest $request)
    {
        $imageName = time().'.'.$request->image->getClientOriginalExtension();
        $user = new Users(
                        $full_name  = $request->full_name,
                        $email      = $request->email,
                        $username   = $request->username,
                        $password   = Hash::make($request->password),
                        $dob        = $request->dob,
                        $gender     = $request->gender,
                        $roles_id   = $request->roles,
                        $city_id    = $request->city,
                        $profile_picture = 'images/' . $imageName
                    );

        if($user->save() And $request->image->move(public_path('images'), $imageName))
        {
            return "Saved success!";
        }
        else{
            return "Failed to Save";
        }
    }

    public function login()
    {
        //return view('user.login');
        $data = Roles::all();
        dd($data);
    }

    public function postLogin()
    {
        return "you're logged in";
    }
}
