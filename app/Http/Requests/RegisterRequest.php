<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
        return [
            'image'                 =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2024',
            'full_name'             =>  'required|min:8|max:50',
            'email'                 =>  'required|unique:users,email|min:8|email',
            'username'              =>  'required|unique:users,username|min:8',
            'password'              =>  'required|min:6|confirmed',
            'password_confirmation' =>  'required|min:6|same:password',
            'dob'                   =>  'required|before:now',
        ];
    }
}
