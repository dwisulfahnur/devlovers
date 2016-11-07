<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if($this->isMethod('post')){
            return [
                'image'                 =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2024',
                'full_name'             =>  'required|min:8|max:50',
                'email'                 =>  'required|min:8|email|unique:users,email',
                'username'              =>  'required|min:8|unique:users,username',
                'password'              =>  'required|min:6|confirmed',
                'password_confirmation' =>  'required|min:6|same:password',
                'dob'                   =>  'required|before:now',
                'gender'                =>  'required|boolean',
                'roles'                 =>  'required|exists:cities,id',
                'city'                  =>  'required|exists:cities,id'
            ];
        }

        if($this->isMethod('put')){
            return [
                'image'                 =>  'image|mimes:jpeg,png,jpg,gif,svg|max:2024',
                'full_name'             =>  'required|min:8|max:50',
                'email'                 =>  'required|min:8|email|unique:users,email,'.$this->session()->get('id'),
                'username'              =>  'required|min:8|unique:users,username,'.$this->session()->get('id'),
                'dob'                   =>  'required|before:now',
                'gender'                =>  'required|boolean',
                'roles'                 =>  'required|exists:roles,id',
                'city'                  =>  'required|exists:cities,id'
            ];

        }
    }
}
