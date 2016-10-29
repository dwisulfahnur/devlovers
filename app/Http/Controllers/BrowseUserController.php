<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;

class BrowseUserController extends Controller
{
    public function browse_user(Request $request){
        $user = DB::table('users')->select('id', 'full_name', 'profile_picture', 'gender')->paginate(5);
        //dd($user);
        return view('user.browse', ["users"=>$user]);
    }

    public function filter_user(Request $request){
        $roles = DB::table('roles')->select('id', 'name')->get();
        $cities = DB::table('cities')->select('id', 'name')->get();

        return view('user.browse_filter', ["roles"=>$roles, "cities"=>$cities]);
    }

    public function filter_browse_post(Request $request){

        //$gender = ($request->gender === 0) ? $request->gender : '%';
        if($request->gender==='0'){
            $gender = '0';
        }
        elseif($request->gender==='1'){
            $gender = '1';
        }else{
            $gender = '%';
        }
        $roles = ($request->roles) ? $request->roles : '%';
        $city = ($request->city) ? $request->city : '%';

        $user = DB::table('users')->select('id', 'full_name', 'profile_picture')
                                  ->where('gender', 'LIKE', $gender)
                                  ->where('roles_id', 'LIKE', $roles)
                                  ->where('city_id', 'LIKE', $city)
                                  ->paginate(5);

        return view('user.browse', ["users"=>$user]);
    }

}
