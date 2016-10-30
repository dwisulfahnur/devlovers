<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App;

class BrowseUserController extends Controller
{
    public function browse_user(Request $request){
        $user_id = DB::table('users')->select('id')->where('username', $request->session()->get('username'))->first()->id;
        $_gender = $request->has('gender');
        $_roles = $request->has('roles');
        $_city = $request->has('city');

        if(!$_gender and !$_roles and !$_city){
            $user = DB::table('users')->select('id', 'full_name', 'profile_picture', 'gender')
                                      ->whereNotIn('id',[$user_id])
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

            $user = DB::table('users')->select('id', 'full_name', 'profile_picture')
                                      ->where('gender', 'LIKE', $gender)
                                      ->where('roles_id', 'LIKE', $roles)
                                      ->where('city_id', 'LIKE', $city)
                                      ->whereNotIn('id',[$user_id])
                                      ->paginate(5);
        }


        if($request->has('like','target')){
            $target = $request->input('target');
            $like = $request->input('like');
            $user_has_likes = App\Users_likes::where([
                                                    ['user_id',  $user_id],
                                                    ['target_user_id', $target]
                                                    ])->first();
            if($user_has_likes){
                $user_has_likes->like = $like;
                $user_has_likes->save();
            }
            else{
                $user_like = new App\Users_likes();
                $user_like->user_id = $user_id;
                $user_like->target_user_id = $target;
                $user_like->like = $like;
                $user_like->save();
            }
        }

        return view('user.browse', ["users"=>$user]);
    }

    public function filter_user(Request $request){
        $roles = DB::table('roles')->select('id', 'name')->get();
        $cities = DB::table('cities')->select('id', 'name')->get();

        return view('user.browse_filter', ["roles"=>$roles, "cities"=>$cities]);
    }
}
