<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required',
            'firstname' => 'required',
            'lastname'=> 'required',
            'date_of_birth' => 'required|date',
            'address'=>'required',
            'email'=>'required|email',
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'username.required' => 'Name is not null',
            'firstname.required' => 'Firstname is not null',
            'lastname.required' => 'Lastname is not null',
            'date_of_birth.required' => 'Date of birth is not null',
            'date_of_birth.date' => 'Date of birth is invalid',
            'address.required' => 'Address is not null',
            'email.required' => 'Email is not null',
            'email.email' => 'Email is invalid',
        ];
    }
}
