<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{

    public function register()
    {
        $roles = DB::table('roles')->select('id', 'name')->get();
        $programming_languages = DB::table('programming_languages')->select('id','name')->get();
        $cities = DB::table('cities')->select('id', 'name')->get();

        $data['roles'] = $roles;
        $data['programming_languages'] = $programming_languages;
        $data['cities'] = $cities;
        return view('user.register', $data);
    }

    public function postRegister(RegisterRequest $request)
    {
        //hashing password of Password field
        $password = Hash::make($request->password);

        //Set Name of Profile_piture File
        $imageName = time().'.'.$request->image->getClientOriginalExtension();

        //Create Object of User
        $user = [
                    'full_name'  => $request->full_name,
                    'email'      => $request->email,
                    'username'   => $request->username,
                    'password'   => $password,
                    'dob'        => $request->dob,
                    'gender'     => $request->gender,
                    'roles_id'   => $request->roles,
                    'city_id'    => $request->city,
                    'profile_picture' => 'images/' . $imageName,
                    "created_at"      => \Carbon\Carbon::now(),
                    "updated_at"      => \Carbon\Carbon::now()
                ];
        //Save User data and Profile picture to Storage if not Fail.
        if($request->image->move(public_path('images'), $imageName) And DB::table('users')->insert([$user]) )
        {
            $user_self_id = DB::table('users')->where('email', $user['email'])->first()->id;
            if($user_self_id){
                $programming_languages = $request->input('programming_languages');
                foreach ($programming_languages as $language) {
                    DB::table('users_programming_languages')->insert(['user_id' => $user_self_id, 'programming_languages_id' => $language]);
                }

                return redirect('/login');
            }
        }
        else{
            return redirect('/login')->withErrors('Failed to save user data');
        }
    }

}
