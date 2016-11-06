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

    static function createUser($user_object)
    {

    }

    static function getUserProgrammingLanguage($id){
        $user_self_language = DB::table('users')
                              ->join('users_programming_languages', 'users.id', '=', 'users_programming_languages.user_id')
                              ->join('programming_languages', 'users_programming_languages.programming_languages_id', '=', 'programming_languages.id')
                              ->select('programming_languages.id', 'programming_languages.name')
                              ->where('users.id', $id)
                              ->get();
        return $user_self_language;
    }
}
