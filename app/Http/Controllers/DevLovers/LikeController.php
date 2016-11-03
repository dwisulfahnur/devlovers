<?php

namespace App\Http\Controllers\DevLovers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LikeController extends Controller
{
    public function like(Request $request)
    {
        #Procedure for check match user
        function check_match($user_id, $target){
            if((DB::table('users_likes')->where('user_id', $user_id)
                                               ->where('target_user_id', $target)
                                               ->where('like', 1)
                                               ->first())){
                if((DB::table('users_likes')->where('user_id', $target)
                                                   ->where('target_user_id', $user_id)
                                                   ->where('like', 1)
                                                   ->first())){

                    DB::table('users_matches')->insert(['user_id'=>$user_id, 'user_match_id'=>$target]);
                    DB::table('users_matches')->insert(['user_id'=>$target, 'user_match_id'=>$user_id]);
                }

            }

        }

        //Handle like request and user matches
        $user_id = DB::table('users')->select('id')->where('username', $request->session()->get('username'))->first()->id;
        if($request->has('like','target')){
            $target = $request->input('target');
            $like = $request->input('like');
            $user_has_likes = DB::table('users_likes')->where('user_id', $user_id)
                                                      ->where('target_user_id', $target)
                                                      ->first();
            if($user_has_likes){
                if(settype(! $user_has_likes->like === $like){
                    DB::table('users_likes')->where('user_id', $user_id)
                                            ->where('target_user_id', $target)
                                            ->update(['like'        =>$like,
                                                      'updated_at'  => \Carbon\Carbon::now()]);
                    if($like==='1'){
                        check_match($user_id, $target);
                    }
                }
                return redirect()->back();
            }
            else{
                DB::table('users_likes')->insert([
                    'user_id'           => $user_id,
                    'target_user_id'    => $target,
                    'like'              => $like,
                    "created_at"        => \Carbon\Carbon::now(),
                    "updated_at"        => \Carbon\Carbon::now()
                ]);
                if($like===1){
                    check_match($user_id, $target);
                }
                return redirect()->back();
            }
        }

    }
}
