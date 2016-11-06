<?php

namespace App\Libraries\DevLovers;

use Illuminate\Support\Facades\DB;

class UserView
{
    static function isView($user_self_id, $target_user_id)
    {
        $user_view = DB::table('users_views')->where('user_id', $user_self_id)
                                             ->where('target_user_id', $target_user_id)
                                             ->first();
        if($user_view === null){
            return false;
        }
        return true;
    }

    static function createView($user_self_id, $target_user_id)
    {
        $user_view_object = ['user_id'         => $user_self_id,
                             'target_user_id'   => $target_user_id,
                             'created_at'      => \Carbon\Carbon::now(),
                             'updated_at'      => \Carbon\Carbon::now()];

        DB::table('users_views')->insert($user_view_object);

    }

    static function updateView($user_self_id, $target_user_id)
    {
        $user_view_object = ['updated_at'      => \Carbon\Carbon::now()];

        DB::table('users_views')->where('user_id', $user_self_id)
                                ->where('target_user_id', $target_user_id)
                                ->update(['updated_at'=> \Carbon\Carbon::now()]);

    }
}
