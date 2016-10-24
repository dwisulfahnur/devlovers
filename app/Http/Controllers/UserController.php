<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use App\Roles;
use App\Users;
use Illuminate\Http\Request;
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
        $user = new Users;
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = $request->password;
        $user->dob = $request->dob;
        $user->gender = $request->gender;
        $user->roles_id = $request->roles;
        $user->city_id = $request->city;

        $imageName = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('images'), $imageName);
        $user->profile_picture = 'images/'.$imageName;

        if($user->save()){
            return "Saved success!";
        }
        else{
            return "Failed to Save";
        }
        
    }
}
