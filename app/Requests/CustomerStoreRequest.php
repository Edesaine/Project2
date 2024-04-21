<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerStoreRequest extends FormRequest
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
            'name'=> ['required'],
            'email' => ['required'],
            'password' => ['required'],
            'phone' => ['required'],
            'gender' => ['required'],
            'address' => ['required'],
            'account_status' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'name.regex' => 'Name is not correct format',
            'email.required' => 'Email is required',
            'password.required' => 'Password is required',
            'phone.required' => 'Phone is required',
            'phone.regex' => 'Phone is not correct format',
            'gender.required' => 'Gender is not correct',
            'address.required' => 'Address is required',
            'account_status.required' => 'Status is required',
        ];
    }
}
