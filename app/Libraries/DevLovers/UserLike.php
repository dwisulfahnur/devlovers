<?php

namespace App\Libraries\DevLovers;

use Illuminate\Support\Facades\DB;


class UserLike
{
    static function getUserLike($user_self_id, $target_user_id)
    {
        $user = DB::table('users_likes')->where('user_id', $user_self_id)
                                        ->where('target_user_id', $target_user_id)
                                        ->first();
        return $user;
    }

    static function createUserLike($user_self_id, $target_user_id, $like)
    {
        $user_like = ['user_id'        => $user_self_id,
                      'target_user_id' => $target_user_id,
                      'like'           => $like,
                      'created_at'      => \Carbon\Carbon::now(),
                      'updated_at'      => \Carbon\Carbon::now()
                     ];
        DB::table('users_likes')->insert($user_like);
    }

    static function updateUserLike($user_self_id, $target_user_id, $like)
    {
        DB::table('users_likes')->where('user_id', $user_self_id)
                                ->where('target_user_id', $target_user_id)
                                ->update(['like' => $like, 'updated_at' => \Carbon\Carbon::now()]);
    }

}
