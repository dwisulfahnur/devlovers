<?php

namespace App\Libraries\DevLovers;

use Illuminate\Support\Facades\DB;

class UserObject
{

    static function getUserById($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        return $user;
    }

    static function isUser($id)
    {
        if(self::getUserById($id === null)){
            return false;
        }
        return true;
    }

    static function getUserByEmail($email)
    {
        $user = DB::table('users')->where('email', $email)->first();
        return $user;
    }

    static function getUserByUsername($username)
    {
        $user = DB::table('users')->where('username', $username)->first();
        return $user;
    }

    static function getUserHasLike($id){

    }

    static function createUser($user_object)
    {

    }

    static function getUserProgrammingLanguage($id){
        $user_self_language = DB::table('users')
                              ->join('users_programming_languages', 'users.id', '=', 'users_programming_languages.user_id')
                              ->join('programming_languages', 'users_programming_languages.programming_languages_id', '=', 'programming_languages.id')
                              ->select('programming_languages.id')
                              ->where('users.id', $id)
                              ->get();

        $user_programming_languages = [];
        foreach ($user_self_language as $language) {
            array_push($user_programming_languages, $language->id);
        }
        return $user_programming_languages;
    }


}

class UserLike
{
    static function isLike($user_self_id, $target_user_id)
    {
        $user = DB::table('users_likes')->where('user_id', $user_self_id)
                                        ->where('target_user_id', $target_user_id)
                                        ->where('like', 1)
                                        ->first();
        if(! $user)
        {
            return false;
        }
        return true;
    }

    static function isHasLike($user_self_id, $target_user_id)
    {
        $user = DB::table('users_likes')->where('user_id', $user_self_id)
                                  ->where('target_user_id', $target_user_id)
                                  ->first();
        if($user === null)
        {
            return false;
        }
        return true;
    }

    static function createLike($user_self_id, $target_user_id, $like)
    {
        $user_like = ['user_id'        => $user_self_id,
                      'target_user_id' => $target_user_id,
                      'like'           => $like
                     ];
        DB::table('users_likes')->insert($user_like);
    }

}

class UserMatch
{
    static function isMatch($user_self_id, $target_user_id)
    {
        if( !UserLike::isLike($user_self_id, $target_user_id) And !UserLike::isLike($target_user_id, $user_self_id) ){
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
