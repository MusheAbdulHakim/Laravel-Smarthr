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
            'name'=>'required|max:100',
            'username'=>'required|max:10',
            'email'=>'required|email|max:100',
            'password'=>'required|confirmed',
            'avatar' =>'file|image|mimes:jpg,jpeg,png,gif',
        ];
    }
}
