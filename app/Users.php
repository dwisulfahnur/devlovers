<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    //
    public function __construct($full_name, $email, $username, $password, $dob, $gender, $roles_id, $city_id, $profile_picture)
    {
        $this->full_name = $full_name;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
        $this->dob = $dob;
        $this->age = date_diff(date_create($dob), date_create('today'))->y;;
        $this->gender = $gender;
        $this->roles_id = $roles_id;
        $this->city_id = $city_id;
        $this->profile_picture = $profile_picture;
    }

}
