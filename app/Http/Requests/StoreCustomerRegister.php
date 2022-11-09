<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreCustomerRegister extends FormRequest
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
            'name' => 'required|max:255',
            'email'=>'required|max:255|email|unique:customers,email',
            'phone'=>'required|numeric',
            'birthday' => 'required',
            'gender' => 'required|max:255',
            'password' => ['required', Password::defaults() ,'confirmed',],
            'g-recaptcha-response' => 'required|captcha',
        ];
    }

    public function messages(){
        return [
            'g-recaptcha-response.required' => 'Please verify that you are not a robot.',
            'g-recaptcha-response.captcha' =>  'Captcha error! try again later or contact site admin.',
        ];
    }
}
