<?php

namespace App\Http\Controllers\DevLovers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App;

use App\Http\Controllers\Controller;

class BrowseUserController extends Controller
{
    public function browse_user(Request $request){

        //----------- make an array of user id which will be hidden in view-------------//
        $user_like = DB::table('users_likes')->select('target_user_id')
                                             ->where('user_id', session('id'))
                                             ->where('like', 1)
                                             ->get();

        $user_hide = [];
        foreach ($user_like as $user){
            array_push($user_hide, $user->target_user_id);
        }
        array_push($user_hide,  $request->session()->get('id'));
        //---------------------------------###########---------------------------------//

        // Handle browse user with filter or without filter
        $_gender = $request->has('gender');
        $_roles = $request->has('roles');
        $_city = $request->has('city');

        if(!$_gender and !$_roles and !$_city){
            $user = DB::table('users')->select('id', 'full_name', 'profile_picture', 'gender', 'username')
                                      ->whereNotIn('id', $user_hide)
                                      ->paginate(5);
        }
        else{
            switch ($request->input('gender')) {
                case '0':
                    $gender = '0'; break;
                case '1':
                    $gender = '1'; break;
                default:
                    $gender = '%'; break;
            }
            $roles = ($request->input('roles')) ? $request->input('roles') : '%';
            $city = ($request->input('city')) ? $request->input('city') : '%';

            $user = DB::table('users')->select('id', 'full_name', 'profile_picture', 'username')
                                      ->where('gender', 'LIKE', $gender)
                                      ->where('roles_id', 'LIKE', $roles)
                                      ->where('city_id', 'LIKE', $city)
                                      ->whereNotIn('id',$user_hide)
                                      ->paginate(5);

        }

        $data['users'] = $user;
        return view('devlovers.browse', $data);
    }

    public function filter_user(Request $request){
        $roles = DB::table('roles')->select('id', 'name')->get();
        $cities = DB::table('cities')->select('id', 'name')->get();

        $data['roles'] = $roles;
        $data['cities'] = $cities;
        return view('devlovers.browse_filter', $data);
    }
}
