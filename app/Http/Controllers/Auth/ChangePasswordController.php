<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests;

class ChangePasswordController extends Controller
{
    public function change(){
        return view('auth.change_password');
    }

    public function put_change(ChangePasswordRequest $request){
        $user = DB::table('users')->where('id', session('id'))->first();
        $old_password = $request->input('password');
        $new_password = $request->input('new_password');
        $hash_password = Hash::make($new_password);
        if(Hash::check($old_password, $user->password)){
            if($old_password === $new_password){
                $error = 'The password should not be same as the old password!';
            }
            else{
                DB::table('users')->where('id', session('id'))->update(['password' => $hash_password]);
            }
        }
        else{
            $error = 'Your password is wrong!';
        }
        if(isset($error)){
            return redirect()->back()->withErrors([$error]);
        }
        return redirect()->back()->with('status', 'Password is changed !');
    }
}
