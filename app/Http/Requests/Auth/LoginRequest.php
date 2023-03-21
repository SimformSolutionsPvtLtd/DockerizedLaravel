<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\ValidationRequests;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends ValidationRequests
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string',
        ];
    }


    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => __('Please enter email'),
            'email.email' => __('Please enter valid email'),
            'password.required' => __('Please enter password'),
        ];
    }
}
