<?php

namespace App\Http\Controllers\DevLovers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    public function detail_user(Request $request, $username){
        $user_self = DB::table('users')->select('id', 'full_name')->where('username', $request->session()->get('username'))->first();


        //get user target object
        $user_id = DB::table('users')->select('id', 'full_name')->where('username', $username)->first()->id;
        $user = DB::table('users')
                ->join('roles', 'users.roles_id', '=', 'roles.id')
                ->join('cities', 'users.city_id', '=', 'cities.id')
                ->select('users.id as id',
                         'users.full_name as full_name',
                         'users.dob as dob',
                         'users.profile_picture as profile_picture',
                         'users.gender as gender',
                         'roles.name as role',
                         'cities.name as city')
                ->where('users.id', $user_id)
                ->first();

        // check user if not exist
        if(!$user){
        return abort(404);
        }

        $user->programming_languages = DB::table('users')
                                       ->join('users_programming_languages', 'users.id', '=', 'users_programming_languages.user_id')
                                       ->join('programming_languages', 'users_programming_languages.programming_languages_id', '=', 'programming_languages.id')
                                       ->select('programming_languages.name')
                                       ->where('users.id', $user_id)
                                       ->get();
        $user->gender = $user->gender===0 ? "Female" : "Male";
        $user->age = date_diff(date_create($user->dob), date_create('today'))->y;

        //User view Handle
        $user_is_view = DB::table('users_views')->where('user_id', $user_self->id)
                                                ->where('target_user_id', $user->id)
                                                ->first();
        if(!$user_is_view){
            DB::table('users_views')->insert([
                  'user_id'         => $user_self->id,
                  'target_user_id'  => $user->id,
                  'created_at'      => \Carbon\Carbon::now(),
                  'updated_at'      => \Carbon\Carbon::now(),
                 ]);
        }
        else{
            DB::table('users_views')->where('user_id', $user_self->id)
            ->where('target_user_id', $user->id)
            ->update(['updated_at'=>\Carbon\Carbon::now()]);
        }

        return view('user.detail_user', ["user"=>$user, "user_self"=>$user_self]);
    }
}
