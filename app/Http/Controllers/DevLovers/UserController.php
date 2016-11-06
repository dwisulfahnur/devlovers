<?php

namespace App\Http\Controllers\DevLovers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Http\Requests\UserRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Libraries\DevLovers\UserView;
use App\Libraries\DevLovers\UserObject;

class UserController extends Controller
{

    public function detail_user(Request $request, $username)
    {
        // check user if not exist
        if(UserObject::getUserByUsername($username) === null){
            return abort(404);
        }

        #------------------------------ Get User object ---------------#
        $user = DB::table('users')
                ->join('roles', 'users.roles_id', '=', 'roles.id')  //Join table roles
                ->join('cities', 'users.city_id', '=', 'cities.id') //Join table city
                ->select('users.id as id',
                         'users.username as username',
                         'users.full_name as full_name',
                         //'users.dob as dob',
                         'users.profile_picture as profile_picture',
                         //'users.gender as gender',
                         'roles.name as role')
                         //'cities.name as city')
                ->where('users.username', $username)
                ->first();
        // Create User programming language Object
        $user->programming_languages = DB::table('users')
                                       ->join('users_programming_languages', 'users.id', '=', 'users_programming_languages.user_id')
                                       ->join('programming_languages', 'users_programming_languages.programming_languages_id', '=', 'programming_languages.id')
                                       ->select('programming_languages.name')
                                       ->where('users.id', $user->id)
                                       ->get();
        // Count User Age by DOB
        //$user->gender = $user->gender===0 ? "Female" : "Male";
        //$user->age = date_diff(date_create($user->dob), date_create('today'))->y;

        #---------------- End of Get User object ----------------------#


        #------------------------ Handle of User view ---------------------#
        if($username !== session('username')){
            UserView::createView(session('id'), $user->id);
        }
        #----------------------- Handle of User view ---------------------#

        $data['user'] = $user;
        return view('devlovers.detail_user', $data);
    }

    public function edit_profile(Request $request){
        $user_self = UserObject::getUserById(session('id'));
        $user_self->programming_languages = [];

        # Add programming_languages_id to array
        foreach(UserObject::getUserProgrammingLanguage(session('id')) as $language){
            array_push($user_self->programming_languages, $language->id);
        }

        $roles = DB::table('roles')->select('id', 'name')->get();
        $programming_languages = DB::table('programming_languages')->select('id','name')->get();
        $cities = DB::table('cities')->select('id', 'name')->get();


        $data['user_self'] = $user_self;
        $data['roles'] = $roles;
        $data['programming_languages'] = $programming_languages;
        $data['cities'] = $cities;
        return view('devlovers.edit_profile', $data);
    }

    public function put_edit_profile(Request $request){

        $user = DB::table('users')->where('id', session('id'))->first();
        $imgName = $request->input('username').time().'.'.$request->image->getClientOriginalExtension();
        //create user object
        $user_object = [
                    'full_name'  => $request->input('full_name'),
                    'email'      => $request->input('email'),
                    'username'   => $request->input('username'),
                    'dob'        => $request->input('dob'),
                    'gender'     => $request->input('gender'),
                    'profile_picture' => $imgName,
                    'roles_id'   => $request->input('roles'),
                    'city_id'    => $request->input('city'),
                    'updated_at'      => \Carbon\Carbon::now()
                ];

        if(DB::table('users')->where('id', $user->id)->update($user_object)){
            if($request->hasFile('image')){
                $request->image->move(storage_path('images'), $imgName);
            }
            DB::table('users_programming_languages')->where('user_id', $user->id)->delete();
            $users_programming_languages = $request->programming_languages;
            foreach($users_programming_languages as $language){
                DB::table('users_programming_languages')->insert(['user_id' => $user->id, 'programming_languages_id' => $language]);
            }
        }
        return redirect()->back();
    }
}
