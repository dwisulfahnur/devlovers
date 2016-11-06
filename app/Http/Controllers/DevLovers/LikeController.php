<?php

namespace App\Http\Controllers\DevLovers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Libraries\DevLovers\UserObject;
use App\Libraries\DevLovers\UserLike;
use App\Libraries\DevLovers\UserMatch;

class LikeController extends Controller
{
    public function like(Request $request)
    {
        //------------------------- Handle like request and user matches ---------------------------//
        if($request->has('like','target')){

            $user_self_id = session('id');
            $target_user_id = $request->input('target');
            $like = $request->input('like') ? 1 : 0;

            $user_like = UserLike::getUserLike($user_self_id, $target_user_id);

            if($user_like And !($user_like->like === $like)){
                if($like === 1){
                    if(UserMatch::isMatch($user_self_id, $target_user_id)){     //check if User is Match
                        UserMatch::createMatch($user_self_id, $target_user_id);      //Create User Match
                    }
                    if($user_like->like === 0){  //If user want to change dislike to like
                        UserLike::updateUserLike($user_self_id, $target_user_id, $like); //Update to Like (1)
                    }
                }
            }
            if(!$user_like){
                UserLike::createUserLike($user_self_id, $target_user_id, $like);
                if(UserMatch::isMatch($user_self_id, $target_user_id)){     //check if User is Match
                    UserMatch::createMatch($user_self_id, $target_user_id);      //Create User Match
                }
            }

        }
        return redirect()->back();
    }
}
