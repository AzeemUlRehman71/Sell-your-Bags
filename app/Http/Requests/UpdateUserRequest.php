<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            //'email' => 'required|email|unique:users',
            'email' => 'required|email|unique:users,email,'.$this->id,
            'password' => 'required|min:8|required_with:password_confirmation|same:password_confirmation',
        ];
    }
}
