<?php

namespace App\Libraries\DevLovers;

use Illuminate\Support\Facades\DB;

class UserMatch
{
    static function isMatch($user_self_id, $target_user_id)
    {
        $user1 = UserLike::getUserLike($user_self_id, $target_user_id);
        $user2 = UserLike::getUserLike($target_user_id, $user_self_id);
        if( !$user1 and !$user2 ){
            return false;
        }
        return true;
    }

    static function createMatch($user_self_id, $target_user_id)
    {
        $user_matches = [['user_id'         => $user_self_id,
                          'user_match_id'   => $target_user_id,
                          'created_at'      => \Carbon\Carbon::now(),
                          'updated_at'      => \Carbon\Carbon::now()],
                         ['user_id'         => $target_user_id,
                          'user_match_id'   => $user_self_id,
                          'created_at'      => \Carbon\Carbon::now(),
                          'updated_at'      => \Carbon\Carbon::now()
                        ]];
        DB::table('users_matches')->insert($user_matches);
    }
}
