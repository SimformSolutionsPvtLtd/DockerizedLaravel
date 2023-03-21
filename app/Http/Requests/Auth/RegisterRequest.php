<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\ValidationRequests;
use Illuminate\Support\Arr;
class RegisterRequest extends ValidationRequests
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

         $rules = [
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users|max:50',
            'password' => 'required|string|min:8|max:30',
        ];

        if ($this->routeIs('update-profile'))
        {
            $rules = Arr::except($rules, ['email', 'password']);
        }

        return $rules;
    }


    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => __('Please enter name'),
            'email.required' => __('Please enter email'),
            'email.email' => __('Please enter valid email'),
            'password.required' => __('Please enter password'),
        ];
    }
}
