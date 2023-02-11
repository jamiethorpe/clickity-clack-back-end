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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            // TODO - prevent people from using really terrible names
            'id' => 'nullable|exists:users,id',
            'name' => 'required|string|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string',
            'password_confirmation' => 'required|string|same:password',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter your name',
            'email.required' => 'Please enter your email address',
            'email.email' => 'Please enter a valid email address',
            'email.unique' => 'There is already an account with that email address',
            'password.required' => 'Please enter a password',
            'password_confirmation.required' => 'Please confirm your password',
            'password_confirmation.same' => 'The passwords do not match',
        ];
    }
}
